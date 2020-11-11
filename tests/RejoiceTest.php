<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Prinx\Config;
use Rejoice\Simulator\Libs\Simulator;
use function Prinx\Dotenv\env;

class RejoiceTest extends TestCase
{
    public function __construct()
    {
        parent::__construct();
        loadEnv(realpath(__DIR__.'/../.env.example'));
    }

    public function testRequest()
    {
        $simulator = new Simulator;
        $config = new Config(__DIR__.'/../config/');

        $phoneNumber = $config->get('app.request_param_user_phone_number');
        $network = $config->get('app.request_param_user_network');
        $sessionId = $config->get('app.request_param_session_id');
        $ussdServiceOp = $config->get('app.request_param_request_type');
        $menuString = $config->get('app.request_param_user_response');

        $simulator->setPayload([
            $phoneNumber   => env('USSD_PHONE', '+000123456789'),
            $network       => env('USSD_NETWORK_MNC', '00'),
            $sessionId     => rand(1000000, 1999999),
            $ussdServiceOp => '1',
            $menuString    => env('USSD_CODE', '*380*57#'),
        ]);

        $simulator->setEndpoint(env('APP_URL', 'http://localhost/rejoice/public/index.php'));
        $response = $simulator->callUssd();
        $data = json_decode($response->data('data'), true);

        $this->assertTrue(is_array($data), 'Test USSD request successful');
        $this->assertTrue($data[$ussdServiceOp] == '2', 'Test Service code correct');
        $this->assertTrue($simulator->getPayload()[$sessionId] == $data[$sessionId], 'Test sessionID correct');
    }
}

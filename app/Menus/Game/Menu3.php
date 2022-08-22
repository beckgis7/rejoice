<?php

namespace App\Menus\Game;

use App\Menus\Menu;

class Menu3 extends Menu
{
    // public $answer;
    // public function before(){
    //     $responses = $this->previousResponses();
    //     $this->answer = $responses->get('Game::Menu2');
    // }

    public function message()
    {
        return [
            '',
            "Enter PIN to confirm",
            "GHS1 payment",
        ];
    }

    public function defaultNextMenu()
    {
        return 'Game::Menu4';
    }

    public function validate($response)
    {
        $this->sessionSave('momo-pin', $response);
        $pin = $this->sessionGet('momo-pin');
        log_JSON_file($pin, 'Momo-Pin');

        return [
            'minLen:1', 
            'maxLen:4', 
        ];
    }
}

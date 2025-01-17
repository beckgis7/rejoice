<?php

    use App\Helpers\CurlUtils;
    use function Prinx\Dotenv\env;

    function api_caller($method, $payload, $endpoint, $headers)
    {
        $curl_handle = curl_init();
        switch ($method) {
            case 'POST':
                curl_setopt($curl_handle, CURLOPT_POST, 1);
                if ($payload) {
                    curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $payload);
                }
                break;
            case 'PUT':
                curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, 'PUT');
                if ($payload) {
                    curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $payload);
                }
                break;
            case 'GET':
                if ($payload) {
                    curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $payload);
                }
                break;
            default:
                if ($payload) {
                    curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $payload);
                }
        }
        curl_setopt($curl_handle, CURLOPT_URL, $endpoint);
        curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl_handle);
        $err = curl_error($curl_handle);
        curl_close($curl_handle);

        return $result;
    }

    function get_genders()
    {
        $headers = ['Content-Type:application/json'];

        $payload = [];

        $endpoint = env('API_BASE_URL').'genders';

        $resp = CurlUtils::callAPI('GET', $payload, $endpoint, $headers);
        $resp = json_decode($resp, true);

        $gender = [];
        foreach ($resp['data'] as $res) {
            $gender[] = $res['name'];
        }
        //log_JSON_file($gender,'GENDER');
        return $gender;
    }

    function get_auxes($service_name)
    {
        $headers = ['Content-Type:application/json'];
        $payload = [];

        $endpoint = env('API_BASE_URL').$service_name;

        $resp = CurlUtils::callAPI('GET', $payload, $endpoint, $headers);
        $data = json_decode($resp, true);

        return $data['data'];
    }

    function get_auxes_by_id($service_name, $id)
    {
        $headers = ['Content-Type:application/json'];
        $payload = [];

        $endpoint = env('API_BASE_URL').$service_name.'/'.$id;

        $resp = CurlUtils::callAPI('GET', $payload, $endpoint, $headers);

        $data = json_decode($resp, true);

        return $data['data'];
    }

    function post_data($service_name, $payload, $headers)
    {
        $endpoint = env('API_BASE_URL').$service_name;

        $resp = CurlUtils::callAPI('POST', $payload, $endpoint, $headers);

        return json_decode($resp, true);

        //return $data['data'];
    }

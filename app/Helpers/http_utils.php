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

//..........................................................................................................................................................................
    function get_data($service_name)
    {
        $headers = array('Content-Type:application/json');
        $payload = [];
        $endpoint = env('API_BASE_URL').$service_name;

        $resp = CurlUtils::callAPI('GET', $payload, $endpoint, $headers);

        return json_decode($resp, true);

    }
    function get_data_id($service_name,$id)
    {
        $headers = array('Content-Type:application/json');
        $payload = [];
        $endpoint = env('API_BASE_URL').$service_name.$id;

        $resp = CurlUtils::callAPI('GET', $payload, $endpoint, $headers);

        return json_decode($resp, true);

    }

    function post_data($service_name, $payload)
    {
        $headers = array('Content-Type:application/json');
        $endpoint = env('API_BASE_URL').$service_name;

        $resp = CurlUtils::callAPI('POST', $payload, $endpoint, $headers);

        return json_decode($resp, true);

        //return $data['data'];
    }

    function get_alpha_range($index): string
    {
        switch ($index){
            case 1:
                $range = 'A-C';
            break;
            case 2:
                $range = 'E-O';
                break;
            case 3:
                $range = 'S-W';
                break;
            default:
                $range = 'V-Z';
        }
        return $range;
    }

/*    620	03	gh	Ghana	233	Airtel/Tigo
620	06	gh	Ghana	233	Airtel/Tigo
620	04	gh	Ghana	233	Expresso Ghana Ltd
620	07	gh	Ghana	233	GloMobile
620	01	gh	Ghana	233	MTN
620	02	gh	Ghana	233	Vodafone*/
    function mnc_name($mnc){
       switch ($mnc){
           case 01:
               return 'MTN';
           case 02:
               return 'VDF';
           case 03:
           case 06:
               return 'ATL';
           case 04:
               return 'Expresso';
           case 07:
               return 'Glo';
           default:
               return null;
       }
    }

<?php

    namespace App\Helpers;

    class CurlUtils
    {
        public static function callAPI($method, $payload, $endpoint, $headers)
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
            curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, 0);
            $result = curl_exec($curl_handle);
            $err = curl_error($curl_handle);
            curl_close($curl_handle);

            return $result;
        }

        public static function logJSONFile($my_data, $tag = 'untagged')
        {
            if (env('LOG_JSON')) {
                $json_file = json_encode($my_data, JSON_PRETTY_PRINT);
                $fileName = $tag.'_'.time().'_datafile.json';
                $dir = '/json_logs/';
                $file_path = storage_path($dir.$fileName);
                file_put_contents($file_path, $json_file);
            }
            return true;
        }

    }

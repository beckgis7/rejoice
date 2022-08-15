<?php

    use function Prinx\Dotenv\env;

    function log_JSON_file($my_data, $tag = 'untagged')
    {
        if (env('LOG_JSON')) {
            $json_file = json_encode($my_data, JSON_PRETTY_PRINT);
            $fileName = $tag.'_'.time().'_datafile.json';
            $dir = 'json_logs/';
            $file_path = storage_path($dir.$fileName);
            file_put_contents($file_path, $json_file);
        }
    }


<?php

    function create_directory($path)
    {
        if (!file_exists($path)) {
            if (!mkdir($path, 0777, true) && !is_dir($path)) {
                throw new \RuntimeException(sprintf('Directory "%s" was not created', $path));
            }
        }

        return $path;
    }

    /**
     * recursively create a long directory path.
     */
    function create_dir($path)
    {
        if (is_dir($path)) {
            return true;
        }
        $prev_path = substr($path, 0, strrpos($path, '/', -2) + 1);
        $return = create_dir($prev_path);

        return ($return && is_writable($prev_path)) ? mkdir($path) : false;
    }

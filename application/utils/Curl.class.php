<?php
// application/utils/Curl.class.php

// Application utilities

class Curl {

    // url :: string -> [string => string]
    public static function url($url) {
        $handle = curl_init();

        curl_setopt_array($handle, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_USERAGENT => $_SERVER['HTTP_USER_AGENT'],
        ]);

        $data = curl_exec($handle);

        curl_close($handle);

        return json_decode($data, true);
    }
}
<?php

if (!defined('ABSPATH')) {
    exit;
}

class AnkerRest
{
    public static function exec($method, $url, $obj = [])
    {
        if (!$settings = (object)unserialize(get_option('connect_options'))) {
            return false;
        }

        $curl = curl_init();

        switch ($method) {
            case 'GET':
                if (strpos($url, '?') === false && !empty($obj)) {
                    $url .= '?' . http_build_query($obj);
                }
                break;

            case 'POST':
                curl_setopt($curl, CURLOPT_POST, true);
                curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($obj));
                break;

            case 'PUT':
            case 'DELETE':
            default:
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, strtoupper($method)); // method
                curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($obj)); // body
        }

        $headers = [
            'Accept: application/json',
            'Content-Type: application/json',
        ];

        $headers[] = 'Authorization: Bearer ' . $settings->private_token;

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_URL, 'https://connect.5-anker.com/' . $url);
        curl_setopt($curl, CURLOPT_HEADER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        // Exec
        $response = curl_exec($curl);
        $info = curl_getinfo($curl);
        curl_close($curl);

        // Data
        $header = trim(substr($response, 0, $info['header_size']));
        $body = substr($response, $info['header_size']);

        return json_decode($body);
    }

    public static function get($url, $obj = [])
    {
        return static::exec('GET', $url, $obj);
    }

    public static function post($url, $obj = [])
    {
        return static::exec('POST', $url, $obj);
    }

    public static function put($url, $obj = [])
    {
        return static::exec('PUT', $url, $obj);
    }

    public function delete($url, $obj = [])
    {
        return static::exec('DELETE', $url, $obj);
    }
}

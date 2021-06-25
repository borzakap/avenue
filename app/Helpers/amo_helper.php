<?php

use League\OAuth2\Client\Token\AccessToken;

if (!function_exists('amo_save_token')) {

    /**
     * @param array $accessToken
     */
    function amo_save_token($accessToken) {
        if (
                isset($accessToken) && isset($accessToken['accessToken']) && isset($accessToken['refreshToken']) && isset($accessToken['expires']) && isset($accessToken['baseDomain'])
        ) {
            $data = [
                'accessToken' => $accessToken['accessToken'],
                'expires' => $accessToken['expires'],
                'refreshToken' => $accessToken['refreshToken'],
                'baseDomain' => $accessToken['baseDomain'],
            ];

            helper('filesystem');

            write_file(WRITEPATH.'amo/token.json', json_encode($data));
        } else {
            exit('Invalid access token ' . var_export($accessToken, true));
        }
    }

}

if (!function_exists('amo_get_token')) {

    /**
     * @return AccessToken
     */
    function amo_get_token() {
        if (!file_exists(WRITEPATH.'amo/token.json')) {
            exit('Access token file not found');
        }

        $accessToken = json_decode(file_get_contents(WRITEPATH.'amo/token.json'), true);

        if (
                isset($accessToken) && isset($accessToken['accessToken']) && isset($accessToken['refreshToken']) && isset($accessToken['expires']) && isset($accessToken['baseDomain'])
        ) {
            return new AccessToken([
                'access_token' => $accessToken['accessToken'],
                'refresh_token' => $accessToken['refreshToken'],
                'expires' => $accessToken['expires'],
                'baseDomain' => $accessToken['baseDomain'],
            ]);
        } else {
            exit('Invalid access token ' . var_export($accessToken, true));
        }
    }

}

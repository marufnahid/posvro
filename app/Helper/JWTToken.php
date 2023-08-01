<?php

namespace App\Helper;

use Firebase\JWT\Key;

class JWTToken
{
    public static function createJWTToken($userEmail):string
    {
        $key = env('JWT_SECRET');
        $payload = array(
            "iss" => "laravel-jwt",
            "iat" => time(),
            "exp" => time() + 3600,
            "userEmail" => $userEmail
        );
        return \Firebase\JWT\JWT::encode($payload, $key, 'HS256');
    }

    public static function validateJWTToken($token)
    {
        try {
            if($token == null){
                return 'unauthorized';
            }else {
                $key = env('JWT_SECRET');
                $decoded = \Firebase\JWT\JWT::decode($token, new Key($key, 'HS256'));
                return $decoded->userEmail;
            }
        } catch (\Exception $e) {
            return false;
        }
    }
}

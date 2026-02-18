<?php

namespace App\Services;

use Exception;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use stdClass;

class JwtService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function GenerateJwt($credential){
        $key = env('JWT_SECRET');
        $payload = [
            'iss' => 'jkbfest',
            'aud' => 'jkbfest',
            'id' => $credential['id'],
            'name' => $credential['nama'],
            'email' => $credential['email'],
            'exp' => time() + 10800
        ];


        $jwt = JWT::encode($payload,$key,'HS256');
        return $jwt;
    }

    public static function DecodeJwt($token){
        $key = env('JWT_SECRET');
        // veriyfing jwt
        try{
            $decode = JWT::decode($token , new Key($key , 'HS256'));
        }catch (ExpiredException $e){
            return ['status' => false , 'type' => 'expired'];
        }
        catch (Exception $e){
            return ['status' => false , 'type' => 'invalid'];
        }
        return ['status' => true , 'type' => 'success'];
    }

    public static function GetVar($token){
        $key = env('JWT_SECRET');
        $std = new stdClass();
        $user = JWT::decode($token , new Key($key , 'HS256'));
        return $user;
    }
}

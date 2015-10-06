<?php

namespace DaGopherboy\SilexJWTRestPhp\Routes\Open;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Firebase\JWT\JWT;

class AuthenticateProvider
{
    public function authenticate(Application $app, Request $request)
    {
        $username = $request->get('username');
        $password = $request->get('password');

        if ($username == 'test' && $password == 'test') {
            $jsonObject = array(
                "iss" => "DaGopherboy", // Claiming Issure (Can't be validated atm)
                "aud" => "https://github.com/DaGopherboy/Silex-JWT-Rest-Php", // Intended Audience
                "iat" => time(), // Issued At Time
                "nbf" => time(), // Not Before Time
                "exp" => time()+60*60*24, // Expiration Time
            );

            $someSuperSecretKey = getenv('SomeSuperSecretKey');

            if(empty($someSuperSecretKey)) {
                $someSuperSecretKey = '123456789';
            }

            $jsonWebToken = JWT::encode($jsonObject, $someSuperSecretKey);

            return $app->json([
                               'status' =>  1,
                               'message' => $jsonWebToken
                                ]);
        } else {

                return $app->json(['status' => 0,
                    'message' => 'Failed to Authenticate']);
            }

    }
}

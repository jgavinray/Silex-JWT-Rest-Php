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
                // Registered Claims
                "iss" => "DaGopherboy", // Claiming Issure
                "aud" => "https://github.com/DaGopherboy/Silex-JWT-Rest-Php", // Intended Audience
                "iat" => time(), // Issued At Time
                "nbf" => time(), // Not Before Time
                "exp" => time()+60*60*24, // Expiration Time (24 hours)
                // Public Claims
                "payload" => [
                    "firstName" => "Test",
                    "lastName" => "Tester",
                    "title" => "Head of Quality Assurance",
                    "admin" => true
                ]
            );

            // Get the secret key for signing the JWT from an environment variable
            $someSuperSecretKey = getenv('SomeSuperSecretKey');

            // If no environment variable is set, use this one.
            if(empty($someSuperSecretKey)) {
                $someSuperSecretKey = '123456789';
            }

            // Sign the JWT with the secret key
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

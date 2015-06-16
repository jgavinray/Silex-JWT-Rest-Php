<?php

namespace DaGopherboy\SilexJWTRestPhp\Routes\Open;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class AuthenticateProvider
{
    public function authenticate(Application $app, Request $request)
    {
        $username = $request->get('username');
        $password = $request->get('password');

        if ($username == 'test' && $password == 'test') {
            $jsonObject = array(
                "iss" => "https://github.com/firebase/php-jwt",
                "aud" => "https://github.com/DaGopherboy/Silex-JWT-Rest-Php",
                "iat" => time(),
                "exp" => time()+60*60*24, // 24 hours
                "jti" => time()
            );

            $jsonWebToken = \JWT::encode($jsonObject, '12345667890');

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

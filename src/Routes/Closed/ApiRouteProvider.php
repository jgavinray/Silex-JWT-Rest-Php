<?php

namespace DaGopherboy\SilexJWTRestPhp\Routes\Closed;

use Silex\Application;
use Silex\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Firebase\JWT\JWT;

class ApiRouteProvider implements ControllerProviderInterface
{
    public function connect(Application $app)
    {
        $route = $app['controllers_factory'];

        $before = function (Request $request) use ($app) {
            // Validation here - Check JWT or whatever

            // Strip out the bearer
            $rawHeader = $request->headers->get('Authorization');
            if (strpos($rawHeader, 'Bearer ') === false) {
                return new Response('Unauthorized', 401);
            }

            $headerWithoutBearer = str_replace('Bearer ', '', $rawHeader);

            // Get the secret key for signing the JWT from an environment variable
            $someSuperSecretKey = getenv('SomeSuperSecretKey');

            // If no environment variable is set, use this one.
            if(empty($someSuperSecretKey)) {
                $someSuperSecretKey = '123456789';
            }

            try {
                $decodedJWT = JWT::decode($headerWithoutBearer, $someSuperSecretKey, ['HS256']);
            }  catch (Exception $e) {
                return new Response('Unauthorized', 401);
            }

            $app['payload'] = $decodedJWT->payload;
        };

        $route->get('/', function () use ($app) {
            return $app->json([
                'status'     =>  1,
                'message'    => json_encode($app['payload'])
            ]);
        })->before($before);

        return $route;
    }
}

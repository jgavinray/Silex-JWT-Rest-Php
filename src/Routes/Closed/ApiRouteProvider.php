<?php

namespace DaGopherboy\SilexJWTRestPhp\Routes\Closed;

use Silex\Application;
use Silex\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\Request;

class ApiRouteProvider implements ControllerProviderInterface
{
    public function connect(Application $app)
    {
        $route = $app['controllers_factory'];

        $before = function (Request $request) {
            // Validation here - Check JWT or whatever
        };

        $route->get('/', function () use ($app) {
            return $app->json([
                'status'     =>  1,
                'message'    => 'Something'
            ]);
        })->before($before);
        return $route;
    }
}

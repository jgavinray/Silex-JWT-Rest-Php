<?php

namespace DaGopherboy\SilexJWTRestPhp\Routes\Open;

use Silex\Application;
use Silex\ControllerProviderInterface;

class RootRouteProvider implements ControllerProviderInterface
{
    public function connect(Application $app)
    {
        $route = $app['controllers_factory'];
        $route->get('/', function () use ($app) {
            return $app->json([
                'status'     =>  0,
                'message'    => 'Access Denied'
            ]);
        });
        return $route;
    }
}

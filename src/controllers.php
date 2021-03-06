<?php

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use DaGopherboy\SilexJWTRestPhp\Routes\Closed\ApiRouteProvider;
use DaGopherboy\SilexJWTRestPhp\Routes\Open\RootRouteProvider;

$app->mount('/', new RootRouteProvider);
$app->mount('/api', new ApiRouteProvider);
$app->match('/authenticate', "DaGopherboy\SilexJWTRestPhp\Routes\Open\AuthenticateProvider::authenticate");

$app->error(function (\Exception $e, $code) {
    switch ($code) {
        case 404:
            $message = 'The requested page could not be found.';
            break;
        default:
            $message = "We are sorry, but something went terribly wrong. $e";
    }
    return new Response($message, $code);
});

return $app;

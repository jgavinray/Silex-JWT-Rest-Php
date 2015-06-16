<?php

use Symfony\Component\HttpFoundation\Response;
use DaGopherboy\SilexJWTRestPhp\Routes\Open\RootRouteProvider;
//use DaGopherboy\SilexJWTRestPhp\Routes\Open\AuthenticateProvider;

$app->mount('/', new RootRouteProvider);
$app->match('/authenticate', new AuthenticateProvider::authenticate);

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

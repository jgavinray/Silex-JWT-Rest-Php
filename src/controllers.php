<?php

use Symfony\Component\HttpFoundation\Response;
use DaGopherboy\SilexJWTRestPhp\Routes\Open\RootRouteProvider;

$app->mount('/', new RootRouteProvider);

$app->error(function (\Exception $e, $code) use ($app) {
    switch ($code) {
        case 404:
            $message = 'The requested page could not be found.';
            break;
        default:
            $message = 'We are sorry, but something went terribly wrong.';
    }
    return new Response($message, $code);
});
return $app;

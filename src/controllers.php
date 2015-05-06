<?php
use Symfony\Component\HttpFoundation\Response;

$app->get('/', function() use($app) {
    return $app->json([ 'status'     => 0,
                        'message'    => 'Access Denied']);
});

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

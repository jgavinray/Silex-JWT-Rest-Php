<?php

use Silex\WebTestCase;
use Silex\Application;

class AuthenticateTest extends WebTestCase
{
    public function createApplication()
    {
        $app = new Application();
        require __DIR__.'/../../src/app.php';
        $app['session.test'] = true;
        // Controllers
        require __DIR__ . '/../../src/controllers.php';
        return $this->app = $app;
    }

    public function testAuthenticateCheckStatus() {
        $client = $this->createClient();
        $userDetails = ['username'  => 'test',
                        'password'  => 'test',
        ];
        $client->request('Post', '/authenticate',$userDetails);
        $response = json_decode($client->getResponse()->getContent());
        $this->assertEquals($response->status,1);
    }

    public function testAuthenticateCheckStatusCode() {
        $client = $this->createClient();
        $client->request('Post', '/authenticate');
        $this->assertEquals(200,$client->getResponse()->getStatusCode());
    }
}

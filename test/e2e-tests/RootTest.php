<?php

use Silex\WebTestCase;
use Silex\Application;


class RootTest extends WebTestCase
{

    public function createApplication()
    {
        $app = new Application();
        require __DIR__ . '/../../src/app.php';
        require __DIR__ . '/../../src/controllers.php';
        return $this->app = $app;
    }

    public function testRootForStatus() {
        $client = $this->createClient();

        $client->request('GET', '/');
        $response = json_decode($client->getResponse()->getContent());
        $this->assertEquals($response->status,0);
    }

    public function testRootForMessage() {
        $client = $this->createClient();

        $client->request('GET', '/');
        $response = json_decode($client->getResponse()->getContent());
        $this->assertEquals($response->message,'Access Denied');
    }
}

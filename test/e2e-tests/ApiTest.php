<?php

use Silex\WebTestCase;
use Silex\Application;


class ApiTest extends WebTestCase
{

    public function createApplication()
    {
        $app = new Application();
        require __DIR__ . '/../../src/app.php';
        require __DIR__ . '/../../src/controllers.php';
        return $this->app = $app;
    }

    public function testApiForStatus() {
        $client = $this->createClient();

        $client->request('GET', '/api/');
        $response = json_decode($client->getResponse()->getContent());
        $this->assertEquals($response->status,1);
    }

    public function testApiForMessage() {
        $client = $this->createClient();

        $client->request('GET', '/api/');
        $response = json_decode($client->getResponse()->getContent());
        $this->assertEquals($response->message,'Something');
    }
}

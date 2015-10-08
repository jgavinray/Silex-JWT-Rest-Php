<?php

use Silex\WebTestCase;
use Silex\Application;


class ApiTest extends WebTestCase
{

    protected $jwt;
    protected $validuser = 'test';
    protected $validpassword = 'test';

    public function createApplication()
    {
        $app = new Application();
        require __DIR__ . '/../../src/app.php';
        require __DIR__ . '/../../src/controllers.php';
        return $this->app = $app;
    }

    public function testApiForStatus() {
        if(empty($this->jwt)){
            $this->getTokenWithValidUsernameAndPassword();
        }

        $client = $this->createClient();

        $client->request('GET',
                         '/api/',
                         [],
                         [],
                         ['HTTP_AUTHORIZATION' => "Bearer $this->jwt"]
        );
        $response = json_decode($client->getResponse()->getContent());
        $this->assertEquals($response->status,1);
    }

    public function testApiForMessage() {
        if(empty($this->jwt)){
            $this->getTokenWithValidUsernameAndPassword();
        }

        $client = $this->createClient();

        $client->request('GET',
                         '/api/',
                         [],
                         [],
                         ['HTTP_AUTHORIZATION' => "Bearer $this->jwt"]
        );
        $response = json_decode($client->getResponse()->getContent());
        $this->assertEquals($response->message,'{"firstName":"Test","lastName":"Tester","title":"Head of Quality Assurance","admin":true}');
    }

    public function getTokenWithValidUsernameAndPassword() {
        $client = $this->createClient();
        $userDetails = ['username'  => $this->validuser,
                        'password'  => $this->validpassword,
        ];
        $client->request('POST', '/authenticate', $userDetails);
        $response = json_decode($client->getResponse()->getContent());
        $this->jwt = $response->message;
    }
}

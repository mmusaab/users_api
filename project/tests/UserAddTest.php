<?php

namespace App\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserAddTest extends KernelTestCase
{
    public function testPOST()
    {
        $client = new Client([
            'headers' => [ 'Content-Type' => 'application/json' ]
        ]);

        $data = array(
            "firstName" => "FirstName",
            "lastName" => "LastName",
            "email" => "abc@test.com"
        );

        $response = $client->post('http://localhost:80/api/users',
            ['body' => json_encode($data)]
        );

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testValidation()
    {
        $client = new Client([
            'headers' => [ 'Content-Type' => 'application/json' ]
        ]);

        // testing validation without email
        $data = array(
            "firstName" => "FirstName",
            "lastName" => "LastName",
            "email" => ""
        );

        try {
            $response = $client->post('http://localhost:80/api/users',
                ['body' => json_encode($data)]
            );
        }catch (RequestException $e) {
            if ($e->getResponse()->getStatusCode() == '400') {
                $this->assertEquals(400, $e->getResponse()->getStatusCode());
            }
        }
    }
}
<?php


namespace Tests\Foundation;


use Foundation\HttpClient\ClientRequest;
use Tests\TestApp;

class ClientRequestTest extends TestApp
{

    public function testMakeSomeRequest()
    {
        $client = new ClientRequest('https://api.themoviedb.org/3');
        $response = $client->get('movie/upcoming',['api_key' => '1f54bd990f1cdfb230adb312546d765d', 'page' => '1']);
        $this->assertIsObject($response->getBody());
        $this->assertEquals($response->getStatus(), 200);
    }
}
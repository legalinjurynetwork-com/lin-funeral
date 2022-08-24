<?php 
namespace App\Http\API;

class MockClient implements ClientInterface
{    
    public function sendRequest($endpoint='', $data=[])
    {
        $dataPoints = include('config/konnektiveResponses.php');
        return $dataPoints[$endpoint];
    }    
}

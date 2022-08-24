<?php 
namespace App\Http\API;

use App\Http\API\ClientInterface;


 
class Client implements ClientInterface
{
    public $baseUrl;
    public $loginId;
    public $password;
    
    public function sendRequest($endpoint='', $data=[])
    {
        $apiUrl = $this->baseUrl . $endpoint . '?loginId=' . $this->loginId . '&password=' . $this->password . '&' . http_build_query($data);
        //$apiUrl = 'https://api.konnektive.com/leads/import/?loginId=lab270&password=Shared123$&firstName=Test&lastName=Robinson&address1=4455+Hollywood+Blvd&address2=Apt.+1120&postalCode=00012&city=Rome&state=NY&country=US&emailAddress=Robinson@email.net&phoneNumber=11233399&shipFirstName=Test&shipLastName=Robinson&shipAddress1=4455+Hollywood+Blvd&shipAddress2=Apt.+1120&shipPostalCode=00012&shipCity=Rome&shipState=NY&shipCountry=US&campaignId=1';
        //$apiUrl = 'https://api.konnektive.com/leads/import?loginId=lab270&password=Shared123$campaignId=1&address1=12895+Tracey+Knolls+Suite+986&address2=12895+Tracey+Knolls+Suite+986&city=Lailabury&state=Oregon&postalCode=53559&country=MG&emailAddress=dangelo87%40gmail.com&firstName=Icie&lastName=Shanahan&ipAddress=197.155.205.66&phoneNumber=1-834-363-2051&shipAddress1=368+Streich+Falls+Apt.+880&shipAddress2=Suite+932&shipCity=Weimannport&shipFirstName=Kellie&shipLastName=Bode&shipState=District+of+Columbia&shipPostalCode=89014&shipCountry=KE'
        //dd($apiUrl);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $apiUrl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

}



 ?>
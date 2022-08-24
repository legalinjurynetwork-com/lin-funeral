<?php


namespace App\Http\API;
use Faker\Generator as Faker;
use App\Http\API\ClientInterface;
use App\Http\API\Client;

class Konnektive
{
    private $baseUrl = 'https://api.konnektive.com';
    private $loginId;
    private $password;
    private $client;

    public function __construct($loginId='', $password='', ClientInterface $client)
    {
        $this->loginId = $loginId;
        $this->password = $password;
        $this->client = $client;
        $this->client->loginId = $loginId;
        $this->client->password = $password;
        $this->client->baseUrl = $this->baseUrl;

    }

    public function __get($name)
    {
        If (isset($this->$name)) {
            return $this->$name;
        }
    }

    public function importLead($data=[])
    {
        $data = [
            'campaignId' => $data['campaign_id'],
            'address1' => $data['billing_address1'],
            'address2' => $data['billing_address2'],
            'city' => $data['billing_city'],
            'state' => $data['billing_region'],
            'postalCode' => $data['billing_postal_code'],
            'country' => $data['billing_country'],
            'emailAddress' => $data['email_address'],
            'firstName' => $data['billing_first_name'],
            'lastName' => $data['billing_last_name'],
            'ipAddress' => $data['ip_address'],
            'phoneNumber' => $data['phone_number'],
            'shipAddress1' => $data['shipping_address1'],
            'shipAddress2' => $data['shipping_address2'],
            'shipCity' => $data['shipping_city'],
            'shipFirstName' => $data['shipping_first_name'],
            'shipLastName' => $data['shipping_last_name'],
            'shipState' => $data['shipping_region'],
            'shipPostalCode' => $data['shipping_postal_code'],
            'shipCountry' => $data['shipping_country'],
        ];
        return $this->client->sendRequest('/leads/import/', $data);
    }

    public function importOrder($data)
    {
        $data = [
            'orderId' => $data["orderId"],
            'cardNumber' => $data["cardNumber"],
            'cardExpiryDate' => $data["cardExpiryDate"],
            'cardSecurityCode' => $data["cardSecurityCode"],
            'paySource' => 'CREDITCARD',
            'product1_id' => $data["product_id"],
            'variant1_id' => $data["variantDetailId"],
        ];
        
    
        // foreach ($products as $key => $product) {
        //     $productNumber = $key + 1;
        //     $data['product' . $productNumber . '_id'] = $product['id'];
        //     $data['product' . $productNumber . '_qty'] = $product['quantity'];
        // }
        return $this->client->sendRequest('/order/import/', $data);
    }

    public function importUpsale($orderId='', $productId='', $productQuantity=1)
    {
        $data = [
            'orderId' => $orderId,
            'productId' => $productId,
            'productQty' => $productQuantity
        ];
        return $this->client->sendRequest('/upsale/import/', $data);
    }

    public function queryCampaign($campaignId='')
    {
        $data = [
            'campaignId' => $campaignId,
            'resultsPerPage' => 200,
            'showAllProducts' => 1,
        ];
        return $this->client->sendRequest('/campaign/query/', $data);
    }

}

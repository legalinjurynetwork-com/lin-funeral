<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Faker\Factory;
use App\Http\API\Konnektive;
use App\User;
use App\Classes\Cart\Cart;
use App\Classes\Cart\CartItem;
use \App\Product;
use App\Models\Customer;

class TestingController extends Controller
{
    
    function __construct(){
        // $this->middleware('web');
    }
    
    public function testing(Konnektive $konnektive){
        return 200;
        $faker = Factory::create('en_US');
        $customer = Customer::find(1);
        $lead = $konnektive->importLead(1, $customer);
        
        $orderId = json_decode($lead)->message->orderId; //1401A5549B
        
        echo $orderId;
        $order = $konnektive->importOrder($orderId, '7373461669202733', '08/25', '100');
        dd($order);
    }
    
    public function test_view(){
        $cart = new Cart;
        return view("testing", ["cart" => $cart]);
    }
    
    public function import_lead(){
        
        $konnektive = new Konnektive('lab270', 'Shared123$');
        $faker = Factory::create('en_US');
        
        $data = [
            'billing_address1' => $faker->streetAddress,
            'billing_address2' => $faker->secondaryAddress,
            'billing_first_name' => $faker->firstName,
            'billing_last_name' => $faker->lastName,
            'billing_city' => $faker->city,
            'billing_region' => $faker->state,
            'billing_postal_code' => $faker->postcode,
            'billing_country' => $faker->countryCode,
            'shipping_address1' => $faker->streetAddress,
            'shipping_address2' => $faker->secondaryAddress,
            'shipping_first_name' => $faker->firstName,
            'shipping_last_name' => $faker->lastName,
            'shipping_city' => $faker->city,
            'shipping_region' => $faker->state,
            'shipping_postal_code' => $faker->postcode,
            'shipping_country' => $faker->countryCode,
            'ip_address' => $faker->ipv4,
            'email_address' => $faker->email,
            'phone_number' => $faker->e164PhoneNumber
        ];
        
        $response = $konnektive->importLead($data);
        
        dd($response);
    }
    
    
    public function preauth_order(){
        $konnektive = new \App\Http\API\Konnektive('lab270', 'Shared123$');
        $response = $konnektive->preauthOrder('90390A87C6', '7373461669202733', '08/25', '100');
        
        dd($response);
    }
    
    public function query_campaign(){
        $konnektive = new \App\Http\API\Konnektive('lab270', 'Shared123$');
        $response = $konnektive->queryCampaign();
        
        dd($response);
    }
}

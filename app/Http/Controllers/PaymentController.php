<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Http\API\Konnektive;
use App\Models\Customer;
use App\Models\Order;
use App\Classes\Encryption;

class PaymentController extends Controller
{
    
    protected $konnektive;
    
    function __construct(Konnektive $konnektive)
    {
        $this->konnektive = $konnektive;
    }
    
    public function payment1(Request $request){
        $data = $request->all();
        // GET CUSTOMER
        $customer_id = \Session::get('customer_id');
        $customer = Customer::where("id", $customer_id)->first();
        $data["customer_id"] = $customer->id;
        if (!$customer){
            \Session::flash('error', "Could not determine customer info - returning user to landing page");
            return view("welcome");
        }
        
        // Merge Data with Customer Info
        $data = $this->createDataDependingOnSameBilling($data, $customer);
        
        // SET PRODUCT ID AND CAMPAIGN ID
        $product = \Session::get('product');
        $data["campaign_id"] = "2";  /// THIS SHOULD NEVER CHANGE UNLESS A NEW CAMPAIGN IN KONNEKTIVE IS CREATED
        $data["product_id"] = config("products.$product.product_id");  // NEW PRODUCTS CAN BE UDPATED/CHANGED 
        $data["variantDetailId"] = config("products.$product.variantDetailId"); // THIS IS THE VARIENT ID OF THAT PRODUCT IN KONNEKTIVE. 
        
        // IMPORT LEAD, CHARGE CARD, AND Save Order
        $order = $this->importLeadThenChargeCardThenSaveOrder($data);
        $decoded_order = json_decode($order);
        
        if ($decoded_order->result == "SUCCESS") {
            $data["product_list"] = [$product];
            // ENCRYPT DATA AND SAVE TO SESSION
            $encyption = new Encryption;
            \Session::put('data', $encyption->encrypt(json_encode($data)));
            // FLASH SUCESS AND REDIRECT TO VIEW
            \Session::flash('success', "Order Created Successfully");
            return redirect("U10");
        
        } else {
            
            \Session::flash('error', $decoded_order->result);
            return redirect()->back();
        }
    
    }
    
    
    public function payment2(Request $request, Konnektive $konnektive)
    {
        // GET DATA
        $encyption = new Encryption;
        $sessionData = \Session::get('data');
        $data = (array) json_decode($encyption->decrypt($sessionData));
        $data["product_id"] = "56";
        $data["variantDetailId"] = "";
        // IMPORT LEAD, CHARGE CARD, AND Save Order
        
        $order = $this->importLeadThenChargeCardThenSaveOrder($data);
        
        
        
        $decoded_order = json_decode($order);
        
        if ($decoded_order->result == "SUCCESS") {
            array_push($data["product_list"], "bonus_bottle");
            
            
            // ENCRYPT DATA AND SAVE TO SESSION
            $encyption = new Encryption;
            \Session::put('data', $encyption->encrypt(json_encode($data)));
            // FLASH SUCESS AND REDIRECT TO VIEW
            \Session::flash('success', "Order Created Successfully");
            return redirect("U15");
        
        } else {
            \Session::flash('error', "Credit Card was not charged. Please try again.");
            return redirect()->back();
        }
        
    }
    
    public function payment3(Request $request, Konnektive $konnektive)
    {
        // GET DATA
        $encyption = new Encryption;
        $sessionData = \Session::get('data');
        $data = (array) json_decode($encyption->decrypt($sessionData));
        $data["product_id"] = "71";
        $data["variantDetailId"] = "93";
        // IMPORT LEAD, CHARGE CARD, AND Save Order
        $order = $this->importLeadThenChargeCardThenSaveOrder($data);
        $decoded_order = json_decode($order);
        
        if ($decoded_order->result == "SUCCESS") {
            array_push($data["product_list"], "scratch_repair");
            // ENCRYPT DATA AND SAVE TO SESSION
            $encyption = new Encryption;
            \Session::put('data', $encyption->encrypt(json_encode($data)));
            \Session::flash('success', "Order Created Successfully");
            return redirect("thankyou");
        } else {
            \Session::flash('error', "Credit Card was not charged. Please try again.");
            return redirect()->back();
        }

    }
    
    
    private function createDataDependingOnSameBilling($data, $customer){
        if (isset($data["same_billing"])) {
            // if same billing: subtract billing data from the request and merge customer billing
            unset($data["billing_first_name"]);
            unset($data["billing_last_name"]);
            unset($data["billing_address1"]);
            unset($data["billing_address2"]);
            unset($data["billing_city"]);
            unset($data["billing_region"]);
            unset($data["billing_postal_code"]);
            unset($data["billing_country"]);
            $data = array_merge($data, $customer->toArray());
        } else {
            // if different billing: subtract billing data from the customer and merge from request
            unset($customer["billing_first_name"]);
            unset($customer["billing_last_name"]);
            unset($customer["billing_address1"]);
            unset($customer["billing_address2"]);
            unset($customer["billing_city"]);
            unset($customer["billing_region"]);
            unset($customer["billing_postal_code"]);
            unset($customer["billing_country"]);
            $data = array_merge($data, $customer->toArray());
        }
        return $data;
    }
    
    
    private function chargeCardBasedOnEnv($data){
        
        if (env("APP_ENV") == "local") {
                
            return $this->konnektive->importOrder([ 'orderId' => $data["orderId"], 'cardNumber' => '0000000000000000', 'cardExpiryDate' => '08/25', 'cardSecurityCode' => '100', 'paySource' => 'CREDITCARD', 'product_id' => $data["product_id"], "variantDetailId" => $data["variantDetailId"]   ] );
        } else {
            $month = $data['month'];
            $year = $data['year'];
            $data["cardExpiryDate"] =  "$month/$year";
            $data["product1_id"] =  $data["product_id"];
            $data["cardSecurityCode"] = "cvv";
            return $this->konnektive->importOrder($data);
        }
        
    }
    
    private function saveOrderToDb($data, $decoded_order){
        $order = new Order;
        $order->customer_id = $data["customer_id"];
        $order->konnektive_order_id = $decoded_order->message->orderId;
        $order->konnektive_campaign_id = $decoded_order->message->campaignId;
        $order->konnektive_product_id = $decoded_order->message->items[0]->productId;
        $order->status = $decoded_order->result;
        $order->amount_paid = $decoded_order->message->amountPaid;
        $order->info =  json_encode($decoded_order->message);
        $order->save();
        return $order;
    }
    
    private function importLeadThenChargeCardThenSaveOrder($data){
        // IMPORT LEAD INTO KONNEKTIVE
        $lead = $this->konnektive->importLead($data);
        
        // attach order id if it exists.
        if (isset(json_decode($lead)->message->orderId)) {
            $data["orderId"] = json_decode($lead)->message->orderId;
        } else {
            $data["orderId"] = 0;
        }
        //Charge Card depending on Environment
        $order = $this->chargeCardBasedOnEnv($data);
        return $order;
        
        
        
    }
    
}


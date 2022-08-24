<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\Customer;
use \Carbon\Carbon;
use App\Classes\Encryption;
use App\Models\Lead;
// use Google\Client;
// use Google\Google_Service_Sheets_Sheet;
// use Google\Google_Service_Sheets;
// use Google\Google_Client;
use Google\Client;
use Illuminate\Support\Facades\Log;
use MailchimpMarketing\ApiClient;
use Revolution\Google\Sheets\Sheets;

use Illuminate\Support\Str;
use Session;

class PageController extends Controller
{
    public function welcome(){
        return view('home.welcome');
    }

    public function ebook(){
        return view('ebook.ebook');
    }

    public function ebookthankyou(){
        return view('ebook.thankyou');
    }

    public function privacy(){
        return view('privacy');
    }

    public function thankyou(){
        return view('home.thankyou');
    }

    public function leads(){
        $leads = Lead::all();
        return view('leads', ["leads" => $leads]);
    }

    public function terms_and_conditions(){
        return view('terms_and_conditions');
    }

    public function ccpa(){
        return view('ccpa');
    }

    public function donotsell(){
        return view('donotsell');
    }

    public function post(Request $request)
    {

        $data = $request->all();
        $first_name = $request->get('first_name', '');
        $last_name = $request->get('last_name', '');
        $age = $request->get('age', '');
        $phone_number = $request->get('phone_number', '');
        $email_address = $request->get('email_address', '');
        $postal_code = $request->get('postal_code', '');
        $address = $request->get('address', '');
        $isEbook = $request->has('is_ebook');


        // DATA FOR LEADSPEDIA.
        $postData = [
            'first_name' => $first_name,
            'last_name' => $last_name,
            'age' => $age,
            'email_address' => $email_address,
            'phone_home' => $phone_number,
            'zip_code' => $postal_code,
            'trusted_form_cert_id' => $request->get('xxTrustedFormCertUrl'),
            'lp_request_id' => $request->get('req_id'),
            'lp_campaign_id' => "60242f3ad7b92",
            'lp_campaign_key' => "2Bthkc7G9p3nyvZWjd4N",
            'lp_s1' => $request->get('s1'),
            'lp_s2' => $request->get('s2'),
            'lp_s3' => $request->get('s3'),
            'lp_s4' => $request->get('s4'),
            'lp_s5' => $request->get('s5'),
            'ip_address' => $request->get('ip_address'),
        ];

        // STRIP OUT ALL DATA AND ADD TO lp_s
        $dataStripped = $data;
        $unset = true;
        foreach ($dataStripped as $key => $d) {
            if ($unset) {
                unset($dataStripped [$key]);
            }
            if ($key === "opt_in") {
                $unset = false;
            }
        }
        unset($dataStripped["xxTrustedFormToken"]);
        unset($dataStripped["xxTrustedFormCertUrl"]);
        unset($dataStripped["xxTrustedFormPingUrl"]);
        $dataStrippedValues = array_values($dataStripped);

        // ADD STRIPPED DATA TO lp_s
        foreach ($dataStrippedValues as $key => $value) {
            $key_plus1 = $key + 1;
            $postData["lp_s$key_plus1"] = $value;
        }
        $postData = array_merge($postData, $data);
        //https://us1.api.mailchimp.com/3.0/lists/1539738/members
        //http://us1.api.mailchimp.com/3.0/lists/1539738/members


        // save lead to leadpedia
        $guzzle = new \GuzzleHttp\Client();
        $leadspediaUrl = "https://track.legalinjuryadvocates.com/post.do";
        $request = $guzzle->request('POST', $leadspediaUrl, [
            'form_params' => $postData
        ]);

        try {
            //send to mailchimp
            $mailchimp = new ApiClient();

            $mailchimp->setConfig([
                'apiKey' => 'feaf8aa6e3d84eb35b32564c94763b5f-us1',
                'server' => 'us1'
            ]);

            $mailchimp->lists->addListMember('b2b7fc9bb3', [
                'email_address' => $postData['email_address'],
                'status' => 'subscribed',
                'merge_fields' => [
                    'FNAME' => $postData['first_name'],
                    'LNAME' => $postData['last_name'],
                    'PHONE' => $postData['phone_home']
                ]
            ]);
        } catch (Exception $e) {
            Log::error('Couldnt save to Mailchimp');
        }

        // insert into database:
        $lead = new Lead;
        $lead->first_name = $first_name;
        $lead->last_name = $last_name;
        $lead->age = $age;
        $lead->phone_number = $phone_number;
        $lead->email_address = $email_address;
        $lead->postal_code = $postal_code;

        if ($lead->save()) {


            if($isEbook)
            {
                return redirect()->action('App\Http\Controllers\PageController@ebookthankyou');
            } else {
                return redirect()->action('App\Http\Controllers\PageController@thankyou');
            }

        } else {
            return redirect()->back()->with("error", "Form not submitted, please contact admin.");
        }
    }

    function addRowToSpreadsheet($data = array()) {


        $user = $request->user();

        $token = [
            'access_token'  => env(""),
            'refresh_token' => $user->refresh_token,
            'expires_in'    => $user->expires_in,
            'created'       => $user->updated_at->getTimestamp(),
        ];
        $values = Sheets::setAccessToken($token)->spreadsheet('spreadsheetId')->sheet('Sheet 1')->all();
    }

    public function prepaidFuneral(){
        return view('funeral.home');
    }

    public function prepaidFuneralConfirm(){
        return view('funeral.confirm');
    }

    public function funeralConfirmInfo(Request $request){
        $leadId = $request->get('lead_id');
        if($leadId){
            $lead = Lead::where("id", $leadId)->first();
            if($lead){
                return view('funeral.confirm-info',[
                    'lead' => $lead
                ]);
            }else{
                abort(404);
            }
        }else{
            abort(404);
        }
        
    }

    public function funeralConfirmInfoPost(Request $request){
        if(Session::has('lead')){
            $sessionLead = Session::get('lead');
            $sessionLeadId = $sessionLead['lead_id'];

            $lead = Lead::where("id", $sessionLeadId)->first();
        }else{
            $lead = Lead::where("id", $request->get('lead_id'))->first();
        }
        
        if($lead){
            Session::put('lead', ['lead_id' => $lead->id]);

            $lead->myselfyesno = $request->get('myselfyesno');
            $lead->postal_code = $request->get('zipcode');
            $lead->save(); 

            return redirect()->action('App\Http\Controllers\PageController@funeralConfirmInfoStep2');
        }
    }

    public function funeralConfirmInfoStep2(Request $request){

        if(Session::has('lead')){
            $sessionLead = Session::get('lead');
            $sessionLeadId = $sessionLead['lead_id'];
            if($sessionLeadId){
                return view('funeral.confirm-info-step2');
            }
        }
        else{
            abort(404);
        }
    }

    public function funeralConfirmInfoStep2Post(Request $request){
        $data = $request->all();

        $sessionLead = Session::get('lead');
        $sessionLeadId = $sessionLead['lead_id'];

        $lead = Lead::where("id", $sessionLeadId)->first();
        if($lead!=''){
            if($lead){
                Session::put('lead', ['lead_id' => $lead->id]);
                $lead->birthyear = $request->get('birthyear');
                $lead->save(); 

                return redirect()->action('App\Http\Controllers\PageController@funeralConfirmInfoStep3');
            }
        }
    }

    public function funeralConfirmInfoStep3(Request $request){
        if(Session::has('lead')){
            $sessionLead = Session::get('lead');
            $sessionLeadId = $sessionLead['lead_id'];
            if($sessionLeadId){
                return view('funeral.confirm-info-step3');
            }
        }
        else{
            abort(404);
        }
    }

    public function funeralConfirmInfoStep3Post(Request $request){
        $sessionLead = Session::get('lead');
        $sessionLeadId = $sessionLead['lead_id'];

        $lead = Lead::where("id", $sessionLeadId)->first();
        if($lead){
            Session::put('lead', ['lead_id' => $lead->id]);
            $lead->illnesshospice = $request->get('illnesshospice');
            $lead->save(); 
            Session::forget('lead');
            return redirect()->action('App\Http\Controllers\PageController@funeralThankyou');
        }
    }

    

    public function funeralPost(Request $request)
    {
        $data = $request->all();
        $first_name = $request->get('first_name', '');
        $last_name = $request->get('last_name', '');
        $phone_number = $request->get('phone_home', '');
        $email_address = $request->get('email_address', '');
        
        $phone_number =str_replace("-","",$phone_number);
        $phone_number =str_replace("(","",$phone_number);
        $phone_number =str_replace(")","",$phone_number);
        //$postal_code = $request->get('postal_code', '');

        // DATA FOR LEADSPEDIA.
        // $postData = [
        //     'first_name' => $first_name,
        //     'last_name' => $last_name,
        //     //'age' => $age,
        //     'email_address' => $email_address,
        //     'phone_home' => $phone_number,
        //     //'zip_code' => $postal_code,
        //     'trusted_form_cert_id' => $request->get('xxTrustedFormCertUrl'),
        //     'lp_request_id' => $request->get('req_id'),
        //     'lp_campaign_id' => "60242f3ad7b92",
        //     'lp_campaign_key' => "2Bthkc7G9p3nyvZWjd4N",
        //     'lp_s1' => $request->get('s1'),
        //     'lp_s2' => $request->get('s2'),
        //     'lp_s3' => $request->get('s3'),
        //     'lp_s4' => $request->get('s4'),
        //     'lp_s5' => $request->get('s5'),
        //     'ip_address' => $request->get('ip_address'),
        // ];

        // // STRIP OUT ALL DATA AND ADD TO lp_s
        // $dataStripped = $data;
        // $unset = true;
        // foreach ($dataStripped as $key => $d) {
        //     if ($unset) {
        //         unset($dataStripped [$key]);
        //     }
        //     if ($key === "opt_in") {
        //         $unset = false;
        //     }
        // }
        // unset($dataStripped["xxTrustedFormToken"]);
        // unset($dataStripped["xxTrustedFormCertUrl"]);
        // unset($dataStripped["xxTrustedFormPingUrl"]);
        // $dataStrippedValues = array_values($dataStripped);

        // // ADD STRIPPED DATA TO lp_s
        // foreach ($dataStrippedValues as $key => $value) {
        //     $key_plus1 = $key + 1;
        //     $postData["lp_s$key_plus1"] = $value;
        // }
        // $postData = array_merge($postData, $data);
        // //https://us1.api.mailchimp.com/3.0/lists/1539738/members
        // //http://us1.api.mailchimp.com/3.0/lists/1539738/members


        // // save lead to leadpedia
        // $guzzle = new \GuzzleHttp\Client();
        // $leadspediaUrl = "https://track.legalinjuryadvocates.com/post.do";
        // // $request = $guzzle->request('POST', $leadspediaUrl, [
        // //     'form_params' => $postData
        // // ]);

        // insert into database:
        $lead = new Lead;
        $lead->first_name = $first_name;
        $lead->last_name = $last_name;
        //$lead->age = $age;
        $lead->phone_number = $phone_number;
        $lead->email_address = $email_address;
        //$lead->postal_code = $postal_code;

        if ($lead->save()) {
            Session::put('lead', ['lead_id' => $lead->id]);

            //Send SMS 
            try {
            $site_path = 'https://usafuneralplanning.com';
            $account_sid = 'AC6bb8ea2bc725348f281fc16a1d730c71';
            $auth_token = 'bf4e41d9e5ce92993ea5c6c1ebbd5aec';
            $twilio_number = '+16067663668';
            $twilioto_number = '+1'.$phone_number;

            $twilio_message = 'Click here to confirm your entry '.$site_path.'/1/confirm-info?lead_id='.$lead->id;
            $twilioClient = new \Twilio\Rest\Client($account_sid, $auth_token);

            //Use the client to do fun stuff like send text messages!
            $twilioClient->messages->create(
                // the number you'd like to send the message to
                $twilioto_number,
                [
                    // A Twilio phone number you purchased at twilio.com/console
                    'from' => $twilio_number,
                    // the body of the text message you'd like to send
                    'body' => $twilio_message
                ]
            );
            } catch (Exception $e) {
                Log::error('Couldnt sent SMS:'.$e->getMessage());
                return redirect()->back()->with("error", $e->getMessage());
            }
            //Send SMS End

            return redirect()->action('App\Http\Controllers\PageController@prepaidFuneralConfirm');

        } else {
            return redirect()->back()->with("error", "Form not submitted, please contact admin.");
        }
    }

    public function funeralThankyou(Request $request){

        return view('funeral.congratulations');
    }


    // New for link 2

    public function prepaidFuneral2(){
        return view('funeral2.home');
    }

    public function funeralPost2(Request $request)
    {
        $data = $request->all();
        $first_name = $request->get('first_name', '');
        $last_name = $request->get('last_name', '');
        $phone_number = $request->get('phone_home', '');
        $email_address = $request->get('email_address', '');
        
        // $phone_number =str_replace("-","",$phone_number);
        // $phone_number =str_replace("(","",$phone_number);
        // $phone_number =str_replace(")","",$phone_number);
        
        // insert into database:
        $lead = new Lead;
        $lead->first_name = $first_name;
        $lead->last_name = $last_name;
        //$lead->age = $age;
        $lead->phone_number = $phone_number;
        $lead->email_address = $email_address;
        //$lead->postal_code = $postal_code;

        if ($lead->save()) {
            Session::put('lead', ['lead_id' => $lead->id]);            
            
            //return redirect()->action('App\Http\Controllers\PageController@prepaidFuneralConfirm');
            return redirect('/2/confirm-info?lead_id='.$lead->id);

        } else {
            return redirect()->back()->with("error", "Form not submitted, please contact admin.");
        }
    }

    public function funeralConfirmInfo2(Request $request){
        $leadId = $request->get('lead_id');
        if($leadId){
            $lead = Lead::where("id", $leadId)->first();
            if($lead){
                return view('funeral2.confirm-info',[
                    'lead' => $lead
                ]);
            }else{
                abort(404);
            }
        }else{
            abort(404);
        }
    }

    public function funeralConfirmInfo2Post(Request $request){
        if(Session::has('lead')){
            $sessionLead = Session::get('lead');
            $sessionLeadId = $sessionLead['lead_id'];

            $lead = Lead::where("id", $sessionLeadId)->first();
        }else{
            $lead = Lead::where("id", $request->get('lead_id'))->first();
        }
        
        if($lead){
            Session::put('lead', ['lead_id' => $lead->id]);

            $lead->myselfyesno = $request->get('myselfyesno');
            $lead->postal_code = $request->get('zipcode');
            $lead->save(); 

            return redirect()->action('App\Http\Controllers\PageController@funeralConfirmInfo2Step2');
        }
    }

    public function funeralConfirmInfo2Step2(Request $request){

        if(Session::has('lead')){
            $sessionLead = Session::get('lead');
            $sessionLeadId = $sessionLead['lead_id'];
            if($sessionLeadId){
                return view('funeral2.confirm-info-step2');
            }
        }
        else{
            abort(404);
        }
    }


    public function funeralConfirmInfo2Step2Post(Request $request){
        $data = $request->all();

        $sessionLead = Session::get('lead');
        $sessionLeadId = $sessionLead['lead_id'];

        $lead = Lead::where("id", $sessionLeadId)->first();
        if($lead!=''){
            if($lead){
                Session::put('lead', ['lead_id' => $lead->id]);
                $lead->birthyear = $request->get('birthyear');
                $lead->save(); 

                return redirect()->action('App\Http\Controllers\PageController@funeralConfirmInfo2Step3');
            }
        }
    }

    public function funeralConfirmInfo2Step3(Request $request){
        if(Session::has('lead')){
            $sessionLead = Session::get('lead');
            $sessionLeadId = $sessionLead['lead_id'];
            if($sessionLeadId){
                return view('funeral2.confirm-info-step3');
            }
        }
        else{
            abort(404);
        }
    }

    public function funeralConfirmInfo2Step3Post(Request $request){
        $sessionLead = Session::get('lead');
        $sessionLeadId = $sessionLead['lead_id'];

        $lead = Lead::where("id", $sessionLeadId)->first();
        if($lead){
            Session::put('lead', ['lead_id' => $lead->id]);
            $lead->illnesshospice = $request->get('illnesshospice');
            $lead->save(); 
            Session::forget('lead');
            return redirect()->action('App\Http\Controllers\PageController@funeral2Thankyou');
        }
    }

    public function funeral2Thankyou(Request $request){

        return view('funeral2.congratulations');
    }

}

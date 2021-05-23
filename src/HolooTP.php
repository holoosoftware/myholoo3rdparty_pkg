<?php


namespace torfenagar\HolooThirdParty;


use Torfenagar\HolooThirdParty\classes\HolooAuth;
use Torfenagar\HolooThirdParty\classes\HolooGetData;
use Torfenagar\HolooThirdParty\classes\HolooServices;
use Torfenagar\HolooThirdParty\clients\GuzzleClient;
use Torfenagar\HolooThirdParty\clients\IClient;

class HolooTP
{

    public  $serial_number;
    public  $api_key;
    public  $lang;
    public  $sandbox;
    public  $client;
    public  $laravel;

    /**
     * HolooThirdParty constructor.
     * @param $serial_number
     * @param $api_key
     * @param $lang
     * @param $sandbox
     * @param IClient $client
     * @param $laravel
     */
    public function __construct($serial_number = null , $api_key = null, $lang = 'fa', $sandbox = '0',  $client = null,  $laravel = true)
    {
        $this->serial_number =  (string) config('HolooThirdParty.serial_number', $serial_number);
        $this->api_key =  (string) config('HolooThirdParty.api_key', $api_key); ;
        $this->lang = (string) config('HolooThirdParty.lang', $lang); ;
        $this->sandbox = (string) config('HolooThirdParty.sandbox', $sandbox) ;
        $this->client =  new GuzzleClient($sandbox);
        $this->laravel = $laravel ;
    }


    public function Authenticate()
    {
        $auth = new HolooAuth($this->serial_number , $this->api_key , $this->client);
        return $auth->Authenticate();
    }

    public function RegisterForPartner()
    {
        $auth = new HolooAuth($this->serial_number , $this->api_key , $this->client);
        return $auth->RegisterForPartner();
    }

    public function GetServiceBySerial($access_token)
    {
        $service = new HolooGetData($this->serial_number , $this->api_key , $this->client);
        return $service->GetServiceBySerial($access_token);
    }

    public function GetDatabaseNames($access_token){
        $service = new HolooGetData($this->serial_number , $this->api_key , $this->client);
        return $service->GetDatabaseNames($access_token);
    }

    public function GetBank($access_token , $db_name){
        $service = new HolooGetData($this->serial_number , $this->api_key , $this->client);
        return $service->GetBank($access_token , $db_name);
    }

    public function GetCash($access_token , $db_name){
        $service = new HolooGetData($this->serial_number , $this->api_key , $this->client);
        return $service->GetCash($access_token , $db_name);
    }

    public function GetCustomerGroup($access_token , $db_name){
        $service = new HolooGetData($this->serial_number , $this->api_key , $this->client);
        return $service->GetCustomerGroup($access_token , $db_name);
    }

    public function GetTableData($access_token , $db_name , $table_name , $a_code = ''){
        $service = new HolooGetData($this->serial_number , $this->api_key , $this->client);
        return $service->GetTableData($access_token , $db_name , $table_name , $a_code);
    }

    public function ReceiveFromCustomer($access_token , $data = ''){
        $service = new HolooServices($this->serial_number , $this->api_key , $this->client);
        return $service->ReceiveFromCustomer($access_token , $data);
    }

    public function CustomerPost($access_token , $data = ''){
        $service = new HolooServices($this->serial_number , $this->api_key , $this->client);
        return $service->CustomerPost($access_token , $data);
    }

    public function ProductPost($access_token , $data = ''){
        $service = new HolooServices($this->serial_number , $this->api_key , $this->client);
        return $service->ProductPost($access_token , $data);
    }

    public function InvoicePost($access_token ,$db_name, $data = ''){
        $service = new HolooServices($this->serial_number , $this->api_key , $this->client);
        return $service->InvoicePost($access_token , $db_name , $data);
    }

    public function GetNotify($json_data){
        $service = new HolooServices($this->serial_number , $this->api_key , $this->client);
        return $service->GetNotify($json_data);
    }
    public function SearchArticles($access_token , $db_name , $m_groupcode = '' , $s_groupcode = '' , $is_article = 'true'){
        $service = new HolooGetData($this->serial_number , $this->api_key , $this->client);
        return $service->SearchArticles($access_token , $db_name , $m_groupcode , $s_groupcode , $is_article );
    }
}

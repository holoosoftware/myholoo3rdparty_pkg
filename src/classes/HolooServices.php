<?php


namespace Torfenagar\HolooThirdParty\classes;


class HolooServices
{
    public $serial;
    public $api_key;
    public $client;

    /**
     * Auth constructor.
     * @param $serial
     * @param $api_key
     * @param $client
     */
    public function __construct($serial , $api_key , $client)
    {
        $this->serial = $serial;
        $this->api_key = $api_key;
        $this->client = $client;

    }

    /**
     * @param $headers
     * @param null $access_token
     * @return array
     */
    private function manage_headers($headers , $access_token = null){
        return array_merge([
            'serial'        => $this->serial ,
            'token'         => $access_token ,
        ], $headers);
    }


    /**
     * @param $access_token
     * @param $data
     * @return mixed
     */
    public function ReceiveFromCustomer($access_token , $data)
    {
        $uri = 'api/CallApi/ReciveFromCustomer';
        $headers = $this->manage_headers(['content-type' => 'application/x-www-form-urlencoded'] , $access_token);
        return $this->client->SendRequest('POST' , $uri , ['data' => $data] , $headers , 'form_params');
    }

    /**
     * @param $access_token
     * @param $data
     * @return mixed
     */
    public function CustomerPost($access_token , $data)
    {
        $uri = 'api/CallApi/CustomerPost';
        $headers = $this->manage_headers(['content-type' => 'application/x-www-form-urlencoded'] , $access_token);
        return $this->client->SendRequest('POST' , $uri , ['data' => $data] , $headers , 'form_params');
    }

    /**
     * @param $access_token
     * @param $data
     * @return mixed
     */
    public function ProductPost($access_token , $data)
    {
        $uri = 'api/CallApi/ProductPost';
        $headers = $this->manage_headers(['content-type' => 'application/x-www-form-urlencoded'] , $access_token);
        return $this->client->SendRequest('POST' , $uri , ['data' => $data] , $headers , 'form_params');
    }

    /**
     * @param $access_token
     * @param $db_name
     * @param $data
     * @return mixed
     */
    public function InvoicePost($access_token , $db_name , $data){
        $uri = 'api/CallApi/InvoicePost';
        $headers = $this->manage_headers(['content-type' => 'application/x-www-form-urlencoded' , 'database' => $db_name] , $access_token);
        return $this->client->SendRequest('POST' , $uri , ['data' => $data] , $headers , 'form_params');
    }

    public function GetNotify($json_data){
        $params = json_decode($json_data , true);
        $uri = 'api/AgentNotify/GetNotify';
        $headers = $this->manage_headers(['content-type' => 'application/json'] );
        return $this->client->SendRequest('POST' , $uri , $params , $headers , 'body');
    }
}

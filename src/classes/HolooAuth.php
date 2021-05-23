<?php


namespace Torfenagar\HolooThirdParty\classes;


use Torfenagar\HolooThirdParty\clients\GuzzleClient;

class HolooAuth
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
     * @return mixed
     */
    public function Authenticate()
    {
        $uri = 'api/Ticket/Authenticate';
        $params = ['serial' => $this->serial , 'ApiKey' => $this->api_key ];
        $headers = ['content-type' => 'application/x-www-form-urlencoded'];
        return $this->client->SendRequest('POST' , $uri , $params , $headers , 'form_params');
    }

    /**
     * @return array
     */
    public function RegisterForPartner(){
        $uri = 'api/Ticket/RegisterForPartner';
        $params = ['serial' => $this->serial];
        $headers = ['ApiKey' => $this->api_key , 'content-type' => 'application/x-www-form-urlencoded'];
        return $this->client->SendRequest('POST' , $uri , $params , $headers , 'form_params');
    }


}

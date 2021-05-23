<?php


namespace Torfenagar\HolooThirdParty\classes;


class HolooGetData
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
     * @return mixed
     */
    public function GetServiceBySerial($access_token)
    {
        $uri = 'api/AgentService/GetServiceByserial';
        $headers = $this->manage_headers([] , $access_token);
        return $this->client->SendRequest('POST' , $uri , [] , $headers , 'json');
    }

    /**
     * @param $access_token
     * @return mixed
     */
    public function GetDatabaseNames($access_token){
        $uri = 'api/Service/GetDatabaseNames';
        $headers = $this->manage_headers([] , $access_token);
        return $this->client->SendRequest('GET' , $uri , [] , $headers , '');
    }


    /**
     * @param $access_token
     * @param $db_name
     * @return mixed
     */
    public function GetBank($access_token , $db_name){
        $uri = 'api/Bank/GetBank';
        $headers = ['database' => $db_name ];
        $headers = $this->manage_headers($headers , $access_token);
        return $this->client->SendRequest('GET' , $uri , [] , $headers , '');
    }

    /**
     * @param $access_token
     * @param $db_name
     * @return mixed
     */
    public function GetCash($access_token , $db_name){
        $uri = 'api/Cash/GetCash';
        $headers = ['database' => $db_name ];
        $headers = $this->manage_headers($headers , $access_token);
        return $this->client->SendRequest('GET' , $uri , [] , $headers , '');
    }

    /**
     * @param $access_token
     * @param $db_name
     * @return mixed
     */
    public function GetCustomerGroup($access_token , $db_name){
        $uri = 'api/Cash/GetCash';
        $headers = [
            'database' => $db_name ,
            'Authorization' => 'Bearer ' . $access_token
        ];
        $headers = $this->manage_headers($headers , $access_token);
        return $this->client->SendRequest('GET' , $uri , [] , $headers , '');
    }

    /**
     * @param $access_token
     * @param $db_name
     * @param $table_name
     * @param string $a_code
     * @return mixed
     */
    public function GetTableData($access_token , $db_name , $table_name , $a_code = ''){
        $uri = "api/Service/${table_name}/${db_name}/${a_code}";
        $headers = $this->manage_headers([] , $access_token);
        return $this->client->SendRequest('GET' , $uri , [] , $headers , '');
    }

    /**
     * @param $access_token
     * @param $db_name
     * @param $m_groupcode
     * @param $s_groupcode
     * @param $is_article
     * @return mixed
     */
    public function SearchArticles($access_token , $db_name , $m_groupcode , $s_groupcode , $is_article ){
        $uri = "api/Article/SearchArticles";
        $headers = [
            'database'      => $db_name ,
            'm_groupcode'   => $m_groupcode,
            's_groupcode'   => $s_groupcode,
            'isArticle'     => $is_article,
        ];
        $headers = $this->manage_headers($headers , $access_token);
        return $this->client->SendRequest('GET' , $uri , [] , $headers , '');
    }
}

<?php


namespace Torfenagar\HolooThirdParty\clients;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class GuzzleClient implements IClient
{
    function __construct($sandbox)
    {
        $sub = ($sandbox) ? 'https://sandbox.' : 'http://';
        $this->baseUrl =  $sub . 'myholoo.ir';
    }

    public $baseUrl;

    /**
     * Send requests to zarinpal
     * and receive responses.
     *
     * @param string $method
     * @param string $uri
     * @param array $payload
     * @param array $headers
     *
     * @param string $type ==> json || form_params
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    function SendRequest(string $method  , string $uri , array $payload, array $headers = [] , $type = 'json')
    {
        if (!isset($method) || $method !== 'GET') $method = 'POST';

        if ($type == 'body') $payload = json_encode($payload , true);

        $client = new Client($this->GetClientArray());
        $headers =  $this->GetHeader($headers);
        $response = $this->GetResponse($client, $method, $uri, $headers, $type, $payload);

        if (is_string($response)) return [$response] ;

        $response = $response->getBody()->getContents();
        return json_decode($response, true);
    }

    /**
     * @param $headers
     * @return array
     */
    private  function GetHeader($headers){
        return array_merge([
            'user-agent' => 'Holoo Third Party v1.0.0',
            'cache-control' => 'no-cache',
            'content-type' => 'application/json',
            'content-length' => '0',
            'accept' => 'application/json'
        ], $headers);
    }

    /**
     * @param Client $client
     * @param string $method
     * @param string $uri
     * @param array $headers
     * @param $type
     * @param array $payload
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function GetResponse(Client $client, string $method, string $uri, array $headers, $type, array $payload)
    {
        try {
            $response = $client->request($method, $uri,
                [
                    'exceptions' => true,
                    'debug' => false,
                    'allow_redirects' => true,
                    'http_errors' => true,
                    'headers' => $headers,
                    $type => $payload,

                ]);
            return $response;
        }catch (\Exception $exception){
            return $exception->getMessage();
        }

    }

    /**
     * @return array
     */
    private function GetClientArray()
    {
        return [
            'exceptions' => false,
            'base_uri' => $this->baseUrl,
            'verify' => false
        ];
    }
}

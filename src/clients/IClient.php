<?php


namespace Torfenagar\HolooThirdParty\clients;


use GuzzleHttp\Exception\RequestException;

interface IClient
{
    /**
     * Send requests to myHoloo
     * and receive responses.
     *
     * @param string $method
     * @param array $payload
     * @param array $headers
     *
     * @throws RequestException
     * @return array
     */
    function SendRequest(string $method , string $uri , array $payload, array $headers = []);
}

<?php
require 'vendor/autoload.php';


function CallAPI($method, $url, $data = false)
{
    $client = new GuzzleHttp\Client();
    $res = $client->request($method, $url);
    echo $res->getStatusCode();
    // "200"
    echo $res->getHeader('content-type')[0];
    // 'application/json; charset=utf8'
    echo $res->getBody();
    // {"type":"User"...'

}

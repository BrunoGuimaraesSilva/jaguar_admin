<?php
require 'vendor/autoload.php';

/* *********************************
	* Função chamar a API
	* $method = Metodo REST
    * $url = Url a ser chamada
    * $data = Valores a serem enviados
    * $option = Opções de request
*********************************** */

function CallAPI($method = 'GET', $url = '', $data = [], $option = [])
{
    $client = new GuzzleHttp\Client();
    //$ip = 'http://192.168.8.157:8080';
    $ip = 'http://172.19.160.1:8080';
    $url = $ip.$url;

    switch ($method) {
        case 'POST':
            $res = $client->request('POST', $url, [
                'form_params' => [$data]
            ]);
            break;
        case 'GET':
            $res = $client->request('GET', $url, $option);
            break;
        case 'PUT':
            $res = $client->put($url, [
                'body' => [$data],
                'timeout' => 5
            ]);
            break;
        case `DELETE`:
            $res = $client->delete($url);
            break;
        default:
            $res = $client->request('GET', $url, $option);
            break;
    }

    $statusCode = $res->getStatusCode();
    if ($statusCode == 200) {
        return array(
            'data' =>  json_decode($res->getBody()),
            'status' => $statusCode
        );
    } else {
        return array(
            'data' =>  '',
            'status' => $statusCode
        );
    }
}

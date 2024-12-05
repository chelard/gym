<?php

namespace App\Http\Controllers;


use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function getDni($numero): string
    {

        $token = 'apis-token-10455.Ngm276EinohQElwJAjVD9OMgYMiUqmCo';
        $client = new Client(['base_uri' => 'https://api.apis.net.pe', 'verify' => false]);
        $parameters = [
            'http_errors' => false,
            'connect_timeout' => 5,
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Referer' => 'https://apis.net.pe/api-consulta-dni',
                'User-Agent' => 'laravel/guzzle',
                'Accept' => 'application/json',
            ],
            'query' => ['numero' => $numero]
        ];

        $res = $client->request('GET', '/v2/reniec/dni', $parameters);

        $response = json_decode($res->getBody()->getContents(), true);

        // Extraer el campo apellidoPaterno + apellidoMaterno + 'nombres'

        $nombreCompleto = $response['apellidoPaterno'] . ' ' . $response['apellidoMaterno'] . ' ' . $response['nombres'];

        return $nombreCompleto; //
    }
}

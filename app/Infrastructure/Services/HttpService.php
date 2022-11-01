<?php

declare(strict_types=1);


namespace App\Infrastructure\Services;

use GuzzleHttp\Client;

class HttpService
{
    private Client $client;

    private array $headers = [];

    public function __construct()
    {
        $this->client = new Client();
        $this->headers = ['Content-type' => 'application/json'];
    }

    public function addHeaders(array $headers): void
    {
        $this->headers += $headers;
    }

    public function post($url, $data): ?array
    {
        $response = $this->client->post($url, [
            'headers' => $this->headers,
            'json' => $data
        ]);

        return json_decode((string) $response->getBody(), true);
    }

}

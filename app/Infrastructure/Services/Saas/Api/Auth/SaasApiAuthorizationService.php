<?php

declare(strict_types=1);


namespace App\Infrastructure\Services\Saas\Api\Auth;

use App\Infrastructure\Services\HttpService;
use Exception;
use GuzzleHttp\Client;

class SaasApiAuthorizationService
{

    private HttpService $http;

    private ?string $token;

    public function __construct()
    {
        $this->http = new HttpService();
    }


    public function execute(): void
    {
        $accessToken = null;

        try {
            $result = $this->http->post(config('saas.default.host') .'/oauth/token', config('saas.default.admin'));
            $accessToken = $result['access_token'] ?? null;

            if (is_null($accessToken)) {
                throw new Exception('access token not found');
            }

        } catch (Exception $exception) {
            echo $exception->getMessage().PHP_EOL;
        }

        $this->token = $accessToken;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }
}

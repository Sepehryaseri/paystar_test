<?php

namespace App\Core\PayStar\Services;

use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

abstract class Service
{
    public array $body;
    public array $parameters;
    public array $headers;
    public string $baseUrl;
    public PendingRequest $request;

    public function __construct()
    {
        $gatewayId = config('paystar.gateway_id');
        $this->baseUrl = config('paystar.base_url');

        $this->headers = [
            'Content-Type' => 'application/json',
            'Authorization' => "Bearer {$gatewayId}"
        ];

        $this->request = Http::withHeaders($this->headers)
            ->withoutVerifying();
    }

    public function response(PromiseInterface|Response $response): array
    {
        return [
            'status' => $response->status(),
            'body' => json_decode($response->body(), true),
            'headers' => $response->headers(),
        ];
    }
}

<?php

namespace Hashstudio\JuroSdk;

use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Message;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class JuroSdk
{

    const CONTRACTS_METHOD = 'contracts';
    const TEMPLATES_METHOD = 'templates';
    const BASE_URL = 'https://api.juro.com/v3/';

    public function __construct(readonly string $apiKey, readonly bool $debug = false)
    {
    }

    public function getClient(): PendingRequest
    {
        $debugMiddleware = Middleware::mapRequest(function (RequestInterface $request) {
            Log::debug('[JuroSdk market debug] Request: ' . Message::toString($request) . '\n\n');
            return $request;
        });
        $responseMiddleware = Middleware::mapResponse(function (ResponseInterface $response) {
            Log::debug('[JuroSdk market debug] Request: ' . Message::toString($response) . '\n\n');
            return $response;
        });

        $request = Http::withOptions(['base_uri' => self::BASE_URL , 'debug' => $this->debug])
        ->withHeaders([
            'content-type' => 'application/json',
            'x-api-key' => $this->apiKey,
        ]);

        if ($this->debug) {
            $request->withMiddleware($debugMiddleware);
            $request->withMiddleware($responseMiddleware);
        }

        return $request;
    }

    public function createContract(array $data): array
    {
        $response = $this->getClient()->post(self::CONTRACTS_METHOD, $data);

        return $response->json();
    }

    public function getTemplates(): array
    {
        $response = $this->getClient()->get(self::TEMPLATES_METHOD);

        return $response->json();
    }

    public function getTemplateById(string $templateId): array
    {
        $response = $this->getClient()->get(self::TEMPLATES_METHOD . '/' . $templateId);

        return $response->json();
    }

    public function getTemplateFields(string $templateId): array
    {
        $response = $this->getTemplateById($templateId);

        return $response['template']['fields'];
    }
}

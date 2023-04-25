<?php

namespace Hashstudio\JuroSdk;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

class JuroSdk
{

    const CONTACTS_METHOD = 'contacts';
    const TEMPLATES_METHOD = 'templates';
    const BASE_URL = 'https://api.juro.com/v3/';

    private string $apiKey;
    public function __construct()
    {
        $this->apiKey = config('juro-sdk.api-key');
    }

    public function getClient(): PendingRequest
    {
        return Http::withHeaders([
            'content-type' => 'application/json',
            'x-api-key' => $this->apiKey,
        ]);
    }

    public function createContract(array $data): array
    {
        $response = $this->getClient()->post(self::BASE_URL . self::CONTACTS_METHOD, $data);

        return $response->json();
    }

    public function getTemplates(): array
    {
        $response = $this->getClient()->get(self::BASE_URL . self::TEMPLATES_METHOD);

        return $response->json();
    }

    public function getTemplateById(string $templateId): array
    {
        $response = $this->getClient()->get(self::BASE_URL . self::TEMPLATES_METHOD . '/' . $templateId);

        return $response->json();
    }

    public function getTemplateFields(string $templateId): array
    {
        $response = $this->getTemplateById($templateId);

        return $response['template']['fields'];
    }
}

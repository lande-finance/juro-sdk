<?php

namespace Hashstudio\JuroSdk\Tests;

use Hashstudio\JuroSdk\JuroSdk;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class JuroSdkTest extends TestCase
{
    private JuroSdk $juroSdk;

    protected function setUp(): void
    {
        parent::setUp();

        // Set the Juro API key in the config for testing purposes
        config(['juro-sdk.api-key' => 'test_api_key']);

        $this->juroSdk = new JuroSdk();
    }

    public function testCreateContract(): void
    {
        $data = ['key' => 'value'];

        Http::fake([
            JuroSdk::BASE_URL . JuroSdk::CONTRACTS_METHOD => Http::response([
                'result' => 'success',
            ], 200),
        ]);

        $response = $this->juroSdk->createContract($data);

        Http::assertSent(function (Request $request) use ($data) {
            return $request->url() == JuroSdk::BASE_URL . JuroSdk::CONTRACTS_METHOD &&
                $request->hasHeader('x-api-key', 'test_api_key') &&
                $request->data() == $data;
        });

        $this->assertSame(['result' => 'success'], $response);
    }

    public function testGetTemplates(): void
    {
        Http::fake([
            JuroSdk::BASE_URL . JuroSdk::TEMPLATES_METHOD => Http::response([
                'templates' => [
                    ['id' => 1, 'name' => 'Template 1'],
                    ['id' => 2, 'name' => 'Template 2'],
                ],
            ], 200),
        ]);

        $response = $this->juroSdk->getTemplates();

        Http::assertSent(function (Request $request) {
            return $request->url() == JuroSdk::BASE_URL . JuroSdk::TEMPLATES_METHOD &&
                $request->hasHeader('x-api-key', 'test_api_key') &&
                $request->isGet();
        });

        $this->assertSame([
            'templates' => [
                ['id' => 1, 'name' => 'Template 1'],
                ['id' => 2, 'name' => 'Template 2'],
            ],
        ], $response);
    }

    public function testGetTemplateById(): void
    {
        $templateId = 'test_template_id';

        Http::fake([
            JuroSdk::BASE_URL . JuroSdk::TEMPLATES_METHOD . '/' . $templateId => Http::response([
                'template' => [
                    'id' => $templateId,
                    'name' => 'Test Template',
                ],
            ], 200),
        ]);

        $response = $this->juroSdk->getTemplateById($templateId);

        Http::assertSent(function (Request $request) use ($templateId) {
            return $request->url() == JuroSdk::BASE_URL . JuroSdk::TEMPLATES_METHOD . '/' . $templateId &&
                $request->hasHeader('x-api-key', 'test_api_key');
        });

        $this->assertSame([
            'template' => [
                'id' => $templateId,
                'name' => 'Test Template',
            ],
        ], $response);
    }

    public function testGetTemplateFields(): void
    {
        $templateId = 'test_template_id';

        Http::fake([
            JuroSdk::BASE_URL . JuroSdk::TEMPLATES_METHOD . '/' . $templateId => Http::response([
                'template' => [
                    'id' => $templateId,
                    'name' => 'Test Template',
                    'fields' => [
                        ['id' => 'field_1', 'name' => 'Field 1'],
                        ['id' => 'field_2', 'name' => 'Field 2'],
                    ],
                ],
            ], 200),
        ]);

        $response = $this->juroSdk->getTemplateFields($templateId);

        Http::assertSent(function (Request $request) use ($templateId) {
            return $request->url() == JuroSdk::BASE_URL . JuroSdk::TEMPLATES_METHOD . '/' . $templateId &&
                $request->hasHeader('x-api-key', 'test_api_key') &&
                $request->method() == 'GET';
        });

        $this->assertSame([
            ['id' => 'field_1', 'name' => 'Field 1'],
            ['id' => 'field_2', 'name' => 'Field 2'],
        ], $response);
    }

}

# Changelog

All notable changes to `juro-sdk` will be documented in this file

## 2.0.0 - 2026-03-16

### Added
- Laravel 12 support (`illuminate/support ^12.0`)
- `phpunit.xml` configuration file

### Changed
- `require-dev`: `orchestra/testbench` updated to `^7.0|^8.0|^9.0|^10.0` (covers Laravel 9–12)
- `require-dev`: `phpunit/phpunit` updated to `^9.0|^10.0|^11.0`

### Fixed
- `JuroSdkFacade::getFacadeAccessor()` returned `'juro-sdk'` instead of `JuroSdk::class` — facade never resolved from the container
- `JuroSdkTest` extended the app's `Tests\TestCase` instead of `Orchestra\Testbench\TestCase`
- `JuroSdkTest::setUp()` called `new JuroSdk()` without the required `$apiKey` argument
- Config key typo `juro-sdk.api-key` → `juro-sdk.api_key`
- `$request->isGet()` replaced with `$request->method() === 'GET'` (method removed in Laravel 10+)

## 1.0.0 - 201X-XX-XX

- initial release

# Description of the package

SDK Juro Kit for Laravel framework.
Consumes JURO api https://api-docs.juro.com/

At a moment this package supports only createContract method.

## Requirements
- PHP >= 8.0
- Laravel >= 9.0

## Installation

You can install the package via composer:

```bash
composer require hashstudio/juro-sdk
```

## Usage

```php
php artisan vendor:publish --tag=juro-sdk-config
```

```php
$sdk = new \Lande\JuroSdk\JuroSdk();

$data = [
    "templateId" => "643fef1bfec94c08f5f5e67a",
    "contract" => [
        "answers" => [
            [
                "uid" => "ad6c9b80-43c1-4b92-b881-7d2aa50b28fc",
                "value" => "Infinity industries"
            ]
        ]
    ]
];

$sdk->createContract($data);
```


### Testing

```bash
composer test
```

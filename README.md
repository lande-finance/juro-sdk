# Very short description of the package

Internal Lande SDK Juro Kit

## Installation

You can install the package via composer:

```bash
composer require lande/juro-sdk
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
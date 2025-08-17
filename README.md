# GavaBridge

A simple, clean, and developer-friendly Laravel SDK that bridges your Laravel app with **Kenya Revenue Authority (KRA) APIs** via [GavaConnect](https://developer.go.ke/apis).  
It simplifies authentication, token caching, and request handling, letting you focus on building your product.

---

## Features

-   🔑 Automatic OAuth2 (client credentials) token management
-   📡 Easy access to common KRA endpoints:
    -   PIN validation
    -   TCC validation
    -   Taxpayer obligations & liabilities
    -   Excise license check
    -   NIL return filing
-   🧩 Extendable: add more endpoints in minutes
-   ⚡ Built for Laravel 10+ / 11

---

## Installation

1. Require the package:

    ```bash
    composer require gavabridge/kra
    ```

2. Publish the config:

    ```bash
    php artisan vendor:publish --tag=gavabridge-config
    ```

3. Add credentials in `.env`:
    ```env
    GAVABRIDGE_ENV=sandbox
    GAVABRIDGE_KEY=your_consumer_key
    GAVABRIDGE_SECRET=your_consumer_secret
    GAVABRIDGE_TOKEN_URL_SANDBOX=https://sbx.kra.go.ke/oauth/token
    GAVABRIDGE_API_BASE_SANDBOX=https://sbx.kra.go.ke
    ```

---

## Usage

You can access all endpoints via the **`GavaBridge` facade**:

```php
use GavaBridge\Kra\Facades\GavaBridge as Kra;

// PIN validation
$result = Kra::pin()->validateByPin('A000000010');

// TCC validation
$check = Kra::tcc()->validate('A000000010', 'TCC-12345678');

// Obligations
$obls = Kra::taxpayer()->obligations('A000000010');

// Liabilities
$libs = Kra::taxpayer()->liabilities('A000000010');

// Excise license
$lic = Kra::excise()->checkByNumber('EXC-0001234');

// NIL return (payload from portal spec)
$resp = Kra::returns()->fileNil([
    'pin' => 'A000000010',
    'taxHead' => 'VAT',
    'period' => '2025-07',
    /* ... other fields per API spec ... */
]);
```

---

## Roadmap

-   [ ] Add Import Certificate Checker
-   [ ] Add Excise License by PIN
-   [ ] Add E-Slip Checker
-   [ ] Add eTIMS (OSCU/VSCU) support

---

## License

MIT © 2025 – ASAD ALI SIDOW

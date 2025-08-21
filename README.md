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
    KRA_ENV=sandbox
    KRA_CONSUMER_KEY=your_consumer_key
    KRA_CONSUMER_SECRET=your_consumer_secret
    ```

---

## Usage

You can access all endpoints via the **`GavaBridge` facade**:

```php
use GavaBridge\Kra\Facades\Kra;

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
     "TAXPAYERDETAILS" => [
        "TaxpayerPIN" => "A000000000L",
        "ObligationCode" => "4",
        "Month" => "04",
        "Year" => "2000"
     ]
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

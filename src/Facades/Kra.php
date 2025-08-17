<?php

namespace GavaConnect\Kra\Facades;

use Illuminate\Support\Facades\Facade;
use GavaConnect\Kra\Support\KraManager;

/** @method static \GavaConnect\Kra\Http\PinClient pin()
 *  @method static \GavaConnect\Kra\Http\TccClient tcc()
 *  @method static \GavaConnect\Kra\Http\ExciseClient excise()
 *  @method static \GavaConnect\Kra\Http\TaxpayerClient taxpayer()
 *  @method static \GavaConnect\Kra\Http\ReturnsClient returns()
 */
class Kra extends Facade
{
    protected static function getFacadeAccessor()
    {
        return KraManager::class;
    }
}

<?php

namespace GavaBridge\Kra\Facades;

use Illuminate\Support\Facades\Facade;
use GavaBridge\Kra\Support\KraManager;

/** @method static \GavaBridge\Kra\Http\PinClient pin()
 *  @method static \GavaBridge\Kra\Http\TccClient tcc()
 *  @method static \GavaBridge\Kra\Http\ExciseClient excise()
 *  @method static \GavaBridge\Kra\Http\TaxpayerClient taxpayer()
 *  @method static \GavaBridge\Kra\Http\ReturnsClient returns()
 */
class Kra extends Facade
{
    protected static function getFacadeAccessor()
    {
        return KraManager::class;
    }
}

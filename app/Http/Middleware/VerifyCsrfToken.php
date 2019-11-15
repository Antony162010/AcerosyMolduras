<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'store_house/info',
        'store_house/store',
        '/signin',
        'store_house/products',
        'provider/{email}',
        'provider/store',
        'sale/store',
        'sale/provinces',
        'sale/districts',
        'sale/products',
        'buy/products',
        'store_house/catalog',
        'store_house/products'
    ];
}

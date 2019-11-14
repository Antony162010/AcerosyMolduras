<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BuyDetail extends Model
{
    protected $filliable = [
        'idproduct','price','quantity','amount'
    ];
}

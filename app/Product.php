<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $filliable = [
        'category_idcategory','code','price','mark','model'
    ];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductTransactions extends Model
{
    protected $fillable = [
        'product_id', 'quantity', 'type', 'created_at'
    ];
}

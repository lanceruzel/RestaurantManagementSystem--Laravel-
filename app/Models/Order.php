<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public $table = 'orders';

    const CREATED_AT = null;
    const UPDATED_AT = null;

    protected $fillable = [
        'billID',
        'menuID',
        'price',
        'quantity',
        'total',
    ];
}

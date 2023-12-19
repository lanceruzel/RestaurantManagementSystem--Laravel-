<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    public $table = 'bill';

    const CREATED_AT = null;
    const UPDATED_AT = null;

    protected $fillable = [
        'assignedAccount',
        'assignedTable',
        'total',
        'orderStatus',
        'paymentStatus',
    ];
}

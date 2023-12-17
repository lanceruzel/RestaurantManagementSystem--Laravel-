<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuCategory extends Model
{
    use HasFactory;

    public $table = 'menu_category';

    const CREATED_AT = null;
    const UPDATED_AT = null;

    protected $fillable = [
        'categoryName'
    ];
}

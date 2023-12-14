<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeInformation extends Model
{
    use HasFactory;

    public $table = 'employeeinformation';

    const CREATED_AT = null;
    const UPDATED_AT = null;

    protected $fillable = [
        'accountID',
        'firstName',
        'middleName',
        'lastName',
        'birthdate',
        'gender',
        'address',
        'contact',
    ];

    
}

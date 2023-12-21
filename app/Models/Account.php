<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Account extends Authenticatable
{
    use HasFactory, Notifiable;

    public $table = 'Account';

    const CREATED_AT = null;
    const UPDATED_AT = null;

    protected $fillable = [
        'email',
        'password',
        'created_at'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function employee(){
        return $this->hasOne(EmployeeInformation::class, 'accountID', 'id');
    }
}

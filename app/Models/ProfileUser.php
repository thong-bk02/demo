<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProfileUser extends Model
{
    protected $table = 'profile_users';

    protected $fillable = [
        'user_id',
        'user_code',
        'gender',
        'address',
        'phone',
        'birthday',
        'position',
        'department',
        'date_start'
    ];

    use HasFactory, SoftDeletes;

}

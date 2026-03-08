<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecialUser extends Model
{
    //
    use HasFactory;
    public $table = 'special_users';
    protected $fillable = [
        'email',
        'password'
    ];

}

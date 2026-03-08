<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResetToken extends Model
{
    //
    public $table = 'token_reset_password';
    protected $fillable = [
        'token',
        'user_id'
    ];
}

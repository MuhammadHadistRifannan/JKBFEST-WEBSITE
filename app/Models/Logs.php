<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Logs extends Model
{
    //
    protected $table = 'log';
    public $timestamps = true;
    protected $fillable = [
        'action',
        'description',
    ];

}

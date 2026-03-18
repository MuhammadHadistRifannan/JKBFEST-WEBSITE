<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailVerification extends Model
{
    //
    public $table = 'email_verifications';
    protected $fillable = [
        'email',
        'otp',
        'expired_at',
        'verified'
    ];

    public function isOtpExpired($email){
        $data = EmailVerification::select('expired_at')->where('email' , $email)->first();
        return now()->greaterThan($data->expired_at) ? true : false;
    }
}

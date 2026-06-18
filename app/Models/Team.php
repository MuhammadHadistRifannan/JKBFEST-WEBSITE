<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    //
    use HasFactory;
    protected $fillable = [
        'user_id',
        'team_name',
        'advisor_name',
        'advisor_phone',
        'institution',
        'status_team',
        'link_karya',
        'waktu_submit'
    ];

    public $timestamps = false;

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function document(){
        return $this->hasOne(Documents::class, 'team_id');
    }

    public function member(){
        return $this->hasMany(TeamMember::class , 'team_id');
    }

    public function getLinkKaryaAttribute($value)
    {
        if ($value && !preg_match("~^(?:f|ht)tps?://~i", $value)) {
            return "https://" . $value;
        }
        return $value;
    }


}

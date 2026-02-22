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
        'status_team'
    ];

    public $timestamps = false;

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function document(){
        return $this->hasOne(Document::class, 'team_id');
    }

    public function member(){
        return $this->hasMany(TeamMember::class , 'team_id');
    }


}

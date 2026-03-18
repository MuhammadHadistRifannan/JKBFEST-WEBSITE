<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Documents extends Model
{
    //
    protected $fillable = [
        'team_id',
        'document_path',
        'status_document' ,
        'has_payed',
        'alasan_ditolak'
    ];


     public function team(){
         return $this->belongsTo(Team::class);
     }
}

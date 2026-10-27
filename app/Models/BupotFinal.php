<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BupotFinal extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'bupot_final';

    protected $fillable = [
        'id','user_id','type','period','year','no', 'npwp','nik','name','address','country_code','object_code','bruto','dpp','tarif','pph','date','ptkp_code','ptkp'
    ];

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }  
}

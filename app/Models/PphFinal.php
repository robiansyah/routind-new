<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PphFinal extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pph_final';

    protected $fillable = [
        'id','spt_id','type','period','year','no', 'npwp','nik','name','address','country_code','object_code','bruto','dpp','tarif','pph','date','ptkp_code'
    ];

    public function spt()
    {
        return $this->belongsTo(Spt::class)->withDefault();
    }  
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Spt1771lampiran1 extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = '1771lampiran1';

    protected $fillable = [
        'spt_id', 'peredaran_usaha', 'penghasilan_luar', 'pph_final', 'butir_5a', 'butir_5b', 'butir_5c', 'butir_5d', 'butir_5e', 'butir_5f', 'butir_5g', 'butir_5h', 'butir_5k', 'butir_5l', 'butir_6c', 'butir_6d', 
    ];
}

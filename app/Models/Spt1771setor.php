<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Spt1771setor extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = '1771setor';

    protected $fillable = [
        'spt_id', 'kode_map', 'kode_jenis', 'tanggal', 'bayar', 'ntpn'
    ];
}

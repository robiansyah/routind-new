<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Spt1771lampkhus1a extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = '1771lampkhus1a';

    protected $fillable = [
        'spt_id', 'jenis_fiskal', 'jenis_harta', 'kelompok_harta', 'nama_harta', 'bulan', 'tahun', 'harga', 'nilai_sisa', 'metode_komersial', 'metode_fiskal', 'fiskal', 'catatan'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Spt1771lampiran6bc extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = '1771lampiran6bc';

    protected $fillable = [
        'spt_id', 'jenis', 'nama', 'npwp', 'jumlah', 'tahun', 'bunga'
    ];
}

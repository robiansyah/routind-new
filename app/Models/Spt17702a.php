<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Spt17702a extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = '1770_2a';

    protected $fillable = [
        'spt_id', 'nama', 'npwp', 'nomor', 'tanggal', 'jenis', 'pph'
    ];
}

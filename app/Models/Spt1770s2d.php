<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spt1770s2d extends Model
{
    use HasFactory;

    protected $table = '1770s_2d';

    protected $fillable = [
        'spt_id', 'nmAgKel', 'tglLahir', 'nik', 'hubKel', 'kerja'
    ];
}

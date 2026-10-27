<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spt17704c extends Model
{
    use HasFactory;

    protected $table = '1770_4c';

    protected $fillable = [
        'spt_id', 'nmAgKel', 'tglLahir', 'nik', 'hubKel', 'kerja'
    ];
}

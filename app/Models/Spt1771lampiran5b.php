<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Spt1771lampiran5b extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = '1771lampiran5b';

    protected $fillable = [
        'spt_id', 'nama', 'alamat', 'npwp', 'jabatan'
    ];
}

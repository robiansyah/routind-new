<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Spt1771lampiran4blain extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = '1771lampiran4blain';

    protected $fillable = [
        'spt_id', 'jenis', 'penghasilan'
    ];
}

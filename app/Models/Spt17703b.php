<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Spt17703b extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = '1770_3b';

    protected $fillable = [
        'spt_id', 'bantuan', 'warisan', 'laba', 'asuransi', 'beasiswa', 'luar_negeri', 'imbalan', 'lainnya', 'jumlah'
    ];
}

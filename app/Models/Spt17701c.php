<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Spt17701c extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = '1770_1c';

    protected $fillable = [
        'spt_id', 'nama', 'npwp', 'penghasilan', 'pengurangan', 'neto'
    ];
}

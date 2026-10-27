<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Spt17703a extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = '1770_3a';

    protected $fillable = [
        'spt_id', 'pjk_deposito', 'pph_deposito'
    ];
}

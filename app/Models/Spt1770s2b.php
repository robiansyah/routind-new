<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spt1770s2b extends Model
{
    use HasFactory;

    protected $table = '1770s_2b';

    protected $fillable = [
        'spt_id', 'kodeHarta', 'jnsHarta', 'thPerolehan', 'harga', 'ket'
    ];
}

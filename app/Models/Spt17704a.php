<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spt17704a extends Model
{
    use HasFactory;

    protected $table = '1770_4a';

    protected $fillable = [
        'spt_id', 'kodeHarta', 'jnsHarta', 'thPerolehan', 'harga', 'ket'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spt1770s2c extends Model
{
    use HasFactory;

    protected $table = '1770s_2c';

    protected $fillable = [
        'spt_id', 'kodeUtang', 'nmPbrPinjam', 'almtPbrPinjam', 'thPinjam', 'jmlPinjam'
    ];
}

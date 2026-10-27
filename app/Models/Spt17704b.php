<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spt17704b extends Model
{
    use HasFactory;

    protected $table = '1770_4b';

    protected $fillable = [
        'spt_id', 'kodeUtang', 'nmPbrPinjam', 'almtPbrPinjam', 'thPinjam', 'jmlPinjam'
    ];
}

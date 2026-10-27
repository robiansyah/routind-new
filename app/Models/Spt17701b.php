<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Spt17701b extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = '1770_1b';

    protected $fillable = [
        'spt_id'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Spt1770s1a extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = '1770s_1a';
}

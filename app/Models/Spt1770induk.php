<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Spt1770induk extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = '1770_induk';

    protected $fillable = [
        'spt_id'
    ];

    public function spt()
    {
        return $this->belongsTo(Spt::class)->withDefault();
    }
}

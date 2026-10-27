<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BupotDoc extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'bupot_doc';

    protected $fillable = [
        "bupot_id",
        "jnsDok",
        "namaDok",
        "nomorDok",
        "tglDok",
    ];

    public function bupot()
    {
        return $this->belongsTo(Bupot::class);
    }
}

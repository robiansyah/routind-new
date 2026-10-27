<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BupotSign extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'bupot_doc';

    public function npwp()
    {
        return $this->belongsTo(User::class, 'npwp', 'username');
    }
}

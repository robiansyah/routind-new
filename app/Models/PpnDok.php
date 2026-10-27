<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PpnDok extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'ppn_dok';

    protected $fillable = [
        "spt_id",'type','name','doc_no','doc_date','dpp','ppn','ppnbm'
    ];

    public function spt()
    {
        return $this->belongsTo(Spt::class)->withDefault();
    }
}

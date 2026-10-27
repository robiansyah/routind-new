<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PpnInduk extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'ppn_induk';

    protected $fillable = [
        'spt_id','dpp_a1','dpp_a2','ppn_a2','ppnbm_a2','dpp_a21','ppn_a21','ppnbm_a21','dpp_a22','ppn_a22','ppnbm_a22','dpp_a23','ppn_a23','ppnbm_a23','dpp_a24','ppn_a24','ppnbm_a24',
        'dpp_b1','ppn_b1','ppnbm_b1','dpp_b2','ppn_b2','ppnbm_b2','dpp_b3','ppn_b3','ppnbm_b3','ppn_calculated','ttd_name','ttd_position','lampiran'

    ];

    public function spt()
    {
        return $this->belongsTo(Spt::class)->withDefault();
    }
}

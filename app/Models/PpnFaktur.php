<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PpnFaktur extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'ppn_faktur';

    protected $fillable = [
        'spt_id','type','name','npwp','transaction_id','transaction_code','invoice_no','invoice_date','retur_no','dpp','ppn','ppnbm'
    ];

    public function spt()
    {
        return $this->belongsTo(Spt::class)->withDefault();
    }
}

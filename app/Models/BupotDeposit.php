<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BupotDeposit extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "spt_id",
        "npwp",
        "npwpSsp",
        "noBuktiSetor",
        "fgPbkBpe",
        "fgSsKb",
        "thnPajak",
        "msPajak",
        "kdMap",
        "kdJnsSetor",
        "kdObjPajak",
        "jmlBruto",
        "idSetor",
        "jmlSetor",
        "tglSetor",
    ];

    protected $table = 'bupot_deposit';

    public function pay()
    {
        return $this->belongsTo(Pay::class, 'idSetor');
    }
}

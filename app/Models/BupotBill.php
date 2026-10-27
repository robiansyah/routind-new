<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BupotBill extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'bupot_bill';

    protected $fillable = [
        "spt_id",
        "npwp",
        "msPajak",
        "thnPajak",
        "kdMap",
        "kjs",
        "pphDipotong",
        "pphDipotongLama",
        "kdBilling",
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'npwp', 'username');
    }
}

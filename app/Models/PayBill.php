<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PayBill extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'pay_id', 'deposit_id', 'amount'
    ];

    public function deposit()
    {
        return $this->belongsTo(TaxDeposit::class, 'deposit_id');
    }

    public function object()
    {
        return $this->belongsTo(TaxObject::class, 'deposit_id', 'deposit_id');
    }
}

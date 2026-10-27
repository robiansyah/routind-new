<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pay extends Model
{
    use HasFactory, SoftDeletes;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function deposit()
    {
        return $this->belongsTo(TaxDeposit::class, 'deposit_id');
    }

    public function object()
    {
        return $this->belongsTo(TaxObject::class, 'deposit_id', 'deposit_id');
    }

    public function bills()
    {
        return $this->hasMany(PayBill::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaxObject extends Model
{
    use HasFactory, SoftDeletes;

    public function deposit(){
        return $this->belongsTo(TaxDeposit::class, 'deposit_id')->withDefault();
    }
}

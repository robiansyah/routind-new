<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaxDeposit extends Model
{
    use HasFactory, SoftDeletes;

    public function type()
    {
        return $this->belongsTo(TaxType::class, 'type_id')->withDefault();
    }
}

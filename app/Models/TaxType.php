<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaxType extends Model
{
    use HasFactory, SoftDeletes;

    public function deposits()
    {
        return $this->hasMany(TaxDeposit::class, 'type_id')->withDefault();
    }
}

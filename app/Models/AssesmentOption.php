<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AssesmentOption extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'code', 'value', 'name'
    ];

    public function form()
    {
        return $this->belongsTo(AssesmentForm::class, 'form_id')->withDefault();
    }
}
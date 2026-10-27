<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AssesmentCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'form_id', 'name', 'option_code', 'relation', 'column'
    ];

    public function form()
    {
        return $this->belongsTo(AssesmentForm::class, 'form_id')->withDefault();
    }

    public function options()
    {
        return $this->hasMany(AssesmentOption::class, 'option_code', 'code')->withDefault();
    }
}
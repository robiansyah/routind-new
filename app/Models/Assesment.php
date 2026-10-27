<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Assesment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category_id', 'question_id', 'option_id', 'operator', 'answer', 'weight'
    ];

    public function category()
    {
        return $this->belongsTo(AssesmentCategory::class, 'category_id')->withDefault();
    }

    public function question()
    {
        return $this->belongsTo(Question::class)->withDefault();
    }
}
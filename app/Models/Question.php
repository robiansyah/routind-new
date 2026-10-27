<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'class_id', 'form_id', 'question', 'type', 'weight', 'start_date', 'end_date', 'description', 'status'
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'class_id')->withDefault();
    }

    public function form()
    {
        return $this->belongsTo(AssesmentForm::class, 'form_id')->withDefault();
    }

    public function assesments()
    {
        return $this->hasMany(Assesment::class);
    }

    public function spt()
    {
        return $this->hasMany(Spt::class, 'question_id')->orderBy('nilai', 'desc')->orderBy('second', 'asc');
    }
}
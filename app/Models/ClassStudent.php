<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClassStudent extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'class_id', 'student_id', 'nim'
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'class_id')->withDefault();
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id')->withDefault();
    }


}

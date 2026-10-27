<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Kelas extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'class';
    protected $keyType = 'string';
    public $incrementing = false;

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    public function co()
    {
        return $this->belongsTo(User::class, 'co_id')->withDefault();
    }

    public function students()
    {
        return $this->hasMany(ClassStudent::class, 'class_id');
    }

    public function questions()
    {
        return $this->hasMany(Question::class, 'class_id');
    }

    public function materials()
    {
        return $this->hasMany(Material::class, 'class_id');
    }

    public static function boot() {
        parent::boot();

        static::creating(function ($model) {
            $model->id = Str::uuid();
        });
    }
}

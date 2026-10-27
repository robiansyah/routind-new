<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class AcademyBatch extends Model
{
    use HasFactory, SoftDeletes;

    protected $keyType = 'string';
    public $incrementing = false;

    public static function boot() {
        parent::boot();

        static::creating(function ($model) {
            $model->id = Str::uuid();
        });
    }
    protected $fillable = [
        'event_id', 'name', 'start_date', 'end_date', 'registration', 'link_group', 'price', 'discount', 'code'
    ];

    public function event()
    {
        return $this->belongsTo(AcademyEvent::class, 'event_id')->withDefault();
    }
}
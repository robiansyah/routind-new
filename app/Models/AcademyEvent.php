<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class AcademyEvent extends Model
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
        'category_id', 'title', 'slug', 'description', 'image', 'location', 'start_date', 'end_date', 'price', 'registration', 'link_group', 'status', 'about', 'career', 'earn', 'benefit', 'curriculum'
    ];

    public function category()
    {
        return $this->belongsTo(AcademyCategory::class, 'category_id')->withDefault();
    }

    public function batch()
    {
//        return $this->hasOne(AcademyBatch::class, 'event_id')->latest('end_date');
        return $this->hasOne(AcademyBatch::class, 'event_id')->where([['registration', '>=', date('Y-m-d')]])->orderBy('start_date');
    }

    public function batch2()
    {
        return $this->hasOne(AcademyBatch::class, 'event_id')->latest('end_date');
//        return $this->hasOne(AcademyBatch::class, 'event_id')->where([['registration', '>=', date('Y-m-d')]])->orderBy('start_date');
    }

    public function batches()
    {
        return $this->hasMany(AcademyBatch::class, 'event_id')->orderBy('start_date');
    }
}
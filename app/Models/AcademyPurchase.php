<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class AcademyPurchase extends Model
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $keyType = 'string';
    public $incrementing = false;

    public static function boot() {
        parent::boot();

        static::creating(function ($model) {
            $model->id = Str::uuid();
        });
    }

    protected $fillable = [
        'email','name','status','invoice_code'
    ];

    public function batch()
    {
        return $this->belongsTo(AcademyBatch::class, 'batch_id');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Referral extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id','name', 'code', 'start_date', 'end_date', 'length'
    ];

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    public function students()
    {
        return $this->hasMany(User::class, 'referral_code', 'code');
    }
}

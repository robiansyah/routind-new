<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Personalia extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'personalia';

    protected $fillable = [
        'id','user_id','name','npwp','gender','address', 'ptkp','position','start_date','end_date','status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }
}

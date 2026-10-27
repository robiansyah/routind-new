<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LogActivity extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'subject', 'url', 'method', 'ip', 'agent', 'user_id', 'description'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

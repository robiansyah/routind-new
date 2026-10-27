<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Certificate extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id', 'category_id', 'sign_id', 'design_id', 'name', 'date', 'code', 'description', 'participant_no', 'no', 'username', 'email', 'batch', 'start', 'end', 'kup', 'ppn', 'pbb', 'op', 'ap', 'badan', 'potput', 'phone', 'visibility', 'type'
    ];

    public function category()
    {
        return $this->belongsTo(AcademyCategory::class, 'category_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    public function sign()
    {
        return $this->belongsTo(CertificateSign::class, 'sign_id');
    }

    public function design()
    {
        return $this->belongsTo(CertificateDesign::class, 'design_id');
    }
}
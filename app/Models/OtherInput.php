<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OtherInput extends Model
{
    use HasFactory, SoftDeletes;

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    protected $fillable = [
        'id','user_id','transaction_type','transaction_detail','transaction_doc','transaction_name','other_no','other_date','other_period', 'other_year','dpp','ppn','ppnbm',
    ];  

}

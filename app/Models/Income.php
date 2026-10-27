<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Income extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id','user_id','personalia_id','npwp','period','year','salary','pph','other','honorarium','premi','natura','thr','bruto','pension','zakat','previous','status','ptkp_code','ptkp','pkp','pph21','terutang','rates','no','nik','name','address','position','date','type','position_fee','end_period','end_year'
    ];

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    public function personalia()
    {
        return $this->belongsTo(Personalia::class, 'personalia_id')->withDefault();
    }
}

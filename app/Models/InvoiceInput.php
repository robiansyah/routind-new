<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvoiceInput extends Model
{
    use HasFactory, SoftDeletes;

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    public function retur()
    {
        return $this->hasOne(ReturInput::class, 'invoice_id');
    }

    protected $fillable = [
        'id','user_id','transaction_code','invoice_no','invoice_date','invoice_period', 'invoice_year','reference_id','collector_id','collector_name','collector_address','credit','dpp','ppn','ppnbm','approval_date'
    ];

    

}

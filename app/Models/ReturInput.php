<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReturInput extends Model
{
    use HasFactory, SoftDeletes;

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    public function invoice()
    {
        return $this->belongsTo(InvoiceInput::class, 'invoice_id')->withDefault();
    }

    protected $fillable = [
        'id','user_id','invoice_id','retur_no','retur_date','retur_period', 'retur_year','dpp','ppn','ppnbm',
    ];  

}

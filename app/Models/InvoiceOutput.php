<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvoiceOutput extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'dpp', 'ppn', 'ppnbm'
    ];

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    public function items()
    {
        return $this->hasMany(InvoiceOutputItem::class, 'invoice_id');
    }

    public function retur()
    {
        return $this->hasOne(ReturOutput::class, 'invoice_id');
    }

}

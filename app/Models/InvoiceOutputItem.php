<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvoiceOutputItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'invoice_id', 'code', 'name', 'price', 'amount', 'discount', 'dpp', 'ppn', 'tarif_ppnbm', 'ppnbm', 'type', 'unit'
    ];

}

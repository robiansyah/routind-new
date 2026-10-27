<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DigiInvoice extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'no', 'name', 'address', 'date', 'code', 'item', 'price', 'discount', 'qty', 'description', 'status', 'type', 'payment', 'qrcode'
    ];
}
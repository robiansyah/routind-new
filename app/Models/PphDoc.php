<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PphDoc extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pph_doc';

    protected $fillable = [
        "spt_id",
        "kdObjPjk",
        "jmlPph",
        "jmlBruto",
        "jmlPenerima",
    ];

    public function object()
    {
        return $this->belongsTo(TaxObject::class, 'kdObjPjk', 'kdObjPjk')->withDefault();
    }

    public function spt()
    {
        return $this->belongsTo(Spt::class)->withDefault();
    }
}

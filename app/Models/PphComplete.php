<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PphComplete extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pph_complete';

    protected $fillable = [
        "spt_id",
        "fgDOSS",
        "kdObjPjk7",
        "jmlBruto7a",
        "jmlPPh7a",
        "jmlBruto7b",
        "jmlPPh7b",
        "jmlPPh7c",
        "jmlPPh7d",
        "jmlPPh7e",
        "fgSebagai",
        "fgNikNpwp",
        "nikNpwpTtd",
        "nmWpTtd",
    ];
}

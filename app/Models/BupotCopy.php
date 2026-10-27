<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BupotCopy extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "spt_id",
        "kdBupot",
        "idBupot",
        "thnPajak",
        "msPajak",
        "noBupot",
        "npwpPemotong",
        "fgIdDipotong",
        "idDipotong",
        "namaDipotong",
        "fgQq",
        "namaQq",
        "almtDipotong",
        "kelDipotong",
        "kecDipotong",
        "kotaDipotong",
        "provDipotong",
        "kdPosDipotong",
        "noTelpDipotong",
        "fgNikErr",
        "alasanNikTanpaValidasi",
        "kdObjPjk",
        "kdJnsPjk",
        "fgFasilitas",
        "noSkb",
        "noSkdln",
        "noAturanDtp",
        "ntpnDtp",
        "noSKPP23",
        "noDokLainnya",
        "jmlBruto",
        "kiraNetto",
        "tarif",
        "tarifLt",
        "pphDipotong",
        "fgStatus",
        "revNo",
        "tglPemotongan",
        "fgTtdSebagai",
        "nikNpwpTtd",
        "namaTtd",
        "fgNikNpwpTtd",
        "fgLbDiprosesOleh",
        "createdBy",
        "kdNgrDipotong",
        "namaNgrDipotong",
        "tempatLahirDipotong",
        "tglLahirDipotong",
        "noPasporDipotong",
        "noKitasDipotong",
    ];

    protected $table = 'bupot_copy';

    public function docs()
    {
        return $this->hasMany(BupotDoc::class, 'bupot_id', 'id');
    }

    public function object(){
        return $this->hasOne(TaxObject::class, 'kdObjPjk', 'kdObjPjk');
    }
}

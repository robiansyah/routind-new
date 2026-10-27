<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bupot extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
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

    protected $table = 'bupot';

    public function docs()
    {
        return $this->hasMany(BupotDoc::class);
    }

    public function doc()
    {
        return $this->hasOne(BupotDoc::class, 'bupot_id');
    }

    public function object(){
        return $this->hasOne(TaxObject::class, 'kdObjPjk', 'kdObjPjk');
    }

    public function user(){
        return $this->belongsTo(User::class, 'npwpPemotong', 'npwp')->withDefault();
    }
}

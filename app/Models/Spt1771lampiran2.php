<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Spt1771lampiran2 extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = '1771lampiran2';

    protected $fillable = [
        'spt_id', 'hpp_barang', 'bul_barang', 'bdlu_barang', 'hpp_gaji', 'bul_gaji', 'bdlu_gaji', 'hpp_transportasi', 'bul_transportasi', 'bdlu_transportasi', 'hpp_penyusutan', 'bul_penyusutan', 'bdlu_penyusutan', 'hpp_sewa', 'bul_sewa', 'bdlu_sewa', 'hpp_bunga', 'bul_bunga', 'bdlu_bunga', 'hpp_jasa', 'bul_jasa', 'bdlu_jasa', 'hpp_piutang', 'bul_piutang', 'bdlu_piutang',
        'hpp_royalti', 'bul_royalti', 'bdlu_royalti', 'hpp_pemasaran', 'bul_pemasaran', 'bdlu_pemasaran', 'hpp_lainnya', 'bul_lainnya', 'bdlu_lainnya', 'hpp_awal', 'bul_awal', 'bdlu_awal', 'hpp_akhir', 'bul_akhir', 'bdlu_akhir', 'jumlah_barang', 'jumlah_gaji', 'jumlah_transportasi', 'jumlah_penyusutan', 'jumlah_sewa', 'jumlah_bunga', 'jumlah_jasa', 'jumlah_piutang', 'jumlah_royalti', 'jumlah_pemasaran', 'jumlah_lainnya', 'jumlah_awal', 'jumlah_akhir',
        'jumlah_hpp', 'jumlah_bul', 'jumlah_bdlu', 'total'
    ];
}

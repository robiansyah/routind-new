<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Spt1771induk extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = '1771induk';

    protected $fillable = [
        'spt_id', 'but', 'telp', 'faks', 'periode_awal', 'periode_akhir', 'alamat', 'audit', 'opini', 'nama_kap', 'npwp_kap', 'nama_akuntan', 'npwp_akuntan', 'nama_kkp', 'npwp_kkp', 'nama_konsultan', 'npwp_konsultan',
        'pkp', 'tarif_pph', 'pph_terutang', 'pengembalian', 'jumlah_pph_terutang', 'pph_ditanggung', 'jumlah_kredit', 'jumlah_pph', 'pph_sendiri', 'stp_pph', 'jumlah_sendiri_stp', 'pph_kurang_lebih', 'tanggal', 'lebih_bayar',
        'penghasilan', 'pph_terutang_14', 'kredit_pajak', 'jumlah_pph_dibayar', 'pph_pasal_25', 'pernyataan', 'lamp_a', 'lamp_b', 'lamp_c', 'lamp_d', 'lamp_e', 'lamp_f', 'lamp_g', 'lamp_h', 'lamp_i', 'lamp_j', 'lamp_k', 'lamp_l', 'lamp_m', 'lamp_n',
        'tempat_ttd', 'tanggal_ttd', 'nama_lengkap', 'npwp', 'file_laporan', 'file_rekapitulasi', 'file_nominatif', 'file_but', 'file_migas', 'file_perbandingan', 'file_lainnya', 'kurang_bayar'
    ];

    public function spt()
    {
        return $this->belongsTo(Spt::class)->withDefault();
    }
}

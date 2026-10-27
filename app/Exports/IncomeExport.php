<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class IncomeExport implements FromCollection, WithMapping, WithHeadings
{
    /**
     * grade
     *
     * @var mixed
     */
    protected $income;

    /**
     * __construct
     *
     * @param  mixed $grade
     * @return void
     */
    public function __construct($income) {
        $this->income = $income;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->income;
    }

    public function map($income) : array {
        return [
            $income->personalia->name,
            $income->period,
            $income->year,
            $income->status,
            $income->ptkp,
            $income->salary,
            $income->pph,
            $income->other,
            $income->honorarium,
            $income->premi,
            $income->natura,
            $income->thr,
            $income->bruto,
            ($income->bruto*0.05 >= 500000) ? 500000 : $income->bruto*0.05,
            $income->pension,
            $income->zakat,
            $income->terutang
        ] ;
    }

    public function headings() : array {
        return [
            'Nama',
            'Bulan',
            'Tahun',
            'Status',
            'PTKP',
            'Gaji/Pensiun atau THT/JHT',
            'Tunjangan PPh',
            'Tunjangan Lainnya, Uang Lembur, dan sebagainya',
            'Honorarium dan Imbalan Lainnya Sejenisnya',
            'Premi Asuransi yang dibayar Pemberi Kerja',
            'Natura dan Kenikmatan Lainnya',
            'Tantiem, Bonus, Gratifikasi, Jasa Produksi dan THR',
            'Penghasilan Bruto',
            'Biaya Jabatan',
            'Iuran Pensiun atau Iuran THT/JHT',
            'Zakat/Iuran Wajib Keagamaan',
            'Terutang'
        ] ;
    }
}
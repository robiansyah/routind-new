<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Certificate;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Str;

class LainImport implements ToCollection, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function collection(Collection $rows)
    {
        Validator::make($rows->toArray(), [
            '*.email' => 'required|email',
            '*.nama_peserta' => 'required',
            '*.partisipasi' => 'required',
            '*.kegiatan' => 'required',
            '*.tanggal' => 'required',
            '*.desain' => 'required',
            '*.ttd' => 'required',
        ])->validate();

        foreach ($rows as $row)
        {
            $str = 'RTND-'.date('y').strtoupper(Str::random(6));
            $year = substr($row['tanggal'],0, 4);
            $max = Certificate::whereYear('created_at', $year)->orderBy('id', 'DESC')->first();
            $no = ($max) ? $max->no + 1 : 1;
            Certificate::create([
                'email' => $row['email'],
                'name' => $row['kegiatan'],
                'description' => $row['partisipasi'],
                'username' => $row['nama_peserta'],
                'date' => $row['tanggal'],
                'design_id' => $row['desain'],
                'sign_id' => $row['ttd'],
                'code' => $str,
                'no' => $no
            ]);
        }
    }
}
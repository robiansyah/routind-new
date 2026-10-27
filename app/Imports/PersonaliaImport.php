<?php

namespace App\Imports;

use App\Models\Personalia;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PersonaliaImport implements ToCollection, WithHeadingRow
{
    public function  __construct($user_id)
    {
        $this->user_id= $user_id;
    }
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function collection(Collection $rows)
    {
        Validator::make($rows->toArray(), [
            '*.npwp' => 'required|unique:personalia,npwp,NULL,id,deleted_at,NULL,user_id,'.$this->user_id
        ])->validate();
        foreach ($rows as $row)
        {
            Personalia::create([
                'user_id' => $this->user_id,
                'name' => $row['nama'],
                'npwp' => $row['npwp'],
                'gender' => $row['jenis_kelamin'],
                'address' => $row['alamat'],
                'ptkp' => $row['ptkp'],
                'position' => $row['jabatan'],
                'start_date' => $row['mulai_kerja'],
            ]);
        }
    }
}
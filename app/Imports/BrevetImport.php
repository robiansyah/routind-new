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

class BrevetImport implements ToCollection, WithHeadingRow
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
            '*.no_peserta' => 'required',
            '*.batch' => 'required',
            '*.tanggal_mulai' => 'required',
            '*.tanggal_akhir' => 'required',
            '*.tanggal_ttd' => 'required',
            '*.kup' => 'required',
            '*.ppn' => 'required',
            '*.pbb' => 'required',
            '*.op' => 'required',
            '*.ap' => 'required',
            '*.badan' => 'required',
            '*.potput' => 'required',
            '*.visibilitas' => 'required',
        ])->validate();

        foreach ($rows as $row)
        {
            $user = User::where('email', $row['email'])->first();
            if($user){
                $certificate = Certificate::where('participant_no', $row['no_peserta'])->first();
                if($certificate){
                    $certificate->update([
                        'name' => 'Brevet A & B Batch '.$row['batch'],
                        'date' => $row['tanggal_ttd'],
                        'batch' => $row['batch'],
                        'start' => $row['tanggal_mulai'],
                        'end' => $row['tanggal_akhir'],
                        'kup' => $row['kup'],
                        'ppn' => $row['ppn'],
                        'pbb' => $row['pbb'],
                        'op' => $row['op'],
                        'ap' => $row['ap'],
                        'badan' => $row['badan'],
                        'potput' => $row['potput'],
                        'sign_id' => 1,
                        'visibility' => $row['visibilitas'],
                        'type' => $row['jenis']
                    ]);
                }else{
                    $str = 'RTND-'.date('y').strtoupper(Str::random(6));
                    $year = substr($row['tanggal_ttd'],0, 4);
                    $max = Certificate::whereYear('created_at', $year)->orderBy('id', 'DESC')->first();
                    $no = ($max) ? $max->no + 1 : 1;
                    Certificate::create([
                        'user_id' => $user->id,
                        'name' => 'Brevet A & B Batch '.$row['batch'],
                        'participant_no' => $row['no_peserta'],
                        'date' => $row['tanggal_ttd'],
                        'code' => $str,
                        'no' => $no,
                        'batch' => $row['batch'],
                        'start' => $row['tanggal_mulai'],
                        'end' => $row['tanggal_akhir'],
                        'kup' => $row['kup'],
                        'ppn' => $row['ppn'],
                        'pbb' => $row['pbb'],
                        'op' => $row['op'],
                        'ap' => $row['ap'],
                        'badan' => $row['badan'],
                        'potput' => $row['potput'],
                        'sign_id' => 1,
                        'visibility' => $row['visibilitas'],
                        'type' => $row['jenis']
                    ]);
                }
            }
        }
    }
}
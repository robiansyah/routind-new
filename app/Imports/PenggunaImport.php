<?php

namespace App\Imports;

use App\Models\User;
use App\Models\RoleUser;
use App\Models\Profile;
use App\Models\Referral;
use App\Models\Partnership;
use App\Models\ClassStudent;
use App\Models\Kelas;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use DB;

class PenggunaImport implements ToCollection, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function collection(Collection $rows)
    {
        Validator::make($rows->toArray(), [
            '*.nama' => 'required',
            '*.email' => 'required|email',
            '*.no_hp' => 'required',
            '*.jenis_pengguna' => 'required|integer|between:2,4',
        ])->validate();

        foreach ($rows as $row)
        {
            $user = User::where('email', $row['email'])->first();
            $ref = strtoupper($row['referral_code']);
            $ins = strtoupper($row['institution_code']);

            $cek = Referral::where([['code', $ref]])->first();
            $partnership = Partnership::where([['code', $ins]])->first();
            if($user){
                if($cek){
                    if($user->end_date == '' || $user->end_date < date("Y-m-d", strtotime("+".$cek->length." days"))){
                        $user->end_date = date("Y-m-d", strtotime("+".$cek->length." days"));
                    }
                    if($user->referral_code==''){
                        $user->referral_code = $ref;
                    }
                    if($user->paket == ''){
                        $user->paket = 'premium';
                    }
                    if($user->email_verified_at == ''){
                        $user->email_verified_at = date('Y-m-d H:i:s');
                    }
                    $user->save();
                }
                if($partnership && $user->institution_code == ''){
                    $user->institution_code = $ins;
                    $user->save();
                }
                $user->update([
                    'password' => Hash::make($row['no_hp']),
                ]);

                $role = RoleUser::where('user_id', $user->id)->first();
                $role->update([
                    'role_id' => $row['jenis_pengguna']
                ]);
                $npwp = $user->npwp;
                $nik = $user->username;
            }else{
                $npwp = IdGenerator::generate(['table' => 'users','field'=>'npwp', 'length' => 16, 'prefix' => '183573002']);
                $nik = IdGenerator::generate(['table' => 'users','field'=>'username', 'length' => 16, 'prefix' => '293573001']);
                $user = User::create([
                    'name' => $row['nama'],
                    'username' => $nik,
                    'npwp' => $npwp,
                    'email' => $row['email'],
                    'mobile_phone' => $row['no_hp'],
                    'password' => Hash::make($row['no_hp']),
                    'paket' => ($cek) ? 'premium' : null,
                    'end_date' => ($cek) ? date("Y-m-d", strtotime("+".$cek->length." days")) : null,
                    'referral_code' => $ref,
                    'institution_code' => ($partnership) ? $ins : null,
                    'email_verified_at' => date('Y-m-d H:i:s'),
                ]);

                RoleUser::create([
                    'user_id' => $user->id,
                    'role_id' => $row['jenis_pengguna'],
                ]);

                Profile::create([
                    'user_id' => $user->id,
                    'corporate_name' => 'PT. '.$row['nama'],
                ]);
            }
            //update coretax database
            $coretax_cek = DB::connection('coretax_db')
                ->table('users')
                ->where('email', $row['email'])
                ->first();

            if($coretax_cek){
                DB::connection('coretax_db')->table('users')->where('id', $coretax_cek->id)
                    ->update([
                        'name' => $row['nama'],
                        'username' => $nik,
                        'npwp' => $npwp,
                        'email' => $row['email'],
                        'phone' => $row['no_hp'],
                        'password' => bcrypt($row['no_hp']),
                        'email_verified_at' => date('Y-m-d H:i:s'),
                        'company_name' => 'PT. ' . $row['nama'],
                        'code' => ($partnership) ? $ins : null,
                    ]);

                DB::connection('coretax_db')->table('model_has_roles')->where('model_id', $coretax_cek->id)
                    ->update([
                        'role_id' => $row['jenis_pengguna']
                    ]);

                if(!empty($row['class_code'])){
                    $code = strtoupper($row['class_code']);
                    $kelas = DB::connection('coretax_db')->table('classrooms')->where('code', $code)->first();
                    if($kelas){
                        $cek = DB::connection('coretax_db')->table('classroom_students')->where('student_id', $coretax_cek->id)->first();
                        if($cek){
                            if($cek->classroom_id==$kelas->id){
                                DB::connection('coretax_db')->table('classroom_students')->where('student_id', $coretax_cek->id)
                                    ->update([
                                        'nim' => $row['no_hp']
                                    ]);
                            }else{
                                DB::connection('coretax_db')->table('classroom_students')->where('student_id', $coretax_cek->id)
                                    ->update([
                                        'classroom_id' => $kelas->id,
                                        'student_id' => $coretax_cek->id,
                                        'nim' => $row['no_hp'],
                                    ]);
                            }
                        }else{
                            DB::connection('coretax_db')->table('classroom_students')->insert([
                                'classroom_id' => $kelas->id,
                                'student_id' => $coretax_cek->id,
                                'nim' => $row['no_hp'],
                            ]);
                        }

                    }
                }
            }else{
                DB::connection('coretax_db')->table('users')->insert([
                    'id' => $user->id,
                    'name' => $row['nama'],
                    'username' => $nik,
                    'npwp' => $npwp,
                    'email' => $row['email'],
                    'phone' => $row['no_hp'],
                    'password' => bcrypt($row['no_hp']),
                    'email_verified_at' => date('Y-m-d H:i:s'),
                    'company_name' => 'PT. '.$row['nama'],
                    'code' => ($partnership) ? $ins : null,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);

                DB::connection('coretax_db')->table('model_has_roles')->insert([
                    'role_id' => $row['jenis_pengguna'],
                    'model_type' => 'App\Models\User',
                    'model_id' => $user->id,
                ]);

                if(!empty($row['class_code'])){
                    $code = strtoupper($row['class_code']);
                    $kelas = DB::connection('coretax_db')->table('classrooms')->where('code', $code)->first();
                    if($kelas){
                        $cek = DB::connection('coretax_db')->table('classroom_students')->where('student_id', $user->id)->first();
                        if($cek){
                            if($cek->classroom_id==$kelas->id){
                                DB::connection('coretax_db')->table('classroom_students')->where('student_id', $user->id)
                                    ->update([
                                        'nim' => $row['no_hp']
                                    ]);
                            }else{
                                DB::connection('coretax_db')->table('classroom_students')->where('student_id', $user->id)
                                    ->update([
                                        'classroom_id' => $kelas->id,
                                        'student_id' => $user->id,
                                        'nim' => $row['no_hp'],
                                    ]);
                            }
                        }else{
                            DB::connection('coretax_db')->table('classroom_students')->insert([
                                'classroom_id' => $kelas->id,
                                'student_id' => $user->id,
                                'nim' => $row['no_hp'],
                            ]);
                        }

                    }
                }
            }

            $code = strtoupper($row['class_code']);
            $kelas = Kelas::where('code', $code)->first();
            if($kelas){
                $cek = ClassStudent::where('student_id', $user->id)->first();
                if($cek){
                    if($cek->class_id==$kelas->id){
                        $cek->nim = $row['no_hp'];
                        $cek->save();
                    }else{
                        $cek->delete();
                        ClassStudent::create([
                            'class_id' => $kelas->id,
                            'student_id' => $user->id,
                            'nim' => $row['no_hp'],
                        ]);
                    }
                }else{
                    ClassStudent::create([
                        'class_id' => $kelas->id,
                        'student_id' => $user->id,
                        'nim' => $row['no_hp'],
                    ]);
                }

            }
        }
    }
}
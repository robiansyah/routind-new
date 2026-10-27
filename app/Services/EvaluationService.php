<?php

namespace App\Services;
use App\Models\Spt;
use App\Models\Question;
use App\Models\Assesment;
use App\Models\AssesmentCategory;
use App\Models\AssesmentOption;
use DB;

class EvaluationService
{
    public function evaluation($id)
    {
        $spt = Spt::findOrFail($id);
        $question = Question::with('form')->findOrFail($spt->question_id);
        $nilai = 0;
        $note = "";
        if($question->form->name==$spt->form_code){
            $assesments = Assesment::with('category')->where('question_id', $question->id)->get();
            foreach ($assesments as $item){
                if($item->option_id==''){
                    if($item->category->data=='sum'){
                        $hasil = ($item->category->relation=='spt') ? $spt : (($item->category->condition=='') ? DB::table($item->category->relation)->where('spt_id', $id)->sum($item->category->column) : DB::table($item->category->relation)->where('spt_id', $id)->where($item->category->condition, $item->category->value)->sum($item->category->column));
                        $nilai += ($hasil==$item->answer) ? $item->weight : 0;
                        $note .= $item->category->name;
                        $note .= ($hasil==$item->answer) ? " Benar<br>" : " Salah<br>";
                    }else{
                        $hasil = ($item->category->relation=='spt') ? $spt : (($item->category->condition=='') ? DB::table($item->category->relation)->where('spt_id', $id)->first() : DB::table($item->category->relation)->where('spt_id', $id)->where($item->category->condition, $item->category->value)->first());
                        $column = $item->category->column;
                        $nilai += ($hasil->$column==$item->answer) ? $item->weight : 0;
                        $note .= $item->category->name;
                        $note .= ($hasil->$column==$item->answer) ? " Benar<br>" : " Salah<br>";
                    }
                }else{
                    $option = AssesmentOption::findOrFail($item->option_id);
                    $hasil = ($item->category->relation=='spt') ? $spt : (($item->category->condition=='') ? DB::table($item->category->relation)->where('spt_id', $id)->first() : DB::table($item->category->relation)->where('spt_id', $id)->where($item->category->condition, $item->category->value)->first());
                    $column = $item->category->column;
                    $nilai += ($hasil->$column==$option->value) ? $item->weight : 0;
                    $note .= $item->category->name;
                    $note .= ($hasil->$column==$option->value) ? " Benar<br>" : " Salah<br>";
                }
            }
        }
        $awal  = strtotime($question->start_date);
        $akhir = strtotime(date('Y-m-d H:i:s'));
        $diff  = $akhir - $awal;
        $spt->second = $diff;
        $spt->nilai = $nilai;
        $spt->note = $note;
        $spt->save();

        return true;
    }
}
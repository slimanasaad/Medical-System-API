<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Record;
use App\Models\Patient;
use App\Traits\GeneralTrait;

class RecordController extends Controller
{
    use GeneralTrait;
    public function show_record(){

        $record_check= Record::leftjoin('patients','patient_id','=','patients.id')->first();
        if(!$record_check){
            return $this->returnError("e06","no record");
        }
        $Record = Record::leftjoin('patients','patient_id','=','patients.id')->get(['records.id','diabetes','hypertension','kidney_disease','ischemic_heart','cva','medication','diagnosis','drugs','patient_id','name','email','password','age','phone','national_id','picture','relative_phone']);

        return $this -> returnData('Record',$Record,"all record","s04");
    }
    
        public function show_record_by_id(Request $request){
            $id=$request->id;

        $record_check= Record::leftjoin('patients','patient_id','=','patients.id')->where('records.patient_id',$id)->first();
        if(!$record_check){
            return $this->returnError("e06","no record");
        }
        $Record = Record::leftjoin('patients','patient_id','=','patients.id')->where('records.patient_id',$id)->get(['records.id','diabetes','hypertension','kidney_disease','ischemic_heart','cva','medication','diagnosis','drugs','patient_id','name','email','password','age','phone','national_id','picture','relative_phone']);

        return $this -> returnData('Record',$Record,"record '$id'","s05");
    }
    
}

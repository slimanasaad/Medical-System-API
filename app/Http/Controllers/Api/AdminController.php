<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Patient;
use App\Models\Record;
use App\Traits\GeneralTrait;

class AdminController extends Controller
{
    use GeneralTrait;
    public function register_admin(Request $request){
        $Admin = Admin::where('email',$request->email)->first();
            if(!$Admin){
        Admin::insert([
            'name'=>$request->name,
            'email' => $request->email,
            'password' => $request->password,
            'phone' => $request->phone
        ]);
            $id = Admin::select('id')->where([['email',$request->email],['password', $request->password]])->get();
            return $this -> returnData('id',$id,"Account successfully created","s01");
            //return $this->returnSuccessMessage("s01","Account successfully created");
            }
            return $this->returnError('e01','This account is already registered');
        
    }
    
    public function login_admin(Request $request){
        $Admin = Admin::where([['email',$request->email],['password', $request->password]])->first();
        //$id = Admin::select('id')->where([['email',$request->email],['password', $request->password]])->get();
        if(!$Admin){
            return $this -> returnError('e02','Please enter your information correctly');
         }
        $id = Admin::select('id')->where([['email',$request->email],['password', $request->password]])->get();
        return $this -> returnData('id',$id,"Login succeeded","s02");
        //return $this->returnSuccessMessage("s02","Login succeeded");
        
    }
        // add patient record function
    public function add_record(Request $request){
        $patient_id=$request->id;
        $diabetes = $request->diabetes;
        $hypertension = $request->hypertension;
        $kidney_disease = $request->kidney_disease;
        $ischemic_heart = $request->ischemic_heart;
        $cva = $request->cva;
        $medication = $request->medication;
        $Patient = Patient::where('id',$patient_id)->first();
        if(!$Patient){
            return $this -> returnError('e03','This patient does not exist');
         }
        Record::insert([
            'diabetes'=>$diabetes,
            'patient_id' => $request->id,
            'hypertension' => $hypertension,
            'kidney_disease' => $kidney_disease,
            'ischemic_heart' => $ischemic_heart,
            'cva' => $cva,
            'medication' => $medication
        ]);
        return $this->returnSuccessMessage("s03","Create record successfully");
    }

    // update record function
    public function update_record(Request $request){
        $id=$request->id;
        $diabetes = $request->diabetes;
        $hypertension = $request->hypertension;
        $kidney_disease = $request->kidney_disease;
        $ischemic_heart = $request->ischemic_heart;
        $cva = $request->cva;
        $medication = $request->medication;
        $Record = Record::where('id',$id)->first();
        if(!$Record){
            return $this -> returnError('e04','This record does not exist');
         }
        Record::where('id',$id)->update(['diabetes'=>"$diabetes" ,'hypertension'=>"$hypertension" ,'kidney_disease'=>"$kidney_disease",'ischemic_heart'=>"$ischemic_heart", 'cva' => "$cva" , 'medication'=>"$medication" ]);
        
        return $this->returnSuccessMessage("s04","update record successfully");
    }
    

    // delete record function
    public function delete_record(Request $request){
        $id=$request->id;
        $Record = Record::where('id',$id)->first();
        if(!$Record){
            return $this -> returnError('e04','This record does not exist');
         }
        Record::where('id',$id)->delete();
        return $this->returnSuccessMessage("s05","delete record successfully");
    }

    

}

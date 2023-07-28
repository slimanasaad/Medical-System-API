<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Record;
use App\Traits\GeneralTrait;

class DoctorController extends Controller
{
    use GeneralTrait;
    public function register_doctor(Request $request){
        $Doctor = Doctor::where('national_id',$request->national_id)->first();
            if(!$Doctor){
        Doctor::insert([
            'name'=>$request->name,
            'email' => $request->email,
            'password' => $request->password,
            'phone' => $request->phone,
            'national_id'=>$request->national_id
        ]);
$id = Doctor::select('id')->where([['national_id',$request->national_id],['password', $request->password]])->get();
            return $this -> returnData('id',$id,"Account successfully created","s01");
            //return $this->returnSuccessMessage("s01","Account successfully created");
            
            }
            return $this->returnError('e01','This account is already registered');
        
    }
    public function login_doctor(Request $request){
        $Doctor = Doctor::where([['national_id',$request->national_id],['password', $request->password]])->first();
        if(!$Doctor){
            return $this -> returnError('e02','Please enter your information correctly');
         }
$id = Doctor::select('id')->where([['national_id',$request->national_id],['password', $request->password]])->get();
            return $this -> returnData('id',$id,"Login succeeded","s02");
        //return $this->returnSuccessMessage("s02","Login succeeded");
        
    }
    
    // update record from doctor function
    public function update_diagnosis(Request $request){
        $id=$request->id;
        $diagnosis=$request->diagnosis;

        $Record = Record::where('id',$id)->first();
        if(!$Record){
            return $this -> returnError('e04','This record does not exist');
         }
        Record::where('id',$id)->update(['diagnosis'=>"$diagnosis"]);
        
        return $this->returnSuccessMessage("s04","update record successfully");
    
    }
    
        // update record from doctor function
    public function update_drugs(Request $request){
        $id=$request->id;

        $drugs=$request->drugs;
        $Record = Record::where('id',$id)->first();
        if(!$Record){
            return $this -> returnError('e04','This record does not exist');
         }
        Record::where('id',$id)->update(['drugs'=>"$drugs"]);
        
        return $this->returnSuccessMessage("s04","update record successfully");
    
    }

}

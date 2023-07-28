<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Traits\GeneralTrait;

class PatientController extends Controller
{
    use GeneralTrait;
    public function register_patient(Request $request){
        $Patient = Patient::where('national_id',$request->national_id)->first();
            if(!$Patient){
            if($request->picture){
            $name = time();
            \Image::make($request->picture)->save(public_path('img/').$name);
            }
        Patient::insert([
            'name'=>$request->name,
            'email' => $request->email,
            'password' => $request->password,
            'phone' => $request->phone,
            'national_id'=>$request->national_id,
            'age'=>$request->age,
            'picture'=>$name,
            'relative_phone' => $request->relative_phone
        ]);
$id = Patient::select('id')->where([['national_id',$request->national_id],['password', $request->password]])->get();
            return $this -> returnData('id',$id,"Account successfully created","s01");
            //return $this->returnSuccessMessage("s01","Account successfully created");
    }
    
            return $this->returnError('e01','This account is already registered');
        
}

    public function login_patient(Request $request){
        $Patient = Patient::where([['national_id',$request->national_id],['password', $request->password]])->first();
        if(!$Patient){
            return $this -> returnError('e02','Please enter your information correctly');
         }
$id = Patient::select('id')->where([['national_id',$request->national_id],['password', $request->password]])->get();
            return $this -> returnData('id',$id,"Login succeeded","s02");
        //return $this->returnSuccessMessage("s02","Login succeeded");
        
    }
    
    // show all patient function
    public function show_patient(){
    $Patient = Patient::select('id','name','email','password','phone','age','national_id','picture')->get();
    /*
    if(!$Patient){
        return $this->returnError("e05","no patients");        
    }
    */
     return $this -> returnData('patient',$Patient,"all patient","s03");   
    }

}

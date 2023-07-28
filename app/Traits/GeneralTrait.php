<?php
namespace App\Traits;

trait GeneralTrait
{
/*
    public function getCurrentLang(){
        return app()->getLocale();
    }
*/
    public function returnError($errNum, $msg){
        return response()->json([
            'status'=>false,
            'errnum'=>$errNum,
            'msg'=>$msg
        ]);
    }

    public function returnSuccessMessage($errNum,$msg){
        return response()->json([
            'status'=>true,
            'errnum'=>$errNum,
            'msg'=>$msg
        ]);
    }

    public function returnData($key,$value,$msg,$errnum){
        return response()->json([
            'status'=>true,
            'errnum'=>$errnum,
            'msg'=>$msg,
            $key=>$value
        ]);
    }
        



}
<?php
namespace App\Http\Helpers;
use Illuminate\Http\Exceptions\HttpResponseException;

class Helper {

public static function sendError ($message,$errors=[],$code=401)

{
    $response= ['sucess'=>false, 'message'=> $message];
    if(!empty($errors)){
        $response['data']=$errors;
    }

    throw new HttpResponseException(response()->json($response,$code));
    


}


public static function sendSuccess($message, $data = [])
{
    $response = ['success' => true, 'message' => $message];
    if (!empty($data)) {
        $response['data'] = $data;
    }

    throw new HttpResponseException(response()->json($response, 200));
}
}


?>
<?php 

const PATH_PREFIX = "/";
const PORT = ":8000";
const BASE_URL = "http://localhost" . PORT . PATH_PREFIX;

// Dont use redirect when working with AJAX... 

// class Res{
//     public static function redirect($path){
//         header("Location: " . BASE_URL . $path); 
//         exit; 
//     }
// }

// class Auth{
//     public static function loginRequired(){
//         if(!isset($_SESSION['id'])){
//             Res::redirect("auth/login"); // change later 
//         }
//     }
// }

class Errors{
    const ERRORS = [
        'ERR_MISSING_DATA' => ['status'=>400, 'message'=>'ERR: Data is missing'],
        'ERR_INVALID_DATA'=> ['status'=>400, 'message'=>'ERR: Invalid data'],
        'ERR_LOCKED_OUT'=>['status'=>401, 'message'=>'ERR: Not authorized'],
        'ERR_INCORRECT_DATA'=>['status'=>401, 'message'=>'ERR_ Incorrect data'],
        'ERR_FORBIDDEN' => ['status'=>403, 'message'=>'ERR: Forbidden'], 
        'ERR_NOT_FOUND'=>['status'=>404, 'message'=>'ERR: Requested resource missing'],
        'ERR_UPLOAD_FAIL'=>['status'=>422, 'message'=>'ERR: Upload fail']
    ]; 

    public static function sendJsonFormatErr($errorCode){
        $error = self::ERRORS[$errorCode]; 
        http_response_code($error['status']);
        echo json_encode([
            'status'=> 'error',
            'message'=>$error['message']
        ]);
    }

    public static function sendErrPath($errorCode){
        http_response_code(self::ERRORS[$errorCode]['status']); 
        echo json_encode([
            'errorPath' => PATH_PREFIX . 'errors/' . $errorCode
        ]); 
    }

}



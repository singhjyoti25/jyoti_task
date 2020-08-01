<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use \Firebase\JWT\JWT;
use chriskacerguis\RestServer\RestController;
/**
* Common controller for service modules
* version: 2.1 (23-01-2019)
*/

class Common_Service_Controller extends RestController{
    
    public function __construct(){

        parent::__construct(); 
        $this->load->helper('response_message'); //load api response message helper
    }

    /**
     * Check auth token of request
     * Modified in ver 2.0
     */
    public function check_service_auth() {
         $this->authData = '';    
        //authenticate user
        $authToken = $this->get_bearer_token();
        if(empty($authToken)) {
            $this->auth_error_msg();
        }
        
        //Validate token
        try {
            $decoded =  JWT::decode($authToken, getenv('JWT_SECRET_KEY'), array('HS256'));
            $user_id = $decoded->data->user_id;
            $device_id = $decoded->data->device_id;
             
        }catch ( \Firebase\JWT\ExpiredException $e ) {
            $this->auth_error_msg(SESSION_EXPIRED, get_response_message(506), BAD_REQUEST);
        } 
        catch (Exception $e) {
            $this->auth_error_msg(INVALID_TOKEN,get_response_message(101), BAD_REQUEST);
        }

        //At this point authentication is successfully done
        //Get authenticated User data
        $userAuthData = $this->general_model->getUserDetail($user_id,$device_id);

        if(empty($userAuthData)){
            
            $this->auth_error_msg(USER_NOT_FOUND, get_response_message(104), BAD_REQUEST);
        }

        if($userAuthData->status != 1) {
            $this->auth_error_msg(ACCOUNT_INACTIVE, get_response_message(111), BAD_REQUEST);
        } 
        
        //user authenticated successfully
        $this->authData = $userAuthData;
        return TRUE;
    }

    /** 
     * Get Authorization header
     */
    protected function getAuthorizationHeader() {

        $headers = null;

        if (isset($_SERVER['Authorization'])) {
            $headers = trim($_SERVER["Authorization"]);
        } else if (isset($_SERVER['HTTP_AUTHORIZATION'])) { //Nginx or fast CGI
            $headers = trim($_SERVER["HTTP_AUTHORIZATION"]); 
        } else if (function_exists('apache_request_headers')) {

            $requestHeaders = apache_request_headers();
            // Server-side fix for bug in old Android versions (a nice side-effect of this fix means we don't care about capitalization for Authorization)
            $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
            if (isset($requestHeaders['Authorization'])) {
                $headers = trim($requestHeaders['Authorization']);
            }
        }
        return $headers;
    }

    /**
     * Get Bearer token from header
     */
    public function get_bearer_token() {

        $headers = $this->getAuthorizationHeader();
        
        // HEADER: Get the access token from the header
        if (!empty($headers)) {
            if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
                return $matches[1];
            }
        }
        return null;
    }

    /**
     * Show request authentication error message
     * Added in ver 2.0
     */
    public function auth_error_msg($error_type='ACCESS_DENIED', $msg='Invalid Authorisation', $status_code=400, $data='') {

        if(empty($data)) {
            $data=(object)[];
        }
        $this->response(['status' => FAIL, 'status_code' => $status_code,'error_type' => $error_type, 'message' => $msg, "data" => $data ], $status_code);
    }

    /**
    * Returns error response for an API request
    */
    public function error_response($msg='Invalid param value', $error_type='INVALID_PARAM', $status_code=400, $data='') {

        if(empty($data)) {
            $data=(object)[];
        }

        $this->response(['status' => FAIL, 'status_code' => $status_code,'error_type' => $error_type, 'message' => $msg, "data" => $data ], $status_code);
    }

    /**
    * Returns success response for an API request
    */
    public function success_response($msg='', $data='', $status_code=OK) {

        if(empty($data)) {
            $data=(object)[];
        }

        $this->response(['status' => SUCCESS, 'status_code' => $status_code,'message' => $msg, "data" => $data ], $status_code);
    }

}//End Class 

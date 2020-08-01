<?php

/**
* Information controller
* Handles web service request
* version: 1.0 ( 01-08-2020 )
*/
class Information extends Common_Service_Controller {

	public function __construct(){
        parent::__construct();
	}

    function send_request_get(){

        $email = $this->get('email');
        if(empty($email)){
            $this->error_response(get_response_message(115)); //error reponse for required email
        }

        $datetime = date('Y-m-d H:i:s'); //current datetime

        //Before sending request get this email already sent request before or not
        $isEmailExist = $this->common_model->is_data_exist(INFORMATION, array('requested_email' => $email));

        if($isEmailExist !==FALSE){  //If email exist then only increase request no by 1

            $request_no = $isEmailExist->request_no +1; //Increase request no by 1

            $data = array('request_no' => $request_no, 'created_at' => $datetime);
            $where = array('requested_email' => $email);
            $update = $this->common_model->updateFields(INFORMATION,$data,$where);

            if($update === FALSE){  //If data not updated  then throw error
                $this->error_response(get_response_message(107)); //error reponse for not sending request
            }

            //Else insert row in mapping table and throw success message
            $mapData = array('information_id' => $isEmailExist->inforamtionID,'created_at' => $datetime);
            $this->common_model->insertData(INFORMATION_MAPPING,$mapData);
            $this->success_response(get_response_message(116)); //success response after successfully sending request

        }

        //else insert new record
        $data = array('requested_email' => $email, 'request_no' => 1, 'created_at' => $datetime);
        $last_id = $this->common_model->insertData(INFORMATION,$data);

        if(!$last_id){  //If data not inserted  then throw error
            $this->error_response(get_response_message(107)); //error reponse for not sending request
        }

        //Else insert row in mapping table and throw success message
        $mapData = array('information_id' => $last_id,'created_at' => $datetime);
        $this->common_model->insertData(INFORMATION_MAPPING,$mapData);
        $this->success_response(get_response_message(116)); //success response after successfully sending request
    }
} //End Class
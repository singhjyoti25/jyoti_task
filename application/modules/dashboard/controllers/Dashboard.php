<?php

class Dashboard extends MX_Controller {

	public function __construct(){

    parent::__construct();
	  //$this->load->model('dashboard_model');
	}

	function index(){
  	$data['title'] =  'Dashboard';
    $data['total_request'] =  $this->common_model->request_count();
    $data['all_request'] =  $this->common_model->all_request();
    $this->load->admin_render('dashboard', $data);  

	}

  //Request list 
  function request_list(){ 
    $no = $_POST['start'];
    if(isset($_POST['date_search']) && !empty($_POST['date_search'])){
     
      $search_date = $_POST['date_search'];
      
      $where = "DATE_FORMAT(`inforamtion_mapping`.`created_at`,'%Y-%m-%d %H:%i:%s') = '".$search_date."' ";
      $this->common_model->set_data($where); 
    }

    $list = $this->common_model->request_list();
    $data = array();
    foreach ($list as $request) {
      $no++;
      $row = array();
      $row[] = $no;
      $row[] = $request->requested_email; 
      $row[] = $request->created_at; 
      $data[] = $row;
    }

    $output = array(
      "draw" => $_POST['draw'],
      "recordsTotal" => $this->common_model->count_all(),
      "recordsFiltered" => $this->common_model->count_filtered(),
      "data" => $data,
      "csrf"=>''
    );
    //output to json format
    echo json_encode($output);

  }//END OF FUNCTION
 
}
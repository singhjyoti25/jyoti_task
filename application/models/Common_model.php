<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Common Model
 * version: 1.0 (01-08-2020)
 * Common DB queries
 */
class Common_model extends CI_Model {

    var $column_order = array();  //set column field database for datatable orderable
    var $table_col= array();
    var $column_search = array(); //set column field database for datatable 
   
    public function __construct(){
        parent::__construct();
    }
    
    /* INSERT RECORD FROM SINGLE TABLE */
    function insertData($table, $dataInsert) {
        $this->db->insert($table, $dataInsert);
        return $this->db->insert_id();
    }

    /* UPDATE RECORD FROM SINGLE TABLE */
    function updateFields($table, $data, $where){
        $this->db->update($table, $data, $where);
        if($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }
    }
    
    /* UPDATE RECORD FROM TABLE */
    function deleteData($table,$where){
        $this->db->where($where);
        $this->db->delete($table); 
        if($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }   
    }

    /* Check if given data exists in table and return record if exist- Very useful fn
     */
    function is_data_exist($table, $where){
        $this->db->from($table);
        $this->db->where($where);
        $query = $this->db->get();
        $rowcount = $query->num_rows();
        if($rowcount==0){
            return FALSE; //record not found
        }
        else {
            return $query->row(); //return record if found (In preveious versions, this use to return TRUE(bool) only)
        }
    } 
    /* get total request count
     */
    function request_count(){
        $this->db->select('SUM(request_no) as total_request');
        $this->db->from(INFORMATION);
        $query = $this->db->get();
        $result = $query->row();
        return $result->total_request;
    } 

    /* get all requset information
     */
    function all_request(){
        $this->db->select('*');
        $this->db->from(INFORMATION);
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    public function set_data($where=''){
        $this->where = $where; 
    } 

    private function posts_get_query(){
       
        $this->db->select('inforamtion.inforamtionID,inforamtion.requested_email,inforamtion.request_no,inforamtion_mapping.created_at, inforamtion_mapping.information_id ');

        $this->db->from(INFORMATION.' as inforamtion');
        $this->db->join(INFORMATION_MAPPING.' as inforamtion_mapping', ' inforamtion_mapping.information_id = inforamtion.inforamtionID'); 
        $i = 0;

        foreach ($this->column_search as $emp) { // loop column
            if(isset($_POST['search']['value']) && !empty($_POST['search']['value'])){
                $_POST['search']['value'] = $_POST['search']['value'];
            } else
                $_POST['search']['value'] = '';

            if($_POST['search']['value']) // if datatable send POST for search
            {
                if($i===0) // first loop
                {
                    $this->db->group_start();
                    $this->db->like(($emp), $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like(($emp), $_POST['search']['value']);
                }

                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if(!empty($this->group_by)){
            $this->db->group_by($this->group_by);
        }
        
        if(!empty($this->where))
            $this->db->where($this->where); 
           
        //for category filter
        $count_val = count($_POST['columns']);
        for($i=1;$i<=$count_val;$i++){ 

            if(!empty($_POST['columns'][$i]['search']['value'])){ 

                $this->db->where(array($this->table_col[$i]=>$_POST['columns'][$i]['search']['value'])); 
            }
        }

        if(isset($_POST['order'])) { // here order processing
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order)){
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function request_list(){
        $this->posts_get_query();
        if(isset($_POST['length']) && $_POST['length'] < 1) {
            $_POST['length']= '5';
        } else
        $_POST['length']= $_POST['length'];
        
        if(isset($_POST['start']) && $_POST['start'] > 1) {
            $_POST['start']= $_POST['start'];
        }
        $this->db->limit($_POST['length'], $_POST['start']);
        
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered(){
        $this->posts_get_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all(){
        $this->db->from(INFORMATION);
        return $this->db->count_all_results();
    }
} //end of class
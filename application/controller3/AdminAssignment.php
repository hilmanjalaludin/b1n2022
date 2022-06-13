<?php

 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
class AdminAssignment extends EUI_Controller{
	
	
 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */	
function __construct(){
	parent::__construct();
display(0);		
	$this->load->helper('EUI_Object');
	$this->load->model(base_class_model($this));
	
	
}	

 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
function index(){	

// load data di model rol 
 $this->role = Singgleton('M_UserRole');
 
// get my role data process on form action 
 $Button = $this->role->_select_role_form_action($this);
 $this->load->view("mod_admin_assignment/view_assignment_index", array(
	'Button' => Objective( $Button ) 
  )); 
  
}

/**
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
   function Submit()
{
	
// check by check 
  if( !_get_is_login() ){
	echo_json_encode( 0 ); 
	return FALSE;
  } 
// select all data process like this  
 $cond = array('success' => 0 , 'row' => null );
 $out = UR();

// then will get out. 
 if( !$out->field('frm_bucket_user_action') ){
	echo_json_encode( 0 ); 
	return FALSE;	
 }
  $this->conDataResponse = 0;
// on act quantity  
 if( $out->field('frm_bucket_user_action') == 1 ){
	$this->conDataResponse = Singgleton($this)->_set_row_admin_quantity( $out );
 }

//   on act checked  
 if( $out->field('frm_bucket_user_action') == 2 ){
	 // note: belum ada functionnya di Model
	$this->conDataResponse = Singgleton($this)->_set_row_buket_checked( $out ); 
 }
 
// then if true process . 
 if( $this->conDataResponse ) {
	echo json_encode(array( 'success' => 1,  'row' => $this->conDataResponse )); 
	return FALSE;	
 }
 
 echo_json_encode( 0 ); 
 // return --> 	
}

/**
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
  

function Assign()
{
	
 // get all request from client 

 $this->url= UR();
  
// then set on her  
 $this->start_page = 0;
 $this->per_page   = 10;
  
 // ---------- customize page data ------------------------ 
 if( $this->url->find_value('frm_admin_record') ){
	$this->per_page = $this->url->field('frm_admin_record');
  }	 	  
  
 // ------------- then result data ---------------------------------
 
   $this->post_page  = $this->url->field('page','intval');
   $this->arr_result = array();
   
  $this->Data =& Singgleton($this);
 
  $this->arr_content =  $this->Data->_select_row_bucket_page(UR());
  $this->tot_result = count($this->arr_content);
	
   if( $this->post_page) {
	$this->start_page = (($this->post_page-1)*$this->per_page);
  } else {	
	$this->start_page = 0;
  }

 // @ pack : set result on array
  if( (is_array($this->arr_result)) 
	AND ( $this->tot_result > 0 ) )
 {
	$this->arr_result = array_slice($this->arr_content, $this->start_page, $this->per_page);
}	
 
 $this->page_counter = ceil($this->tot_result/ $this->per_page);
 
 // @ pack : then set it to view 
 
 $ar_data_admin = array (
	'content_pages' => $this->arr_result,
	'total_records' => $this->tot_result,
	'total_pages'   => $this->page_counter,
	'select_pages'  => $this->post_page,
	'start_page' 	=> $this->start_page );
 
 $this->load->view("mod_admin_assignment/view_assigment_row_page", $ar_data_admin);	


}
/**
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
  
 function Role() {
	$out= UR();
	$arr_role_toolbars = array();
	
	if( $out->find_value('modul') )  {
		$arr_role_toolbars = $this->M_UserRole->_select_role_menu_toolbar( $out->get_value('modul'));
	}
    echo json_encode( $arr_role_toolbars );
 }


// =============== END CLASS ======================
	
}


?>
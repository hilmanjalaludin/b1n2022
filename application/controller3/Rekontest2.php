<?php

 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
class Rekontest2 extends EUI_Controller{
	
	
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
 $this->load->view("mod_user_rekontest2/view_rekontest2_index", array(
	'Button' => Objective( $Button ) 
  )); 
  
}


/**
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
  

function UserunderGroup(){
	
// default array to Process 	
 $result_array = array(); 
 $result_select = null;
	
// nilai awal untuk sebuah form process ok . 
 $user_form_control = null;

 
//call my Lib .
	
 $STD =& Singgleton('M_SysUser'); 
 $URI = UR();
	
// get selected dropdown 

 $result_select = $URI->fields( 'select' );
 if( $URI->find_value( 'frmrek_from_usergroup' ) ){
	$result_array = $STD->_getUserLevelGroup($URI->field('frmrek_from_usergroup'), 1);
 }
 // if 'dropdown'
 
 if( $URI->field('type') == 'dropdown' ){
	$user_form_control = form()->combo($URI->field('id'), 'select tolong', $result_array, first($result_select)); 
 }
 
 // if 'listboxes'
 
 else if( $URI->field('type') == 'listboxes' ){
	$user_form_control = form()->listCombo( $URI->field('id'), 'select tolong', $result_array, $result_select, 
										    null, array( 'height' => '200px', 'dwidth' => '100%')); 
 }
 else {
	$user_form_control = form()->combo($URI->field('id'), 'select tolong', $result_array, $result_select ); 
 }
 
 
// return data process "$user_form_control";
 printf("%s", $user_form_control);
  
}


/**
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
function EventUnderGroup(){
	
// default array to Process 	
 $result_array = array(); 
 $result_select = null;
	
// nilai awal untuk sebuah form process ok . 
 $user_form_control = null;

 
//call my Lib .
	
 $STD =& Singgleton('M_SysUser'); 
 $URI =& UR();
	
// get selected dropdown 
 $result_select = $URI->fields( 'select' );
 if( $URI->find_value( 'torek_groupuser' ) ){
	$result_array = @call_user_func('SetCapital', $STD->_getUserLevelGroup($URI->field('torek_groupuser'), 1));
 }
 
// if 'dropdown'
 if( $URI->field('type') == 'dropdown' ){
	$user_form_control = form()->combo($URI->field('id'), 'select tolong', $result_array, first($result_select)); 
 }
 
 // if 'listboxes'
 else if( $URI->field('type') == 'listboxes' ){
	$user_form_control = form()->listCombo( $URI->field('id'), 'select tolong', $result_array, $result_select, 
										    null, array( 'height' => '200px', 'dwidth' => '99%')); 
 }
 else {
	$user_form_control = form()->combo($URI->field('id'), 'select tolong', $result_array, $result_select ); 
 }
 
 
// return data process "$user_form_control";
 printf("%s", $user_form_control);	
}


/**
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
function CallReasonId(){

// get uri data to process OK 	
	$URI =& UR();
	
// form controller OK 	
	$form_controll = null;
	
// result_array  to process 	
	$result_array = call_user_func('CallResultByCategory', $URI->field('callStatus'));
	
	
// define form 	
	$form_controll  = form()->combo("frmrek_from_reasonstatus", "select xselect tolong", $result_array, null, null, array('multiple' => true ) );
	
	printf('%s', $form_controll);	
	
}


/**
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
function CallReasonDataId(){
// get uri data to process OK 	
	$URI =& UR();
	$form_controll = null;
	
// result_array  to process 	
	$result_array = call_user_func('CallResultByCategory', $URI->field('callStatus'));
	
// define form 	
	$form_controll  = form()->combo("torek_callreasonid", "select tolong", $result_array, null, array('change' => 'window.EventSetCallBackLater(this);')  );
	printf('%s', $form_controll);	
	
}
 
// http://192.168.10.236/bni-tele-ans/index.php/Rekontest2/CallReasonDataId
/**
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
  

function Pager() {
	
 // get all request from client 

 $this->url= UR();
  
// then set on her  
 $this->start_page = 0;
 $this->per_page   = 5;
 
  
// customize page data
 if( $this->url->find_value('frmrek_from_recordpage') ){
  $this->per_page = $this->url->field('frmrek_from_recordpage');
 }	 	  

// get posted data object  
if( $this->result_posted) {
	$this->start_page = (($this->result_posted-1)*$this->per_page);
 } else {	
	$this->start_page = 0;
 }
 
 
// "singgleton " 
 $this->Data =& Singgleton($this);
 
// then result data  

 $this->result_count  = 0 ;
 $this->result_array  = array();
 $this->result_posted = $this->url->field('page','intval');
 $this->result_array  = $this->Data->_select_pager_rekontest($this->url, null, $this);
 $this->result_count  = $this->Data->_select_count_rekontest($this->url);
 

 
// "result_count"
 $this->result_pager = 0;
 if( $this->result_count ){	 
	$this->result_pager = ceil($this->result_count/ $this->per_page);
 }
  
 // @ pack : then set it to view 
 // set data view client porcess  
  $this->load->view("mod_user_rekontest2/view_rekontest2_row_page", array(
	'content_pages' => $this->result_array,
	'total_records' => $this->result_count,
	'total_pages'   => $this->result_pager,
	'select_pages'  => $this->result_posted,
	'start_page' 	=> $this->start_page ));

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
 $con = array( 'success' => 0 , 'row' => null );
 $out = &UR();
 
 
// get load model 
 $this->load->model( array('M_UserRekontest2') );
 $Rekontest2 = &Singgleton('M_UserRekontest2');
 
// then will get out. 
 if( !$out->field('torek_useraction') ){
	echo_json_encode( 0 ); 
	return FALSE;	
 }
  
// on act quantity  
 $this->conDataResponse = 0;
 if( $out->field( 'torek_useraction' )){
	$Rekontest2->_set_row_rekontest2_perrata( $out );
	$totalDataProcess = $Rekontest2->_get_call_back_message();
	if( $totalDataProcess ){
		$this->conDataResponse = $totalDataProcess;
	}
 }
  
// then if true process . 
 if( $this->conDataResponse ) {
	echo json_encode(array( 'success' => 1,  'row' => $this->conDataResponse )); 
	return FALSE;	
 }
 
 // return callback data process server data.
 @call_user_func('echo_json_encode', 0);
 return false;
 
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
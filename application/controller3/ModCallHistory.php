<?php 
/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
class ModCallHistory extends EUI_Controller
{

/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 
 function __construct()
{ 
	parent::__construct();
	$this->load->model(array('M_ModCallHistory'));
	$this->load->helpers(array('EUI_Object'));
}

/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
function index(){ }	

/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 
 public function PageCallHistory()
{
  $this->start_page = 0;
  $this->per_page   = 10;
  $this->post_page  = (int)_get_post('page');
  
 // data java  
  $std=& Singgleton($this);
  
 // result array 
  $this->arr_result  = array();
  $this->arr_content = $std->_select_page_call_history( UR() );
  $this->tot_result  = count($this->arr_content);
  
 // then post page 
  
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
 
 $arr_call_history = array
(
	'content_pages' => $this->arr_result,
	'total_records' 	=> $this->tot_result,
	'total_pages'   => $this->page_counter,
	'select_pages'  => $this->post_page,
	'start_page' 	=> $this->start_page
 );
 
  $this->load->view("mod_call_history/view_call_history_page", $arr_call_history);	
}


/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 
 public function PageCallQualityHistory( )
{
  $this->start_page = 0;
  $this->per_page   = 5;
  $this->post_page  = (int)_get_post('page');
  
  $obj_class =& get_class_instance(base_class_model($this));
  $this->arr_result = array();
  $this->arr_content = $obj_class->_select_page_quality_call_history( new EUI_Object( _get_all_request() ));
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
 
 $arr_call_history = array
(
	'content_pages' => $this->arr_result,
	'total_records' 	=> $this->tot_result,
	'total_pages'   => $this->page_counter,
	'select_pages'  => $this->post_page,
	'start_page' 	=> $this->start_page
 );
 
  $this->load->view("mod_call_history/view_quality_history_page", $arr_call_history);	
}


/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */

 public function PageCallMonQualityHistory( )
{
  $this->start_page = 0;
  $this->per_page   = 5;
  $this->post_page  = (int)_get_post('page');
  
  $obj_class =& get_class_instance(base_class_model($this));
  $this->arr_result = array();
  $this->arr_content = $obj_class->_select_page_quality_callmon_history( new EUI_Object( _get_all_request() ));
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
 
 $arr_call_history = array
(
  'content_pages' => $this->arr_result,
  'total_records'   => $this->tot_result,
  'total_pages'   => $this->page_counter,
  'select_pages'  => $this->post_page,
  'start_page'  => $this->start_page
 );
 
  $this->load->view("mod_call_history/view_quality_monitoring_history_page", $arr_call_history); 
}

/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 function PageCallRecording( )
{
	
// define all object 
   $this->urlData	 = UR();
   
// define data untuk pager 
   $this->start_page = 0;
   $this->per_page   = 5;
   $this->post_page  = $this->urlData->field('page');
   $this->stdClas 	 = Singgleton($this);
  
  // call my object properties 
  // data on result process 
  
   $this->arr_result  = array();
   $this->arr_content = $this->stdClas->_select_page_recording( $this->urlData );
   $this->tot_result  = count($this->arr_content);
   
  // start number of record .
  
  if( $this->post_page) {
	 $this->start_page = (($this->post_page-1)*$this->per_page);
  } else {	
	 $this->start_page = 0;
  }

 // set result on array
  if( (is_array($this->arr_result))  and ( $this->tot_result > 0 ) ) {
	$this->arr_result = array_slice($this->arr_content, $this->start_page, $this->per_page);
  }	
	
 // $this->page_counter 	
 $this->page_counter = ceil($this->tot_result/ $this->per_page);
 
 // then set it to view 
 $this->load->view("mod_call_history/view_recording_history_page", array ( 'content_pages' => $this->arr_result,
																			'total_records' => $this->tot_result,
																			'total_pages'   => $this->page_counter,
																			'select_pages'  => $this->post_page,
																			'start_page' 	=> $this->start_page ));	
}


/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 public function PageAddress( )
{
  $this->start_page = 0;
  $this->per_page   = 5;
  $this->post_page  = (int)_get_post('page');
  
  $obj_class =& get_class_instance(base_class_model($this));
  $this->arr_result = array();
  $this->arr_content = $obj_class->_select_page_address( new EUI_Object( _get_all_request() ));
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
 
 $arr_page_address = array
(
	'content_pages' => $this->arr_result,
	'total_records' => $this->tot_result,
	'total_pages'   => $this->page_counter,
	'select_pages'  => $this->post_page,
	'start_page' 	=> $this->start_page
 );
 
 $this->load->view("mod_call_history/view_address_page", $arr_page_address);
 
}

// --------------------------------------------------------------
}

?>

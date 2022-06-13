<?php
/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	 
class CampaignPerUser extends EUI_Controller {
	
/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */		
function __construct(){
	parent::__construct();
	display(0);
	$this->load->model(array(base_class_model($this)));
	$this->load->helper(array('EUI_Object'));
}	

/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
function index(){
	
// eg : model data on this 
 $this->callBackConn = Singgleton($this);
 if( !is_object( $this->callBackConn ) ){
	exit(0);
 }
// sent view data process on this OK 
 $this->load ->view('mod_campaign_peruser/per_user_nav',array(
	'page' => $this->callBackConn->_select_peruser_count_page()
 ));
}
 
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
function Content() {
 if(!CK()->field('UserId') ) {
	return false;
 }

 // get on model data proces  
 $this->UserKuota = Singgleton($this);
 $this->UserRole = Singgleton('M_UserRole');
 
 // sent view data page process && then will result_array.
 $this->load->view('mod_campaign_peruser/per_user_list',array(
	'role' =>  $this->UserRole->_select_role_table_action(get_class($this)),
	'button' => $this->UserKuota->_select_per_user_role($this),
	'page' => $this->UserKuota->_select_peruser_source_page($this),
	'num' => $this->UserKuota->_select_peruser_number_page($this)
 ));
	
 }
 
/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
function GroupPerUser(){
	
// Request Header Post Data 
 $this->dataURI = UR();
	
// default data empty process 	
 $this->result_array = array();
 if( !$this->dataURI->field('GroupPerUser')) {
	$this->result_array = array();
 }
 
// get all user under level  

 $this->result_array = AllUserIdByLevelLogin( $this->dataURI->field('GroupPerUser') );
// then will get source data from here .
 printf("%s", form()->combo('CPU_UserId', 'select superlong', $this->result_array ));
 return false;
	
} 

/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
 
 function Submit()
{
	
// tangkap semua header Data 
 $this->dataURI = UR();

// callback msg 
 $this->dataMSG = array('success' => 0);
 if(  !$this->dataURI->field('CPU_CampaignId') ){
	printf('%s', json_encode( $this->dataMSG ));
	return false;
 }
// return of process 



 $this->dataRow = Singgleton($this)->_submit_per_user( $this->dataURI );
 if( $this->dataRow ){
	$this->dataMSG = array('success' => 1);
 }
 
 printf('%s', json_encode( $this->dataMSG ));
 return false;
	
	
}

/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
 
 function Silent()
{
	
// will set Global 
 Global $argc, $argv;
 
// this callback 
 $this->dataMSG = array('success' => 0, 'total' => 0 );	

// this from URI 
 $this->dataURI = UR();
 $this->dataOBJ = Singgleton($this);
	
 // result data content update buket user kuota 
 // ketika check kuota maka akan dipush script untuk check.
 
 $this->dataUser = $this->dataURI->fields('dataUser');
 if( is_array($this->dataUser) and !count($this->dataUser) ){
	$this->dataUser = null; 
 }
 // akan di check dengan crontab atau by URI 
  $this->result_kuotasize = $this->dataOBJ->_select_bucket_update_kuota( $this->dataUser );
  if( $this->result_kuotasize ){
	$this->dataMSG = array('success' => 1, 'total' => $this->result_kuotasize);
  }
  
  // return callback to client request .
  printf("%s", json_encode($this->dataMSG)); 
  return false;
}

/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
 
 function Update()
{
	
// tangkap semua header Data 
 $this->dataURI = UR();

// callback msg 
 $this->dataMSG = array('success' => 0);
 if(  !$this->dataURI->field('CPU_Id') ){
	printf('%s', json_encode( $this->dataMSG ));
	return false;
 }
// return of process 

 $this->dataRow = Singgleton($this)->_update_per_user( $this->dataURI );
 if( $this->dataRow ){
	$this->dataMSG = array('success' => 1);
 }
 
 printf('%s', json_encode( $this->dataMSG ));
 return false;
	
	
}

/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
 
function Pager(){
 
 // define data proces 
 
 $this->out = UR();
 $this->cok = CK();
 
// sent view data on user request  
 if( !is_object( $this->out ) 
  OR !$this->cok->field('UserId') ){
	exit(0);
 }
 // then process agian 
  $this->rowBucketData = Singgleton($this); 
  $this->load->view("mod_campaign_peruser/per_user_data", array());
}
/**
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
function Disable(){
 $this->dataURL = UR();
 $this->dataMSG = array('success' => 0 );
 
 // add data sent get view GET URL 
 if( !$this->dataURL->field('PerUserId') ){
	printf('%s', json_encode( $this->dataMSG ));
	return false;
  }

 // then sent process to model data  
 $this->rowData = Singgleton($this)->_disable_per_user( $this->dataURL );
 if( $this->rowData ){
	$this->dataMSG = array('success' => 1); 
 }

// return query data client Browser Process 
// test data .
 
 printf('%s', json_encode($this->dataMSG));
 return false;
 
} 
/**
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
function Enable(){
 $this->dataURL = UR();
 $this->dataMSG = array('success' => 0 );
 
 // add data sent get view GET URL 
 if( !$this->dataURL->field('PerUserId') ){
	printf('%s', json_encode( $this->dataMSG ));
	return false;
  }

 // then sent process to model data  
 $this->rowData = Singgleton($this)->_enable_per_user( $this->dataURL );
 if( $this->rowData ){
	$this->dataMSG = array('success' => 1); 
 }

// return query data client Browser Process 
// test data .
 
 printf('%s', json_encode($this->dataMSG));
 return false;
 
} 
/**
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
function Delete(){
 $this->dataURL = UR();
 $this->dataMSG = array('success' => 0 );
 
 // add data sent get view GET URL 
 if( !$this->dataURL->field('PerUserId') ){
	printf('%s', json_encode( $this->dataMSG ));
	return false;
  }

 // then sent process to model data  
 $this->rowData = Singgleton($this)->_delete_per_user( $this->dataURL );
 if( $this->rowData ){
	$this->dataMSG = array('success' => 1); 
 }

// return query data client Browser Process 
// test data .
 
 printf('%s', json_encode($this->dataMSG));
 return false;
 
} 

/**
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
 function Edit()
{
 $this->dataURI = UR();	
  
 $this->UserKuota = Singgleton($this);	
 
 // sent view process then will get here .
 $this->load->view("mod_campaign_peruser/per_user_panel",  array(
	'panel'  => Objective( array('form' => 'per_user_edit', 'title' =>'Campaign Per User', 'icon' => 'fa-pencil') ),
	'button' => $this->UserKuota->_select_per_user_role($this),
	'PerUser' => $this->UserKuota->_select_per_user_detail( $this->dataURI  )
  ));	
} 
 
 
/**
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
 function Add()
{
	
 $this->UserKuota = Singgleton($this);	
 
 // sent view process then will get here .
 $this->load->view("mod_campaign_peruser/per_user_panel",  array(
	'panel' => Objective( array('form' => 'per_user_add', 'title' =>'Campaign Per User', 'icon' => 'fa-plus') ),
	'button' => $this->UserKuota->_select_per_user_role($this)
  ));	
} 
 
 

/**
 *
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	

function Data(){


// define data proces from url 
 $this->dataURL = UR();
  
 // define properties object pager 
 
  $this->result_start = 0;
  $this->result_pager   = 10;
  
// jika record customize by user .
  if( $this->dataURL->find_value('frm_bucket_record') ){
	$this->result_pager = $this->dataURL->field('frm_bucket_record');
  }	 	  
  
 // get post data of pager 
  $this->result_array = array();
  $this->result_page  = $this->dataURL->field('page');
  
 // then result data "Singgleton"
  $this->dataCls =Singgleton($this);
  
 
  // result kontent pager data 
  $this->result_content = $this->dataCls->_select_bucket_user_kuota( $this->dataURL );
  $this->result_total = count( $this->result_content );
  
  
 // then will get of here proces OK 
  if( $this->result_page ) {
	$this->result_start = (($this->result_page-1)*$this->result_pager);
  } else {	
	$this->result_start = 0;
  }

 // set result on array
  if( is_array( $this->result_array ) and $this->result_total > 0 ) {
	$this->result_array= array_slice( $this->result_content, $this->result_start, $this->result_pager);
  }
  
  // result pager counter 
  $this->result_counter = ceil( $this->result_total / $this->result_pager);
  
 // result assoc data 
 $this->result_bucket = array(
	'content_pages' => $this->result_array,
	'total_records' => $this->result_total,
	'total_pages'   => $this->result_counter,
	'select_pages'  => $this->result_page,
	'start_page' 	=> $this->result_start );
 
 // sent view data to view .
	$this->load->view("mod_campaign_peruser/user_kuota_page",  $this->result_bucket);
 
}

/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
 
 public function Role()
{
	
// public process metjode data 	
 $out= UR();
 $rol = Singgleton('M_UserRole');	
// define callback OK 	
 $result_array = array();
 if( $out->find_value('modul') )  {
	$result_array = $rol->_select_role_menu_toolbar( $out->field('modul'));
 }
  printf("%s", json_encode( $result_array ));
  
 }
/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
 
}

?>
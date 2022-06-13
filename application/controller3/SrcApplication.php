<?php

// --------------------------------------------------------------------------------

/*
 * @ package 			EventStore	
 *
 * @ author 			uknown 
 * @ publish 			protected  
 */
 
 class SrcApplication extends EUI_Controller 
{

/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */ 
 
  function __construct()   { 
	parent::__construct();
	$this->load->model(array(base_class_model($this)));
	$this->load->helper(array('EUI_Object'));
  }
 
/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */ 
  
 function index() { 
	if( !_get_is_login()) { 
		return false; 
	}
	
	// sent to view data object 
	$this->load ->view('src_mod_apps/view_application_nav',array( 
		'page'=> Singgleton($this)->_select_default_page() 
	));
	
 }
 
/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */ 
 function content()
{
	
// jika tidak login .
	
	if( !_get_is_login() ) { 
		return false; 
	}
	 
	$roleobj = $this->M_UserRole->_select_role_form_action(get_class($this));
	
	// sent to view user client data object 
	$this->load->view('src_mod_apps/view_application_list',array(
		'button' => new EUI_Object( $roleobj ),
		'page' 	 => Singgleton($this)->_select_page_source(),
		'num'  	 => Singgleton($this)->_select_page_number()
	));
	
}

/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */ 
  
function Approval(){
	
// get data browser URL && Cookies
 $this->url = UR();
 $this->cok = CK();
 
 // jika ID tidak ada 
 if( !$this->url->find_value('CustomerId') ){
	exit(0);
 }
 
 // jika tidak ada cokie 
 if( !$this->cok->find_value('UserId') ){
	exit(0); 
 }
 // on debug data process .

 $ButtonSysRole = Singgleton('M_UserRole')->_select_role_form_action($this);
 
 
 // debug($ButtonSysRole); --> function debug guna check data validation
 // hanya untuk development 
 
 $this->load->view("src_mod_apps/view_application_body", array(
  'Button' => Objective( $ButtonSysRole ),
  'CustomerId' => $this->url->field('CustomerId')
 ));
 
}

/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */ 
function EventRetry()
{
 $cond = array('success' => 0);
 
 if( !_get_is_login()) { 
	return false; 
 }
 
 $cond  = get_class_instance(base_class_model($this))->_set_event_row_retry( _find_all_object_request() );
 if( $cond ){
	$cond = array('success' => 1);
  }
  
  echo json_encode($cond);
  
}
/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */ 
 
 public function Role()
{
	$out= _find_all_object_request();
	$arr_role_toolbars = array();
	if( $out->find_value('modul') )  {
		$arr_role_toolbars = $this->M_UserRole->_select_role_menu_toolbar( $out->get_value('modul'));
	}
    echo json_encode( $arr_role_toolbars );
 }
 
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */ 
  
 // =============================== END CLASS ==========================================
 
} 
?>
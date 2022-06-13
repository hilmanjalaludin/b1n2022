<?php
 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
class QualityFollowup extends EUI_Controller
{
 
 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 function __construct() {
	parent::__construct();
	//display();
	
	$this->load->model(array(base_class_model($this)));
	$this->load->helper(array('EUI_Object'));
	 
 }
 
 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
 function index() {
	if( !_get_is_login() ){  
		return FALSE; 
	}
	
 // look view data on view .
	$this->aksesor = Singgleton('M_QualityFollowup');
	$this->load ->view('src_quality_followup/view_quality_nav',array ( 
	'page'=> $this->aksesor->_get_default() ));
	
 }
  /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 
 function Content()  {
	
 if( !_get_is_login() ) {  
	return FALSE; 
 }

// create aksesor process data OK 
 
    $this->aksesor = Singgleton($this);
 
// show data on process like this;	
	$this->load->view('src_quality_followup/view_quality_list',array(
		'page' 	 => $this->aksesor->_get_resource(),
		'num'  	 => $this->aksesor->_get_page_number(), 
		'button' => $this->aksesor->_get_form_action() 
	));
	
 }
 
 
 
 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
 function Followup(){	 
 
	$this->callBackStd = Singgleton($this);
	$this->callBackMsg = array('success' => 0 , 'UserId' => 0 );
		
	// on result  ok on row process with interface data 
	 if( $this->callBackStd->_set_quality_followup_master(UR()) )
	{
		// ambill callback response data dari singgle class 
		$row = $this->callBackStd->_get_quality_followup_callback();
		if( $row->find_value( 'UserId' )  ){
			$this->callBackMsg = array(  'success' => 1,  
										 'UserId'  => $row->field('UserId') );	
		}
    } else {	
	
		// jika process gagal pada set followup QA 
		$row = $this->callBackStd->_get_quality_followup_callback();
		
		if( $row->find_value( 'UserId' )  ){
		$this->callBackMsg = array( 'success' => 0,  
									'UserId'  => $row->field('UserId') );	
		}
	}
	
	printf('%s', json_encode( $this->callBackMsg ));
	return false;
   
 }
 
  
 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 
 public function Role()
{
	$out= UR();
	$arr_role_toolbars = array();
	if( $out->find_value('modul') )  {
		$arr_role_toolbars = $this->M_UserRole->_select_role_menu_toolbar( $out->get_value('modul'));
	}
    echo json_encode( $arr_role_toolbars );
 }
	
// ============================== END CLASS ==============================
 
}
?>
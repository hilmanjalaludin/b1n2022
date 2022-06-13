<?php 
error_reporting(E_ALL);
ini_set("display_errors", 1);
class UserPopup extends EUI_Controller{
	
  
/**
 * [Recovery data failed upload BNI TELE]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
function __construct(){
	parent::__construct();
	$this->load->model(array( base_class_model($this)));
}	
/**
 * [Recovery data failed upload BNI TELE]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
 
function index(){ }
 
/**
 * [Recovery data failed upload BNI TELE]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
 
function Result(){


// get attribute data process on here 	
	$dataURL =&Singgleton('M_SetCallResult');
	$dataURI =&UR();
	
// kemudian akan di store di view dengan methode checklist 
// saja OK 

	$dataMSG = $dataURL->_select_call_result_perkategory( $dataURI->field( 'origin' ) );
	
	
	$this->load->view( 'mod_view_userpopup/view_popup_result', array( 'row' => $dataMSG, 
																	 'uri' => $dataURI ));
		
}
	
/**
 * [Recovery data failed upload BNI TELE]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
  
 
} 

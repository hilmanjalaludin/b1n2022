<?php 
class UserPullData extends EUI_Controller
{
	
 var $gDistributeRata = 1;
 var $gDistributeAgent = 2;

 
 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
 function __construct()
{
	parent::__construct();
	$this->load->model(array(base_class_model($this)));
	$this->load->helper(array('EUI_Object'));
}

 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
 public function index()
{ 
  $out = UR();
  
  $this->callBackMsg = array('success' => 0)	;
  if( !_have_get_session('UserId') ) {
	echo json_encode( $this->callBackMsg);
	return false;
  }
  
 //--------------- checj parameter ------------------------ 
 
 if( !$out->fetch_ready()) 
 {
	echo json_encode( $this->callBackMsg );
	return false;	
  }	

// debuging data process 
  $output =& Singgleton($this); 
  if( $out->get_value('pull_user_type') == 1 ) {
	  $this->callBackMsg = array( 'success' => $output->_set_row_pulldata_rata( $out ) );
  }
 
 
 // jika bagi Tertentu.
 
  if( $out->get_value('pull_user_type') == 2 ) {
	$this->callBackMsg = array( 'success' => $output->_set_row_pulldata_agent( $out ) );
  }  
  
  // return user 
   printf("%s", json_encode( $this->callBackMsg));
   return false;
}


// =========== END CLASS ===============================================================

}
?>
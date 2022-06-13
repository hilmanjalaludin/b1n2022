<?php 
 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
class UserDistribusi extends EUI_Controller
{
 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */	
 var $gDistributeRata = 1;
 var $gDistributeAgent = 2;

 
 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 function __construct() {
	parent::__construct();
	
	display();
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
  
  
  // call create callback 
  $this->callBackMsg = array('success' => 0)	;
  
  // cek session data login 
  if(!CK()->field('UserId') ) {
	echo json_encode( $this->callBackMsg );
	return false;
  }
 
// cek by check on here  
 if( !$out->fetch_ready())  {
	echo json_encode( $this->callBackMsg );
	return false;	
 }	

// Singgleton
  $callDataID =& Singgleton($this); 
  
 // on other type data OK 
  $resultDataProcess = null;
 
  if( $out->field('dis_user_type') == 1 ) {
	$callDataID->_set_row_distribusi_rata( $out );  
  }
  
 // type here like this 
  if( $out->field('dis_user_type') == 2 ) {
	$callDataID->_set_row_distribusi_agent( $out ); 
  }
  
  // type data process OK 
  
  $resultDataProcess = $callDataID->_get_message_process();
  if( is_array($resultDataProcess) && count($resultDataProcess) ) {
	$this->callBackMsg = array('success' => 1, 'report' => $resultDataProcess);  
  }
  
  // belajar komitment test 
  printf("%s", json_encode( $this->callBackMsg));
}


// =========== END CLASS ===============================================================

}
?>
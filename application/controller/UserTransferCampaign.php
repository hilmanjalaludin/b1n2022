<?php 
 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
class UserTransferCampaign extends EUI_Controller
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
 
  // type data process OK 
  $resultDataProcess = $callDataID->update_campaign($out);
	$this->callBackMsg = array('success' => 1, 'report' => $resultDataProcess);
  printf("%s", json_encode( $this->callBackMsg));
}


// =========== END CLASS ===============================================================

}
?>
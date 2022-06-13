<?php 
 // ------------------------------------------------------------------------

/**
 * CodeIgniter Download Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/helpers/download_helper.html
 */

 
class AuthValidation Extends EUI_Controller{
	
 var $ProductId = null;
 var $ProductName = null;
 var $CustomerId = null; 	
 var $CustomerNum  = null;
 var $ProductValid  = array();
	
	

 /**
  * [Recovery data failed upload BNI TELE]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  	
 function __construct(){ 
	
	parent::__construct();
	display(1);
	$this->load->model( array('M_AuthValidation'));
	
	
	$this->ProductId = UR()->field('ProductId');
	$this->ProductName = UR()->field('ProductName');
	$this->CustomerId = UR()->field('CustomerId');
	$this->CustomerNum  = UR()->field('CustomerNum');
	
	// load my model like this;
	$this->ProductValid = array( 'NTB'   => array( 'table' => 't_gn_frm_transaction_ntb', 	'where' => 'TR_CustomerNumber'),
								 'ADD'   => array( 'table' => 't_gn_frm_transaction_addon', 	'where' => 'TR_CustomerNumber'),
								 'XSELL' => array( 'table' => 't_gn_frm_transaction_xsell', 	'where' => 'TR_CustomerNumber'),
								 'USAGE' => array( 'table' => 't_gn_frm_usage', 				'where' => 'TX_Usg_Custno') );
		
		
 }	
 

 /**
  * [Recovery data failed upload BNI TELE]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
function selling(){
	 
// default data 
  $URI =& UR(); 
  $STD =& Singgleton($this);

 // default callback data Process OK  
 
 $MSG = array('success' => 0 ); 
 if( !$URI->find_value('CustomerNum')  ){
	printf('%s', json_encode( $MSG) );
	return false;
 }
 
// ambil data referensinya dari array object Process OK 
// akan purge.

 $resultValidation = ( isset( $this->ProductValid[$this->ProductName]) 
							? $this->ProductValid[$this->ProductName] : null );
   							
							
// konvert data to object process OK 							
 $resultValidation = Objective( $resultValidation );
 // $checkvalidation = $STD->_select_validation_selling( $resultValidation, $URI );
 $checkvalidation = $resultValidation;
 if( $checkvalidation ){
	$MSG = array('success' => 1 );  
 }
 
 // return data callback Mesage to CLient 
 printf('%s', json_encode( $MSG) );
 return false;
 
 } 
 /**
  * [Recovery data failed upload BNI TELE]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */ 
 
}

?>
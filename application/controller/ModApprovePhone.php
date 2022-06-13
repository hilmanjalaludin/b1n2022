<?php
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
 
class ModApprovePhone extends EUI_Controller 
{

 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
 function __construct() {
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
  
function index() {
	
	
// data OK 	
 $this->Instance = Singgleton($this);
 if( !CK()->field('UserId') ) {
	exit(0);
 }
 
 // sent to view Data Process 
 $this->load->view( 'mod_approval_phone/view_approve_phone_nav',array(
	'page' =>  $this->Instance->_get_default()
 ));
}

 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
 function Content()
{
  if( !CK()->field('UserId') ) {
	return false;
 }
 // load my data model on this process data 
 
 $this->row = Singgleton($this);
 $this->load->view('mod_approval_phone/view_approve_phone_list',array(
	'button' => $this->row->_select_row_form_action($this), 
	'page' 	 => $this->row->_get_resource(),
	'num'  	 => $this->row->_get_page_number()
 ));
 
 
}
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
 function Approval()
{
 $this->callBackMsg = array('success'=>0);	
 
// then check data Process 
 $obj= Singgleton($this);
 $out= UR();
 //debug($out);
 
 // then check data Process 
 if( !$out->find_value('ApproveItemId')){
	printf('%s', json_encode( $this->callBackMsg ));
	return false;
 }
 
 
 // then will save data update and convert 
 $this->item = $obj->_update_row_item_approval( $out );
 //var_dump($this->item);
 if( $this->item ){
	$this->callBackMsg = array('success'=>1 );	 
 }
  // then will save data update and convert 
 printf('%s', json_encode( $this->callBackMsg ));
 return false;
 
}
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
function ContactDetail() {

// get data process untuk Data 
 $this->cok = CK();	
 $this->out = UR();

 // data testing OK 
 if( !$this->cok->field('UserId') ){
	return FALSE;
 }
 
// call all object yang di butuhkan untuk process detail 
 $this->rol = Singgleton('M_UserRole');
 $this->cst = Singgleton('M_SrcCustomerList');
 $this->std = Singgleton($this);
 
// next proces on ready ok sip  next process 
 $this->ApproveId = $this->out->get_value('ApproveId');
 $this->MasterId = $this->std->_select_row_customer_data($this->ApproveId);
 if( !$this->MasterId ){
	exit('Data tidak ada!');
 }
 
 // overite object data customer 
 $this->result_detail = $this->std->_select_row_approval_item($this->ApproveId);
 $this->result_master = $this->cst->_select_row_master_detail($this->MasterId);
 $this->result_button = $this->std->_select_row_form_action( $this );
 
// next sent to view data OK SIP Ya .
 $this->result_master = Objective( $this->result_master);
 $this->result_detail = Objective( $this->result_detail);
 $this->result_header = $this->out;
 
 $this->load->view('mod_approval_phone/view_approve_main_phone',array(
	'Detail' => $this->result_master,
	'Items'  => $this->result_detail,
	'Button' => $this->result_button,
	'Header' => $this->result_header
	
	// 'Customers' 		=> $cst->_getDetailCustomer( $CustomerId ),
	// 'Phones' 			=> $cst->_getPhoneCustomer( $CustomerId ),
	// 'AddPhone' 			=> $cst->_getApprovalPhoneItems( $CustomerId ),
	// 'ItemApprove'		=> $obj->_getAllApprovalItems(),
	// 'Button'			=> Objective( $buttonrole )
 ));
 
}
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
 function AddContact()
{

// ambil ref process data OK 
 $this->dataURI = UR();
 $this->dataCOK = CK();
 // ambil semua data ref 	
 if( !_get_is_login() ){  
	exit(0);
 }
 
 //check validasi datanya 
 if( !$this->dataURI->field('CustomerId') ){
	 exit();
 }
 
 // ambil data class ini .
 //$this->dataList = $this->M_PhoneType->_getPhoneTypeList();
 $this->dataRole = SystemRoleFrm($this->dataURI->field('ControllerId'), 'Objective');
 
 // debug($this->dataList);
 // debug($this->dataRole);
 
// krim ke view data untuk membuat form 
// via window open .

 $this->load->view('mod_approval_phone/view_approve_phone_add',array (
	'row' => $this->dataURI,
	'btn' => $this->dataRole
 ));
 
}



 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
function PhoneNumber()
{
	$_conds = array('phoneNumber' => '' );
	$fieldname = $this -> URI-> _get_post('FieldName');
	$this -> db -> select($fieldname); 
	$this -> db -> from('t_gn_customer');
	$this -> db -> where('CustomerId',$this -> URI-> _get_post('CustomerId'));
	
	if( $rows =  $this -> db -> get() -> result_first_assoc() ){
		$_conds = array('phoneNumber' => $rows[$fieldname]);
	}

	echo json_encode($_conds);
}


 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
 
 function RefreshPhoneNumber() {
  // this will refresh datav on process OK 
  $this->load->view('mod_approval_phone/view_approve_refresh_number',array (
	'out' => UR() 
  ));
 
}


 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
 function Submit() 
{
  $std = Singgleton($this);
  
 // ambil library di common helper  
  $out = UR();
  $cok = CK();
  
  // cek session apakah masih login atau sudah logout
  
   if( ! $cok->find_value('UserId') ){
	return FALSE;
	}
 
 
 // proces di model ini.
  $this->callBackMsg  = array('success' => 0 );
  if( $std->_submit_row_item_contact($out) ){
	  $this->callBackMsg = array( 'success' => 1);		
  }
  // return client to response 
  printf("%s", json_encode( $this->callBackMsg ) );
  
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
 
 // ============================ END CLASS ============================

}

?>
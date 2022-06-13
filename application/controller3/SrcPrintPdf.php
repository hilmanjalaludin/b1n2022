<?php
/*
 * E.U.I 
 *
 php -q /opt/enigma/webapps/hsbc_cc_tele/index.php SrcCustomerClosing PDF
 
 * subject	: get model data for SysUser 
 * 			  extends under Controller class
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/controller/sysuser/
 */
 
class SrcPrintPdf extends EUI_Controller
{
 
/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 function __construct()
{
	parent::__construct();
	$this->load->model(array(base_class_model($this)));
	$this->load->helper(array('EUI_Object','EUI_Bimage'));
	
 }
 
 
/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 function index()
{
	if( !_get_is_login() ){  
		return FALSE; 
	}
	
	$this->load ->view('src_print_pdf/view_print_pdf_nav',array ( 
		'page'=> get_class_instance(base_class_model($this))->_get_default() 
	));
 }
 
/*
 * @ def 		: content / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function Content()
 {
	if( !_get_is_login() )
	{  
		return FALSE; 
	}
	
	$object =& get_class_instance(base_class_model($this));
	$roleobj = $this->M_UserRole->_select_role_form_action(get_class($this));
	$this->load->view('src_print_pdf/view_print_pdf_list',array(
		'button' => new EUI_Object( $roleobj ),
		'page' => $object->_get_resource(),
		'num'  => $object->_get_page_number()
	));
		
	
 }
 
/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */

 
 public function SuspendType()
{
  $var =new EUI_Object( _get_all_request() );	
  $out =& get_class_instance('M_SrcCustomerList');
  $output = $out->_getDetailCustomer( $var->get_value('CustomerId'));
  
} 



// ------------------------------------------------------------------------------------------
/*
 * @ def 		: index / default pages controller 
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 
function EventWritePod()
{ 

 $error = array('success' => 0 );
 
 if( !_have_get_session('UserId') ) { 
	echo json_encode( $error ); 
	return false;
 }
 
// --- save pod on here  --------------------------------------
 
 $outs = _find_all_object_request();
 $objs = get_class_instance( base_class_model($this) );
 
  if(  $SourceId = $objs->_set_row_save_user_print_pdf( $outs ) ) 
 {
	$error = array('success' => 1);
 } 
 
 
 echo json_encode( $error );
 return FALSE;
}



// ------------------------------------------------------------------------------------------
/*
 * @ def 		: index / default pages controller 
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function ActionWritePod() 
{
	if( _get_is_login() ){
		$this->load->form("pod_form/frm_add_pod");
	}
}

// ------------------------------------------------------------------------------------------
/*
 * @ def 		: index / default pages controller 
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function ActionPrintPod(){
	if( _get_is_login() ){
		$this->load->form("pod_form/frm_print_pod");
	}
}

// ------------------------------------------------------------------------------------------
/*
 * @ def 		: index / default pages controller 
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function EventPrintPod(){ }

 
// ------------------------------------------------------------------------------------------
/*
 * @ def 		: index / default pages controller 
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 function Barcode() 
 {
	 if( $this->URI->segment(3) ){
		InializeBarcode($this->URI->segment(3));
	 } else {
		 return null;
	 }
}

// ------------------------------------------------------------------------------------------
/*
 * @ def 		: index / default pages controller 
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 function PrintPdf()
 {
	$success = array('success' => 0, 'url' => '' );
	
	$out =_find_all_object_request();
	if( !$out->find_value('CustomerId') ){
		exit('file not found');
	}
	
	$sql = sprintf("select* from t_gn_pdf_application a where a.PDF_CustomerId='%s'", $out->get_value('CustomerId'));
	$res = $this->db->query( $sql );
	if( $res->num_rows() > 0 
		AND $row = $res->result_first_assoc() ) 
	{
		//print_r($row);
		
		if( file_exists( $row['PDF_Path_Location'] ))
		{
			$arr_app = explode("mail", $row['PDF_Path_Location']);
			
			$cond = join("", array("http://192.168.9.11", $arr_app[1]) );
			$success = array(
				'success' => 1, 'url' => $cond 
			);
		}
	}
	echo json_encode($success);
	
 }
  
// ---------------------------------------------------------------------------------------------------------

/* 
 * Method 		Role 
 *
 * @pack 		metjode 
 * @param		testing all 
 * @notes		must be exist if have button attribute role
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
 
// ============================== END CLASS ==============================
 
}
?>
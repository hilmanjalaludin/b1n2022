<?php
/*
 * E.U.I 
 *
 
 * subject	: get model data for SysUser 
 * 			  extends under Controller class
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/controller/sysuser/
 */
 
class CtiExtension extends EUI_Controller
{


 
/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 function CtiExtension()
 {
	parent::__construct();
	$this->load->model(array(base_class_model($this)));
	$this->load->helper(array('EUI_Object','EUI_Socket'));
	
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
	if( $this ->EUI_Session -> _have_get_session('UserId') )
	{
		$_EUI['page'] = $this -> {base_class_model($this)} -> _get_default();
		if( is_array($_EUI) ) 
		{
			$this -> load -> view('cti_extension/view_cti_extension_nav',$_EUI);
		}	
	}	
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
	 
	if(!_have_get_session('UserId') )
  {
	  return false;
  }
		
	$object =& get_class_instance(base_class_model($this));
	$roleobj = $this->M_UserRole->_select_role_form_action(get_class($this));
	$this->load->view('cti_extension/view_cti_extension_list',array(
		'role' => $this->M_UserRole->_select_role_table_action(get_class($this)),
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

 public function Download()
 {
	if( $this -> URI -> _get_have_post('mode'))
	{
		$mode = base64_decode( $this -> URI -> _get_post('mode') );
		
		switch( $mode )
		{
			case 'extension_tpl' : self::download_extension_tpl(); break;
			case 'extension_xls' : self::download_extension_xls(); break;
			case 'extension_cnf' : self::download_extension_cnf(); break;
		}
	}
 }
 
/*
 * @ def 		: download_extension_cnf 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function Upload()
{
	$data  = null;
	if( !copy($_FILES['fileToupload']['tmp_name'], APPPATH .'/temp/'.$_FILES['fileToupload']['name'] ) ) {
		$_conds = array("success"=>0, "error" => "Failed copy file " . $_FILES['fileToupload']['name'] );
	}
	else
	{
		ExcelImport() -> _ReadData(APPPATH .'temp/'.$_FILES['fileToupload']['name']);
		$pos = 2; $num=0;
		while( $pos <= ExcelImport() -> rowcount(0) )
		{
			$data[$num]['pbx'] 			= ExcelImport() -> val($pos,1); 
			$data[$num]['ext_number'] 	= ExcelImport() -> val($pos,2); 
			$data[$num]['ext_desc'] 	= ExcelImport() -> val($pos,3);
			$data[$num]['ext_type'] 	= ExcelImport() -> val($pos,4);
			$data[$num]['ext_status'] 	= ExcelImport() -> val($pos,5);
			$data[$num]['ext_location'] = ExcelImport() -> val($pos,6);
			$pos++; $num++;
		}
		
		if( !is_null( $data) )
		{
			if( $this -> {base_class_model($this)} -> _cti_extension_upload( $data ) ){
				$_conds = array("success"=>1, "error" => " Upload CTI Extension " );
			}
			else{
				$_conds = array("success"=>0, "error" => " Upload CTI Extension " );
			}
		}
	}
	
	echo json_encode($_conds);
}
 
/*
 * @ def 		: download_extension_cnf 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
  
function PageUpload()
{
	$this -> load -> view("cti_extension/view_cti_page_upload");
}
 
/*
 * @ def 		: download_extension_cnf 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 private function download_extension_cnf()
 {
	$this -> load -> view
	( 
		"cti_extension/view_cti_download_cnf", 
		 $this -> {base_class_model($this)} -> _get_data_download()
	);
 }
 
/*
 * @ def 		: download_extension_xls
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 function download_extension_xls()
 {
	$this -> load -> view
	( 
		"cti_extension/view_cti_download_xls", 
		 $this -> {base_class_model($this)} -> _get_data_download()
	);
	
 }
 

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 
function SetEventDownload()
{
	if( $this->URI->segment(3) == 'Excel' )
 {
		$this->download_extension_xls();
	}
	
	if( $this->URI->segment(3) == 'Conf' ){
		$this->download_extension_cnf();
	}
} 



//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 
function download_extension_tpl()
 {
	$EUI = array( 'columns' => $this -> {base_class_model($this)} -> _get_data_template() );
	$this -> load -> view("cti_extension/view_cti_download_tpl", $EUI);
 }
 
/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
  
function _getPBX()
{
	$_conds = array();
	foreach( $this->M_Pbx->_get_pbx_setting() as $rows)
	{
		$_conds[$rows['pbx']] = $rows['value'];
	}
	
	return $_conds;
	
}

/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
  
function _getType()
{
	$_conds = ARRAY(0,1,2,3,4);
	return $_conds;
}

/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
  
function _getStatus()
{
	$_conds = ARRAY('0' =>'Not Active','1'=>'Active');
	return $_conds;
}
 
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 function SetEventAdd()
{
	$role = $this->M_UserRole->_select_role_form_action(get_class($this));
	$this -> load -> view("cti_extension/view_cti_add_tpl", array(
		"Button" => Objective( $role )
	));
 }
 
 
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 
 function SetEventEdit()
 {
	$out = _find_all_object_request();
	$row = $this ->{base_class_model($this)}->_select_rows_ext_detail( $out->get_value('ExtId'));
	$rol = $this->M_UserRole->_select_role_form_action(get_class($this));
	
	$this -> load -> view("cti_extension/view_cti_edit_tpl",  array (
		'Data' => $row, 
		'Button' => Objective( $rol )
	));
 }
 
/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function EventSaveExtension()
{
	$_conds = array('success'=>0);
	
	$res = $this->{base_class_model($this)}->_set_event_save_extension( _find_all_object_request() );
	if( $res )
	{
		$_conds = array('success'=>1);
	}
	
	echo json_encode($_conds);
 }
 
/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
  
function Restart()
{	
	system("sudo /sbin/service centerback restart",$callback);
	if( $callback ){
		echo "Service centerback restart, Success";
	}
	else{
		echo "Service centerback restart, Failed";
	}
 }
 
/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function SetEventUpdate()
{
	$_conds = array('success'=>0);
	
	$res = $this -> {base_class_model($this)} -> _set_event_update_extension( _find_all_object_request() );
	if( $res ) {
		$_conds = array('success'=>1);
	}
	
	echo json_encode($_conds);
}

/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function SetEventDelete()
{
	$cond = array( 'success'=>0 );
	$replay = $this ->{base_class_model($this)}-> _set_event_delete_extension( _find_all_object_request() );
	if($replay ) 
	{
		$cond = array('success'=>1 );
	}
	
	echo json_encode($cond);
	
 }

/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
  
 function SetEventRelease()
 {
	$cond = array( 'success'=>0 );
	$replay = $this ->{base_class_model($this)}-> _set_event_release_extension( _find_all_object_request() );
	if( is_array($replay) ) 
	{
		$cond = array('success'=>1, 'message' => $replay );
	}
	
	echo json_encode($cond);
	
 }
 
 // -----------------------------------------------------------

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
 
// end of file  
}
?>
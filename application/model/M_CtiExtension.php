<?php
/*
 * E.U.I 
 *
 
 * subject	: M_SetBenefit modul 
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/model/M_Utility/
 */
 
class M_CtiExtension extends EUI_Model
{


//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
private static $Instance = NULL;

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 public static function &Instance() 
{
  if( is_null(self::$Instance) ) {
	self::$Instance = new self();
  }
  return self::$Instance;
}

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 function __construct()
{
  $this->load->model(array('M_Pbx','M_UserRole'));
  $this->load->meta('_cc_extension_agent');
}

/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function _get_default()
{
	
	$out = new EUI_Object(_get_all_request()); 
	
// ---------- customize filter ------------------------
	
	$this->EUI_Page->_setPage(DEFAULT_COUNT_PAGE); 
	$this->EUI_Page->_setSelect("a.id as ExtId");
	$this->EUI_Page->_setFrom("cc_extension_agent a");
	$this->EUI_Page->_setJoin("cc_pbx_settings b ","a.pbx=b.id", "LEFT");
	$this->EUI_Page->_setJoin("tms_agent c ","a.ext_location=c.ip_address", "LEFT", true);
	
// ------------------- post filter  --------------------------------------------------------------	
	
	$this->EUI_Page->_setAndCache("a.ext_number", "frm_ext_number", true);
	$this->EUI_Page->_setAndCache("a.ext_location", "frm_ext_location", true);
	$this->EUI_Page->_setAndCache("a.ext_status", "frm_ext_status", true);
	$this->EUI_Page->_setAndCache("a.ext_type", "frm_ext_type", true);
	$this->EUI_Page->_setAndCache("a.ext_desc", "frm_ext_description", true);
	$this->EUI_Page->_setAndCache("a.pbx", "frm_ext_pbx_server", true);
	$this->EUI_Page->_setLikeCache("c.full_name", "frm_ext_user_state", true);
	
	
	// $this->EUI_Page->_setAndCache("a.CallCategoryId", "frm_src_call_category", true);
	// $this->EUI_Page->_setAndOrCache("a.CustomerCallDateTs>='". StartDate(_get_post('frm_src_start_date')) ."'", 'frm_src_start_date', true);
	// $this->EUI_Page->_setAndOrCache("a.CustomerCallDateTs<='". EndDate(_get_post('frm_src_end_date')) ."'", 'frm_src_end_date', true);
	
// -------- return page data -------------------------------------
	//echo $this->EUI_Page->_getCompiler();
	
	return $this->EUI_Page;
	
}

/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 public function _get_content()
{
	$this->EUI_Page->_postPage(_get_post('v_page') );
	$this->EUI_Page->_setPage(DEFAULT_COUNT_PAGE);
	$this->EUI_Page->_setArraySelect(array(
		"a.id as ExtId" => array("ExtId", "ExtId", "primary"), 
		"a.ext_number as extNumber" => array("extNumber", "Ext. Number"),
		"b.set_value as extPbx" => array("extPbx", "PABX Server"), 
		"a.ext_desc as extDesc" => array("extDesc", "Description"), 
		"a.ext_type as extType" => array("extType", "Ext. Type"), 
		"a.ext_status as extStatus" => array("extStatus", "Ext. Status"), 
		"a.ext_location as extLocation" => array("extLocation", "Ext. Location"), 
		"c.full_name as AgentName" => array("AgentName", "Agent State"), 
	
	));
	
	$this->EUI_Page->_setFrom("cc_extension_agent a");
	$this->EUI_Page->_setJoin("cc_pbx_settings b ","a.pbx=b.id", "LEFT");
	$this->EUI_Page->_setJoin("tms_agent c ","a.ext_location=c.ip_address", "LEFT", true);
	
// -------------- filter data --- 	
	$this->EUI_Page->_setAndCache("a.ext_number", "frm_ext_number", true);
	$this->EUI_Page->_setAndCache("a.ext_location", "frm_ext_location", true);
	$this->EUI_Page->_setAndCache("a.ext_status", "frm_ext_status", true);
	$this->EUI_Page->_setAndCache("a.ext_type", "frm_ext_type", true);
	$this->EUI_Page->_setAndCache("a.ext_desc", "frm_ext_description", true);
	$this->EUI_Page->_setAndCache("a.pbx", "frm_ext_pbx_server", true);
	$this->EUI_Page->_setLikeCache("c.full_name", "frm_ext_user_state", true);
	
	
	
	// -----------if have order sorted ---------------------------------

   if( _get_have_post("order_by") ){
	$this->EUI_Page->_setOrderBy(_get_post("order_by"), _get_post("type"));
   } else {
	$this->EUI_Page->_setOrderBy("a.id", "ASC");
   }
   
// -----------then limit on here ---------------------------------
	$this->EUI_Page->_setLimit();
	//echo $this->EUI_Page->_getCompiler();
	
}


/*
 * @ def 		: _get_resource // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function _get_resource()
 {
	self::_get_content();
	if( $this -> EUI_Page -> _get_query()!='') 
	{
		return $this -> EUI_Page -> _result();
	}	
 }
 
/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function _get_page_number() 
 {
	if( $this -> EUI_Page -> _get_query()!='' ) {
		return $this -> EUI_Page -> _getNo();
	}	
 }
 
/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function _get_data_download()
{
	$this -> _cc_extension_agent -> meta_select();
	$data = array ( 
		'data' => $this -> _cc_extension_agent -> meta_get_query(), 
		'cols' => $this -> _cc_extension_agent -> _get_meta_colums() 
	);
	
	return $data;
} 


/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function _get_data_template()
{
	$data_template = $this -> _cc_extension_agent -> _get_meta_colums();
 	if( $data_template )
	{
		return $data_template;
	}
} 
 
 //---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
function _getDataExtension( $ExtensionId=0 )
{
	$this ->db ->select('*');	
	$this ->db ->from('cc_extension_agent');
	$this ->db ->where('id',$ExtensionId);
	
	if( $rows = $this ->db ->get() -> result_first_assoc() ){
		return $rows;
	}
	else{
		return array();
	}
} 
 
/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 function _cti_extension_upload( $data = null )
 {
	$_totals = 0;
	$_conds = false;
	if( !is_null( $data) )
	{
		if($this -> URI -> _get_post('mode') =='truncate') //empty table if truncate mode  
			$this -> db -> truncate( $this -> _cc_extension_agent-> _get_meta_index() );
			
		// then request 
		
		foreach( $data as $rows ) 
		{
			if( $this -> db -> insert( 
				$this -> _cc_extension_agent-> _get_meta_index(),
				$rows
			)){
				$_totals+=1;
			}
		}
		
		if( $_totals > 1)
			$_conds = true;
		
	}
	
	return $_conds;	
 }


/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 
 function _set_event_update_extension( $out = null )
 {
	if( is_null($out) ){
		return false;
	}
	
	$this->db->reset_write();
	$this->db->set("ext_number", $out->get_value('ext_number') );
	$this->db->set("ext_location", $out->get_value('ext_location') );
	$this->db->set("pbx", $out->get_value('pbx') );
	$this->db->set("ext_type", $out->get_value('ext_type') );
	$this->db->set("ext_status", $out->get_value('ext_status') );
	$this->db->set("ext_desc", $out->get_value('ext_desc') );
	$this->db->where("id", $out->get_value('id') );
	
	if( $this->db->update("cc_extension_agent") ){
		EventLoger('UPD', array("Update extension ",$out->get_value('ext_number')));
		return true;
	}
	return false;
	
 }
 
 
/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 function _set_event_save_extension( $out = null )
 {
	 if( is_null($out) ){
		 return false;
	 }
	 
	$this->db->reset_write();
	$this->db->set("ext_number", $out->get_value('ext_number') );
	$this->db->set("ext_location", $out->get_value('ext_location') );
	$this->db->set("pbx", $out->get_value('pbx') );
	$this->db->set("ext_type", $out->get_value('ext_type') );
	$this->db->set("ext_status", $out->get_value('ext_status') );
	$this->db->set("ext_desc", $out->get_value('ext_desc') );
	$this->db->insert('cc_extension_agent');
	
	if(  $this->db->affected_rows() > 0 ) {
		return true;
	}	
	return false;
 }
 /*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 private function _getExtension( $PbxId=0 )
 {
	$this -> db -> select('ext_number');
	$this -> db -> from('cc_extension_agent');
	$this -> db -> where('id',$PbxId);
	
	if( $rows = $this -> db ->get()->result_first_assoc() ){
		return $rows['ext_number'];
	} 
	else
		return false;
	
 }
 
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */ 
 function _select_rows_ext_detail( $ExtId = 0 )
 {
	$ar_row_ext   = array();
	
	$sql = sprintf("select * from cc_extension_agent a where a.id = '%s'", $ExtId );
	$qry = $this->db->query( $sql );
	 if( $qry->num_rows() > 0 )  {
		$ar_row_ext  = $qry->result_first_assoc();		
	}	
	
	return Objective($ar_row_ext);
 }
 
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
function _set_event_release_extension( $out = null )
{
	$ar_error_message = array();
	
	if( is_null($out) OR !$out->find_value('ExtId')  ){
		return false;
	}
	
// -- call pbx object  --- 
	
	$objPbx =& get_class_instance('M_Pbx');
	
	$ar_ext_id = $out->get_array_value('ExtId');
	if( is_array($ar_ext_id) and count($ar_ext_id) > 0 ) 
		foreach( $ar_ext_id as $key => $val )
	{
		$row = $this->_select_rows_ext_detail( $val );
		if( $row->find_value('pbx') )
		{
			EventLoger('REF', array("Register extension ",$row->get_value('ext_number')));
			
			// ---- get object server by PBX id  --- 
			
			$obj  = $objPbx->_select_pbx_manager_server( $row->get_value('pbx') );
			
			// --- then get server host pbx application --- 
			
			 $objSock = new EUI_Socket(); 
			 if( $obj->find_value('server.host'))
			{
				$objSock->set_fp_server( $obj->get_value('server.host'),$obj->get_value('server.port')); 
				$objSock->set_fp_command( sprintf( "rel-station\r\n"."ext:%s\r\n\r\n", $row->get_value('ext_number'))); 
				$objSock-> send_fp_comand();
			}
			
			// --- ret object  ---- 
			
			$Sock = $objSock->get_fp_callback();
			
			if( is_bool($Sock->messages_replay) 
				and $Sock->messages_replay == FALSE )
			{
				$ar_error_message[$row->get_value('ext_number')] =  $Sock->error_string;		
				
			} else {
				$ar_error_message[$row->get_value('ext_number')] =  'OK';
			}
		}
	}
	
	return $ar_error_message;
 }
 
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 function _set_event_delete_extension( $out = null )
 {
	$cond = 0;
	
	$ar_ext_id = $out->get_array_value('ExtId');
	
	if( is_array($ar_ext_id) and count($ar_ext_id) > 0 ) 
		foreach( $ar_ext_id as $key => $val )
	{
		$row = $this->_select_rows_ext_detail( $val );
		if( $this->db->delete('cc_extension_agent',array( 'id'=> $val )) ) {
			EventLoger('DEL', array("delete extension ",$row->get_value('ext_number')));
			$cond++;		
		}
	}
	
	return $cond;
 }
 
/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
  
function _select_pbx_server()
{
	$_conds = array();
	foreach( $this->M_Pbx->_get_pbx_setting() as $rows)
	{
		$_conds[$rows['pbx']] = $rows['value'];
	}
	
	return $_conds;
	
} 
 //---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 
function _select_ext_status()
{
	$_conds = array('0' =>'Enable','1'=>'Disable');
	return $_conds;
}
  
 
 //---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
function _select_ext_description()
{
	$_conds = array('INBOUND' =>'INBOUND','OUTBOUND'=>'OUTBOUND');
	return $_conds;
}
 
 
 //---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
function _select_ext_type()
{
	$_conds = array('0'=> 'Analog','1'=> 'Digital','2' => 'Softphone');
	return $_conds;
}  

 
}

?>
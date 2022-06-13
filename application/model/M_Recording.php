<?php
/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
 // from : M_ModVoiceData to M_Recording <clean:up> 
class M_Recording Extends EUI_Model
{

/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
private static $Instance = null;
/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 private $constant = array();
/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
public static function &Instance()
{
  if( is_null(self::$Instance) ){
	self::$Instance = new self();
 }
  return self::$Instance;	
}
/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
 function __construct() { 
// load model data 
  $this->load->model(array('M_Pbx','M_Configuration','M_SrcCustomerList','M_SysUser'));
//load constant 
  $this->constant = (object)array( 'start_time' => join(" ", array( date('Y-m-d'), '00:00:00')),
								   'end_time' 	=> join(" ", array( date('Y-m-d'), '23:59:59')));
}
 
/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 public function _get_default()
{
 
 // get all request on ckient Header process On HED 

	$this->dataURI = UR();
	//debug($this->dataURI);
	$this->dataCOK = CK();
	
 // set query parameter --------------------------	
 
	$this->EUI_Page->_setPage(DEFAULT_COUNT_PAGE);
	$this->EUI_Page->_setCount(true);
	$this->EUI_Page->_setSelect("count(a.id) as total");
	$this->EUI_Page->_setFrom("cc_recording a");
	$this->EUI_Page->_setJoin("t_gn_customer_master b ","a.assignment_data = b.DM_Id", "INNER");
	$this->EUI_Page->_setJoin("t_gn_campaign f "," b.DM_CampaignId=f.CampaignId", "LEFT");
	$this->EUI_Page->_setJoin("cc_agent c "," a.agent_id=c.id", "LEFT");
	$this->EUI_Page->_setJoin("tms_agent d "," c.userid=d.id", "LEFT", TRUE);
	
 // process filter data yang berasal dari session login di mulai dari 
 // sini dengan method_exists .
  
  // USER_ROOT, USER_ADMIN
	if( in_array( $this->dataCOK->field('HandlingType'), array(USER_ROOT, USER_ADMIN)) ) {
		$this->EUI_Page->_setAnd("d.UserId IS NOT NULL", false);
	}
	
 // USER_ACCOUNT_MANAGER // GENERAL_MANAGER 
	if( in_array($this->dataCOK->field('HandlingType'), array(USER_ACCOUNT_MANAGER)) ) {
		$this->EUI_Page->_setAnd("d.mgr_id", $this->dataCOK->field('UserId'));
	}
	
 // USER_MANAGER // ACC 
	if( in_array($this->dataCOK->field('HandlingType'), array(USER_MANAGER)) ) {
		$this->EUI_Page->_setAnd("d.mgr_id", $this->dataCOK->field('UserId'));
	}
		
	
//  USER_SUPERVISOR
	if( in_array($this->dataCOK->field('HandlingType'), array(USER_SUPERVISOR)) ) {
		$this->EUI_Page->_setAnd("d.spv_id", $this->dataCOK->field('UserId'));
	}
	
//  USER_LEADER 	
	if( in_array($this->dataCOK->field('HandlingType'),  array(USER_LEADER)) ) {
		$this->EUI_Page->_setAnd("d.tl_id", $this->dataCOK->field('UserId'));
	}
	
	
	
// process filter by request User , Atau berdasarkan filter 
// optional yang di pilih oleh user .
// dan akan di simpan sebagai cache .


// jika data session kosong 
	$this->EUI_Page->_setAndCache("b.DM_CallCategoryId", 'MSD_call_category', 	TRUE);
	 
 
	// tanggal recoding wajib di isi : 
	if( !$this->dataURI->find_value('VLS_Data_start_date') ){
		$this->dataURI->setReq('VLS_Data_start_date', date('d-m-Y'));
	}
	if( !$this->dataURI->find_value('VLS_Data_end_date') ){
		$this->dataURI->setReq('VLS_Data_end_date', date('d-m-Y'));
	}
	 
	// get on here like this;
	$this->EUI_Page->_setBeginCache("a.start_time",	'VLS_Data_start_date', TRUE);
	$this->EUI_Page->_setStopCache("a.start_time", 	'VLS_Data_end_date', 	TRUE);
	$this->EUI_Page->_setFieldCache('LIKE',	'VLS1_filter_field', 'VLS1_filter_value', TRUE);
    $this->EUI_Page->_setFieldCache('LIKE',	'VLS2_filter_field', 'VLS2_filter_value', TRUE);
	$this->EUI_Page->_setAndOrCache(sprintf("a.duration>=%d", $this->dataURI->field('VLS_Duration_Start')), 'VLS_Duration_Start', true);
	$this->EUI_Page->_setAndOrCache(sprintf("a.duration<=%d", $this->dataURI->field('VLS_Duration_End')),   'VLS_Duration_End', true);
	
	// echo $this->EUI_Page->_getCompiler();
	//exit('under maintenance');
	
	return $this->EUI_Page;
	
 }
 
/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 function _get_content()
{	
// get all request on ckient Header process On HED 

	$this->dataURI = UR();
	$this->dataCOK = CK();
	
// set paramete data pager on here process like this.
// set count for efective data 

	$this->EUI_Page->_postPage($this->dataURI->field('v_page') );
	$this->EUI_Page->_setPage(DEFAULT_COUNT_PAGE); 
	
// sent array select process on here .
// call_date, destination, extension, agent_id, duration, size, file_name, cust_name, 	campaign
	$this->EUI_Page->_setArraySelect(array(
		"a.id as CC_RecId"				 	=> array("CC_RecId", 		"CC_RecId","primary"),
		"a.start_time as CC_DateTime" 	 	=> array("CC_DateTime",		"CC_DateTime"),
		"a.anumber as CC_Destination" 	 	=> array("CC_Destination",	"CC_Destination"),
		"a.agent_ext as CC_Extension" 	 	=> array("CC_Extension",	"CC_Extension"),
		"c.userid as CC_AgentId" 		 	=> array("CC_AgentId",		"CC_AgentId"),
		"b.DM_CallCategoryId as DM_CallCategoryId"		=> array("DM_CallCategoryId", 	 "DM_CallCategoryKode"),
		"a.duration as CC_Duration" 	 	=> array("CC_Duration",		"CC_Duration"),
		"a.file_voc_size as CC_FileSize" 	=> array("CC_FileSize",		"CC_FileSize"),
		"a.file_voc_name as CC_FileName" 	=> array("CC_FileName",		"CC_FileName"),
		"f.CampaignDesc as CC_CampaignId" 	=> array("CC_CampaignId",	"DM_CampaignId"),
		"b.DM_Custno as CC_Custno" 	 		=> array("CC_Custno",		"DM_Custno"),
		"b.DM_FirstName as CC_FirstName" 	=> array("CC_FirstName",	"DM_FirstName")
	));
	
	$this->EUI_Page->_setFrom("cc_recording a");
	$this->EUI_Page->_setJoin("t_gn_customer_master b","a.assignment_data = b.DM_Id", "INNER");
	$this->EUI_Page->_setJoin("t_gn_campaign f "," b.DM_CampaignId=f.CampaignId", "LEFT");
	$this->EUI_Page->_setJoin("cc_agent c "," a.agent_id=c.id", "LEFT");
	$this->EUI_Page->_setJoin("tms_agent d "," c.userid=d.id", "LEFT", TRUE);
	
 // process filter data yang berasal dari session login di mulai dari 
 // sini dengan method_exists .
  
 // USER_ROOT, USER_ADMIN
	if( in_array( $this->dataCOK->field('HandlingType'), array(USER_ROOT, USER_ADMIN)) ) {
		$this->EUI_Page->_setAnd("d.UserId IS NOT NULL", false);
	}
	
 // USER_ACCOUNT_MANAGER // GENERAL_MANAGER 
	if( in_array($this->dataCOK->field('HandlingType'), array(USER_ACCOUNT_MANAGER)) ) {
		$this->EUI_Page->_setAnd("d.mgr_id", $this->dataCOK->field('UserId'));
	}
	
 // USER_MANAGER // ACC 
	if( in_array($this->dataCOK->field('HandlingType'), array(USER_MANAGER)) ) {
		$this->EUI_Page->_setAnd("d.mgr_id", $this->dataCOK->field('UserId'));
	}
		
	
 //  USER_SUPERVISOR
	if( in_array($this->dataCOK->field('HandlingType'), array(USER_SUPERVISOR)) ) {
		// $this->EUI_Page->_setAnd("d.spv_id", $this->dataCOK->field('UserId'));
	}
	
 //  USER_LEADER 	
	if( in_array($this->dataCOK->field('HandlingType'),  array(USER_LEADER)) ) {
		$this->EUI_Page->_setAnd("d.tl_id", $this->dataCOK->field('UserId'));
	}
	
	
	
 // process filter by request User , Atau berdasarkan filter 
 // optional yang di pilih oleh user .
 // dan akan di simpan sebagai cache .
 
 
	$this->EUI_Page->_setBeginCache("a.start_time",	'VLS_Data_start_date', TRUE);
	$this->EUI_Page->_setStopCache("a.start_time", 	'VLS_Data_end_date', 	TRUE);
	$this->EUI_Page->_setAndCache("b.DM_CallCategoryId", 'MSD_call_category', 	TRUE);
	$this->EUI_Page->_setFieldCache('LIKE',	'VLS1_filter_field', 'VLS1_filter_value', TRUE);
    $this->EUI_Page->_setFieldCache('LIKE',	'VLS2_filter_field', 'VLS2_filter_value', TRUE);
	$this->EUI_Page->_setAndOrCache(sprintf("a.duration>=%d", $this->dataURI->field('VLS_Duration_Start')), 'VLS_Duration_Start', true);
	$this->EUI_Page->_setAndOrCache(sprintf("a.duration<=%d", $this->dataURI->field('VLS_Duration_End')),   'VLS_Duration_End', true);
	
 // set order field  
  
	if( $this->dataURI->find_value('order_by') ){
		$this->EUI_Page->_setOrderBy( $this->dataURI->field('order_by'), $this->dataURI->field('type') ); 
	}	 
	else{
		$this->EUI_Page->_setOrderBy('a.id', 'DESC');
	}
   
   // set limit data tiap pager -nya 
	$this->EUI_Page->_setLimit();	
	//echo $this->EUI_Page->_getCompiler();
	
	
}

 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
function _select_row_fetch_data( $rec_id = 0 ){
	
	$this->result_assoc = array();
	$sql = sprintf("select * from cc_recording a where a.id = '%s'", $rec_id);
	$qry = $this->db->query($sql);
	if( $qry && $qry->num_rows() > 0 ){
		$this->result_assoc = $qry->result_first_assoc();
	}
	// return object data 
	return Objective( $this->result_assoc );
	
} 

/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
 function _select_row_ftp_config( $extension  = 0 )
{
	// this get name pbx 
	$this->dataServerExtension = $extension;
	$this->dataServerPbxID = null;
	$this->dataServerPbxConf = null;
	$this->dataServerPbxAddr = array();
	
	// then will query step by step 
	$sql = sprintf("select a.pbx from cc_extension_agent a where a.ext_number = '%s'", $this->dataServerExtension);
	$qry = $this->db->query( $sql );
	if( $qry && $qry->num_rows() >0 
		and ( $row = $qry->result_first_assoc() ))
   {
		$this->dataServerPbxID = $row['pbx'];
	}
	
	// if pbx server empty OR Null Return false;
	if( is_null($this->dataServerPbxID) ){
		return false;
	}
	
	// this get config 
	$sql = sprintf("SELECT cf.ConfigName FROM t_lk_configuration cf 
					WHERE cf.ConfigValue ='%s' 
					AND cf.ConfigCode='PBX_VLS_CONFIG'",  $this->dataServerPbxID );
					
	$qry = $this->db->query( $sql ); 
	if( $qry && $qry->num_rows() >0 
		and ( $row = $qry->result_first_assoc() ))  {
		$this->dataServerPbxConf = $row['ConfigName'];
	}				
	
	// if pbx server empty OR Null Return false;
	// var_dump($this->dataServerPbxConf);
	
	if( is_null($this->dataServerPbxConf) ){
		return false;
	}
	
	// get row data PBX setup t_lk_configuration.
	$sql = sprintf("SELECT a.ConfigID, a.ConfigName, a.ConfigValue 
					FROM t_lk_configuration a where ConfigCode='%s'", $this->dataServerPbxConf);
					
	$qry = $this->db->query( $sql );			
	if( $qry and $qry->num_rows() >0 )
	 foreach( $qry->result_record() as $row )
	{
		$this->dataServerPbxAddr[$row->field('ConfigName')] = $row->field('ConfigValue','trim');
	}				
	
	// return data convert to object string.
	return Objective( $this->dataServerPbxAddr );
}


/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 function _getVoiceData($VoiceId=0 )
 {
	$this -> db -> select("*");
	$this -> db -> from("cc_recording a");
	$this -> db -> where('id',$VoiceId);
	//echo $this -> db ->_get_var_dump();
	
	$_result =  array();
	
	if( $_conds = $this -> db->get() -> result_first_assoc() )
	{
		foreach($_conds as $fld => $values )
		{
			if( $fld=='file_voc_size' ) 
				$_result[$fld] = $this->EUI_Tools->_get_format_size($values);
				
			else if( $fld=='duration' ) 
				$_result[$fld] = $this->EUI_Tools->_set_duration($values);
				
			else if( $fld=='anumber' ) 
				$_result[$fld] = $this->EUI_Tools->_getPhoneNumber($values);	
				
			else if( $fld=='start_time' ) 
				$_result[$fld] = $this->EUI_Tools->_datetime_indonesia($values);	
				
			else 
				$_result[$fld] = $values;
		}
		
		return $_result;
	}
	else
		return null;
 }

/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 
public function _get_resource()
 {
	self::_get_content();
	if( $this -> EUI_Page -> _get_query()!='') 
	{
		return $this -> EUI_Page -> _result();
	}	
 }
 
/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
public function _get_page_number() 
 {
	
	if( $this -> EUI_Page -> _get_query()!='' ) {
		return $this -> EUI_Page -> _getNo();
	}	
 }
 
 
}
?>
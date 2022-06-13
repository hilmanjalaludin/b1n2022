<?php 
/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	 
class M_CallDisposition extends EUI_Model{
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
function __construct(){ 
	$this->load->model(array('M_UserRole'));
}
	
/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	 
public static function &Instance(){
	if( is_null(self::$Instance ) ){
		self::$Instance = new self();
	}
	return self::$Instance;
}


 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
    
function _select_call_disposition_count_page() {
	
 // get data object 	
	$out = UR();  $cok = CK();  $cnf = CF();
// get all data not contacted 
	$this->EUI_Page->_setPage(DEFAULT_COUNT_PAGE); 
	$this->EUI_Page->_setCount(TRUE);
	$this->EUI_Page->_setSelect("count(a.DS_CallId) as tot");
	$this->EUI_Page->_setFrom("t_lk_calldisposition a");
	$this->EUI_Page->_setJoin("t_lk_callreasoncategory b ","a.DS_CallCategoryId=b.CallReasonCategoryId", "LEFT" );
	$this->EUI_Page->_setJoin("tms_agent_profile c ","a.DS_CallUserGroup=c.id", "LEFT", true);
	
	

// default query for all user data yang di munculkan adalah data2 non close 
// atau approve

//  ADMIN / ROOT 		
	if( $cok->cookie(array(USER_ROOT, USER_ADMIN)) ){
		//$this->EUI_Page->_setWhereIn("c.admin_id", $cnf->field('default_admin'));	
	}
// filter data pager :  MANAGER  
	if( $cok->cookie( USER_MANAGER ) ){  
		$this->EUI_Page->_setWhereNotIn("c.id", array(USER_ROOT, USER_ADMIN) );
	}
// filter data pager :  ACC MANAGER   
	if( $cok->cookie(USER_ACCOUNT_MANAGER) ){ 
		$this->EUI_Page->_setWhereNotIn("c.id", array(USER_ROOT, USER_ADMIN) );
	}
// filter data pager :  SPV -- 
	if( $cok->cookie(USER_SUPERVISOR) ){ 
		$this->EUI_Page->_setWhereNotIn("c.id", array(USER_ROOT, USER_ADMIN) );
	}
// filter data pager :  LEADER ( TL )	-- 
	if( $cok->cookie(USER_LEADER) ){ 
		$this->EUI_Page->_setWhereNotIn("c.id", array(USER_ROOT, USER_ADMIN) );
	}
// filter data pager :  AGENT ( TSR )	-- 
	if( $cok->cookie(array(USER_AGENT_OUTBOUND, USER_AGENT_INBOUND))){ 
		$this->EUI_Page->_setWhereNotIn("c.id", array(USER_ROOT, USER_ADMIN) );	
	}
	
//  post filter  --------------------------------------------------------------	
 
	$this->EUI_Page->_setAndCache("a.DS_CallUserGroup", 'DS_CallUserGroup', TRUE);
    $this->EUI_Page->_setBeginCache("a.DS_CallUserUpdateTs", 'DS_CallUserUpdateTs_start_date', TRUE);
    $this->EUI_Page->_setStopCache("a.DS_CallUserUpdateTs", 'DS_CallUserUpdateTs_end_date', 	TRUE);
	$this->EUI_Page->_setFieldCache('LIKE', 'DS1_filter_field', 'DS1_filter_value', TRUE);
    $this->EUI_Page->_setFieldCache('LIKE', 'DS2_filter_field', 'DS2_filter_value', TRUE);
	
	
// return page data -------------------------------------
   // echo $this->EUI_Page->_getCompiler();
	return $this->EUI_Page;
}

 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
    
function _select_call_disposition_content_page()
{
	
// get all define not interested on here 
	$out = UR();  $cok = CK();  $cnf = CF(); 
	
// get all define not interested on here 
	
	$this->EUI_Page->_postPage( $out->field('v_page') );
	$this->EUI_Page->_setPage(DEFAULT_COUNT_PAGE);
	
// select an pager methodelogist 
	
	$this->EUI_Page->_setArraySelect(array(
		"a.DS_CallId as DS_CallId"							=> array("DS_CallId",			"DS_CallId","primary"),
		"c.name as DS_CallUserGroup"						=> array("DS_CallUserGroup",	"DS_CallUserGroup"),
		"a.DS_CallCategoryKode as DS_CallCategoryKode"		=> array("DS_CallCategoryKode",	"DS_CallCategoryKode"),
		"b.CallReasonCategoryName as DS_CallCategoryName"	=> array("DS_CallCategoryName",	"DS_CallCategoryName"),
		"a.DS_CallUserSorter as DS_CallUserSorter"			=> array("DS_CallUserSorter",	"DS_CallUserSorter"),
		"a.DS_CallUserEditor as DS_CallUserEditor"			=> array("DS_CallUserEditor",	"DS_CallUserEditor"),
		"a.DS_CallUserUpdateTs as DS_CallUserUpdateTs"		=> array("DS_CallUserUpdateTs",	"DS_CallUserUpdateTs")
	));
	
	$this->EUI_Page->_setFrom("t_lk_calldisposition a");
	$this->EUI_Page->_setJoin("t_lk_callreasoncategory b ","a.DS_CallCategoryId=b.CallReasonCategoryId", "LEFT" );
	$this->EUI_Page->_setJoin("tms_agent_profile c ","a.DS_CallUserGroup=c.id", "LEFT", true);
	 
// default query for all user data yang di munculkan adalah data2 non close 
// atau approve

//  ADMIN / ROOT 		
	if( $cok->cookie(array(USER_ROOT, USER_ADMIN)) ){
		//$this->EUI_Page->_setWhereIn("c.admin_id", $cnf->field('default_admin'));	
	}
	
// filter data pager :  MANAGER  
	if( $cok->cookie( USER_MANAGER ) ){  
		$this->EUI_Page->_setWhereNotIn("c.id", array(USER_ROOT, USER_ADMIN) );
	}	
	
	
// filter data pager :  ACC MANAGER   
	if( $cok->cookie(USER_ACCOUNT_MANAGER) ){ 
		$this->EUI_Page->_setWhereNotIn("c.id", array(USER_ROOT, USER_ADMIN) );
	}
	
// filter data pager :  SPV -- 
	if( $cok->cookie(USER_SUPERVISOR) ){ 
		$this->EUI_Page->_setWhereNotIn("c.id", array(USER_ROOT, USER_ADMIN) );
	}
	
// filter data pager :  LEADER ( TL )	-- 
	if( $cok->cookie(USER_LEADER) ){ 
		$this->EUI_Page->_setWhereNotIn("c.id", array(USER_ROOT, USER_ADMIN) );
	}
	
// filter data pager :  AGENT ( TSR )	-- 
	if( $cok->cookie(array(USER_AGENT_OUTBOUND, USER_AGENT_INBOUND))){ 
		$this->EUI_Page->_setWhereNotIn("c.id", array(USER_ROOT, USER_ADMIN) );	
	}
	
	
// customize filter data by post user 
/*	FIELD	:
			[DS_CallUserUpdateTs_start_date] => 
            [DS_CallUserUpdateTs_end_date] => 
            [DS1_filter_field] => 
            [DS1_filter_value] => 
            [DS2_filter_field] => 
            [DS2_filter_value] => 
            [DS_CallUserGroup] => 
	*/
	
	$this->EUI_Page->_setAndCache("a.DS_CallUserGroup", 'DS_CallUserGroup', TRUE);
    $this->EUI_Page->_setBeginCache("a.DS_CallUserUpdateTs", 'DS_CallUserUpdateTs_start_date', TRUE);
    $this->EUI_Page->_setStopCache("a.DS_CallUserUpdateTs", 'DS_CallUserUpdateTs_end_date', 	TRUE);
	$this->EUI_Page->_setFieldCache('LIKE', 'DS1_filter_field', 'DS1_filter_value', TRUE);
    $this->EUI_Page->_setFieldCache('LIKE', 'DS2_filter_field', 'DS2_filter_value', TRUE);

	
// customize filter data order by user 
  if( $out->find_value("order_by") ){
	  $this->EUI_Page->_setOrderBy($out->field("order_by"), $out->field("type"));
  } 
  else {
	  $this->EUI_Page->_setOrderBy("a.DS_CallUserGroup", "ASC");
  }
  
   
//  then limit on here  
  $this->EUI_Page->_setLimit();
  //echo $this->EUI_Page->_getCompiler();
	
}


/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	 
function _select_call_disposition_number_page()  {
	if( strlen($this->EUI_Page->_get_query() ) > 0 ) {
		return $this->EUI_Page->_getNo();
	}	
 }
  
/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	 
 
function _select_call_disposition_source_page() {
 $this->_select_call_disposition_content_page();
 if( strlen($this->EUI_Page->_get_query())>0 )  {
	return $this->EUI_Page->_result();
 }
} 

/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	 

function _update_call_disposition_data( $out = null ){
	
// jika bukan object data yang di kirim.	
 $cok = CK();
 if( !is_object($out) ){
	return false;
 }	

// get user detail 
 $this->DS_CallCategoryKode = $this->_select_call_disposition_kode( $out->field('DS_CallCategoryId') );
 
//reset data 	
 $this->db->reset_write();
 $this->db->set('DS_CallCategoryKode',	$this->DS_CallCategoryKode);
 $this->db->set('DS_CallCategoryId',	$out->field('DS_CallCategoryId'));
 $this->db->set('DS_CallUserGroup', 	$out->field('DS_CallUserGroup'));
 $this->db->set('DS_CallUserSorter',	$out->field('DS_CallUserSorter'));
 $this->db->set('DS_CallUserUpdateTs',	$out->field('DS_CallUserUpdateTs'));
 $this->db->set('DS_CallUserEditor', 	$cok->field('UserId')); 
 
 // jika duplicate 
 $this->db->where('DS_CallId', $out->field('DS_CallId'));
 // then will the insert value data to table  
 if( $this->db->update('t_lk_calldisposition') ){
	return true;
 }
 return false;
 
	
}
/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	 

function _submit_call_disposition_data( $out = null ){
	
// jika bukan object data yang di kirim.	
 $cok = CK();
 if( !is_object($out) ){
	return false;
 }	
 // get "$this->DS_CallCategoryKode"
 $this->DS_CallCategoryKode = $this->_select_call_disposition_kode( $out->field('DS_CallCategoryId') );
 
//reset data 	
 $this->db->reset_write();
 $this->db->set('DS_CallCategoryKode', $this->DS_CallCategoryKode);
 $this->db->set('DS_CallUserGroup', $out->field('DS_CallUserGroup'));
 $this->db->set('DS_CallCategoryId', $out->field('DS_CallCategoryId'));
 $this->db->set('DS_CallUserEditor', $cok->field('UserId'));
 $this->db->set('DS_CallUserUpdateTs', $out->field('DS_CallUserUpdateTs'));
 $this->db->set('DS_CallUserSorter', $out->field('DS_CallUserSorter'));
 
 // jika duplicate 
 $this->db->duplicate('DS_CallUserEditor', $cok->field('UserId'));
 $this->db->duplicate('DS_CallUserUpdateTs', $out->field('DS_CallUserUpdateTs'));
 $this->db->duplicate('DS_CallUserSorter', $out->field('DS_CallUserSorter')); 
 
 
 // then will the insert value data to table 
 $this->db->insert_on_duplicate('t_lk_calldisposition');
 if( $this->db->affected_rows() > 0 ){
	 return true;
 }
 return false;
 
 
 
 	
	
}

/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	 
 
 function _delete_call_disposition_data( $dataURI  = null  )
{
//	debug($dataURI);
// check by richeck data OK .
 if( !is_object($dataURI)){
	return false;
 }
 // query data on model delete bucket kuota  user process 
 // tested on here .
 
 $sql = sprintf("delete from t_lk_calldisposition where DS_CallId='%s'",$dataURI->field('DS_CallId'));
 //echo $sql;
 $qry = $this->db->query( $sql );
 if( $this->db->affected_rows() > 0 ){
	return true;
 }
 return false;
}

/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	 
 
function  _select_call_disposition_kode( $KategoryId = 0 ){
	$sql =sprintf("select a.CallReasonCategoryCode from t_lk_callreasoncategory a 
				   where a.CallReasonCategoryId =%d", $KategoryId);
	$qry = $this->db->query( $sql );
	if( $qry && $qry->num_rows()> 0 ){
		return $qry->result_singgle_value();
	}	
	return null;	
}

/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	 
 
function _select_call_disposition_detail( $dataURI = null ){
	
	$result_array = array();
	$sql = sprintf("select a.* from t_lk_calldisposition a 
					where a.DS_CallId = '%s'", $dataURI->field('DS_CallId')); 
					
	//echo $sql;				
	$qry = $this->db->query( $sql );
	if( $qry && $qry->num_rows()> 0 ){
		$result_array = $qry->result_first_assoc();
	 }
	return Objective ( $result_array );
}
/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	 
 
 
function _select_call_disposition_role( $kode = null ) {
	return SystemRoleFrm($kode, 'Objective');
}
/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	 
 function _select_call_disposition_pager() { }

/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	 
}
?>
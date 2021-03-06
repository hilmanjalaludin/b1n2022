<?php
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
class M_ModUploadDetail Extends EUI_Model
{
	
 private static $Instance = null;
 
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */	
 function __construct() { 
	$this->load->model(array('M_UserRole'));
 }
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */	
  
 public static function &Instance() {
  if( is_null(self::$Instance) ) {
	self::$Instance = new self();
  }
  return self::$Instance;
}
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
 function _get_default()
{
// get data object 		
// get all data not contacted 
	
	$out = UR();  $cok = CK();  $cnf = CF();
	
// get data object 		
// get all data not contacted 

	$this->EUI_Page->_setPage(DEFAULT_COUNT_PAGE); 
	$this->EUI_Page->_setCount(true);
	$this->EUI_Page->_setSelect("COUNT(a.FTP_UploadId) as tot");
	
	
	$this->EUI_Page->_setFrom("t_gn_upload_report_ftp a", true);
// then will get state data process .
	
	$this->EUI_Page->_setFieldCache('LIKE', 			 'USD1_filter_field', 	'USD1_filter_value', TRUE);
    $this->EUI_Page->_setFieldCache('LIKE', 			 'USD2_filter_field', 	'USD2_filter_value', TRUE);
	$this->EUI_Page->_setFieldCache('LIKE', 			 'USD3_filter_field', 	'USD3_filter_value', TRUE);
    $this->EUI_Page->_setFieldCache('LIKE', 			 'USD4_filter_field', 	'USD4_filter_value', TRUE);
	
	// return data pager counting pager.
	// echo $this->EUI_Page->_getCompiler();
	
	return $this->EUI_Page;
 }
 
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
function _get_content() {
	
		
// get data object 	
	$out = UR();  $cok = CK();  $cnf = CF(); 
	
// get all define not interested on here 
// call object page 
	$this->EUI_Page->_postPage( $out->field('v_page') );
	$this->EUI_Page->_setPage(DEFAULT_COUNT_PAGE);
	
// get select dat query from array select .
	$this->EUI_Page->_setArraySelect(array(
		'a.FTP_UploadId as UPL_UploadId' 				=> array('UPL_UploadId',		'UPL_UploadId', 'PRIMARY'),
		'a.FTP_UploadId as UPL_DataID' 					=> array('UPL_DataID',			'UPL_DataID'),
		'a.FTP_Recsource as UPL_Recsource' 				=> array('UPL_Recsource',		'UPL_Recsource'),
		'a.FTP_UploadRows as UPL_UploadRows' 			=> array('UPL_UploadRows',		'UPL_UploadRows'),
		'a.FTP_UploadSuccess as UPL_UploadSuccess' 		=> array('UPL_UploadSuccess',	'UPL_UploadSuccess'),
		'a.FTP_UploadFailed as UPL_UploadFailed' 		=> array('UPL_UploadFailed',	'UPL_UploadFailed'),
		'a.FTP_UploadDuplicate as UPL_UploadDuplicate' 	=> array('UPL_UploadDuplicate',	'UPL_UploadDuplicate'),
		'a.FTP_UploadDateTs as UPL_UploadDateTs' 		=> array('UPL_UploadDateTs',	'UPL_UploadDateTs'),
		'a.FTP_UploadFilename as UPL_UploadFilename' 	=> array('UPL_UploadFilename',	'UPL_UploadFilename'),
		'a.FTP_UploadType as UPL_UploadType' 			=> array('UPL_UploadType',		'UPL_UploadType'),
		'a.FTP_UploadBy as UPL_UploadBy' 				=> array('UPL_UploadBy',		'UPL_UploadBy'),
		'a.FTP_Flags as UPL_Flags'						=> array('UPL_Flags',			'UPL_Flags'),
		
	));
	
	$this->EUI_Page->_setFrom("t_gn_upload_report_ftp a", true);
	// get filter data on data Detail process 
	
	$this->EUI_Page->_setFieldCache('LIKE', 			 'USD1_filter_field', 	'USD1_filter_value', TRUE);
    $this->EUI_Page->_setFieldCache('LIKE', 			 'USD2_filter_field', 	'USD2_filter_value', TRUE);
	$this->EUI_Page->_setFieldCache('LIKE', 			 'USD3_filter_field', 	'USD3_filter_value', TRUE);
    $this->EUI_Page->_setFieldCache('LIKE', 			 'USD4_filter_field', 	'USD4_filter_value', TRUE);
	
	// get order by if exist data pager 
	if( $out->find_value('order_by')){
		$this->EUI_Page->_setOrderBy( $out->field('order_by'), $out->field('type') );
	}
	else{
		$this->EUI_Page->_setOrderBy('a.FTP_UploadId','DESC');
	}
	// echo $this->EUI_Page->_getCompiler();
	// get data process limit OK 
	$this->EUI_Page->_setLimit();
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
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
function _aktivasi_row_upload_data( $URI = null ) {

// return data process 	
 if( !is_object($URI->dataURI) ){
	return false;
 }
 
 $this->dataNUM = 0;
 
 // get data result_array 
 $this->dataARR = $URI->dataURI->fields('UPL_UploadId');
 if( is_array( $this->dataARR ) )
   foreach( $this->dataARR as $key => $dataID  )
 {
	$this->db->reset_write();
	$this->db->set('FTP_Flags',$URI->dataURI->field('UPL_Flags') );
	$this->db->where('FTP_UploadId', $dataID);
	if( $this->db->update('t_gn_upload_report_ftp') ){
	    $this->dataNUM++;
	}
  } 	 
  
 // $this->dataNUM 
 return (int)$this->dataNUM;
}

/*
 * [Recovery data Delete]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
function _select_row_upload_data( $UploadId=null ) {
	
  $this->result_array = array();
  $sql = sprintf("select * from t_gn_upload_report_ftp where FTP_UploadId='%s'", $UploadId);
  $qry = $this->db->query( $sql );
  if( !$qry ){
	  exit( $sql );
  }
  
  // then will get data 
  if( $qry->num_rows() > 0 ){
	  $this->result_array = $qry->result_first_assoc();
  }
  // return data process "$this->result_array"
  return Objective( $this->result_array );	
} 

/*
 * [Recovery data Delete]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
function _delete_row_upload_data( $URI = null ) {
 if(!is_object($URI->dataURI )) {
	return false;
 }
 
 // ambil data upload id yang akan di delete .
 $this->num = 0;
 $result_row = $URI->dataURI->fields('UPL_UploadId');
  
 if( is_array( $result_row ) ) 
	foreach( $result_row as $key => $dataID )
 {
	
 // ambil data dari paling belakang . delete data dari process 
 // yang memiliki relasi Customer Data PORCESS Seperti 
 // data Customer dan CLosing like, This.
	
	$sql = sprintf("select a.DM_Id as CustomerId, a.DM_Custno as Custno, a.DM_UploadId as DM_UploadId
				    from t_gn_customer_master a where a.DM_UploadId =%s", $dataID);
					
	$qry = $this->db->query( $sql );
	if( $qry && $qry->num_rows() > 0 ) 
	foreach( $qry->result_record() as $row ){
		
		// delete history 
		$this->CustomerUpl = $row->field('DM_UploadId');
		$this->CustomerId  = $row->field('CustomerId');
		$this->CustomerNum = $row->field('Custno');
		
		
		// jika data bukan Customer data seperti Update Upload .
		$this->result_query = array(); 
		if( !$this->CustomerId ){
			continue;	
		}
		
		// jika process delete bertipe data yang memiliki relasi 
		// dengan table lain seperti berikut ini.
		
		$this->result_query[] = sprintf("delete from t_gn_callhistory where CustomerId='%s'", $this->CustomerId);
		$this->result_query[] = sprintf("delete from t_gn_verification_history where VH_Data_CustId='%s'", $this->CustomerId);
		$this->result_query[] = sprintf("delete from t_gn_customer_verification where CV_Data_CustId='%s'", $this->CustomerId);
		
		$this->result_query[] = sprintf("delete from t_gn_verification_session where VS_CustId='%s'", $this->CustomerId);
		$this->result_query[] = sprintf("delete from t_gn_selling_verification where SV_Cust_Id='%s'", $this->CustomerId);
		$this->result_query[] = sprintf("delete from t_gn_appoinment where CustomerId='%s'", $this->CustomerId);
		$this->result_query[] = sprintf("delete from t_gn_assignment where AssignCustId='%s'", $this->CustomerId);
		$this->result_query[] = sprintf("delete from t_gn_assignment_log where AssignCustId='%s'", $this->CustomerId);
		$this->result_query[] = sprintf("delete from t_gn_bucket_customers where AssignCustId='%s'", $this->CustomerId);
		
		// delete by custnum OK 
		$this->result_query[] = sprintf("delete from t_gn_frm_ntb where DB_CustNum='%s'",  $this->CustomerNum);
		$this->result_query[] = sprintf("delete from t_gn_frm_transaction_ntb where TR_CustomerNumber='%s'",  $this->CustomerNum);
		$this->result_query[] = sprintf("delete from t_gn_frm_transaction_xsell where TR_CustomerNumber='%s'", $this->CustomerNum);
		$this->result_query[] = sprintf("delete from t_gn_frm_usage where TX_Usg_Custno='%s'", $this->CustomerNum);
		$this->result_query[] = sprintf("delete from t_gn_customer_master where DM_Id='%s'", $this->CustomerId);
		$this->result_query[] = sprintf("delete from t_gn_bucket_customers where BM_FTP_UploadId='%s'", $this->CustomerUpl);
		
		// $this->result_query[] = sprintf("delete from t_gn_frm_addon where CustomerId='%s'", );
		// $this->result_query[] = sprintf("delete from t_gn_frm_xsell where CustomerId='%s'", );
		
		if(is_array($this->result_query))
		foreach( $this->result_query as $sql_key => $sql_str ){
			if( $this->db->query( $sql_str ) ){
				$this->num++;
			}
		}
	}
	
 // delete data yang memiliki relasi dengan upload process 
 // contohnya pada data update Refresh.
 
	$this->result_query = array();
	$this->result_query[] = sprintf("delete from t_gn_upload_refresh where UR_Data_UploadId='%s'", $dataID);
	if( is_array($this->result_query )) 
	foreach($this->result_query as $key => $sql_str ) {
		if( $this->db->query( $sql_str ) ){
			$this->num++;
		}
	}	
	
// delete from FTP Upload Process 
	$this->db->query(sprintf("delete from t_gn_upload_report_ftp 
							  where FTP_UploadId='%s'", $dataID));
	
 }	
 // return data proces OK 
 return (bool)$this->num;
}
 
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
// ================== END CLASS ===================

function _get_downloadcontent() {
	$_conds = array();
	
	$this->db->reset_select();
	$this->db->select("a.FTP_UploadId as UPL_UploadId, a.FTP_UploadId as UPL_DataID,a.FTP_Recsource as UPL_Recsource,a.FTP_UploadRows as UPL_UploadRows,
						a.FTP_UploadSuccess as UPL_UploadSuccess, a.FTP_UploadFailed as UPL_UploadFailed, a.FTP_UploadDuplicate as UPL_UploadDuplicate,
						a.FTP_UploadDateTs as UPL_UploadDateTs, a.FTP_UploadFilename as UPL_UploadFilename, a.FTP_UploadType as UPL_UploadType,
						a.FTP_UploadBy as UPL_UploadBy, a.FTP_Flags as UPL_Flags",FALSE );
	
	$this -> db ->from("t_gn_upload_report_ftp a"); 
	// $this -> db ->where("a.CustomerId", $CustomerId);
	if(_get_have_post('USD1_filter_value')){
		$this -> db ->like(_get_post('USD1_filter_field'), _get_post('USD1_filter_value'));
	}
	if(_get_have_post('USD2_filter_value')){
		$this -> db ->like(_get_post('USD2_filter_field'), _get_post('USD2_filter_value'));
	}
	if(_get_have_post('USD3_filter_value')){
		$this -> db ->like(_get_post('USD3_filter_field'), _get_post('USD3_filter_value'));
	}
	if(_get_have_post('USD4_filter_value')){
		$this -> db ->like(_get_post('USD4_filter_field'), _get_post('USD4_filter_value'));
	}
	$this -> db ->order_by("a.FTP_UploadId","DESC");
	// $this->db->print_out();
	$rs = $this->db->get();
	$i = 0;
	if( $rs -> num_rows() > 0 ) 
		foreach( $rs->result_assoc() as $rows )
	{
		$_conds[$i] = $rows; 
		$i++;
	}
	
	return (array)$_conds;
}

}

?>
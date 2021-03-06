<?php 

/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
class M_Rekontest2 extends EUI_Model{

 private static $params = null;

 
 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 private static $Instance   = null; 
 public static function &Instance() {
	if( is_null(self::$Instance) ){
		self::$Instance = new self();
	}	
	return self::$Instance;
}


/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
function __construct(){
 $this->load->model(array('M_UserRole','M_SysUser'));	
}	

/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */	
  
 function _select_page_like_data(  $field='', $opr ='', $route = null ) {
	 
	$this->arr_ptr = array('LIKE' => 'LIKE', 'NOT_LIKE' => 'NOT LIKE');
	$this->str_sql = null;
	$this->arr_sql = array();
	
	if( !is_array( $route )){
		$route = array( $route );
	}
	
// data propost data value query str .
	if( is_array( $route ) ) 
		foreach( $route as $key => $value )
	{
		// in array data findings 
		if( in_array( $opr, array_keys( $this->arr_ptr ) )){
			$this->arr_sql[] = sprintf("%s %s '%%%s%%' ", sprintf('b.%s', $field), $this->arr_ptr[$opr], trim($value));
		}		
	}
	
	// jika data koong 
	if( count($this->arr_sql) == 0  ){
		return FALSE;
	}	
	
	// jika matching data process 
	$this->str_sql = sprintf(" ( %s ) ", join(' OR ', $this->arr_sql));
	if( !strcmp( $opr, 'NOT_LIKE') )  {
		$this->str_sql = sprintf(" ( %s ) ", join(' AND ', $this->arr_sql) ); // " ( ".  ." ) ";
	} 
	// return data join compile 
	return $this->str_sql;
} 

/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */	
 function _select_page_field_data( $UserGroup  = 0 ){
	
	//var_dump($UserGroup);
	$this->result_field = false;
 // USER_ADMIN or USER_ROOT 
	if( in_array($UserGroup,  array( USER_ROOT, USER_ADMIN))) {
		$this->result_field = sprintf('a.%s', 'AssignAdmin');
	}	
	
 // USER_GENERAL_MANAGER  
	if( in_array($UserGroup,  array( USER_GENERAL_MANAGER ))){
		$this->result_field = sprintf('a.%s', 'AssignAmgr');
	}	
	
 // USER_MANAGER OR USER_ACCOUNT_MANAGER
	if( in_array($UserGroup,  array(USER_MANAGER, USER_ACCOUNT_MANAGER))){
		$this->result_field = sprintf('a.%s', 'AssignMgr');
	}	
 // USER_SUPERVISOR
	if( in_array($UserGroup,  array(USER_SUPERVISOR))){
		$this->result_field = sprintf('a.%s', 'AssignSpv');
	}
 // USER_LEADER
	if( in_array($UserGroup,  array(USER_LEADER))){
		$this->result_field = sprintf('a.%s', 'AssignLeader');
	}
	
// admin followup -- USER_ADMIN_FOLLOWUP
	if( in_array($UserGroup,  array( USER_QUALITY,  USER_ADMIN_FOLLOWUP, 
									 USER_QUALITY_ANALYST,  USER_QUALITY_ADMIN ))){
		$this->result_field =  false;
	}
	
 // USER_AGENT_OUTBOUND AND USER_AGENT_INBOUND
	if( in_array($UserGroup,  array(USER_AGENT_OUTBOUND, USER_AGENT_INBOUND))){
		$this->result_field =  sprintf('a.%s', 'AssignSelerId');
	}
	// return data .
	//var_dump($this->result_field);
	return $this->result_field;
 } 
  
/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
 
 function _select_count_rekontest( $out  = null  )
{
	
// tankap semua varibale dari process search 
  $this->out = $out;
  $this->cok = CK();
  $this->cof = CF();
  
 // define all variable $ar_call_not_interest = array_keys(CallResultInterest());	
  $result_total = array();
  
// inull then get default ----------------
 $this->db->reset_select();
 $this->db->select('count(a.AssignId) as total', false);
 $this->db->from("t_gn_assignment a");
 $this->db->join("t_gn_customer_master b "," a.AssignCustId=b.DM_Id", "LEFT");
 $this->db->join("t_gn_campaign c "," b.DM_CampaignId =c.CampaignId", "LEFT");
 $this->db->where("a.AssignBlock", 0);

 // ini berlaku hanya untuk kondisi tertentu.
  $this->db->where_not_in('b.DM_CallCategoryId', array( NSTS,CLOS, RDPC, APRV, YCOM, NCOM,RJCK));
 
 // filter expired data customer expired data 
 
 //$this->db->where( sprintf("b.DM_DateExpired>='%s'", date('Y-m-d')), "", FALSE);
 $this->db->where( sprintf("c.CampaignEndDate>='%s'", date('Y-m-d')), "", FALSE);
  
 // filter data yang pertama by campaign 
 if( $this->out->find_value('frmrek_from_campaignid') ){
	$this->db->where_in("b.DM_CampaignId", $this->out->fields('frmrek_from_campaignid'));
 }
 
 // filter by recsource jika memang ada 
 if( $this->out->find_value('trans_from_recsource') ){
	$this->db->where_in("b.DM_Recsource", $this->out->fields('trans_from_recsource'));
 }	 
 // tanggal update di customer jika sudah ada .
 if( $this->out->find_value('frmrek_from_updatets_start_date') ){
	$this->db->where(sprintf("b.DM_UpdatedTs>='%s 00:00:00'", $this->out->field('frmrek_from_updatets_start_date', 'SetDate')), "", FALSE );
 }
 if( $this->out->find_value('frmrek_from_updatets_end_date') ){
	$this->db->where(sprintf("b.DM_UpdatedTs<='%s 23:59:59'", $this->out->field('frmrek_from_updatets_end_date', 'SetDate')), "", FALSE );
 }
 
 // filter by CallStatus / Call Kategory ID 
 // call category status In "Selller" 
 if( $this->out->find_value('frmrek_from_callstatus') ){
	$this->db->where_in("b.DM_CallCategoryId", $this->out->fields('frmrek_from_callstatus'));
 }
 
 // call reason  status In "Selller"
 if( $this->out->find_value('frmrek_from_reasonstatus') ){
	$this->db->where_in("b.DM_CallReasonId", $this->out->fields('frmrek_from_reasonstatus'));
 }
 
 // get data user handler on this assign 
 // on filter process .
 if( $this->out->find_value('frmrek_from_usergroup') ){
	// check data process 
	$this->str_where = $this->_select_page_field_data($this->out->field('frmrek_from_usergroup'));
	if( !is_bool( $this->str_where ) 
	and count($this->out->fields('frmrek_from_userlist-html')) ) {
		$this->db->where_in($this->str_where,  $this->out->fields('frmrek_from_userlist-html', 'intval'));
	}	
 }
  
	// frmrek_from_ages_start 
	if( $this->out->find_value('frmrek_from_ages_start' ) ) {
		$this->db->where(sprintf("b.DM_Age>=%d", $this->out->field('frmrek_from_ages_start')), "", FALSE );
	}
	 
	// frmrek_from_ages_stop 
	if( $this->out->find_value('frmrek_from_ages_stop' ) ) {
		$this->db->where(sprintf("b.DM_Age<=%d", $this->out->field('frmrek_from_ages_stop')), "", FALSE );
	}


	// frmrek_from_availss_start 
	if( $this->out->find_value('frmrek_from_availss_start' ) ) {
		$this->db->where(sprintf("b.DM_DataAvailSS>=%d", $this->out->field('frmrek_from_availss_start')), "", FALSE );
	}
	
	// frmrek_from_availss_stop 
	if( $this->out->find_value('frmrek_from_availss_stop' ) ) {
		$this->db->where(sprintf("b.DM_DataAvailSS<=%d", $this->out->field('frmrek_from_availss_stop')), "", FALSE );
	}

	 
	// frmrek_from_kreditlimit_start 
	if( $this->out->find_value('frmrek_from_kreditlimit_start' ) ) {
		$this->db->where(sprintf("b.DM_CrLimit>=%d", $this->out->field('frmrek_from_kreditlimit_start')), "", FALSE );
	}            

	// frmrek_from_kreditlimit_stop 
	if( $this->out->find_value('frmrek_from_kreditlimit_stop' ) ) {
		$this->db->where(sprintf("b.DM_CrLimit<=%d", $this->out->field('frmrek_from_kreditlimit_stop')), "", FALSE );
	}            
	 
 // field filter data process "TRANS_FIELD_VALUE1"
 
 if( $this->out->field('frmrek_from_value1') ){
	// check jika false gak usah  
	$this->db->where($this->_select_page_like_data( $this->out->field('frmrek_from_value1'), 
													$this->out->field('frmrek_from_field1'),
													$this->out->fields('frmrek_from_field2')), '', FALSE );
								   
 }
 
 // filter step ke - 2 by Session User Login  
 if( !strcmp( $this->cok->field('HandlingType'), USER_ROOT) ){
	$this->db->where_in('a.AssignAdmin', $this->cof->field('default_admin'));
} 
 
 // jika admin ambil semua data yang ada .
 if( !strcmp( $this->cok->field('HandlingType'), USER_ADMIN) ){
	$this->db->where('( a.AssignAmgr<>0  OR a.AssignMgr <> 0  OR a.AssignSpv <> 0 
						OR a.AssignLeader <> 0  OR a.AssignSelerId <> 0 )', '', false);
 } 
 
 // jika admin ambil semua data yang ada .
 if( !strcmp( $this->cok->field('HandlingType'), USER_GENERAL_MANAGER) ){
	$this->db->where('a.AssignAmgr',  $this->cok->field('UserId'));
	$this->db->where('( a.AssignMgr <> 0  OR a.AssignSpv <> 0 OR a.AssignLeader <> 0  OR a.AssignSelerId <> 0 )',  '', false);
 } 
 
 // jika admin ambil semua data yang ada .
 if( @in_array($this->cok->field('HandlingType'), array(USER_MANAGER, USER_ACCOUNT_MANAGER) )) {
	$this->db->where(sprintf( "(a.AssignAmgr='%d' OR a.AssignMgr='%d')",  $this->cok->field('GenaralManagerId'), $this->cok->field('UserId') ), '', false);
	$this->db->where('( a.AssignSpv <> 0 OR a.AssignLeader <> 0 OR a.AssignSelerId <> 0 )', '', false);
 }

 // jika admin ambil semua data yang ada .
 if( !strcmp( $this->cok->field('HandlingType'), USER_SUPERVISOR) ){
	$this->db->where('a.AssignSpv', $this->cok->field('UserId'));
	$this->db->where('( a.AssignLeader <> 0  OR a.AssignSelerId <> 0)', '', false);
 }
 
  // jika admin ambil semua data yang ada .
 if( !strcmp( $this->cok->field('HandlingType'), USER_LEADER) ){
	$this->db->where('a.AssignLeader', $this->cok->field('UserId'));
	$this->db->where('a.AssignSelerId<>0',  '', false);
 }
 
 
 // jika admin ambil semua data yang ada .
 if( !strcmp( $this->cok->field('HandlingType'), USER_AGENT_INBOUND) ){
	$this->db->where('a.AssignSelerId', $this->cok->field('UserId')); 
 } 
 
 // jika admin ambil semua data yang ada .
 if( !strcmp( $this->cok->field('HandlingType'), USER_AGENT_OUTBOUND) ){
	$this->db->where('a.AssignSelerId', $this->cok->field('UserId')); 
 } 
  
 
// cetak untuk debugging saja .
//  $this->db->print_out();
  $qry = $this->db->get();
 
 // jika terjadi error maka tampilkan errornya 
 if( !$qry ){
	 debug( $this->db->_error_message() ); 
 }
 
 // ambil query dataprocess result OK 
 if( $qry && $qry->num_rows() > 0 ){
	$result_total = (int)$qry->result_singgle_value();
  }
  return (int)$result_total;
} 


/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
 
 function _select_pager_rekontest( $out  = null, $field = null, $std = null )
{
	
// tankap semua varibale dari process search 
  $this->out = $out;
  $this->cok = CK();
  $this->cof = CF();

 // define all variable $ar_call_not_interest = array_keys(CallResultInterest());	
  $result_array = array();
  
// inull then get default ----------------
 
 $this->db->reset_select();
 if( is_null($field)) {
	 
	$this->db->select('
		a.AssignId 				AS RekontestId,  
		b.DM_Custno 			AS DM_Custno,
		b.DM_FirstName 			AS DM_FirstName,
		b.DM_CampaignId 		AS DM_CampaignId, 
		b.DM_MotherName 		AS DM_MotherName,
		b.DM_Dob 				AS DM_Dob,
		b.DM_Age 				AS DM_Age,
		b.DM_CrLimit 			AS DM_CrLimit,
		b.DM_CcLimit 			AS DM_CcLimit,
		b.DM_DataAvailSS        AS DM_DataAvailSS,
		b.DM_CcTypeName 		AS DM_CcTypeName,
		b.DM_GenderId 			AS DM_GenderId,
		b.DM_AddressLine1 		AS DM_AddressLine1,
		b.DM_AddressLine2 		AS DM_AddressLine2,
		b.DM_AddressLine3 		AS DM_AddressLine3,
		b.DM_AddressLine4 		AS DM_AddressLine4,
		b.DM_HomePhoneNum 		AS DM_HomePhoneNum,
		b.DM_MobilePhoneNum 	AS DM_MobilePhoneNum,
		b.DM_OtherPhoneNum 		AS DM_OtherPhoneNum,
		b.DM_OfficeName 		AS DM_OfficeName,
		b.DM_CallReasonId 		AS DM_CallReasonId,
		b.DM_CallCategoryId 	AS DM_CallCategoryId,
		b.DM_CallReasonId 		AS DM_CallReasonId,
		b.DM_LastCategoryKode 	AS DM_LastCategoryKode,
		b.DM_LastReasonKode 	AS DM_LastReasonKode,
		b.DM_Dob 				AS DM_Dob, 
		b.DM_SellerId 			AS DM_SellerId,
		b.DM_SellerKode 		AS DM_SellerKode,
		b.DM_City 				AS DM_City, 
		a.AssignMode 			as DM_Assign_Mode,
		a.AssignDate 			AS DM_AssignDateTs,
		b.DM_UpdatedTs 			AS DM_UpdatedTs', 
		
		FALSE); 
 } else {
	$this->db->select($field, FALSE); 
 }
 
 $this->db->from("t_gn_assignment a");
 $this->db->join("t_gn_customer_master b "," a.AssignCustId=b.DM_Id", "LEFT");
 $this->db->join("t_gn_campaign c "," b.DM_CampaignId =c.CampaignId", "LEFT");
 $this->db->where("a.AssignBlock", 0);
 
 // ini berlaku hanya untuk kondisi tertentu.
  $this->db->where_not_in('b.DM_CallCategoryId', array( NSTS,CLOS, RDPC, APRV, YCOM, NCOM,RJCK));
 
 // filter expired data customer expired data 
 
 // $this->db->where( sprintf("b.DM_DateExpired>='%s'", date('Y-m-d')), "", FALSE);
 $this->db->where( sprintf("c.CampaignEndDate>='%s'", date('Y-m-d')), "", FALSE);
  
 // filter data yang pertama by campaign 
 if( $this->out->find_value('frmrek_from_campaignid') ){
	$this->db->where_in("b.DM_CampaignId", $this->out->fields('frmrek_from_campaignid'));
 }
 
 // filter by recsource jika memang ada 
 if( $this->out->find_value('trans_from_recsource') ){
	$this->db->where_in("b.DM_Recsource", $this->out->fields('trans_from_recsource'));
 }	 
 // tanggal update di customer jika sudah ada .
 if( $this->out->find_value('frmrek_from_updatets_start_date') ){
	$this->db->where(sprintf("b.DM_UpdatedTs>='%s 00:00:00'", $this->out->field('frmrek_from_updatets_start_date', 'SetDate')), "", FALSE );
 }
 if( $this->out->find_value('frmrek_from_updatets_end_date') ){
	$this->db->where(sprintf("b.DM_UpdatedTs<='%s 23:59:59'", $this->out->field('frmrek_from_updatets_end_date', 'SetDate')), "", FALSE );
 }
 
 // filter by CallStatus / Call Kategory ID 
 // call category status In "Selller" 
 if( $this->out->find_value('frmrek_from_callstatus') ){
	$this->db->where_in("b.DM_CallCategoryId", $this->out->fields('frmrek_from_callstatus'));
 }
 
 // call reason  status In "Selller"
 if( $this->out->find_value('frmrek_from_reasonstatus') ){
	$this->db->where_in("b.DM_CallReasonId", $this->out->fields('frmrek_from_reasonstatus'));
 }
 
 // get data user handler on this assign 
 // on filter process .
 if( $this->out->find_value('frmrek_from_usergroup') ){
	// check data process 
	$this->str_where = $this->_select_page_field_data($this->out->field('frmrek_from_usergroup'));
	if( !is_bool( $this->str_where ) 
	and count($this->out->fields('frmrek_from_userlist-html')) ) {
		$this->db->where_in($this->str_where,  $this->out->fields('frmrek_from_userlist-html', 'intval'));
	}	
 }
  
 // frmrek_from_ages_start 
 if( $this->out->find_value('frmrek_from_ages_start' ) ) {
 	$this->db->where(sprintf("b.DM_Age>=%d", $this->out->field('frmrek_from_ages_start')), "", FALSE );
 }
  
 // frmrek_from_ages_stop 
 if( $this->out->find_value('frmrek_from_ages_stop' ) ) {
 	$this->db->where(sprintf("b.DM_Age<=%d", $this->out->field('frmrek_from_ages_stop')), "", FALSE );
 }
 
 
 // frmrek_from_availss_start 
 if( $this->out->find_value('frmrek_from_availss_start' ) ) {
 	$this->db->where(sprintf("b.DM_DataAvailSS>=%d", $this->out->field('frmrek_from_availss_start')), "", FALSE );
 }
 
 // frmrek_from_availss_stop 
 if( $this->out->find_value('frmrek_from_availss_stop' ) ) {
 	$this->db->where(sprintf("b.DM_DataAvailSS<=%d", $this->out->field('frmrek_from_availss_stop')), "", FALSE );
 }
 
  
 // frmrek_from_kreditlimit_start 
 if( $this->out->find_value('frmrek_from_kreditlimit_start' ) ) {
 	$this->db->where(sprintf("b.DM_CrLimit>=%d", $this->out->field('frmrek_from_kreditlimit_start')), "", FALSE );
 }            
 
 // frmrek_from_kreditlimit_stop 
 if( $this->out->find_value('frmrek_from_kreditlimit_stop' ) ) {
 	$this->db->where(sprintf("b.DM_CrLimit<=%d", $this->out->field('frmrek_from_kreditlimit_stop')), "", FALSE );
 }            
  
 // field filter data process "TRANS_FIELD_VALUE1"
 
 if( $this->out->field('frmrek_from_value1') ){
	// check jika false gak usah  
	$this->db->where($this->_select_page_like_data( $this->out->field('frmrek_from_value1'), 
													$this->out->field('frmrek_from_field1'),
													$this->out->fields('frmrek_from_field2')), '', FALSE );
								   
 }
 
 // filter step ke - 2 by Session User Login  
 if( !strcmp( $this->cok->field('HandlingType'), USER_ROOT) ){
	$this->db->where_in('a.AssignAdmin', $this->cof->field('default_admin'));
  } 
 
 // jika admin ambil semua data yang ada .
 if( !strcmp( $this->cok->field('HandlingType'), USER_ADMIN) ){
	$this->db->where('( a.AssignAmgr<>0  OR a.AssignMgr <> 0  OR a.AssignSpv <> 0 
						OR a.AssignLeader <> 0  OR a.AssignSelerId <> 0 )', '', false);
 } 
 
 // jika admin ambil semua data yang ada .
 if( !strcmp( $this->cok->field('HandlingType'), USER_GENERAL_MANAGER) ){
	$this->db->where('a.AssignAmgr',  $this->cok->field('UserId'));
	$this->db->where('( a.AssignMgr <> 0  OR a.AssignSpv <> 0 OR a.AssignLeader <> 0  OR a.AssignSelerId <> 0 )',  '', false);
 } 
 
 // jika admin ambil semua data yang ada .
 if( @in_array($this->cok->field('HandlingType'), array(USER_MANAGER, USER_ACCOUNT_MANAGER) )) {
	$this->db->where(sprintf( "(a.AssignAmgr='%d' OR a.AssignMgr='%d')",  $this->cok->field('GenaralManagerId'), $this->cok->field('UserId') ), '', false);
	$this->db->where('( a.AssignSpv <> 0 OR a.AssignLeader <> 0 OR a.AssignSelerId <> 0 )', '', false);
 }

 // jika admin ambil semua data yang ada .
 if( !strcmp( $this->cok->field('HandlingType'), USER_SUPERVISOR) ){
	$this->db->where('a.AssignSpv', $this->cok->field('UserId'));
	$this->db->where('( a.AssignLeader <> 0  OR a.AssignSelerId <> 0)', '', false);
 }
 
  // jika admin ambil semua data yang ada .
 if( !strcmp( $this->cok->field('HandlingType'), USER_LEADER) ){
	$this->db->where('a.AssignLeader', $this->cok->field('UserId'));
	$this->db->where('a.AssignSelerId<>0',  '', false);
 }
 
 
 // jika admin ambil semua data yang ada .
 if( !strcmp( $this->cok->field('HandlingType'), USER_AGENT_INBOUND) ){
	$this->db->where('a.AssignSelerId', $this->cok->field('UserId')); 
 } 
 
 // jika admin ambil semua data yang ada .
 if( !strcmp( $this->cok->field('HandlingType'), USER_AGENT_OUTBOUND) ){
	$this->db->where('a.AssignSelerId', $this->cok->field('UserId')); 
 } 
  
  
// order di sesuiakna dengan field yang di sorting oleh 
// user di client.

 if( $this->out->find_value("orderby") ){
	$this->db->order_by($this->out->field("orderby"), $this->out->field("type") );
 } else {
	$this->db->order_by("a.AssignId", "DESC");
 }
 // echo "<pre>".$this -> db -> _get_var_dump()."</pre>";

 // query limit untuk page langsung di tuju ke query 
 // selector saja , untuk performance data ketika 
 // user melakukan select data .
 
 if( is_object( $std ) ) {
	if( $std->result_posted ) {
		$std->start_page = (($std->result_posted-1)*$std->per_page);
	} 
	else {	
		$std->start_page = 0;
	}
	
	// set on limite data 
	$this->db->limit( $std->per_page, $std->start_page);
 }
	
	
 
 
// cetak untuk debugging saja .
// echo "<pre>".$this->db->print_out()."</pre>";

  $qry = $this->db->get();
  if( !$qry ){
	 debug( $this->db->_error_message() ); 
  }
 
 // ambil query dataprocess result OK 
 if( $qry && $qry->num_rows() > 0 ){
	$result_array = (array)$qry->result_assoc();
  }
  return (array)$result_array;
} 
  

/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */

	
// end class process 	
}
?>
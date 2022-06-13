<?php 

 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 class M_ModCallHistory extends EUI_Model
{

 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 
private static $Instance  = null;	
	
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 function __construct()
{ 
	$this->load->model(array('M_MaskingNumber'));
}

 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 public static function &Instance()
{
	if( is_null(self::$Instance) )
 {
	self::$Instance = new self();
 }
  return  self::$Instance;
 
}

 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 
function _select_page_quality_call_history( $out  = null )
{
	
  
   $arr_call_history = array();
  
   if( !$out->fetch_ready()) 
  { 
	return (array)$arr_call_history;
  }
  
  $this->db->reset_select();
  $this->db->select("	
		IF( a.HistoryType IN(0,3,4), (select  lsb.CallReasonCategoryName  from t_lk_callreason lsa  inner join t_lk_callreasoncategory lsb  on lsa.CallReasonCategoryId=lsb.CallReasonCategoryId where lsa.CallReasonId =a.CallReasonId ),'Other Activity') as CallReasonCategoryName,
		IF( a.HistoryType IN(0,3,4), (select cs.CallReasonDesc from t_lk_callreason cs where cs.CallReasonId = a.CallReasonId), IF( a.HistoryType=2, (select a.ConfigName from t_lk_configuration a where a.ConfigValue=a.CallReasonId and a.ConfigCode='CHANGE_STATUS'), 'QA Activity')) as CallReasonDesc,
		a.CallHistoryCreatedTs,
		b.init_name as full_name,
		a.CallNumber,
		e.AproveName,
		a.CallHistoryNotes,
		f.History_Type_Name as CallHistoryType ", 
  FALSE);
  $this->db->from('t_gn_callhistory a');
  $this->db->join('tms_agent b','a.CreatedById=b.UserId','left');
  $this->db->join('t_lk_callreason c','a.CallReasonId=c.CallReasonId','left');
  $this->db->join('t_lk_callreasoncategory d','c.CallReasonCategoryId=d.CallReasonCategoryId','left');
  $this->db->join('t_lk_aprove_status e','a.ApprovalStatusId=e.ApproveId','left');
  $this->db->join('t_lk_history_type f','a.HistoryType=f.History_Type_Code','left');
  $this->db->where('a.CustomerId', $out->get_value('CustomerId') );
  
 if( _get_have_post("orderby") ){
	$this->db->order_by(_get_post("orderby"), _get_post("type"));
  } else {
	$this->db->order_by("a.CallHistoryId", "DESC");
  }
 
  $rs = $this->db->get();
  if( $rs->num_rows() > 0 ){
	  $arr_call_history = (array)$rs->result_assoc();
  }
  return (array)$arr_call_history;
  
}
	
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
function _select_page_call_history( $out = null )
{
  $cok = &CK();
  // echo USAGE;
  $result_array = array();
  if( !is_object($out ) )  { 
	return (array)$result_array;
  }
  
  // reset cache select data array.
  $this->db->reset_select();
  $this->db->select("a.DM_CampaignId", FALSE);
  $this->db->from("t_gn_customer_master a");
  $this->db->where("a.DM_Id", $out->field('CustomerId'));
  $qrys = $this->db->get();
  if( $qrys && $qrys->num_rows() > 0 ){
	  $result_arrays = (array)$qrys->result_assoc();
  }
  $cmpid = $result_arrays;
   // echo $this->db->print_out();
  // print_r($cmpid);
  
  // a.CallNumber as HS_Call_PhoneNum,	
  $this->db->reset_select();
  $this->db->select("a.CallHistoryId as HS_Call_Id, 
					 a.CallHistoryCreatedTs as HS_Call_CreateDateTs,
					 a.CallCategoryId as HS_Call_CategoryId,
					 a.CallReasonId as HS_Call_ReasonId,
					 if(b.handling_type != 4, '', a.CreatedById ) as HS_Call_UserId,
					 a.CallHistoryNotes as HS_Call_Remarks",  
			FALSE);
  $this->db->from('t_gn_callhistory a');
  $this->db->join('tms_agent b', 'a.CreatedById=b.UserId', 'LEFT');
  $this->db->where("a.CustomerId", $out->field('CustomerId'));
  
  // if data agent_id 
  if( !strcmp( $cok->field('HandlingType'), USER_AGENT_OUTBOUND) ){
	 
    $users_id = $cok->field('UserId');
	
	if($cmpid['DM_CampaignId'] == USAGE){
		$where_in = SetWhereIn(array( USER_ROOT, 
								  USER_ADMIN,
								  USER_GENERAL_MANAGER,
								  USER_MANAGER,
								  USER_ACCOUNT_MANAGER,
								  USER_SUPERVISOR,
								  USER_LEADER ), 1);
	}else{
		$where_in = SetWhereIn(array( USER_AGENT_OUTBOUND,
								  USER_ADMIN,
								  USER_GENERAL_MANAGER,
								  USER_MANAGER,
								  USER_ACCOUNT_MANAGER,
								  USER_SUPERVISOR,
								  USER_LEADER,
								  USER_QUALITY_STAFF,
								  USER_QUALITY_ADMIN), 1);
	}
								  
	// Edit by Aan (8 Januari 2018)
	// Call history cuma dia yg liat
	// $where_in = SetWhereIn(array( USER_AGENT_OUTBOUND), 1);
												  
	$this->db->where(sprintf("( b.handling_type IN(%s))", $where_in), '', false);
	
  }
  
  // order by on page 
  if( $out->find_value("orderby") ){
	 $this->db->order_by($out->field("orderby"), $out->field("type"));
  } else {
	 $this->db->order_by("a.CallHistoryId", "DESC");
  }
  
 // echo $this->db->print_out();
   
  $qry = $this->db->get();
  if( $qry && $qry->num_rows() > 0 ){
	  $result_array = (array)$qry->result_assoc();
  }
  return (array)$result_array;

}



// -----------------------------------------------------------

/* 
 * Method     AddUser 
 *
 * @pack    wellcome on eui first page 
 * @param   testing all 
 */
function _select_page_quality_callmon_history( $out = null )
{
  /**
select 
a.DateCreateTs as DateCallmon ,  
a.Enter_New_Score as TotalScore , 
a.Status_Callmon as StatusCallmon  ,
b.CustomerFirstName as CustomerName , 
c.code_user as CodeUser, 
d.name as Privilege
from t_gn_score_result a
inner join t_gn_customer b on a.CustomerId=b.CustomerId
left join tms_agent c on a.CreateById=c.UserId
left join tms_agent_profile d on c.profile_id=d.id
where a.CustomerId=400;
   */
   $arr_callmon_history = array();
  
   if( !$out->fetch_ready()) 
  { 
  return (array)$arr_callmon_history;
  }
  
  $this->db->reset_select();
  $this->db->select(" 
      a.DateCreateTs as DateCallmon ,  
      a.Enter_New_Score as TotalScore , 
      a.Status_Callmon as StatusCallmon  ,
      b.CustomerFirstName as CustomerName , 
      c.code_user as CodeUser, 
      d.name as Privilege" , FALSE);
  $this->db->from('t_gn_score_result a');
  $this->db->join('t_gn_customer b','a.CustomerId=b.CustomerId','inner');
  $this->db->join('tms_agent c','a.CreateById=c.UserId','left');
  $this->db->join('tms_agent_profile d','c.profile_id=d.id','left');
  $this->db->where('a.CustomerId', $out->get_value('CustomerId') );
  
 if( _get_have_post("orderby") ){
  $this->db->order_by(_get_post("orderby"), _get_post("type"));
  } else {
  $this->db->order_by("a.DateCreateTs", "DESC");
  }
 
  $rs = $this->db->get();
  if( $rs->num_rows() > 0 ){
    $arr_callmon_history = (array)$rs->result_assoc();
  }
  return (array)$arr_callmon_history;

}

	
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
function _select_page_recording( $out = null )
{
  
  // check apakah data tersebut berisi array 
  $this->result_array = array();
  $this->CustomerId = $out->field('CustomerId');
  if( !$this->CustomerId ){ 
	return $this->result_array;
  }
  
  // a.anumber AS VLS_Call_Number, 
 // reset select sebelum melakukan query data 
  $this->db->reset_select();
  $this->db->select(" a.id AS VLS_Id, 
					  a.file_voc_name AS VLS_File_Name, 
					  a.start_time AS VLS_Start_Time, 
					  a.duration AS VLS_Duration_Time, 
					  a.file_voc_size AS VLS_Voice_Size, 
					  b.name AS VLS_User_Id, 
					  a.id AS VLS_Button_Id ", FALSE);
	
  $this->db->from("cc_recording a");
  $this->db->join("cc_agent b ","a.agent_id=b.id","LEFT");
  $this->db->where("a.assignment_data", $out->field('CustomerId'));
  
  // check data order process 
  if( $out->find_value("orderby") ){
	$this->db->order_by( $out->field("orderby"), $out->field("type") );
  } else {
	$this->db->order_by("a.id", "DESC");
  }
  
  //echo $this->db->_get_var_dump();
  $rs = $this->db->get();
  if( $rs->num_rows() > 0 ){
	$this->result_array = $rs->result_assoc();
  }
  return $this->result_array;
}

 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 public function _select_page_address( $out = null )
{
	$arr_address = array(); // default data 
  if( !$out->fetch_ready() ){ 
	return (array)$arr_address; 
  }
   
 // ---------- kep data on parameter -----------------------
 
    $ProvinceId = (int)$out->get_value('ProvinceId');
    $Keyword = $out->get_value('keyword');
 
// ------------------ default spelect ---------------------- 
    $this->db->reset_select();
    $this->db->select(" a.ZipId, a.ZipCode, a.ZipProvinceId, b.Province,
					   a.ZipKelurahan, a.ZipKecamatan, a.ZipDT, a.ZipKotaKab", FALSE);
					   
	$this->db->from("t_lk_zip a ");
	$this->db->join("t_lk_province b "," a.ZipProvinceId = b.ProvinceId", "LEFT");
	$this->db->where("a.ZipProvinceId", $ProvinceId);
	$this->db->where("( 
			a.ZipCode REGEXP ('^$Keyword') 
			OR a.ZipKelurahan REGEXP ('^$Keyword') 
			OR a.ZipKecamatan REGEXP ('^$Keyword')
			OR a.ZipKotaKab REGEXP ('^$Keyword') )", "", FALSE);
	
	
// ----------- order by selected --------------	
  if( _get_have_post("orderby") ){
		$this->db->order_by(_get_post("orderby"), _get_post("type"));
   } else {
		$this->db->order_by('a.ZipKelurahan','ASC');
   }
   
 // ------ if have post limited ------------
  if( _get_have_post('limit') ) {
	$this->db->limit(_get_post('limit'));
  }	
  
  //$this->db->limit(10);
   
  $rs  = $this->db->get();
  if( $rs->num_rows() > 0 ) {
	$arr_address = $rs->result_assoc();
  }
  
  return (array)$arr_address;
}  
  
// =================== END CLASS ============================
}
?>

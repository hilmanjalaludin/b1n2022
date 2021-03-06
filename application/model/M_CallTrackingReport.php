<?php

class M_CallTrackingReport extends EUI_Model
{

/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	 
 
 private static $Instance   = null; 
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
	$this->load->model(array('M_Report','M_SetCampaign','M_SysUser','')); 
}


/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	 
function _select_report_notes()
{
	$this->notes = array();
	$sql = "select b.CallReasonCategoryName,  a.CallReasonCode, a.CallReasonDesc from t_lk_callreason a 
		left join t_lk_callreasoncategory b on a.CallReasonCategoryId  = b.CallReasonCategoryId
		where a.CallReasonStatusFlag = 1 and a.CallReasonCategoryId <> 9
		order by a.CallReasonCode ASC ";
	
	$rs = $this->db->query($sql);
	  if( $rs->num_rows() ) 
		  foreach( $rs->result_assoc() as $row ) 
	{
		$this->notes[] = $row;
	 }
	  
	 return $this->notes;
}

/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	 
function _select_report_notification()
{
	$this->notification = array(
		array("note" => "New Assigned", "desc" => "New Database upload"),
		array("note" => "Re Assigned", "desc" => "Database Recycle bucket"),
		array("note" => "Solicited New Assigned", "desc" => "Solicited New Database"),
		array("note" => "Solicited Reutilized", "desc" => "Solicited Recycle Database"),
		array("note" => "Total Solicited / Utilized", "desc" => "Solicited New Database + Recycle Database"),
		array("note" => "NOS", "desc" => "Number Of Sales (Number Of Insured)")
	);
	
	return $this->notification;
}

/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	 
 public function _select_report_manager( $Manger = 0 ) 
{
 
 $this->manager = array();
 
 $gHandle = _get_session('HandlingType');
 $gUserId = _get_session('UserId');
 
 if( in_array($gHandle, 
   array(USER_ROOT, USER_ADMIN, USER_ADMIN, USER_UPLOADER) ) )
 {
	$sql = sprintf("select a.UserId, a.id, a.full_name 
					from tms_agent a  where a.handling_type = %d and a.user_state=1", 
					USER_GENERAL_MANAGER);
			
			
 }
 
 // USER_MANAGER, USER_ACCOUNT_MANAGER 
 if( in_array($gHandle, array(USER_MANAGER, USER_ACCOUNT_MANAGER) ) ) {
	$sql = sprintf("select a.UserId, a.id, a.full_name from tms_agent a 
					where a.handling_type = %d and a.UserId='$gUserId' 
					and a.user_state=1", 
					USER_GENERAL_MANAGER); 
 }
 
 // USER_SUPERVISOR 
 if( in_array($gHandle, array(USER_SUPERVISOR) ) ) {
	$sql = sprintf("select a.UserId, a.id, a.full_name from tms_agent a  
					where a.handling_type = %d and a.UserId IN (
					select cs.act_mgr  from tms_agent cs 
					where cs.UserId = $gUserId ) and a.user_state=1", 
					USER_GENERAL_MANAGER);
 }
 
 // USER_LEADER 
  if( in_array($gHandle, array(USER_LEADER) )) {
	$sql = sprintf("select a.UserId, a.id, a.full_name from tms_agent a  
					where a.handling_type = %d and a.UserId IN (
					select cs.act_mgr from tms_agent cs 
					where cs.UserId = $gUserId ) and a.user_state=1", 
					USER_GENERAL_MANAGER);
 }
 
 
 $qry = $this->db->query($sql);
 if( $qry && $qry->num_rows() ) 
 foreach( $qry->result_record() as $row )  {
	$this->manager[$row->field('UserId')] = sprintf('%s - %s', $row->field('id', 'SetCapital'), 
														$row->field('full_name', 'SetCapital') );
 }
  
 return $this->manager;
 
}

/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	 
 public function _select_report_atm( $Atm = 0 ) 
{
 
 $this->atm = array();
 
 $gHandle = _get_session('HandlingType');
 $gUserId = _get_session('UserId');
 
 if( in_array($gHandle, 
   array(USER_ROOT, USER_ADMIN, USER_ADMIN, USER_UPLOADER) ) )
 {
	$sql = "select a.UserId, a.id from tms_agent a where a.handling_type =". USER_ACCOUNT_MANAGER ."
			and a.user_state=1 "; 
 }
 
 
 if( in_array($gHandle, 
   array(USER_MANAGER, USER_ACCOUNT_MANAGER) ) )
 {
	$sql = "select a.UserId, a.id  from tms_agent a 
			where a.handling_type =". USER_ACCOUNT_MANAGER ." 
			and a.act_mgr IN (
			select cs.act_mgr  from tms_agent cs  
			where cs.UserId='$gUserId' ) and a.user_state=1"; 
 }
 
 if( in_array($gHandle, 
   array(USER_SUPERVISOR) ) )
 {
	$sql = "select a.UserId, a.id  from tms_agent a  
			where a.handling_type =". USER_ACCOUNT_MANAGER ." 
			and a.UserId ='$gUserId' and a.user_state=1";
 }
 
 if( in_array($gHandle,
	array(USER_LEADER) ))
 {
	$sql = "select a.UserId, a.id  from tms_agent a  
			where a.handling_type =". USER_ACCOUNT_MANAGER ."
			and a.UserId IN (
				select cs.spv_id from tms_agent cs 
				where cs.UserId =$gUserId
			) and a.user_state=1 "; 
 }
 
 $qry = $this->db->query($sql);
 if( $qry && $qry->num_rows() ) 
	foreach( $qry->result_assoc() as $row ) 
 {
	$this->atm[$row['UserId']] = $row['id'];
 }
  
 return $this->atm;
 
}
/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
 
function _select_report_button(){
	$this->result_button = SystemRoleFrm($this->URI->segment(1));
	return Objective( $this->result_button );
}
/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	 
 public function _select_report_spv( $atm = 0 ) 
{
 
 $this->spv = array();
 
 $gHandle = _get_session('HandlingType');
 $gUserId = _get_session('UserId');
 
 if( in_array($gHandle, 
   array(USER_ROOT, USER_ADMIN, USER_ADMIN, USER_UPLOADER) ) )
 {
	$sql = "select a.UserId, a.id , a.full_name
			 from tms_agent a where a.handling_type = ". USER_SUPERVISOR ." 
			 and a.user_state=1 "; 
 }
 
 
 if( in_array($gHandle, 
   array(USER_MANAGER, USER_ACCOUNT_MANAGER) ) )
 {
	$sql = "select a.UserId, a.id , a.full_name  from tms_agent a 
			where a.handling_type=". USER_SUPERVISOR ." and a.act_mgr IN (
			select cs.act_mgr  from tms_agent cs  
			where cs.UserId='$gUserId' ) and a.user_state=1"; 
 }
 
 if( in_array($gHandle, 
   array(USER_SUPERVISOR) ) )
 {
	$sql = "select a.UserId, a.id , a.full_name from tms_agent a  
			where a.handling_type =". USER_SUPERVISOR ." 
			and a.spv_id='$gUserId' and a.user_state=1";
 }
 
 
 if( in_array($gHandle,
	array(USER_LEADER) ))
 {
	$sql = " select a.UserId, a.id , a.full_name from tms_agent a  
			 where a.handling_type = ". USER_SUPERVISOR ." 
			 and a.UserId='$gUserId' and a.user_state=1";
 }
 
 // echo $sql;
 $qry = $this->db->query($sql);
 if( $qry && $qry->num_rows() ) 
	foreach( $qry->result_record() as $row ) 
 {
	$this->spv[$row->field('UserId')] = sprintf('%s - %s',  $row->field('id', 'SetCapital'), 
															$row->field('full_name', 'SetCapital') );
 }
  
 return $this->spv;
 
}


/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	 
 function _select_report_spv_by_manager( $ManagerId = 0 )
{
  $gHandle = _get_session('HandlingType');
  
  if( !is_array($ManagerId)  ){
	 $ManagerId = array($ManagerId); 
  }  
  
 $this->Atm = array();
 
 $this->db->reset_select();
 $this->db->select("a.UserId, a.id, a.full_name", FALSE);
 $this->db->from("tms_agent a");
 $this->db->where_in("a.handling_type", array(USER_SUPERVISOR));
 $this->db->where_in("a.act_mgr",  $ManagerId);
 $this->db->where("a.user_state", 1);
 
 
// --------- handle by login  ------------- 
  if( in_array($gHandle, 
   array(USER_SUPERVISOR) ) ) {
	 $this->db->where("a.UserId", _get_session('UserId'));
 }


// --------- handle by login  -------------
 
 if( in_array($gHandle, 
   array(USER_LEADER) ) ) {
	 $this->db->where("a.spv_id", _get_session('SupervisorId'));
 }
 
 
 $this->db->order_by("a.id", "ASC");
 $rs = $this->db->get();
 
 if( $rs->num_rows() ) 
	foreach( $rs->result_record() as $row ) 
  {
	 $this->Atm[$row->field('UserId')] = sprintf("%s - %s", $row->field('id', 'SetCapital'), 
														    $row->field('full_name', 'SetCapital'));
  }
  
 return  $this->Atm;
}

// ----------------------------------------
// spv Or leader 

 function _select_report_spv_by_mgr( $Mgr = 0 )
{
 $gHandle = _get_session('HandlingType');	
  if( !is_array($Mgr)  ){
	 $Mgr = array($Mgr); 
  }  
  
 $this->tl = array();
 
 $this->db->reset_select();
 $this->db->select("a.UserId, a.id", FALSE);
 $this->db->from("tms_agent a");
 $this->db->where_in("a.handling_type", array(USER_LEADER));
 $this->db->where_in("a.act_mgr",  $Mgr);
 $this->db->where("a.user_state", 1);
 
 // --------- handle by login  -------------
 if( in_array($gHandle, 
   array(USER_LEADER) ) ) {
	 $this->db->where("a.UserId", _get_session('UserId'));
 }
 
 $this->db->order_by("a.id", "ASC");
 $rs = $this->db->get();
 
 if( $rs && $rs->num_rows() ) 
	foreach( $rs->result_assoc() as $row ) 
  {
	 $this->tl[$row['UserId']] = $row['id'];
  }
  
 return  $this->tl;
}
// ----------------------------------------
// spv Or leader 

 function _select_report_spv_by_atm( $AtmId = 0 )
{
 $gHandle = _get_session('HandlingType');	
  if( !is_array($AtmId)  ){
	 $AtmId = array($AtmId); 
  }  
  
 $this->tl = array();
 
 $this->db->reset_select();
 $this->db->select("a.UserId, a.id", FALSE);
 $this->db->from("tms_agent a");
 $this->db->where_in("a.handling_type", array(USER_LEADER));
 $this->db->where_in("a.spv_id",  $AtmId);
 $this->db->where("a.user_state", 1);
 
 // --------- handle by login  -------------
 if( in_array($gHandle, 
   array(USER_LEADER) ) ) {
	 $this->db->where("a.UserId", _get_session('UserId'));
 }
 
 $this->db->order_by("a.id", "ASC");
 $rs = $this->db->get();
 
 if( $rs && $rs->num_rows() ) 
	foreach( $rs->result_assoc() as $row ) 
  {
	 $this->tl[$row['UserId']] = $row['id'];
  }
  
 return  $this->tl;
}	

// ----------------------------------------
// spv Or leader 

 public function _select_report_tmr_by_spv( $spvid = 0 ) 
{
  
  if( is_bool( $spvid ) AND $spvid == FALSE  ){
	$spvid = array("9999");
  }
  
  if( !is_array($spvid)  ){
	$spvid = array($spvid); 
  }
 
  $this->tmr = array();
  
  $this->db->reset_select();
  $this->db->select("a.UserId, a.id, a.full_name", FALSE);
  $this->db->from("tms_agent a");
  $this->db->where_in("a.handling_type", array(USER_AGENT_INBOUND, USER_AGENT_OUTBOUND));
  $this->db->where_in("a.spv_id",  $spvid);
  $this->db->where("a.user_state", 1);
  $this->db->order_by("a.id", "ASC");
// $this->db->print_out();
   
  $rs = $this->db->get();
  if( $rs && $rs->num_rows() ) 
	foreach( $rs->result_record() as $row ) 
  {
	 $this->tmr[$row->field('UserId')] = sprintf('%s - %s',  $row->field('id', 'SetCapital'), 
															 $row->field('full_name', 'SetCapital') );
  }
 return  $this->tmr;
 
}	

/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	 
 public function _select_report_tmr_by_atm( $Atm = 0 ) 
{
  
  if( is_bool($Atm) AND $Atm == FALSE  ){
	$Atm = array("9999");
  }
  
  if( !is_array($Atm)  ){
	$Atm = array($Atm); 
  }
 
  $this->tmr = array();
  
  $this->db->reset_select();
  $this->db->select("a.UserId, a.id", FALSE);
  $this->db->from("tms_agent a");
  $this->db->where_in("a.handling_type", array(USER_AGENT_INBOUND, USER_AGENT_OUTBOUND));
  $this->db->where_in("a.spv_id",  $Atm);
  $this->db->where("a.user_state", 1);
  $this->db->order_by("a.id", "ASC");
  //$this->db->print_out();
   
  $rs = $this->db->get();
  if( $rs && $rs->num_rows() ) 
	foreach( $rs->result_assoc() as $row ) 
  {
	 $this->tmr[$row['UserId']] = $row['id'];
  }
 return  $this->tmr;
 
}	

/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	 
 public function _select_report_tmr_by_date( $Mgr= 0 ) 
{
  $this->tmr = array();
  
  $this->db->reset_select();
  $this->db->select("a.UserId, a.id", FALSE);
  $this->db->from("tms_agent a");
  $this->db->where_in("a.handling_type", array(USER_AGENT_INBOUND, USER_AGENT_OUTBOUND));
  $this->db->where("a.user_state", 1);
  $this->db->order_by("a.id", "ASC");
  //$this->db->print_out();
   
  $rs = $this->db->get();
  if( $rs && $rs->num_rows() ) 
	foreach( $rs->result_assoc() as $row ) 
  {
	 $this->tmr[$row['UserId']] = $row['id'];
  }
 return  $this->tmr;
 
}	

// ----------------------------------------
// spv Or leader 

 public function _select_report_tmr_by_mgr( $Mgr= 0 ) 
{
  
  if( is_bool($Mgr) AND $Mgr == FALSE  ){
	$Mgr = array("9999");
  }
  
  if( !is_array($Mgr)  ){
	$Mgr = array($Mgr); 
  }
 
  $this->tmr = array();
  
  $this->db->reset_select();
  $this->db->select("a.UserId, a.id", FALSE);
  $this->db->from("tms_agent a");
  $this->db->where_in("a.handling_type", array(USER_AGENT_INBOUND, USER_AGENT_OUTBOUND));
  $this->db->where_in("a.act_mgr",  $Mgr);
  $this->db->where("a.user_state", 1);
  $this->db->order_by("a.id", "ASC");
  //$this->db->print_out();
   
  $rs = $this->db->get();
  if( $rs && $rs->num_rows() )
	foreach( $rs->result_assoc() as $row ) 
  {
	 $this->tmr[$row['UserId']] = $row['id'];
  }
 return  $this->tmr;
 
}	

// ----------------------------------------
// spv Or leader 

 public function _select_report_tmr( $atm = 0 ) 
{
 
 $this->tmr = array();
 $gHandle = CK()->field('HandlingType');
 $gUserId = CK()->field('UserId');
 
 if( in_array($gHandle, 
   array(USER_ROOT, USER_ADMIN, USER_ADMIN, USER_UPLOADER) ) )
 {
	$sql = "select a.UserId, a.id 
			 from tms_agent a where a.handling_type IN( ". USER_AGENT_INBOUND .", ". USER_AGENT_OUTBOUND .")
			 order by a.id ASC "; 

 }
 
 
 if( in_array($gHandle, 
   array(USER_MANAGER, USER_ACCOUNT_MANAGER) ) )
 {
	$sql = "select a.UserId, a.id  from tms_agent a 
			where a.handling_type IN( ". USER_AGENT_INBOUND .", ". USER_AGENT_OUTBOUND .") and a.act_mgr IN (
			select cs.act_mgr  from tms_agent cs  
			where cs.act_mgr='$gUserId' ) 
			order by a.id ASC "; 
 }
 
 if( in_array($gHandle, 
   array(USER_SUPERVISOR) ) )
 {
	$sql = "select a.UserId, a.id  from tms_agent a  
			where a.handling_type IN( ". USER_AGENT_INBOUND .", ". USER_AGENT_OUTBOUND .")
			and a.spv_id ='$gUserId' 
			order by a.id ASC  ";
 }
 
 
 if( in_array($gHandle,
	array(USER_LEADER) ))
 {
	$sql = " select a.UserId, a.id  from tms_agent a  
			 where a.handling_type IN( ". USER_AGENT_INBOUND .", ". USER_AGENT_OUTBOUND .")
			 and a.tl_id='$gUserId'
			 order by a.id ASC ";
 }
 
 
 $qry = $this->db->query($sql);
 if( $qry && $qry->num_rows() ) 
	foreach( $qry->result_assoc() as $row ) 
 {
	 $this->tmr[$row['UserId']] = $row['id'];
 }
  
 return  $this->tmr;
 
}

// ---------------------------------------------------
 public function _select_report_campaign()
{
	
 $this->report_campaign = array();
 
 $this->db->reset_select();
 $this->db->select("CampaignId, CampaignName", FALSE);
 $this->db->from("t_gn_campaign");
//  $this->db->where("CampaignStatusFlag",1);
 $rs = $this->db->get();
 if( is_object($rs) && $rs->num_rows() > 0 ) 
	foreach( $rs->result_assoc() as $row )
{
	$this->report_campaign[$row['CampaignId']] = $row['CampaignName'];
 }
// echo "<pre>".$rs."</pre>";
 // $this->output->enable_profiler(TRUE);
 // var_dump($this->db->last_query($rs));die();
 return $this->report_campaign;
 
}

public function _select_report_campaign2($status)
{
	
	$this->report_campaign = array();
	
	$this->db->reset_select();
	$this->db->select("CampaignId, CampaignName", FALSE);
	$this->db->from("t_gn_campaign");
	 $this->db->where("CampaignStatusFlag",$status[0]);
	$rs = $this->db->get();
	if( is_object($rs) && $rs->num_rows() > 0 ) 
		foreach( $rs->result_assoc() as $row )
	{
		$this->report_campaign[$row['CampaignId']] = $row['CampaignName'];
	}
	return $this->report_campaign;
}


// ---------------------------------------------------
 public function _select_report_recsource( $rec_id = null )
{
  	
 $this->report_recsource = array();
 
 $this->db->reset_select();
 $this->db->select("RecSourceId, RecSourceDesc", FALSE);
 $this->db->from("t_lk_recsource");
 $this->db->where("RecSourceFlags",1);
 if( is_array($rec_id)  ){
	$this->db->where_in("RecSourceId",$rec_id);
 }
 
 $rs = $this->db->get();
 if( $rs && $rs->num_rows() > 0 ) 
	foreach( $rs->result_assoc() as $row )
{
	$this->report_recsource[$row['RecSourceId']] = $row['RecSourceDesc'];
 }
 
 return $this->report_recsource;
 
}

// ----------------------------------------------------
// --------------------------------------------------------------

 public function _select_report_type()
{

 $this->report_type = array(
	'filter_campaign_group_date' => 'Summary By Campaign',
	'filter_upload_filename' => 'Summary By Upload File',
	'filter_campaign_group_mgr' => 'Summary by Campaign per AM',
	'filter_campaign_group_spv' => 'Summary by Campaign per SPV',
	'filter_campaign_group_agent' => 'Summary by Campaign per Agent'
		
 );
 
 
// ---------- level admin etc. 
 $gHandle  = _get_session('HandlingType');
  if( in_array($gHandle, 
	array(USER_ROOT, USER_ADMIN, USER_ADMIN, USER_UPLOADER) ) )
 {
	$this->report_type = array(
		'filter_campaign_group_date' => 'Summary By Campaign',
		'filter_upload_filename' => 'Summary By Upload File',
		'filter_campaign_group_mgr' => 'Summary by Campaign per AM',
		'filter_campaign_group_spv' => 'Summary By Campaign per SPV',
		'filter_campaign_group_agent' => 'Summary By Campaign per Agent'
		
	 );
 }
 
// -------- level manager  
  if( in_array($gHandle,
	array(USER_MANAGER, USER_ACCOUNT_MANAGER) ))
 {
	$this->report_type = array(
		'filter_campaign_group_date' => 'Summary By Campaign',
		'filter_upload_filename' => 'Summary By Upload File',
		'filter_campaign_group_mgr' => 'Summary by Campaign per AM',
		'filter_campaign_group_spv' => 'Summary By Campaign per SPV',
		'filter_campaign_group_agent' => 'Summary By Campaign per Agent'
		
	 );
 }
 
 
 // -------- level ATM  -----------------------
 
  if( in_array($gHandle,
	array(USER_SUPERVISOR) ))
 {
	$this->report_type = array(
		'filter_campaign_group_date' => 'Summary By Campaign',
		'filter_upload_filename' => 'Summary By Upload File',
		'filter_campaign_group_mgr' => 'Summary by Campaign per AM',
		'filter_campaign_group_spv' => 'Summary By Campaign per SPV',
		'filter_campaign_group_agent' => 'Summary By Campaign per Agent'
	);
 }
 
 
 // -------- level SPV  --------------------
  if( in_array($gHandle,
	array(USER_LEADER) ))
 {
	 $this->report_type = array(
		'filter_campaign_group_date' => 'Summary By Campaign',
		'filter_upload_filename' => 'Summary By Upload File',
		'filter_campaign_group_mgr' => 'Summary by Campaign per AM',
		'filter_campaign_group_spv' => 'Summary By Campaign per SPV',
		'filter_campaign_group_agent' => 'Summary By Campaign per Agent'
	 );
 }
 
 return $this->report_type;
 
} 


// ----------------------------------------------------
// --------------------------------------------------------------

 public function _select_report_mode()
{
	//$this->report_mode = array ( 'summary' => 'Summary', 'detail' => 'Detail' );
	$this->report_mode = array ( 'summary' => 'Summary');
	return $this->report_mode;
}

// ----------------------------------------------------
// --------------------------------------------------------------

  public function _select_attr_user()
 {
	$this->user_attr  = array();
    $gUserId = _get_session('UserId');
    
	$sql = " select * from  tms_agent a where a.UserId = ". $gUserId ." ";
	$qry = $this->db->query($sql);
	if( $qry->num_rows() >  0 ){
		$this->user_attr = (array)$qry->result_first_assoc();
	}
	return new EUI_Object($this->user_attr);
}

//-------------------------------------------------------



// ---------------------------------------------------
 public function _select_report_product()
{
	
 $this->report_product = array();
 
 $this->db->reset_select();
 $this->db->select("ProductId, ProductCode", FALSE);
 $this->db->from("t_gn_product_master");
 $this->db->where("ProductStatusFlag",1);
 $rs = $this->db->get();
 if( is_object($rs) && $rs->num_rows() > 0 ) 
	foreach( $rs->result_assoc() as $row )
{
	$this->report_product[$row['ProductId']] = $row['ProductCode'];
 }
// echo "<pre>".$rs."</pre>";
 // $this->output->enable_profiler(TRUE);
 // var_dump($this->db->last_query($rs));die();
 return $this->report_product;
 
}

// ---------------------------------------------------
 public function _select_report_product_by_campaign($CampaignId = 0)
{
	
 $this->report_product = array();
 
 $this->db->reset_select();
 $this->db->select("a.ProductId, a.ProductCode", FALSE);
 $this->db->from("t_gn_product_master a");
 $this->db->join("t_gn_campaignproduct b","a.ProductId = b.ProductId");
 $this->db->join("t_gn_campaign c","b.CampaignId = c.CampaignId");
 $this->db->where_in("b.CampaignId",$CampaignId);
//  $this->db->where("c.CampaignStatusFlag",1);
//  $this->db->where("a.ProductStatusFlag",1);
 $rs = $this->db->get();
 if( is_object($rs) && $rs->num_rows() > 0 ) 
	foreach( $rs->result_assoc() as $row )
{
	$this->report_product[$row['ProductId']] = $row['ProductCode'];
 }
// echo "<pre>".$rs."</pre>";
 // $this->output->enable_profiler(TRUE);
 // var_dump($this->db->last_query($rs));die();
 return $this->report_product;
 
}

// -------------------------------------------------------------
// New Filter Condition Call Tracking
  public function _select_report_type_new()
{

 $this->report_type = array(
	'filter_call_track_day' => 'Call Track By Day',
	'filter_call_track_campaign' => 'Call Track By Campaign',
	'filter_call_track_agent' => 'Call Track by Agent'
		
 );
 return $this->report_type;
 
}
// ======================================= END CLASS ====================================

}
?>

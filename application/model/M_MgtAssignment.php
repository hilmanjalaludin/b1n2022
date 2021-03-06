<?php

// error_reporting(E_ALL);
// ini_set("display_errors", 1);

/*
 * E.U.I 
 *
 
 * subject	: M_MgtAssignment modul 
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/model/M_Utility/
 */
 
class M_MgtAssignment extends EUI_Model
{

 private static $Active;
 private static $NotActive;
 private static $CampaignId;

 
// -----------------------------------------------------------------------------
/*
 *
 * @ package		function get detail content list page 
 * @ param			not assign parameter
 */
 
 private static $Instance   = null; 
 public static function &Instance()
{
	if( is_null(self::$Instance) ){
		self::$Instance = new self();
	}	
	return self::$Instance;
}

// -----------------------------------------------------------------------------
/*
 *
 * @ package		function get detail content list page 
 * @ param			not assign parameter
 */
 
function __construct()
{
	self::$Active = 1;
	self::$NotActive = 0;
	$this->load->model(array('M_ModDistribusi','M_SetCallResult','M_SysUser','M_Combo'));
} 
 
/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
  
 /* 
function _get_default()
{
	$this -> EUI_Page -> _setPage(10); 
	$this -> EUI_Page -> _setQuery("
		SELECT a.CampaignId, a.CampaignNumber, a.CampaignName, b.Description 
		FROM t_gn_campaign a 
		LEFT JOIN t_lk_outbound_goals b on a.OutboundGoalsId=b.OutboundGoalsId
	"); 

	
	$flt =" AND a.CampaignStatusFlag=1 ";
	
	if( $this -> URI -> _get_have_post('OutboundGoalId') ){
		$flt .= " AND a.OutboundGoalsId = '{$this->URI->_get_post('OutboundGoalId')}'"; 
	}
	
   // set where 
	
	$this -> EUI_Page -> _setWhere($flt);
	
	// set order
	if( $this -> URI -> _get_have_post('order_by') ){
		$this -> EUI_Page -> _setOrderBy($this->URI->_get_post('order_by'),$this->URI->_get_post('type'));
	}
	
	if( $this -> EUI_Page -> _get_query() ) 
	{
		return $this -> EUI_Page;
	}
}
*/

/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 /*
function _get_content()
{

  $this -> EUI_Page->_postPage( $this -> URI -> _get_post('v_page') );
  $this -> EUI_Page->_setPage(10);
 
  $this -> EUI_Page-> _setQuery("
		SELECT a.CampaignId, a.CampaignNumber, a.CampaignName, b.Description 
		FROM t_gn_campaign a 
		LEFT JOIN t_lk_outbound_goals b on a.OutboundGoalsId=b.OutboundGoalsId 
	");
  
	
	// set where
	$flt =" AND a.CampaignStatusFlag=1 ";
	if( $this -> URI -> _get_have_post('OutboundGoalId') ){
		$flt .= " AND a.OutboundGoalsId = '{$this->URI->_get_post('OutboundGoalId')}'"; 
	}
	
	$this -> EUI_Page-> _setWhere($flt);
	
	// set order
	if( $this -> URI -> _get_have_post('order_by') ){
		$this -> EUI_Page -> _setOrderBy($this->URI->_get_post('order_by'),$this->URI->_get_post('type'));
	}
	
	$this -> EUI_Page->_setLimit();
}
*/

/*
 * @ def 		: _get_resource // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 /*
function _get_resource()
 {
	self::_get_content();
	if( $this -> EUI_Page -> _get_query()!='') 
	{
		return $this -> EUI_Page -> _result();
	}	
 }
 */
/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 /*
function _get_page_number() 
 {
	if( $this -> EUI_Page -> _get_query()!='' ) {
		return $this -> EUI_Page -> _getNo();
	}	
 }
 */
 

/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 /*
function _getShowData($Data=null)
{
	$_counter = 0;	
	if( !is_null($Data) )
	{
		$sql = "select 
					COUNT(b.AssignId) as Counter 
				from t_gn_customer a
				left join t_gn_assignment b on a.CustomerId=b.CustomerId
				where 1=1
				and a.CampaignId = '".$Data['CampaignId']."'
				and a.CallReasonId not in (".implode(',',array_keys($this->M_SetCallResult->_getRealInterest())).") ";
				
		if( isset($Data['UserId']) 
			AND is_array($Data['UserId']) )
		{
			$sql .= " and b.AssignSelerId in (".implode(',',$Data['UserId']).") ";
			// $this -> db -> where_in('b.AssignSelerId',$Data['UserId']);
		}
		
		if( isset($Data['CallResultId']) 
			AND is_array($Data['CallResultId']) )
		{
			$idReason = array();
			$filter = "";
			
			foreach($Data['CallResultId'] as $reason)
			{
				if($reason == 'new'){
					$filter = " a.CallReasonId is null ";
				}
				else{
					$idReason[] = $reason;
				}
			}
			
			if(!empty($filter))
			{
				if(count($idReason)>0)
				{
					$sql .= " and (a.CallReasonId in (".implode(',',$idReason).") or ".$filter." )";
				}
				else{
					$sql .= " and ".$filter." ";
				}
			}
			else{
				$sql .= " and a.CallReasonId in (".implode(',',$idReason).")";
			}
		}
		
		$qry = $this->db->query($sql);
		if($rows = $qry->result_first_assoc()) {
			$_counter = $rows['Counter'];
		}
	}
	
	return $_counter;
}
*/

/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 function _select_row_field_level($Level=null )
{ 
	if(!is_null($Level)) 
{
	$arr_list_user = array 
	( 
		USER_ADMIN => 'AssignAdmin', 
		USER_MANAGER => 'AssignMgr', 
		USER_ACCOUNT_MANAGER => 'AssignAmgr',
		USER_SUPERVISOR => 'AssignSpv',
		USER_AGENT_OUTBOUND => 'AssignSelerId', 
		USER_AGENT_INBOUND => 'AssignSelerId', 
		USER_LEADER => 'AssignLeader',
		USER_QUALITY => 'AssignAdmin', 
		USER_ROOT => 'AssignAdmin'
	);
		
	return (string)$arr_list_user[$Level];
 }
	
	return null;
}	
 
/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 function _get_select_campaign()
 {
	$sql = " SELECT * FROM t_gn_campaign ";
	$qry = $this -> db -> query($sql);
	foreach( $qry -> result_assoc() as $rows ){
		$_conds[$rows['CampaignStatusFlag']][$rows['CampaignId']] = $rows;
	}
	
	return $_conds;
 }
 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
 public function getLevelUser()
{
  $this->result_assoc = array();  
  $this->result_array = array();
  
 // $data = array(); 
 // define data user on process OK sip Test 

 $this->userLevel = CK()->field('HandlingType');
 
 
//  USER_ROOT, USER_ADMIN	
 if( @in_array( $this->userLevel, 
		 array(USER_ROOT, USER_ADMIN ))){ 
	$this->result_assoc = array(  	USER_ADMIN, 
									USER_QUALITY_STAFF,
									USER_QUALITY_HEAD, 
									USER_ROOT, 
									USER_UPLOADER,
									USER_ADMIN_FOLLOWUP);
 }
	
// USER_GENERAL_MANAGER 		
 if( @in_array( $this->userLevel, 
		 array(USER_GENERAL_MANAGER ) )){ 
	$this->result_assoc = array(	USER_ADMIN, USER_ROOT, 
									USER_QUALITY_STAFF,
									USER_QUALITY_HEAD,
									USER_GENERAL_MANAGER,
									USER_UPLOADER, 
									USER_ADMIN_FOLLOWUP);
 }
	
// USER_MANAGER, USER_ACCOUNT_MANAGER 
// Update tambah USER_SUPERVISOR 23082018		
 if( @in_array( $this->userLevel, 
		 array(USER_MANAGER, USER_ACCOUNT_MANAGER) )){
	$this->result_assoc = array(	USER_ADMIN, 
									USER_GENERAL_MANAGER,	
									USER_MANAGER, 
									USER_ACCOUNT_MANAGER, 
									USER_ROOT, 
									USER_QUALITY_STAFF,
									USER_QUALITY_HEAD,
									USER_UPLOADER, 
									USER_ADMIN_FOLLOWUP);
									//USER_SUPERVISOR);
   } 
		
		
// USER_QUALITY_STAFF, USER_QUALITY_HEAD 		
 if( @in_array( $this->userLevel, 
		 array(USER_QUALITY_STAFF, USER_QUALITY_HEAD))){
		$this->result_assoc = array();
  }

 // USER_SUPERVISOR 
 if( @in_array( $this->userLevel, array(USER_SUPERVISOR) ) ) {
	
	$this->result_assoc = array(	USER_ADMIN, 
									USER_ROOT, 
									USER_ACCOUNT_MANAGER, 		
									USER_GENERAL_MANAGER,
									USER_MANAGER, 
									
									USER_QUALITY_STAFF,
									USER_SUPERVISOR, 
									USER_UPLOADER,
									USER_ADMIN_FOLLOWUP);
 }
	 
// ON USER_LEADER ====>	
 if( @in_array( $this->userLevel, array(USER_LEADER) ) ) {
	
	$this->result_assoc = array(	USER_ADMIN, 
									USER_ROOT, 
									USER_GENERAL_MANAGER,
									USER_ACCOUNT_MANAGER, 
									USER_MANAGER, 
									USER_QUALITY_STAFF, 
									USER_QUALITY_HEAD, 
									USER_SUPERVISOR, 
									USER_LEADER, 
									USER_UPLOADER, 
									USER_ADMIN_FOLLOWUP);	
 }		   
		 
// === > run of query statments 

	$this->db->reset_select();
	$this->db->select("a.id, a.name", FALSE);
	$this->db->from("tms_agent_profile a");
	$this->db->where_not_in("a.id", $this->result_assoc);
	$this->db->where("a.IsActive", 1);
	$this->db->order_by('a.level_group', 'ASC');
	//echo $this->db->get_var_dump();
	$rs = $this->db->get();
	
	if( $rs && $rs->num_rows() > 0 ) foreach( $rs->result_assoc() as $row ) {		
		$this->result_array[$row['id']] = $row['name'];
	}
	
	return (array)$this->result_array;
}

 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */


  //Tambahan Fucntion Get User Level Transfer 
  public function getLevelUserTrfData()
{
  $this->result_assoc = array();  
  $this->result_array = array();
  
 // $data = array(); 
 // define data user on process OK sip Test 

 $this->userLevel = CK()->field('HandlingType');
 
 
//  USER_ROOT, USER_ADMIN	
 if( @in_array( $this->userLevel, 
		 array(USER_ROOT, USER_ADMIN ))){ 
	$this->result_assoc = array(  	USER_ADMIN, 
									USER_QUALITY_STAFF,
									USER_QUALITY_HEAD, 
									USER_ROOT, 
									USER_UPLOADER,
									USER_ADMIN_FOLLOWUP);
 }
	
// USER_GENERAL_MANAGER 		
 if( @in_array( $this->userLevel, 
		 array(USER_GENERAL_MANAGER ) )){ 
	$this->result_assoc = array(	USER_ADMIN, USER_ROOT, 
									USER_QUALITY_STAFF,
									USER_QUALITY_HEAD,
									USER_GENERAL_MANAGER,
									USER_UPLOADER, 
									USER_ADMIN_FOLLOWUP);
 }
	
// USER_MANAGER, USER_ACCOUNT_MANAGER
 if( @in_array( $this->userLevel, 
		 array(USER_MANAGER, USER_ACCOUNT_MANAGER) )){
	$this->result_assoc = array(	USER_ADMIN, 
									USER_GENERAL_MANAGER,	
									USER_MANAGER, 
									USER_ACCOUNT_MANAGER, 
									USER_ROOT, 
									USER_QUALITY_STAFF,
									USER_QUALITY_HEAD,
									USER_UPLOADER, 
									USER_ADMIN_FOLLOWUP,
									USER_SUPERVISOR);
   } 
		
		
// USER_QUALITY_STAFF, USER_QUALITY_HEAD 		
 if( @in_array( $this->userLevel, 
		 array(USER_QUALITY_STAFF, USER_QUALITY_HEAD))){
		$this->result_assoc = array();
  }

 // USER_SUPERVISOR 
 if( @in_array( $this->userLevel, array(USER_SUPERVISOR) ) ) {
	
	$this->result_assoc = array(	USER_ADMIN, 
									USER_ROOT, 
									USER_ACCOUNT_MANAGER, 		
									USER_GENERAL_MANAGER,
									USER_MANAGER, 
									
									USER_QUALITY_STAFF,
									USER_SUPERVISOR, 
									USER_UPLOADER,
									USER_ADMIN_FOLLOWUP);
 }
	 
// ON USER_LEADER ====>	
 if( @in_array( $this->userLevel, array(USER_LEADER) ) ) {
	
	$this->result_assoc = array(	USER_ADMIN, 
									USER_ROOT, 
									USER_GENERAL_MANAGER,
									USER_ACCOUNT_MANAGER, 
									USER_MANAGER, 
									USER_QUALITY_STAFF, 
									USER_QUALITY_HEAD, 
									USER_SUPERVISOR, 
									USER_LEADER, 
									USER_UPLOADER, 
									USER_ADMIN_FOLLOWUP);	
 }		   
		 
// === > run of query statments 

	$this->db->reset_select();
	$this->db->select("a.id, a.name", FALSE);
	$this->db->from("tms_agent_profile a");
	$this->db->where_not_in("a.id", $this->result_assoc);
	$this->db->where("a.IsActive", 1);
	$this->db->order_by('a.level_group', 'ASC');
	// echo $this->db->_get_var_dump();
	$rs = $this->db->get();
	
	if( $rs && $rs->num_rows() > 0 ) foreach( $rs->result_assoc() as $row ) {		
		$this->result_array[$row['id']] = $row['name'];
	}
	
	return (array)$this->result_array;
}
  
 public function getLevelUserPullData()
{
  $this->result_assoc = array();  
  $this->result_array = array();
  
 // get handling data process  
  $this->result_level = CK()->field('HandlingType');
  
 // define sesion -------------------
  
 // USER_ADMIN
 if( @in_array($this->result_level, array(USER_ROOT) )) { 
	 $this->result_assoc = array( USER_QUALITY_STAFF,
								  USER_QUALITY_HEAD,
								  USER_UPLOADER, 
								  USER_ADMIN_FOLLOWUP);
 }
 
 // USER_ADMIN
 if( @in_array( $this->result_level, array(USER_ADMIN) )){ 
	$this->result_assoc = array(USER_QUALITY_STAFF,
								USER_QUALITY_HEAD, 
								USER_ROOT, 
								USER_UPLOADER,
								USER_ADMIN_FOLLOWUP );
 }
 
// USER_GENERAL_MANAGER  
 if( @in_array( $this->result_level, array(USER_GENERAL_MANAGER) )){
	$this->result_assoc = array(USER_ADMIN, 
								USER_ROOT, 
								USER_QUALITY_STAFF,
								USER_QUALITY_HEAD, 
								USER_UPLOADER, 
								USER_ADMIN_FOLLOWUP );
 }
	
// USER_MANAGER & USER_ACCOUNT_MANAGER	
 if( @in_array( $this->result_level, array(USER_MANAGER, USER_ACCOUNT_MANAGER ))) {

	$this->result_assoc = array( USER_ADMIN, 
								 USER_ROOT, 
								 USER_GENERAL_MANAGER,
								 USER_QUALITY_STAFF, 
								 USER_QUALITY_HEAD,
								 USER_UPLOADER,
								 USER_ADMIN_FOLLOWUP);
 }
 
// USER_QUALITY_HEAD, USER_QUALITY_STAFF 
 if( @in_array( $this->result_level,  array(USER_QUALITY_HEAD, USER_QUALITY_STAFF ))) {
	$this->result_assoc = array();
 }
 
// USER_SUPERVISOR 
 if( @in_array( $this->result_level, array(USER_SUPERVISOR) ) ) {
		$this->result_assoc = array( USER_ADMIN, 
									 USER_ROOT, 
									 USER_GENERAL_MANAGER,
									 USER_ACCOUNT_MANAGER, 
									 USER_MANAGER,
									 USER_QUALITY_STAFF, 
									 USER_QUALITY_HEAD, 
									 USER_UPLOADER,
									 USER_ADMIN_FOLLOWUP);
									
	}
		
  // USER_LEADER		
  if( @in_array( $this->result_level, array(USER_LEADER) ) ) {
		$this->result_assoc = array( USER_ADMIN, 
									 USER_ROOT, 
									 USER_GENERAL_MANAGER,
									 USER_ACCOUNT_MANAGER, 
									 USER_MANAGER,
									 USER_QUALITY_STAFF, 
									 USER_QUALITY_HEAD, 
									 USER_UPLOADER,
									 USER_SUPERVISOR,
									 USER_ADMIN_FOLLOWUP);
									
	}
	 
	
/** run of query statments **/ 

	$this->db->reset_select();
	$this->db->select("a.id, a.name", FALSE);
	$this->db->from("tms_agent_profile a");
	$this->db->where_not_in("a.id", $this->result_assoc);
	$this->db->where("a.IsActive", 1);
	$this->db->order_by('a.level_group', 'ASC');
	
	$rs = $this->db->get();
	if( $rs && $rs->num_rows() > 0 ) 
		foreach( $rs->result_assoc() as $rows ) {		
		$this->result_array[$rows['id']] = $rows['name'];
	}
	
// return callback data process 	
	return (array)$this->result_array;
}
		
// ------------------------------------------------------------------------
/*
 * @ aksess : .public 
 */
 
public function DistribusiType()
{
	$datas = array(1=>'Bagi Rata',2=>'Jumlah Agent Tertentu');
	if( is_array($datas) ) {
		return $datas;
	}
}

// ------------------------------------------------------------------------
/*
 * @ aksess : .public 
 */
 
 public function DistribusiAction()
{
   $arr_action = array(1=>'Quantity',2=>'Checked');
	if( is_array($arr_action) ) 
 {
	return (array)$arr_action;
  }
}

public function DistribusiActionQuantity()
{
   $arr_action = array(1=>'Quantity');
	if( is_array($arr_action) ) 
 {
	return (array)$arr_action;
  }
}

		
/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 function DistribusiMode()
 {
	return array( 1 => 'Urutan',2 => 'Acak' );
 }
 
 
/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 function _get_count_privileges( $CampaignId=0, $_status='')
 {
	$_totals = array();
	
	
	$_wheres = " SELECT count(b.CustomerId) as jumlah,  a.CampaignStatusFlag as conds
				 FROM t_gn_campaign a 
				 INNER JOIN t_gn_customer b on a.CampaignId=b.CampaignId 
				 INNER JOIN t_gn_assignment  c on b.CustomerId=c.CustomerId
				 WHERE a.CampaignStatusFlag IN( '".self::$Active."','".self::$NotActive."')
				 AND a.CampaignId = '$CampaignId' ";
	
	if( $this -> EUI_Session -> _get_session('HandlingType') == USER_ROOT )	
		$_wheres.= " AND c.AssignAmgr IS NULL
					 AND c.AssignMgr IS NULL
					 AND c.AssignSpv IS NULL
					 AND c.AssignSelerId IS NULL 
					 GROUP BY a.CampaignStatusFlag ";
							
	else if( $this -> EUI_Session -> _get_session('HandlingType') == USER_ADMIN )	
		$_wheres.= " AND c.AssignMgr IS NULL
					 AND c.AssignSpv IS NULL
					 AND c.AssignSelerId IS NULL 
					 GROUP BY a.CampaignStatusFlag ";
						 
	else if( $this -> EUI_Session -> _get_session('HandlingType') == USER_ACCOUNT_MANAGER )	
		$_wheres.= " AND c.AssignAmgr = '".$this -> EUI_Session -> _get_session('UserId')."'
					 AND c.AssignMgr IS NULL
					 AND c.AssignSpv IS NULL
					 AND c.AssignSelerId IS NULL";		
					 
	else if( $this -> EUI_Session -> _get_session('HandlingType') == USER_MANAGER )	
		$_wheres.= " AND c.AssignMgr = '".$this -> EUI_Session -> _get_session('UserId')."'
					 AND c.AssignSpv IS NULL
					 AND c.AssignSelerId IS NULL";
		 
	
	else if( $this -> EUI_Session -> _get_session('HandlingType') == USER_SUPERVISOR )	
		$_wheres.= " AND c.AssignMgr IS NOT NULL
					 AND c.AssignSpv = '".$this -> EUI_Session -> _get_session('UserId')."'
					 AND c.AssignSelerId IS NULL 
					 GROUP BY a.CampaignStatusFlag ";

	else if( $this -> EUI_Session -> _get_session('HandlingType') == USER_LEADER )	
		$_wheres.= " AND c.AssignMgr IS NOT NULL
					 AND c.AssignLeader = '".$this -> EUI_Session -> _get_session('UserId')."'
					 AND c.AssignSpv IS NOT NULL
					 AND c.AssignSelerId IS NULL 
					 GROUP BY a.CampaignStatusFlag ";
					 
 // start && run query 
	$qry = $this -> db ->query($_wheres);
	foreach( $qry -> result_assoc() as $rows ){
		$_totals[$rows['conds']]+= $rows['jumlah'];
	}
	
	if( $_status !='' ) 
		return (INT)$_totals[$_status];
	else
	{
		return (($_totals[self::$Active])+($_totals[self::$NotActive]));
	}
}	


/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */	
  
 function _select_page_like_data(  $field='', $opr ='', $route = null ) {
	 
	$this->arr_ptr = array('LIKE' => 'LIKE', 'NOT_LIKE' => 'NOT LIKE', 'SAMDENG' => '=');
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
			if( !strcmp( $opr, 'SAMDENG') ){
				$this->arr_sql[] = sprintf("%s %s '%s' ", sprintf('b.%s', $field), $this->arr_ptr[$opr], trim($value));
			}else{
				$this->arr_sql[] = sprintf("%s %s '%%%s%%' ", sprintf('b.%s', $field), $this->arr_ptr[$opr], trim($value));
			}
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
//   edit hilman
function _select_page_distribute($out = null, $field = null, $std = null)
	{

		// tankap semua varibale dari process search
		$this->out = $out;
		$this->cok = CK();
		$this->cof = CF();

		//  debug($this->out);
		// define all variable  $ar_call_not_interest = array_keys(CallResultInterest());
		$result_array = array();

		// inull then get default ----------------

		$this->db->reset_select();
		if (is_null($field)) {

			$this->db->select(
				'
		a.AssignId 				AS DistAssignId,
		b.DM_Custno 			AS DM_Custno,
		b.DM_FirstName 			AS DM_FirstName,
		b.DM_CampaignId 		AS DM_CampaignId,
		b.DM_MotherName 		AS DM_MotherName,
		b.DM_Dob 				AS DM_Dob,
		b.DM_Age 				AS DM_Age,
		b.DM_CrLimit 			AS DM_CrLimit,
		MAX(cv.CV_Data_AvailSS)      AS DM_DataAvailSS,
		b.DM_CcLimit 			AS DM_CcLimit,
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
		b.DM_City 				AS DM_City,
		a.AssignMode 			as DM_Assign_Mode,
		b.DM_FixId				as DM_FixId,
		b.DM_IdentificationNum  as DM_IdentificationNum,
		a.AssignDate 			AS DM_AssignDateTs,
		b.DM_UpdatedTs 			AS DM_UpdatedTs',

				FALSE
			);
		} else {
			$this->db->select($field, FALSE);
		}

		$this->db->from("t_gn_assignment a");
		$this->db->join("t_gn_customer_master b ", " a.AssignCustId=b.DM_Id", "INNER");
		$this->db->join("t_gn_customer_verification cv ", " cv.CV_Data_CustId=b.DM_Id", "INNER");
		$this->db->join("t_gn_campaign c ", " b.DM_CampaignId = c.CampaignId", "INNER");
		$this->db->where("a.AssignBlock", 0);

		// ini berlaku hanya untuk kondisi tertentu.
		$this->db->where_in('b.DM_CallCategoryId', array(NSTS), FALSE);

		// filter expired data customer expired data
		//$this->db->where( sprintf("b.DM_DateExpired>='%s 00:00:00'", date('Y-m-d')), "", FALSE);
		$this->db->where(sprintf("c.CampaignEndDate>='%s 00:00:00'", date('Y-m-d')), "", FALSE);

		$this->db->where("c.CampaignStatusFlag",1);
		//filter data tidak boleh reason"APMT"
		$this->db->where(sprintf("b.DM_CallReasonId != 50"));

		// filter data yang pertama by campaign
		if ($this->out->find_value('dis_campaign_name')) {
			$this->db->where_in("b.DM_CampaignId", $this->out->fields('dis_campaign_name'));
		}

		// filter by recsource jika memang ada
		if ($this->out->find_value('dis_recsource_name')) {
			$this->db->where_in("b.DM_Recsource", $this->out->fields('dis_recsource_name'));
		}

		// tanggal start assign yang dimaksud.
		if ($this->out->find_value('dis_assign_date_start_date')) {
			$this->db->where(sprintf("a.AssignDate>='%s 00:00:00'", $this->out->field('dis_assign_date_end_date', 'SetDate')), "", FALSE);
		}
		if ($this->out->find_value('dis_assign_date_end_date')) {
			$this->db->where(sprintf("a.AssignDate<='%s 23:59:59'", $this->out->field('dis_assign_date_end_date', 'SetDate')), "", FALSE);
		}

		// tanggal update di customer jika sudah ada .
		if ($this->out->find_value('dis_update_start_date')) {
			$this->db->where(sprintf("b.DM_UpdatedTs>='%s 00:00:00'", $this->out->field('dis_update_start_date', 'SetDate')), "", FALSE);
		}
		if ($this->out->find_value('dis_update_end_date')) {
			$this->db->where(sprintf("b.DM_UpdatedTs<='%s 23:59:59'", $this->out->field('dis_update_end_date', 'SetDate')), "", FALSE);
		}

		// filter by CallStatus / Call Kategory ID
		if ($this->out->find_value('dis_call_status')) {
			$this->db->where_in("b.DM_CallCategoryId", $this->out->fields('dis_call_status'));
		}

		if ($this->out->find_value('cycle')) {
			$this->db->where_in("cv.CV_Data_Cycle", $this->out->fields('cycle'));
		}

		// dis_range_age_start
		if ($this->out->find_value('dis_range_age_start')) {
			$this->db->where(sprintf("b.DM_Age>=%d", $this->out->field('dis_range_age_start')), "", FALSE);
		}

		// dis_range_age_stop
		if ($this->out->find_value('dis_range_age_stop')) {
			$this->db->where(sprintf("b.DM_Age<=%d", $this->out->field('dis_range_age_stop')), "", FALSE);
		}


		// dis_avail_ss_start
		if ($this->out->find_value('dis_avail_ss_start')) {
			$this->db->where(sprintf("cv.CV_Data_AvailSS>=%d", $this->out->field('dis_avail_ss_start')), "", FALSE);
		}

		// dis_avail_ss_stop
		if ($this->out->find_value('dis_avail_ss_stop')) {
			$this->db->where(sprintf("cv.CV_Data_AvailSS<=%d", $this->out->field('dis_avail_ss_stop')), "", FALSE);
		}

		// dis_kredit_limit_start
		if ($this->out->find_value('dis_kredit_limit_start')) {
			$this->db->where(sprintf("b.DM_CrLimit>=%d", $this->out->field('dis_kredit_limit_start')), "", FALSE);
		}

		// dis_kredit_limit_stop
		if ($this->out->find_value('dis_kredit_limit_stop')) {
			$this->db->where(sprintf("b.DM_CrLimit<=%d", $this->out->field('dis_kredit_limit_stop')), "", FALSE);
		}

		// filter step ke - 2 by Session User Login
		if (!strcmp($this->cok->field('HandlingType'), USER_ROOT)) {
			// $this->db->where_in('a.AssignAdmin', $this->cof->field('default_admin'));
			$this->db->where('a.AssignAmgr',  0);
			$this->db->where('a.AssignMgr',  0);
		}

		// jika admin ambil semua data yang ada .
		if (!strcmp($this->cok->field('HandlingType'), USER_ADMIN)) {
			$this->db->where('a.AssignAmgr',  0);
			$this->db->where('a.AssignMgr',  0);
		}

		// jika USER_GENERAL_MANAGER
		if (!strcmp($this->cok->field('HandlingType'), USER_GENERAL_MANAGER)) {
			$this->db->where('a.AssignAmgr',  $this->cok->field('UserId'));
			// $this->db->where('a.AssignMgr',  0);
			//$this->db->where('a.AssignAmgr',  0);
		}

		// jika admin ambil semua data yang ada .
		if (
			!strcmp($this->cok->field('HandlingType'), USER_MANAGER)
			or !strcmp($this->cok->field('HandlingType'), USER_ACCOUNT_MANAGER)
		) {
			/*$this->db->where( sprintf("( a.AssignAmgr='%s' OR a.AssignMgr='%s' )",
				$this->cok->field('GenaralManagerId'),
				$this->cok->field('UserId') ), '', false );*/
			//if($this->cok->field('GenaralManagerId')>0){
			//	$this->db->where( sprintf("( a.AssignAmgr='%s' OR a.AssignMgr='%s' )",
			//				$this->cok->field('GenaralManagerId'),
			//				$this->cok->field('UserId') ), '', false );
			//	$this->db->where('a.AssignSpv', 0);
			//} else {

			//	$this->db->where( sprintf("( a.AssignAmgr='%s' AND a.AssignMgr='%s' )",
			//				$this->cok->field('GenaralManagerId'),
			//				$this->cok->field('UserId') ), '', false );
			//	$this->db->where('a.AssignSpv', 0);
			//}
			$this->db->where('a.AssignMgr',  $this->cok->field('UserId'));
			$this->db->where('a.AssignSpv', 0);
		}

		// jika admin ambil semua data yang ada .
		if (!strcmp($this->cok->field('HandlingType'), USER_SUPERVISOR)) {
			$this->db->where('a.AssignSpv', $this->cok->field('UserId'));
			$this->db->where('a.AssignSelerId',  0);
		}

		// jika admin ambil semua data yang ada .
		if (!strcmp($this->cok->field('HandlingType'), USER_LEADER)) {
			$this->db->where('a.AssignLeader', $this->cok->field('UserId'));
			$this->db->where('a.AssignSelerId',  0);
		}


		// jika admin ambil semua data yang ada .
		if (!strcmp($this->cok->field('HandlingType'), USER_AGENT_INBOUND)) {
			$this->db->where('a.AssignSelerId', $this->cok->field('UserId'));
		}

		// jika admin ambil semua data yang ada .
		if (!strcmp($this->cok->field('HandlingType'), USER_AGENT_OUTBOUND)) {
			$this->db->where('a.AssignSelerId', $this->cok->field('UserId'));
		}


		// order di sesuiakna dengan field yang di sorting oleh
		// user di client.

		if ($this->out->find_value("group_by")) {
			$this->db->group_by($this->out->field("orderby"), $this->out->field("type"));
		} else {
			$this->db->group_by("b.DM_Id,b.DM_CampaignId");
		}
		if ($this->out->find_value("orderby")) {
			$this->db->order_by($this->out->field("orderby"), $this->out->field("type"));
		} else {
			$this->db->order_by("a.AssignId", "DESC");
		}
		//var_dump($this->cok->field('HandlingType'));
		// echo "<pre>" . $this->db->print_out() . "</pre>";

		// query limit untuk page langsung di tuju ke query
		// selector saja , untuk performance data ketika
		// user melakukan select data .

		if (is_object($std)) {
			if ($std->post_page) {
				$std->start_page = (($std->post_page - 1) * $std->per_page);
			} else {
				$std->start_page = 0;
			}
			// set on limite data
			$this->db->limit($std->per_page, $std->start_page);
		}


		// cetak untuk debugging saja .
		//  $this->db->print_out();
		$qry = $this->db->get();

		//   var_dump($this->db->last_query());

		// jika terjadi error maka tampilkan errornya
		if (!$qry) {
			debug($this->db->_error_message());
		}

		// ambil query dataprocess result OK
		if ($qry && $qry->num_rows() > 0) {
			$result_array = (array)$qry->result_assoc();
		}
		return (array)$result_array;
	}
//   edit hilman
//  function _select_page_distribute( $out= null, $field = null, $std = null )
//  {

// // tankap semua varibale dari process search 
//   $this->out = $out;
//   $this->cok = CK();
//   $this->cof = CF();
   
//  //  debug($this->out);
//  // define all variable  $ar_call_not_interest = array_keys(CallResultInterest());	
//   $result_array = array();
  
// // inull then get default ----------------
 
//  $this->db->reset_select();
//  if( is_null($field)) {
	 
// 	$this->db->select('
// 		a.AssignId 				AS DistAssignId,  
// 		b.DM_Custno 			AS DM_Custno,
// 		b.DM_FirstName 			AS DM_FirstName,
// 		b.DM_CampaignId 		AS DM_CampaignId, 
// 		b.DM_MotherName 		AS DM_MotherName,
// 		b.DM_Dob 				AS DM_Dob,
// 		b.DM_Age 				AS DM_Age,
// 		b.DM_CrLimit 			AS DM_CrLimit,
// 		b.DM_DataAvailSS        as DM_DataAvailSS,
// 		b.DM_CcLimit 			AS DM_CcLimit,
// 		b.DM_CcTypeName 		AS DM_CcTypeName,
// 		b.DM_GenderId 			AS DM_GenderId,
// 		b.DM_AddressLine1 		AS DM_AddressLine1,
// 		b.DM_AddressLine2 		AS DM_AddressLine2,
// 		b.DM_AddressLine3 		AS DM_AddressLine3,
// 		b.DM_AddressLine4 		AS DM_AddressLine4,
// 		b.DM_HomePhoneNum 		AS DM_HomePhoneNum,
// 		b.DM_MobilePhoneNum 	AS DM_MobilePhoneNum,
// 		b.DM_OtherPhoneNum 		AS DM_OtherPhoneNum,
// 		b.DM_OfficeName 		AS DM_OfficeName,
// 		b.DM_CallReasonId 		AS DM_CallReasonId,
// 		b.DM_CallCategoryId 	AS DM_CallCategoryId,
// 		b.DM_CallReasonId 		AS DM_CallReasonId,
// 		b.DM_LastCategoryKode 	AS DM_LastCategoryKode,
// 		b.DM_LastReasonKode 	AS DM_LastReasonKode,
// 		b.DM_Dob 				AS DM_Dob, 
// 		b.DM_SellerId 			AS DM_SellerId,
// 		b.DM_City 				AS DM_City, 
// 		a.AssignMode 			as DM_Assign_Mode,
// 		b.DM_FixId				as DM_FixId,
// 		b.DM_IdentificationNum  as DM_IdentificationNum,
// 		a.AssignDate 			AS DM_AssignDateTs,
// 		b.DM_UpdatedTs 			AS DM_UpdatedTs', 
		
// 		FALSE); 
//  } else {
// 	$this->db->select($field, FALSE); 
//  }
 
//  $this->db->from("t_gn_assignment a");
//  $this->db->join("t_gn_customer_master b "," a.AssignCustId=b.DM_Id", "INNER");
//  $this->db->join("t_gn_customer_verification cv "," cv.CV_Data_CustId=b.DM_Id", "INNER");
//  $this->db->join("t_gn_campaign c "," b.DM_CampaignId = c.CampaignId", "INNER");
//  $this->db->where("a.AssignBlock", 0);
 
//  // ini berlaku hanya untuk kondisi tertentu.
//  $this->db->where_in('b.DM_CallCategoryId', array(NSTS), FALSE);
 
//  // filter expired data customer expired data 
//  //$this->db->where( sprintf("b.DM_DateExpired>='%s 00:00:00'", date('Y-m-d')), "", FALSE);
//  $this->db->where( sprintf("c.CampaignEndDate>='%s 00:00:00'", date('Y-m-d')), "", FALSE);

// //filter data tidak boleh reason"APMT"
//  $this->db->where( sprintf("b.DM_CallReasonId != 50"));

//  // filter data yang pertama by campaign 
//  if( $this->out->find_value('dis_campaign_name') ){
// 	 $this->db->where_in("b.DM_CampaignId", $this->out->fields('dis_campaign_name'));
//  }
 
//  // filter by recsource jika memang ada 
//  if( $this->out->find_value('dis_recsource_name') ){
// 	 $this->db->where_in("b.DM_Recsource", $this->out->fields('dis_recsource_name'));
//  }
 
//  // tanggal start assign yang dimaksud.
//  if( $this->out->find_value('dis_assign_date_start_date') ){
// 	 $this->db->where(sprintf("a.AssignDate>='%s 00:00:00'", $this->out->field('dis_assign_date_end_date', 'SetDate')), "", FALSE );
//  }
//  if( $this->out->find_value('dis_assign_date_end_date') ){
// 	 $this->db->where(sprintf("a.AssignDate<='%s 23:59:59'", $this->out->field('dis_assign_date_end_date', 'SetDate')), "", FALSE );
//  }
 
//  // tanggal update di customer jika sudah ada .
//  if( $this->out->find_value('dis_update_start_date') ){
// 	 $this->db->where(sprintf("b.DM_UpdatedTs>='%s 00:00:00'", $this->out->field('dis_update_start_date', 'SetDate')), "", FALSE );
//  }
//  if( $this->out->find_value('dis_update_end_date') ){
// 	 $this->db->where(sprintf("b.DM_UpdatedTs<='%s 23:59:59'", $this->out->field('dis_update_end_date', 'SetDate')), "", FALSE );
//  }
 
//  // filter by CallStatus / Call Kategory ID 
//  if( $this->out->find_value('dis_call_status') ){
// 	$this->db->where_in("b.DM_CallCategoryId", $this->out->fields('dis_call_status'));
//  }

//  if( $this->out->find_value('cycle') ){
// 	$this->db->where_in("cv.CV_Data_Cycle", $this->out->fields('cycle'));
//  }
 
// // dis_range_age_start 
// if( $this->out->find_value('dis_range_age_start' ) ) {
// 	$this->db->where(sprintf("b.DM_Age>=%d", $this->out->field('dis_range_age_start')), "", FALSE );
// }
 
// // dis_range_age_stop 
// if( $this->out->find_value('dis_range_age_stop' ) ) {
// 	$this->db->where(sprintf("b.DM_Age<=%d", $this->out->field('dis_range_age_stop')), "", FALSE );
// }


// // dis_avail_ss_start 
// if( $this->out->find_value('dis_avail_ss_start' ) ) {
// 	$this->db->where(sprintf("b.DM_DataAvailSS>=%d", $this->out->field('dis_avail_ss_start')), "", FALSE );
// }

// // dis_avail_ss_stop 
// if( $this->out->find_value('dis_avail_ss_stop' ) ) {
// 	$this->db->where(sprintf("b.DM_DataAvailSS<=%d", $this->out->field('dis_avail_ss_stop')), "", FALSE );
// }
 
// // dis_kredit_limit_start 
// if( $this->out->find_value('dis_kredit_limit_start' ) ) {
// 	$this->db->where(sprintf("b.DM_CrLimit>=%d", $this->out->field('dis_kredit_limit_start')), "", FALSE );
// }            

// // dis_kredit_limit_stop 
// if( $this->out->find_value('dis_kredit_limit_stop' ) ) {
// 	$this->db->where(sprintf("b.DM_CrLimit<=%d", $this->out->field('dis_kredit_limit_stop')), "", FALSE );
// }            
 
// // filter step ke - 2 by Session User Login  
//  if( !strcmp( $this->cok->field('HandlingType'), USER_ROOT) ){
// 	$this->db->where_in('a.AssignAdmin', $this->cof->field('default_admin'));
// 	$this->db->where('a.AssignAmgr',  0);
// 	$this->db->where('a.AssignMgr',  0);
//  } 
 
//  // jika admin ambil semua data yang ada .
//  if( !strcmp( $this->cok->field('HandlingType'), USER_ADMIN) ){
// 	$this->db->where('a.AssignAmgr',  0);
// 	$this->db->where('a.AssignMgr',  0);
//  } 
 
//  // jika USER_GENERAL_MANAGER
//  if( !strcmp( $this->cok->field('HandlingType'), USER_GENERAL_MANAGER) ){
// 	$this->db->where('a.AssignAmgr',  $this->cok->field('UserId'));
// 	$this->db->where('a.AssignMgr',  0);
// 	//$this->db->where('a.AssignAmgr',  0);
//  } 
 
// // jika admin ambil semua data yang ada .
//  if( !strcmp( $this->cok->field('HandlingType'), USER_MANAGER) 
// 	 OR !strcmp( $this->cok->field('HandlingType'), USER_ACCOUNT_MANAGER) ){
// 	/*$this->db->where( sprintf("( a.AssignAmgr='%s' OR a.AssignMgr='%s' )", 
// 				$this->cok->field('GenaralManagerId'), 
// 				$this->cok->field('UserId') ), '', false );*/
// 	//if($this->cok->field('GenaralManagerId')>0){
// 	//	$this->db->where( sprintf("( a.AssignAmgr='%s' OR a.AssignMgr='%s' )", 
// 	//				$this->cok->field('GenaralManagerId'), 
// 	//				$this->cok->field('UserId') ), '', false );
// 	//	$this->db->where('a.AssignSpv', 0);
// 	//} else {
		
// 	//	$this->db->where( sprintf("( a.AssignAmgr='%s' AND a.AssignMgr='%s' )", 
// 	//				$this->cok->field('GenaralManagerId'), 
// 	//				$this->cok->field('UserId') ), '', false );
// 	//	$this->db->where('a.AssignSpv', 0);
// 	//}
// 	$this->db->where('a.AssignMgr',  $this->cok->field('UserId'));
// 	$this->db->where('a.AssignSpv', 0);
//  }

//  // jika admin ambil semua data yang ada .
//  if( !strcmp( $this->cok->field('HandlingType'), USER_SUPERVISOR) ){
// 	$this->db->where('a.AssignSpv', $this->cok->field('UserId'));
// 	$this->db->where('a.AssignSelerId',  0);
//  }
 
//   // jika admin ambil semua data yang ada .
//  if( !strcmp( $this->cok->field('HandlingType'), USER_LEADER) ){
// 	$this->db->where('a.AssignLeader', $this->cok->field('UserId'));
// 	$this->db->where('a.AssignSelerId',  0);
//  }
 
 
//  // jika admin ambil semua data yang ada .
//  if( !strcmp( $this->cok->field('HandlingType'), USER_AGENT_INBOUND) ){
// 	$this->db->where('a.AssignSelerId', $this->cok->field('UserId')); 
//  } 
 
//  // jika admin ambil semua data yang ada .
//  if( !strcmp( $this->cok->field('HandlingType'), USER_AGENT_OUTBOUND) ){
// 	$this->db->where('a.AssignSelerId', $this->cok->field('UserId')); 
//  } 
  
  
// // order di sesuiakna dengan field yang di sorting oleh 
// // user di client.

//  if( $this->out->find_value("orderby") ){
// 	$this->db->order_by($this->out->field("orderby"), $this->out->field("type") );
//  } else {
// 	$this->db->order_by("a.AssignId", "DESC");
//  }
 
//  //var_dump($this->cok->field('HandlingType'));
//  	// echo "<pre>".$this->db->print_out()."</pre>";
 
//  // query limit untuk page langsung di tuju ke query 
//  // selector saja , untuk performance data ketika 
//  // user melakukan select data .
 
// 	if( is_object( $std ) ) {
// 		if( $std->post_page ) {
// 			$std->start_page = (($std->post_page-1)*$std->per_page);
// 		} 
// 		else {	
// 			$std->start_page = 0;
// 		}
// 	 // set on limite data 
// 		$this->db->limit( $std->per_page, $std->start_page);
// 	}
	
 
// // cetak untuk debugging saja .
// // $this->db->print_out();
//   $qry = $this->db->get();
// //  var_dump($this->db->last_query());die;
//  // jika terjadi error maka tampilkan errornya 
//  if( !$qry ){
// 	 debug( $this->db->_error_message() ); 
//  }
 
//  // ambil query dataprocess result OK 
//  if( $qry && $qry->num_rows() > 0 ){
// 	$result_array = (array)$qry->result_assoc();
//   }
//   return (array)$result_array;
// } 

/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
 
function _select_count_distribute( $out = null  ){
	
// tankap semua varibale dari process search 
  $this->out = $out;
  $this->cok = CK();
  $this->cof = CF();
  
  $result_total = 0;
  
// inull then get default ----------------
// echo "<pre>";
 // print_r($_SESSION);
// echo "</pre>";
 $this->db->reset_select();
 $this->db->select("count(a.AssignId) as total", FALSE); 
 $this->db->from("t_gn_assignment a");
 $this->db->join("t_gn_customer_master b "," a.AssignCustId=b.DM_Id", "INNER");
 $this->db->join("t_gn_customer_verification cv "," cv.CV_Data_CustId=b.DM_Id", "INNER");
 $this->db->join("t_gn_campaign c "," b.DM_CampaignId = c.CampaignId", "INNER");
 $this->db->where("a.AssignBlock", 0);
 
 // ini berlaku hanya untuk kondisi tertentu.
 $this->db->where_in('b.DM_CallCategoryId', array(NSTS), FALSE);
 
 // filter expired data customer expired data 
 //$this->db->where( sprintf("b.DM_DateExpired>='%s 00:00:00'", date('Y-m-d')), "", FALSE);
 $this->db->where( sprintf("c.CampaignEndDate>='%s 00:00:00'", date('Y-m-d')), "", FALSE);
 $this->db->where("c.CampaignStatusFlag",1);
 //filter data tidak boleh callreason"APMT"
 // $this->db->where( sprintf("b.DM_CallReasonId != 50"));

 // filter data yang pertama by campaign 
 if( $this->out->find_value('dis_campaign_name') ){
	 $this->db->where_in("b.DM_CampaignId", $this->out->fields('dis_campaign_name'));
 }
 
 // filter by recsource jika memang ada 
 if( $this->out->find_value('dis_recsource_name') ){
	 $this->db->where_in("b.DM_Recsource", $this->out->fields('dis_recsource_name'));
 }
 
 // tanggal start assign yang dimaksud.
 if( $this->out->find_value('dis_assign_date_start_date') ){
	 $this->db->where(sprintf("a.AssignDate>='%s 00:00:00'", $this->out->field('dis_assign_date_end_date', 'SetDate')), "", FALSE );
 }
 if( $this->out->find_value('dis_assign_date_end_date') ){
	 $this->db->where(sprintf("a.AssignDate<='%s 23:59:59'", $this->out->field('dis_assign_date_end_date', 'SetDate')), "", FALSE );
 }
 
 // tanggal update di customer jika sudah ada .
 if( $this->out->find_value('dis_update_start_date') ){
	 $this->db->where(sprintf("b.DM_UpdatedTs>='%s 00:00:00'", $this->out->field('dis_update_start_date', 'SetDate')), "", FALSE );
 }
 if( $this->out->find_value('dis_update_end_date') ){
	 $this->db->where(sprintf("b.DM_UpdatedTs<='%s 23:59:59'", $this->out->field('dis_update_end_date', 'SetDate')), "", FALSE );
 }
 
 // filter by CallStatus / Call Kategory ID 
 if( $this->out->find_value('dis_call_status') ){
	$this->db->where_in("b.DM_CallCategoryId", $this->out->fields('dis_call_status'));
 }

 if( $this->out->find_value('cycle') ){
	$this->db->where_in("cv.CV_Data_Cycle", $this->out->fields('cycle'));
 }
 
// dis_range_age_start 
 if( $this->out->find_value('dis_range_age_start' ) ) {
	$this->db->where(sprintf("b.DM_Age>=%d", $this->out->field('dis_range_age_start')), "", FALSE );
 }
 
// dis_range_age_stop 
 if( $this->out->find_value('dis_range_age_stop' ) ) {
	$this->db->where(sprintf("b.DM_Age<=%d", $this->out->field('dis_range_age_stop')), "", FALSE );
 }


// dis_avail_ss_start 
 if( $this->out->find_value('dis_avail_ss_start' ) ) {
	$this->db->where(sprintf("cv.CV_Data_AvailSS>=%d", $this->out->field('dis_avail_ss_start')), "", FALSE );
 }

// dis_avail_ss_stop 
 if( $this->out->find_value('dis_avail_ss_stop' ) ) {
	$this->db->where(sprintf("cv.CV_Data_AvailSS<=%d", $this->out->field('dis_avail_ss_stop')), "", FALSE );
 }
 
// dis_kredit_limit_start 
 if( $this->out->find_value('dis_kredit_limit_start' ) ) {
	$this->db->where(sprintf("b.DM_CrLimit>=%d", $this->out->field('dis_kredit_limit_start')), "", FALSE );
 }            

// dis_kredit_limit_stop 
 if( $this->out->find_value('dis_kredit_limit_stop' ) ) {
	$this->db->where(sprintf("b.DM_CrLimit<=%d", $this->out->field('dis_kredit_limit_stop')), "", FALSE );
 }
 
// filter step ke - 2 by Session User Login  
 if( !strcmp( $this->cok->field('HandlingType'), USER_ROOT) ){
	$this->db->where_in('a.AssignAdmin', $this->cof->field('default_admin'));
	$this->db->where('a.AssignAmgr',  0);
	$this->db->where('a.AssignMgr',  0);
 } 
 
 // jika admin ambil semua data yang ada .
 if( !strcmp( $this->cok->field('HandlingType'), USER_ADMIN) ){
	$this->db->where('a.AssignAmgr',  0);
	$this->db->where('a.AssignMgr',  0);
 } 
 
 // jika admin ambil semua data yang ada .
 if( !strcmp( $this->cok->field('HandlingType'), USER_GENERAL_MANAGER) ){
	//$this->db->where('a.AssignMgr',  $this->cok->field('UserId'));
	$this->db->where('a.AssignAmgr',  $this->cok->field('UserId'));
	$this->db->where('a.AssignMgr',  0);
 } 

// jika admin ambil semua data yang ada .
 if( !strcmp( $this->cok->field('HandlingType'), USER_MANAGER) 
	 OR !strcmp( $this->cok->field('HandlingType'), USER_ACCOUNT_MANAGER) ){
	//$this->db->where( sprintf("( a.AssignAmgr='%s' OR a.AssignMgr='%s' )", 
	//			$this->cok->field('GenaralManagerId'), 
	//			$this->cok->field('UserId') ), '', false );
	//if($this->cok->field('GenaralManagerId')>0){
	//	$this->db->where( sprintf("( a.AssignAmgr='%s' OR a.AssignMgr='%s' )", 
	//				$this->cok->field('GenaralManagerId'), 
	//				$this->cok->field('UserId') ), '', false );
	//	$this->db->where('a.AssignSpv', 0);
	//} else {
		
	//	$this->db->where( sprintf("( a.AssignAmgr='%s' AND a.AssignMgr='%s' )", 
	//				$this->cok->field('GenaralManagerId'), 
	//				$this->cok->field('UserId') ), '', false );
	//	$this->db->where('a.AssignSpv', 0);
	//}
	$this->db->where('a.AssignMgr',  $this->cok->field('UserId'));
	$this->db->where('a.AssignSpv', 0);
 }

 // jika admin ambil semua data yang ada .
 if( !strcmp( $this->cok->field('HandlingType'), USER_SUPERVISOR) ){
	$this->db->where('a.AssignSpv', $this->cok->field('UserId'));
	$this->db->where('a.AssignSelerId',  0);
 }
 
  // jika admin ambil semua data yang ada .
 if( !strcmp( $this->cok->field('HandlingType'), USER_LEADER) ){
	$this->db->where('a.AssignLeader', $this->cok->field('UserId'));
	$this->db->where('a.AssignSelerId',  0);
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
// $this->db->print_out();
 $qry = $this->db->get();
 // jika terjadi error maka tampilkan errornya 
 if( !$qry ){
	 debug( $this->db->_error_message() ); 
 }
 
 // ambil query dataprocess result OK 
 if( $qry && $qry->num_rows() > 0 ){
	$result_total = $qry->result_singgle_value();
  }
  return (int)$result_total;
}
 
/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
 
 function _select_page_transfer( $out  = null, $field = null, $std = null )
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
		a.AssignId 				AS TransAssignId,  
		b.DM_Custno 			AS DM_Custno,
		b.DM_FirstName 			AS DM_FirstName,
		b.DM_CampaignId 		AS DM_CampaignId, 
		b.DM_MotherName 		AS DM_MotherName,
		b.DM_Dob 				AS DM_Dob,
		b.DM_Age 				AS DM_Age,
		b.DM_CrLimit 			AS DM_CrLimit,
		b.DM_CcLimit 			AS DM_CcLimit,
		b.DM_DataAvailSS        as DM_DataAvailSS,
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
		a.AssignSelerId 		AS DM_SellerId,
		b.DM_City 				AS DM_City, 
		a.AssignMode 			as DM_Assign_Mode,
		a.AssignDate 			AS DM_AssignDateTs,
		b.DM_UpdatedTs 			AS DM_UpdatedTs', 
		
		FALSE); 
 } else {
	$this->db->select($field, FALSE); 
 }
 
 $this->db->from("t_gn_assignment a");
 $this->db->join("t_gn_customer_master b "," a.AssignCustId=b.DM_Id", "INNER");
 $this->db->join("t_gn_campaign c "," b.DM_CampaignId = c.CampaignId", "INNER");
  
 // ini berlaku hanya untuk kondisi tertentu.
  // $this->db->where_not_in('b.DM_CallCategoryId', array(NSTS,CLOS, APRV, YCOM, NCOM,RJCK));
  $this->db->where_not_in('b.DM_CallCategoryId', array(NSTS,'4','5',CLOS,'8','14'));
  // $this->db->where_not_in('b.DM_CallCategoryId', array(NSTS,NOCT,DECL,INVD,CLOS, YCOM, NCOM,RJCK));
  $this->db->where_not_in('b.DM_QualityCategoryId', array(NSTS,CLOS));																							   
  // $this->db->where_not_in('b.DM_QualityCategoryId', array(CLOS));
 //filter callreason APMT tidak tampil
  // $this->db->where_not_in('b.DM_CallReasonId', array(50));
 
 // filter expired data customer expired data 
 
 //$this->db->where( sprintf("b.DM_DateExpired>='%s'", date('Y-m-d')), "", FALSE);
 $this->db->where( sprintf("c.CampaignEndDate>='%s'", date('Y-m-d')), "", FALSE);
 $this->db->where("b.DM_AdmId", 0);
 $this->db->where("b.DM_Followup", 0);
 
 
 // filter data yang pertama by campaign 
 
 if( $this->out->find_value('trans_from_campaign_id') ){
	 $this->db->where_in("b.DM_CampaignId", $this->out->fields('trans_from_campaign_id'));
 }
 
 // filter by recsource jika memang ada 
 if( $this->out->find_value('trans_from_recsource') ){
	 $this->db->where_in("b.DM_Recsource", $this->out->fields('trans_from_recsource'));
 }	 
 // tanggal update di customer jika sudah ada .
 if( $this->out->find_value('trans_call_start_date') ){
	 $this->db->where(sprintf("b.DM_UpdatedTs>='%s 00:00:00'", $this->out->field('trans_call_start_date', 'SetDate')), "", FALSE );
 }
 if( $this->out->find_value('trans_end_start_date') ){
	 $this->db->where(sprintf("b.DM_UpdatedTs<='%s 23:59:59'", $this->out->field('trans_end_start_date', 'SetDate')), "", FALSE );
 }
 
 // filter by CallStatus / Call Kategory ID 
 // call category status In "Selller" 
 if( $this->out->find_value('trans_call_category_id') ){
	$this->db->where_in("b.DM_CallCategoryId", $this->out->fields('trans_call_category_id'));
	// $this->db->or_where_in('b.DM_QualityCategoryId', $this->out->fields('trans_call_category_id'));
 }
 
 // call reason  status In "Selller"
 if( $this->out->find_value('trans_call_result_id') ){
	$this->db->where_in("b.DM_CallReasonId", $this->out->fields('trans_call_result_id'));
	// $this->db->or_where_in("b.DM_QualityReasonId", $this->out->fields('trans_call_result_id'));
 }
 
 // get data user handler on this assign 
 // on filter process .
 if( $this->out->find_value('trans_from_user_group') ){
	// check data process 
	$this->str_where = $this->_select_page_field_data($this->out->field('trans_from_user_group'));
	if( !is_bool( $this->str_where ) 
	and count($this->out->fields('trans_form_user_list')) ) {
		
		$this->db->where_in($this->str_where,  $this->out->fields('trans_form_user_list'));
	}	
 }
  
	// trans_range_age_start 
	if( $this->out->find_value('trans_range_age_start' ) ) {
		$this->db->where(sprintf("b.DM_Age>=%d", $this->out->field('trans_range_age_start')), "", FALSE );
	}
	 
	// trans_range_age_stop 
	if( $this->out->find_value('trans_range_age_stop' ) ) {
		$this->db->where(sprintf("b.DM_Age<=%d", $this->out->field('trans_range_age_stop')), "", FALSE );
	}


	// transavail_ss_start 
	if( $this->out->find_value('trans_avail_ss_start' ) ) {
		$this->db->where(sprintf("b.DM_DataAvailSS>=%d", $this->out->field('trans_avail_ss_start')), "", FALSE );
	}

	// trans_avail_ss_stop 
	if( $this->out->find_value('trans_avail_ss_stop' ) ) {
		$this->db->where(sprintf("b.DM_DataAvailSS<=%d", $this->out->field('trans_avail_ss_stop')), "", FALSE );
	}
	 
	// trans_kredit_limit_start 
	if( $this->out->find_value('trans_kredit_limit_start' ) ) {
		$this->db->where(sprintf("b.DM_CrLimit>=%d", $this->out->field('trans_kredit_limit_start')), "", FALSE );
	}            

	// trans_kredit_limit_stop 
	if( $this->out->find_value('trans_kredit_limit_stop' ) ) {
		$this->db->where(sprintf("b.DM_CrLimit<=%d", $this->out->field('trans_kredit_limit_stop')), "", FALSE );
	}            
	 
  // field filter data process "TRANS_FIELD_VALUE1"
 
 if( $this->out->field('trans_field_value1') ){
	// check jika false gak usah  
	$sqlstr = $this->_select_page_like_data( $this->out->field('trans_field_value1'), 
													$this->out->field('trans_field_filter1'),
													$this->out->fields('trans_field_text1'));
	
	if( is_string($sqlstr) ){
		$this->db->where($sqlstr, '', FALSE );
	}
								   
 }
 
// trans_range_age_start 
 if( $this->out->find_value('trans_range_age_start' ) ) {
 	$this->db->where(sprintf("b.DM_Age>=%d", $this->out->field('trans_range_age_start')), "", FALSE );
 }
  
 // trans_range_age_stop 
 if( $this->out->find_value('trans_range_age_stop' ) ) {
 	$this->db->where(sprintf("b.DM_Age<=%d", $this->out->field('trans_range_age_stop')), "", FALSE );
 }
 
 
 // transavail_ss_start 
 if( $this->out->find_value('trans_avail_ss_start' ) ) {
 	$this->db->where(sprintf("b.DM_DataAvailSS>=%d", $this->out->field('trans_avail_ss_start')), "", FALSE );
 }
 
 // trans_avail_ss_stop 
 if( $this->out->find_value('trans_avail_ss_stop' ) ) {
 	$this->db->where(sprintf("b.DM_DataAvailSS<=%d", $this->out->field('trans_avail_ss_stop')), "", FALSE );
 }
  
 // trans_kredit_limit_start 
 if( $this->out->find_value('trans_kredit_limit_start' ) ) {
 	$this->db->where(sprintf("b.DM_CrLimit>=%d", $this->out->field('trans_kredit_limit_start')), "", FALSE );
 }            
 
 // trans_kredit_limit_stop 
 if( $this->out->find_value('trans_kredit_limit_stop' ) ) {
 	$this->db->where(sprintf("b.DM_CrLimit<=%d", $this->out->field('trans_kredit_limit_stop')), "", FALSE );
 }            
  

 // filter step ke - 2 by Session User Login  
 if( !strcmp( $this->cok->field('HandlingType'), USER_ROOT) ){
	$this->db->where_in('a.AssignAdmin', $this->cof->field('default_admin'));
	$this->db->where('( a.AssignAmgr<>0  OR a.AssignMgr <> 0 OR 
						a.AssignSpv <> 0  OR a.AssignLeader <> 0  OR a.AssignSelerId <> 0 )', '', false);
 } 
 
 // jika admin ambil semua data yang ada .
 if( !strcmp( $this->cok->field('HandlingType'), USER_ADMIN) ){
	$this->db->where('( a.AssignAmgr<>0  OR a.AssignMgr <> 0  OR a.AssignSpv <> 0 
						OR a.AssignLeader <> 0  OR a.AssignSelerId <> 0 )', '', false);
 } 
 
 // jika admin ambil semua data yang ada .
 if( !strcmp( $this->cok->field('HandlingType'), USER_ACCOUNT_MANAGER) ){
	$this->db->where('a.AssignMgr',  $this->cok->field('UserId'));
	$this->db->where('( a.AssignMgr <> 0  OR a.AssignSpv <> 0 OR a.AssignLeader <> 0  OR a.AssignSelerId <> 0 )',  '', false);
 } 
 
 // jika admin ambil semua data yang ada .
 // if( @in_array($this->cok->field('HandlingType'), array(USER_MANAGER, USER_ACCOUNT_MANAGER) )) {
	// $this->db->where(sprintf( "(a.AssignAmgr='%d' OR a.AssignMgr='%d')",  $this->cok->field('GenaralManagerId'), $this->cok->field('UserId') ), '', false);
	// $this->db->where('( a.AssignSpv <> 0 OR a.AssignLeader <> 0 OR a.AssignSelerId <> 0 )', '', false);
 // }

 // jika admin ambil semua data yang ada .
 if( !strcmp( $this->cok->field('HandlingType'), USER_SUPERVISOR) ){
	$this->db->where('a.AssignSpv', $this->cok->field('UserId'));
	//remarks sementara buat ucen ngeselin
	// $this->db->where('( a.AssignLeader <> 0  #OR a.AssignSelerId <> 0)', '', false);
	// $this->db->where('( a.AssignLeader <> 0 )', '', false);
	$this->db->where("a.AssignBlock", 0);
 }
 
  // jika admin ambil semua data yang ada .
 if( !strcmp( $this->cok->field('HandlingType'), USER_LEADER) ){
	$this->db->where('a.AssignLeader', $this->cok->field('UserId'));
	$this->db->where('a.AssignSelerId<>0',  '', false);
	$this->db->where("a.AssignBlock", 0);
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
 
// echo "<pre>".$this->db->print_out()."</pre>";
 // query limit untuk page langsung di tuju ke query 
 // selector saja , untuk performance data ketika 
 // user melakukan select data .
 
 if( is_object( $std ) ) {
	if( $std->post_page ) {
		$std->start_page = (($std->post_page-1)*$std->per_page);
	} 
	else {	
		$std->start_page = 0;
	}
	
	// set on limite data 
	$this->db->limit( $std->per_page, $std->start_page);
 }
	
	
 
 
// cetak untuk debugging saja .
// $this->db->print_out();
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
  
  
/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
 
 function _select_count_transfer( $out  = null  )
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
 $this->db->join("t_gn_customer_master b "," a.AssignCustId=b.DM_Id", "INNER");
 $this->db->join("t_gn_campaign c "," b.DM_CampaignId = c.CampaignId", "INNER");
 $this->db->where("a.AssignBlock", 0);
 $this->db->where("b.DM_Followup", 0);

 
 // ini berlaku hanya untuk kondisi tertentu.
 // $this->db->where_not_in('b.DM_CallCategoryId', array_map('intval', array(NSTS,CLOS, RDPC, APRV, YCOM, NCOM,RJCK)));
  // $this->db->where_not_in('b.DM_CallCategoryId', array(NSTS,CLOS, APRV, YCOM, NCOM,RJCK));
  $this->db->where_not_in('b.DM_CallCategoryId', array(NSTS, '4','5',CLOS,'8','14'));
  // $this->db->where_not_in('b.DM_CallCategoryId', array(NSTS,NOCT,DECL,INVD,CLOS, YCOM, NCOM,RJCK));
  $this->db->where_not_in('b.DM_QualityCategoryId', array(NSTS,CLOS));																							   
  // $this->db->where_not_in('b.DM_QualityCategoryId', array(CLOS));
 
 // filter expired data customer expired data 
 //$this->db->where( sprintf("b.DM_DateExpired>='%s'", date('Y-m-d')), "", FALSE);
 $this->db->where( sprintf("c.CampaignEndDate>='%s'", date('Y-m-d')), "", FALSE);
 
 //filter callreason APMT tidak tampil
  // $this->db->where_not_in('b.DM_CallReasonId', array(50));
 
 // filter data yang pertama by campaign 
 
 if( $this->out->find_value('trans_from_campaign_id') ){
	 $this->db->where_in("b.DM_CampaignId", $this->out->fields('trans_from_campaign_id'));
 }
 
 // filter by recsource jika memang ada 
 if( $this->out->find_value('trans_from_recsource') ){
	 $this->db->where_in("b.DM_Recsource", $this->out->fields('trans_from_recsource'));
 }	 
 // tanggal update di customer jika sudah ada .
 if( $this->out->find_value('trans_call_start_date') ){
	 $this->db->where(sprintf("b.DM_UpdatedTs>='%s 00:00:00'", $this->out->field('trans_call_start_date', 'SetDate')), "", FALSE );
 }
 if( $this->out->find_value('trans_end_start_date') ){
	 $this->db->where(sprintf("b.DM_UpdatedTs<='%s 23:59:59'", $this->out->field('trans_end_start_date', 'SetDate')), "", FALSE );
 }
 
 // filter by CallStatus / Call Kategory ID 
 // call category status In "Selller" 
 if( $this->out->find_value('trans_call_category_id') ){
	$this->db->where_in("b.DM_CallCategoryId", $this->out->fields('trans_call_category_id'));
	// $this->db->or_where_in("b.DM_QualityCategoryId", $this->out->fields('trans_call_category_id'));
 }
 
 // call reason  status In "Selller"
 if( $this->out->find_value('trans_call_result_id') ){
	$this->db->where_in("b.DM_CallReasonId", $this->out->fields('trans_call_result_id'));
	// $this->db->or_where_in("b.DM_QualityReasonId", $this->out->fields('trans_call_result_id'));
 }
 
 // get data user handler on this assign 
 // on filter process .
 if( $this->out->find_value('trans_from_user_group') ){
	// check data process 
	$this->str_where = $this->_select_page_field_data($this->out->field('trans_from_user_group'));
	if( !is_bool( $this->str_where ) 
	and count($this->out->fields('trans_form_user_list') )) {
		$this->db->where_in($this->str_where,  $this->out->fields('trans_form_user_list'));
	}	
 }
 
  // field filter data process "TRANS_FIELD_VALUE1"
 
 if( $this->out->field('trans_field_value1') ){
	// check jika false gak usah  
	$sqlstr = $this->_select_page_like_data( $this->out->field('trans_field_value1'), 
													$this->out->field('trans_field_filter1'),
													$this->out->fields('trans_field_text1'));
	
	if( is_string($sqlstr) ){
		$this->db->where($sqlstr, '', FALSE );
	}
								   
 }
 
 // filter step ke - 2 by Session User Login  
 if( !strcmp( $this->cok->field('HandlingType'), USER_ROOT) ){
	$this->db->where_in('a.AssignAdmin', $this->cof->field('default_admin'));
	$this->db->where('( a.AssignAmgr<>0  OR a.AssignMgr <> 0 OR a.AssignSpv <> 0  OR a.AssignLeader <> 0  OR a.AssignSelerId <> 0 )', '', false);
 } 
 
 // jika admin ambil semua data yang ada .
 if( !strcmp( $this->cok->field('HandlingType'), USER_ADMIN) ){
	$this->db->where('( a.AssignAmgr<>0 OR a.AssignMgr <> 0 OR a.AssignSpv <> 0 OR a.AssignLeader <> 0 OR a.AssignSelerId <> 0 )', '', false);
 } 
 
 // jika admin ambil semua data yang ada .
 if( !strcmp( $this->cok->field('HandlingType'), USER_ACCOUNT_MANAGER) ){
	$this->db->where('a.AssignMgr',  $this->cok->field('UserId'));
	$this->db->where('(a.AssignMgr <> 0 OR a.AssignSpv <> 0 OR a.AssignLeader <> 0 OR a.AssignSelerId <> 0)',  '', false);
 } 
 
 // jika admin ambil semua data yang ada .
 // USER_MANAGER|USER_ACCOUNT_MANAGER 
 // if( @in_array($this->cok->field('HandlingType'),
	// array(USER_MANAGER, USER_ACCOUNT_MANAGER) )) {
	// $this->db->where(sprintf("(a.AssignAmgr='%d' OR a.AssignMgr='%d')",  $this->cok->field('GenaralManagerId'),  $this->cok->field('UserId')), '', false);
	// $this->db->where('( a.AssignSpv <> 0 OR a.AssignLeader <> 0 OR a.AssignSelerId <> 0 )', '', false);
 // }
 
 // jika admin ambil semua data yang ada .
 if( !strcmp( $this->cok->field('HandlingType'), USER_SUPERVISOR) ){
	$this->db->where('a.AssignSpv', $this->cok->field('UserId'));
	//remarks sementara ucen ngeselin
	// $this->db->where('( a.AssignLeader <> 0 #OR a.AssignSelerId <> 0 )', '', false);
	// $this->db->where('( a.AssignLeader <> 0 )', '', false);
	$this->db->where("b.DM_AdmId", 0);
 }
 
 
// $this->db->where_or(array( 'a.AssignLeader'  => array( 'OR' => ''), 
						// 'a.AssignSelerId' => array( 'OR' => '') 
			// ));
 
	
 
  // jika admin ambil semua data yang ada .
 if( !strcmp( $this->cok->field('HandlingType'), USER_LEADER) ){
	$this->db->where('a.AssignLeader', $this->cok->field('UserId'));
	$this->db->where('a.AssignSelerId<>0',  '', false);
	$this->db->where("b.DM_AdmId", 0);
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
 // $this->db->print_out();
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
 
 function _select_page_pulldata( $out  = null, $field = null, $std = null )
{
	
 
// tankap semua varibale dari process search 
  $this->out = $out;
  $this->cok = CK();
  $this->cof = CF();
  
  $result_array = array();
  
// inull then get default ----------------
 
 $this->db->reset_select();
 if( is_null($field)) {
	 
	$this->db->select('
		a.AssignId 				AS PullAssignId,  
		b.DM_Custno 			AS DM_Custno,
		b.DM_FirstName 			AS DM_FirstName,
		b.DM_CampaignId 		AS DM_CampaignId, 
		b.DM_MotherName 		AS DM_MotherName,
		b.DM_Dob 				AS DM_Dob,
		b.DM_Age 				AS DM_Age,
		b.DM_CrLimit 			AS DM_CrLimit,
		b.DM_CcLimit 			AS DM_CcLimit,
		b.DM_DataAvailSS        as DM_DataAvailSS,
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
		b.DM_LastCategoryKode 	AS DM_LastCategoryKode,
		b.DM_LastReasonKode 	AS DM_LastReasonKode,
		b.DM_Dob 				AS DM_Dob, 
		b.DM_SellerId 			AS DM_SellerId,
		b.DM_City 				AS DM_City, 
		a.AssignMode 			AS DM_Assign_Mode,
		a.AssignDate 			AS DM_AssignDateTs,
		b.DM_UpdatedTs 			AS DM_UpdatedTs', 
			
		FALSE); 
 } else {
	$this->db->select($field, FALSE); 
 }
 
 $this->db->from("t_gn_assignment a");
 $this->db->join("t_gn_customer_master b "," a.AssignCustId=b.DM_Id", "INNER");
 $this->db->join("t_gn_campaign c "," b.DM_CampaignId = c.CampaignId", "INNER");
 $this->db->where("a.AssignBlock", 0);
 $this->db->where("b.DM_Followup", 0);

 
 // ini berlaku hanya untuk kondisi tertentu.
 $this->db->where_in('b.DM_CallCategoryId', array(NSTS));
 
 // filter expired data customer expired data 
 //$this->db->where( sprintf("b.DM_DateExpired>='%s'", date('Y-m-d')), "", FALSE);
 $this->db->where( sprintf("c.CampaignEndDate>='%s'", date('Y-m-d')), "", FALSE);
 
 //filter data tidak boleh reason"APMT"
 $this->db->where( sprintf("b.DM_CallReasonId != 50"));

 //filter data tidak boleh untuk callcategory RDPC
 $this->db->where_not_in('b.DM_CallCategoryId', array( RDPC));

 // filter data yang pertama by campaign 
 
 if( $this->out->find_value('pull_from_campaign_id') ){
	 $this->db->where_in("b.DM_CampaignId", $this->out->fields('pull_from_campaign_id'));
 }
 
 // filter by recsource jika memang ada 
 if( $this->out->find_value('pull_from_recsource') ){
	 $this->db->where_in("b.DM_Recsource", $this->out->fields('pull_from_recsource'));
 }
 
 // tanggal start assign yang dimaksud.
 // tanggal update di customer jika sudah ada .
 if( $this->out->find_value('pull_call_start_date') ){
	 $this->db->where(sprintf("b.DM_UpdatedTs>='%s 00:00:00'", $this->out->field('pull_call_start_date', 'SetDate')), "", FALSE );
 }
 if( $this->out->find_value('pull_end_start_date') ){
	 $this->db->where(sprintf("b.DM_UpdatedTs<='%s 23:59:59'", $this->out->field('pull_end_start_date', 'SetDate')), "", FALSE );
 }
 
 // filter by CallStatus / Call Kategory ID 
 if( $this->out->find_value('pull_call_category_id') ){
	$this->db->where_in("b.DM_CallCategoryId", $this->out->fields('pull_call_category_id'));
 }
 // call reason  status In "Selller"
 if( $this->out->find_value('pull_call_result_id') ){
	$this->db->where_in("b.DM_CallReasonId", $this->out->fields('pull_call_result_id'));
 }
 
 // get data user handler on this assign 
 // on filter process .
 if( $this->out->find_value('pull_from_user_group') ){
	// check data process 
	$this->str_where = $this->_select_page_field_data($this->out->field('pull_from_user_group'));
	if( !is_bool( $this->str_where ) 
		and count($this->out->fields('pull_form_user_list')) ) {
		$this->db->where_in( $this->str_where,  $this->out->fields('pull_form_user_list'));
	}	
 }
 
// field filter data process "TRANS_FIELD_VALUE1"
 
 if( $this->out->field('pull_field_value1') ){
	// check jika false gak usah  
	$sqlstr = $this->_select_page_like_data( $this->out->field('pull_field_value1'), 
													$this->out->field('pull_field_filter1'),
													$this->out->fields('pull_field_text1'));
	if( is_string($sqlstr) ){												
		$this->db->where($sqlstr, '', FALSE );
	}
 }
 
 
// pull_range_age_start 
 if( $this->out->find_value('pull_range_age_start' ) ) {
 	$this->db->where(sprintf("b.DM_Age>=%d", $this->out->field('pull_range_age_start')), "", FALSE );
 }
  
 // pull_range_age_stop 
 if( $this->out->find_value('pull_range_age_stop' ) ) {
 	$this->db->where(sprintf("b.DM_Age<=%d", $this->out->field('pull_range_age_stop')), "", FALSE );
 }
 
 
 // transavail_ss_start 
 if( $this->out->find_value('pull_avail_ss_start' ) ) {
 	$this->db->where(sprintf("b.DM_DataAvailSS>=%d", $this->out->field('pull_avail_ss_start')), "", FALSE );
 }
 
 // pull_avail_ss_stop 
 if( $this->out->find_value('pull_avail_ss_stop' ) ) {
 	$this->db->where(sprintf("b.DM_DataAvailSS<=%d", $this->out->field('pull_avail_ss_stop')), "", FALSE );
 }
  
 // pull_kredit_limit_start 
 if( $this->out->find_value('pull_kredit_limit_start' ) ) {
 	$this->db->where(sprintf("b.DM_CrLimit>=%d", $this->out->field('pull_kredit_limit_start')), "", FALSE );
 }            
 
 // pull_kredit_limit_stop 
 if( $this->out->find_value('pull_kredit_limit_stop' ) ) {
 	$this->db->where(sprintf("b.DM_CrLimit<=%d", $this->out->field('pull_kredit_limit_stop')), "", FALSE );
 }            
  
 
// filter step ke - 2 by Session User Login  
 if( !strcmp( $this->cok->field('HandlingType'), USER_ROOT) ){
	$this->db->where_in('a.AssignAdmin', $this->cof->field('default_admin'));
	$this->db->where('( a.AssignAmgr<>0 
						OR a.AssignMgr <> 0 
						OR a.AssignSpv <> 0 
						OR a.AssignLeader <> 0 
						OR a.AssignSelerId <> 0 )', '', false);
 } 
 
 // jika admin ambil semua data yang ada .
 if( !strcmp( $this->cok->field('HandlingType'), USER_ADMIN) ){
	$this->db->where('( a.AssignAmgr<>0 
						OR a.AssignMgr <> 0 
						OR a.AssignSpv <> 0 
						OR a.AssignLeader <> 0 
						OR a.AssignSelerId <> 0 )', '', false);
 } 
 
 // jika admin ambil semua data yang ada .
 if( !strcmp( $this->cok->field('HandlingType'), USER_GENERAL_MANAGER)){
	$this->db->where('a.AssignAmgr',  $this->cok->field('UserId'));
	$this->db->where('( a.AssignMgr <> 0 
						OR a.AssignSpv <> 0 
						OR a.AssignLeader <> 0 
						OR a.AssignSelerId <> 0 )',  '', false);
 } 
 
 //$this->cok->field('UserId')
 
 // jika admin ambil semua data yang ada . Kondisi Sebelumnya 
 // if( !strcmp( $this->cok->field('HandlingType'), USER_MANAGER)
	//  OR !strcmp( $this->cok->field('HandlingType'), USER_ACCOUNT_MANAGER)){
	// $this->db->where( sprintf( "( a.AssignMgr=%d OR a.AssignAmgr=%d )", 
	// 							$this->cok->field('UserId'),	
	// 							$this->cok->field('GenaralManagerId')), '', false);
	// $this->db->where('( a.AssignSpv <> 0 
	// 					OR a.AssignLeader <> 0 
	// 					OR a.AssignSelerId <> 0 )', '', false);
 // }

//Kondisi Ambil data yang baru
 if( !strcmp( $this->cok->field('HandlingType'), USER_MANAGER)
	 OR !strcmp( $this->cok->field('HandlingType'), USER_ACCOUNT_MANAGER)){
	$this->db->where( sprintf( "( a.AssignMgr=%d AND a.AssignAmgr=%d )", 
								$this->cok->field('UserId'),	
								$this->cok->field('GenaralManagerId')), '', false);
	$this->db->where('( a.AssignSpv <> 0 
						OR a.AssignLeader <> 0 
						OR a.AssignSelerId <> 0 )', '', false);
 }

 // jika admin ambil semua data yang ada .
 if( !strcmp( $this->cok->field('HandlingType'), USER_SUPERVISOR) ){
	$this->db->where('a.AssignSpv', $this->cok->field('UserId'));
	$this->db->where('( a.AssignLeader <> 0 
						OR a.AssignSelerId <> 0 )', '', false);
	$this->db->where("b.DM_AdmId", 0);
 }
 
  // jika admin ambil semua data yang ada .
 if( !strcmp( $this->cok->field('HandlingType'), USER_LEADER) ){
	$this->db->where('a.AssignLeader', $this->cok->field('UserId'));
	$this->db->where('a.AssignSelerId<>0',  '', false);
	$this->db->where("b.DM_AdmId", 0);
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

 // echo "<pre>".$this->db->print_out()."</pre>";
 
 // query limit untuk page langsung di tuju ke query 
 // selector saja , untuk performance data ketika 
 // user melakukan select data .
 
 if( is_object( $std ) ) {
	if( $std->post_page ) {
		$std->start_page = (($std->post_page-1)*$std->per_page);
	} 
	else {	
		$std->start_page = 0;
	}
	
	// set on limite data 
	$this->db->limit( $std->per_page, $std->start_page);
 }
	
// cetak untuk debugging saja .
// $this->db->print_out();
  $qry = $this->db->get();
 
 // jika terjadi error maka tampilkan errornya 
 if( !$qry ){
	 debug( $this->db->_error_message() ); 
 }
 
 // ambil query dataprocess result OK 
 if( $qry && $qry->num_rows() > 0 ){
	$result_array = (array)$qry->result_assoc();
  }
  return (array)$result_array;
} 
  
  
 
/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
 
 function _select_count_pulldata( $out = null )
{
	
// tankap semua varibale dari process search 
  $this->out = $out;
  $this->cok = CK(); // session 
  $this->cof = CF(); // admin default
  
  
  // define all variable /
  $result_total = 0;
  
// inull then get default ----------------
 $this->db->reset_select();
 $this->db->select('count(a.AssignId) as total', FALSE); 
 $this->db->from("t_gn_assignment a");
 $this->db->join("t_gn_customer_master b "," a.AssignCustId=b.DM_Id", "INNER");
 $this->db->join("t_gn_campaign c "," b.DM_CampaignId = c.CampaignId", "INNER");
 $this->db->where("a.AssignBlock", 0);
 $this->db->where("b.DM_Followup", 0);

 
 // ini berlaku hanya untuk kondisi tertentu.
 $this->db->where_in('b.DM_CallCategoryId', array(NSTS));
 
 // filter expired data customer expired data 
 //$this->db->where( sprintf("b.DM_DateExpired>='%s'", date('Y-m-d')), "", FALSE);
 $this->db->where( sprintf("c.CampaignEndDate>='%s'", date('Y-m-d')), "", FALSE);
 
 //filter data tidak boleh reason"APMT"
 $this->db->where( sprintf("b.DM_CallReasonId != 50"));

 //filter data tidak boleh untuk callcategory RDPC
 $this->db->where_not_in('b.DM_CallCategoryId', array( RDPC));

 // filter data yang pertama by campaign 
 
 if( $this->out->find_value('pull_from_campaign_id') ){
	 $this->db->where_in("b.DM_CampaignId", $this->out->fields('pull_from_campaign_id'));
 }
 
 // filter by recsource jika memang ada 
 if( $this->out->find_value('pull_from_recsource') ){
	 $this->db->where_in("b.DM_Recsource", $this->out->fields('pull_from_recsource'));
 }
 
 // tanggal start assign yang dimaksud.
 // tanggal update di customer jika sudah ada .
 if( $this->out->find_value('pull_call_start_date') ){
	 $this->db->where(sprintf("b.DM_UpdatedTs>='%s 00:00:00'", $this->out->field('pull_call_start_date', 'SetDate')), "", FALSE );
 }
 if( $this->out->find_value('pull_end_start_date') ){
	 $this->db->where(sprintf("b.DM_UpdatedTs<='%s 23:59:59'", $this->out->field('pull_end_start_date', 'SetDate')), "", FALSE );
 }
 
 // filter by CallStatus / Call Kategory ID 
 if( $this->out->find_value('pull_call_category_id') ){
	$this->db->where_in("b.DM_CallCategoryId", $this->out->fields('pull_call_category_id'));
 }
 // call reason  status In "Selller"
 if( $this->out->find_value('pull_call_result_id') ){
	$this->db->where_in("b.DM_CallReasonId", $this->out->fields('pull_call_result_id'));
 }
 
 // get data user handler on this assign 
 // on filter process .
 if( $this->out->find_value('pull_from_user_group') ){
	// check data process 
	$this->str_where = $this->_select_page_field_data($this->out->field('pull_from_user_group'));
	if( !is_bool( $this->str_where ) 
		and count($this->out->fields('pull_form_user_list')) ) {
		$this->db->where_in( $this->str_where,  $this->out->fields('pull_form_user_list'));
	}	
 }
 
 // field filter data process "TRANS_FIELD_VALUE1"
 
 if( $this->out->field('pull_field_value1') ){
	// check jika false gak usah  
	$sqlstr = $this->_select_page_like_data( $this->out->field('pull_field_value1'), 
													$this->out->field('pull_field_filter1'),
													$this->out->fields('pull_field_text1'));
	if( is_string($sqlstr) ){												
		$this->db->where($sqlstr, '', FALSE );
	}
 }
 
// pull_range_age_start 
 if( $this->out->find_value('pull_range_age_start' ) ) {
 	$this->db->where(sprintf("b.DM_Age>=%d", $this->out->field('pull_range_age_start')), "", FALSE );
 }
  
 // pull_range_age_stop 
 if( $this->out->find_value('pull_range_age_stop' ) ) {
 	$this->db->where(sprintf("b.DM_Age<=%d", $this->out->field('pull_range_age_stop')), "", FALSE );
 }
 
 
 // transavail_ss_start 
 if( $this->out->find_value('pull_avail_ss_start' ) ) {
 	$this->db->where(sprintf("b.DM_DataAvailSS>=%d", $this->out->field('pull_avail_ss_start')), "", FALSE );
 }
 
 // pull_avail_ss_stop 
 if( $this->out->find_value('pull_avail_ss_stop' ) ) {
 	$this->db->where(sprintf("b.DM_DataAvailSS<=%d", $this->out->field('pull_avail_ss_stop')), "", FALSE );
 }
  
 // pull_kredit_limit_start 
 if( $this->out->find_value('pull_kredit_limit_start' ) ) {
 	$this->db->where(sprintf("b.DM_CrLimit>=%d", $this->out->field('pull_kredit_limit_start')), "", FALSE );
 }            
 
 // pull_kredit_limit_stop 
 if( $this->out->find_value('pull_kredit_limit_stop' ) ) {
 	$this->db->where(sprintf("b.DM_CrLimit<=%d", $this->out->field('pull_kredit_limit_stop')), "", FALSE );
 }            
   
// filter step ke - 2 by Session User Login  
 if( !strcmp( $this->cok->field('HandlingType'), USER_ROOT) ){
	$this->db->where_in('a.AssignAdmin', $this->cof->field('default_admin'));
	$this->db->where('( a.AssignAmgr<>0 
						OR a.AssignMgr <> 0 
						OR a.AssignSpv <> 0 
						OR a.AssignLeader <> 0 
						OR a.AssignSelerId <> 0 )', '', false);
 } 
 
 // jika admin ambil semua data yang ada .
 if( !strcmp( $this->cok->field('HandlingType'), USER_ADMIN) ){
	$this->db->where('( a.AssignAmgr<>0 
						OR a.AssignMgr <> 0 
						OR a.AssignSpv <> 0 
						OR a.AssignLeader <> 0 
						OR a.AssignSelerId <> 0 )', '', false);
 } 
 
 // jika admin ambil semua data yang ada .
 if( !strcmp( $this->cok->field('HandlingType'), USER_GENERAL_MANAGER)){
	$this->db->where('a.AssignAmgr',  $this->cok->field('UserId'));
	$this->db->where('( a.AssignMgr <> 0 
						OR a.AssignSpv <> 0 
						OR a.AssignLeader <> 0 
						OR a.AssignSelerId <> 0 )',  '', false);
 } 
 
 // jika admin ambil semua data yang ada . Kondisi sebelumnya
 // if( !strcmp( $this->cok->field('HandlingType'), USER_MANAGER)
	//  OR !strcmp( $this->cok->field('HandlingType'), USER_ACCOUNT_MANAGER)){
	// $this->db->where( sprintf( "( a.AssignMgr=%d OR a.AssignAmgr=%d )", $this->cok->field('UserId'),	
	// 																    $this->cok->field('GenaralManagerId')), '', false);
								
	// $this->db->where('( a.AssignSpv <> 0 
	// 					OR a.AssignLeader <> 0 
	// 					OR a.AssignSelerId <> 0 )', '', false);
 // }

 //Kondisi ambil data yang baru
 if( !strcmp( $this->cok->field('HandlingType'), USER_MANAGER)
	 OR !strcmp( $this->cok->field('HandlingType'), USER_ACCOUNT_MANAGER)){
	$this->db->where( sprintf( "( a.AssignMgr=%d AND a.AssignAmgr=%d )", $this->cok->field('UserId'),	
																	    $this->cok->field('GenaralManagerId')), '', false);
								
	$this->db->where('( a.AssignSpv <> 0 
						OR a.AssignLeader <> 0 
						OR a.AssignSelerId <> 0 )', '', false);
 }

 // jika admin ambil semua data yang ada .
 if( !strcmp( $this->cok->field('HandlingType'), USER_SUPERVISOR) ){
	$this->db->where('a.AssignSpv', $this->cok->field('UserId'));
	$this->db->where('( a.AssignLeader <> 0 
						OR a.AssignSelerId <> 0 )', '', false);
	$this->db->where("b.DM_AdmId", 0);
 }
 
  // jika admin ambil semua data yang ada .
 if( !strcmp( $this->cok->field('HandlingType'), USER_LEADER) ){
	$this->db->where('a.AssignLeader', $this->cok->field('UserId'));
	$this->db->where('a.AssignSelerId<>0',  '', false);
	$this->db->where("b.DM_AdmId", 0);
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
 
 
// cetak untuk debugging saja .
// $this->db->print_out();

  $qry = $this->db->get();
 if( !$qry ){
	 debug( $this->db->_error_message() ); 
 }
 
 // ambil query dataprocess result OK 
 if( $qry && $qry->num_rows() > 0 ){
	$result_total = $qry->result_singgle_value();
  }
  return (int)$result_total;
} 
  
function _select_page_transfer_campaign( $out  = null, $field = null, $std = null )
{
	
// tankap semua varibale dari process search 
  $this->out = $out;
  $this->cok = CK();
  $this->cof = CF();
  
 // define all variable $ar_call_not_interest = array_keys(CallResultInterest());	
  $result_array = array();
// inull then get default ----------------
 if($this->out->fields('transfer_campaign_from_campaign_id') != null) {
	$this->db->reset_select();
	if( is_null($field)) {
		
		$this->db->select('a.DM_CampaignId, c.CampaignCode, a.DM_Id, a.DM_Custno, a.DM_FirstName, b.CV_Data_CardType, a.DM_CcLimit, a.DM_DataAvailSS as avail_ss, d.CallReasonDesc',FALSE);
	} else {
		$this->db->select($field, FALSE); 
	}
	
	$this->db->from("t_gn_customer_master a");
	$this->db->join("t_gn_customer_verification b "," a.DM_Id=b.CV_Data_CustId", "INNER");
	$this->db->join("t_gn_campaign c "," a.DM_CampaignId = c.CampaignId", "INNER");
	$this->db->join("t_lk_callreason d "," a.DM_CallReasonId = d.CallReasonId", "INNER");
		
	// ini berlaku hanya untuk kondisi tertentu.
		//$this->db->where_not_in('a.DM_CallCategoryId', array(NSTS,'4','5',CLOS,'8','14'));
		//$this->db->where_not_in('a.DM_QualityCategoryId', array(NSTS,CLOS));
	
	// filter expired data customer expired data 
	
	//$this->db->where( sprintf("b.DM_DateExpired>='%s'", date('Y-m-d')), "", FALSE);
	//$this->db->where( sprintf("c.CampaignEndDate>='%s'", date('Y-m-d')), "", FALSE);
	$this->db->where("a.DM_AdmId", 0);
	$this->db->where("a.DM_Followup", 0);
	$this->db->where("a.DM_CallReasonId", 1);
	
	// filter data yang pertama by campaign 
	
	if( $this->out->find_value('transfer_campaign_from_campaign_id') ){
		$this->db->where_in("a.DM_CampaignId", $this->out->fields('transfer_campaign_from_campaign_id'));
	}
	
	// filter by recsource jika memang ada 
	if( $this->out->find_value('transfer_campaign_from_recsource') ){
		$this->db->where_in("a.DM_Recsource", $this->out->fields('transfer_campaign_from_recsource'));
	}	 
	// tanggal update di customer jika sudah ada .
	if( $this->out->find_value('transfer_campaign_call_start_date') ){
		$this->db->where(sprintf("a.DM_UpdatedTs>='%s 00:00:00'", $this->out->field('transfer_campaign_call_start_date', 'SetDate')), "", FALSE );
	}
	if( $this->out->find_value('transfer_campaign_end_start_date') ){
		$this->db->where(sprintf("a.DM_UpdatedTs<='%s 23:59:59'", $this->out->field('transfer_campaign_end_start_date', 'SetDate')), "", FALSE );
	}
	
	// filter by CallStatus / Call Kategory ID 
	// call category status In "Selller" 
	if( $this->out->find_value('transfer_campaign_call_category_id') ){
		$this->db->where_in("a.DM_CallCategoryId", $this->out->fields('transfer_campaign_call_category_id'));
	}
	
	// call reason  status In "Selller"
	if( $this->out->find_value('transfer_campaign_call_result_id') ){
		$this->db->where_in("a.DM_CallReasonId", $this->out->fields('transfer_campaign_call_result_id'));
	}
	
	// get data user handler on this assign 
	// on filter process .
	if( $this->out->find_value('transfer_campaign_from_user_group') ){
		// check data process 
		$this->str_where = $this->_select_page_field_data($this->out->field('transfer_campaign_from_user_group'));
		if( !is_bool( $this->str_where ) 
		and count($this->out->fields('transfer_campaign_form_user_list')) ) {
			
			$this->db->where_in($this->str_where,  $this->out->fields('transfer_campaign_form_user_list'));
		}	
	}
		
		// transfer_campaign_range_age_start 
		if( $this->out->find_value('transfer_campaign_range_age_start' ) ) {
			$this->db->where(sprintf("a.DM_Age>=%d", $this->out->field('transfer_campaign_range_age_start')), "", FALSE );
		}
		
		// transfer_campaign_range_age_stop 
		if( $this->out->find_value('transfer_campaign_range_age_stop' ) ) {
			$this->db->where(sprintf("a.DM_Age<=%d", $this->out->field('transfer_campaign_range_age_stop')), "", FALSE );
		}


		// transavail_ss_start 
		if( $this->out->find_value('transfer_campaign_avail_ss_start' ) ) {
			$this->db->where(sprintf("a.DM_DataAvailSS>=%d", $this->out->field('transfer_campaign_avail_ss_start')), "", FALSE );
		}

		// transfer_campaign_avail_ss_stop 
		if( $this->out->find_value('transfer_campaign_avail_ss_stop' ) ) {
			$this->db->where(sprintf("a.DM_DataAvailSS<=%d", $this->out->field('transfer_campaign_avail_ss_stop')), "", FALSE );
		}
		
		// transfer_campaign_kredit_limit_start 
		if( $this->out->find_value('transfer_campaign_kredit_limit_start' ) ) {
			$this->db->where(sprintf("a.DM_CrLimit>=%d", $this->out->field('transfer_campaign_kredit_limit_start')), "", FALSE );
		}            

		// transfer_campaign_kredit_limit_stop 
		if( $this->out->find_value('transfer_campaign_kredit_limit_stop' ) ) {
			$this->db->where(sprintf("a.DM_CrLimit<=%d", $this->out->field('transfer_campaign_kredit_limit_stop')), "", FALSE );
		}            
		
		// field filter data process "TRANSfer_campaign_FIELD_VALUE1"
	
	if( $this->out->field('transfer_campaign_field_value1') ){
		// check jika false gak usah  
		$sqlstr = $this->_select_page_like_data( $this->out->field('transfer_campaign_field_value1'), 
														$this->out->field('transfer_campaign_field_filter1'),
														$this->out->fields('transfer_campaign_field_text1'));
		
		if( is_string($sqlstr) ){
			$this->db->where($sqlstr, '', FALSE );
		}
										
	}
	
	// transfer_campaign_range_age_start 
	if( $this->out->find_value('transfer_campaign_range_age_start' ) ) {
		$this->db->where(sprintf("a.DM_Age>=%d", $this->out->field('transfer_campaign_range_age_start')), "", FALSE );
	}
		
	// transfer_campaign_range_age_stop 
	if( $this->out->find_value('transfer_campaign_range_age_stop' ) ) {
		$this->db->where(sprintf("a.DM_Age<=%d", $this->out->field('transfer_campaign_range_age_stop')), "", FALSE );
	}

	// transfer_campaign_kredit_limit_start 
	if( $this->out->find_value('transfer_campaign_kredit_limit_start' ) ) {
		$this->db->where(sprintf("a.DM_CrLimit>=%d", $this->out->field('transfer_campaign_kredit_limit_start')), "", FALSE );
	}            
	
	// transfer_campaign_kredit_limit_stop 
	if( $this->out->find_value('transfer_campaign_kredit_limit_stop' ) ) {
		$this->db->where(sprintf("a.DM_CrLimit<=%d", $this->out->field('transfer_campaign_kredit_limit_stop')), "", FALSE );
	}            
		
	// order di sesuiakna dengan field yang di sorting oleh 
	// user di client.

	if( $this->out->find_value("orderby") ){
		$this->db->order_by($this->out->field("orderby"), $this->out->field("type") );
	}
	
	// query limit untuk page langsung di tuju ke query 
	// selector saja , untuk performance data ketika 
	// user melakukan select data .
	
	if( is_object( $std ) ) {
		if( $std->post_page ) {
			$std->start_page = (($std->post_page-1)*$std->per_page);
		} 
		else {	
			$std->start_page = 0;
		}
		
		// set on limite data 
		$this->db->limit( $std->per_page, $std->start_page);
	}

	// cetak untuk debugging saja .
		$qry = $this->db->get();
		//echo '<pre>';
		//print_r($this->db->last_query());
		//echo '</pre>';
		if( !$qry ){
		debug( $this->db->_error_message() ); 
		}
	
	// ambil query dataprocess result OK 
	if( $qry && $qry->num_rows() > 0 ){
		$result_array = (array)$qry->result_assoc();
	}
 }
 $array_second = array();
 foreach($result_array as $item) {
	$item['CV_Data_AvailSS'] = number_format($item['avail_ss']);
	unset($item['avail_ss']);
	array_push($array_second, $item);
 }
  return (array)$array_second;
} 
  
  
/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
 
 function _select_count_transfer_campaign( $out  = null  )
{
	
// tankap semua varibale dari process search 
  $this->out = $out;
  $this->cok = CK();
  $this->cof = CF();
  
 // define all variable $ar_call_not_interest = array_keys(CallResultInterest());	
  $result_total = array();
	if($this->out->fields('transfer_campaign_from_campaign_id') != null) {
	// inull then get default ----------------
	$this->db->reset_select();
	$this->db->select('count(a.DM_Id) as total', false);
	$this->db->from("t_gn_customer_master a");
	$this->db->join("t_gn_customer_verification b "," a.DM_Id=b.CV_Data_CustId", "INNER");
	$this->db->join("t_gn_campaign c "," a.DM_CampaignId = c.CampaignId", "INNER");
	$this->db->join("t_lk_callreason d "," a.DM_CallReasonId = d.CallReasonId", "INNER");
$this->db->where("a.DM_AdmId", 0);
	$this->db->where("a.DM_Followup", 0);
	$this->db->where("a.DM_CallReasonId", 1);
	
	// filter data yang pertama by campaign 
	
	if( $this->out->find_value('transfer_campaign_from_campaign_id') ){
		$this->db->where_in("a.DM_CampaignId", $this->out->fields('transfer_campaign_from_campaign_id'));
	}
	
	// filter by recsource jika memang ada 
	if( $this->out->find_value('transfer_campaign_from_recsource') ){
		$this->db->where_in("a.DM_Recsource", $this->out->fields('transfer_campaign_from_recsource'));
	}	 
	// tanggal update di customer jika sudah ada .
	if( $this->out->find_value('transfer_campaign_call_start_date') ){
		$this->db->where(sprintf("a.DM_UpdatedTs>='%s 00:00:00'", $this->out->field('transfer_campaign_call_start_date', 'SetDate')), "", FALSE );
	}
	if( $this->out->find_value('transfer_campaign_end_start_date') ){
		$this->db->where(sprintf("a.DM_UpdatedTs<='%s 23:59:59'", $this->out->field('transfer_campaign_end_start_date', 'SetDate')), "", FALSE );
	}
	
	// filter by CallStatus / Call Kategory ID 
	// call category status In "Selller" 
	if( $this->out->find_value('transfer_campaign_call_category_id') ){
		$this->db->where_in("a.DM_CallCategoryId", $this->out->fields('transfer_campaign_call_category_id'));
	}
	
	// call reason  status In "Selller"
	if( $this->out->find_value('transfer_campaign_call_result_id') ){
		$this->db->where_in("a.DM_CallReasonId", $this->out->fields('transfer_campaign_call_result_id'));
	}
	
	// get data user handler on this assign 
	// on filter process .
	if( $this->out->find_value('transfer_campaign_from_user_group') ){
		// check data process 
		$this->str_where = $this->_select_page_field_data($this->out->field('transfer_campaign_from_user_group'));
		if( !is_bool( $this->str_where ) 
		and count($this->out->fields('transfer_campaign_form_user_list')) ) {
			
			$this->db->where_in($this->str_where,  $this->out->fields('transfer_campaign_form_user_list'));
		}	
	}
		
		// transfer_campaign_range_age_start 
		if( $this->out->find_value('transfer_campaign_range_age_start' ) ) {
			$this->db->where(sprintf("a.DM_Age>=%d", $this->out->field('transfer_campaign_range_age_start')), "", FALSE );
		}
		
		// transfer_campaign_range_age_stop 
		if( $this->out->find_value('transfer_campaign_range_age_stop' ) ) {
			$this->db->where(sprintf("a.DM_Age<=%d", $this->out->field('transfer_campaign_range_age_stop')), "", FALSE );
		}


		// transavail_ss_start 
		if( $this->out->find_value('transfer_campaign_avail_ss_start' ) ) {
			$this->db->where(sprintf("a.DM_DataAvailSS>=%d", $this->out->field('transfer_campaign_avail_ss_start')), "", FALSE );
		}

		// transfer_campaign_avail_ss_stop 
		if( $this->out->find_value('transfer_campaign_avail_ss_stop' ) ) {
			$this->db->where(sprintf("a.DM_DataAvailSS<=%d", $this->out->field('transfer_campaign_avail_ss_stop')), "", FALSE );
		}
		
		// transfer_campaign_kredit_limit_start 
		if( $this->out->find_value('transfer_campaign_kredit_limit_start' ) ) {
			$this->db->where(sprintf("a.DM_CrLimit>=%d", $this->out->field('transfer_campaign_kredit_limit_start')), "", FALSE );
		}            

		// transfer_campaign_kredit_limit_stop 
		if( $this->out->find_value('transfer_campaign_kredit_limit_stop' ) ) {
			$this->db->where(sprintf("a.DM_CrLimit<=%d", $this->out->field('transfer_campaign_kredit_limit_stop')), "", FALSE );
		}            
		
		// field filter data process "TRANSfer_campaign_FIELD_VALUE1"
	
	if( $this->out->field('transfer_campaign_field_value1') ){
		// check jika false gak usah  
		$sqlstr = $this->_select_page_like_data( $this->out->field('transfer_campaign_field_value1'), 
														$this->out->field('transfer_campaign_field_filter1'),
														$this->out->fields('transfer_campaign_field_text1'));
		
		if( is_string($sqlstr) ){
			$this->db->where($sqlstr, '', FALSE );
		}
										
	}
	
	// transfer_campaign_range_age_start 
	if( $this->out->find_value('transfer_campaign_range_age_start' ) ) {
		$this->db->where(sprintf("a.DM_Age>=%d", $this->out->field('transfer_campaign_range_age_start')), "", FALSE );
	}
		
	// transfer_campaign_range_age_stop 
	if( $this->out->find_value('transfer_campaign_range_age_stop' ) ) {
		$this->db->where(sprintf("a.DM_Age<=%d", $this->out->field('transfer_campaign_range_age_stop')), "", FALSE );
	}

	// transfer_campaign_kredit_limit_start 
	if( $this->out->find_value('transfer_campaign_kredit_limit_start' ) ) {
		$this->db->where(sprintf("a.DM_CrLimit>=%d", $this->out->field('transfer_campaign_kredit_limit_start')), "", FALSE );
	}            
	
	// transfer_campaign_kredit_limit_stop 
	if( $this->out->find_value('transfer_campaign_kredit_limit_stop' ) ) {
		$this->db->where(sprintf("a.DM_CrLimit<=%d", $this->out->field('transfer_campaign_kredit_limit_stop')), "", FALSE );
	}            
		
	// order di sesuiakna dengan field yang di sorting oleh 
	// user di client.

	if( $this->out->find_value("orderby") ){
		$this->db->order_by($this->out->field("orderby"), $this->out->field("type") );
	}
		
	
	// cetak untuk debugging saja .
	// $this->db->print_out();
		$qry = $this->db->get();
	
	// jika terjadi error maka tampilkan errornya 
	if( !$qry ){
		debug( $this->db->_error_message() ); 
	}
	
	// ambil query dataprocess result OK 
	if( $qry && $qry->num_rows() > 0 ){
		$result_total = (int)$qry->result_singgle_value();
		}
	}
  return (int)$result_total;
} 
// ---------------------------------------------------------------------------------------------------------------
/*
 * @ package	 	view data on distribute part 	
 *  
 */
 
 function _select_row_assign_level( $AssignId = 0 )
{
  $arr_group =& UserPrivilege();
  $this->db->reset_select();
  $this->db->select("
	( select t1.full_name as t1 from tms_agent t1 where t1.UserId=a.AssignAdmin ) as Level1,
	( select t2.full_name as t2 from tms_agent t2 where t2.UserId=a.AssignAmgr ) as Level2,
	( select t3.full_name as t3 from tms_agent t3 where t3.UserId=a.AssignMgr ) as Level3,
	( select t4.full_name as t4 from tms_agent t4 where t4.UserId=a.AssignSpv ) as Level4,
	( select t5.full_name as t5 from tms_agent t5 where t5.UserId=a.AssignLeader ) as Level5,
	( select t6.full_name as t6 from tms_agent t6 where t6.UserId=a.AssignSelerId ) as Level6", FALSE);
	
  $this->db->from("t_gn_assignment a");
  $this->db->where("a.AssignId", $AssignId);
  
  $rs = $this->db->get();
  if( $rs->num_rows() > 0 ) 
  {
	 $arr_rows = array();
	 $rows = $rs->result_first_assoc();	
	 if(is_array($rows))foreach( $rows as $k => $val ) 
	{
		if( !is_null($val) ) 
		{
			$arr_rows[$k] = $val;
		}
	 }	 
	 return join("<br>", $arr_rows);
  }	  
  return null;
  
}

// ======================== END CLASS ================================================================================= 
}

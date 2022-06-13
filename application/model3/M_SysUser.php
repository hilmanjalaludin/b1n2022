<?php
/*
 * E.U.I 
 *
 
 * subject	: get model data for user modul 
 * 			  extends under model class
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/model/sysuser/
 */
 
 class M_SysUser extends EUI_Model 
{

 var $page_limit = 10;
// ------------------------------------------------------------

 private static $Instance = null;
 public static function &Instance()
{
  if( is_null(self::$Instance) ){
	self::$Instance = new self();
  }
  return self::$Instance;
}

// -----------------------------------------------------------

 function __construct()
{ 
	$this->load->model(array('M_Configuration','M_User','M_UserRole'));
	 
}

 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
function get_default()  {
	 
  $cok = CK();  $cnf = CF(); 

 // set filter data -----------------------------------
 
  $this->EUI_Page->_setPage(DEFAULT_COUNT_PAGE);
  $this->EUI_Page->_setCount(true);
  $this->EUI_Page->_setSelect("count(a.UserId) as total");
  $this->EUI_Page->_setFrom("tms_agent a");
  $this->EUI_Page->_setJoin("tms_agent_profile c","a.profile_id=c.id", "LEFT", true);
  
 // filter data by sesison get on level 
  $this->EUI_Page->_setAnd("c.level_group>", $cok->field('GroupLevel'), false);
 
 // debug($cok);
 // handle by session LEVEL "USER_GENERAL_MANAGER"
  if( $cok->cookie(array(USER_GENERAL_MANAGER)) ){
	$this->EUI_Page->_setAnd('a.act_mgr', $cok->field('UserId'));
  }
  
 // USER_MANAGER, USER_ACCOUNT_MANAGER 
  if( $cok->cookie(array(USER_MANAGER, USER_ACCOUNT_MANAGER)) ){
	$this->EUI_Page->_setAnd('a.mgr_id', $cok->field('UserId'));
  }
  
 // USER_SUPERVISOR  
  if( $cok->cookie(array(USER_SUPERVISOR)) ){	 
	$this->EUI_Page->_setAnd('a.spv_id', $cok->field('UserId'));
  }
  
 // USER_LEADER 
  if( $cok->cookie(array(USER_LEADER)) ){
	$this->EUI_Page->_setAnd('a.tl_id', $cok->field('UserId'));
  }
  
 // USER_AGENT_OUTBOUND, USER_AGENT_INBOUND 
  if( $cok->cookie(array(USER_AGENT_OUTBOUND, USER_AGENT_INBOUND))){ 
	$this->EUI_Page->_setAnd('UserId', $cok->field('UserId'));
	
  }
  
	 
 // set filter data -----------------------------------
 
  $this->EUI_Page->_setLikeCache("a.id", "user_id", true);
  $this->EUI_Page->_setLikeCache("a.ip_address", "user_address", true);
  $this->EUI_Page->_setLikeCache("a.full_name", "user_name", true);
  $this->EUI_Page->_setAndCache("a.handling_type", "user_privileges", true);
  $this->EUI_Page->_setAndCache("a.user_state", "user_active", true);
  $this->EUI_Page->_setAndCache("a.logged_state", "user_login", true);
  //echo $this->EUI_Page->_getCompiler();
  return $this->EUI_Page;
 }
 
 
//------------------------------------------------------------ 
/*
 *@ get page content return to content list 
 *@ get content data 
 */
 
 public function get_content() {

 
 // get config && session data 
$cok = CK();  $cnf = CF(); 


 $this->EUI_Page->_postPage(_get_post('v_page') );
 $this->EUI_Page->_setPage(DEFAULT_COUNT_PAGE);
 $this->EUI_Page->_setArraySelect(array(
	"a.UserId as ID" => array("ID", "ID", "primary"),
	"a.id as UserId" => array("UserId","User ID"),
	"a.full_name as Fullname" => array("Fullname", "User Name"),
	"a.code_user as UserCode" => array("UserCode", "User Code"),
	"c.name as Privileges" => array("Privileges", "Privileges"),
	"d.description as CcGroup" => array("CcGroup","CC Group"),
	"IF(a.telphone=1,'YES','NO') as Telephone" => array("Telephone","Telephone"),
	"IF(a.user_state=1,'Active','Not Active') as UserActive" => array("UserActive","User Active"),
	"IF(a.logged_state=1,'Login','Logout') as LoginStatus" => array("LoginStatus"," Login Status"),
	"IF(a.logged_state=1, a.ip_address, '-') as LoginAddress" => array("LoginAddress","IP Address")
 ));
 
 $this->EUI_Page->_setFrom("tms_agent a");
 $this->EUI_Page->_setJoin("cc_agent b", "a.id=b.userid", "LEFT");
 $this->EUI_Page->_setJoin("tms_agent_profile c","a.profile_id=c.id", "LEFT");
 $this->EUI_Page->_setJoin("cc_agent_group d","d.id=b.agent_group", "LEFT", true);
 
 // filter data by sesison get on level 
 $this->EUI_Page->_setAnd("c.level_group>", $cok->field('GroupLevel'), false);
 // debug($cok);
 // handle by session LEVEL "USER_GENERAL_MANAGER"
 
 if( $cok->cookie(array(USER_GENERAL_MANAGER)) ){
	$this->EUI_Page->_setAnd('a.act_mgr', $cok->field('UserId'));
  }
  
 // USER_MANAGER, USER_ACCOUNT_MANAGER 
 if( $cok->cookie(array(USER_MANAGER, USER_ACCOUNT_MANAGER)) ){
	$this->EUI_Page->_setAnd('a.mgr_id', $cok->field('UserId'));
  }
  
 // USER_SUPERVISOR  
 if( $cok->cookie(array(USER_SUPERVISOR)) ){	 
	$this->EUI_Page->_setAnd('a.spv_id', $cok->field('UserId'));
  }
  
 // USER_LEADER 
 if( $cok->cookie(array(USER_LEADER)) ){
	$this->EUI_Page->_setAnd('a.tl_id', $cok->field('UserId'));
  }
  
 // USER_AGENT_OUTBOUND, USER_AGENT_INBOUND 
 if( $cok->cookie(array(USER_AGENT_OUTBOUND, USER_AGENT_INBOUND))){ 
	$this->EUI_Page->_setAnd('UserId', $cok->field('UserId'));
	
  }
// ------------------------- set filter data -----------------------------------

 $this->EUI_Page->_setLikeCache("a.id", "user_id", true);
 $this->EUI_Page->_setLikeCache("a.ip_address", "user_address", true);
 $this->EUI_Page->_setLikeCache("a.full_name", "user_name", true);
 $this->EUI_Page->_setAndCache("a.handling_type", "user_privileges", true);
 $this->EUI_Page->_setAndCache("a.user_state", "user_active", true);
 $this->EUI_Page->_setAndCache("a.logged_state", "user_login", true);
  
  
// --------------- set order  ------------------------------------------- 

   if( !_get_have_post('order_by')){
	 $this->EUI_Page->_setOrderBy('a.UserId','DESC');
  } else {
	 $this->EUI_Page->_setOrderBy(_get_post('order_by'), _get_post('type'));
  }	

// --------------- set limit  ------------------------------------------- 
  
  $this->EUI_Page->_setLimit();
 // echo $this->EUI_Page->_getCompiler();
	
  
} 


/*
 *@ get buffering query from database
 *@ then return by object type ( resource(link) ); 
 */
 
function get_resource_query()
 {
	self::get_content();
	
	if( $this -> EUI_Page -> _get_query()!='') 
	{
		return $this -> EUI_Page -> _result();
	}	
 }
 
/*
 *@ get number record & start of number every page 
 *@ then result ( INT ) type 
 */
 
function get_page_number()
  {
	if( $this -> EUI_Page -> _get_query()!='' )
	{
		return $this -> EUI_Page -> _getNo();
	}	
  }
  
  
//---------------------------------------------------------------------------------------
/*
 * @ package 		_reset_user_password
 */
 public function _reset_user_password( $data = null )
{
	
  $tot = 0;
 if( !is_null( $data ) AND is_array($data) )
 {
	foreach( $data as $k => $UserId ) 
	{
		$outUser = new EUI_Object( self::_getUserDetail($UserId) );
		if( $outUser->fetch_ready() )
		{
			$this->db->reset_write();
			$this->db->where('UserId', $outUser->get_value('UserId'));	
			$this->db->set("password", md5('1234'));
			$this->db->set("update_password", date('Y-m-d H:i:s'));
			$this->db->update("tms_agent");
			if($this->db->affected_rows() > 0 )
			{
				EventLoger('RET', array( "reset password from ",  $outUser->get_value('password'),  "to default password",md5('1234')));
				$tot++;
			}	
		}	
		
	}	
 }
	
// ------------- callback to client -----------------
	
 if( $tot ) { 
	return TRUE; 
 }
 
 return FALSE;
 
}


//---------------------------------------------------------------------------------------
/*
 * @ package 		_reset_user_location 
 */

 public function _reset_user_location( $data = null )
{
 $tot = 0;
 
 
// ------------- get process -----------------------]
 
 if( !is_null( $data ) 
		AND is_array($data) )
 {
	foreach( $data as $k => $UserId ) 
	{
		// ---------- detail User ---------------
		$outUser =new EUI_Object( self::_getUserDetail($UserId) );
		if( $outUser->fetch_ready() )
		{	
			$this->db->reset_write();
			$this->db->where("UserId",$outUser->get_value('UserId'));
			$this->db->set("ip_address", "NULL", FALSE);
			$this->db->set("logged_state", 0);
			$this->db->update("tms_agent");
			if( $this->db->affected_rows() > 0 ) 
			{
				EventLoger('RET', array( "reset ip addres ",  $outUser->get_value('ip_address'),  "on login user", $outUser->get_value('full_name') ));
				$tot++;
			}
		}	
	}	
}
	
	
// ------------- callback to client -----------------
	
 if( $tot ) { 
	return TRUE; 
 }
 
 return FALSE;

}


//---------------------------------------------------------------------------------------
/*
 * @ package 		_disable_user 
 */

 public function _disable_user( $data = null )
{
 
 $tot = 0;
 if( !is_null( $data ) AND is_array($data) )
 {
	foreach( $data as $k => $UserId ) 
	{
		$out = new EUI_Object( self::_getUserDetail($UserId) );
		if( $out->fetch_ready() ) 
		{	
			$this->db->reset_write();
			$this->db->where("UserId",$out->get_value('UserId'));
			$this->db->set("user_state", 0);
			$this->db->update("tms_agent");
			if( $this->db->affected_rows() > 0 ) 
			{
				EventLoger('DIS', array( "disable active user ",  $out->get_value('full_name')));
				$tot++;
			}
		}
	}
 }
	
// ------------- callback to client -----------------
	
 if( $tot ) { 
	return TRUE; 
 }
 
 return FALSE;
 
} 

//---------------------------------------------------------------------------------------
/*
 * @ package 		_enable_user 
 */
 
function _enable_user( $data = null )
{
	$tot = 0;
 if( !is_null( $data ) AND is_array($data) )
 {
	foreach( $data as $k => $UserId ) 
	{
		$out = new EUI_Object( self::_getUserDetail($UserId, array(0,1)));
		if( $out->fetch_ready() ) 
		{	
			$this->db->reset_write();
			$this->db->where("UserId",$out->get_value('UserId'));
			$this->db->set("user_state", 1);
			$this->db->update("tms_agent");
			if( $this->db->affected_rows() > 0 ) 
			{
				EventLoger('ENB', array( "enable active user ",  $out->get_value('full_name')));
				$tot++;
			}
		}
	}
 }
	
// ------------- callback to client -----------------
	
 if( $tot ) { 
	return TRUE; 
 }
 
 return FALSE;
} 

//@ _get_user

function _get_user( $UserId )
{
	$sql = " select a.*, b.id as cc_agent_id from tms_agent a 
			 left join cc_agent b on a.id=b.userid
			 WHERE a.UserId ='$UserId' 
			 AND b.userid is not null  ";
			 
	$qry = $this -> db -> query($sql);
	if( !$qry -> EOF() )
	{
		return $qry -> result_first_assoc();
	}	
	else
		return false;
}


//---------------------------------------------------------------------------------------
/*
 * @ package 		_remove_user 
 */
 
 
 public function _remove_user( $data = null )
{
  $tot = 0;
  if( !is_null( $data ) 
	  AND is_array($data) )
  {
		
	 foreach( $data as $k => $UserId ) 
	{
		$out = new EUI_Object( self::_getUserDetail($UserId, array(0,1)));
		if( is_object($out) AND $out->fetch_ready()  ) 
		{
			 EventLoger('DEL', array
			( 
				"delete user : ", 
				"full_name[{$out->get_value('full_name')}],",
				"id[{$out->get_value('Username')}], ",
				"UserId[{$out->get_value('UserId')}],",
				"handling_type[{$out->get_value('handling_type')}],",
				"tl_id[{$out->get_value('tl_id')}],",
				"spv_id[{$out->get_value('spv_id')}],",
				"mgr_id[{$out->get_value('mgr_id')}],",
				"act_mgr[{$out->get_value('act_mgr')}],",
				"quality_id[{$out->get_value('quality_id')}],",
				"admin_id[{$out->get_value('admin_id')}],",
				"code_user[{$out->get_value('code_user')}],",
				"password[{$out->get_value('password')}]"
			));
			
		// ---------- del from tms_agent ------------------
		
			$this->db->reset_write();
			$this->db->where("UserId",$out->get_value('UserId'));
			if( $this->db->delete("tms_agent") ){
				$tot++;	
			}	
			
		// ---------- del from cc_agent  ------------------
		
			$this->db->reset_write();
			$this->db->where("id",$out->get_value('Username'));
			$this->db->delete("cc_agent");
		}	
	}	
 }
// ------------- callback to client -----------------
	
 if( $tot ) { 
	return TRUE; 
 }
 
 return FALSE;
 
	
} 

// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	_set_add_user .
 * @ note		eweh note.
 */
 protected function _select_row_field( $cond = 0 )
{
	$cond = (int)$cond;
	$arr_row_field = array
(
	USER_ROOT => 0,
	USER_ADMIN => 'admin_id',
	USER_SUPERVISOR => 'spv_id',
	USER_LEADER => 'tl_id',
	USER_MANAGER => 'mgr_id',
	USER_ACCOUNT_MANAGER => 'act_mgr',
	USER_QUALITY_HEAD =>  'quality_id',
	USER_QUALITY_STAFF => 0,
	USER_AGENT_OUTBOUND => 0,
	USER_AGENT_INBOUND => 0,
	USER_QUALITY => 0
 );
	
// ---------------- data field mapping ---------------
	
	if( isset( $arr_row_field[$cond] ) ){
		return $arr_row_field[$cond];
	}	
	
	return FALSE;
}

// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	_set_add_user .
 * @ note		eweh note.
 */

 public function _set_add_user()
{
 
 $cond = FALSE;

// ----------- reset write -----------------------------------------
  
 $out = new EUI_Object(_get_all_request());
  
 if( !_have_get_session('UserId') OR !$out->fetch_ready() )
 {
	return FALSE;
 }

// ----------- reset write -----------------------------------------
 
  $this->db->reset_write();
  $this->db->set('id', $out->get_value('userid'));  
  $this->db->set('code_user', $out->get_value('textAgentcode')); 
  $this->db->set('full_name', $out->get_value('fullname')); 
  $this->db->set('init_name', $out->get_value('userid'));  
  $this->db->set('profile_id', (int)$out->get_value('profile'));  
  $this->db->set('handling_type', (int)$out->get_value('profile')); 
  $this->db->set('spv_id', (int)$out->get_value('user_spv')); 
  $this->db->set('mgr_id', (int)$out->get_value('user_mgr'));  
  $this->db->set('admin_id', (int)$out->get_value('user_admin'));	 
  $this->db->set('act_mgr', (int)$out->get_value('account_manager'));	 
  $this->db->set('quality_id', (int)$out->get_value('quality_head'));	 
  $this->db->set('tl_id', (int)$out->get_value('user_leader'));  	
  $this->db->set('telphone', (int)$out->get_value('user_telphone')); 
  $this->db->set('password', $out->get_value('password','md5')); 
  $this->db->set('user_state', (int)$out->get_value('user_active')); 
  $this->db->set('user_role', $out->get_value('user_role')); 
  $this->db->set('updated_by', _get_session('UserId'));  
  $this->db->set('update_password', date('Y-m-d H:i:s')); 
  $this->db->set('agency_id', 'IFM'); 
  $this->db->set('logged_state', 0); 
 
 
  $this->db->insert('tms_agent');
  
// ------------------------- insert into cc_agent ------------------------------- 
  $UserId = $this->db->insert_id();
  if( $UserId ) 
  {
	$this->db->reset_write();
	$this->db->set("userid", $out->get_value('userid'));
	$this->db->set("name", $out->get_value('fullname'));
	$this->db->set("agent_group", $out->get_value('cc_group'));
	$this->db->set("password", md5('1234'));
	$this->db->set("login_status", 1);
	$this->db->set("occupancy", 1);
	$this->db->insert("cc_agent");
	$CCAgentId  = $this->db->insert_id(); // cc_agent.id 
	
	$ProfileId = $out->get_value('profile','intval');
	if( $this->db->affected_rows() AND $UserId 
		AND $field = $this->_select_row_field($ProfileId) )
	{
		$this->db->reset_write();
		$this->db->where("UserId",(int)$UserId);
		$this->db->set($field, $UserId);
		$this->db->update("tms_agent");
	}
	
// --- cc skill  --------------------------------
	
	$UserSkill = $out->get_value('user_skill', 'intval');
	if( $CCAgentId AND $UserSkill ) 
	{
		$this->db->reset_write();
		$this->db->set("agent", $CCAgentId);
		$this->db->set("skill", $UserSkill);
		$this->db->set("score", 100);
		
		$this->db->duplicate("score", 100);
		$this->db->duplicate("skill", $UserSkill);
		$this->db->insert_on_duplicate("cc_agent_skill");
	}
	// ----------- loger user -----------------------------------------
	EventLoger('ADD', array("add user", $out->get_value('fullname') ));
	
  }
  
// ------------------------- insert into cc_agent ------------------------------- 
  
  if( ($UserId) 
	AND _have_get_session('UserId') ) 
 {
	$cond = TRUE;
  }
  
  return (bool)$cond;
  
} 
// ========= END ADD USER 




// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */

  protected function Repassword( $old = null, $new  = null )
 {
	if( is_null($old) OR is_null($new) ) { 
		return FALSE;	
	}
	
	if( strcmp($old, $new) != 0 ){
		return md5($new);	
	} else {
		return $old;
	}
}
 
 
// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */

 public function _set_update_user()
{
 
 $out = new EUI_Object(_get_all_request() );
 if( !$out->fetch_ready() 
	OR !_have_get_session('UserId') )
 {
	return FALSE;
 }
 
// -------------- reset writer data ----------------------------------------------
 
 $this->db->reset_write();
 $this->db->where('UserId', 	$out->get_value('where_id'));
 $this->db->set('full_name', 	$out->get_value('fullname') );     	
 $this->db->set('telphone', 	$out->get_value('user_telphone'));		 
 // $this->db->set('init_name', $out->get_value('where_id'));		 
 $this->db->set('profile_id', 	$out->get_value('profile'));			 
 $this->db->set('admin_id', 	$out->get_value('user_admin'));			
 $this->db->set('tl_id', 		$out->get_value('team_leader'));			 
 $this->db->set('spv_id', 		$out->get_value('user_spv'));				 
 $this->db->set('mgr_id', 		$out->get_value('user_mgr'));				 
 $this->db->set('code_user', 	$out->get_value('textAgentcode'));		 
 $this->db->set('act_mgr', 		$out->get_value('account_manager'));		 
 $this->db->set('quality_id', 	$out->get_value('quality_head'));		 
 $this->db->set('handling_type',$out->get_value('profile'));	
 $this->db->set('user_role',	$out->get_value('user_role'));	
 $this->db->set('last_update', date('Y-m-d H:i:s'));
 
 // --------------- if have change password ----------------------------------------------
 
 $password =& $this->Repassword($out->get_value('where_pwd'), $out->get_value('password'));
 if( $password != FALSE ) {
	$this->db->set('password', $password);		
	$this->db->set('update_password', date('Y-m-d H:i:s'));
 }
 
 $this->db->update("tms_agent");
 
 // --------------- if have change password ----------------------------------------------
 
 if( $this->db->affected_rows() )
 {
	$this->db->reset_write();
	$this->db->where("userid", $out->get_value('userid'));
	$this->db->set("name", $out->get_value('fullname'));
	$this->db->set("agent_group", $out->get_value('cc_group'));
	$this->db->update("cc_agent");	
	
	
	$this->db->reset_write();
	 if( $out->get_value('user_skill', 'intval') ) 
	{
		
	 $objAgent = new EUI_Object( $this->_get_detail_user($out->get_value('where_id')) );
	  $this->db->reset_write();
	  $this->db->set("agent", $objAgent->get_value('AgentId', 'intval'));
	  $this->db->set("skill", $out->get_value('user_skill', 'intval'));
	  $this->db->set("score", 100);
	  $this->db->duplicate("skill", $out->get_value('user_skill', 'intval'));
	  $this->db->duplicate("score", 100);
	  $this->db->insert_on_duplicate("cc_agent_skill");
	}
	
	EventLoger('UPD', array("update user", $out->get_value('fullname') ));
	return (bool)TRUE;
	
 } else {
	return (bool)FALSE;
 }
 
 
} 
// end function ===============> 

 
// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
 public function _set_register_user_pbx( $_UserId=null )
{
 $_conds = FALSE;
 $this->load->Model('M_Pbx');
  
  if( class_exists('M_Pbx') )
 {
	if( (count($_UserId)!=0) && ($_UserId!=''))  
	{
		$_conds = $this->M_Pbx->_set_register_user($_UserId);
	}
 }
	return $_conds;
}


//@ _get_detail_user

 function _get_detail_user( $UserId = 0  )
{
	
// ----------- write select -----------------------	

 $this->db->reset_select();
 $this->db->select('
	a.UserId, a.id as Username, 
	a.full_name, a.handling_type, 
	a.tl_id, a.spv_id, 
	a.mgr_id, a.admin_id, 
	a.act_mgr, a.quality_id,
	a.code_user, a.init_name, 
	b.agent_group, a.telphone, 
	a.password,a.user_state,
	b.id as AgentId,
	a.user_role as user_role,
    (select sk.skill from cc_agent_skill sk where sk.agent =b.id) as user_skill', FALSE);
	
 $this->db->from('tms_agent a ');
 $this->db->join('cc_agent b ','a.id=b.userid','LEFT');
 $this->db->where('a.UserId', $UserId);
 
 $rs = $this->db->get();
 if( $rs->num_rows() > 0 ) {
	return (array)$rs->result_first_assoc();
 } else {
	return array();
 }
 
}
/*
 * [Recovery data failed upload AJMI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */

function _get_admin(){
	
	$result_array = array();
	$this->db->reset_select();
	$this->db->select('a.id as UserKode, a.UserId, a.full_name, a.id');
	$this->db->from("tms_agent a");
	$this->db->join("tms_agent_profile b", "a.handling_type=b.id","left");
	$this->db->where("b.id",USER_ADMIN);
	$qry = $this -> db->get();
	
	if( $qry )foreach( $qry->result_assoc() as $row ) {
		$result_array[$row['UserId']] = sprintf('%s - %s', $row['UserKode'], $row['full_name']);
	}
	
	return $result_array;
	
}


//@ function 

function _getQualityControll(){
	
$_avail = array();
	
	$this->db->select('a.UserId, a.full_name, a.id');
	$this->db->from("tms_agent a");
	$this->db->join("tms_agent_profile b", "a.handling_type=b.id","left");
	$this->db->where("b.id",USER_QUALITY);
	
	foreach( $this -> db->get()->result_assoc() as $rows )
	{
		$_avail[$rows['UserId']] = $rows['full_name'];
	}
	
	return $_avail;
	
}


//@ _get_detail_user

function _getUserDetail( $UserId, $where_in = null )
{
	$_data = array();
	$this ->db-> reset_select();
	$this ->db-> select('a.UserId, a.id as Username, a.full_name, a.tl_id, a.handling_type, a.spv_id, a.mgr_id, a.act_mgr, a.quality_id, a.admin_id, a.code_user, a.init_name, a.telphone, a.ip_address, a.password, a.user_role');
	$this ->db-> from('tms_agent a');
	$this ->db-> where('a.UserId', $UserId);
	
	if( is_array($where_in) ){
		$this->db->where_in('a.user_state', $where_in);
	} else{
		$this->db->where_in('a.user_state', array(1));
	}
	
	$rs = $this->db->get();
	 if( $rs->num_rows() > 0 )
	{
		return (array)$rs->result_first_assoc();
	} 
	
	return array();
		
}


//@ select get profile id

function _get_handling_type() 
{
	$_data = array();
	$this -> db ->reset_select();
	$this -> db -> select('a.id, a.name');
	$this -> db -> from('tms_agent_profile  a');
	$this -> db -> where('a.IsActive',1);
	
	if( $this -> EUI_Session->_get_session('HandlingType')!=USER_ROOT){
		$this -> db -> where('a.id!=',USER_ROOT,FALSE);	
	}
	$this -> db ->order_by("a.level_group","ASC");
	

	foreach( $this -> db -> get() -> result_assoc() as $rows ) {
		$_data[$rows['id']] = $rows['name'];
	}


	
	return $_data;
}

/*
 * [Recovery data failed upload AJMI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
function _get_administrator() 
{
	$result_array = array();
	$this->db->reset_select();
	$this->db->select('id as UserKode ,UserId, full_name');
	$this->db->from('tms_agent');
	$this->db->where('handling_type', USER_ADMIN );
	
	$qry  = $this->db->get();
	if( $qry ) foreach(  $qry-> result_assoc() as $row )  {
		$result_array[$row['UserId']] = sprintf('%s - %s', $row['UserKode'], $row['full_name']);
	}
	return (array)$result_array;
}

/*
 * [Recovery data failed upload AJMI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
function _get_manager() 
{
	$result_array = array();
	$this -> db->reset_select();
	$this -> db->select('id as UserKode, UserId, full_name');
	$this -> db->from('tms_agent');
	$this -> db->where('handling_type', USER_MANAGER );
	
	$qry  = $this->db->get();
	if( $qry ) foreach(  $qry-> result_assoc() as $row )  {
		$result_array[$row['UserId']] = sprintf('%s - %s', $row['UserKode'], $row['full_name']);
	}
	return (array)$result_array;
}

/*
 * [Recovery data failed upload AJMI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
 
 // _get_general_manager 
 // lebih tinggi dari account_manager 
 
function _get_general_manager()  {
	$result_array = array();
	$this -> db->reset_select();
	$this -> db -> select('id as UserKode, UserId, full_name');
	$this -> db -> from('tms_agent');
	$this -> db -> where('handling_type', USER_GENERAL_MANAGER );
	
	$qry  = $this->db->get();
	if( $qry ) foreach(  $qry-> result_assoc() as $row )  {
		$result_array[$row['UserId']] = sprintf('%s - %s', $row['UserKode'], $row['full_name']);
	}
	
	return (array)$result_array;
}


/*
 * [Recovery data failed upload AJMI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
 
// USER_ACCOUNT_MANAGER  = USER_MANAGER BNI gunakan Kolom mgr_id 
// level di bawah General MANAGER  = act_mgr.
 
function _get_account_manager() {
	$result_array = array();
	$this->db->reset_select();
	$this->db->select('id as UserKode, UserId, full_name');
	$this->db->from('tms_agent');
	$this->db->where('handling_type', USER_ACCOUNT_MANAGER );
	$qry = $this->db->get();
	if( $qry ) foreach(  $qry-> result_assoc() as $row )  {
		$result_array[$row['UserId']] = sprintf('%s - %s', $row['UserKode'], $row['full_name']);
	}
	
	return (array)$result_array;
}


//@ select get profile id

function _get_quality_head() 
{
	$_data = array();
	$this -> db -> select('UserId, id, full_name');
	$this -> db -> from('tms_agent');
	$this -> db -> where('handling_type', USER_QUALITY_HEAD );
	
	foreach( $this -> db -> get() -> result_assoc() as $rows ) 
	{
		$_data[$rows['UserId']] = $rows['id'] ." - ". $rows['full_name'];
	}
	
	return $_data;
}



//@ select get profile id

function _get_quality_staff($UserId = null ) 
{
	$_data = array();
	$this -> db -> select('UserId, id, full_name');
	$this -> db -> from('tms_agent');
	$this -> db -> where('handling_type', USER_QUALITY_STAFF );
	$this -> db -> where('user_state',1);
	
	// if have leader 
	
	if( !is_null($UserId) ){
		$this -> db -> where('quality_id',$UserId);		
	}
	
	foreach( $this -> db -> get() -> result_assoc() as $rows ) 
	{
		$_data[$rows['UserId']] = $rows['id'] ." - ". $rows['full_name'];
	}
	
	return $_data;
}

 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
function _get_user_by_login() 
{
	
	$result_array = array();
	
	$this->db->reset_select();
	$this->db->select('UserId, id, full_name');
	$this->db->from('tms_agent');
	
	if( $this->EUI_Session->_get_session('HandlingType') == USER_ROOT ){
		$this->db->where_in('handling_type', array(USER_AGENT_OUTBOUND,USER_AGENT_INBOUND));
	}
	else if( $this->EUI_Session->_get_session('HandlingType') == USER_ADMIN ){
		$this->db->where_in('handling_type',array(USER_AGENT_OUTBOUND,USER_AGENT_INBOUND));	
	}
	else if( $this->EUI_Session->_get_session('HandlingType') == USER_GENERAL_MANAGER ){
		$this->db->where_in('handling_type', array(USER_AGENT_OUTBOUND,USER_AGENT_INBOUND));
		$this->db->where('act_mgr',$this -> EUI_Session->_get_session('UserId'));	
	}
	
	else if( $this->EUI_Session->_get_session('HandlingType') == USER_MANGER ){
		$this->db->where_in('handling_type', array(USER_AGENT_OUTBOUND,USER_AGENT_INBOUND));
		$this->db->where('mgr_id',$this -> EUI_Session->_get_session('UserId'));	
	}
	else if( $this -> EUI_Session->_get_session('HandlingType') == USER_SUPERVISOR ){
		$this->db->where_in('handling_type', array(USER_AGENT_OUTBOUND,USER_AGENT_INBOUND));
		$this->db->where('spv_id',$this -> EUI_Session->_get_session('UserId'));
	}
	else if($this->EUI_Session->_get_session('HandlingType') == USER_AGENT_OUTBOUND ){
		$this->db->where_in('handling_type',array(USER_AGENT_OUTBOUND,USER_AGENT_INBOUND));
		$this->db->where('UserId',$this -> EUI_Session->_get_session('UserId'));
	}
	else if($this->EUI_Session->_get_session('HandlingType') == USER_AGENT_INBOUND  ){
		$this->db->where_in('handling_type',array(USER_AGENT_OUTBOUND,USER_AGENT_INBOUND));
		$this->db->where('UserId',$this -> EUI_Session->_get_session('UserId'));
	}
	else if($this->EUI_Session->_get_session('HandlingType') == USER_LEADER  ){
		$this->db->where_in('handling_type',array(USER_AGENT_OUTBOUND,USER_AGENT_INBOUND));
		$this->db->where('tl_id',$this -> EUI_Session->_get_session('UserId'));
	}
	else{
		$this->db->where_in('handling_type',array(USER_AGENT_OUTBOUND,USER_AGENT_INBOUND));
	}
	
	$this->db->order_by("full_name");
	$qry = $this->db->get();
	
	if($qry && $qry->num_rows() > 0 )
	foreach( $qry->result_assoc() as $row )  {
		$result_array[$row['UserId']] = $row;
	}
	return (array)$result_array;
}

 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 function _get_admin_followup(){
	 
	$result_array = array();
	$sql = sprintf("select a.UserId, a.id, a.full_name 
					from tms_agent a where a.handling_type ='%s'", USER_ADMIN_FOLLOWUP);
					
	$qry = $this->db->query( $sql );
	if( $qry && $qry->num_rows() > 0) 
	foreach( $qry->result_assoc() as $row ){
		$result_array[$row['UserId']] = sprintf("%s - %s ", $row['id'], $row['full_name']);
	}	
	
	return (array)$result_array;
 } 

 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
	 
 function _get_admin_followup_login(){
	$result_array = array();
	
	$this->cok = CK();
	
	$this->db->reset_select();
	$this->db->select("a.UserId as Id, a.id as Kode, a.full_name as Name", false);
	$this->db->from('tms_agent a');
	
	$this->db->where('a.handling_type', USER_ADMIN_FOLLOWUP);
	// jika login sebagai "SPV"
	if(  $this->cok->cookie(USER_SUPERVISOR) ){
	  $this->db->where('a.spv_id', $this->cok->field('SupervisorId') );	
	}
	// jika login sebagai "USER_LEADER"
	if(  $this->cok->cookie(USER_LEADER ) ){
		$this->db->where('a.tl_id', $this->cok->field('SupervisorId') );	
	}
	// then will get resul data on here.
	 
	$qry = $this->db->get();
	if( $qry && $qry->num_rows() > 0) 
	foreach( $qry->result_assoc() as $row ){
		$result_array[$row['Id']] = sprintf("%s - %s ", $row['Kode'], $row['Name']);
	}	
	 return (array)$result_array;  
 }   
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
   
function _get_teleamarketer($param = null ) 
{
	$result_array = array();
	display();
	// get cokie login 
	$this->cok = CK();
	
	// then will get query data process 
	
	$this->db->reset_select();
	$this->db->select('UserId, id, full_name');
	$this->db->from('tms_agent');
	$this->db->where_in('handling_type', array( USER_AGENT_OUTBOUND,
												USER_AGENT_INBOUND));
		
	// cheked list 
	if( !is_null($param) AND ($param) ) {
		$this->db->where($param); 	
	}
	
	// level USER_ROOT
	if( !strcmp($this->cok->field('HandlingType'), USER_ROOT ) ) {
		$this->db->where_not_in('handling_type',array(USER_ROOT));
	}
	
	// level USER_ADMIN
	if( !strcmp($this->cok->field('HandlingType'),USER_ADMIN) ) {
		$this->db->where('admin_id IS NOT NULL','', FALSE);
		$this->db->where_not_in('handling_type',array(USER_ROOT));
	}
	
	// level USER_ACCOUNT_MANAGER 
	if( !strcmp($this->cok->field('HandlingType'),USER_ACCOUNT_MANAGER )) {  
		$this->db->where_in('act_mgr',$this->cok->field('UserId'));
		$this->db->where_not_in('handling_type',array( USER_ROOT, 
													   USER_ADMIN, 
													   USER_MANAGER, 
													   USER_ACCOUNT_MANAGER ));
	}
	
	// level USER_MANAGER
	if( !strcmp($this->cok->field('HandlingType'),USER_MANAGER )) { 
		$this->db->where_in('mgr_id',$this->cok->field('UserId'));
		$this->db->where_not_in('handling_type',array(  USER_ROOT, 
														USER_ADMIN, 
														USER_MANAGER ));
	}
	
	// level USER_SUPERVISOR
	
	if( !strcmp($this->cok->field('HandlingType'),USER_SUPERVISOR )) {   
		$this->db->where_in('spv_id',$this->cok->field('UserId'));
		$this->db->where_not_in('handling_type',array( USER_ROOT, 
													   USER_ADMIN, 
													   USER_MANAGER, 
													   USER_ACCOUNT_MANAGER, 
													   USER_SUPERVISOR ));
	}
	
	// level team USER_LEADER 
	
	if(!strcmp($this->cok->field('HandlingType'),USER_LEADER )) {    
		$this->db->where_in('tl_id',$this->cok->field('UserId'));
		$this->db->where_not_in('handling_type',array( USER_ROOT, 
													   USER_ADMIN, 
													   USER_MANAGER, 
													   USER_ACCOUNT_MANAGER, 
													   USER_SUPERVISOR, 
													   USER_LEADER ));
	}
	
	$this->db->order_by("id");
	
	$rs = $this->db->get();
	if( $rs && $rs->num_rows() > 0 )
	foreach($rs->result_assoc() as $row )  {
		$result_array[$row['UserId']] = sprintf("%s - %s", $row['id'], $row['full_name']);
	}
	
	return (array)$result_array;
}


//@ select get profile id

function _get_supervisor() 
{
  $_data = array();
  $this->db ->reset_select();
  $this->db ->select('id as UserKode, UserId, full_name');
  $this->db ->from('tms_agent');
  $this->db ->where('handling_type', USER_SUPERVISOR );
	
  $handling_type = _get_session('HandlingType');
  if(in_array($handling_type, array(USER_SUPERVISOR) )){
	$this->db->where_in("UserId", _get_session('UserId'));
  }
	
  if(in_array($handling_type, array(USER_LEADER) )){
	$this->db->where_in("UserId", _get_session('SupervisorId'));
  }
 
  $rs = $this->db->get();
  if( $rs->num_rows() > 0 ) 
	foreach( $rs-> result_assoc() as $rows ) 
{
	$_data[$rows['UserId']] = sprintf('%s - %s', $rows['UserKode'], $rows['full_name']);
 }
	
	return $_data;
}

//@ select get profile id

function _get_teamleader() 
{
	$_data = array();
	$this -> db -> select('UserId, full_name');
	$this -> db -> from('tms_agent');
	$this -> db -> where('handling_type', USER_LEADER );
	
	foreach( $this -> db -> get() -> result_assoc() as $rows ) 
	{
		$_data[$rows['UserId']] = $rows['full_name'];
	}
	
	return $_data;
}

//@ select get profile id

function _get_atmleader() 
{
	$_data = array();
	$this -> db -> select('UserId, full_name , id');
	$this -> db -> from('tms_agent');
	$this -> db -> where('handling_type', USER_SUPERVISOR );
	
	foreach( $this -> db -> get() -> result_assoc() as $rows ) 
	{
		$_data[$rows['UserId']] = $rows['id'];
	}
	
	return $_data;
}


//@ cc_agent_group

function _getJoinUser()
{
	$_conds = array();
	
	$this->db->select('b.id, b.userid, b.name');
	$this->db->from('tms_agent a');
	$this->db->join('cc_agent b','a.id=b.userid','LEFT');
	$this->db->join('tms_agent_profile c','a.profile_id=c.id','LEFT');
	$this->db->where('c.IsActive',1);
	$this->db->where('b.userid is not null');
	
	foreach( $this -> db -> get() -> result_assoc() as $rows )
	{
		$_conds[$rows['id']] = $rows['name'];
	}
	
	return $_conds;

}

//@ cc_agent_group

function _get_agent_group() 
{
	$_data = array();
	$this -> db -> select('id, description');
	$this -> db -> from('cc_agent_group');

	foreach( $this -> db -> get() -> result_assoc() as $rows ) 
	{
		$_data[$rows['id']] = $rows['description'];
	}
	
	return $_data;
}

//@ cc_agent_group

function _get_telephone() 
{
	$_data = array('1'=>'YES','0'=>'NO');
	return $_data;
}


// _getUserCapacity

function _getUserCapacity( $Status=1 )
{
	$_Capacity = 0;
	
	$this -> db -> select("COUNT('a.UserId') as Jumlah",FALSE);
	$this -> db -> from("tms_agent a");
	$this -> db -> where("a.user_state", $Status);
	$this -> db -> where_in("a.profile_id", array(USER_AGENT_OUTBOUND,USER_AGENT_INBOUND));
	
	$rows = $this -> db -> get()->result_first_assoc();
	if( is_array($rows) )
	{
		$_Capacity = (INT)$rows['Jumlah'];
	}
	
	return $_Capacity;
	
}

 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
function _getUserLevelGroup( $Level = null, $arr_active = null ) {
	
// define sesion object 
   $CK =& CK();
  
	
// define default array object .	
  $result_array = array();
  
 // reset select & query data 
 
  $this->db->reset_select();
  $this->db->select('b.UserId, b.full_name as Username, b.id as UserKode, b.init_name, a.id as UserLevelId');
  $this->db->from('tms_agent_profile a');
  $this->db->join('tms_agent b','a.id=b.handling_type','LEFT');
	
// on active or not active User 
 // $this->db->where('b.logged_state', 1);
 
	if(!is_null($Level) ){
		$this->db->where('a.id', $Level);
	}
	
 // on active or not active User 	
	if( is_array($arr_active) AND count($arr_active) > 0) {
		$this->db->where_in("b.user_state", $arr_active);
	}
	

// get kondition OK 	
	if( !is_array($arr_active)  AND !is_null($arr_active) ) {
		$this->db->where_in("b.user_state", array($arr_active));
	}
	
// level USER_ROOT	
	if( $CK->field('HandlingType')== USER_ROOT ) {
		//$this->db->where_not_in('b.handling_type',array(USER_ROOT));
	}
	
// level USER_ADMIN
	if( $CK->field('HandlingType')== USER_ADMIN ) {
		$this->db->where('b.admin_id IS NOT NULL', '', false);
		$this->db->where_not_in('b.handling_type',array( USER_ROOT ));
	}
	
		
	// level USER_GENERAL MANAGER 
	if( $CK->field('HandlingType')== USER_GENERAL_MANAGER ) {
		$this->db->where_in('b.act_mgr',$CK->field('UserId'));
		$this->db->where_not_in('b.handling_type',array( USER_ROOT,
														 USER_ADMIN,
														 USER_GENERAL_MANAGER ));
	}
	
	// level USER_MANAGER | USER_ACCOUNT_MANAGER
	if( @in_array( $CK->field('HandlingType'), array( USER_MANAGER, USER_ACCOUNT_MANAGER )  )) {
		
		$this->db->where_in('b.mgr_id',$CK->field('UserId'));
		$this->db->where_not_in('b.handling_type',array( USER_ROOT,
														 USER_ADMIN,
														 USER_MANAGER,
														 USER_ACCOUNT_MANAGER, 
														 USER_GENERAL_MANAGER ));
	}
	
	
	// level USER_SUPERVISOR
	
	if( $CK->field('HandlingType')== USER_SUPERVISOR ) {
		$this->db->where_in('b.spv_id',$CK->field('UserId'));
		$this->db->where_not_in('b.handling_type',array( USER_ROOT,
														 USER_ADMIN,
														 USER_MANAGER,
														 USER_GENERAL_MANAGER,	
														 USER_ACCOUNT_MANAGER,
														 USER_SUPERVISOR ));
	}
	
	
	// level team USER_LEADER 
	if( $CK->field('HandlingType')== USER_LEADER ) {
		$this->db->where_in('b.tl_id',$CK->field('UserId'));
		$this->db->where_not_in('b.handling_type',array( USER_ROOT,
														 USER_ADMIN,
														 USER_MANAGER,
														 USER_GENERAL_MANAGER,
														 USER_ACCOUNT_MANAGER,
														 USER_SUPERVISOR,
														 USER_LEADER ));
	}
	
	/*
	//----------- LOOK OF RESULT DATA ------------------------------ 
	//----------- echo $this->db->_get_var_dump(); -----------------
	*/
	
	$this->db->order_by("b.UserId", "ASC");
	$rs = $this->db->get();
	if($rs->num_rows()> 0 ) foreach( $rs->result_assoc() as $row )  {
		$result_array[$row['UserId']] = sprintf('%s - %s',  $row['UserKode'], 
															$row['Username'] );
	}
	return $result_array;
}	
	
/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 public function _getUserGroupWithMe( $Level = null, $arr_active = null )
{
    $result_array = array();
	$this->db->reset_select();
	$this->db->select('b.UserId, b.id, b.full_name, a.id as UserLevelId');
	$this->db->from('tms_agent_profile a');
	$this->db->join('tms_agent b','a.id=b.handling_type','LEFT');
	
//---------- on active or not active User 
	
	if(!is_null($Level) ){
		$this->db->where('a.id', $Level);
	}
	
//---------- on active or not active User 	
	if( is_array($arr_active) 
		AND count($arr_active) > 0)
	{
		$this->db->where_in("b.user_state", $arr_active);
	}
	
	if( !is_array($arr_active) 
		AND !is_null($arr_active) )
	{
		$this->db->where_in("b.user_state", array($arr_active));
	}
	
	// level USER_ROOT
	
	if(_get_session('HandlingType')== USER_ROOT ) {
		
	}
	
	// level USER_ADMIN|admin_id
	if(_get_session('HandlingType')== USER_ADMIN ) {
		$this->db->where_in('b.admin_id',_get_session('UserId'));
		$this->db->where_not_in('b.handling_type',array(USER_ROOT));
	}
	
	
	// level USER_ACCOUNT_MANAGER / USER_GENERAL_MANAGER
	// act_mgr 
	
	 
	// if(_get_session('HandlingType')== USER_ACCOUNT_MANAGER ) {
		// $this->db->where_in('b.act_mgr',_get_session('UserId'));
		// $this->db->where_not_in('b.handling_type',array(
			// USER_ROOT,
			// USER_ADMIN,
			// USER_ADMIN_FOLLOWUP
		// ));
	// }
	//var_dump(USER_MANAGER);
	
	// level USER_MANAGER | mgr_id
	if(_get_session('HandlingType')== USER_MANAGER ) {
		$this->db->where_in('b.mgr_id',_get_session('UserId'));
		$this->db->where_not_in('b.handling_type',array(
			USER_ROOT,
			USER_ADMIN,
			USER_ACCOUNT_MANAGER,
			USER_ADMIN_FOLLOWUP
		));
	}
	
	
	// level USER_SUPERVISOR | spv_id
	
	if(_get_session('HandlingType')== USER_SUPERVISOR ) {
		$this->db->where_in('b.spv_id',_get_session('UserId'));
		$this->db->where_not_in('b.handling_type',array(
			USER_ROOT,
			USER_ADMIN,
			USER_MANAGER,
			USER_ACCOUNT_MANAGER,
			USER_ADMIN_FOLLOWUP
		));
	}
	
	// level team USER_LEADER | tl_id
	
	if(_get_session('HandlingType')== USER_LEADER ) {
		$this->db->where_in('b.tl_id',_get_session('UserId'));
		$this->db->where_not_in('b.handling_type',array(
			USER_ROOT,
			USER_ADMIN,
			USER_MANAGER,
			USER_ACCOUNT_MANAGER,
			USER_SUPERVISOR,
			USER_ADMIN_FOLLOWUP
		));
	}
	
	// LOOK OF RESULT DATA 
	// $this->db->print_out();
	
	$qry = $this->db->get();
	if( $qry && $qry->num_rows()>0 ) 
	foreach( $qry->result_record() as $row ) {
		$result_array[$row->field('UserId')] = sprintf( '%s - %s', $row->field('id'),  $row->field('full_name'));
	}
	
	return (array)$result_array;
}		
	
/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */	
function _get_quality_staff_by_skill() 
{
	$_data = array();
	
	$sql = "select a.Quality_Group_Id, b.UserId, a.Quality_Skill_Id, b.id, b.full_name from t_gn_quality_group a
			left join tms_agent b on a.Quality_Staff_id = b.UserId
			where b.UserId is not null";
	$qry = $this->db->query($sql);
	
	if($qry->num_rows() > 0)
	{
		foreach($qry->result_assoc() as $rows)
		{
			$_data[$rows['Quality_Skill_Id']][$rows['UserId']] = $rows['id'].' - '.$rows['full_name'];
		}
	}
	
	return $_data;
}

//---------------------------------------------------------------------------------------
/*
 * @ package 		get all user data 
 */
 
 function _get_select_all_user() 
{
  $arr_select_all = array();
  $this->db->reset_select();
  $this->db->select("a.UserId, a.id, a.full_name ");
  $this->db->from("tms_agent a ");
  $this->db->order_by("a.full_name","ASC");
  $rs = $this->db->get();
  if( $rs->num_rows() > 0 ) 
	  foreach( $rs->result_assoc() as $rows )
  {	
	$arr_select_all[$rows['UserId']] = sprintf("%s - %s", $rows['id'], $rows['full_name']) ;// "( {} ) {}";	
  }
  
  return (array)$arr_select_all;
}


//---------------------------------------------------------------------------------------
/*
 * @ package 		get all user data 
 * @ return (array) with UserId 
 */
 
  public function _select_row_user_id_by_level( $level = null  )
 {
	$arr_select_all = array(); 
	
	if( !is_array($level) ){
		$level = array( $level );	
	 }
	 
	 if( count($level) == 0 )
	{
		return (array)$arr_select_all;
	}
	
	$this->db->reset_select();
	$this->db->select("a.UserId", false);
	$this->db->from("tms_agent a");
	$this->db->join("tms_agent_profile b ","a.handling_type = b.id","LEFT");
	$this->db->where("b.IsActive", 1);
	$this->db->where_in("b.id", array_map('intval', $level) );
	
	$rs = $this->db->get();
	if( $rs->num_rows() > 0 ) 
		foreach( $rs->result_assoc() as $rows )
	{
		$arr_select_all[$rows['UserId']] = $rows['UserId'];
	}
	return (array)$arr_select_all;
 } 
 
	function _get_user_by_query( $where=array() )
	{
		$_datas = array();
		
		$sql = "select UserId, init_name from tms_agent
				where 1=1
				AND user_state = 1 ";
				
		foreach($where as $field => $value)
		{
			$sql .= " AND $field = '$value' ";
		}
		
		$sql .= " ORDER BY init_name ASC ";
		
		$qry = $this->db->query($sql);
		
		if($qry->num_rows()>0)
		{
			$no=0;
			foreach($qry->result_assoc() as $rows)
			{
				$_datas[$rows['UserId']] = (++$no).' - '.$rows['init_name'];
			}
		}
		
		return $_datas;
	}

	function _getUserByCode( $UserCode = null, $state =null )
	{
		$_data = array();

		$this -> db -> select('
				a.UserId, a.id as Username, 
				a.full_name, a.tl_id, a.handling_type, 
				a.spv_id, a.mgr_id, a.act_mgr, 
				a.quality_id, a.admin_id, a.code_user, 
				a.init_name', FALSE);
				
	  	$this-> db -> from('tms_agent a');
		
		// @ pack : customize query // default by code 
		
	  	if(!is_array($UserCode)){	
			$this->db->where('a.id', $UserCode);
	  	}
	  
		// @ pack : customize query 
		  
	 	if(is_array($UserCode)) 
	 		foreach( $UserCode as $key => $val ) {
			    	if(!is_array($val) ){
						$this->db->where_in($key, array($val));
				} else{
					$this->db->where_in('a.id', $val);
				}
			}
	 
		// @ pack : default is null ----------------------------> 
		
		if(is_null($state) ){
			$this->db->where_in('a.user_state', array(0,1));
		}
		
		// @ pack : default is null 	
	 	if( is_array( $state )){
			$this->db->where_in('a.user_state', array(0,1));
	  	}
		
		// @ pack : default is null 	
	  	if( !is_array( $state ) AND !is_null($state) ){
			$this->db->where_in('a.user_state',array($state));
	  	}
		
		// @ pack : default is null 	
		$this->db->order_by("a.full_name","ASC");
		$_data = $this->db->get();
		
		if( $_data->num_rows()> 0 ) {
			return $_data->result_first_assoc();
		}	
		else
			return false;
	}

// =============== END CLASS ==========

}
?>
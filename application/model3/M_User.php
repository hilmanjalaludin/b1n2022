<?php
/*
 * EUI Model  
 *
 
 * Section  : < M_User > get information user on table 
 * author 	: razaki team  
 * link		: http://www.razakitechnology.com/eui/controller 
 */
 
class M_User extends EUI_Model{

// ------------------------------------------------------------
/*
 * @ package 		instance class 
 */
 
 private static $Instance = null;
 public static function &Instance()
{
   if( is_null(self::$Instance) )
  {
	self::$Instance = new self();
  }
  return self::$Instance;
}

// ------------------------------------------------------------
/*
 * @ package 		constructor  
 */
 
 public function __construct()  {
	$this->load->model(array('M_Loger'));
 }
 
// ------------------------------------------------------------------------

/**
 * Create URL Title
 * @access	public
 * @param	string	the string
 * @param	string	the separator: dash, or underscore
 * @return	string
 */
 
 function _getATM() 
 {
	$datas = array();	
	$this->db->reset_select();
	$this->db->select('UserId, full_name');
	$this->db->from('tms_agent');
	$this->db->where('handling_type',3);
	$rs = $this->db->get();
	if( $rs->num_rows() > 0 )
		foreach ( $rs->result_assoc() as $rows) 
	{
		$datas[$rows['UserId']] = $rows['full_name'];
	}

	return $datas;
}
 
// ------------------------------------------------------------------------

/**
 * Create URL Title
 * @access	public
 * @param	string	the string
 * @param	string	the separator: dash, or underscore
 * @return	string
 */
 
function _set_update_activity( $event = 'LOGIN', $UserId ) {
	return TRUE;
}
// ------------------------------------------------------------------------

/**
 * Create URL Title
 * @access	public
 * @param	string	the string
 * @param	string	the separator: dash, or underscore
 * @return	string
 */
 function _get_last_login()
 {
	$_conds = null;
	
	$UserId = $this -> EUI_Session -> _get_session('UserId');
	
	$this->db->reset_select();
	$this->db->select("a.ActivityDate",false);
	$this->db->from("t_gn_activitylog a");
	$this->db->where("a.ActivityUserId", _get_session('UserId'));
	$this->db->where("a.ActivityEvent", "ACTION_EVENT_LOGIN");
	$this->db->order_by("a.ActivityId", "DESC");
	$this->db->limit(1);
	
	$rs = $this->db->get(); 
	if( $rs->num_rows() > 0 ) 
	{
		$rows =& Objective( $rs->result_first_assoc() );
		if( $rows->find_value('ActivityDateTs') ) {
			$_conds = $rows->get_value('ActivityDateTs');
		}
	}
	
	return (string)$_conds;
		
 }
  
// ------------------------------------------------------------------------
/**
 * check used password on history 
 * @access	public
 * @param	string	the string
 * @param	string	the separator: dash, or underscore
 * @return	string
 */
 
function _getPasswordHistory( $Username= null, $Password= null ){

	if( is_null($Username) OR is_null( $Password ) ){
		return false;
	}
	
	$this->db->reset_select();
	$this->db->select("count(a.ActivityId) as tot", false);
	$this->db->from("t_gn_activitylog a");
	$this->db->where("a.ActivityEvent", "ACTION_EVENT_PASSWORD");
	$this->db->where("a.ActivityUserName", $Username);
	$this->db->where("a.ActivityDesc", $Password);
	//$this->db->print_out();
	
	$rs = $this->db->get();
	
	if( $rs->num_rows() > 0 AND $row = $rs->result_first_assoc() ){
		$total_used_password = (int)$row['tot'];
	}
	
	return $total_used_password;
}

 
/*
 * get login detail every user on tms agent 
 * return < array >
 */
 
function getLoginUser( $_User )
{
	$_conds  = FALSE;
	
	if( !is_array( $_User ) ) {
		return (bool)$_conds;
	}
	
	$User =& Objective( $_User );

	$sql = sprintf("
				SELECT a.*, b.menu_group, b.menu, b.name as GroupName, b.level_group as GroupLevel  
				FROM tms_agent a 
				LEFT JOIN tms_agent_profile b on a.handling_type=b.id 
				WHERE a.user_state = 1 and a.id ='%s' 
				AND a.password='%s'", 
				$User->get_value('username'), 
				md5($User->get_value('password')) );
				
	$rs = $this->db->query($sql);
	if( $rs -> num_rows() > 0 ) {
		$_conds = $rs->result_first_assoc();
	}	
	
	return $_conds;
 }
 
function getLoginUserBlocked( $_User )
{
	$_conds  = array();

	$sql = sprintf("
				SELECT a.*, b.menu_group, b.menu, b.name as GroupName, b.level_group as GroupLevel  
				FROM tms_agent a 
				LEFT JOIN tms_agent_profile b on a.handling_type=b.id 
				WHERE a.id ='%s' ", 
				$_User );
	// echo $sql;		
	$rs = $this->db->query($sql);
	if( $rs -> num_rows() > 0 ) {
		$_conds = (array)$rs->result_first_assoc();
	}
	return $_conds;
 }
 
 function getUserBlocked( $_User )
{
	$_conds  = array();

	$sql = sprintf("
				select
					a.id, a.userid, c.full_name, b.ext_status, b.status_reason,
					unix_timestamp(now()) - unix_timestamp(b.status_time) as stat_duration
				from cc_agent a
				inner join cc_agent_activity b on a.id = b.agent
				inner join tms_agent c on a.userid = c.id
				where b.ext_status = 25 and c.handling_type = 4
				and c.UserId = '%s' ", 
				$_User );
	// echo $sql;		
	$rs = $this->db->query($sql);
	if( $rs -> num_rows() > 0 ) {
		$_conds = (array)$rs->result_first_assoc();
	}
	return $_conds;
 }
 
 function getListBlock( $_User )
{
	$_conds  = array();

	$sql = sprintf("
				select
					count(a.AgentID) total
				from t_gn_agent_block a
				where date(a.BlockDate) = curdate()
				and a.ReasonID = 2
				and a.AgentID ='%s' ", 
				$_User );
	// echo $sql;	
	$rs = $this->db->query($sql);
	if( $rs -> num_rows() > 0 ) {
		$_conds = (array)$rs->result_first_assoc();
	}
	return $_conds;
 }
 
 function getLogin( $_User )
{
	$_conds  = array();

	$sql = sprintf("
				select
					min(a.ActivityDate) as Tgl
				from t_gn_activitylog a
					inner join tms_agent b on a.ActivityUserId = b.UserId
				where b.handling_type = 4
				and date(a.ActivityDate) = curdate()
				and a.ActivityUserName ='%s' ", 
				$_User );
	// echo $sql;
	$rs = $this->db->query($sql);
	if( $rs -> num_rows() > 0 ) {
		$_conds = (array)$rs->result_first_assoc();
	}
	return $_conds;
 }

//---------------------------------------------------------------------------------------
/*
 * @ package 		_set_row_update_user_logout
 */
 protected function _set_row_update_user_logout()
{
 
 $this->db->reset_write();			
 $this->db->set('ip_address','NULL',FALSE);	
 $this->db->set('last_update',$this->EUI_Tools->_date_time());
 $this->db->set('logged_state',$Login);
 $this->db->where('UserId',_get_session('UserId'));
 $this->db->update('tms_agent');	
	if( $this->db->affected_rows() > 0 )
 {
	EventLoger("OUT", array("sesion logout from device"));
	return true;
  }
	return FALSE;	
 }
 
//---------------------------------------------------------------------------------------
/*
 * @ package 		_set_row_update_user_login
 */
 protected function _set_row_update_user_login()
{
 $this->db->reset_write(); 
 $this->db->where('UserId',_get_session('UserId'));
 $this->db->set('ip_address', $this->EUI_Tools->_get_real_ip() );
 $this->db->set('last_update',$this->EUI_Tools->_date_time() );
 $this->db->set('logged_state',1);
 
  $this->db->update('tms_agent');
  if( $this->db->affected_rows() > 0 )
  {
	EventLoger("INC", array( "sesion Login from device")); 
	return TRUE;
 } 
  return FALSE;	
}
 
//---------------------------------------------------------------------------------------
/*
 * @ package 		get all user data 
 */
 
  public function _setUpdateLastLogin( $Login=1 )
 {
	$cond= 0;
	if( $Login ==1 ) 
	{
		$this->db->reset_write();	
		$this->db->set('login_count','(login_count)+1', FALSE );
		$this->db->where('UserId', $this->EUI_Session->_get_session('UserId'));
		$this->db->update('tms_agent');	
	}
	
//--- check sesion vailable user  ----------------------
	
	if( _have_get_session('UserId') 
		AND _get_session('UserId')) 
	{
		if( $Login ){
			$cond = $this->_set_row_update_user_login();	
		} else {
			$cond = $this->_set_row_update_user_logout();	
		}
	}					
		
	return $cond;
 }
 
// ----------------------------------
/*
 * @ pack			UserRole 		
 */

 public function _setUserRole( $UserRole = '' )
{
 $arr_user_login = array();
 $arr_user_role = explode(',', $UserRole);	
 if(is_array($arr_user_role) ) 
	foreach( $arr_user_role as $key => $val )
 {
	$arr_user_login[$val] = $val;
 }
 return (array)$arr_user_login;
 
} 
 
// _setUpdatePassword :: change of the parameter on here test again 
 
 public function _setUpdatePassword( $param=null )
 {
	 
	$_conds = 0;
	
	$out = new EUI_Object( $param );
	
	 if( $out->fetch_ready() )
	{
		$this->db->reset_write();	
		
		// --- update by userid parameter --- 
		if( $out->find_value('UserId') ) {
			$this->db->where('UserId', $out->get_value('UserId') );	
		}
		
		// --- update by username parameter --- 
		
		else if( $out->find_value('Username') ) {
			$this->db->where('id', $out->get_value('Username'));	
		}
		
		// --- update by session login -- 
		else {
			$this->db->where('UserId', _get_session('UserId') );	
		}
		
		$this->db->where('password', (string)$out->get_value('curr_password', 'md5'));
		$this->db->set('password',(string)$out->get_value('new_password', 'md5'));
		
		
		// --- if have user update data ---- 
		
		if( $out->find_value('UpdateDate') ){
			$this->db->set('update_password',$out->get_value('UpdateDate'));
		}
		
		$this->db->update('tms_agent'); 
		if( $this->db->affected_rows() >0 ) 
		{
			EventLoger('UPD', array(
				"Change password", 
				"from", $out->get_value('curr_password', 'md5'),
				"to", $out->get_value('new_password', 'md5')
			), $out->get_value('Username'));
			$_conds++;
		}
	}
	
	return $_conds;
 }
 

//---------------------------------------------------------------------------------------
/*
 * @ package 		get all user data 
 */
 
 public function  _set_user_change_password( $out  = null )
{
 if( !$out->fetch_ready() ){
	return FALSE;
 }	

//------ compare string is match ---------------------	
 if( strcmp( $out->get_value('new_password', 'md5'),  
	$out->get_value('renew_password', 'md5') ) == 0 )
 {
	$this->db->reset_write();
	$this->db->where("id", (string)$out->get_value('userid', 'trim'));
	$this->db->set("password", (string)$out->get_value('renew_password', 'md5'));
	$this->db->set("update_password", date('Y-m-d H:i:s'));
	$this->db->update("tms_agent");
	if( $this->db->affected_rows() > 0 )
	{
	  // set to loger 
		EventLoger('UPD', array(
			"Change password", 
			"from", $out->get_value('password'),
			"to", $out->get_value('renew_password', 'md5')
		));
			
		return TRUE;	
	}	
 } 
   return FALSE;
   
 }

 
 
 
}

// END OF FILE
// location : ./application/controller/Auth.php

?>
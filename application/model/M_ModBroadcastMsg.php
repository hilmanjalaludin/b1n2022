<?php
/*
 * [Recovery APP BNI Tele ANS CHATTING MODULS]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
 
class M_ModBroadcastMsg extends EUI_Model {
	

/*
 * [Recovery APP BNI Tele ANS CHATTING MODULS]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
 
/** 
 * connect to database [chating] config 
 * on [/opt/enigma/webapps/bni-tele-ans-dev3.1.4.r1/system/keys/81dc9bdb52d04dc20036dbd8313ed055.ini]::chating
 */
 
 function __construct(){
	$this->load->model(array('M_UserRole'));	
	
 }
/*
 * [Recovery APP BNI Tele ANS CHATTING MODULS]
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

/*
 * [Recovery APP BNI Tele ANS CHATTING MODULS]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
 
 function _select_row_user_active( $out = null ){
 
 $this->db->reset_select();
 $this->db->select("
	a.UserId as UserId,
	b.userid as UserOnline,
	a.full_name as UserFullname,
	c.name as GroupName,
	IF(a.logged_state =1, 'Login', 'Logout') as UserLogin", 
 FALSE);
 $this->db->from("tms_agent a");
 $this->db->join("cc_agent b", "a.id=b.userid", "INNER");
 $this->db->join("tms_agent_profile c "," a.handling_type=c.id", "LEFT");
 $this->db->where("a.user_state", 1);
 
 
// --- if this OK ---  
 if( $out->find_value('UserLogin') ){
	$this->db->where_in("a.logged_state", $out->get_value('UserLogin')); 
 }
 
// -- handling --- 
 
 $HandlingType = _get_session('HandlingType');
 //var_dump($HandlingType);
 
// --- root ---  
 if(in_array($HandlingType, 
	array(USER_ADMIN)))
 {
	$this->db->where_not_in("a.handling_type", array(USER_ROOT));
 } 
 
// --- user Act MGR --- 
 
  if(in_array($HandlingType, 
	array(USER_ACCOUNT_MANAGER)))
 {
	$this->db->where_not_in("a.handling_type", array(USER_ROOT, USER_ADMIN));
	$this->db->where_not_in("a.UserId", array(_get_session('UserId')));
	// $this->db->where_in("a.act_mgr", array(_get_session('UserId')));
 }
 
// --- user Act MGR --- 
 
  if(in_array($HandlingType, 
	array(USER_SUPERVISOR)))
 {
	$this->db->where_not_in("a.handling_type", array(USER_ROOT, USER_ADMIN));
	$this->db->where_not_in("a.UserId", array(_get_session('UserId')));
	$this->db->where_in("a.spv_id", array(_get_session('UserId')));
 } 
// --- user leader --- 
 
  if(in_array($HandlingType, 
	array(USER_LEADER)))
 {
	$this->db->where_in("a.handling_type", array(USER_ACCOUNT_MANAGER, USER_AGENT_INBOUND, USER_AGENT_OUTBOUND));
	$this->db->where_not_in("a.UserId", array(_get_session('UserId')));
	$this->db->where_in("a.tl_id", array(_get_session('UserId')));
	$this->db->where_in("a.act_mgr", array(_get_session('AccountManager')));
 } 
 
// $this->db->print_out();
  // --------- order_by -------------------------------------------------------------
 
 if( $out->find_value('orderby') ) {
	$this->db->order_by( $out->get_value('orderby'), $out->get_value('type') );		
 } else {
	$this->db->order_by( "b.userid", "ASC"); 
 }
   
 $rs = $this->db->get();
 if( $rs->num_rows() > 0 ){
	return $rs->result_assoc();
 }
	
 return array();
}
/*
 * [Recovery APP BNI Tele ANS CHATTING MODULS]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
  
 function _getUserOnline(){
	$sql = null; $_conds = array();
	
	// level : root 
	
	if( $this -> EUI_Session -> _have_get_session('HandlingType')== USER_ROOT)
		$sql = "SELECT * FROM tms_agent a where a.user_state=1 AND logged_state = 1";
	
	// level : admin
	
	if( $this -> EUI_Session -> _have_get_session('HandlingType')== USER_ADMIN)
		$sql = "SELECT * FROM tms_agent a where a.user_state=1 AND logged_state = 1
				a.handling_type NOT IN('" . USER_ROOT ."') ";
	
	// level : manager 
	
	if( $this -> EUI_Session -> _have_get_session('HandlingType')== USER_MANAGER)
		$sql = "SELECT * FROM tms_agent a WHERE a.user_state=1  
				AND a.mgr_id ='". $this -> EUI_Session ->_get_session('UserId') ."' 
				AND a.handling_type='".USER_TELESALES."' AND logged_state = 1";
				
	// level : supervisor
	
	if( $this -> EUI_Session -> _have_get_session('HandlingType')== USER_SUPERVISOR)
		$sql = "SELECT * FROM tms_agent a WHERE a.user_state=1  
				AND a.spv_id ='". $this -> EUI_Session ->_get_session('UserId') ."' 
				AND a.handling_type='".USER_TELESALES."' AND logged_state = 1";
	
	// level : leader 
	
	if( $this -> EUI_Session -> _have_get_session('HandlingType')== USER_LEADER)
		$sql = "SELECT * FROM tms_agent a WHERE a.user_state=1  
				AND a.tl_id='".$this->EUI_Session->_get_session('UserId') ."' 
				AND a.handling_type='".USER_TELESALES."' AND logged_state = 1";
				
	
	// level : Telemarketing 
	
	if( $this -> EUI_Session -> _have_get_session('HandlingType')== USER_TELESALES )
		$sql = "SELECT * FROM tms_agent a WHERE a.user_state=1 
				AND a.handling_type='".USER_TELESALES."' AND logged_state = 1";
	
	// level : Quality Insurance ( QA ) 
	
	if( $this -> EUI_Session -> _have_get_session('HandlingType')== USER_QUALITY)
		$sql = "SELECT * FROM tms_agent a WHERE a.user_state=1 AND logged_state = 1";
		
	// execute 
	
	if( !is_null( $sql) )
	{
		$qry = $this -> db -> query($sql);
		foreach( $qry -> result_assoc() as $rows )
		{
			$_conds[$rows['UserId']] = array
			(
				'name' => $rows['full_name'],
				'code' => $rows['id'] 
			);
		}
	}	
	
	return $_conds;
 }
/*
 * [Recovery APP BNI Tele ANS CHATTING MODULS]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
 function _getUserOffline() {
	$sql = null; $_conds = array();
	
	// level : root 
	
	if( $this -> EUI_Session -> _have_get_session('HandlingType')== USER_ROOT)
		$sql = "SELECT * FROM tms_agent a where a.user_state=1 AND logged_state=0";
	
	// level : admin
	
	if( $this -> EUI_Session -> _have_get_session('HandlingType')== USER_ADMIN)
		$sql = "SELECT * FROM tms_agent a where a.user_state=1 AND logged_state=0
				a.handling_type NOT IN('" . USER_ROOT ."') ";
		
	
	// level : manager 
	
	if( $this -> EUI_Session -> _have_get_session('HandlingType')== USER_MANAGER)
		$sql = "SELECT * FROM tms_agent a WHERE a.user_state=1  
				AND a.mgr_id ='". $this -> EUI_Session ->_get_session('UserId') ."' 
				AND a.handling_type='".USER_TELESALES."' AND logged_state=0";
				
	// level : supervisor
	
	if( $this -> EUI_Session -> _have_get_session('HandlingType')== USER_SUPERVISOR)
		$sql = "SELECT * FROM tms_agent a WHERE a.user_state=1  
				AND a.spv_id ='". $this -> EUI_Session ->_get_session('UserId') ."' 
				AND a.handling_type='".USER_TELESALES."' AND logged_state =0";
	
	// level : Telemarketing 
	
	if( $this -> EUI_Session -> _have_get_session('HandlingType')== USER_TELESALES )
		$sql = "SELECT * FROM tms_agent a WHERE a.user_state=1 
				AND a.handling_type='".USER_TELESALES."' AND logged_state =0";
	
	// level : Quality Insurance ( QA ) 
	
	if( $this -> EUI_Session -> _have_get_session('HandlingType')== USER_QUALITY)
		$sql = "SELECT * FROM tms_agent a WHERE a.user_state=1 AND logged_state =0";
		
	// execute 
	
	if( !is_null( $sql) )
	{
		$qry = $this -> db -> query($sql);
		foreach( $qry -> result_assoc() as $rows )
		{
			$_conds[$rows['UserId']] = array
			(
				'name' => $rows['full_name'],
				'code' => $rows['id'] 
			);
		}
	}	
	
	return $_conds;
 }
/*
 * [Recovery APP BNI Tele ANS CHATTING MODULS]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
 
 function _setSendUserOnline( $data=null ) {
	$totals = 0;
	
	// get [integers]
	$fromUser = (int)get_cokie_value('UserId');
	if( is_null($data) or !isset($data['Users']) ) {
		return 0;
	}
	
	// get array [process on this]
	if( is_array( $data ) ) 
	foreach( $data['Users'] as $key => $UserId ) {
		$this->dbchat->reset_write();
		$this->dbchat->set('from', $fromUser);
		$this->dbchat->set('to', $UserId);
		$this->dbchat->set('message', $data['Message']);
		$this->dbchat->set('sent', date('Y-m-d H:i:s'));
		$this->dbchat->set('recd', 0 );
		if( $this->dbchat->insert('tms_agent_msgbox') ) {
			$totals++;
		}	
	}
	return $totals;
	
 }
/*
 * [Recovery APP BNI Tele ANS CHATTING MODULS]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
 function _setSendUserOffline( $data=null ) {
	$totals = 0;
	
	// get [integers]
	$fromUser = (int)get_cokie_value('UserId');
	if( is_null($data) or !isset($data['Users']) ) {
		return 0;
	}
	// get process data on [process]
	if(is_array($data))
	foreach( $data['Users'] as $key => $UserId ){
		$this->dbchat->reset_write();
		$this->dbchat->set('from', $fromUser);
		$this->dbchat->set('message', $data['Message']);
		$this->dbchat->set('sent', date('Y-m-d H:i:s'));
		$this->dbchat->set('to', $UserId);
		$this->dbchat->set('recd', 0);
		if( $this->dbchat->insert('tms_agent_msgbox') ) {
			$totals++;
		}		
	}
	// return integers
	return (int)$totals;
	
 }
/*
 * [Recovery APP BNI Tele ANS CHATTING MODULS]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
function _set_row_sent_broadcast_message( $URI=null ) {
	
	$COK = CK();
	$num  = 0 ;
	$arr_user = $URI->get_array_value('UserData');
	
	if( is_array( $arr_user ) ) 
	foreach( $arr_user as $k => $UserId ) {
		// set variable 	
		$sent = date('Y-m-d H:i:s');
		$message = $this->dbchat->escape_str($URI->field('TextMessage'));
		$from = $COK->field('UserId');
		
		$this->dbchat->reset_write();
		$this->dbchat->set("from", $from);
		$this->dbchat->set("message",$message );
		$this->dbchat->set("sent", $sent);
		$this->dbchat->set("to", $UserId);
		$this->dbchat->set("recd", 0);
		$this->dbchat->insert("tms_agent_msgbox");
		if( $this->dbchat->affected_rows() > 0 ){
			$num++;
		} 
	}
	return $num;
 }
 
/*
 * [Recovery APP BNI Tele ANS CHATTING MODULS]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
 function _setUpdateAll($UserId=null) {
	$conds = array( 'success' => 0 );
	
	$this->dbchat->reset_write();
	$this->dbchat->set('recd',1);
	$this->dbchat->where('to', $UserId);
	if( $this->dbchat->update('tms_agent_msgbox')){
		$conds = array('success'=>1);
	}
	return $conds;
 }
 /*
 * [Recovery APP BNI Tele ANS CHATTING MODULS]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
function _setUpdateMessage($messageid=null) {
	$conds = array('success'=>0);
	$this->dbchat->reset_write();
	$this->dbchat->set('recd',1);
	$this->dbchat->where('id',$messageid);
	if( $this->dbchat->update('tms_agent_msgbox')){
		$conds = array('success'=>1);
	}
	return $conds;
} 
/*
 * [Recovery APP BNI Tele ANS CHATTING MODULS]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
 
}
?>
<?php 
// -------------------------------------------------------------------
/*
 * @ this event loger to write user activity from 
 *   system required .
 *	 
 */
 
class M_EventLoger extends EUI_Model
{


//--------------------------------------------------------------------------------------
/*
 *
 * @ package		instance of class  
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

//--------------------------------------------------------------------------------------
/*
 *
 * @ package		instance of class  
 * @ param			not assign parameter
 */
 
function _EventUser( $Username = null )
{ 
	if( is_null($Username)  ){
		return false;
	}
	$arr_event_user = array();
	
	$sql = sprintf("select * from tms_agent a where a.id='%s'", $Username);
	
	$res = $this->db->query( $sql );
	
	if( $res->num_rows() > 0 )
	{
		$arr_event_user = $res->result_first_assoc();
	}
	return Objective( $arr_event_user );
}
 
//--------------------------------------------------------------------------------------
/*
 *
 * @ package		instance of class  
 * @ param			not assign parameter
 */
 
 protected function & _EventOption( $event = null )
{
  $event = strtoupper( $event );
  $arr_option = array
  (
	'ADD' => 'ACTION_EVENT_ADD',
	'DEL' => 'ACTION_EVENT_DELETE',
	'UPD' => 'ACTION_EVENT_UPDATE',
	'DIS' => 'ACTION_EVENT_DISABLE',
	'ENB' => 'ACTION_EVENT_ENABLE',
	'REG' => 'ACTION_EVENT_REGISTER',
	'OUT' => 'ACTION_EVENT_LOGOUT',
	'INC' => 'ACTION_EVENT_LOGIN',
	'REF' => 'ACTION_EVENT_REFRESH',
	'CNL' => 'ACTION_EVENT_CANCEL',
	'RET' => 'ACTION_EVENT_RESET',
	'RJT' => 'ACTION_EVENT_REJECT',
	'EXP' => 'ACTION_EVENT_PASSWORD',
	'RPT' => 'ACTION_EVENT_REPORT'
 );
	
// --- not null ----------------------->
 if( is_null($event) ){
	return FALSE;
 }
	
 if( isset($arr_option[$event]) ) {
	return $arr_option[$event];
 } else {
	 return (string)$event;
 }
 return FALSE;
 
}

//--------------------------------------------------------------------------------------
/*
 *
 * @ package		instance of class  
 * @ param			not assign parameter
 */
 public function _EventLoger($Event = '', $Description = '', $Username = null ) 
{
	if(!is_array($Description) )
  {
	$Description = array($Description);	
  }	
  
  
 // -- useranme -- 
 $objUser = $this->_EventUser( $Username );
 
 $UserId = null;
 $Username = null;
 
 if( _have_get_session('UserId') ){
	$UserId = _get_session('UserId', 'strtoupper');
 } 
 
 if( is_object($objUser) 
	 and $objUser->find_value('UserId') ) 
 {
	$UserId =  $objUser->get_value('UserId', 'strtoupper');
 }
 
 
 if( _have_get_session('Username') ){
	$Username = _get_session('Username','strtoupper');
 } 
 
 if( is_object($objUser) 
	 and $objUser->find_value('id') ) 
 {
	$Username =  $objUser->get_value('id','strtoupper');
 }
 
 
  $Description = join(" ", $Description);
  $ActivityLocation = _getIP();
	
// -------------------------------------------------------
	
  $Event = & $this->_EventOption( $Event );
  if( $Event )
  {
	$this->db->reset_write();
	$this->db->set("ActivityUserId",$UserId);
	$this->db->set("ActivityUserName",$Username);
	$this->db->set("ActivityEvent", $Event);
	$this->db->set("ActivityDesc", ucwords($Description));
	$this->db->set("ActivityLocation", $ActivityLocation );
	$this->db->set("ActivityDate", date('Y-m-d H:i:s'));
		
	// ---------------- update its -------------------------------------
	
		$this->db->insert("t_gn_activitylog");
		if( $this->db->affected_rows() > 0 ){
			return true;
		}
		return FALSE;
	}	 
 }

 // ======================== END CLASS ================================
 

}

?>
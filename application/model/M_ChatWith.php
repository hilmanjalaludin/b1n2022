<?php
class M_ChatWith extends EUI_Model
{

 private static $instance = null;

 // patern 
 
 public static function &get_instance() 
 {
	if(is_null(self::$instance)){
		self::$instance = new self();
	}
	return self::$instance;
 }
 
 // aksesor 
 function M_ChatWith()
{
	
 }
 
 
// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
protected function _select_user_top_level( $arr_field = array(), $where = '' )
{
	$arr_result = array();
	
	if( !is_array( $arr_field ) ){
		$arr_field = array($arr_field);
	}
	
	$this->db->reset_select();	
	$this->db->select($arr_field, false);
	$this->db->from("tms_agent");
	$this->db->where($where);
	$rs = $this->db->get();
	
	if( $rs->num_rows() > 0 ) 
		foreach( $rs->result_first_assoc()  as $field  => $val )
	{
		$arr_result[$val] = $val;
	}
	
	return $arr_result;
} 


	
 
 
/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 public function _getUserReady()
{
 
 // sesssion Data 
 $cookie =& CK();
  $arr_where_in = array();
  $arr_user_online = array();
  
// --------------------------------------------------------------------------------------------------------------------------
  $arr_where_in = $this->_select_user_top_level(
		array("spv_id", "tl_id", "quality_id", "admin_id", "act_mgr"), 
		array("UserId" => _get_session('UserId'))
	);
	
// --------------------------------------------------------------------------------------------------------------------------
  $this->db->reset_select();
  $this->db->select("
	a.UserId as UserId, 
	a.id as Username, 
	a.full_name as Fullname, 
	b.name as profileid , 
	IF(a.logged_state=1, 'Login','Logout') as LoginStatus", 
  FALSE);
  
  $this->db->from("tms_agent a ");
  $this->db->join("tms_agent_profile b" , "a.profile_id=b.id" , "left");
  $this->db->where("a.user_state",1);
 // $this->db->where("a.logged_state",1);
 // ----- user admin privilege -------------------------------------

 if( in_array( $cookie->field('HandlingType'),  
	array( USER_ROOT )) )
 {
    // select -- ALL --- 	
 }	
 
  if( in_array( $cookie->field('HandlingType'),  
	array( USER_QUALITY_STAFF )) )
 {
    $this->db->where_in('a.handling_type',array(
		USER_SUPERVISOR,USER_QUALITY_STAFF,USER_QUALITY_HEAD, 
		USER_QUALITY, USER_ADMIN, 
		USER_LEADER));		
 }	
 
  if( in_array( $cookie->field('HandlingType'),  
	array( USER_QUALITY_HEAD )) )
 {
    $this->db->where_in('a.handling_type',array(
		USER_SUPERVISOR,USER_QUALITY_STAFF,USER_QUALITY_HEAD,
		USER_QUALITY, USER_ADMIN, 
		USER_LEADER,USER_QUALITY_ANALYST));		
 }	
 

 
 
// ----- user admin privilege -------------------------------------

 if( in_array( $cookie->field('HandlingType'),  
	array( USER_ADMIN )) )
 {
	$this->db->where('a.admin_id',$cookie->field('UserId'));	
 }

// ----- user admin privilege -------------------------------------
 
 // if( in_array($cookie->field('HandlingType'),  
	// array( USER_ACCOUNT_MANAGER )) )
 // {
	// $this->db->where('a.act_mgr',$cookie->field('UserId'));	
 // }
 
 
// ----- user admin privilege -------------------------------------
 
 if( in_array($cookie->field('HandlingType'),  
	array( USER_MANAGER )) )
 {
	$this->db->where('a.mgr_id',$cookie->field('UserId'));	
 }
 
 // ----- user admin privilege -------------------------------------
 
 if( in_array($cookie->field('HandlingType'),  
	array( USER_SUPERVISOR )) )
 {
	 
	// set an array to Process OK SIP 
	
	$where_in = array(  $cookie->field('AdministratorId'),
						$cookie->field('AccountManager'), 
						$cookie->field('GenaralManagerId'),
						$cookie->field('ManagerId') );
							
	// then set on CI query Data.						
	$this->db->where( sprintf( "(a.spv_id IN(%s) OR a.UserId IN (%s))", 
								$cookie->field('UserId'), 
								SetWhereIn($where_in, true) ), "", FALSE);	
 }
 
// ----- user admin privilege -------------------------------------
 
 if( in_array($cookie->field('HandlingType'),  
	array( USER_LEADER )) )
 {
	$this->db->where('a.tl_id',$cookie->field('UserId'));	
	$this->db->or_where('a.profile_id' , 11);
	$this->db->or_where('a.profile_id' , 5);
	$this->db->or_where('a.profile_id' , 15);
 }
 
 // ----- user admin privilege -------------------------------------
 
 if( in_array($cookie->field('HandlingType'),  
	array( USER_AGENT_INBOUND )) )
 {
	$this ->db ->where_in('a.UserId',$arr_where_in);	
 }
 
 // ----- user admin privilege -------------------------------------

  if( in_array($cookie->field('HandlingType'),  
	array( USER_AGENT_OUTBOUND )) )
 {
	$this ->db ->where_in('a.UserId',$arr_where_in);
 }
 
 if( in_array($cookie->field('HandlingType'),  
	array( USER_QUALITY_STAFF )) )
 {
	$this ->db ->where_in('a.handling_type',5);	
 }
 
 // echo $this->db->print_out();
 
 $rs = $this->db->get();
 
 if( $rs->num_rows() > 0 ) 
 {
	$arr_user_online = (array)$rs->result_assoc();
 }
 
 return $arr_user_online;
 
}
 
	 
/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
}
?>
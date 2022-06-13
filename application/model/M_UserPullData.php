<?php 
 /**
  * [M_UserDistribusi :: class ]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
class M_UserPullData extends EUI_Model
{
	
 /**
  * [M_UserDistribusi :: class ]
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

 /**
  * [M_UserDistribusi :: class ]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 
 public function __construct()
{ 
	$this->load->model(array('M_MgtAssignment','M_SysUser'));
 }
 
 /**
  * [M_UserDistribusi :: class ]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 
 
 protected function _event_loger_distribute( $AssignId = 0 , $AssignMode = 'PUL')
{
	

 $cok = CK();
// define array for all process this methode	
 $row = array();
 
 // select on query to log process 
 
 $this->db->reset_select();
 $this->db->select("a.*, b.DM_Id, b.DM_CallReasonId ",FALSE);
 $this->db->from("t_gn_assignment a");
 $this->db->join("t_gn_customer_master b "," a.AssignCustId= b.DM_Id", FALSE);
 $this->db->where("a.AssignId", $AssignId );
 
 $qry = $this->db->get();
 if( $qry && $qry->num_rows() > 0 ) {
	$row = (array)$qry->result_first_assoc();
 }

 
// check by richek ya ..

 $out = Objective( $row );
 if( !count( $row) > 0 OR !$out->field('DM_Id') ) {
	 return false;
 }
 
// ayo aku process ya . dan tambahakn field yang di inginkan 
 $out->add('AssignLocation', IpAddress());
 $out->add('AssignDate', date('Y-m-d H:i:s'));
 $out->add('AssignById', $cok->field('UserId'));
 $out->add('AssignMode', $AssignMode);
 
// then push data to loger 
  
  $this->db->reset_write();
  $this->db->set("AssignId",		$out->field('AssignId'));
  $this->db->set("AssignCustId",	$out->field('DM_Id'));
  $this->db->set("CallReasonId",	$out->field('DM_CallReasonId')); 
  $this->db->set("AssignAdmin", 	$out->field('AssignAdmin')); 
  $this->db->set("AssignAmgr",  	$out->field('AssignAmgr')); 
  $this->db->set("AssignMgr",   	$out->field('AssignMgr'));
  $this->db->set("AssignSpv",   	$out->field('AssignSpv'));
  $this->db->set("AssignLeader",	$out->field('AssignLeader'));
  $this->db->set("AssignSelerId",	$out->field('AssignSelerId'));
  $this->db->set("AssignBlock", 	$out->field('AssignBlock'));
  $this->db->set("AssignById", 		$out->field('AssignById'));
  $this->db->set("AssignMode",  	$out->field('AssignMode'));
  $this->db->set("AssignLocation",  $out->field('AssignLocation'));
  $this->db->set("AssignDate", 		$out->field('AssignDate'));
  
 // push data trigger_error to SQL process .
  
  $this->db->insert("t_gn_assignment_log");
  if(  $this->db->affected_rows()>  0 ){
	return true;
  }
   
  return false;
  
  
  
 }
 
  
/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 function _set_row_kuota_user( $UserId = 0 ){
	 $sql = sprintf("UPDATE t_gn_bucket_kuota a  SET a.BK_Kuota_Data = (( a.BK_Kuota_Data)+1)
			 where a.BK_Kuota_UserId ='%s'", $UserId); 
	 return $this->db->query( $sql );
 }
  
  
/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
  
function _get_row_kuota_user( $UserId = 0 ){
	
	$result_array = array();
	$sql = sprintf("SELECT a.BK_Kuota_Size, a.BK_Kuota_Data  FROM t_gn_bucket_kuota a 
					WHERE a.BK_Kuota_UserId='%s'", $UserId );
					
	$qry = $this->db->query( $sql );
	
	if(  $qry && $qry->num_rows() > 0 ) {
		$row  = $qry->result_first_record();
		if( is_object( $row ) ) {	
			// compare data di sini 
			$kuota_data = $row->field('BK_Kuota_Data', 'intval');
			$kuota_size = $row->field('BK_Kuota_Size', 'intval');
			
			if( $kuota_data <  $kuota_size ){
				return true;
			}
			return false;
		}
	}
	// jika null skip saja .
	return null;
}   
 
/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
function _set_row_update_master( $user = null, $AssignID = 0   ){
 
 if( !is_object( $user ) ){
	return false;
 }
 
 $user->add('AssignId', $AssignID);
 // update loger setiap distribusi .
 $sql = sprintf("UPDATE t_gn_customer_master a  INNER JOIN t_gn_assignment b ON a.DM_Id=b.AssignCustId
				SET a.DM_SellerId = '%s',  a.DM_SellerKode= '%s' WHERE b.AssignId ='%s'",  
				$user->field('UserId'),
				$user->field('Username'), 
				$user->field('AssignId'));
				
 if(  $this->db->query($sql) ){
	return true;
 }
 return false;
 
}

 
 /**
  * [M_UserDistribusi :: class ]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
function _set_row_update_assign( $result_array = null, $UserId = 0, $Level = 0 )
{
	//print_r($result_array);
	 
  // ini panggil object aja ya 
  $this->callTotalData = 0;
  $Usr = Objective( Singgleton('M_SysUser')->_getUserDetail( $UserId ) );
  
 

// tarik ke level  "USER_ADMIN|USER_ROOT" dengan data yang 
// difilter .
 
  if(!strcmp( $Level, USER_ADMIN ) OR !strcmp( $Level, USER_ROOT ) )  
  foreach( $result_array as $k => $row )   
 {
	 
// ketika pull data process Kurangi data yang di tarik dari User 
// berikut ini.
	 
 // convert to object data row	
	$row = Objective( $row );
	//var_dump($row);
	
// define call assignment data process 	
    $this->callDisAsgID  = $row->get_value('AssignId');
	$this->callDisAsgMod = 'PUL';

	
// tambahakn field untuk dimasukan ke field.
	$row->add('AssignAdmin', $Usr->get_value('UserId'));
	$row->add('AssignDate', date('Y-m-d H:i:s'));
	$row->add('AssignMode', $this->callDisAsgMod);
	$row->add('AssignNull', 'NULL');
	
 // reset data query process 
 
	$this->db->reset_write();
	
	$this->db->set("AssignAdmin", 	$row->get_value('AssignAdmin'),	FALSE);
	$this->db->set("AssignAmgr", 	$row->get_value('AssignNull'),	FALSE);
	$this->db->set("AssignMgr", 	$row->get_value('AssignNull'), 	FALSE);
	$this->db->set("AssignSpv", 	$row->get_value('AssignNull'), 	FALSE);
	$this->db->set("AssignLeader", 	$row->get_value('AssignNull'), 	FALSE);
	$this->db->set("AssignSelerId", $row->get_value('AssignNull'), 	FALSE);
	$this->db->set("AssignDate", 	$row->get_value('AssignDate'));
	$this->db->set("AssignMode", 	$row->get_value('AssignMode'));
	
// jika success update ke table di bawah ini.

	$this->db->where('AssignId', $row->get_value('AssignId'));
	
	if( $this->db->update( 't_gn_assignment' ) )  {
		$this->_set_row_update_master( $Usr, $this->callDisAsgID);
		$this->_event_loger_distribute( $this->callDisAsgID, $this->callDisAsgMod);
		$this->callTotalData++;
	}	
	
 }
  
  
// distribusi ke level  "USER_GENERAL_MANAGER" dengan data yang 
// difilter .
 
  if(!strcmp( $Level, USER_GENERAL_MANAGER ))  
  foreach( $result_array as $k => $row )   
 {
	 
 // convert to object data row	
	$row = Objective( $row );

	
// define call assignment data process 	
    $this->callDisAsgID  = $row->get_value('AssignId');
	$this->callDisAsgMod = 'PUL';

	
// tambahakn field untuk dimasukan ke field.
	$row->add('AssignAmgr', $Usr->get_value('UserId'));
	$row->add('AssignDate', date('Y-m-d H:i:s'));
	$row->add('AssignMode', $this->callDisAsgMod);
	$row->add('AssignNull', 'NULL');
	
 // reset data query process 
 
	$this->db->reset_write();
	$this->db->set("AssignAmgr", 	$row->get_value('AssignAmgr'), 	FALSE);
	$this->db->set("AssignMgr", 	$row->get_value('AssignNull'), 	FALSE);
	$this->db->set("AssignSpv", 	$row->get_value('AssignNull'), 	FALSE);
	$this->db->set("AssignLeader", 	$row->get_value('AssignNull'), 	FALSE);
	$this->db->set("AssignSelerId", $row->get_value('AssignNull'), 	FALSE);
	$this->db->set("AssignDate", 	$row->get_value('AssignDate'));
	$this->db->set("AssignMode", 	$row->get_value('AssignMode'));
	
// jika success update ke table di bawah ini.
	$this->db->where('AssignId', $row->get_value('AssignId'));
	if( $this->db->update( 't_gn_assignment' ) )  {
		$this->_set_row_update_master( $Usr, $this->callDisAsgID);
		$this->_event_loger_distribute( $this->callDisAsgID, $this->callDisAsgMod);
		$this->callTotalData++;
	}	
 }
  
// distribusi ke level  "USER_ACCOUNT_MANAGER == USER_ACCOUNT_MANAGER" dengan data yang 
// difilter .

 if((!strcmp( $Level, USER_MANAGER ) OR !strcmp( $Level, USER_ACCOUNT_MANAGER)) )   
 foreach( $result_array as $k => $row )   {
	
	$row = Objective( $row );
	
	
// define call assignment data process 	
    $this->callDisAsgID  = $row->get_value('AssignId');
	$this->callDisAsgMod = 'PUL';
	
// tambahakn ke field object 
	$row->add('AssignAmgr', $Usr->get_value('act_mgr'));
	$row->add('AssignMgr',  $Usr->get_value('UserId'));
	$row->add('AssignDate', date('Y-m-d H:i:s'));
	$row->add('AssignMode', $this->callDisAsgMod);
	$row->add('AssignNull', 'NULL');
	
	
// reset data query process 
	
	$this->db->reset_write();
	$this->db->set("AssignAmgr", 	$row->get_value('AssignAmgr'), 	FALSE);
	$this->db->set("AssignMgr", 	$row->get_value('AssignMgr'), 	FALSE);
	
	$this->db->set("AssignSpv", 	$row->get_value('AssignNull'), 	FALSE);
	$this->db->set("AssignLeader", 	$row->get_value('AssignNull'), 	FALSE);
	$this->db->set("AssignSelerId", $row->get_value('AssignNull'), 	FALSE);
	$this->db->set("AssignDate", 	$row->get_value('AssignDate'));
	$this->db->set("AssignMode", 	$row->get_value('AssignMode'));
	
	
	// jika success update ke table di bawah ini.
	$this->db->where('AssignId', $row->get_value('AssignId'));
	if( $this->db->update('t_gn_assignment') ) {
		$this->_set_row_update_master( $Usr, $this->callDisAsgID);
		$this->_event_loger_distribute( $this->callDisAsgID, $this->callDisAsgMod);
		$this->callTotalData++;
	}	
	
 }
 
 
// distribusi ke level  "USER_SUPERVISOR" dengan data yang 
// difilter .

 if(!strcmp( $Level, USER_SUPERVISOR ))  
 foreach( $result_array as $k => $row )   {
	
// cek kuota data jika data berisi true maka process 

   // $this->kuota = $this->_get_row_kuota_user( $Usr->get_value('UserId') );
   // if( is_bool($this->kuota) and !$this->kuota ){
	   // continue;
   // }	
   
// lanjut processnya .   
	$row = Objective( $row );
// define call assignment data process 	
    $this->callDisAsgID  = $row->get_value('AssignId');
	$this->callDisAsgMod = 'PUL';
	
// tambahakn ke field object 
	$row->add('AssignAmgr', $Usr->get_value('act_mgr'));
	$row->add('AssignMgr',  $Usr->get_value('mgr_id'));
	$row->add('AssignSpv',  $Usr->get_value('UserId'));
	$row->add('AssignDate', date('Y-m-d H:i:s'));
	$row->add('AssignMode', $this->callDisAsgMod);
	$row->add('AssignNull', 'NULL');
	
// reset data query process 
	
	$this->db->reset_write();
	
	$this->db->set("AssignAmgr", 	$row->get_value('AssignAmgr'), 	FALSE);
	$this->db->set("AssignMgr", 	$row->get_value('AssignMgr'), 	FALSE);
	$this->db->set("AssignSpv", 	$row->get_value('AssignSpv'), 	FALSE);
	
	$this->db->set("AssignLeader", 	$row->get_value('AssignNull'), 	FALSE);
	$this->db->set("AssignSelerId", $row->get_value('AssignNull'), 	FALSE);
	$this->db->set("AssignDate", 	$row->get_value('AssignDate'));
	$this->db->set("AssignMode", 	$row->get_value('AssignMode'));
	
	// jika success update ke table di bawah ini.
	$this->db->where('AssignId', $row->get_value('AssignId'));
	if( $this->db->update('t_gn_assignment') ) {
		//$this->_set_row_kuota_user($Usr->get_value('UserId') ); // update kuota 
		$this->_set_row_update_master( $Usr, $this->callDisAsgID); // update kjustomer 
		$this->_event_loger_distribute( $this->callDisAsgID, $this->callDisAsgMod); // update loger 
		$this->callTotalData++;
	}		
 }
 
 
// distribusi ke level  "USER_LEADER" dengan data yang 
// difilter .
//var_dump($result_array);

 if(!strcmp( $Level, USER_LEADER ))  
 foreach( $result_array as $k => $row )   {
	
  // cek kuota data jika data berisi true maka process 
   // $this->kuota = $this->_get_row_kuota_user( $Usr->get_value('UserId') );
   // if( is_bool( $this->kuota) and !$this->kuota ){
	   // continue;
   // }	
   
// lanjut processnya .

	$row = Objective( $row );
	
	
// define call assignment data process 	
    $this->callDisAsgID  = $row->get_value('AssignId');
	$this->callDisAsgMod = 'PUL';
	
// tambahakn ke field object 
	$row->add('AssignAmgr',   $Usr->get_value('act_mgr'));
	$row->add('AssignMgr',    $Usr->get_value('mgr_id'));
	$row->add('AssignSpv',    $Usr->get_value('spv_id'));
	$row->add("AssignLeader", $Usr->get_value('UserId'));
	$row->add('AssignDate',   date('Y-m-d H:i:s'));
	$row->add('AssignMode',   $this->callDisAsgMod);
	$row->add('AssignNull',   'NULL');
	
	
// reset data query process 
	$this->db->reset_write();
	
	$this->db->set("AssignAmgr", 	$row->get_value('AssignAmgr'), 	FALSE);
	$this->db->set("AssignMgr", 	$row->get_value('AssignMgr'), 	FALSE);
	$this->db->set("AssignSpv", 	$row->get_value('AssignSpv'), 	FALSE);
	$this->db->set("AssignLeader", 	$row->get_value('AssignLeader'), FALSE);
	
	$this->db->set("AssignSelerId", $row->get_value('AssignNull'), 	FALSE);
	$this->db->set("AssignDate", 	$row->get_value('AssignDate'));
	$this->db->set("AssignMode", 	$row->get_value('AssignMode'));
	
	// jika success update ke table di bawah ini.
	
	$this->db->where('AssignId',   $row->get_value('AssignId'));
	if( $this->db->update('t_gn_assignment') ) {
		$this->_set_row_update_master( $Usr, $this->callDisAsgID);
		$this->_event_loger_distribute( $this->callDisAsgID, $this->callDisAsgMod);
		$this->callTotalData++;
	}	
 }
 
  
// distribusi ke level  "USER_AGENT_OUTBOUND" dengan data yang 
// difilter .

if(!strcmp( $Level, USER_AGENT_OUTBOUND ))  
 foreach( $result_array as $k => $row )   {
	
	$row = Objective( $row );
	
	
// define call assignment data process 	
    $this->callDisAsgID  = $row->get_value('AssignId');
	$this->callDisAsgMod = 'PUL';
	
// tambahakn ke field object 
	$row->add('AssignAmgr',    $Usr->get_value('act_mgr'));
	$row->add('AssignMgr',     $Usr->get_value('mgr_id'));
	$row->add('AssignSpv',     $Usr->get_value('spv_id'));
	$row->add("AssignLeader",  $Usr->get_value('tl_id'));
	$row->add("AssignSelerId", $Usr->get_value('UserId'));
	$row->add('AssignDate',    date('Y-m-d H:i:s'));
	$row->add('AssignMode',    $this->callDisAsgMod);
	$row->add('AssignNull',   'NULL');
	
	
 // reset data query process 
	
	$this->db->reset_write();
	$this->db->set("AssignAmgr",    $row->get_value('AssignAmgr'));
	$this->db->set("AssignMgr",     $row->get_value('AssignMgr'));
	$this->db->set("AssignSpv",     $row->get_value('AssignSpv'));
	$this->db->set("AssignLeader",  $row->get_value('AssignLeader'));
	$this->db->set("AssignSelerId", $row->get_value('AssignSelerId'));
	$this->db->set("AssignDate",    $row->get_value('AssignDate'));
	$this->db->set("AssignMode",    $row->get_value('AssignMode'));
	
 // jika success update ke table di bawah ini.
	$this->db->where('AssignId',    $row->get_value('AssignId'));
	if( $this->db->update('t_gn_assignment') ) {
		$this->_set_row_update_master( $Usr, $this->callDisAsgID);
		$this->_event_loger_distribute( $this->callDisAsgID, $this->callDisAsgMod);
		$this->callTotalData++;
	}	
 }
 
// distribusi ke level  "USER_AGENT_INBOUND" dengan data yang 
// difilter .

if(!strcmp( $Level, USER_AGENT_INBOUND ))  
 foreach( $result_array as $k => $row )   {
	
	
	$row = Objective( $row );
	
	
// define call assignment data process 	
    $this->callDisAsgID = $row->get_value('AssignId');
	$this->callDisAsgMod = 'PUL';
	
	
// tambahakn ke field object 
	$row->add('AssignAmgr',    $Usr->get_value('act_mgr'));
	$row->add('AssignMgr',     $Usr->get_value('mgr_id'));
	$row->add('AssignSpv',     $Usr->get_value('spv_id'));
	$row->add("AssignLeader",  $Usr->get_value('tl_id'));
	$row->add("AssignSelerId", $Usr->get_value('UserId'));
	$row->add('AssignDate',    date('Y-m-d H:i:s'));
	$row->add('AssignMode',    $this->callDisAsgMod);
	$row->add('AssignNull', 	'NULL');
	
	
	
 // reset data query process 
	
	$this->db->reset_write();
	
	$this->db->set("AssignAmgr",    $row->get_value('AssignAmgr'));
	$this->db->set("AssignMgr",     $row->get_value('AssignMgr'));
	$this->db->set("AssignSpv",     $row->get_value('AssignSpv'));
	$this->db->set("AssignLeader",  $row->get_value('AssignLeader'));
	$this->db->set("AssignSelerId", $row->get_value('AssignSelerId'));
	$this->db->set("AssignDate",    $row->get_value('AssignDate'));
	$this->db->set("AssignMode",    $row->get_value('AssignMode'));
	
 // jika success update ke table di bawah ini.
	$this->db->where('AssignId',    $row->get_value('AssignId'));
	if( $this->db->update('t_gn_assignment') ) {
		$this->_set_row_update_master( $Usr, $this->callDisAsgID);
		$this->_event_loger_distribute( $this->callDisAsgID, $this->callDisAsgMod);
		$this->callTotalData++;
	}
 } 
 
 // return to data callback 
 return $this->callTotalData;
	
} 

// --------------------------------------------------------------------------------------
/*
 * @ aksess : public 
 */ 
 
 public function _set_row_pulldata_rata( $out = null )
{

 $objAsg =& get_class_instance('M_MgtAssignment');
 $rowAsg = array();
 
// ------ get on DB  // quantity 
 if( $out->get_value('pull_user_action') == 1 ){
	$rowAsg = $objAsg->_select_page_pulldata( $out, array( "a.AssignId" ));	
 } 
 
  

 
 // Get on selected grid ------------- // checklist data 
 if( $out->get_value('pull_user_action') == 2 ){
	$arr_Asg = $out->get_array_value('AssignId');
	if(is_array($arr_Asg))foreach( $arr_Asg as $k => $AssignId ){
		$rowAsg[] = array('AssignId' => $AssignId);
	}	
 }
 
// --------- next process ---------------------------------------
 
  if( is_array($rowAsg) AND count($rowAsg) == 0 )
 {
	return FALSE;
 }	
  
 // --------- on random ---------------------------
 $Level = $out->get_value('pull_to_user_group');
 $total_dist = & $out->get_value('pull_user_quantity');
 if( $out->get_value('pull_user_mode')== 2) {
	shuffle($rowAsg);
 }
 
 // def data posted by user ---------------------------
    
  $arr_user_avail =& $out->get_array_value('pull_to_user_list');
  $total_user = count( $arr_user_avail );
  $arr_data_avail = array_slice( $rowAsg, 0, $total_dist);
  $total_data_avail = count($arr_data_avail);
  
// -------------- complaintmnet ------------
  
  if( $total_user  > $total_data_avail ){
	return FALSE;
  }
  
// ------- next step ------------------------------------

  $arr_assign_avail = array();
  $total_data_per_user = (int)( $total_user ? ($total_data_avail/$total_user) : 0 );
  if( $total_data_per_user == 0 ){
	return FALSE;
  }	  
  
  
// ---------  next step -------------------------------
  $total = 0;
  $start = 0;
  if( is_array($arr_user_avail) )
	foreach( $arr_user_avail as $key => $UserId )
{
	if( $start == 0  ){
		$offset = 0;
	} else {	
		$offset = ($start * $total_data_per_user );
	}
	
	$row_asg_avail = array_slice($arr_data_avail, $offset, $total_data_per_user);
	if( $this->_set_row_update_assign($row_asg_avail, $UserId, $Level) ){
		$total++;
	}
	
	$start++;
 }
 
 return (int)$total;

 
} 
 
// --------------------------------------------------------------------------------------
/*
 * @ aksess : public 
 */ 
 
 public function _set_row_pulldata_agent( $out = null  ) 
{
 
 $objAsg =& get_class_instance('M_MgtAssignment');
 $rowAsg = array();
 
// ------ get on DB  
 if( $out->get_value('pull_user_action') == 1 ){
	$rowAsg = $objAsg->_select_page_pulldata( $out );	
 } 

 // Get on selected grid ------------- 
 if( $out->get_value('pull_user_action') == 2 ){
	$arr_Asg = $out->get_array_value('AssignId');
	if(is_array($arr_Asg))foreach( $arr_Asg as $k => $AssignId ){
		$rowAsg[] = array('AssignId' => $AssignId);
	}	
 }
 		
 if( is_array($rowAsg) AND count($rowAsg) == 0 )
 {
	return FALSE;
 }	
  
 // --------- on random ---------------------------
 $Level = $out->get_value('pull_to_user_group');
 $total_dist = & $out->get_value('pull_user_quantity');
 
 
 if( $out->get_value('pull_user_mode')== 2) {
	shuffle($rowAsg);
 }
 
//------------ if data not valid ---------------
 
 $arr_user_avail = array();
 $arr_tots_input = 0;
 $outAgent = $out->get_array_value('pull_to_user_list');
 
 if(is_array($outAgent) )
	foreach( $outAgent as $k => $UsrId )
 {
	$avail_data = (int)$out->get_value("pull_to_user_list_{$UsrId}");
	if( $avail_data )
	{
		$arr_user_avail[$UsrId] = $avail_data;	
		$arr_tots_input +=$avail_data;
	}
 }

// sort array ASC 
 
 asort($arr_user_avail, SORT_ASC);
 if( $arr_tots_input > $total_dist  ){
	return FALSE;	
 }	 
 
// def data posted by user ---------------------------
    
  $total_user = count( $arr_user_avail );
  $arr_data_avail = array_slice( $rowAsg, 0, $total_dist);
  $total_data_avail = count($arr_data_avail);
  
// -------------- complaintmnet ------------
  
  if( $total_user  > $total_data_avail ){
	return FALSE;
  }
  
  
// ---------  next step -------------------------------
  $total = 0;
  $start = 0;
  if( is_array($arr_user_avail) )
	foreach( $arr_user_avail as $UserId => $perpage )
{
	$arr_process = array();
	for( $i = 0; $i<$perpage; $i++){
		$arr_process[$i] = $arr_data_avail[$start];
		$start++;
	}	
	
	if( $this->_set_row_update_assign( $arr_process, $UserId, $Level) ) {
		$total++;
	}
 }
 
 return (int)$total;

}  
 
// ============================== END CLASS ==================================================
}

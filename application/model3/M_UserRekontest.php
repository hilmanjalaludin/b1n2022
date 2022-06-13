<?php 

/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
class M_UserRekontest extends EUI_Model
{

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
 
 function __construct() { 
	$this->load->model(array('M_Rekontest','M_SysUser'));
 }
 
/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
 function _event_loger_distribute( $AssignId = 0 , $AssignMode = 'DIS')
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
  
  * 
  * kembalikan nilai ke result sebelumnya 
  */
 function _set_row_decline_data( $AssignId = 0 )
{
	$row  = null;
	$sql = sprintf("select a.* from t_gn_customer_decline a 
					left join t_gn_assignment b on a.DM_Id=b.AssignCustId
					where a.DD_ProcessStatus = 0
					and b.AssignId= '%s' ", $AssignId);
	//echo $sql;				
					
	$qry = $this->db->query( $sql );
	if( $qry and $qry->num_rows() > 0 ){
		$row = $qry->result_first_record();
	}				
	// then will process OK 
	if( is_null( $row ) ){
		return false;
	}
	
// then will get is .
	$this->db->reset_write();
	$this->db->set('DM_UpdatedTs', 			date('Y-m-d H:i:s'));
	$this->db->set('DM_CallReasonId',		$row->field('DM_CallReasonId'));
	$this->db->set('DM_CallReasonKode',		$row->field('DM_CallReasonKode'));
	$this->db->set('DM_CallCategoryId',		$row->field('DM_CallCategoryId'));
	$this->db->set('DM_CallCategoryKode',	$row->field('DM_CallCategoryKode'));
	$this->db->set('DM_LastReasonId',		$row->field('DM_LastReasonId'));
	$this->db->set('DM_LastReasonKode',		$row->field('DM_LastReasonKode'));
	$this->db->set('DM_LastCategoryId',		$row->field('DM_LastCategoryId'));
	$this->db->set('DM_LastCategoryKode',	$row->field('DM_LastCategoryKode'));
	$this->db->where('DM_Id', 				$row->field('DM_Id'));
	
// then will get data proces "PID" 	
	$this->db->update('t_gn_customer_master');
	if( $this->db->affected_rows() > 0 ){
		
		// will update if OK Process SIP 
		$sql = sprintf("UPDATE t_gn_customer_decline a 
						SET a.DD_DateUpdateTs = NOW(), 
							a.DD_ProcessStatus = 1
						where a.DD_Id =%s 
						and a.DD_ProcessStatus = 0", $row->field('DD_Id'));
		$this->db->query( $sql );
	}
	return true;
}  


/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
 
function _get_row_kuota_user( $UserId = 0, $Username = null ){
	
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
			// set data on kuota check 
			if( $kuota_data <  $kuota_size ){
				return true;
			}
			return false;
		}
	}
	// jika null skip saja .
	return null;
} 
  
/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */

 function _set_row_kuota_user( $UserId = 0 ){
	 $sql = sprintf("UPDATE t_gn_bucket_kuota a  SET a.BK_Kuota_Data = (( a.BK_Kuota_Data)+1)
			 where a.BK_Kuota_UserId ='%s'", $UserId); 
	 return $this->db->query( $sql );
 }
   
/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
 
function _set_row_update_master( $USR = null, $AssignID = 0   ){
 
// data UR Data URI Post webmail. 
 $URI = &UR();  
 $COF = &CF();
 
// create new object data && and protest 
 $KonditionId = 0;

// create new object data && and protest 
 $row = Objective( array());
 $row->add('CallCategoryId', 	$URI->field('torek_callstatusid', 'intval'));
 $row->add('CallReasonId', 		$URI->field('torek_callreasonid', 'intval'));
 $row->add('CallCategoryKode', 	$URI->field('torek_callstatusid', 'KategoryKode')); 
 $row->add('CallReasonKode', 	$URI->field('torek_callreasonid', 'ResultKode'));
 $row->add('DM_SellerId', 		$USR->field('UserId'));
 $row->add('DM_SellerKode', 	$USR->field('Username'));
 $row->add('DM_UpdatedTs', 		date('Y-m-d H:i:s'));
 
// then will get is object data process ok  
 if( !is_object( $USR ) ){
	return false;
 }
 
// get data CustomerId ID from assignment ID 
 $row->add('DM_Id', 0);
 $sql = sprintf("select a.AssignCustId from t_gn_assignment a where a.AssignId='%s'", $AssignID);
 $qry = $this->db->query( $sql );
 if(  $qry && $qry->num_rows() > 0 ){
	$row->add('DM_Id', $qry->result_singgle_value());
 }
 
// "reset_write" 
 // DM_CallSellerUpdateTs
 $this->db->reset_write();
 $this->db->set('DM_SellerId', $row->field('DM_SellerId'));
 $this->db->set('DM_SellerKode', $row->field('DM_SellerKode'));
 $this->db->set('DM_CallReasonId', $row->field('CallReasonId'));
 $this->db->set('DM_CallReasonKode', $row->field('CallReasonKode'));
 $this->db->set('DM_CallCategoryId', $row->field('CallCategoryId'));
 $this->db->set('DM_CallCategoryKode', $row->field('CallCategoryKode'));
 $this->db->set('DM_LastReasonId', $row->field('CallReasonId'));
 $this->db->set('DM_LastReasonKode', $row->field('CallReasonKode'));
 $this->db->set('DM_LastCategoryId', $row->field('CallCategoryId'));
 $this->db->set('DM_LastCategoryKode', $row->field('CallCategoryKode'));
 $this->db->set('DM_UpdatedTs', $row->field('DM_UpdatedTs'));
 $this->db->set('DM_CallSellerUpdateTs', $row->field('DM_UpdatedTs'));
 $this->db->where('DM_Id', $row->field('DM_Id'));
 
// update data process on here like this;
 $this->db->update('t_gn_customer_master');
 if( $this->db->affected_rows() > 0 ){
	
	// on kontext status data process to appointment data 
	// process on here like this;
	
	$COF = $COF->field('default_callreason', 'Objective'); 
	if( $COF->field('APMT') ){
		
		// set callbackDateTime on TRX janji
		$callbackDateTime = sprintf('%s %02d:%02d:00', $URI->field('DateLater',  'SetDate'),
													   $URI->field('HourLater',  'SetCapital'),
													   $URI->field('MinuteLater','SetCapital')); 
		
		
		$this->db->reset_write();
		$this->db->set('ApoinmentDate', 	$callbackDateTime);
		$this->db->set('CustomerId', 		$row->field('DM_Id'));
		$this->db->set('ApoinmentCreate', 	$row->field('DM_UpdatedTs'));
		$this->db->set('UserId', 			$row->field('DM_SellerId'));
		$this->db->set('ApoinmentFlag', 	0);
		$this->db->insert('t_gn_appoinment');
		
	}
	
	//callback data process 
	$KonditionId++;
 }
 
 // return callback data process ok .
 return $KonditionId;
 
}

/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
function _get_call_back_message(){
	return intval( $this->callTotalData );
}  
  
/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
  
function _set_row_update_assign( $result_array = null, $UserId = 0, $Level = 0 ) {
	
// default step process data   
  $this->callTotalData = 0;
  $this->callAsgMode = 'REK';
  
 // fet detail user transfer data process 
  $Usr = Objective( Singgleton('M_SysUser')->_getUserDetail( $UserId ) );
  
// distribusi ke level  "USER_GENERAL_MANAGER" dengan data yang 
// difilter .
 
 // if(!strcmp( $Level, USER_GENERAL_MANAGER )) untuk pindahan level manager harus di set 0 value assignspv & assignselerid 
  if(!strcmp( $Level, USER_GENERAL_MANAGER ))  
  foreach( $result_array as $k => $row )   
 {
	// cek kuota data jika data berisi true maka process 
   $this->kuota = $this->_get_row_kuota_user( $Usr->get_value('UserId') );
   if( is_bool($this->kuota) and !$this->kuota ){
	   continue;
   }	
 
 // convert to object data row	
	$row = Objective( $row );

	
// define call assignment data process 	
    $this->callDisAsgID  = $row->get_value('AssignId');

	
// tambahakn field untuk dimasukan ke field.
	$row->add('AssignAmgr', $Usr->get_value('UserId'));
	$row->add('AssignDate', date('Y-m-d H:i:s'));
	$row->add('AssignMode', $this->callAsgMode);
	
 // reset data query process 
 
	$this->db->reset_write();
	$this->db->where('AssignId', $row->get_value('AssignId'));
	$this->db->set("AssignAmgr", $row->get_value('AssignAmgr'));
	$this->db->set("AssignSpv", 0);
	$this->db->set("AssignSelerId", 0);
	$this->db->set("AssignDate", $row->get_value('AssignDate'));
	$this->db->set("AssignMode", $row->get_value('AssignMode'));
// jika success update ke table di bawah ini.
	
	if( $this->db->update( 't_gn_assignment' ) )  {
		$this->_set_row_update_master( $Usr, $this->callDisAsgID);
		$this->_event_loger_distribute( $this->callDisAsgID,  $this->callAsgMode);
		$this->_set_row_decline_data( $this->callDisAsgID );
		$this->callTotalData++;
	}	
 } 
 
// distribusi ke level  "USER_MANAGER|
// USER_ACCOUNT_MANAGER" dengan data yang 
// difilter .

 if((!strcmp( $Level, USER_MANAGER ) OR !strcmp( $Level, USER_ACCOUNT_MANAGER)) )  
 foreach( $result_array as $k => $row )   {
	 
// cek kuota data jika data berisi true maka process 
   $this->kuota = $this->_get_row_kuota_user( $Usr->get_value('UserId') );
   if( is_bool($this->kuota) and !$this->kuota ){
	   continue;
   }	
   
// row data OK '
  
   $row = Objective( $row );
// define call assignment data process 	
    $this->callDisAsgID  = $row->get_value('AssignId');
	
// tambahakn ke field object 
	$row->add('AssignAmgr', $Usr->get_value('act_mgr'));
	$row->add('AssignMgr',  $Usr->get_value('UserId'));
	$row->add('AssignDate', date('Y-m-d H:i:s'));
	$row->add('AssignMode', $this->callAsgMode);
	
	
// reset data query process 
	
	$this->db->reset_write();
	$this->db->where('AssignId', $row->get_value('AssignId'));
	$this->db->set("AssignAmgr", $row->get_value('AssignAmgr'));
	$this->db->set("AssignMgr",  $row->get_value('AssignMgr'));
	$this->db->set("AssignSpv",  0);
	$this->db->set("AssignSelerId",  0);
	$this->db->set("AssignDate", $row->get_value('AssignDate'));
	$this->db->set("AssignMode", $row->get_value('AssignMode'));
	
	// jika success update ke table di bawah ini.
	
	if( $this->db->update('t_gn_assignment') ) {
		$this->_set_row_update_master( $Usr, $this->callDisAsgID);
		$this->_event_loger_distribute( $this->callDisAsgID, 'DIS');
		//$this->_set_row_decline_data( $this->callDisAsgID );
		$this->callTotalData++;
	}	
	
 }
 
 
// distribusi ke level  "USER_SUPERVISOR" dengan data yang 
// difilter .

 if(!strcmp( $Level, USER_SUPERVISOR ))  
 foreach( $result_array as $k => $row )   {
	
// cek kuota data jika data berisi true maka process 

   $this->kuota = $this->_get_row_kuota_user( $Usr->get_value('UserId') );
   if( is_bool($this->kuota) and !$this->kuota ){
	   continue;
   }	
   
// lanjut processnya .   
	$row = Objective( $row );
// define call assignment data process 	
    $this->callDisAsgID  = $row->get_value('AssignId');
	
// tambahakn ke field object 
	$row->add('AssignAmgr', $Usr->get_value('act_mgr'));
	$row->add('AssignMgr',  $Usr->get_value('mgr_id'));
	$row->add('AssignSpv',  $Usr->get_value('UserId'));
	$row->add('AssignDate', date('Y-m-d H:i:s'));
	$row->add('AssignMode',  $this->callAsgMode);
	
	
// reset data query process 
	
	$this->db->reset_write();
	$this->db->where('AssignId', $row->get_value('AssignId'));
	$this->db->set("AssignAmgr", $row->get_value('AssignAmgr'));
	$this->db->set("AssignMgr",  $row->get_value('AssignMgr'));
	$this->db->set("AssignSpv",  $row->get_value('AssignSpv'));
	$this->db->set("AssignSelerId",  0);
	$this->db->set("AssignDate", $row->get_value('AssignDate'));
	$this->db->set("AssignMode", $row->get_value('AssignMode'));
	
	// jika success update ke table di bawah ini.
	
	if( $this->db->update('t_gn_assignment') ) {
		// echo "<pre>".$this->db->print_out()."</pre>";
		$this->_set_row_kuota_user($Usr->get_value('UserId') ); // update kuota 
		$this->_set_row_update_master( $Usr, $this->callDisAsgID); // update kjustomer 
		$this->_event_loger_distribute( $this->callDisAsgID, 'DIS'); // update loger 
		//$this->_set_row_decline_data( $this->callDisAsgID );
		$this->callTotalData++;
	}		
 }
 
 
// distribusi ke level  "USER_LEADER" dengan data yang 
// difilter .

 if(!strcmp( $Level, USER_LEADER ))  
 foreach( $result_array as $k => $row )   {
	
  // cek kuota data jika data berisi true maka process 
   $this->kuota = $this->_get_row_kuota_user( $Usr->get_value('UserId') );
   
   if( is_bool( $this->kuota) and !$this->kuota ){
	   continue;
   }	
   
// lanjut processnya .

	$row = Objective( $row );
	
	
// define call assignment data process 	
    $this->callDisAsgID  = $row->get_value('AssignId');
	
// tambahakn ke field object 
	$row->add('AssignAmgr',   $Usr->get_value('act_mgr'));
	$row->add('AssignMgr',    $Usr->get_value('mgr_id'));
	$row->add('AssignSpv',    $Usr->get_value('spv_id'));
	$row->add("AssignLeader", $Usr->get_value('UserId'));
	$row->add('AssignDate',   date('Y-m-d H:i:s'));
	$row->add('AssignMode',   $this->callAsgMode);
	
	
// reset data query process 
	$this->db->reset_write();
	$this->db->where('AssignId',   $row->get_value('AssignId'));
	$this->db->set("AssignAmgr",   $row->get_value('AssignAmgr'));
	$this->db->set("AssignMgr",    $row->get_value('AssignMgr'));
	$this->db->set("AssignSpv",    $row->get_value('AssignSpv'));
	$this->db->set("AssignLeader", $row->get_value('AssignLeader'));
	$this->db->set("AssignDate",   $row->get_value('AssignDate'));
	$this->db->set("AssignMode",   $row->get_value('AssignMode'));
	
	// jika success update ke table di bawah ini.
	
	if( $this->db->update('t_gn_assignment') ) {
		$this->_set_row_kuota_user($Usr->get_value('UserId') ); // update kuota 
		$this->_set_row_update_master( $Usr, $this->callDisAsgID);
		$this->_event_loger_distribute( $this->callDisAsgID,  $this->callAsgMode);
		//$this->_set_row_decline_data( $this->callDisAsgID );
		$this->callTotalData++;
	}	
 }
 
  
// distribusi ke level  "USER_AGENT_OUTBOUND" dengan data yang 
// difilter .

if(!strcmp( $Level, USER_AGENT_OUTBOUND ))  
 foreach( $result_array as $k => $row )   {
	
// cek kuota data jika data berisi true maka process 	
   $this->kuota = $this->_get_row_kuota_user( $Usr->get_value('UserId') );
   if( is_bool( $this->kuota) and !$this->kuota ){
	   continue;
   }	
   
	$row = Objective( $row );
	
	
// define call assignment data process 	
    $this->callDisAsgID  = $row->get_value('AssignId');
	
// tambahakn ke field object 
	$row->add('AssignAmgr',    $Usr->get_value('act_mgr'));
	$row->add('AssignMgr',     $Usr->get_value('mgr_id'));
	$row->add('AssignSpv',     $Usr->get_value('spv_id'));
	$row->add("AssignLeader",  $Usr->get_value('tl_id'));
	$row->add("AssignSelerId", $Usr->get_value('UserId'));
	$row->add('AssignDate',    date('Y-m-d H:i:s'));
	$row->add('AssignMode',    $this->callAsgMode);
	
	
 // reset data query process 
	
	$this->db->reset_write();
	$this->db->where('AssignId',    $row->get_value('AssignId'));
	$this->db->set("AssignAmgr",    $row->get_value('AssignAmgr'));
	$this->db->set("AssignMgr",     $row->get_value('AssignMgr'));
	$this->db->set("AssignSpv",     $row->get_value('AssignSpv'));
	$this->db->set("AssignLeader",  $row->get_value('AssignLeader'));
	$this->db->set("AssignSelerId", $row->get_value('AssignSelerId'));
	$this->db->set("AssignDate",    $row->get_value('AssignDate'));
	$this->db->set("AssignMode",    $row->get_value('AssignMode'));
	
 // jika success update ke table di bawah ini.
	
	if( $this->db->update('t_gn_assignment') ) {
		$this->_set_row_kuota_user($Usr->get_value('UserId') ); // update kuota 
		$this->_set_row_update_master( $Usr, $this->callDisAsgID);
		$this->_event_loger_distribute( $this->callDisAsgID,  $this->callAsgMode);
		//$this->_set_row_decline_data( $this->callDisAsgID );
		$this->callTotalData++;
	}	
 }
 
// distribusi ke level  "USER_AGENT_INBOUND" dengan data yang 
// difilter .

if(!strcmp( $Level, USER_AGENT_INBOUND ))  
 foreach( $result_array as $k => $row )   {
	// cek kuota data jika data berisi true maka process 	
   $this->kuota = $this->_get_row_kuota_user( $Usr->get_value('UserId') );
   if( is_bool( $this->kuota) and !$this->kuota ){
	   continue;
   }	
   
	$row = Objective( $row );
	
	
// define call assignment data process 	
    $this->callDisAsgID  = $row->get_value('AssignId');
	
// tambahakn ke field object 
	$row->add('AssignAmgr',    $Usr->get_value('act_mgr'));
	$row->add('AssignMgr',     $Usr->get_value('mgr_id'));
	$row->add('AssignSpv',     $Usr->get_value('spv_id'));
	$row->add("AssignLeader",  $Usr->get_value('tl_id'));
	$row->add("AssignSelerId", $Usr->get_value('UserId'));
	$row->add('AssignDate',    date('Y-m-d H:i:s'));
	$row->add('AssignMode',     $this->callAsgMode);
	
	
 // reset data query process 
	
	$this->db->reset_write();
	$this->db->where('AssignId',    $row->get_value('AssignId'));
	$this->db->set("AssignAmgr",    $row->get_value('AssignAmgr'));
	$this->db->set("AssignMgr",     $row->get_value('AssignMgr'));
	$this->db->set("AssignSpv",     $row->get_value('AssignSpv'));
	$this->db->set("AssignLeader",  $row->get_value('AssignLeader'));
	$this->db->set("AssignSelerId", $row->get_value('AssignSelerId'));
	$this->db->set("AssignDate",    $row->get_value('AssignDate'));
	$this->db->set("AssignMode",    $row->get_value('AssignMode'));
	
 // jika success update ke table di bawah ini.
	
	if( $this->db->update('t_gn_assignment') ) {
		$this->_set_row_kuota_user( $Usr->get_value('UserId') ); // update kuota 
		$this->_set_row_update_master( $Usr, $this->callDisAsgID);
		$this->_event_loger_distribute( $this->callDisAsgID,  $this->callAsgMode);
		//$this->_set_row_decline_data( $this->callDisAsgID );
		
		// plus++
		$this->callTotalData++;
	}	
 } 
 
 // return to data callback 
 return $this->callTotalData;

} 


/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 function _set_row_rekontest_perrata( $out = null )  {
//	 debug($out);
  
// call object --
 $objRek = Singgleton( 'M_Rekontest' );
 $rowAsg = array();
 
//  get on DB  // quantity 
 if( $out->field('torek_useraction') == 1 ){
	$rowAsg = $objRek->_select_pager_rekontest( $out, array( "a.AssignId" ));	
 } 
 
 
// Get on selected grid  -- checklist data  -- 
 if( $out->field('torek_useraction') == 2 ){
	$arrAsg = $out->fields('AssignId');
	if( is_array($arrAsg) ) foreach( $arrAsg as $k => $AssignId ){
		$rowAsg[] = array( 'AssignId' => $AssignId );
	}	
 }
 
// next process  
  if( is_array($rowAsg) && count($rowAsg) == 0 ) {
	return FALSE;
 }	
  
 // --------- on random ---------------------------
 $Level = $out->field('torek_groupuser');
 $total_dist = $out->field('torek_sharedata');
 
 if( $out->field('trans_user_mode')== 2) {
	shuffle($rowAsg);
 }
 
 // def data posted by user ---------------------------
    
  $arr_user_avail =& $out->fields('torek_userlist_html');
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
 

/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
 
 public function _set_row_rekontest_peragent( $out = null  ) 
{
// call object --
 	
 $objAsg =& get_class_instance('M_MgtAssignment');
 $rowAsg = array();
 
// ------ get on DB  
 if( $out->get_value('trans_user_action') == 1 ){
	$rowAsg = $objAsg->_select_page_transfer( $out, array("a.AssignId"));	
 } 

 // Get on selected grid ------------- 
 if( $out->get_value('trans_user_action') == 2 ){
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
 $Level = $out->get_value('trans_to_user_group');
 $total_dist = & $out->get_value('trans_user_quantity');
 
 
 if( $out->get_value('trans_user_mode')== 2) {
	shuffle($rowAsg);
 }
 
//------------ if data not valid ---------------
 
 $arr_user_avail = array();
 $arr_tots_input = 0;
 $outAgent = $out->get_array_value('trans_to_user_list');
 
 if(is_array($outAgent) )
	foreach( $outAgent as $k => $UsrId )
 {
	$avail_data = (int)$out->get_value("trans_to_user_list_{$UsrId}");
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

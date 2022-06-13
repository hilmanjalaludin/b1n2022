<?php
/*
 * E.U.I 
 *
 
 * subject	: M_SetBenefit modul 
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/model/M_Utility/
 */
 
class M_SetCallResult extends EUI_Model
{

// -----------------------------------------------------------------------------------------------------------------
/*
 * @package    : self::_get_resource
 * 
 * Auth 		uknow 
 * Object 		-  
 */
 private static $Instance   = null; 
 
// -----------------------------------------------------------------------------------------------------------------
/*
 * @package    : self::_get_resource
 * 
 * Auth 		uknow 
 * Object 		-  
 */
 
 public static function &Instance()
{
	if( is_null(self::$Instance) ){
		self::$Instance = new self();
	}	
	return self::$Instance;
}

// -----------------------------------------------------------------------------------------------------------------
/*
 * @package    : self::_get_resource
 * 
 * Auth 		uknow 
 * Object 		-  
 */
 
 public function __construct() { 
  $this->load->helper(array('EUI_Object'));
}

// -----------------------------------------------------------------------------------------------------------------
/*
 * @package    : self::_get_resource
 * 
 * Auth 		uknow 
 * Object 		-  
 */
function _get_default()
{
	$this -> EUI_Page -> _setPage(10); 
	
	$this -> EUI_Page -> _setQuery
		(
		 " SELECT a.CallReasonId FROM t_lk_callreason a 
		   LEFT JOIN  t_lk_callreasoncategory b ON a.CallReasonCategoryId=b.CallReasonCategoryId "
		); 
	
	$flt = '';
	
	if( $this->URI->_get_have_post('keywords') ) 
	{
		$flt.=" AND ( 
				a.CallReasonCategoryId LIKE '%{$this->URI->_get_post('keywords')}%' 
				OR a.CallReasonLevel LIKE '%{$this->URI->_get_post('keywords')}%'
				OR a.CallReasonCode LIKE '%{$this->URI->_get_post('keywords')}%'
				OR a.CallReasonDesc LIKE '%{$this->URI->_get_post('keywords')}%'
				OR a.CallReasonStatusFlag LIKE '%{$this->URI->_get_post('keywords')}%'
				OR a.CallReasonContactedFlag LIKE '%{$this->URI->_get_post('keywords')}%'
				OR a.CallReasonEvent LIKE '%{$this->URI->_get_post('keywords')}%'
				OR a.CallReasonLater LIKE '%{$this->URI->_get_post('keywords')}%'
				OR a.CallReasonOrder LIKE '%{$this->URI->_get_post('keywords')}%'
				OR a.CallReasonNoNeed LIKE '%{$this->URI->_get_post('keywords')}%' 
			) ";
	}				
			
	$this -> EUI_Page -> _setWhere( $flt );   
	if( $this -> EUI_Page -> _get_query() ) {
		return $this -> EUI_Page;
	}
}

// -----------------------------------------------------------------------------------------------------------------
/*
 * @package    : self::_get_resource
 * 
 * Auth 		uknow 
 * Object 		-  
 */
 
function _get_content()
{

  $this -> EUI_Page->_postPage( $this -> URI -> _get_post('v_page') );
  $this -> EUI_Page->_setPage(10);
 
  $sql ="SELECT a.*,IF(a.CallReasonEvent=0,'No','YES') as triger,
		IF(a.CallReasonLater=0,'No','YES') as calllater, IF(a.CallReasonNoNeed=0,'No','YES') as notinterest, 
		b.*, IF(CallReasonStatusFlag=0,'Not Active','Active') as statusResult 
		FROM t_lk_callreason a
		LEFT JOIN t_lk_callreasoncategory b
		ON a.CallReasonCategoryId=b.CallReasonCategoryId";
			
  $this -> EUI_Page ->_setQuery($sql);
  $flt = '';
 
  if( $this -> URI -> _get_have_post('keywords') )
  {
	$flt.=" AND ( 
			a.CallReasonCategoryId LIKE '%{$this->URI->_get_post('keywords')}%' 
			OR a.CallReasonLevel LIKE '%{$this->URI->_get_post('keywords')}%'
			OR a.CallReasonCode LIKE '%{$this->URI->_get_post('keywords')}%'
			OR a.CallReasonDesc LIKE '%{$this->URI->_get_post('keywords')}%'
			OR a.CallReasonStatusFlag LIKE '%{$this->URI->_get_post('keywords')}%'
			OR a.CallReasonContactedFlag LIKE '%{$this->URI->_get_post('keywords')}%'
			OR a.CallReasonEvent LIKE '%{$this->URI->_get_post('keywords')}%'
			OR a.CallReasonLater LIKE '%{$this->URI->_get_post('keywords')}%'
			OR a.CallReasonOrder LIKE '%{$this->URI->_get_post('keywords')}%'
			OR a.CallReasonNoNeed LIKE '%{$this->URI->_get_post('keywords')}%' 
			) ";
				
  }				
		
  $this -> EUI_Page->_setWhere($flt);
  if( $this -> URI -> _get_have_post('order_by'))
  {
	$this -> EUI_Page->_setOrderBy($this->URI->_get_post('order_by'),$this->URI->_get_post('type'));
  }
  
  $this -> EUI_Page->_setLimit();
}



// -----------------------------------------------------------------------------------------------------------------
/*
 * @package    : self::_get_resource
 * 
 * Auth 		uknow 
 * Object 		-  
 */
 
function _get_resource()
 {
	self::_get_content();
	if( $this -> EUI_Page -> _get_query()!='') 
	{
		return $this -> EUI_Page -> _result();
	}	
 }
 
// -----------------------------------------------------------------------------------------------------------------
/*
 * @package    : self::_get_resource
 * 
 * Auth 		uknow 
 * Object 		-  
 */
 
 
function _get_page_number() 
 {
	if( $this -> EUI_Page -> _get_query()!='' ) {
		return $this -> EUI_Page -> _getNo();
	}	
 }
 
// -----------------------------------------------------------------------------------------------------------------
/*
 * @package    : self::_get_resource
 * 
 * Auth 		uknow 
 * Object 		-  
 */
 
function _getNotInterest()
{
	$_conds = array();
	
	$sql = " SELECT a.CallReasonId, a.CallReasonDesc, a.CallReasonCode FROM t_lk_callreason a 
			 LEFT JOIN t_lk_callreasoncategory b on a.CallReasonCategoryId=b.CallReasonCategoryId
			 WHERE a.CallReasonNoNeed=1  AND b.CallReasonInterest=0 ORDER BY a.CallReasonOrder ASC ";
		 
	$qry = $this -> db -> query($sql);
	if( !$qry -> EOF() ) 
	{
		foreach( $qry -> result_assoc() as $rows )
		{
			$_conds[$rows['CallReasonId']] = array 
			( 
				'name' => $rows['CallReasonDesc'], 
				'code' => $rows['CallReasonCode']
			);
		}
	}
	
	return $_conds;
}

// -----------------------------------------------------------------------------------------------------------------
/*
 * @package    : self::_get_resource
 * 
 * Auth 		uknow 
 * Object 		-  
 */
 
function _getInterestSale()
 {
	$_conds = array();
	$sql = " SELECT a.CallReasonId, a.CallReasonDesc, a.CallReasonCode from t_lk_callreason a 
			 LEFT join t_lk_callreasoncategory b on a.CallReasonCategoryId = b.CallReasonCategoryId
			 WHERE b.CallReasonInterest =1 AND a.CallReasonStatusFlag=1 ";
	
	$qry = $this -> db -> query($sql);
	if(!$qry -> EOF()){
		foreach( $qry -> result_assoc() as $rows ) {
			$_conds[$rows['CallReasonId']]= array( 
				'name' => $rows['CallReasonDesc'], 
				'code' => $rows['CallReasonCode']
			);	
		}	
	}
	
	return $_conds;
 }

// -----------------------------------------------------------------------------------------------------------------
/*
 * @package    : self::_get_resource
 * 
 * Auth 		uknow 
 * Object 		-  
 */
 
function _getBoolean()
{
	$array = array('1'=>'Yes','0'=>'No');
	return $array;
}	

// -----------------------------------------------------------------------------------------------------------------
/*
 * @package    : self::_get_resource
 * 
 * Auth 		uknow 
 * Object 		-  
 */
 
function _getCallback()
{
	$_conds = array();
	
	$sql = " SELECT a.CallReasonId, a.CallReasonDesc, a.CallReasonCode 
			 FROM  t_lk_callreason a WHERE a.CallReasonLater=1 
			 AND a.CallReasonStatusFlag=1 ";
			 
	$qry = $this -> db -> query($sql);
	if( !$qry -> EOF() ) 
	{
		foreach( $qry -> result_assoc() as $rows )
		{
			$_conds[$rows['CallReasonId']] = array ( 
				'name' => $rows['CallReasonDesc'], 
				'code' => $rows['CallReasonCode']
			);	
		}	
	}
	
	return $_conds;
}

// -----------------------------------------------------------------------------------------------------------------
/*
 * @package    : self::_get_resource
 * 
 * Auth 		uknow 
 * Object 		-  
 */
 
function _getCallReasonId( $CategoryId=NULL )
{
	$_conds = array();
	$this -> db->reset_select();
	$this -> db->select("a.CallReasonId, a.CallReasonDesc, a.CallReasonCode");
	$this -> db->from("t_lk_callreason a");
	$this -> db->join("t_lk_callreasoncategory b ","a.CallReasonCategoryId=b.CallReasonCategoryId","LEFT");
	$this -> db->where("a.CallReasonStatusFlag",1);
	
	if(!is_null($CategoryId))
	{
		$this -> db -> where("a.CallReasonCategoryId",$CategoryId);
	}
	
	//echo $this -> db ->_get_var_dump();
	foreach( $this->db->get()->result_assoc() as $rows ) {
		$_conds[$rows['CallReasonId']] = array  ( 
			'name' => $rows['CallReasonDesc'], 
			'code' => $rows['CallReasonCode']
		);	
	}	

	return $_conds;		 
} 


// -----------------------------------------------------------------------------------------------------------------
/*
 * @package    : self::_get_resource
 * 
 * Auth 		uknow 
 * Object 		-  
 */
 
function _getCallReasonIdRekontest( $CategoryId=NULL )
{
	$_conds = array();
	$this -> db->reset_select();
	$this -> db->select("a.CallReasonId, a.CallReasonDesc, a.CallReasonCode");
	$this -> db->from("t_lk_callreason a");
	$this -> db->join("t_lk_callreasoncategory b ","a.CallReasonCategoryId=b.CallReasonCategoryId","LEFT");
#	$this -> db->where("a.CallReasonStatusFlag",1);
	$this -> db->where_in("a.CallReasonId",array(71,1));	
	if(!is_null($CategoryId))
	{
		$this -> db -> where("a.CallReasonCategoryId",$CategoryId);
	}
	
	//echo $this -> db ->_get_var_dump();
	foreach( $this->db->get()->result_assoc() as $rows ) {
		$_conds[$rows['CallReasonId']] = array  ( 
			'name' => $rows['CallReasonDesc'], 
			'code' => $rows['CallReasonCode']
		);	
	}	

	return $_conds;		 
} 


// -----------------------------------------------------------------------------------------------------------------
/*
 * @package    : self::_get_resource
 * 
 * Auth 		uknow 
 * Object 		-  
 */
 
 
function _getInboundReasonId()
{
	$_conds = array();
	$this->db->reset_select();
	$this->db->select("a.CallReasonId, a.CallReasonDesc, a.CallReasonCode");
	$this->db->from("t_lk_callreason a");
	$this->db->join("t_lk_callreasoncategory b ","a.CallReasonCategoryId=b.CallReasonCategoryId","LEFT");
	$this->db->where("b.CallOutboundGoalsId",1);
	$rs  = $this->db->get();
	
	if( $rs->num_rows() > 0 ) 
		foreach( $rs->result_assoc() as $rows )
	{
		$_conds[$rows['CallReasonId']] = array 
		( 
			'name' => $rows['CallReasonDesc'], 
			'code' => $rows['CallReasonCode']
		);	
	}	
	return $_conds;		 
} 

// -----------------------------------------------------------------------------------------------------------------
/*
 * @package    : self::_get_resource
 * 
 * Auth 		uknow 
 * Object 		-  
 */
 
 public function _getEventSale()
{
	$this->ar_event_sale = array();
	$qry = $this->db->query(sprintf("
			SELECT 
				a.CallReasonId, 
				a.CallReasonDesc, 
				a.CallReasonCode 
			 FROM  t_lk_callreason a 
			 WHERE a.CallReasonEvent=%s", 1)
			);
	 
	if( $qry->num_rows()>0 )
		foreach( $qry->result_assoc() as $rows )
	{
		$this->ar_event_sale[$rows['CallReasonId']] = array ( 
			'name' => $rows['CallReasonDesc'], 
			'code' => $rows['CallReasonCode']
		);	
	}
    
	return (array)$this->ar_event_sale;		 
}
// -----------------------------------------------------------------------------------------------------------------
/*
 * @package    : self::_get_resource
 * 
 * Auth 		uknow 
 * Object 		-  
 */
 
 function _setActive($data=array())
 {
	$_conds = 0;
	if(is_array($data))
	{
		foreach( $data['CallReasonId'] as $keys => $CallReasonId )
		{
			if( $this -> db ->update('t_lk_callreason', 
				array('CallReasonStatusFlag'=> $data['Active']), 
				array('CallReasonId' => $CallReasonId)
			))
			{
				$_conds++;
			}	
		}
	}	
	return $_conds;
 }
 
// -----------------------------------------------------------------------------------------------------------------
/*
 * @package    : self::_get_resource
 * 
 * Auth 		uknow 
 * Object 		-  
 */
 
 function _setSaveCallResult( $post=array() )
 {
	$_conds = 0;
	if( $this -> db->insert('t_lk_callreason',$post) ) 
	{
		$_conds++;
	}
	return $_conds;
 }
 
// -----------------------------------------------------------------------------------------------------------------
/*
 * @package    : self::_get_resource
 * 
 * Auth 		uknow 
 * Object 		-  
 */
 
 function _setDeleteCallResult($_post)
 {
	$_conds = 0;
	foreach($_post as $a => $PK )
	{
		if( $this -> db ->delete('t_lk_callreason', 
			array('CallReasonId' => $PK) 
		)) 
		{
			$_conds++;
		}
	}
	
	return $_conds; 
 }
 
// -----------------------------------------------------------------------------------------------------------------
/*
 * @package    : self::_get_resource
 * 
 * Auth 		uknow 
 * Object 		-  
 */

function _getDataResult( $ResultId=0 )
{  
	$_conds = array();
	
	$this -> db -> select('*');
	$this -> db -> from('t_lk_callreason a');
	$this -> db -> where('a.CallReasonId',$ResultId);
	
	if( $rows = $this -> db -> get() -> result_first_assoc())
	{
		$_conds = $rows;
	}
	
	return $_conds;
}

// -----------------------------------------------------------------------------------------------------------------
/*
 * @package    : self::_get_resource
 * 
 * Auth 		uknow 
 * Object 		-  
 */

function _setUpdateCallResult($_post = array() )
{
	$_conds = 0; $update = array(); $where = array();
	foreach( $_post as $fields => $values )
	{
		if(($fields!='CallReasonId'))
			$update[$fields] = $values;
		else
			$where[$fields] = $values;
	}
	
	if( $this -> db -> update('t_lk_callreason',$update,$where)){
		$_conds++;	
	}
	
	return $_conds;
}

// -----------------------------------------------------------------------------------------------------------------
/*
 * @package    : self::_get_resource
 * 
 * Auth 		uknow 
 * Object 		-  
 */
 
function _getEventType($CallReasonId)
{
	$this->db->select('a.CallReasonEvent, a.CallReasonLater');
	$this->db->from('t_lk_callreason a');
	$this->db->where('a.CallReasonStatusFlag',1);
	$this->db->where('a.CallReasonId', $CallReasonId);
	
	if( $rows = $this -> db->get()->result_first_assoc()){
		return $rows;
	}
	else
		return null;

}


// -----------------------------------------------------------------------------------------------------------------
/*
 * @package    : self::_get_resource
 * 
 * Auth 		uknow 
 * Object 		-  
 */
 
function _getPendingInfo()
{
	$_conds = array();
	$sql = "SELECT a.CallReasonId, a.CallReasonDesc  FROM 
				t_lk_callreason a 
			WHERE a.CallReasonPendingQA = 1 ";
	
	$qry = $this -> db -> query($sql);
	if(!$qry -> EOF()){
		foreach( $qry -> result_assoc() as $rows ) {
			$_conds[$rows['CallReasonId']]= $rows['CallReasonDesc'];
		}	
	}
	
	return $_conds;
 }
 
 
// -----------------------------------------------------------------------------------------------------------------
/*
 * @package    : self::_get_resource
 * 
 * Auth 		uknow 
 * Object 		-  
 */
 
 function _getRealInterest()
 {
	$Int = $this->_getInterestSale();
	$Pen = $this->_getPendingInfo();
	
	$process = array();
	foreach( $Int as $k => $v ){
		if(!in_array($k,array_keys($Pen) )){
			$process[$k] = $v;
		}
	}
	
	return $process;
	
 }
 
// -----------------------------------------------------------------------------------------------------------------
/*
 * @package    : self::_get_resource
 * 
 * Auth 		uknow 
 * Object 		-  
 */
 
 function _getAllResult()
 {
	$_conds = array();
	$sql = "SELECT a.CallReasonId, a.CallReasonDesc  FROM 
				t_lk_callreason a 
			WHERE a.CallReasonPendingQA <> 1 ";
	
	$qry = $this -> db -> query($sql);
	if(!$qry -> EOF()){
		foreach( $qry -> result_assoc() as $rows ) {
			$_conds[$rows['CallReasonId']]= $rows['CallReasonDesc'];
		}	
	}
	
	return $_conds;
 }
 
// ---------------------------------------------------------------------------------------------
/* 
 * add call result all by not interest && New 
 *
 */
 
 function _getCallResultTransfer()
{
  
 $arr_call_result = array();
 
 $this->db->reset_select();
 $this->db->select("a.CallReasonId, a.CallReasonDesc", FALSE);
 $this->db->from("t_lk_callreason a");
 $this->db->join("t_lk_callreasoncategory b ","a.CallReasonCategoryId=b.CallReasonCategoryId","LEFT");
 $this->db->where("a.CallReasonEvent", 0);
 $this->db->where("b.CallOutboundGoalsId", 2);
 $this->db->where_not_in("a.CallReasonId", array(99));
 
 $rs = $this->db->get();
 if( $rs->num_rows() > 0 ) 
	foreach( $rs->result_assoc() as $rows )
 {
	$arr_call_result[$rows['CallReasonId']] = $rows['CallReasonDesc'];	
 }
 return (array)$arr_call_result;
 
}


// -----------------------------------------------------------------------------------------------------------------
/*
 * @package    : self::_get_resource
 * 
 * Auth 		uknow 
 * Object 		-  
 */
 public function _select_row_call_status_code( $code = '' )
{
  $arr_call_result = array();
  
  $this->db->reset_select();
  $this->db->select("a.CallReasonId, a.CallReasonDesc", FALSE);
  $this->db->from("t_lk_callreason a");
  $this->db->where("a.CallReasonCode", sprintf("%s", $code));
  $rs = $this->db->get();
  if( $rs->num_rows() > 0 ) 
	  foreach( $rs->result_assoc() as $rows )
 {
	$arr_call_result[$rows['CallReasonId']] = $rows['CallReasonDesc'];
 }
 
 return (array)$arr_call_result;
  
}


// -----------------------------------------------------------------------------------------------------------------
/*
 * @package    : self::_get_resource
 * 
 * Auth 		uknow 
 * Object 		-  
 */
 
 public function _select_row_call_status_key_by_privilege( $key )
{
  $this->ar_row_key = array();
  $this->ar_row_key = $this->_select_row_call_status_by_privilege( $key );
  if( count($this->ar_row_key) !=0 ){
	return array_keys( $this->ar_row_key );	
  }
  return array(0);
} 
// -----------------------------------------------------------------------------------------------------------------
/*
 * @package    : self::_get_resource
 * 
 * Auth 		uknow 
 * Object 		-  
 */
function _select_row_detail_status( $StatusId = 0 )
{ 
 $arr_call_status = array();
 $rs  = $this->db->query(sprintf("
			SELECT 
				a.CallReasonCode,  
				a.CallReasonId,
				b.CallReasonCategoryCode,
				b.CallReasonCategoryId
			FROM t_lk_callreason a 
			INNER JOIN t_lk_callreasoncategory b 
			ON a.CallReasonCategoryId = b.CallReasonCategoryId
			WHERE a.CallReasonId = %s", $StatusId));
	if( $rs->num_rows() > 0 ){
		$arr_call_status = $rs->result_first_assoc();
	}		
	
 return (array)$arr_call_status;		
}

 /*
  * [Recovery penambahan akses per kategori ]
  * author    : Didi ganteng
  * @param $kategoryId
  * @return [array]             [description]
  */
  
function _select_call_result_perkategory( $kategoryId = 0 ){
	
	$result_array = array();	
	$sql = sprintf("select distinct a.CallReasonId as ID, b.profileid, a.CallReasonCode as Kode,   a.CallReasonDesc as Name
		from t_lk_callreason a 
        left join t_lk_callreasongroup b on a.CallReasonId = b.CallReasonId
        inner join tms_agent c on c.profile_id = b.profileid
        where b.CallCategoryId = '%s' and b.flag = '1'", $kategoryId);

	// jika QAS 
	if( in_array(_get_session('HandlingType'), 
	   array('19')) )
	{
		$sql .= " and b.profileid = '19'";
	}
	
    //jika TM
	if( in_array(_get_session('HandlingType'), 
	   array('4')) )
	{
		$sql .= " and b.profileid = '4'";
	}
    
    //jika admfu
	if( in_array(_get_session('HandlingType'), 
	   array('20')) )
	{
		$sql .= " and b.profileid = '20'";
	}

	$qry = $this->db->query( $sql );
	// echo "<pre> $sql </pre>";
	if( $qry && $qry->num_rows() > 0 ) 
		foreach( $qry->result_assoc() as $row ){
			$result_array[$row['ID']] = sprintf("%s - %s", $row['Kode'], $row['Name']);
	}			  
	return (array)$result_array;	
}



 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
 public function _select_row_call_status_by_privilege( $uid )
{
	
 $this->ar_syscal_status = array();
 
// ---------------------------- call status  -----------------

 $rs = $this->db->query(sprintf("select 
				a.CallReasonId, 
				a.CallReasonPrivileges 
				from t_lk_callreason a
				where a.CallReasonStatusFlag=%s", 1));
				
 if( $rs->num_rows() > 0 ) 
	foreach( $rs->result_assoc() as $rows )
 {
	 $row = new EUI_Object( $rows ); 
	 if( $row->find_value('CallReasonPrivileges') ) 
		foreach( $row->get_array_value('CallReasonPrivileges') as $key => $val ) 
	{
		$this->ar_syscal_status[$val][$row->get_value('CallReasonId')] = $row->get_value('CallReasonId'); 
	}
 }	
 
 // --------------- testing  ------------------------------------
 
 if( isset( $this->ar_syscal_status[$uid] ) ) {
	$this->ar_call_status = $this->ar_syscal_status[$uid];
 }
 
 return $this->ar_call_status;
  
}	

// ===================== END CLASS ==========================================

}
?>
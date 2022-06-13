<?php
/*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 * 
 */
 
class M_Combo extends EUI_Model
{

/*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 * 
 */	
 
private static $Intance = null;

/*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 * 
 */	
 
public function __construct()
{
	$this->load->model(array(
		'M_SetCampaign', 
		'M_SetProduct', 
		'M_SetCallResult', 
		'M_SysUser', 
		'M_SetResultQuality',
		'M_SetResultCategory',
		'M_CtiSkill',
		'M_Configuration',
		'M_PhoneType'
	));
	
	
}

 
public function	&get_instance()
{
	if(is_null(self::$Intance) )
	{
		self::$Intance = new self();
	}
	
	return self::$Intance;
}


/*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 * 
 */	
 
public function	&Instance()
{
	if(is_null(self::$Intance) )
	{
		self::$Intance = new self();
	}
	
	return self::$Intance;
}

/*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 * 
 */	
 

function _getMaried()
{
	$_conds = array();
	$this ->db->reset_select();
	$this -> db -> select('MaritalStatusCode, MaritalStatusDesc');
	$this -> db -> from('t_lk_maritalstatus');
	$rs = $this -> db ->get();
	
	if( mysql_errno() ){
		return array();
	}
	
	if($rs->num_rows() > 0 )
		foreach($rs->result_assoc() as $rows ) 
	{
		$_conds[$rows['MaritalStatusCode']] = $rows['MaritalStatusDesc'];
	}
	
	return $_conds;
}

/*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 * 
 */	
 

function _getSmoking()
{
	$_conds = array();
	$this ->db->reset_select();
	$this -> db -> select('SmokingCode, SmokingName');
	$this -> db -> from('t_lk_smoking');
	$this -> db -> where('SmokingFlagStatus',1);
	foreach($this -> db ->get()->result_assoc() as $rows )
	{
		$_conds[$rows['SmokingCode']] = $rows['SmokingName'];
	}
	
	return $_conds;
	
}



/*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 * 
 */	
 

function _getComunication()
{
	$_conds = array();
	$this ->db->reset_select();
	$this -> db -> select('CommChannelId,CommChannelDesc');
	$this -> db -> from('t_lk_communications_channel');
	foreach($this -> db ->get()->result_assoc() as $rows )
	{
		$_conds[$rows['CommChannelId']] = $rows['CommChannelDesc'];
	}
	
	return $_conds;
}


/*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 * 
 */	
 

function _getWorkType()
{
	$_conds = array();
	$this ->db->reset_select();
	$this -> db -> select('OccId, OccDesc');
	// $this -> db -> select('OccCode, OccIndonesian, OccEnglish');
	// $this -> db -> from('t_lk_occupation_code');
	$this -> db -> from('t_lk_occupation');
	foreach($this -> db ->get()->result_assoc() as $rows )
	{
		// $_conds[$rows['OccCode']] = $rows['OccIndonesian'];
		$_conds[$rows['OccId']] = $rows['OccDesc'];
	}
	
	return $_conds;
}


/*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 * 
 */	
 

function _getCountry()
{
	$_conds = array();
	$this ->db->reset_select();
	$this -> db -> select('CountryCode, CountryName');
	$this -> db -> from('t_lk_country');
	$this -> db -> where('CountryFlagStatus',1);
	foreach($this -> db ->get()->result_assoc() as $rows )
	{
		$_conds[$rows['CountryCode']] = $rows['CountryName'];
	}
	
	return $_conds;
}
/**
  * [User]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */  
function _getAddressByContact( $KontakId = 0){
	
	$result_array = array();
	$sql = sprintf("SELECT  a.DM_AddressLine1,  a.DM_AddressLine2,  a.DM_AddressLine3 
					FROM t_gn_customer_master a
					WHERE a.DM_Id=%d", $KontakId);
	//debug($sql);				
	$qry = $this->db->query( $sql);
	if( $qry && $qry->num_rows() > 0 ) {
		$row = $qry->result_first_assoc();
		if(  is_array( $row )) foreach( $row as $key => $val ){
			if( strlen( $val ) > 1 ){
				$result_array[] = $val;
			}
		}
	}
	// return array data .
	return join(" ", $result_array );
	
}
/**
  * [User]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */  
function _getSponsor()
{
	$_conds = array();
	
	$this ->db->reset_select();
	$this -> db -> select('SponsorCode, SponsorName');
	$this -> db -> from('t_lk_sponsor');
	$rs = $this -> db ->get();
	if( mysql_errno() ){ return array(); }
	
	foreach( $rs->result_assoc() as $rows ) {
		$_conds[$rows['SponsorCode']] = "{$rows['SponsorCode']} - {$rows['SponsorName']}";
	}
	
}
/**
  * [User]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */  

 function _getKategoryKode( $Id = 0 ){
	$sql = sprintf("SELECT a.CallReasonCategoryCode  FROM  t_lk_callreasoncategory a 
					WHERE a.CallReasonCategoryId='%s'", $Id);
					
					
	$qry = $this->db->query( $sql );		
	if( $qry && $qry->num_rows() > 0 ) {
		if( $row = $qry->result_first_assoc() ){
			return $row['CallReasonCategoryCode'];
		}
	}				
	return 0;
 }
 
 
/**
  * [User]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */  

 function _getResultKode( $Id = null){
	 
	 $sql = sprintf("SELECT a.CallReasonCode  
					FROM t_lk_callreason a WHERE a.CallReasonId ='%s'", $Id);
			
	$qry = $this->db->query( $sql );		
	if( $qry && $qry->num_rows() > 0 ) {
		if( $row = $qry->result_first_assoc() ){
			return $row['CallReasonCode'];
		}
	}				
	return 0;
}
/**
  * [User]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */  

function _getAllCallReason( $CallReasonCategoryId = 0 ){
	
	// default array to Process Ok 
	$result_array =array();
	
	$this->db->reset_select();
	$this->db->select(" a.CallReasonId as Id, 
						a.CallReasonCode as Kode, 
						a.CallReasonDesc as Name", false);
						
	$this->db->from('t_lk_callreason a');
	$this->db->where('a.CallReasonStatusFlag', 1);
	
	// jika ada ya ?
	if( $CallReasonCategoryId && !is_null($CallReasonCategoryId) ){
		$this->db->where('a.CallReasonCategoryId', $CallReasonCategoryId);
	}
	// echo $this -> db -> _get_var_dump();
	// on the get data process OK SIP Ya .
	$qry = $this->db->get();
	if( $qry && $qry->num_rows() > 0 ) 
	foreach( $qry->result_assoc() as $row ){
		$result_array[$row['Id']] = sprintf("%s - %s", $row['Kode'], $row['Name']); 
	}
	return $result_array;
}

/**
  * [User]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */  

function _getAllCallReasonCode( $CallReasonCategoryCode = 0 ){
	
	// default array to Process Ok 
	$result_array =array();
	
	$this->db->reset_select();
	$this->db->select(" a.CallReasonId as Id, 
						a.CallReasonCode as Kode, 
						a.CallReasonDesc as Name", false);
						
	$this->db->from('t_lk_callreason a');
	$this->db->where('a.CallReasonStatusFlag', 1);
	
	// jika ada ya ?
	if( $CallReasonCategoryCode && !is_null($CallReasonCategoryCode) ){
		$this->db->where('a.CallReasonCode', $CallReasonCategoryCode);
	}
	// echo $this -> db -> _get_var_dump();
	// on the get data process OK SIP Ya .
	$qry = $this->db->get();
	if( $qry && $qry->num_rows() > 0 ) 
	foreach( $qry->result_assoc() as $row ){
		$result_array[$row['Kode']] = sprintf("%s - %s", $row['Kode'], $row['Name']); 
	}
	return $result_array;
}
 /**
  * [User]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */  
function _getAllCallStatus()
{
	$result_array =array();
	$sql = sprintf("SELECT  
					a.CallReasonCategoryId as Id,  a.CallReasonCategoryCode as Kode, 
					a.CallReasonCategoryName as Name
					FROM t_lk_callreasoncategory  a 
					WHERE a.CallReasonCategoryFlags=%d", 1);
	$qry = $this->db->query( $sql);
	if( $qry && $qry->num_rows() > 0 ) 
	foreach( $qry->result_assoc() as $row ){
		$result_array[$row['Id']] = sprintf("%s - %s", $row['Kode'], $row['Name']); 
	}
	return $result_array;
		
}


 /**
  * [User]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */  
function _getAllCallStatusFilterRekontest()
{
	$result_array =array();
	$sql = sprintf("SELECT  
					a.CallReasonCategoryId as Id,  a.CallReasonCategoryCode as Kode, 
					a.CallReasonCategoryName as Name
					FROM t_lk_callreasoncategory  a 
					WHERE a.CallReasonCategoryFlags=%d
					AND a.CallReasonCategoryId not IN (5,7,8,9)", 1);
	$qry = $this->db->query( $sql);
	if( $qry && $qry->num_rows() > 0 ) 
	foreach( $qry->result_assoc() as $row ){
		$result_array[$row['Id']] = sprintf("%s - %s", $row['Kode'], $row['Name']); 
	}
	return $result_array;
		
}


 /**
  * [User]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */  
function _getAllCallStatusRekontest()
{
	$result_array =array();
	$sql = sprintf("SELECT  
					a.CallReasonCategoryId as Id,  a.CallReasonCategoryCode as Kode, 
					a.CallReasonCategoryName as Name
					FROM t_lk_callreasoncategory  a 
					WHERE a.CallReasonCategoryFlags=%d
					AND a.CallReasonCategoryId IN (1,3)", 1);
	$qry = $this->db->query( $sql);
	if( $qry && $qry->num_rows() > 0 ) 
	foreach( $qry->result_assoc() as $row ){
		$result_array[$row['Id']] = sprintf("%s - %s", $row['Kode'], $row['Name']); 
	}
	return $result_array;
		
}
 /**
  * [User]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */  
function _getAllCallCategoryCode()
{
	$result_array =array();
	$sql = sprintf("SELECT  
					a.CallReasonCategoryId as Id,  a.CallReasonCategoryCode as Kode, 
					a.CallReasonCategoryName as Name
					FROM t_lk_callreasoncategory  a 
					WHERE a.CallReasonCategoryFlags=%d", 1);
	$qry = $this->db->query( $sql);
	if( $qry && $qry->num_rows() > 0 ) 
	foreach( $qry->result_assoc() as $row ){
		$result_array[$row['Kode']] = sprintf("%s - %s", $row['Kode'], $row['Name']); 
	}
	return $result_array;
	
}
 /**
  * [User]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */  
function _getAllCallStatusNew()
{
	$result_array =array();
	// $sql = sprintf("SELECT  
					// a.CallReasonCategoryId as Id,  a.CallReasonCategoryCode as Kode, 
					// a.CallReasonCategoryName as Name
					// FROM t_lk_callreasoncategory  a 
					// WHERE a.CallReasonCategoryFlags=%d", 1);
	// $qry = $this->db->query( $sql);
	$this->db->reset_select();
	$this->db->select(" a.CallReasonCategoryId as Id,  a.CallReasonCategoryCode as Kode, 
						a.CallReasonCategoryName as Name", false);
						
	$this->db->from('t_lk_callreasoncategory a');
	$this->db->where_in('a.CallReasonCategoryId', array(1));
	$qry = $this->db->get();
	if( $qry && $qry->num_rows() > 0 ) 
	foreach( $qry->result_assoc() as $row ){
		$result_array[$row['Id']] = sprintf("%s - %s", $row['Kode'], $row['Name']); 
	}
	return $result_array;
		
}

function _getAllCallStatus_()
{
	$result_array =array();
	// $sql = sprintf("SELECT  
	// 				a.CallReasonCategoryId as Id,  a.CallReasonCategoryCode as Kode, 
	// 				a.CallReasonCategoryName as Name
	// 				FROM t_lk_callreasoncategory  a 
	// 				WHERE a.CallReasonCategoryFlags=%d", 1);
	$this->db->reset_select();
	$this->db->select(" a.CallReasonCategoryId as Id,  a.CallReasonCategoryCode as Kode, 
						a.CallReasonCategoryName as Name", false);
						
	$this->db->from('t_lk_callreasoncategory a');
	$this->db->where_in('a.CallReasonCategoryId', array(3,2));
	// echo $sql;
	// $qry = $this->db->query( $sql);
	$qry = $this->db->get();
	if( $qry && $qry->num_rows() > 0 ) 
	foreach( $qry->result_assoc() as $row ){
		$result_array[$row['Id']] = sprintf("%s - %s", $row['Kode'], $row['Name']); 
	}
	return $result_array;
		
}
function _getAllCallStatusInterest()
{
	$result_array =array();
	$sql = sprintf("SELECT  
					a.CallReasonCategoryId as Id,  a.CallReasonCategoryCode as Kode, 
					a.CallReasonCategoryName as Name
					FROM t_lk_callreasoncategory  a 
					WHERE a.CallReasonCategoryFlags=1
					AND a.CallReasonInterest <> 1");
	$qry = $this->db->query( $sql);
	if( $qry && $qry->num_rows() > 0 ) 
	foreach( $qry->result_assoc() as $row ){
		$result_array[$row['Id']] = sprintf("%s - %s", $row['Kode'], $row['Name']); 
	}
	return $result_array;
		
}	
 /**
  * [User]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
function _getAllCallDisposition( ){
	
	$cok = CK();
	
	$result_array = array();
	
	// query data untuk Process call status activitas di 
	// masing2 user group 
	
	$sql = sprintf("SELECT a.DS_CallCategoryId as ID,  b.CallReasonCategoryCode as Kode,  b.CallReasonCategoryName as Name
					FROM t_lk_calldisposition a
					LEFT JOIN t_lk_callreasoncategory b on a.DS_CallCategoryId = b.CallReasonCategoryId
					WHERE a.DS_CallUserGroup = '%s'
					AND b.CallReasonCategoryFlags = 1
					ORDER BY a.DS_CallUserSorter ASC ",  $cok->field('HandlingType') );
					
	$qry = $this->db->query($sql);
	if( $qry && $qry->num_rows() > 0 ) 
		foreach( $qry->result_assoc() as $row ){
		$result_array[$row['ID']] = sprintf("%s - %s", $row['Kode'], $row['Name']);	
	}
	
	// jika belum di setting maka ambil data yang all 
	if( count( $result_array ) ==0 ){
		foreach( $this->_getAllCallStatus() as $ID => $value){
			$result_array[$ID] = $value;
		}
	}
	return (array)$result_array;
	
}

/**
  * [User]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */  
function _getOutboundCategory()
{
	$_conds = array();
	$_conds = $this -> M_SetResultCategory->_getOutboundCategory();
	if( is_array($_conds) )
	{
		return $_conds;
	}
	else
		return null;
}	


/*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 * 
 */	
 
function _getInboundCategory()
{
	$_conds = array();
	$_conds = $this -> M_SetResultCategory->_getInboundCategory();
	if( is_array($_conds) )
	{
		return $_conds;
	}
	else
		return null;
}	

/*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 * 
 */	
 
// function _getComplaintCategory()
// {
	// $_conds = array();
	// $_conds = $this -> M_ComplaintCategory->_getComplaintCategory();
	// if( is_array($_conds) )
	// {
		// return $_conds;
	// }
	// else
		// return null;
// }	

/*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 * 
 */	
function _getGender()
{
	$_conds = array();
	$this ->db->reset_select();
	$this -> db -> select('GenderId,Gender');
	$this -> db -> from('t_lk_gender');
	foreach($this -> db ->get()->result_assoc() as $rows )
	{
		$_conds[$rows['GenderId']] = $rows['Gender'];
	}
	
	return $_conds;
}	


/*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 * 
 */
function _getCallResultInbound()
{ 
	$_conds = array();
	$this ->db->reset_select();
	$this -> db -> select("a.CallReasonId,a.CallReasonDesc"); 
	$this -> db -> from("t_lk_callreason  a ");
	$this -> db -> join("t_lk_callreasoncategory b ","a.CallReasonCategoryId=b.CallReasonCategoryId","LEFT");
	$this -> db -> join("t_lk_outbound_goals c ","b.CallOutboundGoalsId=c.OutboundGoalsId","LEFT");
	$this -> db -> where("c.Name","inbound");
	
	foreach($this -> db ->get()->result_assoc() as $rows )
	{
		$_conds[$rows['CallReasonId']] = $rows['CallReasonDesc'];
	}
	
	return $_conds;
}	



/*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 * 
 */
function _getCallResultOutbound()
{ 
	$_conds = array();
	$this ->db->reset_select();
	$this -> db -> select("a.CallReasonId,a.CallReasonDesc"); 
	$this -> db -> from("t_lk_callreason  a ");
	$this -> db -> join("t_lk_callreasoncategory b ","a.CallReasonCategoryId=b.CallReasonCategoryId","LEFT");
	$this -> db -> join("t_lk_outbound_goals c ","b.CallOutboundGoalsId=c.OutboundGoalsId","LEFT");
	$this -> db -> where("c.Name","outbound");
	
	foreach($this -> db ->get()->result_assoc() as $rows )
	{
		$_conds[$rows['CallReasonId']] = $rows['CallReasonDesc'];
	}
	
	return $_conds;
}	


/*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 * 
 */
function _getPaymentMode()
{
	$_conds = array();
	$this ->db->reset_select();
	$this -> db -> select('PayModeId, PayMode');
	$this -> db -> from('t_lk_paymode');
	foreach($this -> db ->get()->result_assoc() as $rows )
	{
		$_conds[$rows['PayModeId']] = $rows['PayMode'];
	}
	
	return $_conds;
}	
/*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 * 
 */
// function _getScoreStatus()
// {
	// $_conds = array();
	// $this -> db -> select('ScoreId, ScoreName');
	// $this -> db -> from('t_lk_score_status');
	// $this -> db -> where('ScoreFlags',1);
	
	// foreach($this -> db ->get()->result_assoc() as $rows )
	// {
		// $_conds[$rows['ScoreId']] = $rows['ScoreName'];
	// }
	
	// return $_conds;
// }
/*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 * 
 */
function _getPaymentType()
{
	$_conds = array();
	$this ->db->reset_select();
	$this -> db -> select('PaymentTypeId, PaymentTypeDesc');
	$this -> db -> from('t_lk_paymenttype');
	$this -> db -> where('Active',1);
	
	foreach($this -> db ->get()->result_assoc() as $rows )
	{
		$_conds[$rows['PaymentTypeId']] = $rows['PaymentTypeDesc'];
	}
	
	return $_conds;
}	
/*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 * 
 */
function _getCardType()
{
	$_conds = array();
	$this ->db->reset_select();
	$this -> db -> select('CardTypeId, CardTypeDesc');
	$this -> db -> from('t_lk_cardtype');
	foreach($this -> db ->get()->result_assoc() as $rows )
	{
		$_conds[$rows['CardTypeId']] = $rows['CardTypeDesc'];
	}
	
	return $_conds;
}
/*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 * 
 */
function _getPremiGroup()
{
	$_conds = array();
	$this ->db->reset_select();
	$this -> db -> select('PremiumGroupId,PremiumGroupDesc');
	$this -> db -> from('t_lk_premiumgroup');
	foreach($this -> db ->get()->result_assoc() as $rows )
	{
		$_conds[$rows['PremiumGroupId']] = $rows['PremiumGroupDesc'];
	}
	
	return $_conds;
}
/*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 * 
 */
function _getBank()
{
	$_conds = array();
	$this ->db->reset_select();
	$this -> db -> select('BankId,BankName');
	$this -> db -> from('t_lk_bank');
	$this -> db -> where('BankStatusFlag',1);
	
	foreach($this -> db ->get()->result_assoc() as $rows )
	{
		$_conds[$rows['BankId']] = $rows['BankName'];
	}
	
	return $_conds;
}

/*
 * @ def 	: _getOrderStatus
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 * 
 */
// function _getOrderStatus()
// {
	// $_conds = array();
	// $this -> db -> select('OrderStatusId, StatusName');
	// $this -> db -> from('t_lk_order_status');
	// foreach($this -> db ->get()->result_assoc() as $rows )
	// {
		// $_conds[$rows['OrderStatusId']] = $rows['StatusName'];
	// }
	
	// return $_conds;
// }


/*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 * 
 */
function _getProvince()
{
	$_conds = array();
	$this ->db->reset_select();
	$this -> db -> select('ProvinceId, Province');
	$this -> db -> from('t_lk_province');
	foreach($this -> db ->get()->result_assoc() as $rows )
	{
		$_conds[$rows['ProvinceId']] = $rows['Province'];
	}
	
	return $_conds;
}

/*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 * 
 */
function _getRealtionship()
{
	$_conds = array();
	$this ->db->reset_select();
	$this -> db -> select('RelationshipTypeId, RelationshipTypeDesc');
	$this -> db -> from('t_lk_relationshiptype');
	$this -> db -> where('RelationshipTypeFlags',1);
	
	foreach($this -> db ->get()->result_assoc() as $rows )
	{
		$_conds[$rows['RelationshipTypeId']] = $rows['RelationshipTypeDesc'];
	}
	
	return $_conds;
}
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  function _getCardVarianId(){
	  $resultArray = array();
	  $sql = sprintf(" select a.CAF_Id, a.CAF_Kode, a.CAF_Flags from t_lk_cardvarian a order by a.CAF_Sort %s", "ASC");
	  $qry = $this->db->query($sql);
	  if( $qry && $qry->num_rows()> 0 ) 
	  foreach( $qry->result_assoc() as $row  ){
			$resultArray[$row['CAF_Id']] = $row['CAF_Kode'];
	  }
	  // resultArray:
	  return (array)$resultArray;
  }


  function _getProgramDetailTenor( $Penawaran = ''){
	$result_array = array();
	$sql = sprintf("select a.PRD_Data_Id as Kode, a.PRD_Data_Value as Name,a.PRD_Data_Tenor AS Tenor
					from t_lk_program_detail a 
					where a.PRD_Data_Kode ='%s'
					and a.PRD_Data_Status = 1 
					order by a.PRD_Data_Sort ASC  ", $Penawaran);
	$qry = $this->db->query($sql);
	if( $qry && $qry->num_rows() > 0 ) 
		foreach( $qry->result_assoc() as $row ){
		$res= explode (",",$row['Tenor']);
		
	}	
	foreach($res as $t){
		$result_array[$t] = sprintf("%s", $t);	
	}
  
	return (array)$result_array;	
} 

  
   /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  function _getStateTypeKode(){
	  $resultArray = array();
	  $sql = sprintf(" select a.ST_Kode, a.ST_Name 
				from t_lk_state_type a order by a.ST_Sort %s", "ASC");
	  $qry = $this->db->query($sql);
	  if( $qry && $qry->num_rows()> 0 ) 
	  foreach( $qry->result_assoc() as $row  ){
			$resultArray[$row['ST_Kode']] = $row['ST_Name'];
	  }
	  // resultArray:
	  return (array)$resultArray;
  }

  function _getProgramDetailbalconTenor( $Penawaran = ''){
	$result_array = array();
	$sql = sprintf("SELECT a.PRD_Data_Id AS Kode,a.PRD_Data_Tenor AS Tenor, a.PRD_Data_Value AS Name
	FROM t_lk_program_detail a
	WHERE a.PRD_Data_Status = 1 
	AND a.PRD_Data_Master= 'BALCON'
	ORDER BY a.PRD_Data_Sort ASC");
	$qry = $this->db->query($sql);
	if( $qry && $qry->num_rows() > 0 ) 
		foreach( $qry->result_assoc() as $row ){
		$result_array[$row['Kode']] = sprintf("%s", $row['Tenor']);	
		//$result_array[$row['Tenor']] = sprintf("%s", $row['Name']);	
		//$result_array[$row['Kode']] = sprintf("%s", $row['Name']);	
	}	
	// var_dump($result_array);
	// die;
	return (array)$result_array;	
} 

/**
  * [User]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */  
function _getRealtionshipKode()
{
	$_conds = array();
	$this->db->reset_select();
	$this->db->select('RelationshipTypeCode, RelationshipTypeDesc');
	$this->db->from('t_lk_relationshiptype');
	$this->db->where('RelationshipTypeFlags',1);
	
	$qry = $this->db->get();
	foreach($qry->result_assoc() as $rows ){
		$_conds[$rows['RelationshipTypeCode']] = $rows['RelationshipTypeDesc'];
	}
	
	return $_conds;
}
/*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 * 
 */
function _getSalutation()
{
	$_conds = array();
	$this ->db->reset_select();
	$this ->db-> select('SalutationId, Salutation');
	$this ->db->from('t_lk_salutation');
	foreach($this -> db ->get()->result_assoc() as $rows )
	{
		$_conds[$rows['SalutationId']] = $rows['Salutation'];
	}
	
	return $_conds;
}

/*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 * 
 */
function _getProductCurrency()
{
	$_conds = array();
	try 
	{
		$this ->db->reset_select();
		$this ->db-> select('CurrId, CurrCode, CurrName', false);
		$this ->db->from('t_lk_currency');
		$rs = $this ->db->get();
		foreach($rs->result_assoc() as $rows ) {
			$_conds[$rows['CurrCode']] = "{$rows['CurrCode']} - {$rows['CurrName']}";
		}
		return $_conds;
	} catch( Exception $e ){
		return array();
	}	
}
/*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 * 
 */
 
function _getProductType()
{
	$_conds = array();
	$this ->db->reset_select();
	$this ->db-> select('ProductTypeId, ProductFormJs');
	$this ->db->from('t_lk_producttype');
	foreach($this -> db ->get()->result_assoc() as $rows )
	{
		$_conds[$rows['ProductTypeId']] = $rows['ProductFormJs'];
	}
	
	return $_conds;
}

 /*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
function _getProgramDetail( $Penawaran = ''){
	$result_array = array();
	$sql = sprintf("select a.PRD_Data_Id as Kode, a.PRD_Data_Value as Name
					from t_lk_program_detail a 
					where a.PRD_Data_Kode ='%s'
					and a.PRD_Data_Status = 1 
					order by a.PRD_Data_Sort ASC ", $Penawaran);
	
	$qry = $this->db->query($sql);
	if( $qry && $qry->num_rows() > 0 ) 
		foreach( $qry->result_assoc() as $row ){
		$result_array[$row['Kode']] = sprintf("%s", $row['Name']);	
	}	
	return (array)$result_array;	
} 
 /*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
 
function _getProductScript( $ProductId = 0 ){ 
$result_array = array();

 $this->db->reset_select();
 $this->db->select('*', false);
 $this->db->from('t_gn_product_script a');
 $this->db->where('a.ScriptFlagStatus', 1);
 if( $ProductId ){
	$this->db->where('a.ProductId', $ProductId);
	}
	
// get source 
$this->db->order_by('a.Description','ASC');
$qry = $this->db->get();
if( !$qry )	{
	exit(mysql_error());
}
// tehnget of source data; 
 if( $qry->num_rows() > 0 ) 
 foreach( $qry->result_record() as $row ){
	$result_array[$row->field('ScriptId')] = $row->field('Description', 'strtoupper');
 }
 // return of client method.
 return (array)$result_array;

}


/*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 * 
 */
 
 public function _getPhoneType() 
{
	if( !class_exists('M_PhoneType') ){
		return array();
	} 
	
	return get_class_instance('M_PhoneType')->_getPhoneTypeList();
}


/*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 * 
 */
 
function _getProductTypeName()
{
 $arr_product_type = array();
 if( !class_exists('M_SetProduct') ){
	return $arr_product_type;
 }	
 $arr_product_type =& get_class_instance('M_SetProduct')->_getProductTypeName();
 return $arr_product_type;
}



/*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 * 
 */
function _getDirectionType()
{
	$_conds = array();
	$this -> db -> select('ActionCode,ActionName');
	$this -> db -> from('t_lk_direction_action');
	foreach($this -> db ->get()->result_assoc() as $rows ){
		$_conds[$rows['ActionCode']] = $rows['ActionName'];
	}
	
	return $_conds;
}
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
function _getUserTelemarketing()
{
	$_conds = array();
	if(class_exists('M_SysUser')){
		$_conds = $this ->M_SysUser->_get_teleamarketer();
	}
	
	return $_conds;
}
 
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
function _getUserDetail( $UserId = 0 ){
	$result_array = array();
	
	$sql = sprintf(" SELECT a.*,
					 ( SELECT ts.id FROM tms_agent ts WHERE ts.UserId = a.admin_id ) AS admin_kode,
					 ( SELECT ts.id FROM tms_agent ts WHERE ts.UserId = a.act_mgr ) AS amgr_kode,
					 ( SELECT ts.id FROM tms_agent ts WHERE ts.UserId = a.mgr_id ) AS mgr_kode,
					 ( SELECT ts.id FROM tms_agent ts WHERE ts.UserId = a.spv_id ) AS spv_kode,
					 ( SELECT ts.id FROM tms_agent ts WHERE ts.UserId = a.tl_id ) AS leader_kode
				    FROM tms_agent a 
				    WHERE a.UserId='%s'", $UserId);
				   
	$qry = $this->db->query( $sql );
	if( $qry && $qry->num_rows() > 0 ){
		$result_array = $qry->result_first_assoc();
	}
	return Objective( $result_array );
}

 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
function _getUser()
{
	$_conds = array();
	if(class_exists('M_SysUser')){
		$_conds = $this ->M_SysUser->_get_teleamarketer();
	}
	
	return $_conds;
}

 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
function _getAdminFollowup(){
	return $this->M_SysUser->_get_admin_followup();
}

 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
function _getAdminFollowupLogin(){
	return $this->M_SysUser->_get_admin_followup_login( );
}

 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */

function _getSessionPrivilege(){
	

// debug(CK());
 $CK =& CK();
 
	$result_array = array();
	
	$this->db->reset_select();
	$this->db->select('a.id, a.name', false);
	$this->db->from('tms_agent_profile a');
	$this->db->where('a.IsActive', 1);
	
// get handling_type 
// handling_type "USER_ROOT"	
	if( $CK->cookie(array(USER_ROOT) ) ){
		$this->db->where('a.level_group>=0', '', false);
	}
	
// handling_type "USER_SUPERVISOR"	
	else if( $CK->cookie(array(USER_GENERAL_MANAGER) ) ){
		$this->db->where_in('a.id', array( USER_ACCOUNT_MANAGER,
										   USER_MANAGER, 
										   USER_SUPERVISOR, 
										   USER_AGENT_OUTBOUND));
	}
	
	
// handling_type "USER_SUPERVISOR"	
	else if( $CK->cookie(array(USER_SUPERVISOR) ) ){
		$this->db->where_in('a.id', array(USER_AGENT_OUTBOUND));
	}
	
	else{
		$this->db->where( sprintf('a.level_group>%s', $CK->field('GroupLevel') ), '', false);
	}
	
	$this->db->order_by('a.level_group', 'ASC');
	//$this->db->print_out();
	$qry = $this->db->get();  
    if( $qry && $qry->num_rows() > 0 ) 
	foreach( $qry->result_assoc() as $row ){
		$result_array[$row['id']] = sprintf('%s', $row['name']);
	} 
	
	return (array)$result_array;
}  
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */

function _getAllUser() {
	$_conds = array();
	if(class_exists('M_SysUser')){
		$_conds = $this ->M_SysUser->_get_select_all_user();
	}
	
	return $_conds;
}

// get _getProduct 

function _getProduct()
{
	$_conds = array();
	if(class_exists('M_SetProduct')){
		$Product = $this -> M_SetProduct -> _getProductId();
		foreach($Product as $keys => $rows )
		{
			$_conds[$keys] = $rows['name'];
		}
	}
	
	return $_conds;
}


/**
  * [Product]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
function _getProductIDByCampaignId( $CampaignId = 0 ) {
	
	$result_array = array();
	
	$sql = "select a.CampaignId, a.ProductId from t_gn_campaignproduct a";
	$qry = $this->db->query( $sql );
	if( $qry and $qry->num_rows() > 0 ) 
	foreach( $qry->result_assoc() as $row ) {
		$result_array[$row['CampaignId']] = $row['ProductId'];	
	}
	return (array)$result_array;
}

// get _getProduct 
function _getProductName()
{
	$_conds = array();
	
	if(class_exists('M_SetProduct')){
		$Product = $this -> M_SetProduct -> _getProductId();
		foreach($Product as $keys => $rows )
		{
			$_conds[$keys] = $rows['code'];
		}
	}
	
	return $_conds;
}

// get _getProduct 
function _getProductCode()
{
	$_conds = array();
	
	if(class_exists('M_SetProduct')){
		$Product = $this -> M_SetProduct -> _getProductId();
		foreach($Product as $keys => $rows )
		{
			$_conds[$rows['code']] = $rows['code'];
		}
	}
	
	return $_conds;
}

// get product kode BY Id 
function _getProductCodeById( $ProductId = 0 ){
	
	$result_product_kode = 0;
	$sql = sprintf(" select a.ProductCode from t_gn_product_master  a 
					 where a.ProductId = '$ProductId'  
					 and a.ProductStatusFlag = 1", 
					 $ProductId );
					
	$qry = $this->db->query($sql);
	if( $qry && $qry->num_rows() > 0 ){
		$result_product_kode = $qry->result_singgle_value();
	}
	
 // return callback data Process OK 
	return $result_product_kode;
	
}



// get _getCampaign 

function _getCampaign()
{
	$_conds = array();
	if( class_exists('M_SetCampaign')) {
		$_conds = $this->M_SetCampaign->_get_campaign_name();
		
		
	}
	return $_conds;
}


// get _getCallResult 

function _getCallResult()
{
	$_conds = array();
	
	if( class_exists('M_SetCallResult') ){
		$_list = $this->M_SetCallResult->_getCallReasonId(null);
		
		if( is_array($_list) ) 
		{
			foreach($_list as $k => $rows )
			{
				$_conds[$k] = $rows['name'];
			}
		}
	}
	
	return $_conds;
}


 /**
  * [CallResultByCategory]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
function _getCallResultByCategory( $cetegoryId = 0 )
{
	$result_array = array();
	$result_assoc = $this->M_SetCallResult->_getCallReasonId( $cetegoryId );
	if(is_array( $result_assoc ))  foreach( $result_assoc as $key => $row ) {
		$result_array[$key] = sprintf("%s - %s", $row['code'], $row['name'] );
	}
	return (array)$result_array;
}

/**
  * [CallResultByCategory]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
function _getCallResultByCategoryRekontest( $cetegoryId = 0 )
{
	$result_array = array();
	$result_assoc = $this->M_SetCallResult->_getCallReasonIdRekontest( $cetegoryId );
	if(is_array( $result_assoc ))  foreach( $result_assoc as $key => $row ) {
		$result_array[$key] = sprintf("%s - %s", $row['code'], $row['name'] );
	}
	return (array)$result_array;
}

// get approval status 

function _getQualityResult()
{
	$_conds = array();
	if( class_exists('M_SetResultQuality') ){
		$_list = $this->M_SetResultQuality->_getQualityResult();
		if( is_array($_list) ) 
		{
			foreach($_list as $k => $rows )
			{
				$_conds[$k] = $rows['name'];
			}
		}
	}
	
	return $_conds;
}


/*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 * 
 */
 function _getSerialize()
 {
	$data = array();
	$list = get_class_methods($this);
	foreach($list as $key => $Method )
	{
		$_key= substr($Method,4,strlen($Method));
		$data[$_key] = $Method;
	}
	
	return $data;
 }
 
/*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 * 
 */
 
 function _getIdentification()
 {
	$_conds = array();
	$this ->db->reset_select();
	$this -> db -> select('*');
	$this -> db -> from('t_lk_identificationtype');
	foreach($this -> db ->get()->result_assoc() as $rows )
	{
		$_conds[$rows['IdentificationTypeId']] = $rows['IdentificationType'];
	}
	
	return $_conds;
	
 }	
  
/*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 * 
 */
  
 function _getBillingAddress()
 {
	$_conds = array();
	$this ->db->reset_select();
	$this->db->select('BilingId, BilingDescription');
	$this->db->from('t_lk_billingaddress');
	$this->db->where('BilingFlagsStatus',1);
	
	foreach($this -> db ->get()->result_assoc() as $rows )
	{
		$_conds[$rows['BilingId']] = $rows['BilingDescription'];
	}
	
	return $_conds;
	
 } 
 
/*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 * 
 */
 
// function _getComplaintStatus()
// {
	// $_conds = array();
	// $this->db->select('a.id, a.StatusName');
	// $this->db->from('t_lk_complaint_status a');
	// $this->db->where('a.flags',1);
	
	// foreach($this -> db ->get()->result_assoc() as $rows )
	// {
		// $_conds[$rows['id']] = $rows['StatusName'];
	// }
	
	// return $_conds;
	
// }
 
/*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 * 
 */
 
 
  function _getCallDirection()
 {
	$_conds = array();
	$this ->db->reset_select();
	$this->db->select('OutboundGoalsId, Description');
	$this->db->from('t_lk_outbound_goals');
	$this->db->where('Flags',1);
	
	foreach($this -> db ->get()->result_assoc() as $rows )
	{
		$_conds[$rows['OutboundGoalsId']] = $rows['Description'];
	}
	
	return $_conds;
	
 } 
 
  
 
/*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 * 
 */
 
 
  function _getAgentGroup()
 {
	$_conds = array();
	$this ->db->reset_select();
	$this->db->select('id, description');
	$this->db->from('cc_agent_group');
	$this->db->where('status_active',1);
	
	foreach($this -> db ->get()->result_assoc() as $rows )
	{
		$_conds[$rows['id']] = $rows['description'];
	}
	
	return $_conds;
	
 }  

 
/*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 * 
 */
 
 
  function _getAgentId()
 {
	$_conds = array();
	$this ->db->reset_select();
	$this->db->select('a.id, a.name');
	$this->db->from('cc_agent a');
	$this->db->join('tms_agent b', 'a.userid = b.id','INNER');
	
    if( in_array( _get_session('UserId'), array(USER_ROOT) )) {	
		$this->db->where('b.handling_type IS NOT NULL',"", FALSE);
    } else{
		$this->db->where_not_in('b.handling_type', array(USER_ROOT));
	}
	
	$this->db->order_by('a.name', 'ASC');
	foreach($this -> db ->get()->result_assoc() as $rows )
	{
		$_conds[$rows['id']] = $rows['name'];
	}
	
	return $_conds;
	
 }
 
 
/*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 * 
 */
  function _getProductPlanName( $ProductId = null )
 {
	$arr_data = array();
	
	$this->db->reset_select();
	$this->db->select(
		"a.ProductPlan, 
		IF(b.ProductPlanName IS NULL, a.ProductPlanName, b.ProductPlanName) as ProductPlanName", FALSE);
	$this->db->from("t_gn_productplan a");
	$this->db->join("t_gn_plan_name b ","a.ProductPlan=b.ProductPlanId AND a.ProductId=b.ProductId", "LEFT");
	
	 if( !is_null($ProductId) ) {
		$this->db->where("a.ProductId", $ProductId);
	 }
	 
	$this->db->group_by("a.ProductPlanName");
	$this->db->order_by("a.ProductPlanName", "ASC");
	$rs = $this->db->get();
	
	if( mysql_errno() ){
		return array();
	}
	
	if( $rs->num_rows() > 0 ) 
		foreach( $rs->result_assoc() as $rows ) {
		$arr_data[$rows['ProductPlan']] = $rows['ProductPlanName']; 	
	}
	return (array)$arr_data;
 }
 
 
 
 /*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 * 
 */
 function _getUserPrivilege()
{
	$arr_user_privileges = array();
	$this->db->reset_select();
	$this->db->select("a.id, a.name ");
	$this->db->from("tms_agent_profile a ");
	$this->db->where("a.IsActive", 1);
	$this->db->order_by("a.level_group", "ASC");
	
	$rs = $this->db->get();
	if( $rs -> num_rows() > 0 ) 
		foreach( $rs->result_assoc() as $rows ) 
	{
		$arr_user_privileges[$rows['id']] = $rows['name'];	
	}
	return (array)$arr_user_privileges;
 }
 
 /*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 * 
 */
 function _getCallResultTransfer()
{
  if( class_exists('M_SetCallResult') )
 {
	 $out =& get_class_instance('M_SetCallResult');
	 return $out->_getCallResultTransfer();
  } else{
	  return array();
  }
  
}
 /*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 * 
 */
 
 function _getQualityScoreStaff()
{
  //
  $arr_quality_score_register = array();
  
  $this->load->model(array('M_SysUser','M_QtySetAgent'));	
  
 //--------- instance of class ------------------------------
 
  $User =& get_class_instance('M_SysUser');
  $Quality = & get_class_instance('M_QtySetAgent');
  
 // -------------------------------------------------------------
   $arr_all_quality  =& $User->_get_quality_staff();
   $arr_reg_quality = & $Quality->_select_row_quality_score_register();
  
 // ---------- return -----------------
	if( is_array( $arr_all_quality ) )
		foreach( $arr_all_quality as $UserId => $val )
	{
		if( @in_array( $UserId, $arr_reg_quality))
		{
			$arr_quality_score_register[$UserId] = $val;
		}		
	}
	
	return (array)$arr_quality_score_register;
}


 /*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 * 
 */
 
 function _getQualityAllStaff()
{
  //
  $arr_all_quality = array();
  
  $this->load->model(array('M_SysUser'));	
  
 //--------- instance of class ------------------------------
 
  $User =& get_class_instance('M_SysUser');
  $Quality = & get_class_instance('M_QtySetAgent');
  
 // -------------------------------------------------------------
  $arr_all_quality  =& $User->_get_quality_staff();
  return (array)$arr_all_quality;
}

/*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 * 
 */
 
 function _getTeamLeader()
{
  //
  $arr_all_spv = array();
  
  $this->load->model(array('M_SysUser'));	
  
 //--------- instance of class ------------------------------
 
  $User =& get_class_instance('M_SysUser');
  
 // -------------------------------------------------------------
  $arr_all_spv  =& $User->_get_teamleader();
  return (array)$arr_all_spv;
}


 function _getATMTeamLeader()
{
  //
  $arr_all_spv = array();
  
  $this->load->model(array('M_SysUser'));	
  
 //--------- instance of class ------------------------------
 
  $User =& get_class_instance('M_SysUser');
  
 // -------------------------------------------------------------
  $arr_all_spv  =& $User->_get_atmleader();
  return (array)$arr_all_spv;
}



 /*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 * 
 */
 function _getLayoutThemes()
{
  $this->load->model(array('M_SysThemes'));	
  if( class_exists('M_SysThemes') )
 {
	 return $this->M_SysThemes->_getUserThemes();
  } else{
	  return array();
  }
  
}
 /*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 * 
 */
 function _getQualitySkill()
{
  $this->load->model(array('M_QtyStaffGroup'));	
  if( class_exists('M_QtyStaffGroup') )
 {
	 return $this->M_QtyStaffGroup->_getStaffSkill();
  } else{
	  return array();
  }
  
}
/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
function _getAdditionalPhone( $CustomerId = 0 )
{ 
  $arr_result = array();
  $this->db->reset_select();
  $this->db->select("a.AddPhoneNumber, a.AddPhoneNumber, b.PhoneDesc, b.PhoneKode", FALSE);
  $this->db->from("t_gn_addphone  a ");
  $this->db->join("t_lk_phonetype b ","a.AddPhoneType=b.PhoneType", "LEFT");
  $this->db->where("a.CustomerId", $CustomerId);
  //$this->db->print_out();
  
  $rs = $this->db->get();
  if( $rs && $rs->num_rows() > 0 ) 
  foreach($rs->result_record() as $row ){  
	  $arr_result[$row->field('AddPhoneNumber','base64_encode')] = sprintf("%s - %s", $row->field('PhoneKode'), $row->field('AddPhoneNumber','SetMasking'));
	  // join(" ", array($rows['PhoneKode'], _setMasking($rows['AddPhoneNumber'])));
  }
  
  return (array)$arr_result;
  
}

/*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 * 
 */
function _getAllUserIdByLevelLogin( $level = null )
{
	//
  $arr_all_spv = array();
  
  $this->load->model(array('M_SysUser'));	
  
 //--------- instance of class ------------------------------
 
  $User =& get_class_instance('M_SysUser');
 // -------------------------------------------------------------
  $arr_all_spv  =& $User->_getUserLevelGroup( $level );
  return (array)$arr_all_spv;
  
}



 /*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 * 
 */
function _getAllUserIdByLevel( $level = null )
{
	//
  $arr_all_spv = array();
  
  $this->load->model(array('M_SysUser'));	
  
 //--------- instance of class ------------------------------
 
  $User =& get_class_instance('M_SysUser');
 // -------------------------------------------------------------
  $arr_all_spv  =& $User->_select_row_user_id_by_level( $level );
  return (array)$arr_all_spv;
  
}

// ---------------------------------------------------------------------
/*
 * @ package : list on Minute 
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 * 
 */
public function _getListHour()
{
  $arr_list_hour = array();	
  $start_hour = 0;  $end_hour = 24;
  for( $i = 0; $i<=$end_hour; $i++)
  {
	  $list_val = "";
	  if( strlen($i) == 1 ){
		  $list_val ="0$i"; 
	  } else {
		  $list_val ="$i";
	  }
	  
	  $arr_list_hour[(string)$list_val] = (string)$list_val;
  }  
  return (array)$arr_list_hour;
  
} 

// ---------------------------------------------------------------------
/*
 * @ package : list on Minute 
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 * 
 */
public function _getListMinute()
{
  $arr_list_hour = array();	
  $start_hour = 0;  $end_hour = 60;
  for( $i = 0 ; $i<=$end_hour; $i++)
  {
	  $list_val = "";
	  if( strlen($i) == 1 ){
		  $list_val ="0$i"; 
	  } else {
		  $list_val ="$i";
	  }
	  
	  $arr_list_hour[(string)$list_val] = (string)$list_val;
  }  
  return (array)$arr_list_hour;
  
}


// ------------- get Group Premi ----------------------
function _getProductGroupPremi( $ProductId = 0 )
{
	$arr_product_group_premi = array();
	
	$this->db->reset_select();
	$this->db->select("b.PremiumGroupId, b.PremiumGroupDesc", FALSE);
	$this->db->from("t_gn_productplan a ");
	$this->db->join("t_lk_premiumgroup b "," a.PremiumGroupId=b.PremiumGroupId", "LEFT");
	$this->db->where("a.ProductId", (int)$ProductId);
	$this->db->group_by("a.PremiumGroupId");
	$this->db->order_by("b.PremiumGroupOrder", "ASC");
	
	//echo $this->db->print_out();
	
	$rs = $this->db->get();
	if( $rs->num_rows() > 0 ) foreach( $rs ->result_assoc() as $rows )
	{
		$arr_product_group_premi[$rows['PremiumGroupId']] = ucwords($rows['PremiumGroupDesc']);
	}
	
	return (array)$arr_product_group_premi;
}

// ------------ get Gender by Product -------------------

function _getProductGender( $ProductId = 0 )	
{
	$arr_product_gender = array();
	$this->db->reset_select();
	$this->db->select("b.GenderId, b.Gender", FALSE);
	$this->db->from("t_gn_productplan a ");
	$this->db->join("t_lk_gender b "," a.GenderId=b.GenderId", "LEFT");
	$this->db->where("a.ProductId", (int)$ProductId);
	$this->db->group_by("a.GenderId");
	$this->db->order_by("b.GenderId", "ASC");
	
	$rs = $this->db->get();
	if( $rs->num_rows() > 0 ) foreach( $rs ->result_assoc() as $rows )
	{
		$arr_product_gender[$rows['GenderId']] = ucfirst(strtolower($rows['Gender']));
	}
	
	return (array)$arr_product_gender;
	
}


// ------- update on here ------------------
// ------------ get Gender by Product -------------------

 function _getQualityStatus()	
{
 $arr_quality_status = array();
 $this->db->reset_select();
 $this->db->select("a.ApproveId, a.AproveName,
	( SELECT COUNT(ts.ApproveId) from t_lk_aprove_status  ts where ts.ApproveParent = a.ApproveId ) as tot ", 
	FALSE);
	
 $this->db->from("t_lk_aprove_status a");
 $this->db->where("a.AproveFlags", 1);
 $this->db->where("a.ApproveParent",0);
 
	
/*	
 $this->db->from("t_lk_aprove_status a");
 $this->db->where("a.AproveFlags", 1);
 $this->db->having("tot", 0);
 
 */
 $rs = $this->db->get();
 if( $rs->num_rows() > 0 ) 
	 foreach( $rs ->result_assoc() as $rows ) 
 {
	$arr_quality_status[$rows['ApproveId']] = ucfirst(strtolower($rows['AproveName']));
 }
	
	return (array)$arr_quality_status;
	
}


// ------------ get Gender by Product -------------------

 function _getQualityParentStatus( $QualityId = 0 )	
{
 $arr_quality_status = 0;
 $this->db->reset_select();
 $this->db->select("(select qta.ApproveId from t_lk_aprove_status qta where qta.ApproveId=a.ApproveParent ) as ApproveId", FALSE);
 $this->db->from("t_lk_aprove_status a");
 $this->db->where("a.AproveFlags", 1);
 $this->db->where("a.ApproveId", $QualityId);
 $rs = $this->db->get();
 if( $rs->num_rows() > 0 ) 
{
	$arr_quality_status  = $rs->result_singgle_value();
 }
 
 if( $arr_quality_status == 0 ){
  return (int)$QualityId;
 }	
  return (int)$arr_quality_status;
	
}


// ------------ get mail status -------------------

 function _getMailStatus()
{
 $arr_mail_status = array();
 
 $this->db->reset_select();
 $this->db->select("*", FALSE);
 $this->db->from("egs_status_refference");
 $this->db->where("EmailStatusFlags",1);
 
 $rs = $this->db->get();
 if( $rs->num_rows() > 0 ) 
	 foreach( $rs->result_assoc() as $rows )
 {
	$arr_mail_status[$rows['EmailStatusCode']] =  $rows['EmailStatusName'];
 }
 
 return (array)$arr_mail_status;
 
}

// ------------ get Gender by Product -------------------

function _getQualityReason( $ParentId = null )	
{
 
 $arr_quality_status = array();
 $this->db->reset_select();
 $this->db->select("a.ApproveId, a.AproveName ", FALSE);
 $this->db->from("t_lk_aprove_status a");
 $this->db->where_not_in("a.ApproveParent",array(0));
 if( !is_null( $ParentId) 
	AND $ParentId >  0 )
 {
	$this->db->where("a.ApproveParent",$ParentId);
 }
 $rs = $this->db->get();
 if( $rs->num_rows() > 0 ) 
	 foreach( $rs ->result_assoc() as $rows ) 
 {
	$arr_quality_status[$rows['ApproveId']] = $rows['AproveName'];
 }
	
 return (array)$arr_quality_status;
 
}

// ------------ get Gender by Product -------------------

function _getQualitySuspend( $ParentId = null )	
{
 $Quality =& get_class_instance('M_SetResultQuality');
 return (array)$arr_quality_status;
 
}

// ------------ get Gender by Product -------------------

 function _getCtiSkill()
{
  $objClass =& get_class_instance('M_CtiSkill');
  return (array)$objClass->getSelectSkillUser(); 	
}



// ------------ get Gender by Product -------------------

 function _getCallDuration( $CustomerId = null )	
{
  
  $duration = 0;
  $this->db->reset_select();
  $this->db->select("SUM(a.duration) as Duration",false);
  $this->db->from("cc_recording a ");
  $this->db->where("a.assignment_data", $CustomerId);
  $this->db->group_by("a.assignment_data");
	
  $rs = $this->db->get();
  if( $rs->num_rows() > 0 ){
	$duration = $rs->result_singgle_value();
  }
  
  if(function_exists('_getDuration') ){
	return ( $duration ? _getDuration($duration) : '00:00:00');
  } else {
	  return ( $duration ? $duration : '00:00:00');
  }
}


// ------------- get Group Gender ------------------------
 function _getFieldValue()
{
	$arr_value = array();
	$this->db->reset_select();
	$this->db->select("a.ConfigName, a.ConfigValue", FALSE);
	$this->db->from("t_lk_configuration a ");
	$this->db->where("a.ConfigCode", "FLT_VALUE_DATA");
	$this->db->where("a.ConfigFlags", 1);
	$rs = $this->db->get();
	if( $rs->num_rows() > 0 ) 
		foreach( $rs->result_assoc() as $rows )
	{
		$arr_value[$rows['ConfigName']] = lang($rows['ConfigValue']);
	}
	
	return $arr_value;
}


// ------------- get Group Gender ------------------------

 function _getFilterValue()
{
	$arr_value = array();
	$this->db->reset_select();
	$this->db->select("a.ConfigName, a.ConfigValue", FALSE);
	$this->db->from("t_lk_configuration a ");
	$this->db->where("a.ConfigCode", "FLT_FIELD_DATA");
	$this->db->where("a.ConfigFlags", 1);
	$rs = $this->db->get();
	if( $rs->num_rows() > 0 ) 
		foreach( $rs->result_assoc() as $rows )
	{
		$arr_value[$rows['ConfigName']] = $rows['ConfigValue'];
	}
	
	return $arr_value;
}

// ---------------- select call status Not In Interested data --> 
function _getCallResultNotInterest()
{
	
 $arr_value = array();	
 $this->db->reset_select();
 $this->db->select("a.CallReasonId, a.CallReasonDesc ", FALSE);
 $this->db->from("t_lk_callreason a ");
 $this->db->join("t_lk_callreasoncategory b ","a.CallReasonCategoryId=b.CallReasonCategoryId", "INNER");
 $this->db->where_not_in("b.CallReasonCategoryCode",array('600'));
 $this->db->where("a.CallReasonStatusFlag", 1);
// $this->db->print_out();
 
 $rs = $this->db->get();
 if( $rs->num_rows() > 0 ) 
	foreach( $rs->result_assoc() as $rows )
 {
	$arr_value[$rows['CallReasonId']] = $rows['CallReasonDesc'];
 }
	
 return $arr_value;
 
}



// ---------------- select call status Not In Interested data --> 

function _getCallResultNotInterestThinkingBadlead()
{
	
 $arr_value = array();	
 $this->db->reset_select();
 $this->db->select("a.CallReasonId, a.CallReasonDesc ", FALSE);
 $this->db->from("t_lk_callreason a ");
 $this->db->join("t_lk_callreasoncategory b ","a.CallReasonCategoryId=b.CallReasonCategoryId", "INNER");
 $this->db->where_not_in("b.CallReasonCategoryCode",array('600'));
 $this->db->where_not_in("a.CallReasonLater",array(1));
 $this->db->where_not_in("a.CallReasonNoMoreFU",array(1));
 $this->db->where("a.CallReasonStatusFlag", 1);
 $this->db->order_by("a.CallReasonDesc", "ASC");
 
 $rs = $this->db->get();
 if( $rs->num_rows() > 0 ) 
	foreach( $rs->result_assoc() as $rows )
 {
	$arr_value[$rows['CallReasonId']] = $rows['CallReasonDesc'];
 }
	
 return $arr_value;
 
}

// ---------------- select call status Not In Interested data --> 

function _getCallResultNotInterestBadlead()
{
	
 $arr_value = array();	
 $this->db->reset_select();
 $this->db->select("a.CallReasonId, a.CallReasonDesc ", FALSE);
 $this->db->from("t_lk_callreason a ");
 $this->db->join("t_lk_callreasoncategory b ","a.CallReasonCategoryId=b.CallReasonCategoryId", "INNER");
 $this->db->where_not_in("a.CallReasonCode",array('SA','PU','GPU','CPGP', 'INC','RPU'));
 $this->db->where_not_in("a.CallReasonNoMoreFU",array(1));
 $this->db->where("a.CallReasonStatusFlag", 1);
 $this->db->order_by("a.CallReasonDesc", "ASC");
 //$this->db->print_out();
 
 $rs = $this->db->get();
 if( $rs->num_rows() > 0 ) 
	foreach( $rs->result_assoc() as $rows )
 {
	$arr_value[$rows['CallReasonId']] = $rows['CallReasonDesc'];
 }
	
 return $arr_value;
 
}


// ---------------- select call status Not In Interested data --> 
//---------------------------------------------------------------------------------------

/* @ package 			: Dropdown Helper Attribute  
 *
 * @ Notes 				: View All Reference Data On All Modul 
 * @ param 				: uknown 
 * @ author				: uknown 
 */

 function _getEventUserCallStatus( $CallReasonId = "" , $CategoryId = NULL )
 {
	$ar_populate = array();

	if ( is_array($CallReasonId) ) {
		$this->db->reset_select();
		$this->db->select("a.CallReasonId, a.CallReasonDesc", FALSE);
		$this->db->from("t_lk_callreason a");
		$this->db->where_in("a.CallReasonId", $CallReasonId);
		
		if( !is_null($CategoryId) ){
			$this->db->where("a.CallReasonCategoryId", $CategoryId);
		}
		
		$rs = $this->db->get();
		

		if( $rs->num_rows() > 0 ) 
			foreach( $rs->result_assoc() as $rows )
		{
			$ar_populate[$rows['CallReasonId']] = $rows['CallReasonDesc'];
		}
		return (array)$ar_populate;
	}
 }
 

// ---------------- select call status Not In Interested data --> 

 function _getCallResultThinking()
{
 $arr_value = array();	
 $this->db->reset_select();
 $this->db->select("a.CallReasonId, a.CallReasonDesc ", FALSE);
 $this->db->from("t_lk_callreason a ");
 $this->db->where_in("a.CallReasonCode",array('CB', 'ST'));
 $this->db->where("a.CallReasonLater", 1);
 $this->db->where("a.CallReasonStatusFlag", 1);
 $this->db->order_by("a.CallReasonDesc", "ASC");
 
 $rs = $this->db->get();
 if( $rs->num_rows() > 0 ) 
	foreach( $rs->result_assoc() as $rows )
 {
	$arr_value[$rows['CallReasonId']] = $rows['CallReasonDesc'];
 }
	
 return $arr_value;
}



// ---------------- select call status Not In Interested data --> 

 function _getCallRequestPickup()
{
	
 $arr_value = array();	
 $this->db->reset_select();
 $this->db->select("a.CallReasonId, a.CallReasonDesc ", FALSE);
 $this->db->from("t_lk_callreason a ");
 $this->db->where_in("a.CallReasonCode",array('RPU','PU'));
 $this->db->where("a.CallReasonStatusFlag", 1);
 $this->db->order_by("a.CallReasonOrder", "ASC");
 
 $rs = $this->db->get();
 if( $rs->num_rows() > 0 ) 
	foreach( $rs->result_assoc() as $rows )
 {
	$arr_value[$rows['CallReasonId']] = $rows['CallReasonDesc'];
 }
	
 return $arr_value;
 
}


// ---------------- select call status Not In Interested data --> 
function _getCallResultInterest()
{
	
 $arr_value = array();	
 $this->db->reset_select();
 $this->db->select("a.CallReasonId, a.CallReasonDesc ", FALSE);
 $this->db->from("t_lk_callreason a ");
 $this->db->where_in("a.CallReasonCode",array('SA','PU','INC','GPU','CPGP','RPU'));
 $this->db->where("a.CallReasonStatusFlag", 1);
 $this->db->order_by("a.CallReasonOrder", "ASC");
 
 $rs = $this->db->get();
 if( $rs->num_rows() > 0 ) 
	foreach( $rs->result_assoc() as $rows )
 {
	$arr_value[$rows['CallReasonId']] = $rows['CallReasonDesc'];
 }
	
 return $arr_value;
 
}

//------------- print PDF status ---------------------


// ---------------- select call status Not In Interested data --> 
function _getCallResultPrintPdf()
{
 
 $arr_value = array();	
 $sql ="select a.CallReasonId, a.CallReasonDesc 
		from t_lk_callreason a 
		where a.CallReasonCode IN('SA', 'PU', 'INC', 'GPU', 'CPGP','RPU')
		and a.CallReasonStatusFlag=1 ";
 $rs = $this->db->query( $sql );
 if( $rs->num_rows() > 0 ) 
	foreach( $rs->result_assoc() as $rows )
 {
	$arr_value[$rows['CallReasonId']] = $rows['CallReasonDesc'];
 }
	
 return $arr_value;
 
}



// ---------------- select call status Not In Interested data --> 
function _getCallResultWritePOD()
{
	
 $arr_value = array();	
 $this->db->reset_select();
 $this->db->select("a.CallReasonId, a.CallReasonDesc ", FALSE);
 $this->db->from("t_lk_callreason a ");
 $this->db->where_in("a.CallReasonCode",array('SA'));
 $this->db->where_in("a.CallReasonEvent", array('0'));
 $this->db->where("a.CallReasonStatusFlag", 1);
 
 $rs = $this->db->get();
 if( $rs->num_rows() > 0 ) 
	foreach( $rs->result_assoc() as $rows )
 {
	$arr_value[$rows['CallReasonId']] = $rows['CallReasonDesc'];
 }
	
 return $arr_value;
 
}
/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 function _getSelectFilterBy()
{
 $arr_value = array();	
 $this->db->reset_select();
 $this->db->select("a.ConfigName as ValId, a.ConfigValue as ValText ");
 $this->db->from("t_lk_configuration a ");
 $this->db->where_in("a.ConfigCode",array('FLT_VALUE_PHONE'));
 $this->db->where_in("a.ConfigFlags", array(1));
 
  $rs = $this->db->get();
 if( $rs->num_rows() > 0 ) 
	foreach( $rs->result_assoc() as $rows )
 {
	$arr_value[$rows['ValId']] = $rows['ValText'];
 }
	
 return $arr_value;
 
}

/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
function _getPremiType()
{
 $arr_premi_type = array();
 $this->db->reset_select();
 $this->db->select("*", false);
 $this->db->from("t_lk_premitype");
 $this->db->where("PremiTypeFlags", 1);
 $rs = $this->db->get();
 if( $rs->num_rows() > 0 ) 
	foreach( $rs ->result_assoc() as $rows )
 {
	$arr_premi_type[$rows['PremiTypeId']] =  $rows['PremiTypeName'];
 }
 return (array)$arr_premi_type;
 
}	

/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
function _getAllTemplate(){
	
 $result_array = array();
 $sql  = sprintf("SELECT a.TemplateId as Kode,  a.TemplateName as Name 
				  FROM t_gn_template a 
				  WHERE a.TemplateFlags ='%d' ", 1);
					 
	$rs = $this->db->query($sql);	
  if( $rs->num_rows() > 0 ) 
	  foreach( $rs->result_assoc() as $row ) {
		 $result_array[$row['Kode']] = $row['Name'];
  }
  return (array) $result_array ;
}

/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
function _getInsertTemplate(){
	
 $result_array = array();
 $sql  = sprintf("SELECT a.TemplateId as Kode,  a.TemplateName as Name 
				  FROM t_gn_template a 
				  WHERE a.TemplateFlags ='%d' 
				  and TemplateMode='insert' ", 1);
					 
	$rs = $this->db->query($sql);	
  if( $rs->num_rows() > 0 ) 
	  foreach( $rs->result_assoc() as $row ) {
		 $result_array[$row['Kode']] = $row['Name'];
  }
  return (array) $result_array ;
}

/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
function _getUpdateTemplate(){
	
 $result_array = array();
 $sql  = sprintf("SELECT a.TemplateId as Kode,  a.TemplateName as Name 
				  FROM t_gn_template a 
				  WHERE a.TemplateFlags ='%d' 
				  and TemplateMode='update' ", 1);
					 
	$rs = $this->db->query($sql);	
  if( $rs->num_rows() > 0 ) 
	  foreach( $rs->result_assoc() as $row ) {
		 $result_array[$row['Kode']] = $row['Name'];
  }
  return (array) $result_array ;
}

/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 public function _getAllEmailAddress()
{
  $ar_address = array();
  
  $sql  =" SELECT a.EmailDestination as Address FROM egs_destination a UNION 
		   SELECT b.EmailCC as Address FROM egs_copy_carbone b UNION 
		   SELECT c.EmailBCC as Address FROM egs_blindcopy_carbone c ";
		   
  $rs = $this->db->query($sql);	
  if( $rs->num_rows() > 0 )  
	foreach( $rs->result_assoc() as $rows ) 
  {
	  $ar_address[$rows['Address']] = $rows['Address'];
  }
  return (array)$ar_address;
 
}

// -----------------------------------------------------------------------------
/*
 * @ pack : get all name space config 
 * 
 */
 
 public function _getConfigNameSpace() 
{
	$ar_config = $this->M_Configuration->_getNameSpace();
	if( is_array($ar_config) ){
		return $ar_config;
	}
	return array();
 }
 
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 function _getDataPerUser(){
	 
	// then will set data  
	$dataCOK = CK();
	$result_array = array();
	$sql = sprintf(" SELECT a.CPU_CampaignId as CampaignId FROM t_gn_campaign_peruser a 
					 WHERE a.CPU_Flags=1 AND a.CPU_UserId='%d' ", $dataCOK->field('UserId'));
					
	$qry = $this->db->query( $sql );
	if( $qry && $qry->num_rows()>0 ) 
	foreach($qry->result_assoc() as $row ){
		$result_array[$row['CampaignId']] = $row['CampaignId'];
	}
	return (array)$result_array;
 } 
 
 
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 function _getAllCampaignRefresh(){
	 
	// then will set data  
	$dataCOK = CK();
	$result_array = array();
	$sql = sprintf(" select a.CMP_Ref_Kode, a.CMP_Ref_Name from t_gn_campaign_refresh a
					 where a.CMP_Ref_Status = %s 
					 order by a.CMP_Ref_Order ASC", 1 );
					
	$qry = $this->db->query( $sql );
	if( $qry && $qry->num_rows()>0 ) 
	foreach($qry->result_assoc() as $row ){
		$result_array[$row['CMP_Ref_Kode']] = $row['CMP_Ref_Name'];
	}
	return (array)$result_array;
 } 
 

 
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 
 public function _getFileRecsource() 
{
 $ar_recsource = array();
 
 $this->db->reset_select();
 $this->db->select("a.FTP_Recsource as Kode, a.FTP_UploadFilename as Label", false);
 $this->db->from("t_gn_upload_report_ftp a ");
 $this->db->order_by("a.FTP_UploadId ", 'ASC');
 
 if( mysql_errno() ){
	 return $ar_recsource;
 }
 
 $rs = $this->db->get();
 if( $rs->num_rows()>  0  ) 
	 foreach( $rs->result_assoc() as $rows )
 {
	$ar_recsource[$rows['Kode']] = basename($rows['Label']);
 }
 return (array)$ar_recsource;
 
}

public function _getFileRecsourceTrans() 
{
 $ar_recsource = array();
 // in_array( _get_session('UserId'), array(USER_ROOT)
 $this->db->reset_select();
 // $this->db->select("a.FTP_Recsource as Kode, a.FTP_UploadFilename as Label", false);
 // $this->db->from("t_gn_upload_report_ftp a ");
 // $this->db->join("t_gn_customer_master b "," a.FTP_Recsource=b.DM_Recsource", "LEFT");
 // $this->db->where( sprintf("b.DM_DateExpired>='%s'", date('Y-m-d')), "", FALSE);
 // $this->db->group_by("a.FTP_UploadId");
 // $this->db->order_by("a.FTP_UploadId ", 'ASC');
 
 $this->db->select("a.FTP_Recsource as Kode, a.FTP_UploadFilename as Label, COUNT(c.AssignId) AS `Data`", false);
 $this->db->from("t_gn_upload_report_ftp a ");
 $this->db->join("t_gn_customer_master b "," a.FTP_Recsource=b.DM_Recsource", "LEFT");
 $this->db->join("t_gn_assignment c "," b.DM_Id=c.AssignCustId", "LEFT");
 $this->db->join("t_gn_campaign d"," b.DM_CampaignId = d.CampaignId","LEFT");
 // $this->db->where( sprintf("b.DM_DateExpired>='%s'", date('Y-m-d')), "", FALSE);
 $this->db->where( sprintf("d.CampaignEndDate>='%s'", date('Y-m-d')), "", FALSE);
 
 if(_get_session('HandlingType') == USER_SUPERVISOR){
	$this->db->where( "c.AssignSpv", _get_session('UserId') );
 }
 
 $this->db->group_by("a.FTP_UploadId");
 $this->db->order_by("a.FTP_UploadId ", 'ASC');
 // echo $this -> db -> _get_var_dump();
 // print_r($_SESSION);
 
 if( mysql_errno() ){
	 return $ar_recsource;
 }
 
 $rs = $this->db->get();
 if( $rs->num_rows()>  0  ){
	if( _get_session('HandlingType') == USER_SUPERVISOR ) {
		foreach( $rs->result_assoc() as $rows ){
			if($rows['Data']>0){
				$ar_recsource[$rows['Kode']] = basename($rows['Label']);
			}
		}
	}else{
		foreach( $rs->result_assoc() as $rows ){
			$ar_recsource[$rows['Kode']] = basename($rows['Label']);
		}
	}
 }
	 
 return (array)$ar_recsource;
 
}

public function _getFileRecsourceAdmin() 
{
 $ar_recsource = array();
 
 $this->db->reset_select();
 $this->db->select("a.FTP_Recsource as Kode, a.FTP_UploadFilename as Label", false);
 $this->db->from("t_gn_upload_report_ftp a ");
 $this->db->join("t_gn_customer_master b "," a.FTP_Recsource=b.DM_Recsource", "LEFT");
 $this->db->where("b.DM_CampaignId", 29);
 //$this->db->where("b.DM_DataType", 'REG');
 //$this->db->where( sprintf("b.DM_DateExpired>='%s'", date('Y-m-d')), "", FALSE);
 $this->db->group_by("a.FTP_UploadId");
 $this->db->order_by("a.FTP_UploadId ", 'ASC');
 // echo $this -> db -> _get_var_dump();
 
 if( mysql_errno() ){
	 return $ar_recsource;
 }
 
 $rs = $this->db->get();
 if( $rs->num_rows()>  0  ) 
	 foreach( $rs->result_assoc() as $rows )
 {
	$ar_recsource[$rows['Kode']] = basename($rows['Label']);
 }
 return (array)$ar_recsource;
 
}
 
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 
 public function _getRecsource() 
{
 $ar_recsource = array();
 
 $this->db->reset_select();
 $this->db->select("a.FTP_Recsource as Kode, a.FTP_Recsource as Label", false);
 $this->db->from("t_gn_upload_report_ftp a ");
 $this->db->order_by("a.FTP_UploadId ", 'ASC');
 
 if( mysql_errno() ){
	 return $ar_recsource;
 }
 
 $rs = $this->db->get();
 if( $rs->num_rows()>  0  ) 
	 foreach( $rs->result_assoc() as $rows )
 {
	$ar_recsource[$rows['Kode']] = $rows['Label'];
 }
 return (array)$ar_recsource;
 
}
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */

 function  _getFileUpload()
{
  $this->load->model(array('M_ModViewUpload'));
  if( !class_exists('M_ModViewUpload') ){
	return array();
  } 
	
   return (array)$this->M_ModViewUpload->_getModFilename();
}
 
 
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 function _getUserKode( $UserId  = 0 ){
	 
	// ambil row data pertiap user yang terpilih.
	 $sql = sprintf("select * from tms_agent where UserId = '%s'", $UserId );
	 $qry = $this->db->query($sql);
	 
	 if( $qry && $qry->num_rows() > 0 ){
		 return $qry->result_first_record();
	 }
	 
	return Objective( array() );
 }
 
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
   function _getPaperUrlWork( $uid = 0  ){
	 
	 $result_array = array();	
	 $sql = sprintf("select * from t_gn_paper_work a where a.PW_PaperWork_Product = '%s'", $uid);
	 $qry = $this->db->query( $sql );
	 if( $qry && $qry->num_rows() > 0 ){
		$result_array = (array)$qry->result_first_assoc(); 
	 }
	 return $result_array;
	 
  }
  
   /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  function _getCustomerNameById( $customerid = 0 ){
	  
	  $result_value = null;
	  
	  $sql = sprintf("select a.DM_Custno from t_gn_customer_master a 
					where a.DM_Id = %s", $customerid );
	  $qry = $this->db->query( $sql );
	 if( $qry && $qry->num_rows() > 0 ){
		$result_value = $qry->result_singgle_value(); 
	 }
	 return $result_value;			
  }
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 function _getLastCallNumber( $CustomerId = 0 ){
	

/// default untuk nilai awal ya.	
	$result_array = array();
	$sql =sprintf(" SELECT a.CallNumber FROM t_gn_callhistory a 
				    WHERE a.CustomerId = '%d' AND a.CallNumber<>'' 
					ORDER BY a.CallHistoryId ASC LIMIT 1", 
					$CustomerId);
	
//echo $sql;	
	//echo ----> $sql <--------------;								
	$qry = $this->db->query($sql);
	if( $qry && $qry->num_rows()> 0 ) 
	foreach( $qry->result_assoc() as $row  ){
		$result_array[$row['CallNumber']] = $row['CallNumber'];
	}	
	
	// debug($result_array);
	// jika data array maka ambil yang end saja 
	
	if( is_array($result_array) 
		and count($result_array) > 0 ) {
		return end($result_array);
	}
	
	return null;
	
 } 
 
 function _getRDPCColor( $customerid = 0 ){
	  
	  $result_value = null;
	  
	  $sql = sprintf("select count(a.CallHistoryId) as Red
from t_gn_callhistory a 
where a.CustomerId = %s
and a.CallCategoryId = 8", $customerid);
	  $qry = $this->db->query( $sql );
	 if( $qry && $qry->num_rows() > 0 ){
		$result_value = $qry->result_singgle_value(); 
	 }
	 return $result_value;			
  }
 
 // ================= END CLASS ========================= 
}

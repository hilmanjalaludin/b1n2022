<?php

/**
 * Parse out the attributes
 *
 * Some of the functions use this
 *
 * @access	private
 * @param	array
 * @param	bool
 * @return	string
 */

 
class U_Cap_Data extends EUI_Upload
{
	
 /**
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 var $_upload_table_name = null;
 var $_upload_table_data = null;
 var $_tots_rowselect 	 = 0;
 var $_tots_success 	 = 0;
 var $_tots_failed 		 = 0;
 var $_tots_duplicate 	 = 0;
 var $_tots_expired	     = 0;
 var $_tots_blacklist 	 = 0;
 var $_upload_data_date  = null;
 var $_upload_data_user  = 0;
 var $_upload_expired_date = null;
 
 
	
 /**
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
 private $_field_additional = array(); 
 private $_field_uploadId = 0;
 private $_is_complete = FALSE;
 private $_campaignId = 0;
 private $_recsource = 0;
 protected $_class_tools = null;
 private static $Instance = null;

 /**
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  function __construct()
 {
	$this->_get_campaignId();
	$this->load->model(array('M_SysUser','M_Tools'));
	$this->load->helpers(array("EUI_Object"));
	
	if(is_null($this->_class_tools)) {
		$this->_class_tools = Singgleton('M_Tools');
	}
	
	// call default data 
	$this->_upload_data_user = CK()->field('UserId');
	$this->_upload_data_date = date('Y-m-d H:i:s');
 
}
 /**
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */	
	public static function &Instance()
	{
		if( is_null(self::$Instance) ) 
		{
			self::$Instance = new self();
		}
	  
		return self::$Instance;
	}
			
 /**
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */	
	  private function _reset_class_run( $ar_reset_items )
	{
		foreach ( $ar_reset_items as $items => $items_default )
		{
			if(trim($items) )
			{
				$this->$items = $items_default;
			}
		}
	 } 

 /**
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */	
	 protected function _reset_class_argvs() 
	{
	  $ar_items_reset = array(
		'_tots_rowselect' 	 => 0,
		'_tots_success'		 => 0,
		'_tots_failed'		 => 0,
		'_campaignId'		 => 0,
		'_field_uploadId'	 => 0,
		'_tots_duplicate'	 => 0,
		'_is_complete'		 => FALSE,
		'_class_tools'		 => NULL, 
		'_upload_table_name' => NULL,
		'_upload_table_data' => NULL,
		'_field_additional'  => array() 
	  );
	  
	  $this->_reset_class_run( $ar_items_reset );
	}

 /**
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */	
public function _get_class_callback()
{
	 $ar_items_back = array  (
		 'TOTAL_UPLOAD' 	=> $this->_tots_rowselect,
		 'TOTAL_SUCCES' 	=> $this->_tots_success,
		 'TOTAL_FAILED' 	=> $this->_tots_failed,
		 'TOTAL_DUPLICATE' 	=> $this->_tots_duplicate,
		 'TOTAL_EXPIRED'	=> $this->_tots_expired,
		 'TOTAL_BLACKLIST'  => $this->_tots_blacklist
		
	  );
		
	  return (object)$ar_items_back;
	}
 /**
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */		 
	public function _set_additional( $field = null, $values=null  ) 
	{
		if( !is_null($field) )
		{
			$this->_field_additional[$field] = $values;
		}	
	}

 /**
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */	
	public function _get_campaignId() 
	{
		if( $this->URI->_get_have_post('CampaignId')) 
		{
			$this->_campaignId = $this->URI->_get_post('CampaignId');
		}	
		
		return $this->_campaignId;
	}
	



// 	
 /**
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */	
 // mus be english format.
 
function _set_expired_date( $expired_date  = null ){
	if( !is_null( $expired_date ) ){
		$this->_upload_expired_date = $expired_date;
	}
}	
 	
 /**
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */	
  
public function _set_campaignId( $CampaignId = null )  {
	if( !is_null( $CampaignId ) ){
		$this->_campaignId = $CampaignId;
	}
	if( !is_null( $CampaignId )) {
			$this->_campaignId =(int)_get_post('CampaignId');
	}
	return $this->_campaignId;
}
 /**
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */	
  
	public function _get_recsource() 
	{
		if( $this->URI->_get_have_post('recsource')) 
		{
			$this->_recsource = $this->URI->_get_post('recsource');
		}	
		
		return $this->_recsource;
	}
	
 /**
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */	
  
	 public function _set_recsource( $recsource = null ) 
	{
		if( !is_null( $recsource ) ){
			$this->_recsource = $recsource;
		}

		if(is_null( $recsource )) {
			$this->_recsource = _get_post('recsource');
		}
		return $this->_recsource;
	}
 
 /**
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */	
  
  public function _get_iswrite_bucket() { 
	return false;
 }
 
 /**
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */	
  
public function _set_uploadId( $_set_uploadId = 0 ) {
	if( $_set_uploadId ) {
		$this->_field_uploadId= $_set_uploadId;
	}	
}

/**
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */	
  
public function _set_table( $table = null ){
	if( !is_null( $table ) ) {
		$this->_upload_table_name = $table;
	 }
}

 /**
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */	
  
public function _get_is_complete() {
	return $this->_is_complete;
 }
	

 /**
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  	
 function _set_write_filter( $streams = null, $CustomerId = 0 )
 {
	 
// exit if condition not match data on rows section .
   if( !is_array( $streams ) OR !$CustomerId ){
		 return false;
   }
	
// set an object data process 
	$this->stm = null;
	$this->stm = Objective( $streams );
	$this->stm->add('CustomerId', $CustomerId);
	$this->stm->add('upload_date', date('Y-m-d H:i:s')); 

// insert into here .	
	$this->db->reset_write();
	$this->db->set('prod_cust_id', $this->stm->field('CustomerId') );
	$this->db->set('prod_cust_revsegment', $this->stm->field('CUST_REV_SEGMENT'));
	$this->db->set('prod_cust_product', $this->stm->field('PRODUCT'));
	$this->db->set('prod_cust_propensity', $this->stm->field('propensity'));
	$this->db->set('prod_cust_npwp', $this->stm->field('NEED_NPWP_PIL'));
	$this->db->set('prod_cust_dormant', $this->stm->field('flag_dormant'));
	$this->db->set('prod_cust_programavail', $this->stm->field('program_available'));
	
	$this->db->set('prod_cust_created', $this->stm->field('upload_date'));
	$this->db->insert('t_gn_filter_product');
	return true;
 }
 
/**
 * @param  [type] $row [object row ]
 * @return [type]             [description]
 */	
 
 private function _set_update_bucket( $BucketId = 0 ){
	$sql = sprintf(" UPDATE t_gn_bucket_customers a SET a.BM_Process='%s'  WHERE a.BM_Id='%d'", 'Y', $BucketId);
	if( !$this->db->query( $sql ) ){
		 return false;
	}
	return true;
 }
 
 
/**
 * @param  [type] $row [object row ]
 * @return [type]             [description]
 */	
 
private function _set_write_assignlog( $AssignDataID  = 0 ){


// this will call data 	
	$val = CK();
	$val->add('AssignId', $AssignDataID); 
// update data di customer untuk dapat data baru 
// 
	$sql  = sprintf(" UPDATE t_gn_customer_master a  
					  INNER JOIN t_gn_assignment b on a.DM_Id=b.AssignCustId
					  SET a.DM_SellerId ='%s', a.DM_SellerKode ='%s'
					  WHERE b.AssignId = '%d'",  
							$val->field('UserId', array('SetCapital')),
							$val->field('Username', array('SetCapital')),
							$val->field('AssignId', array('SetCapital')) );
	//echo $sql;
	// update langsung ke customer.
	$this->db->query($sql);
	
// query syntak insert to loger data process .
	
	$sql = sprintf("INSERT INTO t_gn_assignment_log (
							 AssignId,  		AssignCustId, 
							 CallReasonId,   	AssignAdmin, 
							 AssignAmgr,  		AssignMgr, 
							 AssignSpv,   		AssignLeader, 
							 AssignSelerId,  	AssignDate, 
							 AssignMode,  		AssignBlock, 
							 AssignById, 		AssignLocation
					)  SELECT 
							 a.AssignId as AssignId, 
							 a.AssignCustId as AssignCustId,
							 b.DM_CallReasonId as CallReasonId,
							 a.AssignAdmin as AssignAdmin,
							 a.AssignAmgr as AssignAmgr,
							 a.AssignMgr as AssignMgr,
							 a.AssignSpv as AssignSpv,
							 a.AssignLeader as AssignLeader,
							 a.AssignSelerId as AssignSelerId,
							 a.AssignDate as AssignDate,
							 a.AssignMode as AssignMode,
							 a.AssignBlock as AssignBlock, 
							 '%s' as AssignById,
							 '%s' as AssignLocation
						 FROM t_gn_assignment a 
						 INNER JOIN t_gn_customer_master b on a.AssignCustId = b.DM_Id
						 WHERE a.AssignId = '%s'", 
						 $val->field('UserId'), 
						 $val->field('LoginIP'),
						 $val->field('AssignId'));
	
	//echo $sql;
	if( !$this->db->query($sql) ){
		$ths->_mysql_error[] = mysql_error();
	}
	return true;
}
 
 
/**
 * @param  [type] $row [object row ]
 * @return [type]             [description]
 */	
 
  private function _set_write_bucket( $row = null )  
{
	if( is_null( $row)){
		return false;
	}
	
// maping data untuk bucket customer "t_gn_bucket_customers";
	$array_assoc = array(
		'DM_Custno' 			=> 'BM_Custno', 		
		'DM_FirstName' 			=> 'BM_FirstName',      
		'DM_MotherName' 		=> 'BM_MotherName',     
		'DM_Dob' 				=> 'BM_Dob',            
		'DM_HomePhoneNum' 		=> 'BM_HomePhoneNum',   
		'DM_OfficePhoneNum' 	=> 'BM_OfficePhoneNum', 
		'DM_MobilePhoneNum' 	=> 'BM_MobilePhoneNum', 
		'DM_OtherPhoneNum' 		=> 'BM_OtherPhoneNum',  
		'DM_CrLimit' 			=> 'BM_CrLimit',        
		'DM_CcTypeName' 		=> 'BM_CcTypeName',     
		'DM_AddressLine1' 		=> 'BM_AddressLine1',   
		'DM_AddressLine2' 		=> 'BM_AddressLine2',   
		'DM_AddressLine3' 		=> 'BM_AddressLine3',   
		'DM_AddressLine4' 		=> 'BM_AddressLine4',   
		'DM_CcLimit' 			=> 'BM_CcLimit' );
		
 // ubah object ke bentuk @array_assoc

	$result_array = $row->fetch_assoc();
	$this->db->reset_write();
	if( is_array( $result_array ) ) foreach( $result_array as $field => $value ) {
		// check by check data proces 
		$this->check = Objective( $array_assoc );
		if( $this->check->field( $field ) ) {
			$this->db->set( $array_assoc[$field], $value );
		} 
	} 
	
	
	$this->db->set('BM_ProductId',    $this->_writeProductId);  
	$this->db->set('BM_Recsource', 	  $this->_recsource);
	$this->db->set('BM_CampaignId',   $this->_campaignId);
	$this->db->set('BM_UploadedTs',   $this->_upload_data_date);
	$this->db->set('BM_UploadedById', $this->_upload_data_user);
	$this->db->set('BM_FTP_UploadId', $this->_field_uploadId);
	$this->db->set('BM_DateExpired',  $this->_upload_expired_date);
	// check by check kondisi 
	
	$callDispositionQry = $this->db->insert("t_gn_bucket_customers", null);
	if( !$callDispositionQry ) {
		$ths->_mysql_error[] = mysql_error();
		return 0;
	} 
		
	// untuk di masukan && dan data update untk table lain.	
	return (int)$this->db->insert_id();
} 
	
/**
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
public function _set_content( $ar_items_source = null )
{
 
 if( !is_null($ar_items_source)  
 AND is_array($ar_items_source) )  {
	
	$this->_upload_table_data = $ar_items_source;
	// additional if have proces not set on other class 
	// this will generate add of field not found in 
	// rows data .
	/* $this->_set_additional('deb_created_ts', date('Y-m-d H:i:s'));
	   $this->_set_additional('deb_cmpaign_id', $this->_campaignId);
	    $this->_set_additional('deb_upload_id', $this->_field_uploadId); 
	 */
		
	$this->_tots_rowselect = count($ar_items_source);
	$this->_is_complete  = TRUE;
  }
  
}
/**
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */		
protected function _set_assignment( $DebiturId = 0 , $AgentCode=null )
{

$conds  = FALSE;
// ambil session data dari modul cok 
 $cok = CK();
 $cok->add('AssignCustId', $DebiturId);
 $cok->add('AssignDate', $this->_upload_data_date);
 $cok->add('AssignMode', 'UPL');
 
// ambil ID dari User ID tersebut.
 $this->CustID = $DebiturId;
 $this->UserId = $cok->field('UserId');
 $this->CondID = 0;
 $this->AssignID = 0; 
  
 // check by ricek 
 
 if( !$this->UserId OR !$this->CustID ){
	return false;
 }

 // masukan ke table Assigment table  jika sudah ada di assigment 
 // kemudian update t_gn_customer_master, Sebagai Last SellerId .
 
 
//  jika User ROOT selain ROOT lihat  dibawahnya 
 $this->db->reset_write();
 
 if( !strcmp( $cok->field('HandlingType'), USER_ROOT )){
	$this->db->set('AssignCustId',$cok->field('AssignCustId'));
	$this->db->set('AssignAdmin', $cok->field('UserId'));
	$this->db->set('AssignDate', $cok->field('AssignDate'));
	$this->db->set('AssignMode', $cok->field('AssignMode'));
	$this->CondID++;
 }
 // ambil hiraki 
 else if( !strcmp( $cok->field('HandlingType'), USER_ADMIN )){
	$this->db->set('AssignCustId',$cok->field('AssignCustId'));
	$this->db->set('AssignAdmin', $cok->field('UserId'));
	$this->db->set('AssignDate', $cok->field('AssignDate'));
	$this->db->set('AssignMode', $cok->field('AssignMode'));
	
	$this->CondID++;
 }
 
 // jika ACCOUNT MANAGER 
 else if( !strcmp( $cok->field('HandlingType'), USER_ACCOUNT_MANAGER )){
	$this->db->set('AssignCustId',$cok->field('AssignCustId'));
	$this->db->set('AssignAdmin', $cok->field('AdministratorId'));
	$this->db->set('AssignAmgr', $cok->field('AccountManager'));
	$this->db->set('AssignDate', $cok->field('AssignDate'));
	$this->db->set('AssignMode', $cok->field('AssignMode'));
	$this->CondID++;
 }
  // ambil hiraki 
 else if( !strcmp( $cok->field('HandlingType'), USER_MANAGER )){
	$this->db->set('AssignCustId',$cok->field('AssignCustId'));
	$this->db->set('AssignAdmin', $cok->field('AdministratorId'));
	$this->db->set('AssignAmgr', $cok->field('AccountManager'));
	$this->db->set('AssignMgr', $cok->field('ManagerId'));
	$this->db->set('AssignDate', $cok->field('AssignDate'));
	$this->db->set('AssignMode', $cok->field('AssignMode'));
	$this->CondID++;
 }
 
 // process di hentikan .
 if( !$this->CondID){
	 return false;
 }
 // process data masukan ke assign 
  
  $this->db->insert('t_gn_assignment');
  if( $this->db->affected_rows() > 0 ){
	$this->AssignID = $this->db->insert_id();
  }
  
 // jika data assgn kosong / 0   
  if( !$this->AssignID ){
	  return false;
  }
  
  // this set return to log assigment 
  return $this->AssignID;
}
/**
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */		
protected function _set_loan_tiering($loan_tiering = array(), $_cust_id = 0){
		$_set_loan_tiering = array();
		$cardno = 0;
		foreach($loan_tiering as $key => $val){
			if(strtolower($key)=='cardno'){
				$cardno = $val;
			}else if(strtolower($key)!='cardno'){
				$tenor = explode("_",$key);
				if(end($tenor)==6){
					$_set_loan_tiering[$_cust_id][6]['cardno'] = $cardno;
					$_set_loan_tiering[$_cust_id][6][$tenor[0]] = $val;
				}else if(end($tenor)==12){
					$_set_loan_tiering[$_cust_id][12]['cardno'] = $cardno;
					$_set_loan_tiering[$_cust_id][12][$tenor[0]] = $val;
				}else if(end($tenor)==24){
					$_set_loan_tiering[$_cust_id][24]['cardno'] = $cardno;
					$_set_loan_tiering[$_cust_id][24][$tenor[0]] = $val;
				}else if(end($tenor)==36){
					$_set_loan_tiering[$_cust_id][36]['cardno'] = $cardno;
					$_set_loan_tiering[$_cust_id][36][$tenor[0]] = $val;
				}
			}
		}
		foreach($_set_loan_tiering as $keys => $vals){
			foreach($vals as $key => $val){
				$this->db->set('CustomerId',$_cust_id);
				$this->db->set('Cardno',$_set_loan_tiering[$keys][$key]['cardno']);
				$this->db->set('CampaignId',$this->_get_campaignId());
				$this->db->set('Tenor',$key);
				$this->db->set('LoanAmount',$_set_loan_tiering[$keys][$key]['loan']);
				$this->db->set('Installment',$_set_loan_tiering[$keys][$key]['install']);
				$this->db->set('Rate',$_set_loan_tiering[$keys][$key]['interest']);
				$this->db->set('UploadDate', date('Y-m-d H:i:s'));
				
				$this->db->insert('t_gn_loan_tiering');
				if( $this->db->affected_rows() > 0 ) {
					$conds++;
				}
			}
		}
	}
/**
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */		
 
 public function _set_process()
{
	
 // disini harus di cek terlebih dahulu , berdasrkan setting 
 // table "t_gn_template", apakah bernilai Y/N jika Y maka 
 // masukan data ke Bucket jika N tidak Perlu langsung ke table 
 // tujuan 

 $this->_writeToBucketData  = $this->_get_iswrite_bucket();
 $this->_writeBucketDataId  = 0;
 $this->_writeAssignDataId  = 0;
 
 // define data arrray disini 
 $array_assoc = array();
 
// next of process langsung return false;
 $cond = is_array( $this->_upload_table_data );
 //debug($cond)
 if( !$cond ){
	 return false;
 }
 
// then next process 
  $this->_tots_duplicate = 0;
  // $duplicate = is_array($this -> getCustNoDuplicate($val->field( 'DM_Custno')));
  
  
  // exit();
  $ths->_mysql_error = null;
  if(is_array($this->_upload_table_data)) 
	 foreach( $this->_upload_table_data as $n => $values )
  {
	$duplicate = $this -> getCustNoDuplicate($values['DM_Custno']);
	// print_r($duplicate['Assign_Sell_CustId']['DM_Custno']);
    $val = Objective( $values ); // convert_cyr_string 
	// print_r($duplicate);
// jika data custno tdak ada return nxt ke row berikutya.
	if( $val->find_value( 'DM_Custno') && $duplicate['Assign_Sell_CustId']['Assign_Sell_IsReady'] == 1 ) 
	{
		$this->_tots_duplicate+=1;
		continue;
	}
	
	// $Duplicate = 
	
// update data asign admi upload data cap .
	$sql = sprintf("UPDATE t_gn_selling_assignment a 
					INNER JOIN t_gn_customer_master b ON a.Assign_Sell_CustId=b.DM_Id 
					SET a.Assign_Sell_IsReady = 1 ,
						a.Assign_Sell_UpdateTs = NOW() 
					WHERE b.DM_Custno = '%s'", $val->field( 'DM_Custno', 'trim'));			
// update dataprocess 
	// echo $sql;
	$this->db->query( $sql );
	if($this->db->affected_rows() > 0 ){
		$this->_tots_success+=1;
	}
	else {
		$this->_tots_failed+=1;
	}
	// end for each : Data 
  }
  
  
}
/**
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */		
 
function _gen_custno() {
	
 $this->num = '000000000001';
 $sql = "select max(CustomerId) as ujung from t_gn_customer";
 $qry = $this->db->query($sql);
 
 if( $qry->num_rows()>0 ) {
	$this->max = ((int)$qry->result_singgle_value()+1);
	$this->num = str_pad($this->max,12,"0",STR_PAD_LEFT);
 }
 return $this->num;
}

Public Function getCustNoDuplicate($param)
{
	$campaign = array();
	$sql = "select a.Assign_Sell_Id, a.Assign_Sell_CustId, b.DM_Custno, a.Assign_Sell_IsReady
			from t_gn_selling_assignment a
			inner join t_gn_customer_master b on a.Assign_Sell_CustId = b.DM_Id
			where b.DM_Custno = '".$param."' ";
	// echo $sql;
	$qry = $this->db->query($sql);
	
	if($qry->num_rows() > 0)
	{
		foreach($qry->result_array() as $rows)
		{
			$campaign['Assign_Sell_CustId'] = $rows;
		}
	}
	return $campaign;
}

/**
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
 
 function testing() {
	 return "okaaay! xxx";
 }
	
// end class 	
}
?>
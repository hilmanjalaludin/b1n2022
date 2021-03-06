<?php

class U_Refresh_DataVerification extends EUI_Upload{

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
 var $_VerificationFlags = "Y"; 

 private $_field_additional = array(); 
 private $_field_uploadId	= 0;
 private $_is_complete		= FALSE;
 private $_campaignId		= 0;
 private $_recsource		= 0;
 protected $_class_tools	= null;
 private static $Instance	= null;

	function __construct(){
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

	public static function &Instance(){
		if( is_null(self::$Instance) ){
			self::$Instance = new self();
		}

		return self::$Instance;
	}

	private function _reset_class_run( $ar_reset_items ){
		foreach ( $ar_reset_items as $items => $items_default ){
			if(trim($items) ){
				$this->$items = $items_default;
			}
		}
	} 

	protected function _reset_class_argvs(){
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

	public function _get_class_callback(){
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
	
	public function _set_uploadId( $_set_uploadId = 0 ) {
		if( $_set_uploadId ) {
			$this->_field_uploadId= $_set_uploadId;
		}	
	}
	
	protected function _set_write_loger( $row = null ){
		// check validation data process OK 
		if( is_null( $row ) ){  
			return false; 
		}
		// then push of name session UserId 
		$row->add('UR_Data_UploadUser', CK()->field( 'Username' ));
		$row->add('UR_Data_UploadId',$this->_field_uploadId);

		// callback array process 
		$result_array = $row->fetch_assoc();
		$this->db->reset_write();
		if( is_array( $result_array )) 
			foreach( $result_array as $field => $value ){
				$this->db->set($field, $value);
			}

		// insert into logger Process SIP 	
		$this->db->insert('t_gn_upload_refresh');
		return true;
	}
	
	protected function updateRefreshLog($UploadId = null, $FixId = null){
		$this->db->set('UR_Refresh_Status', 1 );
		$this->db->where('UR_Data_UploadId', $UploadId );
		$this->db->where('UR_Data_FixID', $FixId );
		$this->db->update('t_gn_upload_refresh');
	}
 
	public function _get_all_active_campaign(){
		$arr_campaignid = array();
		$sql = "SELECT a.CampaignId FROM t_gn_campaign a WHERE a.CampaignStatusFlag = 1";
		$qry = $this->db->query( $sql );
		if( $qry && $qry->num_rows() ) {
			foreach($qry->result_array() as $key=>$row){
				$arr_campaignid[] = $row['CampaignId'];
			}
		}
		return $arr_campaignid;
	}
 
	public function _set_process(){
		// disini harus di cek terlebih dahulu , berdasrkan setting 
		// table "t_gn_template", apakah bernilai Y/N jika Y maka 
		// masukan data ke Bucket jika N tidak Perlu langsung ke table 
		// tujuan 

		$this->_writeToBucketData  = $this->_get_iswrite_bucket();
		$activeCampaignId = $this->_get_all_active_campaign();

		$this->_writeBucketDataId  = 0;
		$this->_writeAssignDataId  = 0;
		// define data arrray disini 

		$loan_tiering = array();	
		$array_assoc = array();

		// next of process langsung return false;
		$cond = is_array( $this->_upload_table_data );
		if( !$cond ){
		 return false;
		}

		// ambil nilai Product Untuk dimasukan ke DB berdasrkan 
		// campaign Upload Data .
		$this->_writeProductId = ProductByCampaignID($this->_campaignId); 

		// then next process  
		$ths->_mysql_error = null;
		if(is_array($this->_upload_table_data)) 
		foreach( $this->_upload_table_data as $n => $values ) {
   
		// set an object data to process 	
		$result_value = Objective( $values ); // convert_cyr_string 
		$result_value->add('CV_Data_UpdateTs', date('Y-m-d H:i:s'));

		// set on this theory data 
		$result_loger = Objective(array());
		$result_loger->add('UR_Data_FixID',		 $result_value->field('CV_Data_FixID') );
		$result_loger->add('UR_Data_Membal', 	 $result_value->field('CV_Data_Membal') );
		$result_loger->add('UR_Data_AvailXD', 	 $result_value->field('CV_Data_AvailXD') );
		$result_loger->add('UR_Data_AvailSS', 	 $result_value->field('CV_Data_AvailSS') );
		$result_loger->add('UR_Data_Block', 	 $result_value->field('CV_Data_Block') );	
		$result_loger->add('UR_Data_Crelimit', 	 $result_value->field('CV_Data_Crelimit') );
		$result_loger->add('UR_Data_CcExpired',  $result_value->field('CV_Data_CcExpired') );	
		$result_loger->add('UR_Data_UploadTs', 	 $result_value->field('CV_Data_UpdateTs') ); 
		
		// set an loger data process OK 	
	   @call_user_func_array( array($this, '_set_write_loger'), array( $result_loger ));
		
		// on set here like this 	
		$result_array = null;
		$result_array = $result_value->fetch_assoc();
		
		// set on key 	
		$this->db->wherekey = null;
		$this->db->reset_write();
		if( is_array( $result_array ) ) 
		foreach( $result_array as $field => $value ) {
			if( !strcmp( 'CV_Data_FixID', $field )){
				$this->db->wherekey = $value;
				$this->db->where($field, $value );
				// $this->db->where('CV_Data_Campaign_Id', $this->_campaignId );
				if($activeCampaignId)
					$this->db->where_in('CV_Data_Campaign_Id', $activeCampaignId );
			} 
			else{
				$this->db->set($field, $value );
			}
		}
	
		// cek apakah benar table yang dimasukan .
		if( !is_null( $this->_upload_table_name )){
			$kondisi = false;
			$kondisi = $this->db->update( $this->_upload_table_name, false);
			// echo $this->db->last_query();
			// die();
			if(!$this->db->affected_rows()) {
				// echo $this->db->affected_rows();
				// echo $kondisi;
				// echo $this->db->last_query();
				// die();
				// $this->_mysql_error[] = mysql_error();
				// echo mysql_error();
				$this->_tots_failed+=1;
				$this->db->wherekey = null;
				// continue;
			}else{
			
			// jika process update gagal 
			// if( !$kondisi ){
				// $this->_tots_failed+=1;
				// $this->db->wherekey = null;
				// continue;
			// }
			// echo $this->db->last_query();
			// jika process update berhasil memang ada update / perubahan 
			// pada table verifikasi maka update juga di customer - nya OK Bos .
			$this->updateRefreshLog($this->_field_uploadId, $result_value->field('CV_Data_FixID'));
			$this->_tots_success+=1;
			// $sql = sprintf("UPDATE t_gn_customer_master a INNER JOIN t_gn_customer_verification b  on a.DM_Custno=b.CV_Data_Custno and a.DM_CampaignId = b.CV_Data_Campaign_Id
							// SET a.DM_DataFixID   = b.CV_Data_FixID,
								// a.DM_DataMembal  = b.CV_Data_Membal,
								// a.DM_DataAvailXD = b.CV_Data_AvailXD,
								// a.DM_DataAvailSS = b.CV_Data_AvailSS,
								// a.DM_DataBlock   = b.CV_Data_Block,
								// a.DM_CrLimit	 = b.CV_Data_Crelimit,
								// a.DM_CcExpired   = b.CV_Data_CcExpired
							// WHERE 
								// b.CV_Data_FixID  = '%s'
								// AND b.CV_Data_Campaign_Id", $this->db->wherekey, $this->_campaignId);
								
			// if( $this->db->query( $sql ) ){
				$this->db->wherekey = null;
			}
		}
	
		// end foreach data looping process : ?
	}
  
  return true;
  
  
}
	
	// export to csv
	private function _getFixid(){
		$sql = "SELECT a.CV_Data_FixID, a.CV_Data_CcExpired, a.CV_Data_Membal, a.CV_Data_Crelimit, a.CV_Data_Block, a.CV_Data_AvailXD, a.CV_Data_AvailSS
			FROM t_gn_customer_verification a
			INNER JOIN t_gn_campaign c ON a.CV_Data_Campaign_Id = c.CampaignId
			WHERE c.CampaignStatusFlag = 1";
		$qry = $this->db->query( $sql );
		if( $qry && $qry->num_rows() ) {
			foreach($qry->result_array() as $key=>$row){
				$fixids[$row['CV_Data_FixID']]['CV_Data_FixID']		= $row['CV_Data_FixID'];
				$fixids[$row['CV_Data_FixID']]['CV_Data_CcExpired']	= $row['CV_Data_CcExpired'];
				$fixids[$row['CV_Data_FixID']]['CV_Data_Membal']	= $row['CV_Data_Membal'];
				$fixids[$row['CV_Data_FixID']]['CV_Data_Crelimit']	= $row['CV_Data_Crelimit'];
				$fixids[$row['CV_Data_FixID']]['CV_Data_Block']		= $row['CV_Data_Block'];
				$fixids[$row['CV_Data_FixID']]['CV_Data_AvailXD']	= $row['CV_Data_AvailXD'];
				$fixids[$row['CV_Data_FixID']]['CV_Data_AvailSS']	= $row['CV_Data_AvailSS'];
			}
		}
		return $fixids;
	}
	
	public function _exportFixid($download = 0){
		// $this->load->helper('EUI_WriteFixed');
		$this->load->helper('EUI_WriteFixedv2');
		$define_header_fixed = array(   'CV_Data_FixID'		=> 1,
										'CV_Data_CcExpired'	=> 1,
										'CV_Data_Membal'	=> 1,
										'CV_Data_Crelimit'	=> 1,
										'CV_Data_Block'		=> 1,
										'CV_Data_AvailXD'	=> 1,
										'CV_Data_AvailSS'	=> 1);
		$define_header_label = array(	'CV_Data_FixID'		=> 'FIX',
								'CV_Data_CcExpired'	=> 'EXPIRE',
								'CV_Data_Membal'	=> 'MEMBAL',
								'CV_Data_Crelimit'	=> 'CRELIM',
								'CV_Data_Block'		=> 'BLOCK',
								'CV_Data_AvailXD'	=> 'AVAILXD',
								'CV_Data_AvailSS'	=> 'AVAILSS');

		$basefilepath = sprintf("%s%s_%s.csv", '/Refresh/Fixid/','FixId',date('Ymd_His'));

		$writefix = new EUI_WriteFixedv2($basefilepath, dirname( __FILE__ ));
		$writefix->write_header_fixed_position($define_header_fixed);
		
		// kalau pemisahnya diset berarti fixed length-nya off
		$writefix->set_pemisah(",");

		$writefix->write_header_label($define_header_label);
		$data = $this->_getFixid();

		$i = 0;
		foreach( $data as $key => $row  ){
			$writefix->write_content( $i, 0, $row['CV_Data_FixID']);
			$writefix->write_content( $i, 1, $row['CV_Data_CcExpired']);
			$writefix->write_content( $i, 2, $row['CV_Data_Membal']);
			$writefix->write_content( $i, 3, $row['CV_Data_Crelimit']);
			$writefix->write_content( $i, 4, $row['CV_Data_Block']);
			$writefix->write_content( $i, 5, $row['CV_Data_AvailXD']);
			$writefix->write_content( $i, 6, $row['CV_Data_AvailSS']);
			$i++;
		}

		//set on kontent data proces ok ;
		$writefix->write_process();
		$writefix->write_closed();

		// data handler proces 
		$filepathname = $writefix->pathfilename();
		// $filetype = @filetype($filepathname);
		
		// debug($writefix);
		if($download){
			return $filepathname;
			// $filepathname = $writefix->pathfilename();
			// echo $filepathname;
			
		}else{
			return false;
		}
	}
	
	
	
	/**************************************************************/

	public function _set_table( $table = null ){
		if( !is_null( $table ) ) {
			$this->_upload_table_name = $table;
		}
	}
	
	public function _get_is_complete() {
		return $this->_is_complete;
	}
	
	public function _set_content( $ar_items_source = null ){
		if( !is_null($ar_items_source) AND is_array($ar_items_source) )  {
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
	
	// ===========================================================/
	
	public function _set_additional( $field = null, $values=null  ){
		if( !is_null($field) ){
			$this->_field_additional[$field] = $values;
		}	
	}

	public function _get_campaignId(){
		if( $this->URI->_get_have_post('CampaignId')){
			$this->_campaignId = $this->URI->_get_post('CampaignId');
		}		
		
		return $this->_campaignId;
	}

	function _set_expired_date( $expired_date  = null ){
		if( !is_null( $expired_date ) ){
			$this->_upload_expired_date = $expired_date;
		}
	}	

	public function _set_campaignId( $CampaignId = null )  {
		if( !is_null( $CampaignId ) ){
			$this->_campaignId = $CampaignId;
		}
		if( !is_null( $CampaignId )) {
			$this->_campaignId =(int)_get_post('CampaignId');
		}
		return $this->_campaignId;
	}

	public function _get_recsource(){
		if( $this->URI->_get_have_post('recsource')){
			$this->_recsource = $this->URI->_get_post('recsource');
		}

		return $this->_recsource;
	}
	
	public function _set_recsource( $recsource = null ){
		if( !is_null( $recsource ) ){
			$this->_recsource = $recsource;
		}

		if(is_null( $recsource )){
			$this->_recsource = _get_post('recsource');
		}
		
		return $this->_recsource;
	}
 
	public function _get_iswrite_bucket(){
		$arr_template = array();
		$sql = sprintf("select * from t_gn_template a where a.TemplateTableName = '%s'", $this->_upload_table_name );
		$qry = $this->db->query( $sql );
		if( $qry && $qry->num_rows() ) {
			$arr_template = $qry->result_first_assoc();
		}
	
		// validate on object data
		$rd = call_user_func('Objective',$arr_template);
		if( $rd->find_value('TemplateBucket') 
			&& !strcmp( $rd->field('TemplateBucket'), 'Y') ) {
			return true;	
		}
		return false;
	}
 
	

	

	function _set_write_filter( $streams = null, $CustomerId = 0 ){
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

	private function _set_update_bucket( $BucketId = 0 ){
		$sql = sprintf(" UPDATE t_gn_bucket_customers a SET a.BM_Process='%s'  WHERE a.BM_Id='%d'", 'Y', $BucketId);
		if( !$this->db->query( $sql ) ){
			return false;
		}
		return true;
	}

	private function _set_write_assignlog( $AssignDataID  = 0 ){
		// this will call data 	
		$val = CK();
		$val->add('AssignId', $AssignDataID); 
		// update data di customer untuk dapat data baru 

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

	function _set_write_verification( $CustID = 0 ){
		$this->result_verification_error = array(); 
		// insert data on process  
		$sql = sprintf(" INSERT INTO t_gn_customer_verification ( 
					 CV_Data_CustId, 
					 CV_Data_Campaign_Id,
					 CV_Data_Custno,
					 CV_Data_FixID,
					 CV_Data_MotherName,
				 	 CV_Data_Dob,
					 CV_Data_Membal,
					 CV_Data_DLDate,
					 CV_Data_RzipCode,
					 CV_Data_LzipCode,
					 CV_Data_Block,
					 CV_Data_OpenDate,
					 CV_Data_CcExpired,
					 CV_Data_NoOfMonth,
					 CV_Data_AvailXD,
					 CV_Data_AvailSS,
					 CV_Data_CardType,
					 CV_Data_Cycle,
					 CV_Data_Crelimit,
					 CV_Data_Penawaran  ) 
					SELECT 
						DM_Id 			 as CV_Data_CustId,
						DM_Custno 		 as CV_Data_Custno,
						DM_CampaignId 	 as CV_Data_Campaign_Id,
						DM_DataFixID 	 as CV_Data_FixID,
						DM_MotherName 	 as CV_Data_MotherName,
						DM_Dob 			 as CV_Data_Dob,
						DM_DataMembal 	 as CV_Data_Membal,
						DM_DataDLDate 	 as CV_Data_DLDate,
						DM_ZipCode 		 as CV_Data_RzipCode,
						DM_OfficeZipCode as CV_Data_LzipCode,
						DM_DataBlock	 as CV_Data_Block,
						DM_DataOpenDate  as CV_Data_OpenDate,
						DM_ExpiredCard 	 as CV_Data_CcExpired,
						DM_DataNoMonth   as CV_Data_NoOfMonth,
						DM_DataAvailXD   as CV_Data_AvailXD,
						DM_DataAvailSS   as CV_Data_AvailSS,
						DM_CcTypeName    as CV_Data_CardType,
						DM_DataCycle	 as CV_Data_Cycle,
						DM_CrLimit 	 	 as CV_Data_Crelimit, 
						DM_DataPenawaran as CV_Data_Penawaran
					FROM t_gn_customer_master 
					WHERE DM_Id ='%d' ", $CustID);

		// insert data proces 
		if( !$this->db->query($sql) ){
			$this->result_verification_error[] = mysql_error();
		}
		return true;
		
	}

	private function _set_write_bucket( $row = null ){
		//display();
		if( is_null( $row)){
			return false;
		}
	
		// debug($row);
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
			'DM_CcLimit' 			=> 'BM_CcLimit',
			'DM_DataFixID'		 	=> 'BM_DataFixID',
			'DM_DataMembal' 		=> 'BM_DataMembal',
			'DM_CrLimit' 			=> 'BM_CrLimit',
			'DM_DataDLDate' 		=> 'BM_DataDLDate',
			'DM_ZipCode' 			=> 'BM_ZipCode',
			'DM_OfficeZipCode' 		=> 'BM_OfficeZipCode',
			'DM_DataBlock' 			=> 'BM_DataBlock',
			'DM_DataOpenDate' 		=> 'BM_DataOpenDate',
			'DM_DataNoMonth' 		=> 'BM_DataNoMonth',
			'DM_DataAvailXD' 		=> 'BM_DataAvailXD',
			'DM_DataAvailSS' 		=> 'BM_DataAvailSS',
			'DM_DataCycle'			=> 'BM_DataCycle',
			'DM_DataPenawaran' 		=> 'BM_DataPenawaran' 
		);
		
		// ubah object ke bentuk @array_assoc
		$result_array = $row->fetch_assoc();
		$this->db->reset_write();
		if( is_array( $result_array ) ) 
		foreach( $result_array as $field => $value ) {
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
	
		$this->db->insert("t_gn_bucket_customers" );
		if($this->db->affected_rows() < 1  ) {
			$ths->_mysql_error[] = mysql_error();
		} 
		
		//debug($this->_mysql_error);	
		// untuk di masukan && dan data update untk table lain.	
		return (int)$this->db->insert_id();
	} 

	protected function _set_assignment( $DebiturId = 0 , $AgentCode=null ){
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
		// jika User ROOT selain ROOT lihat  dibawahnya 
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








// end class 	
}
?>
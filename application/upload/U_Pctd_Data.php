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


class U_Pctd_Data extends EUI_Upload
{

	/**
	 * @param  [type] $CustomerId [description]
	 * @return [type]             [description]
	 */
	var $_upload_table_name = null;
	var $_upload_table_data = null;
	var $_tots_rowselect 	 = 0;
	var $_tots_success 	 = 0;
	var $_tots_success_verification = 0;
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

	var $_VerificationFlags = "Y";
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
		$this->load->model(array('M_SysUser', 'M_Tools'));
		$this->load->helpers(array("EUI_Object"));

		if (is_null($this->_class_tools)) {
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
		if (is_null(self::$Instance)) {
			self::$Instance = new self();
		}

		return self::$Instance;
	}

	/**
	 * @param  [type] $CustomerId [description]
	 * @return [type]             [description]
	 */
	private function _reset_class_run($ar_reset_items)
	{
		foreach ($ar_reset_items as $items => $items_default) {
			if (trim($items)) {
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
			'_tots_success_verification'		 => 0,
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

		$this->_reset_class_run($ar_items_reset);
	}

	/**
	 * @param  [type] $CustomerId [description]
	 * @return [type]             [description]
	 */
	public function _get_class_callback()
	{
		$ar_items_back = array(
			'TOTAL_UPLOAD' 	=> $this->_tots_rowselect,
			'TOTAL_SUCCES' 	=> $this->_tots_success,
			'TOTAL_SUCCES_VERIFICATION' 	=> $this->_tots_success_verification,
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
	public function _set_additional($field = null, $values = null)
	{
		if (!is_null($field)) {
			$this->_field_additional[$field] = $values;
		}
	}

	/**
	 * @param  [type] $CustomerId [description]
	 * @return [type]             [description]
	 */
	public function _get_campaignId()
	{
		if ($this->URI->_get_have_post('CampaignId')) {
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

	function _set_expired_date($expired_date  = null)
	{
		if (!is_null($expired_date)) {
			$this->_upload_expired_date = $expired_date;
		}
	}

	/**
	 * @param  [type] $CustomerId [description]
	 * @return [type]             [description]
	 */

	public function _set_campaignId($CampaignId = null)
	{
		if (!is_null($CampaignId)) {
			$this->_campaignId = $CampaignId;
		}
		if (!is_null($CampaignId)) {
			$this->_campaignId = (int)_get_post('CampaignId');
		}
		return $this->_campaignId;
	}
	/**
	 * @param  [type] $CustomerId [description]
	 * @return [type]             [description]
	 */

	public function _get_recsource()
	{
		if ($this->URI->_get_have_post('recsource')) {
			$this->_recsource = $this->URI->_get_post('recsource');
		}

		return $this->_recsource;
	}

	/**
	 * @param  [type] $CustomerId [description]
	 * @return [type]             [description]
	 */

	public function _set_recsource($recsource = null)
	{
		if (!is_null($recsource)) {
			$this->_recsource = $recsource;
		}

		if (is_null($recsource)) {
			$this->_recsource = _get_post('recsource');
		}
		return $this->_recsource;
	}

	/**
	 * @param  [type] $CustomerId [description]
	 * @return [type]             [description]
	 */

	public function _get_iswrite_bucket()
	{
		$arr_template = array();
		$sql = sprintf(
			"select * from t_gn_template a where a.TemplateTableName = '%s'",
			$this->_upload_table_name
		);
		$qry = $this->db->query($sql);
		// var_dump($this->db->last_query());
		if ($qry && $qry->num_rows()) {
			$arr_template = $qry->result_first_assoc();
		}

		// validate on object data .

		$rd = call_user_func('Objective', $arr_template);
		if (
			$rd->find_value('TemplateBucket')
			&& !strcmp($rd->field('TemplateBucket'), 'Y')
		) {
			return true;
		}
		return false;
	}

	/**
	 * @param  [type] $CustomerId [description]
	 * @return [type]             [description]
	 */

	public function _set_uploadId($_set_uploadId = 0)
	{
		if ($_set_uploadId) {
			$this->_field_uploadId = $_set_uploadId;
		}
	}

	/**
	 * @param  [type] $CustomerId [description]
	 * @return [type]             [description]
	 */

	public function _set_table($table = null)
	{

		if (!is_null($table)) {
			$this->_upload_table_name = $table;
		}
	}

	/**
	 * @param  [type] $CustomerId [description]
	 * @return [type]             [description]
	 */

	public function _get_is_complete()
	{
		return $this->_is_complete;
	}


	/**
	 * @param  [type] $CustomerId [description]
	 * @return [type]             [description]
	 */

	function _set_write_filter($streams = null, $CustomerId = 0)
	{

		// exit if condition not match data on rows section .
		if (!is_array($streams) or !$CustomerId) {
			return false;
		}

		// set an object data process
		$this->stm = null;
		$this->stm = Objective($streams);
		$this->stm->add('CustomerId', $CustomerId);
		$this->stm->add('upload_date', date('Y-m-d H:i:s'));

		// insert into here .
		$this->db->reset_write();
		$this->db->set('prod_cust_id', $this->stm->field('CustomerId'));
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

	private function _set_update_bucket($BucketId = 0)
	{
		$sql = sprintf(" UPDATE t_gn_bucket_customers a SET a.BM_Process='%s'  WHERE a.BM_Id='%d'", 'Y', $BucketId);
		if (!$this->db->query($sql)) {
			return false;
		}
		return true;
	}


	/**
	 * @param  [type] $row [object row ]
	 * @return [type]             [description]
	 */

	private function _set_write_assignlog($AssignDataID  = 0)
	{

		// this will call data
		// get data customer ID form ASG ID

		$CustomerId = 0;
		$sql = sprintf("select a.AssignCustId from t_gn_assignment a where a.AssignId=%d", $AssignDataID);
		$qry = $this->db->query($sql);
		if ($qry && $qry->num_rows() > 0) {
			$CustomerId = (int)$qry->result_singgle_value();
		}

		// update data di customer untuk dapat data baru
		$val = &CK();
		$val->add('DM_Id', $CustomerId);
		$sql = sprintf(
			"UPDATE t_gn_customer_master a SET a.DM_SellerId ='%s', a.DM_SellerKode ='%s' WHERE a.DM_Id= %d ",
			$val->field('UserId', array('SetCapital')),
			$val->field('Username', array('SetCapital')),
			$val->field('DM_Id', array('SetCapital'))
		);

		// return callback on here skip on log statment
		// for efisiensi data process OK .

		return $this->db->query($sql);

		// query syntak insert to loger data process .

		$sql = sprintf(
			"INSERT INTO t_gn_assignment_log (
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
			$val->field('AssignId')
		);

		//echo $sql;
		/*
	if( !$this->db->query($sql) ){
		$ths->_mysql_error[] = mysql_error();
	}
	*/

		return true;
	}


	/**
	 * @param  [type] $row [object row ]
	 * @return [type]             [description]
	 */

	function _set_write_verification($disposition = 0, $row = null)
	{
		// echo "<pre>";
		// var_dump(!$disposition);
		// die;

		if (is_null($row)) {
			return false;
		}

		// konvert ke bentuk Object OK
		$row = @call_user_func('Objective', $row);
		$num = 0;

		$this->db->reset_write();
		if (!$disposition) {
			// insert yang pertama OK
			$this->db->set('CV_Data_Custno',	 $row->field('DM_Custno'));
			$this->db->set('CV_Data_Campaign_Id', $this->_campaignId);
			$this->db->set('CV_Data_FixID',      $row->field('DM_DataFixID'));
			$this->db->set('CV_Data_Dob',        $row->field('DM_Dob'));
			$this->db->set('CV_Data_Membal',     $row->field('DM_DataMembal'));
			$this->db->set('CV_Data_DLDate',     $row->field('DM_DataDLDate'));
			$this->db->set('CV_Data_RzipCode',   $row->field('DM_ZipCode'));
			$this->db->set('CV_Data_LzipCode',   $row->field('DM_OfficeZipCode'));
			$this->db->set('CV_Data_Block',      $row->field('DM_DataBlock', 'intval'));
			$this->db->set('CV_Data_OpenDate',   $row->field('DM_DataOpenDate'));
			$this->db->set('CV_Data_CcExpired',  $row->field('DM_ExpiredCard'));
			$this->db->set('CV_Data_NoOfMonth',  $row->field('DM_DataNoMonth'));
			$this->db->set('CV_Data_AvailXD',    $row->field('DM_DataAvailXD'));
			$this->db->set('CV_Data_AvailSS',    $row->field('DM_DataAvailSS'));
			$this->db->set('CV_Data_CardType',   $row->field('DM_CcTypeName'));
			$this->db->set('CV_Data_Cycle',      $row->field('DM_DataCycle'));
			$this->db->set('CV_Data_Crelimit',   $row->field('DM_CrLimit'));
			$this->db->set('CV_Data_MotherName', $row->field('DM_MotherName'));
			$this->db->set('CV_Data_Penawaran',  $row->field('DM_DataPenawaran'));
			$this->db->insert('t_gn_customer_verification');

			$date = date_create($row->field('TGL_TRANSAKSI'));
			$data = date_format($date, "Y/m/d");

			$this->db->reset_write();
			$this->db->set('CV_Data_Campaign_Id', $this->_campaignId);
			$this->db->set('CV_Data_Custno',	  $row->field('DM_Custno'));
			$this->db->set('CV_Data_FixID',	  $row->field('DM_DataFixID'));
			$this->db->set('TRX_ID',	  $row->field('TRX_ID'));
			$this->db->set('REF_ID',	  $row->field('REF_ID'));
			$this->db->set('MERCHANT_ID',	 $row->field('MERCHANT_ID'));
			$this->db->set('AMOUNT',	 $row->field('AMOUNT'));
			$this->db->set('TGL_TRANSAKSI',	$data);


			// $this->db->duplicate('CV_Data_Custno',		$out->field('DM_Custno'));
			// $this->db->duplicate('CV_Data_Campaign_Id', $this->_campaignId);
			// $this->db->duplicate('CV_Data_Custno',	  $row->field('DM_Custno'));
			// $this->db->duplicate('CV_Data_FixID',	  $row->field('DM_DataFixID'));
			// $this->db->duplicate('TRX_ID',	  $row->field('TRX_ID'));
			// $this->db->duplicate('REF_ID',	  $row->field('REF_ID'));
			// $this->db->duplicate('MERCHANT_ID',	 $row->field('MERCHANT_ID'));
			// $this->db->duplicate('AMOUNT',	 $row->field('AMOUNT'));
			// $this->db->duplicate('TGL_TRANSAKSI',	$data);

			$this->db->insert('t_gn_attr_pctd');
			// $this->db->insert('t_gn_attr_pctd');
			// var_dump($this->db->last_query());

			// jika process Berhasil SIP Ya .
			// if ($this->db->insert('t_gn_customer_verification')) {
			// 	// var_dump($this->db->last_query());
			// 	// die;
			$num++;
			$this->_tots_success_verification += 1;
			// } else {
			//
			// 	$this->_tots_duplicate += 1;
			// }
			// echo $this->db->last_query();
		} else {
			// $num++;
			// $this->_tots_duplicate += 1;
			// $this->_tots_success_verification += 1;
		}

		// jika Customer Id tidak Null OK ,
		if ($disposition) {
			$sql = sprintf("update t_gn_customer_verification a
						inner join t_gn_customer_master b on a.CV_Data_Custno=b.DM_Custno and a.CV_Data_Campaign_Id = b.DM_CampaignId
						set a.CV_Data_CustId=b.DM_Id
						where b.DM_Custno = '%s'", $row->field('DM_Custno'));

			$pctd = sprintf("update t_gn_attr_pctd a
									inner join t_gn_customer_master b on a.CV_Data_Custno=b.DM_Custno and a.CV_Data_Campaign_Id = b.DM_CampaignId
									set a.CV_Data_CustId=b.DM_Id
									where b.DM_Custno = '%s'", $row->field('DM_Custno'));

			if ($this->db->query($sql)) {

				$this->db->query($pctd);
				// var_dump($this->db->last_query());
				// die;
				$num++;
			}
		}
		// return callback data proces sip
		return $num;
	}

	/**
	 * @param  [type] $row [object row ]
	 * @return [type]             [description]
	 */

	private function _set_write_bucket($row = null)
	{
		//display();
		if (is_null($row)) {
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
		if (is_array($result_array))
			foreach ($result_array as $field => $value) {
				// check by check data proces
				$this->check = Objective($array_assoc);
				if ($this->check->field($field)) {
					$this->db->set($array_assoc[$field], $value);
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

		$this->db->insert("t_gn_bucket_customers");
		if ($this->db->affected_rows() < 1) {
			$ths->_mysql_error[] = mysql_error();
		}

		//debug($this->_mysql_error);
		// untuk di masukan && dan data update untk table lain.
		return (int)$this->db->insert_id();
	}

	/**
	 * @param  [type] $CustomerId [description]
	 * @return [type]             [description]
	 */
	public function _set_content($ar_items_source = null)
	{

		if (
			!is_null($ar_items_source)
			and is_array($ar_items_source)
		) {

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
	protected function _set_assignment($DebiturId = 0, $AgentCode = null)
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

		if (!$this->UserId or !$this->CustID) {
			return false;
		}

		// masukan ke table Assigment table  jika sudah ada di assigment
		// kemudian update t_gn_customer_master, Sebagai Last SellerId .


		//  jika User ROOT selain ROOT lihat  dibawahnya
		$this->db->reset_write();

		if (!strcmp($cok->field('HandlingType'), USER_ROOT)) {
			$this->db->set('AssignCustId', $cok->field('AssignCustId'));
			$this->db->set('AssignAdmin', $cok->field('UserId'));
			$this->db->set('AssignDate', $cok->field('AssignDate'));
			$this->db->set('AssignMode', $cok->field('AssignMode'));
			$this->CondID++;
		}
		// ambil hiraki
		else if (!strcmp($cok->field('HandlingType'), USER_ADMIN)) {
			$this->db->set('AssignCustId', $cok->field('AssignCustId'));
			$this->db->set('AssignAdmin', $cok->field('UserId'));
			$this->db->set('AssignDate', $cok->field('AssignDate'));
			$this->db->set('AssignMode', $cok->field('AssignMode'));

			$this->CondID++;
		}

		// jika ACCOUNT MANAGER
		else if (!strcmp($cok->field('HandlingType'), USER_ACCOUNT_MANAGER)) {
			$this->db->set('AssignCustId', $cok->field('AssignCustId'));
			$this->db->set('AssignAdmin', $cok->field('AdministratorId'));
			$this->db->set('AssignAmgr', $cok->field('AccountManager'));
			$this->db->set('AssignDate', $cok->field('AssignDate'));
			$this->db->set('AssignMode', $cok->field('AssignMode'));
			$this->CondID++;
		}
		// ambil hiraki
		else if (!strcmp($cok->field('HandlingType'), USER_MANAGER)) {
			$this->db->set('AssignCustId', $cok->field('AssignCustId'));
			$this->db->set('AssignAdmin', $cok->field('AdministratorId'));
			$this->db->set('AssignAmgr', $cok->field('AccountManager'));
			$this->db->set('AssignMgr', $cok->field('ManagerId'));
			$this->db->set('AssignDate', $cok->field('AssignDate'));
			$this->db->set('AssignMode', $cok->field('AssignMode'));
			$this->CondID++;
		}

		// process di hentikan .
		if (!$this->CondID) {
			return false;
		}
		// process data masukan ke assign

		$this->db->insert('t_gn_assignment');
		if ($this->db->affected_rows() > 0) {
			$this->AssignID = $this->db->insert_id();
		}

		// jika data assgn kosong / 0
		if (!$this->AssignID) {
			return false;
		}

		// this set return to log assigment
		return $this->AssignID;
	}
	/**
	 * @param  [type] $CustomerId [description]
	 * @return [type]             [description]
	 */
	protected function _set_loan_tiering($loan_tiering = array(), $_cust_id = 0)
	{
		$_set_loan_tiering = array();
		$cardno = 0;
		foreach ($loan_tiering as $key => $val) {
			if (strtolower($key) == 'cardno') {
				$cardno = $val;
			} else if (strtolower($key) != 'cardno') {
				$tenor = explode("_", $key);
				if (end($tenor) == 6) {
					$_set_loan_tiering[$_cust_id][6]['cardno'] = $cardno;
					$_set_loan_tiering[$_cust_id][6][$tenor[0]] = $val;
				} else if (end($tenor) == 12) {
					$_set_loan_tiering[$_cust_id][12]['cardno'] = $cardno;
					$_set_loan_tiering[$_cust_id][12][$tenor[0]] = $val;
				} else if (end($tenor) == 24) {
					$_set_loan_tiering[$_cust_id][24]['cardno'] = $cardno;
					$_set_loan_tiering[$_cust_id][24][$tenor[0]] = $val;
				} else if (end($tenor) == 36) {
					$_set_loan_tiering[$_cust_id][36]['cardno'] = $cardno;
					$_set_loan_tiering[$_cust_id][36][$tenor[0]] = $val;
				}
			}
		}
		foreach ($_set_loan_tiering as $keys => $vals) {
			foreach ($vals as $key => $val) {
				$this->db->set('CustomerId', $_cust_id);
				$this->db->set('Cardno', $_set_loan_tiering[$keys][$key]['cardno']);
				$this->db->set('CampaignId', $this->_get_campaignId());
				$this->db->set('Tenor', $key);
				$this->db->set('LoanAmount', $_set_loan_tiering[$keys][$key]['loan']);
				$this->db->set('Installment', $_set_loan_tiering[$keys][$key]['install']);
				$this->db->set('Rate', $_set_loan_tiering[$keys][$key]['interest']);
				$this->db->set('UploadDate', date('Y-m-d H:i:s'));

				$this->db->insert('t_gn_loan_tiering');
				if ($this->db->affected_rows() > 0) {
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

		$loan_tiering = array();
		$array_assoc = array();

		// next of process langsung return false;

		$cond = is_array($this->_upload_table_data);
		if (!$cond) {
			return false;
		}


		// ambil nilai Product Untuk dimasukan ke DB berdasrkan
		// campaign Upload Data .

		$this->_writeProductId = ProductByCampaignID($this->_campaignId);

		// $this->blk = Singgleton( 'M_MgtBlacklist' );
		// then next process

		$ths->_mysql_error = null;
		if (is_array($this->_upload_table_data))
			foreach ($this->_upload_table_data as $n => $values) {

				$val = Objective($values); // convert_cyr_string
				// cuci data terlebih dahulu sebelum masuk ke table
				// master customer .

				$val->add('DM_Custno', 			$val->field('DM_Custno', array('SetStringVal')));
				$val->add('DM_Dob', 			$val->field('DM_Dob', array('SetDateEnglish')));
				$val->add('DM_FirstName', 		$val->field('DM_FirstName', array('SetStringVal', 'SetCapital')));
				$val->add('DM_MotherName', 		$val->field('DM_MotherName', array('SetStringVal', 'SetCapital')));
				$val->add('DM_HomePhoneNum', 	$val->field('DM_HomePhoneNum', array('SetStringVal')));
				$val->add('DM_OfficePhoneNum', 	$val->field('DM_OfficePhoneNum', array('SetPhoneNumber')));
				$val->add('DM_MobilePhoneNum', 	$val->field('DM_MobilePhoneNum', array('SetPhoneNumber')));
				$val->add('DM_OtherPhoneNum',	$val->field('DM_OtherPhoneNum', array('SetPhoneNumber')));
				$val->add('DM_CrLimit', 		$val->field('DM_CrLimit', array('SetStringVal')));
				$val->add('DM_CcTypeName', 		$val->field('DM_CcTypeName', array('SetStringVal')));
				$val->add('DM_AddressLine1', 	$val->field('DM_AddressLine1', array('SetCapital')));
				$val->add('DM_AddressLine2', 	$val->field('DM_AddressLine2', array('SetCapital')));
				$val->add('DM_AddressLine3', 	$val->field('DM_AddressLine3', array('SetCapital')));
				$val->add('DM_AddressLine4', 	$val->field('DM_AddressLine4', array('SetCapital')));
				$val->add('DM_CcLimit', 		$val->field('DM_CcLimit', array('SetStringVal')));

				// khusus untuk usage

				$val->add('DM_DataFixID', 		$val->field('DM_DataFixID', array('SetStringVal')));
				$val->add('DM_ExpiredCard', 	$val->field('DM_ExpiredCard', array('SetStringVal')));
				$val->add('DM_DataMembal', 		$val->field('DM_DataMembal', array('SetStringVal')));
				$val->add('DM_DataDLDate', 		$val->field('DM_DataDLDate', array('SetDateEnglish')));
				$val->add('DM_ZipCode', 		$val->field('DM_ZipCode', array('SetStringVal')));
				$val->add('DM_OfficeZipCode', 	$val->field('DM_OfficeZipCode', array('SetStringVal')));
				$val->add('DM_DataOpenDate', 	$val->field('DM_DataOpenDate', array('SetDateEnglish')));
				$val->add('DM_DataNoMonth', 	$val->field('DM_DataNoMonth', array('SetStringVal')));
				$val->add('DM_DataAvailXD', 	$val->field('DM_DataAvailXD', array('SetStringVal')));
				$val->add('DM_DataAvailSS', 	$val->field('DM_DataAvailSS', array('SetStringVal')));
				$val->add('DM_DataCycle', 		$val->field('DM_DataCycle', array('SetStringVal')));
				$val->add('DM_DataPenawaran',	$val->field('DM_DataPenawaran', array('SetStringVal')));

				// then will get write to bucket data on this process

				if ($this->_writeToBucketData) {
					$this->_writeBucketDataId = $this->_set_write_bucket($val);
				}
				// var_dump($this->_writeToBucketData);
				// die;
				// jika ada process bandingkan ke blacklist tambah disinisaja ya .

				$val->add('DM_Age', $val->field('DM_Dob', 'SetAge'));

				// jika kondisi 2 tersebut tidak terpenuhi process data tersebut
				// berikut ini.

				$result_array = null;
				$result_array = $val->fetch_assoc();

				// 	@call_user_func_array untuk data verifikasi .
				@call_user_func_array(
					array($this, '_set_write_verification'),
					array(0, $result_array)
				);

				// push data to DB setelah data di cuci
				// hingga bersih.

				$this->db->reset_write();
				if (is_array($result_array))
					foreach ($result_array as $field => $value) {

						if ($field != 'REF_ID'  && $field != 'TRX_ID' && $field != 'MERCHANT_ID' && $field != 'AMOUNT' && $field != 'TGL_TRANSAKSI') {
							// var_dump($field);
							$this->db->set($field, $value);
						}
						//data hilman menhilkangkan yg ditemplate
					}
				// die;

				// set on productID

				$this->db->set('DM_BucketId',    		$this->_writeBucketDataId);
				$this->db->set('DM_ProductId',   		$this->_writeProductId);
				$this->db->set('DM_Recsource',   		$this->_recsource);
				$this->db->set('DM_CampaignId',  		$this->_campaignId);
				$this->db->set('DM_UploadedTs',  		$this->_upload_data_date);
				$this->db->set('DM_UploadedById',		$this->_upload_data_user);
				$this->db->set('DM_UploadId',    		$this->_field_uploadId);
				$this->db->set('DM_DateExpired', 		$this->_upload_expired_date);
				$this->db->set('DM_VerificationFlags',  $this->_VerificationFlags);

				// cek apakah benar table yang dimasukan .

				if (is_null($this->_upload_table_name)) {
					$this->_tots_failed += 1;
					continue;
				}
				// t_gn_customer_master
				// var_dump($this->_upload_table_name);
				// die;

				// lanjutkan ke process insert ke table master
				// data OK
				$callDispositionID = 0;
				$this->db->insert($this->_upload_table_name, null);
				// var_dump()
				// var_dump($this->db->last_query());
				// die;
				if ($this->db->affected_rows() > 0) {
					$callDispositionID = $this->db->insert_id();
					@call_user_func_array(array($this, '_set_write_verification'), array(1, $result_array));
				}

				// jika increment - nya kosong di skip saja .
				if (!$callDispositionID) {
					//$this->_tots_failed+=1;
					@call_user_func_array(array($this, '_set_write_verification'), array(1, $result_array));
					continue;
				}

				// hasil dari Process OK
				if ($callDispositionID) {
					$this->_tots_success += 1;
				}

				// jika process Berhasil maka ambil untuk di assigment data
				// jika insert ketable customer OK update table di Bukcet dengan char "Y"

				if ($this->_writeBucketDataId) {
					$this->_set_update_bucket($this->_writeBucketDataId);
				}

				// insert ke table assigment dengan data balikan dari customer
				$this->_writeAssignDataId = $this->_set_assignment($callDispositionID);
				if ($this->_writeAssignDataId) {
					$this->_set_write_assignlog($this->_writeAssignDataId);
				}

				// end proc_close
			}

		//print_r($error);
		// end foreach

	}
	/**
	 * @param  [type] $CustomerId [description]
	 * @return [type]             [description]
	 */

	function _gen_custno()
	{

		$this->num = '000000000001';
		$sql = "select max(CustomerId) as ujung from t_gn_customer";
		$qry = $this->db->query($sql);

		if ($qry->num_rows() > 0) {
			$this->max = ((int)$qry->result_singgle_value() + 1);
			$this->num = str_pad($this->max, 12, "0", STR_PAD_LEFT);
		}
		return $this->num;
	}

	/**
	 * @param  [type] $CustomerId [description]
	 * @return [type]             [description]
	 */

	function testing()
	{
		return "okaaay! xxx";
	}

	// end class
}

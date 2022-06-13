<?php

/**
 * Enigma User Interface
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		Enigma User Interface
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2011, razaki, Inc.
 * @license		http://razakitechnology.com/user_guide/license.html
 * @link		http://razakitechnology.com
 * @since		Version 1.0
 * @filesource
 */
class M_SecondProduct extends EUI_Model
{


	// -----------------------------------------------------------

	/* 
 * Method 		AddUser 
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */

	private static $Instance = null;

	// -----------------------------------------------------------

	/* 
 * Method 		AddUser 
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */

	public static function &Instance()
	{
		if (is_null(self::$Instance)) {
			self::$Instance = new self();
		}
		return self::$Instance;
	}

	// ----------------------------------------------------------------------------------------------------------------
	/*
 * @ pack ............... : get Account Status By User Login 
 * @ auth ............... : uknown 
 * @ date ............... : 2016-11-16 
 *
 */


	function __construct()
	{
		$this->load->model(array('M_Website', 'M_UserRole'));
	}


	// ----------------------------------------------------------------------------------------------------------------
	/*
 * @ pack ............... : get Account Status By User Login 
 * @ auth ............... : uknown 
 * @ date ............... : 2016-11-16 
 *
 */


	function _select_row_page_size($HandlingType)
	{
		$out = ObjectRequest();
		// $this->EUI_Page->_setPage(DEFAULT_COUNT_PAGE);
		// --- select an array page  --------------------------------------------------------------------
		if ($HandlingType == 8) {
			$this->EUI_Page->_setArraySelect(array(
				"ver.CV_Data_Custno as KurirID"      => array("KurirID", "KurirID", "primary"),
				"ver.CV_Data_CustId as CV_Data_CustId"      => array("CV_Data_CustId", "Customer Id"),
				"ver.CV_Data_Custno as CV_Data_Custno"      => array("CV_Data_Custno", "Customer No"),
				"a.DM_FirstName as DM_FirstName"  => array("DM_FirstName", "Nama"),
				"a.DM_MotherName as DM_MotherName"  => array("DM_MotherName", "Nama Ibu Kandung"),
				"ver.CV_Data_FixID as CV_Data_FixID"  => array("CV_Data_FixID", "FIX ID"),
				"ver.CV_Data_CardType as CV_Data_Custno2"  => array("CV_Data_Custno2", "Jenis Kartu"),
				"son.CallReasonDesc as CallReasonDesc"  => array("CallReasonDesc", "Status"),
				"a.DM_UploadedTs as DM_UploadedTs"  => array("DM_UploadedTs", "Tanggal Update"),
				"gn.CampaignCode as CampaignCode"            => array("CampaignCode", "Campaign"),
			));
		} else if ($HandlingType == 22) {
			$this->EUI_Page->_setArraySelect(array(
				"ver.CV_Data_Custno as KurirID"      => array("KurirID", "KurirID", "primary"),
				"ver.CV_Data_Custno as CV_Data_Custno"      => array("CV_Data_Custno", "Customer No"),
				"a.DM_FirstName as DM_FirstName"  => array("DM_FirstName", "Nama"),
				"ver.CV_Data_CardType as CV_Data_Custno2"  => array("CV_Data_Custno2", "Jenis Kartu"),
				"son.CallReasonDesc as CallReasonDesc"  => array("CallReasonDesc", "Status"),
				"a.DM_UploadedTs as DM_UploadedTs"  => array("DM_UploadedTs", "Tanggal Update"),
				"gn.CampaignCode as CampaignCode"            => array("CampaignCode", "Campaign"),
			));
		}

		$this->EUI_Page->_setFrom("t_gn_customer_master a ", true);
		$this->EUI_Page->_setJoin("t_gn_customer_verification ver ", "a.DM_Id=ver.CV_Data_CustId", "INNER");
		$this->EUI_Page->_setJoin("t_lk_callreason son ", "a.DM_LastReasonId=son.CallReasonId", "INNER");
		$this->EUI_Page->_setJoin("t_gn_campaign gn ", "gn.CampaignId=ver.CV_Data_Campaign_Id", "INNER");
		// ----------- filter  ---------------------------
		$this->EUI_Page->_setWhere("AND gn.CampaignStatusFlag=1");
		$this->EUI_Page->_setLikeCache("ver.CV_Data_Custno", "CV_Data_Custno", TRUE);
		$this->EUI_Page->_setLikeCache("a.DM_FirstName", "DM_FirstName", TRUE);
		if (strpos($this->EUI_Page->_compile, 'LIKE') !== false) {
			$this->EUI_Page->_setPage(DEFAULT_COUNT_PAGE);
		} else {
			$this->EUI_Page->_setPage(0);
		}
		return $this->EUI_Page;
	}

	// ----------------------------------------------------------------------------------------------------------------
	/*
 * @ pack ............... : get Account Status By User Login 
 * @ auth ............... : uknown 
 * @ date ............... : 2016-11-16 
 *
 */
	function _select_row_page_content($HandlingType)
	{


		$flag = 1;
		$out = ObjectRequest();
		$this->EUI_Page->_postPage($out->get_value('v_page'));
		// --- select an array page  --------------------------------------------------------------------
		if ($HandlingType == 8) {
			$this->EUI_Page->_setArraySelect(array(
				"ver.CV_Data_Custno as KurirID"      => array("KurirID", "KurirID", "primary"),
				"ver.CV_Data_CustId as CV_Data_CustId"      => array("CV_Data_CustId", "Customer Id"),
				"ver.CV_Data_Custno as CV_Data_Custno"      => array("CV_Data_Custno", "Customer No"),
				"a.DM_FirstName as DM_FirstName"  => array("DM_FirstName", "Nama"),
				"a.DM_MotherName as DM_MotherName"  => array("DM_MotherName", "Nama Ibu Kandung"),
				"ver.CV_Data_FixID as CV_Data_FixID"  => array("CV_Data_FixID", "FIX ID"),
				"ver.CV_Data_CardType as CV_Data_Custno2"  => array("CV_Data_Custno2", "Jenis Kartu"),
				"son.CallReasonDesc as CallReasonDesc"  => array("CallReasonDesc", "Status"),
				"a.DM_UploadedTs as DM_UploadedTs"  => array("DM_UploadedTs", "Tanggal Update"),
				"gn.CampaignCode as CampaignCode"            => array("CampaignCode", "Campaign"),				
				"ver.CV_Data_AvailSS as CV_Data_AvailSS"            => array("CV_Data_AvailSS", "Aval SS"),				
				
			));
		} else if ($HandlingType == 22) {
			$this->EUI_Page->_setArraySelect(array(
				"ver.CV_Data_Custno as KurirID"      => array("KurirID", "KurirID", "primary"),
				"ver.CV_Data_Custno as CV_Data_Custno"      => array("CV_Data_Custno", "Customer No"),
				"a.DM_FirstName as DM_FirstName"  => array("DM_FirstName", "Nama"),
				"ver.CV_Data_CardType as CV_Data_Custno2"  => array("CV_Data_Custno2", "Jenis Kartu"),
				"son.CallReasonDesc as CallReasonDesc"  => array("CallReasonDesc", "Status"),
				"a.DM_UploadedTs as DM_UploadedTs"  => array("DM_UploadedTs", "Tanggal Update"),
				"gn.CampaignCode as CampaignCode"            => array("CampaignCode", "Campaign"),
				"ver.CV_Data_AvailSS as CV_Data_AvailSS"            => array("CV_Data_AvailSS", "Aval SS"),	
			));
		}
		$this->EUI_Page->_setFrom("t_gn_customer_master a ");
		$this->EUI_Page->_setJoin("t_gn_customer_verification ver ", "a.DM_Id=ver.CV_Data_CustId", "INNER");
		$this->EUI_Page->_setJoin("t_lk_callreason son ", "a.DM_LastReasonId=son.CallReasonId", "INNER");
		$this->EUI_Page->_setJoin("t_gn_campaign gn ", "gn.CampaignId=ver.CV_Data_Campaign_Id", "INNER");
		// ----------- filter  ---------------------------
		$this->EUI_Page->_setWhere(" AND gn.CampaignStatusFlag=1");
		$this->EUI_Page->_setLikeCache("ver.CV_Data_Custno", "CV_Data_Custno", TRUE);
		$this->EUI_Page->_setLikeCache("a.DM_FirstName", "DM_FirstName", TRUE);
		// -----------then limit on here ---------------------------------
		if (strpos($this->EUI_Page->_compile, 'LIKE') !== false) {
			// $this->EUI_Page->_setPage(DEFAULT_COUNT_PAGE);
		} else {
			$this->EUI_Page->_setPage(0);
			$this->EUI_Page->_setLimit();
		}
		// echo '<pre>';
		// print_r($this->EUI_Page->_compile);
		// echo '</pre>';
		// echo $this->EUI_Page->_getCompiler();
	}


	// -------------------------------------------------------------

	/* 
 * Method 		_select_row_page
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */

	function _select_row_page_row($HandlingType)
	{
		$this->_select_row_page_content($HandlingType);
		if ($this->EUI_Page) {
			return $this->EUI_Page->_get();
		}
		return FALSE;
	}

	// -------------------------------------------------------------

	/* 
 * Method 		_select_num_page
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */

	function _select_row_page_num()
	{
		$arr_num_page = $this->EUI_Page->_getNo();
		if (is_null($arr_num_page) == FALSE) {
			return $arr_num_page;
		}
	}


	// -------------------------------------------------------------

	/* 
 * Method 		_select_num_page
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */

	function _select_row_layout_data($LayoutId = 0, $Call = null)
	{

		$sql = sprintf("select ver.CV_Data_Id as CV_Data_Id, ver.CV_Data_CustId as CV_Data_CustId, ver.CV_Data_Custno as CV_Data_Custno, a.DM_FirstName as DM_FirstName, ver.CV_Data_CardType as CV_Data_CardType, son.CallReasonDesc as CallReasonDesc, a.DM_UploadedTs as DM_UploadedTs, gn.CampaignCode as CampaignCode from t_gn_customer_master a INNER JOIN t_gn_customer_verification ver ON a.DM_Id=ver.CV_Data_CustId INNER JOIN t_lk_callreason son ON a.DM_LastReasonId=son.CallReasonId INNER JOIN t_gn_campaign gn ON gn.CampaignId=ver.CV_Data_Campaign_Id where ver.CV_Data_Custno =%d", $LayoutId);

		$rs  = $this->db->query($sql);
		if (
			$rs->num_rows() > 0
			and ($row = $rs->result_first_assoc())
		) {
			$this->ar_list = $row;
		}
		// -- if have call event data  ---

		if (is_null($Call)) {
			return $this->ar_list;
		}
		if (function_exists($Call)) {
			return call_user_func($Call, $this->ar_list);
		}
		return $this->ar_list;
	}

	// -------------------------------------------------------------

	// -------------------------------------------------------------

	/* 
 * Method 		
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
	function _save_courier($out = null)
	{
		// clear of the cache data set object 
		if (!is_object($out) or !$out->fetch_ready()) {
			return FALSE;
		}
		$this->db->set("KurirCode", $out->get_value('KurirCode'));
		$this->db->set("KurirDesc", $out->get_value('KurirDesc'));
		$this->db->set("flag", $out->get_value('flag'));
		$this->db->insert("t_lk_kurir");
		if ($this->db->insert_id() > 0) {
			return TRUE;
		}
		return FALSE;
	} // -- end  function --



	// ---------------------------------------------------------------------------------------------------------------
	// ----------------------------------------------------------------------------------------------------------------
	/*
 * @ pack ............... : Delete data Curier
 * @ auth ............... : Didi
 * @ date ............... : 2018-02-14 
 *
 */
	function _delete_data_courier($dataURI  = null)
	{
		//	debug($dataURI);
		// check by richeck data OK .
		if (!is_object($dataURI)) {
			return false;
		}
		// query data on model delete bucket kuota  user process 
		// tested on here .

		$sql = sprintf("delete from t_lk_kurir where KurirID='%s'", $dataURI->field('KurirID'));
		//echo $sql;
		$qry = $this->db->query($sql);
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}
	// ----------------------------------------------------------------------------------------------------------------
	/*
 * @ pack ............... : Update data courier
 * @ auth ............... : Didi
 * @ date ............... : 2018-02-14 
 *
 */
	function _setUpdateSecondProduct($out  = null)
	{
		// var_dump($out->get_value('New_CV_Data_CustId'));
		// var_dump($out->get_value('Old_CampaignCode'));
		// var_dump('campaign baru', $out->get_value('New_CampaignCode'));
		// var_dump($out->get_value('CV_Data_Id'));
		// die;

		if (!is_object($out)) {
			return FALSE;
		}

		$this->db->reset_write();
		$this->db->set("CV_Data_CustId", $out->get_value('New_CV_Data_CustId'));
		$this->db->set("CV_Data_Campaign_Id", $out->get_value('New_CampaignCode'));
		$this->db->where("CV_Data_Id", $out->get_value('CV_Data_Id'));
		$date = date('Y-m-d H:I:S');

		// if ($this->db->update('t_gn_customer_verification')) {
		if ($this->db->update('t_gn_customer_verification')) {

			$this->db->reset_write();
			$this->db->set('Custno',				$out->get_value('CV_Data_Custno'));
			$this->db->set('Oldcampaign',			$out->get_value('Old_CampaignCode'));
			$this->db->set('Newcampaign',			$out->get_value('New_CampaignCode'));
			$this->db->set('Tanggal_update',		$date);
			$this->db->set('Updateby',				_get_session('UserId'));
			$this->db->set('old_custid',			$out->get_value('Old_CV_Data_CustId'));
			$this->db->set('new_custid',			$out->get_value('New_CV_Data_CustId'));

			//jika terjadi duplicate
			// $this->db->duplicate('TR_SetoranSebelum',		$out->field('TR_SetoranSebelum') );
			// $this->db->duplicate('TR_SetoranTambahan',	$out->field('TR_SetoranTambahan') );
			// $this->db->duplicate('TR_SetoranTotal',		$out->field('TR_SetoranTotal') );
			// $this->db->duplicate('TR_TenorSebelum', 		$out->field('TR_TenorSebelum') );
			// $this->db->duplicate('TR_TenorTambahan', 		$out->field('TR_TenorTambahan') );
			// $this->db->duplicate('TR_TenorTotal', 		$out->field('TR_TenorTotal') );
			// $this->db->duplicate('TR_QCID',				$out->field('TR_QCID'));

			$this->db->insert('update_kartu_log');
			// var_dump($this->db->last_query());
			// die;

			return TRUE;
		}
		return FALSE;
	}

	function _getCampaign()
	{
		$sql = sprintf("SELECT * FROM t_gn_campaign a
		WHERE 
		a.CampaignStatusFlag=1");
		$rs  = $this->db->query($sql);
		return $rs->result();
	}
}

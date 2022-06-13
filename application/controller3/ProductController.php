<?php if (!defined('BASEPATH')) exit('No direct script access allowed');



ini_set("error_reporting", 1);
ini_set("display_errors", 1);


class ProductController extends EUI_Controller
{

	public $formname; // form product name
	public $appendform; // append form to div class or something
	public $returncatchdata; //  return catch data
	public $CampaignName;
	public $CustomerId;
	public $ModelName;

	// data save define
	public $datacustomer;
	public $datacreditcard;
	public $agent_hierarchy;


	/**
	 * [__construct description]
	 * define return all data
	 */
	public function __construct()
	{
		parent::__construct();

		$this->returncatchdata = array();
		$ModelName = "M_ProductController";
		$this->ModelName = $ModelName;
		$this->load->model(array($this->ModelName, "M_ProductLookup"));
		$this->load->helper(array(
			"EUI_Object"
		));

		// get hierarchy by agent ;
		$this->agent_hierarchy = $this->M_ProductLookup->_get_hierarchy();
	}

	public function postFrmPctd()
	{
		// var_dump($_POST['cbx']);
		// echo '<br/>';
		// var_dump($_POST['TX_Usg_Tenor']);
		// die;
		$customer = $this->db->query('SELECT * FROM t_gn_customer_master WHERE DM_Id = ' . $_POST['CV_Data_CustId'][0])->row_array();
		$custVerif = $this->db->query('SELECT * FROM t_gn_customer_verification WHERE CV_Data_CustId = ' . $_POST['CV_Data_CustId'][0] . ' AND CV_Data_FixID = "' . $_POST['CV_Data_FixID'][0] . '"')->row_array();
		$assigment = $this->db->query('SELECT * FROM t_gn_assignment WHERE AssignCustId = ' . $_POST['CV_Data_CustId'][0])->row_array();
		$now = date('Y-m-d H:i:s');
		$this->EUI_Session->_get_session('UserId');
		if ($_POST['cbx'] != null) {
			foreach ($_POST['cbx'] as $key => $item) {
				if ($_POST['TX_Usg_Tenor'][$item] == '' || $_POST['TX_Usg_Tenor'][$item] == null) {
					echo '<script>history.back(alert("anda belum memilih tenor merchant ' . $_POST['MERCHANT_ID'][$item] . ' !"))</script>';
					die();
				}
				$Id = $_POST['Id'][$item];
				$refID = $_POST['REF_ID'][$item];
				$fixID = $_POST['CV_Data_FixID'][$item];
				$trxID = $_POST['TRX_ID'][$item];
				$cardType = $custVerif['CV_Data_CardType'];
				$custno = $_POST['CV_Data_Custno'][$item];
				$custID = $_POST['CV_Data_CustId'][$item];
				$custName = $customer['DM_FirstName'];
				$merchant = $_POST['MERCHANT_ID'][$item];
				$amount = $_POST['AMOUNT'][$item];
				$tgl = $_POST['TGL_TRANSAKSI'][$item];
				$penawaran = $_POST['PRD_Data_Kode'][$item];
				$tenor = $_POST['TX_Usg_Tenor'][$item];
				$amgr = $assigment['AssignAmgr'];
				$mgr = $assigment['AssignMgr'];
				$spv = $assigment['AssignSpv'];
				$seller = $assigment['AssignSelerId'];
				// var_dump($tenor);
				// echo '<br/>';
				if ($penawaran == '0.8%') {
					$mid = 1415;
				} else if ($penawaran == '0.75%') {
					$mid = 1528;
				} else if ($penawaran == '0.7%' || $penawaran == '0.65%') {
					$mid = 1529;
				} else if ($penawaran == '0%') {
					$mid = 631;
				}
				$sql = "INSERT INTO t_gn_frm_pctd
				(TX_Usg_CustomerName, REF_ID, TX_Usg_FixID, TRX_ID, TX_Usg_JenisKartu, TX_Usg_Custno, TX_Usg_CustId, MERCHANT_ID, AMOUNT, TGL_TRANSAKSI, TX_Data_Penawaran, TX_Usg_Tenor, M_id, TX_Usg_AmgrKode, TX_Usg_MgrKode, TX_Usg_SpvKode, TX_Usg_SellerId, TX_Usg_SellerKode, TX_Usg_UpdatedTs)
				VALUES
				('$custName', '$refID', '$fixID', '$trxID', '$cardType', '$custno', '$custID', '$merchant', '$amount', '$tgl', '$penawaran', '$tenor', '$mid', '$amgr', '$mgr', '$spv', '$seller', '$seller', '$now')";
				// var_dump($sql);
				// echo '<br/>';
				$this->db->query($sql);
				$sql2 = "UPDATE t_gn_attr_pctd SET status = 0 WHERE Id = " . $Id;
				$this->db->query($sql2);
			}
			redirect($_SERVER['HTTP_REFERER']);
		} else {
			echo '<script>history.back(alert("anda belum memilih transaksi !"))</script>';
		}
	}

	public function DeleteTransactionPctd()
	{
		$_get_data = _get_all_request();
		if (is_array($_get_data)) {
			$gd = new EUI_Object($_get_data);
		}
		$sql = "DELETE FROM t_gn_frm_pctd WHERE TX_Usg_Id = " . $gd->get_value('id_frm_pctd');
		$this->db->query($sql);
		$sql2 = "UPDATE t_gn_attr_pctd SET status = 1 WHERE REF_ID = " . (int)$gd->get_value('ref_id');
		$this->db->query($sql2);
		$call_back = array("success" => 1);
		echo json_encode($call_back);
	}

	public function FormControlPCTD($CampaignName = "", $ProgramName = "", $VerficationId = "")
	{
		$this->CampaignName = $CampaignName;
		$this->VerficationId = $VerficationId;
		$this->ProgramName = $ProgramName;
		$this->CustomerId = UR()->field('CustomerId');
		$this->fixID = UR()->field('fixID');
		$this->penawaran = UR()->field('penawaran');
		$form_builder_folder = trim($CampaignName) . "/" . $ProgramName . "/form_index";
		$detail_transaction = $this->{base_class_model($this)}->_get_row_detail_transaction_pctd($this->CustomerId, $this->fixID);


		$detail_transaction2 = $this->{base_class_model($this)}->_get_row_detail_transaction_pctd2($this->CustomerId, $this->fixID);

		$detail_tenor = $this->{base_class_model($this)}->_get_tenor_pctd($this->penawaran);
		$detail_form_builder = array(
			"folder" 			=> trim($this->CampaignName) . "/",
			"subfolder"			=> trim($this->ProgramName) . "/",
			"DetailTransaction"	=> $detail_transaction,
			"DetailTransaction2"	=> $detail_transaction2,
			"tenor"		=>	$detail_tenor
		);
		$this->load->form($form_builder_folder, $detail_form_builder);
	}

	public function FormControlDetailPCTD($CampaignName = "", $ProgramName = "", $VerficationId = "")
	{
		$this->CampaignName = $CampaignName;
		$this->VerficationId = $VerficationId;
		$this->ProgramName = $ProgramName;
		$this->CustomerId = UR()->field('CustomerId');
		$this->fixID = UR()->field('fixID');
		$form_builder_folder = trim($CampaignName) . "/" . $ProgramName . "/detail/form_index";
		$detail_transaction = $this->{base_class_model($this)}->_get_row_detail_transaction_pctd($this->CustomerId, $this->fixID);
		$detail_form_builder = array(
			"folder" 			=> trim($this->CampaignName) . "/",
			"subfolder"			=> trim($this->ProgramName) . "/",
			"DetailTransaction"	=> $detail_transaction
		);
		$this->load->form($form_builder_folder, $detail_form_builder);
	}

	/**
	 * [index description]
	 * @return [type] [description]
	 */
	public function index()
	{
	}

	/**
	 * [getLK description]
	 * @param  string $param [description]
	 * @return [type]        [description]
	 * Level Kartu 
	 */
	public function getLK($param = "")
	{
		$get_data = _get_all_request();
		$gd = new EUI_Object($get_data);

		if ($param == "cardlevel") {
			$AffinityCardLevel = $this->M_ProductLookup->AffinityCardLevel($gd->get_value("id"));
			echo "<option value='0'>- PILIH -</option>";
			foreach ($AffinityCardLevel as $acl) {
				echo "<option value='" . $acl["id"] . "'>" . $acl["name"] . "</option>";
			}
		}
	}



	/**
	 * [PaperWork description]
	 * structure url for get url form
	 * get data and post form
	 * Method / CampaignName / CustomerId 
	 */
	public function PaperWork($CampaignName = "", $CustomerId = "")
	{
		$this->CampaignName = $CampaignName;
		$this->CustomerId   = $CustomerId;

		// var_dump($this->CustomerId );
		// die;
		// get campaign name from M_ProductController/_get_campaign_name or ProductName
		// $ListCampaignName = $this->{base_class_model($this)}->_get_campaign_name();

		$ListCampaignName = $this->{base_class_model($this)}->_get_product_name($CustomerId);

		//var_dump($ListCampaignName);
		//var_dump($ListCampaignName);

		// if get campaign name parameter is found in list campaign

		if (in_array($this->CampaignName, $ListCampaignName)) {
			// start to build form
			$form_builder_folder = trim($this->CampaignName) . "/form_index";

			$CustomerMaster = $this->{base_class_model($this)}->_get_customer($CustomerId);
			// echo "<pre>";
			// var_dump($CustomerMaster);
			// die;
			$detail_form = $this->{base_class_model($this)}->DetailFormSubmitted($CampaignName, $CustomerMaster->get_value("DM_Custno"));
			$AddTrans = $this->{base_class_model($this)}->_get_addon_trans_detail($CustomerMaster->get_value("DM_Custno"));

			/* [FS] Get handling type SPV */
			$spvdisabled = $this->{base_class_model($this)}->_get_handling(_have_get_session("UserId"));

			$detail_form_builder = array(
				"folder" 		 => trim($this->CampaignName) . "/",
				"CustomerNumber" => $CustomerMaster->get_value("DM_Custno"),
				"Lookup"	     => $this->M_ProductLookup,
				"Detail" 		 => new EUI_Object($detail_form),
				"DetailJs" 	     => $detail_form,
				"CM"			 => $CustomerMaster,
				// addon
				"AddTrans"		 => $AddTrans,
				/* [FS] DISABLED SPV*/
				"spvdisabled" => $spvdisabled
			);


			// echo "<pre>";
			// print_r($detail_form);
			// echo "</pre>";
			$this->load->form($form_builder_folder, $detail_form_builder);
		} else {
		}
	}

	public function Save()
	{
		$this->callBackMsg = array('success' => 0);

		// DEFINE dataall process on client 

		$out = UR();
		$cok = CK();

		//then get all process 
		if (!$cok->find_value('UserId')) {
			echo json_encode($cond);
			return false;
		}


		// Singgleton 
		// $row = Singgleton("M_ProductController");
		// if( $row->_set_row_save_tapenas( $out ) ){
		// 	$this->callBackMsg = array('success' => 1 );
		// }
		$Test = $this->M_ProductController->_set_row_save_tapenas($out);
		if ($Test) {
			$this->callBackMsg = array('success' => 1);
		}

		// return process client 
		printf("%s", json_encode($this->callBackMsg));
		return false;
	}


	/**
	 * [FormLoader description]
	 * @param string $CampaignName [description]
	 * @param string $Folder       [description]
	 * @param string $ProgramName  [nama program tambahan]
	 * @param string $CustomerId   [description]
	 
	 * @date 			2017-09-15		
	 */
	public function FormControl($CampaignName = "", $ProgramName = "", $VerficationId = "")
	{
		// echo "test";

		// simpan data ke bentuk object / variabel .	
		$this->CampaignName = $CampaignName;
		$this->VerficationId = $VerficationId;
		$this->ProgramName = $ProgramName;
		$this->CustomerId = UR()->field('CustomerId');

		// DATA CUSTOMERID GET BY HEADER GET 
		// FILTER_VALIDATE_INT / filter_var as a function
		//var_dump($this->CampaignName,"listcampaignbefore");
		$ListCampaignName = $this->{base_class_model($this)}->_get_campaign_name();
		// echo "<pre>";
		// var_dump($ListCampaignName, "listcampaign");
		// var_dump($CampaignName, "CampaignName");
		// var_dump(in_array($CampaignName, $ListCampaignName));
		// die;
		// check by richek Process 
		if (in_array($CampaignName, $ListCampaignName)) {
			// echo "campaign";
			// start to build form
			$form_builder_folder = trim($CampaignName) . "/" . $ProgramName . "/form_index";

			$CustomerMaster = $this->{base_class_model($this)}->_get_customer($this->CustomerId);
			$CustNo = $CustomerMaster->field("DM_Custno");

			// ambil data jika sudah pernah melakukan save data ke table 
			// transaction process .

			$detail_form = $this->{base_class_model($this)}->DetailFormSubmitted($CampaignName, $CustNo, $this);
			//$detail_form = $this->{base_class_model($this)}->DetailFormSubmitted($CampaignName , $CustomerMaster->get_value("DM_Custno")  ,$this);
			// echo "<pre>";
			// var_dump($detail_form);
			// die;
			$detail_trans = $this->{base_class_model($this)}->_get_row_usage_transaction($CustNo, $this);
			$detail_form_builder = array(
				"folder" 			=> trim($this->CampaignName) . "/",
				"subfolder"			=> trim($this->ProgramName) . "/",
				"CustomerNumber" 	=> $CustNo,
				"Lookup"			=> $this->M_ProductLookup,
				"Detail" 			=> $detail_form,
				"DetailTransaction"	=> $detail_trans,
				"CM"				=> $CustomerMaster
			);
			// echo "<pre>";
			// var_dump($detail_form_builder);

			// Buil data form 	
			$this->load->form($form_builder_folder, $detail_form_builder);
		}
	}

	public function FormTapenas($CampaignName = "", $ProgramName = "")
	{

		// simpan data ke bentuk object / variabel .	
		$this->CampaignName = $CampaignName;
		$this->ProgramName = $ProgramName;
		$this->CustomerId = UR()->field('CustomerId');
		$this->TapenasId = UR()->field('TapenasId');

		// DATA CUSTOMERID GET BY HEADER GET 
		// FILTER_VALIDATE_INT / filter_var as a function

		$ListCampaignName = $this->{base_class_model($this)}->_get_campaign_name();

		// check by richek Process 
		if (in_array($CampaignName, $ListCampaignName)) {

			// start to build form
			$form_builder_folder = trim($CampaignName) . "/" . $ProgramName . "/form_index";
			$CustomerMaster = $this->{base_class_model($this)}->_get_customer($this->CustomerId);
			$CustomerTapenas = $this->{base_class_model($this)}->_get_customer_tapenas($this->TapenasId);
			$CustId = $CustomerTapenas->field("TapenasId");
			$CustNo = $CustomerMaster->field("DM_Custno");
			// print_r($ProgramName);
			// ambil data jika sudah pernah melakukan save data ke table 
			// transaction process .

			$detail_form = $this->{base_class_model($this)}->DetailFormSubmitted($CampaignName, $CustNo, $this);
			$detail_tape = $this->{base_class_model($this)}->_get_row_tapenas($CustId);
			$cek_row_tapenas = $this->{base_class_model($this)}->_get_save_tapenas($CustId);
			$qcid	= $this->{base_class_model($this)}->getSpvMgr();
			$detail_form_builder = array(
				"folder" 			=> trim($this->CampaignName) . "/",
				"subfolder"			=> trim($this->ProgramName) . "/",
				"CustId"			=> $CustId,
				"CustomerNumber" 	=> $CustNo,
				"Lookup"			=> $this->M_ProductLookup,
				"Detail" 			=> $detail_form,
				//"DetailTransaction"	=> $detail_trans,
				"DetailTapenas"		=> $detail_tape,
				"CekRowTapenas"		=> $cek_row_tapenas,
				"QcId"				=> $qcid,
				"CM"				=> $CustomerTapenas
			);

			// Buil data form 	
			$this->load->form($form_builder_folder, $detail_form_builder);
		}
	}




	public function TestUserIdentity()
	{
		$UserIdentity  = $this->{base_class_model($this)}->_get_user(_have_get_session("UserId"));
		echo "<pre>";
		var_dump($UserIdentity);
	}

	/**
	 * [FormLoader description]
	 * @param string $CampaignName [description]
	 * @param string $Folder       [description]
	 * @param string $CustomerId   [description]
	 * @date 			2017-09-10
	
	public function FormControl ( $CampaignName = "" , $SubFolder = "" , $CustomerId = "" ) {
		//FILTER_VALIDATE_INT / filter_var as a function
		$ListCampaignName = $this->{base_class_model($this)}->_get_campaign_name();

		// if 
		if ( in_array( $CampaignName , $ListCampaignName ) ) {

			// start to build form
			$form_builder_folder = trim($CampaignName) . "/" . $SubFolder . "/form_index";
			$CustomerMaster = $this->{base_class_model($this)}->_get_customer($CustomerId);
			$detail_form = $this->{base_class_model($this)}->DetailFormSubmitted($CampaignName , $CustomerMaster->get_value("DM_Custno"));

			$detail_form_builder = array (
				"folder" => trim($CampaignName) . "/" . $SubFolder  ,
				"CustomerNumber" => $CustomerMaster->get_value("DM_Custno") ,
				"Lookup"	=> $this->M_ProductLookup , 
				"Detail" => $detail_form , 
				"CM"	=>  $CustomerMaster
			);

			$this->load->form( $form_builder_folder , $detail_form_builder );
		}


	}
	 */



	// ==============================================================
	//
	// THIS CONTENT BELOW IS JUST FOR TRANSCATION TOT TABLE
	// THIS CONTENT BELOW REQUIRED FOR TRANSACTION
	//
	// ==============================================================


	/**
	 * [RouteForm description]
	 * get data post and route form
	 */
	public function RouteCard($cardtype = "")
	{
		$_get_data = _get_all_request();
		if (is_array($_get_data)) {
			$gd = new EUI_Object($_get_data); // alias as GD


			switch ($cardtype) {

					// save statement
				case "NTB":
					$this->NTB($gd);
					break;
				case "ADDONNTB":
					$this->ADDONNTB($gd);
					break;
				case "XSELL":
					$this->XSELL($gd);
					break;

					// campaign addon
				case "ADDON":
					$this->saveADDONtrans($gd);
					break;
				case "ADDONIF":
					$this->updateADDONtrans($gd);
					break;
				case "DELADDON":
					$this->ADDONDELETE($gd);
					break;
				case "ADDONADDITIONALCARD":
					$this->ADDONADDITIONALCARD($gd);
					break;

					// update statement 
				case "NTBUPDATE":
					$this->NTBUPDATE($gd);
					break;
				case "ADDONNTBUPDATE":
					$this->ADDONNTBUPDATE($gd);
					break;
				case "ADDONUPDATE":
					$this->ADDONUPDATE($gd);
					break;
				case "XSELLUPDATE":
					$this->XSELLUPDATE($gd);
					break;
			}
		}
	}

	public function TAPENAS($subfolder = "")
	{

		// set data defaultnya  @variabel -nya 

		$this->DataProductDetail = sprintf("M_%s", ucfirst(strtolower($subfolder)));
		$this->DataProductMsg = array('success' => 0, 'data' => null);
		// echo $this->DataProductDetail;
		// get data post tampung dalam object ini.
		// test.

		$this->DataProductURI = UR();

		// concat nama object untuk mengambil 
		// data modelnya berdasakan URI Segment.

		if ($this->DataProductDetail == '') {
			printf('%s', json_encode($this->DataProductMsg));
			return false;
		}

		// lanjutkan ke process ini , panggil class nya .
		// ambil model berikut ini. 

		$this->load->model($this->DataProductDetail);
		if (!class_exists($this->DataProductDetail)) {
			printf('%s', json_encode($this->DataProductMsg));
			return false;
		}

		// lanjutkan ke process ini , panggil class nya .
		// ambil model berikut ini. 

		$this->dataRow = Singgleton($this->DataProductDetail);
		if (!is_object($this->dataRow)) {
			printf('%s', json_encode($this->DataProductMsg));
			return false;
		}


		// jika process Berhasil ambil last insert data ID -nya
		// sebagai satatus callback .

		$this->cond = $this->dataRow->_submit_paper_work_tapenas($this->DataProductURI);
		if ($this->cond) {
			$this->DataProductMsg = array(
				'success' => 1,
				'data' => $this->dataRow->_callback_paper_works()
			);
		}
		// then will get of process OK .
		printf('%s', json_encode($this->DataProductMsg));
		return false;
	}


	/**
	 * [NTB ProductName / CampaignName]
	 * @param string $CustomerId [CustomerId]
	 * @param string $CardType   [getCardType]
	 * first is save ntb if success send ntb id or insert_id
	 * $req = request data 
	 */
	public function NTB($req = "")
	{
		// ntbid , message , transactionid , success

		$call_back = array("ntbid" => null, "message" => "", "transactionid" => null, "success" => 0);

		$ntb = $this->{base_class_model($this)}->_save_ntb($req);
		$ntbid = $ntb->get_value("ntbid");
		if (is_object($ntb)) {
			// ntbid , messsage , success
			if ($ntb->get_value("success") == 1) {
				// insert transaction
				$this->db->reset_write();
				$this->db->set("TR_CustomerNumber", $req->get_value("CustomerNumber"));
				$this->db->set("TR_NTBID", $ntbid);
				$this->db->set("TR_Created_Date", date("Y-m-d H:i:s"));
				$this->db->set("TR_Agent_ID", _get_session("UserId"));
				$this->db->set("TR_DualCard",  $req->get_value("DC_Dual_Card_Agree"));
				$this->db->set("TR_IPAddr", _getIp());

				if ($this->db->insert("t_gn_frm_transaction_ntb")) {
					$transactionid = $this->db->insert_id();
					$call_back = array("ntbid" => $ntbid, "message" => "Save, Success..", "transactionid" => $transactionid, "success" => 1);
				}

				// if(_get_session("HandlingType")==8){
				// echo "sql => ".MYSQL_ERROR();
				// }
			}
		}

		echo json_encode($call_back);
	}


	/**
	 * [NTBUPDATE description]
	 * @param string $req [description]
	 */
	public function NTBUPDATE($req = "")
	{
		$call_back = array(
			"message" => "Update, Failed..",
			"success" => 0
		);
		$ntb_id = $req->get_value("FRM_NTB_Id"); // ntbid
		if (!empty($ntb_id) and _have_get_session("UserId")) {
			$update_affected = $this->{base_class_model($this)}->_update_ntb($req);
			if ($update_affected->get_value("success") == 1) {
				$call_back = array(
					"message" => "Update , Success ..",
					"success" => 1
				);
			}
		}
		echo json_encode($call_back);
	}




	/**
	 * [ADD-On ProductName / CampaignName]
	 * @param string $CustomerId [CustomerId]
	 * @param string $CardType   [GetCardType for Insert to ADDON Table]
	 */
	public function ADDONNTB($req = "")
	{
		/**
		 *  "ADDON_Nama_Kartu" ,
			"ADDON_Umur" ,
			"ADDON_DOB" ,
			"ADDON_Jenis_Kartu" ,
			"ADDON_Hubungan" ,
			"ADDON_Jenis_Kelamin" ,
			"ADDON_No_Hp"
		 */

		$call_back = array("message" => "", "success" => 0);
		// check total add-on
		$totaladdon = $req->get_value("totaladdon");
		$transactionid = $req->get_value("transactionid");


		if (!empty($transactionid)) {
			$insert_id_addon = "";
			if (!empty($totaladdon)) {
				for ($td = 1; $td <= $totaladdon; $td++) {
					$insert_id_addon .= $this->{base_class_model($this)}->_save_addon_ntb($req, $td);
					$insert_id_addon .= ",";
				}

				$insert_id_addon = rtrim($insert_id_addon, ",");
			}

			if (!empty($insert_id_addon)) {
				$this->db->reset_write();
				$this->db->set("TR_Total_ADDON", $totaladdon);
				$this->db->set("TR_ADDONID", $insert_id_addon);
				$this->db->where("TR_Id", $transactionid);
				if ($this->db->update("t_gn_frm_transaction_ntb")) {
					$call_back = array("message" => "Save, ADDON NTB Success ..", "success" => 1);
				}
			} else {
				$call_back = array("message" => "Silahkan isi salah satu form Addon ..", "success" => 0);
			}
		} else {
			$call_back = array("message" => "Silahkan isi Form NTB Terlebih dahulu ..", "success" => 0);
		}


		echo json_encode($call_back);
	}


	/**
	 * [ADDONNTBUPDATE description] 
	 * @param string $req [description]
	 */
	public function ADDONNTBUPDATE($req = "")
	{

		$call_back = array("success" => 0, "message" => "Please Change Data ..");
		$_get_out_request = _get_all_request();
		$_out = new EUI_Object($_get_out_request);

		if (is_array($_get_out_request)) {
			$catch = $this->{base_class_model($this)}->_save_addon_ntb_update($_out);
			if ($catch->get_value("success") == 1) {
				$call_back = array(
					"success" => 1,
					"message" => "Update Addon, Success..",
					"rowntb"  => $catch->get_value("rowntb")
				);
			}
		}

		echo json_encode($call_back);
	}


	/**
	 * [XSELL ProductName / CampaignName]
	 * @param string $CustomerId [CustomerId]
	 * @param string $CardType   [GetCardType for Generate XSELL]
	 */
	public function XSELL($req = "")
	{
		$call_back = array("success" => 0, "insert_id" => 0, "message" => "Insert Failed!");

		// start to getting out
		$_get_out_request = _get_all_request();

		$out = new EUI_Object($_get_out_request);
		if (is_object($out)) {
			$catch = $this->{base_class_model($this)}->_save_xsell($out);
			if ($catch->get_value("success") == 1) {
				$call_back = array("success" => 1, "insert_id" => $catch->get_value("insert_id"), "message" => "Success, Saved..");
			}
		}

		echo json_encode($call_back);
	}

	/**
	 * [XSELLUPDATE description]
	 * @param string $req [description]
	 */
	public function XSELLUPDATE($req = "")
	{
		$call_back = array("success" => 0, "message" => "Data is not updated..");

		// start to getting out
		$_get_out_request = _get_all_request();
		$out = new EUI_Object($_get_out_request);
		if (is_object($out)) {
			$catch = $this->{base_class_model($this)}->_update_xsell($out);
			if ($catch->get_value("success") == 1) {
				$call_back = array("success" => 1, "message" => "Update, Success..", "xsellupdate" => $catch->get_value("xsellupdate"));
			}
		}

		echo json_encode($call_back);
	}


	/**
	 * [ADDON description]
	 */
	public function ADDON($req = "")
	{
		$call_back = array("success" => 0, "message" => "");
		if (_have_get_session("UserId")) {
			$_get_out_request = _get_all_request();
			if (is_array($_get_out_request)) {
				$out = new EUI_Object($_get_out_request);
				// $state = $this->{base_class_model($this)}->_save_addon($out);

				// if insert success save transaction to t_gn_frm_transaction_addon
				// if ( $state->get_value("success") == 1 ) {
				// $FRM_ADDON_Id = $state->get_value("insert_id");

				// catch from save model
				$CustomerNumber  = $out->get_value("CustomerNumber");
				$TR_ADDONID      = $FRM_ADDON_Id;
				$TR_Created_Date = date("Y-m-d H:i:s");
				$TR_Agent_ID     = _get_session("UserId");
				$TR_IPAddr       = _getIp();

				$this->db->reset_write();
				$this->db->set("TR_CustomerNumber", $CustomerNumber);
				// $this->db->set("TR_ADDONID" , $TR_ADDONID);
				$this->db->set("TR_Created_Date", $TR_Created_Date);
				$this->db->set("TR_Agent_ID", $TR_Agent_ID);
				$this->db->set("TR_IPAddr", $TR_IPAddr);

				$DB_Alamat_Krim_1 = $out->get_value("DB_Alamat_Krim_1");
				$DB_Alamat_Krim_2 = $out->get_value("DB_Alamat_Krim_2");
				$DB_Alamat_Krim_3 = $out->get_value("DB_Alamat_Krim_3");
				$DB_Alamat_Krim_4 = $out->get_value("DB_Alamat_Krim_4");
				$DB_Kota 		  = $out->get_value("DB_Kota");
				$DB_Kode_Pos 	  = $out->get_value("DB_Kode_Pos");
				$DB_Home_Phone    = $out->get_value("DB_Home_Phone");
				$DB_Mobil_Phone   = $out->get_value("DB_Mobil_Phone");
				$DB_Office_Phone  = $out->get_value("DB_Office_Phone");
				$CustomerNumber   = $out->get_value("CustomerNumber");

				// $this->db->set("DB_Alamat_Krim_1" , $DB_Alamat_Krim_1);
				// $this->db->set("DB_Alamat_Krim_2" , $DB_Alamat_Krim_2);
				// $this->db->set("DB_Alamat_Krim_3" , $DB_Alamat_Krim_3);
				// $this->db->set("DB_Alamat_Krim_4" , $DB_Alamat_Krim_4);
				// $this->db->set("DB_Kota" , $DB_Kota);
				// $this->db->set("DB_Kode_Pos" , $DB_Kode_Pos);
				// $this->db->set("DB_Home_Phone" , $DB_Home_Phone);
				// $this->db->set("DB_Mobil_Phone" , $DB_Mobil_Phone);
				// $this->db->set("DB_Office_Phone" , $DB_Office_Phone);

				$this->db->duplicate("DB_Alamat_Krim_1", $DB_Alamat_Krim_1);
				$this->db->duplicate("DB_Alamat_Krim_2", $DB_Alamat_Krim_2);
				$this->db->duplicate("DB_Alamat_Krim_3", $DB_Alamat_Krim_3);
				$this->db->duplicate("DB_Alamat_Krim_4", $DB_Alamat_Krim_4);
				$this->db->duplicate("DB_Kota", $DB_Kota);
				$this->db->duplicate("DB_Kode_Pos", $DB_Kode_Pos);
				$this->db->duplicate("DB_Home_Phone", $DB_Home_Phone);
				$this->db->duplicate("DB_Mobil_Phone", $DB_Mobil_Phone);
				$this->db->duplicate("DB_Office_Phone", $DB_Office_Phone);
				// $this->db->duplicate('ADDON_TransId', $req->field('FRM_ADDON_Id'));

				//save transaction
				if ($this->db->insert_on_duplicate("t_gn_frm_transaction_addon")) {
					$FRM_ADDON_Id = $this->db->insert_id();
					$call_back = array("success" => 1, "message" => "Save, Success .. ", "insert_id" => $FRM_ADDON_Id);
				}
				// }
			}
		}
		echo json_encode($call_back);
	}

	/**
	 * [ADDONUPDATE description]
	 * @param string $req [description]
	 */
	public function ADDONUPDATE($req = "")
	{
		$call_back = array("message" => "Please Change Data..", "success" => 0);

		$_get_out_request = _get_all_request();
		$out = new EUI_Object($_get_out_request);
		$FRM_ADDON_Id = $out->get_value("FRM_ADDON_Id");

		// check if have session with value UserId
		if (is_object($out) and _have_get_session("UserId")) {
			$out_model = $this->{base_class_model($this)}->_save_addon_addon_update($out);
			if (
				$out_model->get_value("success") == 1
				and !empty($FRM_ADDON_Id)
			) {
				$call_back = array("message" => "Update, Success .. ", "success" => 0);
			}
		}

		echo json_encode($call_back);
	}

	/**
	 * [ADDONADDITIONALCARD description]
	 */
	public function ADDONADDITIONALCARD($req = "")
	{
		$call_back = array("message" => "Update Failed, There is nothing Changed Data..", "success" => 0);
		if (_have_get_session("UserId")) {
			$_get_out_request = _get_all_request();
			$out = new EUI_Object($_get_out_request);

			// addon form sequence
			$addonseq = $out->get_value("addonseq");
			// if save data changed is needed was saved
			$FRM_ADDON_Id = $out->get_value("FRM_ADDON_Id_" . $addonseq);

			if (!empty($FRM_ADDON_Id)) {
				$_save_addon_addon = $this->{base_class_model($this)}->_save_addon_addon($out);
				if ($_save_addon_addon->get_value("success") == 1) {
					$call_back = array("message" => "Update, Success ..", "success" => 1);
				}

				if ($_save_addon_addon->get_value("success") == 2) {
					$call_back = array("message" => "Update, Failed Phone Number Same!", "success" => 0);
				}
			} else {
				$call_back = array("message" => "Please Save form 'IF DATA CHANGED IS NEEDED' before save 'KARTU TAMBAHAN'..", "success" => 0);
			}
		}

		echo json_encode($call_back);
	}

	/**
	 * [USAGE description]
	 */

	public function USAGE($subfolder = "")
	{

		// set data defaultnya  @variabel -nya 

		$this->DataProductDetail = sprintf("M_%s", ucfirst(strtolower($subfolder)));
		$this->DataProductMsg = array('success' => 0, 'data' => null);

		// get data post tampung dalam object ini.
		// test.

		$this->DataProductURI = UR();

		// concat nama object untuk mengambil 
		// data modelnya berdasakan URI Segment.

		if ($this->DataProductDetail == '') {
			printf('%s', json_encode($this->DataProductMsg));
			return false;
		}

		// lanjutkan ke process ini , panggil class nya .
		// ambil model berikut ini. 

		$this->load->model($this->DataProductDetail);
		if (!class_exists($this->DataProductDetail)) {
			printf('%s', json_encode($this->DataProductMsg));
			return false;
		}

		// lanjutkan ke process ini , panggil class nya .
		// ambil model berikut ini. 

		$this->dataRow = Singgleton($this->DataProductDetail);
		if (!is_object($this->dataRow)) {
			printf('%s', json_encode($this->DataProductMsg));
			return false;
		}


		// jika process Berhasil ambil last insert data ID -nya
		// sebagai satatus callback .

		$this->cond = $this->dataRow->_submit_paper_work($this->DataProductURI);
		if ($this->cond) {
			$this->DataProductMsg = array(
				'success' => 1,
				'data' => $this->dataRow->_callback_paper_work()
			);
		}
		// then will get of process OK .
		printf('%s', json_encode($this->DataProductMsg));
		return false;
	}

	public function BALCON($subfolder = "")
	{

		// set data defaultnya  @variabel -nya 
		// var_dump('siap');
		// die;
		$this->DataProductDetail = sprintf("M_%s", ucfirst(strtolower($subfolder)));
		$this->DataProductMsg = array('success' => 0, 'data' => null);

		// get data post tampung dalam object ini.
		// test.

		$this->DataProductURI = UR();

		// concat nama object untuk mengambil 
		// data modelnya berdasakan URI Segment.

		if ($this->DataProductDetail == '') {
			printf('%s', json_encode($this->DataProductMsg));
			return false;
		}
		// lanjutkan ke process ini , panggil class nya .
		// ambil model berikut ini. 

		$this->load->model($this->DataProductDetail);

		if (!class_exists($this->DataProductDetail)) {
			printf('%s', json_encode($this->DataProductMsg));
			return false;
		}

		// lanjutkan ke process ini , panggil class nya .
		// ambil model berikut ini. 

		$this->dataRow = Singgleton($this->DataProductDetail);

		if (!is_object($this->dataRow)) {
			printf('%s', json_encode($this->DataProductMsg));
			return false;
		}


		// jika process Berhasil ambil last insert data ID -nya
		// sebagai satatus callback .
		$this->cond = $this->dataRow->_submit_paper_work($this->DataProductURI);
		if ($this->cond) {
			$this->DataProductMsg = array(
				'success' => 1,
				'data' => $this->dataRow->_callback_paper_work()
			);
		}
		// then will get of process OK .
		printf('%s', json_encode($this->DataProductMsg));
		return false;
	}

	public function DeleteTransaction()
	{
		$_get_data = _get_all_request();
		if (is_array($_get_data)) {
			$gd = new EUI_Object($_get_data);
		}

		$call_back = array("transusage" => null, "message" => "", "transactionid" => null, "success" => 0);

		$deleting = $this->{base_class_model($this)}->_delete_transaction_usage($gd->get_value('SequenceNo'), $gd->get_value('TransacId'), $gd->get_value('VerifycaId'));

		if ($deleting) {
			$call_back = array("transusage" => null, "message" => $deleting, "transactionid" => null, "success" => 1);
		}
		echo json_encode($call_back);
	}
	public function DeleteTransactionbalcon()
	{
		$_get_data = _get_all_request();
		if (is_array($_get_data)) {
			$gd = new EUI_Object($_get_data);
		}

		$call_back = array("transusage" => null, "message" => "", "transactionid" => null, "success" => 0);

		$deleting = $this->{base_class_model($this)}->_delete_transaction_balcon($gd->get_value('SequenceNo'), $gd->get_value('TransacId'), $gd->get_value('VerifycaId'));

		if ($deleting) {
			$call_back = array("transusage" => null, "message" => $deleting, "transactionid" => null, "success" => 1);
		}
		echo json_encode($call_back);
	}


	public function updateADDONtrans($req = "")
	{
		$call_back = array("success" => 0, "message" => "Create ADD-On Transaction First");

		if (_have_get_session("UserId")) {
			$_get_out_request = _get_all_request();
			if (is_array($_get_out_request)) {
				$out = new EUI_Object($_get_out_request);

				$CustomerNumber  = $out->get_value("CustomerNumber");
				$TR_Created_Date = date("Y-m-d H:i:s");
				$TR_Agent_ID     = _get_session("UserId");
				$TR_IPAddr       = _getIp();
				$checkaddontrans = $this->{base_class_model($this)}->_check_row_addon_trans($CustomerNumber);
				if ($checkaddontrans) {
					$this->db->reset_write();
					$this->db->where("TR_CustomerNumber", $CustomerNumber);

					$this->db->set("TR_Update_Date", $TR_Created_Date);
					$this->db->set("TR_Agent_ID", $TR_Agent_ID);
					$this->db->set("TR_IPAddr", $TR_IPAddr);

					$DB_Alamat_Krim_1 = $out->get_value("DB_Alamat_Krim_1");
					$DB_Alamat_Krim_2 = $out->get_value("DB_Alamat_Krim_2");
					$DB_Alamat_Krim_3 = $out->get_value("DB_Alamat_Krim_3");
					$DB_Alamat_Krim_4 = $out->get_value("DB_Alamat_Krim_4");
					$DB_Kota 		  = $out->get_value("DB_Kota");
					$DB_Kode_Pos 	  = $out->get_value("DB_Kode_Pos");
					$DB_Home_Phone    = $out->get_value("DB_Home_Phone");
					$DB_Mobil_Phone   = $out->get_value("DB_Mobil_Phone");
					$DB_Office_Phone  = $out->get_value("DB_Office_Phone");
					$CustomerNumber   = $out->get_value("CustomerNumber");

					$this->db->set("DB_Alamat_Krim_1", $DB_Alamat_Krim_1);
					$this->db->set("DB_Alamat_Krim_2", $DB_Alamat_Krim_2);
					$this->db->set("DB_Alamat_Krim_3", $DB_Alamat_Krim_3);
					$this->db->set("DB_Alamat_Krim_4", $DB_Alamat_Krim_4);
					$this->db->set("DB_Kota", $DB_Kota);
					$this->db->set("DB_Kode_Pos", $DB_Kode_Pos);
					$this->db->set("DB_Home_Phone", $DB_Home_Phone);
					$this->db->set("DB_Mobil_Phone", $DB_Mobil_Phone);
					$this->db->set("DB_Office_Phone", $DB_Office_Phone);
					$this->db->set("IF_DataChange_Flag", 1);

					//save transaction
					if ($this->db->update("t_gn_frm_transaction_addon")) {
						// $FRM_ADDON_Id = $this->db->insert_id();
						$call_back = array("success" => 0, "message" => "Update Data Success");
					}
				}
			}
		}
		echo json_encode($call_back);
	}

	public function saveADDONtrans($req = "")
	{
		$call_back = array("success" => 0, "message" => "");

		if (_have_get_session("UserId")) {
			$_get_out_request = _get_all_request();
			if (is_array($_get_out_request)) {
				$out = new EUI_Object($_get_out_request);

				// catch from save model
				$addonseq = $out->get_value("addonseq");
				$CustomerNumber  = $out->get_value("CustomerNumber" . $addonseq);
				$TR_ADDONID      = $FRM_ADDON_Id;
				$TR_Created_Date = date("Y-m-d H:i:s");
				$TR_Agent_ID     = _get_session("UserId");
				$TR_IPAddr       = _getIp();

				$checkaddontrans = $this->{base_class_model($this)}->_check_row_addon_trans($CustomerNumber);
				// var_dump(is_array($checkaddontrans));
				if (!is_array($checkaddontrans)) {
					$this->db->reset_write();
					$this->db->set("TR_CustomerNumber", $CustomerNumber);
					$this->db->set("TR_Created_Date", $TR_Created_Date);
					$this->db->set("TR_Agent_ID", $TR_Agent_ID);
					$this->db->set("TR_IPAddr", $TR_IPAddr);

					//save transaction
					if ($this->db->insert("t_gn_frm_transaction_addon")) {
						$FRM_ADDON_Id = $this->db->insert_id();
					}

					if ($FRM_ADDON_Id) {
						$saveAddon = $this->{base_class_model($this)}->_save_addon_addon($out, $FRM_ADDON_Id);
						if ($saveAddon->get_value('success') == 1) {
							if ($saveAddon->get_value('addon_id') != NULL) {
								$call_back = array("success" => 1, "message" => "Save ADD-On " . $addonseq . ", Success .. ", "insert_id" => $FRM_ADDON_Id);
								// $call_back = array( "success" => 1 , "message" => "Save ADD-On ".$addonseq.", Success .. insert_id = ".$FRM_ADDON_Id , "insert_id" => $FRM_ADDON_Id );
							} else {
								$call_back = array("success" => 1, "message" => "Save ADD-On " . $addonseq . ", Duplicate ..");
							}
						} else if ($saveAddon->get_value('success') == 2) {
							$call_back = array("success" => 0, "message" => "Mobile phone number can't be the same ..");
						} else if ($saveAddon->get_value('success') == 2) {
							$call_back = array("success" => 0, "message" => "Data Failed...!");
						}
					}
				} else {
					$checkaddon = $this->{base_class_model($this)}->_check_row_addon($CustomerNumber, $addonseq);
					// var_dump($checkaddon);
					if ($checkaddon) {
						$updateoaddon = $this->{base_class_model($this)}->_save_addon_addon_update($out, $addonseq);
						if ($updateoaddon['success'] == 1) {
							$call_back = $updateoaddon;
						} else if ($updateoaddon['success'] == 2) {
							$call_back = array("success" => 0, "message" => "Mobile phone number can't be the same ..");
						} else {
							$call_back = array("success" => 0, "message" => "Save Data Failed...!");
						}
					} else {
						$saveoAddon = $this->{base_class_model($this)}->_save_addon_addon($out, $checkaddontrans['TR_Id']);
						if ($saveoAddon->get_value('success') == 1) {
							if ($saveoAddon->get_value('addon_id') != NULL) {
								$call_back = array("success" => 1, "message" => "Save ADD-On " . $addonseq . $checkaddontrans['TR_Id'] . ", Success .. ", "insert_id" => $FRM_ADDON_Id);
							} else {
								$call_back = array("success" => 1, "message" => "Save ADD-On " . $addonseq . ", Duplicate ..");
							}
						} else if ($saveoAddon->get_value('success') == 2) {
							$call_back = array("success" => 0, "message" => "Mobile phone number can't be the same ..");
						} else {
							$call_back = array("success" => 0, "message" => "Update Failed...!");
						}
					}
				}
			}
		}
		echo json_encode($call_back);
	}

	public function ADDONDELETE($addonId = "")
	{
		$call_back = array("success" => 0, "message" => "Delete Addon Failed...");

		$_get_out_request = _get_all_request();
		if (is_array($_get_out_request)) {
			$out = new EUI_Object($_get_out_request);
			if ($out->get_value("CustomerNumber" . $out->get_value("Addsequence"))) {
				$cancelQueryAddon = "
						INSERT INTO t_gn_frm_addon_cancel 
						(FRM_Addon_Id,
							ADDON_Nama_Kartu,
							ADDON_Hubungan,
							ADDON_Jenis_Kartu,
							ADDON_DOB,
							ADDON_Umur,
							ADDON_Jenis_Kelamin,
							ADDON_No_Hp,
							ADDON_CustNum,
							ADDON_TransId,
							ADDON_Seq,
							CreatedTs,
							ADDDEL_date
						)
						SELECT FRM_Addon_Id,
							ADDON_Nama_Kartu,
							ADDON_Hubungan,
							ADDON_Jenis_Kartu,
							ADDON_DOB,
							ADDON_Umur,
							ADDON_Jenis_Kelamin,
							ADDON_No_Hp,
							ADDON_CustNum,
							ADDON_TransId,
							ADDON_Seq,
							CreatedTs,
							now()
						FROM  t_gn_frm_addon a 
						WHERE a.ADDON_Seq = " . $out->get_value("FRM_ADDON_Ke_" . $out->get_value("Addsequence")) . "
						AND a.ADDON_CustNum = '" . $out->get_value("CustomerNumber" . $out->get_value("Addsequence")) . "';
					";

				$selectInsertCancel = $this->db->query($cancelQueryAddon);
				if ($selectInsertCancel == true) {
					$call_back = array("success" => 1, "message" => "Delete Addon Success...");
					$this->db->reset_write();
					$this->db->where("ADDON_Seq", $out->get_value("FRM_ADDON_Ke_" . $out->get_value("Addsequence")));
					$this->db->where("ADDON_CustNum", $out->get_value("CustomerNumber" . $out->get_value("Addsequence")));
					$this->db->delete("t_gn_frm_addon");

					if ($this->db->affected_rows() > 0) {
						// $return_data = $valAddon;
						return $this->db->last_query();
					}
				} else {
					$call_back = array("success" => 2, "message" => "Delete Addon Success...");
				}
			} else {
				$call_back = array("success" => 2, "message" => "Delete Addon Success...");
			}
		}

		echo json_encode($call_back);
	}
}

/* End of file ProductController.php */
/* Location: ./application/controllers/ProductController.php */

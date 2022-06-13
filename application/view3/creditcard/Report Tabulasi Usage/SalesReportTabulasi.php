<?php
/*
 * Sales Report 
 * Source From 
 */
 
class SalesReportTabulasi extends EUI_Controller {

	public $data_ntb;
 
	public function __construct() {
		parent::__construct();
		$this->load->model(array(base_class_model($this) , "M_ProductLookup" ));
		$this->load->helper(array('EUI_Object'));
	 	$this->campaign = array(
	 		29 => "ntb" , 
	 		31 => "xsell" , 
	 		33 => "add" , 
	 		35 => "usage"
	 	);

	 	$this->folder = "rpt_sales_report_tabulasi/";
	 	$this->folderCampaign = "rpt_sales_report_tabulasi/rpt_per_campaign/";

	}

	
	/**
	 * [index description]
	 * @return [type] [description]
	 */
	public function index() {
		if( _get_is_login() == FALSE ) { return FALSE; }
		$out =& get_class_instance('M_SalesReportTabulasi');
		$out_data = array( "Campaign" => array() );
		$this->load->view("rpt_sales_report_tabulasi/report_sales_nav" , $out_data);
	}

	/**
	 * [ShowReport description]
	 */
	public function ShowReport () {
		$get_all_out = _get_all_request();
		$gao = new EUI_Object($get_all_out);
		$campaignId = $gao->get_value("campaign_id");
		$mode_report = strtolower($gao->get_value("mode"));
		if ( $gao->get_value("mode") == "HTML" ) {
			// switch mode
			$this->load->view( $this->folderCampaign . $mode_report . "/rpt_style" );
			switch ( $campaignId ) {
				// ntb report
				case 29 : 
					$this->load->view( $this->folderCampaign . $mode_report . "/rpt_".$this->campaign[29]."_html" , 
						array(
								"param" => $gao , 
								"data_ntb" => $this->_get_data_ntb() , 
								"data_ntb_dualcard" => $this->_get_data_dualcard_ntb() , 
								"data_addon_ntb" => $this->_get_data_addon_ntb()
					)); break;

				case 31 : $this->load->view( $this->folderCampaign . $mode_report . "/rpt_".$this->campaign[31]."_html" , array(
								"param" => $gao , 
								"data_xsell" => $this->_get_data_xsell("xsell") , 
								"data_addon_xsell" => $this->_get_data_xsell("addon")
					)); break;

				case 33 : $this->load->view( $this->folderCampaign . $mode_report . "/rpt_".$this->campaign[33]."_html" , array(
								"param" => $gao , 
								"data_ntb" => $this->_get_data_ntb() , 
								"data_ntb_dualcard" => $this->_get_data_dualcard_ntb() , 
								"data_addon_ntb" => $this->_get_data_addon_ntb()
					)); break;

                case 35 : $this->load->view( $this->folderCampaign . $mode_report . "/rpt_".$this->campaign[35]."_html" , array(
								"param" => $gao,
								"data_usage" => $this->_get_data_usage()
//								"data_ntb_dualcard" => $this->_get_data_dualcard_ntb() , 
//								"data_addon_ntb" => $this->_get_data_addon_ntb()
					));
                    break;
			}
		}

	}
	/**
	 * [index description]
	 * @return [type] [description]
	 */
	function ShowCampaignByProductId(){
		$URL =& UR();
		
		$result_array = array();
		
		// get '$ProductId: data  
		$ProductId = $URL->field('ProductId');
		
		// then if ok 
		$sql = sprintf("select b.CampaignId, b.CampaignCode, b.CampaignDesc 
						from t_gn_campaignproduct a left join t_gn_campaign b on a.CampaignId=b.CampaignId 
						where a.ProductId=%d", $ProductId);
						
		$qry = $this->db->query( $sql );
		if( $qry && $qry->num_rows() > 0 ) 
		foreach( $qry->result_assoc() as $row ){
			$result_array[$row['CampaignId']] = $row['CampaignDesc']; 
		}	
		
		// return user browser OK SIP Ya .
		echo form()->combo('campaign_id','select auto x-select', 
				$result_array ,null, array("change" => "window.showRecsourceByCampaignId(this);")); 
				
		// end function;
	}
	/**
	 * [index description]
	 * @return [type] [description]
	 */
	 
	function ShowRecsourceByCampaignId(){
		$URL =& UR();
		$result_array = array();
		
		// get '$CampaignId: data  
		$CampaignId = $URL->field('CampaignId');
		
		// get query data to process OK 
		$sql = sprintf("select a.DM_Recsource as Kode, b.FTP_UploadFilename as Name
						from t_gn_customer_master a 
						left join t_gn_upload_report_ftp b on a.DM_Recsource=b.FTP_Recsource
						where b.FTP_UploadSuccess > 0 
						and a.DM_CampaignId = %d
						group by a.DM_Recsource", $CampaignId);
						
		$qry = $this->db->query( $sql );
		if( $qry && $qry->num_rows() > 0 ) 
		foreach( $qry->result_record() as $row ){
			$result_array[$row->field('Kode')] = $row->field('Name', 'basename'); 
		}	
		
		// return user browser OK SIP Ya .
		echo form()->combo('recsource_id','select auto x-select', $result_array ,null, null, 
			array('multiple' => true, 'title' => '') ); 
			
		
	}


	/**
	 * [ShowReport description]
	 */
	public function ShowExcel () {
		$get_all_out = _get_all_request();
		$gao = new EUI_Object($get_all_out);
		$campaignId = $gao->get_value("campaign_id");
		$mode_report = strtolower($gao->get_value("mode"));

		// $xcelFname = "report";
		// switch ( $campaignId ) {
			// case 29 : $xcelFname = 
		// 
		
		if ( $gao->get_value("mode") == "EXCEL" ) {
			// switch mode
			switch ( $campaignId ) {
				case 29 :
					$xcelFname = "Tabulasi_".$this->campaign[29]."_".date("ddmmyy");
					$dao = array(
								"param" => $gao , 
								"data_ntb" => $this->_get_data_ntb() , 
								"data_ntb_dualcard" => $this->_get_data_dualcard_ntb() , 
								"data_addon_ntb" => $this->_get_data_addon_ntb()
					);
					$Campaign = $this->campaign[29];
				break;
				case 31 :
					$xcelFname = "Tabulasi_".$this->campaign[31]."_".date("ddmmyy");
					$dao = array(
								"param" => $gao , 
								"data_ntb" => $this->_get_data_ntb() , 
								"data_ntb_dualcard" => $this->_get_data_dualcard_ntb() , 
								"data_addon_ntb" => $this->_get_data_addon_ntb()
					);
					$Campaign = $this->campaign[31];
				break;
				case 33 :
					$xcelFname = "Tabulasi_".$this->campaign[33]."_".date("ddmmyy");
					$dao = array(
								"param" => $gao , 
								"data_ntb" => $this->_get_data_ntb() , 
								"data_ntb_dualcard" => $this->_get_data_dualcard_ntb() , 
								"data_addon_ntb" => $this->_get_data_addon_ntb()
					);
					$Campaign = $this->campaign[33];
				break;
				case 35 :
					$xcelFname = "Tabulasi_".$this->campaign[35]."_".date("ddmmyy");
					$dao = array(
								"param" => $gao , 
								"data_ntb" => $this->_get_data_ntb() , 
								"data_ntb_dualcard" => $this->_get_data_dualcard_ntb() , 
								"data_addon_ntb" => $this->_get_data_addon_ntb()
					);
					$Campaign = $this->campaign[35];
				break;
			}
		}
		
		header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
		header("Content-Disposition: attachment; filename=$xcelFname.xls");  //File name extension was wrong
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Cache-Control: private",false);

		$this->load->view( $this->folderCampaign . $mode_report . "/rpt_".$Campaign."_excel" , $dao);
	}



	/**
	 *==================================================================
	 *
	 * THIS BELOW CONTENT GET DATA REPORT 
	 * |
	 * v
	 *
	 * =================================================================
	 */
	

	/**
	 * [_row_addon description]
	 * @param  string $addon_id [description]
	 * @return [type]           [description]
	 */
	public function _row_addon ( $addon_id = "" ) {
		// get addon
		$data_addon = false;
		$get_addon = $this->db->query(
			"SELECT concat(b.DM_FirstName , ' ' , if(b.DM_LastName is not null , b.DM_LastName , '') ) as CustomerNames , a.* 
			FROM t_gn_frm_addon a 
			INNER JOIN t_gn_customer_master b on a.ADDON_CustNum=b.DM_Custno
			WHERE a.FRM_Addon_Id in($addon_id);"
		);

		if ( $get_addon == true AND $get_addon->num_rows() > 0 ) {
			$data_addon = $get_addon;
		}

		return $data_addon;

	}
	

	// ==============================================
	// START STATEMENT FOR NTB
	
	/**
	 * [_get_row_ntb description]
	 * @return [type] [description]
	 */
	public function _get_data_ntb () {
		// start to get all request
		
		$data_ntb = false;
		$this->data_ntb = $data_ntb;
		$param_request = _get_all_request();
		$out = new EUI_Object($param_request);

		$this->data_addon_ntb = array();

		// and we get here
		$CampaignId   = $out->get_value("campaign_id");
		$StartDate    = $out->get_value("start_date");
		$EndDate      = $out->get_value("end_date");

		// filter all request if not empty get
		if ( !empty($CampaignId) AND !empty($StartDate) AND !empty($EndDate) ) {
			$StartDate = _getDateEnglish($StartDate) . " 00:00:00";
			$EndDate   = _getDateEnglish($EndDate) . " 23:59:58";
			$query_ntb     = "
				SELECT b.* , a.* , c.DM_QualityUserId , c.DM_CcLimit, e.FTP_UploadFilename FROM t_gn_frm_transaction_ntb a
				INNER JOIN t_gn_customer_master c on a.TR_CustomerNumber=c.DM_Custno
				INNER JOIN t_gn_frm_ntb b on a.TR_CustomerNumber=b.DB_CustNum
				LEFT join t_gn_upload_report_ftp e ON c.DM_UploadId = e.FTP_UploadId
				WHERE a.TR_Created_Date >= '$StartDate' AND a.TR_Created_Date <= '$EndDate'
				ORDER BY a.TR_CustomerNumber
			";

			$get_data_ntb  = $this->db->query( $query_ntb );
			if ( $get_data_ntb->num_rows() > 0 ) {
				$data_ntb = $get_data_ntb;
				$this->data_ntb = $data_ntb;

				foreach ( $this->data_ntb->result() as $antb ) {
					$data_addon_arr = array();
					$data_addon_arr["CustomerNumber"] = $antb->TR_CustomerNumber;
					$data_addon_arr["Addon_Id"] = $antb->TR_ADDONID;
					$this->data_addon_ntb[] = $data_addon_arr;
				}


			}
		}

		return $data_ntb;
	}

	/**
	 * [_get_data_dualcard_ntb description]
	 * @param  string $CustomerId [description]
	 * @return [type]             [description]
	 */
	public function _get_data_dualcard_ntb () {
		$call_back = array();
		$data_dualcard = array();
		$no = 1;
		if ( is_object($this->data_ntb) AND $this->data_ntb->num_rows() > 0 ) {
			foreach ( $this->data_ntb->result_array() as $dsd ) {
				$Obj_dc = Objective($dsd);
				$dualcardAgree = $Obj_dc->get_value("DC_Dual_Card_Agree");
				if ( $dualcardAgree == true ) {
					$data_dualcard_agree = array();
					$data_dualcard_agree["ORG"] 						= $Obj_dc->get_value("DB_Org") ;
					$data_dualcard_agree["LOGO"] 						= $Obj_dc->get_value("Logo") ;
					$data_dualcard_agree["APPID"] 						= $Obj_dc->get_value("AppId") ;
					$data_dualcard_agree["CustomerNumber"] 				= $Obj_dc->get_value("DB_CustNum") ;
					$data_dualcard_agree["CustomerNumberCorporate"] 	= $Obj_dc->get_value("") ;
					$data_dualcard_agree["EmpolyoeeReffCode"] 			= $Obj_dc->get_value("") ;
					$data_dualcard_agree["SourceCode"] 					= $Obj_dc->get_value("JenisKartu") ;
					$data_dualcard_agree["CARD"] 						= $Obj_dc->get_value("") ;
					$data_dualcard_agree["JenisKartu"] 					= $Obj_dc->get_value("DC_Dual_Card_Type") ;
					$data_dualcard_agree["LOGODualCard"] 				= $Obj_dc->get_value("") ;
					$data_dualcard_agree["LIMIT"] 						= $Obj_dc->get_value("DC_Dual_Card_Limit") ;
					$data_dualcard_agree["NamaDiKTP"] 					= $Obj_dc->get_value("DB_Nama_KTP") ;
					$data_dualcard_agree["NamaDiKartu"] 				= $Obj_dc->get_value("CC_Nama_Yang_Diinginkan") ;
					$data_dualcard_agree["DOBCustomer"] 				= $Obj_dc->get_value("DB_DOB") ;
					$data_dualcard_agree["JenisKelamin"] 				= $Obj_dc->get_value("DB_Jenis_Kelamin") ;
					$data_dualcard_agree["NoKTP"] 						= $Obj_dc->get_value("CONTACT_No_Ktp") ;
					$data_dualcard_agree["MothersName"] 				= $Obj_dc->get_value("CONTACT_Nama_Ibu_Kandung") ;
					$data_dualcard_agree["Jabatan"] 					= $Obj_dc->get_value("WORK_Jabatan") ;
					$data_dualcard_agree["Penghasilan"] 				= $Obj_dc->get_value("FINANCE_Penghasilan_Sekarang") ;
					$data_dualcard_agree["NoRekening"] 					= $Obj_dc->get_value("FINANCE_No_Kartu_Kredit_Dimiliki1_1") . "-" . $Obj_dc->get_value("FINANCE_No_Kartu_Kredit_Dimiliki1_2") . "-" . $Obj_dc->get_value("FINANCE_No_Kartu_Kredit_Dimiliki1_3") .  "-" . $Obj_dc->get_value("FINANCE_No_Kartu_Kredit_Dimiliki1_4") ;
					$data_dualcard_agree["KreditLimit"] 				= $Obj_dc->get_value("DM_CcLimit") ;
					$data_dualcard_agree["TglJatuhTempo"] 				= $Obj_dc->get_value("CONTACT_Tgl_Jatuh_Tempo") ;
					$data_dualcard_agree["Addrees_1"] 					= $Obj_dc->get_value("CONTACT_Alamat_Rumah_1") ;
					$data_dualcard_agree["Addrees_2"] 					= $Obj_dc->get_value("CONTACT_Alamat_Rumah_2") ;
					$data_dualcard_agree["Addrees_3"] 					= $Obj_dc->get_value("CONTACT_Alamat_Rumah_3") ;
					$data_dualcard_agree["Addrees_4"] 					= $Obj_dc->get_value("CONTACT_Alamat_Rumah_4") ;
					$data_dualcard_agree["HOMECITY"] 					= $Obj_dc->get_value("CONTACT_Kota") ;
					$data_dualcard_agree["HOMEZIPCODE"] 				= $Obj_dc->get_value("CONTACT_Kode_Post") ;
					$data_dualcard_agree["KodeArea"] 					= $Obj_dc->get_value("CONTACT_Kode_Area_Tlp") ;
					$data_dualcard_agree["HomePhone"] 					= $Obj_dc->get_value("CONTACT_Tlp_Rumah") ;
					$data_dualcard_agree["OFFICENAME"] 					= $Obj_dc->get_value("WORK_Nama_Kantor") ;
					$data_dualcard_agree["OFFICEADDR1"] 				= $Obj_dc->get_value("WORK_Almat_Kantor_1") ; 
					$data_dualcard_agree["OFFICEADDR2"] 				= $Obj_dc->get_value("WORK_Almat_Kantor_2") ;
					$data_dualcard_agree["OFFICEADDR3"] 				= $Obj_dc->get_value("WORK_Almat_Kantor_3") ;
					$data_dualcard_agree["OFFICEADDR4"] 				= $Obj_dc->get_value("WORK_Almat_Kantor_4") ;
					$data_dualcard_agree["OFFICECITY"] 					= $Obj_dc->get_value("WORK_Kota_Kantor") ;
					$data_dualcard_agree["OFFICEZIPCODE"] 				= $Obj_dc->get_value("WORK_Kode_Pos_Kantor") ;
					$data_dualcard_agree["KodeArea"] 					= $Obj_dc->get_value("WORK_Kode_Area_Tlp_Kantor") ;
					$data_dualcard_agree["OFFICEPHONE"] 				= $Obj_dc->get_value("WORK_Tlp_Kantor") ;
					$data_dualcard_agree["HANDPHONE"] 					= $Obj_dc->get_value("") ;
					$data_dualcard_agree["EmergencyContact"] 			= $Obj_dc->get_value("EC_Nama") ;
					$data_dualcard_agree["HUBUNGAN"] 					= $Obj_dc->get_value("EC_Hubungan") ;
					$data_dualcard_agree["TELPEMERGENCYCONTACT"] 		= $Obj_dc->get_value("EC_Telp") ;
					$data_dualcard_agree["KIRIMBILLING"] 				= $Obj_dc->get_value("WORK_Alamat_Biling") ;
					$data_dualcard_agree["KIRIMKARTU"] 					= $Obj_dc->get_value("WORK_Alamat_Kartu") ;
					$data_dualcard_agree["NamaBankLain"] 				= $Obj_dc->get_value("OTHER_Nama_Bank") ;
					$data_dualcard_agree["CardLain"] 					= $Obj_dc->get_value("") ;
					$data_dualcard_agree["SPV"] 						= $Obj_dc->get_value("") ;
					$data_dualcard_agree["QC"] 							= $Obj_dc->get_value("") ;
					$data_dualcard_agree["Program"] 					= $Obj_dc->get_value("") ;
					$data_dualcard_agree["File"] 						= $Obj_dc->get_value("") ;
					$data_dualcard[] = $data_dualcard_agree;
				}
			}
		}


		return $data_dualcard;
	}

	

	/**
	 * [_get_data_addon_ntb description]
	 * @param  string $CustomerNumber [description]
	 * @return [type]                 [description]
	 */
	public function _get_data_addon_ntb () {
		$fetch_addon_ntb = array();

		$data_addon_ntb = $this->data_addon_ntb;
		if ( is_array($data_addon_ntb) AND count($data_addon_ntb) > 0 ) {
			foreach ( $data_addon_ntb as $dan ) {
				$row_id = Objective($dan);
				$addon_id = $row_id->get_value("Addon_Id");
				$row_addon = $this->_row_addon($addon_id);

				if ( is_object($row_addon) AND $row_addon != false ) {
					foreach ( $row_addon->result() as $ra ) {
						$fetch_addon_ntb_arr = array();
						$fetch_addon_ntb_arr["ADDON_CustNum"] = $ra->ADDON_CustNum;
						$fetch_addon_ntb_arr["SPV_Code"] = $ra->SPV_Code;
						$fetch_addon_ntb_arr["Agent_Code"] = $ra->Agent_Code;
						$fetch_addon_ntb_arr["QA_Code"] = "";
						$fetch_addon_ntb_arr["ADDON_Nama_Kartu"] = $ra->ADDON_Nama_Kartu;
						$fetch_addon_ntb_arr["ADDON_DOB"] = $ra->ADDON_DOB;
						$fetch_addon_ntb_arr["ADDON_Jenis_Kelamin"] = $ra->ADDON_Jenis_Kelamin;
						$fetch_addon_ntb_arr["ADDON_No_Hp"] = $ra->ADDON_No_Hp;
						$fetch_addon_ntb_arr["ADDON_Jenis_Kartu"] = $ra->ADDON_Jenis_Kartu;
						$fetch_addon_ntb_arr["CreatedTs"] = $ra->CreatedTs;
						$fetch_addon_ntb_arr["ADDON_Hubungan"] = $ra->ADDON_Hubungan;

						$fetch_addon_ntb[] = $fetch_addon_ntb_arr;
					}
				}
			}
		}
		return $fetch_addon_ntb;
	}


	/**
	 * [_get_row_xsell description]
	 * @return [type] [description]
	 */
	public function _get_data_xsell ( $status_get = "" ) {


		$out = _get_all_request();
		$out = new EUI_Object($out);

		// and we get here
		$CampaignId   = $out->get_value("campaign_id");
		$StartDate    = $out->get_value("start_date");
		$EndDate      = $out->get_value("end_date");


		


		if ( $status_get == "xsell" ) {

		}

		if ( $status_get == "addon" ) {

		}

	}


    public function _get_data_usage(){
        $data_usage = false;
		$this->data_usage = $data_usage;
		$param_request = _get_all_request();
		$out = new EUI_Object($param_request);
		$this->data_addon_ntb = array();

		// and we get here
		$CampaignId   = $out->get_value("campaign_id");
		$StartDate    = $out->get_value("start_date");
		$EndDate      = $out->get_value("end_date");

		// filter all request if not empty get
		if ( !empty($CampaignId) AND !empty($StartDate) AND !empty($EndDate) ) {
			$StartDate = _getDateEnglish($StartDate) . " 00:00:00";
			$EndDate   = _getDateEnglish($EndDate) . " 23:59:58";
			$query_usg     = "
                SELECT a.*, b.DM_Recsource
                FROM t_gn_frm_usage a
                LEFT JOIN t_gn_customer_master b ON a.TX_Usg_CustId = b.DM_Id
                WHERE a.TX_Usg_CreatedTs >= '$StartDate' AND a.TX_Usg_CreatedTs <= '$EndDate'
                ORDER BY a.TX_Usg_Id
			";

			$get_data_usage  = $this->db->query( $query_usg );
			if ( $get_data_usage->num_rows() > 0 ) {
				$data_usage = $get_data_usage;
				$this->data_usage = $data_usage;

//				foreach ( $this->data_ntb->result() as $usg ) {
//					$data_addon_arr = array();
//					$data_addon_arr["CustomerNumber"] = $usg->TR_CustomerNumber;
//					$data_addon_arr["Addon_Id"] = $usg->TR_ADDONID;
//					$this->data_addon_ntb[] = $data_addon_arr;
//				}


			}
		}

		return $data_usage;
    }
	// END STATEMENT FOR NTB
	// ==============================================
	

	// ==============================================
	// START STATEMENT FOR XSELL
	

	













}


?>
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
	 		35 => "usage",
	 		36 => "tapenas"
	 	);
		$this->product = array(
	 		22 => "ntb" , 
	 		25 => "xsell" , 
	 		24 => "add" , 
	 		23 => "usage",
	 		26 => "tapenas"
	 	);
		
		$this->newcampaign = CampaignId();
		$this->newproduct = ProductByCampaignID();

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
		$out_data = array(
							"Campaign" => array(),
							"Supervisor" => $this -> M_SalesReportTabulasi ->supervisor(),
							"Transaksi" => $this -> M_SalesReportTabulasi ->transaksi()
						);
		$this->load->view("rpt_sales_report_tabulasi/report_sales_nav" , $out_data);
	}

	/**
	 * [ShowReport description]
	 */
	public function ShowReport () {		
		session_start();
		if(  $this->EUI_Session->_get_session('UserId') && $this->EUI_Session->_get_session('HandlingType') != '4') {
			
			$get_all_out = _get_all_request();
			$gao = new EUI_Object($get_all_out);
			$campaignId = $gao->get_value("campaign_id");
			$productid = $this->newproduct[$campaignId];
			// print_r($this->product[$productid]);
			$mode_report = strtolower($gao->get_value("mode"));
			if ( $gao->get_value("mode") == "HTML" ) {
				// switch mode
				$this->load->view( $this->folderCampaign . $mode_report . "/rpt_style" );
				switch ( $productid ) {
					// ntb report
					case 22 : 
						$this->load->view( $this->folderCampaign . $mode_report . "/rpt_".$this->product[$productid]."_html" , 
							array( "param" => $gao
								/*
									"data_ntb" => $this->_get_data_ntb() , 
									"data_ntb_dualcard" => $this->_get_data_dualcard_ntb() , 
									"data_addon_ntb" => $this->_get_data_addon_ntb(),
									"data_addon_ntb_1" => $this->M_SalesReportTabulasi->_get_data_addon_ntb_1(),
									"data_addon_ntb_2" => $this->M_SalesReportTabulasi->_get_data_addon_ntb_2()
									*/
						)); break;

					case 25 : $this->load->view( $this->folderCampaign . $mode_report . "/rpt_".$this->product[$productid]."_html" , array(
									"param" => $gao , 
									"data_ntb" => $this->_get_xsell() , 
									"data_addon_xsell" => $this->_get_data_xsell("addon")
						)); break;

					case 24 : $this->load->view( $this->folderCampaign . $mode_report . "/rpt_".$this->product[$productid]."_html" , array(
									"param" => $gao , 
									// "data_ntb" => $this->_row_addon()
									"data_ntb" => $this->_get_addon()
									// "data_ntb_dualcard" => $this->_get_data_dualcard_ntb() , 
									// "data_addon_ntb" => $this->_get_data_addon_ntb()
						)); break;
				   case 23 : 
					$this->load->view( $this->folderCampaign . $mode_report . "/rpt_".$this->product[$productid]."_html" , array(
									"param" => $gao
									
									//"data_usage" => $this->_get_data_usage()
	//								"data_ntb_dualcard" => $this->_get_data_dualcard_ntb() , 
	//								"data_addon_ntb" => $this->_get_data_addon_ntb()
						));
						break;
						
					case 26 : $this->load->view( $this->folderCampaign . $mode_report . "/rpt_".$this->product[$productid]."_html" , array(
									"param" => $gao,
									"data_tapenas" => $this->_get_data_tapenas()
									// "data_usage" => $this->_get_data_usage()
	//								"data_ntb_dualcard" => $this->_get_data_dualcard_ntb() , 
	//								"data_addon_ntb" => $this->_get_data_addon_ntb()
						));
						break;

					// case 44 : $this->load->view( $this->folderCampaign . $mode_report . "/rpt_".$this->campaign[35]."_html" , array(
									// "param" => $gao
									
									// "data_usage" => $this->_get_data_usage()
									// "data_ntb_dualcard" => $this->_get_data_dualcard_ntb() , 
									// "data_addon_ntb" => $this->_get_data_addon_ntb()
						// ));
						// break;
				}
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
			$result_array[$row['CampaignId']] = $row['CampaignCode']; 
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
	function getRecsourceByCampaign( $campaignId ){
		$fetchArray  = array();
		// get query data to process OK 
		$sql = sprintf("select a.DM_Recsource as Kode, b.FTP_UploadFilename as Name
						from t_gn_customer_master a 
						left join t_gn_upload_report_ftp b on a.DM_Recsource=b.FTP_Recsource
						where b.FTP_UploadSuccess > 0 
						and a.DM_CampaignId = %d
						group by a.DM_Recsource", $campaignId);
						
		$qry = $this->db->query( $sql );
		if( $qry && $qry->num_rows() > 0 ) 
		foreach( $qry->result_record() as $row ){
			$fetchArray[$row->field('Kode')] = $row->field('Name', 'basename'); 
		}	
		return (array)$fetchArray;
	} 
	/**
	 * [index description]
	 * @return [type] [description]
	 */
	 
	function ShowRecsourceByCampaignId(){
		
		$URL =& UR();
		$resultArray = array();
		
		// get '$CampaignId: data  
		$CampaignId = (int)$URL->field('CampaignId');
		$CampaignTgl = date('Ymd');
		$CacheName = sprintf("dropSalesSource%s.%s", $CampaignId, $CampaignTgl);
		
		$cache = new Cache();// create [cache JSON]
		$resultArray = $cache->cache_read($CacheName);
		if( !$cache->cache_ready($CacheName)){
			$resultArray = $this->getRecsourceByCampaign($CampaignId);
			$cache->cache_write($CacheName, $resultArray);
		}
		// return user browser OK SIP Ya .
		echo form()->combo('recsource_id','select auto x-select', $resultArray ,null, null, 
			array('multiple' => true, 'title' => '') ); 
			
		
		
		/*
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
			
			*/
		
	}
	/**
	 * [ShowReport description]
	 */
	public function ShowText() {
		session_start();
		if(  $this->EUI_Session->_get_session('UserId') && $this->EUI_Session->_get_session('HandlingType') != '4') {

			// definisi product report 
			$this->product = array( NTB 	=> "ntb" ,  	
									XSELL 	=> "xsell" , 
									ADD 	=> "add" , 		
									USAGE 	=> "usage",
									27 	=> "balcon",
								 );
			
			// ambil semua parameter yg di kirim 
			// oleh browser 
			
			$URI =& UR();
			
			// all setup 
			$campaignId = $URI->field("campaign_id");
			$productid  = $URI->field("product_id");
			$mode_report = $URI->field("mode", "strtolower");
			$StartDate    = $URI->field("start_date");
		    $EndDate      = $URI->field("end_date");

			
			// switch kondision process 
			$result_array  = array();

				
			switch( $productid ){
				// untuk sementara data yang di export ke txt hanya 
				// data usage saja .
				case USAGE : 
					$result_array = array(
						"param" => $URI,
						"title" => sprintf("Tabulasi_%s_%s",$this->product[$productid], date("ddmmyy") ),
						"data"  => $this->_get_data_usage(),
						"datesstart" =>$StartDate,
						"datesend" =>$EndDate
					);
				break;
				case 27 : 
					$result_array = array(
						"param" => $URI,
						"title" => sprintf("Tabulasi_%s_%s",$this->product[$productid], date("ddmmyy") ),
						"data"  => $this->_get_data_balcon() 
					);
				break;
				
				default:
					exit(0);
				break;
			}
			//var_dump($result_array);
			// masukan kedalam vie untuk di process 
			$this->foldername = sprintf("rpt_%s_text.php", $this->product[$productid]);
			$this->folderpath = sprintf("%s%s/%s", $this->folderCampaign, $mode_report, $this->foldername);
			
	$this->load->view( $this->folderpath, $result_array );

		}

	}


	/**
	 * [ShowReport description]
	 */
	public function ShowExcel () {
		session_start();
		if(  $this->EUI_Session->_get_session('UserId') && $this->EUI_Session->_get_session('HandlingType') != '4') {

			$get_all_out = _get_all_request();
			$gao = new EUI_Object($get_all_out);
			$campaignId = $gao->get_value("campaign_id");
			$mode_report = strtolower($gao->get_value("mode"));

			$productid = $this->newproduct[$campaignId];
			// print_r($this->product[$productid]);
			// $xcelFname = "report";
			// switch ( $campaignId ) {
				// case 29 : $xcelFname = 
			// 
			
			if ( $gao->get_value("mode") == "EXCEL" ) {
				// switch mode
				switch ( $productid ) {
					case 22 :
						$xcelFname = "Tabulasi_".$this->newcampaign[$campaignId]."_".date("ddmmyy");
						$dao = array(
									// "param" => $gao , 
									// "data_ntb" => $this->_get_data_ntb() , 
									// "data_ntb_dualcard" => $this->_get_data_dualcard_ntb() , 
									// "data_addon_ntb" => $this->_get_data_addon_ntb()
									
									"param" => $gao,
									"data_ntb" => $this->_get_data_ntb(),
									"data_ntb_dualcard" => $this->_get_data_dualcard_ntb(),
									"data_addon_ntb" => $this->_get_data_addon_ntb(),
									"data_addon_ntb_1" => $this->M_SalesReportTabulasi->_get_data_addon_ntb_1(),
									"data_addon_ntb_2" => $this->M_SalesReportTabulasi->_get_data_addon_ntb_2()
						);
						$Product = $this->product[$productid];
					break;
					case 25 :
						$xcelFname = "Tabulasi_".$this->newcampaign[$campaignId]."_".date("ddmmyy");
						$dao = array(
									// "param" => $gao , 
									// "data_ntb" => $this->_get_data_ntb() , 
									// "data_ntb_dualcard" => $this->_get_data_dualcard_ntb() , 
									// "data_addon_ntb" => $this->_get_data_addon_ntb()
									
									"param" => $gao , 
									"data_ntb" => $this->_get_xsell() , 
									"data_addon_xsell" => $this->_get_data_xsell("addon")
						);
						$Product = $this->product[$productid];
					break;
					case 24 :
						$xcelFname = "Tabulasi_".$this->newcampaign[$campaignId]."_".date("ddmmyy");
						$dao = array(
									// "param" => $gao , 
									// "data_ntb" => $this->_row_addon()
									// "data_ntb_dualcard" => $this->_get_data_dualcard_ntb() , 
									// "data_addon_ntb" => $this->_get_data_addon_ntb()
									
									"param" => $gao , 
									// "data_ntb" => $this->_row_addon()
									"data_ntb" => $this->_get_addon()
									// "data_ntb_dualcard" => $this->_get_data_dualcard_ntb() , 
									// "data_addon_ntb" => $this->_get_data_addon_ntb()
						);
						$Product = $this->product[$productid];
					break;
					case 23 :
						$xcelFname = "Tabulasi_".$this->newcampaign[$campaignId]."_".date("ddmmyy");
						$dao = array(
									// "param" => $gao , 
									// "data_ntb" => $this->_get_data_ntb()
									// "data_ntb_dualcard" => $this->_get_data_dualcard_ntb() , 
									// "data_addon_ntb" => $this->_get_data_addon_ntb()
									
									"param" => $gao,
									"data_usage" => $this->_get_data_usage()
	//								"data_ntb_dualcard" => $this->_get_data_dualcard_ntb() , 
	//								"data_addon_ntb" => $this->_get_data_addon_ntb()
						);
						$Product = $this->product[$productid];
					break;
					case 26 :
						$xcelFname = "Tabulasi_".$this->newcampaign[$campaignId]."_".date("ddmmyy");
						$dao = array(
									// "param" => $gao , 
									// "data_ntb" => $this->_get_data_ntb()
									// "data_ntb_dualcard" => $this->_get_data_dualcard_ntb() , 
									// "data_addon_ntb" => $this->_get_data_addon_ntb()
									
									"param" => $gao,
									"data_tapenas" => $this->_get_data_tapenas()
	//								"data_ntb_dualcard" => $this->_get_data_dualcard_ntb() , 
	//								"data_addon_ntb" => $this->_get_data_addon_ntb()
						);
						$Product = $this->product[$productid];
					break;
					// case 44 :
						// $xcelFname = "Tabulasi_".$this->campaign[35]."_".date("ddmmyy");
						// $dao = array(
									// "param" => $gao , 
									// "data_ntb" => $this->_get_data_ntb()
									// "data_ntb_dualcard" => $this->_get_data_dualcard_ntb() , 
									// "data_addon_ntb" => $this->_get_data_addon_ntb()
									
									// "param" => $gao,
									// "data_usage" => $this->_get_data_usage()
									// "data_ntb_dualcard" => $this->_get_data_dualcard_ntb() , 
									// "data_addon_ntb" => $this->_get_data_addon_ntb()
						// );
						// $Campaign = $this->campaign[35];
					// break;
				}
			}
			
			header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
			header("Content-Disposition: attachment; filename=$xcelFname.xls");  //File name extension was wrong
			header("Expires: 0");
			header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
			header("Cache-Control: private",false);

			// <!-- perubahan 12-08-2020 -->
			if($this->EUI_Session->_get_session('HandlingType') == '22' && $Product==$this->product[23] || $this->EUI_Session->_get_session('UserId')=='685' && $Product==$this->product[23]){
			$this->load->view( $this->folderCampaign . $mode_report . "/rpt_".$Product."_excel_spv" , $dao);
			}else{
			$this->load->view( $this->folderCampaign . $mode_report . "/rpt_".$Product."_excel" , $dao);
			}

		}

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
		$sql = "SELECT concat(b.DM_FirstName , ' ' , if(b.DM_LastName is not null , b.DM_LastName , '') ) as CustomerNames , a.*,
			b.DM_QualityUserId, c.id, d.Gender,
			case  
			   when a.ADDON_Jenis_Kartu = '1,2' then 'Pertama Dan Kedua'
			   when a.ADDON_Jenis_Kartu = '1' then 'Pertama'
			   when a.ADDON_Jenis_Kartu = '2' then 'Kedua'
			end as Jenis, e.RelationshipTypeDesc,
			IF(f.handling_type != 4, h.id, a.Agent_Code) AgentCode,
			date(a.CreatedTs) as CreatedTs, c.id QA_Code
						FROM t_gn_frm_addon a 
						INNER JOIN t_gn_customer_master b on a.ADDON_CustNum=b.DM_Custno
						LEFT JOIN tms_agent c ON b.DM_QualityUserId = c.UserId
						INNER JOIN t_lk_gender d ON a.ADDON_Jenis_Kelamin = d.GenderId
						INNER JOIN t_lk_relationshiptype e ON a.ADDON_Hubungan = e.RelationshipTypeCode
						INNER JOIN tms_agent f ON a.Agent_Code = f.id
						INNER JOIN t_gn_assignment g ON b.DM_Id = g.AssignCustId
						INNER JOIN tms_agent h ON g.AssignSelerId = h.UserId
			WHERE a.FRM_Addon_Id in($addon_id) and b.DM_CampaignId";
		$get_addon = $this->db->query($sql);
		// echo "<pre>$sql</pre>";
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
		$Supervisor   = $out->get_value("supervisor_id");							   
		$Tmr		  = $out->get_value("TmrId");							   

		// filter all request if not empty get
		if ( !empty($CampaignId) AND !empty($StartDate) AND !empty($EndDate) ) {
			
			// please change this [query] for efectively bandwidth
 
			$StartDate = _getDateEnglish($StartDate) . " 00:00:00";
			$EndDate   = _getDateEnglish($EndDate) . " 23:59:58";
			$query_ntb     = "SELECT e.DM_Dob,ca.CAF_Kode as LOGO,rl.RelationshipTypeDesc as dulur,e.DM_FirstName,o.OccDesc as gawean, co.CO_Name as perusahaan,
								ms.MaritalStatusDesc as ngewong,st.ST_Name as ownership,
								cv.CAF_Kode as CardVarian,
								d.CONTACT_Status_Pernikahan,
								d.*, a.*, if(b.handling_type = 4, b.id, i.id) Agent_Code,
								b.spv_id, c.id SPV_Code, e.DM_QualityUserId, g.id QA_Code,
								e.DM_CcLimit, f.FTP_UploadFilename,
#								concat('T00T', if(b.handling_type = 4, b.id, i.id), 'MAS1MAS1000') SourceCode,
								case when (e.DM_DataType='REG') then concat('T00T', if(b.handling_type = 4, b.id, i.id), 'MAS1MAS1000')
								when (e.DM_DataType='CAP') then concat('L00T', if(b.handling_type = 4, b.id, i.id), 'MAS1MAS1000')
								else 'NO'
								end as SourceCode,
								case when (e.DM_DataType='REG') then concat('T9', if(b.handling_type = 4, b.id, i.id), 'MAS1MAS1000')
								when (e.DM_DataType='CAP') then concat('L9', if(b.handling_type = 4, b.id, i.id), 'MAS1MAS1000')
								else 'NO'
								end as SourceCode2,
								j.RelationshipTypeDesc, d.CONTACT_Nama_Ibu_Kandung, k.CallHistoryNotes
								FROM t_gn_frm_transaction_ntb a
								left JOIN tms_agent b ON a.TR_Agent_ID = b.UserId
								left JOIN tms_agent c ON b.spv_id = c.UserId
								left JOIN t_gn_frm_ntb d ON a.TR_CustomerNumber = d.DB_CustNum
								left join t_lk_occupation o on o.OccCode=d.WORK_Pekerjaan
								left JOIN t_gn_customer_master e ON a.TR_CustomerNumber = e.DM_Custno
								left JOIN t_gn_upload_report_ftp f ON e.DM_UploadId = f.FTP_UploadId
								left join t_lk_corporation co on d.WORK_Jenis_Perusahaan=co.CO_Kode
								left join t_lk_maritalstatus ms on d.CONTACT_Status_Pernikahan=ms.MaritalStatusCode
								left join t_lk_state_type st on st.ST_Kode=d.CONTACT_Status_Tempat_Tinggal
								left join t_lk_cardvarian ca on ca.CAF_Id=d.CC_Kartu_Yang_Diinginkan
								left join t_lk_cardvarian cv on cv.CAF_Id=d.DC_Dual_Card_Propose
								left join t_lk_relationshiptype rl on rl.RelationshipTypeCode=d.EC_Hubungan and rl.RelationshipType = 1
								left join t_lk_cardvarian ca1 on ca1.CAF_Id=d.CC_Afinity
								left JOIN tms_agent g ON e.DM_QualityUserId = g.UserId
								left JOIN t_gn_assignment h ON e.DM_Id = h.AssignCustId
								left JOIN tms_agent i ON h.AssignSelerId = i.UserId
								left JOIN t_lk_relationshiptype j ON d.EC_Hubungan = j.RelationshipTypeCode and j.RelationshipType = 1
								inner join (select
													his.CustomerId, his.CallHistoryNotes
												from t_gn_callhistory his
												where his.CallReasonId = 22
												and his.CallHistoryCreatedTs >= '$StartDate'
												and his.CallHistoryCreatedTs <= '$EndDate'
												group by his.CustomerId
												order by his.CallHistoryId asc) k on e.DM_Id = k.CustomerId
				WHERE e.DM_QualityUpdateTs >= '$StartDate' AND e.DM_QualityUpdateTs <= '$EndDate' AND e.DM_QualityReasonId=44 ";
				if($Supervisor){
					$query_ntb .=" And b.spv_id in ($Supervisor) ";
				}
				if($Tmr){
					$query_ntb .=" And b.UserId in ($Tmr) ";
				}
				$query_ntb .="ORDER BY a.TR_CustomerNumber";
			// echo "<pre>$query_ntb</pre>"; exit();
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
					$data_dualcard_agree["LOGO"] 						= $Obj_dc->get_value("LOGO") ;
					$data_dualcard_agree["APPID"] 						= $Obj_dc->get_value("AppId") ;
					$data_dualcard_agree["CustomerNumber"] 				= $Obj_dc->get_value("DB_CustNum") ;
					$data_dualcard_agree["CustomerNumberCorporate"] 	= $Obj_dc->get_value("") ;
					$data_dualcard_agree["EmpolyoeeReffCode"] 			= $Obj_dc->get_value("") ;
					$data_dualcard_agree["SourceCode"] 					= $Obj_dc->get_value("SourceCode2") ;
					$data_dualcard_agree["CARD"] 						= $Obj_dc->get_value("CardVarian") ;
					$data_dualcard_agree["JenisKartu"] 					= $Obj_dc->get_value("DC_Dual_Card_Type") ;
					$data_dualcard_agree["LOGODualCard"] 				= $Obj_dc->get_value("") ;
					$data_dualcard_agree["LIMIT"] 						= $Obj_dc->get_value("DC_Dual_Card_Limit") ;
					$data_dualcard_agree["NamaDiKTP"] 					= $Obj_dc->get_value("DM_FirstName") ;
					$data_dualcard_agree["NamaDiKartu"] 				= $Obj_dc->get_value("CC_Nama_Yang_Diinginkan") ;
					$data_dualcard_agree["DOBCustomer"] 				= $Obj_dc->get_value("DM_Dob") ;
					$data_dualcard_agree["JenisKelamin"] 				= $Obj_dc->get_value("CONTACT_Jenis_Kelamin") ;
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
					$data_dualcard_agree["HUBUNGAN"] 					= $Obj_dc->get_value("RelationshipTypeDesc") ;
					$data_dualcard_agree["TELPEMERGENCYCONTACT"] 		= $Obj_dc->get_value("EC_Telp") ;
					$data_dualcard_agree["KIRIMBILLING"] 				= $Obj_dc->get_value("WORK_Alamat_Biling") ;
					$data_dualcard_agree["KIRIMKARTU"] 					= $Obj_dc->get_value("WORK_Alamat_Kartu") ;
					$data_dualcard_agree["NamaBankLain"] 				= $Obj_dc->get_value("OTHER_Nama_Bank") ;
					$data_dualcard_agree["CardLain"] 					= $Obj_dc->get_value("") ;
					$data_dualcard_agree["SPV"] 						= $Obj_dc->get_value("SPV_Code") ;
					$data_dualcard_agree["QC"] 							= $Obj_dc->get_value("QA_Code") ;
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
						$fetch_addon_ntb_arr["Agent_Code"] = $ra->AgentCode;
						$fetch_addon_ntb_arr["QA_Code"] = $ra->QA_Code;
						$fetch_addon_ntb_arr["ADDON_Nama_Kartu"] = $ra->ADDON_Nama_Kartu;
						$fetch_addon_ntb_arr["ADDON_DOB"] = $ra->ADDON_DOB;
						$fetch_addon_ntb_arr["ADDON_Jenis_Kelamin"] = $ra->Gender;
						$fetch_addon_ntb_arr["ADDON_No_Hp"] = $ra->ADDON_No_Hp;
						$fetch_addon_ntb_arr["ADDON_Jenis_Kartu"] = $ra->Jenis;
						$fetch_addon_ntb_arr["CreatedTs"] = $ra->CreatedTs;
						$fetch_addon_ntb_arr["ADDON_Hubungan"] = $ra->RelationshipTypeDesc;

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


		


		if ( $status_get == "xsell" and !empty($CampaignId) AND !empty($StartDate) AND !empty($EndDate) ) {
			$StartDate = _getDateEnglish($StartDate) . " 00:00:00";
			$EndDate   = _getDateEnglish($EndDate) . " 23:59:00";
			
			// $queryXsel = "";

		}

		if ( $status_get == "addon" ) {

		}

	}
	
	public function _get_xsell () {
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
		$Supervisor   = $out->get_value("supervisor_id");
		$Tmr		  = $out->get_value("TmrId");							   

		// filter all request if not empty get
		if ( !empty($CampaignId) AND !empty($StartDate) AND !empty($EndDate) ) {
			$StartDate = _getDateEnglish($StartDate) . " 00:00:00";
			$EndDate   = _getDateEnglish($EndDate) . " 23:59:58";
			$query_ntb     = "select xs.TR_CustomerNumber as ApplicationID,
								'' as ORG,
								cs.DM_CcTypeName as LOGO,
								ca.CAF_Name as LOGOBARU,
								cs.DM_CcTypeName as KartuLama,
								cs.DM_FirstName as NamaKartu,
								concat('T90T', if(b.handling_type = 4, a.id, c.id), '133CP200000') SourceCode,
								b.id as PIC_SPV,
								d.id as PIC_QC,
								( select ch.CallHistoryNotes from t_gn_callhistory ch 
								   WHERE ch.CallHistoryId=( select max(cm.CallHistoryId) from t_gn_callhistory cm  
								   where cm.CustomerId=cs.DM_Id and cm.HistoryType=0 )) as NOTE,
	
								right(up.FTP_UploadFilename,42) as UPLOAD_ID,
								sx.DB_NPWP as NPWP,
								sx.XSELL_Ktp as ktp,
								sx.XSELL_Tempat_Lahir as Tempat_lahir
								#xs.TR_Created_Date
								from t_gn_frm_transaction_xsell xs
								inner join tms_agent a on xs.TR_Agent_ID=a.UserId
								inner join tms_agent b on a.spv_id=b.UserId
								inner join t_gn_customer_master cs on cs.DM_Custno=xs.TR_CustomerNumber
								INNER JOIN t_gn_frm_xsell sx on sx.DB_CustNum=xs.TR_CustomerNumber
								INNER JOIN tms_agent c on cs.DM_SellerId=c.UserId
								inner join tms_agent d on cs.DM_QualityUserId=d.UserId
								inner join t_lk_cardvarian ca on ca.CAF_Id=sx.DB_Logo
								inner join t_gn_upload_report_ftp up on up.FTP_UploadId=cs.DM_UploadId
								WHERE cs.DM_CallReasonId=22 and
								cs.DM_QualityReasonId=44
								and cs.DM_QualityUpdateTs >= '$StartDate' 
								AND cs.DM_QualityUpdateTs <= '$EndDate'";
				if($Supervisor){
					$query_ntb .=" And b.spv_id in ($Supervisor) ";
				}
				if($Tmr){
					$query_ntb .=" And a.UserId in ($Tmr) ";
				}
				//$query_ntb .="order by xs.TR_CustomerNumber";
			//echo "<pre>$query_ntb</pre>";
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
	
	public function _get_addon () {
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
		$Supervisor   = $out->get_value("supervisor_id");							   
		$Tmr		  = $out->get_value("TmrId");							   

		// filter all request if not empty get
		if ( !empty($CampaignId) AND !empty($StartDate) AND !empty($EndDate) ) {
			$StartDate = _getDateEnglish($StartDate) . " 00:00:00";
			$EndDate   = _getDateEnglish($EndDate) . " 23:59:58";
			$query_ntb     = "select 
							a.TR_CustomerNumber as CustId,
							cm.DM_Id,
							cm.DM_FirstName as NamaKartu,
							b.ADDON_Nama_Kartu,
							b.ADDON_Jenis_Kelamin,
							ca.CAF_Kode as JenisKartu,
							'' as JenisKartu2,
							re.RelationshipTypeDesc as dulur,
							b.ADDON_DOB as DOB,
							b.ADDON_No_Hp,
							'' as HomePhone,
							'' as WorkPhone,
							'' as HP,
							c.CallReasonCode as StatusCall,
							'' as ReasonCall,
							date(cm.DM_CallDateTs) as TglCall,
							'' as KrimKrtu,
							'' as HomeNo,
							'' as MobNo,
							'' as OffNo,
							b.SPV_Code,
							ag.id as QCCode,
							g.id as AgentCode,
							concat('T00T', if(e.handling_type = 4, g.id, d.id), '00001000000') SourceCode,
							cm.DM_CallDateTs as LastDate,
							mid(up.FTP_UploadFilename,47,50) as UPLOAD_desc,
							'' as Email,
							'' as FaxNo,
							(select ch.CallHistoryNotes from t_gn_callhistory ch WHERE ch.CustomerId=cm.DM_Id
							and ch.CallReasonId=22 order by ch.CallHistoryId desc limit 1) as NOTE,
							'' as NoteQc,
							'' as Address1,
							'' as OhomePhone,
							'' as OMobilePhone,
							'' as OfficePhone,
							'' as CCExpired
							from t_gn_frm_transaction_addon a
							left join t_gn_frm_addon b on a.TR_CustomerNumber=b.ADDON_CustNum
							inner join t_gn_customer_master cm on cm.DM_Custno=a.TR_CustomerNumber
							inner join t_lk_cardvarian ca on ca.CAF_Id=b.ADDON_Jenis_Kartu
							inner join t_lk_relationshiptype re on re.RelationshipTypeCode=b.ADDON_Hubungan
							inner join t_lk_callreason c on cm.DM_QualityReasonId=c.CallReasonId
							inner join tms_agent ag on ag.UserId=cm.DM_QualityUserId
							inner join tms_agent g on g.UserId=a.TR_Agent_ID
							inner join tms_agent e on g.spv_id=e.UserId
							inner join tms_agent d on d.UserId=cm.DM_SellerId
							inner join t_gn_upload_report_ftp up on up.FTP_UploadId=cm.DM_UploadId
				WHERE cm.DM_QualityUpdateTs >= '$StartDate' AND cm.DM_QualityUpdateTs <= '$EndDate' 
				AND cm.DM_QualityReasonId=44 ";
				if($Supervisor){
					$query_ntb .=" And g.spv_id in ($Supervisor) ";
				}
				if($Tmr){
					$query_ntb .=" And g.UserId in ($Tmr) ";
				}
				// $query_ntb .=" group by b.ADDON_Nama_Kartu ORDER BY a.TR_CustomerNumber";
				$query_ntb .=" group by b.FRM_Addon_Id ORDER BY a.TR_CustomerNumber";
			// echo "<pre>$query_ntb</pre>"; exit();
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


//     public function _get_data_usage(){
//         $data_usage = false;
// 		$this->data_usage = $data_usage;
// 		$param_request = _get_all_request();
// 		$out = new EUI_Object($param_request);
// 		$this->data_addon_ntb = array();

// 		// and we get here
// 		$CampaignId   = $out->get_value("campaign_id");
// 		$StartDate    = $out->get_value("start_date");
// 		$EndDate      = $out->get_value("end_date");
// 		$Supervisor	  = $out->get_value("supervisor_id");
// 		$Transaksi	  = $out->get_value("transaksi");
// 		$Tmr		  = $out->get_value("TmrId");

// 		// filter all request if not empty get
// 		if ( !empty($CampaignId) AND !empty($StartDate) AND !empty($EndDate) ) {
// 			$StartDate = _getDateEnglish($StartDate) . " 00:00:00";
// 			$EndDate   = _getDateEnglish($EndDate) . " 23:59:58";
// 			$query_usg     = "SELECT a.*, b.DM_Recsource , g.PRD_Data_Value , b.DM_spvid, 
// 					b.DM_QualityUserId, h.code_user FROM t_gn_frm_usage a
// 					LEFT JOIN t_gn_customer_master b ON a.TX_Usg_CustId = b.DM_Id
// 					INNER JOIN t_gn_assignment f on b.DM_Id = f.AssignCustId
// 					INNER JOIN t_lk_program_detail g on a.TX_Usg_ProgramData=g.PRD_Data_Id
// 					LEFT JOIN tms_agent h on b.DM_QualityUserId = h.UserId
// 					WHERE 1=1
// 					and b.DM_QualityReasonId = 44
// 					and b.DM_QualityUpdateTs >= '$StartDate' AND b.DM_QualityUpdateTs <= '$EndDate'";
// 					if($Supervisor){
// 						$query_usg .=" And f.AssignSpv in ($Supervisor) ";
// 					}
// 					if($Transaksi == 1){
// 						// $query_usg .=" And a.TX_Usg_TransSeq = $Transaksi ";
// 						$query_usg .=" And a.TX_Usg_TransSeq %2 <> 0 ";
// 					} else if($Transaksi == 2) {
// 						$query_usg .=" And a.TX_Usg_TransSeq %2 = 0 ";
// 					}
// 					if($Tmr){
// 						$query_usg .=" And f.AssignSelerId IN ($Tmr) ";
// 					}
// 					$query_usg .="ORDER BY a.TX_Usg_Id";
// 			//echo "<pre>$query_usg</pre>";
// 			$get_data_usage  = $this->db->query( $query_usg );
// 			if ( $get_data_usage->num_rows() > 0 ) {
// 				$data_usage = $get_data_usage;
// 				$this->data_usage = $data_usage;

// //				foreach ( $this->data_ntb->result() as $usg ) {
// //					$data_addon_arr = array();
// //					$data_addon_arr["CustomerNumber"] = $usg->TR_CustomerNumber;
// //					$data_addon_arr["Addon_Id"] = $usg->TR_ADDONID;
// //					$this->data_addon_ntb[] = $data_addon_arr;
// //				}


// 			}
// 		}

// 		return $data_usage;
//     }

	public function _get_data_usage(){
		// echo "test";
		// die;
        $data_usage = false;
		$this->data_usage = $data_usage;
		$param_request = _get_all_request();
		$out = new EUI_Object($param_request);
		$this->data_addon_ntb = array();

		// and we get here
		$CampaignId   = $out->get_value("campaign_id");
		$StartDate    = $out->get_value("start_date");
		$EndDate      = $out->get_value("end_date");
		$Supervisor	  = $out->get_value("supervisor_id");
		$Transaksi	  = $out->get_value("transaksi");
		$Tmr		  = $out->get_value("TmrId");

		// filter all request if not empty get
		if ( !empty($CampaignId) AND !empty($StartDate) AND !empty($EndDate) ) {
			$StartDate = _getDateEnglish($StartDate) . " 00:00:00";
			$EndDate   = _getDateEnglish($EndDate) . " 23:59:58";
			if($Transaksi ==1){	
				$query_usg     = "SELECT a.*, b.DM_Recsource , g.PRD_Data_Value , b.DM_spvid, 
						b.DM_QualityUserId, h.code_user, b.DM_MobilePhoneNum FROM t_gn_frm_usage a
						INNER JOIN (SELECT TX_Usg_Custno, if(count(TX_Usg_TransSeq) = 1, TX_Usg_TransSeq, min(TX_Usg_TransSeq)) as MaxSeq
						FROM t_gn_frm_usage GROUP BY TX_Usg_FixID) Seq on a.TX_Usg_Custno = Seq.TX_Usg_Custno
						AND a.TX_Usg_TransSeq = Seq.MaxSeq
						LEFT JOIN t_gn_customer_master b ON a.TX_Usg_CustId = b.DM_Id
						INNER JOIN t_gn_assignment f on b.DM_Id = f.AssignCustId
						INNER JOIN t_lk_program_detail g on a.TX_Usg_ProgramData=g.PRD_Data_Id
						LEFT JOIN tms_agent h on b.DM_QualityUserId = h.UserId
						WHERE 1=1
						and b.DM_QualityReasonId = 44
						AND g.PRD_Data_Value !=  'SS 1%' 
						AND g.PRD_Data_Value !=  'SS 1.25%' 
						and b.DM_QualityUpdateTs >= '$StartDate' AND b.DM_QualityUpdateTs <= '$EndDate'";
					if($Supervisor){
						$query_usg .=" And f.AssignSpv in ($Supervisor) ";
					}
					if($Tmr){
						$query_usg .=" And f.AssignSelerId IN ($Tmr) ";
					}
					//  var_dump($query_usg);
					//  die;
			} else if($Transaksi ==2){
				$query_usg     = "SELECT a.*, b.DM_Recsource , g.PRD_Data_Value , b.DM_spvid, 
						b.DM_QualityUserId, h.code_user, b.DM_MobilePhoneNum FROM t_gn_frm_usage a
						INNER JOIN (SELECT TX_Usg_Custno, if(count(TX_Usg_TransSeq) > 1, max(TX_Usg_TransSeq), 0) as MaxSeq
						FROM t_gn_frm_usage GROUP BY TX_Usg_FixID) Seq on a.TX_Usg_Custno = Seq.TX_Usg_Custno
						AND a.TX_Usg_TransSeq = Seq.MaxSeq
						LEFT JOIN t_gn_customer_master b ON a.TX_Usg_CustId = b.DM_Id
						INNER JOIN t_gn_assignment f on b.DM_Id = f.AssignCustId
						INNER JOIN t_lk_program_detail g on a.TX_Usg_ProgramData=g.PRD_Data_Id
						LEFT JOIN tms_agent h on b.DM_QualityUserId = h.UserId
						WHERE 1=1
						and b.DM_QualityReasonId = 44
						AND g.PRD_Data_Value !=  'SS 1%' 
						AND g.PRD_Data_Value !=  'SS 1.25%' 
						and a.TX_Usg_ProgramValue <> 'XD 0,75%'
						and b.DM_QualityUpdateTs >= '$StartDate' AND b.DM_QualityUpdateTs <= '$EndDate'";
					if($Supervisor){
						$query_usg .=" And f.AssignSpv in ($Supervisor) ";
					}
					if($Tmr){
						$query_usg .=" And f.AssignSelerId IN ($Tmr) ";
					}
			} else if($Transaksi ==3){
				$query_usg     = "SELECT a.*, b.DM_Recsource , g.PRD_Data_Value , b.DM_spvid, 
						b.DM_QualityUserId, h.code_user, b.DM_MobilePhoneNum FROM t_gn_frm_usage a
						INNER JOIN (SELECT TX_Usg_Custno,
	if(count(TX_Usg_TransSeq) > 1, if(max(TX_Usg_TransSeq)>1, MAX(TX_Usg_TransSeq),0), 0) as MaxSeq
						FROM t_gn_frm_usage GROUP BY TX_Usg_Custno) Seq on a.TX_Usg_Custno = Seq.TX_Usg_Custno
						AND a.TX_Usg_TransSeq = Seq.MaxSeq
						LEFT JOIN t_gn_customer_master b ON a.TX_Usg_CustId = b.DM_Id
						INNER JOIN t_gn_assignment f on b.DM_Id = f.AssignCustId
						INNER JOIN t_lk_program_detail g on a.TX_Usg_ProgramData=g.PRD_Data_Id
						LEFT JOIN tms_agent h on b.DM_QualityUserId = h.UserId
						WHERE 1=1
						and b.DM_QualityReasonId = 44
						and a.TX_Usg_ProgramValue in ('XD 0,75%','XD 0,65%')
						and b.DM_QualityUpdateTs >= '$StartDate' AND b.DM_QualityUpdateTs <= '$EndDate'";
					if($Supervisor){
						$query_usg .=" And f.AssignSpv in ($Supervisor) ";
					}
					if($Tmr){
						$query_usg .=" And f.AssignSelerId IN ($Tmr) ";
					}
					
					$query_usg .= " GROUP BY a.TX_Usg_Id ";
					
			}  else if($Transaksi ==4){
				/*$query_usg     = "SELECT a.*, b.DM_Recsource , g.PRD_Data_Value , b.DM_spvid, 
						b.DM_QualityUserId, h.code_user, b.DM_MobilePhoneNum, CONCAT(TX_Usg_ProgramValue,'-',TX_Usg_TransSeq) as MaxSeq FROM t_gn_frm_usage a
						LEFT JOIN t_gn_customer_master b ON a.TX_Usg_CustId = b.DM_Id
						INNER JOIN t_gn_assignment f on b.DM_Id = f.AssignCustId
						INNER JOIN t_lk_program_detail g on a.TX_Usg_ProgramData=g.PRD_Data_Id
						LEFT JOIN tms_agent h on b.DM_QualityUserId = h.UserId
						WHERE 1=1
						and b.DM_QualityReasonId = 44
						#and a.TX_Usg_ProgramValue <> 'XD 0,75%'
						and b.DM_QualityUpdateTs >= '$StartDate' AND b.DM_QualityUpdateTs <= '$EndDate'";
					if($Supervisor){
						$query_usg .=" And f.AssignSpv in ($Supervisor) ";
					}
					if($Tmr){
						$query_usg .=" And f.AssignSelerId IN ($Tmr) ";
					}*/
					$query_usg1     = "SELECT * FROM (SELECT a.*, b.DM_Recsource , g.PRD_Data_Value , b.DM_spvid, 
						b.DM_QualityUserId, h.code_user, b.DM_MobilePhoneNum, CONCAT(TX_Usg_ProgramValue,'-',1) AS MaxSeq FROM t_gn_frm_usage a
						INNER JOIN
							(SELECT TX_Usg_Custno,
if(TX_Usg_ProgramValue<>'XD 0,75%' AND count(TX_Usg_TransSeq) > 1, min(TX_Usg_TransSeq),
	if(TX_Usg_ProgramValue<>'XD 0,75%' AND count(TX_Usg_TransSeq) = 1, TX_Usg_TransSeq,0)
	) AS MaxSeq
								FROM t_gn_frm_usage a LEFT JOIN t_gn_customer_master b ON a.TX_Usg_CustId = b.DM_Id
		WHERE b.DM_UpdatedTs >= '$StartDate' AND b.DM_UpdatedTs <= '$EndDate' and TX_Usg_ProgramValue<>'XD 0,75%' GROUP BY TX_Usg_Custno) Seq
									on a.TX_Usg_Custno = Seq.TX_Usg_Custno
						AND a.TX_Usg_TransSeq = Seq.MaxSeq
						LEFT JOIN t_gn_customer_master b ON a.TX_Usg_CustId = b.DM_Id
						INNER JOIN t_gn_assignment f on b.DM_Id = f.AssignCustId
						INNER JOIN t_lk_program_detail g on a.TX_Usg_ProgramData=g.PRD_Data_Id
						LEFT JOIN tms_agent h on b.DM_QualityUserId = h.UserId
						WHERE 1=1
						and b.DM_QualityReasonId = 44
						AND g.PRD_Data_Value != 'SS 1%' 
						AND g.PRD_Data_Value != 'SS 1.25%'
						and b.DM_QualityUpdateTs >= '$StartDate' AND b.DM_QualityUpdateTs <= '$EndDate'";
					if($Supervisor){
						$query_usg1 .=" And f.AssignSpv in ($Supervisor) ";
					}
					if($Tmr){
						$query_usg1 .=" And f.AssignSelerId IN ($Tmr) ";
					}
					
					$query_usg2     = "SELECT a.*, b.DM_Recsource , g.PRD_Data_Value , b.DM_spvid, 
						b.DM_QualityUserId, h.code_user, b.DM_MobilePhoneNum, CONCAT(TX_Usg_ProgramValue,'-',2) AS MaxSeq FROM t_gn_frm_usage a
						INNER JOIN (SELECT TX_Usg_Custno,
if(TX_Usg_ProgramValue not in ('XD 0,75%','XD 0,65%') AND count(TX_Usg_TransSeq) > 1, max(TX_Usg_TransSeq), 0) AS MaxSeq
						FROM t_gn_frm_usage a LEFT JOIN t_gn_customer_master b ON a.TX_Usg_CustId = b.DM_Id
		WHERE b.DM_UpdatedTs >= '$StartDate' AND b.DM_UpdatedTs <= '$EndDate' GROUP BY TX_Usg_FixID) Seq on a.TX_Usg_Custno = Seq.TX_Usg_Custno
						AND a.TX_Usg_TransSeq = Seq.MaxSeq
						LEFT JOIN t_gn_customer_master b ON a.TX_Usg_CustId = b.DM_Id
						INNER JOIN t_gn_assignment f on b.DM_Id = f.AssignCustId
						INNER JOIN t_lk_program_detail g on a.TX_Usg_ProgramData=g.PRD_Data_Id
						LEFT JOIN tms_agent h on b.DM_QualityUserId = h.UserId
						WHERE 1=1
						and b.DM_QualityReasonId = 44
						AND g.PRD_Data_Value != 'SS 1%' 
						AND g.PRD_Data_Value != 'SS 1.25%'
						#and a.TX_Usg_ProgramValue <> 'XD 0,75%'
						and b.DM_QualityUpdateTs >= '$StartDate' AND b.DM_QualityUpdateTs <= '$EndDate'";
						// if(TX_Usg_ProgramValue<>'XD 0,75%' AND count(TX_Usg_TransSeq) > 1, max(TX_Usg_TransSeq), 0) AS MaxSeq
					if($Supervisor){
						$query_usg2 .=" And f.AssignSpv in ($Supervisor) ";
					}
					if($Tmr){
						$query_usg2 .=" And f.AssignSelerId IN ($Tmr) ";
					}
					
			$query_usg3     = "SELECT a.*, b.DM_Recsource , g.PRD_Data_Value , b.DM_spvid, 
						b.DM_QualityUserId, h.code_user, b.DM_MobilePhoneNum, CONCAT(TX_Usg_ProgramValue,'-',1) AS MaxSeq FROM t_gn_frm_usage a
						INNER JOIN
							(SELECT TX_Usg_Custno,
		if(TX_Usg_ProgramValue='XD 0,75%',MIN(TX_Usg_TransSeq),0) AS MaxSeq
								FROM t_gn_frm_usage a LEFT JOIN t_gn_customer_master b ON a.TX_Usg_CustId = b.DM_Id
		WHERE b.DM_UpdatedTs >= '$StartDate' AND b.DM_UpdatedTs <= '$EndDate' GROUP BY TX_Usg_Custno) Seq
									on a.TX_Usg_Custno = Seq.TX_Usg_Custno
						AND a.TX_Usg_TransSeq = Seq.MaxSeq
						LEFT JOIN t_gn_customer_master b ON a.TX_Usg_CustId = b.DM_Id
						INNER JOIN t_gn_assignment f on b.DM_Id = f.AssignCustId
						INNER JOIN t_lk_program_detail g on a.TX_Usg_ProgramData=g.PRD_Data_Id
						LEFT JOIN tms_agent h on b.DM_QualityUserId = h.UserId
						WHERE 1=1
						and b.DM_QualityReasonId = 44
						AND g.PRD_Data_Value != 'SS 1%' 
						AND g.PRD_Data_Value != 'SS 1.25%'
						and b.DM_QualityUpdateTs >= '$StartDate' AND b.DM_QualityUpdateTs <= '$EndDate'";
					if($Supervisor){
						$query_usg3 .=" And f.AssignSpv in ($Supervisor) ";
					}
					if($Tmr){
						$query_usg3 .=" And f.AssignSelerId IN ($Tmr) ";
					}
					
					$query_usg = $query_usg1.' UNION '.$query_usg2. ' UNION '.$query_usg3. ' ) AS NewTable group by NewTable.TX_Usg_Id' ;
					// var_dump($query_usg);
					// die;
			} 
			elseif ($Transaksi ==5) {
				$query_usg     = "SELECT a.*, b.DM_Recsource , g.PRD_Data_Value , b.DM_spvid, 
						b.DM_QualityUserId, h.code_user, b.DM_MobilePhoneNum FROM t_gn_frm_usage a
						LEFT JOIN (SELECT TX_Usg_Custno, if(count(TX_Usg_TransSeq) = 1, TX_Usg_TransSeq, min(TX_Usg_TransSeq)) as MaxSeq
						FROM t_gn_frm_usage GROUP BY TX_Usg_FixID) Seq on a.TX_Usg_Custno = Seq.TX_Usg_Custno
						AND a.TX_Usg_TransSeq = Seq.MaxSeq
						LEFT JOIN t_gn_customer_master b ON a.TX_Usg_CustId = b.DM_Id
						INNER JOIN t_gn_assignment f on b.DM_Id = f.AssignCustId
						INNER JOIN t_lk_program_detail g on a.TX_Usg_ProgramData=g.PRD_Data_Id
						LEFT JOIN tms_agent h on b.DM_QualityUserId = h.UserId
						WHERE 1=1
						and b.DM_QualityReasonId = 44
						AND g.PRD_Data_Value IN ('SS 1%','SS 1.25%')
						and b.DM_QualityUpdateTs >= '$StartDate' AND b.DM_QualityUpdateTs <= '$EndDate'";
					if($Supervisor){
						$query_usg .=" And f.AssignSpv in ($Supervisor) ";
					}
					if($Tmr){
						$query_usg .=" And f.AssignSelerId IN ($Tmr) ";
					}
					$query_usg .="GROUP BY TX_Usg_Id";
			//  var_dump($query_usg);
			//  die;
			}
			
			else {
				$query_usg     = "SELECT a.*, b.DM_Recsource , g.PRD_Data_Value , b.DM_spvid, 
						b.DM_QualityUserId, h.code_user, b.DM_MobilePhoneNum FROM t_gn_frm_usage a
						LEFT JOIN t_gn_customer_master b ON a.TX_Usg_CustId = b.DM_Id
						INNER JOIN t_gn_assignment f on b.DM_Id = f.AssignCustId
						INNER JOIN t_lk_program_detail g on a.TX_Usg_ProgramData=g.PRD_Data_Id
						LEFT JOIN tms_agent h on b.DM_QualityUserId = h.UserId
						WHERE 1=1
						and b.DM_QualityReasonId = 44
						and b.DM_QualityUpdateTs >= '$StartDate' AND b.DM_QualityUpdateTs <= '$EndDate'";
					if($Supervisor){
						$query_usg .=" And f.AssignSpv in ($Supervisor) ";
					}
					if($Tmr){
						$query_usg .=" And f.AssignSelerId IN ($Tmr) ";
					}
					
			}
			if($Transaksi!=4){
				$query_usg .=" ORDER BY a.TX_Usg_Id";
			}
			
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
	public function _get_data_balcon(){
        $data_usage = false;
		$this->data_usage = $data_usage;
		$param_request = _get_all_request();
		$out = new EUI_Object($param_request);
		$this->data_addon_ntb = array();

		// and we get here
		$CampaignId   = $out->get_value("campaign_id");
		$StartDate    = $out->get_value("start_date");
		$EndDate      = $out->get_value("end_date");
		$Supervisor	  = $out->get_value("supervisor_id");
		$Transaksi	  = $out->get_value("transaksi");
		$Tmr		  = $out->get_value("TmrId");

		// filter all request if not empty get
		if ( !empty($CampaignId) AND !empty($StartDate) AND !empty($EndDate) ) {
			$StartDate = _getDateEnglish($StartDate) . " 00:00:00";
			$EndDate   = _getDateEnglish($EndDate) . " 23:59:58";
			$query_usg     = "SELECT a.*, b.DM_Recsource , g.PRD_Data_Value , b.DM_spvid, 
						b.DM_QualityUserId, h.code_user, b.DM_MobilePhoneNum, b.DM_CampaignId,
						CAST(a.TX_Usg_AvailableXD AS SIGNED) AS TxAvailableXD,
						CAST(a.TX_Usg_AvailableSS AS SIGNED) AS TxAvailableSS
						FROM t_gn_frm_balcon a
						INNER JOIN (SELECT TX_Usg_Custno, if(count(TX_Usg_TransSeq) = 1, TX_Usg_TransSeq, min(TX_Usg_TransSeq)) as MaxSeq
						FROM t_gn_frm_balcon GROUP BY TX_Usg_FixID) Seq on a.TX_Usg_Custno = Seq.TX_Usg_Custno
						AND a.TX_Usg_TransSeq = Seq.MaxSeq
						LEFT JOIN t_gn_customer_master b ON a.TX_Usg_CustId = b.DM_Id
						INNER JOIN t_gn_assignment f on b.DM_Id = f.AssignCustId
						LEFT JOIN t_lk_program_detail g on a.TX_Usg_ProgramData=g.PRD_Data_Id
						LEFT JOIN tms_agent h on b.DM_QualityUserId = h.UserId
						WHERE 1=1
						and b.DM_QualityReasonId = 44
						and a.TX_Usg_CreatedTs >= '$StartDate' AND a.TX_Usg_CreatedTs <= '$EndDate'
						and b.DM_CampaignId=$CampaignId ";
					if($Supervisor){
						$query_usg .=" And f.AssignSpv in ($Supervisor) ";
					}
					if($Tmr){
						$query_usg .=" And f.AssignSelerId IN ($Tmr) ";
					}
					$query_usg .=" ORDER BY a.TX_Usg_Id";
						// die;
			$get_data_usage  = $this->db->query( $query_usg );
			// var_dump($this->db->last_query());
			// die;
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

	
    public function _get_data_tapenas(){
        $data_tapenas = false;
		$this->data_tapenas = $data_tapenas;
		$param_request = _get_all_request();
		$out = new EUI_Object($param_request);
		//$this->data_addon_ntb = array();

		// and we get here
		$CampaignId   = $out->get_value("campaign_id");
		$StartDate    = $out->get_value("start_date");
		$EndDate      = $out->get_value("end_date");
		$Supervisor	  = $out->get_value("supervisor_id");
		//$Transaksi	  = $out->get_value("transaksi");
		$Tmr		  = $out->get_value("TmrId");

		// filter all request if not empty get
		if ( !empty($CampaignId) AND !empty($StartDate) AND !empty($EndDate) ) {
			$StartDate = _getDateEnglish($StartDate) . " 00:00:00";
			$EndDate   = _getDateEnglish($EndDate) . " 23:59:58";
			$query_tape     = "SELECT b.DM_FirstName, c.TapenasNoRekening, c.TapenasKodeWilayah, a.TR_SetoranSebelum, 
							   a.TR_SetoranTambahan, a.TR_SetoranTotal, a.TR_TenorSebelum, a.TR_TenorTambahan, 
							   a.TR_TenorTotal, d.id Agent_Code, e.id Spv_Code, f.id Qc_Code
							   FROM t_gn_frm_tapenas a 
							   JOIN t_gn_customer_master b ON a.TR_CustNo = b.DM_Id
							   JOIN t_gn_customer_tapenas c ON c.TapenasId = a.TR_CustNo
							   LEFT JOIN tms_agent d ON a.TR_AgentID = d.UserId
							   LEFT JOIN tms_agent e ON d.spv_id = e.UserId
							   LEFT JOIN tms_agent f ON a.TR_QCID = f.UserId
							   WHERE
							   a.TR_CreateDate >= '$StartDate' AND a.TR_CreateDate <= '$EndDate'";
								if($Supervisor){
									$query_tape .=" And a.TR_SpvID in ($Supervisor) ";
								}
								if($Tmr){
									$query_tape .="And a.TR_AgentID IN ($Tmr) ";
								}
								$query_tape .="ORDER BY a.TR_Tapenas_Id";
			//echo "<pre>$query_tape</pre>";
			$get_data_tapenas  = $this->db->query( $query_tape );
			if ( $get_data_tapenas->num_rows() > 0 ) {
				$data_tapenas = $get_data_tapenas;
				$this->data_tapenas = $data_tapenas;
				//print_r($data_tapenas);

//				foreach ( $this->data_ntb->result() as $usg ) {
//					$data_addon_arr = array();
//					$data_addon_arr["CustomerNumber"] = $usg->TR_CustomerNumber;
//					$data_addon_arr["Addon_Id"] = $usg->TR_ADDONID;
//					$this->data_addon_ntb[] = $data_addon_arr;
//				}


			}
		}

		return $data_tapenas;
    }
	// END STATEMENT FOR NTB
	// ==============================================
	

	// ==============================================
	// START STATEMENT FOR XSELL
	

	













}


?>
<?php
/*
 * Sales Report 
 * Source From 
 */
 
class RptPerformanceTsr extends EUI_Controller {

	public $data_ntb;
	
	var $product = array();
	var $report_group = array(); 
 
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
		$this->folder = "rpt_performance_tsr/";
	 	$this->folderCampaign = "rpt_performance_tsr/rpt_per_campaign/";

	}

	
	/**
	 * [index description]
	 * @return [type] [description]
	 */
	public function index() {
		
		if( _get_is_login() == FALSE ) { return FALSE; }
		$out =& get_class_instance('M_RptPerformanceTsr');
		$out_data = array(
							"Campaign" => array(),
							"Supervisor" => $this -> M_RptPerformanceTsr ->supervisor(),
							"Transaksi" => $this -> M_RptPerformanceTsr ->transaksi()
						);
		$this->load->view("rpt_performance_tsr/report_sales_nav" , $out_data);
	}

	/**
	 * [ShowReport description]
	 */
	public function ShowReport () {
		$this->product = array(
	 		NTB => "ntb" , 
	 		XSELL => "xsell" , 
	 		ADD => "add" , 
	 		USAGE => "usage",
			ALL => "all"
	 	);

	 	$report_group = array(
	 		1 => "Summary",
	 		2 => "Details"
	 	);
		
		$get_all_out = _get_all_request();
		$gao = new EUI_Object($get_all_out);
		$campaignId = $gao->get_value("campaign_id");
		$mode_report = strtolower($gao->get_value("mode"));
		$productid = $gao->get_value("product_id");
		$group = $gao->get_value("report_group");
		// echo $this->folderCampaign . $mode_report . "/rpt_".$this->product[$productid]."_html";
		if ( $gao->get_value("mode") == "HTML" ) {
			if($group == 2) {
				$this->load->view( $this->folderCampaign . $mode_report . "/rpt_style" );
				switch ( $productid ) {
					// ntb report
					case NTB : 
						$this->load->view( $this->folderCampaign . $mode_report . "/rpt_".$this->product[$productid]."_html" , 
							array(
									// "param" => $gao , 
									// "data_ntb" => $this->_get_data_ntb() ,
									// "data_ntb_dualcard" => $this->_get_data_dualcard_ntb() , 
									// "data_addon_ntb" => $this->_get_data_addon_ntb()
									
									"param" => $gao , 
									"data_ntb" => $this->_get_data_ntb() ,
									"data_clos" => $this->M_RptPerformanceTsr->getDataClos() ,
									"data_sess" => $this->M_RptPerformanceTsr->getDataSess() ,
									"addonke1" => $this->M_RptPerformanceTsr->getData_clossing_ntb_addon(1) ,
									"addonke2" => $this->M_RptPerformanceTsr->getData_clossing_ntb_addon(2) ,
									// "data_ntb_dualcard" => $this->_get_data_dualcard_ntb() ,
									"duals" => $this->M_RptPerformanceTsr->getDataClosDual()
									// "data_addon_ntb" => $this->_get_data_addon_ntb()
						)); break;

					case XSELL : 
						$this->load->view( $this->folderCampaign . $mode_report . "/rpt_".$this->product[$productid]."_html" , array(
									// "param" => $gao , 
									// "data_ntb" => $this->_get_data_ntb()
									// "data_addon_xsell" => $this->_get_data_xsell("addon")
									
									"param" => $gao , 
									"data_ntb" => $this->_get_data_ntb() ,
									"data_clos" => $this->M_RptPerformanceTsr->getDataClos() ,
									"data_sess" => $this->M_RptPerformanceTsr->getDataSess() ,
									"data_ntb_dualcard" => $this->_get_data_dualcard_ntb() , 
									"data_addon_ntb" => $this->_get_data_addon_ntb()
						)); 
						break;

					case ADD : 
						$this->load->view( $this->folderCampaign . $mode_report . "/rpt_".$this->product[$productid]."_html" , array(
									// "param" => $gao , 
									// "data_ntb" => $this->_get_data_ntb()
									
									"param" => $gao , 
									"data_ntb" => $this->_get_data_ntb() ,
									"data_clos" => $this->M_RptPerformanceTsr->getDataClos() ,
									"data_sess" => $this->M_RptPerformanceTsr->getDataSess() ,
									"data_ntb_dualcard" => $this->_get_data_dualcard_ntb() , 
									"data_addon_ntb" => $this->_get_data_addon_ntb()
						)); break;

	                case USAGE : 
						$this->load->view( $this->folderCampaign . $mode_report . "/rpt_".$this->product[$productid]."_html" , array(
									// "param" => $gao,
									// "data_usage" => $this->_get_data_ntb()
									
									"param" => $gao , 
									"data_ntb" => $this->_get_data_ntb() ,
									"data_clos" => $this->M_RptPerformanceTsr->getDataClos() ,
									"data_sess" => $this->M_RptPerformanceTsr->getDataSess() ,
									"data_ntb_dualcard" => $this->_get_data_dualcard_ntb() , 
									"data_addon_ntb" => $this->_get_data_addon_ntb()
						));
	                    break;
					
					default : 
						$productid = "ALL";
						$this->load->view( $this->folderCampaign . $mode_report . "/rpt_".$this->product[$productid]."_html" , 
							array(
									"param" => $gao , 
									"data_ntb" => $this->_get_data_ntb() ,
									"data_clos" => $this->M_RptPerformanceTsr->getDataClos() ,
									"data_sess" => $this->M_RptPerformanceTsr->getDataSess() ,
									"data_ntb_dualcard" => $this->_get_data_dualcard_ntb() , 
									"data_addon_ntb" => $this->_get_data_addon_ntb()
						)); break;
				}
			}
			else{
				$this->load->view( $this->folderCampaign . $mode_report . "/rpt_style" );
				switch ( $productid ) {
					// ntb report
					case NTB : 
						$this->load->view( $this->folderCampaign . $mode_report . "/rpt_".$this->product[$productid]."_html_smry" , 
							array(
									// "param" => $gao , 
									// "data_ntb" => $this->_get_data_ntb() ,
									// "data_ntb_dualcard" => $this->_get_data_dualcard_ntb() , 
									// "data_addon_ntb" => $this->_get_data_addon_ntb()
									
									"param" => $gao , 
									"data_ntb" => $this->_get_data_ntb_smry() ,
									"data_clos" => $this->M_RptPerformanceTsr->getDataClos() ,
									"addonke1" => $this->M_RptPerformanceTsr->getData_clossing_ntb_addon(1) ,
									"addonke2" => $this->M_RptPerformanceTsr->getData_clossing_ntb_addon(2) ,
									"data_sess" => $this->M_RptPerformanceTsr->getDataSess() ,
									"duals" => $this->M_RptPerformanceTsr->getDataClosDual()
									// "data_ntb_dualcard" => $this->_get_data_dualcard_ntb() , 
									// "data_addon_ntb" => $this->_get_data_addon_ntb()
						)); break;

					case XSELL : 
						$this->load->view( $this->folderCampaign . $mode_report . "/rpt_".$this->product[$productid]."_html_smry" , array(
									// "param" => $gao , 
									// "data_ntb" => $this->_get_data_ntb()
									// "data_addon_xsell" => $this->_get_data_xsell("addon")
									
									"param" => $gao , 
									"data_ntb" => $this->_get_data_ntb_smry() ,
									"data_clos" => $this->M_RptPerformanceTsr->getDataClos() ,
									"data_sess" => $this->M_RptPerformanceTsr->getDataSess() ,
									"data_ntb_dualcard" => $this->_get_data_dualcard_ntb() , 
									"data_addon_ntb" => $this->_get_data_addon_ntb()
						)); 
						break;

					case ADD : 
						$this->load->view( $this->folderCampaign . $mode_report . "/rpt_".$this->product[$productid]."_html_smry" , array(
									// "param" => $gao , 
									// "data_ntb" => $this->_get_data_ntb()
									
									"param" => $gao , 
									"data_ntb" => $this->_get_data_ntb_smry() ,
									"data_clos" => $this->M_RptPerformanceTsr->getDataClos() ,
									"data_sess" => $this->M_RptPerformanceTsr->getDataSess() ,
									"data_ntb_dualcard" => $this->_get_data_dualcard_ntb() , 
									"data_addon_ntb" => $this->_get_data_addon_ntb()
						)); break;

	                case USAGE : 
						$this->load->view( $this->folderCampaign . $mode_report . "/rpt_".$this->product[$productid]."_html_smry" , array(
									// "param" => $gao,
									// "data_usage" => $this->_get_data_ntb()
									
									"param" => $gao , 
									"data_ntb" => $this->_get_data_ntb_smry() ,
									"data_clos" => $this->M_RptPerformanceTsr->getDataClos() ,
									"data_sess" => $this->M_RptPerformanceTsr->getDataSess() ,
									"data_ntb_dualcard" => $this->_get_data_dualcard_ntb() , 
									"data_addon_ntb" => $this->_get_data_addon_ntb()
						));
	                    break;
					
					default : 
						$productid = "ALL";
						$this->load->view( $this->folderCampaign . $mode_report . "/rpt_".$this->product[$productid]."_html_smry" , 
							array(
									"param" => $gao , 
									"data_ntb" => $this->_get_data_ntb_smry() ,
									"data_clos" => $this->M_RptPerformanceTsr->getDataClos() ,
									"data_sess" => $this->M_RptPerformanceTsr->getDataSess() ,
									"data_ntb_dualcard" => $this->_get_data_dualcard_ntb() , 
									"data_addon_ntb" => $this->_get_data_addon_ntb()
						)); break;
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
	public function ShowText() {
		
		// definisi product report 
		$this->product = array( NTB 	=> "ntb" ,  	
								XSELL 	=> "xsell" , 
								ADD 	=> "add" , 		
								USAGE 	=> "usage",
								ALL => "all" );
		
		// ambil semua parameter yg di kirim 
		// oleh browser 
		
		$URI =& UR();
		
		// all setup 
		$campaignId = $URI->field("campaign_id");
		$productid  = $URI->field("product_id");
		$mode_report = $URI->field("mode", "strtolower");
		
		// switch kondision process 
		$result_array  = array();
		switch( $productid ){
			// untuk sementara data yang di export ke txt hanya 
			// data usage saja .
			case USAGE : 
				$result_array = array(
					"param" => $URI,
					"title" => sprintf("Tabulasi_%s_%s",$this->product[$productid], date("ddmmyy") ),
					"data"  => $this->_get_data_usage() 
				);
			break;
			
			default:
				exit(0);
			break;
		}
		
		// masukan kedalam vie untuk di process 
		$this->foldername = sprintf("rpt_%s_text.php", $this->product[$productid]);
		$this->folderpath = sprintf("%s%s/%s", $this->folderCampaign, $mode_report, $this->foldername);
		
		// masukan data propcess nya go way !...
		$this->load->view( $this->folderpath, $result_array );
	}

	/**
	 * [ShowReport description]
	 */
	public function ShowExcel () {
		
		$this->product = array(
	 		NTB => "ntb" , 
	 		XSELL => "xsell" , 
	 		ADD => "add" , 
	 		USAGE => "usage",
			ALL => "all"
	 	);
		
		
		
		$get_all_out = _get_all_request();
		$gao = new EUI_Object($get_all_out);
		$campaignId = $gao->get_value("campaign_id");
		$productid = $gao->get_value("product_id");
		$group = $gao->get_value("report_group");
		$mode_report = strtolower($gao->get_value("mode"));

		// $xcelFname = "report";
		// switch ( $campaignId ) {
			// case 29 : $xcelFname = 
		// 
		// exit;
		
		
		if ( $gao->get_value("mode") == "EXCEL" ) {
			if($group == 2) {
				switch ( $productid ) {
					case NTB : // 29 
						$xcelFname = "ReportProductivity_".$this->product[$productid]."_".date("ddmmyy");
						$dao = array(
									// "param" => $gao , 
									// "data_ntb" => $this->_get_data_ntb() , 
									// "data_ntb_dualcard" => $this->_get_data_dualcard_ntb() , 
									// "data_addon_ntb" => $this->_get_data_addon_ntb()
									
									"param" => $gao , 
									"data_ntb" => $this->_get_data_ntb() ,
									"data_clos" => $this->M_RptPerformanceTsr->getDataClos() ,
									"data_sess" => $this->M_RptPerformanceTsr->getDataSess() ,
									"data_ntb_dualcard" => $this->_get_data_dualcard_ntb() , 
									"data_addon_ntb" => $this->_get_data_addon_ntb()
						);
					break;
					
					case XSELL : 
						$xcelFname = "ReportProductivity_".$this->product[$productid]."_".date("ddmmyy");
						$dao = array(
									// "param" => $gao , 
									// "data_ntb" => $this->_get_data_ntb() , 
									// "data_ntb_dualcard" => $this->_get_data_dualcard_ntb() , 
									// "data_addon_ntb" => $this->_get_data_addon_ntb()
									
									"param" => $gao , 
									"data_ntb" => $this->_get_data_ntb() ,
									"data_clos" => $this->M_RptPerformanceTsr->getDataClos() ,
									"data_sess" => $this->M_RptPerformanceTsr->getDataSess() ,
									"data_ntb_dualcard" => $this->_get_data_dualcard_ntb() , 
									"data_addon_ntb" => $this->_get_data_addon_ntb()
						);
					break;
					
					case ADD :
						$xcelFname = "ReportProductivity_".$this->product[$productid]."_".date("ddmmyy");
						$dao = array(
									// "param" => $gao , 
									// "data_ntb" => $this->_row_addon()
									// "data_ntb_dualcard" => $this->_get_data_dualcard_ntb() , 
									// "data_addon_ntb" => $this->_get_data_addon_ntb()
									
									"param" => $gao , 
									"data_ntb" => $this->_get_data_ntb() ,
									"data_clos" => $this->M_RptPerformanceTsr->getDataClos() ,
									"data_sess" => $this->M_RptPerformanceTsr->getDataSess() ,
									"data_ntb_dualcard" => $this->_get_data_dualcard_ntb() , 
									"data_addon_ntb" => $this->_get_data_addon_ntb()
						);
					break;
					
					case USAGE :
						$xcelFname = "ReportProductivity_".$this->product[$productid]."_".date("ddmmyy");
						$dao = array(
									// "param" => $gao , 
									// "data_ntb" => $this->_get_data_ntb()
									// "data_ntb_dualcard" => $this->_get_data_dualcard_ntb() , 
									// "data_addon_ntb" => $this->_get_data_addon_ntb()
									
									"param" => $gao , 
									"data_ntb" => $this->_get_data_ntb() ,
									"data_clos" => $this->M_RptPerformanceTsr->getDataClos() ,
									"data_sess" => $this->M_RptPerformanceTsr->getDataSess() ,
									"data_ntb_dualcard" => $this->_get_data_dualcard_ntb() , 
									"data_addon_ntb" => $this->_get_data_addon_ntb()
						);
					break;
					
					default : 
						$productid = "ALL";
						$xcelFname = "ReportProductivity_".$this->product[$productid]."_".date("ddmmyy");
						$dao = array(
									// "param" => $gao , 
									// "data_ntb" => $this->_get_data_ntb()
									// "data_ntb_dualcard" => $this->_get_data_dualcard_ntb() , 
									// "data_addon_ntb" => $this->_get_data_addon_ntb()
									
									"param" => $gao , 
									"data_ntb" => $this->_get_data_ntb() ,
									"data_clos" => $this->M_RptPerformanceTsr->getDataClos() ,
									"data_sess" => $this->M_RptPerformanceTsr->getDataSess() ,
									"data_ntb_dualcard" => $this->_get_data_dualcard_ntb() , 
									"data_addon_ntb" => $this->_get_data_addon_ntb()
	//								"data_ntb_dualcard" => $this->_get_data_dualcard_ntb() , 
	//								"data_addon_ntb" => $this->_get_data_addon_ntb()

										// "data_ntb" => $this->_get_data_ntb_smry() ,
										// "data_clos" => $this->M_RptPerformanceTsr->getDataClos() ,
										// "data_sess" => $this->M_RptPerformanceTsr->getDataSess() ,
										// "data_ntb_dualcard" => $this->_get_data_dualcard_ntb() , 
										// "data_addon_ntb" => $this->_get_data_addon_ntb()
						);
					break;
				}	
			} else {
				// switch mode
				switch ( $productid ) {
					case NTB : // 29 
						$xcelFname = "ReportProductivity_".$this->product[$productid]."_".date("ddmmyy");
						$dao = array(
									// "param" => $gao , 
									// "data_ntb" => $this->_get_data_ntb() , 
									// "data_ntb_dualcard" => $this->_get_data_dualcard_ntb() , 
									// "data_addon_ntb" => $this->_get_data_addon_ntb()
									
									"param" => $gao , 
									"data_ntb" => $this->_get_data_ntb_smry() ,
									"data_clos" => $this->M_RptPerformanceTsr->getDataClos() ,
									"data_sess" => $this->M_RptPerformanceTsr->getDataSess() ,
									"data_ntb_dualcard" => $this->_get_data_dualcard_ntb() , 
									"data_addon_ntb" => $this->_get_data_addon_ntb()
						);
					break;
					
					case XSELL : 
						$xcelFname = "ReportProductivity_".$this->product[$productid]."_".date("ddmmyy");
						$dao = array(
									// "param" => $gao , 
									// "data_ntb" => $this->_get_data_ntb() , 
									// "data_ntb_dualcard" => $this->_get_data_dualcard_ntb() , 
									// "data_addon_ntb" => $this->_get_data_addon_ntb()
									
									"param" => $gao , 
									"data_ntb" => $this->_get_data_ntb_smry() ,
									"data_clos" => $this->M_RptPerformanceTsr->getDataClos() ,
									"data_sess" => $this->M_RptPerformanceTsr->getDataSess() ,
									"data_ntb_dualcard" => $this->_get_data_dualcard_ntb() , 
									"data_addon_ntb" => $this->_get_data_addon_ntb()
						);
					break;
					
					case ADD :
						$xcelFname = "ReportProductivity_".$this->product[$productid]."_".date("ddmmyy");
						$dao = array(
									// "param" => $gao , 
									// "data_ntb" => $this->_row_addon()
									// "data_ntb_dualcard" => $this->_get_data_dualcard_ntb() , 
									// "data_addon_ntb" => $this->_get_data_addon_ntb()
									
									"param" => $gao , 
									"data_ntb" => $this->_get_data_ntb_smry() ,
									"data_clos" => $this->M_RptPerformanceTsr->getDataClos() ,
									"data_sess" => $this->M_RptPerformanceTsr->getDataSess() ,
									"data_ntb_dualcard" => $this->_get_data_dualcard_ntb() , 
									"data_addon_ntb" => $this->_get_data_addon_ntb()
						);
					break;
					
					case USAGE :
						$xcelFname = "ReportProductivity_".$this->product[$productid]."_".date("ddmmyy");
						$dao = array(
									// "param" => $gao , 
									// "data_ntb" => $this->_get_data_ntb()
									// "data_ntb_dualcard" => $this->_get_data_dualcard_ntb() , 
									// "data_addon_ntb" => $this->_get_data_addon_ntb()
									
									"param" => $gao , 
									"data_ntb" => $this->_get_data_ntb_smry() ,
									"data_clos" => $this->M_RptPerformanceTsr->getDataClos() ,
									"data_sess" => $this->M_RptPerformanceTsr->getDataSess() ,
									"data_ntb_dualcard" => $this->_get_data_dualcard_ntb() , 
									"data_addon_ntb" => $this->_get_data_addon_ntb()
						);
					break;
					
					default : 
						$productid = "ALL";
						$xcelFname = "ReportProductivity_".$this->product[$productid]."_".date("ddmmyy");
						$dao = array(
									// "param" => $gao , 
									// "data_ntb" => $this->_get_data_ntb()
									// "data_ntb_dualcard" => $this->_get_data_dualcard_ntb() , 
									// "data_addon_ntb" => $this->_get_data_addon_ntb()
									
									"param" => $gao , 
									"data_ntb" => $this->_get_data_ntb_smry() ,
									"data_clos" => $this->M_RptPerformanceTsr->getDataClos() ,
									"data_sess" => $this->M_RptPerformanceTsr->getDataSess() ,
									"data_ntb_dualcard" => $this->_get_data_dualcard_ntb() , 
									"data_addon_ntb" => $this->_get_data_addon_ntb()
	//								"data_ntb_dualcard" => $this->_get_data_dualcard_ntb() , 
	//								"data_addon_ntb" => $this->_get_data_addon_ntb()

										// "data_ntb" => $this->_get_data_ntb_smry() ,
										// "data_clos" => $this->M_RptPerformanceTsr->getDataClos() ,
										// "data_sess" => $this->M_RptPerformanceTsr->getDataSess() ,
										// "data_ntb_dualcard" => $this->_get_data_dualcard_ntb() , 
										// "data_addon_ntb" => $this->_get_data_addon_ntb()
						);
					break;
				}	
			}
		}
		// ambil data berdasarkan product saja 
		// karna kalau by cmapaign , bisa jadi satu product 
		// banyak campaign @ omens 
		$product = $this->product[$productid];
		if( !$product ){
			exit('no product selected');
		}
		
		header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
		header("Content-Disposition: attachment; filename=$xcelFname.xls");  //File name extension was wrong
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Cache-Control: private",false);
		
		if($group == 1) {
			$this->folderdata = sprintf("rpt_%s_excel_smry", $product);
		} else {
			$this->folderdata = sprintf("rpt_%s_excel", $product);
		}
		
		$this->load->view( $this->folderCampaign . $mode_report . "/". $this->folderdata, $dao);
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
			"SELECT concat(b.DM_FirstName , ' ' , if(b.DM_LastName is not null , b.DM_LastName , '') ) as CustomerNames , a.*,
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
			WHERE a.FRM_Addon_Id in($addon_id) and b.DM_CampaignId;"
		);
		// echo "<pre>$get_addon</pre>";
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
		if (!empty($StartDate) AND !empty($EndDate) ) {
			$StartDate = _getDateEnglish($StartDate) . " 00:00:00";
			$EndDate   = _getDateEnglish($EndDate) . " 23:59:58";
			/**$query_ntb     = "select agent.id Tsr, date(mst.DM_CallDateTs) as STime,
	count(a.id) Attemps,
								count(distinct(a.assign_data)) as Datas,
								sum( unix_timestamp(a.end_time) - unix_timestamp(a.start_time) ) as tot_durr,
count(distinct(if(mst.DM_QualityReasonKode = 'CLOS' and mst.DM_CallDateTs >= '".$StartDate."' and mst.DM_CallDateTs <= '".$EndDate."' ,1,NULL))) as Closedeal,
								count(addon.FRM_Addon_Id) as addondeal
								from cc_call_session a
								left join cc_agent cca ON a.agent_id = cca.id
								left join tms_agent agent ON cca.userid = agent.id
								left join tms_agent agentSpv on agent.spv_id = agentSpv.UserId
								inner join t_gn_customer_master mst ON mst.DM_Id = a.assign_data
								left join t_gn_frm_addon addon on mst.DM_Custno = addon.ADDON_CustNum
								
								where 1=1
								AND mst.DM_CallDateTs >= '".$StartDate."'
								AND mst.DM_CallDateTs <= '".$EndDate."'";**/
			/*if($Supervisor){
					$query_ntb .=" And agentSpv.spv_id in ($Supervisor) ";
				}
				if($Tmr){
					$query_ntb .=" And agent.UserId in ($Tmr) ";
				}
				if($CampaignId){
					$query_ntb .=" And mst.DM_CampaignId in ($CampaignId) ";
				}*/
				
				// $query_ntb .=" group by a.agent_id, STime, a.assign_data having Tsr is not null";
				
	// $query_ntb = "select a.DM_SellerId, a.DM_SellerKode, a.DM_Id as DMID, cca.id as CID, tma.UserId as TMID,
					// count(a.DM_Id) as TotDat, date(a.DM_CallDateTs) as DM_CallDateTs,
					// count(if(a.DM_QualityReasonKode = 'CLOS' and a.DM_CallReasonKode = 'APRV',1,NULL)) as TotalClos,
					// (select count(distinct b.CallHistoryId) from t_gn_callhistory b where b.CustomerId = DMID and b.CreatedById = TMID) as Attempts,
					// (select sum( unix_timestamp(cck.end_time) - unix_timestamp(cck.start_time) ) from cc_call_session cck where cck.assign_data = DMID and cck.agent_id = CID) as CCCALLSESS
					// from t_gn_customer_master a 
					// inner join tms_agent tma ON a.DM_SellerId = tma.UserId
					// inner join cc_agent cca ON tma.id = cca.userid
					// inner join tms_agent tms on tma.spv_id = tms.UserId
					// where 1=1
					// AND a.DM_CallDateTs >= '".$StartDate."'
					// AND a.DM_CallDateTs <= '".$EndDate."'";
	// if($Supervisor){
		// $query_ntb .=" And tms.spv_id in ($Supervisor) ";
	// }
	// if($Tmr){
		// $query_ntb .=" And a.DM_SellerId in ($Tmr) ";
	// }
	// if($CampaignId){
		// $query_ntb .=" And a.DM_CampaignId in ($CampaignId) ";
	// }
	// $query_ntb .=" group by a.DM_Id";
	
	$query_ntb = "select
					a.CreatedById, 
					date(a.CallHistoryCreatedTs) DM_CallDateTs,
					b.id DM_SellerKode, b.full_name,
					count(distinct a.CustomerId) TotDat,
					count(a.CallHistoryId) Attempts,
					his.TotalClos
				from t_gn_callhistory a
					inner join tms_agent b on a.CreatedById = b.UserId
					inner join cc_call_session c on a.CallSessionId = c.session_id
					inner join t_gn_customer_master d on a.CustomerId = d.DM_Id
					left join (select
								ch.CreatedById, date(ch.CallHistoryCreatedTs) Tgl,
								count(ch.CustomerId) TotalClos
							from t_gn_callhistory ch
								inner join tms_agent ag on ch.CreatedById = ag.UserId
							where ch.CallReasonId = 22 and ag.handling_type not in (19,22)
								and ch.CallHistoryCreatedTs between '".$StartDate."' and '".$EndDate."'
							group by Tgl, ch.CreatedById) his on a.CreatedById = his.CreatedById and his.Tgl = DM_CallDateTs
				where 1=1
					and a.CallHistoryCreatedTs between '".$StartDate."' and '".$EndDate."' ";
	if($Supervisor){
		$query_ntb .=" and b.spv_id in ($Supervisor) ";
	}
	if($Tmr){
		$query_ntb .=" and a.CreatedById in ($Tmr) ";
	}
	if($CampaignId){
		$query_ntb .=" and d.DM_CampaignId in ($CampaignId) ";
	}
	$query_ntb .=" group by date(a.CallHistoryCreatedTs), a.CreatedById";
				
			//echo "<pre>$query_ntb</pre>";
			
			$get_data_ntb  = $this->db->query( $query_ntb );
			$data_addon_arr = array();
			if ( $get_data_ntb->num_rows() > 0 ) {
				$data_ntb = $get_data_ntb;
				$this->data_ntb = $data_ntb;

				foreach ( $data_ntb->result_assoc() as $antb ) {
					$data_addon_arr[$antb['DM_SellerKode']][$antb['DM_CallDateTs']]['Datas'] += $antb['TotDat'];
					$data_addon_arr[$antb['DM_SellerKode']][$antb['DM_CallDateTs']]['full_name'] = $antb['full_name'];
					$data_addon_arr[$antb['DM_SellerKode']][$antb['DM_CallDateTs']]['Attemps'] += $antb['Attempts'];
					// $data_addon_arr[$antb['DM_SellerKode']][$antb['DM_CallDateTs']]['Closedeal'] += $antb['TotalClos'];
					// $data_addon_arr[$antb['DM_SellerKode']][$antb['DM_CallDateTs']]['addondeal'] += $antb['addondeal'];
					// $data_addon_arr[$antb['DM_SellerKode']][$antb['DM_CallDateTs']]['tot_durr'] += $antb['CCCALLSESS'];
				}
			}
		}
		
		// $data_addon_arr = new EUI_Object($data_addon_arr);
		return $data_addon_arr;
	}
	
	public function _get_data_ntb_smry () {
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
		if (!empty($StartDate) AND !empty($EndDate) ) {
			$StartDate = _getDateEnglish($StartDate) . " 00:00:00";
			$EndDate   = _getDateEnglish($EndDate) . " 23:59:58";
			/**$query_ntb     = "select agent.id Tsr, date(mst.DM_CallDateTs) as STime,
	count(a.id) Attemps,
								count(distinct(a.assign_data)) as Datas,
								sum( unix_timestamp(a.end_time) - unix_timestamp(a.start_time) ) as tot_durr,
count(distinct(if(mst.DM_QualityReasonKode = 'CLOS' and mst.DM_CallDateTs >= '".$StartDate."' and mst.DM_CallDateTs <= '".$EndDate."' ,1,NULL))) as Closedeal,
								count(addon.FRM_Addon_Id) as addondeal
								from cc_call_session a
								left join cc_agent cca ON a.agent_id = cca.id
								left join tms_agent agent ON cca.userid = agent.id
								left join tms_agent agentSpv on agent.spv_id = agentSpv.UserId
								inner join t_gn_customer_master mst ON mst.DM_Id = a.assign_data
								left join t_gn_frm_addon addon on mst.DM_Custno = addon.ADDON_CustNum
								
								where 1=1
								AND mst.DM_CallDateTs >= '".$StartDate."'
								AND mst.DM_CallDateTs <= '".$EndDate."'";**/
			/*if($Supervisor){
					$query_ntb .=" And agentSpv.spv_id in ($Supervisor) ";
				}
				if($Tmr){
					$query_ntb .=" And agent.UserId in ($Tmr) ";
				}
				if($CampaignId){
					$query_ntb .=" And mst.DM_CampaignId in ($CampaignId) ";
				}*/
				
				// $query_ntb .=" group by a.agent_id, STime, a.assign_data having Tsr is not null";
				
	// $query_ntb = "select a.DM_SellerId, a.DM_SellerKode, a.DM_Id as DMID, cca.id as CID, tma.UserId as TMID,
					// count(a.DM_Id) as TotDat, date(a.DM_CallDateTs) as DM_CallDateTs,
					// count(if(a.DM_QualityReasonKode = 'CLOS' and a.DM_CallReasonKode = 'APRV',1,NULL)) as TotalClos,
					// (select count(distinct b.CallHistoryId) from t_gn_callhistory b where b.CustomerId = DMID and b.CreatedById = TMID) as Attempts,
					// (select sum( unix_timestamp(cck.end_time) - unix_timestamp(cck.start_time) ) from cc_call_session cck where cck.assign_data = DMID and cck.agent_id = CID) as CCCALLSESS
					// from t_gn_customer_master a 
					// inner join tms_agent tma ON a.DM_SellerId = tma.UserId
					// inner join cc_agent cca ON tma.id = cca.userid
					// inner join tms_agent tms on tma.spv_id = tms.UserId
					// where 1=1
					// AND a.DM_CallDateTs >= '".$StartDate."'
					// AND a.DM_CallDateTs <= '".$EndDate."'";
	// if($Supervisor){
		// $query_ntb .=" And tms.spv_id in ($Supervisor) ";
	// }
	// if($Tmr){
		// $query_ntb .=" And a.DM_SellerId in ($Tmr) ";
	// }
	// if($CampaignId){
		// $query_ntb .=" And a.DM_CampaignId in ($CampaignId) ";
	// }
	// $query_ntb .=" group by a.DM_Id";
	
	$query_ntb = "select
					a.CreatedById, 
					date(a.CallHistoryCreatedTs) DM_CallDateTs,
					b.id DM_SellerKode, b.full_name, e.id, e.full_name spv,
					count(distinct a.CustomerId) TotDat,
					count(a.CallHistoryId) Attempts,
					his.TotalClos
				from t_gn_callhistory a
					inner join tms_agent b on a.CreatedById = b.UserId
					inner join cc_call_session c on a.CallSessionId = c.session_id
					inner join t_gn_customer_master d on a.CustomerId = d.DM_Id
					left join (select
								ch.CreatedById, date(ch.CallHistoryCreatedTs) Tgl,
								count(ch.CustomerId) TotalClos
							from t_gn_callhistory ch
								inner join tms_agent ag on ch.CreatedById = ag.UserId
							where ch.CallReasonId = 22 and ag.handling_type not in (19,22)
								and ch.CallHistoryCreatedTs between '".$StartDate."' and '".$EndDate."'
							group by ch.CreatedById) his on a.CreatedById = his.CreatedById and his.Tgl = DM_CallDateTs
					left join tms_agent e on b.spv_id = e.UserId
				where 1=1
					and a.CallHistoryCreatedTs between '".$StartDate."' and '".$EndDate."' ";
	if($Supervisor){
		$query_ntb .=" and b.spv_id in ($Supervisor) ";
	}
	if($Tmr){
		$query_ntb .=" and a.CreatedById in ($Tmr) ";
	}
	if($CampaignId){
		$query_ntb .=" and d.DM_CampaignId in ($CampaignId) ";
	}
	$query_ntb .=" group by a.CreatedById";
				
			// echo "<pre>$query_ntb</pre>";
			
			$get_data_ntb_smry  = $this->db->query( $query_ntb );
			$data_addon_arr = array();
			if ( $get_data_ntb_smry->num_rows() > 0 ) {
				$data_ntb = $get_data_ntb_smry;
				$this->data_ntb = $data_ntb;

				foreach ( $data_ntb->result_assoc() as $antb ) {
					$data_addon_arr[$antb['DM_SellerKode']]['Datas'] += $antb['TotDat'];
					$data_addon_arr[$antb['DM_SellerKode']]['full_name'] = $antb['full_name'];
					$data_addon_arr[$antb['DM_SellerKode']]['id'] = $antb['id'];
					$data_addon_arr[$antb['DM_SellerKode']]['spv'] = $antb['spv'];
					$data_addon_arr[$antb['DM_SellerKode']]['Attemps'] += $antb['Attempts'];
					// $data_addon_arr[$antb['DM_SellerKode']][$antb['DM_CallDateTs']]['Closedeal'] += $antb['TotalClos'];
					// $data_addon_arr[$antb['DM_SellerKode']][$antb['DM_CallDateTs']]['addondeal'] += $antb['addondeal'];
					// $data_addon_arr[$antb['DM_SellerKode']]['tot_durr'] += $antb['CCCALLSESS'];
				}
			}
		}
		
		// $data_addon_arr = new EUI_Object($data_addon_arr);
		return $data_addon_arr;
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
								(select ch.CallHistoryNotes from t_gn_callhistory ch WHERE ch.CustomerId=cs.DM_Id order by ch.CallHistoryId desc limit 1) as NOTE,
								right(up.FTP_UploadFilename,42) as UPLOAD_ID,
								sx.DB_NPWP as NPWP
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
								and xs.TR_Created_Date >= '$StartDate' 
								AND xs.TR_Created_Date <= '$EndDate'";
				if($Supervisor){
					$query_ntb .=" And b.spv_id in ($Supervisor) ";
				}
				if($Tmr){
					$query_ntb .=" And b.UserId = $Tmr ";
				}
				$query_ntb .="order by xs.TR_CustomerNumber";
			// echo "<pre>$query_ntb</pre>";
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
								 j.RelationshipTypeDesc, d.CONTACT_Nama_Ibu_Kandung
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
				WHERE a.TR_Created_Date >= '$StartDate' AND a.TR_Created_Date <= '$EndDate' AND e.DM_QualityReasonId=44 ";
				if($Supervisor){
					$query_ntb .=" And b.spv_id in ($Supervisor) ";
				}
				if($Tmr){
					$query_ntb .=" And b.UserId = $Tmr ";
				}
				$query_ntb .="ORDER BY a.TR_CustomerNumber";
			// echo "<pre>$query_ntb</pre>";
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
		$Supervisor	  = $out->get_value("supervisor_id");
		$Transaksi	  = $out->get_value("transaksi");

		// filter all request if not empty get
		if ( !empty($CampaignId) AND !empty($StartDate) AND !empty($EndDate) ) {
			$StartDate = _getDateEnglish($StartDate) . " 00:00:00";
			$EndDate   = _getDateEnglish($EndDate) . " 23:59:58";
			$query_usg     = " SELECT a.*, b.DM_Recsource, g.PRD_Data_Value 
					FROM t_gn_frm_usage a
					LEFT JOIN t_gn_customer_master b ON a.TX_Usg_CustId = b.DM_Id
					INNER JOIN t_gn_assignment f on b.DM_Id = f.AssignCustId
					INNER JOIN t_lk_program_detail g on a.TX_Usg_ProgramData=g.PRD_Data_Id
					WHERE a.TX_Usg_CreatedTs >= '$StartDate' AND a.TX_Usg_CreatedTs <= '$EndDate'";
					if($Supervisor){
						$query_usg .=" And f.AssignSpv in ($Supervisor) ";
					}
					if($Transaksi){
						$query_usg .=" And a.TX_Usg_TransSeq = $Transaksi ";
					}
					$query_usg .="ORDER BY a.TX_Usg_Id";
			 //echo "<pre>$query_usg</pre>";
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
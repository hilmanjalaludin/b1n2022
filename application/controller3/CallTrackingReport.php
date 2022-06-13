<?php
/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
 
class CallTrackingReport extends EUI_Controller 
{

	/*
	 * [Recovery data failed upload HSBC TAMAN SARI]
	 * @param  [type] $CustomerId [description]
	 * @return [type]             [description]
	 */	
	 
	 var $FilterGroupBy = null;
	 var $Mode = null;
	 var $R_Model = null;

	/*
	 * [Recovery data failed upload HSBC TAMAN SARI]
	 * @param  [type] $CustomerId [description]
	 * @return [type]             [description]
	 */	
	 public function __construct()
	{
	 parent::__construct();
	 $this->load->model(array(base_class_model($this)));
	 $this->load->helper(array('EUI_Object'));
	 
	}
	/*
	 * [Recovery data failed upload HSBC TAMAN SARI]
	 * @param  [type] $CustomerId [description]
	 * @return [type]             [description]
	 */	
	 public function index()
	{
  		if( _get_is_login() == FALSE ) { 
			exit('login reuired');  
  		}
  
	 	// then will call this method of report  
	 	// call all process on here .

  		$this->Report =& Singgleton('M_CallTrackingReport');
  
		//$rt = $this->Report->_select_report_button();
		//debug($rt);
 
  		$this->load->view("rpt_call_tracking/report_call_track_nav", array (
			'report_type' 		=> $this->Report->_select_report_type(),
			'report_type_new' 	=> $this->Report->_select_report_type_new(),
			'report_campaign' 	=> $this->Report->_select_report_campaign(),
			'report_product' 	=> $this->Report->_select_report_product(),
			'report_recsource'	=> $this->Report->_select_report_recsource(),
			'report_manager' 	=> $this->Report->_select_report_manager(),
			'report_atm' 		=> $this->Report->_select_report_atm(),
			'report_spv' 		=> $this->Report->_select_report_spv(),
			'report_agent' 		=> $this->Report->_select_report_tmr(),
			'report_mode' 		=> $this->Report->_select_report_mode(),
			'report_user'		=> $this->Report->_select_attr_user(),
			'report_button'		=> $this->Report->_select_report_button()
		 ));
	}

	public function FilterCampaignStatus()
	{
		$data = array();
		$obClass = & get_class_instance('M_CallTrackingReport');
		if(in_array('2', _get_array_post('CampaignStatus'))) {
			$data = $obClass->_select_report_campaign();
		} else {
			$data = $obClass->_select_report_campaign2( _get_array_post('CampaignStatus'));	
		}
		echo form()->chooseall('CampaignIdNew','select tolong',  $data, null, array("change" => "ShowFilterProduct(this);"));
	}
	
	/*
	 * [Recovery data failed upload HSBC TAMAN SARI]
	 * @param  [type] $CustomerId [description]
	 * @return [type]             [description]
	 */	
	public function GroupFilterBy() 
	{
		

	} 

	/*
	 * [Recovery data failed upload HSBC TAMAN SARI]
	 * @param  [type] $CustomerId [description]
	 * @return [type]             [description]
	 */	
	public function showCampaign()
	{
		$this->dataOBJ = Singgleton($this);
		return $this->dataOBJ->_getCampaignReady();
	}

	/*
	 * [Recovery data failed upload HSBC TAMAN SARI]
	 * @param  [type] $CustomerId [description]
	 * @return [type]             [description]
	 */	
  	public function ShowDataCampaignId() 
	{


	}

	/*
	 * [Recovery data failed upload HSBC TAMAN SARI]
	 * @param  [type] $CustomerId [description]
	 * @return [type]             [description]
	 */	
	public function ShowByAtm()
	{
		
	}

	/*
	 * [Recovery data failed upload HSBC TAMAN SARI]
	 * @param  [type] $CustomerId [description]
	 * @return [type]             [description]
	 */	
 	function EventLogerReport( $dataURI, $type='html' )
	{
	
		$report_data_type = $this->URI->segment(3);
		$report_start_date = $dataURI->field('start_date');
		$report_end_date = $dataURI->field('end_date');
		$report_sec_interval = $dataURI->field('interval');
		$report_sum_type = $dataURI->field('report_type');
	
		$arr_notes = sprintf("{ report_document:%s,report_mode:%s, report_interval:{ start_date:%s, end_date:%s }, report_type: %s }",
							$report_data_type,
							$report_sec_interval,
							$report_start_date,
							$report_end_date,
							$report_sum_type );
		EventLoger('RPT', array($arr_notes));
	}

	/*
	 * [Recovery data failed upload HSBC TAMAN SARI]
	 * @param  [type] $CustomerId [description]
	 * @return [type]             [description]
	 */	
 	public function ShowExcel()
	{
	
		//self::EventLogerReport( _find_all_object_request());
		$report_type = _get_post('report_type');
		if( $report_type == 'filter_campaign_group_agent' ){
			Excel()->HTML_Excel(get_class($this).''.time());
			$this->load->view("mod_view_tracking/html/view_campaign_group_agent");
		}
		
		if( $report_type == 'filter_campaign_group_spv' ){
			Excel()->HTML_Excel(get_class($this).''.time());
			$this->load->view("mod_view_tracking/html/filter_campaign_group_spv");
		}
		
		if( $report_type == 'filter_campaign_group_atm' ){
			Excel()->HTML_Excel(get_class($this).''.time());
			$this->load->view("mod_view_tracking/html/view_campaign_group_atm");
		}
		
		if( $report_type == 'filter_campaign_group_mgr' ){
			Excel()->HTML_Excel(get_class($this).''.time());
			$this->load->view("mod_view_tracking/html/view_campaign_group_mgr");
		}
		if( $report_type == 'filter_campaign_group_date' ){
			Excel()->HTML_Excel(get_class($this).''.time());
			$this->load->view("mod_view_tracking/html/view_campaign_group_date");
		}
		
		if( $report_type == 'user-report-track-absen' ){
			Excel()->HTML_Excel('Summary_Agent_Absensi_'.time());
			$this->load->view("mod_view_tracking/html/view_user_report_agent_absen");
		}
		
		
		if( $report_type == 'user-report-track-agenttime' ){
			Excel()->HTML_Excel('Summary_Time_Agent_'.time());
			$this->load->view("mod_view_tracking/html/view_user_report_agent_time");
		}
	 }
	 public function ShowExcel2()
	{
	
		//self::EventLogerReport( _find_all_object_request());
		$report_type = _get_post('report_type');
		if( $report_type == 'filter_campaign_group_agent' ){
			Excel()->HTML_Excel(get_class($this).''.time());
			$this->load->view("mod_view_tracking/html/view_campaign_group_agent");
		}
		
		if( $report_type == 'filter_campaign_group_spv' ){
			Excel()->HTML_Excel(get_class($this).''.time());
			$this->load->view("mod_view_tracking/html/filter_campaign_group_spv");
		}
		
		if( $report_type == 'filter_campaign_group_atm' ){
			Excel()->HTML_Excel(get_class($this).''.time());
			$this->load->view("mod_view_tracking/html/view_campaign_group_atm");
		}
		
		if( $report_type == 'filter_campaign_group_mgr' ){
			Excel()->HTML_Excel(get_class($this).''.time());
			$this->load->view("mod_view_tracking/html/view_campaign_group_mgr");
		}
		if( $report_type == 'filter_campaign_group_date' ){
			Excel()->HTML_Excel(get_class($this).''.time());
			$this->load->view("mod_view_tracking/html/view_campaign_group_date");
		}
		
		if( $report_type == 'user-report-track-absen' ){
			Excel()->HTML_Excel('Summary_Agent_Absensi_'.time());
			$this->load->view("mod_view_tracking/html/view_user_report_agent_absen");
		}
		
		
		if( $report_type == 'user-report-track-agenttime' ){
			Excel()->HTML_Excel('Summary_Time_Agent_'.time());
			$this->load->view("mod_view_tracking/html/view_user_report_agent_time");
		}
 	}
 
 
	 /*
	 * [Recovery data failed upload HSBC TAMAN SARI]
	 * @param  [type] $CustomerId [description]
	 * @return [type]             [description]
	 */	
 	function showHTML()  
	{
		// tankap parameter yang di kirim .
	    $this->dataURI = UR();
	  
	    
		// catat setiap user yang meanrik Report 
		// untuk bukti ketiak ada user menarik report pada 
		// jam2 krusial.
		
		// process akan langsung dilakukan di view untuk optimasi 
		// performance report , tanpa lewat 
		// model terlebih dahulu.
		
		
		switch( $this->dataURI->field('report_type','trim')){

			/* filter_campaign_group_date */
			case 'filter_campaign_group_date':
				$this->load->view("mod_view_tracking/html/view_campaign_group_date");
			break;
		
		
			/* filter_campaign_group_date */
			case 'filter_campaign_group_date':
				$this->load->view("mod_view_tracking/html/view_campaign_group_date");
			break;
		
		
			/* filter_upload_filename */
			case 'filter_upload_filename' :
				$this->load->view("mod_view_tracking/html/view_upload_filename");
			break;
		
			/* filter_campaign_group_spv */
			case 'filter_campaign_group_spv' :
				$this->load->view("mod_view_tracking/html/view_campaign_group_spv");
			break;
		
			/* filter_campaign_group_spv */
			case 'filter_campaign_group_agent' :
				$this->load->view("mod_view_tracking/html/view_campaign_group_agent");
			break;
		
			/* filter_campaign_group_atm */
			case 'filter_campaign_group_atm' : 
				$this->load->view("mod_view_tracking/html/view_campaign_group_atm");
			break;	
		
			/* filter_campaign_group_mgr */
			case 'filter_campaign_group_mgr': 
				$this->load->view("mod_view_tracking/html/view_campaign_group_mgr");
			break;
		
		
			/* user-report-track-absen */
			case 'user-report-track-absen':
				$this->load->view("mod_view_tracking/html/view_user_report_agent_absen");
			break;
		
			/*user-report-track-agenttime */
			case 'user-report-track-agenttime':
				$this->load->view("mod_view_tracking/html/view_user_report_agent_time");
			break;		
			
			// LH 07 September 2020
			/* filter_call_tracking_by_day */
			case 'filter_call_track_day': 
				$this->load->view("mod_view_tracking/html/view_call_track_by_day");
			break;
		
			/* filter_call_tracking_by_campaign */
			case 'filter_call_track_campaign':
				$this->load->view("mod_view_tracking/html/view_call_track_by_campaign");
			break;
		
			/* filter_call_tracking_by_day */
			case 'filter_call_track_agent':
				$this->load->view("mod_view_tracking/html/view_call_track_by_agent");
			break;	
		}	
	 }
	 function showHTML2()  
	{
		
		// tankap parameter yang di kirim .
	    $this->dataURI = UR();
	  
	    
		// catat setiap user yang meanrik Report 
		// untuk bukti ketiak ada user menarik report pada 
		// jam2 krusial.
		
		// process akan langsung dilakukan di view untuk optimasi 
		// performance report , tanpa lewat 
		// model terlebih dahulu.
		
		
		switch( $this->dataURI->field('report_type','trim')){

			/* filter_campaign_group_date */
			case 'filter_campaign_group_date':
				$this->load->view("mod_view_tracking/html/view_campaign_group_date");
			break;
		
		
			/* filter_campaign_group_date */
			case 'filter_campaign_group_date':
				$this->load->view("mod_view_tracking/html/view_campaign_group_date");
			break;
		
		
			/* filter_upload_filename */
			case 'filter_upload_filename' :
				$this->load->view("mod_view_tracking/html/view_upload_filename");
			break;
		
			/* filter_campaign_group_spv */
			case 'filter_campaign_group_spv' :
				$this->load->view("mod_view_tracking/html/view_campaign_group_spv");
			break;
		
			/* filter_campaign_group_spv */
			case 'filter_campaign_group_agent' :
				$this->load->view("mod_view_tracking/html/view_campaign_group_agent");
			break;
		
			/* filter_campaign_group_atm */
			case 'filter_campaign_group_atm' : 
				$this->load->view("mod_view_tracking/html/view_campaign_group_atm");
			break;	
		
			/* filter_campaign_group_mgr */
			case 'filter_campaign_group_mgr': 
				$this->load->view("mod_view_tracking/html/view_campaign_group_mgr");
			break;
		
		
			/* user-report-track-absen */
			case 'user-report-track-absen':
				$this->load->view("mod_view_tracking/html/view_user_report_agent_absen");
			break;
		
			/*user-report-track-agenttime */
			case 'user-report-track-agenttime':
				$this->load->view("mod_view_tracking/html/view_user_report_agent_time");
			break;		
			
			// LH 07 September 2020
			/* filter_call_tracking_by_day */
			case 'filter_call_track_day': 
				$this->load->view("mod_view_tracking/html/view_call_track_by_day");
			break;
		
			/* filter_call_tracking_by_campaign */
			case 'filter_call_track_campaign':
				$this->load->view("mod_view_tracking/html/view_call_track_by_campaign2");
			break;
		
			/* filter_call_tracking_by_day */
			case 'filter_call_track_agent':
				$this->load->view("mod_view_tracking/html/view_call_track_by_agent");
			break;	
		}	
 	}
 
 
	//---------------------------------------------------------------------------------------

	/* properties		index 
	 *
	 * @param 			uknown 
	 * @author			uknown 
	 */ 
	 
	 function ShowSpvReportByManger() 
	{
	  $Report = & Singgleton('M_CallTrackingReport');
	  $User = $Report->_select_attr_user();
	  
	  echo form()->combo('SpvId','select tolong', 
							$Report->_select_report_spv_by_manager( _get_array_post('ManagerId') ),  $User->get_value('SpvId'), 
							array("change" => "ShowAgentReportBySpv(this);") );
	   
	} 

	//---------------------------------------------------------------------------------------

	/* properties		index 
	 *
	 * @param 			uknown 
	 * @author			uknown 
	 */
	 
	function ShowSpvReportByAtm()
	{ 
	   $obClass = & get_class_instance('M_CallTrackingReport');
	   $atClass = $obClass->_select_attr_user();
	   echo form()->combo('SpvId','select tolong', $obClass->_select_report_spv_by_atm( _get_array_post('AtmId') ), $atClass->get_value('tl_id'), 
		array("change" => "ShowAgentReportBySpv(this);") );
	}
 //---------------------------------------------------------------------------------------

/* properties		index 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 
 function ShowSpvReportAbsentByManger()
{
	$obClass = & get_class_instance('M_CallTrackingReport');
    $atClass = $obClass->_select_attr_user();
    echo form()->combo('user_spv_id','select tolong', $obClass->_select_report_spv_by_manager( _get_array_post('ManagerId') ), 
		$atClass->get_value('tl_id'), 
	array("change" => "ShowAgentReportAbsentBySpv(this);") );
} 

//---------------------------------------------------------------------------------------

/* properties		index 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
function ShowAgentReportAbsentBySpv()
{
	$Report = & Singgleton('M_CallTrackingReport');
	echo form()->combo('user_tmr_id','select tolong', 
		$Report->_select_report_tmr_by_spv( _get_array_post('SpvId')));
}

/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
function ShowAgentReportBySpv() 
{
  $obClass = & get_class_instance('M_CallTrackingReport');
  echo form()->combo('TmrId','select tolong', $obClass->_select_report_tmr_by_spv( _get_array_post('SpvId'))); 
 }
 
 
 /*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
 function ShowReport() 
 {
	session_start();
	if(  $this->EUI_Session->_get_session('UserId') && $this->EUI_Session->_get_session('HandlingType') != '4') {
		$this->EventLogerReport( UR() );	
		// get number of URI Segmentation ( 3 )// param 	 
		 if( !strcmp( $this->URI->segment(3), 'html' )) {
			$this->showHTML(); 
		 }	
		 
		 // model view export data to excel <xls.2013>
		 else if( !strcmp( $this->URI->segment(3), 'excel' ))  {
			$this->ShowExcel(); 
		 }
		 else{
			$this->showHTML();  
		 }
		 // end show;
		 
		}
	}
	function ShowReport2() 
 {
	
	session_start();
	if(  $this->EUI_Session->_get_session('UserId') && $this->EUI_Session->_get_session('HandlingType') != '4') {
		$this->EventLogerReport( UR() );	
		// get number of URI Segmentation ( 3 )// param 	 
		 if( !strcmp( $this->URI->segment(3), 'html' )) {
			$this->showHTML2(); 
		 }	
		 
		 // model view export data to excel <xls.2013>
		 else if( !strcmp( $this->URI->segment(3), 'excel' ))  {
			$this->ShowExcel2(); 
		 }
		 else{
			$this->showHTML2();  
		 }
		 // end show;
		 
		}
}

// LH 07 September 2020

	function ShowFilterProduct()
	{
		$obClass = & get_class_instance('M_CallTrackingReport');
		if (in_array("all", _get_array_post('CampaignId'))) {
			// var_dump('ShowFilterProduct2');
		  	echo form()->chooseall('ProductId','select tolong',  $obClass->_select_report_product());
		} else {
			// var_dump('ShowFilterProduct1');
		  	echo form()->chooseall('ProductId','select tolong',  $obClass->_select_report_product_by_campaign( _get_array_post('CampaignId')));
		
		}

	}


	//---------------------------------------------------------------------------------------

	/* properties		index 
	 *
	 * @param 			uknown 
	 * @author			uknown 
	 */ 
	 
	 function ShowSpvReportByMangerNew() 
	{
	  $Report = & Singgleton('M_CallTrackingReport');
	  $User = $Report->_select_attr_user();
	  
	  echo form()->combo('spvidnew','select tolong', 
							$Report->_select_report_spv_by_manager( _get_array_post('ManagerIdNew') ),  $User->get_value('SpvIdNew'), 
							array("change" => "ShowAgentReportBySpvNew(this);") );
	   
	} 

	//---------------------------------------------------------------------------------------

	/* properties		index 
	 *
	 * @param 			uknown 
	 * @author			uknown 
	 */
	 
	function ShowSpvReportByAtmNew()
	{ 
	   $obClass = & get_class_instance('M_CallTrackingReport');
	   $atClass = $obClass->_select_attr_user();
	   echo form()->combo('spvidnew','select tolong', $obClass->_select_report_spv_by_atm( _get_array_post('AtmIdNew') ), $atClass->get_value('tl_idNew'), 
		array("change" => "ShowAgentReportBySpvNew(this);") );
	}

	/*
	 * @param  [type] $CustomerId [description]
	 * @return [type]             [description]
	 */	
	function ShowAgentReportBySpvNew() 
	{
	  $obClass = & get_class_instance('M_CallTrackingReport');
	  echo form()->combo('TmrIdNew','select tolong', $obClass->_select_report_tmr_by_spv( _get_array_post('SpvIdNew'))); 
	}
}
?>
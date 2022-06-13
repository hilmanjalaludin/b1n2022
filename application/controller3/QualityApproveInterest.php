<?php
/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 
class QualityApproveInterest extends EUI_Controller
{

/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 public function __construct() 
{
	parent::__construct();
	//display();
	$this->load->model(array( base_class_model($this)));	
	$this->load->helper('EUI_Object');
	
 }
/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 public function QualityDetail()
{
	
	$out =new EUI_Object( _get_all_request() );	
	$CustomerId = $out->get_value('CustomerId'); 
//---------- load object by instance ------------

	
	$objQtyResult =& get_class_instance('M_SetResultQuality');
	$objQuality   =& get_class_instance('M_QtyApprovalInterest');
	$objCustomer  =& get_class_instance('M_SrcCustomerList');
	$objUser      =& get_class_instance('M_SysUser');
	$objectCustomer = $objCustomer->_getDetailCustomer($CustomerId);
	
// --------- load view data ------------------------------------
	 $this->load->view('qty_approval_interest/view_quality_detail',array 
	(
		'Customers' 	   => new EUI_Object($objectCustomer), 
		'Accurate'		   => new EUI_Object( $this->{base_class_model($this)}->_fetch_row_accurate_data( $CustomerId ) ) , 
		'Callhistory' 	   => $objQuality->_getLastCallHistory( $CustomerId ),
		'Seller'		   => (object)$objUser->_get_user($objectCustomer["SellerId"]) ,
		'Agent'		       => (object)$objUser->_get_user(_have_get_session("UserId")) ,
		'Disabled'		   => $objQuality->_select_row_data_quality_status( $CustomerId),
		'QualityApprove'   => $this->QualityResult(),
		'ResultPoints' 	   => ApprovalPoint(),
		'JsonAssesment'    => JsonAssesment(),
		'QtyScoring' 	   => QualityScoring(),
		'Assesment' 	   => Assesment(),
		'QualityScoring'   => ContentScoring(),
		'ComboScoring'     => ComboScoring(), 
		'scoring'	 	   => $this->M_Scoring
	));
}

/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 function _getCombo()
 {
	 
	return array();
 }
/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
public function index()
{
 if(_have_get_session('UserId') && class_exists('M_QtyApprovalInterest') )
 {
	$this->load->view('qty_approval_interest/view_approval_interest_nav',array( 
		'page' => $this->{base_class_model($this)}->_get_default()  
	));
 }
 
}
 
/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
public function Content()
{

  if(_have_get_session('UserId') ) 
  {
	$_EUI['page'] = $this->{base_class_model($this)}->_get_resource();    // load content data by pages 
	$_EUI['num']  = $this->{base_class_model($this)}->_get_page_number(); // load content data by pages 
	
	// sent to view data 
	if( is_array($_EUI) && is_object($_EUI['page']) ) {
		$this -> load -> view('qty_approval_interest/view_approval_interest_list',$_EUI);
	 }	
  }	
}
 
/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 
function QualityResult()
{
	$_conds= array();
	$_conds = $this->M_SetResultQuality->_getQualityResult();
	
	foreach( $_conds as $k => $rows )
	{
		$_conds[$k] = $rows['name']; 
	}
	
	return $_conds;
}


/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
function LastCallHistory( $CustomerId = 0 )
{	
	$_conds = array();
	
	if( $this -> EUI_Session->_have_get_session('UserId') )
	{
		$_conds = $this -> {base_class_model($this)}->_getLastCallHistory( $CustomerId );
	}
	
	return $_conds;
}

/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
function CallResultId()
{
	$_conds = array();
	$datas = $this -> M_SetCallResult->_getCallReasonId();
	foreach($datas as $k => $rows )
	{
		$_conds[$k] = $rows['name'];
	}
	
	return $_conds;
}

 
function Recording()
{
	$param = array(
		'CustomerId' => $this->URI->_get_post('CustomerId'),
		'pages' => $this->URI->_get_post('Pages'),
	);
	
	$ListView =  array( 
		'data'  => $this->{base_class_model($this)}->_getListVoice($param), 
		'page'  => $this->{base_class_model($this)}->_getPages($param),
		'records' => $this->{base_class_model($this)}->_getCountVoice($param),
		'current' => $this->URI->_get_post('Pages')
		);
	
	
	if( $ListView )
	{
		$this -> load -> view('qty_approval_interest/view_quality_recording',$ListView);
	}
}

/*
 * @ def 		:  remove this function Not Use for this version 
 * -------------------------------------------
 
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 public function CallHistory()  {
   exit('Modul move on ');
}

// ---------------------------------------------------------------------------
/*
 * @ def 		: approval save point 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 public function SaveQualityActivity()
{
  $cond = array("success" => 0);
  $out= new EUI_Object( _get_all_request() );
  if( !$out->fetch_ready() ){ 
	return FALSE; 
  }
  
 // --------------------------------------------------------- 
  $obClass =& get_class_instance(base_class_model($this));

  if (  $obClass->_save_row_quality_data($out)  ) {
	$cond = array("success" => 1);  
	echo json_encode($cond);  
	return false;
  }	  
  
  echo json_encode(array("success" => 0 ));
}

public function SaveAccurate()
{
  $cond = array("success" => 0);
  $out= new EUI_Object( _get_all_request() );
  if( !$out->fetch_ready() ){ 
	return FALSE; 
  }
  
 // --------------------------------------------------------- 
  $obClass =& get_class_instance(base_class_model($this));

  if (  $obClass->_save_row_accurate_data($out)  ) {
 	echo json_encode(array("success" => 1 ));
 	return false;
  }	  
  
  echo json_encode(array("success" => 0 ));
}

// ---------------------------------------------------------------------------
/*
 * @ def 		: approval save point 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 public function SetQualityReason()
{
	$out =new EUI_Object( _get_all_request() );
	$QualityStatus = $this->{base_class_model($this)}->_select_quality_status( $out->get_value('CustomerId'));
	echo form()->combo('QualityReasonStatus','select tolong xchosen ui-widget-qty-disabled', QualityReason($out->get_value('QualityStatus')), $QualityStatus);
}

 // ---------------------------------------------------------------------------
/*
 * @ def 		: approval save point 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 public function saveScoring () {
	if ( isset($_POST) ) :
		$this->M_Scoring->saveScore($_POST);
	endif;
 }


/*
 * @ def 		: approval save point 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 
public function DetailInsured()
{
  
  $out =new EUI_Object(_get_all_request());
  if( !$out-> fetch_ready() ){
	  return FALSE;
  }

// ------------------------------------------------------------------------  
  $objInsured =& get_class_instance('M_Insured');
  $objUnderwrite =& get_class_instance('M_Underwriting');
  $objBenefiecery =& get_class_instance('M_Benefiecery');
  
 //--------------------------------------------------------------------------
  $objQuality   =& get_class_instance('M_QtyApprovalInterest');
  $arr_insured =new EUI_Object( $objInsured->_getInsureId($out->get_value('InsuredId')) );
  
  //print_r($arr_insured);
  
  
  $arr_output = array (
		
		'Insured' => $arr_insured,
		'Disabled' => $objQuality->_select_row_data_quality_status( $arr_insured->get_value('CustomerId') ),
		'Question' => $objUnderwrite->_getUnderwriting( 
			$arr_insured->get_value('ProductId'),
			$arr_insured->get_value('CustomerId'),
			$arr_insured->get_value('InsuredId')
		),
		 'QtyUnderwriting'=> $objUnderwrite->_getExitsUnderwriting(
			$arr_insured->get_value('ProductId'),
			$arr_insured->get_value('CustomerId'),
			$arr_insured->get_value('InsuredId')
		 ));
  
  $this -> load -> view("qty_approval_interest/view_detail_insured", $arr_output );
	
}


/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */

function PlayBySessionId() 
{
  $_success = array('success'=>0);
	
  $FTP = $this -> M_Configuration -> _getFTP();
  $sql ="SELECT b.id as RecId FROM cc_call_session a  
		 LEFT JOIN cc_recording b ON a.session_id=b.session_key 
		 WHERE a.session_id='{$this -> URI->_get_post('RecordId')}'";
			 
  $qry = $this -> db ->query($sql);
  if( $rows = $qry -> result_first_assoc() )
  {
	 $voice  = $this -> {base_class_model($this)}->_getVoiceResult($rows['RecId']);
	 if( is_array($voice) )
	 {
		$this->load->library('Ftp');
		
		$PBX = $this->M_Pbx ->InstancePBX($voice['agent_ext']);
		$this->Ftp->connect(array(
			'hostname' => $FTP["FTP_SERVER{$PBX}"],
			'port' => $FTP["FTP_PORT{$PBX}"],
			'username' => $FTP["FTP_USER{$PBX}"],
			'password' => $FTP["FTP_PASSWORD{$PBX}"]
		));
		
		if( ($this -> Ftp->_is_conn()!=FALSE) 
			&& (isset($voice['file_voc_loc'])) )
		{
			$_found   = null;
			$this->Ftp->changedir($voice['file_voc_loc']); 
			
			$_ftplist = $this -> Ftp -> list_files('.');
			foreach($_ftplist as $k => $src )
			{
				if( ($src == $voice['file_voc_name'])) {
					$_found = $src;
				}
			}
			
		/** def location to local download **/
		
			if(!defined('RECPATH') ) 
				define('RECPATH',str_replace('system','application', BASEPATH)."temp");
				
		/** if match fil then download **/
		
			if( !is_null($_found) )
			{
				$_original_path = RECPATH;
				if($this -> Ftp -> download(RECPATH . '/' . $_found, $_found))
				{	
					exec("sox {$_original_path}/{$_found} {$_original_path}/{$_found}.wav");
					$voice['file_voc_name'] = "{$_found}.wav";
					
					@unlink( $_original_path ."/". $_found );
					
					$_success = array('success'=>1, 'data' => $voice );
				}
			}
		}
	}
	
	
	}
	
	echo json_encode($_success);
	
} 

/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
function SubmitRate(){
  $this->out = UR();
  $this->msg = array('success' => 0);
  if( !$this->out->find_value('QR_Voice_Record') ){
	echo json_encode($this->msg);
	return false;
  }
  // then will get of process 
	// DM_Custno
	// debug($this->out);
	
 if( $row = Singgleton($this)->_submit_quality_rate( $this->out ) ){
	 $this->msg = array('success' => 1);
  }	
  echo json_encode($this->msg);
  return false;
}

/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 function ftpconvertData( $source = null){
	$file_source = sprintf("%s",$source);
	$file_destination = sprintf("%s.wav", rtrim($source,".gsm"));
	exec(sprintf("sox %s %s", $file_source, $file_destination));
	
 } 
 
/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 function ftpconfiguration( $extension  = 0 )
{
	// this get name pbx 
	$this->dataServerExtension = $extension;
	$this->dataServerPbxID = null;
	$this->dataServerPbxConf = null;
	$this->dataServerPbxAddr = array();
	
	// then will query step by step 
	$sql = sprintf("select a.pbx from cc_extension_agent a where a.ext_number = '%s'", $this->dataServerExtension);
	$qry = $this->db->query( $sql );
	if( $qry && $qry->num_rows() >0 
		and ( $row = $qry->result_first_assoc() ))
   {
		$this->dataServerPbxID = $row['pbx'];
	}
	
	// if pbx server empty OR Null Return false;
	if( is_null($this->dataServerPbxID) ){
		return false;
	}
	
	// this get config 
	$sql = sprintf("SELECT cf.ConfigName FROM t_lk_configuration cf 
					WHERE cf.ConfigValue ='%s' 
					AND cf.ConfigCode='PBX_VLS_CONFIG'",  $this->dataServerPbxID );
					
	$qry = $this->db->query( $sql ); 
	if( $qry && $qry->num_rows() >0 
		and ( $row = $qry->result_first_assoc() ))  {
		$this->dataServerPbxConf = $row['ConfigName'];
	}				
	
	// if pbx server empty OR Null Return false;
	// var_dump($this->dataServerPbxConf);
	
	if( is_null($this->dataServerPbxConf) ){
		return false;
	}
	
	// get row data PBX setup t_lk_configuration.
	$sql = sprintf("SELECT a.ConfigID, a.ConfigName, a.ConfigValue 
					FROM t_lk_configuration a where ConfigCode='%s'", $this->dataServerPbxConf);
					
	$qry = $this->db->query( $sql );			
	if( $qry and $qry->num_rows() >0 )
	 foreach( $qry->result_record() as $row )
	{
		$this->dataServerPbxAddr[$row->field('ConfigName')] = $row->field('ConfigValue','trim');
	}				
	
	// return data convert to object string.
	return Objective( $this->dataServerPbxAddr );
} 
/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
function ftpfetchData( $row = null ){
	$this->load->library('Ftp');
	
// then test OK 	
	$this->ftp_remote_find 	= null;
	$this->ftp_remote_files = null;
	$this->ftp_remote_conn 	= false;
	
// then define of data testing OK 
	$this->ftp_remote_dir 	= $row->field('file_voc_loc');
	$this->ftp_remote_file 	= $row->field('file_voc_name');
	$this->ftp_remote_extn  = $row->field('agent_ext','trim');
	
// buka konneksi ke FTP Service DI PBX 	
// untuk buka koneksi cehck IP PBX berdasrakan Seting di cc_agent_extension 
// mengacu ke PBX.id 

	$this->dataFtpConfig = $this->ftpconfiguration( $this->ftp_remote_extn );
	if( !$this->dataFtpConfig ){
		exit('NO CONFIGURATION');
	}
	
	if( !$this->dataFtpConfig->find_value( 'PBX_VLS_HOST' ) ) {
		exit('NO CONFIGURATION');
	} 
	
// debug($this->dataFtpConfig);
// then will push data to Ftp library.	
	$this->ftpCallBackMsg = false;
	$this->Ftp->connect(array(
		'hostname' 	=> $this->dataFtpConfig->field('PBX_VLS_HOST'),
		'port' 		=> $this->dataFtpConfig->field('PBX_VLS_PORT'),
		'username' 	=> $this->dataFtpConfig->field('PBX_VLS_USER'),
		'password' 	=> $this->dataFtpConfig->field('PBX_VLS_PWD'),
		'debug' 	=> 1 
	));
	
// lanjut ke porcess  - mya 	
	$this->ftp_remote_conn = $this->Ftp->_is_conn();
	
	if( !$this->ftp_remote_conn ) {
		printf('%s', 'FAILED CONNECTION TO SERVER REMOTE');
		exit(0);
	}
	
	 
// jika koneksi berhasil 
    if( !$this->ftp_remote_conn ){
		printf('%s', 'FAILED CONNECTION TO SERVER REMOTE');
		exit(0);
	}
	
	// change dir ftp service 
	$this->Ftp->changedir( $this->ftp_remote_dir  );
	if( $this->ftp_remote_conn and ( is_null( $this->ftp_remote_files ) )){
		$this->ftp_remote_files = $this->Ftp->list_files('.');
	}
	
	// print_r($this->ftp_remote_files);
	// jika isi data adalah array 
	
	if( is_array($this->ftp_remote_files))
	foreach( $this->ftp_remote_files as $key => $file ){
		//jika nama file tersebut ada .
		if( strcmp( $this->ftp_remote_file, $file ) ){
			continue;	
		}
		$this->ftp_remote_find = $file;
	}
	
	// jika file kosong .
	if( is_null($this->ftp_remote_find)){
		printf('FILE <%s> NAME NOT FOUND ON SEVER REMOTE', $this->ftp_remote_file);
		exit(0);
	}
	
	// jika ada maka ambil file tersebut download dan konvert ya .
	
	$this->ftp_path_destination = sprintf("%s/%s", rtrim(BASEPATH, '/system'), 'application/temp');
	$this->ftp_file_destination = sprintf("%s/%s", $this->ftp_path_destination, $this->ftp_remote_find);
	
	// download file after attribute change OK 
	$this->ftpCallBackMsg = $this-> Ftp->download($this->ftp_file_destination, $this->ftp_remote_find);
	if( !$this->ftpCallBackMsg ){
		printf('FILE <%s> FAILED TO DOWNLOAD', $this->ftp_remote_file);
		exit(0);
	}
	// return to client request data fetch OK 
	$this->ftpconvertData($this->ftp_file_destination);
	
	return $this->ftpCallBackMsg;
}

/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 
function VoicePlay()
{
	
// get all row record data Rec
	$this->out = UR();
	$this->ftp = false;
	
	if( !$this->out->find_value('RecordId') ){
		exit('recording not found');
	}
	
	// get data all row value on recording table .
	$this->row = Singgleton($this)->_select_row_data_voice( $this->out->field('RecordId') );
	if( !$this->row->find_value('id') ){
		exit('recording not found');
	}
	// jika berhasil ke download ambil url untuk di play di browser -nya 
	$this->file_destination_play = null;
	$this->ftp = $this->ftpfetchData( $this->row );
	if( $this->ftp ){
		
		// jika data untuk GSM convert ke wav terlebih dahulu 
		
		$this->file_destination_wav = sprintf("%s.wav", rtrim($this->row->field('file_voc_name'),'.gsm'));
		$this->file_destination_play = sprintf("%s/application/temp/%s", rtrim( base_url(), '/'), $this->file_destination_wav);
	}
	
	// sudah ok push disini ;
	$this->row->add('file_url_data', $this->file_destination_play);
	
	// masukan data tersebut ke via data untuk di play namun sebelum di 
	// download dan ubah file tersebut agar bisa di play di browser client 
	// get.its
	$this->btn = SystemRoleFrm( $this->out->field('ControllerId'), 'Objective');
	$this->load->view("mod_voice_data/view_voice_play", array( 
		'row' => $this->row, 
		'btn' => $this->btn
	));
}


// ---------------------- update Insured  on selected insured ID . ---

 public function UpdatePayer() 
{
 $conds = array('success' => 0 );
 $out = new EUI_Object( _get_all_request() );
 
 if( !$out->fetch_ready() ) {
	echo json_encode( $conds );
	return false;
 }
 
 
// ------------ call class ---------------------------------------
 
 $obClass =& get_class_instance('M_Payers');
 if( $obClass-> _UpdateDataPayers( $out ) ) {
	$conds = array('success' => 1); 
 }	 
 
 echo json_encode($conds);
  
}


// ---------------------- update Insured  on selected insured ID . ---

 public function UpdateInsured() 
{
 $conds = array('success' => 0 );
 $out = new EUI_Object( _get_all_request() );
 
 if( !$out->fetch_ready() ) {
	echo json_encode( $conds );
	return false;
 }
 
 
// ------------ call class ---------------------------------------
 
 $obClass =& get_class_instance('M_Insured');
 if( $obClass-> _UpdateDataInsured( $out ) ) {
	$conds = array('success' => 1); 
 }	 
 
  echo json_encode($conds);	
  
}



//UpdateBenefiacery
public function UpdateBenefiacery() 
{

  $_conds = array('success' => 0 );
	$BeneficiaryId = $this -> URI->_get_array_post('BeneficiaryId');
	if( $param = $this -> URI->_get_all_request() 
		AND is_array($BeneficiaryId) )
	{
		$n = 0;
		foreach( $BeneficiaryId as $key => $num )
		{
			$_SET_POST['GenderId'] = $param["BenefGender_{$num}"];
			$_SET_POST['SalutationId'] = $param["BenefSalutationId_{$num}"];
			$_SET_POST['BeneficiaryDOB'] = date('Y-m-d',strtotime($param["BeneficiaryDOB_{$num}"]));
			$_SET_POST['BeneficiaryFirstName'] = $param["BeneficiaryFirstName_{$num}"];
			$_SET_POST['RelationshipTypeId'] = $param["BenefRealtionship_{$num}"];
			$_SET_POST['BeneficiaryAge'] = $param["BeneficiaryAge_{$num}"];
			$_SET_POST['BeneficiaryUpdatedTs'] = date('Y-m-d H:i:s');
			$_SET_POST['BeneficiaryId'] = $num;
			if( $res= $this -> M_Benefiecery -> _UpdateDataBeneficiary($_SET_POST) ){
				$n++;
			}
		}	
		if( $n > 0 ) {
			$_conds = array('success' => 1);
		}	
	}	
	
  __(json_encode($_conds));	
}

// ------------------------------------------------------------------------------
/*
 * @ package  Interested by Handle Random 
 */ 
 
function Interested(){ 
	echo json_encode(array('count' => 0));
} 

}
?>
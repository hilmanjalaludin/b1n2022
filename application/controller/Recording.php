<?php

/*
 * E.U.I 
 *
 
 * subject	: get model data for SysUser 
 * 			  extends under Controller class
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/controller/sysuser/
 */
 
class Recording Extends EUI_Controller
{

/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 function __construct () {
	parent::__construct();
	//display(1);
	$this->load->model(array(base_class_model($this)));
	$this->load->helpers(array('EUI_Object'));
	$this->load->library('Ftp');
 }
 
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
  function _getCallInterest() { return null;  }
/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 
function getAllResult() { return null; }

/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
 function index()  {
// singgleton data 	
  $this->dataVLS = Singgleton($this);
  if(!is_object($this->dataVLS) ){
	exit(0); 
 }
 
// sent view data process 

 $this->load->view('mod_voice_data/view_mod_voice_nav',array(
	'page' => $this->dataVLS->_get_default()
 )); 
}
 
/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 function Content() {

 
 // singgleton data and process to sent view 
	$this->dataVLS = Singgleton($this);
	
// berikut ini proces kirim adat ke process .
	$this->load->view('mod_voice_data/view_mod_voice_list',array(
		'page' => $this->dataVLS->_get_resource(),
		'num'  => $this->dataVLS->_get_page_number()
	));
	 
}
 
/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
function Playing()
{
	$_success = array('success'=>0);
	
	$FTP = $this -> M_Configuration -> _getFTP();	
	$voice  = $this -> {base_class_model($this)}->_getVoiceData($this->URI->_get_post('RecordId') );
	
	// if exist data then cek in PBX Server ...
	if( is_array($voice) ) 
	{
	
	 // include library FTP 
	 
		$this->load->library('Ftp');
		
	// set parameter attribute 
	
		$PBX = $this->M_Pbx ->InstancePBX($voice['agent_ext']);
		$this->Ftp->connect(array(
			'hostname' => $FTP["FTP_SERVER{$PBX}"],
			'port' => $FTP["FTP_PORT{$PBX}"],
			'username' => $FTP["FTP_USER{$PBX}"],
			'password' => $FTP["FTP_PASSWORD{$PBX}"])
		);
		
		
		
		// cek connection ID 
		
		if( ($this -> Ftp->_is_conn()!=FALSE) 
			AND (isset($voice['file_voc_loc'])) )
		{
			$_found   = null;
			
		// change directory on server remote ...
		
			$this->Ftp->changedir($voice['file_voc_loc']); 
			
		// show file on spesific location ..
		
			$_ftplist = $this -> Ftp -> list_files('.');
			foreach($_ftplist as $k => $src )
			{
				if( ($src == $voice['file_voc_name'])) {
					$_found = $src;
				}
			}
			
		// def location to local download 
		
			if(!defined('RECPATH') ) 
				define('RECPATH',str_replace('system','application', BASEPATH)."temp");
				
		// if match fil then download 
		
			if( !is_null($_found) ) 
			{
				$_original_path = RECPATH;
				
				if($this -> Ftp -> download(RECPATH . '/' . $_found, $_found ) ) 
				{
					exec("sox {$_original_path}/{$_found} {$_original_path}/{$_found}.wav");
					$voice['file_voc_name'] = "{$_found}.wav";
					@unlink( $_original_path ."/". $_found );
					$_success = array('success'=>1, 'data' => $voice );
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
  
 function Convert( $source = null){
	$file_source = sprintf("%s",$source);
	$file_destination = sprintf("%s.wav", rtrim($source,".gsm"));
	exec(sprintf("sox %s %s", $file_source, $file_destination));
	return $file_destination;
	
 } 
 
/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 function Process()
{		
// get attribute proces on here .
   
	$this->dataVLS = Singgleton($this); 
	$this->dataURI = UR();
	
 // configuration voice data by click user ...
	$this->msg = array( 'success' => 0, 'data' => null );
	// $this->row = $this->dataVLS->_select_row_fetch_data( $this->dataURI->field('RecordId') ); 
	$this->row = $this->dataVLS->_select_row_fetch_data( $this->URI->_get_post('RecordId') ); 
	
	if( !$this->row->field('file_voc_name') ){
	  exit('FILE NOT FOUND');
	} 
	 
// get set data Process on here LIKE .

	$this->ftp_remote_dir 	= $this->row->field('file_voc_loc');
	$this->ftp_remote_file 	= $this->row->field('file_voc_name');
	$this->ftp_remote_extn  = $this->row->field('agent_ext');
	
 // get configuration from list database .
	$this->dataFtpConfig = $this->dataVLS->_select_row_ftp_config( $this->ftp_remote_extn );
	if( !$this->dataFtpConfig ){
		exit('NO CONFIGURATION');
	}
	
	
 // include library FTP set parameter attribute 
	
	$this->ftpCallBackMsg = FALSE;
	$this->Ftp->connect(array(
		'hostname'  => $this->dataFtpConfig->field( 'PBX_VLS_HOST' ),   
		'port' 		=> $this->dataFtpConfig->field( 'PBX_VLS_PORT' ), 
		'username'  => $this->dataFtpConfig->field( 'PBX_VLS_USER' ),  
		'password'  => $this->dataFtpConfig->field( 'PBX_VLS_PWD'  )
	));
			
// var_dump($this->Ftp);	
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
	
	if( is_array( $this->ftp_remote_files ))
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
	// var_dump($this->ftp_file_destination);
	
	$this->pathProcessDataHasil = $this->Convert($this->ftp_file_destination);

	if( $this->ftpCallBackMsg ){
		$this->row->add('path_destination_tmp', $this->pathProcessDataHasil);
		$this->msg = array( 'success'=> 1, 'data' => $this->row->fetch_assoc() );
	} 
	
	// return client on JSON data type.
	printf("%s", json_encode( $this->msg ) );
	return false;
 }
 

/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  function Download() 
 {

// get data URI Process on Here Data  

	$this->dataURI = UR();
	if( !$this->dataURI->find_value('path')) {
		exit(0);
	}
	
// check apakah file nya ada ?
	$this->dataPath1 = base64_decode($this->dataURI->field('path'));//$this->dataURI->field('path','base64_decode'); // tmp 
	$this->dataPath2 = $this->dataPath1;//sprintf("%s.gsm", rtrim( $this->dataPath1, '.wav')); // asli 
	// print_r($this->dataPath1); die();
// pastikan kembali bahwa file yang akan di download masih tersedia 
// untuk di download by system.

	if( !file_exists($this->dataPath1) 
	OR !file_exists($this->dataPath2 ) ){
		exit('FILE NOT FOUND ON THIS SERVER');
	}
	
// then will get and download data Stream 	
	header("Pragma: public");
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("Cache-Control: public");
	header("Content-Description: File Transfer");
	header("Content-Type: audio/x-gsm");
	header("Content-Disposition: attachment; filename=". basename($this->dataPath1));
	header("Content-Transfer-Encoding: binary");
	header("Content-Length: " . filesize($this->dataPath1));
    ob_clean();
    flush();
	readfile($this->dataPath1); 
	
// delete file tmp && GSM -nya 	
	@unlink($this->dataPath1); // delete hasil convert dari GSM - WAV 
	@unlink($this->dataPath2); // delete file asli GSM .
 }
/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 function Deleted()
 {
	$_success = array('success'=>0);
	
	if(!defined('RECPATH')) {
		define('RECPATH',str_replace('system','application', BASEPATH)."temp");	
	}
	
	if( $this -> URI ->_get_have_post('filename') )
	{
		$file_voice = RECPATH . '/' . $this -> URI->_get_post("filename");
		if(file_exists($file_voice) )
		{
			if( @unlink($file_voice) )
			{
				$_success = array('success'=>1);
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
 function Role()  
{
	
// get attribute data header URI from URL 
	$this->dataURI = UR();
	$this->dataCLS = Singgleton('M_UserRole');
	
// get result data on row proces on here 
	$this->result_array = array();
	if( $this->dataURI->field('modul') )  {
		$this->result_array = $this->dataCLS->_select_role_menu_toolbar( $this->dataURI->field('modul'));
	}
	// return client request 'DATA'
	printf('%s', json_encode( $this->result_array ));
	return false;
	
 }

 
}

?>
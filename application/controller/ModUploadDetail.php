<?php
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
class ModUploadDetail Extends EUI_Controller
{

 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
function __construct() {
	parent::__construct();	
	display(0);
	$this->load->model(array(base_class_model($this)));
 }
 
 
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
 function index() 
{
	
 // get all attribute properties 
 $this->dataCOK = CK();
 $this->dataURI = UR();
 
// then will get its. 
 if( !$this->dataCOK->field('UserId') ) {
	exit(0);
 }	
// then sent view look data 
 $this->dataSTD = Singgleton($this);
 $this->load->view('mod_upload_detail/view_upload_nav', array(
	'page' => $this->dataSTD->_get_default()
 ));		
 
	 
 }
 
/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
 
public function Content()
 {
	if( $this -> EUI_Session -> _have_get_session('UserId'))
	{
		$EUI['page'] = $this ->{base_class_model($this)}-> _get_resource(); // load content data by pages 
		$EUI['num']  = $this ->{base_class_model($this)}-> _get_page_number(); 	// load content data by pages 
		
		$this -> load -> view('mod_upload_detail/view_upload_list', $EUI );
	}
 }
 
/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
 
function Aktivasi()  {
	
// get all attribute properties 
 $this->dataCOK = CK();
 $this->dataURI = UR();
 $this->dataSTD = Singgleton($this);

// then will save delete
 $this->callbackMsg = array('success'=> 0);
 $this->cond = $this->dataSTD->_aktivasi_row_upload_data( $this );
 if(  $this->cond ){
	$this->callbackMsg = array('success'=> 1); 
 }
 
 printf('%s', json_encode($this->callbackMsg ));
 return false;
 
	// $_conds = array('success' => 0 );
	
	// if( $this -> EUI_Session -> _have_get_session('UserId') 
		// AND  $this -> URI -> _get_have_post('FTP_UploadId') )
	// {
		// $DataId = $this -> URI->_get_array_post('FTP_UploadId');
		// if( is_array($DataId) )
		// {
			// $results = $this -> {base_class_model($this)}->_setHidden($DataId, $this ->URI->_get_post('Active'));
			// if( $results )
			// {
				// $_conds = array('success' => 1);
			// }
		// }
	// }
	
	// echo json_encode($_conds);
} 

/*
 * [Recovery data Delete]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
function Delete()
{
	
// get all attribute properties 
 $this->dataCOK = CK();
 $this->dataURI = UR();
 $this->dataSTD = Singgleton($this);

// then will save delete
 $this->callbackMsg = array('success'=> 0);
 $this->cond = $this->dataSTD->_delete_row_upload_data( $this );
 if(  $this->cond ){
	$this->callbackMsg = array('success'=> 1); 
 }
 
 printf('%s', json_encode($this->callbackMsg ));
 return false;
}
 

/*
 * [Recovery data Delete]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
 
 function Download() 
{
	
// get URL Data Process 
 $this->dataURI = UR();
 $this->dataSTD = Singgleton($this);
 
 // then will get Source Data .
 $this->dataROW = $this->dataSTD->_select_row_upload_data( $this->dataURI->field('UPL_UploadId') );
 if(!$this->dataROW->field('FTP_UploadId') ){
	exit(0); 
 }
 
 // get data url device data on path 
 $this->dataTIM = date('Y-m-dHi', $this->dataROW->field('FTP_UploadDateTs', 'strtotime'));
 $this->dataFNM = sprintf('%s_%s', $this->dataTIM, $this->dataROW->field('FTP_UploadFilename', 'basename'));
 $this->dataRLM = sprintf('%s%s', $this->dataROW->field('FTP_UploadFilename', 'basename'));
 $this->dataPTH = sprintf('%s/application/temp/%s', rtrim(BASEPATH, '/system'), $this->dataFNM); 
 
 // get file name 
 if( !file_exists($this->dataPTH) ){
	$this->dataPTH = sprintf('%s/application/temp/%s', rtrim(BASEPATH, '/system'), $this->dataRLM); 
 }
 // get path real fdata 
 if( !file_exists($this->dataPTH) ){
	exit('exit'); 
 }
 
// get data from header process .
 $this->dataBFR = 2048;
 $this->dataFRD = fopen( $this->dataPTH, 'r' );
 if( !$this->dataFRD ){
	 exit(0);
 }
 
// open stream header 
 header("Pragma: public");
 header("Expires: 0");
 header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
 header("Content-Type: application/force-download");
 header("Content-Type: application/octet-stream");
 header("Content-Type: application/download");;
 header("Content-Disposition: attachment;filename=". $this->dataFNM );
 header("Content-length:". filesize( $this->dataPTH ));
 header("Content-Transfer-Encoding: binary ");
 
 // get data row proces then will get here .
 if($this->dataFRD ) while( !feof( $this->dataFRD) ) {
	$this->dataRED = fread( $this->dataFRD, $this->dataBFR );
	print($this->dataRED);
 } 
// close data process OK 
 fclose($this->dataFRD );
}
 
/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
 
function Role() {
	 
	$this->dataURI = UR();
	$this->result_toolbars = array();
	
	// hget find_value modul data 
	if( $this->dataURI->find_value('modul') )  {
		$this->result_toolbars = $this->M_UserRole->_select_role_menu_toolbar( $this->dataURI->field('modul'));
	}
    printf('%s', json_encode( $this->result_toolbars ));
	return false;
}

public function DownloadList()
 {
	$filename = 'UploadDetail_'.date('Ymd_Him').'.xls';
	
	header("Pragma: public");
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("Content-Type: application/force-download");
	header("Content-Type: application/octet-stream");
	header("Content-Type: application/download");;
	header("Content-Disposition: attachment;filename=$filename");
	header("Content-Transfer-Encoding: binary ");
	
	// echo "Downloading";
	if( $this -> EUI_Session -> _have_get_session('UserId') ){
		$EUI['page'] = $this ->{base_class_model($this)}-> _get_downloadcontent(); // load content data by pages 
		$this -> load -> view('mod_upload_detail/view_upload_downloadlist', $EUI );
	}
 }
 
 
}

?>
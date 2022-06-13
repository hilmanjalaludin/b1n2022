<?php
/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 
if(!defined( 'EXCEL' )) define('EXCEL','XLS');
if(!defined( 'TEXT' ))  define('TEXT','TXT');
if(!defined( 'CSV' ))  define('CSV','CSV');


// upgrade class this;

class MgtBucket extends EUI_Controller
{
	
/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 public function __construct() 
{
	parent::__construct();
	display(0);
	$this->load->model(array(base_class_model($this)));
	$this->load->helper(array('EUI_Object'));
 }
 
 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
function SaveByCheckedATM()
{	
	$_success = array('success'=>0, 'mesages' => '0');
		
	if( $this -> EUI_Session -> _have_get_session('UserId') )
	{ 
		$post = array (
			'CampaignId' => $this -> URI->_get_post('campaign_id'),
			'BucketId' => $this -> URI -> _get_array_post('ftp_list_id'),
			'atm'=>	$this -> URI->_get_post('atm')
		);
		
		if(class_exists('M_ModDistribusi'))
		{
			// $total_data = $this ->M_ModDistribusi ->_setDistribusi($post,'saveByChecked');
			$total_data = $this ->M_ModDistribusi ->_setDistribusi($post,'SaveByCheckedATM');
			if( $total_data > 0 )
			{
				$_success = array('success'=>1, 'mesages' => $total_data );
			} 
		}
	}
	
	echo json_encode($_success);
	
}
 
 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 function getCampaignName()
 {
	$datas = array();
	if(class_exists('M_SetCampaign') )
	{
		$datas = $this -> M_SetCampaign -> _get_campaign_name();
	}
	
	echo json_encode($datas);
		
}

/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
function getATMName()
 {
 	$datas = array();
	if(class_exists('M_User') )
	{
		$datas = $this -> M_User -> _getATM();

	}
	echo json_encode($datas);
 } 
  
/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  public function index() 
 {
	if( !_get_is_login() ) { exit(0); }
	
	$Button = $this->M_UserRole->_select_role_form_action(get_class($this));
	$this -> load -> view("mgt_bucket_data/view_bucket_page", array(
		'Button' => new EUI_Object( $Button ),
		'Template' => $this->{base_class_model($this)}->_get_template()
	));
 }
 
/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  public function Content() 
 {
	$oClass =& get_class_instance(base_class_model($this));
	if(_have_get_session('UserId') )
	{
		$this->load->view("mgt_bucket_data/view_bucket_list", array(
			'page' => $oClass->_get_resource(),
			'num'  => $oClass->_get_page_number()	
		));	
	}	
 }
 
/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
private function _getFileName()
{ 
	$_name = null; $_data = explode('.',$_FILES['fileToupload']['name'] );
	if(is_array($_data) )
	{
		$_name = strtoupper( $_data[count($_data)-1] );
	}
	
	return $_name;
} 

// M_Template::_get_template_by_campaign(
/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  function UploadBucket() 
 {
	

// pre define all object variable on modul bucket upload 
// for properies .

  $this->success 	= 1;  
  $this->failed 	= 0;
  
// pre define all object variable on modul bucket upload 
// for properies .

  $this->fls = FL(); $this->out = UR();  $this->cok = CK();	
  $this->out->add('recsource', date('YmdHis'));
 // pre define all object variable on modul bucket upload 
// for properies .
  $this->ar_val_extn = array( EXCEL, TEXT, CSV );
  $this->ar_val_data = $this->out->get_value();
  $this->ar_val_file = $this->fls->get_value();
 
 // nilai default untuk setiap process upload 
 
 
   $this->callbackMsg = array('success' => $this->failed, 'mesages'=> 'File Not Found');
	
// ubah variable array ke bentuk object 	untuk 
// di process lebih lanjut.

   $this->stm = $this->fls->field('fileToupload', 'Objective');
   
 // cek validation 
   if( is_object( $this->fls ) and ( !$this->stm->find_value('name') 
									OR !$this->out->find_value('CampaignId')  
									OR !$this->out->find_value('recsource')))
	{
	   $this->callbackUpl = 'Form upload not complete.';	
	   $this->callbackMsg = array( 'success' => $this->failed, 
								   'mesages' => $this->callbackUpl);	
	   
	   printf('%s', json_encode( $this->callbackMsg) );
	   return false;
   }
   
 // panggil modul template untuk process cek file 
 // berdasarkan template .
 
  $this->upl =& Singgleton('M_Upload');
  $this->tpl =& Singgleton('M_Template');
  
 // get detail row of template . 
  $this->cmp = array('CampaignId' => $this->out->field('CampaignId'),
					 'TemplateId' => $this->out->field('TemplateId') ); 
					 
 // cek apakah data berisi array ?
 
  if( !is_array( $this->cmp ) ){
	printf('%s', json_encode( $this->callbackMsg) );
	return false;
  }

// next process berikutnya . convert data ke dalam bentuk object 
// class helper.

 $this->tpo = Objective( $this->cmp );
 
 if( !$this->tpo->find_value('TemplateId') ){
	printf('%s', json_encode( $this->callbackMsg) );
	return false;
 }
 
 
// ambil detail template -nya && extension yang di maksud oleh 
// data upload .

  $this->tdb = $this->tpl->_getDetailTemplate( $this->tpo->field('TemplateId') );
  $this->ext = $this->_getFileName();
  // print_r($this->ext);
  
// ambil detail template -nya && extension yang di maksud oleh 
// data upload .  
  $this->tpd = Objective( $this->tdb); 
  
// cek validation dari extension file tersebut  
  
  if( is_null( $this->ext ) ){
	printf('%s', json_encode( $this->callbackMsg) );
	return false;
  }
  
// lanjut ke process berikutnya . this will default of message callbackUpl
 $this->callbackUpl = null;
 
 // jika bukan ke 2 type file ini.
 
  if( !in_array( $this->ext,  $this->ar_val_extn ) ) 
 {
	 $this->callbackUpl = 'File extension no suported.';
	 $this->callbackMsg = array('success' => $this->failed, 'mesages' => $this->callbackUpl );
	 
	 // return 
	 printf('%s', json_encode( $this->callbackMsg) );
	 return false;
	 
 }
 
 
 // jika data yang akan di upload tidak masuk terlebih dahule ke table
 // bucket customer melainkan ke table yang sudah di tentukan oleh user .
 
  if( $this->tpd->find_value('TemplateBucket') 
   and (  !strcmp($this->tpd->field('TemplateBucket'), 'N') OR 
		  !strcmp($this->tpd->field('TemplateBucket'), 'Y') ) )  
{
	
	// set parameter tambahan disini .
	
	$this->param = array( 'CampaignId'  => $this->out->field('CampaignId'),
						  'recsource'   => $this->out->field('recsource'),
						  'TemplateId'  => $this->tpo->field('TemplateId'),
						  'expireddate' => $this->out->field('ExpiredDate') );
							
	// kemudian akan di sesuikan berdasarkan kondisi 
	// berikut ini. INSERT|UPDATE
	
	$this->tpm = $this->tpd->field('TemplateMode','strtoupper');
	
	// jika kondisi yang di minta adalaha insert 
	// ketable yang dimaksud.
	
	
	if(!strcmp( $this->tpm, 'INSERT')) {
		$this->callbackUpl = $this->upl->setInsertUpload( 
							 array( 'file_attribut' => $this->ar_val_file, 'request_attribut' => $this->param ), 
							 array( 'Upload_DateTs' => date('Y-m-d H:i:s'), 'Upload_ById'     => $this->cok->field('UserId')));
		
		$this->callbackMsg = array( 'success' => $this->success, 'mesages' => $this->callbackUpl );		
	} 	
	
	// jika kondisi yang di minta adalaha insert 
	// ketable yang dimaksud.
	
	if(!strcmp( $this->tpm, 'UPDATE')) {
		$this->callbackUpl = $this->upl->setUpdateUpload( 
							 array( 'file_attribut' => $this->ar_val_file, 'request_attribut' => $this->param ), 
							 array( 'Upload_DateTs' => date('Y-m-d H:i:s'), 'Upload_ById'     => $this->cok->field('UserId')));
		
		$this->callbackMsg = array( 'success' => $this->success, 'mesages' => $this->callbackUpl );	
	}
		
 }
  
  // like this;
  // update cache source data from [database]
  if( property_exists($this, 'UpdateCache' ) ){
	 $this->UpdateCache();
  } 
  
  // return callbackMsg 
	printf('%s', json_encode( $this->callbackMsg ) );
	return false;
	
 }
 
 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
function UpdateCache(){
	// update cache by options
	$cache = new Cache();
	$fread = Dropdown();
	
	// cache on all file upload 
	$resultArray = array();
	$cachename = sprintf('dropFileUpload'); 
	if( $resultArray = $fread->_getFileUpload() ){
		$cache->cache_update($cachename, $resultArray);
	}
	
	// cache on all recsource 
	$resultArray = array();
	$cachename = sprintf('dropRecsource'); 
	if( $resultArray = $fread->_getRecsource() ){
		$cache->cache_update($cachename, $resultArray);
	}
	
	// cache file recsource[] 
	$resultArray = array();
	$cachename = sprintf('dropFileRecsource'); 
	if( $resultArray = $fread->_getFileRecsource() ){
		$cache->cache_update($cachename, $resultArray);
	}
	
	// cache on all recsource 
	$cachename = sprintf("dropFileRecsourceTrans.%s", date('Ymd'));
	$resultArray = array();
	if( $resultArray = $fread->_getFileRecsource() ){
		$cache->cache_update($cachename, $resultArray);
	}
	return 0;
} 
 
 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 function UpdateData() {
	
  $this->dates 	  = date('Y-m-d H:i:s'); 
// pre define all object variable on modul bucket upload 
// for properies .

  $this->success 	= 1;  
  $this->failed 	= 0;
  
// pre define all object variable on modul bucket upload 
// for properies .

  $this->fls = FL(); 
  $this->out = UR();  
  $this->cok = CK();	
  
// --- out add -- test 
  
  $this->out->add('recsource', date('YmdHis'));
  
// pre define all object variable on modul bucket upload 
// for properies .
  $this->ar_val_extn = array( EXCEL, TEXT, CSV );
  $this->ar_val_data = $this->out->get_value();
  
  $this->ar_val_file = $this->fls->get_value();
 
 // konversi data ke bentuk asli process 
  
  $result_array = array();
  if( is_array($this->ar_val_file) 
  and isset($this->ar_val_file['fileTorefresh'] ) ){
	  
	 foreach( $this->ar_val_file['fileTorefresh'] as $key => $val ){
		$result_array['fileToupload'][$key] = $val;
	 } 
  }
  // reset on here .
  $this->ar_val_file = array();
  $this->ar_val_file = $result_array;
  
 // nilai default untuk setiap process upload 
 
 
   $this->callbackMsg = array( 'success' => $this->failed, 
							   'mesages'=> 'File Not Found');
	
// ubah variable array ke bentuk object 	untuk 
// di process lebih lanjut.
   $this->stm = $this->fls->field('fileTorefresh', 'Objective');
 
 // cek validation 
  if( is_object( $this->fls ) and ( !$this->stm->find_value('name')  OR !$this->out->find_value('recsource') ) )   {
	   $this->callbackUpl = 'Form upload not complete.';	
	   $this->callbackMsg = array( 'success' => $this->failed, 
								   'mesages' => $this->callbackUpl);	
	   
	   printf('%s', json_encode( $this->callbackMsg) );
	   return false;
   }
   
 // panggil modul template untuk process cek file 
 // berdasarkan template .
 
  $this->upl =& Singgleton('M_Upload');
  $this->tpl =& Singgleton('M_Template');
  
 // get detail row of template . 
  $this->cmp = array( 'CampaignId' => $this->out->field('refresh_campaignId') , 
					  'TemplateId' => $this->out->field('refresh_template') ); 
	
 // var_dump($this->cmp);	
 // cek apakah data berisi array ?
 
  if( !is_array( $this->cmp ) ){
	printf('%s', json_encode( $this->callbackMsg) );
	return false;
  }

// next process berikutnya . convert data ke dalam bentuk object 
// class helper.

 $this->tpo = Objective( $this->cmp );
 
 if( !$this->tpo->find_value('TemplateId') ){
	printf('%s', json_encode( $this->callbackMsg) );
	return false;
 }
 
 
// ambil detail template -nya && extension yang di maksud oleh 
// data upload .

 $this->type = $this->stm->field('name', 'pathinfo');
 $this->type = @call_user_func('Objective', $this->type);
 
 
 $this->tdb = $this->tpl->_getDetailTemplate( $this->tpo->field('TemplateId') );
 $this->ext = $this->type->field('extension', 'strtoupper');  
 
// ambil detail template -nya && extension yang di maksud oleh 
// data upload .  

  $this->tpd = Objective( $this->tdb); 
  
// cek validation dari extension file tersebut  
  
  if( is_null( $this->ext ) ){
	printf('%s', json_encode( $this->callbackMsg) );
	return false;
  }
  
// lanjut ke process berikutnya . this will default of message callbackUpl
 $this->callbackUpl = null;
 
 // jika bukan ke 2 type file ini.
  
  if( !in_array( $this->ext,  $this->ar_val_extn ) ) 
 {
	 $this->callbackUpl = 'File extension no suported.';
	 $this->callbackMsg = array( 'success' => $this->failed, 
								 'mesages' => $this->callbackUpl );
	 
	 // return 
	 printf('%s', json_encode( $this->callbackMsg) );
	 return false;
	 
 }
  
 // jika data yang akan di upload tidak masuk terlebih dahule ke table
 // bucket customer melainkan ke table yang sudah di tentukan oleh user .
 //debug($this->tpd);
  if( $this->tpd->find_value('TemplateBucket') 
   and (  !strcmp($this->tpd->field('TemplateBucket'), 'N') OR 
		  !strcmp($this->tpd->field('TemplateBucket'), 'Y') ) )  
{
	
	// set parameter tambahan disini .
	
	$this->param = array( 'TemplateId'  => $this->tpo->field('TemplateId'), 
						  'recsource'   => $this->out->field('recsource'));
							
	// kemudian akan di sesuikan berdasarkan kondisi 
	// berikut ini. INSERT|UPDATE
	
	$this->tpm = $this->tpd->field('TemplateMode','strtoupper');
	 
	// jika kondisi yang di minta adalaha insert 
	// ketable yang dimaksud
	
	
	if((!strcmp( $this->tpm, 'INSERT') OR !strcmp( $this->tpm, 'UPDATE'))) {
		
	// this update ONLY Not Functionality for update Or Insert Becase 
	// Global Method Like This;	
	
		$this->callbackUpl = $this->upl->setUpdateUpload( array( 'file_attribut' => $this->ar_val_file, 'request_attribut'  => $this->param ),
														   array( 'Upload_DateTs' => $this->dates, 		 'Upload_ById'       => $this->cok->field('UserId')));
		
		$this->callbackMsg = 	array(  'success' => $this->success, 'mesages' => $this->callbackUpl );		
	} 	
		
 }
  
 // return callbackMsg 
  printf('%s', json_encode( $this->callbackMsg ) );
  return FALSE;
  
}
 
 
 

// M_Template::_get_template_by_campaign(
/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  function UploadReguler() 
 {
	

// pre define all object variable on modul bucket upload 
// for properies .

  $this->success 	= 1;  
  $this->failed 	= 0;
  
// pre define all object variable on modul bucket upload 
// for properies .

  $this->fls = FL(); $this->out = UR();  $this->cok = CK();	
  $this->out->add('recsource', date('YmdHis'));
 // pre define all object variable on modul bucket upload 
// for properies .
  $this->ar_val_extn = array( EXCEL, TEXT, CSV );
  $this->ar_val_data = $this->out->get_value();
  $this->ar_val_file = $this->fls->get_value();
 
 // nilai default untuk setiap process upload 
 
 
   $this->callbackMsg = array('success' => $this->failed, 'mesages'=> 'File Not Found');
	
// ubah variable array ke bentuk object 	untuk 
// di process lebih lanjut.

   $this->stm = $this->fls->field('fileToupload', 'Objective');
   
 // cek validation 
   if( is_object( $this->fls ) and ( !$this->stm->find_value('name')  OR 
		!$this->out->find_value('recsource') ) ) 
	{
	   $this->callbackUpl = 'Form upload not complete.';	
	   $this->callbackMsg = array( 'success' => $this->failed, 
								   'mesages' => $this->callbackUpl);	
	   
	   printf('%s', json_encode( $this->callbackMsg) );
	   return false;
   }
   
 // panggil modul template untuk process cek file 
 // berdasarkan template .
 
  $this->upl =& Singgleton('M_Upload');
  $this->tpl =& Singgleton('M_Template');
  
 // get detail row of template . 
  $this->cmp = array('CampaignId' => 0, 'TemplateId' => $this->out->field('TemplateId') ); 
					 
 // cek apakah data berisi array ?
 
  if( !is_array( $this->cmp ) ){
	printf('%s', json_encode( $this->callbackMsg) );
	return false;
  }

// next process berikutnya . convert data ke dalam bentuk object 
// class helper.

 $this->tpo = Objective( $this->cmp );
 
 if( !$this->tpo->find_value('TemplateId') ){
	printf('%s', json_encode( $this->callbackMsg) );
	return false;
 }
 
 
// ambil detail template -nya && extension yang di maksud oleh 
// data upload .

  $this->tdb = $this->tpl->_getDetailTemplate( $this->tpo->field('TemplateId') );
  $this->ext = $this->_getFileName();
  
// ambil detail template -nya && extension yang di maksud oleh 
// data upload .  
  $this->tpd = Objective( $this->tdb); 
  
// cek validation dari extension file tersebut  
  
  if( is_null( $this->ext ) ){
	printf('%s', json_encode( $this->callbackMsg) );
	return false;
  }
  
// lanjut ke process berikutnya . this will default of message callbackUpl
 $this->callbackUpl = null;
 
 // jika bukan ke 2 type file ini.
 
  if( !in_array( $this->ext,  $this->ar_val_extn ) ) 
 {
	 $this->callbackUpl = 'File extension no suported.';
	 $this->callbackMsg = array('success' => $this->failed, 'mesages' => $this->callbackUpl );
	 
	 // return 
	 printf('%s', json_encode( $this->callbackMsg) );
	 return false;
	 
 }
 
 
 // jika data yang akan di upload tidak masuk terlebih dahule ke table
 // bucket customer melainkan ke table yang sudah di tentukan oleh user .
 
  if( $this->tpd->find_value('TemplateBucket') 
   and (  !strcmp($this->tpd->field('TemplateBucket'), 'N') OR 
		  !strcmp($this->tpd->field('TemplateBucket'), 'Y') ) )  
{
	
	// set parameter tambahan disini .
	
	$this->param = array( 'TemplateId'  => $this->tpo->field('TemplateId'), 
						  'recsource'   => $this->out->field('recsource'));
							
	// kemudian akan di sesuikan berdasarkan kondisi 
	// berikut ini. INSERT|UPDATE
	
	$this->tpm = $this->tpd->field('TemplateMode','strtoupper');
	
	// jika kondisi yang di minta adalaha insert 
	// ketable yang dimaksud.
	
	
	if(!strcmp( $this->tpm, 'INSERT')) {
		$this->callbackUpl = $this->upl->setRegulerUpload( 
							 array( 'file_attribut' => $this->ar_val_file, 'request_attribut' => $this->param ), 
							 array( 'Upload_DateTs' => date('Y-m-d H:i:s'), 'Upload_ById'     => $this->cok->field('UserId')));
		
		$this->callbackMsg = array( 'success' => $this->success, 'mesages' => $this->callbackUpl );		
	} 	
	
	// jika kondisi yang di minta adalaha insert 
	// ketable yang dimaksud.
	
	if(!strcmp( $this->tpm, 'UPDATE')) {
		$this->callbackUpl = $this->upl->setRegulerUpload( 
							 array( 'file_attribut' => $this->ar_val_file, 'request_attribut' => $this->param ), 
							 array( 'Upload_DateTs' => date('Y-m-d H:i:s'), 'Upload_ById'     => $this->cok->field('UserId')));
		
		$this->callbackMsg = array( 'success' => $this->success, 'mesages' => $this->callbackUpl );	
	}
		
 }
  
  // return callbackMsg 
	printf('%s', json_encode( $this->callbackMsg ) );
	return false;
	
 }
 
 /*
 * EUI :: Upload Manual() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */	
 
 function ManualUpload()
 {
	if( !_get_is_login() ) {
		exit(0);
	}
	
	$Template = array('Template' => $this -> {base_class_model($this)} ->_get_template() );
	$this -> load -> view("mgt_bucket_data/view_bucket_page", $Template);
		
 }
 
// ----------------------------------------------------------------------------------

/*
 * @ package 		distribute from bucket saveByAmount() 
 *
 * @ def			function get detail content list page 
 * @ param			not assign parameter
 */	
  
  public function saveByAmount()
{
// -------- call object -------------------
	$out =new EUI_Object( _get_all_request() );
	
	$_success = array('success'=>0, 'mesages' => '0');
	if( !$out->fetch_ready() ){
		echo json_encode( $_success );
		return false;	
	}
	
// -------------------------next off process data distribute ----------------------------------

	$vars_array = array 
  (
		'AmountSize' 	=> $out->get_value('amount_size'),  
		'AmountAssign' 	=> $out->get_value('amount_assign'),  
		'AssignStatus' 	=> $out->get_value('assign_status'),  
		'CampaignId' 	=> $out->get_value('campaign_name'), 
		'FilenameId' 	=> $out->get_value('fileupload'), 
		'StartDate' 	=> $out->get_value('start_date'),  
		'EndDate' 		=> $out->get_value('end_date') 
	);
	
// ---------- if class Exist from this ---------------------------------------------------
	
	if(class_exists('M_ModDistribusi'))
	{
		$objClass =& get_class_instance('M_ModDistribusi');
		$message= $objClass->_setDistribusi($vars_array ,'saveByAmount');
		
		if( !is_null($message) OR is_array($message) ) {
			$_success = array('success'=>1, 'mesages' => $message );
		} 
	}
	
	echo json_encode($_success);
}

// ----------------------------------------------------------------------------------

/*
 * @ package 		distribute from bucket saveByAmount() 
 *
 * @ def			function get detail content list page 
 * @ param			not assign parameter
 */	
  
  
 public function saveByAmountATM()
{
	$_success = array('success'=>0, 'mesages' => '0');
	
	$post = array
	(
		'AmountSize' => ($this -> URI->_get_have_post('amount_size') ? $this -> URI->_get_post('amount_size') : false ),
		'AmountAssign' => ($this -> URI->_get_have_post('amount_assign') ? $this -> URI->_get_post('amount_assign') : false ),
		'AssignStatus' => ($this -> URI->_get_have_post('assign_status') ? $this -> URI->_get_post('assign_status') : false ),
		'CampaignId' => ($this -> URI->_get_have_post('campaign_name') ? $this -> URI->_get_post('campaign_name') : false ),
		'FilenameId' => ($this -> URI->_get_have_post('fileupload') ? $this -> URI->_get_post('fileupload') : false ),
		'StartDate' => ($this -> URI->_get_have_post('start_date') ? $this -> URI->_get_post('start_date') : false ),
		'EndDate' => ($this -> URI->_get_have_post('end_date') ? $this -> URI->_get_post('end_date') : false ),
		'atm' => ($this -> URI->_get_have_post('atm') ? $this -> URI->_get_post('atm') : false )
	);
	
	if(class_exists('M_ModDistribusi'))
	{
		$total_data = $this ->M_ModDistribusi ->_setDistribusi($post,'saveByAmountATM');
		if( $total_data > 0 )
		{
			$_success = array('success'=>1, 'mesages' => $total_data );
		} 
	}
	
	echo json_encode($_success);
}

 
/*
 * EUI :: SaveByChecked() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */	

function SaveByChecked()
{	
	$_success = array('success'=>0, 'mesages' => '0');
		
	if( $this -> EUI_Session -> _have_get_session('UserId') )
	{ 
		$post = array (
			'CampaignId' => $this -> URI->_get_post('campaign_id'),
			'BucketId' => $this -> URI -> _get_array_post('ftp_list_id')	
		);
		
		if(class_exists('M_ModDistribusi'))
		{
			$total_data = $this ->M_ModDistribusi ->_setDistribusi($post,'saveByChecked');
			if( $total_data > 0 )
			{
				$_success = array('success'=>1, 'mesages' => $total_data );
			} 
		}
	}
	
	echo json_encode($_success);
	
}

// -----------------------------------------------------------

/* 
 * Method 		Role 
 *
 * @pack 		metjode 
 * @param		testing all 
 * @notes		must be exist if have button attribute role
 */

 
function PageBucketData()
{
	
  $this->start_page = 0;
  $this->per_page   = 10;
  $this->dataURI	= UR();
  
 // ---------- customize page data ------------------------ 
  if( $this->dataURI->field('frm_bucket_record') ){
	$this->per_page = _get_post('frm_bucket_record');
  }	 	  
  
 // ------------- then result data ---------------------------------
 
  $this->post_page  = $this->dataURI->field('page','intval');
  $this->post_stdr  = Singgleton($this);
  $this->arr_result = array();
  
 // get pager data on live Query 
  if( $this->post_page) {
	$this->start_page = (($this->post_page-1)*$this->per_page);
  } else {	
	$this->start_page = 0;
  }
  
  // optimize select data tidak disimpan di array agar process 
  // lebih cepat 
  
  $this->arr_result = $this->post_stdr->_select_row_bucket_page(UR(), null, $this);
  $this->tot_result = $this->post_stdr->_select_row_bucket_counter(UR());
  $this->page_counter = ceil($this->tot_result/ $this->per_page);
 
 // sent data to view proces on client not data 'table'
 $this->load->view("mgt_bucket_data/view_bucket_row_page", array(
	'content_pages' => $this->arr_result,
	'total_records' => $this->tot_result,
	'total_pages'   => $this->page_counter,
	'select_pages'  => $this->post_page,
	'start_page' 	=> $this->start_page
  ));	
 
}


 // -----------------------------------------------------------

/* 
 * Method 		Role 
 *
 * @pack 		metjode 
 * @param		testing all 
 * @notes		must be exist if have button attribute role
 */
 
public function Submit()
{
  if( !_get_is_login() ){
	echo_json_encode(0); 
	return FALSE;
  }

 $cond = array('success' => 0 , 'row' => null );
 $out = _find_all_object_request();
 if( !$out->find_value('frm_bucket_user_action') ){
	echo_json_encode(0); 
	return FALSE;	
 }
 
 //var_dump($out->get_value('frm_bucket_user_action'));
 
// ---------- on act quantity ---------------------
 if( $out->get_value('frm_bucket_user_action') == 1 ){
	$ar_bool = get_class_instance(base_class_model($this))->_set_row_buket_quantity( $out );
 }

// ---------- on act checked ---------------------
 if( $out->get_value('frm_bucket_user_action') == 2 ){
	$ar_bool = get_class_instance(base_class_model($this))->_set_row_buket_checked( $out ); 
 }
 
 if( is_array( $ar_bool ) )
 {
	echo json_encode(array(
		'success' => 1, 
		'row' => $ar_bool
	)); 
	
	return FALSE;	
 }
 
 echo_json_encode( 0 ); 
 // return --> 	
}

 // -----------------------------------------------------------

/* 
 * Method 		Role 
 *
 * @pack 		metjode 
 * @param		testing all 
 * @notes		must be exist if have button attribute role
 */
 
 public function Role()
{
	$out= _find_all_object_request();
	$arr_role_toolbars = array();
	if( $out->find_value('modul') )  {
		$arr_role_toolbars = $this->M_UserRole->_select_role_menu_toolbar( $out->get_value('modul'));
	}
    echo json_encode( $arr_role_toolbars );
 }
 
// ======================= END CLASS =========================================

}

?>
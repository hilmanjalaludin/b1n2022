<?php
/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
 
class SetProductScript extends EUI_Controller
{
 
/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
 
 function __construct()
 {
	parent::__construct();
	display(0);
	$this->load->model( array( base_class_model($this)) );
	$this->load->helper(array('EUI_Object'));
	
 }
/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
 
 function index()
 {
	if( $this ->EUI_Session -> _have_get_session('UserId') )
	{
		$_EUI['page'] = $this -> {base_class_model($this)} -> _get_default();
		if( is_array($_EUI) ) 
		{
			$this -> load -> view('set_product_script/view_product_script_nav',$_EUI);
		}	
	}	
 }
 
/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
 
function Content()
 {
	if( $this -> EUI_Session -> _have_get_session('UserId') )
	{
		$_EUI['page'] = $this->{base_class_model($this)} -> _get_resource();    // load content data by pages 
		$_EUI['num']  = $this->{base_class_model($this)} -> _get_page_number(); // load content data by pages 
		if( is_array($_EUI) 
		   AND is_object($_EUI['page']) )  
		{
			$this -> load -> view('set_product_script/view_product_script_list',$_EUI);
		}	
	}	
 }
/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
 
private function _getProductName()
{
	$Data = $this ->M_SetProduct->_getProductId();
	if( is_array($Data) )
	{
		foreach( $Data as $k => $p )
		{
			$_conds[$k] = $p['name']; 
		}
	}
	
	return $_conds;
}
 
/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
 
 function AddScript()
 {
	$UI  = array
	(
		'ProductName' => $this->_getProductName(),
		'Active'=> $this ->M_SetPrefix->_get_status_prefix()
	);
	
	$this -> load -> view("set_product_script/view_product_script_add",$UI);
 }


/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
 
function _is_type( $t )
{
	$_conds = false;
	
	$_type = explode('.', $t);
	$_array = array ('txt','pdf','doc', 'docs');
	
	if( in_array( strtolower($_type[count($_type)-1]), $_array )) 
		$_conds = true;
		
	return $_conds;	
} 

/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
 
 
function Upload()
{
	
// ambil semua attribuet data -nya 
	$this->dataFILE = FL();
	$this->dataURI = UR();
	$this->dataCOK = CK();
	
// return to callback Data User .
 $this->callBackMsg = array('success' => 0 );
 if( !$this->dataFILE->find_value('ScriptFileName') ){
	printf('%s', json_encode($this->callBackMsg)); 
	return false;
 }
 
 // get attribuet data OBJECT 
 
 $this->dataFLATTR =  $this->dataFILE->field('ScriptFileName', 'Objective');
 if( !$this->dataFLATTR->find_value('name') ){
	printf('%s', json_encode($this->callBackMsg)); 
	return false; 
 }
 
 // define my path upload data 
 $dataFiletoUploadPath = sprintf("%s/application/script/%s", rtrim(BASEPATH,'/system'), $this->dataFLATTR->field('name'));
 if( file_exists($dataFiletoUploadPath)){
	 @unlink($dataFiletoUploadPath);
 }
 
 // kemudian masukan ke folder script.
 if( !move_uploaded_file($this->dataFLATTR->field('tmp_name'),  $dataFiletoUploadPath) ){
	printf('%s', json_encode($this->callBackMsg)); 
	return false; 
 }
 
 
 // call lisb db 
 // jika processs pindah OK kemudian generate lagi 
 
 $this->dataCTR = Singgleton($this);
 if( !is_object($this->dataCTR)){
	printf('%s', json_encode($this->callBackMsg)); 
	return false;
 }
 // position data 
 $this->dataRow = $this->dataCTR->_setUpload($this->dataURI, $this->dataFILE );
 if( $this->dataRow ){
	$this->callBackMsg = array('success' => 1 ); 
 }
 
 // return to client Request JSON .
 printf('%s', json_encode($this->callBackMsg)); 
 return false;
	
 // lanjutkan ke process berikut ini .
 // debug($this->dataFILE);
	
	// $_result = array('success'=>0);
	// if( isset($_FILES['ScriptFileName'])) 
	// {
		// $_Data = $this -> URI -> _get_all_request();
		// if( $this -> _is_type($_FILES['ScriptFileName']['name']) ) 
		// {
			// if( move_uploaded_file($_FILES['ScriptFileName']['tmp_name'], APPPATH .'script/'.$_FILES['ScriptFileName']['name']))
			// {
				// if( $this->{base_class_model($this)}->_setUpload( array('post_data' => $_Data, 'post_files' => $_FILES ) )) 
				// {
					// $_result = array( 'success' => 1 );
				// }
			// }
		// }	
	// }
	
	// echo json_encode($_result);
	
}
/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
 
 
function SetActive()
{
	$_result = array('success'=>0); $_Data = array();
	if( $this -> URI->_get_have_post('ScriptId') ) 
	{
		$_Data['ScriptId'] = $this -> URI -> _get_array_post('ScriptId');
		$_Data['Flags'] = $this -> URI -> _get_post('Active');
		if( isset($_Data['ScriptId']))
		{
			if( $this ->{base_class_model($this)}->_setActive($_Data) )
			{
				$_result = array('success'=>1);
			}
		}
	}
	
	echo json_encode($_result);
	
} 
/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function Delete()
{
	$_result = array('success'=>0); $_Data = array();
	if( $this -> URI->_get_have_post('ScriptId') ) 
	{
		$_Data['ScriptId'] = $this -> URI -> _get_array_post('ScriptId');
		if( isset($_Data['ScriptId']))
		{
			if( $this ->{base_class_model($this)}->_setDelete($_Data) )
			{
				$_result = array('success'=>1);
			}
		}
	}
	
	echo json_encode($_result);
	
} 

/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 public function getScript()
{
	
//   test data -----------------------
 $result_assoc =& Singgleton($this);
 $result_array = array();
 
 // get call this this object  
 if( !CK()->field('UserId') ) {
	echo json_encode($result_array);
	return false;
 }
 
 // if jika null ;
 
	$CampaignId = UR()->field( 'CampaignId', 'intval' );
	$result_array = $result_assoc->_getScript( $CampaignId );

// get data array 
 
	echo json_encode($result_array);
	return false;
	
}
/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
 
function ShowProductScript() {
 $this->out = UR();
 
 if( !$this->out->find_value('ScriptId') )  {
	exit('No ScriptId');
 }
// sent to view process .
$this->std = Singgleton($this);//& get_class_instance(base_class_model($this));

$this->load->view("set_product_script/view_product_show", array (
	'Data' => $this->std->_getDataScript( $this->out->field('ScriptId', 'base64_decode'))
	));
	
}

 // ========================================================= END CLASS =========================================================
 
}
?>
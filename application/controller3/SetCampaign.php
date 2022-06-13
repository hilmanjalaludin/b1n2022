<?php

/*
 * E.U.I 
 *
 
 * subject	: get SetCampaign modul 
 * 			  extends under EUI_Controller class
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/model/sysuser/
 */
 
class SetCampaign extends EUI_Controller
{
	
/*
 * EUI :: index() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */	
 
 function __construct() {
	parent::__construct();
	$this->load->model(array("M_SetCampaign","M_Utility","M_ModOutBoundGoal","M_SetProduct"));
	$this->load->helper(array('EUI_Object'));
 }
 
/*
 * EUI :: index() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */	
 
function index()
{

 if( $this -> EUI_Session -> _have_get_session('UserId'))
 {
	$EUI['page'] = $this -> M_SetCampaign -> _get_default();
	$this -> load -> view('set_campaign/view_campaign_nav', $EUI );
 }
 
}

/*
 * EUI :: Content() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */

function Content()
{
 if( $this -> EUI_Session -> _have_get_session('UserId'))
 {
	$EUI['page'] = $this->{base_class_model($this)}->_get_resource_query(); // load content data by pages 
	$EUI['num']  = $this->{base_class_model($this)}->_get_page_number(); 	// load content data by pages 
	$EUI['size'] = $this->{base_class_model($this)}->_get_size_campaign();
	
	$this -> load -> view('set_campaign/view_campaign_list', $EUI );
 }
}

/*
 * EUI :: Content() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */
	
function Add()
{
	if(!_have_get_session('UserId') )  {
		return false;
	}
	$this->load->view('set_campaign/view_campaign_add',array());
}


/*
 * EUI :: Content() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */
	
 public function Edit()
{	
	if(!_have_get_session('UserId'))  {
		return false;	
	}
	
	$vars =new EUI_Object( _get_all_request() );
	if( !$vars->fetch_ready() ) { return false; }
	
 // ------------------ sent output data to view --------------------------------------------------------
 
	$objRes =& get_class_instance('M_SetCampaign');
	$objPro =& get_class_instance('M_SetProduct');
	
 // ------------------ sent output data to view --------------------------------------------------------
	
	$CampaignList = $objRes->getAttribute( $vars->get_value('CampaignId') );
	$ProductList = $objPro->_getProductCampaignId($vars->get_value('CampaignId'));
	$PayTypeList = $objPro->_getCampaignChannel($vars->get_value('CampaignId'));
	
 // ------------------ sent output data to view --------------------------------------------------------
  
	$this -> load -> view('set_campaign/view_campaign_edit', array(
		'row' => new EUI_Object($CampaignList),
		'ProductList' => $ProductList,
		'PaymentList' => $PayTypeList
	));
	
	//'Utility'=> $this -> M_Utility,
		//'OutboundGoals' => $this ->M_ModOutBoundGoal->_getOuboundGoals(),
		//'ProductCampaign' => $this->M_SetProduct->_getProductCampaignId($this -> URI->_get_post('CampaignId')),
		//'Campaign' => $objRes->getAttribute(_get_post('CampaignId'))
		// 'Action' => $this->{base_class_model($this)}->_getMethodAction(), 
		// 'Method' => $this->{base_class_model($this)}->_getMethodDirection(),
		// 'Avail' => $this->{base_class_model($this)}->_getCampaignGoals(2),
		//'PaymentChannelList' => $this->M_SetProduct->_getCampaignChannel($this -> URI->_get_post('CampaignId'))
	//));
}

/*
 * EUI :: Content() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */
	
function EditTarget()
{
	if( $this -> EUI_Session -> _have_get_session('UserId')) 
	{
		//$alias_str_list = $this->M_SetCampaign->_getAliasFieldList($this -> URI->_get_post('CampaignId'));
		$UI = array
		(
			'Campaign' => $this->{base_class_model($this)}->getAttribute( $this -> URI->_get_post('CampaignId')),
			'Target' => $this->{base_class_model($this)}->getTarget( $this -> URI->_get_post('CampaignId'))
		); 
		$this -> load -> view('set_campaign/view_campaign_target',$UI);

	}
}

/*
 * EUI :: Content() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */

 public function SaveTarget()
{
	$_conds = array("success"=>0);
	$param = $this -> URI -> _get_all_request();
	if( isset( $param ) AND count($param) > 0 ) 
	{
		if( $this->{base_class_model($this)}->set_save_event_target( $param ) )
		{
			$_conds = array("success" => 1);
		}
	}
	
	echo json_encode($_conds);
}

/*
 * EUI :: Content() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */

function View()
{
	$_post_data = $this -> URI -> _get_array_post("CampaignId");
	if(is_array($_post_data)) 
	{
		$data = array("result" => $this ->{base_class_model($this)}-> _getDataCampaignId($_post_data) );
		$this -> load -> view('set_campaign/view_campaign_views',$data);
	}
}


/*
 * EUI :: Content() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */

function Manage()
{
	if( $this -> EUI_Session -> _have_get_session('UserId')) {
		$UI = array
		(
		'Method' => $this->{base_class_model($this)}->_getMethodDirection(),
		'AvailOut' => $this->{base_class_model($this)}->_getCampaignGoals(2),
		'AvailIn' => $this->{base_class_model($this)}->_getCampaignGoals(1)
		); 
		$this -> load -> view('set_campaign/view_manage_campaign',$UI);
	}
}


/*
 * EUI :: Export() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */
	
	
function Export()
{

 $_post_data = $this -> URI -> _get_array_post("CampaignId");
 
 if(is_array($_post_data) AND is_array($_post_data))
 {
	$data = array("result" => $this ->{base_class_model($this)}-> _getDataCampaignId($_post_data) );
	$this -> load -> view('set_campaign/view_campaign_export',$data);
 }
 
}


/*
 * EUI :: SaveCampaign() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */
	
 public function Update()
{
	
 $cond = array('success'=> 0, 'error'=> ''); 
 if( !_have_get_session('UserId') ) { 
	return false;	
 }
	
// -------------------------------------------------------------- 	

  $obj =& get_class_instance('M_SetCampaign');
  $out =new EUI_Object( _get_all_request() );
 
  if( $obj->_set_event_update_campaign( $out ) ){
	$files = array('cache_dropcampaignid.json', 'cache_dropProductByCampaignID.json');
	
	$old ='cache_dropcampaignid.json';
	$old1 ='cache_dropProductByCampaignID.json';
	foreach ($files as $file) {
		chmod('/var/www/html/development/bni10092021/system/cache/',0777);
		$path = "/var/www/html/development/bni10092021/system/cache/".$file;
		$data = unlink($path);
		chmod($path, 0777);
	}
	$cond = array('success'=> 1, 'result' => $data );
  }
  
  echo json_encode($cond);
}


/*
 * EUI :: SaveCampaign() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */
	
 public function Submit()
{
	
 $cond = array('success'=> 0, 'error'=> ''); 
 if( !_have_get_session('UserId') ) { 
	return false;	
 }
	
// -------------------------------------------------------------- 	

  $obj =& get_class_instance('M_SetCampaign');
  $out =new EUI_Object( _get_all_request() );
 
  if( $obj->_set_save_campaign( $out ) ){
	$files = array('cache_dropcampaignid.json', 'cache_dropProductByCampaignID.json');
	
	$old ='cache_dropcampaignid.json';
	$old1 ='cache_dropProductByCampaignID.json';
	foreach ($files as $file) {
		chmod('/var/www/html/development/bni10092021/system/cache/',0777);
		$path = "/var/www/html/development/bni10092021/system/cache/".$file;
		$data = unlink($path);
		chmod($path, 0777);
	}
		$cond = array('success'=> 1, 'result' => $data );
	
  }
  
  echo json_encode($cond);
}


/*
 * EUI :: SaveCampaign() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */
 
 public function Delete()
{
  
  $cond = array('success'=> 0, 'error'=> ''); 
  if( !_have_get_session('UserId') ) { 
	return false;	
  }
	
// -------------------------------------------------------------- 	

  $obj =& get_class_instance('M_SetCampaign');
  $out =new EUI_Object( _get_all_request() );
 
  if( $obj->_set_event_delete_campaign( $out ) ){
	 $cond = array('success'=> 1 ); 	
  }
  
  echo json_encode($cond);
}	

/*
 * EUI :: getDataInbound() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */
	
function getDataInbound()
{
	$_success = array('success'=> 0, 'data'=> 0 ); 
	
	if( $this -> EUI_Session->_have_get_session('UserId'))
	{
		$data = $this -> {base_class_model($this)}->_getDataInbound($this -> URI->_get_post('CampaignId'));
		if( !is_null($data) 
			AND (INT)$data > 0 )
		{
			$_success = array('success'=> 1, 'data'=> $data ); 
		}	
	}
	
	echo json_encode($_success);
}

/*
 * EUI :: ManageCampaign() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */
function ManageCampaign()
{
	$_success = array('success'=> 0); 
		
	if( $this -> EUI_Session->_have_get_session('UserId'))
	{
		$parameter = $this->URI->_get_all_request();
		if( is_array($parameter))
		{
			$jumlah = $this->{base_class_model($this)}->_setManageCampaign($parameter);
			
			if($jumlah)
			{
				$_success = array('success'=>1, 'data' => $jumlah);
			}
		}	
	}
	
	echo json_encode($_success);
}

	
}
 // ================ END CLASS =========================

?>
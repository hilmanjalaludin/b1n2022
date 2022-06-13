<?php
/*
 * E.U.I 
 *
 
 * subject	: get model data for SysUser 
 * 			  extends under Controller class
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/controller/sysuser/
 */
 
class SetUpload extends EUI_Controller
{

// ---------------------------------------------------------------------	
/*
 * @ package : 	
 * ---------------------------------------------------------------------
 *
 * @ param 	 :  
 * @ param 	 :  
 */
 public function __construct()
{
	parent::__construct();
	//display(1);
	$this->load->model(base_class_model($this));
	$this->load->helper(array('EUI_Object')); 
	
 }
 
// ---------------------------------------------------------------------	
/*
 * @ package : 	
 * ---------------------------------------------------------------------
 *
 * @ param 	 :  
 * @ param 	 :  
 */
 
 public function index()
{
	if(! _have_get_session('UserId') ) {
		return false;
	}	
	
// ------------------ this page --------------------------------------------------

	$out =new EUI_Object('EUI_Object');
	$obj =& get_class_instance(base_class_model($this));
	
// ------------------ this page --------------------------------------------------
	
	$this->load->view('set_temp_upload/view_template_nav',array (
		'page' 		=> $obj->_get_default(),
		'plist' 	=> $obj->_get_list_tables(),
		'ModeType' 	=> $obj->_getTypeUpload(),
		'FileType' 	=> $obj->_getTypeFile()
	));
}
 
/*
 * @ def 		: content / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function Content()
 {
	if( $this -> EUI_Session -> _have_get_session('UserId') )
	{
		$_EUI['page'] = $this -> {base_class_model($this)} -> _get_resource();    // load content data by pages 
		$_EUI['num']  = $this -> {base_class_model($this)} -> _get_page_number(); // load content data by pages 
		if( is_array($_EUI) && is_object($_EUI['page']) )  
		{
			$this -> load -> view('set_temp_upload/view_template_list',$_EUI);
		}	
	}	
 }
 
/**
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
 function setTemplate()
 {
	//ambil semua url yang di post 
	
	$this->url = UR();
	
	// define data of ;fields 
	$this->fields = array();
	if( $this->url->find_value('tables') ){
		$this->fields = Singgleton($this)->_get_field_column( $this->url->field('tables') );
	}
	
// data process OK 	
	$this->result_array = array_slice($this->fields, 0, $this->url->field('total') );
	$this->result_assoc = $this->fields;
	
// type method 	"insert"
	if( !strcmp( $this->url->field('method', 'strtolower'), 'insert' )  ){
		$this->load->view('set_temp_upload/view_layout_upload', array(
			'fields' => $this->result_array,
			'select' => $this->result_assoc
		));
	}
// type method 	"update"
	
	if( !strcmp( $this->url->field('method', 'strtolower'), 'update' )  ){
		$this -> load -> view('set_temp_upload/view_layout_kupload',array(
			'fields' => $this->result_array,
			'select' => $this->result_assoc
		));
	}
	
 }


/**
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
 public function Create()
{

// ---------- load content model --------------------------------------
	
 if( !_have_get_session('UserId') ) {
	return false;
 }
 
// ---------- load content model --------------------------------------
 
 $this->row = Singgleton($this);
 $this->load->view('set_temp_upload/view_add_template',array(
	'page' 		=> $this->row->_get_default(),
	'plist' 	=> $this->row->_get_list_tables(),
	'ModeType' 	=> $this->row->_getTypeUpload(),
	'FileType' 	=> $this->row->_getTypeFile(),
	'LimitDays' => $this->row->_LimitDays(),
	'BlackList' => $this->row->_BlackList()
 ));
 
}
/**
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
 public function Submit()
{
	$this->cond = array('success'=> 0);	
	
	// get class object TPL 
	$this->tpl = Singgleton($this);
	$this->out = UR();
	
//jika mode insert yng dipilih 	
	if( !strcmp($this->out->field('mode_input'), 'insert')  
	&& $this->tpl->_submit_row_template( $this->out )) {
		$this->cond = array('success' => 1);
	}
		
//jika mode insert yng dipilih 	
	if( !strcmp( $this->out->field('mode_input'), 'update' ) 
	&& $this->tpl->_update_row_template( $this->out )) {
		$this->cond = array('success' => 1);
	}
	// return of response to client 
	echo json_encode( $this->cond );
	return false;
}

/**
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
 
 function DownloadTemplate()
 {
	// get all param data on her OK 
 $this->out  = UR();
 
 // then set on her 
 $this->result_array = array();
   
 if( !$this->out->field('TemplateId') ) {
	show_error("No have template ID ");
	exit(0);
 }
 
 // result_array 
  $this->tpl = Singgleton($this);
  
 // data process on here this OK 
  $this->result_array = $this->tpl->_get_name_template($this->out->field('TemplateId'));
  $this->result_templ = $this->tpl->_get_download_template($this->out->field('TemplateId'));
  
 // result_array row 
  $this->result_assoc = Objective( $this->result_array);
  $this->result_assoc->add('TemplateRow', $this->result_templ);
  
  // data Type "TXT"
  if( !strcmp( $this->result_assoc->field('TemplateFileType'), 'txt' ))  {
		$this->load->view('set_temp_upload/view_download_data_txt',array(
			'template' => $this->result_assoc->field('TemplateRow'),
			'filename' => $this->result_assoc->field('TemplateName'),
			'filetype' => $this->result_assoc->field('TemplateFileType'),
			'sparator' => $this->result_assoc->field('TemplateSparator')
		)); 
  }
  // data type "CSV" 
   if( !strcmp( $this->result_assoc->field('TemplateFileType'), 'csv' )) {
		$this->load->view('set_temp_upload/view_download_data_txt',array(
			'template' => $this->result_assoc->field('TemplateRow'),
			'filename' => $this->result_assoc->field('TemplateName'),
			'filetype' => $this->result_assoc->field('TemplateFileType'),
			'sparator' => $this->result_assoc->field('TemplateSparator')
		)); 
   }
   
   // data type "XLS" 
   
   if( !strcmp( $this->result_assoc->field('TemplateFileType'), 'xls' ))   {   
		$this->load->view('set_temp_upload/view_download_data_xls',array(
			'template' => $this->result_assoc->field('TemplateRow'),
			'filename' => $this->result_assoc->field('TemplateName'),
			'filetype' => $this->result_assoc->field('TemplateFileType'),
			'sparator' => $this->result_assoc->field('TemplateSparator')
		));  
  }
  
 }
/**
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
 function Enable()
 {
	$_conds = array('success' => 0 ); 
	if( $this -> URI -> _get_have_post('TemplateId'))
	{
		if( $this ->{base_class_model($this)}-> _set_active_template( 1, $this -> URI -> _get_post('TemplateId') ))
		{
			$_conds = array('success' => 1);	
		} 
	}
	
	echo json_encode($_conds);
 }
 
/**
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
 function Disable()
 {
	$_conds = array('success' => 0 ); 
	if( $this -> URI -> _get_have_post('TemplateId'))
	{
		if( $this ->{base_class_model($this)}-> _set_active_template(0, $this -> URI -> _get_post('TemplateId') ))
		{
			$_conds = array('success' => 1);	
		} 
	}
	
	echo json_encode($_conds);
 }
 
 
/**
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
 function Delete()
 {
	$result_conds = array('success' => 0 ); 
	$result_array = UR()->fields('TemplateId');
	
	// jika counter berisi  = 0 
	if( count( $result_array ) == 0 ) {
		echo json_encode( $result_conds );	
		return false;
	}
	
	// get data model list OK 
	$this->tpl = Singgleton($this);
	if( $this->tpl-> _delete_row_template( $result_array ) ) {
		$result_conds = array('success' => 1);	
	}
	
	// return data response OK 
	echo json_encode( $result_conds );	
	return false;
		
 }
 
 
/**
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */ 
}
?>
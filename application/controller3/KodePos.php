<?php 
/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
class KodePos extends EUI_Controller{
	
var $dataURI = null;	
/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
 
function __construct(){
  parent::__construct();
  display(0);
  
// get attr model && helper 
  $this->load->model(array(base_class_model($this)));
  $this->load->helper(array('EUI_Object'));
  
  // get URI DATA 
  $this->dataURI = UR(); 
 }
 /*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
 
 function index(){
	 
 }
 
 /*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
 
 function Search(){
	 
// ambil data uri  
 
 $this->dataCOK = CK();
 
 // then will the ceck client with server match 
 if( !$this->dataURI->find_value('user') ){
	exit('not valid data');
 }
 
 
 // bandingkan datanya 
 $this->fromCOK = $this->dataCOK->field('Username','strtoupper');
 $this->formURI = $this->dataURI->field('user', 'strtoupper');
 
 // jika sessui buka data header 
 
 if(!strcmp( $this->formURI, $this->formURI)){
	$this->load->view("mod_view_kodepos/view_kodepos_search",array()); 
 }  
}
  /*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
 
 function Pager(){
	 
	 
// get all reference data URI 
// from here 
 $this->dataURI = UR(); 
 
// define setup pager text .
 $this->result_array  = array();
 $this->result_content= array();
 
// data define default
$this->dataDFL = Objective( array());
	
// dd push data hahah 
 
 $this->dataDFL->add('start_page', 0);
 $this->dataDFL->add('per_page', 10);
	
// setup data pager 
 $this->start_page = $this->dataDFL->field('start_page','intval');
 $this->per_page   = $this->dataDFL->field('per_page','intval');
 $this->post_page  = $this->dataURI->field('page', 'intval');
  
  
// get my data class 
  $this->Instance = Singgleton($this);
  
 // untuk pagging maka hrus di konversi index 0 = 1 	
  if( $this->post_page) {
	  $this->start_page = (($this->post_page-1)*$this->per_page);
  } else {	
	  $this->start_page = 0;
  }
  
  
// then will process its.
  $this->result_totals = $this->Instance->_select_count_kode_pos( $this );
  $this->result_array = $this->Instance->_select_page_kode_pos( $this );
  
  
// jika data  -nya array dan sudah di set sebelumnnya.
// ok tampilkan ini .

// get all process to view <store> data user client 
 $this->result_counter = ceil( $this->result_totals/ $this->per_page);
 
// show detail pager on view data.
 $this->load->view( 'mod_view_kodepos/view_kodepos_pager', array(
	'content_pages' => $this->result_array,
	'total_records' => $this->result_totals,
	'total_pages'   => $this->result_counter,
	'select_pages'  => $this->post_page,
	'start_page' 	=> $this->start_page
  ));
  
}
 
 /*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
  
 
}
?>
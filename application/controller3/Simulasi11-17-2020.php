<?php 
/**
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
class Simulasi extends EUI_Controller {
/**
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 function __construct() 
{
	parent::__construct();	
	display(0);
	$this->load->model(array(base_class_model($this)));
	$this->load->helper(array('EUI_Object'));
	
}

/**
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
  public function index() {
	$this->load->view("mod_view_simulasi/view_main_simulasi");	 
 }
 
/**
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
 function Usage(){
	 
	 
// get all data URI 	
 $this->dataURI = UR(); 
 if( !$this->dataURI->find_value('ProgramId')  ){
	exit('program not found.');
 }
 
 // get my model process from program data 
 $this->dataPRG = $this->dataURI->field('ProgramId',array('strtolower') );
 $this->dataOBJ = sprintf("M_%s", ucfirst($this->dataPRG));
  
 if(!$this->dataOBJ ){
	exit('program not found.');
 }
 // get my model process from program data 
 $this->load->model(array( $this->dataOBJ ));
 if( !class_exists( $this->dataOBJ ) ){
	exit('program not found.'); 
 }
 
 // get row data from singgleton .
 $this->dataSGL = Singgleton($this->dataOBJ);
 $this->dataSRC = $this->dataSGL->_select_ver_master( $this->dataURI->field('VerifyId'));
 
 // debug($this->dataSRC);
 // then will open here 
 $this->load->view(sprintf("mod_view_simulasi/view_simulasi_%s_index", $this->dataPRG), array(
	'program' => ucfirst($this->dataPRG), 
	'dataheader' => $this->dataURI,
	'rowdata' => $this->dataSRC
 ));	 
 
}
 
 //http://192.168.10.236/bni-tele-ans/index.php/Simulasi/PagerXtradana
 /**
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
 function PagerXtradana(){
	 
	$URI = UR();
	
	$resultArrRate = array();
	$callculatorRate = $URI->fields('txJsRate');
	foreach( $callculatorRate as $key => $val ) {
		$resultArrRate[$val] = Call( $val, 'RateUsage');
	}
	// debug($resultArrRate);
	// var_dump($callculatorRate);
 
	if( in_array('all', array_keys($resultArrRate)) OR !count($resultArrRate) ){
		$resultArrRate = RateUsage();
		unset($resultArrRate['all']);
	}
	
	$callculatorTenor = $URI->fields('txJsTenor'); 
	if( is_array( $callculatorTenor) 
		and !count($callculatorTenor) ){
		$callculatorTenor = Tenor();
	}
	
	// then if in_array 
	$TX_Dana = $URI->field('txJsDana','SetNominal');
	//debug($callculatorRate);
	// default data to process on here 
	// var_dump($resultArrRate);
	
	$result_assoc = array();
	if( is_array( $resultArrRate ) ) 
	foreach( $resultArrRate as $TX_Key => $TX_Rate ) {
		
		// var_dump($TX_Key);
		// buat masing2 index 
		if(is_array($callculatorTenor))
		foreach( $callculatorTenor as $tenor_key  => $TX_Tenor ){	
	
			$TX_Pokok = round(($TX_Dana/$TX_Tenor));
			$TX_Bunga = round((($TX_Dana*$TX_Key)/100));
			$TX_Total = round(($TX_Pokok+$TX_Bunga));
			
			
			$result_assoc[$TX_Rate][$TX_Tenor]['TX_Tenor'] = Call( $TX_Tenor, 'trim');
			$result_assoc[$TX_Rate][$TX_Tenor]['TX_Rate']  = Call( $TX_Key,  'trim');
			$result_assoc[$TX_Rate][$TX_Tenor]['TX_Dana']  = Call( $TX_Dana,  'SetCurrency');
			$result_assoc[$TX_Rate][$TX_Tenor]['TX_Pokok'] = Call( $TX_Pokok, 'SetCurrency');
			$result_assoc[$TX_Rate][$TX_Tenor]['TX_Bunga'] = Call( $TX_Bunga, 'SetCurrency');
			$result_assoc[$TX_Rate][$TX_Tenor]['TX_Total'] = Call( $TX_Total, 'SetCurrency');
		}
	}
	
//	 debug($result_assoc);
	
	
	// debug($callculatorTenor);
	
	 
	$result_label = array(
		'TX_Rate'  => 'Rate',
		'TX_Dana'  => 'Dana ( Rp. )',
		'TX_Tenor' => 'Tenor',
		'TX_Pokok' => 'Pokok ( Rp. )',
		'TX_Bunga' => 'Bunga ( Rp. )',
		'TX_Total' => 'Total ( Rp. )' );
	
	//get list data process .
	// $Tx_Tenor = $URI->fields('txJsTenor');
	// if( is_array($Tx_Tenor) and count($Tx_Tenor)<1 ){
		// $Tx_Tenor = Tenor();
	// }
	
	// $Tx_Rate  = $URI->field('txJsRate');
	// $Tx_Dana  = $URI->field('txJsDana','SetNominal');
	
	//testing data OK Rows selected .
	// if( !$URI->field('txJsRate') ){
		// $Tx_Rate = '0';
	// }
	// $this->result_value = array();
	// if($URI->find_value('txJsDana') ) 
		// foreach( $Tx_Tenor as $RX_Num => $RX_Tenor )
	// {
		
	//global data 
		// $RX_Dana  = $Tx_Dana;
		// $RX_Rate  = $Tx_Rate;
		
	//spesifik 
		// $RX_Pokok = round( ($RX_Dana/$RX_Tenor) );
		// $RX_Bunga = round((($RX_Dana*$RX_Rate)/100) );
		// $RX_Total = ($RX_Pokok+$RX_Bunga);
		
		//set an array process test .
		
		// $this->result_value[$RX_Num] = array(
			// 'TX_Rate'  => sprintf("%s %%", $RX_Rate),
			// 'TX_Tenor' => $RX_Tenor,
			// 'TX_Dana'  => Call( $RX_Dana,  'SetCurrency'),
			// 'TX_Pokok' => Call( $RX_Pokok, 'SetCurrency'),
			// 'TX_Bunga' => Call( $RX_Bunga, 'SetCurrency'),
			// 'TX_Total' => Call( $RX_Total, 'SetCurrency')
			// );
	// }
	//print_r($result_assoc);
	
	$this->load->view("mod_view_simulasi/view_simulasi_xtradana_pager", 
		array( 'rowdata' => $result_assoc, 'label' => $result_label ));
	
		// 'label' => $this->result_label,
		// 'value' => $this->result_value,
	// ));
} 

/**
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
  
function Calculator( $Id = null  ){
	
 if( !$this->URI->segment(3) ){
 	printf("%s", "program not available");
	exit(0);
 }
	
// definisikan setiap variable untuk memungkinkan process 
// program lain seperti smart bill. 

 $programData = $this->URI->segment(3);
 $programUrl = &UR();
 

// process under function  
if(!strcmp($programData, 'XTRADANA' )  ){
	$this->process_callculator_xtradana( $programUrl );
 }elseif(!strcmp($programData, 'BALCON')){
	$this->process_callculator_balcon( $programUrl );
 }
 
}
function getDataValue( ){
	$programData = $this->URI->segment(3);
	$sql_programdata = "SELECT a.PRD_Data_Id, a.PRD_Data_Value AS Kode,a.PRD_Data_Tenor AS tenor
				  FROM t_lk_program_detail a
				  WHERE a.PRD_Data_Status = 1 
				  AND a.PRD_Data_Master= 'BALCON'
				  AND a.PRD_Data_Id='$programData'
				  ORDER BY a.PRD_Data_Sort ASC";
   // var_dump($sql_programdata);
	  $program = $this->db->query($sql_programdata)->row_array();
  //	var_dump($barang['Kode']);
	  $data = array(
		  'PRD_Data_Id'=>$program['PRD_Data_Id'],
		  'kode' => $program['Kode'],
		  'tenor' => $program['tenor']
   );
   
   echo json_encode($data);
  
}


/**
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
function process_callculator_xtradana( $out = null ){
	
// get data Object 

 $result_array  = array();
 
// call my object to Process SIP

 $this->load->model(array('M_Xtradana'));

 $this->fetch = null;
 $this->fetch = Singgleton('M_Xtradana'); 
 if( !is_object( $this->fetch ) ){
	$result_array =  array();
 }
 
// call my data refference process row. 
 $result_array = $this->fetch->_select_callculator( $out ); 
// callback data on view process OK  
  $this->load->view("mod_view_simulasi/view_callculator_xtradana", array( 'data' => $result_array ));
}

function process_callculator_balcon( $out = null ){
	
	// get data Object 
	
	 $result_array  = array();
	 
	// call my object to Process SIP
	
	 $this->load->model(array('M_Balcon'));
	
	 $this->fetch = null;
	 $this->fetch = Singgleton('M_Balcon');
	//  var_dump(is_object( $this->fetch ));
	//  die; 
	 if( !is_object( $this->fetch ) ){
		$result_array =  array();
	 }
	 
	// call my data refference process row. 
	 $result_array = $this->fetch->_select_callculator( $out );
	  
	// callback data on view process OK  
	  $this->load->view("mod_view_simulasi/view_callculator_balcon", array( 'data' => $result_array ));
	}


/**
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  public function PagePremi()
{
	 
  $this->start_page = 0;
  $this->per_page   = 10;
  $this->post_page  = (int)_get_post('page');
  
  $obj_class =& get_class_instance(base_class_model($this));
  $this->arr_result = array();
  $this->arr_content = $obj_class->_select_page_product_premi( new EUI_Object( _get_all_request() ));
  $this->tot_result = count($this->arr_content);
	
   if( $this->post_page) {
	$this->start_page = (($this->post_page-1)*$this->per_page);
  } else {	
	$this->start_page = 0;
  }

 // @ pack : set result on array
  if( (is_array($this->arr_result)) 
	AND ( $this->tot_result > 0 ) )
 {
	$this->arr_result = array_slice($this->arr_content, $this->start_page, $this->per_page);
}	
 
 $this->page_counter = ceil($this->tot_result/ $this->per_page);
 
 // @ pack : then set it to view 
 
 $arr_call_history = array
(
	'content_pages' => $this->arr_result,
	'total_records' 	=> $this->tot_result,
	'total_pages'   => $this->page_counter,
	'select_pages'  => $this->post_page,
	'start_page' 	=> $this->start_page
 );
 
  $this->load->view("mod_view_simulasi/view_page_simulasi_premi", $arr_call_history);	
}


//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
  public function PageBenefit()
{
	 
  $this->start_page = 0;
  $this->per_page   = 10;
  $this->post_page  = (int)_get_post('page');
  
  $obj_class =& get_class_instance(base_class_model($this));
  $this->arr_result = array();
  $this->arr_content = $obj_class->_select_page_product_benefit( new EUI_Object( _get_all_request() ));
  $this->tot_result = count($this->arr_content);
	
   if( $this->post_page) {
	$this->start_page = (($this->post_page-1)*$this->per_page);
  } else {	
	$this->start_page = 0;
  }

 // @ pack : set result on array
  if( (is_array($this->arr_result)) 
	AND ( $this->tot_result > 0 ) )
 {
	$this->arr_result = array_slice($this->arr_content, $this->start_page, $this->per_page);
}	
 
 $this->page_counter = ceil($this->tot_result/ $this->per_page);
 
 // @ pack : then set it to view 
 
 $arr_call_history = array
(
	'ProductPlanId' => _get_post('ProductPlanId'),
	'ProductAttr'	=> $obj_class->_select_attr_product(_get_post('ProductPlanId')),
	'content_pages' => $this->arr_result,
	'total_records' => $this->tot_result,
	'total_pages'   => $this->page_counter,
	'select_pages'  => $this->post_page,
	'start_page' 	=> $this->start_page
 );
 
  $this->load->view("mod_view_simulasi/view_page_simulasi_benefit", $arr_call_history);	
}

 
// ==============================================  END ==============================================	

}

?>
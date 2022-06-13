<?php 
 
 class M_ApplicationSender extends EUI_Model
{
	
//-------------------------------------------------------------------------------------------------------
/*
 * @ package save Activity by Agent 
 *
 * @ return 	: void(0)
 */
 
 var $ApplicationNo 	= 0;
 var $ApplicationId 	= 0;
 var $ProductId 		= 0;
 var $CustomerId 		= 0;
 var $CustomerName		= null;
 var $UserCreateId 		= null;
 var $Recsource			 = null;
 
 
//-------------------------------------------------------------------------------------------------------
/*
 * @ package save Activity by Agent 
 *
 * @ return 	: void(0)
 */
 
 private static $Instance = null; 
 public static function &Instance() 
{
	if( is_null(self::$Instance) ){
		self::$Instance = new self();
	}	
	return self::$Instance;
 }
 
 //-------------------------------------------------------------------------------------------------------
/*
 * @ package save Activity by Agent 
 *
 * @ return 	: void(0)
 */
 
 
 function __construct()
{
   $this->load->library(array('PDF'));
   $this->load->helper(array('EUI_Object','EUI_SMLGenerator'));
} 

//-------------------------------------------------------------------------------------------------------
/*
 * @ package save Activity by Agent 
 *
 * @ return 	: void(0)
 */
 
 function _select_data_row_application() 
{
 $this->db->reset_select();
 $this->db->select("a.*", FALSE);
 $this->db->from("t_gn_customer a ");
 $this->db->where("a.CustomerId", $this->CustomerId);
 
 $rs = $this->db->get();
 if( $rs -> num_rows() > 0 ) {
	return $rs->result_first_assoc();
 }
 return array();

 } 

 
//-------------------------------------------------------------------------------------------------------
/*
 * @ package save Activity by Agent 
 *
 * @ return 	: void(0)
 */
 
 function _select_number_row_application() 
{
	$this->db->reset_select();
	$this->db->select("a.Recsource, a.CustomerNumber, a.CustomerId, a.CustomerFirstName", FALSE);
    $this->db->from("t_gn_customer a ");
	$this->db->where("a.CustomerId", $this->CustomerId);
	
	$rs = $this->db->get();
	if( $rs -> num_rows() > 0 )
	{
		$row = new EUI_Object( $rs->result_first_assoc() );
		$this->ApplicationNo = sprintf("%s-%s-%08d", 
			$row->get_value('Recsource'),
			$row->get_value('CustomerNumber'),
			$row->get_value('CustomerId')
		);
	}
	
	return (string)$this->ApplicationNo;
} 

 
//-------------------------------------------------------------------------------------------------------
/*
 * @ package save Activity by Agent 
 *
 * @ return 	: void(0)
 */
 
 
 function _set_inialize_row_application( $arr  = array() )
{
	if( is_array( $arr ) 
		and count($arr)!=0 )
	{
		$out = new EUI_Object($arr);
		
		if( $out->find_value('CustomerId') ){
			$this->CustomerId = $out->get_value('CustomerId');
		}
		
		if( $out->find_value('ProductId') ){
			$this->ProductId = $out->get_value('ProductId');
		}
		
		if( $out->find_value('UserCreateId') ){
			$this->UserCreateId = $out->get_value('UserCreateId');
		}
		
		
	}
	
	return $this;	
} 


//-------------------------------------------------------------------------------------------------------
/*
 * @ package save Activity by Agent 
 *
 * @ return 	: void(0)
 */
 function _select_pdf_configuration()
{
  $arr_config = array();
  $sql = sprintf( "SELECT a.ConfigName, a.ConfigValue 
				   FROM t_lk_configuration a 
				   WHERE a.ConfigCode='%s' 
				   AND a.ConfigFlags='%d'", 'PDF', 1);
				   
  $qry = $this->db->query( $sql );
  if( $qry->num_rows() > 0 ) 
	foreach( $qry->result_assoc() as $row )
 {
	$arr_config[$row['ConfigName']] = $row['ConfigValue'];	
 }
	
	return Objective( $arr_config );
} 

//-------------------------------------------------------------------------------------------------------
/*
 * @ package save Activity by Agent 
 *
 * @ return 	: void(0)
 */
 
 function _set_pdf_row_application()
{
	$objConfigPDF = $this->_select_pdf_configuration();
	$objClassPDF  = &get_class_instance('EUI_PDF');
	
	$selectProduct = $this->db->query("SELECT *
									  FROM t_gn_product a 
									  WHERE 
									  a.ProductId='".$this->ProductId."' 
	");

	if ( $selectProduct == true AND $selectProduct->num_rows() > 0 ) {
		$sp = $selectProduct->row();
		$product = $sp->ProductCode;
	} 

	if ( $product == "PIL" ) {
		$objClassPDF->set_option(array(
			'--disable-smart-shrinking' 	=> '',
			'-T' 							=> "10mm",
			'-R' 							=> "1mm",
			'-L' 							=> "1mm",
			'-B' 							=> "19mm"
		));
	} else if ( $product == "CARD" ) {
		$objClassPDF->set_option(array(
			'--disable-smart-shrinking' 	=> '',
			'-T' 							=> "10mm",
			'-R' 							=> "2mm",
			'-L' 							=> "2mm",
			'-B' 							=> "17mm"
		));
	} else if ( $product == "ADDON" ) {
		$objClassPDF->set_option(array(
			'--disable-smart-shrinking' 	=> '',
			'-T' 							=> "6mm",
			'-R' 							=> "1mm",
			'-L' 							=> "1mm",
			'-B' 							=> "10mm"
		));
	} else if ( $product == "XSELL" ) {
		$objClassPDF->set_option(array(
			'--disable-smart-shrinking' 	=> '',
			'-T' 							=> "6mm",
			'-R' 							=> "1mm",
			'-L' 							=> "1mm",
			'-B' 							=> "10mm"
		));
	}
	
	
	$objClassPDF->set_conf(array(
		'ip' 							=> $objConfigPDF->get_value('PDF_SERVER_PROCESS'),
		'host' 							=> $objConfigPDF->get_value('PDF_DOMAIN_PROCESS'),
		'method' 						=> $objConfigPDF->get_value('PDF_PAGE_PROCESS'),
		'controller' 					=> $objConfigPDF->get_value('PDF_MODUL_PROCESS')
	));
	
	
	$objClassPDF->set_argv(array(
		'ViewLayout'					=> $objConfigPDF->get_value('PDF_VIEW_PROCESS'),
		'ProductId'						=> $this->ProductId,
		'CustomerId'					=> base64_encode($this->CustomerId)
	));
	
	
	
// --- select number file name -- ------------------------------------------
	
	$_select_number_row_application = $this->_select_number_row_application();
	if( strlen( $_select_number_row_application ) > 0 ) {
		$objClassPDF->set_pdf( $_select_number_row_application  );
	}
	
	return $objClassPDF;
	
} 

//-------------------------------------------------------------------------------------------------------
/*
 * @ package save Activity by Agent 
 *
 * @ return 	: void(0)
 */
 function _select_row_attr_config()
{
  $arr_attr_config = array();
 
  $sql= sprintf("select a.ConfigName,a.ConfigValue  from t_lk_configuration a where a.ConfigCode='%s'",'V_MAIL_CONFIG');
  $rs = $this->db->query($sql);
  if( $rs->num_rows() > 0 ) 
	foreach( $rs->result_assoc() as $rows ) 
 {
	$arr_attr_config[$rows['ConfigName']] = $rows['ConfigValue'];
  }
  
  if( function_exists('Objective') ){ 
	return Objective( $arr_attr_config );
  }
  return (object)$arr_attr_config;
 
} 

//Formulir Pendaftaran HSBC Card Reguler - (nama recsource)
//Formulir Pendaftaran HSBC Personal Loan - (nama recsource)

//-------------------------------------------------------------------------------------------------------
/*
 * @ package save Activity by Agent 
 *
 * @ return 	: void(0)
 */
 
function _select_body_row_application()
{
	
 $row = $this->_select_data_row_application();	
// --- convert object  -- 
 $roj = new EUI_Object($row);
 
 $out = $this->_select_row_attr_config();
 
// -- subject after product set  --- 

 if( in_array($this->ProductId, 
   array(ID_PRODUCT_PILL) ))
 { 
	$row['title_text'] = sprintf($out->get_value('OUTBOX_TITLE_PILL'), $roj->get_value('Recsource') ); 
 } 
 else if( in_array($this->ProductId, 
	array(ID_PRODUCT_CARD) ))
 {
	$row['title_text'] = sprintf($out->get_value('OUTBOX_TITLE_CARD'), $roj->get_value('Recsource') );
 } 
 else{
	$row['title_text'] = sprintf("%s", $out->get_value('OUTBOX_TITLE_MAIL'));
 }
 
// -- default body ---  
 
 $row['body_text'] = sprintf("%s", $out->get_value('OUTBOX_BODY_MAIL'));	
 $row['UserCreateId'] = sprintf("%s",$this->UserCreateId);
 
 return new EUI_Object( $row );
 
}


//-------------------------------------------------------------------------------------------------------
/*
 * @ package save Activity by Agent 
 *
 * @ return 	: void(0)
 */
 
function _set_sendmail_assigment_id( $num = false ) {
	
}

//-------------------------------------------------------------------------------------------------------
/*
 * @ package save Activity by Agent 
 *
 * @ return 	: void(0)
 */
 
function _set_resendmail_assigment_id( $num = false ) {
	
}

//-------------------------------------------------------------------------------------------------------
/*
 * @ package save Activity by Agent 
 *
 * @ return 	: void(0)
 */
 
//-------------------------------------------------------------------------------------------------------
/*
 * @ package save Activity by Agent 
 *
 * @ return 	: void(0)
 */
 
 public function _set_row_keep_transport_tmp() 
{
	$CustomerId = $this->CustomerId;
	$ProductId = $this->ProductId;
	
	if( is_null($CustomerId) OR is_null($ProductId) ) 
	{
		return FALSE;
	}
	
 // --- _set_row_transportation_tmp -- 

  $this->db->reset_write();
  $this->db->set("CustomerId", $CustomerId);
  $this->db->set("ProductId", $ProductId);
  $this->db->set("ApprovalByUserId", _get_session('UserId') );
  $this->db->set("ApprovalByUserName", _get_session('UserId') );
  $this->db->set("ApprovalDateTs", date('Y-m-d H:i:s'));
  
 // -- if duplicate  -- 
  $this->db->duplicate("ApprovalDateTs",date('Y-m-d H:i:s'));
  $this->db->duplicate("ApprovalByUserId", _get_session('UserId') );
  $this->db->duplicate("ApprovalByUserName", _get_session('Username','strtoupper'));
  
  
  if( $this->db->insert_on_duplicate("t_gn_approval_tmp") ){
	return true;  
  }
  
  return FALSE;
}  
   

//-------------------------------------------------------------------------------------------------------
/*
 * @ package save Activity by Agent 
 *
 * @ return 	: void(0)
 */
 
 public function _set_send_row_application( $num = false )
{
  $objPDF = $this->_set_pdf_row_application();
   if( !is_object( $objPDF ) ) {
	return false;
  }
  
  $this->Run = $objPDF->Runner();

  if( !$this->Run->Success() )  {
	  return false;
  }

 // -- send data by email addresss --- 
 
 if(( $this->Run->Success() ) AND ($num == true) ){
	 return $this;
 }
  
 $this->row = $this->_select_body_row_application();
  
 if( is_object($this->row) 
	   AND $this->row->find_value('CustomerId') ) 
  {
		$this->objMail = new EUI_SMLGenerator();
		$this->objMail->set_send_date(date('Y-m-d H:i:s'));
		$this->objMail->set_add_assign( $this->row->get_value('CustomerId') );	
		$this->objMail->set_send_user( $this->row->get_value('UserCreateId') );	
		$this->objMail->set_add_title( $this->row->get_value('title_text') );
		$this->objMail->set_add_body( $this->row->get_value('body_text') );
		$this->objMail->set_add_to( $this->row->get_value('CustomerEmail'));
		$this->objMail->set_add_attachment( $this->Run->filename() );
		$this->objMail->set_compile();
  }
  
  return $this;
} 

//---------------- END CLASS ---------------------------
 
}
?>
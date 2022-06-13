<?php 
//---------------------------------------------------------------------
/*
 * class Backdor for activity It Support .
 */
 
 class Backdor extends EUI_Controller 
{


 function __construct()
{ 
	parent::__construct();
	$this->load->model(array(base_class_model($this)));
	$this->load->helper(array('EUI_Object','EUI_Socket'));
}

//---------------------------------------------------------------------
/*
 * class Backdor for activity It Support .
 */
 
 public function index()
{
	echo " <form name='frmExtension' 
		method='POST' action='". site_url() ."/Backdor/ReleaseExtension/?action=". time() ."'>
		<table>
			<tr>
				<td>Extension<td>
				<td><input type='text' value='' style='width:70px;' name='extension'><td>
				<td><input type='Submit' value='Submit' name='btnSubmit'><td>
			</tr>
		</table>
	</form>";
}

// ---------------------------------------------------------------------------------
/*
 *  release extension if login identification Not Match 
 */
 
 public function ReleaseExtension()
{

 if( !_get_have_post('btnSubmit') 
	OR ! _get_have_post('extension') )
 {
	exit("Invalid Parameter . Please try Again.!");	
 }
 
 $extension = _get_post('extension'); 
 if( !$extension ){
	exit('No Extension to Release');
 } 
 
 $pbx=& get_class_instance( base_class_model($this) );
  
  if( !is_object($pbx) )
 {
	exit('object class error.');
 }	 
 
//--------------- look Backdir  
 $Manger = $pbx->_select_row_cc_setting( $extension, 'manager');
 if( !$Manger ){
	exit("ERR [$extension] extension not valid!.");
 } 
 
 if( !is_array( $Manger ) OR count( $Manger ) == 0  ){
	exit("configuration not valid!"); 
 }	 
 
 
 if( !class_exists('EUI_Socket') ){
	exit("class  Socket not found!");  
 } 
 
 
// ------------ process ---------------------------------------------- 
 $Cti = new EUI_Object( $Manger );
 if( !$Cti->fetch_ready() ){
	exit('Invalid Argument.!');
 } 
 
 $Sock = new EUI_Socket();
 $Sock->set_fp_server( $Cti->get_value('server.host','strval'), $Cti->get_value('server.port','intval')); 
 $Sock->set_fp_command( "rel-station\r\n"."ext:{$extension}\r\n\r\n" ); 
  if( $Sock->send_fp_comand() ) 
 {
	if( !$Sock->get_fp_response() ){
		exit("Release Extension Failed.");
	}
	exit("Release Extension OK. ");
 } 
 else {
	exit("Server Connection Error.");
  }
} 

// ---------------------------------------------------------------------------------
/*
 *  release extension if login identification Not Match 
 */

 public function ReleaseLogin()
{
	$UserId = (string)$this->URI->segment(3);
	
	if( !$UserId){
		exit("Agent Not Exist.");
	}
	
	$this->db->reset_select();
	$this->db->where("id", $UserId);
	$this->db->set("logged_state", 0);
	$this->db->set("ip_address", "NULL", FALSE);
	$this->db->update("tms_agent");
	if( $this->db->affected_rows() > 0 ){
		exit("Release Agent Login OK.");
	} else {
		exit("Release Agent Login Failed.");
	}	
	
} 
//---------------------------------------------------------------------------------------

/* Modul			UserMenu 
 *
 * @package 		controller 
 * @project			helpdesk 
 */
 
 private function StructTable( $TABLES = '' )
{
	
 $ar_sql_table = "DESC $TABLES";
 $ar_sql_query = $this->db->query( $ar_sql_table );
 if( $ar_sql_query -> num_rows() == 0  ){
	return false;	
 }	
	
  $arr_header = null;
  if( $ar_sql_query ) 
  {
	return $ar_sql_query->result_assoc();
  }
  
  return null;
  
} 

//---------------------------------------------------------------------------------------

/* Modul			UserMenu 
 *
 * @package 		controller 
 * @project			helpdesk 
 */
 
 public function StructDatabase()
{
 
 $out = new EUI_Object(_get_all_request());
 
// ----------------- list Post --------------------------------------------------------------------
 $arr_list_table = $out->get_array_value('table');
 
 // ---------------------------------------
 $this->load->helper('EUI_ExcelWorksheet'); 
 $ar_sql_table = "SHOW TABLES";
 $ar_sql_query = $this->db->query( $ar_sql_table );
 if( $ar_sql_query -> num_rows() == 0  ){
	return false;	
 }	
	
 // --------------------------------------------------------------- 
  $arr_title ="Database Structure Of ". title() . " Version ". version();
  $base_file_tmp = "DATABASE_STRUCTURE_".title()."_". version() ."_".date('YmdHs').".xls";
  $base_file_name = dirname(__FILE__) ."/".urlencode($base_file_tmp);
 
 // read excel  ---------------------------------------------------------
  $workbook =& new writeexcel_workbook($base_file_name);
  $worksheet =& $workbook->addworksheet();
 
 
 /* pack header format every file **/
  
  $header1_format =& $workbook->addformat();
  $header1_format ->set_bold();
  $header1_format->set_size(10);
  $header1_format->set_color('black');
  $header1_format->set_align('left');
  $header1_format->set_align('vcenter');
  
  $header_format =& $workbook->addformat();
  $header_format ->set_bold();
  $header_format->set_size(10);
  $header_format->set_color('white');
  $header_format->set_align('left');
  $header_format->set_align('vcenter');
  $header_format->set_pattern();
  $header_format->set_fg_color('blue');
  $header_format->set_border(1);
  $header_format->set_border_color('silver');
  //$header_format->set_text_h_align(25);
	
   
 
  $title_format =& $workbook->addformat();
  $title_format ->set_bold();
  $title_format->set_size(14);
  $title_format->set_color('black');
  $title_format->set_align('left');
  $title_format->set_align('vcenter');

  $format_content =& $workbook->addFormat();
  $format_content->set_border(1);
  $format_content->set_border_color('silver');
 // $format_content->set_text_h_align(20);

// ============ loader content data header ========================// 

  $arr_header = null;
  if( $ar_sql_query ) 
	foreach( $ar_sql_query->result_assoc() as $rows )
 {
	foreach( $rows as $key => $name ){
		$arr_header[$name] = $name;
	}
  }
  
 // -----------------------------------------------------------------------
 $num_header = 0;
 $worksheet->write_string($num_header, 0, urlencode($arr_title));
 $num_header = $num_header+2;
 
 if(is_array($arr_header)) 
	foreach( $arr_header as $k => $value )
 {
	$worksheet->write_string($num_header, 0, $value, $header1_format );	
	$table_rows = $this->StructTable($value);
	$num_header = $num_header+2;
	
	// ---------- header data table --> 
	
	$arr_field = array( 'FIELD','TYPE','ALLOW_NULL', 'KEY', 'DEFAULT', 'EXTRA');
	foreach( $arr_field as $no => $flds ){
		$worksheet->write_string( $num_header, $no, $flds, $header_format);
	}
	
	// ---------- header ---------------------------
	$num_header = $num_header+1;
	if( is_array( $table_rows ) ) 
		foreach( $table_rows as $row )
	{
		$num_cols = 0;	
		 foreach( $row  as $Field => $Val )
		{
			 if( in_array( $Field, array('Field')))
			 {
				$worksheet->write_string($num_header, $num_cols, $Val, $format_content);	
			 } else {
				$worksheet->write_string($num_header, $num_cols, strtoupper($Val), $format_content);	 
			 }
			$num_cols++;	
		}
		$num_header+=1; 
	}	
	$num_header+=1;
 }
 
	
 $workbook->close(); // end book 
  if( file_exists($base_file_name))
 {
	header("Pragma: public");
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("Content-Type: application/force-download");
	header("Content-Type: application/octet-stream");
	header("Content-Type: application/download");
	header("Content-type: application/vnd.ms-excel; charset=utf-16");
	header("Content-Disposition: attachment; filename=". basename($base_file_name));
	header("Content-Transfer-Encoding: binary");
	header("Content-Length: " . filesize($base_file_name));
	readfile($base_file_name); 
	@unlink($base_file_name);
 }
 
}

// =========================== END CLASS 

	
}

?>
<?php 

class MailOutbox extends EUI_Controller 
{
	
// -----------------------------------------------------------

/* 
 * Method 		AddUser 
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
 
 
function __construct()
{
	parent::__construct();
	$this->load->model(base_class_model($this));
	$this->load->helpers("EUI_Object");
}

// -----------------------------------------------------------

/* 
 * Method 		AddUser 
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
 
 
 function index() 
{
	
 if( !_have_get_session('UserId')){ return FALSE; }
 
 $arr_helper = array('page' => $this->{base_class_model($this)}->_select_count_page() );
 $this->load->view("mod_mail_outbox/view_mailoutbox_nav", $arr_helper);	
 
}


// -----------------------------------------------------------

/* 
 * Method 		AddUser 
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
 
 function content()
{
  if( !_have_get_session('UserId') ) { return FALSE; }	
  $arr_helper = array  (
	'role' => $this->M_UserRole->_select_role_table_action(get_class($this)),
	'page' => $this->{base_class_model($this)}->_select_row_page(),
	'num'  => $this->{base_class_model($this)}->_select_num_page() 
  );
   
  $this->load->view("mod_mail_outbox/view_mailoutbox_list", $arr_helper); 
}



// -----------------------------------------------------------

/* 
 * Method 		AddUser 
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
 
function Edit()
{
 if( _have_get_session('UserId') 
	AND _get_have_post('BookClassId') ) 
 {
   $out = $this->{base_class_model($this)}->_select_row_class_max();
   $row = $this->{base_class_model($this)}->_select_row_class_detail(_get_post('BookClassId'));   
   $arr_view = array(
		'out' => new EUI_Object($out),
		'row' => new EUI_Object($row)
   ); 
   
   $this->load->view("mod_mail_outbox/view_mailoutbox_edit", $arr_view);
 }
 
}

// -----------------------------------------------------------

/* 
 * Method 		AddUser 
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
 
function Add()
{
  if( _have_get_session('UserId') ) 
 {
   $out = $this->{base_class_model($this)}->_select_row_class_max();	
   $arr_view = array('out' => new EUI_Object($out)); 
   $this->load->view("mod_mail_outbox/view_mailoutbox_add", $arr_view);
 }
 
}
// -----------------------------------------------------------

/* 
 * Method 		Role 
 *
 * @pack 		metjode 
 * @param		testing all 
 * @notes		must be exist if have button attribute role
 */
 
 public function Update()
{
  $cond = array( "success" => 0);
  if( $this->{base_class_model($this)}->_update_row_class() ) {
	 $cond = array( "success" => 1);
  }
  
  echo json_encode($cond); 
}


// -----------------------------------------------------------

/* 
 * Method 		Role 
 
 * ---------------------------------------------------------------------------------------------
 * @pack 		metjode 
 * @param		testing all 
 * @notes		must be exist if have button attribute role
 */
 
 public function Enable()
{
  $cond = array("success" => 0);
  if( $this->{base_class_model($this)}->_aktivasi_row_booking_class(1) ){
	$cond = array( "success" => 1);  
  }
  
  echo json_encode($cond); 
}
// -----------------------------------------------------------

/* 
 * Method 		Role 
 *
 * @pack 		metjode 
 * @param		testing all 
 * @notes		must be exist if have button attribute role
 */
 
 public function Disable()
{
  $cond = array( "success" => 0);
  if( $this->{base_class_model($this)}->_aktivasi_row_booking_class(0) )
  {
	$cond = array( "success" => 1);  
  }
  
  echo json_encode($cond); 
}


// -----------------------------------------------------------

/* 
 * Method 		Role 
 *
 * @pack 		metjode 
 * @param		testing all 
 * @notes		must be exist if have button attribute role
 */
 
 public function Delete()
{
  $cond = array( "success" => 0);
  if( $this->{base_class_model($this)}->_delete_row_outbox_mail() )
  {
	$cond = array( "success" => 1);  
  }
  
  echo json_encode($cond); 
}

// -----------------------------------------------------------

/* 
 * Method 		Role 
 *
 * @pack 		metjode 
 * @param		testing all 
 * @notes		must be exist if have button attribute role
 */
 
 public function Save()
{
  $cond = array( "success" => 0);
  if( $this->{base_class_model($this)}->_save_row_booking_class() )
  {
	$cond = array( "success" => 1);  
  }
  
  echo json_encode($cond); 
}

// -----------------------------------------------------------

/* 
 * Method 		Role 
 *
 * @pack 		metjode 
 * @param		testing all 
 * @notes		must be exist if have button attribute role
 */
 
public function Download(){
	$OutboxId = $this->URI->segment(4);
	$Mail =& get_class_instance(base_class_model($this));
	
// --------- then setup ist ----------------------------	
	$arr_path = $Mail->_select_row_outbox_attachment( $OutboxId );
	if( is_array( $arr_path ) )
	{
		if( file_exists($arr_path['path']) )
		{ 
			header("Content-Type: application/octet-stream");
			$file = sprintf("%s", $arr_path['path']);
			header("Content-Disposition: attachment; filename=" . urlencode(basename($file)));   
			header("Content-Type: application/octet-stream");
			header("Content-Type: application/download");
			header("Content-Description: File Transfer");            
			header("Content-Length: " . filesize($arr_path['path']));
			flush(); // this doesn't really matter.
			$fp = fopen($file, "r");
			while (!feof($fp))
			{
				echo fread($fp, 65536);
				flush(); // this is essential for large downloads
			} 
			fclose($fp); 
		} else {
			exit('file not found');
		}	
	}
}
 
// -----------------------------------------------------------

/* 
 * Method 		Role 
 *
 * @pack 		metjode 
 * @param		testing all 
 * @notes		must be exist if have button attribute role
 */
 
 public function Detail()
{
	$Mail =& get_class_instance(base_class_model($this));
	$Inbox = $Mail->_select_row_mail_outbox_detail(_get_post('MailOutboxId'));
	$this->load->view("mod_mail_outbox/view_mailoutbox_print", array (
		"content" => new EUI_Object( $Inbox )
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

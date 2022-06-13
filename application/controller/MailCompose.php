<?php 
class MailCompose extends EUI_Controller
{

//---------------------------------------------------------------------------------------

/* properties		: __construct 
 *
 * @param 			: this class  
 * @author			: -
 */
 
 function __construct()
{
  parent::__construct();
  $this->load->model(array(base_class_model($this)));
  $this->load->helper("EUI_Object");
  $this->load->helper("EUI_SMLGenerator");
}

//---------------------------------------------------------------------------------------

/* properties		: index 
 *
 * @param 			: default of the class  
 * @author			: -
 */
 
 function index()
{
	if( !_have_get_session('UserId') ) 
 {
	return false;
  }
  $out = _find_all_object_request();
  
  
  $EventRoleback = 'Home';
  if( $out->find_value('EventRoleback') ){
	$EventRoleback = $out->get_value('EventRoleback');	
  }  
  
  $this->load->view("mod_mail_compose/mail_compose_index", array
  (
	'EventIconic' => 'fa-envelope-o',
	'EventRoleback' => $EventRoleback,
	'EventContent' => 'mail_compose_content',
	'EventTitleTab' => array('Mail', 'Compose')
  ));
}

//---------------------------------------------------------------------------------------

/* properties		: index 
 *
 * @param 			: default of the class  
 * @author			: -
 */
 
function Forward()
{ 
 	if( !_have_get_session('UserId') ) 
 {
	return false;
  }
  
   $outCls  = & get_class_instance("M_MailInbox");
   $Inbox = $outCls->_select_row_mail_inbox_detail(_get_post('MailInboxId'));
   $this->load->view("mod_mail_compose/mail_compose_index", array
  (
	'EventOut' => new EUI_Object($Inbox), 
	'EventIconic' => 'fa-share',
	'EventRoleback' => 'MailInbox',
	'EventContent' => 'mail_forward_content',
	'EventTitleTab' => array('Mail', 'Forward')
  ));
  
}



 
//---------------------------------------------------------------------------------------

/* properties		: index 
 *
 * @param 			: default of the class  
 * @author			: -
 */
 
 function Reply()
{ 
  if( !_have_get_session('UserId') ) 
 {
	return false;
  }
   
   $outCls  = & get_class_instance("M_MailInbox");
   $Inbox = $outCls->_select_row_mail_inbox_detail(_get_post('MailInboxId'));
   
   $this->load->view("mod_mail_compose/mail_compose_index", array
  (
    'EventOut' => new EUI_Object($Inbox), 
	'EventIconic' => 'fa-reply-all',
	'EventRoleback' => 'MailInbox',
	'EventContent' => 'mail_reply_content',
	'EventTitleTab' => array('Mail', 'Reply')
	
 ));
}

//---------------------------------------------------------------------------------------

/* properties		: Add 
 *
 * @param 			: procedure 
 * @author			: -  
 */
 
 public function Add()
{
	 
 }
 
//---------------------------------------------------------------------------------------

/* properties		: Submit 
 *
 * @param 			: ${_REQUEST}
 * @author			: -
 */
 
 public function Submit()
{
  $cond = array('success' => 0);
  
  $out  = _find_all_object_request(); 
  if( $out->fetch_ready() ) 
 {
	$Booth =& SML_Generator();
	
	$Booth->set_send_date(date('Y-m-d H:i:s'));
	$Booth->set_add_assign(0);
	$Booth->set_add_title($out->get_value('mail_subject'));
	$Booth->set_add_body($out->get_value('body_content'));
	
	$arr_address_to  = $out->get_array_value('address_to');
	$arr_address_cc  = $out->get_array_value('address_cc');
	$arr_address_bcc = $out->get_array_value('address_bcc');
	
// ------------ dest ----------------------------	
	if( is_array($arr_address_to) ) 
		foreach( $arr_address_to as $k => $Address )
	{
		$Booth->set_add_to($Address);	
	}
	
	
// ------------ cc ----------------------------	
	if( is_array($arr_address_cc) ) 
		foreach( $arr_address_cc as $k => $Address )
	{
		$Booth->set_add_cc($Address);	
	}
	
// ------------ bcc ----------------------------

	if( is_array($arr_address_bcc) ) 
		foreach( $arr_address_bcc as $k => $Address )
	{
		$Booth->set_add_bcc($Address);	
	}
	
	if( $Booth->set_compile() ) {
		$cond = array('success' => 1);
	}
 }
 echo json_encode($cond);  // callback to client :
 
}
 
//---------------------------------------------------------------------------------------

/* properties		: Submit 
 *
 * @param 			: ${_REQUEST}
 * @author			: -
 */
 
 public function Role()
{
  echo json_encode(array());
  
 } 

// ============== END CLASS =======================	
}

?>
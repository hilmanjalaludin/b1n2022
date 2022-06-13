<?php 
// -----------------------------------------------------------

/* 
 * Method 		AddUser 
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
 
 
 
class M_MailInbox extends EUI_Model
{
	
var $PageRecord = 10;
// -----------------------------------------------------------

/* 
 * Method 		AddUser 
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
 
 private static $Instance = null;

// -----------------------------------------------------------

/* 
 * Method 		AddUser 
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
 
 public static function &Instance()
{
  if( is_null( self::$Instance ) ) {		
	self::$Instance = new self();	
  }	
  return self::$Instance;	
} 

// --------------- select blocking sms -----------------

// -----------------------------------------------------------

/* 
 * Method 		AddUser 
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
 function __construct()
{ 
	$this->load->model(array('M_UserRole'));
}

// -------------------------------------------------------------

/* 
 * Method 		_select_row_page
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
 
 function _select_content_page()
{
  $out = _find_all_object_request();
  
// ---------------------------------------------------------------------  
  
  $this->EUI_Page->_postPage(_get_post('v_page'));
  $this->EUI_Page->_setPage($this->PageRecord); 
// ---------------------------------------------------------------------  
 
 // select 
	// a.EmailInboxId, 
	// a.EmailSender, 
	// a.EmailMessageId, 
	// a.EmailSubject, 
	// a.EmailStatus, 
	// a.EmaiReceiveDate 
// from egs_inbox  a 
 
  $this->EUI_Page->_setArraySelect(array(
	"a.EmailInboxId as MailInboxId"=> array("MailInboxId", "MailInboxId", "primary"), 
	"a.EmailMessageId as EmailMessageId"=> array("EmailMessageId", "ID"), 
	"a.EmailSender as EmailSender"=> array("EmailSender", "Sender"), 
	"a.EmailSubject as EmailSubject"=> array("EmailSubject", "Subject"), 
	"a.EmaiReceiveDate as EmaiReceiveDate"=> array("EmaiReceiveDate", "Receive Date"),
	"IF(a.EmailStatus IN(1), 'Read', 'Unread') as EmailStatus" => array("EmailStatus", "Status")
	
  ));
  
  $this->EUI_Page->_setFrom("egs_inbox a ", true);
  
 // ----------- then limit on here   ---------------------------------  
 // ----------- $out->debug_label(); ------------------------------------
  // $this->EUI_Page->_setAndCache("a.book_class_code", "book_class_code", TRUE);
  // $this->EUI_Page->_setAndCache("a.book_class_desc", "book_class_desc", TRUE);
  // $this->EUI_Page->_setAndCache('a.book_class_flags',"book_class_flags", TRUE); 
  // $this->EUI_Page->_setAndOrCache("DATE(a.book_class_create)>='". $out->get_value('start_create', '_getDateEnglish')."'", 'start_create', TRUE);
  // $this->EUI_Page->_setAndOrCache("DATE(a.book_class_create)<='". $out->get_value('end_create', '_getDateEnglish') ."'", 'end_create', TRUE);
	
// -----------if have order sorted ---------------------------------
   if( _get_have_post("order_by") )
   {
	 $this->EUI_Page->_setOrderBy($out->get_value("order_by"), $out->get_value("type"));
   } else {
	   $this->EUI_Page->_setOrderBy("a.EmailInboxId", "DESC");
   }
   
// -----------then limit on here ---------------------------------
	$this->EUI_Page->_setLimit();

} 

// -------------------------------------------------------------

/* 
 * Method 		_select_count_page
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
 
 function _select_count_page()
{
	
 $out = _find_all_object_request();
// ---------------------------------------------------------------------
 	
  $this->EUI_Page->_setPage($this->PageRecord);  
  $this->EUI_Page->_setSelect("a.EmailInboxId");
  $this->EUI_Page->_setFrom("egs_inbox a ", true);
   
  //$this->EUI_Page->_setFrom("t_lk_booking_class a ", true);
   
 // ----------- if have filter --------------------------------------
  // $this->EUI_Page->_setAndCache("a.book_class_code", "book_class_code", TRUE);
  // $this->EUI_Page->_setAndCache("a.book_class_desc", "book_class_desc", TRUE);
  // $this->EUI_Page->_setAndCache('a.book_class_flags',"book_class_flags", TRUE); 
  // $this->EUI_Page->_setAndOrCache("DATE(a.book_class_create)>='". $out->get_value('start_create', '_getDateEnglish')."'", 'start_create', TRUE);
  // $this->EUI_Page->_setAndOrCache("DATE(a.book_class_create)<='". $out->get_value('end_create', '_getDateEnglish') ."'", 'end_create', TRUE);	
  return $this->EUI_Page;
} 

// -------------------------------------------------------------

/* 
 * Method 		_select_row_page
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
 
 function _select_row_page()
{
  $this->_select_content_page();
  if( $this->EUI_Page )
 {
	return $this->EUI_Page->_get();
  }
  return FALSE;
} 

// -------------------------------------------------------------

/* 
 * Method 		_select_num_page
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
 
 function _select_num_page()
{
 $arr_num_page = $this->EUI_Page->_getNo();
  if( is_null($arr_num_page) == FALSE )
 {
	return $arr_num_page;	
 }
 
} 

// -------------------------------------------------------------

/* 
 * Method 		_select_num_page
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
 
function _select_row_mail_inbox_sender( $InboxId = 0 )
{
  $ar_from = array();	
  $this->db->reset_select();
  $this->db->select("a.EmailDestination", FALSE);
  $this->db->from("egs_destination  a ");
  $this->db->where("a.EmailReffrenceId",$InboxId);
  $this->db->where("a.EmailDirection", 1);
  $rs = $this->db->get();
  if( $rs->num_rows() > 0 )
	  foreach( $rs->result_assoc() as $rows )
  {
	   $ar_from[$rows['EmailDestination']] = $rows['EmailDestination'];
  }
  
  return $ar_from;
} 

// -------------------------------------------------------------

/* 
 * Method 		_select_num_page
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
 

function _select_row_mail_inbox_cc( $InboxId = 0  )
{
  $ar_from = array();	
  $this->db->reset_select();
  $this->db->select("a.EmailCC", FALSE);
  $this->db->from("egs_copy_carbone  a ");
  $this->db->where("a.EmailReffrenceId",$InboxId);
  $this->db->where("a.EmailDirection", 1);
  $rs = $this->db->get();
  if( $rs->num_rows() > 0 )
	  foreach( $rs->result_assoc() as $rows )
  {
	   $ar_from[$rows['EmailCC']] = $rows['EmailCC'];
  }
  
  
  return $ar_from;
} 

// -------------------------------------------------------------

/* 
 * Method 		_select_num_page
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
 

function _select_row_mail_inbox_bcc( $InboxId = 0  )
{
   $ar_from = array();	
  $this->db->reset_select();
  $this->db->select("a.EmailBCC", FALSE);
  $this->db->from("egs_blindcopy_carbone  a ");
  $this->db->where("a.EmailReffrenceId",$InboxId);
  $this->db->where("a.EmailDirection", 1);
  $rs = $this->db->get();
  if( $rs->num_rows() > 0 )
	  foreach( $rs->result_assoc() as $rows )
  {
	 $ar_from[$rows['EmailCC']] = $rows['EmailCC'];
  }
  
  return $ar_from;
} 
 
// -------------------------------------------------------------
/* 
 * Method 		_select_num_page
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
 
 private function _set_event_row_read( $InboxId )
{
   $this->db->reset_write();
   $this->db->set("EmailStatus",1);
   $this->db->where("EmailInboxId", $InboxId);
   return $this->db->update("egs_inbox");
} 
// -------------------------------------------------------------
/* 
 * Method 		_select_num_page
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
 
function _select_row_header_reply_content( $out )
{
	$out = new EUI_Object($out);
	$var_html = "<p>&nbsp;</p><p>&nbsp;</p>
	<div style=\"border-top:1px dashed #000000;\" class=\"ui-widget-form-table\"> 
		<div style='font-family:Trebuchet MS;font-size:13px;'><span style=\"font-weight:bold;\"> From : </span>". $out->get_value('EmailSender') ."</div>
		<div style='font-family:Trebuchet MS;font-size:13px;'><span style=\"font-weight:bold;\"> To : </span>" .$out->get_value('to'). "</div>
		<div style='font-family:Trebuchet MS;font-size:13px;'><span style=\"font-weight:bold;\"> CC : </span>".$out->get_value('cc')."</div>
		<div style='font-family:Trebuchet MS;font-size:13px;'><span style=\"font-weight:bold;\"> Sent Date : </span>". $out->get_value('EmaiReceiveDate') . "</div>
	</div>";
	
	return join("<br>", array($var_html,$out->get_value('EmailContent')));
}


// -------------------------------------------------------------
/* 
 * Method 		_select_num_page
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
 
function _select_row_header_forward_content( $out )
{
	$out = new EUI_Object($out);
	$var_html = "<p>&nbsp;</p><p>&nbsp;</p>
	<p style=\"font-size:14px;\">----- Forwarded Message -----</p>
	<div> 
		<div style='font-family:Trebuchet MS;font-size:13px;'><span style=\"font-weight:bold;\"> From : </span>". $out->get_value('EmailSender') ."</div>
		<div style='font-family:Trebuchet MS;font-size:13px;'><span style=\"font-weight:bold;\"> To : </span>" .$out->get_value('to'). "</div>
		<div style='font-family:Trebuchet MS;font-size:13px;'><span style=\"font-weight:bold;\"> CC : </span>".$out->get_value('cc')."</div>
		<div style='font-family:Trebuchet MS;font-size:13px;'><span style=\"font-weight:bold;\"> Sent Date : </span>". $out->get_value('EmaiReceiveDate') . "</div>
	</div>";
	
	return join("<br>", array($var_html,$out->get_value('EmailContent')));
}
	
// -------------------------------------------------------------
/* 
 * Method 		_select_num_page
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */

 function _select_row_mail_inbox_detail( $id  = 0 )
{
 $this->_set_event_row_read( $id ); // update to read 
 
 $row_inbox_detail= array();
 $this->db->reset_select();
 $this->db->select("a.*",FALSE);
 $this->db->from("egs_inbox a");
 $this->db->where("a.EmailInboxId",$id);
 $qry = $this->db->get();
 
 if( $qry->num_rows() > 0 )
  {
	$row_inbox_detail = $qry->result_first_assoc();  
  }
  
  $row_inbox_detail['ar_to'] = $this->_select_row_mail_inbox_sender($id);
  $row_inbox_detail['ar_cc'] = $this->_select_row_mail_inbox_cc($id);
  $row_inbox_detail['ar_bcc'] = $this->_select_row_mail_inbox_bcc($id);
  $row_inbox_detail['to'] = join(";", $row_inbox_detail['ar_to']);
  $row_inbox_detail['cc'] = join(";", $row_inbox_detail['ar_cc']);
  $row_inbox_detail['bcc'] = join(";", $row_inbox_detail['ar_bcc']);

// -- add body to header replay ---
  $row_inbox_detail['reply_body'] = $this->_select_row_header_reply_content( $row_inbox_detail );
  $row_inbox_detail['forward_body'] = $this->_select_row_header_forward_content( $row_inbox_detail );
  return $row_inbox_detail;
}

// ---------------------------------------------------------------------

/* 
 * Method 		_UpdateWiki
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */

 function _select_row_class_max()
{
	
  $row_paket_max = null;
  $this->db->reset_select();
  $this->db->select("(MAX(a.book_class_code)+1) as ClassMax, (max(a.book_class_order)+1) as Orders", FALSE);
  $this->db->from("t_lk_booking_class a ");
  $rs = $this->db->get();
  if( $rs->num_rows() > 0 ) 
  {
	$row = $rs->result_first_assoc();
	if( $row ) 
	{
		$row_paket_max['class_code']  = $row['ClassMax'];
		$row_paket_max['class_order'] = $row['Orders'];
	}	
  }
  
  return $row_paket_max;
  
}


// ---------------------------------------------------------------------

/* 
 * Method 		_UpdateWiki
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */

 public function _update_row_class()
{
  $cond = 0;
 $out = _find_all_object_request();
  if( $out ) 
 {
	$this->db->reset_write();
	$this->db->set("book_class_name",$out->get_value('book_class_name'));
	$this->db->set("book_class_desc",$out->get_value('book_class_desc'));
	$this->db->set("book_class_flags",$out->get_value('book_class_flags'));
	$this->db->set("book_class_order",$out->get_value('book_class_order'));
	$this->db->set("book_class_userid",_get_session('UserId'));
	$this->db->set("book_class_create", date('Y-m-d H:i:s'));
	
	$this->db->where("book_class_code",$out->get_value('book_class_code'));
	
	if( $this->db->update("t_lk_booking_class") ) {
		$cond++;
	}
	
	// echo $this->db->last_query();
 }
  
  return $cond;
}


// ---------------------------------------------------------------------

/* 
 * Method 		_UpdateWiki
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */

function _aktivasi_row_booking_class( $flags = 0 ) // default Not Active
{
  $cond = 0;
  $out = _find_all_object_request();
  if( $out->get_array_value('BookClassId') ) 
	  foreach( $out->get_array_value('BookClassId') as $key => $Id ) 
 {
	$this->db->reset_write();
	$this->db->where("book_class_id", $Id);
	$this->db->set("book_class_flags",$flags);
	if( $this->db->update("t_lk_booking_class") )  
	{
		$cond++;
	}
 }
  
 //echo $this->db->last_query();
  return $cond;
}

// ---------------------------------------------------------------------

/* 
 * Method 		_UpdateWiki
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */

function _delete_row_mail_inbox()
{
  $cond = 0;
  $out = _find_all_object_request();
  
  $ar_inbox = $out->get_array_value('MailInboxId');
  if( is_array($ar_inbox) AND count($ar_inbox) > 0 ) 
	  foreach( $out->get_array_value('MailInboxId') as $key => $Id ) 
 {
	$this->db->reset_write();
	$this->db->where("EmailReffrenceId", $Id);
	$this->db->where("EmailDirection", 1);
	$this->db->delete("egs_blindcopy_carbone");
	// ---------- destn --- 
	
	$this->db->reset_write();
	$this->db->where("EmailReffrenceId", $Id);
	$this->db->where("EmailDirection", 1);
	$this->db->delete("egs_copy_carbone");
	 
	// ---------- destn --- 
	
	$this->db->reset_write();
	$this->db->where("EmailReffrenceId", $Id);
	$this->db->where("EmailDirection", 1);
	$this->db->delete("egs_attachment_url");
	 
	// ---------- destn --- 
	
	$this->db->reset_write();
	$this->db->where("HistoryRefferenceId", $Id);
	$this->db->where("HistoryDirection", 1);
	$this->db->delete("egs_history");
 
	// ---------- destn --- 
	
	$this->db->reset_write();
	$this->db->where("EmailReffrenceId", $Id);
	$this->db->where("EmailDirection", 1);
	$this->db->delete("egs_destination");
	
	$this->db->reset_write();
	$this->db->where("EmailInboxId", $Id);
	
	if( $this->db->delete("egs_inbox") )  {
		EventLoger("DELETE", "Inbox Mail ID {$Id}");
		$cond++;
	}
 }
  
  return $cond;
}

// ---------------------------------------------------------------------

/* 
 * Method 		_UpdateWiki
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */

 public function _save_row_booking_class()
{
	
  $cond = 0;
  $out =& new EUI_Object(_get_all_request() );
  if( $out ) 
 {
	// ------------------------------------------------------------
	if( is_array($out->fetch_label()) ) 
		foreach( $out->fetch_label() as $k => $field )
	{
		$this->db->set( $field, $out->get_value($field, 'trim') );
	}
	
	$this->db->set("book_class_userid", _get_session('UserId'));
	$this->db->set("book_class_create", date('Y-m-d H:i:s'));
	$this->db->insert("t_lk_booking_class");
	if( $this->db->affected_rows() > 0 ) {
		$cond++;
	}
 }
  
  return $cond;
}



 
// =========================== END CLASS ====================================
// =========================== END CLASS ====================================
		
}

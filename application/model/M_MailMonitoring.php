<?php
class M_MailMonitoring extends EUI_Model
{

	
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



//---------------------------------------------------------------------------------------

/* properties		: Submit 
 *
 * @param 			: ${_REQUEST}
 * @author			: -
 */
 
 function __construct()
{ 
	 $this->load->model(array('M_UserRole','M_ApplicationSender','M_SetProduct','M_SysUser'));
}


//---------------------------------------------------------------------------------------

/* properties		: Submit 
 *
 * @param 			: ${_REQUEST}
 * @author			: -
 */
 public function To( $OutboxId = 0 )
{
 $to = '';
 
	$this->db->select('*');
	$this->db->from('t_gn_email_outgoing_to');
	$this->db->where('email_reference_id',$OutboxId);
	foreach( $this->db->get() -> result_assoc() as $rows )
	{
		if( !empty($rows['email_outgoing_to']) )
		{
			$to .= $rows['email_outgoing_to']."</br>";	
		}
	}
	
	return $to;
	
}

//---------------------------------------------------------------------------------------

/* properties		: Submit 
 *
 * @param 			: ${_REQUEST}
 * @author			: -
 */
function _select_row_monitor_id( $Id = 0  )
{
 $sql = sprintf("select a.* from egs_queue a where a.QueueId='%s'", $Id);
 $res = $this->db->query( $sql );
 if( $res -> num_rows() > 0 )
 {
	return $res->result_first_assoc();
 }
	
 return array();
} 


//---------------------------------------------------------------------------------------

/* properties		: Submit 
 *
 * @param 			: ${_REQUEST}
 * @author			: -
 */
 
 public function _set_event_save_row_pdf( $out  = null )
{

 if( !is_object( $out ) ){
	return FALSE;
 } 
 
 if( !$out->ProductId OR !$out->CustomerId)
 {
	 return FALSE;
 }
 
 // ------- get call user -------------------
 
 $obUser =& get_class_instance('M_SysUser');
 $rwUser = Objective( $obUser->_get_detail_user( $out->UserCreateId ));
 
 // ------ define  -------------------
 $PDF_CustomerId = $out->CustomerId;
 $PDF_ProductId = $out->ProductId;
 $PDF_User_Approve = $rwUser->get_value('Username', 'strtoupper');
 $PDF_Path_Location = $out->Run->argv_process;
 $PDF_File_Name = $out->Run->_file;
 $PDF_File_WriteTs = date('Y-m-d H:i:s');
 
 // -------------------------------------
 $this->db->reset_write();
 
 $this->db->set("PDF_CustomerId", $PDF_CustomerId);
 $this->db->set("PDF_ProductId", $PDF_ProductId);
 $this->db->set("PDF_User_Approve", $PDF_User_Approve); 
 $this->db->set("PDF_Path_Location",$PDF_Path_Location);
 $this->db->set("PDF_File_Name", $PDF_File_Name);
 $this->db->set("PDF_File_WriteTs", $PDF_File_WriteTs);
 
 $this->db->duplicate("PDF_Path_Location",$PDF_Path_Location);
 $this->db->duplicate("PDF_File_Name", $PDF_File_Name);
 $this->db->duplicate("PDF_File_WriteTs", $PDF_File_WriteTs);
 $this->db->insert_on_duplicate("t_gn_pdf_application");
 
 return true;
 
 } 


//---------------------------------------------------------------------------------------

/* properties		: Submit 
 *
 * @param 			: ${_REQUEST}
 * @author			: -
 */
 public function _select_row_mail_monitor()
{
  $ar_spool_monitor = array();
  $this->db->reset_select();
  
 $this->db->select("
	a.QueueId, 
	b.EmailCreateTs,
	( SELECT GROUP_CONCAT(dst.EmailDestination) from egs_destination dst 
	  WHERE dst.EmailReffrenceId=b.EmailOutboxId AND dst.EmailDirection =2) as SentTo,
	b.EmailSubject, 
	c.EmailStatusName, 
	a.QueueReason, 
	(UNIX_TIMESTAMP(NOW()) - UNIX_TIMESTAMP(a.QueueStatusTs )) as QueueTimeTs,
	
	a.QueueTrying", FALSE);
 $this->db->from("egs_queue a ");
 $this->db->join("egs_outbox b", "a.QueueMailId=b.EmailOutboxId","LEFT");
 $this->db->join("egs_status_refference c ","a.QueueStatus=c.EmailStatusCode","LEFT");
 $this->db->order_by("a.QueueMailId", "ASC");
 //echo $this->db->_get_var_dump();
 
 $rs = $this->db->get();
 $num = 0;
 if($rs->num_rows() > 0)
	//foreach( $rs-> result_assoc() as $rows )  
 {
	$ar_spool_monitor = (array)$rs->result_assoc();
 }
	
 return $ar_spool_monitor;
}

// ================== END CLASS ============================================================

}

?>
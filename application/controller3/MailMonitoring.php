<?php
//---------------------------------------------------------------------------------------

/* properties		: Submit 
 *
 * @param 			: ${_REQUEST}
 * @author			: -
 */
 
 
class MailMonitoring extends EUI_Controller
{

//---------------------------------------------------------------------------------------

/* properties		: Submit 
 *
 * @param 			: ${_REQUEST}
 * @author			: -
 */
 
 function __construct() 
{
	parent::__construct();
	$this->load->model(array(base_class_model($this)));
	$this->load->helper('EUI_Object');
	$this->load->helper('EUI_SMLGenerator');
	$this->load->helper('EUI_IMAP');
}
	
	
//---------------------------------------------------------------------------------------

/* properties		: Submit 
 *
 * @param 			: ${_REQUEST}
 * @author			: -
 */
 	
function index() 
{
	if( $this -> EUI_Session->_get_session('UserId') )
	{
		$this -> load -> view("mod_mail_monitor/view_mail_monitor_nav",array(null));
	}
}


//---------------------------------------------------------------------------------------

/* properties		: Submit 
 *
 * @param 			: ${_REQUEST}
 * @author			: -
 */
 
 
 public function Content()
{
	$obj =& get_class_instance('M_MailMonitoring');
	$this->load->view("mod_mail_monitor/view_mail_monitor_list", array( 
		'row' => $obj->_select_row_mail_monitor() 
	));	
}

//---------------------------------------------------------------------------------------

/* properties		: Submit 
 *
 * @param 			: ${_REQUEST}
 * @author			: -
 */
 
 public function Retry()
{
 $_conds = array('success' => 0 );
 $this->db->set('QueueTrying',0);
 $this->db->set('QueueStatus',0);
 $this->db->set('QueueReason','NULL',FALSE);
 $this->db->set('QueueStatusTs',date('Y-m-d H:i:s'));
 
 $this->db->where('QueueId', _get_post('MonitorId'));
 $this->db->update('egs_queue');
 if( $this->db->affected_rows() > 0 )
 {
	$_conds = array('success' => 1 );
 }
 
 echo json_encode($_conds);
	
}


//---------------------------------------------------------------------------------------

/* properties		: Submit 
 *
 * @param 			: ${_REQUEST}
 * @author			: -
 */
 
public function Cancel()
{

 $_conds = array('success' => 0 );
 
 $out = $this->{base_class_model($this)}->_select_row_monitor_id(_get_post('MonitorId'));
 $row =& new EUI_Object( $out );
  if( !$row->fetch_ready() ) 
 {
	return FALSE;
 }	 
 
 // ------------ 1 -----------------
 $this->db->reset_write();
 $this->db->where("EmailOutboxId",$row->get_value('QueueMailId'));
 $this->db->set("EmailStatus", 1006);
 $this->db->update("egs_outbox");
 
// --------- update on customer ----------------
 
 $this->EventUpdateOnMailStatus($row->get_value('QueueMailId'));
 
 // ------------ 2 -----------------
 $this->db->reset_write(); 
 $this->db->where('QueueId',_get_post('MonitorId'));	
 if($this->db->delete('egs_queue') ) 
{
	$_conds = array('success' => 1 );
 }
	
 echo json_encode($_conds);
	
}

//---------------------------------------------------------------------------------------

/* properties		: Submit 
 *
 * @param 			: ${_REQUEST}
 * @author			: -
 */
 
 public function Role()
{
  $role_object =& get_class_instance("M_UserRole");
  
  echo json_encode(array());
 
 } 


//---------------------------------------------------------------------------------------

/* properties		: Submit 
 *
 * @param 			: ${_REQUEST}
 * @author			: -
 */
 private function EventUpdateOnMailStatus( $OutboxId=0 ) 
 {
	$sql = sprintf("update t_gn_customer a
					inner join egs_outbox b on a.CustomerId=b.EmailAssignDataId
					set a.EmailStatus = b.EmailStatus
					where b.EmailOutboxId='%s'", $OutboxId);					
	$this->db->query($sql);
}
 
//---------------------------------------------------------------------------------------

/* properties		: Submit 
 *
 * @param 			: ${_REQUEST}
 * @author			: -
 */
 
 private function EventSetOutbox( $OutboxId= 0)
{
  if( $OutboxId ) 
 {
	$this->db->select('*');
	$this->db->from('egs_outbox a');
	$this->db->where('a.EmailOutboxId', $OutboxId);
	return $this->db->get(); 
  }
  else {
	return null;
  }	
}
 
//---------------------------------------------------------------------------------------

/* properties		: Submit 
 *
 * @param 			: ${_REQUEST}
 * @author			: -
 */
  
 public function EventSetSpool( $out = null )
{
	$TryOut = (int)$out->get_value('OUTBOX_SEND_RETRY');
	$this->db->reset_select();
	$this->db->select('*',FALSE);
	$this->db->from('egs_queue a');
	$this->db->where("a.QueueTrying<=$TryOut","", FALSE);
	$this->db->where_not_in('QueueStatus', array(1003)); 
	$this->db->order_by('QueueId','ASC');
	return $this->db->get();
}


/*
 * @ def 		: SetSaveError
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 private function EventDeleteError($QueueId = 0 )
{
	
 $count = 0;
 if( $QueueId )
 {
	$this->db->reset_write(); 
	$this->db->where('QueueId',$QueueId);
	$this->db->delete('egs_queue');
	
	if( $this->db->affected_rows() > 0 ) {
		$count++;
	}
 }
return $count;
 
}
 
//---------------------------------------------------------------------------------------

/* properties		: Submit 
 *
 * @param 			: ${_REQUEST}
 * @author			: -
 */
  
public function EventSetError( $QueueId = 0 , $OutboxId = 0 , $message = '', $error_code=1004 )
{
  if( $QueueId )
{	
	$this->db->reset_write();
	$this->db->set('QueueStatus', $error_code);
	$this->db->set('QueueReason', $message);
	$this->db->set('QueueTrying','((QueueTrying)+1)', FALSE);
	$this->db->set('QueueStatusTs', date('Y-m-d H:i:s'));
	$this->db->where('QueueId',$QueueId);
	$this->db->update('egs_queue');
		
	if( $this->db->affected_rows() > 0 )
	{
		$this->db->set('EmailStatus',$error_code);
		$this->db->set('EmaiUpdateTs',date('Y-m-d H:i:s'));
		$this->db->where('EmailOutboxId',$OutboxId);
		$this->db->update('egs_outbox');
			
		if( $this->db->affected_rows() > 0 )
		{
			$this->EventUpdateOnMailStatus($OutboxId);
			$this->db->reset_write();
			$this->db->set('HistoryRefferenceId',$OutboxId); 
			$this->db->set('HistoryStatus', $error_code);
			$this->db->set('HistoryDirection',2); 
			$this->db->set('HistoryReason', $message);
			$this->db->set('HistoryCreateTs',date('Y-m-d H:i:s'));
			$this->db->insert('egs_history');
		}
	}
 }
	
}


//---------------------------------------------------------------------------------------

/* properties		: Submit 
 *
 * @param 			: ${_REQUEST}
 * @author			: -
 */
 
function getEventCc( $OutboxId = 0 )
{
  
  $rows = array();
  if( $OutboxId ) 
  {
	$this->db->select("*");
	$this->db->from("egs_copy_carbone");
	$this->db->where("EmailReffrenceId", $OutboxId);
	$this->db->where("EmailDirection",2);
	
	if( $OutboxId ){
		$rows = $this->db->get();
	}
  }
  
  return $rows;
}



//---------------------------------------------------------------------------------------

/* properties		: Submit 
 *
 * @param 			: ${_REQUEST}
 * @author			: -
 */
 
public function getEventBcc( $OutboxId = 0 )
{
  $rows = array();
  if( $OutboxId ) 
  {
	$this->db->select("*");
	$this->db->from("egs_blindcopy_carbone");
	$this->db->where("EmailReffrenceId", $OutboxId);
	$this->db->where("EmailDirection",2);
	
	if( $OutboxId ){
		$rows = $this->db->get();
	}
  }
  
  return $rows;
}

//---------------------------------------------------------------------------------------

/* properties		: Submit 
 *
 * @param 			: ${_REQUEST}
 * @author			: -
 */
 
public function getEventDestination( $OutboxId = 0 )
{
  $rows = array();
  if( $OutboxId ) 
  {
	$this ->db->select("*");
	$this ->db->from("egs_destination");
	$this ->db->where("EmailReffrenceId", $OutboxId);
	$this->db->where("EmailDirection",2);
	
	if( $OutboxId ){
		$rows =$this->db->get();
	}
  }
  
  return $rows;
}

//---------------------------------------------------------------------------------------

/* properties		: Submit 
 *
 * @param 			: ${_REQUEST}
 * @author			: -
 */
 
public function getEventAttachment($OutboxId = 0)
{
  $rows = array();
  if( $OutboxId ) 
  {
	$this ->db->select("*");
	$this ->db->from("egs_attachment_url");
	$this ->db->where("EmailReffrenceId", $OutboxId);
	
	if( $OutboxId ){
		$rows =$this->db->get();
	}
  }
  
  return $rows;
		
}


//---------------------------------------------------------------------------------------

/* properties		: Submit 
 *
 * @param 			: ${_REQUEST}
 * @author			: -
 */
 
 private function SetEventProcess($Mailer, $OutboxId)
{

// -------------------to ------------------------------

	$dest = $this->getEventDestination( $OutboxId );
	if( is_object($dest) ){foreach( $dest->result_assoc() as $rows )
	{
		if( trim($rows['EmailDestination'])!='' ){
			$Mailer->addAddress($rows['EmailDestination'],$rows['EmailDestination']);
		}
	}}
				
//-------------- cc --------------------------------
				
	$CC = $this->getEventCc( $OutboxId );
	if(is_object($CC) ){foreach( $CC->result_assoc() as $rows )
	{
		if( trim($rows['EmailCC'])!='' ){
			$Mailer->addCC($rows['EmailCC'],$rows['EmailCC']);
		}
	}}
				
//-------------------------- bcc -------------------------

	$BCC = $this->getEventBcc( $OutboxId );
	if(is_object($BCC)){foreach( $BCC->result_assoc() as $rows )
	{
		if( trim($rows['EmailBCC'])!='' ){
			$Mailer->addBCC($rows['EmailBCC'],$rows['EmailBCC']);
		}
	}}
	
// ------------------- get Event ----------- 
	$Attachment = $this->getEventAttachment($OutboxId);
	if( is_object($Attachment) ){ foreach( $Attachment->result_assoc() as $rows )
	{
		if( trim($rows['EmailAttachmentPath'])!=''){
			$Mailer->addAttachment($rows['EmailAttachmentPath']);
		}
	}}	
}

//---------------------------------------------------------------------------------------

/* properties		: Submit 
 *
 * @param 			: ${_REQUEST}
 * @author			: -
 */
 
 private function EventSetExecute( $Mailer, $out )
{
 
 $qry = $this->EventSetSpool( $out );
 $i = 0;
 if( ($qry !=FALSE ) && ( $qry->num_rows() > 0) ) 
	foreach( $qry->result_assoc() as $rows  )
 {
	 
	$row =& new EUI_Object( $rows );
	if( !$row->fetch_ready() ) {
		return false;
	}
	
	
	$QueueId = $row->get_value('QueueId');
	
 // -------------- testing ok -------------------------------
 
	$QueueTrying = (int)$out->get_value('QueueTrying');
	$CountTrying = (int)$out->get_value('OUTBOX_SEND_RETRY');
	
	if( $QueueTrying < $CountTrying )
	{
		/** global attributes **/
		$Mailer->setFrom( $out->get_value('OUTBOX_SMTP_AUTH'), $out->get_value('OUTBOX_SMTP_NAME') );
		$Mailer->ConfirmReadingTo = $out->get_value('OUTBOX_SMTP_AUTH');
		
		$OutboxId = $row->get_value('QueueMailId');
		$Outbox = self::EventSetOutbox($OutboxId);
		if( $Outbox->num_rows() > 0 )
		{
			$objOut =& new EUI_Object( $Outbox->result_first_assoc() );	
			if( $objOut->fetch_ready() )
			{
				$Mailer->Subject = $objOut->get_value('EmailSubject');
				if( strlen( $objOut->get_value('EmailContent') ) > 0 ) {
					$Mailer->IsHTML(true);
					$Mailer->msgHTML( $objOut->get_value('EmailContent') );
				}	
				else {
					$Mailer->msgHTML("To view the message, please use an HTML compatible email viewer!");
				}
					$Mailer->AltBody = 'To view the message, please use an HTML compatible email viewer!';
			}
		}
		
		self::SetEventProcess($Mailer, $OutboxId);
		
		try 
		{
			echo "$i\n\r";
			self::EventSetError($QueueId, $OutboxId, 'On Progreess', 1005);
			
			if( $Mailer->send() ) 
			{
				$this->db->reset_write();	
				$this->db->set('EmailStatus',1003);
				$this->db->set('EmaiUpdateTs',date('Y-m-d H:i:s'));
				$this->db->where('EmailOutboxId',$OutboxId);
				$this->db->update('egs_outbox');
				
				if( $this->db->affected_rows() > 0 )
				{
					$this->EventUpdateOnMailStatus($OutboxId);
					
					$this->db->reset_write();
					$this->db->set('HistoryRefferenceId',$OutboxId); 
					$this->db->set('HistoryStatus',1003);
					$this->db->set('HistoryDirection',2); 
					$this->db->set('HistoryReason', "SENT OK");
					$this->db->set('HistoryCreateTs',date('Y-m-d H:i:s'));
					$this->db->insert('egs_history');
					
					if( $this->db->affected_rows() > 0 ) 
					{
						$this->db->reset_write();
						$this->db->where("QueueId", $QueueId);
						$this->db->delete('egs_queue');
					}	
				}
				$Mailer->clearAllRecipients();
				$Mailer->clearAttachments();
				
			// --- if send then set its  ---- 	
				$this->EventSetEventMsgId($Mailer, $OutboxId ); // set msg id 
				
			}
			else {
				self::EventSetError( $QueueId, $OutboxId, $Mailer->getError(), 1004);
			}
			
		 } 
		 catch (phpmailerException $e){
			self::EventSetError( $QueueId, $OutboxId, $e->errorMessage(), 1004);
		 } 
		 catch (Exception $e) {
			self::EventSetError( $QueueId, $OutboxId, $e->errorMessage(), 1004);
		 }
		
	}
	else{
		
	//	self::EventDeleteError( $QueueId ); 	
	}
	   
	$i++;
  }
}

//---------------------------------------------------------------------------------------

/* properties		: Submit 
 *
 * @param 			: ${_REQUEST}
 * @author			: -
 */
 
public function EventSetEventMsgId( $Mailer = null, $OutboxId = 0 )
{
	if( !is_object($Mailer) ){
		return false;
	}
	
	// --------------- msg id  -----------------
	$MessageID  = $Mailer->getLastMessageID();
	if( strlen($MessageID)  > 1 )
	{
		$MessageID = preg_replace("[<|>]", "", $MessageID);
		$this->db->reset_write();	
		$this->db->set('EmailMsgId',$MessageID);
		$this->db->where('EmailOutboxId',$OutboxId);
		$this->db->update('egs_outbox');
	}
	
	return true;
} 
 
//---------------------------------------------------------------------------------------

/* properties		: Submit 
 *
 * @param 			: ${_REQUEST}
 * @author			: -
 */
 
 public function EventOutboxListener()
{
	
 $Mailer = FALSE;
 $this->load->library('EUI_Mailer');	
  if( class_exists('EUI_Mailer') )
 {
	$Mailer =& get_class_instance('EUI_Mailer');
 }
 

 
// -------------- config data --------------------------
 
  $config =&SML_Generator()->select_config();
  if( is_array( $config ) ) 
 {
	 
  $out =& new EUI_Object( $config );
  if( !$out->fetch_ready() ) { return FALSE; }
	
  $Mailer->SMTPAuth  = true;  // enable SMTP authentication 
  $Mailer->SMTPDebug = $out->get_value('OUTBOX_SMTP_DEBUG');
  $Mailer->isSMTP();   // telling the class to use SMTP
  $Mailer->SetFrom( $out->get_value('OUTBOX_SMTP_AUTH'),  $out->get_value('EMAIL_SMTP_LIGHTTEXT'));
  
   if( ($out->get_value('OUTBOX_SMTP_SECURE') == 'NULL') 
	 OR  ( $out->get_value('OUTBOX_SMTP_SECURE') == 0 ))
  {
	$Mailer->SMTPSecure = '';
  }	
	
 // --- is not ssl 
 
  if( $out->get_value('OUTBOX_SMTP_SECURE') == 1){
	$Mailer->SMTPSecure = $out->get_value('OUTBOX_SMTP_SECURE');
  }
  
  // -- is ssl -- 
  
   if( $out->get_value('OUTBOX_SMTP_SECURE') == 'ssl' )
  {
	 $Mailer->SMTPSecure = 'ssl';
  }
  
   
   $Mailer->Port 		= $out->get_value('OUTBOX_SMTP_PORT');  			// set the SMTP port
   $Mailer->Host 		= $out->get_value('OUTBOX_SMTP_HOST'); 				// SMTP server
   $Mailer->Username 	= $out->get_value('OUTBOX_SMTP_AUTH');				// SMTP account username
   $Mailer->Password 	= $out->get_value('OUTBOX_SMTP_PASSWORD');	 		// SMTP account password 
} 
  
  if( (bool)$Mailer !=FALSE )
  {
	$this->EventSetExecute( $Mailer, $out ); 
  }
 // end function  ===>
}



 
//---------------------------------------------------------------------------------------

/* properties		: Submit 
 *
 * @param 			: ${_REQUEST}
 * @author			: -
 */
 
 public function EventInboxListener()
{
  $Imap =& get_class_instance('EUI_ImapApi_helper');
  $Imap->Imap_while_loop('UNSEEN');
 } 

//---------------------------------------------------------------------------------------

/* properties		: Submit 
 *
 * @param 			: ${_REQUEST}
 * @author			: -
 */
 
 function EventSenderApplication()
{
 
 $objType =& get_class_instance('M_SetProduct');
 
 // -- call generator process PDF & Mail --
 
 $out =& get_class_instance('M_ApplicationSender');
 $mod =& get_class_instance('M_MailMonitoring');
 
// -- select on tmp  -- 

 $this->db->reset_select();
 $this->db->select("*");
 $this->db->from("t_gn_approval_tmp a ");
 $this->db->order_by("a.ApprovalDateTs", "ASC");
 $this->db->limit(1);
 
 $rs = $this->db->get();
 if( is_object($rs) AND $rs->num_rows() > 0 ) 
	foreach( $rs->result_assoc() as $rows )
 {
	$row = Objective($rows);
	
	if( $row->find_value('CustomerId') )  
	{
		$Type = $objType->_select_product_type( $row->get_value('ProductId'));
		
		// if long form will generate & sent to email gw 
		
		if( $Type == PRODUCT_LONG_FORM )
		{
			$cond = $out->_set_inialize_row_application(array( 
				'CustomerId' => $row->get_value('CustomerId'),
				'ProductId' => $row->get_value('ProductId'),
				'UserCreateId' => $row->get_value('ApprovalByUserId')	
			))->_set_send_row_application(false);
			
			
			//-- look at if return object -- 
			
			if( is_object( $cond ) ) {
				$mod->_set_event_save_row_pdf( $cond );
				$sql = sprintf( "DELETE FROM t_gn_approval_tmp WHERE CustomerId='%s'", $row->get_value('CustomerId'));
				$this->db->query($sql);	
				printf("Success Send With CustomerId : %s\n\r", $row->get_value('CustomerId'));
			}
		
		}
		
		// if Not long form will generate Only 
		
		if( $Type == PRODUCT_SHORT_FORM ) 
		{
			$cond = $out->_set_inialize_row_application(array( 
				'CustomerId' => $row->get_value('CustomerId'),
				'ProductId' => $row->get_value('ProductId'),
				'UserCreateId' => $row->get_value('ApprovalByUserId')	
			))->_set_send_row_application(true);
			
			
			//-- look at if return object -- 
			
			if( is_object( $cond ) ) {
				$mod->_set_event_save_row_pdf( $cond );
				$sql = sprintf( "DELETE FROM t_gn_approval_tmp WHERE CustomerId='%s'", $row->get_value('CustomerId'));
				$this->db->query($sql);	
				printf("Success Send With CustomerId : %s\n\r", $row->get_value('CustomerId'));
			}
		}
		
		
	}
 } else {
	 printf("No Record (%s)\n\r",0);
 }
 
	
 }
 
// =============== END CLASS ==================================	

}
?>
<?php 
 //display();
 $this->load->helpers(array('EUI_Object','EUI_Page','EUI_Spiner'));
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 
 $outs = UR();
 $spiner =& Singgleton("EUI_Spiner");
 
 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
 $spiner->set_field_order( $outs->get_value('orderby'), $outs->get_value('type'));
 $spiner->set_max_adjust(5);
 
 if( $outs->find_value('handler') ){
	$spiner->set_func_page_table( $outs->field("handler"));
 }
 
 $spiner->set_width_table(99); // "percent"
 $spiner->set_height_row_body(32); // px 
 $spiner->set_height_row_header(27); // px 
 
// ------------ source  ---------------------------
// $spiner->set_field_add_header(FormbarLabel());

 $spiner->set_name_table("id-page-call-history-data");
 $spiner->set_content_row_table( $content_pages );
 $spiner->set_total_row_record($total_records);
 $spiner->set_total_row_page($total_pages);
 $spiner->set_select_row_page($select_pages);
 $spiner->set_start_row_page($start_page);
 
/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
 //debug($spiner->select_pager_debug());
 $spiner->set_checkbox_table(array());
 
/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
   // Array
// (
    // [HS_Call_Id] => HS_Call_Id
    // [HS_Call_CreateDateTs] => HS_Call_CreateDateTs
    // [HS_Call_CategoryId] => HS_Call_CategoryId
    // [HS_Call_ReasonId] => HS_Call_ReasonId
    // [HS_Call_UserId] => HS_Call_UserId
    // [HS_Call_Remarks] => HS_Call_Remarks
// )
 $spiner->set_field_header( array (
	"HS_Call_CreateDateTs"  => lang(array("HS_Call_CreateDateTs")),
	// "HS_Call_PhoneNum"		=> lang(array("HS_Call_PhoneNum")),
	"HS_Call_CategoryId" 	=> lang(array("HS_Call_CategoryId")),
	"HS_Call_ReasonId" 		=> lang(array("HS_Call_ReasonId")),
	"HS_Call_UserId"		=> lang(array("HS_Call_UserId")),
	"HS_Call_Remarks" 		=> lang(array("HS_Call_Remarks"))
  ));
  
/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
    
	
  $spiner->set_field_header_wrap(array(
	"HS_Call_CreateDateTs"  => 'nowrap', 
	"HS_Call_CategoryId" 	=> 'nowrap', 
	"HS_Call_ReasonId" 		=> 'nowrap', 
	"HS_Call_UserId"		=> 'nowrap', 
	"HS_Call_Remarks" 		=> 'nowrap' 
  ));
  
   $spiner->set_field_wrap(array(
	"HS_Call_CreateDateTs"  => 'nowrap' 
	
  ));
  
/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
    
 $spiner->set_field_align(array (
	"HS_Call_CreateDateTs"  => 'center', 
	"HS_Call_CategoryId" 	=> 'left', 
	"HS_Call_ReasonId" 		=> 'left', 
	"HS_Call_UserId"		=> 'left', 
	"HS_Call_Remarks" 		=> 'left' 
 ));
 
 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
 $spiner->set_field_call_back(array(
	"HS_Call_CreateDateTs"	=> array("SetDateTime"),
	"HS_Call_CategoryId" => array("AllCallStatus"),
	// "HS_Call_PhoneNum" => array("SetMasking"),
	"HS_Call_ReasonId" => array('AllCallReason'),
	"HS_Call_UserId" => array('AllUser','SetCapital'),
	"HS_Call_Remarks" =>array('SetCapital'), 
	
 ));
  
 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
 $spiner->select_spiner_table_page();
 
 ?>
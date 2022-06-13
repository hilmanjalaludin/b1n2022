<?php 
 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
 $this->load->helpers(array('EUI_Object','EUI_Page','EUI_Spiner'));
 
 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
 $pager  = UR();
 $spiner =&Singgleton("EUI_Spiner");
 
 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
 $spiner->set_field_order( $pager->get_value('orderby'), $pager->get_value('type'));
 $spiner->set_max_adjust(5);
 
 
 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 $spiner->set_func_page_table('EventSpiner'); 
 if( $pager->find_value('handler') ){ 
	$spiner->set_func_page_table( $pager->field('handler') );
 }

 $spiner->set_width_table(99); // "percent"
 $spiner->set_height_row_body(32); // px 
 $spiner->set_height_row_header(27); // px 
 
// ------------ source  ---------------------------
// $spiner->set_field_add_header(FormbarLabel());

 $spiner->set_name_table("ui-pager-cm-data");
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
 
 $spiner->set_checkbox_table(array(
	'field' => 'DM_Id', 
	'event' => 'ActionCheckCm' ));
	
 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
   
 $spiner->set_field_header( array (
	"DM_Id"     	=> lang("Cust Id"),
	"DM_Custno" 			=> lang("Cust No"),
	"DM_FirstName" 			=> lang("Nama"),
  "DM_CampaignId"			=> lang("Campaign ID"),
	"CampaignDesc"			=> lang("Campaign"),
	"DM_CallReasonKode"	=> lang("Call Reason Code"),
  "CampaignStatusFlag"	=> lang("Status Campaign"),
));
 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
    
	
  $spiner->set_field_header_wrap(array(
    "DM_Id"      	=> "nowrap",
    "DM_Custno" 			=> "nowrap",
    "DM_FirstName" 			=> "nowrap",
    "DM_CampaignId"			=> "nowrap",
    "CampaignDesc"			=> "nowrap",
    "DM_CallReasonKode"			=> "nowrap",
    "CampaignStatusFlag"			=> "nowrap"
  ));	
 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */	
 $spiner->set_field_wrap(array(
	  "DM_Id"      	=> "nowrap",
    "DM_Custno" 			=> "nowrap",
    "DM_FirstName" 			=> "nowrap",
    "DM_CampaignId"			=> "nowrap",
    "CampaignDesc"			=> "nowrap",
    "DM_CallReasonKode"			=> "nowrap",
    "CampaignStatusFlag"			=> "nowrap"
	));	
 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
    
 $spiner->set_field_align(array (
	"DM_Id"      	=> "left",
	"DM_Custno" 			=> "left",
	"DM_FirstName" 			=> "left",
  "DM_CampaignId" 		=> "left",
	"CampaignDesc" 		=> "left",
	"DM_CallReasonKode" 	=> "left",
  "CampaignStatusFlag" 	=> "left",
	));
 
 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
//  $spiner->set_field_call_back(array(
// 	"DM_UpdatedTs"		=> array("SetDateTime"),
// 	"DM_Custno" 		=> array("SetBoldColor"),
// 	"DM_CrLimit" 		=> array('SetCurrency'),
// 	"DM_CcLimit" 		=> array('SetCurrency'),
// 	"DM_DataAvailSS"    => array('SetCurrency'),	
	
// 	"DM_HomePhoneNum"	=> array('SetMasking'),
// 	"DM_MobilePhoneNum"	=> array('SetMasking'),
// 	"DM_OfficePhoneNum"	=> array('SetMasking'),
// 	"DM_OtherPhoneNum"	=> array('SetMasking'),
	
	 
// 	"CampaignDesc" 	=> array('CampaignId'),
// 	"DM_GenderId"		=> array('SetCapital'),
// 	"DM_Dob" 			=> array('SetDate'),
// 	"DM_AssignDateTs" 	=> array('SetDateTime'),
// 	'DM_LastCategoryKode'	=> array('AllCallCategoryCode','SetCaptionName'),
// 	'DM_LastReasonKode'	=> array('AllCallReasonCode','SetCaptionName'),
// 	"DM_SellerId" 		=> array("AllUser", "SetCapital", "SetCaptionKode" ) ));
  
 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
 $spiner->select_spiner_table_page();
 
 // END CLASS DATA OPTION
//  printf("<div class='ui-widget-info-error'><p>%s</p></div>", 
// 		"* ) Data yang dapat di customer master adalah data-data dengan status New");
 
 
 ?>
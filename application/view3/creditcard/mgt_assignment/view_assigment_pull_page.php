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

 $spiner->set_name_table("ui-pager-pull-data");
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
	'field' => 'PullAssignId', 
	'event' => 'ActionCheckPull' ));
	
 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
   
 $spiner->set_field_header( array (
	"DM_CampaignId"     	=> lang(array("LB_CampaignId")),
	"DM_Custno" 			=> lang(array("LB_CustomerNumber")),
	"DM_FirstName" 			=> lang(array("LB_CustomerName")),
	"DM_GenderId"			=> lang(array("LB_GenderId")),
	"DM_Dob"				=> lang(array("LB_CustomerDOB")),
	"DM_Age"				=> lang(array("DM_Age")),
	"DM_MotherName"			=> lang(array("LB_MotherName")),
	"DM_HomePhoneNum" 		=> lang(array("LB_CustomerHomePhoneNum")),
	"DM_MobilePhoneNum" 	=> lang(array("LB_CustomerMobilePhoneNum")),
	"DM_OfficePhoneNum" 	=> lang(array("LB_CustomerWorkPhoneNum")),
	"DM_OtherPhoneNum"		=> lang(array("LB_CustomerOtherPhone")),
	"DM_CcTypeName"			=> lang(array("LB_CardType")),
	"DM_CrLimit"			=> lang(array("LB_CreditLimit")),
	"DM_DataAvailSS"		=> lang(array("DM_DataAvailSS")),
	"DM_CcLimit"			=> lang(array("LB_LimitNTBD")),	 
	"DM_SellerId"			=> lang(array("LB_UserDisposition")),
	"DM_LastCategoryKode" 	=> lang(array("DM_LastCategoryKode")),
	"DM_LastReasonKode" 	=> lang(array("DM_LastReasonKode")),
	"DM_Assign_Mode"		=> lang(array("DM_Assign_Mode")),	
	"DM_AssignDateTs"   	=> lang(array("LB_DateAssignment")),
	"DM_UpdatedTs"			=> lang(array("LB_CustomerUpdatedTs")) ));
 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
    
	
  $spiner->set_field_header_wrap(array(
	"DM_CampaignId"      => "nowrap",
	"DM_Custno" 		=> "nowrap",
	"DM_FirstName" 		=> "nowrap",
	"DM_MotherName"		=> "nowrap",
	"DM_CcTypeName"		=> "nowrap",
	"DM_CrLimit"		=> "nowrap", 
	"DM_CcLimit"		=> "nowrap",
	"DM_DataAvailSS"		=> "nowrap",	
	"DM_HomePhoneNum" 	=> "nowrap",
	"DM_MobilePhoneNum" => "nowrap",
	"DM_OfficePhoneNum" => "nowrap",
	"DM_OtherPhoneNum"	=> "nowrap", 
	"DM_UploadedTs"		=> "nowrap",
	"DM_LastCategoryKode"=> "nowrap",
	"DM_Assign_Mode"	=> "nowrap",
	"DM_LastReasonKode" => "nowrap",
	"DM_SellerId"		=> "nowrap",
	"DM_UpdatedTs"		=> "nowrap" ));	
 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */	
 $spiner->set_field_wrap(array(
	"DM_UploadedTs"		=> "nowrap",
	"DM_FirstName"		=> "nowrap",
	"DM_MotherName"		=> "nowrap",
	"DM_AssignDateTs" 	=> "nowrap",
	"DM_UpdatedTs" 		=> "nowrap",
	"DM_SellerId" 		=> "nowrap" ));	
 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
    
 $spiner->set_field_align(array (
	"DM_Recsource"      	=> "left",
	"DM_Custno" 			=> "left",
	"DM_FirstName" 			=> "left",
	"DM_HomePhoneNum" 		=> "left",
	"DM_MobilePhoneNum" 	=> "left",
	"DM_OfficePhoneNum" 	=> "left",
	"DM_OtherPhoneNum"		=> "left",
	"DM_Process" 			=> "center",
	"DM_UploadedTs"			=> "center",
	"DM_CrLimit"			=> "right",
	"DM_DataAvailSS"		=> "right",
	"DM_CcLimit"			=> "right",
	"DM_CampaignId"			=> "center",
	"DM_Age"				=> "center",
	"DM_GenderId"			=> "center",
	"DM_Assign_Mode"		=> 'center' ));
 
 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
 $spiner->set_field_call_back(array(
	"DM_UpdatedTs"		=> array("SetDateTime"),
	"DM_Custno" 		=> array("SetBoldColor"),
	"DM_CrLimit" 		=> array('SetCurrency'),
	"DM_CcLimit" 		=> array('SetCurrency'),
	"DM_DataAvailSS"    => array('SetCurrency'),
	"DM_OfficePhoneNum" => array('SetCapital'),
	"DM_OtherPhoneNum" 	=> array('SetCapital'),
	"DM_CampaignId" 	=> array('CampaignId'),
	"DM_GenderId"		=> array('SetCapital'),
	"DM_Dob" 			=> array('SetDate'),
	"DM_HomePhoneNum"	=> array('SetMasking'),
	"DM_MobilePhoneNum" => array('SetMasking'),
	"DM_OfficePhoneNum" => array('SetMasking'),
	"DM_OtherPhoneNum"	=> array('SetMasking'),
	"DM_AssignDateTs" 	=> array('SetDateTime'),
	'DM_LastCategoryKode'	=> array('AllCallCategoryCode','SetCaptionName'),
	'DM_LastReasonKode'	=> array('AllCallReasonCode','SetCaptionName'),
	"DM_SellerId" 		=> array("AllUser","SetCaptionKode", "SetCapital","SetBoldColor") ));
  
 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
 $spiner->select_spiner_table_page();
 // END CLASS DATA OPTION
 printf("<div class='ui-widget-info-error'><p>%s</p></div>", 
		"* ) Data yang dapat di Tarik adalah data-data dengan status NEW.");
 
 
 ?>
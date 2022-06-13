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
 $spiner->set_func_page_table("EventBucketData");
 $spiner->set_width_table(99); // "percent"
 $spiner->set_height_row_body(32); // px 
 $spiner->set_height_row_header(27); // px 
 
// ------------ source  ---------------------------
// $spiner->set_field_add_header(FormbarLabel());

 $spiner->set_name_table("id-bucket-data");
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
  
// debug($spiner->select_pager_debug());
 
 $spiner->set_checkbox_table(array(
	'field' => 'BucketId', 
	'event' => 'EventLookup'
 ));
/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
   
 $spiner->set_field_header( array
 (
	"BM_Recsource"      => lang(array("LB_Recsource")),
	"BM_Custno" 		=> lang(array("LB_CustomerNumber")),
	"BM_FirstName" 		=> lang(array("Customer Name")),
	
	"BM_MotherName"		=> lang(array("LB_MotherName")),
	"BM_Dob"			=> lang(array("LB_CustomerDOB")),
	"BM_CcTypeName"		=> lang(array("LB_CardType")),
	"BM_CrLimit"		=> lang(array("LB_CreditLimit")),
	
	"BM_HomePhoneNum" 	=> lang(array("LB_CustomerHomePhoneNum")),
	"BM_MobilePhoneNum" => lang(array("LB_CustomerMobilePhoneNum")),
	"BM_OfficePhoneNum" => lang(array("LB_CustomerWorkPhoneNum")),
	"BM_OtherPhoneNum"	=> lang(array("LB_CustomerOtherPhone")),
	"BM_CcLimit"		=> lang(array("LB_LimitNTBD")),	
	"BM_Process" 		=> lang(array("LB_CustomerProcess")),
	"BM_UploadedTs"		=> lang(array("LB_CustomerUploadedTs"))
  ));
/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
    
	
  $spiner->set_field_header_wrap(array(
		"BM_Recsource"      => "nowrap",
		"BM_Custno" 		=> "nowrap",
		"BM_FirstName" 		=> "nowrap",
		"BM_MotherName"		=> "nowrap",
		"BM_CcTypeName"		=> "nowrap",
		"BM_CrLimit"		=> "nowrap",
		"BM_MotherName"		=> "nowrap",
		"BM_CcLimit"		=> "nowrap",
		"BM_HomePhoneNum" 	=> "nowrap",
		"BM_MobilePhoneNum" => "nowrap",
		"BM_OfficePhoneNum" => "nowrap",
		"BM_OtherPhoneNum"	=> "nowrap",
		"BM_Process" 		=> "nowrap",
		"BM_UploadedTs"		=> "nowrap"
	));	
/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
    
 $spiner->set_field_align(array (
	"BM_Recsource"      => "left",
	"BM_Custno" 		=> "left",
	"BM_FirstName" 		=> "left",
	"BM_HomePhoneNum" 	=> "left",
	"BM_MobilePhoneNum" => "left",
	"BM_OfficePhoneNum" => "left",
	"BM_OtherPhoneNum"	=> "left",
	"BM_Process" 		=> "center",
	"BM_UploadedTs"		=> "center",
	"BM_CrLimit"		=> "right",
	"BM_CcLimit"		=> "right"
	
 ));
 
 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
 $spiner->set_field_call_back(array(
	"BM_UploadedTs"	=> array("SetDateTime"),
	"BM_Custno" => array("SetBoldColor"),
	"BM_CrLimit" => array('SetCurrency'),
	"BM_CcLimit" => array('SetCurrency')
	
 ));
  
 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
 $spiner->select_spiner_table_page();
 
 ?>
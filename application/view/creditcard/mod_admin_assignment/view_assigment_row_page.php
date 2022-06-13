<?php 
 //display();
 $this->load->helpers(array('EUI_Object','EUI_Page','EUI_Spiner'));
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 
 $out = UR();
 $spiner =& Singgleton("EUI_Spiner");
 
 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
 $spiner->set_field_order( $out->get_value('orderby'), $out->get_value('type'));
 $spiner->set_func_page_table($out->field('handler'));
 
 $spiner->set_max_adjust(5);
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
 // Array
// (
    // [DM_AssignId] => DM_AssignId
    // [DM_CampaignId] => DM_CampaignId
    // [DM_FirstName] => DM_FirstName
    // [DM_Custno] => DM_Custno
    // [DM_DataType] => DM_DataType
    // [DM_AddressLine1] => DM_AddressLine1
    // [DM_AddressLine2] => DM_AddressLine2
    // [DM_AddressLine3] => DM_AddressLine3
    // [DM_SellerKode] => DM_SellerKode
    // [DM_CallCategoryKode] => DM_CallCategoryKode
    // [DM_QualityUserId] => DM_QualityUserId
    // [DM_QualityCategoryKode] => DM_QualityCategoryKode
    // [DM_AdmId] => DM_AdmId
    // [DM_AdmCategoryKode] => DM_AdmCategoryKode
// )
 $spiner->set_checkbox_table(array(
	'field' => 'DM_AssignId', 
	'event' => 'EventLookup'
 ));
/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */

 $spiner->set_field_header( array(
	"DM_CampaignId"      		=> lang(array("DM_CampaignId")),
	"DM_Custno" 		 		=> lang(array("DM_Custno")),
	"DM_FirstName" 		 		=> lang(array("DM_FirstName")), 
	"DM_AddressLine1"    		=> lang(array("DM_AddressLine1")),
	"DM_AddressLine2"    		=> lang(array("DM_AddressLine2")),
	"DM_AddressLine3"    		=> lang(array("DM_AddressLine3")),
	"DM_DataType"				=> lang(array("DM_DataType")), 
	"DM_SellerKode"		 		=> lang(array("DM_SellerKode")), 
	"DM_CallCategoryKode"    	=> lang(array("DM_CallCategoryKode")),
	"DM_QualityUserId"     		=> lang(array("DM_QualityUserId")),
	"DM_QualityCategoryKode" 	=> lang(array("DM_QualityCategoryKode")),
	"DM_AdmId"					=> lang(array("DM_AdmId")),
	"DM_AdmCategoryKode"		=> lang(array("DM_AdmCategoryKode")) ,
	"DM_QualityUpdateTs"		=> lang(array("DM_QualityUpdateTs")) 
  ));
  
/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
    
	
  $spiner->set_field_header_wrap(array(
		"DM_CampaignId"				=> "nowrap",
		"DM_DataType"       		=> "nowrap",
		"DM_Custno" 				=> "nowrap",
		"DM_FirstName" 				=> "nowrap",
		"DM_MotherName"				=> "nowrap",
		"DM_AddressLine1"   		=> "nowrap",
		"DM_AddressLine2"   		=> "nowrap",
		"DM_AddressLine3"   		=> "nowrap", 
		"DM_SellerKode" 	   		=> "nowrap",
		"DM_CallCategoryKode"  		=> "nowrap",
		"DM_QualityUserId" 			=> "nowrap",
		"DM_QualityCategoryKode"	=> "nowrap",
		"DM_AdmId" 					=> "nowrap",
		"DM_AdmCategoryKode"		=> "nowrap",
		"DM_QualityUpdateTs"		=> "nowrap"
	));	
	
 $spiner->set_field_wrap(array( 
	'DM_FirstName' => 'nowrap'
 ));
 
/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
    
$spiner->set_header_align(array (
	'DM_DataType' 				=> 'center',
	'DM_CallCategoryKode' 		=> 'center',
	'DM_QualityCategoryKode' 	=> 'center',
	'DM_AdmCategoryKode'		=> 'center',
	"DM_CampaignId"				=> "center" ));	


 $spiner->set_field_align(array (
	'DM_DataType' 				=> 'center',
	"DM_CampaignId"				=> "center",
	"DM_Recsource"     	 		=> "left",
	"DM_Custno" 				=> "left",
	"DM_FirstName" 				=> "left",
	"DM_HomePhoneNum" 			=> "left",
	"DM_MobilePhoneNum" 		=> "left",
	"DM_OfficePhoneNum" 		=> "left",
	"DM_OtherPhoneNum"			=> "left",
	"DM_Process" 				=> "center",
	"DM_AdmCategoryKode"		=> "center",
	"DM_QualityCategoryKode"    => "center",
	"DM_CallCategoryKode"		=> "center",
	"DM_QualityUpdateTs"		=> "center" ));
 
 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
 $spiner->set_field_call_back(array(
	"DM_UploadedTs"			=> array("SetDateTime"),
	"DM_Custno" 			=> array("SetBoldColor"), 
	"DM_CampaignId" 		=> array('CampaignId'),
	'DM_QualityUserId'		=> array('AllUser','SetCapital', 'SetCaptionKode'),
	"DM_AddressLine1" 		=> array('SetKalimat'),
	"DM_AddressLine2" 		=> array('SetKalimat')));
  
 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
 $spiner->select_spiner_table_page();
 
 ?>
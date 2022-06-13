<?php 
global $Buttons;
 
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 $this->load->helpers(array("EUI_Object","EUI_Extendpager")); 
 $pager =& Singgleton('EUI_Extendpager');
 $Buttons = $button;
 
 
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
  
  $pager->set_source_table($page, $num);
  $pager->set_title_row_content('click row for detail');
  $pager->set_width_table('100%');
  $pager->set_class_table('custom-grid');
  
  
 //debug($pager->select_pager_debug());
  
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */  
 
  $pager->set_order_style(array (
	'background-color' 	=> '#FFFCCC',
	'color' 			=> '#8a1b08',
	'cursor' 			=> 'pointer' ));
 
 
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
  // [DM_Id] => DM_Id
    // [DM_CampaignId] => DM_CampaignId
    // [DM_Custno] => DM_Custno
    // [DM_FirstName] => DM_FirstName
    // [DM_AddressLine1] => DM_AddressLine1
    // [DM_AddressLine2] => DM_AddressLine2
    // [DM_AddressLine3] => DM_AddressLine3
    // [DM_SellerId] => DM_SellerId
    // [DM_CallCategoryKode] => DM_CallCategoryKode
    // [DM_QualityUserId] => DM_QualityUserId
    // [DM_QualityCategoryKode] => DM_QualityCategoryKode
    // [DM_AdmId] => DM_AdmId
    // [DM_AdmCategoryKode] => DM_AdmCategoryKode
    // [DM_LastCategoryKode] => DM_LastCategoryKode
    // [DM_UpdatedTs] => DM_UpdatedTs
  $pager->set_align_cols( array
 (
	'DM_CampaignId'			 => 'left',
	'DM_Custno'     		 => 'left',
	'DM_FirstName' 			 => 'left',
	'DM_AddressLine1' 		 => 'left',
	'DM_AddressLine2'		 => 'left',
	'DM_AddressLine3' 		 => 'left',
	'DM_SellerId' 			 => 'center',
	'DM_CallCategoryKode'	 => 'center',
	'DM_QualityUserId'		 => 'center',
	'DM_QualityCategoryKode' => 'center',
	'DM_AdmId'				 => 'center',
	'DM_AdmCategoryKode' 	 => 'center',
	'DM_LastCategoryKode'	 => 'center',
	'DM_UpdatedTs'			 => 'center',
	'DM_DataType'			 => 'center',
	'DM_DataType'			 => 'center'	
	
  ));
 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */ 
   $pager->set_align_header( array
 (
	'DM_CampaignId'			 => 'left',
	'DM_Custno'     		 => 'left',
	'DM_FirstName' 			 => 'left',
	'DM_AddressLine1' 		 => 'left',
	'DM_AddressLine2'		 => 'left',
	'DM_AddressLine3' 		 => 'left',
	'DM_SellerId' 			 => 'center',
	'DM_CallCategoryKode'	 => 'center',
	'DM_QualityUserId'		 => 'center',
	'DM_QualityCategoryKode' => 'center',
	'DM_AdmId'				 => 'center',
	'DM_AdmCategoryKode' 	 => 'center',
	'DM_LastCategoryKode'	 => 'center',
	'DM_UpdatedTs'			 => 'center'	
	
	
  ));
/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
    $pager->set_header_wrap(array(
		'DM_CampaignId'			 => 'wrap',
		'DM_Custno'     		 => 'wrap',
		'DM_FirstName' 			 => 'wrap',
		'DM_AddressLine1' 		 => 'nowrap',
		'DM_AddressLine2'		 => 'nowrap',
		'DM_AddressLine3' 		 => 'nowrap',
		'DM_SellerId' 			 => 'wrap',
		'DM_CallCategoryKode'	 => 'wrap',
		'DM_QualityUserId'		 => 'wrap',
		'DM_QualityCategoryKode' => 'wrap',
		'DM_AdmId'				 => 'wrap',
		'DM_AdmCategoryKode' 	 => 'wrap',
		'DM_LastCategoryKode'	 => 'wrap',
		'DM_UpdatedTs'			 => 'wrap'	
		
	));
	
/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
    $pager->set_content_wrap(array(
		'DM_CampaignId'			 => 'wrap',
		'DM_Custno'     		 => 'wrap',
		'DM_FirstName' 			 => 'wrap',
		'DM_AddressLine1' 		 => 'wrap',
		'DM_AddressLine2'		 => 'wrap',
		'DM_AddressLine3' 		 => 'wrap',
		'DM_SellerId' 			 => 'wrap',
		'DM_CallCategoryKode'	 => 'wrap',
		'DM_QualityUserId'		 => 'wrap',
		'DM_QualityCategoryKode' => 'wrap',
		'DM_AdmId'				 => 'wrap',
		'DM_AdmCategoryKode' 	 => 'wrap',
		'DM_LastCategoryKode'	 => 'wrap',
		'DM_UpdatedTs'			 => 'nowrap'	
		
	));	
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 

  $pager->set_row_format( array
 (
		'DM_CampaignId'			 => array('CampaignId', 'SetCapital'), 
		'DM_SellerId' 			 => array('AllUser','SetCapital','SetCaptionKode'),
		'DM_QualityUserId'		 => array('AllUser','SetCapital','SetCaptionKode'),
		'DM_AdmId'				 => array('AllUser','SetCapital','SetCaptionKode'),
		'DM_UpdatedTs'			 => array('SetDateTime')
  ));   
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 if( $button->find_value('_DTL_TOOL_') )  {
   $pager->set_event_row_click(array('onclick' => $button->get_value('_DTL_TOOL_')->get_value('Event')));
}


//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 $pager->select_pager_content();
 $pager->reset_pager_object();
 
// ------------------------------------END VIEW ---------------------------------
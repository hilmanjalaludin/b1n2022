<?php 
/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 $this->load->helpers(array("EUI_Object","EUI_Extendpager")); 
 $pager =& EUI_Extendpager::Instance();

/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
  $pager->set_source_table($page, $num);
  $pager->set_title_row_content('click row for followup data');
  $pager->set_width_table('100%');
  $pager->set_class_table('custom-grid');
  
  // $pager->select_pager_debug();
   
/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 
  $pager->set_order_style(array (
	'background-color' 	=> '#FFFCCC',
	'color' => '#8a1b08',
	'cursor' => 'pointer'
 ));
 
 // [CustomerId] => CustomerId
    // [DM_CampaignId] => DM_CampaignId
    // [DM_Custno] => DM_Custno
    // [DM_FirstName] => DM_FirstName
    // [DM_City] => DM_City
    // [DM_GenderId] => DM_GenderId
    // [DM_SellerId] => DM_SellerId
    // [DM_CallCategoryId] => DM_CallCategoryId
    // [DM_CallReasonId] => DM_CallReasonId
    // [DM_UpdatedTs] => DM_UpdatedTs
	
/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 $pager->set_align_header( array (
	'DM_CampaignId'			=> 'left',
	'DM_Custno'				=> 'left',
	'DM_FirstName'			=> 'left',
	'DM_CustomerAddress'	=> 'left',
	'DM_GenderId'			=> 'left',
	'DM_SellerId'			=> 'left',
	'DM_QualityUserId'		=> 'center',
	'DM_CallCategoryId' 	=> 'center',
	'DM_QualityCategoryId'	=> 'center',
	'DM_AdmCategoryId'		=> 'center',
	'DM_UpdatedTs' 			=> 'center' 
  ));
  /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
   $pager->set_align_cols( array (
	'DM_CampaignId'			=> 'left',
	'DM_Custno'				=> 'left',
	'DM_FirstName'			=> 'left',
	'DM_CustomerAddress'	=> 'left',
	'DM_GenderId'			=> 'left',
	'DM_SellerId'			=> 'left',
	'DM_CallCategoryId' 	=> 'center',
	'DM_QualityCategoryId'	=> 'center',
	'DM_AdmCategoryId'		=> 'center',
	'DM_UpdatedTs' 			=> 'center' 
  ));
/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
  $pager->set_row_format( array
 (
	'DM_CampaignId'			=> array('CampaignId','SetBoldColor'),
	'DM_Custno'				=> array('SetBoldColor'),
	'DM_FirstName'			=> array('SetCapital'),
	'DM_CustomerAddress'	=> array('AddressContact' ),
	// 'DM_GenderId'			=> array('SetCapital'),
	'DM_SellerId'			=> array('AllUser','SetCapital','SetCaptionKode'),
	// 'DM_SpvId' 				=> array('AllUser','SetCapital', 'SetCaptionKode'),
	'DM_QualityUserId'		=> array('AllUser','SetCapital', 'SetCaptionKode'),
	'DM_CallCategoryId' 	=> array('AllCallStatus','SetCaptionName'),
	'DM_QualityCategoryId'	=> array('AllCallStatus','SetCaptionName'),
	'DM_AdmCategoryId'		=> array('AllCallStatus','SetCaptionName'),
	'DM_UpdatedTs' 			=> array('SetDateTime'),
	'DM_ApproveTs'			=> array('SetDateTime')
	 
  ));
  
 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  $pager->set_header_wrap(array(
		'DM_QualityUserId'		=> 'wrap', 
		'DM_CallCategoryId'		=> 'wrap',
		'DM_QualityCategoryId' 	=> 'wrap',
		'DM_AdmCategoryId' 		=> 'wrap',
		'DM_UpdatedTs' 			=> 'nowrap'		
		
	));
 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */	
 $pager->set_content_wrap(array(
		'DM_UpdatedTs' => 'nowrap'		
		
	));
	
	

/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 if( $button->find_value('_DTL_TOOL_') )
{
   $pager->set_event_row_click(array(	
		'onclick' => $button->get_value('_DTL_TOOL_')->get_value('Event')));
}

/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 
 $pager->select_pager_content();
 $pager->reset_pager_object();
 
// ------------------------------------END VIEW ---------------------------------
?>



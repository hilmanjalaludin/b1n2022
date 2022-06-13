<?php 
/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */

if( !function_exists('rowcallback') ) {
function rowcallback( $source = null, $pager = null ){
	if( is_array($source) ) foreach( $source  as $key => $row ){
		
		$total  = getRDPCColor($row['CustomerId']);
		if( $total && !strcmp( $row['DM_QualityCategoryId'], NSTS ) ){
			// id && class style 
			$pager->set_row_color($row['CustomerId'],  'ui-rdpc-backcolor');	
		} 
	}
  }
}
/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 $this->load->helpers(array("EUI_Object","EUI_Extendpager")); 
 $pager=&Singgleton('EUI_Extendpager');
 
/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
  $pager->set_source_table($page, $num);
  $pager->set_title_row_content('click row for detail');
  $pager->set_width_table('100%');
  $pager->set_class_table('custom-grid');
  
/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  $pager->set_order_style(array (
	'background-color' 	=> '#FFFCCC',
	'color' 			=> '#8a1b08',
	'cursor' 			=> 'pointer'
 ));
 
  //$pager->select_pager_debug();
  
/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
  $pager->set_align_header(array(
	'DM_QualityCategoryId'  => 'center',
	'DM_CallCategoryId' 	=> 'center',
	'DM_QualityUpdateTs' 	=> 'center',
	'DM_QualityUserId'		=> 'center',
	'AgentCode'				=> 'center',
	'DM_DataType'			=> 'center'
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
	'DM_SpvId' 				=> 'left',
	'DM_CallCategoryId' 	=> 'center',
	'DM_QualityCategoryId'	=> 'center',
	'DM_UpdatedTs' 			=> 'center',
	'DM_QualityUpdateTs'	=> 'center',
	'DM_DataType'			=> 'center',
	'AgentCode'				=> 'center'
		
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
	'DM_GenderId'			=> array('SetCapital'),
	'DM_SellerId'			=> array('AllUser','SetCapital','SetCaptionKode'), 
	'DM_CallCategoryId' 	=> array('AllCallStatus','SetCaptionKode'),
	'DM_QualityCategoryId'	=> array('AllCallStatus','SetCaptionKode'),
	'DM_QualityUpdateTs'	=> array('SetDateTime'),
	'DM_UpdatedTs' 			=> array('SetDateTime'),
	'DM_QualityUserId'		=> array('AllUser','SetCapital','SetCaptionKode'),
	'id'					=> array('AllUser','SetCapital','SetCaptionKode')
	 
  ));

/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
    $pager->set_header_wrap(array(
		'DM_CallCategoryId'=> 'wrap', 
		'DM_QualityCategoryId' => 'wrap',
		'DM_QualityUserId' => 'wrap'
		
	));

/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */	
   $pager->set_content_wrap(array(
	'DM_FirstName'=> 'nowrap',
	// 'DM_CallCategoryId'=> 'nowrap',
	// 'DM_CallReasonId'=> 'nowrap',
	'DM_UpdatedTs' => 'nowrap'
	
));
  $pager->set_row_callback('rowcallback');
/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  //debug($button);
 if( $button->find_value('_DTL_TOOL_') )
{
   $pager->set_event_row_click(array('onclick' => $button->get_value('_DTL_TOOL_')->get_value('Event')));
}


 //$pager->set_event_row_click(array('onclick' => 'EventCustomer') );
 
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 $pager->select_pager_content();
 $pager->reset_pager_object();
 
// ------------------------------------END VIEW ---------------------------------
<?php 
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
  $pager->set_role_table($role);
   
  if( SystemTableCheck() ){
	 $pager->set_checkbox_func(true, false);
  }
  
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
    
  $pager->set_align_cols( array (
	'CPU_UserGroup' 	=> 'left',
	'CPU_UserKode'		=> 'left',
	'CPU_UserId' 		=> 'left',
	'CPU_CampaignId'	=> 'left',
	'CPU_UpdateTs'		=> 'center',
	'CPU_Flags'			=> 'center' 
  ));

/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
  $pager->set_row_format( array(
	'CPU_UserGroup' 	=> array('SetCapital'),
	'CPU_UserKode'		=> array('SetCapital'),
	'CPU_UserId' 		=> array('SetCapital','SetBoldColor'),
	'CPU_CampaignId'	=> array('SetCapital'),  
	'CPU_UpdateTs'		=> array('SetDateTime'),
	'CPU_Flags'			=> array('Flags')
  ));

/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
    $pager->set_header_wrap(array());

/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */	
   $pager->set_content_wrap(array(
	'CPU_UserGroup'=> 'nowrap', 
	'CPU_UserKode' => 'wrap',
	'CPU_UpdateTs' => 'nowrap' ));
  
/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  //debug($button);
 if( $button->find_value('_DTL_TOOL_') ) {
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
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
  
  if( SystemTableCheck() ){
	$pager->set_checkbox_func(true, true); 
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
	'BK_Kuota_Group' => 'left',
	'BK_Kuota_UserId' => 'left',
	'BK_Kuota_UserKode'	=> 'left',
	'BK_Kuota_Size'	=> 'center',
	'BK_Kuota_Data'	=> 'center',
	'BK_Kuota_Creator'	=> 'left',
	'BK_Kuota_UpdateTs'	=> 'center',
	'BK_Kuota_Flags'	=> 'center'	
  ));

/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */

  $pager->set_row_format( array
 (
	'BK_Kuota_Group' => array('SetCapital'),
	'BK_Kuota_UserId' => array('SetCapital'),
	'BK_Kuota_UserKode'	=> array('SetCapital'),
	'BK_Kuota_Size'	=> array('SetCapital'), 
	'BK_Kuota_Creator'	=> array('SetCapital'),
	'BK_Kuota_UpdateTs'	=> array('SetDateTime'),
	'BK_Kuota_Creator' => array('AllUser', 'SetCaptionKode', 'SetCapital'),
	'BK_Kuota_Flags'	=>array('Flags')
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
	'DM_FirstName'=> 'nowrap', 
	'DM_City' => 'wrap',
	'DM_UpdatedTs' => 'nowrap' ));
  
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
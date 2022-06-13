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
	'DS_CallUserGroup' 		=> 'left',
	'DS_CallCategoryKode' 	=> 'left',
	'DS_CallCategoryName'	=> 'left',
	'DS_CallUserSorter'		=> 'center',
	'DS_CallUserEditor'		=> 'center',
	'DS_CallUserUpdateTs'	=> 'center'
  ));

/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */

  $pager->set_row_format( array
 (
	'DS_CallUserGroup' 		=> array('SetCapital'),
	'DS_CallCategoryKode' 	=> array('SetCapital'),
	'DS_CallCategoryName'	=> array('SetCapital'),
	'DS_CallUserEditor'		=> array('AllUser','SetCaptionKode','SetCapital'),
	'DS_CallUserUpdateTs'	=> array('SetDateTime') 
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
   $pager->set_content_wrap(array( ));
  
/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  //debug($button);
 if( $button->find_value('_DTL_TOOL_') ) {
   //$pager->set_event_row_click(array('onclick' => $button->get_value('_DTL_TOOL_')->get_value('Event')));
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
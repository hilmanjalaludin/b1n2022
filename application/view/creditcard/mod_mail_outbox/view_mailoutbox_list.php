<?php 

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 $this->load->helpers(array("EUI_Object","EUI_Extendpager")); 
 $pager =& EUI_Extendpager::Instance();
  
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
  $pager->set_role_table($role);
  $pager->set_checkbox_func(true, false);
  $pager->set_source_table($page, $num);
  $pager->set_title_row_content('click row for detail');
  $pager->set_width_table('100%');
  $pager->set_class_table('custom-grid');
  
 // $pager->select_pager_debug();
  
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */  
 
  $pager->set_order_style(array
 (
	'background-color' 	=> '#FFFCCC',
	'color' 			=> '#8a1b08',
	'cursor' 			=> 'pointer'
 ));
 
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
  $pager->set_align_cols( array
 (
	'EmailMessageId'	=> 'center',
	'Recsource' 		=> 'left',
	'CustomerNumber' 	=> 'left',
	'CustomerFirstName' => 'left',
	'EmailSender' 		=> 'left',
	'EmailSubject' 		=> 'left',
	'EmaiReceiveDate'	=> 'left',
	'EmailStatusName'	=> 'left',
	'EmailCreateTs'		=> 'center',
	'EmaiUpdateTs'		=> 'center',
	'EmailCreateById'	=> 'left'
  ));

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 

  $pager->set_row_format( array
 (
    'Recsource' 		=> array('_setCapital','_setBoldColor'),
	'CustomerNumber'	=> array('_setCapital','_setBoldColor'),
	'EmailMessageId'	=> array('_setCapital','_setBoldColor'),
	'CustomerName' 		=> array('_setCapital','_setBoldColor'),
	'EmailStatusName'	=> array('strval'),
	'CustomerUpdatedTs' => array('_getDateTime'),
	'EmailCreateTs'		=> array('_getDateTime'),
	'EmaiUpdateTs'		=> array('_getDateTime'),
	'CustomerDOB' 		=> array('_getDateIndonesia'),
	'CustomerAge' 		=> array('_getAge')
	
  ));  
  
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
  $pager->set_breakword_cols(array(
	"Recsource" 		=> "nowrap",
	"CustomerNumber" 	=> "nowrap",
	"EmailCreateTs"		=> "nowrap",
	"CustomerUpdatedTs" => "nowrap",
	"EmaiUpdateTs" 		=> "nowrap"
	
  ));

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 $pager->set_event_row_click(null);
 
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 $pager->select_pager_content();
 $pager->reset_pager_object();
 ?>



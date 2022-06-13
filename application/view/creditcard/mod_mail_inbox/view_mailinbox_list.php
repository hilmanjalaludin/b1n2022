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
  //$pager->select_pager_debug();
  
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
	'EmailMessageId'	=> 'left',
	'EmailSender' 		=> 'left',
	'EmailSubject' 		=> 'left',
	'EmaiReceiveDate'	=> 'left',
	'EmailStatus' 		=> 'center'
  ));

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 

  $pager->set_row_format( array
 (
	'EmailMessageId'	=> array('_setCapital','_setBoldColor'),
	'CustomerName' 		=> array('_setCapital','_setBoldColor'),
	'CustomerCity' 		=> array('_setCapital'),
	'CampaignName' 		=> array('gotoCallCustomer'),
	'UpdatedById'		=> array('_setCapital','_setWordWrap'),
	'UserId'			=> array('_setCapital','_setWordWrap'),
	'Supervisor'		=> array('_setCapital','_setWordWrap'),	
	'CustomerUpdatedTs' => array('_getDateTime'),
	'CustomerDOB' 		=> array('_getDateIndonesia'),
	'CustomerAge' 		=> array('_getAge')
	
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
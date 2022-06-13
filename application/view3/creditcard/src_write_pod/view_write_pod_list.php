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
  
  $pager->set_source_table($page, $num);
  $pager->set_title_row_content('click row for detail');
  $pager->set_width_table('100%');
  $pager->set_class_table('custom-grid');
  
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
 
 //var_dump( $pager->select_pager_debug() );
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
	$pager->set_align_cols( array
 (
	'Recsource'			=> 'left',
	'CampaignName' 		=> 'left',
	'CustomerNumber'	=> 'left',
	'CustomerDOB' 		=> 'center',
	'Supervisor'		=> 'left',
	'CallResult' 		=> 'left',
	'CustomerFirstName' => 'left',
	'AgentID'			=> 'left',
	'SupervisorID'		=> 'left',
	'EmailStatus'		=> 'center',
	'CallDate' 			=> 'center',
	'CallResultId'		=> 'left',
	'CategoryName'		=> 'left',
	'ProductCode'		=> 'left',
	'ProductType'		=> 'center'	
  ));

   
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 

  $pager->set_row_format( array
 (
	'CustomerNumber'	=> array('_setCapital','_setBoldColor'),
	'CustomerName' 		=> array('_setCapital','_setBoldColor'),
	'CustomerCity' 		=> array('_setCapital'),
	'CampaignName' 		=> array('gotoCallCustomer'),
	'UpdatedById'		=> array('_setCapital','_setWordWrap'),
	'AgentID'			=> array('_setCapital','_setWordWrap'),
	'Supervisor'		=> array('_setCapital','_setWordWrap'),	
	'CustomerUpdatedTs' => array('_getDateTime'),
	'CustomerDOB' 		=> array('_getDateIndonesia'),
	'CallDate'			=> array('_getDateTime'),
	'CustomerAge' 		=> array('_getAge')
	
  ));  
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
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
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

/* properties		set_checkbox_func 
 *
 * @param 			set checked = false , oncheked rows = false 
 * @author			uknown 
 */
 
 $pager->set_checkbox_func(false, false);

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
//$pager->select_pager_debug();
  
 
  $pager->set_order_style(array (
	'background-color' 	=> '#FFFCCC',
	'color' 			=> '#8a1b08',
	'cursor' 			=> 'pointer'
 ));
 
/* 
 : FIELD : 
	[ApprovalHistoryId] => ApprovalHistoryId
    [DM_CampaignId] => DM_CampaignId
    [DM_Custno] => DM_Custno
    [DM_FirstName] => DM_FirstName
    [DM_ContactNumber] => DM_ContactNumber
    [DM_ContactReqByUser] => DM_ContactReqByUser
    [DM_ContactCreateTs] => DM_ContactCreateTs
    [DM_ContactType] => DM_ContactType,
	[DM_ContactStatus] => DM_ContactStatus
*/

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
  $pager->set_align_cols( array
 (
	'DM_CampaignId'			=> 'center',
	'DM_Custno' 			=> 'left',
	'DM_FirstName' 			=> 'left',
	'DM_ContactNumber' 		=> 'left',
	'DM_ContactReqByUser'	=> 'left',
	'DM_ContactCreateTs'	=> 'center',
	'DM_ContactType'		=> 'left',
	'DM_ContactStatus'		=> 'center' 
  ));

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
  $pager->set_row_format( array
 (
	'DM_FirstName' 			=> array('SetBoldColor'),
	'DM_Custno'				=> array('SetBoldColor'),
	'DM_ContactReqByUser'	=> array('AllUser','SetCaptionKode','SetCapital'),
	'DM_ContactCreateTs'	=> array('SetDateTime'),
	'DM_ContactType' 		=> array('PhoneType'),
	'DM_CampaignId'			=> array('CampaignId'),
	'DM_ContactStatus'		=> array('AddContactStatus')
 ));  


 //---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 //debug($button);
 if( $button->find_value('_DTL_TOOL_') ) {
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
?>

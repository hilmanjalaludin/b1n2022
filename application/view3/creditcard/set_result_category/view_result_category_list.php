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
 
 
 $pager->set_checkbox_func(true, false);
 
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
 // $pager ->select_row_field();
  $pager->set_order_style(array
 (
	'background-color' 	=> '#FFFCCC',
	'color' 			=> '#8a1b08',
	'cursor' 			=> 'pointer'
 ));
 
//---------------------------------------------------------------------------------------
/* 
[CallReasonCategoryId] => CallReasonCategoryId
    [CallReasonCategoryCode] => CallReasonCategoryCode
    [CallReasonCategoryName] => CallReasonCategoryName
    [CallReasonInterest] => CallReasonInterest
    [CallDirection] => CallDirection
    [Sorter] => Sorter
    [Flags] => Flags
*/
	
/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
  $pager->set_align_cols( array
 (
	'CallReasonCategoryCode' => 'left',
	'CallReasonCategoryName' => 'left',
	'CallReasonInterest' => 'left',
	'CallDirection' => 'left',
	'Sorter' => 'center',
	'Flags' => 'left' 
  ));

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
  $pager->set_row_format( array
 (
	'CallReasonCategoryCode' => array('_setBoldColor')
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
 
// ------------------------------------END VIEW ---------------------------------
?>




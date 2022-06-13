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
 
 
 $dfl = new EUI_Object( $page->result_assoc());

//---------------------------------------------------------------------------------------

/* properties		set_checkbox_func 
 *
 * @param 			set checked = false , oncheked rows = false 
 * @author			uknown 
 */
 
 $pager->set_checkbox_func(true, false);
 
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
  $pager->set_role_table($role);
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
 
  $pager->set_order_style(array(
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
	'ID' => 'left',
	'MenuId' => 'left',
	'MenuName' => 'left',
	'GroupMenuName' => 'left',
	'MenuControll' => 'left',
	'status' => 'left'
  ));

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 

  $pager->set_row_format( array (
	'MenuName' => array('_setBoldColor'),
	'GroupMenuName' => array('_setCapital'),
	'status' => array('_setCapital')
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


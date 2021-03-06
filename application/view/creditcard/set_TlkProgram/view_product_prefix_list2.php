
<?php
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */

$this->load->helpers(array("EUI_Object", "EUI_Extendpager"));
$pager = &EUI_Extendpager::Instance();
// echo "<pre>";
// var_dump($pager);

//---------------------------------------------------------------------------------------

/* properties		set_checkbox_func 
 *
 * @param 			set checked = false , oncheked rows = false 
 * @author			uknown 
 */

$pager->set_checkbox_func(true, true);

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */

$pager->set_source_table($page, $num);
$pager->set_title_row_content('set checkbox for edit data');
$pager->set_width_table('100%');
$pager->set_class_table('custom-grid');

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
//$pager ->select_row_field();

// $pager->set_order_style(array(
// 	'background-color' 	=> '#FFFCCC',
// 	'color' 			=> '#8a1b08',
// 	'cursor' 			=> 'pointer'
// ));

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
// $pager->set_align_cols(array(
// 	'ProductCode' => 'left',
// 	'ProductName' => 'left',
// 	'PrefixChar' => 'left',
// 	'PrefixLength' => 'center',
// 	'AddView' => 'left',
// 	'EditView' => 'left',
// 	'Handler' => 'left',
// 	'Model'	=> 'left',
// 	'PrefixMethod' => 'left',
// 	'Status' => 'center',
// ));

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */

// $pager->set_row_format(array(
// 	'ProductCode' 	=> array('_setBoldColor'),
// 	'ProductName'	=> array('_setBoldColor')
// ));

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */

// $pager->set_event_row_click(null);

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
// var_dump($pager->select_pager_content());
// die;
$pager->select_pager_content();
$pager->reset_pager_object();
 
// ------------------------------------END VIEW ---------------------------------

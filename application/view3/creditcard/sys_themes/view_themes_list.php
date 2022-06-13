
<?php 
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 $this->load->helpers(array("EUI_Object","EUI_Extendpager")); 
 $pager=&EUI_Extendpager::Instance();
  
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
 
 //$pager->select_pager_debug();

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */  

$pager->set_role_table($role);
// --- you can customize checkbox data field -------------
if( is_array($role) 
	and count($role) > 0 ) {
	$pager->set_checkbox_func(true, false);  
 }
  
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
 
 $pager->set_align_header(array(
	'LayoutName'		=> 'left',
	'LayoutImages' 		=> 'left',
	'LayoutAuthor' 		=> 'left',
	'LayoutDesc' 		=> 'left',
	'LayoutFlags' 		=> 'left'
 ));
   
 //---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
     
$pager->set_content_wrap(array('LayoutDesc' => 'no'));

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
   
$pager->set_align_cols(array(
	'LayoutName'		=> 'left',
	'LayoutImages' 		=> 'left',
	'LayoutAuthor' 		=> 'left',
	'LayoutDesc' 		=> 'left',
	'LayoutFlags' 		=> 'left'
  ));

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 

  $pager->set_row_format(array(
	'LayoutFlags' 	=> array('Flags'),
	'LayoutImages' 	=> array('ImageLayout'),
	'LayoutName'	=> array('SetBoldColor')
  ));  
  
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
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
?>


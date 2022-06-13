<!-- test -->

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
 


//---------------------------------------------------------------------------------------

/* properties		set_checkbox_func 
 *
 * @param 			set checked = false , oncheked rows = false 
 * @author			uknown 
 */
 
 if( SystemTableCheck() ){
	$pager->set_role_table(SystemTableRole());
	$pager->set_checkbox_func(true, false);
 }
 

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
 

 //$pager->select_pager_debug();
 $pager->set_align_cols( array(
    "PT_Adp_Id" 	=> "center",
    "PT_Adp_Code" 	=> "center",
    "PT_Adp_Name" 	=> "left",
    "PT_Adp_Desc" 	=> "left",
    "PT_Adp_Limit" 	=> "center",
    "PT_Adp_Flags" 	=> "center"
 ));


//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
    // [PT_Id] => PT_Id
    // [PT_Adp_Id] => PT_Adp_Id
    // [PT_Adp_Code] => PT_Adp_Code
    // [PT_Adp_Name] => PT_Adp_Name
    // [PT_Adp_Desc] => PT_Adp_Desc
    // [PT_Adp_Limit] => PT_Adp_Limit
    // [PT_Adp_Flags] => PT_Adp_Flags
 $pager->set_row_format( array(
	'PT_Adp_Flags'  	=> array('Flags')
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

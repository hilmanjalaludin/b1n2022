<?php 
 $this->load->helpers(array('EUI_Object','EUI_Page','EUI_Spiner'));
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 
 $outs = _find_all_object_request();
 $spiner =& get_class_instance("EUI_Spiner");
 
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */

 Global $MenuRoleAction;
 Global $MenuRoleActionUser;

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */

$MenuRoleActionUser = MenuRoleActionUser( $outs->get_array_value('UserRoleGroup') );
 
if( !function_exists('call_role_menu_system')  )
{ 
  function call_role_menu_system() 
 {
	global $MenuRoleActionUser;
	
	$arr_role_key = @array_keys($MenuRoleActionUser['toolbars']);
	$args = func_get_args();
	
	$arr_checked = NULL;
	if( @in_array($args[1], $arr_role_key ) ){
		$arr_checked['checked']= TRUE;
	}	
	
	$vars = _find_all_object_request();
	$arr_checked['disabled'] = NULL;
	if( $vars->get_value('Detail') == 1 ){
		$arr_checked['disabled']= TRUE;
	}
	return form()->checkbox("RoleToolbarId", null, join("_", $args), array("change" => "window.EventSetRoleMenu({'mnu_id' : $args[1], 'obj_id' : this });"), $arr_checked);
  }
} 

 
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */

//-------------------- ordering field -------------------------

 $spiner->set_field_order( $outs->get_value('orderby'), $outs->get_value('type'));
 
//-------------------- set table attribute -------------------------------

 $spiner->set_max_adjust(5);
 $spiner->set_func_page_table("PageMenuSystem");
 $spiner->set_width_table(99); // "percent"
 $spiner->set_height_row_body(32); // px 
 $spiner->set_height_row_header(27); // px 
 
// ------------ source  ---------------------------

 $spiner->set_field_add_header(array('Action' =>'Role'));
 $spiner->set_content_row_table( $content_pages );
 $spiner->set_total_row_record($total_records);
 $spiner->set_total_row_page($total_pages);
 $spiner->set_select_row_page($select_pages);
 $spiner->set_start_row_page($start_page);
 
 
// ------------ attribute ---------------------------
 
 $spiner->set_field_header( array
 (
	
	"MenuCode"		=> lang(array("ID")),
	"MenuName" 		=> lang(array("Name")),
	"MenuGroup" 	=> lang(array("Group")),
	"Controller"	=> lang(array("Controller")),	
	"Image"			=> lang(array("Image")),
    "MenuStatus" 	=> lang(array("Status"))
  ));
  
 $spiner->set_field_call_back(array
 (
	"MenuName" 	=> array('_setBoldColor')
 ));
 
 $spiner->set_field_align(array
 (
	"MenuCode"		=> "center",
	"MenuName" 		=> "left",
	"MenuGroup" 	=> "left",
	"Controller"	=> "left",
	"Image"			=> "left",
    "MenuStatus" 	=> "center"
 ));
 
 $spiner->set_field_class(array
 (
	"MenuCode"		=> "content-middle",
	"MenuName" 		=> "content-middle",
	"MenuGroup" 	=> "content-middle",
	"Controller"	=> "content-middle",
	"Image"			=> "content-middle",
    "MenuStatus" 	=> "content-middle"
  )); 
 
 
 $spiner->set_field_width(array(
	"MenuCode"		=> "10%",
	"MenuName" 		=> "20%",
	"MenuGroup" 	=> "20%",
	"Controller"	=> "10%",
	"Image"			=> "10%",
    "MenuStatus" 	=> "20%"
 ));
 
 
 $spiner->set_field_add_call_back(array
 (
	'field' 		=> 'MenuCode', 
	'callback' 		=> 'call_role_menu_system'	
 ));
 
 // ----------------- compile & show ------------------
 
 $spiner->select_spiner_table_page();
 
 ?>
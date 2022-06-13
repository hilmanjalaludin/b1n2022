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
 
 
 $MenuRoleAction  = MenuRoleAction();
 $MenuRoleActionUser = MenuRoleActionUser( $outs->get_array_value('UserRoleGroup') );
 
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
if( !function_exists('spiner_call_back_add_header') ) 
{
	function spiner_call_back_add_header()
 {
	global $MenuRoleAction, $MenuRoleActionUser;
	
	$arr_userbar  = array();
	$arr_toolbar = array();
	
	$args = func_get_args();
	if( count( $args) == 0  ) { return null; }
	
	if( isset($MenuRoleAction['toolbars']) ){
		$arr_toolbar = $MenuRoleAction['toolbars'];
	}
	
	if( isset($MenuRoleActionUser['toolbars']) ){
		$arr_userbar = $MenuRoleActionUser['toolbars'];
	}
	
	$arr_insect = $arr_toolbar[$args[1]];
	$arr_userbars = $arr_userbar[$args[1]];
	
	if(@in_array($args[0], $arr_insect ))
	{
		$btn_disable['checked']=NULL;
		if(@in_array($args[0],  $arr_userbars) ){
			$btn_disable['checked']=true;
		}	
		
		$vars = _find_all_object_request();
		
		$btn_disable['disabled'] = NULL;
		if( $vars->get_value('Detail') == 1 ){
			$btn_disable['disabled']= TRUE;
		}
		return form()->checkbox("RoleToolbarId", null, join("_", $args), array("change" => "window.SetUserToobarMenu({'act_id': $args[0], 'mnu_id' : $args[1], 'obj_id' : this });"), $btn_disable);
	
	} else {
		return form()->checkbox("RoleToolbarId", null, join("_", $args), NULL, array('disabled' => true));
	}
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
 $spiner->set_func_page_table("PageToolbar");
 $spiner->set_width_table(99); // "percent"
 $spiner->set_height_row_body(32); // px 
 $spiner->set_height_row_header(27); // px 
 
// ------------ source  ---------------------------

 $spiner->set_field_add_header(ToolbarLabel());
 $spiner->set_content_row_table( $content_pages );
 $spiner->set_total_row_record($total_records);
 $spiner->set_total_row_page($total_pages);
 $spiner->set_select_row_page($select_pages);
 $spiner->set_start_row_page($start_page);
 
 
// ------------ attribute ---------------------------
 
 $spiner->set_field_header( array
 (
	"MenuName" 		=> lang("Menu Name"),
	"MenuGroup" 	=> lang(array("Menu Group")),
  //  "MenuStatus" 	=> lang(array("Status"))
  ));
  
 $spiner->set_field_call_back(array
 (
	"MenuName" 	=> array('_setBoldColor')
 ));
 
 $spiner->set_field_align(array
 (
	"MenuName" 		=> "left",
	"MenuGroup" 	=> "left",
   // "MenuStatus" 	=> "center"
 ));
 
 $spiner->set_field_class(array
 (
    "MenuName" 		=> "content-middle",
	"MenuGroup" 	=> "content-middle",
    //"MenuStatus" 	=> "content-middle"
  )); 
 
 $spiner->set_field_add_call_back(array
 (
	'field' 		=> 'MenuId', 
	'callback' 		=> 'spiner_call_back_add_header'	
 ));
 
 // ----------------- compile & show ------------------
 
 $spiner->select_spiner_table_page();
 
 ?>
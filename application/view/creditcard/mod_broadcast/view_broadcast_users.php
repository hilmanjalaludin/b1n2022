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

 $spiner->set_field_order( $outs->get_value('orderby'), $outs->get_value('type'));
 $spiner->set_max_adjust(5);
 $spiner->set_func_page_table("SpinerPage");
 $spiner->set_width_table(99); // "percent"
 $spiner->set_height_row_body(32); // px 
 $spiner->set_height_row_header(27); // px 
 
// ------------ source  ---------------------------
// $spiner->set_field_add_header(FormbarLabel());

 $spiner->set_name_table("id-user-window-data");
 $spiner->set_content_row_table( $content_pages );
 $spiner->set_total_row_record($total_records);
 $spiner->set_total_row_page($total_pages);
 $spiner->set_select_row_page($select_pages);
 $spiner->set_start_row_page($start_page);
 
 //$spiner->select_pager_debug();
 
// ------------ attribute ---------------------------
 
 $spiner->set_checkbox_table(array(
	'field' => 'UserId', 
	'event' => null
 ));
 
 
 $spiner->set_field_header( array
 (
	"UserOnline" => lang("User ID"),
	"UserFullname" 	=> lang(array("Fullname")),
	"GroupName" => lang(array("Group")),
	"UserLogin"	=> lang(array("User Login"))
  ));
  
 $spiner->set_field_align(array
 (
	"UserOnline"	=> "left",
	"UserFullname" 	=> "left",
	"GroupName" 	=> "left",
	"UserLogin"		=> "center"
 ));
 
 
 $spiner->set_field_class(array
 (
	"UserOnline" 		=> "content-middle",
	"UserFullname" 	=> "content-middle",
	"GroupName" 		=> "content-middle",
	"UserLogin"			=> "content-middle"
	
  )); 
 
 $spiner->set_field_call_back(array(
	"UpdateTs" 			=> array("_getDateTime"),
	"UserOnline"		=> array("_setBoldColor")
 ));
 
 // ----------------- compile & show ------------------
 
 $spiner->select_spiner_table_page();
 
 ?>
<?php 
 //display();
 $this->load->helpers(array('EUI_Object','EUI_Page','EUI_Spiner'));
 
 
 /*
  * [local fyunction show page option if user available]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
 $sysRole = SystemRoleFrm( UR()->field('ControllerId'), 'Objective');
 if(!function_exists( 'SetDataPlay' ) ) {
	 
   function SetDataPlay( $RC_Id = 0 )  {
	$ar_button = array();
	
	$out = UR();
	$rol = SystemRoleFrm( $out->field('ControllerId'), 'Objective');
	// -- this paly tool window  ----- 
	if( $rol->find_value('_PLAY_TOOL_') ){
		$ar_button[] = form()->formtoolbar(array( $rol->field('_PLAY_TOOL_')->field('Event')=>array('value'=>$RC_Id, 'class'=>'fa fa-play ui-widget-awesome-toolbar', 'label'=>$rol->field('_PLAY_TOOL_')->field('Label'))));
	}
	if( $rol->find_value('_DWN_TOOL_') ){
		$ar_button[] = form()->formtoolbar(array( $rol->field('_DWN_TOOL_')->field('Event')=>array('value'=>$RC_Id, 'class'=>'fa fa-download ui-widget-awesome-toolbar', 'label'=>$rol->field('_DWN_TOOL_')->field('Label')))); 
	}
	return join(" ", $ar_button);
  }
}

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 
 $outs = UR();
 $spiner =& Singgleton("EUI_Spiner");
 
 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
 $spiner->set_field_order( $outs->get_value('orderby'), $outs->get_value('type'));
 $spiner->set_max_adjust(5);
 
 if( $outs->find_value('handler') ){
	$spiner->set_func_page_table( $outs->field("handler"));
 }
 
 $spiner->set_width_table(99); // "percent"
 $spiner->set_height_row_body(32); // px 
 $spiner->set_height_row_header(27); // px 
 
// ------------ source  ---------------------------
// $spiner->set_field_add_header(FormbarLabel());

 $spiner->set_name_table("id-page-call-history-data");
 $spiner->set_content_row_table( $content_pages );
 $spiner->set_total_row_record($total_records);
 $spiner->set_total_row_page($total_pages);
 $spiner->set_select_row_page($select_pages);
 $spiner->set_start_row_page($start_page);
 
/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 // $spiner->select_pager_debug();
 $spiner->set_checkbox_table(array());
 
/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
   
	// [VLS_Id] => VLS_Id
    // [VLS_Call_Number] => VLS_Call_Number
    // [VLS_File_Name] => VLS_File_Name
    // [VLS_Start_Time] => VLS_Start_Time
    // [VLS_Duration_Time] => VLS_Duration_Time
    // [VLS_Voice_Size] => VLS_Voice_Size
    // [VLS_User_Id] => VLS_User_Id
    // [VLS_Button_Id] => VLS_Button_Id
	
 $spiner->set_field_header( array (
	"VLS_Start_Time" 	=> lang(array("VLS_Start_Time")),
	// "VLS_Call_Number"  	=> lang(array("VLS_Call_Number")),
	"VLS_File_Name"		=> lang(array("VLS_File_Name")),
	"VLS_Duration_Time" => lang(array("VLS_Duration_Time")),
	"VLS_Voice_Size"	=> lang(array("VLS_Voice_Size")),
	"VLS_User_Id" 		=> lang(array("VLS_User_Id"))
  ));
  
 // customize data object button 
 // debug($sysRole);
  if( $sysRole->find_value('_PLAY_TOOL_') ){
	  $spiner->set_field_header( array (
			"VLS_Button_Id" => lang(array("VLS_Button_Id")) ));
  }
  
/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
    
  $spiner->set_field_header_wrap(array(
	// "VLS_Call_Number"  	=> 'nowrap',
	"VLS_File_Name"		=> 'nowrap',
	"VLS_Start_Time" 	=> 'nowrap',
	"VLS_Duration_Time" => 'nowrap',
	"VLS_Voice_Size"	=> 'nowrap',
	"VLS_User_Id" 		=> 'nowrap',
	"VLS_Button_Id" 	=> 'nowrap'
  ));
  
   $spiner->set_field_wrap(array(
	"VLS_Start_Time"  => 'nowrap' 
	
  ));
  
/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
 $spiner->set_header_align(array (
	"VLS_Voice_Size"	=> 'center',
	'VLS_Duration_Time' => 'center' ));  
	
 $spiner->set_field_align(array (
	"VLS_Start_Time" 	=> 'center',
	"VLS_Duration_Time" => 'center',
	// "VLS_Call_Number"  	=> 'left',
	"VLS_File_Name"		=> 'left',
	"VLS_Voice_Size"	=> 'right',
	"VLS_User_Id" 		=> 'left',
	"VLS_Button_Id" 	=> 'left'
 ));
 
 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
 $spiner->set_field_call_back(array(
	"VLS_Start_Time" 	=> array('SetDateTime'),
	// "VLS_Call_Number"  	=> array('SetCapital'),
	"VLS_File_Name"		=> array('_setMaskingRecording'),
	"VLS_Duration_Time" => array('SetDuration'),
	"VLS_Voice_Size"	=> array('SetFormatSize'),
	"VLS_User_Id" 		=> array('SetCapital'),
	"VLS_Button_Id" 	=> array('SetDataPlay')
 ));
 
 
  
 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
 $spiner->select_spiner_table_page();
 
 ?>
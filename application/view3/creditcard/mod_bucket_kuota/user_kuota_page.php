<?php 
 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
 $this->load->helpers(array('EUI_Object','EUI_Page','EUI_Spiner'));
 
 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */

if( !function_exists('Button')  ){
  function Button( $KuotaID  = 0 ){
	$btnArr = array();
	$btnURI = SystemRoleFrm( UR()->field('dataURL'), 'Objective');
	// var_dump($btnURI);
	// then will create data button 
	if( $btnURI->find_value('_DEL_TOOL_') ){
		$btnArr[] = form()->formtoolbar(array( $btnURI->field('_DEL_TOOL_')->field('Event')=>array( 'value' => $KuotaID, 'class'=>'fa fa-remove ui-widget-awesome-toolbar', 'label' => $btnURI->field('_DEL_TOOL_')->field('Label')))); 
	}
	return join(" ", $btnArr);
 }
}

 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
 $pager  = UR();
 $spiner =&Singgleton("EUI_Spiner");
 
 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
 $spiner->set_field_order( $pager->get_value('orderby'), $pager->get_value('type'));
 $spiner->set_max_adjust(5);
 
 
 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 $spiner->set_func_page_table('EventSpiner'); 
 if( $pager->find_value('handler') ){ 
	$spiner->set_func_page_table( $pager->field('handler') );
 }

 $spiner->set_width_table(99); // "percent"
 $spiner->set_height_row_body(32); // px 
 $spiner->set_height_row_header(27); // px 
 
// ------------ source  ---------------------------
// $spiner->set_field_add_header(FormbarLabel());

 $spiner->set_name_table("ui-pager-distribusi-data");
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
  
  //debug($spiner->select_pager_debug());
 
 $spiner->set_checkbox_table(null);
	
 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
 $spiner->set_field_header( array (
	"BK_Kuota_Group" 		=> lang(array("BK_Kuota_Group")),
	"BK_Kuota_UserId" 		=> lang(array("BK_Kuota_UserId")),
	"BK_Kuota_UserKode"		=> lang(array("BK_Kuota_UserKode")),
	"BK_Kuota_Size"			=> lang(array("BK_Kuota_Size")),
	"BK_Kuota_Data"			=> lang(array("BK_Kuota_Data")),
	"BK_Kuota_Creator"		=> lang(array("BK_Kuota_Creator")),
	"BK_Kuota_UpdateTs"		=> lang(array("BK_Kuota_UpdateTs")),
	"BK_Kuota_Flags"		=> lang(array("BK_Kuota_Flags")) 
));

// customize button setup by user.
 $btnURI = SystemRoleFrm( UR()->field('dataURL'), 'Objective');
 if( is_object($btnURI) 
	and $btnURI->find_value('_DEL_TOOL_') ) {
	$spiner->set_field_header(array('BK_Kuota_Action' => lang('BK_Kuota_Action') ));
	$spiner->set_field_call_back(array('BK_Kuota_Action' => array('Button')));
	
 }
 
 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
    
	
  $spiner->set_field_header_wrap(array(
	"BK_Kuota_Group" 		=> 'nowrap',
	"BK_Kuota_UserId" 		=> 'nowrap',
	"BK_Kuota_UserKode"		=> 'nowrap',
	"BK_Kuota_Size"			=> 'nowrap',
	"BK_Kuota_Data"			=> 'nowrap',
	"BK_Kuota_Creator"		=> 'nowrap',
	"BK_Kuota_UpdateTs"		=> 'nowrap',
	"BK_Kuota_Flags"		=> 'nowrap' 
));	
 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */	
 $spiner->set_field_wrap(array(
	"BK_Kuota_Group" 		=> 'nowrap',
	"BK_Kuota_UserId" 		=> 'nowrap',
	"BK_Kuota_UserKode"		=> 'nowrap',
	"BK_Kuota_Size"			=> 'nowrap',
	"BK_Kuota_Data"			=> 'nowrap',
	"BK_Kuota_Creator"		=> 'nowrap',
	"BK_Kuota_UpdateTs"		=> 'nowrap',
	"BK_Kuota_Flags"		=> 'nowrap' 
	
	));	
 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */		
 $spiner->set_header_align(array (
	"BK_Kuota_Group" 		=> 'left',
	"BK_Kuota_UserId" 		=> 'left',
	"BK_Kuota_UserKode"		=> 'left',
	"BK_Kuota_Size"			=> 'center',
	"BK_Kuota_Data"			=> 'center',
	"BK_Kuota_Creator"		=> 'left',
	"BK_Kuota_UpdateTs"		=> 'center',
	"BK_Kuota_Flags"		=> 'center',
	"BK_Kuota_Action"		=> 'center'	
	
	));
	
 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
    
 $spiner->set_field_align(array (
	"BK_Kuota_Group" 		=> 'left',
	"BK_Kuota_UserId" 		=> 'left',
	"BK_Kuota_UserKode"		=> 'left',
	"BK_Kuota_Size"			=> 'center',
	"BK_Kuota_Data"			=> 'center',
	"BK_Kuota_Creator"		=> 'left',
	"BK_Kuota_UpdateTs"		=> 'center',
	"BK_Kuota_Flags"		=> 'center' 
	
	));
 
 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
 $spiner->set_field_call_back(array(
	"BK_Kuota_Group" 		=> array('SetCapital'),
	"BK_Kuota_UserId" 		=> array('SetCapital'),
	"BK_Kuota_UserKode"		=> array('SetCapital'),
	"BK_Kuota_Size"			=> array('SetRealNumber'),
	"BK_Kuota_Data"			=> array('SetRealNumber'),
	"BK_Kuota_Creator"		=> array('AllUser','SetCaptionKode','SetCapital'),
	"BK_Kuota_UpdateTs"		=> array('SetDateTime'),
	"BK_Kuota_Flags"		=> array('Flags') ));
  
 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
 $spiner->select_spiner_table_page();
 
 // END CLASS DATA OPTION
 printf("<div class='ui-widget-info-error'><p>%s</p></div>", 
		"* ) Bucket Kuota Adalah Daya tampung maximum Data Pada Masing-masing Level User <br>Yang sebelumnya dilakukan setup");
 
 
 ?>
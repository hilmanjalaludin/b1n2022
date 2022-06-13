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
  // */
  
 /* 
 SOURCE  : 
		 [KDP_Zip_Kode] => KDP_Zip_Kode
		 [KD_Kelurahan] => KD_Kelurahan
		 [KDP_Kecamatan] => KDP_Kecamatan
		 [KDP_Kabupaten] => KDP_Kabupaten
		 [KDP_KabuptenType] => KDP_KabuptenType
		 [KDP_Provinsi] => KDP_Provinsi
 */
 
	
 $spiner->set_field_header( array (
	'KDP_Provinsi' 		=> lang(array('KDP_Provinsi')),
	'KDP_KabuptenType'  => lang(array('KDP_KabuptenType')),
	'KDP_Kabupaten' 	=> lang(array('KDP_Kabupaten')),
	'KDP_Kecamatan' 	=> lang(array('KDP_Kecamatan')),
	'KDP_Kelurahan' 	=> lang(array('KDP_Kelurahan')),
	'KDP_ZipKode' 		=> lang(array('KDP_ZipKode')) 
));


 
 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
    
	
  $spiner->set_field_header_wrap(array(
	"KDP_Provinsi" 		=> 'nowrap',
	"KDP_Kabupaten" 	=> 'nowrap',
	"KDP_KabuptenType"	=> 'nowrap',
	"KDP_Kecamatan"		=> 'nowrap',
	"KDP_Kelurahan"		=> 'nowrap',
	"KDP_ZipKode"		=> 'nowrap'
));	
 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */	
 $spiner->set_field_wrap(array(
	"KDP_Provinsi" 		=> 'wrap',
	"KDP_Kabupaten" 	=> 'wrap',
	"KDP_KabuptenType"	=> 'wrap',
	"KDP_Kecamatan"		=> 'wrap',
	"KDP_Kelurahan"		=> 'wrap',
	"KDP_ZipKode"		=> 'nowrap'
	));	
 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */		
 $spiner->set_header_align(array (
	"KDP_Provinsi" 		=> 'left',
	"KDP_Kabupaten" 	=> 'left',
	"KDP_KabuptenType"	=> 'left',
	"KDP_Kecamatan"		=> 'left',
	"KDP_Kelurahan"		=> 'left',
	"KDP_ZipKode"		=> 'center'
	
	));
	
 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
    
 $spiner->set_field_align(array (
	"KDP_Provinsi" 		=> 'left',
	"KDP_Kabupaten" 	=> 'left',
	"KDP_KabuptenType"	=> 'left',
	"KDP_Kecamatan"		=> 'left',
	"KDP_Kelurahan"		=> 'left',
	"KDP_ZipKode"		=> 'center'
	
	));
 
 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
 $spiner->set_field_call_back(array( 
	"KDP_Provinsi" 		=> array('strtoupper'),
	"KDP_Kabupaten" 	=> array('strtoupper'),
	"KDP_KabuptenType"	=> array('strtoupper'),
	"KDP_Kecamatan"		=> array('strtoupper'),
	"KDP_Kelurahan"		=> array('strtoupper'),
	"KDP_ZipKode"		=> array('strtoupper','SetBoldColor')
 
 ));
  
 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
 $spiner->select_spiner_table_page();
 
 // END CLASS DATA OPTION
 
 printf("<div class='ui-widget-info-error'><p>%s</p></div>", 
		"* ) Silahkan Isi Filter Data Untuk Process Lebih Cepat. <br>
		 * ) Data Yang Ditampilkan Hanya 1000 Record(s) Jika Tanpa Filter.");
 
 
 ?>
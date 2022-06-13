<?php 
error_reporting(E_ALL);
ini_set("display_errors", 1);
@ob_implicit_flush(FALSE);


/*
 * [Recovery data failed upload "BODY CONTENT"]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */ 
if( !function_exists('datestring') ){  
	function datestring( $date  = null){
		return sprintf("%s", date('dmY', strtotime($date)) );
	}
}

/*
 * [Recovery data failed upload "BODY CONTENT"]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */ 
if( !function_exists('valusername') ){ 
function valusername( $userid = 0 ){
	$CI  = &CI(); 
	$sql = sprintf("select a.full_name from tms_agent a where a.UserId = %d", $userid);
	$qry = $CI->db->query( $sql );
	if( $qry && $qry->num_rows() > 0 ) {
		return (string)$qry->result_singgle_value();
	}
	return null;
	
  }
}

/*
 * [Recovery data failed upload "BODY CONTENT"]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */ 
if( !function_exists('datevalue') ){ 
 function datevalue( $date = null ){
	return sprintf("%s 00:00:00", date('d/m/Y', strtotime($date) ));
 } 
}

/*
 * [Recovery data failed upload "BODY CONTENT"]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */ 
 
$this->load->helper('EUI_WriteFixed');


/*
 * [Recovery data failed upload "HEADER"]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */ 
 
$define_header_fixed = array(   'TX_Usg_FixID' 			=> 21,
								'TX_Usg_JumlahDana' 	=> 10,
								'TX_Usg_NamaRekening' 	=> 41,
								'TX_Usg_NoRekening' 	=> 21,
								'TX_Usg_NamaBank' 		=> 29,
								'TX_Usg_Cabang' 		=> 49,
								'TX_Usg_Program' 		=> 36,
								'TX_Usg_Tenor' 			=> 8,
								'TX_Usg_CreatedTs' 		=> 9,
								'TX_Usg_SellerKode' 	=> 40);
								
								
// set hader content 								
$define_header_label = array(	'TX_Usg_FixID' 			=> 'FIX ID',
								'TX_Usg_JumlahDana' 	=> 'AMOUNT',
								'TX_Usg_NamaRekening' 	=> 'BENEF',
								'TX_Usg_NoRekening' 	=> 'REK',
								'TX_Usg_NamaBank' 		=> 'BANK',
								'TX_Usg_Cabang' 		=> 'CABANG',
								'TX_Usg_Program' 		=> 'PROGRAMNAME',
								'TX_Usg_Tenor' 			=> 'PERIODE',
								'TX_Usg_CreatedTs' 		=> 'TRXDATE',
								'TX_Usg_SellerKode' 	=> 'AGENID' );



/*
 * [Recovery data failed upload "BODY CONTENT"]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */ 
 
$basefilepath = sprintf("%s_%s.txt", $title,date('His'));

/*
 * [Recovery data failed upload "BODY CONTENT"]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */ 
 
// debug( $title);
// exit;
  
$writefix = new EUI_WriteFixed($basefilepath, dirname( __FILE__ ));
/*
 * [Recovery data failed upload "BODY CONTENT"]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */ 
  
$writefix->write_header_setup($define_header_fixed );

/*
 * [Recovery data failed upload "BODY CONTENT"]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */ 
 
// baris1
// @row, $cell, @conten, @position 

$writefix->write_header_caption(0, 0, "Campaign",  			 12);
$writefix->write_header_caption(0, 1, ":", 		   			  2);
$writefix->write_header_caption(0, 2, sprintf("%s", $param->field('campaign_id', 'Campaign')), 	43);

$writefix->write_header_caption(1, 0, "Periode",			 12);
$writefix->write_header_caption(1, 1, ":", 					  2);
$writefix->write_header_caption(1, 2, sprintf("%s", $param->field('start_date','datevalue')), 21);
$writefix->write_header_caption(1, 3, "to", 				  3);
$writefix->write_header_caption(1, 4, sprintf("%s", $param->field('end_date','datevalue')), 21);

$writefix->write_header_caption(2, 0, "",					 12);
$writefix->write_header_caption(2, 1, "", 					  2);
$writefix->write_header_caption(2, 2, "", 					 21);
$writefix->write_header_caption(2, 3, "", 				  	  3);
$writefix->write_header_caption(2, 4, "", 					 21); 

/*
 * [Recovery data failed upload "BODY CONTENT"]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */ 
  
$writefix->write_header_label($define_header_label);


/*
 * [Recovery data failed upload "BODY CONTENT"]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */ 
 
$i = 0;
foreach( $data->result_record() as $row  ){
	$writefix->write_content( $i, 0, $row->field('TX_Usg_FixID') );
	$writefix->write_content( $i, 1, $row->field('TX_Usg_JumlahDana') );
	$writefix->write_content( $i, 2, $row->field('TX_Usg_NamaRekening',array('strtoupper')) );
	$writefix->write_content( $i, 3, $row->field('TX_Usg_NoRekening',array('strtoupper')) );
	$writefix->write_content( $i, 4, $row->field('TX_Usg_NamaBank',array('strtoupper')) );
	$writefix->write_content( $i, 5, $row->field('TX_Usg_Cabang',array('strtoupper')) );
	$writefix->write_content( $i, 6, $row->field('PRD_Data_Value',array('strtoupper')) );
	$writefix->write_content( $i, 7, $row->field('TX_Usg_Tenor',array('strtoupper')) );
	$writefix->write_content( $i, 8, $row->field('TX_Usg_CreatedTs', 'datestring') );
	$writefix->write_content( $i, 9, $row->field('TX_Usg_SellerId',array('valusername','strtoupper')));
	$i++;
}

//set on kontent data proces ok ;
 $writefix->write_process();
 $writefix->write_closed();
 
 
// data handler proces 
 $filepathname = $writefix->pathfilename();
 $filetype = @filetype($filepathname);
 if( !$filetype ){
	return false; 
 }
 
 header("Pragma: public");
 header("Expires: 0");
 header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
 header("Cache-Control: public");
 header("Content-Description: File Transfer");
 header("Content-Type: csv/stream");
 header("Content-Disposition: attachment; filename=\"". basename($filepathname) ."\"");
 header("Content-Transfer-Encoding: ASCII");
						
 //Send file headers
    // header("Content-type: $filetype");
    // header("Content-Disposition: attachment;filename=\"". basename($filepathname) ."\"");
    // header("Content-Transfer-Encoding: binary"); 
    // header('Pragma: no-cache'); 
    // header('Expires: 0');
   // Send the file contents.
    set_time_limit(0); 
    readfile($filepathname);
	
	// exit from here .
	@unlink($filepathname);
    exit(0);
	
// debug($writefix);


?>
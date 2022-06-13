<?php 
error_reporting(E_ALL);
ini_set("display_errors", 0);
@ob_implicit_flush(FALSE);


//var_dump($param->field('transaksi'));die();

/*
 * [Recovery data failed upload "BODY CONTENT"]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */ 
if( !function_exists('datestring') ){  
	function datestring( $date  = null){
		return sprintf("%s", date('d/m/Y', strtotime($date)) );
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

if( !function_exists('programName') ){ 
 function programName( $pName = null) {
	 $param = UR();
	 $trx = $param->field('transaksi');
	 $return2 = '';
	if ($pName == 'SS 0,99%' && $trx == 1) {
		$return2 = 'BNI INST INSP 2016';
	} else if ($pName == 'SS 0,99%' && $trx == 2) {
		$return2 = 'INST INSP 2016 2';
	} else if ($pName == 'XD 0,925%' && $trx == 1) {
		$return2 = 'XD INSP TAHUN 2016';
	} else if ($pName == 'XD 0,925%' && $trx == 2) {
		$return2 = 'XD INSP 2016 2';
	} else if ($pName == 'XD 0,75%' && $trx == 1) {
		$return2 = 'XTRADANA 0,75% 2015';
	} else if ($pName == 'XD 0,75%' && $trx == 2) {
		$return2= 'XD 0,75% TRX 2';
	} else if ($pName == 'XD 0,45%' && $trx == 1) {
		$return2= 'XTRADANA SPECIAL PRICE';
	} else if ($pName == 'XD 0,75%' && $trx == 3) {
		$return2= 'XD 0,75% TRX 2';
	} else if ($trx==4){
		$pNames = explode('-',$pName);
		if ($pNames[0] == 'SS 0,99%' && $pNames[1] == 1) {
			$return2 = 'BNI INST INSP 2016';
		} else if ($pNames[0] == 'SS 0,99%' && $pNames[1] >= 2) {
			$return2 = 'INST INSP 2016 2';
		} else if ($pNames[0] == 'XD 0,925%' && $pNames[1] == 1) {
			$return2 = 'XD INSP TAHUN 2016';
		} else if ($pNames[0] == 'XD 0,925%' && $pNames[1] >= 2) {
			$return2 = 'XD INSP 2016 2';
		} else if ($pNames[0] == 'XD 0,75%' && $pNames[1] == 1) {
			$return2 = 'XTRADANA 0,75% 2015';
		} else if ($pNames[0] == 'XD 0,75%' && $pNames[1] >= 2) {
			$return2= 'XD 0,75% TRX 2';
		} else if ($pNames[0] == 'XD 0,45%' && $pNames[1] == 1) {
			$return2= 'XTRADANA SPECIAL PRICE';
		}  
	}else {
		$return2 = '';
	}
	return $return2;
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
 
$define_header_fixed = array(   'TX_Usg_FixID' 			=> 22,
								'Merchant' 				=> 20,
								'TX_Usg_JumlahDana' 	=> 10,
								'TX_Usg_CreatedTss' 	=> 12,
								'TX_Usg_Penawaran' 		=> 5,
								'TX_Usg_NamaBank' 		=> 15,
								// 'TX_Usg_Cabang' 		=> 49,
								// 'TX_Usg_Program' 		=> 36,
								// 'TX_Usg_Tenor' 			=> 8,
								'TX_Usg_CreatedTs' 		=> 12,
								'TX_Usg_SellerKode' 	=> 20);
								
								
// set hader content 								
$define_header_label = array(	'TX_Usg_FixID' 			=> 'FIX ID',
								'Merchant' 				=> 'Merchant',
								'TX_Usg_JumlahDana' 	=> 'AMOUNT',
								'TX_Usg_CreatedTss' 	=> 'TrxDate',
								'TX_Usg_Penawaran' 		=> 'MID',
								'TX_Usg_NamaBank' 		=> 'Refno',
								// 'TX_Usg_Cabang' 		=> 'CABANG',
								// 'TX_Usg_Program' 		=> 'PROGRAMNAME',
								// 'TX_Usg_Tenor' 			=> 'PERIODE',
								'TX_Usg_CreatedTs' 		=> 'AgenDate',
								'TX_Usg_SellerKode' 	=> 'AgenID' );



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
$writefix->write_header_caption(1, 2, sprintf("%s", $param->field('start_date','datevalue')), 20);
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
$param = UR();
$trx = $param->field('transaksi');
$i = 0;
foreach( $data->result_record() as $row  ){
	$writefix->write_content( $i, 0, $row->field('TX_Usg_FixID ') );
	
	if($param->field('campaign_id')==87){
		$writefix->write_content( $i, 1, $row->field('TX_Usg_Block'));
	}else{
		$writefix->write_content( $i, 1, "PROG INST KK".$row->field('TX_Usg_ProgramValue'));
	}
	
	if($param->field('campaign_id')==87){
		$writefix->write_content( $i, 2, $row->field('TxAvailableXD') );
	}else{
		$writefix->write_content( $i, 2, $row->field('TX_Usg_JumlahDana') );
	}
	
	if($param->field('campaign_id')==87){
		$writefix->write_content( $i, 3, $row->field('TX_Usg_Tigabulan') );
	}else{
		$writefix->write_content( $i, 3, $row->field('TX_Usg_CreatedTs', 'datestring') );
	}
	
	if($param->field('campaign_id')==87){
		$writefix->write_content( $i, 4, 1516 );
	}else{
		if($row->field('TX_Usg_Tenor') == '3'){
			$writefix->write_content( $i, 4, 1415 );
		}elseif($row->field('TX_Usg_Tenor') == '6'){
			$writefix->write_content( $i, 4, 1415 );
		}elseif($row->field('TX_Usg_Tenor') == '9'){
			$writefix->write_content( $i, 4, 1415 );
		}elseif($row->field('TX_Usg_Tenor') == '12'){
			$writefix->write_content( $i, 4, 1415 );
		}elseif($row->field('TX_Usg_Tenor') == '18'){
			$writefix->write_content( $i, 4, 1528 );
		}elseif($row->field('TX_Usg_Tenor') == '24'){
			$writefix->write_content( $i, 4, 1529 );
		}elseif($row->field('TX_Usg_Tenor') == '36'){
			$writefix->write_content( $i, 4, 1529 );
		}
	}

	// $writefix->write_content( $i, 5, $row->field('TX_Usg_NamaBank',array('strtoupper')) );
	if($param->field('campaign_id')==87){
		$writefix->write_content( $i, 5, $row->field('TxAvailableSS')."0");
	}else{
		$writefix->write_content( $i, 5,'888888888888' );
	}
	// $writefix->write_content( $i, 6, '888888888888' );
	$writefix->write_content( $i, 6, $row->field('TX_Usg_CreatedTs', 'datestring'));
	// $writefix->write_content( $i, 7, $row->field('TX_Usg_CreatedTs', 'datestring'));
	$writefix->write_content( $i, 7, $row->field('TX_Usg_SellerId',array('valusername','strtoupper')));
	// $writefix->write_content( $i, 8, $row->field('TX_Usg_SellerId',array('valusername','strtoupper')));
	$i++;
	$writefix->write_content( $i, 0, 'CICILAN :' .$row->field('TX_Usg_Tenor'));
	$writefix->write_content( $i, 1, '');
	$writefix->write_content( $i, 2, '');
	$writefix->write_content( $i, 3, '');
	$writefix->write_content( $i, 4, '');
	$writefix->write_content( $i, 5, '');
	$writefix->write_content( $i, 6, '');
	$writefix->write_content( $i, 7, '');
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
 //Send file headers
    header("Content-type: $filetype");
    header("Content-Disposition: attachment;filename=\"". basename($filepathname) ."\"");
    header("Content-Transfer-Encoding: binary"); 
    header('Pragma: no-cache'); 
    header('Expires: 0');
   // Send the file contents.
    set_time_limit(0); 
    readfile($filepathname);
	
	// exit from here .
	@unlink($filepathname);
    exit(0);
	
// debug($writefix);


?>
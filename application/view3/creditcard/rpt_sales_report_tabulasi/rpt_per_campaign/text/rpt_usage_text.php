<?php 
error_reporting(E_ALL);
ini_set("display_errors", 0);
@ob_implicit_flush(FALSE);
// echo "test";
// die;

//var_dump($param->field('transaksi'));die();

/*asdasdas
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

if( !function_exists('datevaluees') ){ 
	function datevaluees( $date = null ){
	   return sprintf("%s 23:59:59", date('d/m/Y', strtotime($date) ));
	} 
   }

if( !function_exists('programName') ){ 
 function programName( $pName = null) {
	 $param = UR();
	 $trx = $param->field('transaksi');
	//  echo "<pre>";
	//  $transeq = UR();
	 // var_dump( $trx);
	//  die;
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
	} 
	// else if ($pName == 'XD 0,65%' && $trx == 1) {
		// $return2= 'XTRADANA SPECIAL PRICE';
	// }
	// else if ($pName == 'XD 0,65%' && $trx != 1) {
		// $return2= 'XTRADANA SPECIAL PRICE 2';
	// }
	else if ($pName == 'XD 0,65%' && $trx == 3) {
		$return2= 'XTRADANA SPECIAL PRICE 2';
	}
	else if ($pName ==' XD 0%' && $trx == 3) {
		$return2= 'SMART TRANSFER 2';
	}
	
	else if ($pName == 'XD 0%' && $trx == 1) {
		$return2= 'SMART TRANSFER';
	}else if ($pName == 'XD 0%' && $trx == 2) {
		$return2= 'SMART TRANSFER 2';
	}
	
	
	else if ($pName == 'SS 1.25%' && $trx == 5) {
		$return2= 'XTRADANA EXP';
	}
		else if ($pName == 'SS 1.25%' && $trx == 2) {
		$return2= 'XTRADANA EXP 2';
	}
	 else if ($pName == 'SS 1%' && $trx == 5) {
		$return2= 'XTRADANA EXP';
	}
		 else if ($pName == 'SS 1%' && $trx == 2) {
		$return2= 'XTRADANA EXP 2';
	}
	else if ($trx==4){
		// echo "gabungan";
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
		} else if ($pNames[0] == 'XD 0,65%' && $pNames[1] == 1) {
			$return2= 'XTRADANA SPECIAL PRICE';
			
		} else if ($pNames[0] == 'XD 0,65%' && $pNames[1] != 1) {
			$return2= 'XTRADANA SPECIAL PRICE 2';
			
		} else if ($pNames[0] == 'XD 1.25%' && $pNames[1] == 1) {
			$return2= 'XTRADANA EXP';
		
		}else if ($pNames[0] == 'XD 1.25%' && $pNames[1] == 2) {
			$return2= 'XTRADANA EXP 2';
		
		} 
		else if ($pNames[0] == 'XD 1%' && $pNames[1] == 1) {
			$return2= 'XTRADANA EXP';
			
		}else if ($pNames[0] == 'XD 1%' && $pNames[1] == 2) {
			$return2= 'XTRADANA EXP 2';
			
		}
		else if ($pNames[0] == 'XD 0%' && $pNames[1] == 1) {
			$return2= 'SMART TRANSFER';
			
		}else if ($pNames[0] == 'XD 0%' && $pNames[1] == 2) {
			$return2= 'SMART TRANSFER 2';
			
		}
	}else {

		if ($pName == 'SS 0,99%') {
			$return2 = 'BNI INST INSP 2016';
		}
		elseif ($pName == 'XD 0,925%' && $trx == 1) {
			$return2 = 'XD INSP TAHUN 2016 1';
		}
		elseif ($pName == 'XD 0,925%' && $trx == 2) {
			$return2 = 'XD INSP TAHUN 2016 2';
		}
		elseif ($pName == 'XD 0,75%') {
			$return2 = 'XTRADANA 0,75% 2015';
		
		}elseif ($pName == 'XD 0,45%') {
			$return2= 'XTRADANA SPECIAL PRICE';
		
		}elseif ($pName == 'XD 0,65%') {
			$return2= 'XTRADANA SPECIAL PRICE';
		
		// }elseif ($pName == 'XD 0%') {
			// $return2= 'SMART TRANSFER '.$pName."|".$trx;
		
		}elseif ($pName == 'SS 1.25%') {
			$return2= 'XTRADANA EXP';
		
		}elseif ($pName == 'SS 1%') {
			$return2= 'XTRADANA EXP';
			
		}else{
			$return2 = '';
		}
	}
	return $return2;
 } 
 
}

if( !function_exists('programNameForAll') ){ 
 function programNameForAll( $pName = null) {
	$pNames = explode('-',$pName);
	$return2 = "";
	// echo $pNames[0]."-".$pNames[1]; die();
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
		$return2 = 'XTRADANA 0,75% 2015 2';
	} else if ($pNames[0] == 'XD 0,45%' && $pNames[1] == 1) {
		$return2= 'XTRADANA SPECIAL PRICE';
	} else if ($pNames[0] == 'XD 0,45%' && $pNames[1] == 2) {
		$return2= 'XTRADANA SPECIAL PRICE 2';
	} else if ($pNames[0] == 'XD 0,65%' && $pNames[1] == 1) {
		$return2= 'XTRADANA SPECIAL PRICE';
	} else if ($pNames[0] == 'XD 0,65%' && $pNames[1] == 2) {
		$return2= 'XTRADANA SPECIAL PRICE 2';
	} else if ($pNames[0] == 'XD 1.25%' && $pNames[1] == 1) {
		$return2= 'XTRADANA EXP';
	} else if ($pNames[0] == 'XD 1.25%' && $pNames[1] == 2) {
		$return2= 'XTRADANA EXP 2';
	} else if ($pNames[0] == 'XD 1%' && $pNames[1] == 1) {
		$return2= 'XTRADANA EXP';
	} else if ($pNames[0] == 'XD 1%' && $pNames[1] == 2) {
		$return2= 'XTRADANA EXP 2';
	} else if ($pNames[0] == 'XD 0%' && $pNames[1] == 1) {
		$return2= 'SMART TRANSFER';
	} else if ($pNames[0] == 'XD 0%' && $pNames[1] == 2) {
		$return2= 'SMART TRANSFER 2';
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
 
// $define_header_fixed = array(   'TX_Usg_FixID' 			=> 21,
// 								'TX_Usg_JumlahDana' 	=> 10,
// 								'TX_Usg_NamaRekening' 	=> 21,
// 								'TX_Usg_NoRekening' 	=> 21,
// 								'TX_Usg_NamaBank' 		=> 10,
// 								'TX_Usg_Cabang' 		=> 19,
// 								'TX_Usg_Program' 		=> 26,
// 								'TX_Usg_Tenor' 			=> 10,
// 								'TX_Usg_CreatedTs' 		=> 10,
// 								'TX_Usg_SellerKode' 	=> 20);
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
$define_header_label = array(	'TX_Usg_FixID' 			=> 'Fix ID',
								'TX_Usg_JumlahDana' 	=> 'Amount',
								'TX_Usg_NamaRekening' 	=> 'Benef',
								'TX_Usg_NoRekening' 	=> 'Rek',
								'TX_Usg_NamaBank' 		=> 'Bank',
								'TX_Usg_Cabang' 		=> 'Cabang',
								'TX_Usg_Program' 		=> 'ProgramName',
								'TX_Usg_Tenor' 			=> 'Periode',
								'TX_Usg_CreatedTs' 		=> 'trxDate',
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
//$explode=explode(' ',$param->field('campaign_id', 'Campaign'));

$writefix->write_header_caption(0, 0, "Campaigns",  			 13.5);
$writefix->write_header_caption(0, 1, ":", 		   			  1);
//$writefix->write_header_caption(0, 2, sprintf("%s", $param->field('campaign_id', 'Campaign')), 	43);
$writefix->write_header_caption(0, 2, sprintf("%s",strtoupper(date(" F Y"))), 20);

$writefix->write_header_caption(1, 0, "Periode",			 8);
$writefix->write_header_caption(1, 1, ":", 					  2);
$writefix->write_header_caption(1, 2, sprintf("%s", $param->field('start_date','datevalue')), 20);
$writefix->write_header_caption(1, 3, "to", 				  3);
$writefix->write_header_caption(1, 4, sprintf("%s", $param->field('end_date','datevaluees')), 21);

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
	$writefix->write_content( $i, 0, $row->field('TX_Usg_FixID') );
	$writefix->write_content( $i, 1, $row->field('TX_Usg_JumlahDana') );
	$writefix->write_content( $i, 2, $row->field('TX_Usg_NamaRekening',array('strtoupper')) );
	$writefix->write_content( $i, 3, $row->field('TX_Usg_NoRekening',array('strtoupper')) );
	$writefix->write_content( $i, 4, $row->field('TX_Usg_NamaBank',array('strtoupper')) );
	$writefix->write_content( $i, 5, trim($row->field('TX_Usg_Cabang',array('strtoupper'))) );
	
	if($trx==4){
		$writefix->write_content( $i, 6, $row->field('MaxSeq',array('programName', 'strtoupper')) );
	}
	else if($trx == 5 && $row->field('TX_Usg_TransSeq') == 2) {
		$writefix->write_content( $i, 6, 'XTRADANA EXP 2' );
	}
	else if($trx == "" or $trx == null){
		$writefix->write_content( $i, 6, $row->field('ValueConcat',array('programNameForAll', 'strtoupper')) );
	}
	else{
		if($row->field('TX_Usg_ProgramValue') == 'SS 0,99%' && $row->field('TX_Usg_TransSeq') == 2) {
			$writefix->write_content( $i, 6, 'BNI INST INSP 2016 2' );
		}
		elseif($row->field('TX_Usg_ProgramValue') == 'XD 0,75%' && $row->field('TX_Usg_TransSeq') == 2) {
			$writefix->write_content( $i, 6, 'XTRADANA 0,75% 2015 2' );
		}
		elseif($row->field('TX_Usg_ProgramValue') == 'XD 0,45%' && $row->field('TX_Usg_TransSeq') == 2) {
			$writefix->write_content( $i, 6, 'XTRADANA SPECIAL PRICE 2' );
		}
		elseif($row->field('TX_Usg_ProgramValue') == 'SS 1.25%' && $row->field('TX_Usg_TransSeq') == 2) {
			$writefix->write_content( $i, 6, 'XTRADANA EXP 2' );
		}
		elseif($row->field('TX_Usg_ProgramValue') == 'XD 1%' && $row->field('TX_Usg_TransSeq') == 2) {
			$writefix->write_content( $i, 6, 'XTRADANA EXP 2' );
		}
		elseif($row->field('TX_Usg_ProgramValue') == 'XD 0%' && $row->field('TX_Usg_TransSeq') == 1) {
			$writefix->write_content( $i, 6, 'SMART TRANSFER' );
		}
		elseif($row->field('TX_Usg_ProgramValue') == 'XD 0%' && $row->field('TX_Usg_TransSeq') == 2) {
			$writefix->write_content( $i, 6, 'SMART TRANSFER 2' );
		}
		/* elseif($row->field('TX_Usg_ProgramValue') == 'XD 0,65%' && $row->field('TX_Usg_TransSeq') == 2) {
			/* $writefix->write_content( $i, 6, 'XD 0,65% 2' );
		}*/
		else if($row->field('TX_Usg_ProgramValue') == 'XD 0,65%' && $row->field('TX_Usg_TransSeq') == 2) {
			$writefix->write_content( $i, 6, 'XTRADANA SPECIAL PRICE 2' );
		}
		else {
			$writefix->write_content( $i, 6, $row->field('TX_Usg_ProgramValue',array('programName', 'strtoupper')) );
		}
	}

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
<?php 
// error_reporting(E_ALL);
// ini_set("display_errors", 1);
@ob_implicit_flush(FALSE);

// print_r($merchants);

if( !function_exists('datestring') ){  
	function datestring( $date  = null){
		return sprintf("%s", date('dmY', strtotime($date)) );
	}
}

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

if( !function_exists('getMerchant') ){
	function getMerchant($pName = null, $merchants = null, $merchantsTenor = null, $pTenor = null){
		$param = UR();
		$trx = $param->field('transaksi');
		$merchant = "-";
		
		$pNames	= explode('-',$pName);
		$tseq	= ($pNames[1]?$pNames[1]:2);
		
		if($trx){
			if( in_array($pTenor,$merchantsTenor[$trx][$pNames[0]][$tseq])){
				$merchant = $merchants[$trx][$pNames[0]][$tseq][$pTenor];
			}else{
				$merchant = $merchants[$trx][$pNames[0]][$tseq]['all'];
			}
		}else{
			if( in_array($pTenor,$merchantsTenor['ALL'][$pNames[0]][$tseq])){
				$merchant = $merchants['ALL'][$pNames[0]][$tseq][$pTenor];
			}else{
				$merchant = $merchants['ALL'][$pNames[0]][$tseq]['all'];
			}
			// $merchant = $merchants['ALL'][$pNames[0]][$tseq];
		}
		
		return $merchant;//."|".$pNames[0]."|".$pNames[1];
	}
}

$this->load->helper('EUI_WriteFixed');
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

$basefilepath = sprintf("%s_%s.txt", $title,date('His'));
$writefix = new EUI_WriteFixed($basefilepath, dirname( __FILE__ ));
$writefix->write_header_setup($define_header_fixed );

$writefix->write_header_caption(0, 0, "Campaigns", 		13.5);
$writefix->write_header_caption(0, 1, ":",				1);
$writefix->write_header_caption(0, 2, sprintf("%s",strtoupper(date(" F Y"))), 20);

$writefix->write_header_caption(1, 0, "Periode",		 8);
$writefix->write_header_caption(1, 1, ":",				 2);
$writefix->write_header_caption(1, 2, sprintf("%s", $param->field('start_date','datevalue')), 20);
$writefix->write_header_caption(1, 3, "to",				 3);
$writefix->write_header_caption(1, 4, sprintf("%s", $param->field('end_date','datevaluees')), 21);

$writefix->write_header_caption(2, 0, "",				12);
$writefix->write_header_caption(2, 1, "", 				 2);
$writefix->write_header_caption(2, 2, "", 				21);
$writefix->write_header_caption(2, 3, "", 				 3);
$writefix->write_header_caption(2, 4, "", 				21); 

$writefix->write_header_label($define_header_label);

$param = UR();
$trx = $param->field('transaksi');
$i = 0;

if($data){
	foreach( $data->result_record() as $row  ){
		if($trx == "ROBOTIK"){
			$merchant = getMerchant($row->field('MaxSeq'), $merchants, $merchantsTenor, $row->field('TX_Usg_Tenor'));
		}else if($trx == "MANUAL"){
			$merchant = getMerchant($row->field('TX_Usg_ProgramValue'), $merchants, $merchantsTenor, $row->field('TX_Usg_Tenor'));
		}else{
			$merchant = getMerchant($row->field('ValueConcat'), $merchants, $merchantsTenor, $row->field('TX_Usg_Tenor'));
		}
		$writefix->write_content( $i, 0, $row->field('TX_Usg_FixID') );
		$writefix->write_content( $i, 1, $row->field('TX_Usg_JumlahDana') );
		$writefix->write_content( $i, 2, $row->field('TX_Usg_NamaRekening',array('strtoupper')) );
		$writefix->write_content( $i, 3, $row->field('TX_Usg_NoRekening',array('strtoupper')) );
		$writefix->write_content( $i, 4, $row->field('TX_Usg_NamaBank',array('strtoupper')) );
		$writefix->write_content( $i, 5, trim($row->field('TX_Usg_Cabang',array('strtoupper'))) );
		// $writefix->write_content( $i, 6, $row->field('MaxSeq',array('getMerchant', 'strtoupper')) );
		$writefix->write_content( $i, 6, $merchant );
		$writefix->write_content( $i, 7, $row->field('TX_Usg_Tenor',array('strtoupper')) );
		$writefix->write_content( $i, 8, $row->field('TX_Usg_CreatedTs', 'datestring') );
		$writefix->write_content( $i, 9, $row->field('TX_Usg_SellerId',array('valusername','strtoupper')));
		$i++;
	}
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
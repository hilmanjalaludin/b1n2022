<?php

 /**
 * [RouteForm description]
 * get data post and route form
 */

 if( !function_exists('Verifikasi') ){
	function Verifikasi(){
		$CI =&CI();
		$CI->load->model('M_DataVerification');
		return Singgleton('M_DataVerification');
	}
 }

 /**
 * [RouteForm description]
 * get data post and route form
 */

 if( !function_exists('DaftarKartu') ) {
	function DaftarKartu(){
		$VR = Verifikasi();
		return $VR->_select_ver_row_pctd( UR()->field('CustomerId') );
	}
 }
 /**
 * [RouteForm description]
 * get data post and route form
 */

if( !function_exists('VerifikasiKartu') ) {
function VerifikasiKartu( $row = null ){

 $totalData = 0;
 $CI =&CI();


 $sql = sprintf("select count(a.SV_Data_Id) as total from t_gn_verification_setup a where a.SV_Data_Context = 2 and a.SV_Data_Value=1");
 $qry = $CI->db->query( $sql );

 if( $qry && $qry->num_rows() > 0 ){
	$totalData = $qry->result_singgle_value();
 }

 // jika  context default value = 1 maka tampilkan source default - nya .
	if( $totalData ){
		return $row->field('CV_Data_CcExpired','trim');
	}

	return null;
 }
}

/**
 * [RouteForm description]
 * get data post and route form
 */

 if( !function_exists('VerifikasiValue') ) {
 function VerifikasiValue( $row  = null ){

	// call core CI
	$CI =&CI();
	if(  is_null( $row ) or !is_object( $row ) ){
		$row->add('SV_Data_CustId', UR()->field('CustomerId'));
		$row->add('SV_Data_Default', null);
	}

 // jika di set satu maka tampilkan data verifikasinya
 // dengan kontext berikut ini.

	$row->add('SV_Data_CustId', UR()->field('CustomerId'));


 // then will get setup
 // query selector generate by system get on setup verification table.
    $sql = sprintf("select %s from %s where %s='%d'", $row->field('SV_Data_Field'),
													  $row->field('SV_Data_Table'),
													  $row->field('SV_Data_Keys'),
													  $row->field('SV_Data_CustId') );
	// var_dump($sql);
	// die;
    $qry = $CI->db->query( $sql );
	if(  $qry && $qry->num_rows() > 0 ){

	 // check apakah ini type data tanggal atau bukan
	 // jika ya recondisi OK
		$dataDefault = $qry->result_singgle_value();
		if( @call_user_func( 'IsDate', $dataDefault )){
			$row->add( 'SV_Data_Default', date( 'dmY', strtotime( $dataDefault )));
		}
		// jika buka tanggal
		else {
			$row->add('SV_Data_Default', strtoupper($dataDefault));
		}
	}

	if( !$row->field('SV_Data_Value') ){
		$row->add('SV_Data_Default', null);
	}

// check apakah data tersebut ada atau kosong
// return null;
	return $row;
  }
}
/**
 * [RouteForm description]
 * get data post and route form
 */

 if( !function_exists('DataMaster') ) {
	function DataMaster(){
  	$VR = Verifikasi();
		return $VR->_select_ver_master_pctd(UR()->field('CustomerId'));
		// return $VR->_select_ver_master(0);
	}
 }
 /**
 * [RouteForm description]
 * get data post and route form
 */

 if( !function_exists('DetailVerification') ) {
	function DetailVerification(){
		$VR = Verifikasi();
		return $VR->_select_ver_detail(0);
	}
 }

 //debug(DataVerification());

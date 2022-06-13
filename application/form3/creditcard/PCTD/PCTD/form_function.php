<?php 

/**
 * [RouteForm description]
 * get data post and route form
 */

if( !function_exists('AvailXtradana') ){
	function AvailXtradana( $nominal  = 0 ){
		$nominalXd = $nominal;
		$jumlahYangDiambil = ( $nominalXd - (($nominal * 50) / 100));
		return round($jumlahYangDiambil);
	} 
}
 ?> 
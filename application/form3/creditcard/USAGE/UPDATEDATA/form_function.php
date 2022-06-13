<?php 

 /**
 * [RouteForm description]
 * get data post and route form
 */
 
 if( !function_exists( 'DetailDataUpdate' ) ){
 function DetailDataUpdate(){
	$CI =& CI();
	// get select all data from here table 
	$URI = UR();
	$sql = sprintf( "select * from t_gn_customer_verification a 
					left join t_gn_customer_master b on a.CV_Data_Custno=b.DM_Custno
					where a.CV_Data_Id = %d", $URI->field('VerificationId') );
					
	$qry = $CI->db->query( $sql );
	if( $qry && $qry->num_rows() > 0 ) {
		$result_array = $qry->result_first_record();
	}	
	// kemudian keluarkan data -nya 
	return $result_array;
 }
 }
 ?> 
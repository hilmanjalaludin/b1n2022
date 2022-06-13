<?php 

/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 * 
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 * @ example    : get by fields ID / Campaign ID
 */
 
$formBackData = _cmpFlexibleLayout($Detail->get_value('DM_CampaignId'));

if( $formBackData ){
	$formBackData->_setTables('t_gn_customer_master'); // rcsorce data
	$formBackData->_setCustomerId(array('DM_Id' => $Detail->get_value('DM_Id') ) ); // set conditional array();
	$formBackData->_Compile();
}

/*
if( $Flexible = )) 
{
	
}
*/
// END OFF

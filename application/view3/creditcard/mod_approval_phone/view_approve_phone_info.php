<?php 
/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
$formBackData = _cmpFlexibleLayout($Detail->get_value('DM_CampaignId'));
if( $formBackData ){
	$formBackData->_setTables('t_gn_customer_master'); // rcsorce data
	$formBackData->_setCustomerId(array('DM_Id' => $Detail->get_value('DM_Id') ) ); // set conditional array();
	$formBackData->_Compile();
}
// END OFF

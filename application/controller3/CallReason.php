<?php
/*
 * EUI Controller  
 *
 
 *@Section  : CallReason
 *@author 	: Omens  
 *@link		: http://www.razakitechnology.com/eui/controller 
 */
 
class CallReason extends EUI_Controller {
	
// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
function __construct()
{ 
	parent::__construct();
	$this->load->Model("M_CallReason");
}

// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
 function ReasonType() 
{
	$cache = cache(); // add cache lib on data function 
	$arr_reason = $cache->cache_read('ctireason');
	if( !$cache->cache_ready('ctireason') ){ 
		$arr_reason = $this->{base_class_model($this)}->_select_call_reason();
		$cache->cache_write('ctireason', $arr_reason);
	}
	echo json_encode($arr_reason);
 }
 
}

//* END OF FILE 
//* location : /application/controller/ CallReason.php

?>
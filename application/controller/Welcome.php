<?php
/*
 * EUI Controller  
 *
 
 * Section  : Welcome first load content on HOME
			  website application enjoy its.
 * author 	: Omens  
 * link		: http://www.razakitechnology.com/eui/controller 
 */
 
class Welcome extends EUI_Controller
{

/*
 @ Constructor 
 */
 
function Welcome() 
{
	parent::__construct();	
	$this->load->Model('M_Website');
	$this->load->helper("EUI_Object");
}	

/*
 @ method index look on URI Segment /index.php/welcome/index 
 @ loading first call on your application 
 */

public function index() {
	
 $out =& get_class_instance('M_Website'); if( is_object( $out ) )  {
		$this->load->view("welcome/Welcome", array(
			'content' => $out->_web_default()
		));
	}	
}

// =================== END CLASS ===================================
}

// END OF FILE
// location : ./application/controller/Welcome.php

?>
<?php  
//--------------------------------------------------
/*
 * Define function on get class Awesome Iconic 
 */ 
 
 if( !function_exists('AwesomeGroupIcon') )
{
 function & AwesomeGroupIcon()
{  
	$arr_awesome_icon = array 
	(
		"quality_assurance" => 'fa fa-users fa-fw',
		"settings" 			=> 'fa fa-gear fa-fw',
		"manage_system" 	=> 'fa fa-gear fa-fw',
		"reports" 			=> 'fa fa-book fa-fw',
		"customers" 		=> 'fa fa-phone-square fa-fw',
		"monitoring" 		=> 'fa fa-database fa-fw',
		"manage_cti" 		=> 'fa fa-asterisk fa-fw',
		"pabx"				=> 'fa fa-asterisk fa-fw',
		"q-assurance"		=> 'fa fa-users fa-fw',
		"manage_data" 		=> 'fa fa-database fa-fw',
		"data"				=> 'fa fa-database fa-fw',
		"recording" 		=> 'fa fa-book fa-fw',
		"system" 			=> 'fa fa-gear fa-fw',
		
		// --- sub tree  --- 
		"srccustomerlist"		=> 'fa fa-phone-square fa-fw',
		"srcappoinment"			=> 'fa fa-calendar fa-fw',
		"srcwritepod"			=> 'fa fa-edit fa-fw',
		"srccustomerclosing"	=> 'fa fa-check-circle fa-fw',
		"srcapplication"		=> 'fa fa-share-square-o fa-fw',
		"mgtassignment"			=> 'fa fa-pencil-square-o fa-fw',
		"modbroadcastmsg"		=> 'fa fa-comment fa-fw',
		"monagentactivity"		=> 'fa fa-user-secret fa-fw',
		"modvoicedata"			=> 'fa fa-microphone-slash fa-fw',
		"mgtbucket"				=> 'fa fa-database fa-fw',
		"modapprovephone"		=> 'fa fa-phone-square fa-fw',	
		"srcapprovalpod"		=> 'fa fa-check-circle fa-fw',
		"srcprintpod"			=> 'fa fa-print fa-fw',
		"srcprintpdf"			=> 'fa fa-file-pdf-o fa-fw',
		"sysuser"				=> 'fa fa-users fa-fw',
		"srcfollowuppod"		=> 'fa fa-phone-square fa-fw'
		
		
	);
	return $arr_awesome_icon;
 }	
}

//--------------------------------------------------
/*
 * Define function on get class Awesome Iconic 
 */ 
 
if( !function_exists('Awesome') )
{
	function Awesome( $Group  = null )
 {
	//var_dump( $Group );
	
	$arr_awesome_icon =& AwesomeGroupIcon();
	$Group = str_replace(" ", "_", strtolower($Group));
	if( isset($arr_awesome_icon[$Group]) )
	{
		return $arr_awesome_icon[$Group];
		
	} else {
		return "fa fa-sign-out fa-fw";
	}	
 }	
	
}

// ============== END layout 

?>	


<?php 
// ------------------------------------------------------------------------

/**
 * CodeIgniter Download Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/helpers/download_helper.html
 */

$g_ListMenu =& base_menu_model(); 
// ------------------------------------------------------------------------

/**
 * CodeIgniter Download Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/helpers/download_helper.html
 */

if( !function_exists('Awesome') ){
 function Awesome( $key  = null ){
	$key = strtoupper($key);
	
	//var_dump(function_exists('base_group_icons'));
	
	$arr_list = base_group_icons();
	 //print_r($arr_list);
	return $arr_list[$key]['GroupFonts'];
 }
}

?>
 <div id="ribbon">
	<span class="ribbon-window-title application-title">
	 </span> 
	
<?php

 
//var_dump(HelpApplicationMenu());
//debug($g_ListMenu);

$cascade = 1;
if(is_array($g_ListMenu)) 
	foreach( $g_ListMenu as $GroupMenu => $ArrGroupMenu ) 
{  
	$g_GroupMenuId = join('-', array( strtolower(str_replace(" ","", $GroupMenu)), $cascade) ); 
	 //var_dump($g_GroupMenuId);
	
	$g_GroupMenuName = ucwords(strtolower($GroupMenu));
	
 	 
	if( count( $ArrGroupMenu )  > 0 )
	{
		printf("<div class=\"ribbon-tab\" id=\"%s-tab\">".
				"<span class=\"ribbon-title\"> 
				<i class=\"fa %s\" aria-hidden=\"true\"></i>&nbsp;&nbsp;%s</span>", 
				$g_GroupMenuId, Awesome($g_GroupMenuName), $g_GroupMenuName );
					
		if( is_array($ArrGroupMenu) and count($ArrGroupMenu) > 0 ) 
			foreach( $ArrGroupMenu as $g_MenuId => $a_MenuId ) 
		{  
			$out = new EUI_Object($a_MenuId);
			
			
			// add pushtack data object 
			$controllerUid = $g_MenuId;
			$controllerName = $out->get_value('file_name','trim');
			$controllerId = sprintf('%s', $controllerName );
			$controllerMenu =  $out->get_value('menu');
			
			// then will get data .
			printf("<div class=\"ribbon-section\"> 
						<div class=\"ribbon-button ribbon-button-large %s\" uid=\"%s\" ctrl=\"%s\" id=\"%s\" onclick=\"Ext.ShowMenu('%s','%s');\"> 
							<span class=\"button-title\"> <i class=\"fa fa-external-link\" aria-hidden=\"true\"></i>&nbsp;%s</span>
						</div> 
					</div>",
				$controllerId,	
				$controllerUid,
				$controllerName, 
				$controllerId,
				$controllerName, 
				$controllerMenu,
				$controllerMenu 
			);
		} 
		echo "</div>";
	} 	
	
	$cascade++;
}
		
	$this->load->layout(base_layout().'/UserAboutUs');
	
echo "</div>";


?>



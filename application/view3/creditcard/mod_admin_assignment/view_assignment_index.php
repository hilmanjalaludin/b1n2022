<?php
/* @ def 	 : view upload manual
 * 
 * @ param	 : sesion  
 * @ package : bucket data 
 */
 
 
?>

<?php get_view(array("mod_admin_assignment","view_assignment_jsv")); ?>
<div id="ui-widget-page-bucket" class="tabs corner ui-frame-with">
	<ul>
		<li class="ui-tab-li-none">
			<a href="#ui-widget-ascmp-content">
			<span class="ui-icon ui-icon-newwin"></span><?php echo lang(array("Assignment"));?> </a>
		</li>
		
		<li class="ui-tab-li-lasted">
			<a href="#ui-widget-upload-content">
			<span class="ui-icon ui-icon-newwin"></span><?php echo lang(array("Upload"));?> </a>
		</li>
	</ul>	
	
	<div id="ui-widget-ascmp-content" class="ui-widget-class-content">
		<?php get_view(array("mod_admin_assignment", "view_assignment_data"))?>
	</div>
	
	<div id="ui-widget-upload-content" class="ui-widget-class-content">
		<?php get_view(array("mod_admin_assignment", "view_assignment_upload"))?>
	</div>
	
</div>

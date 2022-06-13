<?php
/* @ def 	 : view upload manual
 * 
 * @ param	 : sesion  
 * @ package : bucket data 
 */
 
 
 // echo "<pre>";
 // print_r($Button);
 // echo "</pre>";
?>

<?php get_view(array("mgt_bucket_data","view_bucket_jsv")); ?>
<div id="ui-widget-page-bucket" class="tabs corner ui-frame-with">
	<ul>
		<li class="ui-tab-li-none">
			<a href="#ui-widget-ascmp-content">
			<span class="ui-icon ui-icon-newwin"></span><?php echo lang(array("Bucket Assignment"));?> </a>
		</li>
		
		<li class="ui-tab-li-lasted">
			<a href="#ui-widget-upload-content">
			<span class="ui-icon ui-icon-newwin"></span><?php echo lang(array("Bucket", "Upload"));?> </a>
		</li>
		
		<li class="ui-tab-li-lasted">
			<a href="#ui-widget-refresh-content">
			<span class="ui-icon ui-icon-newwin"></span><?php echo lang(array("Data", "Refresh"));?> </a>
		</li>
	</ul>	
	
	<div id="ui-widget-ascmp-content" class="ui-widget-class-content"> 
		<?php get_view(array("mgt_bucket_data", "view_bucket_ascmp"))?>
	</div>
	
	<div id="ui-widget-upload-content" class="ui-widget-class-content">
		<?php get_view(array("mgt_bucket_data", "view_bucket_upload"))?>
	</div>
	
	<div id="ui-widget-refresh-content" class="ui-widget-class-content">
		<?php get_view(array("mgt_bucket_data", "view_bucket_refresh"))?>
	</div>
	
</div>

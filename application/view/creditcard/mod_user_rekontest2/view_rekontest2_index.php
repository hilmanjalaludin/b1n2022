<?php get_view(array("mod_user_rekontest2","view_rekontest2_jsv")); ?> 
<div id="ui-widget-page-bucket" class="tabs corner ui-frame-with">
	<ul>
		<li class="ui-tab-li-lasted">
			<a href="#ui-widget-ascmp-content">
			<span class="ui-icon ui-icon-newwin"></span><?php echo lang(array("Rekontest 2"));?> </a>
		</li> 
	</ul>	
	
	<div id="ui-widget-ascmp-content" class="ui-widget-class-content"> 
		<?php get_view(array("mod_user_rekontest", "view_rekontest_data"))?>
	</div> 
</div>

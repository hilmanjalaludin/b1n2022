<?php get_view(array("mod_call_disposition","call_disposition_jsv"));?>
<div id="ui-widget-tab-panel" class="ui-widget-tab-panel ui-tab-panel-content">
	<ul>
		<li class="ui-tab-li-lasted">
			<a href="#ui-widget-add-content">
			<span class="ui-icon ui-icon-newwin"></span><?php echo $panel->field('title','lang');?> </a>
		</li>
	</ul>	
	<!-- start -->
	<div id="ui-widget-add-content" class="ui-tab-panel-content">
		<?php get_view(array('mod_call_disposition', $panel->field('form')))?>
	</div>
	
</div>	
<?php get_view(array("mod_mail_compose","mail_compose_jsv"));?>


<div id="ui-widget-composer-tabs" class="tabs corner">
	<ul>
		<li class="ui-tab-li-lasted">
			<a href="#ui-widget-composer-content">
			<span class="ui-icon ui-icon-plus"></span><?php echo lang($EventTitleTab);?> </a>
		</li>
	</ul>	
	
	
<!-- start : composer text ---->
	<div id="ui-widget-composer-content">
		<?php echo form()->hidden("EventRoleback", null, $EventRoleback);?>
		<?php get_view(array("mod_mail_compose",$EventContent));?>
	</div>
<!-- end : composer text ---->

	
</div>	
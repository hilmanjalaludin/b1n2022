<?php get_view(array('mod_broadcast','view_broadcast_jsv'));?>
<div id="ui-widget-contact-tabs" class="tabs corner">
	<ul>
		<li class="ui-tab-li-lasted">
			<a href="#ui-widget-contact-detail-data">
			<span class="ui-icon ui-icon-comment"></span>
				
			<?php echo lang(array("Broadcast","Message"));?> </a>
		</li>
    </ul>	
	
	<div id="ui-widget-contact-detail-data" class="ui-widget-contact-tabs">
		<?php get_view(array("mod_broadcast","view_broadcast_index"));?>
	</div>
</div> 

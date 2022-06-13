<?php get_view(array("mod_queue_monitoring","view_queue_monitor_jsv")); ?>
<div id="ui-widget-queues-monitoring" class="tabs corner">
<ul>
	<li class="ui-tab-li-lasted">
		<a href="#ui-widget-smsq-monitoring">
		<span class="ui-icon ui-icon-call"></span><?php echo lang("Queue Monitoring");?> </a>
	</li>
</ul>	

<div id="ui-widget-smsq-monitoring">
 <fieldset id="corners" class="corner ui-widget-fieldset table-fieldset-data">
 <?php echo form()->legend(lang("Queue List "),"fa-desktop");?>	
	<div id="content-monitor"></div>
 </fieldset>
</div>
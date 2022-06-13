<?php get_view(array("mod_queue_monitoring","view_queue_monitor_header")); ?>
<script>
var UserMonitoring;

//---------------------------------------------------------------
Ext.DOM.QueueMonitoring = function()
{
	$("#content-monitor").load(
		Ext.EventUrl([
		  "QueueMonitoring", "Monitor"
		]).Apply() , {
			time : Ext.Date().getDuration()	
	});
}
//---------------------------------------------------------------
$(document).ready( function(){
	$('#ui-widget-queues-monitoring').mytab().tabs();
	$('#ui-widget-queues-monitoring').mytab().tabs();
	$('#ui-widget-queues-monitoring').tabs("option", "selected", 0);
    $('#ui-widget-queues-monitoring').mytab().close(function(){ Ext.BackHome() }, true );
	$('#corners').css({"margin-bottom": "20px", "background-color": "#FFFFFF"});
	$("#ui-widget-smsq-monitoring").css({"padding-bottom": "20px", "background-color": "#FFFFFF"});
	Ext.DOM.QueueMonitoring();
	Ext.DOM.setTimeOutId = window.setInterval('QueueMonitoring();',1000);
	
});




</script>
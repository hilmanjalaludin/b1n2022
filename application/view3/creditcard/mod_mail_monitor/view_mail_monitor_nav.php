<?php echo javascript(); ?>
<script type="text/javascript">
//-----------------------------------------------------------------------

/*
 * modul  		 	method get User Role 
 *
 * @akses 			public & of run window  
 * @author 			uknown 
 */

var Role = new Ext.Role("MailMonitoring");
	Role.extend([
		{ title: " ", icon :"", event: "", key :'QueueId' } // if you have other extends event 
	]);
	
//-----------------------------------------------------------------------

/*
 * modul  		 	method get User Role 
 *
 * @akses 			public & of run window  
 * @author 			uknown 
 */

 Ext.DOM.FaxQueueAgent = function()
 {
	Ext.Ajax 
	({
		url : Role.action('Content'), //Ext.DOM.INDEX +'/M/Content/',
		param : {}	
	}).load("ui-content-queue-mail");
} 
	
//-----------------------------------------------------------------------

/*
 * modul  		 	method get User Role 
 *
 * @akses 			public & of run window  
 * @author 			uknown 
 */
	
  Ext.DOM.SubmitCancel = function(MonitorId)
{
	Ext.Ajax 
	({
		url 	: Role.action('Cancel'), 
		method 	: 'POST',
		param 	: {
			MonitorId : MonitorId
		},
			ERROR : function(e){
				Ext.Util(e).proc(function(items){
					if( items.success ){
						Ext.Msg("Cancel By User").Info();
					}
					else{
						Ext.Msg("Cancel By User").Failed();
					}
				});
			}
		}).post();	
}
	
	
//-----------------------------------------------------------------------

/*
 * modul  		 	method get User Role 
 *
 * @akses 			public & of run window  
 * @author 			uknown 
 */
	
  Ext.DOM.SubmitRetry = function(MonitorId)
{
	Ext.Ajax 
	({
		url 	: Role.action('Retry'), 
		method 	: 'POST',
		param 	: {
			MonitorId : MonitorId
		},
			ERROR : function(e){
				Ext.Util(e).proc(function(items){
					if( items.success ){
						Ext.Msg("Retry send mail").Info();
					}
					else{
						Ext.Msg("Retry send mail").Failed();
					}
				});
			}
		}).post();	
}
	
//-----------------------------------------------------------------------

/*
 * modul  		 	method get User Role 
 *
 * @akses 			public & of run window  
 * @author 			uknown 
 */
	
	
Ext.DOM.Cancel = function(object)
{
	Ext.Ajax 
	({
		url 	: Role.action('Cancel'), //Ext.DOM.INDEX +'/MailQueueMonitoring/Cancel/',
		method 	: 'POST',
		param 	: {
				id : object.id
		},
		ERROR : function(e){
			Ext.Util(e).proc(function(items)
			{
				if( items.success ){
					Ext.Msg("Cancel send mail").Info();
				}
				else{
					Ext.Msg("Cancel send mail").Failed();
				}
			});
		}
	}).post();	
}

//-----------------------------------------------------------------------

/*
 * modul  		 	method get User Role 
 *
 * @akses 			public & of run window  
 * @author 			uknown 
 */

Ext.document('document').ready( function(){
	$('#ui-widget-mail-monitoring').tabs();	
	$('#ui-widget-mail-monitoring').css({"background-color":"#FFFFFF"});
	$('#ui-widget-mail-content').css({"background-color":"#FFFFFF"});
	$('.ui-widget-fieldset').css({"border-radius":"5px"});
	
	Ext.DOM.setTimeOutId = window.setInterval('FaxQueueAgent();',1000);
});
</script>


<div id="ui-widget-mail-monitoring" class="tabs corner">
<ul>
	<li class="ui-tab-li-lasted">
		<a href="#ui-widget-mail-content">
		<span class="ui-icon ui-icon-person"></span><?php echo lang(array("Mail","Queue"));?> </a>
	</li>
</ul>	

<div id="ui-widget-mail-content">
 <fieldset class="corner ui-widget-fieldset table-fieldset-data">
 <?php echo form()->legend(lang("Mail List"),"fa-envelope-o");?>	
 <div id="ui-content-queue-mail" class="ui-widget-form-table table-body-content">
 
 </div>
	
 </fieldset>
</div>

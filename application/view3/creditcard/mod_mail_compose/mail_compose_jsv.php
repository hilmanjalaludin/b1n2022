<?php echo javascript( array(
		array('_file' => base_spl_plugin().'/extToolbars.js', 'eui_'=>version(), 'time'=>time()),
		array('_file' => base_spl_plugin().'/Paging.js', 'eui_'=>version(), 'time'=>time())
	));?>
<script>

//-----------------------------------------------------------------------

/*
 * modul  		 	method get User Role 
 *
 * @akses 			public & of run window  
 * @author 			uknown 
 */

var Role = new Ext.Role("MailCompose");
	Role.extend([
		{ title: " ", icon :"", event: "", key :'ComposeId' } // if you have other extends event 
	]);
 

//-----------------------------------------------------------------------

/*
 * modul  		 	method get User Role 
 *
 * @akses 			public & of run window  
 * @author 			uknown 
 */
 
 Ext.DOM.EventCancel  = function() 
{
	var $RoleBack  = Ext.Cmp('EventRoleback').getValue();
	if( Ext.Msg('Are you sure?').Confirm() )
	{ 
		if( $RoleBack == 'Home' ){
			Ext.BackHome();
		}
		if( $RoleBack == 'MailInbox' ){
			Ext.ShowMenu($RoleBack, "Inbox");
		}
		if( $RoleBack == 'MailOutbox' ){
			Ext.ShowMenu($RoleBack, "Outbox");
		}
	}
	return false;
 }
 
 
//-----------------------------------------------------------------------

/*
 * modul  		 	method get User Role 
 *
 * @akses 			public & of run window  
 * @author 			uknown 
 */
 Ext.DOM.Submit = function()
{
	if( Ext.Cmp('address_to').empty() ){
		Ext.Msg("Adress to is empty").Info();
		return false;
	}
	
	if( Ext.Cmp('mail_subject').empty() ){
		Ext.Msg("Subject is empty").Info();
		return false;
	}
// =============== content save ---------------------
	
	Ext.Ajax
	({
		url 	: Role.action('Submit'),
		method  : 'POST',
		param   : {
			address_to 	 : Ext.Cmp('address_to').getValue(),
			address_cc 	 : Ext.Cmp('address_cc').getValue(),
			address_bcc  : Ext.Cmp('address_bcc').getValue(),
			mail_subject : Ext.Cmp('mail_subject').getValue(),
			body_content : Ext.Cmp('content_email_body').getValue()
		},
		ERROR : function( e ){
			Ext.Util(e).proc(function( response ){
				if( response.success ){
					Ext.Msg("Send Mail").Success();
					return false;
				} else{
					Ext.Msg("Send Mail").Failed();
					return false;
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
 
$(document).ready(function() 
{
    $("#ui-widget-composer-tabs").mytab().tabs();
    $("#ui-widget-composer-tabs").mytab().tabs("option", "selected", 0);
    $("#ui-widget-composer-tabs").mytab().close(function(e) { 
		new Ext.DOM.EventCancel(); 
	}, true);
	
	$('#ui-widget-composer-content').css({"background-color":"#FFFFFF"});
	$('.ui-widget-composer-fieldset').css({"border-radius": "5px" });
	
	$("#content_email_body").cleditor(); 
	
	$('.dts').datepicker ({
		buttonImageOnly : true, 
		showOn			: 'button', 
		buttonImage		: Ext.Image('calendar.gif'), 
		dateFormat		: 'dd-mm-yy', 
		changeMonth		: true,
		changeYear		: true,
		readonly		: true
	});
	
//--------- address autocomplete ---------------------------
	
	$( ".to-address").autocomplete(["Autocomplete", "index"], {
		max : 100,  
		multiple  : true,
		scrollHeight : 300, 
		multipleSeparator : ","
	}).result(function(data,row) { });
	
	$( ".cc-address").autocomplete(["Autocomplete", "index"], {
		max : 100,  
		multiple  : true,
		scrollHeight : 300, 
		multipleSeparator : ","
	}).result(function(data,row) { });
	
	
	$( ".bcc-address").autocomplete(["Autocomplete", "index"], {
		max : 100,  
		multiple  : true,
		scrollHeight : 300, 
		multipleSeparator : ","
	}).result(function(data,row) { });
	
	
 });  
 
 

 
</script>
<?php echo javascript();  ?>
<script>


// -----------------------------------------------------------------------------
/*
 *
 * @ package		function get detail content list page 
 * @ param			not assign parameter
 */

 window.SpinerPage = function( obj )
{
	var user_state_page = Ext.Cmp('frm-field-agent-state').getValue();
	var user_show_page = Ext.Cmp('frm-field-agent-show').getValue();
	
	$('#ui-window-users').Spiner 
	({
		url 	: Ext.EventUrl(new Array('ModBroadcastMsg','EventUserActive')).Apply(),
		param 	: { 
			UserActive : 1,
			UserLogin  : user_state_page,
			ShowPager  : user_show_page.join('')		
		},
		order   : {
			order_type : obj.type,
			order_by   : obj.orderby,
			order_page : obj.page	
		}, 
		complete : function( obj ){
		
		}
	});
}


// -----------------------------------------------------------------------------
/*
 *
 * @ package		function get detail content list page 
 * @ param			not assign parameter
 */

 
 window.EventClear = function()
{
	Ext.Cmp("text_message").setValue("");
	Ext.Cmp("text_message").setFocus();
}


// -----------------------------------------------------------------------------
/*
 *
 * @ package		function get detail content list page 
 * @ param			not assign parameter
 */
 
 window.EventSubmit = function()
{
	var UserId = Ext.Cmp('UserId').getValue();
	if( UserId.length ==0 ){
		Ext.Msg("Please select a User ").Info();
		return false;
	}
	
	var TextMessage = Ext.Cmp("text_message").getValue();
	if( TextMessage == '' ){
		Ext.Msg("Please input Text Message").Info();
		Ext.Cmp("text_message").setFocus();
		return false;
	}
	
// --- input sent via ajax --- 
	
	Ext.Ajax 
	({
		url 	: Ext.EventUrl(new Array('ModBroadcastMsg','SentBroadcastMessage')).Apply(),
		method 	: 'POST',
		param 	: {
			UserData 	: Ext.Cmp('UserId').getValue(),
			TextMessage : Ext.Cmp("text_message").getValue()
		},
		ERROR : function(e)
		{
			Ext.Util(e).proc(function( data ){
				if( data.success == 1) {
					Ext.Msg("Send Message").Success();
				} else {
					Ext.Msg("Send Message").Failed();
				}	
			});
		}
	}).post();
}	

	
/* SendAllUser ******/

// Ext.DOM.SendAllUser = function()
// {
	// if(Ext.Cmp('Users').empty()){  
	   // Ext.Msg("Please Select User").Info();  return false; }
	// else
	// {
		// if ( Ext.Cmp('text_message').empty()){ 
			// Ext.Msg("Text message is empty").Error();
			// return false;
		// }
		// else
		// {
			// Ext.Ajax
			// ({
				// url 	: Ext.DOM.INDEX +'/ModBroadcastMsg/SendUserAll/',
				// method 	: 'POST',
				// param 	: {
					// UserData 	: Ext.Cmp('Users').getValue(),
					// TextMessage :  Ext.Cmp('text_message').getValue()
				// },
				// ERROR : function(e)
				// {
					// var ERR = JSON.parse( e.target.responseText );
					
					// if( ERR.success ) {
						// Ext.Msg("Send Message").Success();
					// }
					// else {
						// Ext.Msg("Send Message").Failed();
					// }
				// }
			// }).post();
		// }
	// }
// }
	
// ----------------------------------------------------------------------------------------------

/*
 * @ pack : get all labels -  array header 
 */
 
 window.UserLayout = function()
{
  $('#ui-widget-contact-tabs').css({ "background-color" : "#FBFEFF", "padding-bottom" : "15px" });
  $('.ui-widget-contact-tabs').css({"background-color" : "#FBFEFF"});
  $(".ui-widget-fieldset").css({"border-radius":"3px","margin": "12px 5px 5px 5px", "padding" : "-5px 5px 15px 5px"});
  $('.date').datepicker ({ showOn: 'button', buttonImage: Ext.Image('calendar.gif'),  buttonImageOnly: true, dateFormat:'dd-mm-yy', readonly:true });
  $('.ui-window').css({"width":"48%","text-align":"left"});
  $(".ui-widget-box").css({"width":"30%" });
  $('.ui-widget-label3').css({"width":"99%","padding": "5px 2px 5px 5px"});
  $('.bottom').css({"border-bottom": "1px dashed #dddddd" });
  $('.x-select-boot').css({"width" : "410px"});
  $('.x-select-boot').chosen();
  
}

	
// -----------------------------------------------------------

/* 
 * Method 		AddUser 
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */

 window.EventPageData = function(){
	window.SpinerPage({ orderby : '',  type: '', page: 0 });  
 }
 
 
 // -----------------------------------------------------------

/* 
 * Method 		AddUser 
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
 window.EventShowAgent = function() {
	 	window.SpinerPage({ orderby : '',  type: '', page: 0 });  
 }
  
	
// -----------------------------------------------------------

/* 
 * Method 		AddUser 
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */

$(document).ready( function() {
	
 $('.select-chosen').chosen();
 $("#ui-widget-contact-tabs").mytab().tabs();
 $("#ui-widget-contact-tabs").mytab().tabs("option", "selected", 0);
 $("#ui-widget-contact-tabs").mytab().close({}, true);
	
 window.UserLayout();
  window.SpinerPage({ orderby : '',  type: '', page: 0 }); 
	
});
</script>
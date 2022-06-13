<?php echo javascript();?>
<script>
 
 
// ----------------------------------------------------------------------------------------------

/*
 * @ pack : get all labels -  array header 
 */
 
 window.UserLayout = function()
{
  $('#ui-widget-wiki-tabs').css({ "background-color" : "#FBFEFF", "padding-bottom" : "15px" });
  $('.ui-widget-wiki-content').css({"background-color" : "#FBFEFF"});
  $(".ui-widget-fieldset").css({"border-radius":"3px","margin": "3px -2px 3px -2px", "padding" : "5px 5px 15px 5px"});
  $('.date').datepicker ({ showOn: 'button', buttonImage: Ext.DOM.LIBRARY + '/gambar/calendar.gif',  buttonImageOnly: true, dateFormat:'dd-mm-yy', readonly:true });
  $('.ui-filter-status').chosen();		
  $('.ui-filter-order').chosen();
  $('.readonly').attr('readonly', true);
  
  
}



// ----------------------------------------------------------------------------------------------

/*
 * @ pack : get all labels -  array header 
 */
 
 
$(window).bind("resize", function(){ 
	window.UserLayout();
 });

 
// ----------------------------------------------------------------------------------------------

/*
 * @ pack : get all labels -  array header 
 */
 
$(document).ready(function() 
{
   $("#ui-widget-wiki-tabs").mytab().tabs();
   $("#ui-widget-wiki-tabs").mytab().tabs("option", "selected", 0);
   $("#ui-widget-wiki-tabs").mytab().close(function(e) {
		if( Ext.Msg('Are you sure?').Confirm() ) {  Role.roleback();  } 
	});
	window.UserLayout();
 });

 
// ------------- on role get message its  ----------------------------------

/*
 * @ pack : get all labels -  array header 
 */

Ext.DOM.CancelWiki = function() 
{
	if( Ext.Msg('Are you sure?').Confirm() ) 
	{
		console.log( typeof(Role)  );	
		if( typeof(Role) =='undefined' ){
			Ext.ShowMenu("Knowledge");
		} else {	
		
			Role.roleback(); 
		}
	}  
}
 
// ------------- on role get message its  ----------------------------------

/*
 * @ pack : get all labels -  array header 
 */
 
 Ext.DOM.Update = function()
{

 var frmEditBookClass = Ext.Serialize('frmEditBookClass');

 if(!frmEditBookClass.Complete() ) {
	Ext.Msg("Input Not Complete").Info();
	return false;
 }

 //<==================================================>
 
  Ext.Ajax
 ({
	url    : Role.action("Update"),
	method : "POST",
	param  : Ext.Join([ frmEditBookClass.getElement()]).object(),
	ERROR  : function( e ) {
		Ext.Util(e).proc(function( response ){
			if( response.success ){
				Ext.Msg("Update Booking Class").Success();
			} else {
				Ext.Msg("Update Booking Class").Failed();
				return false;
			}
		});
		}
	}).post();
 }	 
 
// ------------- on role get message its  ----------------------------------

/*
 * @ pack : get all labels -  array header 
 */
 
 Ext.DOM.Save= function() 
{
 var frmClassBooking = Ext.Serialize('frmClassBooking');

 if(!frmClassBooking.Complete() ) {
	Ext.Msg("Input Not Complete").Info();
	return false;
 }

 //<==================================================>
 
  Ext.Ajax
 ({
	url    : Role.action("Save"),
	method : "POST",
	param  : Ext.Join([ frmClassBooking.getElement()]).object(),
	ERROR  : function( e ) {
		Ext.Util(e).proc(function( response ){
			if( response.success ){
				Ext.Msg("Save Booking Class").Success();
				if( Ext.Msg("Do you want to add again?").Confirm() )  {
					Ext.Ajax({ url : Role.action("Add"), method : "POST", param: {
						time : Ext.Date().getDuration()
					  }
					}).load("main_content");
				}
			} else {
				Ext.Msg("Save Booking Class").Failed();
				return false;
			}
		});
	}
 }).post();
	
}		


</script>
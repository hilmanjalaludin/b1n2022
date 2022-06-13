<script>

// ------------- on role get message its  ----------------------------------

/*
 * @ pack : get all labels -  array header 
 */
 
 window.EventSave = function()  
{
	
 var frmUserPrivilege = Ext.Serialize('frmUserPrivilege');
 if(!frmUserPrivilege.Complete() ) {
	Ext.Msg("Input Not Complete").Info();
	return false;
 }

  Ext.Ajax
 ({
	url    : Role.action("Save"),
	method : "POST",
	param  : Ext.Join([ frmUserPrivilege.getElement()]).object(),
	ERROR  : function( e ) 
	{
		Ext.Util(e).proc(function( data )
		{
			if( data.success )
			{
				Ext.Msg("Save User Privilege").Success();
				if( Ext.Msg("Do you want to add again?").Confirm() )  {
					Role.showMenu('Add', {
						ControllerId : Role.ctrl()
					});
					
				} else {
					Role.showMenu('Edit', {
						ControllerId : Role.ctrl(),
						PrivilegeId : data.PrivilegeId
					});
				}
			} else {
				Ext.Msg("Save User Privilege").Failed();
				return false;
			}
		});
	}
 }).post();
	
}
// ----------------------------------------------------------------------------------------------

/*
 * @ pack : get all labels -  array header 
 */
 
 window.UserLayout = function()
{
  $('#ui-widget-wiki-tabs').css({ "background-color" : "#FBFEFF", "padding-bottom" : "15px" });
  $('.ui-widget-wiki-content').css({"background-color" : "#FBFEFF"});
  
  $('.ui-widget-fieldset').css({
    "border-radius":"3px",
	"margin": "8px 5px 5px 5px", 
	"padding" : "5px 5px 15px 5px"
});
  $('.date').datepicker({ 
		showOn: 'button', buttonImage: Ext.Image('calendar.gif'),  
		buttonImageOnly: true, 
		dateFormat:'dd-mm-yy', 
		readonly:true 
  });
  
  $('.ui-filter-status').chosen();		
  $('.ui-filter-order').chosen();
  $('.select').chosen();
  $('.readonly').attr('readonly', true);
  $('.readonly').attr('disabled', true);
  $('.readonly').css('color', '#DDDDDD');
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
		if( Ext.Msg('Are you sure?').Confirm() ) {  
			Role.roleback();  
		} 
	}, true);
	
	window.UserLayout();
	
 });
 
 
// ------------- on role get message its  ----------------------------------

/*
 * @ pack : get all labels -  array header 
 */
 
 window.EventUpdate = function()
 {
	var frmUserPrivilege = Ext.Serialize('frmUserPrivilege');

	if(!frmUserPrivilege.Complete() ) {
		Ext.Msg("Input Not Complete").Info();
		return false;
	}
	
	Ext.Ajax
	({
		url    : Role.action("Update"),
		method : "POST",
		param  : Ext.Join([ frmUserPrivilege.getElement()]).object(),
		ERROR  : function( e ) {
			Ext.Util(e).proc(function( response ){
				if( response.success ){
					Ext.Msg("Update User Privilege").Success();
				} else {
					Ext.Msg("Update User Privilege").Failed();
					return false;
				}
			});
		}
	}).post();
 }	 
 
 
</script>
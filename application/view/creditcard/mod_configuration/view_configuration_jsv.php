<script>
// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
Ext.DOM.RoleBack = function()
{
	if( Ext.Msg('Are you sure ?').Confirm() ){
		new Ext.ShowMenu("Configuration", Ext.System.view_file_name());	
	}
}


// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
 window.EventUpdate = function()
{
	
 var frmConfigUser = Ext.Serialize('frmConfigUser');
  Ext.Ajax
   ({
	   url 	 	: Role.action('Update'),
	   method 	: 'POST',
	   param  	: Ext.Join(new Array(
					frmConfigUser.getElement() 
				 )).object(),
				 
	   ERROR	: function (e) 
	   {
		  Ext.Util(e).proc(function( data )
		  {
			  if( data.success ) {
				  Ext.Msg("Update Configuration").Success();
			  } 
			  else {
				Ext.Msg("Update Configuration").Failed();
				return false;
			  }
		  });
	  } 	
   }).post(); 
   
 }
 

// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
 window.EventSave = function()
 {
	
 var frmConfigUser = Ext.Serialize('frmConfigUser');
 var cond = frmConfigUser.Complete( new Array ('refConfigCode'));
if( !cond ){
	Ext.Msg('Input form not complete').Info();
	return false;
}
	
// ------------- save data user ----------------------------------------------
	
    Ext.Ajax
   ({
	   url 	 	: Role.action('Save'),
	   method 	: 'POST',
	   param  	: Ext.Join(new Array( frmConfigUser.getElement()  )).object(),
	   ERROR	: function (e)  {
		   Ext.Util(e).proc(function( data ) {
			  if( data.success ) {
				  Ext.Msg("Add Configuration").Success();
			  } 
			  else {
				Ext.Msg("Add Configuration").Failed();
				return false;
			  }
		  });
	  } 	
   }).post(); 
	
} 


// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
$(document).ready( function()
{
  $('#ui-widget-add-campaign').mytab().tabs();
  $('#ui-widget-add-campaign').mytab().tabs("option", "selected", 0);
  $('#ui-widget-add-campaign').css({'background-color':'#FFFFFF'});
  $('#ui-widget-add-content').css({'background-color':'#FFFFFF'});
  $("#ui-widget-add-campaign").mytab().close(function(){
	  Ext.DOM.RoleBack();
  },true);
  
 //-------- disabled by select class --------------------
  $('.cell-disabled').each(function(){
	  $(this).attr('disabled','true');
  });
  $('.select').chosen();
});
</script>
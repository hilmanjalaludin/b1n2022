<script>
// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
Ext.DOM.RoleBack = function()
{
	if( Ext.Msg('Are you sure ?').Confirm() ){
		new Ext.ShowMenu("CtiExtension", Ext.System.view_file_name());	
	}
}


// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
 window.EventUpdate = function()
{
	
 var frmEditExtension = Ext.Serialize('frmEditExtension');
  Ext.Ajax
   ({
	   url 	 	: Role.action('SetEventUpdate'),
	   method 	: 'POST',
	   param  	: Ext.Join(new Array(
					frmEditExtension.getElement() 
				 )).object(),
				 
	   ERROR	: function (e) 
	   {
		  Ext.Util(e).proc(function( data )
		  {
			  if( data.success ) {
				  Ext.Msg("Update Extension").Success();
			  } 
			  else {
				Ext.Msg("Update Extension").Failed();
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
	
 var frmAddExtension = Ext.Serialize('frmAddExtension');
 var cond = frmAddExtension.Complete();
if( !cond ){
	Ext.Msg('Input form not complete').Info();
	return false;
}
	
// ------------- save data user ----------------------------------------------
	
    Ext.Ajax
   ({
	   url 	 	: Role.action('EventSaveExtension'),
	   method 	: 'POST',
	   param  	: Ext.Join(new Array( frmAddExtension.getElement()  )).object(),
	   ERROR	: function (e)  {
		   Ext.Util(e).proc(function( data ) {
			  if( data.success ) {
				  Ext.Msg("Add Extension").Success();
			  } 
			  else {
				Ext.Msg("Add Extension").Failed();
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
<script>
// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
Ext.DOM.RoleBack = function()
{
	if( Ext.Msg('Are you sure ?').Confirm() ){
		Role.roleback();
	}
}

//-----------------------------------------------------------------------

/*
 * modul  		 	method get User Role 
 *
 * @akses 			public & of run window  
 * @author 			uknown 
 */
 

var Role = new Ext.Role("SysThemes");
	Role.extend([
		{ title: " ", icon :"", event: "", key :'ThemeId' } // if you have other extends event 
	]);
	
// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */

 window.EventSave =function()
{
 var frmAddLayout = Ext.Serialize('frmAddLayout');
 if( !frmAddLayout.Complete()){
	Ext.Msg('Form input not complete!').Info();
	return false;
 }
	
  Ext.Ajax
  ({
	url 	: Role.action('Save'),  //Ext.EventUrl(['SysUserLayout','SaveLayout']).Apply(), 
	method  : 'POST',
	param   : Ext.Join(new Array(frmAddLayout.Initialize())).object(),
	success : function( response ) 
	{
		Ext.Util(response).proc(function( data){
			if( data.success == 1 ){
				Ext.Msg("Save Layout").Success();
			} else {
				Ext.Msg("Save Layout").Failed();
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
 
 window.EventUpdate = function()
{
	var frmEditLayout = Ext.Serialize('frmEditLayout');
	if( !frmEditLayout.Complete() ){
		Ext.Msg('Form input not complete!').Info();
		return false;
	}
	
  Ext.Ajax
  ({
	url 	: Role.action('Update'),  //Ext.EventUrl(['SysUserLayout','SaveLayout']).Apply(), 
	method  : 'POST',
	param   : Ext.Join(new Array(frmEditLayout.Initialize())).object(),
	success : function( response ) 
	{
		Ext.Util(response).proc(function( data){
			if( data.success == 1 ){
				Ext.Msg("Update Layout").Success();
			} else {
				Ext.Msg("Update Layout").Failed();
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
  });
  
 //-------- disabled by select class --------------------
  $('.cell-disabled').each(function(){
	  $(this).attr('disabled','true');
  });
  $('.button').css({'width' : '30%' });
  $('.select').chosen();
});
</script>
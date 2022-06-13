<script>

//-----------------------------------------------------------------------

/*
 * modul  		 	method get User Role 
 *
 * @akses 			public & of run window  
 * @author 			uknown 
 */
 

var Role = new Ext.Role("SysMenuGroup");
	Role.extend([
		{ title: " ", icon :"", event: "", key :'GU_Id' } // if you have other extends event 
	]);
	
// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
window.RoleBack = function()
{
	if( Ext.Msg('Are you sure to exit from this session ?').Confirm() ){
		Role.roleback();
	}
}

// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */

window.EventClose =function(){
	window.RoleBack();
}

// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */

window.EventSave =function()
{

	var frmAddGroupMenu = Ext.Serialize('frmAddGroupMenu');
	if( !frmAddGroupMenu.Complete() ){
		Ext.Msg('Form input not complete!').Info();
		return false;
	 }
	 
	 Ext.Ajax
	({
		url 	: Role.action('Save'),  
		method  : 'POST',
		param   : Ext.Join( new Array( frmAddGroupMenu.Initialize() )).object(),		
		success : function( xhr ) 
		{
			Ext.Util( xhr ).proc(function( data ) {
				if( data.success == 1 ){
					Ext.Msg("Save row(s)").Success();
					window.EventClose();
				} else {
					Ext.Msg("Save row(s)").Failed();
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
	var frmEditGroupMenu = Ext.Serialize('frmEditGroupMenu');
	if( !frmEditGroupMenu.Complete() ){
		Ext.Msg('Form input not complete!').Info();
		return false;
	 }
	 
	 Ext.Ajax
	({
		url 	: Role.action('Update'),  
		method  : 'POST',
		param   : Ext.Join( new Array( frmEditGroupMenu.Initialize() )).object(),		
		success : function( xhr ) 
		{
			Ext.Util( xhr ).proc(function( data ) {
				if( data.success == 1 ){
					Ext.Msg("Update row(s)").Success();
					window.EventClose();
				} else {
					Ext.Msg("Update row(s)").Failed();
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
  $('.button').css({"width" :"47%", "text-align" : "left"});
  $('.select').chosen();
});
</script>
<script>
// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
Ext.DOM.RoleBack = function()
{
	if( Ext.Msg('Are you sure ?').Confirm() ){
		new Ext.ShowMenu("CourierList", Ext.System.view_file_name());	
		
	}
}


// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */

Ext.DOM.SaveLayout=function(){

var frmAddLayout = Ext.Serialize('frmAddLayout');
if( !frmAddLayout.Complete() ){
	Ext.Msg('Form input not complete!').Info();
	return false;
}
	Ext.Ajax
	({
		url 	: Ext.EventUrl(['CourierList','SaveCourier']).Apply(), 
		method  : 'POST',
		param  : {
			KurirCode : Ext.Cmp('KurirCode').getValue(),
			KurirDesc : Ext.Cmp('KurirDesc').getValue(),
			flag  : Ext.Cmp('flag').getValue()
		},
		ERROR : function(fn) {
			Ext.Util(fn).proc(function( responseText){
				if( responseText.success == 1 ){
					Ext.Msg("Save Courier").Success();
				} else {
					Ext.Msg("Save Courier").Failed();
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
 

 Ext.DOM.UpdateLayout = function()
{
	var frmEditLayout = Ext.Serialize('frmEditLayout');
	if( !frmEditLayout.Complete() ){
		Ext.Msg('Form input not complete!').Info();
		return false;
	}

	 Ext.Ajax
	({
		url 	: Ext.DOM.INDEX +'/CourierList/Update/',
		method 	: 'POST',
		param 	: {
			KurirCode : Ext.Cmp('KurirCode').getValue(),
			KurirDesc : Ext.Cmp('KurirDesc').getValue(),
			flag  : Ext.Cmp('flag').getValue(),
			KurirID: Ext.Cmp('KurirID').getValue(),
		},
		ERROR : function(fn){
			var ERR = JSON.parse(fn.target.responseText);
			if(ERR.success){
				Ext.Msg("Update Courier").Success();
			}
			else{
				Ext.Msg("Update Courier").Failed();
			}
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
  $('.select').chosen();
});
</script>
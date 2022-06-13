<script>
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
window.RoleBack = function()
{
	if( !Ext.Msg('Are you sure ?').Confirm() ) {
		return false;
	}
// back to panel of index data OK 	
	Ext.ShowMenu("BucketKuota", 
	Ext.System.view_file_name(), {
		data : 'roleback'
	});
	
} 
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
 window.EventClose = function(){
	 window.RoleBack();
 }
 
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
 window.EventUpdate = function()
{
	// get data on event URL Process Here 
	var dataURL = Ext.EventUrl(new Array('BucketKuota', 'UpdateKuota') ),
		frmEditUserKuota = Ext.Serialize('frmEditUserKuota');
	
	
// on submit form identification 
	
	frmEditUserKuota.Submit({ 
		procedure : { 
			arg : ['complete'], 
			val : [] 
		},
		callback :{
			url  	: dataURL.Apply(), 
			method 	: 'POST',
			success : function( xhr ){
				Ext.Util( xhr ).proc(function( data ){
					if( data.success == 1  ){
						Ext.Msg("Update User Kuota").Success();
					} 
					else {
						Ext.Msg("Update User Kuota").Failed();
					}
				});	
			}
		}
	});
	 
 }
  /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
 window.EventSave = function()
{
	
 var frmAddUserKuota = Ext.Serialize('frmAddUserKuota')
 
 if( !frmAddUserKuota.Complete() ) { 
	Ext.Msg('form input not complete!').Info();
	return false; }	 
	
	var dataURL = Ext.EventUrl(new Array('BucketKuota','SubmitKuota'));
// wil sent data to process 	
    Ext.Ajax
   ({
	   url 	 	: dataURL.Apply(),
	   method 	: 'POST',
	   param  	: frmAddUserKuota.Data(),
	   success	: function ( xhr ) {
		  Ext.Util( xhr ).proc(function( data ) {
			  if( data.success ) {
				  Ext.Msg("Add User Kuota").Success();
				  frmAddUserKuota.Clear( new Array( 'BK_Kuota_Creator', 
													'BK_Kuota_UpdateTs',
													'BK_Kuota_Data'));
			  } 
			  else {
				Ext.Msg("Add User Kuota").Failed();
				return false;
			  }
		  });
	  } 		
   }).post(); 
	
} 
  /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
window.EventUserKuota = function( data ){
 var tabUiPanel = Ext.Cmp('ui-html-user-kuota');
 if( tabUiPanel.IsNull() ){
	return false;
 }
// set name url data on server Process .
var dataURL = Ext.EventUrl( new Array('BucketKuota','GroupKuota') ); 
	$('#ui-html-user-kuota').loader({
		url : dataURL.Apply(),
		method : 'POST',
		param : {
			GroupKuota : data.value
		},
		complete : function( html ){
			$(html)
			.css({'height' : '100%' })
			.find('.select').chosen();
			
		}
	});
}  
  
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
$(document).ready( function()  {
	
// create panel tab-panel 	
  $('#ui-widget-tab-panel').mytab().tabs();
  $('#ui-widget-tab-panel').mytab().tabs("option", "selected", 0);
  $("#ui-widget-tab-panel").mytab().close(function(){
	  window.EventClose();
  });
  
  // customize css data styleSheets.
  $('.ui-tab-panel-content')
  .css({ 'background-color':'#FFFFFF' });
  
  
 // disabled by select class --------------------
  $('.ui-disabled')
  .attr('disabled', true);
  
  $('.select').chosen();
  
  // customize button 
  $('.button')
	.css({'width': '48%'});
});
</script>
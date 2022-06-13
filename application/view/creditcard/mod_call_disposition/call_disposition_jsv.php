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
	Ext.ShowMenu("CallDisposition", 
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
	var dataURL = Ext.EventUrl(new Array('CallDisposition', 'UpdateDisposition') ),
		frmEditCalldisposition = Ext.Serialize('frmEditCalldisposition');
	
	
// on submit form identification 
	
	frmEditCalldisposition.Submit({ 
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
						Ext.Msg("Update Call Status Group").Success();
					} 
					else {
						Ext.Msg("Update Call Status Group").Failed();
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
 window.EventAdd = function(){
	Ext.ShowMenu( new Array('CallDisposition','AddDisposition'), 
		Ext.System.view_file_name(),  {
		ControllerId : Role.ctrl()
	}); 	 
 } 
 
  /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
 window.EventSave = function()
{
	
 var frmAddCalldisposition = Ext.Serialize('frmAddCalldisposition')
 
 if( !frmAddCalldisposition.Complete() ) { 
	Ext.Msg('form input not complete!').Info();
	return false; }	 
	
	var dataURL = Ext.EventUrl(new Array('CallDisposition','SubmitDisposition'));
// wil sent data to process 	
    Ext.Ajax
   ({
	   url 	 	: dataURL.Apply(),
	   method 	: 'POST',
	   param  	: frmAddCalldisposition.Data(),
	   success	: function ( xhr ) {
		  Ext.Util( xhr ).proc(function( data ) {
			  if( data.success ) {
				  Ext.Msg("Add Call Status Group").Success();
				  window.EventAdd();
			  } 
			  else {
				Ext.Msg("Add Call Status Group").Failed();
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
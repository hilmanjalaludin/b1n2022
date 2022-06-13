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
	Ext.ShowMenu("CampaignPerUser", 
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
	var dataURL = Ext.EventUrl(new Array('CampaignPerUser', 'Update') ),
		frmEditPerUser = Ext.Serialize('frmEditPerUser');
	
	
// on submit form identification 
	
	frmEditPerUser.Submit({ 
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
						Ext.Msg("Update Per User").Success();
					} 
					else {
						Ext.Msg("Update Per User").Failed();
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
	
 var frmAddCampaignPerUser = Ext.Serialize('frmAddCampaignPerUser')
 
 if( !frmAddCampaignPerUser.Complete( new Array('CPU_CampaignList') ) ) { 
	Ext.Msg('form input not complete!').Info();
	return false; }	 
	
	var dataURL = Ext.EventUrl(new Array('CampaignPerUser','Submit') );
// wil sent data to process 	
    Ext.Ajax
   ({
	   url 	 	: dataURL.Apply(),
	   method 	: 'POST',
	   param  	: frmAddCampaignPerUser.Data(),
	   success	: function ( xhr ) {
		  Ext.Util( xhr ).proc(function( data ) {
			  if( data.success ) {
				  Ext.Msg("Add Campaign Per User").Success();
				  frmAddCampaignPerUser.Clear( new Array());
			  } 
			  else {
				Ext.Msg("Add Campaign Per User").Failed();
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
window.EventPerUser = function( data ){
 var tabUiPanel = Ext.Cmp('ui-html-user-kuota');
 if( tabUiPanel.IsNull() ){
	return false;
 }
// set name url data on server Process .
var dataURL = Ext.EventUrl( new Array('CampaignPerUser','GroupPerUser') ); 
	$('#ui-html-user-kuota').loader({
		url : dataURL.Apply(),
		method : 'POST',
		param : {
			GroupPerUser : data.value
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
  
  
window.AddCampaignPeruUser = function(){
	
//membuat prototype class .	
	this.Tambah = function(){
		var dataContinuePerUser = new Ext.options({
			fo : Ext.Cmp('CPU_CampaignList').getElementId(),
			to : Ext.Cmp('CPU_CampaignAdd').getElementId()	
		});
		
		dataContinuePerUser.move();
		return true;
	}
	
// hapus data 	
	this.Hapus = function(){ 
		var dataContinuePerUser = new Ext.options({
			fo : Ext.Cmp('CPU_CampaignAdd').getElementId(),
			to : Ext.Cmp('CPU_CampaignList').getElementId()	
		});
		dataContinuePerUser.move();
		return true;
	}
	return this;
	
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
  
  //$('.select').chosen();
  
  // customize button 
  $('.button')
	.css({'width': '145px'});
});
</script>
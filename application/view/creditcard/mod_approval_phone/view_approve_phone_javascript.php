<script>
var V_SCRIPT = {};

// ==================> 


// ---------------------------------------------------------------------------------------
/* 
 * @ param : roleback 
 */
 
 window.RoleBack =function()  {	
 if( Ext.Msg('Are you sure?').Confirm() )
 {	
	var ControllerId = Ext.Cmp('ControllerId').getValue();
		Ext.ShowMenu(new Array(ControllerId, 'index'),
			Ext.System.view_file_name(),
		{
			time : Ext.Date().getDuration()
		});
  }
	
}
	
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
 window.PageCallHistory = function( obj )
{
	var tabPanelHistoryID =  Ext.Cmp('tabPanelCallHistory');
	if ( tabPanelHistoryID.IsNull() ){
		console.log('tab panel id empty');
		return false;
	}
	
	// kemudian check juga dataini.
	
   var CustomerId = Ext.Cmp('CustomerId').getValue(),
	   winDataUrl = Ext.EventUrl(new Array('ModCallHistory','PageCallHistory'));
   
   
   $('#tabPanelCallHistory').Spiner ({
	   url 	  : winDataUrl.Apply(),
	   param  :{
		   CustomerId : CustomerId
	   },
	   order  : {
			order_type : obj.type,
			order_by   : obj.orderby,
			order_page : obj.page	
		}, 
		handler  : 'PageCallHistory',
		complete : function( html ){
			//console.log( html );	
			$(html).css({'height' : '100%'});
		}
   });
}
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
 window.EventCallRecording = function( obj )
{
	var tabPanelDataID =  Ext.Cmp('tabPanelCallRecording');
	if ( tabPanelDataID.IsNull() ){
		console.log('tab panel id empty');
		return false;
	}
	var CustomerId = Ext.Cmp('CustomerId').getValue(),
		ControllerId = Ext.Cmp('ControllerId').getValue(),
		dataUrlServer = Ext.EventUrl( new Array('ModCallHistory','PageCallRecording') );
		
	// loader by spiner process data .
	$('#tabPanelCallRecording').Spiner ({
		url 	  : dataUrlServer.Apply(),
		param  :{
		   CustomerId 	: CustomerId,
		   ControllerId : ControllerId
		},
		order  : {
			order_type : obj.type,
			order_by   : obj.orderby,
			order_page : obj.page	
		}, 
		 handler  : 'EventCallRecording',
		 complete : function( html ){
			$(html).css({'height' : '100%'}); 
		}
   });
}
  
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 
  window.EventPlay= function( RecordId )  
 {
	var WinUrl  = new Ext.EventUrl( new Array('QtyApprovalInterest',  'VoicePlay')), WinHeight = 100;
	var WinPlay = new Ext.Window ({
		url    : WinUrl.Apply(),
		name   : 'winplay',
		top    : 0,
		left   : $(window).width(),  
		width  : ($(window).width()/2),
		height : (($(window).height()/2) - WinHeight),
		param  :  {
			RecordId : RecordId
		} 
	});
	
	WinPlay.popup();
	
 }
 
/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 window.EventSubmit= function() 
{
  var frmApprovalUser = Ext.Serialize('frmApprovalUser');
  if( !frmApprovalUser.Complete() ){
	  Ext.Msg('Input form not completed').Info();
	return false;
  }
  
  // jika process Data Ok dan melewati fase 
  // pemeriksaaan 
  
  Ext.Ajax 
  ({
	url 	: Ext.EventUrl(new Array('ModApprovePhone','Approval')).Apply(),
	method  : 'POST',
	param   : frmApprovalUser.Data(),
	success  : function( xhr ){
		//call my object data Util. object
		
		Ext.Util( xhr ).proc(function( data ) {
			
			if( data.success ){
				Ext.Msg("Approve Additional Contact").Success();
				Ext.Cmp("ApprovalStatus").disabled(true);
				
				// refresh data content o history process
				// by user like this.
				
				window.PageCallHistory({orderby: '' , type : '', page : ''});
				return false;
			}	
			else{
				Ext.Msg("Approve Additional Contact").Failed();
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
$(document).ready(function()
{
 
  $('#ui-content-tab-data').mytab().tabs();
  $('#ui-content-tab-data').mytab().tabs("option", "selected", 0);
  $("#ui-content-tab-data").mytab().close(function() { 
		window.RoleBack(); 
	},true);
 
 // untuk tab history process 
 
  $("#ui-content-tabs-history").mytab().tabs(); 
  $('#ui-content-tabs-history').mytab().tabs("option", "selected", 0);
  $("#ui-content-tabs-history").mytab().close({},true);
  
 // content customize css  
  
  $('#ui-content-tab-data').css({ 
	"background-color" : "#FBFEFF", 
	"padding-bottom" : "15px",
	'margin' : '0px -8px 0px 0px' 
	});
	
  $('.ui-content-tab-data').css({
	  "background-color" : "#FBFEFF" 
	 });
	 
	$('div.ui-content-tabs-history')
	.css({'background-color' : '#FFFFFF'});	
  
   $('.tab-bottom-activity-user').css({
	  'background-color':'#FFFFFF',
	  'overflow':'auto'
  });
 // ------------------------------------------------------------------------------------------- 
  
  //$('.cell-disabled').each(function(){ Ext.Cmp($(this).attr('id')).disabled(true); });
  
  $('.textarea').css({
		"height": "130px", 
		"width": "245px"
	}); 
  $('input.ui-customize-data').css({
	 'width' : '250px' 
  });	
  
  $('select.ui-customize-data')
  .css({ 'width' : '254px' })
  .chosen();
  
  $('.ui-disabled')
  .attr('disabled', true);
  
  $('input.button')
  .css({'width': '47%'});
  
  
  
 // customize witdth field && call data tabulasi 
 // activity user.
 
 window.PageCallHistory({orderby: '' , type : '', page : ''});
 window.EventCallRecording({orderby: '' , type : '', page : ''});
 
   // scrollbars data view */
 $('.ui-widget-form-flexi-scrollbars').jScrollPane({
	hijackInternalLinks: true
  });
	
});


</script>
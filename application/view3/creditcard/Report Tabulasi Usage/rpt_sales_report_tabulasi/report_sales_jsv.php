<script>
// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
Ext.DOM.RoleBack = function() {
	if( Ext.Msg('Are you sure ?').Confirm() ){
		if( Ext.Msg('Are you sure ?').Confirm() ) {
			new Ext.BackHome();
		}
	}
}

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
function LayoutReport() {
  $('#ui-report-tab-panel').mytab().tabs();
  $('#ui-report-tab-panel').mytab().tabs("option", "selected", 0);
  $("#ui-report-tab-panel").mytab().close(function(){ Ext.DOM.RoleBack(); }, true);
  $('.ui-widget-panel-class-tabs').css({'background-color':'#FFFFFF'});
  
  // -------- date picker  ----------------------
  $('.date').datepicker ({ 
	    showOn : 'button', buttonImage : Ext.Image("calendar.gif"),  buttonImageOnly	: true, 
		dateFormat : 'dd-mm-yy', readonly:true, changeYear:true, changeMonth:true 
  });

  
  $('#ui-widget-tabs-title').html( Ext.System.view_file_name() ); 
  
  $("#RecsourceId").toogle();
  $("#ManagerId").toogle();
  $("#spvId").toogle();
  $("#TmrId").toogle();
  
  
  $("#user_manager_id").toogle();
  $("#user_spv_id").toogle();
  $("#user_tmr_id").toogle();
 }

 function ShowFilterReport( obj ) 
{
	if( obj.value === 'filter_campaign_group_agent' ) {
		Ext.Cmp('interval').setValue('summary');
		Ext.Cmp('interval').disabled(true);
	} 
	else if( obj.value == 'filter_campaign_group_date') {
		Ext.Cmp('interval').setValue('summary');
		Ext.Cmp('interval').disabled(true);
		
	} else {
		Ext.Cmp('interval').setValue(0);
		Ext.Cmp('interval').disabled(false);
	}	
}

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 

function ShowReport() 
{
	var param = new Array();
		param['mode'] = "HTML";
	var frmReport = Ext.Serialize("frmReport");
	
	var cond = frmReport.Required(new Array('campaign_id', 'start_date', 'end_date'));
	if( !cond){
		Ext.Msg("Report form not complete!").Info();	
		return false;
	}	
	
	Ext.Window
	({
		url 	: Ext.EventUrl(new Array('SalesReportTabulasi', 'ShowReport') ).Apply(), 
		param 	: Ext.Join( new Array( frmReport.getElement(), param) ).object()
	}).newtab();
}

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
function ShowExcel() 
{
	var param = new Array();
		param['mode'] = "EXCEL";
	var frmReport = Ext.Serialize("frmReport");
	var cond = frmReport.Required(new Array('campaign_id', 'start_date', 'end_date'));
	
	if( !cond){
		Ext.Msg("Report form not complete!").Info();	
		return false;
	}	
	
	Ext.Window
	({
		url 	: Ext.EventUrl(new Array('SalesReportTabulasi', 'ShowExcel') ).Apply(), 
		param 	: Ext.Join( new Array( frmReport.getElement(), param) ).object()
	}).newtab();
	
}

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
function ShowAtmReportByManger( obj ) {
	var ManagerId = Ext.Cmp('ManagerId').getValue();
	$("#ui-widget-content-row2").loader ({
		url  : new Array('CallTrackingReport','ShowAtmReportByManger'),
		param : { ManagerId : ManagerId },
		complete : function( data ){
			$("#ui-widget-content-row2").attr("style", "");
			$("#AtmId").toogle();
			
			new ShowFilterReportByAtm()
			
		}
	});
	
}

 // --- new ------------------------------------
 
function UserShowSpvReportByManger( obj )
{
	var ManagerId = Ext.Cmp('user_manager_id').getValue();
	$("#ui-widget-content-user-row3").loader ({
		url  : new Array('CallTrackingReport','UserShowSpvReportByManger'),
		param : { ManagerId : ManagerId },
		complete : function( data ){
			$("#ui-widget-content-user-row3").attr("style", "");
			$("#user_spv_id").toogle();
		}
	});
}

// ---- new ------------------------- 

function UserShowAgentReportBySpv()
{
	var SpvId = Ext.Cmp('user_spv_id').getValue();
	$("#ui-widget-content-user-row4").loader ({
		url  : new Array('CallTrackingReport','UserShowAgentReportBySpv'),
		param : { SpvId : SpvId },
		complete : function( data ){
			$("#ui-widget-content-user-row4").attr("style", "");
			$("#user_tmr_id").toogle();
		}
	});
}


//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 function ShowFilterReportByAtm( obj )
{
	var AtmId = Ext.Cmp('AtmId').getValue();
	$("#ui-widget-content-row3").loader ({
		url  : new Array('CallTrackingReport','ShowSpvReportByAtm'),
		param : { AtmId : AtmId },
		complete : function( data ){
			$("#ui-widget-content-row3").attr("style", "");
			$("#spvId").toogle();
			new ShowAgentReportBySpv();
		}
	});
 }
 
 /*
  * [Recovery  "_getProduct"]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
window.showCampaignByProductId = function( option ){
	var ProductId = option.value;
	var dataURL = Ext.EventUrl( new Array('SalesReportTabulasi', 'ShowCampaignByProductId'));
	
	$('#filter-data-campaign').loader({
		url 	: dataURL.Apply(),
		method 	: 'POST',
		param 	: {
			ProductId : ProductId 
		},
		// response if loader Sucess/ complete  
		complete : function( xhr ){
			$(xhr).css({ 'height' : '100%'});
			$(xhr).find('.x-select').chosen();
		}	
	});
}
 
 /*
  * [Recovery  "_getProduct"]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
window.showRecsourceByCampaignId = function( option ){
	var CampaignId = option.value;
	var dataURL = Ext.EventUrl( new Array('SalesReportTabulasi', 'ShowRecsourceByCampaignId'));
	
	$('#filter-data-recsource').loader({
		url 	: dataURL.Apply(),
		method 	: 'POST',
		param 	: {
			CampaignId : CampaignId 
		},
		// response if loader Sucess/ complete  
		complete : function( xhr ){
			$(xhr).css({ 'height' : '100%'});
			$(xhr).find('.x-select').chosen();
			
		}	
	});
}
 

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
  
 function ShowAgentReportBySpv( obj )
 {
	var SpvId = Ext.Cmp('spvId').getValue();
	$("#ui-widget-content-row4").loader ({
		url  : new Array('CallTrackingReport','ShowAgentReportBySpv'),
		param : { SpvId : SpvId },
		complete : function( data ){
			$("#ui-widget-content-row4").attr("style", "");
			$("#TmrId").toogle();
		}
	});
 }

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
$( document ).ready(function() {
	new LayoutReport();
	
	$('.x-select').chosen();
});

</script>
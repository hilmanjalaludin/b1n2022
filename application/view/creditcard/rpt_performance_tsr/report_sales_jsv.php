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
  $("#supervisor_id").toogle();
  
  
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


/*
 * [Recovery data failed upload "BODY CONTENT"]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */ 

function ShowReport() 
{
	var param = new Array();
		param['mode'] = "HTML";
	var frmReport = Ext.Serialize("frmReport");
	
	var cond = frmReport.Required(new Array( 'start_date', 'end_date', 'report_group'));
	if( !cond){
		Ext.Msg("Report form not complete!").Info();	
		return false;
	}	
	
	Ext.Window
	({
		url 	: Ext.EventUrl(new Array('RptPerformanceTsr', 'ShowReport') ).Apply(), 
		param 	: Ext.Join( new Array( frmReport.getElement(), param) ).object()
	}).newtab();
}


/*
 * [Recovery data failed upload "BODY CONTENT"]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */ 
function ShowExcel() 
{
	var param = new Array();
		param['mode'] = "EXCEL";
	var frmReport = Ext.Serialize("frmReport");
	var cond = frmReport.Required(new Array('start_date', 'end_date'));
	
	if( !cond){
		Ext.Msg("Report form not complete!").Info();	
		return false;
	}
	
	Ext.Window
	({
		url 	: Ext.EventUrl(new Array('RptPerformanceTsr', 'ShowExcel') ).Apply(), 
		param 	: Ext.Join( new Array( frmReport.getElement(), param) ).object()
	}).newtab();
	
}


/*
 * [Recovery data failed upload "BODY CONTENT"]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */ 
function ShowText(){
	var param = new Array();
		param['mode'] = "TEXT";
	var frmReport = Ext.Serialize("frmReport");
	var cond = frmReport.Required(new Array('campaign_id', 'start_date', 'end_date'));
	
	if( !cond){
		Ext.Msg("Report form not complete!").Info();	
		return false;
	}	
	
	Ext.Window ({
		url 	: Ext.EventUrl(new Array('RptPerformanceTsr', 'ShowText') ).Apply(), 
		param 	: Ext.Join( new Array( frmReport.getElement(), param) ).object()
	}).newtab();
}

/*
 * [Recovery data failed upload "BODY CONTENT"]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
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
	var dataURL = Ext.EventUrl( new Array('RptPerformanceTsr', 'ShowCampaignByProductId'));
	
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
			
			if( ProductId.localeCompare('23') ){
				$('.page-blank').attr('disabled', true);
			} else{
				$('.page-blank').attr('disabled', false);
			}
		}	
	});
}
 
 /*
  * [Recovery  "_getProduct"]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
window.showRecsourceByCampaignId = function( option ){
	var a = Ext.Cmp('campaign_id').getValue();
	if(a == 35) {
		Ext.Cmp('transaksi').disabled(false);
		// alert('test');
	} else {
		Ext.Cmp('transaksi').disabled(true);
	}
	var CampaignId = option.value;
	var dataURL = Ext.EventUrl( new Array('RptPerformanceTsr', 'ShowRecsourceByCampaignId'));
	
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
	var SpvId = Ext.Cmp('supervisor_id').getValue();
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
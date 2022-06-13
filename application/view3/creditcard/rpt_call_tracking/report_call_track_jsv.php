<script>
	/*
	 * [Recovery data failed upload HSBC TAMAN SARI]
	 * @param  [type] $CustomerId [description]
	 * @return [type]             [description]
	 */
	Ext.DOM.RoleBack = function() {
		if( Ext.Msg('Are you sure ?').Confirm() ){
			if( Ext.Msg('Are you sure ?').Confirm() ) {
				new Ext.BackHome();
			}
		}
	}

	/*
	 * [Recovery data failed upload HSBC TAMAN SARI]
	 * @param  [type] $CustomerId [description]
	 * @return [type]             [description]
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
		  
		  $("#CampaignId").toogle();
		  $("#CampaignIdNew").toogle();
		  $("#ProductId").toogle();
		  $("#ManagerId").toogle();
		  $("#ManagerIdNew").toogle();
		  $("#spvidnew").toogle();
		  $("#TmrIdNew").toogle();
		  $("#spvid").toogle();
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
	function UserShowReport() 
	{
		var param = new Array();
			param['mode'] = "HTML";
		var frmReport = Ext.Serialize("frmUserReport");
		
		var cond = frmReport.Required(new Array('user_report_type', 'user_start_date', 'user_end_date','user_interval'));
		if( !cond){
			Ext.Msg("Report form not complete!").Info();	
			return false;
		}	
		
		Ext.Window
		({
			url 	: Ext.EventUrl(new Array('CallTrackingReport', 'ShowReport') ).Apply(), 
			param 	: {
				mode 		: 'HTML',
				report_type : Ext.Cmp('user_report_type').getValue(),
				ManagerId  	: Ext.Cmp('user_manager_id').getValue(),
				SpvId 	 	: Ext.Cmp('user_spv_id').getValue(),
				TmrId		: Ext.Cmp('user_tmr_id').getValue(),
				start_date  : Ext.Cmp('user_start_date').getValue(),
				end_date	: Ext.Cmp('user_end_date').getValue(),
				interval	: Ext.Cmp('user_interval').getValue()
			}
		}).newtab();
	}

	/*
	 * [Recovery data failed upload HSBC TAMAN SARI]
	 * @param  [type] $CustomerId [description]
	 * @return [type]             [description]
	 */
 	window.EventSubmit = function() {
		
		var frmReportHtml = Ext.Serialize("frmReport");
		var frmReportCond = frmReportHtml.Required(new Array('report_type', 'start_date', 'end_date','interval'));
		 
		// check argument parameter report 
		// yang akn di kirm ke backand .
		 
		var dataURL = Ext.EventUrl( new Array('CallTrackingReport', 'ShowReport','html' ) );
		if( !frmReportCond ){
			Ext.Msg("Report form not complete!").Info();	
			return false;
		}	
		 
		// launcher data window on new tab 
		// methode.
		console.log( frmReportHtml.Data());
			
		Ext.Window ({
			url   : dataURL.Apply(), //Ext.EventUrl(new Array('CallTrackingReport', 'ShowReport') ).Apply(), 
			param : frmReportHtml.Data()
		}).newtab();
			
		// end .	
	}
	
	/*
	 * [Recovery data failed upload HSBC TAMAN SARI]
	 * @param  [type] $CustomerId [description]
	 * @return [type]             [description]
	 */
    function ShowReports() {
	
		var frmReportHtml = Ext.Serialize("frmReport");
		var frmReportCond = frmReportHtml.Required(new Array('report_type', 'start_date', 'end_date','interval'));
		 
		// check argument parameter report 
		// yang akn di kirm ke backand .
		 
		var dataURL = Ext.EventUrl( new Array('CallTrackReport', 'ShowReport','html' ) );
	 	
	 	if( !frmReportCond ){
			Ext.Msg("Report form not complete!").Info();	
			return false;
	 	}	
		 
		// launcher data window on new tab 
		// methode.
		console.log( frmReportHtml.Data());
			
		Ext.Window ({
			url   : dataURL.Apply(), //Ext.EventUrl(new Array('CallTrackingReport', 'ShowReport') ).Apply(), 
			param : frmReportHtml.Data()
		}).newtab();
			
		// end .	
	}

	/*
	 * [Recovery data failed upload HSBC TAMAN SARI]
	 * @param  [type] $CustomerId [description]
	 * @return [type]             [description]
	 */
	function ShowExcels() 
	{
		var param = new Array();
			param['mode'] = "EXCEL";
		var frmReport = Ext.Serialize("frmReport");
		var cond = frmReport.Required(new Array('report_type', 'start_date', 'end_date','interval'));
		
		if( !cond){
			Ext.Msg("Report form not complete!").Info();	
			return false;
		}	
		
		Ext.Window
		({
			url 	: Ext.EventUrl(new Array('CallTrackingReport', 'ShowExcel') ).Apply(), 
			param 	: Ext.Join( new Array( frmReport.getElement(), param) ).object()
		}).newtab();
	}
	/*
	 * [Recovery data failed upload HSBC TAMAN SARI]
	 * @param  [type] $CustomerId [description]
	 * @return [type]             [description]
	 */
	function UserShowExcel() 
	{
		var param = new Array();
			param['mode'] = "HTML";
		var frmReport = Ext.Serialize("frmUserReport");
		
		var cond = frmReport.Required(new Array('user_report_type', 'user_start_date', 'user_end_date','user_interval'));
		if( !cond){
			Ext.Msg("Report form not complete!").Info();	
			return false;
		}	
		
		Ext.Window
		({
			url 	: Ext.EventUrl(new Array('CallTrackingReport', 'ShowExcel') ).Apply(), 
			param 	: {
				mode 		: 'EXCEL',
				report_type : Ext.Cmp('user_report_type').getValue(),
				ManagerId  	: Ext.Cmp('user_manager_id').getValue(),
				SpvId 	 	: Ext.Cmp('user_spv_id').getValue(),
				TmrId		: Ext.Cmp('user_tmr_id').getValue(),
				start_date  : Ext.Cmp('user_start_date').getValue(),
				end_date	: Ext.Cmp('user_end_date').getValue(),
				interval	: Ext.Cmp('user_interval').getValue()
			}	
			
		}).newtab();
		
	}

	/*
	 * [Recovery data failed upload HSBC TAMAN SARI]
	 * @param  [type] $CustomerId [description]
	 * @return [type]             [description]
	 */
	function EventExport() 
	{
		var param = new Array();
			param['mode'] = "EXCEL";
		var frmReport = Ext.Serialize("frmReport");
		var cond = frmReport.Required(new Array('report_type', 'start_date', 'end_date','interval'));
		
		if( !cond){
			Ext.Msg("Report form not complete!").Info();	
			return false;
		}	
		
		Ext.Window
		({
			url 	: Ext.EventUrl(new Array('CallTrackingReport', 'ShowExcel') ).Apply(), 
			param 	: Ext.Join( new Array( frmReport.getElement(), param) ).object()
		}).newtab();
		
	}

	/*
	 * [Recovery data failed upload HSBC TAMAN SARI]
	 * @param  [type] $CustomerId [description]
	 * @return [type]             [description]
	 */	 
	function ShowSpvReportByManger( obj ) {
		console.log(obj);
		var ManagerId = Ext.Cmp('ManagerId').getValue();
		$("#ui-widget-content-row3").loader ({
			url 	: new Array('CallTrackingReport','ShowSpvReportByManger'),
			param 	: { 
				ManagerId : ManagerId 
			},
			complete : function( data ){
				$(data).css({ 'height' : '100%'});
				$("#ui-widget-content-row2").attr("style", "");
				
				$("#SpvId").toogle();
				//new ShowFilterReportByAtm()
				
			}
		});
	}

	/*
	 * [Recovery data failed upload HSBC TAMAN SARI]
	 * @param  [type] $CustomerId [description]
	 * @return [type]             [description]
	 */	 
	function ShowSpvReportAbsentByManger( obj )
	{
		var ManagerId = Ext.Cmp('user_manager_id').getValue();
		$("#ui-widget-content-user-row3").loader ({
			url  : new Array('CallTrackingReport','ShowSpvReportAbsentByManger'),
			param : { ManagerId : ManagerId },
			complete : function( data ){
				$("#ui-widget-content-user-row3").attr("style", "");
				$("#user_spv_id").toogle();
			}
		});
	}

	/*
	 * [Recovery data failed upload HSBC TAMAN SARI]
	 * @param  [type] $CustomerId [description]
	 * @return [type]             [description]
	 */	 
	function ShowAgentReportAbsentBySpv()
	{
		var user_spv_id = Ext.Cmp('user_spv_id').getValue();
		$("#ui-widget-content-user-row4").loader ({
			url  : new Array('CallTrackingReport','ShowAgentReportAbsentBySpv'),
			param : { SpvId : user_spv_id },
			complete : function( data ){
				$("#ui-widget-content-user-row4").attr("style", "");
				$("#user_tmr_id").toogle();
			}
		});
	}

	/*
	 * [Recovery data failed upload HSBC TAMAN SARI]
	 * @param  [type] $CustomerId [description]
	 * @return [type]             [description]
	 */	 
	function ShowFilterReportAbsent( option ){
		
	}


	/*
	 * [Recovery data failed upload HSBC TAMAN SARI]
	 * @param  [type] $CustomerId [description]
	 * @return [type]             [description]
	 */	 
	function ShowFilterReportByAtm( obj )
	{
		var AtmId = Ext.Cmp('AtmId').getValue();
		$("#ui-widget-content-row3").loader ({
			url  : new Array('CallTrackingReport','ShowSpvReportByAtm'),
			param : { AtmId : AtmId },
			complete : function( data ){
				$("#ui-widget-content-row3").attr("style", "");
				$("#SpvId").toogle();
				new ShowAgentReportBySpv();
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
		var SpvId = Ext.Cmp('SpvId').getValue();
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
	




 	function ShowFilterReportNew( obj ) 
	{
		if( obj.value === 'filter_call_track_agent' ) {
			Ext.Cmp('intervalNew').setValue('summary');
			Ext.Cmp('intervalNew').disabled(true);
			Ext.Cmp('ManagerIdNew').disabled(false);
			Ext.Cmp('spvidnew').disabled(false);
			Ext.Cmp('TmrIdNew').disabled(false);
		} 
		else if( obj.value == 'filter_call_track_campaign') {
			Ext.Cmp('intervalNew').setValue('summary');
			Ext.Cmp('intervalNew').disabled(true);
			Ext.Cmp('ManagerIdNew').disabled(true);
			Ext.Cmp('spvidnew').disabled(true);
			Ext.Cmp('TmrIdNew').disabled(true);
			
		} else {
			Ext.Cmp('intervalNew').setValue('summary');
			Ext.Cmp('intervalNew').disabled(true);
			Ext.Cmp('ManagerIdNew').disabled(true);
			Ext.Cmp('spvidnew').disabled(true);
			Ext.Cmp('TmrIdNew').disabled(true);
		}	
	}
	function ShowFilterReport2( obj ) 
	{
		if( obj.value === 'filter_call_track_agent' ) {
			Ext.Cmp('interval2').setValue('summary');
			Ext.Cmp('interval2').disabled(true);
			Ext.Cmp('ManagerId2').disabled(false);
			Ext.Cmp('spvid2').disabled(false);
			Ext.Cmp('TmrId2').disabled(false);
		} 
		else if( obj.value == 'filter_call_track_campaign') {
			Ext.Cmp('interval2').setValue('summary');
			Ext.Cmp('interval2').disabled(true);
			Ext.Cmp('ManagerId2').disabled(true);
			Ext.Cmp('spvid2').disabled(true);
			Ext.Cmp('TmrId2').disabled(true);
			
		} else {
			Ext.Cmp('interval2').setValue('summary');
			Ext.Cmp('interval2').disabled(true);
			Ext.Cmp('ManagerId2').disabled(true);
			Ext.Cmp('spvid2').disabled(true);
			Ext.Cmp('TmrId2').disabled(true);
		}	
	}


	function ShowFilterProduct( obj )
	{
		var CampaignId = Ext.Cmp('CampaignIdNew').getValue();
		$("#ui-widget-content-row-product").loader ({
			url  : new Array('CallTrackingReport','ShowFilterProduct'),
			param : { CampaignId : CampaignId },
			complete : function( data ){
				$("#ui-widget-content-row-product").attr("style", "");
				$("#ProductId").toogle();
			}
		});
 	}

	 function FilterCampaignStatus(obj)
	{
		var CampaignStatus = Ext.Cmp('CampaignStatus').getValue();
		$("#ui-widget-content-row0-new").loader ({
			url  : new Array('CallTrackingReport','FilterCampaignStatus'),
			param : {
				CampaignStatus : CampaignStatus
			},
			complete : function( data ){
				$("#CampaignIdNew").toogle();
			}
		});
	}

	/*
	 * [Recovery data failed upload HSBC TAMAN SARI]
	 * @param  [type] $CustomerId [description]
	 * @return [type]             [description]
	 */	 
	function ShowSpvReportByMangerNew( obj ) {
		console.log(obj);
		var ManagerIdNew = Ext.Cmp('ManagerIdNew').getValue();
		$("#ui-widget-content-row-spv").loader ({
			url 	: new Array('CallTrackingReport','ShowSpvReportByMangerNew'),
			param 	: { 
				ManagerIdNew : ManagerIdNew 
			},
			complete : function( data ){
				$(data).css({ 'height' : '100%'});
				$("#ui-widget-content-row-spv").attr("style", "");
				
				$("#SpvIdNew").toogle();
				//new ShowFilterReportByAtm()
				
			}
		});
	}

	//---------------------------------------------------------------------------------------

	/* properties		static 
	 *
	 * @param 			uknown 
	 * @author			uknown 
	 */
  
 	function ShowAgentReportBySpvNew( obj )
 	{
		var SpvIdNew = Ext.Cmp('spvidnew').getValue();
		$("#ui-widget-content-row-tmr").loader ({
			url  : new Array('CallTrackingReport','ShowAgentReportBySpvNew'),
			param : { SpvIdNew : SpvIdNew },
			complete : function( data ){
				$("#ui-widget-content-row-tmr").attr("style", "");
				$("#TmrIdNew").toogle();
			}
		});
 	}

	/*
	 * [Recovery data failed upload HSBC TAMAN SARI]
	 * @param  [type] $CustomerId [description]
	 * @return [type]             [description]
	 */
    function ShowReportNew() {


	
		var frmReportHtml = Ext.Serialize("frmReportNew");
		var frmReportCond = frmReportHtml.Required(new Array('report_type_new', 'new_start_date', 'new_end_date','intervalNew'));
		 
		// check argument parameter report 
		// yang akn di kirm ke backand .
		 
		var dataURL = Ext.EventUrl( new Array('CallTrackingReport', 'ShowReport','html' ) );
	 	
	 	if( !frmReportCond ){
			Ext.Msg("Report form not complete!").Info();	
			return false;
	 	}	
		 
		// launcher data window on new tab 
		// methode.
		console.log( frmReportHtml.Data());
			
		Ext.Window ({
			url   : dataURL.Apply(), //Ext.EventUrl(new Array('CallTrackingReport', 'ShowReport') ).Apply(), 
			param : {
				mode 		: 'HTML',
				report_type : Ext.Cmp('report_type_new').getValue(),
				CampaignId 	: Ext.Cmp('CampaignIdNew').getValue(),
				ProductId  	: Ext.Cmp('ProductId').getValue(),
				ManagerId  	: Ext.Cmp('ManagerIdNew').getValue(),
				SpvId 	 	: Ext.Cmp('spvidnew').getValue(),
				TmrId		: Ext.Cmp('TmrIdNew').getValue(),
				start_date  : Ext.Cmp('new_start_date').getValue(),
				end_date	: Ext.Cmp('new_end_date').getValue(),
				interval	: Ext.Cmp('intervalNew').getValue()
			}
		}).newtab();
			
		// end .	
	}
	function ShowReport2() {
		// alert('haloo')

	
		var frmReportHtml = Ext.Serialize("frmReport2");
		var frmReportCond = frmReportHtml.Required(new Array('report_type2', 'start_date2', 'end_date2','interval2'));
		 
		// check argument parameter report 
		// yang akn di kirm ke backand .
		 
		var dataURL = Ext.EventUrl( new Array('CallTrackingReport', 'ShowReport2','html' ) );
	 	
	 	if( !frmReportCond ){
			Ext.Msg("Report form not complete!").Info();	
			return false;
	 	}	
		 
		// launcher data window on new tab 
		// methode.
		console.log( frmReportHtml.Data());
			
		Ext.Window ({
			url   : dataURL.Apply(), //Ext.EventUrl(new Array('CallTrackingReport', 'ShowReport') ).Apply(), 
			param : {
				mode 		: 'HTML',
				report_type : Ext.Cmp('report_type2').getValue(),
				CampaignId 	: Ext.Cmp('CampaignId2').getValue(),
				ProductId  	: Ext.Cmp('ProductId').getValue(),
				ManagerId  	: Ext.Cmp('ManagerId2').getValue(),
				SpvId 	 	: Ext.Cmp('spvid2').getValue(),
				TmrId		: Ext.Cmp('TmrId2').getValue(),
				start_date  : Ext.Cmp('start_date2').getValue(),
				end_date	: Ext.Cmp('end_date2').getValue(),
				interval	: Ext.Cmp('interval2').getValue()
			}
		}).newtab();
			
		// end .	
	}

	/*
	 * [Report Call Tracking New]
	 * @param  [type] $CustomerId [description]
	 * @return [type]             [description]
	 */
	function ShowExcel2() 
	{
		var param = new Array();
			param['mode'] = "EXCEL";
		var frmReport = Ext.Serialize("frmReport2");
		var cond = frmReport.Required(new Array('report_type2', 'start_date2', 'end_date2','interval2'));
		
		if( !cond){
			Ext.Msg("Report form not complete!").Info();	
			return false;
		}	
		
		Ext.Window
		({
			url 	: Ext.EventUrl(new Array('CallTrackingReport', 'ShowExcel2') ).Apply(), 
			param 	: Ext.Join( new Array( frmReport.getElement(), param) ).object()
		}).newtab();
	}
	
	function ShowExcelNew() 
	{
		var param = new Array();
			param['mode'] = "EXCEL";
		var frmReport = Ext.Serialize("frmReportNew");
		var cond = frmReport.Required(new Array('report_type_new', 'new_start_date', 'new_end_date','intervalNew'));
		
		if( !cond){
			Ext.Msg("Report form not complete!").Info();	
			return false;
		}	
		
		Ext.Window
		({
			url 	: Ext.EventUrl(new Array('CallTrackingReport', 'ShowExcel') ).Apply(), 
			param 	: Ext.Join( new Array( frmReport.getElement(), param) ).object()
		}).newtab();
	}

	//---------------------------------------------------------------------------------------

	/* properties		static 
	 *
	 * @param 			uknown 
	 * @author			uknown 
	 */
	$( document ).ready(function() {
		new LayoutReport();
	});

</script>
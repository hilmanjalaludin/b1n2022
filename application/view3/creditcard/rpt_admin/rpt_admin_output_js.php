<script>

	$('.date').datepicker ({ 
		dateFormat : 'yy-mm-dd', readonly:true, changeYear:true, changeMonth:true 
	});
	
	Ext.DOM.ShowReport = function()
	{
		var supervisor	= Ext.Cmp('supervisor').getValue();
		var start_date	= Ext.Cmp('start_date').getValue();
		var end_date	= Ext.Cmp('end_date').getValue();
		
		if(supervisor == "") {
			alert('Choose Supervisor, Please!');
		} else if(start_date == "" || end_date == "") {
			alert('Set Interval, Please!');
		} else {
			Ext.Window
			({
				url 	: Ext.DOM.INDEX +'/SummaryReportAdmin/ShowReport',
				param 	: {
					supervisor : Ext.Cmp('supervisor').getValue(),
					start_date : Ext.Cmp('start_date').getValue(),
					end_date : Ext.Cmp('end_date').getValue()
				}
			}).newtab();	
		}
	}
	
	Ext.DOM.ShowExcel = function()
	{
		var supervisor	= Ext.Cmp('supervisor').getValue();
		var start_date	= Ext.Cmp('start_date').getValue();
		var end_date	= Ext.Cmp('end_date').getValue();
		
		if(supervisor == "") {
			alert('Choose Supervisor, Please!');
		} else if(start_date == "" || end_date == "") {
			alert('Set Interval, Please!');
		} else {
			Ext.Window
			({
				url 	: Ext.DOM.INDEX +'/SummaryReportAdmin/ShowExcel',
				param 	: {
					supervisor : Ext.Cmp('supervisor').getValue(),
					start_date : Ext.Cmp('start_date').getValue(),
					end_date : Ext.Cmp('end_date').getValue()
				}
			}).newtab();	
		}
	}
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
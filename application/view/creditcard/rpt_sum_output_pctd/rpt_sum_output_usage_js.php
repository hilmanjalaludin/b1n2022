<script>

	$('.date').datepicker ({ 
		dateFormat : 'yy-mm-dd', readonly:true, changeYear:true, changeMonth:true 
	});
	
	Ext.DOM.ShowReport = function()
	{
		var supervisor	= Ext.Cmp('supervisor').getValue();
		var start_date	= Ext.Cmp('start_date').getValue();
		var end_date	= Ext.Cmp('end_date').getValue();
		
		if(start_date == "" || end_date == "") {
			alert('Set Interval, Please!');
		} else {
			Ext.Window
			({
				url 	: Ext.DOM.INDEX +'/RptSumOutputUsage/ShowReport',
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
		
		if(start_date == "" || end_date == "") {
			alert('Set Interval, Please!');
		} else {
			Ext.Window
			({
				url 	: Ext.DOM.INDEX +'/RptSumOutputUsage/ShowExcel',
				param 	: {
					supervisor : Ext.Cmp('supervisor').getValue(),
					start_date : Ext.Cmp('start_date').getValue(),
					end_date : Ext.Cmp('end_date').getValue()
				}
			}).newtab();	
		}
	}

	Ext.DOM.ShowReportbalcon = function()
	{
		var supervisor	= Ext.Cmp('supervisor1').getValue();
		var start_date	= Ext.Cmp('start_date1').getValue();
		var end_date	= Ext.Cmp('end_date1').getValue();
		
		if(start_date == "" || end_date == "") {
			alert('Set Interval, Please!');
		} else {
			Ext.Window
			({
				url 	: Ext.DOM.INDEX +'/RptSumOutputBalcon/ShowReport',
				param 	: {
					supervisor : Ext.Cmp('supervisor1').getValue(),
					start_date : Ext.Cmp('start_date1').getValue(),
					end_date : Ext.Cmp('end_date1').getValue()
				}
			}).newtab();	
		}
	}
	
	Ext.DOM.ShowExcelbalcon = function()
	{
		var supervisor	= Ext.Cmp('supervisor1').getValue();
		var start_date	= Ext.Cmp('start_date1').getValue();
		var end_date	= Ext.Cmp('end_date1').getValue();
		
		if(start_date == "" || end_date == "") {
			alert('Set Interval, Please!');
		} else {
			Ext.Window
			({
				url 	: Ext.DOM.INDEX +'/RptSumOutputBalcon/ShowExcel',
				param 	: {
					supervisor : Ext.Cmp('supervisor1').getValue(),
					start_date : Ext.Cmp('start_date1').getValue(),
					end_date : Ext.Cmp('end_date1').getValue()
				}
			}).newtab();	
		}
	}

</script>
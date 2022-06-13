<script>

	$('.date').datepicker ({ 
		dateFormat : 'yy-mm-dd', readonly:true, changeYear:true, changeMonth:true 
	});
	
	Ext.DOM.ShowReportAprv = function()
	{
		var supervisor	= Ext.Cmp('supervisor').getValue();
		var start_date	= Ext.Cmp('start_date').getValue();
		var end_date	= Ext.Cmp('end_date').getValue();
		
		if(start_date == "" || end_date == "") {
			alert('Set Interval, Please!');
		} else {
			Ext.Window
			({
				url 	: Ext.DOM.INDEX +'/RptSumOutputAprv/ShowReport',
				param 	: {
					supervisor : Ext.Cmp('supervisor').getValue(),
					start_date : Ext.Cmp('start_date').getValue(),
					end_date : Ext.Cmp('end_date').getValue()
				}
			}).newtab();	
		}
	}
	
	Ext.DOM.ShowExcelAprv = function()
	{
		var supervisor	= Ext.Cmp('supervisor').getValue();
		var start_date	= Ext.Cmp('start_date').getValue();
		var end_date	= Ext.Cmp('end_date').getValue();
		
		if(start_date == "" || end_date == "") {
			alert('Set Interval, Please!');
		} else {
			Ext.Window
			({
				url 	: Ext.DOM.INDEX +'/RptSumOutputAprv/ShowExcel',
				param 	: {
					supervisor : Ext.Cmp('supervisor').getValue(),
					start_date : Ext.Cmp('start_date').getValue(),
					end_date : Ext.Cmp('end_date').getValue()
				}
			}).newtab();	
		}
	}

// edit 20112020
Ext.DOM.ShowReportbalconAprv = function()
	{
		var supervisor	= Ext.Cmp('supervisor1').getValue();
		var start_date	= Ext.Cmp('start_date1').getValue();
		var end_date	= Ext.Cmp('end_date1').getValue();
		
		if(start_date == "" || end_date == "") {
			alert('Set Interval, Please!');
		} else {
			Ext.Window
			({
				url 	: Ext.DOM.INDEX +'/RptSumOutputBalconAprv/ShowReport',
				param 	: {
					supervisor : Ext.Cmp('supervisor1').getValue(),
					start_date : Ext.Cmp('start_date1').getValue(),
					end_date : Ext.Cmp('end_date1').getValue()
				}
			}).newtab();	
		}
	}
	
	Ext.DOM.ShowExcelbalconAprv = function()
	{
		var supervisor	= Ext.Cmp('supervisor1').getValue();
		var start_date	= Ext.Cmp('start_date1').getValue();
		var end_date	= Ext.Cmp('end_date1').getValue();
		
		if(start_date == "" || end_date == "") {
			alert('Set Interval, Please!');
		} else {
			Ext.Window
			({
				url 	: Ext.DOM.INDEX +'/RptSumOutputBalconAprv/ShowExcel',
				param 	: {
					supervisor : Ext.Cmp('supervisor1').getValue(),
					start_date : Ext.Cmp('start_date1').getValue(),
					end_date : Ext.Cmp('end_date1').getValue()
				}
			}).newtab();	
		}
	}


	Ext.DOM.ShowReportpctdAprv = function()
	{
		var supervisor	= Ext.Cmp('supervisor_pctd').getValue();
		var start_date	= Ext.Cmp('start_date_pctd').getValue();
		var end_date	= Ext.Cmp('end_date_pctd').getValue();
		
		if(start_date == "" || end_date == "") {
			alert('Set Interval, Please!');
		} else {
			Ext.Window
			({
				url 	: Ext.DOM.INDEX +'/RptSumOutputPctdAprv/ShowReport',
				param 	: {
					supervisor : Ext.Cmp('supervisor_pctd').getValue(),
					start_date : Ext.Cmp('start_date_pctd').getValue(),
					end_date : Ext.Cmp('end_date_pctd').getValue()
				}
			}).newtab();	
		}
	}
	
	Ext.DOM.ShowExcelpctdAprv = function()
	{
		var supervisor	= Ext.Cmp('supervisor_pctd').getValue();
		var start_date	= Ext.Cmp('start_date_pctd').getValue();
		var end_date	= Ext.Cmp('end_date_pctd').getValue();
		
		if(start_date == "" || end_date == "") {
			alert('Set Interval, Please!');
		} else {
			Ext.Window
			({
				url 	: Ext.DOM.INDEX +'/RptSumOutputPctdAprv/ShowExcel',
				param 	: {
					supervisor : Ext.Cmp('supervisor_pctd').getValue(),
					start_date : Ext.Cmp('start_date_pctd').getValue(),
					end_date : Ext.Cmp('end_date_pctd').getValue()
				}
			}).newtab();	
		}
	}

// edit 20112020

	
</script>
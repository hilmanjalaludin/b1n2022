<script>

	$('.date').datepicker ({ 
		dateFormat : 'yy-mm-dd', readonly:true, changeYear:true, changeMonth:true 
	});
	
	Ext.DOM.ShowReport = function()
	{
		var campaign	= Ext.Cmp('campaign_id').getValue();
		var start_date	= Ext.Cmp('start_date').getValue();
		var end_date	= Ext.Cmp('end_date').getValue();
		var mode		= Ext.Cmp('mode').getValue();
		
		if(start_date == "" || end_date == "") {
			alert('Set Interval, Please!');
		} else if(mode == "") {
			alert('Choose Mode, Please!');
		} else {
			Ext.Window
			({
				url 	: Ext.DOM.INDEX +'/RptTabulasi/ShowReport',
				param 	: {
					campaign_id : Ext.Cmp('campaign_id').getValue(),
					start_date : Ext.Cmp('start_date').getValue(),
					end_date : Ext.Cmp('end_date').getValue(),
					mode : Ext.Cmp('mode').getValue()
				}
			}).newtab();	
		}
	}
	
	Ext.DOM.ShowExcel = function()
	{
		var campaign	= Ext.Cmp('campaign_id').getValue();
		var start_date	= Ext.Cmp('start_date').getValue();
		var end_date	= Ext.Cmp('end_date').getValue();
		var mode		= Ext.Cmp('mode').getValue();
		
		if(start_date == "" || end_date == "") {
			alert('Set Interval, Please!');
		} else if(mode == "") {
			alert('Choose Mode, Please!');
		} else {
			Ext.Window
			({
				url 	: Ext.DOM.INDEX +'/RptTabulasi/ShowExcel',
				param 	: {
					campaign_id : Ext.Cmp('campaign_id').getValue(),
					start_date : Ext.Cmp('start_date').getValue(),
					end_date : Ext.Cmp('end_date').getValue(),
					mode : Ext.Cmp('mode').getValue()
				}
			}).newtab();	
		}
	}

</script>
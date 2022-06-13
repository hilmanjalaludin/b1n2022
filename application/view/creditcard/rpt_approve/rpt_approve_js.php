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
		// console.log(campaign);
		// console.log(start_date);
		// console.log(end_date);
		// console.log(mode);

	
		if(start_date == "" || end_date == "") {
			alert('Set Interval, Please!');
		}  else {
			Ext.Window
			({
				url 	: Ext.DOM.INDEX +'/Approve/ShowReport',
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
		} else {
			Ext.Window
			({
				url 	: Ext.DOM.INDEX +'/Approve/ShowExcel',
				param 	: {
					campaign_id : Ext.Cmp('campaign_id').getValue(),
					start_date : Ext.Cmp('start_date').getValue(),
					end_date : Ext.Cmp('end_date').getValue(),
					mode : Ext.Cmp('mode').getValue()
				}
			}).newtab();	
		}
	}

	Ext.DOM.CheckAll = function() {
		if($("#check_all").attr("checked")) {
			$(".field_checkbox").attr("checked", true)
		} else {
			$(".field_checkbox").attr("checked", false)
		}
	}
</script>
<style> .ui-widget-display-none { display:none; } .ui-widget-display-yes { display:yes; } </style>
<fieldset class="corner ui-widget-fieldset" style="width:auto;margin:5px; border-radius:5px;">
<?php echo form()->legend(lang(array("Filter","Of", "Report")),"fa-file-text-o");?>
	<form name="frmReport">
		<div class="ui-widget-form-table-compact">
			<div class="ui-widget-form-row">
				<div class="ui-widget-form-cell text_caption">Supervisor</div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell" id="filter-data-campaign"><?php echo form()->combo('supervisor','select auto x-select', $Supervisor );?></div>
			</div>

			<div id="ui-widget-row5" class="ui-widget-form-row">
				<div class="ui-widget-form-cell text_caption" id="ui-widget-label-row5">Interval</div>
				<div class="ui-widget-form-cell text_caption center" id="ui-widget-separator-row5">:</div>
				<div class="ui-widget-form-cell" id="ui-widget-content-row5"> <?php echo form()->input('start_date','input_text box date');?> &nbsp- <?php echo form()->input('end_date','input_text box date');?></div>
			</div>

			<div id="ui-widget-row7" class="ui-widget-form-row">
				<div class="ui-widget-form-cell text_caption" id="ui-widget-label-row7"></div>
				<div class="ui-widget-form-cell text_caption center" id="ui-widget-separator-row7"></div>
				<div class="ui-widget-form-cell" id="ui-widget-content-row7"> 
					<?php echo form()->button('buttonshow','page-go button','Show',array("click"=>"new ShowReport();"));?>
					<?php echo form()->button('buttonhtml','excel button','Export',array("click"=>"new ShowExcel();"));?>
				</div>
			</div>
		</div>
	</form>
</fieldset>

<script>

	$('.date').datepicker ({ 
		dateFormat : 'yy-mm-dd', readonly:true, changeYear:true, changeMonth:true 
	});
	
	Ext.DOM.ShowReport = function()
	{
		// var supervisor	= Ext.Cmp('supervisor').getValue();
		var start_date	= Ext.Cmp('start_date').getValue();
		var end_date	= Ext.Cmp('end_date').getValue();
		
		if(start_date == "" || end_date == "") {
			alert('Set Interval, Please!');
		} else {
			Ext.Window
			({
				url 	: Ext.DOM.INDEX +'/RptAgentActivity/ShowReport',
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
				url 	: Ext.DOM.INDEX +'/RptAgentActivity/ShowExcel',
				param 	: {
					supervisor : Ext.Cmp('supervisor').getValue(),
					start_date : Ext.Cmp('start_date').getValue(),
					end_date : Ext.Cmp('end_date').getValue()
				}
			}).newtab();	
		}
	}

</script>
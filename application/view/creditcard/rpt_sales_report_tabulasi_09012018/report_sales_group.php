<style> .ui-widget-display-none { display:none; } .ui-widget-display-yes { display:yes; } </style>
<fieldset class="corner ui-widget-fieldset" style="width:auto;margin:5px; border-radius:5px;">
<?php echo form()->legend(lang(array("Filter","Of", "Report")),"fa-file-text-o");?>

 <form name="frmReport">
	<div class="ui-widget-form-table-compact">
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption">Campaign</div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo('campaign_id','select auto', CampaignId() ,null, array("change" => "ShowFilterReport(this);"));?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption">Supervisor</div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo('supervisor_id','select auto', $Supervisor );?></div>
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
				<?php echo form()->button('','page-go button','Show',array("click"=>"new ShowReport();"));?>
				<?php echo form()->button('','excel button','Export',array("click"=>"new ShowExcel();"));?>
			</div>
		</div>
		
		
		
	</div>
</form>

</fieldset>

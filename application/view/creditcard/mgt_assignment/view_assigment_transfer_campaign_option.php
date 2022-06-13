<?php get_view(array("mgt_assignment","view_assigment_transfer_campaign_filter"));?>
<fieldset class="corner ui-fieldset-transfer-campaign-bottom" style="width:auto;margin:5px; border-radius:5px;">
<?php echo form()->legend(lang(array("Option","Transfer Campaign")),"fa-gear");?>
	<form name="frmTransferCampaignOption">
	<div class="ui-widget-form-table-compact">
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Transfer Campaign. Action");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->ListCheckbox("transfer_campaign_user_action", DistribusiAction(), null, array("change" =>"Ext.Cmp('transfer_campaign_user_action').oneChecked(this);ActionCheckTransferCampaign(this);")); ?></div>
		</div>
		
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Total Data");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->input("transfer_campaign_user_total", "input_text tolong");?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Data To Transfer");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->input("transfer_campaign_user_quantity", "input_text tolong");?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Campaign New");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo("transfer_campaign_new_campaign", "select xselect tolong", CampaignId(), null);?></div>
		</div>

		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"></div>
			<div class="ui-widget-form-cell text_caption"></div>
			<div class="ui-widget-form-cell">
				<?php echo form()->button("BtnTransferCampaignData", "button assign",lang("Submit"), array("click" => "Ext.DOM.SubmitTransferCampaign();"));?></div>
		</div>
	</div>
	</form>
</fieldset>
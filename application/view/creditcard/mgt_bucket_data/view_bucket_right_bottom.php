<div class="ui-widget-form-table-compact">
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Assg. Action");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->ListCheckbox("frm_bucket_user_action", DistribusiAction(), null, array("change" =>"Ext.Cmp('frm_bucket_user_action').oneChecked(this);window.EventOnBucket('BucketId', this);")); ?></div>
		</div>
		
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array("Assg.","Total","Data"));?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->input("frm_bucket_user_total", "input_text tolong readonly");?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array("Assg.","Quantity"));?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->input("frm_bucket_user_quantity", "input_text tolong");?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Assg. To Campaign");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo("frm_bucket_user_campaign", "select xzselect tolong", CampaignId(), null, array("change" => "Ext.DOM.SelectUserTransToByGroup(this);"));?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"></div>
			<div class="ui-widget-form-cell text_caption"></div>
			<div class="ui-widget-form-cell">
				<?php echo form()->button_role("_SUB_TOOL_", $Button);?>
				<?php echo form()->button_role("_CLS_TOOL_", $Button);?>
			</div>
		</div>
</div>

<!--
<div id="toolbars" class="ui-widget-toolbars"></div>
-->

<?php  //debug($Detail); ?>
<div class="contact_detail" style="margin-left:-8px;">

<?php echo form()->hidden('ControllerId',NULL,_get_post("ControllerId"));?>
<?php echo form()->hidden('ProductId',NULL, $Detail->get_value('DM_ProductId') );?>
<?php echo form()->hidden('ProductName',NULL, $Detail->get_value('DM_ProductId','ProductCodeById') );?>
<?php echo form()->hidden('CampaignId',NULL, $Detail->get_value('DM_CampaignId') );?>
<?php echo form()->hidden('CampaignName',NULL, $Detail->get_value('DM_CampaignName') );?>
	
	<!-- start : detail -->
	<div class="ui-widget-form-table-compact" style="width:99%;">
		<div class="ui-widget-form-row" style="vertical-align:top;">
			<div class="ui-widget-form-cell" style="vertical-align:top;width:70%">
				<?php get_view(array('mod_contact_detail_auto_dial','view_contact_default_detail'));?>
				<?php get_view(array('mod_contact_detail_auto_dial','view_contact_history_detail'));?>
			</div>
			
			<div class="ui-widget-form-cell" style="vertical-align:top;width:30%;">
				<?php get_view(array('mod_contact_detail_auto_dial','view_contact_phone_detail'));?>
			</div>
		</div>
	</div>
</div>
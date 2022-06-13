<div id="toolbars" class="ui-widget-toolbars"></div>
<div class="contact_detail" style="margin-left:-8px;">

<?php echo form()->hidden('ControllerId',NULL,_get_post("ControllerId"));?>
<?php echo form()->hidden('CampaignId',NULL, $Detail->get_value('CampaignId') );?>
	
	<!-- start : detail -->
	<div class="ui-widget-form-table-compact" style="width:99%;">
		<div class="ui-widget-form-row" style="vertical-align:top;">
			
			<div class="ui-widget-form-cell" style="width:70%">
				<?php get_view(array('mod_contact_detail','view_contact_default_detail'));?>
				<?php get_view(array('mod_contact_detail','view_contact_history_detail'));?>
			</div>
			
			<div class="ui-widget-form-cell" style="vertical-align:top;width:28%;">
				<?php get_view(array('mod_contact_detail','view_contact_phone_detail'));?>
			</div>
		</div>
	</div>
</div>
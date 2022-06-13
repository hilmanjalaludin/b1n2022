<fieldset class="corner ui-widget-fieldset" style="padding:2px 5px 20px 5px;">
<?php echo form()->legend(lang("Add"), $panel->field('icon'));?>
<form name="frmAddCampaignPerUser">
	<div class="ui-widget-form-table">
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang('CPU_UserGroup');?></div>
			<div class="ui-widget-form-cell center">:</div>
			<div class="ui-widget-form-cell left"><?php echo form()->combo('CPU_UserGroup', 'select superlong', UserSessionPrivilege(), null, array('change' => 'window.EventPerUser(this);') );?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang('CPU_UserId');?></div>
			<div class="ui-widget-form-cell center">:</div>
			<div class="ui-widget-form-cell left" id="ui-html-user-kuota"><?php echo form()->combo('CPU_UserId', 'select superlong', AllUserIdByLevelLogin(), null);?></div>
		</div>
		
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang('CPU_CampaignId');?></div>
			<div class="ui-widget-form-cell center">:</div>
			<div class="ui-widget-form-cell left" ><?php echo form() -> listCombo('CPU_CampaignId', 'textarea superlong',CampaignId(), null, null, array('dwidth' => '95%' ) ); ?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang('CPU_Flags');?></div>
			<div class="ui-widget-form-cell center">:</div>
			<div class="ui-widget-form-cell left"><?php echo form()->combo('CPU_Flags', 'select superlong', Flags());?></div>
		</div>
		
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"> </div>
			<div class="ui-widget-form-cell center"></div>
			<div class="ui-widget-form-cell left">
				<?php echo form()->button_role('_SAV_TOOL_', $button);?>
				<?php echo form()->button_role('_CLS_TOOL_', $button);?>
			</div>
		</div> 
		
		
	</div>
	
</form>
</fieldset>
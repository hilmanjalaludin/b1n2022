<fieldset class="corner ui-widget-fieldset" style="padding:2px 5px 20px 5px;">
<?php echo form()->legend(lang("Add"), $panel->field('icon'));?>
<form name="frmAddCalldisposition">
	<div class="ui-widget-form-table">
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang('DS_CallUserGroup');?></div>
			<div class="ui-widget-form-cell center">:</div>
			<div class="ui-widget-form-cell left"><?php echo form()->combo('DS_CallUserGroup', 'select superlong', Call(UserPrivilege(),'SetCapital'), null );?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang('DS_CallCategoryKode');?></div>
			<div class="ui-widget-form-cell center">:</div>
			<div class="ui-widget-form-cell left" ><?php echo form()->combo('DS_CallCategoryId', 'select superlong', AllCallStatus());?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang('DS_CallUserSorter');?></div>
			<div class="ui-widget-form-cell center">:</div>
			<div class="ui-widget-form-cell left"><?php echo form()->combo('DS_CallUserSorter', 'select superlong', Order());?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang('DS_CallUserEditor');?></div>
			<div class="ui-widget-form-cell center">:</div>
			<div class="ui-widget-form-cell left"><?php echo form()->input('DS_CallUserEditor', 'input_text superlong ui-disabled', CK()->field('Username','SetCapital'));?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang('DS_CallUserUpdateTs');?></div>
			<div class="ui-widget-form-cell center">:</div>
			<div class="ui-widget-form-cell left"><?php echo form()->input('DS_CallUserUpdateTs', 'input_text superlong ui-disabled', date('Y-m-d H:i:s'));?></div>
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
<fieldset class="corner ui-widget-fieldset" style="padding:2px 5px 20px 5px;">
<?php echo form()->legend(lang("Edit"), $panel->field('icon'));?>
<form name="frmEditCalldisposition">
	<?php echo form()->hidden('DS_CallId', null, $detail->field('DS_CallId'));?>
	<div class="ui-widget-form-table">
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang('DS_CallUserGroup');?></div>
			<div class="ui-widget-form-cell center">:</div>
			<div class="ui-widget-form-cell left"><?php echo form()->combo('DS_CallUserGroup', 'select superlong', Call(UserPrivilege(),'SetCapital'), $detail->field('DS_CallUserGroup') );?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang('DS_CallCategoryKode');?></div>
			<div class="ui-widget-form-cell center">:</div>
			<div class="ui-widget-form-cell left" ><?php echo form()->combo('DS_CallCategoryId', 'select superlong', AllCallStatus(), $detail->field('DS_CallCategoryId') );?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang('DS_CallUserSorter');?></div>
			<div class="ui-widget-form-cell center">:</div>
			<div class="ui-widget-form-cell left"><?php echo form()->combo('DS_CallUserSorter', 'select superlong', Order(), $detail->field('DS_CallUserSorter') );?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang('DS_CallUserEditor');?></div>
			<div class="ui-widget-form-cell center">:</div>
			<div class="ui-widget-form-cell left"><?php echo form()->input('DS_CallUserEditor', 'input_text superlong ui-disabled', $detail->field('DS_CallUserEditor',array('AllUser','SetCaptionKode','SetCapital') ));?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang('DS_CallUserUpdateTs');?></div>
			<div class="ui-widget-form-cell center">:</div>
			<div class="ui-widget-form-cell left"><?php echo form()->input('DS_CallUserUpdateTs', 'input_text superlong ui-disabled', $detail->field('DS_CallUserUpdateTs') );?></div>
		</div>
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"> </div>
			<div class="ui-widget-form-cell center"></div>
			<div class="ui-widget-form-cell left">
				<?php echo form()->button_role('_UPD_TOOL_', $button);?>
				<?php echo form()->button_role('_CLS_TOOL_', $button);?>
			</div>
		</div>
		
	</div>
	
</form>
</fieldset>
<fieldset class="corner" style="margin:10px 0px 0px -20px;padding:5px;"> 
<?php echo form()->legend(lang('User Activity'), "fa-pencil"); ?>
<form name="frmApprovalUser">
<?php echo form()->hidden('ApproveItemId', null, $Items->field("ApprovalHistoryId"));?>
<?php echo form()->hidden('CustomerId', null, $Items->field('CustomerId'));?>

<div class="ui-widget-form-table-compact" style="margin-top:-2px;">
	<div class="ui-widget-form-row">
		<div class="ui-widget-form-cell text_caption"><?php echo lang('DM_ContactReqByUser');?></div>
		<div class="ui-widget-form-cell">:</div>
		<div class="ui-widget-form-cell"><?php echo form()->input('req_ts_agent','input_text tolong ui-customize-data ui-disabled',$Items->field('full_name','_setCapital'));?></div>
	</div>
	
	<div class="ui-widget-form-row">
		<div class="ui-widget-form-cell text_caption"><?php echo lang('DM_ContactCreateTs');?></div>
		<div class="ui-widget-form-cell">:</div>
		<div class="ui-widget-form-cell"><?php echo form()->input('req_ts_dates','input_text tolong ui-customize-data ui-disabled',$Items->field('ApprovalCreatedTs','_getDateTime'));?></div>
	</div>
	<div class="ui-widget-form-row">
		<div class="ui-widget-form-cell text_caption"><?php echo lang('DM_ContactType');?></div>
		<div class="ui-widget-form-cell">:</div>
		<div class="ui-widget-form-cell" ><?php echo form()->input('req_ts_type','input_text tolong ui-customize-data ui-disabled',$Items->field('ApprovePhoneType','PhoneType'));?></div>
	</div>
	
	<div class="ui-widget-form-row">
		<div class="ui-widget-form-cell text_caption"><?php echo lang('DM_ContactNumber');?></div>
		<div class="ui-widget-form-cell">:</div>
		<div class="ui-widget-form-cell" ><?php echo form()->input('req_ts_phone','input_text tolong ui-customize-data ui-disabled',$Items->field('ApprovalOldValue'));?></div>
	</div>
	
	<div class="ui-widget-form-row">
		<div class="ui-widget-form-cell text_caption"><?php echo lang('DM_ContactStatus');?></div>
		<div class="ui-widget-form-cell">:</div>
		<div class="ui-widget-form-cell"><?php echo form()->combo('ApprovalStatus','select tolong ui-customize-data', 
			AddContactStatus(),  $Items->field('ApprovalApprovedFlag'));?></div>
	</div>
	
	<div class="ui-widget-form-row">
		<div class="ui-widget-form-cell text_caption"><?php echo lang('DM_ContactNotes');?></div>
		<div class="ui-widget-form-cell">:</div>
		<div class="ui-widget-form-cell" ><?php echo form()->textarea('ContactRemarks','textarea',null);?></div>
	</div>
	
	<div class="ui-widget-form-row">
		<div class="ui-widget-form-cell text_caption"></div>
		<div class="ui-widget-form-cell"></div>
		<div class="ui-widget-form-cell">
		<?php echo form()->button_role('_SUB_TOOL_', $Button);?>  
		<?php echo form()->button_role('_CLS_TOOL_', $Button);?>  
		</div>
	</div>
	
</div>	
</form>
</fieldset>	
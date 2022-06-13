<?php get_view(array("src_mod_apps","view_application_header"));?>

<div class="page-wrapper">
<fieldset class="corner" style="margin-top:5px;border-radius:0px;padding:5px 0px 10px 0px;">
<?php echo form()->legend(lang(array('User Activity')), "fa-users"); ?>
		<form name="frmUserApproval">
		<?php echo form()->hidden('CustomerId', null, $CustomerId);?>
		<div class="ui-widget-form-table-compact" style="width:99%;">
			<div class="ui-widget-form-row baris1">
				<div class="ui-widget-form-cell text_caption ui-row-col1"><?php echo lang("LB_CallReasonCategoryName");?></div>
				<div class="ui-widget-form-cell center ui-row-col2">:</div>
				<div class="ui-widget-form-cell ui-row-col3"><?php echo form()->combo('CallStatusId','select tolong select-chosen', CallStatusDisposition(), null,array('change'=>"window.EventCallResultID(this);")); ?></div>
			</div>
			
			<div class="ui-widget-form-row baris1">
				<div class="ui-widget-form-cell text_caption ui-row-col1"><?php echo lang("LB_CallReasonName");?></div>
				<div class="ui-widget-form-cell center ui-row-col2">:</div>
				<div class="ui-widget-form-cell ui-row-col3" id="ui-call-result-id">
				<?php echo form()->combo('CallResultId','select tolong select-chosen ',CallResultByCategory(), null ); ?> </div>
			</div>
			
			<div class="ui-widget-form-row baris1">
				<div class="ui-widget-form-cell text_caption ui-row-col1"><?php echo lang("Note");?></div>
				<div class="ui-widget-form-cell center ui-row-col2">:</div>
				<div class="ui-widget-form-cell ui-row-col3"><?php echo form()->textarea("CallRemarks", "textarea tolong uppercase", null, null );?></div>
			</div>
			
			<div class="ui-widget-form-row baris1">
				<div class="ui-widget-form-cell text_caption ui-row-col1"></div>
				<div class="ui-widget-form-cell center ui-row-col2"></div>
				<div class="ui-widget-form-cell ui-row-col3">
						<?php echo form()->button_role('_SUB_TOOL_',$Button);?>
						<?php echo form()->button_role('_CLS_TOOL_',$Button);?>
				</div>
			</div>	
		  </div>
		</form>
		
	</fieldset>
</div>

<?php get_view(array("src_mod_apps","view_application_footer"));?>
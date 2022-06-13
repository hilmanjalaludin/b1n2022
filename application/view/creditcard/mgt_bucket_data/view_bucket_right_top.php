<div class="ui-widget-form-table" style="margin-top:-5px;">
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Upload Date");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"> 
				<?php echo form()->input("frm_bucket_start_date", "input_text date");?> 
				<?php echo lang("to"); ?> 
				<?php echo form()->input("frm_bucket_end_date", "input_text date");?></div>
		</div>	
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array("File","Name"));?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo("frm_bucket_fileupload", "select tolong", FileUpload(), null, null, array('multiple' => true) );?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Recsource Name");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo("frm_bucket_recsource", "select tolong",Recsource(), null, null, array('multiple' => true) );?></div>
		</div>
		
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Assign Status");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell" ><?php echo form()->combo("frm_bucket_status", "select  xzselect tolong",array('N' => 'NO','Y' => 'YES'));?></div>
		</div>	
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Record/Page");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->input("frm_bucket_record", "input_text tolong", 20);?></div>
		</div>
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"></div>
			<div class="ui-widget-form-cell text_caption"></div>
			<div class="ui-widget-form-cell">
				<?php echo form()->button_role("_SRC_TOOL_", $Button);?>
				<?php echo form()->button_role("_CLR_TOOL_", $Button);?>
			</div>
			
		</div> 
</div>
<fieldset class="corner ui-fieldset-cv-bot" style="width:auto;padding: 4px 4px 2px 4px;margin:15px -5px 5px 0px;">
<?php echo form()->legend(lang("Edit"),"fa-gear");?>
	<form name="frmCvOption" id="frmCvOption">
	<div class="ui-widget-form-table-compact">
		<input type="hidden" name="cv_dataid" id="cv_dataid" />
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("CustId Old");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell">
				<input type="text" name="custid_old_cv" id="custid_old_cv" class="input_text tolong" disabled />		
			</div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("CustId New");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->input("custid_new_cv", "input_text tolong");?></div>
		</div>

		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Campagin Old");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell">
				<input type="text" name="campaign_old_cv" id="campaign_old_cv" class="input_text tolong" disabled />			
			</div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Campagin New");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->input("campaign_new_cv", "input_text tolong");?></div>
		</div>
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"></div>
			<div class="ui-widget-form-cell text_caption"></div>
			<div class="ui-widget-form-cell">
				<?php 
					echo form()->button("BtnCvData", "button assign",lang("Submit"), array("click" => "Ext.DOM.UpdateCv();"));
					echo form()->button("BtnCvCancel", "button cancel",lang("Cancel"), array("click" => "Ext.DOM.CancelCv();"));
				?>
			</div>
		</div>
	</div>
	</form>
</fieldset>
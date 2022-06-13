<fieldset class="corner" style="margin-top:-3px;border-radius:5px;padding:5px 0px 10px 0px;">
<?php echo form()->legend(lang(array('Call Activity')), "fa-phone"); ?>
<div style="overflow:auto;margin-top:3px;" class="ui-widget-form-table-compact">
 <?php echo form()->hidden("CallingNumber",NULL, $Detail->get_value('CustomerMobilePhoneNum')); ?>
	<form name="frmActivityCall">
	<?php echo form()->hidden('QualityStatus',NULL,$Detail->get_value('CallReasonQue') );?>
	
	<div class="ui-widget-form-table-compact">
		<div class="ui-widget-form-row baris1">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Phone Number");?></div>
			<div class="ui-widget-form-cell center">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo('PhoneNumber','select tolong select-chosen', CustomerContactPhone($Detail->get_value('CustomerId')), $Detail->get_value('CustomerMobilePhoneNum'),array("change" =>"Ext.Cmp('CallingNumber').setValue(this.value);") ); ?></div>
		</div>
		
		<div class="ui-widget-form-row baris1">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Add Phone");?></div>
			<div class="ui-widget-form-cell center">:</div>
			
			<div class="ui-widget-form-cell">
				<span id="ui-add-phone-list"><?php echo form()->combo('AddPhoneNumber','select tolong select-chosen',CustomerAdditionalPhone($Detail->get_value('CustomerId')), null, array("change" =>"Ext.Cmp('CallingNumber').setValue(this.value);")); ?></span>
				<span class="ui-widget-refresh-active" onclick="window.EventRefreshPhone();" title="Refresh aditional phone">&nbsp;&nbsp;&nbsp;</span>
			</div>
		</div>
		
		<div class="ui-widget-form-row baris1">
			<div class="ui-widget-form-cell text_caption"></div>
			<div class="ui-widget-form-cell center"></div>
			<div class="ui-widget-form-cell left">
				<?php echo form()->button_role('_CAL_TOOL_',$Button);?>
				<?php echo form()->button_role('_HAG_TOOL_',$Button);?>
			</div>
		</div>
		
		<div class="ui-widget-form-row baris1">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Call Category");?></div>
			<div class="ui-widget-form-cell center">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo('CallStatus','select tolong select-chosen ui-disabled', OutboundCategory(),$Detail->get_value('CallReasonCategoryId'),array('change'=>"getCallReasultId(this);")); ?></div>
		</div>
		
		<div class="ui-widget-form-row baris1">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Call Status");?></div>
			<div class="ui-widget-form-cell center">:</div>
			<div class="ui-widget-form-cell" id="DivCallResultId"><?php echo form()->combo('CallResult','select tolong select-chosen ui-disabled',CallResultByCategory($Detail->get_value('CallReasonCategoryId')), $Detail->get_value('CallReasonId'),array('change'=>'getEventSale(this);')); ?> </div>
		</div>
		
		<div class="ui-widget-form-row baris1">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Call Later");?></div>
			<div class="ui-widget-form-cell center">:</div>
			<div class="ui-widget-form-cell">
				<?php echo form()->input('date_call_later','input_text box date ui-disabled'); ?>&nbsp;
				<?php echo form()->combo('hour_call_later','select boox select-chosen ui-disabled',ListHour(), '00', null,array('style'=>'width:52px;margin-top:2px;')); ?> :
				<?php echo form()->combo('minute_call_later','select boox select-chosen ui-disabled',ListMinute(),'00', null, array('style'=>'width:52px;margin-top:2px;'));?>
			</div>
		</div>
		
		<div class="ui-widget-form-row baris1">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Product");?></div>
			<div class="ui-widget-form-cell center">:</div>
			<div class="ui-widget-form-cell"> <?php echo form()->combo('ProductForm','select tolong select-chosen',CustomerProductId($Detail->get_value('CustomerId')), $Detail->get_value('ProductId'), array('change'=>'Ext.DOM.EeventFromProduct(this);'),array('disabled' => true));?></div>
		</div>
		
		<div class="ui-widget-form-row baris1">
			<div class="ui-widget-form-cell text_caption"></div>
			<div class="ui-widget-form-cell center">&nbsp;</div>
			<div class="ui-widget-form-cell">
			<?php echo form()->writepod("frm_create_pod", NULL, $Detail->get_value('CustomerId'), array("change" => "window.EventCreatePod(this);"), $Detail);?>
				<span style="margin-left:-5px;"><?php echo lang("Create POD");?></span>
				&nbsp;
			<?php echo form()->writepod("frm_edit_form", NULL, $Detail->get_value('ProductId'), array("change" => "window.EventEditForm(this);"), $Detail);?>
				<span style="margin-left:-5px;"><?php echo lang("Edit Form");?></span>
			</div>
		</div>
		
		<div class="ui-widget-form-row baris1">
			<div class="ui-widget-form-cell text_caption"></div>
			<div class="ui-widget-form-cell center">&nbsp;</div>
			<div class="ui-widget-form-cell"><?php echo form()->button_role('_RTY_TOOL_',$Button);?></div>
		</div>
		
		<div class="ui-widget-form-row baris1">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Note");?></div>
			<div class="ui-widget-form-cell center">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->textarea("call_remarks", "textarea tolong uppercase", null, null, array('style'=> 'height:120px;'));?></div>
		</div>
		
		<div class="ui-widget-form-row baris1">
			<div class="ui-widget-form-cell text_caption"></div>
			<div class="ui-widget-form-cell center"></div>
			<div class="ui-widget-form-cell">
				<?php echo form()->button_role('_SAV_TOOL_',$Button);?>
				<?php echo form()->button_role('_CLS_TOOL_',$Button);?>
			</div>
		</div>
		
	 </div>
	
	</form>
	</div>	
</fieldset>	
<?php

 if( !function_exists('SetAgentDisabled') ) {
  function SetAgentDisabled() 
 {
	$arr_class = "";
	if( in_array(_get_session('HandlingType'),  
	array(USER_AGENT_OUTBOUND, USER_AGENT_INBOUND))){
	   $arr_class = "agent_disabled";
	}
	return $arr_class;
  }
}

 $arr_class = "";
 $arr_class = SetAgentDisabled();
?>
<fieldset class="corner" style="margin-top:-3px;border-radius:5px;padding:5px 0px 10px 0px;">
<?php echo form()->legend(lang(array('Call Activity')), "fa-phone"); ?>
<div style="overflow:auto;margin-top:3px;" class="ui-widget-form-table-compact">
 <?php echo form()->hidden("CallingNumber",NULL, $Attrs->get_value('CallNumber', 'intval')); ?>
	<form name="frmActivityCall">
	<div class="ui-widget-form-table-compact">
		<div class="ui-widget-form-row baris1">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Phone Number");?></div>
			<div class="ui-widget-form-cell center">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo('PhoneNumber',"select tolong select-chosen ui-disabled", CustomerContactPhone($Detail->get_value('CustomerId')), $Attrs->get_value('CallNumber', 'intval'),array("change" =>"Ext.Cmp('CallingNumber').setValue(this.value);") ); ?></div>
		</div>
		
		<div class="ui-widget-form-row baris1">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Add Phone");?></div>
			<div class="ui-widget-form-cell center">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo('AddPhoneNumber','select tolong select-chosen ui-disabled',CustomerAdditionalPhone($Detail->get_value('CustomerId')), $Attrs->get_value('CallNumber', 'intval'), array("change" =>"Ext.Cmp('CallingNumber').setValue(this.value);")); ?></div>
		</div>
		
		
		<?php if( $Button->find_value('_CAL_TOOL_') ) : ?>
		<div class="ui-widget-form-row baris1">
			<div class="ui-widget-form-cell text_caption"></div>
			<div class="ui-widget-form-cell center"></div>
			<div class="ui-widget-form-cell left">
				<?php echo form()->button_role('_CAL_TOOL_',$Button);?>
				<?php echo form()->button_role('_HAG_TOOL_',$Button);?>
			</div>
		</div>
		<?php endif; ?>
			
			
		<div class="ui-widget-form-row baris1">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Call Category");?></div>
			<div class="ui-widget-form-cell center">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo('CallStatus','select tolong select-chosen ui-disabled', OutboundCategory(),$Detail->get_value('CallReasonCategoryId'),array('change'=>"getCallReasultId(this);")); ?></div>
		</div>
			
		<div class="ui-widget-form-row baris1">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Call Status");?></div>
			<div class="ui-widget-form-cell center">:</div>
			<div class="ui-widget-form-cell" id="DivCallResultId"><?php echo form()->combo('CallResult',sprintf( "select tolong select-chosen %s", $Class->get_value('attr')),EventUserStatusCall(_get_session('HandlingType'), $Detail), $Detail->get_value('CallReasonId'),array('change'=>'getEventSale(this);')); ?> </div>
		</div>
		
		<div class="ui-widget-form-row baris1">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Call Later");?></div>
			<div class="ui-widget-form-cell center">:</div>
			<div class="ui-widget-form-cell">
				<?php echo form()->input('date_call_later',"input_text box date {$arr_class} ui-disabled"); ?>&nbsp;
				<?php echo form()->combo('hour_call_later',"select boox select-chosen {$arr_class} ui-disabled",ListHour(), '00', null,array('style'=>'width:52px;margin-top:2px;')); ?> :
				<?php echo form()->combo('minute_call_later',"select boox select-chosen {$arr_class} ui-disabled",ListMinute(),'00', null, array('style'=>'width:52px;margin-top:2px;'));?>
			</div>
		</div>

		<div class="ui-widget-form-row baris1">
		
		
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Product");?></div>
			<div class="ui-widget-form-cell center">:</div>
			<div class="ui-widget-form-cell"> <?php echo form()->combo('ProductForm',"select tolong select-chosen ui-disabled",CustomerProductId($Detail->get_value('CustomerId')), $Detail->get_value('ProductId'));?></div>
		</div>
	
		<div class="ui-widget-form-row baris1">
			<div class="ui-widget-form-cell text_caption"> </div>
			<div class="ui-widget-form-cell center"> </div>
			<div class="ui-widget-form-cell"> 
				<?php echo form()->checkbox("edit_policy_box", sprintf( "%s", '' ), $Attrs->get_value('ProductId', 'intval'), array('change'=>'Ext.DOM.EeventFromProduct(this);') );?> 
				<span class="" style="font-family:Trebuchet MS;color:#223777;font-size:12px;">Show Form</span>
			</div>
		</div>
		
		<div class="ui-widget-form-row baris1">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Note");?></div>
			<div class="ui-widget-form-cell center">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->textarea("call_remarks", sprintf( "textarea tolong uppercase %s", $Class->get_value('attr') ), null, null, array('style'=> 'height:120px;'));?></div>
		</div>
		
		<div class="ui-widget-form-row baris1">
			<div class="ui-widget-form-cell text_caption"></div>
			<div class="ui-widget-form-cell center"></div>
			
			<div class="ui-widget-form-cell <?php echo sprintf("%s", $Class->get_value('attr')) ?>">
				<?php echo form()->button_role('_SUB_TOOL_',$Button);?>
				<?php echo form()->button_role('_CLS_TOOL_',$Button);?>
			</div>
		</div>
		
	 </div>
	
	</form>
	</div>	
</fieldset>	
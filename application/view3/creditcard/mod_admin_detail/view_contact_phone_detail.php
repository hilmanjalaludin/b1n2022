<fieldset class="corner" style="margin-top:-5px;border-radius:0px;padding:5px 0px 10px 0px;">

<?php echo form()->legend(lang(array('User Activity')), "fa-users"); ?>
<div style="overflow:auto;margin-top:-5px;" class="ui-widget-form-table-compact">
 <?php echo form()->hidden("CallingNumber",NULL, $Detail->get_value('CustomerMobilePhoneNum')); ?>
	<form name="frmActivityCall">
	<?php echo form()->hidden('QualityStatus',NULL,$Detail->get_value('CallReasonQue') );?>
	
	<div class="ui-widget-form-table-compact">
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption ui-row-col1"><?php echo lang("LB_CallNumber");?></div>
			<div class="ui-widget-form-cell center ui-row-col2">:</div>
			<div class="ui-widget-form-cell ui-row-col3">
			<?php echo form()->combo('PhoneNumber','select tolong select-chosen disallowed', 
									$Detail->field('DM_Id', array('CustomerContactPhone')), 
									$Detail->field('DM_Id', array('CustomerContactLasted','base64_encode')), 
									array("change" =>"Ext.Cmp('CallingNumber').setValue(Ext.BASE64.decode(this.value));") ); ?>
			</div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption ui-row-col1"><?php echo lang("LB_AddCallNumber");?></div>
			<div class="ui-widget-form-cell center ui-row-col2">:</div>
			<div class="ui-widget-form-cell ui-row-col3">
				<span id="ui-add-phone-list">
					<?php echo form()->combo('AddPhoneNumber','select tolong select-chosen disallowed',
											 $Detail->field('DM_Id', array('CustomerAdditionalPhone')), 
											 $Detail->field('DM_Id', array('CustomerContactLasted','base64_encode')),
											 array("change" =>"Ext.Cmp('CallingNumber').setValue(Ext.BASE64.decode(this.value));")); ?>
				</span>
				<span class="ui-widget-refresh-active" title='Refresh Data' onclick="window.EventRefreshPhone();" title="Refresh aditional phone">&nbsp;&nbsp;&nbsp;</span>
			</div>
		</div>
		
		<div class="ui-widget-form-row baris1">
			<div class="ui-widget-form-cell text_caption ui-row-col1"></div>
			<div class="ui-widget-form-cell center ui-row-col2"></div>
			<div class="ui-widget-form-cell left ui-row-col3">
				<?php echo form()->button_role('_CAL_TOOL_', $Button, null, 'disallowed');?>
				<?php echo form()->button_role('_HAG_TOOL_', $Button, null, 'disallowed');?>
				<?php echo form()->button_role('_ADD_TOOL_', $Button, null, 'disallowed');?>
			</div>
		</div>
		
		
		<div class="ui-widget-form-row baris1">
			<div class="ui-widget-form-cell text_caption ui-row-col1"></div>
			<div class="ui-widget-form-cell center ui-row-col2"></div>
			<div class="ui-widget-form-cell ui-row-col1"></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption ui-row-col1"><?php echo lang("LB_ProdukScript");?></div>
			<div class="ui-widget-form-cell center ui-row-col2">:</div>
			<div class="ui-widget-form-cell ui-row-col3"><?php echo form()->combo('CallProdukScript','select tolong select-chosen', $Detail->field('DM_ProductId', 'ProductScript'), null, array('change' => 'window.EventScript(this);')); ?></div>
		</div>	
		
	</div>
	</form>
</fieldset>
	
<!-- form activity account -->
		
 <fieldset class="corner" style="margin-top:20px;border-radius:0px;padding:22px 0px 10px 0px;">
	<form name="frmActivityData">
	<div style="overflow:auto;margin-top:-5px;" class="ui-widget-form-table-compact">		
		<div class="ui-widget-form-row baris1">
			<div class="ui-widget-form-cell text_caption ui-row-col1"><?php echo lang("LB_CallReasonCategoryName");?></div>
			<div class="ui-widget-form-cell center ui-row-col2">:</div>
			<div class="ui-widget-form-cell ui-row-col3"><?php echo form()->combo('CallStatusId','select tolong select-chosen', 
				CallStatusDisposition(), $Detail->field('DM_AdmCategoryId'),array('change'=>"window.EventCallResultID(this);")); ?></div>
		</div>
		
		<div class="ui-widget-form-row baris1">
			<div class="ui-widget-form-cell text_caption ui-row-col1"><?php echo lang("LB_CallReasonName");?></div>
			<div class="ui-widget-form-cell center ui-row-col2">:</div>
			<div class="ui-widget-form-cell ui-row-col3" id="ui-call-result-id">
			<?php echo form()->combo('CallResultId','select tolong select-chosen', 
				CallResultByCategory( $Detail->field('DM_AdmCategoryId')), $Detail->field('DM_AdmReasonId'),array('change'=>'getEventSale(this);')); ?> </div>
		</div>

		<div class="ui-widget-form-row" style="display: none;" id="marlin">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Doc. Submitted");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"> 

				<input type='checkbox' name="SV_DocSubmit1" id="SV_DocSubmit1" value="Y">KK
			    <input type='checkbox' name="SV_DocSubmit2" id="SV_DocSubmit2" value="Y">Slip Gaji
			    <input type='checkbox' name="SV_DocSubmit3" id="SV_DocSubmit3" value="Y">SIUP
			    <input type='checkbox' name="SV_DocSubmit4" id="SV_DocSubmit4" value="Y">Rekening Tabungan
			</div>
		</div>

		<div class="ui-widget-form-row baris1">
			<div class="ui-widget-form-cell text_caption ui-row-col1"><?php echo lang("LB_CallLater");?></div>
			<div class="ui-widget-form-cell center ui-row-col2">:</div>
			<div class="ui-widget-form-cell ui-row-col3">
				<?php echo form()->input('DateLater','input_text box date disallowed'); ?>&nbsp;
				<?php echo form()->combo('HourLater','select boox select-chosen disallowed',ListHour(), '00', null,array('style'=>'margin-top:2px;')); ?> :
				<?php echo form()->combo('MinuteLater','select boox select-chosen disallowed',ListMinute(),'00', null, array('style'=>'margin-top:2px;'));?>
			</div>
		</div>
		
		<div class="ui-widget-form-row baris1">
			<div class="ui-widget-form-cell text_caption ui-row-col1"><?php echo lang("Note");?></div>
			<div class="ui-widget-form-cell center ui-row-col2">:</div>
			<div class="ui-widget-form-cell ui-row-col3"><?php echo form()->textarea("CallRemarks", "textarea tolong uppercase disallowed", null, null );?></div>
		</div>
		
		<div class="ui-widget-form-row baris1">
			<div class="ui-widget-form-cell text_caption ui-row-col1"></div>
			<div class="ui-widget-form-cell center ui-row-col2"></div>
			<div class="ui-widget-form-cell ui-row-col3">
				<?php echo form()->button_role('_SAV_TOOL_',$Button, null, 'marlin');?>
				<?php echo form()->button_role('_NXT_TOOL_',$Button, null, null);?>
				<?php echo form()->button_role('_CLS_TOOL_',$Button, null, null);?>
			</div>
		</div>
		
	 </div>
	
	</form>
	</div>	
</fieldset>	
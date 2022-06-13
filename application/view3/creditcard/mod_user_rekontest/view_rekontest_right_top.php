<div class="ui-widget-form-table" style="margin-top:-5px;">

		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell ui-widget-content-top text_caption"><?php echo lang("LB_Recsource");?></div>
			<div class="ui-widget-form-cell ui-widget-content-top text_caption">:</div>
			<div class="ui-widget-form-cell ui-widget-content-top"><?php echo form()->combo("frmrek_from_recsource", "select xselect tolong",FileRecsourceTrans(), null, null, array('multiple' => true ));?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array("DM_CampaignId"));?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo("frmrek_from_campaignid", "select xselect tolong", CampaignId(), null, null, array('multiple' => true) );?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("From Group");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo("frmrek_from_usergroup", "select  xselect tolong",DitributeUserLevel(),null, array('change' =>'window.SelectUserRekByGroup(this);'));?></div>
		</div>	
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("From User");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell" id="frmrek_from_userlist-html" ><?php echo form()->combo("frmrek_from_userlist", "select tolong", array());?></div>
		</div>	
		
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"> </div>
			<div class="ui-widget-form-cell text_caption"> </div>
			<div class="ui-widget-form-cell">  </div>
		</div>	
		 	
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Field Data ");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo("frmrek_from_value1", "select xselect tolong", FieldValue());?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Logical");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo("frmrek_from_field1", "select xselect tolong",FilterValue());?></div>
		</div>	
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Parameter");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell" ><?php echo form()->textarea("frmrek_from_field2", "textarea tolong fieldmultiple ");?></div>
		</div>	
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"> </div>
			<div class="ui-widget-form-cell text_caption"> </div>
			<div class="ui-widget-form-cell"> </div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Call Category ID");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo("frmrek_from_callstatus", "select xselect tolong", AllCallStatusFilterRekontest(), null, array('change' =>'window.UnderCallStatus(this);' ) );?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("DM_CallReasonId");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell " id="frmrek_from_callreason-html"><?php echo form()->combo("frmrek_from_reasonstatus", "select xselect tolong", AllCallReason(), null, null, array('multiple' => true ) );?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('LB_AvailSS'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell text_caption left"><?php echo form() -> fieldinteraval('frmrek_from_availss','input_text box', null, null, null, array('multiple' => true) );?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('LB_KreditLimit'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell text_caption left"><?php echo form()->fieldinteraval('frmrek_from_kreditlimit','input_text box', null, null, null, array('multiple' => true) );?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('LB_RangeAge'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell text_caption left"><?php echo form()->fieldinteraval('frmrek_from_ages','input_text box', null, null, null, array('multiple' => true) );?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("DM_UpdatedTs");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell">  <?php echo form()->interval("frmrek_from_updatets", "input_text date"); ?> </div>
		</div>	
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Record/Page");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->input("frmrek_from_recordpage", "input_text tolong", 20);?></div>
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
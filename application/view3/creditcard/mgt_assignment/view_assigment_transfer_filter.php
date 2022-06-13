<form name="formTransFilter">
<fieldset class="corner ui-fieldset-trans-top" style="width:auto;border-radius:0px;padding: 4px 4px 2px 4px;margin:-12px 5px 10px 5px; border-radius:5px;">
<?php echo form()->legend(lang("Filter Transfer"),"fa-search");?>
	<div class="ui-widget-form-table" style="margin-top:-5px;">
			
		<!-- <div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption">
				<?php 
					// echo lang("LB_Recsource");
				?>
			</div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell">
				<?php 
					// echo form()->combo("trans_from_recsource", "select xselect tolong",FileRecsourceTrans(),null, null, array('multiple' => true )  );
				?>
			</div>
		</div> -->
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("LB_CampaignId");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo("trans_from_campaign_id", "select xselect  tolong",CampaignId(), null, null, array('multiple' => true ) );?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Field Data ");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo("trans_field_value1", "select xselect tolong", FieldValue());?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Logical");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo("trans_field_filter1", "select xselect tolong",FilterValue());?></div>
		</div>	
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Parameter");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell" ><?php echo form()->textarea("trans_field_text1", "textarea tolong");?></div>
		</div>	
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("DM_CallCategoryId");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell">
			<?php //echo form()->combo("trans_call_category_id", "select xselect  tolong", AllCallStatus(),  null, 
					//array("change" => "window.EventSetCallResult('trans_call_category_id','trf-call-reason-id', 'trans_call_result_id'); " ), 
					//array('multiple' => true ) );?>
					
			<?php echo form()->combo("trans_call_category_id", "select xselect  tolong", CategoryCall(),  null, 
					array("change" => "window.EventSetCallResult('trans_call_category_id','trf-call-reason-id', 'trans_call_result_id'); " ), 
					array('multiple' => true ) );?>
			
				<!--
			<@?php echo form()->combo("trans_call_category_id", "select xselect  tolong", AllCallStatus(), 
			null, array('change' =>'Ext.DOM.LoadCallReasonID(this);') );?>
			-->
			
			</div>
		</div>
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("DM_CallReasonId");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell" id="trf-call-reason-id">
				<?php echo form()->combo("trans_call_result_id", "select xselect tolong", AllCallReason(), null, null, 
					array('multiple' => true ) );?>
					<!--
				<@?php echo form()->combo("trans_call_result_id", "select xselect tolong", array() );?>
				-->
				</div>
		</div>
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('LB_AvailSS'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell text_caption left">
			     <?php //echo form() -> fieldinteraval('trans_avail_ss','select box', AllCallStatus(), null, null, array('multiple' => true) );?>
			      
					<select name="trans_avail_ss_start" id="trans_avail_ss_start" class="select box">
					<option value="">Choose</option>
					<option value="0">0</option>
					<option value="1000000.00">1</option>
					<option value="3000000.00">3</option>
					<option value="5000000.00">5</option>
					<option value="10000000.00">10</option>
					<option value="15000000.00">15</option>
					<option value="25000000.00">25</option>
					<option value="50000000.00">50</option>
					<option value="100000000.00">100</option>
					<option value="150000000.00">150</option>
					<option value="250000000.00">250</option>
					<option value="1000000000.00">1000</option>
					</select>
					&nbsp;&nbsp;to&nbsp;&nbsp;
					<select name="trans_avail_ss_stop" id="trans_avail_ss_stop" class="select box">
					<option value="">Choose</option>
					<option value="0">0</option>
					<option value="1000000.00">1</option>
					<option value="3000000.00">3</option>
					<option value="5000000.00">5</option>
					<option value="10000000.00">10</option>
					<option value="15000000.00">15</option>
					<option value="25000000.00">25</option>
					<option value="50000000.00">50</option>
					<option value="100000000.00">100</option>
					<option value="150000000.00">150</option>
					<option value="250000000.00">250</option>
					<option value="1000000000.00">1000</option>
					</select>


			</div>
		</div>
		
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('LB_KreditLimit'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell text_caption left"><?php echo form() -> fieldinteraval('trans_kredit_limit','select box', AllCallStatus(), null, null, array('multiple' => true) );?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('LB_RangeAge'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell text_caption left"><?php echo form() -> fieldinteraval('trans_range_age','select box', AllCallStatus(), null, null, array('multiple' => true) );?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("DM_UpdatedTs");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->input("trans_call_start_date", "input_text date");?><?php echo lang("to"); ?><?php echo form()->input("trans_end_start_date", "input_text date");?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"> </div>
			<div class="ui-widget-form-cell text_caption"> </div>
			<div class="ui-widget-form-cell"> </div>
		</div>
		
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("From Group");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo("trans_from_user_group", "select  xselect tolong",DitributeUserLevel(),null, array('change' =>'Ext.DOM.SelectUserTransByGroup(this);'));?></div>
		</div>	
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("From User");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell" id="ui-user-trans-list"><?php echo form()->combo("trans_form_user_list", "select tolong", array());?></div>
		</div>	
		
		
	
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Record/Page");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->input("trans_record_page", "input_text tolong", 20);?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"></div>
			<div class="ui-widget-form-cell text_caption"></div>
			<div class="ui-widget-form-cell">
				<?php echo form()->button("BtnTransFilter","button search", lang("Search"), array('click' => 'Ext.DOM.SearchDataTrans();'));?>
				<?php echo form()->button("BtnTransReset","button clear", lang(array("Clear","&nbsp;&nbsp;")), array('click' => 'Ext.DOM.ClearDataTrans();'));?>	
			</div>
		</div> 
	</div>
</fieldset>
</form>
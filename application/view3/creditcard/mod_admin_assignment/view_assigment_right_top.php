<form name="frmBucketFilter">
<div class="ui-widget-form-table" style="margin-top:-5px;">

		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell ui-widget-content-top text_caption"><?php echo lang("LB_Recsource");?></div>
			<div class="ui-widget-form-cell ui-widget-content-top text_caption">:</div>
			<div class="ui-widget-form-cell ui-widget-content-top"><?php echo form()->combo("dis_recsource_name", "select xselect tolong",FileRecsourceAdmin(), null, null, array('multiple' => true ));?></div>
		</div>

		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array("DM_CampaignId"));?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><!-- <?php echo form()->combo("frm_admin_campaignid", "select tolong", CampaignId(), 29, null, array('multiple' => true,'disabled' => true) );?> -->
				<input type="text" name="CampaignId" class="input_text tolong" value="NTB" disabled>	
			</div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("LB_CustomerNumber");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->input("frm_admin_customerno", "input_text tolong");?></div>
		</div>
	
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("DM_UpdatedTs");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell">  
				<?php echo form()->input("frm_bucket_start_date", "input_text date");?> 
					<?php echo lang("to"); ?> 
					<?php echo form()->input("frm_bucket_end_date", "input_text date");?>
				<?php 
			//echo form()->interval("frm_admin_admin", "input_text date"); ?> 
			</div>
		</div>	
		
	
		
		<!-- <div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("DM_QualityCategoryKode");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo("admin_call_status", "select tolong",AllCallStatus(), null, null, array('multiple' => true) );?></div>
		</div> -->
		
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("DM_DataType");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell" ><?php echo form()->combo("frm_admin_data_type", "select  xzselect tolong",array('REG' => 'REG','CAP' => 'CAP'));?></div>
		</div>	
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Record/Page");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->input("frm_admin_record", "input_text tolong", 20);?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"></div>
			<div class="ui-widget-form-cell text_caption"></div>
			<div class="ui-widget-form-cell">
				<?php echo form()->button("BtnInjectFilter","button search", lang("Search"), array('click' => 'Ext.DOM.SearchDataAdmin();'));?>
				<?php echo form()->button("BtnInjectReset","button clear", lang(array("Clear","&nbsp;&nbsp;")), array('click' => 'Ext.DOM.ClearDataAdmin();'));?>	
			</div>
		</div> 
</div>
</form>
<fieldset class="corner ui-fieldset-cm-bot" style="width:auto;padding: 4px 4px 2px 4px;margin:15px -5px 5px 0px;">
<?php echo form()->legend(lang("Edit"),"fa-gear");?>
	<form name="frmCmOption" id="frmCmOption">
	<div class="ui-widget-form-table-compact">
		<input type="hidden" name="custid" id="custid" />
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Campaign Old");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell">
				<input type="text" name="campaign_old" id="campaign_old" class="input_text tolong" disabled />	
			</div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Campaign New");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell">
				<select name="campaign_new" id="campaign_new" class="select xselect tolong">
					<?php
						$campaign = $this->db->query("SELECT * FROM t_gn_campaign")->result_array();
						foreach($campaign as $item):
					?>
					<option value="<?php echo $item['CampaignId'];?>"><?php echo $item['CampaignName'];?></option>
					<?php
						endforeach;
					?>
				</select>
				<!-- <?php echo form()->input("campaign_new", "input_text tolong");?> -->
			</div>
		</div>
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"></div>
			<div class="ui-widget-form-cell text_caption"></div>
			<div class="ui-widget-form-cell">
				<?php 
					echo form()->button("BtnCmData", "button assign",lang("Submit"), array("click" => "Ext.DOM.UpdateCm();"));
					echo form()->button("BtnCmCancel", "button cancel",lang("Cancel"), array("click" => "Ext.DOM.CancelCm();"));
				?>
			</div>
		</div>
	</div>
	</form>
</fieldset>
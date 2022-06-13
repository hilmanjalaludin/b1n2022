<fieldset class="corner ui-fieldset-cm-bot" style="width:auto;padding: 4px 4px 2px 4px;margin:15px -5px 5px 0px;">
<?php echo form()->legend(lang("Edit Assignment (Transfer Data)"),"fa-gear");?>
	<form name="frmCmOptionAssignment" id="frmCmOptionAssignment">
	<div class="ui-widget-form-table-compact">
		<input type="hidden" name="custid_assignment" id="custid_assignment" />
    <div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Spv Old");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell">
				<input type="text" name="label_spv_old" id="label_spv_old" class="input_text tolong" disabled />
				<input type="hidden" name="spv_old" id="spv_old" class="input_text tolong" disabled />	
			</div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Spv New");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell">
				<select name="spv_new" id="spv_new" class="select xselect tolong" onchange="Ext.DOM.pickSpv(this)">
				<?php
						$spv = $this->db->query("SELECT a.UserId, a.id, a.full_name FROM tms_agent a WHERE a.handling_type = 22 AND a.user_state = 1")->result_array();
						foreach($spv as $item):
					?>
					<option value="<?php echo $item['UserId'];?>"><?php echo $item['id'].' - '.$item['full_name'];?></option>
					<?php
						endforeach;
					?>
				</select>
			</div>
		</div>
    
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Seller Old");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell">
				<input type="text" name="label_seller_old" id="label_seller_old" class="input_text tolong" disabled />
				<input type="hidden" name="seller_old" id="seller_old" class="input_text tolong" disabled />	
			</div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Seller New");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell">
				<select name="seller_new" id="seller_new" class="select tolong">
					<?php
						// $agent = $this->db->query("SELECT a.UserId, a.code_user FROM tms_agent a WHERE a.handling_type = 4")->result_array();
						// foreach($agent as $item):
					?>
					<!-- <option value="<?php echo $item['UserId'];?>"><?php echo $item['code_user'];?></option> -->
					<?php
						// endforeach;
					?>
				</select>
			</div>
		</div>
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"></div>
			<div class="ui-widget-form-cell text_caption"></div>
			<div class="ui-widget-form-cell">
				<?php 
					echo form()->button("BtnCmAssignmentData", "button assign",lang("Submit"), array("click" => "Ext.DOM.UpdateCmAssignment();"));
					echo form()->button("BtnCmAssignmentCancel", "button cancel",lang("Cancel"), array("click" => "Ext.DOM.CancelCmAssignment();"));
				?>
			</div>
		</div>
	</div>
	</form>
</fieldset>
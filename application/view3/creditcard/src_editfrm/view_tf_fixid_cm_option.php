<fieldset class="corner ui-fieldset-cm-bot" style="width:auto;padding: 4px 4px 2px 4px;margin:15px -5px 5px 0px;">
<?php echo form()->legend(lang("Edit"),"fa-gear");?>
	<form name="frmCmOption" id="frmCmOption">
	<div class="ui-widget-form-table-compact">
		<input type="hidden" name="custid" id="custid" />
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("SPV Kode");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell">
				<input type="text" name="spv_old" id="spv_old" class="input_text tolong" disabled />	
			</div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("SPV Kode New");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell">
				<select name="spv_new" id="spv_new" class="select xselect tolong">
					<?php
						$campaign = $this->db->query("SELECT * FROM tms_agent")->result_array();
						foreach($campaign as $item):
					?>
					<option value="">Choose</option>
					<option value="<?php echo $item['id'];?>"><?php echo $item['id'];?></option>
					<?php
						endforeach;
					?>
				</select>
				<!-- <?php echo form()->input("spv_new", "input_text tolong");?> -->
			</div>
		</div>
		<!-- edit hilman -->
	
		
			<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Seller Kode");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell">
				<input type="text" name="seller_old" id="seller_old" class="input_text tolong" disabled />	
			</div>
		</div>

		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Seller Kode New");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell">
				<select name="seller_new" id="seller_new" class="select xselect tolong">
					<?php
						$campaign = $this->db->query("SELECT * FROM tms_agent")->result_array();
						foreach($campaign as $item):
					?>
					<option value="">Choose</option>
					<option value="<?php echo $item['id'];?>"><?php echo $item['id'];?></option>
					<?php
						endforeach;
					?>
				</select>
				<!-- <?php echo form()->input("seller_new", "input_text tolong");?> -->
			</div>
		</div>
		<!-- edit hilman -->
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
<fieldset class="corner ui-fieldset-dis-bot" style="width:auto;padding: 4px 4px 2px 4px;margin:15px -5px 5px 0px;">
<?php echo form()->legend(lang("Option"),"fa-gear");?>
	<form name="frmDistOption">
	<div class="ui-widget-form-table-compact">
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Dist. Action");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->ListCheckbox("dis_user_action", DistribusiAction(), null, array("change" =>"Ext.Cmp('dis_user_action').oneChecked(this);ActionCheckDist(this);")); ?></div>
		</div>
		
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Total Data");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->input("dis_user_total", "input_text tolong");?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Dist. Quantity");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->input("dis_user_quantity", "input_text tolong");?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Dist. Type");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo("dis_user_type", "select xselect tolong", DistribusiType(), null);?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("User Group");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo("dis_user_group", "select xselect tolong", DitributeUserLevel(), null, array("change" => "Ext.DOM.SelectUserDistByGroup(this);") );?></div>
		</div>
		
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("User List");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo("dis_user_list", "select tolong");?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Dist. Mode");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo("dis_user_mode", "select xselect tolong", DitributeMode(),1);?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"></div>
			<div class="ui-widget-form-cell text_caption"></div>
			<div class="ui-widget-form-cell"><?php echo form()->checkbox("dis_check_kuota", 
				null, null, array('change' =>'window.checkKuota(this);'), array('label' => 'check user kuota') );?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"></div>
			<div class="ui-widget-form-cell text_caption"></div>
			<div class="ui-widget-form-cell">
				<?php echo form()->button("BtnDistData", "button assign",lang("Submit"), array("click" => "Ext.DOM.SubmitDistribute();"));?></div>
		</div>
	</div>
	</form>
</fieldset>
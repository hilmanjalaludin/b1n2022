<fieldset class="corner ui-widget-fieldset" style="padding:2px 5px 20px 5px;">
<?php echo form()->legend(lang("Edit"), $panel->field('icon'));?>
<form name="frmEditUserKuota">
	<?php echo form()->hidden('BK_Kuota_Id', null, $Kuota->field('BK_Kuota_Id'));?>
	<div class="ui-widget-form-table">
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang('BK_Kuota_Group');?></div>
			<div class="ui-widget-form-cell center">:</div>
			<div class="ui-widget-form-cell left"><?php echo form()->combo('BK_Kuota_Group', 'select superlong ui-disabled', Call(UserSessionPrivilege(),'SetCapital'), $Kuota->field('BK_Kuota_Group'), array('change' => 'window.EventUserKuota(this);') );?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang('BK_Kuota_UserKode');?></div>
			<div class="ui-widget-form-cell center">:</div>
			<div class="ui-widget-form-cell left" id="ui-html-user-kuota"><?php echo form()->combo('BK_Kuota_UserKode', 'select superlong ui-disabled', AllUser(),  $Kuota->field('BK_Kuota_UserId'));?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang('BK_Kuota_Size');?>
				<div class="ui-notes-info">( Jumlah Kuota<br>yang di inginkan )</div></div>
			<div class="ui-widget-form-cell center">:</div>
			<div class="ui-widget-form-cell left"><?php echo form()->input('BK_Kuota_Size', 'input_text superlong',$Kuota->field('BK_Kuota_Size'));?>
			</div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang('BK_Kuota_Flags');?></div>
			<div class="ui-widget-form-cell center">:</div>
			<div class="ui-widget-form-cell left"><?php echo form()->combo('BK_Kuota_Flags', 'select superlong', Flags(), $Kuota->field('BK_Kuota_Flags'));?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang('BK_Kuota_Data');?>
				<div class="ui-notes-info">( Jumlah Kuota<br>Saat Ini )</div></div>
			<div class="ui-widget-form-cell center">:</div>
			<div class="ui-widget-form-cell left">
			<?php echo form()->input('BK_Kuota_Data', 'input_text superlong ui-disabled',$Kuota->field('BK_Kuota_Data'));?>
			 </div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang('BK_Kuota_Creator');?></div>
			<div class="ui-widget-form-cell center">:</div>
			<div class="ui-widget-form-cell left"><?php echo form()->input('BK_Kuota_Creator', 'input_text superlong ui-disabled', $Kuota->field('CreatorKode','SetCapital'));?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang('BK_Kuota_UpdateTs');?></div>
			<div class="ui-widget-form-cell center">:</div>
			<div class="ui-widget-form-cell left"><?php echo form()->input('BK_Kuota_UpdateTs', 'input_text superlong ui-disabled', $Kuota->field('BK_Kuota_UpdateTs'));?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"> </div>
			<div class="ui-widget-form-cell center"></div>
			<div class="ui-widget-form-cell left">
				<?php echo form()->button_role('_UPD_TOOL_', $button);?>
				<?php echo form()->button_role('_CLS_TOOL_', $button);?>
			</div>
		</div>
		
	</div>
	
</form>
</fieldset>
<fieldset class="corner ui-widget-fieldset">
<?php echo form()->legend(lang("Detail"),"fa-users");?>
	<form name="frmEditRoleUser">
		<?php echo form()->hidden('UserRoleGroup', null, $row->get_value('user_role_id'));?>
		<?php echo form()->hidden('UserRoleDetail', null, 1);?>
		
		<div class="ui-widget-form-table">
			<div class="ui-widget-form-row">
				<div class="ui-widget-form-cell text_caption left"><?php echo lang("Role Code");?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell"><?php echo form()->input("user_role_code", "input_text superlong readonly", $row->get_value('user_role_code'));?></div>
			</div>
			
			<div class="ui-widget-form-row">
				<div class="ui-widget-form-cell text_caption left"><?php echo lang("Role Desc");?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell"><?php echo form()->input("user_role_desc", "input_text superlong", $row->get_value('user_role_desc'));?></div>
			</div>
		</div>	
			
		<div class="ui-widget-form-table">	
			<div class="ui-widget-form-row">
				<div class="ui-widget-form-cell text_caption left"><?php echo lang("Role Level");?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell"><?php echo form()->combo("user_role_level", "select ui-filter-order superlong", Order(), $row->get_value('user_role_level'));?></div>
			</div>
			
			<div class="ui-widget-form-row">
				<div class="ui-widget-form-cell text_caption left"><?php echo lang("Role Sort");?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell"><?php echo form()->combo("user_role_order", "select ui-filter-status superlong", Order(), $row->get_value('user_role_order'));?></div>
			</div>
		</div>
		
		<div class="ui-widget-form-table">		
			<div class="ui-widget-form-row">
				<div class="ui-widget-form-cell text_caption left"><?php echo lang("Role Status");?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell"><?php echo form()->combo("user_role_flags", "select ui-filter-status superlong", Flags(), $row->get_value('user_role_flags'));?></div>
			</div>
		</div>
	</form>
</fieldset>
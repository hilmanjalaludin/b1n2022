<fieldset class="corner ui-widget-fieldset" style="margin-top:10px;width:95%;padding:5px 20px 15px 5px;border-radius:5px;">
<?php echo form()->legend(lang("Privilege"),"fa-key");?>

	<div class="ui-widget-form-table-maximum" style="margin-left:25px;">
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang('GRP_Level_GroupSystem');?></div>
			<div class="ui-widget-form-cell">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo('profile','select superlong', UserSessionPrivilege(), $row->get_value('handling_type'), 
			array('change' => 'window.EventUserPrivilege(this);' ) );?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang('GRP_Level_Leader');?></div>
			<div class="ui-widget-form-cell">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo('team_leader','select superlong', $User -> _get_teamleader(), $row->get_value('tl_id'), NULL);?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang('GRP_Level_Supervisor');?></div>
			<div class="ui-widget-form-cell">:</div>
			<div class="ui-widget-form-cell">
				<?php echo form()->combo('user_spv','select superlong', $User -> _get_supervisor(), $row->get_value('spv_id'), 
				array('change' => 'window.EventUserSupervisor(this);') );?>
			</div>
		</div>
		
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang('GRP_Level_AccountManager');?></div>
			<div class="ui-widget-form-cell">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo('user_mgr','select superlong', 
				$User->_get_manager(),  $row->get_value('mgr_id') , 
				array('change' => 'window.EventUserAccountManager(this);') );?></div>
		</div>
			
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang('GRP_Level_GeneralManager');?></div>
			<div class="ui-widget-form-cell">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo('account_manager','select superlong', 
				$User->_get_general_manager(), $row->get_value('act_mgr'), 
				array('change' => 'window.EventUserGeneralManager(this);') );?></div>
		</div>
					
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang('GRP_Level_Administrator');?></div>
			<div class="ui-widget-form-cell">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo('user_admin','select superlong', 
					$User->_get_admin(), $row->get_value('admin_id') );?></div>
		</div>
	</div>
</fieldset>
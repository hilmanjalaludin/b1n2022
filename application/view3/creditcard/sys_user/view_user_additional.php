<fieldset class="corner ui-widget-fieldset" style="width:90%;margin:-5px 0px 0px 10px;padding:5px 20px 15px 5px;border-radius:5px;">
<?php echo form()->legend(lang("Additional"),"fa-gear");?>

	<div class="ui-widget-form-table-maximum" style="margin-left:35px;">
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption">Quality Head</div>
			<div class="ui-widget-form-cell">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo('quality_head','select superlong', $User -> _get_quality_head(), $row->get_value('quality_id') );?></div>
		</div>

		<div class="ui-widget-form-row">				
			<div class="ui-widget-form-cell text_caption">CC Group </div>
			<div class="ui-widget-form-cell">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo('cc_group','select superlong', $User -> _get_agent_group(), $row->get_value('agent_group') );?></div>
		</div>
		
		<div class="ui-widget-form-row">				
			<div class="ui-widget-form-cell text_caption">User Skill </div>
			<div class="ui-widget-form-cell">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo('user_skill','select superlong', CtiSkill(), $row->get_value('user_skill') );?></div>
		</div>

		<div class="ui-widget-form-row">				
			<div class="ui-widget-form-cell text_caption">Telphone</div>
			<div class="ui-widget-form-cell">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo('user_telphone','select superlong', $User -> _get_telephone(), $row->get_value('telphone'));?></div>
		</div>
		
		<div class="ui-widget-form-row">				
			<div class="ui-widget-form-cell text_caption">User Active</div>
			<div class="ui-widget-form-cell">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo('user_active','select superlong', $User -> _get_telephone(), $row->get_value('user_state'));?></div>
		</div>
		<div class="ui-widget-form-row">				
			<div class="ui-widget-form-cell text_caption top">User Role </div>
			<div class="ui-widget-form-cell">:</div>
			<div class="ui-widget-form-cell"><?php echo form()-> listcombo('user_role', 'select',UserRole(), $row->get_array_value('user_role'), null, array( "dwidth" =>"290px",  "height" => "150px",  "event"  => null, "button" => array(  array( "label" => "" ) ) ));?></div>
		</div>
		
		<div class="ui-widget-form-row">				
			<div class="ui-widget-form-cell text_caption"></div>
			<div class="ui-widget-form-cell"> </div>
			<div class="ui-widget-form-cell"><?php echo $action; ?></div>
		</div>
	</div>
</fieldset>
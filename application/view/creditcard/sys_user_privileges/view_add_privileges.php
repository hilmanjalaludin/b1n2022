<?php  get_view(array("sys_user_privileges","view_jsv_privileges"));?>
<div id="ui-widget-wiki-tabs" class="tabs corner">
	<ul>
		<li class="ui-tab-li-lasted">
			<a href="#ui-widget-wiki-content">
			<span class="ui-icon ui-icon-pencil"></span>
			<?php echo lang(array("Add","User","Privilege"));?> </a>
		</li>
    </ul>	
	<div id="ui-widget-role-edit-content" class="ui-widget-wiki-content">
		<fieldset class="corner ui-widget-fieldset">
			<?php echo form()->legend(lang("Add"),"fa-plus");?>
			
			<form name="frmUserPrivilege">
			<div class="ui-widget-form-table">
				<div class="ui-widget-form-row">
					<div class="ui-widget-form-cell text_caption"><?php echo lang(array("Privilege", "Name"));?></div>
					<div class="ui-widget-form-cell text_caption center">:</div>
					<div class="ui-widget-form-cell"><?php echo form()->input("privilege_user_name", "input_text superlong");?></div>
				</div>
				<div class="ui-widget-form-row">
					<div class="ui-widget-form-cell text_caption"><?php echo lang(array("Privilege", "Level"));?></div>
					<div class="ui-widget-form-cell text_caption center">:</div>
					<div class="ui-widget-form-cell"><?php echo form()->combo("privilege_user_level", "select superlong", Order() );?></div>
				</div>
				
				
				<div class="ui-widget-form-row">
					<div class="ui-widget-form-cell text_caption"><?php echo lang(array("Privilege","Status"));?></div>
					<div class="ui-widget-form-cell text_caption center">:</div>
					<div class="ui-widget-form-cell"><?php echo form()->combo("privilege_user_status", "select superlong", Flags() );?></div>
				</div>
				
				<div class="ui-widget-form-row">
					<div class="ui-widget-form-cell text_caption left"> </div>
					<div class="ui-widget-form-cell text_caption center"></div>
					<div class="ui-widget-form-cell"><?php echo form()->button_role('_SAV_TOOL_', $button); ?>
					</div>
				</div>
			</div>	
			</form>
			
		</fieldset>
	</div>
	
</div> 

<!-- END OF FILE -->
<!-- location : ./application/view/user/view_add_user.php
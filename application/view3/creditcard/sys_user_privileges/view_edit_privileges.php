
<?php  get_view(array("sys_user_privileges","view_jsv_privileges"));?>
<div id="ui-widget-wiki-tabs" class="tabs corner">
	<ul>
		<li class="ui-tab-li-lasted">
			<a href="#ui-widget-wiki-content">
			<span class="ui-icon ui-icon-pencil"></span>
			<?php echo lang(array("Edit","User","Privilege"));?> </a>
		</li>
    </ul>	
	<div id="ui-widget-role-edit-content" class="ui-widget-wiki-content">
		<fieldset class="corner ui-widget-fieldset">
			<?php echo form()->legend(lang("Edit"),"fa-edit");?>
			
			<form name="frmUserPrivilege">
			<?php echo form()->hidden("PrivilegeId", null, $row->get_value('id','intval') );?>
			<div class="ui-widget-form-table">
				<div class="ui-widget-form-row">
					<div class="ui-widget-form-cell text_caption"><?php echo lang(array("Privilege", "Name"));?></div>
					<div class="ui-widget-form-cell text_caption center">:</div>
					<div class="ui-widget-form-cell"><?php echo form()->input("privilege_user_name", "input_text superlong", $row->get_value('name') );?></div>
				</div>
				<div class="ui-widget-form-row">
					<div class="ui-widget-form-cell text_caption"><?php echo lang(array("Privilege", "Level"));?></div>
					<div class="ui-widget-form-cell text_caption center">:</div>
					<div class="ui-widget-form-cell"><?php echo form()->combo("privilege_user_level", "select superlong", Order(), $row->get_value('level_group'));?></div>
				</div>
				
				
				<div class="ui-widget-form-row">
					<div class="ui-widget-form-cell text_caption"><?php echo lang(array("Privilege","Status"));?></div>
					<div class="ui-widget-form-cell text_caption center">:</div>
					<div class="ui-widget-form-cell"><?php echo form()->combo("privilege_user_status", "select superlong", Flags(), $row->get_value('IsActive'));?></div>
				</div>
				
				<div class="ui-widget-form-row">
					<div class="ui-widget-form-cell text_caption left"> </div>
					<div class="ui-widget-form-cell text_caption center"></div>
					<div class="ui-widget-form-cell"><?php echo form()->button_role('_UPD_TOOL_', $btn); ?>
					</div>
				</div>
			</div>	
			</form>
			
		</fieldset>
	</div>
</div> 

<!--
<div id="result_content_add" class="box-shadow" style="margin-top:10px;">
<fieldset class="corner" style="background-color:white;margin:3px;">
 <legend class="icon-application">&nbsp;&nbsp;&nbsp;Edit Privilege</legend>
 <?php echo form() -> hidden('id',null, $Data['id']);?>
<table cellspacing="6px;">
	<tr>
		<td class="text_caption" nowrap>PrivilegeName </td>
		<td> <?php echo form()-> input('name', 'input_text long',$Data['name']);?> </td>
	</tr>
	
	<tr>
		<td class="text_caption" nowrap>Create By </td>
		<td> <?php echo form()-> input('updated_by', 'input_text long',$this -> EUI_Session->_get_session('Fullname'));?> </td>
	</tr>
		<tr>
		<td class="text_caption" nowrap>Status</td>
		<td> <?php echo form()-> combo('IsActive', 'select long',array('1'=>'Active','0'=>'Not Active'),$Data['IsActive']);?> </td>
	</tr>
	<tr>
		<td class="text_caption" nowrap>Create Date</td>
		<td> <?php echo form()-> input('last_update', 'input_text long',date('Y-m-d H:i:s'));?> </td>
	</tr>
	<tr>
		<td class="text_caption" nowrap>&nbsp;</td>
		<td>
			<input type="button" class="update button" onclick="Ext.DOM.UpdatePrivileges();" value="Update">
		</td>	
	</tr>
	
	
</table>
</fieldset>
</div>
-->

<!-- END OF FILE -->
<!-- location : ./application/view/user/view_add_user.php
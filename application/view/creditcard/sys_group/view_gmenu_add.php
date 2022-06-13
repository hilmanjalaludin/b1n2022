<?php get_view(array("sys_group","view_gmenu_jsv"));?>
<div id="ui-widget-add-campaign" class="tabs corner ui-frame-with">
	<ul>
		<li class="ui-tab-li-lasted">
			<a href="#ui-widget-add-content">
			<span class="ui-icon ui-icon-plus"></span><?php echo lang("Group Menu");?> </a>
		</li>
	</ul>	
	
	
 <div id="ui-widget-add-content" class="ui-widget-add-content ui-frame-with">
 <fieldset class="corner" style="background-color:white;margin:3px;padding:8px 0px 15px 0px;">
 <?php echo form()->legend(lang("Add"),"fa-plus");?>
 <form name="frmAddGroupMenu">
 <div class="ui-widget-form-table-compact">
 
	<div class="ui-widget-form-row">
		<div class="ui-widget-form-cell text_caption">* <?php echo lang("GM_Label_Name");?></div>
		<div class="ui-widget-form-cell text_caption center">:</div>
		<div class="ui-widget-form-cell"><?php echo form()->input('GU_Name','input_text superlong');?></div>
	</div>
	
	<div class="ui-widget-form-row">
		<div class="ui-widget-form-cell text_caption">* <?php echo lang("GM_Label_Description");?></div>
		<div class="ui-widget-form-cell text_caption center">:</div>
		<div class="ui-widget-form-cell"><?php echo form()->input('GU_Desc','input_text superlong');?></div>
	</div>
	
	<div class="ui-widget-form-row">
		<div class="ui-widget-form-cell text_caption"><?php echo lang("GM_Label_Ordering");?></div>
		<div class="ui-widget-form-cell text_caption center">:</div>
		<div class="ui-widget-form-cell"><?php echo form()->combo('GU_Ordering','select superlong', Order() );?></div>
	</div>
	
	<div class="ui-widget-form-row">
		<div class="ui-widget-form-cell text_caption"><?php echo lang("GM_Label_Flags");?></div>
		<div class="ui-widget-form-cell text_caption center">:</div>
		<div class="ui-widget-form-cell"><?php echo form()->combo('GU_Flags','select superlong', Flags() );?></div>
	</div>
	
	<div class="ui-widget-form-row">
		<div class="ui-widget-form-cell text_caption"> </div>
		<div class="ui-widget-form-cell"> </div>
		<div class="ui-widget-form-cell">
			<?php echo form()->button_role("_SAV_TOOL_", $btn); ?>
			<?php echo form()->button_role("_CLS_TOOL_", $btn); ?>
		</div>
	</div>
  </div>
</form>
</fieldset>
</div>
</div>
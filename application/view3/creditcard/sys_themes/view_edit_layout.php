<?php get_view(array("sys_themes","view_themes_jsv"));?>
<div id="ui-widget-add-campaign" class="tabs corner ui-frame-with">
<ul>
	<li class="ui-tab-li-lasted">
		<a href="#ui-widget-add-content">
		<span class="ui-icon ui-icon-plus"></span><?php echo lang("Edit Layout");?> </a>
	</li>
</ul>	
	
<div id="ui-widget-add-content" class="ui-widget-add-content ui-frame-with">
<fieldset class="corner ui-widget-fieldset" style="margin:5px; border-radius:5px;">
<?php echo form()->legend(lang("Edit"),"fa-edit");?>
	<form name="frmEditLayout">
		<?php echo form()->hidden('TH_Theme_Id', null, $row->get_value('Id')); ?>
		<div class="ui-widget-form-table">
		
			<div class="ui-widget-form-row">
				<div class="ui-widget-form-cell text_caption"><?php echo lang('GM_Label_Name');?></div>
				<div class="ui-widget-form-cell center">:</div>
				<div class="ui-widget-form-cell left"><?php echo form()->input('TH_Name','input_text superlong',$row->get_value('Name'));?></div>
			</div>
				
			<div class="ui-widget-form-row">
				<div class="ui-widget-form-cell text_caption"><?php echo lang('GM_Label_Creator');?></div>
				<div class="ui-widget-form-cell center">:</div>
				<div class="ui-widget-form-cell left"><?php echo form()->input('TH_Author','input_text superlong',$row->get_value('Author') );?></div>
			</div>
				
			<div class="ui-widget-form-row">
				<div class="ui-widget-form-cell text_caption"><?php echo lang('GM_Label_Description');?></div>
				<div class="ui-widget-form-cell center">:</div>
				<div class="ui-widget-form-cell text_caption"><?php echo form()->textarea('TH_Description','textarea superlong',$row->get_value('Description') );?></div>
			</div>
			
			<div class="ui-widget-form-row">
				<div class="ui-widget-form-cell text_caption"><?php echo lang('GM_Label_Flags');?></div>
				<div class="ui-widget-form-cell center">:</div>
				<div class="ui-widget-form-cell left"><?php echo form()-> combo('TH_Flags','select superlong',Flags(),$row->get_value('Flags') );?></div>
			</div>
				
			<div class="ui-widget-form-row">
				<div class="ui-widget-form-cell"></div>
				<div class="ui-widget-form-cell"></div>
				<div class="ui-widget-form-cell"><?php echo form()->button_role('_UPD_TOOL_', $btn);?></div>
			</div>
			</div>
			
		</form>
	  </fieldset>	
	</div>	
</div>	

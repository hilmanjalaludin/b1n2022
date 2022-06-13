<fieldset class="corner ui-widget-fieldset">
<?php echo form()->legend(lang("Role User Formbar "),"fa-bars");?>
	<fieldset class="corner ui-widget-fieldset">
	<div class="ui-widget-form-table">
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption left"><?php echo lang("Group");?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo("user_on_bottom_menu_group", "select superlong", GroupMenu());?></div>
			
			<div class="ui-widget-form-cell text_caption left"><?php echo lang("Menu");?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->input("user_on_bottom_menu_name", "input_text superlong");?></div>
			<div class="ui-widget-form-cell text_caption center"> <?php echo form()->link(array('class' => 'fa-search', 'label' => 'Search by modul name', 'button' => 'new FindPageFormbar();')); ?></div>
		</div>	
	</div>	
	</fieldset>
	<fieldset class="corner ui-widget-fieldset">
		<div class="ui-widget-form-table-compact" id="ui-widget-role-formbar" style="width:100%;"></div>	
	</fieldset>
</fieldset>
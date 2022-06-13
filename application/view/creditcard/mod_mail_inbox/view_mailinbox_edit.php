<?php  get_view(array("mod_view_bookkelas","view_bookkelas_jsv"));?>
<body>
<div id="ui-widget-wiki-tabs" class="tabs corner">
	<ul>
		<li class="ui-tab-li-lasted">
			<a href="#ui-widget-wiki-content">
			<span class="ui-icon ui-icon-pencil"></span><?php echo lang("Edit Room Type");?> </a>
		</li>
	</ul>	
	
<div id="ui-widget-wiki-content" class="ui-widget-wiki-content">

<fieldset class="corner ui-widget-fieldset">
<?php echo form()->legend(lang("Edit"),"fa-edit");?>
	<form name="frmEditBookClass">
		<div class="ui-widget-form-table">
			<div class="ui-widget-form-row">
				<div class="ui-widget-form-cell text_caption left"><?php echo lang("Class Code");?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell"><?php echo form()->input("book_class_code", "select superlong readonly", $row->get_value('book_class_code'));?></div>
			</div>
			
			<div class="ui-widget-form-row">
				<div class="ui-widget-form-cell text_caption left"><?php echo lang("Class Name");?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell"><?php echo form()->input("book_class_name", "select superlong", $row->get_value('book_class_name'));?></div>
			</div>
			
				<div class="ui-widget-form-row">
				<div class="ui-widget-form-cell text_caption left"><?php echo lang("Class Desc");?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell"><?php echo form()->input("book_class_desc", "select superlong", $row->get_value('book_class_desc'));?></div>
			</div>
			
			
			<div class="ui-widget-form-row">
				<div class="ui-widget-form-cell text_caption left"><?php echo lang("Sort Field");?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell"><?php echo form()->combo("book_class_order", "select ui-filter-order superlong", UserOrder($row->get_value('book_class_order')+$out->get_value('class_order')+10), $row->get_value('book_class_order'));?></div>
			</div>
			
			<div class="ui-widget-form-row">
				<div class="ui-widget-form-cell text_caption left"><?php echo lang("Status");?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell"><?php echo form()->combo("book_class_flags", "select ui-filter-status superlong", Flags(), 1);?></div>
			</div>
			
			<div class="ui-widget-form-row">
				<div class="ui-widget-form-cell text_caption left"></div>
				<div class="ui-widget-form-cell text_caption center"></div>
				<div class="ui-widget-form-cell"> <?php echo form()->button("button_add","button update", lang("Update"), array('click' => 'Ext.DOM.Update();') );?>
				</div>
			</div>
			
		</div>
	
	</form>
</fieldset>
</div>
</div> 

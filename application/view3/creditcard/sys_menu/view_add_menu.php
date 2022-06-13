<?php get_view(array("sys_menu","view_menu_jsv"));?>
<div id="ui-widget-add-campaign" class="tabs corner ui-frame-with">
	<ul>
		<li class="ui-tab-li-lasted">
			<a href="#ui-widget-add-content">
			<span class="ui-icon ui-icon-pencil"></span><?php echo lang("Add Menu");?> </a>
		</li>
	</ul>	
	
	<!-- start -->
	<div id="ui-widget-add-content" class="ui-widget-add-content ui-frame-with">
		
		<fieldset class="corner ui-widget-fieldset" style="margin-top:-5px;padding:5px 20px 15px 5px;border-radius:5px;">
		<?php echo form()->legend(lang("Add"),"fa-plus");?>
			<form name="frmAddMenu">
				<div class="ui-widget-form-table" id="ui-widget-box-1">	
					<div class="ui-widget-form-row"> 
						<div class="ui-widget-form-cell text_caption">* Name </div>
						<div class="ui-widget-form-cell">:</div>
						<div class="ui-widget-form-cell"> <?php echo form()-> input('menu_name', 'input_text superlong',$row->get_value('menu'));?> </div>
					</div>
					
					<div class="ui-widget-form-row"> 
						<div class="ui-widget-form-cell text_caption">* Group </div>
						<div class="ui-widget-form-cell">:</div>
						<div class="ui-widget-form-cell"> <?php echo form()->combo('menu_group', 'select superlong',GroupMenu(), $row->get_value('group_menu'));?> </div>
					</div>
					
					
					<div class="ui-widget-form-row"> 
						<div class="ui-widget-form-cell text_caption">* Menu ID </div>
						<div class="ui-widget-form-cell">:</div>
						<div class="ui-widget-form-cell"> <?php echo form()-> input('menu_id', 'input_text superlong',$row->get_value('el_id'));?> </div>
					</div>
					
					<div class="ui-widget-form-row"> 
						<div class="ui-widget-form-cell text_caption">* Controller </div>
						<div class="ui-widget-form-cell">:</div>
						<div class="ui-widget-form-cell"> <?php echo form()-> input('menu_controller', 'input_text superlong',$row->get_value('file_name'));?> </div>
					</div>
					
					<div class="ui-widget-form-row"> 
						<div class="ui-widget-form-cell text_caption">* Order </div>
						<div class="ui-widget-form-cell">:</div>
						<div class="ui-widget-form-cell"> <?php echo form()->combo('menu_order', 'select superlong',Order($row->get_value('OrderId')), $row->get_value('OrderId'));?> </div>
					</div>
					
					<div class="ui-widget-form-row"> 
						<div class="ui-widget-form-cell text_caption">* Status </div>
						<div class="ui-widget-form-cell">:</div>
						<div class="ui-widget-form-cell"> <?php echo form()->combo('menu_status', 'select superlong',Flags(), $row->get_value('flag'));?> </div>
					</div>
					
					<div class="ui-widget-form-row"> 
						<div class="ui-widget-form-cell text_caption"></div>
						<div class="ui-widget-form-cell"></div>
						<div class="ui-widget-form-cell"> <?php echo form()->button('button_add', 'button update',lang(array('Save')), array('click' => 'new EventSave();'));?> </div>
					</div>
				</div>
				
				<div class="ui-widget-form-table" id="ui-widget-box-2" style="margin-top:-2px;">  	
					<div class="ui-widget-form-row"> 
						<div class="ui-widget-form-cell text_caption">Menu Toolbar </div>
						<div class="ui-widget-form-cell">:</div>
						<div class="ui-widget-form-cell"> <?php echo form()-> listcombo('menu_toolbar', 'select',ToolbarLabel(), null, null,array( "dwidth" =>"280px",  "height" => "150px",  "event"  => null, "button" => array(  array( "label" => "" ) ) ));?> </div>
					</div>
				</div>
				
				<div class="ui-widget-form-table" id="ui-widget-box-3" style="margin-top:-2px;">			
					<div class="ui-widget-form-row"> 
						<div class="ui-widget-form-cell text_caption">Menu Formbar </div>
						<div class="ui-widget-form-cell">:</div>
						<div class="ui-widget-form-cell"> <?php echo form()-> listcombo('menu_formbar', 'select',FormbarLabel(), null, null, array( "dwidth" =>"280px",  "height" => "150px",  "event"  => null, "button" => array(  array( "label" => "" ) ) ));?> </div>
					</div>
				</div>
				
			</form>
		</fieldset>	
	</div>
</div>	
	
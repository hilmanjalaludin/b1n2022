<?php get_view(array("mod_courier","view_courierlayout_jsv"));?>
<div id="ui-widget-add-campaign" class="tabs corner ui-frame-with">
	
<div id="ui-widget-add-content" class="ui-widget-add-content ui-frame-with">
<fieldset class="corner ui-widget-fieldset" style="margin:5px; border-radius:5px;">
<?php echo form()->legend(lang("Add"),"fa-plus");?>
	<form name="frmAddLayout">
		<div class="ui-widget-form-table">
			<div class="ui-widget-form-row">
				<div class="ui-widget-form-cell text_caption">Kurir Name</div>
				<div class="ui-widget-form-cell center">:</div>
				<div class="ui-widget-form-cell left"><?php echo form()->input('KurirDesc','input_text superlong',$row->get_value('KurirDesc'));?></div>
			</div>
				
			<div class="ui-widget-form-row">
				<div class="ui-widget-form-cell text_caption">Kurir Code</div>
				<div class="ui-widget-form-cell center">:</div>
				<div class="ui-widget-form-cell left"><?php echo form()->input('KurirCode','input_text superlong',$row->get_value('KurirCode') );?></div>
			</div>

			<div class="ui-widget-form-row">
				<div class="ui-widget-form-cell text_caption">Status</div>
				<div class="ui-widget-form-cell center">:</div>
				<div class="ui-widget-form-cell left"><?php echo form()-> combo('flag','select superlong',Flags(),$row->get_value('flag') );?></div>
			</div>
				
			<div class="ui-widget-form-row">
				<div class="ui-widget-form-cell"></div>
				<div class="ui-widget-form-cell"></div>
				<input type="button" class="save button" onclick="Ext.DOM.SaveLayout();" value="Save"></td>
			</div>
			</div>
			
		</form>
	  </fieldset>	
	</div>	
</div>	

<?php get_view(array("mod_configuration","view_configuration_jsv"));?>
<div id="ui-widget-add-campaign" class="tabs corner ui-frame-with">
	<ul>
		<li class="ui-tab-li-lasted">
			<a href="#ui-widget-add-content">
			<span class="ui-icon ui-icon-plus"></span><?php echo lang(array("Add","Config"));?> </a>
		</li>
	</ul>	
	
	<!-- start -->
	<div id="ui-widget-add-content" class="ui-widget-add-content ui-frame-with">
		
		<fieldset class="corner" style="background-color:white;margin:3px;">
		<?php echo form()->legend(lang("Add"),"fa-plus");?>
		
		<!--<legend class="icon-application">&nbsp;&nbsp;&nbsp;Add Configuration  </legend>-->
		 
		 <form name="frmConfigUser">
			<div class="ui-widget-form-table-maximum" style="margin-left:35px;">
				<div class="ui-widget-form-row">
					<div class="ui-widget-form-cell text_caption">* Ref. Code </div>
					<div class="ui-widget-form-cell">:</div>
					<div class="ui-widget-form-cell"><?php echo form()->combo('refConfigCode','select superlong',AllConfigCode(), null, array("change"=>"Ext.Cmp('ConfigCode').setValue(this.value);"));?> </div>
				</div>
				
				<div class="ui-widget-form-row">
					<div class="ui-widget-form-cell text_caption">* Config Code </div>
					<div class="ui-widget-form-cell">:</div>
					<div class="ui-widget-form-cell"><?php echo form()->input('ConfigCode','input_text superlong');?> </div>
				</div>
				
				<div class="ui-widget-form-row">
					<div class="ui-widget-form-cell text_caption">* Config Type</div>
					<div class="ui-widget-form-cell">:</div>
					<div class="ui-widget-form-cell"><?php echo form()->combo('ConfigType','select superlong', ConfigType());?></div>
				</div>
				
				<div class="ui-widget-form-row">
					<div class="ui-widget-form-cell text_caption">* Config Name </div>
					<div class="ui-widget-form-cell">:</div>
					<div class="ui-widget-form-cell"><?php echo form()->input('ConfigName','input_text superlong');?> </div>
				</div>
				
				<div class="ui-widget-form-row">
					<div class="ui-widget-form-cell text_caption">* Config Value</div>
					<div class="ui-widget-form-cell">:</div>
					<div class="ui-widget-form-cell"><?php echo form()->input('ConfigValue','input_text superlong');?></div>
				</div>
				
				
				<div class="ui-widget-form-row">
					<div class="ui-widget-form-cell text_caption">* Config Share</div>
					<div class="ui-widget-form-cell">:</div>
					<div class="ui-widget-form-cell"><?php echo form()->combo('ConfigShare','select superlong', array('0' => 'Not Share','1'=> 'Share'));?></div>
				</div>
				
				
				<div class="ui-widget-form-row">
					<div class="ui-widget-form-cell text_caption">* Config Status</div>
					<div class="ui-widget-form-cell">:</div>
					<div class="ui-widget-form-cell"><?php echo form()->combo('ConfigFlags','select superlong',array('1'=>'Active','0'=>'Not Active'));?></div>
				</div>
				
				<div class="ui-widget-form-row">
					<div class="ui-widget-form-cell"></div>
					<div class="ui-widget-form-cell"></div>
					<div class="ui-widget-form-cell"> <?php echo form()->button_role('_SAV_TOOL_', $btn);?></div>
				</div>
			</div>
			</form>
		</fieldset>	
	</div>
</div>
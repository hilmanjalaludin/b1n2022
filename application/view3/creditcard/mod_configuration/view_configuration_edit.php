<?php get_view(array("mod_configuration","view_configuration_jsv"));?>
<div id="ui-widget-add-campaign" class="tabs corner ui-frame-with">
	<ul>
		<li class="ui-tab-li-lasted">
			<a href="#ui-widget-add-content">
			<span class="ui-icon ui-icon-pencil"></span><?php echo lang(array("Edit","Config"));?> </a>
		</li>
	</ul>	
	
	<!-- start -->
	<div id="ui-widget-add-content" class="ui-widget-add-content ui-frame-with">
		
		<fieldset class="corner ui-widget-fieldset" 
			style="width:97%;margin:-5px 0px 0px 10px;padding:5px 20px 15px 5px;border-radius:5px;">
			
			<form name="frmConfigUser">
			<?php echo form()->legend(lang("Edit"),"fa-edit");?>
				<div class="ui-widget-form-table-compact">	
				<?php echo form()->hidden("ConfigID", null, $row->get_value('ConfigID'));?>
				<div class="ui-widget-form-row">
					<div class="ui-widget-form-cell text_caption">* Ref. Code </div>
					<div class="ui-widget-form-cell">:</div>
					<div class="ui-widget-form-cell"><?php echo form()->combo('refConfigCode','select superlong',AllConfigCode(), $row->get_value('ConfigCode'), array("change"=>"Ext.Cmp('ConfigCode').setValue(this.value);"));?> </div>
				</div>
				
				<div class="ui-widget-form-row">
					<div class="ui-widget-form-cell text_caption">* Config Code </div>
					<div class="ui-widget-form-cell">:</div>
					<div class="ui-widget-form-cell"><?php echo form()->input('ConfigCode','input_text superlong', $row->get_value('ConfigCode') );?> </div>
				</div>
				
				<div class="ui-widget-form-row">
					<div class="ui-widget-form-cell text_caption">* Config Type</div>
					<div class="ui-widget-form-cell">:</div>
					<div class="ui-widget-form-cell"><?php echo form()->combo('ConfigType','select superlong', ConfigType(), $row->get_value('ConfigType') );?></div>
				</div>
				
				<div class="ui-widget-form-row">
					<div class="ui-widget-form-cell text_caption">* Config Name </div>
					<div class="ui-widget-form-cell">:</div>
					<div class="ui-widget-form-cell"><?php echo form()->input('ConfigName','input_text superlong', $row->get_value('ConfigName') );?> </div>
				</div>
				
				<div class="ui-widget-form-row">
					<div class="ui-widget-form-cell text_caption">* Config Value</div>
					<div class="ui-widget-form-cell">:</div>
					<div class="ui-widget-form-cell"><?php echo ConfigStyle('ConfigValue', null, $row->get_value('ConfigValue'), $row->get_value('ConfigType'));?></div>
				</div>
				
				
				<div class="ui-widget-form-row">
					<div class="ui-widget-form-cell text_caption">* Config Share</div>
					<div class="ui-widget-form-cell">:</div>
					<div class="ui-widget-form-cell"><?php echo form()->combo('ConfigShare','select superlong', array('0' => 'Not Share','1'=> 'Share'), $row->get_value('ConfigShare') );?></div>
				</div>
				
				
				<div class="ui-widget-form-row">
					<div class="ui-widget-form-cell text_caption">* Config Status</div>
					<div class="ui-widget-form-cell">:</div>
					<div class="ui-widget-form-cell"><?php echo form()->combo('ConfigFlags','select superlong',array('1'=>'Active','0'=>'Not Active'), $row->get_value('ConfigFlags') );?></div>
				</div>
				
				<div class="ui-widget-form-row">
					<div class="ui-widget-form-cell"></div>
					<div class="ui-widget-form-cell"></div>
					<div class="ui-widget-form-cell"> <?php echo form()->button_role('_UPD_TOOL_', $btn);?></div>
				</div>	
				</div>
			 </form>
		</fieldset>	
</div>

<!--
<div id="result_content_add" class="box-shadow" style="margin-top:10px;">
<fieldset class="corner" style="background-color:white;margin:3px;">
 <legend class="icon-application">&nbsp;&nbsp;&nbsp;Edit Configuration  </legend>
 <form name="frmEditConfig">
 
	<?php echo form()->hidden('ConfigID',null,$rows['ConfigID']);?>
	<table cellpadding="4px;" border=0 cellspacing="3">
		<tr>
			<td class="text_caption">* Reference Code </td>
			<td colspan="1"><?php echo form()->combo('refConfigCode','select long',$space, $rows['ConfigCode'], array("change"=>"Ext.Cmp('ConfigCode').setValue(this.value);"));?></td>
		</tr>
		<tr>
			<td class="text_caption">* Config Code </td>
			<td colspan="1"> <?php echo form()->input('ConfigCode','input_text long',$rows['ConfigCode']);?> </td>
		</tr>
		<tr>
			<td class="text_caption">* Config Name </td>
			<td colspan="1"> <?php echo form()->input('ConfigName','input_text long',$rows['ConfigName']);?> </td>
		</tr>
		<tr>
			<td class="text_caption">* Config Value</td>
			<td><?php echo form()->input('ConfigValue','select long',$rows['ConfigValue']);?></td>
		</tr>
		<tr>
			<td class="text_caption">* Status</td>
			<td><?php echo form()->combo('ConfigFlags','select long',array('1'=>'Active','0'=>'Not Active'),$rows['ConfigFlags']);?></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>
				<input type="button" class="update button" onclick="Ext.DOM.UpdateConfig();" value="Update">
				<input type="button" class="close button" onclick="Ext.Cmp('span_top_nav').setText('');" value="Close">	
			</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
	</table>
	</form>
</fieldset>	
</div>-->

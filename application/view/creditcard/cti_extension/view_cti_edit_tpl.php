<?php get_view(array("cti_extension","view_cti_jsv"));?>
<div id="ui-widget-add-campaign" class="tabs corner ui-frame-with">
	<ul>
		<li class="ui-tab-li-lasted">
			<a href="#ui-widget-add-content">
			<span class="ui-icon ui-icon-pencil"></span><?php echo lang(array("Edit","Extension"));?> </a>
		</li>
	</ul>	
	
<div id="ui-widget-add-content" class="ui-widget-add-content ui-frame-with">
<fieldset class="corner ui-widget-fieldset" style="width:97%;margin:-5px 0px 0px 10px;padding:5px 20px 15px 5px;border-radius:5px;">
<?php echo form()->legend(lang("Edit"), "fa-edit"); ?>
	
	<form name="frmEditExtension">
		
		<?php echo form()->hidden('id',null,$Data->get_value('id'));?>
		<table cellpadding="8px;">
		<tr>
			<td class="text_caption">Ext. Number :</td>
			<td><?php echo form()->input('ext_number','input_text superlong', $Data->get_value('ext_number'));?></td>
		</tr>
		<tr>
			<td class="text_caption">PBX Server :</td>
			<td><?php echo form()->combo('pbx','select superlong',PabxServer(),$Data->get_value('pbx'));?></td>
		</tr>
		<tr>
			<td class="text_caption">Description :</td>
			<td><?php echo form()->textarea('ext_desc','textarea superlong',$Data->get_value('ext_desc'));?></td>
		</tr>
		<tr>
			<td class="text_caption"> Type :</td>
			<td><?php echo form()->combo('ext_type','select superlong',PabxType(),$Data->get_value('ext_type'));?></td>
		</tr>
		<tr>
			<td class="text_caption">Status :</td>
			<td><?php echo form()->combo('ext_status','select superlong',PabxStatus(),$Data->get_value('ext_status'));?></td>
		</tr>
		<tr>
			<td class="text_caption">Location :</td>
			<td><?php echo form()->input('ext_location','input_text superlong',$Data->get_value('ext_location'));?></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>
			<?php if( is_object($Button) && $Button->find_value('_UPD_TOOL_') ) : ?>
				<?php echo form()->button_role("_UPD_TOOL_", $Button);?>
			<?php endif;?>
			</td>
		</tr>	
		</table>
	</form>
	
</fieldset>	
</div>
</div>

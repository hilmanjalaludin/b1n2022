<?php get_view(array("cti_extension","view_cti_jsv"));?>
<div id="ui-widget-add-campaign" class="tabs corner ui-frame-with">
	<ul>
		<li class="ui-tab-li-lasted">
			<a href="#ui-widget-add-content">
			<span class="ui-icon ui-icon-pencil"></span><?php echo lang(array("Add","Extension"));?> </a>
		</li>
	</ul>	
	<!--<#?php print_r($Button); ?>-->
<div id="ui-widget-add-content" class="ui-widget-add-content ui-frame-with">
<fieldset class="corner ui-widget-fieldset" style="width:97%;margin:-5px 0px 0px 10px;padding:5px 20px 15px 5px;border-radius:5px;">
<?php echo form()->legend(lang("Add"), "fa-plus"); ?>
	<form name="frmAddExtension">
		
		<table cellpadding="8px;">
		<tr>
			<td class="text_caption">Extension Number :</td>
			<td><?php echo form()->input('ext_number','input_text superlong');?></td>
		</tr>
		<tr>
			<td class="text_caption">PABX Server :</td>
			<td><?php echo form()->combo('pbx','select superlong',PabxServer());?></td>
		</tr>
		<tr>
			<td class="text_caption">Description :</td>
			<td><?php echo form()->textarea('ext_desc','textarea superlong', "OUTBOUND");?></td>
		</tr>
		<tr>
			<td class="text_caption"> Type :</td>
			<td><?php echo form()->combo('ext_type','select superlong',PabxType());?></td>
		</tr>
		<tr>
			<td class="text_caption">Status :</td>
			<td><?php echo form()->combo('ext_status','select superlong',PabxStatus(), $Status);?></td>
		</tr>
		<tr>
			<td class="text_caption">Location :</td>
			<td><?php echo form()->input('ext_location','input_text superlong');?></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>
				<?php if( is_object($Button) && ($Button->find_value('_SAV_TOOL_')) ) : ?>
				<?php echo form()->button_role("_SAV_TOOL_", $Button);?>
				<?php endif;?>
			</td>
		</tr>	
		</table>
	</div>	
</fieldset>	
</div>
</div>

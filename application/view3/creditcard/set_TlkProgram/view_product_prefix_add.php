<?php get_view(array("set_TlkProgram", "view_product_prefix_jsv")); ?>
<div id="ui-widget-add-campaign" class="tabs corner ui-frame-with">
	<ul>
		<li class="ui-tab-li-lasted">
			<a href="#ui-widget-add-content">
				<span class="ui-icon ui-icon-plus"></span><?php echo lang("Add Program"); ?> </a>
		</li>
	</ul>

	<!-- start : tpl -->

	<div id="ui-widget-add-content" class="ui-widget-add-content ui-frame-with">
		<fieldset class="corner ui-widget-fieldset" style="margin:5px; padding:10px 10px 10px 10px ; border-radius:5px;">
			<?php echo form()->legend(lang(array("Add")), "fa-plus"); ?>
			<form name="frmProductPrefix">
				<table>
					<tr>
						<td class="text_caption">Data Master</td>
						<td class="text_caption">:</td>
						<!-- <td><?php //echo form()->combo('PRD_Data_Master', 'select superlong', Product()); 
									?></td> -->
						<td><?php echo form()->input('PRD_Data_Master', 'input_text superlong', null, null); ?></td>
					</tr>
					<tr>
						<td class="text_caption">Data Kode</td>
						<td class="text_caption">:</td>
						<!-- <td><?php //echo form()->combo('result_method', 'select superlong', $Method); 
									?></td> -->
						<td><?php echo form()->input('PRD_Data_Kode', 'input_text superlong', null, null); ?></td>
					</tr>
					<tr>
						<td class="text_caption">Data Value</td>
						<td class="text_caption">:</td>
						<td><?php echo form()->input('PRD_Data_Value', 'input_text superlong', null, null); ?></td>
					</tr>

					<tr>
						<td class="text_caption">Tenor</td>
						<td class="text_caption">:</td>
						<td><?php echo form()->input('PRD_Data_Tenor', 'input_text superlong', null, null); ?></td>
					</tr>
					<tr>
						<td class="text_caption">Data Rate</td>
						<td class="text_caption">:</td>
						<!-- <td><?php //echo form()->combo('form_input', 'select superlong', $AddForm); 
									?></td> -->
						<td><?php echo form()->input('PRD_Data_Rate', 'input_text superlong', null, null); ?></td>
					</tr>
					<tr>
						<td class="text_caption">Data Sort</td>
						<td class="text_caption">:</td>
						<!-- <td><?php //echo form()->combo('form_edit', 'select superlong', $EditForm); 
									?></td> -->
						<td><?php echo form()->input('PRD_Data_Sort', 'input_text superlong', null, null); ?></td>
					</tr>
					<tr>
						<td class="text_caption">Status</td>
						<td class="text_caption">:</td>
						<td><?php echo form()->combo('status_active', 'select superlong', Flags(), 0); ?></td>
					</tr>
					<tr>
						<td class="text_caption">&nbsp;</td>
						<td class="text_caption">&nbsp;</td>
						<td><input type="button" class="save button" onclick="Ext.DOM.savePrefix();" value="Save"></td>
					</tr>
				</table>
			</form>
		</fieldset>
	</div>

</div>
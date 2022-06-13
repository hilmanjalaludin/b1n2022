<fieldset class="corner" style='margin-top:-10px;'>
<legend class="icon-menulist">&nbsp;&nbsp;Group Filter </legend>
<div>
	<table cellpadding='4' cellspacing=4>
		<tr>
			<td class="text_caption bottom">Filter By </td>
			<td><?php __(form()->combo('Filter','select long', $filter_by, null, array("change" => "Ext.DOM.AgentByGroup(this);") ));?></td>
		</tr>
		<tr>
			<td class="text_caption bottom">Select</td>
			<td > <span id="DivAgent"><?php __(form()->combo('Content_Filter','select long',  array() ));?></span></td>
		</tr>
		<tr>
			<td class="text_caption bottom">Interval </td>
			<td class='bottom'>
				<?php __(form()->input('start_date','input_text box date'));?> &nbsp-
				<?php __(form()->input('end_date','input_text box date'));?>
			</td>
		</tr>
		<tr>
			<td class="text_caption bottom">Mode </td>
			<td class='bottom'><?php __(form()->combo('Mode','select long', $mode_call_center));?></td>
		</tr>
		<tr>
			<td class="text_caption"> &nbsp;</td>
			<td class='bottom'>
				<?php __(form()->button('','page-go button','Show',array("click"=>"Ext.DOM.ShowReport();") ));?>
				<?php __(form()->button('','excel button','Export',array("click"=>"Ext.DOM.ShowExcel();") ));?>
			</td>
		</tr>
	</table>
</div>
</fieldset>
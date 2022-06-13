<?php

// -------------------------------------------------------------------

/*
 * @ package		_getPrefix() 
 * -------------------------------------------------------------------
 *
 * @ def			 
 * @ param			 
 */
 
if( !function_exists('_selectPrefixCode') )
{
function & _selectPrefixCode( $row  ) 
 {
	preg_match_all('![0]+!', $row->get_value('PRD_Data_Master'), $matches);
	$PrefixCode = substr($row->get_value('PRD_Data_Master'), 0, (strlen($row->get_value('PRD_Data_Master'))-strlen($matches[0][0])) );
	return (string)$PrefixCode;
 }
 
}
// -------------------------------------------------------------------

/*
 * @ package		_getPrefix() 
 * -------------------------------------------------------------------
 *
 * @ def			 
 * @ param			 
 */
 $row =& new EUI_object( $data );
 $PrefixCode =& _selectPrefixCode( $row ) ;
//  var_dump($PrefixCode);
//  die;
 
//$row->debug_label();
	
?>


<?php get_view(array("set_TlkProgram","view_product_prefix_jsv"));?>
<div id="ui-widget-add-campaign" class="tabs corner ui-frame-with">
	<ul>
		<li class="ui-tab-li-lasted">
			<a href="#ui-widget-add-content">
			<span class="ui-icon ui-icon-pencil"></span><?php echo lang("Edit Program");?> </a>
		</li>
	</ul>
	
	<!-- start : edit -->
	
	
	<div id="ui-widget-add-content" class="ui-widget-add-content ui-frame-with">
		<fieldset class="corner ui-widget-fieldset" style="margin:5px; padding:10px 10px 10px 10px ; border-radius:5px;">
		<?php echo form()->legend(lang(array("Edit")),"fa-edit");?>
		<form name="frmEditPrefix">
		<?php echo form()->hidden('PRD_Data_Id',null,$row->get_value('PRD_Data_Id'));?>
			<table cellpadding="4px;">
				<tr>
					<td class="text_caption">Data Master</td>
					<td class="text_caption">:</td>
					<!-- <td><?php //echo form() -> combo('PRD_Data_Master','select superlong',Product(), $row->get_value('ProductId'),null,array('disabled'=>true));?></td> -->
					<td><?php echo form() -> input('PRD_Data_Master','input_text superlong', $row->get_value('PRD_Data_Master'), null);?></td>
				</tr>
				<tr>
					<td class="text_caption">Data Kode </td>
					<td class="text_caption">:</td>
					<td><?php echo form() -> input('PRD_Data_Kode','input_text superlong', $row->get_value('PRD_Data_Kode'), null );?></td>
				</tr>
				<tr>
					<td class="text_caption">Data Value</td>
					<td class="text_caption">:</td>
					<td><?php echo form() -> input('PRD_Data_Value','input_text superlong', $row->get_value('PRD_Data_Value'), null );?></td>
				</tr>
				<tr>
					<td class="text_caption">Tenor</td>
					<td class="text_caption">:</td>
					<td><?php echo form() -> input('PRD_Data_Tenor','input_text superlong', $row->get_value('PRD_Data_Tenor'), null );?></td>
				</tr>
				<tr>
					<td class="text_caption">Data Rate</td>
					<td class="text_caption">:</td>
					<!-- <td><?php //echo form() -> input('PRD_Data_Rate','input_text superlong', $PrefixCode, null );?></td> -->
					<td><?php echo form() -> input('PRD_Data_Rate','input_text superlong', $row->get_value('PRD_Data_Rate'), null );?></td>
				</tr>
				<tr>
					<td class="text_caption">Data Sort</td>
					<td class="text_caption">:</td>
					<td><?php echo form() -> input('PRD_Data_Sort','input_text superlong', $row->get_value('PRD_Data_Sort'), null );?></td>
				</tr>
								
				<tr>
					<td class="text_caption"><?php echo lang("Status");?> </td>
					<td class="text_caption">:</td>
					<td><?php echo form() -> combo('status_active','select superlong',Flags(), $row->get_value('PRD_Data_Status') );?></td>
				</tr>
				<tr>
					<td class="text_caption">&nbsp;</td>
					<td class="text_caption">&nbsp;</td>
					<td><input type="button" class="update button" onclick="Ext.DOM.UpdatePrefix();" value="Update"></td>
				</tr>
			</table>
		</form>
		</fieldset>
	</div>
	<!-- end -->
	
</div>	

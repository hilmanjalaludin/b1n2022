<?php
/*
 * E.U.I 
 *
 * subject	: get model data for SysUser 
 * 			  extends under Controller class
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/controller/sysuser/
 */
?>

<form name="frmAddCores">
<div class="box-shadow" style="padding:10px;">
 <fieldset class="corner">
 <legend class="icon-application"> &nbsp;&nbsp;&nbsp;Add Wallboard Setup </legend>
<table cellpadding="4px;">
<tr>
	<td class="text_caption">* Daily Today Target</td>
	<td><?php echo form() -> input('daily_today','input_text long', NULL, NULL,array('style'=>'height:18px;width:160px;color:#000000;border:1px solid red;') ); ?></td>
</tr>
<tr>
	<td class="text_caption">* MTD H-1</td>
	<td><?php echo form() -> input('mtd_h1','input_text long', NULL, NULL ,array('style'=>'height:18px;width:160px;color:#000000;border:1px solid red;') ); ?></td>
</tr>
<tr>
	<td class="text_caption">* Monthly Target</td>
	<td><?php echo form() -> input('month_target','input_text long', NULL, NULL ,array('style'=>'height:18px;width:160px;color:#000000;border:1px solid red;') ); ?></td>
</tr>
<tr>
	<td class="text_caption">* Product </td>
	<td><?php echo form() -> combo('product', 'select', array('usage'=>'Usage','balcon' => 'Balcon'),null,null,array('style'=>'height:21px;width:100px;color:#000000;border:1px solid red;')); ?></td>
</tr>			
<tr>
	<td>&nbsp;</td>
	<td> 
			<input type="button" class="save button" onclick="SaveNewGroupMenu();" value="Save">
			<input type="button" class="close button" onclick="Ext.Cmp('panel-content').setText('');" value="Close">
		</td>
	</tr>	
</table>
</fieldset>
</div>
</form>

<?php

 // END OF FILE 
?>
<div id="result_content_add" class="box-shadow" style="margin-top:10px;">
<fieldset class="corner" style="background-color:white;margin:3px;">
 <legend class="icon-application">&nbsp;&nbsp;&nbsp;Edit Call Result  </legend>
	<?php echo form()->hidden('CallReasonId',null,$Data['CallReasonId']);?>
	<table cellpadding="4px;" border=0 cellspacing="3">
		<tr>
			<td class="text_caption">* Call Result ID</td>
			<td colspan="1"><?php echo form()->input('CallReasonCode','input_text long',$Data['CallReasonCode']);?></td>
			<td class="text_caption">* Contacted</td>
			<td><?php echo form()->combo('CallReasonContactedFlag','select long',$Event, $Data['CallReasonContactedFlag']);?></td>
		</tr>
		<tr>
			<td class="text_caption">* Call Result Name</td>
			<td colspan="1"> <?php echo form()->input('CallReasonDesc','input_text long',$Data['CallReasonDesc']);?> </td>
			<td class="text_caption">* Call Result Level</td>
			<td><?php echo form()->combo('CallReasonLevel','select long', $Orders,$Data['CallReasonLevel']);?></td>
		</tr>
		<tr>
			<td class="text_caption">* Call Result Category</td>
			<td><?php echo form()->combo('CallReasonCategoryId','select long',$CallCategoryId,$Data['CallReasonCategoryId']);?></td>
			<td class="text_caption">* Not Interest</td>
			<td><?php echo form()->combo('CallReasonNoNeed','select long',$Event,$Data['CallReasonNoNeed']);?></td>
		</tr>
		<tr>
			<td class="text_caption">* Open Closing form</td>
			<td><?php echo form()->combo('CallReasonEvent','select long',$Event,$Data['CallReasonEvent']);?></td>
			<td class="text_caption">* Order</td>
			<td><?php echo form()->combo('CallReasonOrder','select long',$Orders,$Data['CallReasonOrder']);?></td>
		</tr>
		<tr>
			<td class="text_caption">* CallBack Reminder</td>
			<td><?php echo form()->combo('CallReasonLater','select long',$Event,$Data['CallReasonLater']);?></td>
			<td class="text_caption">Status</td>
			<td><?php echo form()->combo('CallReasonStatusFlag','select long', array('1'=>'Active','0'=>'Not Active'),$Data['CallReasonStatusFlag'] );?></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>
				<input type="button" class="update button" onclick="Ext.DOM.UpdateCallResult();" value="Update">
				<input type="button" class="close button" onclick="Ext.Cmp('span_top_nav').setText('');" value="Close">	
			</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
	</table>
</fieldset>	
</div>
<div id="result_content_add" class="box-shadow" style="margin-top:10px;">
<fieldset class="corner" style="background-color:white;margin:3px;">
 <legend class="icon-application">&nbsp;&nbsp;&nbsp;Add Call Result  </legend>
	<table cellpadding="4px;" border=0 cellspacing="3">
		<tr>
			<td class="text_caption">* Call Result ID</td>
			<td colspan="1"><?php echo form()->input('CallReasonCode','input_text long');?></td>
			<td class="text_caption">* Contacted</td>
			<td><?php echo form()->combo('CallReasonContactedFlag','select long',$Event);?></td>
		</tr>
		<tr>
			<td class="text_caption">* Call Result Name</td>
			<td colspan="1"> <?php echo form()->input('CallReasonDesc','input_text long');?> </td>
			<td class="text_caption">* Call Result Level</td>
			<td><?php echo form()->combo('CallReasonLevel','select long', $Orders);?></td>
		</tr>
		<tr>
			<td class="text_caption">* Call Result Category</td>
			<td><?php echo form()->combo('CallReasonCategoryId','select long',$CallCategoryId);?></td>
			<td class="text_caption">* Not Interest</td>
			<td><?php echo form()->combo('CallReasonNoNeed','select long',$Event);?></td>
		</tr>
		<tr>
			<td class="text_caption">* Open Closing form</td>
			<td><?php echo form()->combo('CallReasonEvent','select long',$Event);?></td>
			<td class="text_caption">* Order</td>
			<td><?php echo form()->combo('CallReasonOrder','select long',$Orders);?></td>
		</tr>
		<tr>
			<td class="text_caption">* CallBack Reminder</td>
			<td><?php echo form()->combo('CallReasonLater','select long',$Event);?></td>
			<td class="text_caption">Status</td>
			<td><?php echo form()->combo('CallReasonContactedFlag','select long', array('1'=>'Active','0'=>'Not Active') );?></td>
		</tr>
		<tr>
			<td class="text_caption">&nbsp;</td>
			<td>
				<input type="button" class="save button" onclick="Ext.DOM.SaveResult();" value="Save">
				<input type="button" class="close button" onclick="Ext.Cmp('span_top_nav').setText('');" value="Close">	</td>
			<td class="text_caption">&nbsp;</td>
			<td class="text_caption"></td>
		</tr>
	</table>
</fieldset>	
</div>
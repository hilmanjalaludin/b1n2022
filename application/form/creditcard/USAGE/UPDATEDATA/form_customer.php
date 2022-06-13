<?php  $row = DetailDataUpdate();  ?>
<form name="frmDataCustomer">
<?php echo form()->hidden('DM_Id',null, $row->field('DM_Id'));?>
<table class="paperworktable">
	
	<tr> 
		<td class="ui-data-cell-1"><?php echo lang('DM_Custno');?></td>
		<td class="ui-data-cell-2" colspan="3"><?php echo form()->input('DM_Custno', 'input_text tolong ui-disabled ui-normal', 
			$row->field('DM_Custno','SetCapital'));?> </td>
	</tr>
	
	<tr> 
		<td class="ui-data-cell-1"><?php echo lang('DM_FirstName');?></td>
		<td class="ui-data-cell-2" colspan="3"><?php echo form()->input('DM_FirstName', 'input_text tolong  ui-normal', 
			$row->field('DM_FirstName','SetCapital'));?> </td>
	</tr>
	
	
	<tr> 
		<td class="ui-data-cell-1"><?php echo lang('DM_Dob');?></td>
		<td class="ui-data-cell-2" colspan="3"><?php echo form()->input('DM_Dob', 'input_text tolong  ui-normal', 
			$row->field('DM_Dob','SetDate'));?> </td>
	</tr>
	
	<tr> 
		<td class="ui-data-cell-1"><?php echo lang('DM_MotherName');?></td>
		<td class="ui-data-cell-2" colspan="3"><?php echo form()->input('DM_MotherName', 'input_text tolong  ui-normal', 
			$row->field('DM_MotherName','SetCapital'));?> </td>
	</tr>
	
	<tr> 
		<td class="ui-data-cell-1"><?php echo lang('DM_ZipCode');?></td>
		<td class="ui-data-cell-2" colspan="3"><?php echo form()->input('DM_ZipCode', 'input_text tolong  ui-normal', 
			$row->field('DM_ZipCode'));?> </td>
	</tr>
	
	<tr> 
		<td class="ui-data-cell-1"><?php echo lang('DM_OfficeZipCode');?></td>
		<td class="ui-data-cell-2" colspan="3"><?php echo form()->input('CV_Data_LzipCode', 'input_text tolong  ui-normal', 
			$row->field('DM_OfficeZipCode'));?> </td>
	</tr>
	
	<tr> 
		<td class="ui-data-cell-1"><?php echo lang('DM_HomePhoneNum');?></td>
		<td class="ui-data-cell-2" colspan="3"><?php echo form()->input('DM_HomePhoneNum', 'input_text tolong  ui-normal', 
			$row->field('DM_HomePhoneNum','SetCapital'));?> </td>
	</tr>
	
	<tr> 
		<td class="ui-data-cell-1"><?php echo lang('DM_MobilePhoneNum');?></td>
		<td class="ui-data-cell-2" colspan="3"><?php echo form()->input('DM_MobilePhoneNum', 'input_text tolong  ui-normal', 
			$row->field('DM_MobilePhoneNum','SetCapital'));?> </td>
	</tr>
	
	<tr> 
		<td class="ui-data-cell-1"><?php echo lang('DM_OtherPhoneNum');?></td>
		<td class="ui-data-cell-2" colspan="3"><?php echo form()->input('DM_OtherPhoneNum', 'input_text tolong  ui-normal', 
			$row->field('DM_OtherPhoneNum','SetCapital'));?> </td>
	</tr>
	 
</table>
</form>
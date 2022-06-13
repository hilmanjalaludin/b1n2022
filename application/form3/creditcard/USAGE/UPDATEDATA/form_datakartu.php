<?php  $row = DetailDataUpdate();  ?>
<form name="frmDataKartu">
	<?php echo form()->hidden('CV_Data_Id',null, $row->field('CV_Data_Id'));?>
 <table class="paperworktable">
		
	<tr> 
		<td class="ui-data-cell-1"><?php echo lang('Fix ID');?></td>
		<td class="ui-data-cell-2" colspan="3"><?php echo form()->input('CV_Data_FixID', 'input_text tolong ui-disabled ui-normal', 
			$row->field('CV_Data_FixID','SetCapital'));?> </td>
	</tr>
	
	<tr> 
		<td class="ui-data-cell-1"><?php echo lang('Jenis Kartu');?></td>
		<td class="ui-data-cell-2" colspan="3"><?php echo form()->input('CV_Data_CardType', 'input_text tolong  ui-normal', 
			$row->field('CV_Data_CardType','SetCapital'));?> </td>
	</tr>
	
	<tr> 
		<td class="ui-data-cell-1"><?php echo lang('Open Date');?></td>
		<td class="ui-data-cell-2" colspan="3">
		<?php echo form()->input('CV_Data_OpenDate', 'input_text tolong  ui-normal', 
			$row->field('CV_Data_OpenDate', 'SetDate'));?> </td>
	</tr>
	
	<tr> 
		<td class="ui-data-cell-1"><?php echo lang('Expired Date');?></td>
		<td class="ui-data-cell-2" colspan="3"><?php echo form()->input('CV_Data_CcExpired', 'input_text tolong  ui-normal', 
			$row->field('CV_Data_CcExpired'));?> </td>
	</tr>
	
	<tr> 
		<td class="ui-data-cell-1"><?php echo lang('Kredit Limit');?></td>
		<td class="ui-data-cell-2" colspan="3"><?php echo form()->input('CV_Data_Crelimit', 'input_text tolong  ui-normal', 
			$row->field('CV_Data_Crelimit','SetCurrency'));?> </td>
	</tr>
	

	<tr> 
		<td class="ui-data-cell-1"><?php echo lang('Membal');?></td>
		<td class="ui-data-cell-2" colspan="3"><?php echo form()->input('CV_Data_Membal', 'input_text tolong  ui-normal', 
			$row->field('CV_Data_Membal','SetCurrency'));?> </td>
	</tr>
	
	
	
	<tr> 
		<td class="ui-data-cell-1"><?php echo lang('Available XD');?></td>
		<td class="ui-data-cell-2" colspan="3"><?php echo form()->input('CV_Data_AvailXD', 'input_text tolong  ui-normal', 
			$row->field('CV_Data_AvailXD','SetCurrency'));?> </td>
	</tr>
	
	<tr> 
		<td class="ui-data-cell-1"><?php echo lang('Available SS');?></td>
		<td class="ui-data-cell-2" colspan="3"><?php echo form()->input('CV_Data_AvailSS', 'input_text tolong  ui-normal', 
			$row->field('CV_Data_AvailSS','SetCurrency'));?> </td>
	</tr>
	
	<tr> 
		<td class="ui-data-cell-1"><?php echo lang('Penawaran');?></td>
		<td class="ui-data-cell-2" colspan="3">
			<?php echo form()->input('CV_Data_Penawaran', 'input_text tolong  ui-normal', $row->field('CV_Data_Penawaran'));?> </td>
	</tr>
	
	
	<tr> 
		<td class="ui-data-cell-1"><?php echo lang('Cycle');?></td>
		<td class="ui-data-cell-2" colspan="3"><?php echo form()->input('CV_Data_Cycle', 'input_text tolong  ui-normal', 
													 $row->field(CV_Data_Cycle));?> </td>
	</tr>
	
	<tr> 
		<td class="ui-data-cell-1"><?php echo lang('Block');?></td>
		<td class="ui-data-cell-2" colspan="3"><?php echo form()->input('CV_Data_Block', 'input_text tolong  ui-normal', 
													 $row->field('CV_Data_Block'));?> </td>
	</tr>
	
	
	<tr> 
		<td class="ui-data-cell-1" colspan='4'>&nbsp;</td>
	</tr> 
</table>
</form>
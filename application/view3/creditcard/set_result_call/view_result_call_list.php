<?php ?>

<table width="100%" class="custom-grid" cellspacing="0">
<thead>
	<tr height="20"> 
		<th nowrap class="custom-grid th-first" width="5%" align="center">&nbsp;<a href="javascript:void(0);" onclick="Ext.Cmp('chk_result').setChecked();">#</a></th>	
		<th nowrap class="custom-grid th-middle">&nbsp;No</th>	
		<th nowrap class="custom-grid th-middle" align="left"><span class="header_order" id ="a.CallReasonCode" onclick="Ext.EQuery.orderBy(this.id);">Result ID </b></span></th>        
        <th nowrap class="custom-grid th-middle" align="left"><span class="header_order" id ="a.CallReasonDesc" onclick="Ext.EQuery.orderBy(this.id);">Result Name </b></span></th>
		<th nowrap class="custom-grid th-middle" align="left"><span class="header_order" id ="a.CallReasonCategoryId" onclick="Ext.EQuery.orderBy(this.id);">Result Category</b></span></th>
		<th nowrap class="custom-grid th-middle" align="left"><span class="header_order" id ="a.CallReasonLevel" onclick="Ext.EQuery.orderBy(this.id);">Level</span></th>
		<th nowrap class="custom-grid th-middle" align="left"><span class="header_order" id ="a.CallReasonContactedFlag" onclick="Ext.EQuery.orderBy(this.id);">Is Contacted</span></th>
		<th align="center" class="custom-grid th-middle"><span class="header_order" id ="a.CallReasonEvent" onclick="Ext.EQuery.orderBy(this.id);">Apply as Trigger Form</span></th>
		<th class="custom-grid th-middle">&nbsp;<span class="header_order" id ="a.CallReasonLater" onclick="Ext.EQuery.orderBy(this.id);">Apply as Call Later</span></th>
		<th class="custom-grid th-middle">&nbsp;<span class="header_order" id ="a.CallReasonNoNeed" onclick="Ext.EQuery.orderBy(this.id);">Not Interested</span></th>
		<th class="custom-grid th-middle">&nbsp;<span class="header_order" id ="a.CallReasonStatusFlag" onclick="Ext.EQuery.orderBy(this.id);">Result Status</span></th>
		<th class="custom-grid th-lasted"><span class="header_order" id ="a.CallReasonOrder" onclick="Ext.EQuery.orderBy(this.id);">&nbsp;Order</a></th>
	</tr>
</thead>	
<tbody>
<?php
 $no  = $num;
 foreach( $page -> result_assoc() as $rows ) { 
	$color = ($no%2!=0?'#FFFEEE':'#FFFFFF');
?>	
			<tr CLASS="onselect" bgcolor="<?php echo $color;?>">
				<td class="content-first"><input type="checkbox" value="<?php echo $rows['CallReasonId']; ?>" name="chk_result" id="chk_result"></td>
				<td class="content-middle"><?php echo $no ?></td>
				<td class="content-middle"><?php echo $rows['CallReasonCode']; ?></td>
				<td class="content-middle"><?php echo $rows['CallReasonDesc']; ?></td>
				<td class="content-middle"><?php echo $rows['CallReasonCategoryCode']; ?></td>
				<td class="content-middle"><?php echo $rows['CallReasonLevel']; ?></td>
				<td align="center"  class="content-middle"><?php echo ($rows['CallReasonContactedFlag']?'Yes':'No'); ?></td>
				<td align="center" class="content-middle"><?php echo $rows['triger'];?></td>
				<td align="center" class="content-middle"><?php echo $rows['calllater'];?></td>
				<td align="center" class="content-middle"><?php echo $rows['notinterest'];?></td>
				<td align="center" class="content-middle"><?php echo $rows['statusResult'];?></td>
				<td align="center" class="content-lasted"><?php echo $rows['CallReasonOrder'];?></td>
				
				
			</tr>	
</tbody>
	<?php
		$no++;
		};
	?>
</table>




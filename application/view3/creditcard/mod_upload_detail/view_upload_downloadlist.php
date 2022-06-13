
<?php 
// echo "DRU";
// echo "<pre>";
// print_r($page);
// echo "</pre>";

// ------------------------------------END VIEW ---------------------------------
?>

<table width="100%" class="custom-grid" cellspacing="0" border=1>
<thead>
	<tr height="20">
		<th nowrap class="custom-grid th-middle" align="center"><b style='color:#608ba9;'>Data ID</b></span></th>
		<th nowrap class="custom-grid th-middle" align="center">&nbsp;<b style='color:#608ba9;'>Data Recsource</b></span></th>
		<th nowrap class="custom-grid th-middle" align="center">&nbsp;<b style='color:#608ba9;'>Total Row</b></span></th>
		<th nowrap class="custom-grid th-middle" align="center">&nbsp;<b style='color:#608ba9;'>Total Success</b></span></th>
		<th nowrap class="custom-grid th-middle" align="center">&nbsp;<b style='color:#608ba9;'>Total Failed</b></span></th>
		<th nowrap class="custom-grid th-middle" align="center">&nbsp;<b style='color:#608ba9;'>Total Duplicate</b></span></th>
		<th nowrap class="custom-grid th-middle" align="center">&nbsp;<b style='color:#608ba9;'>Date Time</b></span></th>
		<th nowrap class="custom-grid th-middle" align="center">&nbsp;<b style='color:#608ba9;'>File Name</b></span></th>
		<th nowrap class="custom-grid th-middle" align="center">&nbsp;<b style='color:#608ba9;'>Data Type</b></span></th>
		<th nowrap class="custom-grid th-lasted" align="center">&nbsp;<b style='color:#608ba9;'>User ID</b></span></th>
		<th nowrap class="custom-grid th-lasted" align="center">&nbsp;<b style='color:#608ba9;'>Status</b></span></th>
	</tr>
</thead>	
<tbody>
<?php
$no = $num;
foreach( $page as $rows )
{ 
  $color = ($no%2!=0?'#FFFEEE':'#FFFFFF');
  
  // file information status 
  
  $_full_name = basename($rows['FTP_UploadFilename']);
  $_full_path = str_replace('system/', APPPATH, BASEPATH).'temp/'. $_full_name;
	
  // status 
 
  $file_existing = ( file_exists($_full_path) ? 'files are still available': 'files have been deleted');  	
  
 ?>
	<tr class="onselect">
		<td align="left" class="content-first"><b style="color:green;"><?php echo $rows['UPL_DataID'];?></td>
		<td align="left" class="content-middle" style="mso-number-format:'\@';"><b style="color:green;"><?php echo $rows['UPL_Recsource'];?></td>
		<td align="right" class="content-middle right"><?php echo ($rows['UPL_UploadRows'] ?$rows['UPL_UploadRows']:0); ?></td>
		<td align="right" class="content-middle right"><?php echo ($rows['UPL_UploadSuccess']?$rows['UPL_UploadSuccess']:0); ?></td>
		<td align="right" class="content-middle right"><?php echo ($rows['UPL_UploadFailed']?$rows['UPL_UploadFailed']:0); ?></td>
		<td align="right" class="content-middle right"><?php echo ($rows['UPL_UploadDuplicate']?$rows['UPL_UploadDuplicate']:0); ?></td>
		<td align="right" class="content-middle" nowrap><?php echo SetDateTime($rows['UPL_UploadDateTs']); ?></td>
		<td align="left" class="content-middle"><?php echo basename($rows['UPL_UploadFilename']); ?></td>
		<td align="left" class="content-middle"><?php echo $rows['UPL_UploadType']; ?></td>
		<td align="left" class="content-middle"><?php echo $rows['UPL_UploadBy']; ?></td>
		<td align="left" class="content-middle"><?php echo ($rows['UPL_Flags']?'Active':'Not Active'); ?></td>
	</tr>	
			
</tbody><?php
	$no++;
};
?>
</table>
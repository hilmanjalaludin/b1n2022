<!DOCTYPE html>
<html>
<head>
	<style>
		html {
			font-family: Trebuchet MS,Arial,sans-serif;
			font-size: 12px;
		}
		table, th, td {
			border: 1px solid black;
			border-collapse: collapse;
		}
		th, td {
			padding: 5px;
		}
		.kanan {
			text-align: right;
		}
		.tengah {
			text-align: center;
		}
	</style>
<title>Tabulasi Report</title>
</head>
<body>
	<h4>Campaign Name: <?php 
		foreach ($CampaignName as  $value) {
			echo $value['CampaignDesc']."&nbsp;";
		}
	//echo $CampaignName['CampaignDesc']; ?>
	</h4>
	 <?php
	// error_reporting(E_ALL);
	// ini_set('display_errors', 1);	 
	?>
	<h4>Interval: <?php echo $_REQUEST['start_date']; ?> s/d <?php echo $_REQUEST['end_date']; ?></h4>
	<table>
		<thead>
			<tr>
				<th>No.</th>
				<th>Campaign Name</th>
				<th>Customer Number</th>
				<th>Fix ID</th>
				<th>Jenis Kartu</th>
				<th>Agent Name</th>
				<th>Status FIX ID</th>
				<th>Status Call</th>
				<th>Deskripsi / Remark</th>				
			</tr>			
		</thead>
		<tbody>
		<?php
			// echo "<pre>";
			// var_dump($DataTabulasi);
			$no = 1;
			foreach ($DataTabulasi as  $value) {
				// echo "<pre>";
				// print_r($value);			
				?>
			<tr>
				<td class="kiri"><?php echo $no ++; ?></td>
				
				<td class="kiri" style="mso-number-format:\@;"><?php echo ($value['CampaignCode']); ?></td>
				<td class="kiri" style="mso-number-format:\@;"><?php echo ($value['CV_Data_Custno']); ?></td>
				<td class="kiri" style="mso-number-format:\@;"><?php echo ($value['CV_Data_FixID']); ?></td>
				<td class="kiri"><?php echo ($value['CV_Data_CardType']); ?></td>
				<td class="kiri"><?php echo ($value['id']); ?></td>
				<td class="kiri"><?php echo ($value['CV_Data_Status']) != '' ?  ($value['CV_Data_Status']) : 'New'; ?></td>
				<td class="kiri"><?php echo ($value['CallReasonDesc']) != '' ? ($value['CallReasonDesc']) :'-'; ?></td>				
				<td class="kiri"><?php echo ($value['remark']) != '' ? ($value['remark']) :'-'; ?></td>				
			</tr>	
		<?php
				// $no++;
			}
			?>		
			</tbody>
	</table>

</body>
</html>
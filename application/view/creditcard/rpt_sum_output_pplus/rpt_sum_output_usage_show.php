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
<title>Report Perisai Plus</title>
</head>
<body>
	<h4>Supervisor Name: <?php echo ($Supervisor['UserId']?$Supervisor['UserId']:'All'); ?></h4>
	<h4>Interval: <?php echo $_REQUEST['start_date']; ?> s/d <?php echo $_REQUEST['end_date']; ?></h4>
	<table>
		<thead>
			<tr>
				<th rowspan=1>No.</th>
				<th rowspan=1>Fix Id</th>
				<th rowspan=1>Nama CH</th>
				<th rowspan=1>Tanggal Incoming</th>
				<th rowspan=1>Agent</th>
				<th rowspan=1>SPV</th>
				<th rowspan=1>QA</th>
			</tr>
		</thead>
		<tbody>
		<?php
			// print_r($QA);
			$no = 1;
			if(!empty($Data)) {
				foreach($Data as $key => $rows) {
		?>
			<tr>
				<td class="tengah"><?php echo $no; ?></td>
				<td><?php echo $rows['FixId']; ?></td>
				<td><?php echo $rows['Nama CH']; ?></td>
				<td><?php echo $rows['Tanggal Incoming']; ?></td>
				<td><?php echo $Agent[strtoupper($rows['TX_Usg_SellerKode'])]['id']; ?></td>
				<td><?php echo $rows['TX_Usg_SpvKode']; ?></td>
				<td><?php echo $QA[$rows['DM_QualityUserId']]; ?></td>
				
			</tr>
		<?php
					$no++;
				}
			}
		?>
		</tbody>
		<tfoot>
			<tr>
			</tr>
		</tfoot>
	</table>

</body>
</html>
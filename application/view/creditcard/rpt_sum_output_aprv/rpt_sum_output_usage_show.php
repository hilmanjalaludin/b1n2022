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
<title>Summary Output Usage Report only APRV</title>
</head>
<body>
	<h4>Supervisor Name: <?php echo $Supervisor['UserId']; ?></h4>
	<h4>Interval: <?php echo $_REQUEST['start_date']; ?> s/d <?php echo $_REQUEST['end_date']; ?></h4>
	<table>
		<thead>
			<tr>
				<th rowspan=2>No.</th>
				<th rowspan=2>Agent</th>
				<th colspan=2>Xtradana</th>
			</tr>
			<tr>
				<th>Jumlah</th>
				<th>Amount</th>
			</tr>
		</thead>
		<tbody>
		<?php
			$no = 1;
			// echo "<pre>";
				// print_r($Agent);
			// echo "</pre>";
			if(!empty($Data)) {
				foreach($Data as $array => $rows) {
					
		?>
			<tr>
				<td class="tengah"><?php echo $no; ?></td>
				<td><?php echo $rows['TX_Usg_SellerKode']." - ".$rows['full_name']; ?></td>
				<td class="kanan"><?php echo ($rows['TotalUsage']?$rows['TotalUsage']:0); ?></td>
				<td class="kanan"><?php echo ($rows['Amount']?$rows['Amount']:0); ?></td>
			</tr>
		<?php
					$no++;
					
					$sumJumlah		+= $rows['TotalUsage'];
					$sumAmount		+= $rows['Amount'];
				}
			}
		?>
		</tbody>
		<tfoot>
			<tr>
				<th colspan=2>Jumlah</th>
				<th class="kanan"><?php echo ($sumJumlah); ?></th>
				<th class="kanan"><?php echo ($sumAmount); ?></th>
			</tr>
		</tfoot>
	</table>

</body>
</html>
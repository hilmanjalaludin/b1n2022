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
<title>Summary Output Usage Report</title>
</head>
<body>
	<h4>Interval: <?php echo $_REQUEST['start_date']; ?> s/d <?php echo $_REQUEST['end_date']; ?></h4>
	<table>
		<thead>
			<tr>
				<th rowspan=2>No.</th>
				<th rowspan=2>Supervisor</th>
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
			// echo '<pre>';
			// print_r($Data);
			if(!empty($Agent)) {
				foreach($Agent as $array => $rows) {
					//  echo "<pre>";
					//  print_r($Data[$rows['UserId']]['TotalBalcon']);
					//  print_r($Data[$rows['UserId']]['Amount']);
					//  print_r($Data);
					
					//  print_r($Data$rows['UserId']['Amount']);
					// echo "</pre>";
					// die;
		?>
			<tr>
				<td class="tengah"><?php echo $no; ?></td>
				<td><?php echo $rows['SpvCode']; ?></td>
				<td class="kanan"><?php echo ($Data[$rows['UserId']]['TotalBalcon']?$Data[$rows['UserId']]['TotalBalcon']:0); ?></td>
				<td class="kanan"><?php echo number_format($Data[$rows['UserId']]['Amount']?$Data[$rows['UserId']]['Amount']:0); ?></td>
			</tr>
		<?php
					$no++;
					
					$sumJumlah		+= $Data[$array]['TotalBalcon'];
					$sumAmount		+= $Data[$array]['Amount'];
				}
			}
		?>
		</tbody>
		<tfoot>
			<tr>
				<th colspan=2>Jumlah</th>
				<th class="kanan"><?php echo ($sumJumlah); ?></th>
				<th class="kanan"><?php echo number_format($sumAmount); ?></th>
			</tr>
		</tfoot>
	</table>

</body>
</html>
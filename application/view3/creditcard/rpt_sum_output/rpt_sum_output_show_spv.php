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
<title>Summary Output Report</title>
</head>
<body>
	<h4>Interval: <?php echo $_REQUEST['start_date']; ?> s/d <?php echo $_REQUEST['end_date']; ?></h4>
	<table>
		<thead>
			<tr>
				<th rowspan=2>No.</th>
				<th rowspan=2>Supervisor</th>
				<th colspan=3>NTB</th>
				<th rowspan=2>Xsell</th>
				<th rowspan=2>Addon</th>
				<th rowspan=2>Tapenas</th>
				<th rowspan=2>Balcon</th>
				<th rowspan=2>Total</th>
			</tr>
			<tr>
				<th>NTB</th>
				<th>Dual</th>
				<th>Addon</th>
			</tr>
		</thead>
		<tbody>
		<?php
			$no = 1;
			
			if(!empty($Agent)) {
				foreach($Agent as $data => $rows) {
					$Total =
							(
								$DataNTB[$data]['TotalNTB'] + 
								$DataDual[$data]['TotalDual'] + 
								$DataNTBAddOn[$data]['TotalAddOnNTB'] + 
								$DataXsell[$data]['TotalXsell'] + 
								$DataAddOn[$data]['TotalAddOn'] +
								$DataTapenas[$data]['TotalTapenas'] +
								$DataBalcon[$data]['TotalBalcon'] 
							);
							
		?>
			<tr>
				<td class="tengah"><?php echo $no; ?></td>
				<td><?php echo $rows['SpvCode']; ?></td>
				<td class="kanan"><?php echo ($DataNTB[$data]['TotalNTB']?$DataNTB[$data]['TotalNTB']:0); ?></td>
				<td class="kanan"><?php echo ($DataDual[$data]['TotalDual']?$DataDual[$data]['TotalDual']:0); ?></td>
				<td class="kanan"><?php echo ($DataNTBAddOn[$data]['TotalAddOnNTB']?$DataNTBAddOn[$data]['TotalAddOnNTB']:0); ?></td>
				<td class="kanan"><?php echo ($DataXsell[$data]['TotalXsell']?$DataXsell[$data]['TotalXsell']:0); ?></td>
				<td class="kanan"><?php echo ($DataAddOn[$data]['TotalAddOn']?$DataAddOn[$data]['TotalAddOn']:0); ?></td>
				<td class="kanan"><?php echo ($Datatapenas[$data]['TotalTapenas']?$DataTapenas[$data]['TotalTapenas']:0); ?></td>
				<td class="kanan"><?php echo ($DataBalcon[$data]['TotalBalcon']?$DataBalcon[$data]['TotalBalcon']:0); ?></td>
				<td class="kanan"><?php echo ($Total?$Total:0); ?></td>
			</tr>
		<?php
					$no++;
					
					$sumNTB			+= $DataNTB[$data]['TotalNTB'];
					$sumDual		+= $DataDual[$data]['TotalDual'];
					$sumAddonNTB	+= $DataNTBAddOn[$data]['TotalAddOnNTB'];
					$sumXsell		+= $DataXsell[$data]['TotalXsell'];
					$sumAddOn		+= $DataAddOn[$data]['TotalAddOn'];
					$sumTapenas		+= $DataTapenas[$data]['TotalTapenas'];
					$sumBalcon		+= $DataBalcon[$data]['TotalBalcon'];
					$sumTotal		+= $Total;
				}
			}
		?>
		</tbody>
		<tfoot>
			<tr>
				<th colspan=2>Jumlah</th>
				<th class="kanan"><?php echo ($sumNTB); ?></th>
				<th class="kanan"><?php echo ($sumDual); ?></th>
				<th class="kanan"><?php echo ($sumAddonNTB); ?></th>
				<th class="kanan"><?php echo ($sumXsell); ?></th>
				<th class="kanan"><?php echo ($sumAddOn); ?></th>
				<th class="kanan"><?php echo ($sumTapenas); ?></th>
				<th class="kanan"><?php echo ($sumBalcon); ?></th>
				<th class="kanan"><?php echo ($sumTotal); ?></th>
			</tr>
		</tfoot>
	</table>

</body>
</html>
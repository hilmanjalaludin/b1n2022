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
	<h4>Supervisor Name: <?php echo $Supervisor['UserId']; ?></h4>
	<h4>Interval: <?php echo $_REQUEST['start_date']; ?> s/d <?php echo $_REQUEST['end_date']; ?></h4>
	<table>
		<thead>
			<tr>
				<th rowspan = 2>No.</th>
				<th rowspan = 2>Agent Name</th>
				<th colspan = 2>Pray</th>
				<th colspan = 2>Rest</th>
				<th colspan = 2>Toilet</th>
				<th colspan = 2>Paper Work</th>
			</tr>
			<tr>
				<th>Number</th>
				<th>Block</th>
				<th>Number</th>
				<th>Block</th>
				<th>Number</th>
				<th>Block</th>
				<th>Number</th>
				<th>Block</th>
			</tr>
		</thead>
		<tbody>
		<?php
			$no = 1;
			
			if(!empty($Agent)) {
				foreach($Agent as $data => $rows) {
				// echo "<pre>";
				// print_r($AUX);
				// echo "<pre>";
					$nPray		= ($AUX[$data]['tot_sholat'] ? $AUX[$data]['tot_sholat'] : 0);
					$nRest		= ($AUX[$data]['tot_istirahat'] ? $AUX[$data]['tot_istirahat'] : 0);
					$nToilet	= ($AUX[$data]['tot_toilet'] ? $AUX[$data]['tot_toilet'] : 0);
					$nPaperwork	= ($AUX[$data]['tot_paperwork'] ? $AUX[$data]['tot_paperwork'] : 0);
					
					$bPray		= ($Block[$data]['block_sholat'] ? $Block[$data]['block_sholat'] : 0);
					$bRest		= ($Block[$data]['block_istirahat'] ? $Block[$data]['block_istirahat'] : 0);
					$bToilet	= ($Block[$data]['block_toilet'] ? $Block[$data]['block_toilet'] : 0);
					$bPaperwork	= ($Block[$data]['block_paperwork'] ? $Block[$data]['block_paperwork'] : 0);
		?>
			<tr>
				<td class="tengah"><?php echo $no; ?></td>
				<td><?php echo $rows['AgentCode']." - ".$rows['AgentName']; ?></td>
				<td class="kanan"><?php echo ($nPray); ?></td>
				<td class="kanan"><?php echo ($bPray); ?></td>
				<td class="kanan"><?php echo ($nRest); ?></td>
				<td class="kanan"><?php echo ($bRest); ?></td>
				<td class="kanan"><?php echo ($nToilet); ?></td>
				<td class="kanan"><?php echo ($bToilet); ?></td>
				<td class="kanan"><?php echo ($nPaperwork); ?></td>
				<td class="kanan"><?php echo ($bPaperwork); ?></td>
			</tr>
		<?php
					$no++;
					
					$sumnPray		+= $nPray;
					$sumbPray		+= $bPray;
					$sumnRest		+= $nRest;
					$sumbRest		+= $bRest;
					$sumnToilet		+= $nToilet;
					$sumbToilet		+= $bToilet;
					$sumnPaperwork	+= $nPaperwork;
					$sumbPaperwork	+= $bPaperwork;
				}
			}
		?>
		</tbody>
		<tfoot>
			<tr>
				<th colspan=2>Jumlah</th>
				<th class="kanan"><?php echo ($sumnPray); ?></th>
				<th class="kanan"><?php echo ($sumbPray); ?></th>
				<th class="kanan"><?php echo ($sumnRest); ?></th>
				<th class="kanan"><?php echo ($sumbRest); ?></th>
				<th class="kanan"><?php echo ($sumnToilet); ?></th>
				<th class="kanan"><?php echo ($sumbToilet); ?></th>
				<th class="kanan"><?php echo ($sumnPaperwork); ?></th>
				<th class="kanan"><?php echo ($sumbPaperwork); ?></th>
			</tr>
		</tfoot>
	</table>

</body>
</html>
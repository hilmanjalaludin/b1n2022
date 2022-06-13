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
<title>Tabulasi Kurir Report</title>
</head>
<body>
	<h4>Campaign Name: <?php echo $CampaignName['CampaignDesc']; ?></h4>
	<h4>Interval: <?php echo $_REQUEST['start_date']; ?> s/d <?php echo $_REQUEST['end_date']; ?></h4>
	<table>
		<thead>
			<tr>
				<th>No.</th>
				<th>Kode</th>
				<th>Nama</th>
				<th>Distribute Data</th>
				<th colspan=4>Distribusi Data</th>
				<th colspan=4>Sukses Pick Up</th>
				<th colspan=4>Follow Up</th>
				<th>Decline Kurir</th>
				<th>Nobody Pick Up</th>
				<th>Not Contact</th>
				<th>Total</th>
			</tr>
			<tr>
				<th>No.</th>
				<th>Kode</th>
				<th>Nama</th>
				<th>Distribute Data</th>
				<th>Total Distribusi Data</th>
				<th>Jakarta</th>
				<th>Luar Kota</th>
				<th>Non Coverage Area</th>
				<th>Total Sukses Pick Up</th>
				<th>Jakarta</th>
				<th>Luar Kota</th>
				<th>Non Coverage Area</th>
				<th>Total Follow Up</th>
				<th>Jakarta</th>
				<th>Luar Kota</th>
				<th>Non Coverage Area</th>
				<th>Decline Kurir</th>
				<th>Nobody Pick Up</th>
				<th>Not Contact</th>
				<th>Total</th>
			</tr>
		</thead>
		<tbody>
		
		</tbody>
		<tfoot>
			
		</tfoot>
	</table>

</body>
</html>
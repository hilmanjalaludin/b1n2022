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
		.th-blue {
			background: blue;
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
				<th rowspan=2>No.</th>
				<th rowspan=2>Agent</th>
				<th rowspan=2>Distribute Data</th>
				<th rowspan=2>New Data</th>
				<th colspan="6">Sukses Call</th>
				<th colspan=4>Follow UP</th>
				<th colspan=19>Decline</th>
				<th rowspan=2>Not Contact</th>
				<th rowspan=2>Total</th>
			</tr>
			<tr>
				<th>total sukses call </th>
				<th>Sudah Ke ATM</th>
				<th>Sudah kirim WA</th>
				<th>Janji ke ATM</th>
				<th>Sudah kirim Via Email/EFORM</th>
				<th>Sudah Di ambil kurir</th>
				<th>total FOLW</th>
				<th>Appointment</th>
				<th>susah dihubungi</th>
				<th>nada sibuk</th>
				<th>Total Decline</th>
				<th>Tolak Di Awal</th>
				<th>Sudah Ada KK BNI</th>
				<th>CH Langsung kirim ke pusat</th>
				<th>CH Langsung kirim ke cabang</th>
				<th>Tidak mau di ambil kurir </th>
				<th>Dokumen sudah diambil petugas lain </th>
				<th>Sudah Ada KK Bank Lain</th>
				<th>Tidak Setuju Limit</th>
				<th>Keluarga Tidak Setuju</th>
				<th>Tidak Ada Penghasilan</th>
				<th>Tidak Setuju Iuran Tahunan</th>
				<th>Telp Tidak Di angkat</th>
				<th>Non Coverage Area</th>
				<th>Sistem</th>
				<th>Tidak Ada NPWP</th>
				<th>Promo Tidak Menarik</th>
				<th>Fitur Tidak Menarik</th>
				<th>Regulasi/kebijakan</th>
			</tr>
		</thead>
		<tbody>
			<?php 
                $no = 1;
                if(!empty($Data)) {
                	foreach($Data as $key => $value) {
                		$NewData = ($value['jmlDstribusi'] - ($value['TotalSukses'] + $value['TotalDECL'] + $value['TotalFolw'] + $value['NotContacted']) );
                		$Total   = ($NewData + $value['TotalSukses'] + $value['TotalFolw'] + $value['TotalDECL'] + $value['NotContacted']);
			?>
			<tr>
				<td><?php echo  $no; ?></td>
				<td><?php echo ($value['AgentCode']) ? $value['AgentCode'] : 0;  ?></td>
				<td><?php echo ($value['jmlDstribusi']) ? $value['jmlDstribusi'] : 0 ; ?></td>
				<td><?php echo ($NewData) ? $NewData : 0 ?></td>
				<td><?php echo ($value['TotalSukses']) ? $value['TotalSukses'] : 0; ?></td>
				<td><?php echo ($value['sudah_atm']) ? $value['sudah_atm'] : 0 ?></td>
				<td><?php echo $value['SudahKirimWa'] ?></td>
				<td><?php echo $value['JanjiAtm'] ?></td>
				<td><?php echo $value['SudahEmail'] ?></td>
				<td><?php echo $value['SudahAmbilKurir'] ?></td>
				<td><?php echo $value['TotalFolw']; ?></td>
				<td><?php echo $value['Apointment'] ?></td>
				<td><?php echo $value['SusahDihubungi'] ?></td>
				<td><?php echo $value['NadaSibuk'] ?></td>
				<td><?php echo $value['TotalDECL']; ?></td>
				<td><?php echo $value['TolakDiawal'] ?></td>
				<td><?php echo $value['SudahAdaKKbNi'] ?></td>
				<td><?php echo $value['ChLangsungKePusat'] ?></td>
				<td><?php echo $value['ChLangsungKeCabang'] ?></td>
				<td><?php echo $value['TidakMauDiambilKurir'] ?></td>
				<td><?php echo $value['DokumenSudahDiambil'] ?></td>
				<td><?php echo $value['SudahAdaKKbankLain'] ?></td>
				<td><?php echo $value['TidakSetujuLimit'] ?></td>
				<td><?php echo $value['KeluargaTidakSetuju'] ?></td>
				<td><?php echo $value['TidakAdaPenghasilan'] ?></td>
				<td><?php echo $value['TidakSetujuIuranTahunan'] ?></td>
				<td><?php echo $value['TlpTidakDagkat'] ?></td>
				<td><?php echo $value['NonCoverage'] ?></td>
				<td><?php echo $value['Dbs'] ?></td>
				<td><?php echo $value['TidakAdaNpwp'] ?></td>
				<td><?php echo $value['PromoTidakMenarik'] ?></td>
				<td><?php echo $value['FiturTidakMenarik'] ?></td>
				<td><?php echo $value['Regulasi'] ?></td>
				<td><?php echo $value['NotContacted'] ?></td>
				<td><?php echo $Total; ?></td>
			</tr>
			<?php 
				$no++; 
	                $SumDistributeData += $value['jmlDstribusi'];
	                $SumNewData 	   += $NewData;
	                $SumSukesCall	   += $value['TotalSukses'];
	                $sumSudahKeAtm     += $value['sudah_atm'];
	                $SumSudahKirimWa   += $value['SudahKirimWa'];
	                $SumJanjiAtm 	   += $value['JanjiAtm'];
	                $SumSudahEmail     += $value['SudahEmail'];
	                $SumAmbilKurir     += $value['SudahAmbilKurir'];
	                $SumtotalFollow	   += $value['TotalFolw'];
	                $SumAppoinment	   += $value['Appointment'];
	                $SumSusahDihubungi += $value['SusahDihubungi'];
	                $SumNadaSibuk      += $value['NadaSibuk'];
	                $SumTotalDcl       += $value['TotalDECL'];
	                $SumTolakAwal      += $value['TolakDiawal'];
	                $SumSudahAdakkBni  += $value['SudahAdaKKbNi'];
	                $SumChPusat		   += $value['ChLangsungKePusat'];
	                $SumChCabang       += $value['ChLangsungKeCabang'];
	                $SumTidakMauAmbil  += $value['TidakMauDiambilKurir'];
	                $SumDokumenAmbil   += $value['DokumenSudahDiambil'];
	                $SumSudahAdaKKLain += $value['SudahAdaKKbankLain'];
	                $SumTdkSetuju      += $value['TidakSetujuLimit'];
	                $SumKeluargaTdkStj += $value['KeluargaTidakSetuju'];
	                $SumTdkAdPenghslan += $value['TidakAdaPenghasilan'];
	                $SumTdkStjIuran    += $value['TidakSetujuIuranTahunan'];
	                $SumTlpTdkDangkat  += $value['TlpTidakDagkat'];
	                $SumNonCoverage    += $value['NonCoverage'];
	                $SumDbs            += $value['Dbs'];
	                $SumTidakAdaNpwp   += $value['TidakAdaNpwp'];
	                $SumPromoTdkMnrik  += $value['PromoTidakMenarik'];
	                $SumFiturTdkMnrik  += $value['FiturTidakMenarik'];
	                $SumRegulasi 	   += $value['Regulasi'];
	                $SumNotContacted   += $value['NotContacted'];
	                $SumTotal          += $Total;
				}
			}
			?>
		</tbody>
		<tfoot>
			<tr>
				<th colspan=2>Jumlah</th>
				<th><?php echo $SumDistributeData; ?></th>
				<th><?php echo $SumNewData; ?></th>
				<th><?php echo $SumSukesCall; ?></th>
				<th><?php echo $sumSudahKeAtm; ?></th>
				<th><?php echo $SumSudahKirimWa; ?></th>
				<th><?php echo $SumJanjiAtm; ?></th>
				<th><?php echo $SumSudahEmail; ?></th>
				<th><?php echo $SumAmbilKurir; ?></th>
				<th><?php echo $SumtotalFollow; ?></th>
				<th><?php echo $SumAppoinment; ?></th>
				<th><?php echo $SumSusahDihubungi; ?></th>
				<th><?php echo $SumNadaSibuk; ?></th>
				<th><?php echo $SumTotalDcl; ?></th>
				<th><?php echo $SumTolakAwal; ?></th>
				<th><?php echo $SumSudahAdakkBni; ?></th>
				<th><?php echo $SumChPusat; ?></th>
				<th><?php echo $SumChCabang; ?></th>
				<th><?php echo $SumTidakMauAmbil; ?></th>
				<th><?php echo $SumDokumenAmbil; ?></th>
				<th><?php echo $SumSudahAdaKKLain; ?></th>
				<th><?php echo $SumTdkSetuju; ?></th>
				<th><?php echo $SumKeluargaTdkStj; ?></th>
				<th><?php echo $SumTdkAdPenghslan; ?></th>
				<th><?php echo $SumTdkStjIuran; ?></th>
				<th><?php echo $SumTlpTdkDangkat; ?></th>
				<th><?php echo $SumNonCoverage; ?></th>
				<th><?php echo $SumDbs; ?></th>
				<th><?php echo $SumTidakAdaNpwp; ?></th>
				<th><?php echo $SumPromoTdkMnrik; ?></th>
				<th><?php echo $SumFiturTdkMnrik; ?></th>
				<th><?php echo $SumRegulasi; ?></th>
				<th><?php echo $SumNotContacted; ?></th>
				<th><?php echo $SumTotal; ?></th>
			</tr>
		</tfoot>
	</table>

</body>
</html>
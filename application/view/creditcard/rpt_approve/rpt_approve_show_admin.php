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
<title>Tabulasi Admin Report</title>
</head>
<body>
	<h4>Campaign Name: <?php echo $CampaignName['CampaignDesc']; ?></h4>
	<h4>Interval: <?php echo $_REQUEST['start_date']; ?> s/d <?php echo $_REQUEST['end_date']; ?></h4>
	<table>
		<thead>
			<tr>
				<th rowspan=2>No.</th>
				<th rowspan=2>Nama File</th>
				<th rowspan=2>Total Data Upload</th>
				<th rowspan=2>Data Terdistribusi Agent</th>
				<th rowspan=2>Data Terdistribusi Spv</th>
				<th rowspan=2>Data Terdistribusi AM</th>
				<th rowspan=2>Data Closing</th>
				
				<th colspan=4>CONTACTED</th>
				<th colspan=21>DECLINED</th>
				<th colspan=4>NOT CONTACTED</th>
				<th rowspan=2>Redispatch</th>
				<th rowspan=2>Complete Y</th>
				<th rowspan=2>Complete N</th>
				<th rowspan=2>Data New</th>
				<!-- t h rowspan=2>Kartu Tambahan</t h -->
			</tr>
			<tr>
				<!-- <th>Total FOLW</th> -->
				<th>Follow Up</th>
				<th>Janji</th>
				<th>NPU</th>
				<th>Nada Sibuk</th>
				
				<th>Total DECL</th>
				<th>Fitur Tidak Menarik</th>
				<th>Nasabah Tidak Angkat Telp</th>
				<th>Sudah Ada KK Bank Lain</th>
				<th>Sudah Ada KK BNI</th>
				<th>Promo Tidak Menarik</th>
				<th>Regulasi/Kebijakan</th>
				<th>Tolak Diawal</th>
				<th>Verifikasi Tidak Sesuai</th>
				<th>Tidak Setuju Limit</th>
				<th>Keluarga Tidak Setuju</th>
				<th>Tidak Ada Penghasilan</th>
				<th>Pekerjaan Tidak Sesuai</th>
				<th>Tidak Ada EC</th>
				<th>Fixed Line Tidak Diangkat</th>
				<th>Rumah Tidak Diangkat</th>
				<th>EC Tidak Diangkat</th>
				<th>Usia Tidak Sesuai</th>
				<th>Tidak Setuju Iuran Tahunan</th>
				<th>Tidak Punya NPWP</th>
				<th>Decline By System</th>
				
				<th>Total NOCT</th>
				<th>Nomor Tidak Akurat</th>
				<th>Salah Sambung</th>
				<th>Pindah</th>
			</tr>
		</thead>
		<tbody>
		<?php
			$no = 1;
			if(!empty($DataReport)) {
				foreach($DataReport as $array => $data) {
		  			// echo "\n";
					$kata = explode("/",$data['FTP_UploadFilename']);
					
					$DataClosing				= ($DataTabulasi[$array]['Closing']?$DataTabulasi[$array]['Closing']:0);
					$Addon						= ($DataAddon[$array]['addon']?$DataAddon[$array]['addon']:0);
					
					$TotalFolw					= ($DataTabulasi[$array]['TotalFolw']?$DataTabulasi[$array]['TotalFolw']:0);
					$folwip						= ($DataTabulasi[$array]['folwip']?$DataTabulasi[$array]['folwip']:0);
					$Janji						= ($DataTabulasi[$array]['Janji']?$DataTabulasi[$array]['Janji']:0);
					$SusahDihubungi				= ($DataTabulasi[$array]['SusahDihubungi']?$DataTabulasi[$array]['SusahDihubungi']:0);
					$NadaSibuk					= ($DataTabulasi[$array]['NadaSibuk']?$DataTabulasi[$array]['NadaSibuk']:0);
					
					$totaldecl					= ($DataTabulasi[$array]['TotalDECL']?$DataTabulasi[$array]['TotalDECL']:0);
					$FiturTidakMenarik			= ($DataTabulasi[$array]['FiturTidakMenarik']?$DataTabulasi[$array]['FiturTidakMenarik']:0);
					$TelpTidakDiangkat			= ($DataTabulasi[$array]['TelpTidakDiangkat']?$DataTabulasi[$array]['TelpTidakDiangkat']:0);
					$SudahAdaKKBNILain			= ($DataTabulasi[$array]['SudahAdaKKBNILain']?$DataTabulasi[$array]['SudahAdaKKBNILain']:0);
					$SudahAdaKKBNI				= ($DataTabulasi[$array]['SudahAdaKKBNI']?$DataTabulasi[$array]['SudahAdaKKBNI']:0);
					$PromoTidakMenarik			= ($DataTabulasi[$array]['PromoTidakMenarik']?$DataTabulasi[$array]['PromoTidakMenarik']:0);
					$Regulasi					= ($DataTabulasi[$array]['Regulasi']?$DataTabulasi[$array]['Regulasi']:0);
					$TolakDiawal				= ($DataTabulasi[$array]['TolakDiawal']?$DataTabulasi[$array]['TolakDiawal']:0);
					$VerifikasiTidakSesuai		= ($DataTabulasi[$array]['VerifikasiTidakSesuai']?$DataTabulasi[$array]['VerifikasiTidakSesuai']:0);
					$TidakSetujuLimit			= ($DataTabulasi[$array]['TidakSetujuLimit']?$DataTabulasi[$array]['TidakSetujuLimit']:0);
					$KeluargaTidakSetuju		= ($DataTabulasi[$array]['KeluargaTidakSetuju']?$DataTabulasi[$array]['KeluargaTidakSetuju']:0);
					$TidakAdaPenghasilan		= ($DataTabulasi[$array]['TidakAdaPenghasilan']?$DataTabulasi[$array]['TidakAdaPenghasilan']:0);
					$PekerjaanTidakSesuai		= ($DataTabulasi[$array]['PekerjaanTidakSesuai']?$DataTabulasi[$array]['PekerjaanTidakSesuai']:0);
					$TidakAdaEC					= ($DataTabulasi[$array]['TidakAdaEC']?$DataTabulasi[$array]['TidakAdaEC']:0);
					$NOFL						= ($DataTabulasi[$array]['NOFL']?$DataTabulasi[$array]['NOFL']:0);
					$Home						= ($DataTabulasi[$array]['Home']?$DataTabulasi[$array]['Home']:0);
					$ECTidakDiangkat			= ($DataTabulasi[$array]['ECTidakDiangkat']?$DataTabulasi[$array]['ECTidakDiangkat']:0);
					$UsiaTidakSesuai			= ($DataTabulasi[$array]['UsiaTidakSesuai']?$DataTabulasi[$array]['UsiaTidakSesuai']:0);
					$TidakSetujuIuranTahunan	= ($DataTabulasi[$array]['TidakSetujuIuranTahunan']?$DataTabulasi[$array]['TidakSetujuIuranTahunan']:0);
					$TidakPunyaNPWP				= ($DataTabulasi[$array]['TidakPunyaNPWP']?$DataTabulasi[$array]['TidakPunyaNPWP']:0);
					$DeclineBySystem			= ($DataTabulasi[$array]['DeclineBySystem']?$DataTabulasi[$array]['DeclineBySystem']:0);
					
					$TotalNC					= ($DataTabulasi[$array]['TotalNC']?$DataTabulasi[$array]['TotalNC']:0);
					$NomorTidakAkurat			= ($DataTabulasi[$array]['NomorTidakAkurat']?$DataTabulasi[$array]['NomorTidakAkurat']:0);
					$SalahSambung				= ($DataTabulasi[$array]['SalahSambung']?$DataTabulasi[$array]['SalahSambung']:0);
					$Pindah						= ($DataTabulasi[$array]['Pindah']?$DataTabulasi[$array]['Pindah']:0);
					
					$Redispatch					= ($DataTabulasi[$array]['RDPC']?$DataTabulasi[$array]['RDPC']:0);
					$CompleteY					= ($DataTabulasi[$array]['CompleteY']?$DataTabulasi[$array]['CompleteY']:0);
					$CompleteN					= ($DataTabulasi[$array]['CompleteN']?$DataTabulasi[$array]['CompleteN']:0);
					$New						= ($DataTabulasi[$array]['New']?$DataTabulasi[$array]['New']:0);	
		?>
			<tr>
				<td class="tengah"><?php echo $no; ?></td>
				<td><?php echo $kata[6]; ?></td>
				<td class="kanan"><?php echo ($data['FTP_UploadSuccess']); ?></td>
				<td class="kanan"><?php echo (($DataDistribusi[$array]['totalAgent']?$DataDistribusi[$array]['totalAgent']:0)); ?></td>
				<td class="kanan"><?php echo (($DataDistribusi[$array]['totalSpv']?$DataDistribusi[$array]['totalSpv']:0)); ?></td>
				<td class="kanan"><?php echo (($DataDistribusi[$array]['totalAM']?$DataDistribusi[$array]['totalAM']:0)); ?></td>
				<td class="kanan"><?php echo ($DataClosing); ?></td>
				
				<!-- <td class="kanan"><?php //echo ($TotalFolw); ?></td> -->
				<td class="kanan"><?php echo ($folwip); ?></td>
				<td class="kanan"><?php echo ($Janji); ?></td>
				<td class="kanan"><?php echo ($SusahDihubungi); ?></td>
				<td class="kanan"><?php echo ($NadaSibuk); ?></td>
				
				<td class="kanan"><?php echo ($totaldecl); ?></td>
				<td class="kanan"><?php echo ($FiturTidakMenarik); ?></td>
				<td class="kanan"><?php echo ($TelpTidakDiangkat); ?></td>
				<td class="kanan"><?php echo ($SudahAdaKKBNILain); ?></td>
				<td class="kanan"><?php echo ($SudahAdaKKBNI); ?></td>
				<td class="kanan"><?php echo ($PromoTidakMenarik); ?></td>
				<td class="kanan"><?php echo ($Regulasi); ?></td>
				<td class="kanan"><?php echo ($TolakDiawal); ?></td>
				<td class="kanan"><?php echo ($VerifikasiTidakSesuai); ?></td>
				<td class="kanan"><?php echo ($TidakSetujuLimit); ?></td>
				<td class="kanan"><?php echo ($KeluargaTidakSetuju); ?></td>
				<td class="kanan"><?php echo ($TidakAdaPenghasilan); ?></td>
				<td class="kanan"><?php echo ($PekerjaanTidakSesuai); ?></td>
				<td class="kanan"><?php echo ($TidakAdaEC); ?></td>
				<td class="kanan"><?php echo ($NOFL); ?></td>
				<td class="kanan"><?php echo ($Home); ?></td>
				<td class="kanan"><?php echo ($ECTidakDiangkat); ?></td>
				<td class="kanan"><?php echo ($UsiaTidakSesuai); ?></td>
				<td class="kanan"><?php echo ($TidakSetujuIuranTahunan); ?></td>
				<td class="kanan"><?php echo ($TidakPunyaNPWP); ?></td>
				<td class="kanan"><?php echo ($DeclineBySystem); ?></td>
				
				<td class="kanan"><?php echo ($TotalNC); ?></td>
				<td class="kanan"><?php echo ($NomorTidakAkurat); ?></td>
				<td class="kanan"><?php echo ($SalahSambung); ?></td>
				<td class="kanan"><?php echo ($Pindah); ?></td>
				
				<td class="kanan"><?php echo ($Redispatch); ?></td>
				<td class="kanan"><?php echo ($CompleteY); ?></td>
				<td class="kanan"><?php echo ($CompleteN); ?></td>
				<td class="kanan"><?php echo ($New); ?></td>
				<!-- t d class="kanan"><?#php echo ($Addon); ?></t d -->
			</tr>
		<?php
				
				$no++;
				
				$sumTotalDataUpload			+= $data['FTP_UploadSuccess'];
				$sumDataDistribusi			+= $DataDistribusi[$array]['total'];
				$sumDataNew					+= $DataTabulasi[$array]['New'];
				$sumDataClosing				+= $DataTabulasi[$array]['Closing'];
				$sumDataAddOn				+= $DataAddon[$array]['addon'];
				
				$sumtotalfolw				+= $DataTabulasi[$array]['TotalFolw'];
				$sumfolwip					+= $DataTabulasi[$array]['folwip'];
				$sumJanji					+= $DataTabulasi[$array]['Janji'];
				$sumSusahDihubungi			+= $DataTabulasi[$array]['SusahDihubungi'];
				$sumNadaSibuk				+= $DataTabulasi[$array]['NadaSibuk'];
				
				$sumtotaldecl				+= $DataTabulasi[$array]['TotalDECL'];
				$sumFiturTidakMenarik		+= $DataTabulasi[$array]['FiturTidakMenarik'];
				$sumTelpTidakDiangkat		+= $DataTabulasi[$array]['TelpTidakDiangkat'];
				$sumSudahAdaKKBNILain		+= $DataTabulasi[$array]['SudahAdaKKBNILain'];
				$sumSudahAdaKKBNI			+= $DataTabulasi[$array]['SudahAdaKKBNI'];
				$sumPromoTidakMenarik		+= $DataTabulasi[$array]['PromoTidakMenarik'];
				$sumRegulasi				+= $DataTabulasi[$array]['Regulasi'];
				$sumTolakDiawal				+= $DataTabulasi[$array]['TolakDiawal'];
				$sumVerifikasiTidakSesuai	+= $DataTabulasi[$array]['VerifikasiTidakSesuai'];
				$sumTidakSetujuLimit		+= $DataTabulasi[$array]['TidakSetujuLimit'];
				$sumKeluargaTidakSetuju		+= $DataTabulasi[$array]['KeluargaTidakSetuju'];
				$sumTidakAdaPenghasilan		+= $DataTabulasi[$array]['TidakAdaPenghasilan'];
				$sumPekerjaanTidakSesuai	+= $DataTabulasi[$array]['PekerjaanTidakSesuai'];
				$sumTidakAdaEC				+= $DataTabulasi[$array]['TidakAdaEC'];
				$sumNOFL					+= $DataTabulasi[$array]['NOFL'];
				$sumHome					+= $DataTabulasi[$array]['Home'];
				$sumECTidakDiangkat			+= $DataTabulasi[$array]['ECTidakDiangkat'];
				$sumUsiaTidakSesuai			+= $DataTabulasi[$array]['UsiaTidakSesuai'];
				$sumTidakSetujuIuranTahunan	+= $DataTabulasi[$array]['TidakSetujuIuranTahunan'];
				$sumTidakPunyaNPWP			+= $DataTabulasi[$array]['TidakPunyaNPWP'];
				$sumDeclineBySystem			+= $DataTabulasi[$array]['DeclineBySystem'];
				
				$sumTotalNC					+= $DataTabulasi[$array]['TotalNC'];
				$sumNomorTidakAkurat		+= $DataTabulasi[$array]['NomorTidakAkurat'];
				$sumSalahSambung			+= $DataTabulasi[$array]['SalahSambung'];
				$sumPindah					+= $DataTabulasi[$array]['Pindah'];
				
				$sumRedispatch				+= $DataTabulasi[$array]['RDPC'];
				$sumBlock					+= $DataTabulasi[$array]['Block'];
				$sumNew						+= $DataTabulasi[$array]['New'];
				
				}
			}
		?>
		</tbody>
		<tfoot>
			<tr>
				<th colspan=2>Jumlah</th>
				<th class="kanan"><?php echo ($sumTotalDataUpload); ?></th>
				<th class="kanan"><?php echo ($sumDataDistribusi); ?></th>
				<th class="kanan"><?php echo ($sumDataClosing); ?></th>
				
				<!-- <th class="kanan"><?php echo ($sumtotalfolw); ?></th> -->
				<th class="kanan"><?php echo ($sumfolwip); ?></th>
				<th class="kanan"><?php echo ($sumJanji); ?></th>
				<th class="kanan"><?php echo ($sumSusahDihubungi); ?></th>
				<th class="kanan"><?php echo ($sumNadaSibuk); ?></th>
				
				<th class="kanan"><?php echo ($sumtotaldecl); ?></th>
				<th class="kanan"><?php echo ($sumFiturTidakMenarik); ?></th>
				<th class="kanan"><?php echo ($sumTelpTidakDiangkat); ?></th>
				<th class="kanan"><?php echo ($sumSudahAdaKKBNILain); ?></th>
				<th class="kanan"><?php echo ($sumSudahAdaKKBNI); ?></th>
				<th class="kanan"><?php echo ($sumPromoTidakMenarik); ?></th>
				<th class="kanan"><?php echo ($sumRegulasi); ?></th>
				<th class="kanan"><?php echo ($sumTolakDiawal); ?></th>
				<th class="kanan"><?php echo ($sumVerifikasiTidakSesuai); ?></th>
				<th class="kanan"><?php echo ($sumTidakSetujuLimit); ?></th>
				<th class="kanan"><?php echo ($sumKeluargaTidakSetuju); ?></th>
				<th class="kanan"><?php echo ($sumTidakAdaPenghasilan); ?></th>
				<th class="kanan"><?php echo ($sumPekerjaanTidakSesuai); ?></th>
				<th class="kanan"><?php echo ($sumTidakAdaEC); ?></th>
				<th class="kanan"><?php echo ($sumNOFL); ?></th>
				<th class="kanan"><?php echo ($sumHome); ?></th>
				<th class="kanan"><?php echo ($sumECTidakDiangkat); ?></th>
				<th class="kanan"><?php echo ($sumUsiaTidakSesuai); ?></th>
				<th class="kanan"><?php echo ($sumTidakSetujuIuranTahunan); ?></th>
				<th class="kanan"><?php echo ($sumTidakPunyaNPWP); ?></th>
				<th class="kanan"><?php echo ($sumDeclineBySystem); ?></th>
				
				<th class="kanan"><?php echo ($sumTotalNC); ?></th>
				<th class="kanan"><?php echo ($sumNomorTidakAkurat); ?></th>
				<th class="kanan"><?php echo ($sumSalahSambung); ?></th>
				<th class="kanan"><?php echo ($sumPindah); ?></th>
				
				<th class="kanan"><?php echo ($sumRedispatch); ?></th>
				<th class="kanan"><?php echo ($sumBlock); ?></th>
				<th class="kanan"><?php echo ($sumBlock); ?></th>
				<th class="kanan"><?php echo ($sumDataNew); ?></th>
				<!-- t h class="kanan"><?#php echo ($sumDataAddOn); ?></t h -->
			</tr>
		</tfoot>
	</table>

</body>
</html>
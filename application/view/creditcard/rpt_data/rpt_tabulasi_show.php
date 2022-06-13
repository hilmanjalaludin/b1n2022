<?php echo "ini data raw";
die;
?>
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
	<h4>Campaign Name: <?php echo $CampaignName['CampaignDesc']; ?></h4>
	 <?php
	// error_reporting(E_ALL);
	// ini_set('display_errors', 1);	 
	?>
	<h4>Interval: <?php echo $_REQUEST['start_date']; ?> s/d <?php echo $_REQUEST['end_date']; ?></h4>
	<table>
		<thead>
			<tr>
				<th rowspan=2>No.</th>
				<th rowspan=2>Nama File</th>
				<th rowspan=2>Total Data Upload</th>
				<th rowspan=2>Data Terdistribusi MGR</th>
				<th rowspan=2>Data Terdistribusi AM</th>
				<th rowspan=2>Data Terdistribusi SPV</th>
				<th rowspan=2>Data Terdistribusi Agent</th>
				<th rowspan=2>Data Closing</th>
				<th rowspan=2>Data Approve</th>
				
				<th colspan=5>Follow Up</th>
				<th colspan=21>Decline</th>
				<th colspan=4>Not Contacted</th>
				<th rowspan=2>Redispatch</th>
				<th rowspan=2>Block</th>
				<th rowspan=2>Data New</th>
				<!-- t h rowspan=2>Kartu Tambahan</t h -->
			</tr>
			<tr>
				<th>Total FOLW</th>
				<th>Follow Up</th>
				<th>Janji</th>
				<th>Susah Dihubungi</th>
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
			 // $start_date = date("Y-m-d 01:00:00");
			 // $end_date = date("Y-m-d 09:00:00");
			 $start_date = date("2021-01-01 01:00:00");
			 $end_date = date("2021-01-01 23:00:00");
	 
			 $sql = "SELECT
				 a.DM_CampaignId AS Campaign,
				 b.CV_Data_Custno AS CustNo,
				 b.CV_Data_FixID AS FixId,
				 b.CV_Data_CardType AS CardType,
				 b.CV_Data_AvailXD AS AvailableXD,
				 c.TX_Usg_JumlahDana AS Amountclosing,
				 a.DM_FirstName AS Nama,
				 d.CallCategoryId AS CallCategory,
				 d.CallReasonId AS CallReason,
				 f.CallReasonCategoryName AS CategoryName,
				 g.CallReasonDesc AS ReasonDesc,
				 d.AgentCode AS AgentCode,
				 d.SPVCode AS SPVCode,
				 d.CallHistoryCallDate AS HistoryCalldate,
				 SEC_TO_TIME(e.duration) AS Duration
				 FROM
				 t_gn_customer_master a
				 INNER JOIN t_gn_customer_verification b ON a.DM_Id = b.CV_Data_CustId
				 left JOIN t_gn_frm_usage c ON a.DM_Id = c.TX_Usg_CustId
				 INNER JOIN t_gn_callhistory d ON a.DM_Id = d.CustomerId
				 INNER JOIN cc_recording e ON e.session_key=d.CallSessionId
				 INNER JOIN t_lk_callreasoncategory f ON f.CallReasonCategoryId = d.CallCategoryId
				 INNER JOIN t_lk_callreason g ON g.CallReasonId = d.CallReasonId
				 WHERE 
				 d.CallHistoryCreatedTs >= '".$start_date."'
				 and d.CallHistoryCreatedTs <= '".$end_date."'
				 GROUP BY e.id
			 ";
			 $res = $this->db->query($sql);
			 foreach ($sql as $key => $value) {
				 var_dump($value);
			 }
			//  die;
		
		?>
			<tr>
				<td class="tengah"><?php echo $no; ?></td>
				<td><?php echo $kata[6]; ?></td>
				<td class="kanan"><?php echo ($data['FTP_UploadSuccess']); ?></td>
				<td class="kanan"><?php echo ($DataDistribusi[$array]['totalMGR']); ?></td>
				<td class="kanan"><?php echo ($DataDistribusi[$array]['totalAM']); ?></td>
				<td class="kanan"><?php echo ($DataDistribusi[$array]['totalSpv']); ?></td>
				<td class="kanan"><?php echo ($DataDistribusi[$array]['totalAgent']); ?></td>
				<td class="kanan"><?php echo ($DataClosing); ?></td>
				<td class="kanan"><?php echo ($DataApprove); ?></td>
				
				<td class="kanan"><?php echo ($TotalFolw); ?></td>
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
				<td class="kanan"><?php echo ($Block); ?></td>
				<td class="kanan"><?php echo ($New); ?></td>
				<!-- t d class="kanan"><?#php echo ($Addon); ?></t d -->
			</tr>
		<?php
				
				$no++;
				
				$sumTotalDataUpload			+= $data['FTP_UploadSuccess'];
				
				// $sumDataDistribusi			+= $DataDistribusi[$array]['total'];
				$sumDataDistribusiMGR		+= $DataDistribusi[$array]['totalMGR'];
				$sumDataDistribusiAM		+= $DataDistribusi[$array]['totalAM'];
				$sumDataDistribusiSpv		+= $DataDistribusi[$array]['totalSpv'];
				$sumDataDistribusiAgent		+= $DataDistribusi[$array]['totalAgent'];
				
				$sumDataNew					+= $DataTabulasi[$array]['New'];
				$sumDataClosing				+= $DataTabulasi[$array]['Closing'];
				$sumDataAddOn				+= $DataAddon[$array]['addon'];
				$sumDataApprove				+= $DataTabulasi[$array]['Approve'];
				
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
				<th class="kanan"><?php echo ($sumDataDistribusiMGR); ?></th>
				<th class="kanan"><?php echo ($sumDataDistribusiAM); ?></th>
				<th class="kanan"><?php echo ($sumDataDistribusiSpv); ?></th>
				<th class="kanan"><?php echo ($sumDataDistribusiAgent); ?></th>
				<th class="kanan"><?php echo ($sumDataClosing); ?></th>
				<th class="kanan"><?php echo ($sumDataApprove); ?></th>
				
				<th class="kanan"><?php echo ($sumtotalfolw); ?></th>
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
				<th class="kanan"><?php echo ($sumDataNew); ?></th>
				<!-- t h class="kanan"><?#php echo ($sumDataAddOn); ?></t h -->
			</tr>
		</tfoot>
	</table>

</body>
</html>
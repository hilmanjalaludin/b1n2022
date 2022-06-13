<?php
print_r($campaign);
echo "<title>Performance Report</title>";  

$set_alias_header_ntb = array(
	"0"  => "NO" ,
	"1"  => "Agent ID" ,
	"2"  => "Tanggal" ,
	"3"  => "Jumlah Data" ,
	"4"  => "Call Attempt" ,
	"5"  => "Call Duration" ,
	"6"  => "NTB",
	"7"  => "NTB Dual",
	"8"  => "AddOn 1",
	"9"  => "Addon 2",
	"10"  => "Total"
);

function getUploadFilename($val){
	$pathname = explode("/",$val);
	$filename = array_pop((array_slice($pathname, -1)));
	
	return $filename;
}
?>

<p>Date from : <?php echo $param->get_value("start_date" , "_getDateEnglish"); ?> <br>
To        : <?php echo $param->get_value("end_date" , "_getDateEnglish"); ?></p>

<h4>Performance Report - Data NTB</h4>
<table>
	<tr>
		<?php  
		foreach ( $set_alias_header_ntb as $sah => $header ) {
			echo "<th>" . $header . "</th>";

		}
		?>
	</tr>

	
	<?php
	$row_data_ntb = "";
	$totDurrr = 0;
	if ( $data_ntb != false ) {
		$no = 1;
		$i=1;
		foreach ( $data_ntb as $ky => $va ) {
				
			foreach($va as $ke => $vl){
				$row_data_ntb .= "<tr>";
				if($i==$no){
					$row_data_ntb .= "<td>" . $no . "</td>";
					$row_data_ntb .= "<td>" . $ky ." - ". $vl['full_name'] ."</td>";
				}else{
					$row_data_ntb .= "<td></td>";
					$row_data_ntb .= "<td></td>";
				}
				$totalcloseratakanan = ($data_clos[$ky][$ke]['Closedeal']*2)+$addonke1[$ky][$ke]['Closedeal']+$addonke2[$ky][$ke]['Closedeal'];
				$row_data_ntb .= "<td>" . $ke . "</td>";
				$row_data_ntb .= "<td>" . $vl['Datas'] . "</td>";
				$row_data_ntb .= "<td>" . $vl['Attemps'] . "</td>";
				$row_data_ntb .= "<td>" . _getDuration($data_sess[$ky][$ke]['tot_durr']) . "</td>";
				$row_data_ntb .= "<td>" . ($data_clos[$ky][$ke]['Closedeal']?$data_clos[$ky][$ke]['Closedeal']:0) . "</td>";
				$row_data_ntb .= "<td>" . ($data_clos[$ky][$ke]['Closedeal']?$data_clos[$ky][$ke]['Closedeal']:0) . "</td>";
				$row_data_ntb .= "<td>" . ($addonke1[$ky][$ke]['Closedeal']?$addonke1[$ky][$ke]['Closedeal']:0) . "</td>";
				$row_data_ntb .= "<td>" . ($addonke2[$ky][$ke]['Closedeal']?$addonke2[$ky][$ke]['Closedeal']:0) . "</td>";
				$row_data_ntb .= "<td>" . ($totalcloseratakanan?$totalcloseratakanan:0) . "</td>";
				
				$totDatas += $vl['Datas'];
				$totAttmp += $vl['Attemps'];
				$totDurrr += $data_sess[$ky][$ke]['tot_durr'];
				$totDeals += ($data_clos[$ky][$ke]['Closedeal']);
				$totNTBD += ($data_clos[$ky][$ke]['Closedeal']);
				$totaddonke1 += ($addonke1[$ky][$ke]['Closedeal']);
				$totaddonke2 += ($addonke2[$ky][$ke]['Closedeal']);
				$totalcloseratabawah += $totalcloseratakanan;
				$row_data_ntb .= "</tr>";
				$i++;
			}
			$no++;
			$i=$no;
		}
	}

	echo $row_data_ntb;
	echo "<tr><td colspan = '3'>Summary</td>";
	echo "<td>".$totDatas."</td>";
	echo "<td>".$totAttmp."</td>";
	echo "<td>".gmdate('H:i:s', $totDurrr)."</td>";
	echo "<td>".$totDeals."</td>";
	echo "<td>".$totNTBD."</td>";
	echo "<td>".$totaddonke1."</td>";
	echo "<td>".$totaddonke2."</td>";
	echo "<td>".$totalcloseratabawah."</td></tr>";
	?>
</table>
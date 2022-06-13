<?php
print_r($campaign);
echo "<title>Performance Report Summary</title>";  

$set_alias_header_ntb = array(
	"0"  => "NO" ,
	"1"  => "Agent ID" ,
	"2"  => "Jumlah Data" ,
	"3"  => "Call Attempt" ,
	"4"  => "Call Duration" ,
	"5"  => "NTB",
	"6"  => "NTB Dual",
	"7"  => "AddOn 1",
	"8"  => "Addon 2",
	"9"  => "Total"
	
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
			// echo "<pre>";
			// print_r($data_ntb);
			// echo "</pre>";
			$totalcloseratakanan = $duals[$ky]['Duals']+$data_clos[$ky]['Closedeal']+$addonke1[$ky]['Closedeal']+$addonke2[$ky]['Closedeal'];
				$row_data_ntb .= "<tr>";
				$row_data_ntb .= "<td>" . $no . "</td>";
				$row_data_ntb .= "<td>" . $ky ." - ". $va['full_name'] ."</td>";
				$row_data_ntb .= "<td>" . $va['Datas'] . "</td>";
				$row_data_ntb .= "<td>" . $va['Attemps'] . "</td>";
				$row_data_ntb .= "<td>" . _getDuration($data_sess[$ky]['tot_durr']) . "</td>";
				$row_data_ntb .= "<td>" . ($data_clos[$ky]['Closedeal']?$data_clos[$ky]['Closedeal']:0) . "</td>";
				$row_data_ntb .= "<td>" . ($duals[$ky]['Duals']?$duals[$ky]['Duals']:0) . "</td>";
				$row_data_ntb .= "<td>" . ($addonke1[$ky]['Closedeal']?$addonke1[$ky]['Closedeal']:0) . "</td>";
				$row_data_ntb .= "<td>" . ($addonke2[$ky]['Closedeal']?$addonke2[$ky]['Closedeal']:0) . "</td>";
				$row_data_ntb .= "<td>" . ($totalcloseratakanan?$totalcloseratakanan:0) . "</td>";
				
				$totDatas += $vl['Datas'];
				$totAttmp += $vl['Attemps'];
				$totDurrr += $data_sess[$ky]['tot_durr'];
				$totDeals += ($data_clos[$ky]['Closedeal']);
				$totNTBD += ($duals[$ky]['Duals']);
				$totaddonke1 += ($addonke1[$ky]['Closedeal']);
				$totaddonke2 += ($addonke2[$ky]['Closedeal']);
				$totalcloseratabawah += $totalcloseratakanan;
				$row_data_ntb .= "</tr>";
				$i++;
			
			$no++;
			$i=$no;
		}
	}

	echo $row_data_ntb;
	?>
</table>



<?php

echo "<title>Performance Report Summary</title>";  

$set_alias_header_ntb = array(
	"0"  => "NO" ,
	"1"  => "Agent ID" ,
	"2"  => "Jumlah Data" ,
	"3"  => "Call Attempt" ,
	"4"  => "Call Duration" ,
	"5"  => "Closing"
);

function getUploadFilename($val){
	$pathname = explode("/",$val);
	$filename = array_pop((array_slice($pathname, -1)));
	
	return $filename;
}
?>

<p>Date from : <?php echo $param->get_value("start_date" , "_getDateEnglish"); ?> <br>
To        : <?php echo $param->get_value("end_date" , "_getDateEnglish"); ?></p>

<h4>Performance Report - Data ADDOn</h4>
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
				
				$row_data_ntb .= "<tr>";
				$row_data_ntb .= "<td>" . $no . "</td>";
				$row_data_ntb .= "<td>" . $ky ." - ". $va['full_name'] ."</td>";
				$row_data_ntb .= "<td>" . $va['Datas'] . "</td>";
				$row_data_ntb .= "<td>" . $va['Attemps'] . "</td>";
				$row_data_ntb .= "<td>" . gmdate('H:i:s', $data_sess[$ky]['tot_durr']) . "</td>";
				$row_data_ntb .= "<td>" . ($data_clos[$ky]['Closedeal']) . "</td>";
				
				$totDatas += $vl['Datas'];
				$totAttmp += $vl['Attemps'];
				$totDurrr += $data_sess[$ky][$ke]['tot_durr'];
				$totDeals += ($data_clos[$ky][$ke]['Closedeal']);
				$row_data_ntb .= "</tr>";
				$i++;
			$no++;
			$i=$no;
		}
	}

	echo $row_data_ntb;
	?>
</table>



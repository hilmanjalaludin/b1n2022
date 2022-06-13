<?php

echo "<title>Report Tapenas </title>";  

$set_alias_header_usage = array(
    '1' =>'No',
    '2' =>'Prospect Name',
    '3' =>'No. Rek',
    '4' =>'Branch Name',
    '5' =>'Setoran Bulanan Sebelum',
    '6' =>'Setoran Tambahan',
    '7' =>'Setoran Bulanan Sesudah',
    '8' =>'Tenor Sebelum',
    '9' =>'Tenor Tambahan',
    '10' =>'Tenor Sesudah',
    '11' =>'Due Date',
    '12' =>'Agent ID',
    '13' =>'Supervisor ID',
    '14' =>'QC ID',
    '15' =>'Close Deal'
);

function getUploadFilename($val){
	$pathname = explode("/",$val);
	$filename = array_pop((array_slice($pathname, -1)));
	
	return $filename;
}

?>

<p>Date from : <?php echo $param->get_value("start_date" , "_getDateEnglish"); ?> <br>
To        : <?php echo $param->get_value("end_date" , "_getDateEnglish"); ?></p>

<h4>Reporting - Data Tapenas</h4>
<table>
	<tr>
		<?php  
		foreach ( $set_alias_header_usage as $sah => $header ) {
			echo "<th>" . $header . "</th>";

		}
		?>
	</tr>

	
	<?php 
	$row_data_usage = "";
	if ( $data_usage != false ) {
		$no = 1;		
		foreach ( $data_usage->result_array() as $dn ) {
			$obj_ntb = Objective($dn);
            $row_data_usage .= "<tr>";
			$row_data_usage .= "<td>" . $no++ . "</td>";
			$row_data_usage .= "<td>" . $obj_ntb->get_value("TX_Usg_TransId") . "</td>";
			$row_data_usage .= "<td>" . $obj_ntb->get_value("TX_Usg_Custno") . "</td>";
			$row_data_usage .= "<td>" . $obj_ntb->get_value("TX_Usg_FixID") . "</td>";
			$row_data_usage .= "<td>" . $obj_ntb->get_value("TX_Usg_CustomerName") . "</td>";
			$row_data_usage .= "<td>" . $obj_ntb->get_value("TX_Usg_JenisKartu") . "</td>";
			$row_data_usage .= "<td>" . $obj_ntb->get_value("TX_Usg_ExpiredKartu") . "</td>";
			$row_data_usage .= "<td>" . $obj_ntb->get_value("TX_Usg_KreditLimit") . "</td>";
			$row_data_usage .= "<td>" . $obj_ntb->get_value("TX_Usg_AvailableXD") . "</td>";
			$row_data_usage .= "<td>" . $obj_ntb->get_value("TX_Usg_AvailableSS") . "</td>";
			$row_data_usage .= "<td>" . $obj_ntb->get_value("TX_Usg_Cycle") . "</td>";
			$row_data_usage .= "<td>" . $obj_ntb->get_value("TX_Usg_Program") . "</td>";
			$row_data_usage .= "<td>" . $obj_ntb->get_value("DM_Recsource","FileRecsource") . "</td>";
			$row_data_usage .= "<td>" . $obj_ntb->get_value("TX_Usg_Penawaran") . "</td>";
			$row_data_usage .= "<td>" . $obj_ntb->get_value("TX_Usg_NamaRekening") . "</td>";
			$row_data_usage .= "</tr>";
			
			$jumlah_row = count($obj_ntb->get_value("TX_Usg_TransId"));
			$rownya += $jumlah_row;
			$TotalDana += $obj_ntb->get_value("TX_Usg_JumlahDana");
		}
    }
    echo $row_data_usage;
    ?>
</table>
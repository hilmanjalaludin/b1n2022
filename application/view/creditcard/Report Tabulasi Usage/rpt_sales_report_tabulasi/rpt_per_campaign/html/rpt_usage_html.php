<?php

echo "<title>Report Usage </title>";  

$set_alias_header_usage = array(
    '1' =>'No',
    '2' =>'Trans ID',
    '3' =>'Cust ID',
    '4' =>'Fix ID',
    '5' =>'Nama',
    '6' =>'Jenis Kartu',
    '7' =>'Expired Date',
    '8' =>'Kredit Limit',
    '9' =>'Avail XD',
    '10' =>'Avail SS',
    '11' =>'Cycle',
    '12' =>'Program',
    '13' =>'Campaign',
    '14' =>'Status Penawaran',
    '15' =>'Nama Rek',
    '16' =>'No Rek',
    '17' =>'Bank',
    '18' =>'Cabang',
    '19' =>'Dana',
    '20' =>'Cicilan',
    '21' =>'Agent ID',
    '22' =>'Date Agree'
);

function getUploadFilename($val){
	$pathname = explode("/",$val);
	$filename = array_pop((array_slice($pathname, -1)));
	
	return $filename;
}

?>

<p>Date from : <?php echo $param->get_value("start_date" , "_getDateEnglish"); ?> <br>
To        : <?php echo $param->get_value("end_date" , "_getDateEnglish"); ?></p>

<h4>Reporting - Data Usage</h4>
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
			$row_data_usage .= "<td>" . $obj_ntb->get_value("TX_Usg_NoRekening") . "</td>";
			$row_data_usage .= "<td>" . $obj_ntb->get_value("TX_Usg_NamaBank") . "</td>";
			$row_data_usage .= "<td>" . $obj_ntb->get_value("TX_Usg_Cabang") . "</td>";
			$row_data_usage .= "<td>" . $obj_ntb->get_value("TX_Usg_JumlahDana") . "</td>";
			$row_data_usage .= "<td>" . $obj_ntb->get_value("TX_Usg_Tenor") . "</td>";
			$row_data_usage .= "<td>" . $obj_ntb->get_value("TX_Usg_SellerKode") . "</td>";
			$row_data_usage .= "<td>" . $obj_ntb->get_value("TX_Usg_CreatedTs") . "</td>";
			$row_data_usage .= "</tr>";
        }
    }
    echo $row_data_usage;
    ?>
</table>
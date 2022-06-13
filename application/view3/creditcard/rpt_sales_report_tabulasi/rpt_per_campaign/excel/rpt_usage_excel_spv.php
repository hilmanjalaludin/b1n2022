<?php

echo "<title>Report Usage </title>";  

$set_alias_header_ntb = array(
	"0"=>"No",
	"1"=>"Trans ID",
	"2"=>"Cust ID",
	"3"=>"Nama",
	"4"=>"Jenis Kartu",
	"5"=>"Expired Date",
	"6"=>"Kredit Limit",
	"7"=>"Avail XD",
	"8"=>"Avail SS",
	"9"=>"Cycle",
	"10"=>"Program",
	"11"=>"Campaign",
	"12"=>"Status Penawaran",
	"13"=>"Nama Rek",
	"14"=>"No Rek",
	"15"=>"Bank",
	"16"=>"Cabang",
	"17"=>"Dana",
	"18"=>"Cicilan",
	"19"=>"Agent ID",
	"20" => "SPV",
    "21" => "QA",
	"22"=>"Date Agree"
);

function getUploadFilename($val){
	$pathname = explode("/",$val);
	$filename = array_pop((array_slice($pathname, -1)));
	
	return $filename;
}
?>

<p>Date from : <?php echo $param->get_value("start_date" , "_getDateEnglish"); ?> <br>
To        : <?php echo $param->get_value("end_date" , "_getDateEnglish"); ?></p>

<h4>Reporting - Data NTB</h4>
<table>
	<tr>
		<?php  
		foreach ( $set_alias_header_ntb as $sah => $header ) {
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
			// $row_data_usage .= "<td>" . $obj_ntb->get_value("TX_Usg_FixID") . "</td>";
			$row_data_usage .= "<td>" . $obj_ntb->get_value("TX_Usg_CustomerName") . "</td>";
			$row_data_usage .= "<td>" . $obj_ntb->get_value("TX_Usg_JenisKartu") . "</td>";
			$row_data_usage .= "<td>" . $obj_ntb->get_value("TX_Usg_ExpiredKartu") . "</td>";
			$row_data_usage .= "<td>" . $obj_ntb->get_value("TX_Usg_KreditLimit") . "</td>";
			$row_data_usage .= "<td>" . $obj_ntb->get_value("TX_Usg_AvailableXD") . "</td>";
			$row_data_usage .= "<td>" . $obj_ntb->get_value("TX_Usg_AvailableSS") . "</td>";
			$row_data_usage .= "<td>" . $obj_ntb->get_value("TX_Usg_Cycle") . "</td>";
			$row_data_usage .= "<td>" . $obj_ntb->get_value("TX_Usg_Program") . "</td>";
			$row_data_usage .= "<td>" . $obj_ntb->get_value("DM_Recsource","FileRecsource") . "</td>";
			$row_data_usage .= "<td>" . $obj_ntb->get_value("TX_Usg_Rate") . "&nbsp%</td>";
			$row_data_usage .= "<td>" . $obj_ntb->get_value("TX_Usg_NamaRekening") . "</td>";
			$row_data_usage .= "<td>" . $obj_ntb->get_value("TX_Usg_NoRekening") . "</td>";
			$row_data_usage .= "<td>" . $obj_ntb->get_value("TX_Usg_NamaBank") . "</td>";
			$row_data_usage .= "<td>" . $obj_ntb->get_value("TX_Usg_Cabang") . "</td>";
			$row_data_usage .= "<td>" . $obj_ntb->get_value("TX_Usg_JumlahDana") . "</td>";
			$row_data_usage .= "<td>" . $obj_ntb->get_value("TX_Usg_Tenor") . "</td>";
			$row_data_usage .= "<td>" . $obj_ntb->get_value("TX_Usg_SellerKode") . "</td>";
			$row_data_usage .= "<td>" . $obj_ntb->get_value("TX_Usg_SpvKode") . "</td>";
			$row_data_usage .= "<td>" . $obj_ntb->get_value("code_user") . "</td>";
			$row_data_usage .= "<td>" . $obj_ntb->get_value("TX_Usg_CreatedTs") . "</td>";
			// $row_data_usage .= "<td>" . $obj_ntb->get_value("DM_MobilePhoneNum") . "</td>";
			$row_data_usage .= "</tr>";
			
			$jumlah_row = count($obj_ntb->get_value("TX_Usg_TransId"));
			$rownya += $jumlah_row;
			$TotalDana += $obj_ntb->get_value("TX_Usg_JumlahDana");
        }
    }
    echo $row_data_usage;
    ?>
</table>

<p>
	<b>Jumlah account adalah <?php echo $rownya; ?></b><br>
	<b>Total dana adalah <?php echo number_format($TotalDana); ?></b>
</p?
<?php

echo "<title>Report Usage </title>";  

$set_alias_header_ntb = array(
	"0"=>"No",
	"1"=>"Trans ID",
	"2"=>"Cust ID",
	"3"=>"Fix ID",
	"4"=>"Nama",
	"5"=>"Jenis Kartu",
	"6"=>"Expired Date",
	"7"=>"Kredit Limit",
	"8"=>"Avail XD",
	"9"=>"Avail SS",
	"10"=>"Cycle",
	"11"=>"Program",
	"12"=>"Campaign",
	"13"=>"Status Penawaran",
	"14"=>"Nama Rek",
	"15"=>"No Rek",
	"16"=>"Bank",
	"17"=>"Cabang",
	"18"=>"Dana",
	"19"=>"Cicilan",
	"20"=>"Agent ID",
	"21" => "SPV",
    "22" => "QA",
	"23"=>"Date Agree",
	"24" => "Phone Number"
);

function getUploadFilename($val){
	$pathname = explode("/",$val);
	$filename = array_pop((array_slice($pathname, -1)));
	
	return $filename;
}
?>

<p>Date from : <?php echo $param->get_value("start_date" , "_getDateEnglish"); ?> <br>
To        : <?php echo $param->get_value("end_date" , "_getDateEnglish"); ?></p>

<h4>Reporting - Data USAGE</h4>
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
			$row_data_usage .= "<td>" . $obj_ntb->get_value("DM_MobilePhoneNum") . "</td>";
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
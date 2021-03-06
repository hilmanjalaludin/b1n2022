<?php

echo "<title>Report ADDON </title>";  

$set_alias_header_ntb = array(
	"0"  => "NO" ,
	"1"  => "Customer ID" ,
	"2"  => "Nama Kartu Utama/Basic" ,
	"3"  => "Suplemen Nama Tambahan" ,
	"4"  => "Jenis Kelamin" ,
	"5"  => "Jenis Card" ,
	"6"  => "Jenis Card 2" ,
	"7"  => "Hubungan" ,
	"8"  => "DOB" ,
	"9"  => "Mobile No." ,
	"10" => "Home Phone" ,
	"11" => "WkPhone" , 
	"12" => "HP" , 
	"13" => "Status Call" , 
	"14" => "Reason Call" , 
	"15" => "Date Agree" , 
	"16" => "Alamat Kirim Kartu" , 
	"17" => "New Home Number" , 
	"18" => "New Mobile Number" , 
	"19" => "New Office Number" , 
	"20" => "Pic SPV" , 
	"21" => "Pic QC" , 
	"22" => "Agent ID" , 
	"23" => "Source Code" , 
	"24" => "Last Update" , 
	"25" => "File" , 
	"26" => "Email Addr" , 
	"27" => "Fax Number" , 
	"28" => "Note By TSR " , 
	"29" => "Note By QC " , 
	"30" => "Other Address" , 
	"31" => "Other Home Phone" , 
	"32" => "Other Mobile Phone " , 
	"33" => "Other Office Phone " , 
	"34" => "CC Expired" 
);


function getUploadFilename($val){
	$pathname = explode("/",$val);
	$filename = array_pop((array_slice($pathname, -1)));
	
	return $filename;
}
?>

<p>Date from : <?php echo $param->get_value("start_date" , "_getDateEnglish"); ?> <br>
To        : <?php echo $param->get_value("end_date" , "_getDateEnglish"); ?></p>

<h4>Reporting - Data ADDON</h4>
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
	if ( $data_ntb != false ) {
		$no = 1;		
		foreach ( $data_ntb->result_array() as $dn ) {
			$obj_ntb = Objective($dn);
			$row_data_ntb .= "<tr>";
			$row_data_ntb .= "<td>" . $no++ . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("CustId") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("NamaKartu") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("ADDON_Nama_Kartu") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("ADDON_Jenis_Kelamin") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("JenisKartu") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("JenisKartu2") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("dulur") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("DOB") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("ADDON_No_Hp") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("HomePhone") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("WorkPhone") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("HP") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("StatusCall") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("ReasonCall") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("TglCall") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("KrimKrtu") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("HomeNo") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("MobNo") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("OffNo") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("SPV_Code") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("QCCode") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("AgentCode") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("SourceCode") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("LastDate") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("UPLOAD_desc") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("Email") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("FaxNo") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("NOTE") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("NoteQc") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("Address1") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("OhomePhone") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("OMobilePhone") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("OfficePhone") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("CCExpired") . "</td>";
			$row_data_ntb .= "</tr>";
		}	
	}

	echo $row_data_ntb;
	?>
</table>

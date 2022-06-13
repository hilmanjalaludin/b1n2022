<?php

echo "<title>Report XSELL </title>";  

$set_alias_header_ntb = array(
	"0"  => "NO" ,
	"1"  => "Aplication ID" ,
	"2"  => "Organisasi	" ,
	"3"  => "Logo Lama" ,
	"4"  => "Logo Baru" ,
	"5"  => "Sub Type" ,
	"6"  => "Customer Number" ,
	"7"  => "Perisai +" ,
	"8"  => "Income" ,
	"9"  => "DOB" ,
	"10" => "J_Kelamin" ,
	"11" => "Alamat Kirim Kartu" ,
	"12" => "Alamat2" ,
	"13" => "Alamat3" ,
	"14" => "Alamat4" ,
	"15" => "Kota" ,
	"16" => "Jenis Kartu Lama" ,
	"17" => "Jenis Kartu Baru " ,
	"18" => "Nama di Kartu" ,
	"19" => "Source Code" ,
	"20" => "Cycle " ,
	"21" => "Limit Kartu Lama  " ,
	"22" => "Limit Kartu Baru " ,
	"23" => "No CC Lama (Kosong) " ,
	"24" => "New Home Number " ,
	"25" => "New Mobile Number " ,
	"26" => "New Office Number " ,
	"27" => "Pic SPV " ,
	"28" => "Pic QC " ,
	"29" => "Note " ,
	"30" => "File " ,
	"31" => "Email Addr  " ,
	"32" => "Fax Number  " ,
	"33" => "NPWP " ,
	"34" => "KTP",
	"35" => "Tempat Lahir",
	"36" => "Other Address " ,
	"37" => "Other Home Phone " ,
	"38" => "Other Mobile Phone " ,
	"39" => "Other Office Phone " ,
	"40" => "CC Expired " 
);

$set_alias_dual_card = array(
	"0"  => "NO" ,
	"1"  => "Customer Number" ,
	"2"  => "PIC SPV" ,
	"3"  => "PIC TSR" ,
	"4"  => "PIC QC" ,
	"5"  => "Name" ,
	"6"  => "DOB" ,
	"7"  => "Gender" ,
	"8"  => "Mobile No." ,
	"9"  => "LOGO" ,
	"10" => "Deal Date" ,
	"11" => "Relation"
);

function getUploadFilename($val){
	$pathname = explode("/",$val);
	$filename = array_pop((array_slice($pathname, -1)));
	
	return $filename;
}
?>

<p>Date from : <?php echo $param->get_value("start_date" , "_getDateEnglish"); ?> <br>
To        : <?php echo $param->get_value("end_date" , "_getDateEnglish"); ?></p>

<h4>Reporting - Data XSELL</h4>
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
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("ApplicationID") . "</td>";
			$row_data_ntb .= "<td>" . "1" . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("LOGO") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("LOGOBARU") . "</td>";
			$row_data_ntb .= "<td>" . "" . "</td>";
			$row_data_ntb .= "<td>" . "" . "</td>";
			$row_data_ntb .= "<td>" . "" . "</td>";
			$row_data_ntb .= "<td>" . "" . "</td>";
			$row_data_ntb .= "<td>" . "" . "</td>";
			$row_data_ntb .= "<td>" . "" . "</td>";
			$row_data_ntb .= "<td>" . "" . "</td>";
			$row_data_ntb .= "<td>" . "" . "</td>";
			$row_data_ntb .= "<td>" . "" . "</td>";
			$row_data_ntb .= "<td>" . "" . "</td>";
			$row_data_ntb .= "<td>" . "" . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("LOGO") . "</td>";
			$row_data_ntb .= "<td>" . "" . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("NamaKartu") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("SourceCode") . "</td>";
			$row_data_ntb .= "<td>" . "" . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("LOGO") . "</td>";
			$row_data_ntb .= "<td>" . "" . "</td>";
			$row_data_ntb .= "<td>" . "" . "</td>";
			$row_data_ntb .= "<td>" . "" . "</td>";
			$row_data_ntb .= "<td>" . "" . "</td>";
			$row_data_ntb .= "<td>" . "" . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("PIC_SPV") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("PIC_QC") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("NOTE") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("UPLOAD_ID") . "</td>";
			$row_data_ntb .= "<td>" . "" . "</td>";
			$row_data_ntb .= "<td>" . "" . "</td>";
			$row_data_ntb .= "<td style =\"mso-number-format:'\@';\">" . $obj_ntb->get_value("NPWP") . "</td>";
			$row_data_ntb .= "<td style =\"mso-number-format:'\@';\">" . $obj_ntb->get_value("ktp") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("Tempat_lahir") . "</td>";
			$row_data_ntb .= "<td>" . "" . "</td>";
			$row_data_ntb .= "<td>" . "" . "</td>";
			$row_data_ntb .= "<td>" . "" . "</td>";
			$row_data_ntb .= "<td>" . "" . "</td>";
			$row_data_ntb .= "<td>" . "" . "</td>";
			$row_data_ntb .= "</tr>";
		}	
	}

	echo $row_data_ntb;
	?>
</table>

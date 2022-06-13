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
	"9"  => "Jenis Kartu Lama" ,
	"10" => "Jenis Kartu Baru" ,
	"11" => "Nama di katu" ,
	"12" => "Source code" ,
	"13" => "Cycle" ,
	"14" => "Limit Kartu Lama" ,
	"15" => "Limit Kartu Baru" ,
	"16" => "No CC Lama (Kosong)" ,
	"17" => "Note " ,
	"18" => "File" ,
	"19" => "PIC SPV" ,
	"20" => "PIC QC" ,
	"21" => "Email Addr " ,
	"22" => "Fax Number " ,
	"23" => "NPWP " ,
	"24" => "CC Expired " 
);


$set_alias_header_addon = array(
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
	if ( $data_xsell != false ) {
		$no = 1;		
		foreach ( $data_xsell->result_array() as $dn ) {
			$obj_xsell = Objective($dn);
			$row_data_ntb .= "<tr>";
			$row_data_ntb .= "<td>" . $no++ . "</td>";
			$row_data_ntb .= "<td>" . $obj_xsell->get_value("DB_Org") . "</td>";
			$row_data_ntb .= "<td>" . $obj_xsell->get_value("Logo") . "</td>";
			$row_data_ntb .= "<td>" . $obj_xsell->get_value("AppId") . "</td>";
			$row_data_ntb .= "<td>" . $obj_xsell->get_value("DB_CustNum") . "</td>";
			$row_data_ntb .= "<td>" . $obj_xsell->get_value("DB_SourceAgentID") . "</td>";
			$row_data_ntb .= "<td>" . $obj_xsell->get_value("DB_Nama_KTP") . "</td>";
			$row_data_ntb .= "<td>" . $obj_xsell->get_value("CC_Nama_Yang_Diinginkan") . "</td>";
			$row_data_ntb .= "<td>" . $obj_xsell->get_value("DB_DOB") . "</td>";
			$row_data_ntb .= "<td>" . $obj_xsell->get_value("CONTACT_Jenis_Kelamin") . "</td>";
			$row_data_ntb .= "<td>" . $obj_xsell->get_value("CONTACT_No_Ktp") . "</td>";
			$row_data_ntb .= "<td>" . $obj_xsell->get_value("CONTACT_Nama_Ibu_Kandung") . "</td>";
			$row_data_ntb .= "<td>" . $obj_xsell->get_value("WORK_Jabatan") . "</td>";
			$row_data_ntb .= "<td>" . $obj_xsell->get_value("FINANCE_Penghasilan_Sekarang") . "</td>";
			$row_data_ntb .= "<td>" . $obj_xsell->get_value("CONTACT_Tgl_Jatuh_Tempo") . "</td>";
			$row_data_ntb .= "<td>" . $obj_xsell->get_value("CONTACT_Alamat_Rumah_1") . "</td>";
			$row_data_ntb .= "<td>" . $obj_xsell->get_value("CONTACT_Alamat_Rumah_2") . "</td>";
			$row_data_ntb .= "<td>" . $obj_xsell->get_value("CONTACT_Alamat_Rumah_3") . "</td>";
			$row_data_ntb .= "<td>" . $obj_xsell->get_value("CONTACT_Alamat_Rumah_4") . "</td>";
			$row_data_ntb .= "<td>" . $obj_xsell->get_value("CONTACT_Kota") . "</td>";
			$row_data_ntb .= "<td>" . $obj_xsell->get_value("CONTACT_Kode_Post") . "</td>";
			$row_data_ntb .= "<td>" . $obj_xsell->get_value("CONTACT_Kode_Area_Tlp") . "</td>";
			$row_data_ntb .= "<td>" . $obj_xsell->get_value("CONTACT_Tlp_Rumah") . "</td>";
			$row_data_ntb .= "<td>" . $obj_xsell->get_value("CONTACT_Mobile_Phone") . "</td>";
			$row_data_ntb .= "<td>" . $obj_xsell->get_value("WORK_Nama_Kantor") . "</td>";
			$row_data_ntb .= "</tr>";
		}	
	}

	echo $row_data_ntb;
	?>
</table>

<h4>Reporting - Data Addon XSELL</h4>
<table>
	<tr>
		<?php  
		foreach ( $set_alias_header_addon as $saha => $header_addon ) {
			echo "<th>" . $header_addon . "</th>";
		}
		?>
	</tr>
	
		<?php  
		//print_r($data_addon_ntb);
		if ( is_array($data_addon_xsell) AND count($data_addon_xsell) > 0 ) {
			$nos = 1;
			foreach ( $data_addon_xsell as $order => $dan ) {
				$dan = Objective($dan);
				echo "<tr>";
				echo "<td>" . $nos++ . "</td>";
				echo "<td>" . $dan->get_value("ADDON_CustNum") . "</td>";
				echo "<td>" . $dan->get_value("SPV_Code") . "</td>";
				echo "<td>" . $dan->get_value("Agent_Code") . "</td>";
				echo "<td>" . $dan->get_value("QA_Code") . "</td>";
				echo "<td>" . $dan->get_value("ADDON_Nama_Kartu") . "</td>";
				echo "<td>" . $dan->get_value("ADDON_DOB") . "</td>";
				echo "<td>" . $dan->get_value("ADDON_Jenis_Kelamin") . "</td>";
				echo "<td>" . $dan->get_value("ADDON_No_Hp") . "</td>";
				echo "<td>" . $dan->get_value("ADDON_Jenis_Kartu") . "</td>";
				echo "<td>" . $dan->get_value("CreatedTs") . "</td>";
				echo "<td>" . $dan->get_value("ADDON_Hubungan") . "</td>";
				echo "</tr>";
			}
		}
		?>
	
</table>
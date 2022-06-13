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
	"34" => "Other Address " ,
	"35" => "Other Home Phone " ,
	"36" => "Other Mobile Phone " ,
	"37" => "Other Office Phone " ,
	"38" => "CC Expired " 
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
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("NPWP") . "</td>";
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
<h4>Reporting - Data Addon XSELL</h4>
<table>
	<tr>
		<?php  
		foreach ( $set_alias_dual_card as $sahas => $header_dualcard ) {
			echo "<th>" . $header_dualcard . "</th>";
		}
		?>		
	</tr>

		<?php  
		$count_data_dualcard = count($data_ntb_dualcard);
		if ( is_array($data_ntb_dualcard) AND $count_data_dualcard > 0 ) {
			$no = 1;
			foreach ( $data_ntb_dualcard as $number_dual_card => $ddc ) {
				$dc_obj = Objective($ddc);
				echo "<tr>";
				echo "<td>" . $no++ . "</td>";
				echo "<td>" . $dc_obj->get_value("ORG") . "</td>";
				echo "<td>" . $dc_obj->get_value("LOGO") . "</td>";
				echo "<td>" . $dc_obj->get_value("APPID") . "</td>"; ;
				echo "<td>" . $dc_obj->get_value("CustomerNumber") . "</td>";
				echo "<td>" . $dc_obj->get_value("CustomerNumberCorporate") . "</td>";
				echo "<td>" . $dc_obj->get_value("EmpolyoeeReffCode") . "</td>";
				echo "<td>" . $dc_obj->get_value("SourceCode") . "</td>";
				echo "<td>" . $dc_obj->get_value("CARD") . "</td>";
				echo "<td>" . $dc_obj->get_value("JenisKartu") . "</td>";
				echo "<td>" . $dc_obj->get_value("LOGODualCard") . "</td>";
				echo "<td>" . $dc_obj->get_value("LIMIT") . "</td>";
				echo "<td>" . $dc_obj->get_value("NamaDiKTP") . "</td>";
				echo "<td>" . $dc_obj->get_value("NamaDiKartu") . "</td>";
				echo "<td>" . $dc_obj->get_value("DOBCustomer") . "</td>";
				echo "<td>" . $dc_obj->get_value("JenisKelamin") . "</td>";
				echo "<td>" . $dc_obj->get_value("NoKTP") . "</td>";
				echo "<td>" . $dc_obj->get_value("MothersName") . "</td>";
				echo "<td>" . $dc_obj->get_value("Jabatan") . "</td>";
				echo "<td>" . $dc_obj->get_value("Penghasilan") . "</td>";
				echo "<td>" . $dc_obj->get_value("NoRekening") . "</td>";
				echo "<td>" . $dc_obj->get_value("KreditLimit") . "</td>";
				echo "<td>" . $dc_obj->get_value("TglJatuhTempo") . "</td>";
				echo "<td>" . $dc_obj->get_value("Addrees_1") . "</td>";
				echo "<td>" . $dc_obj->get_value("Addrees_2") . "</td>";
				echo "<td>" . $dc_obj->get_value("Addrees_3") . "</td>";
				echo "<td>" . $dc_obj->get_value("Addrees_4") . "</td>";
				echo "<td>" . $dc_obj->get_value("HOMECITY") . "</td>";
				echo "<td>" . $dc_obj->get_value("HOMEZIPCODE") . "</td>";
				echo "<td>" . $dc_obj->get_value("KodeArea") . "</td>";
				echo "<td>" . $dc_obj->get_value("HomePhone") . "</td>";
				echo "<td>" . $dc_obj->get_value("OFFICENAME") . "</td>";
				echo "<td>" . $dc_obj->get_value("OFFICEADDR1") . "</td>"; 
				echo "<td>" . $dc_obj->get_value("OFFICEADDR2") . "</td>";
				echo "<td>" . $dc_obj->get_value("OFFICEADDR3") . "</td>";
				echo "<td>" . $dc_obj->get_value("OFFICEADDR4") . "</td>";
				echo "<td>" . $dc_obj->get_value("OFFICECITY") . "</td>";
				echo "<td>" . $dc_obj->get_value("OFFICEZIPCODE") . "</td>";
				echo "<td>" . $dc_obj->get_value("KodeArea") . "</td>";
				echo "<td>" . $dc_obj->get_value("OFFICEPHONE") . "</td>";
				echo "<td>" . $dc_obj->get_value("HANDPHONE") . "</td>";
				echo "<td>" . $dc_obj->get_value("EmergencyContact") . "</td>";
				echo "<td>" . $dc_obj->get_value("HUBUNGAN") . "</td>";
				echo "<td>" . $dc_obj->get_value("TELPEMERGENCYCONTACT") . "</td>";
				echo "<td>" . $dc_obj->get_value("KIRIMBILLING") . "</td>";
				echo "<td>" . $dc_obj->get_value("KIRIMKARTU") . "</td>";
				echo "<td>" . $dc_obj->get_value("NamaBankLain") . "</td>";
				echo "<td>" . $dc_obj->get_value("CardLain") . "</td>";
				echo "<td>" . $dc_obj->get_value("SPV") . "</td>";
				echo "<td>" . $dc_obj->get_value("QC") . "</td>";
				echo "<td>" . $dc_obj->get_value("Program") . "</td>";
				echo "<td>" . $dc_obj->get_value("File") . "</td>";
				echo "</tr>";
			}
		} else {

		}
		?>
</table>
<h4>Reporting - Data Addon XSEL</h4>
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
		if ( is_array($data_addon_ntb) AND count($data_addon_ntb) > 0 ) {
			$nos = 1;
			foreach ( $data_addon_ntb as $order => $dan ) {
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
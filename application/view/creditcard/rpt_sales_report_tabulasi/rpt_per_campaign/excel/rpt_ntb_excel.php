<?php

echo "<title>Report NTB </title>";  

$set_alias_header_ntb = array(
	"0"  => "NO" ,
	"1"  => "ORG" ,
	"2"  => "LOGO" ,
	"3"  => "APP ID" ,
	"4"  => "Customer Number" ,
	"5"  => "Source Code" ,
	"6"  => "Name On KTP" ,
	"7"  => "Name On Card" ,
	"8"  => "DOB" ,
	"9"  => "Jenis Kelamin" ,
	"10" => "No KTP" ,
	"11" => "Mother Name" ,
	"12" => "Jabatan" ,
	"13" => "Penghasilan" ,
	"14" => "Jatuh Tempo" ,
	"15" => "HomeAddrees1" ,
	"16" => "HomeAddrees2" ,
	"17" => "HomeAddrees3" ,
	"18" => "HomeAddrees4" ,
	"19" => "CityHome" ,
	"20" => "Zippost" ,
	"21" => "AreaCode" ,
	"22" => "HomeTlp" ,
	"23" => "Other Phone" ,
	"24" => "OffieceName" ,
	"25" => "OfficeAddress1" ,
	"26" => "OfficeAddress2" ,
	"27" => "OfficeAddress3" ,
	"28" => "OfficeAddress4" ,
	"29" => "OfficeCity" ,
	"30" => "OfficeZip" ,
	"31" => "OfficeAreaCode" ,
	"32" => "Office Phone" ,
	"33" => "Handphone" ,
	"34" => "Emergency Contact" ,
	"35" => "Family Related" ,
	"36" => "Ec Phone" ,
	"37" => "Ec Address" ,
	"38" => "Ec Kota" ,
	"39" => "SendBiling" ,
	"40" => "SendCard" ,
	"41" => "Tanggal CLOSING" ,
	"42" => "Ibu Kandung" ,
	"43" => "Tahun" ,
	"44" => "Bulan" ,
	"45" => "Status Tempat Tinggal" ,
	"46" => "Status Tempat Tinggal Lainnya" ,
	"47" => "Status Pernikahan" ,
	"48" => "Pendidikan Terakhir" ,
	"49" => "Pendidikan Terakhir Lain" ,
	"50" => "Jumlah Tanggungan" ,
	"51" => "Penghasilan Lain" ,
	"52" => "Sumber Penghasilan Lain" ,
	"53" => "No Kartu Kredit Lain 1" ,
	"54" => "Sejak" ,
	"55" => "Berlaku s/d" ,
	"56" => "Penerbit CC Lain" ,
	"57" => "No Kartu Kredit Lain 2" ,
	"58" => "Sejak" ,
	"59" => "Berlaku s/d" ,
	"60" => "Penerbit CC Lain" ,
	"61" => "Rekening Tabungan BNI yg dimiliki" ,
	"62" => "Tempat Tgl Lahir" ,
	"63" => "Pekerjaan" ,
	"64" => "Pekerjaan Lainnya" ,
	"65" => "Kewarganegaraan" ,
	"66" => "Jenis Perusahaan" ,
	"67" => "Jenis Perusahaan Lainnya" ,
	"68" => "Bidang Usaha" ,
	"69" => "NPWP" ,
	"70" => "PIC_SPV" ,
	"71" => "PIC_TSR" ,
	"72" => "PIC_QC" ,
	"73" => "SOURCE_CODE" ,
	"74" => "UPLOAD_ID" ,
	"75" => "OTHER PRODUCT",
	"76" => "Notes",
	"77" => "Minat Fleksi",
	"78" => "Cabang Pembuka",
	"79" => "Tenor Pinjaman",
	"80" => "Bunga Pinjaman"
);

$set_alias_dual_card = array(
	"1" => "NO" ,
	"2" => "ORG" ,
	"3" => "LOGO" ,
	"4" => "APP ID" ,
	"5" => "Customer Number" ,
	"6" => "Customer Number Corporate" ,
	"7" => "Empolyoee Reff Code" ,
	"8" => "Source Code" ,
	"9" => "CARD" ,
	"10" => "Jenis Kartu" ,
	"11" => "LOGO Dual Card" ,
	"12" => "LIMIT" ,
	"13" => "Nama Di KTP" ,
	"14" => "Nama Di Kartu" ,
	"15" => "DOB Customer" ,
	"16" => "Jenis Kelamin" ,
	"17" => "No KTP" ,
	"18" => "Mother's Name" ,
	"19" => "Jabatan" ,
	"20" => "Penghasilan" ,
	"21" => "No Rekening " ,
	"22" => "Kredit Limit " ,
	"23" => "Tgl Jatuh Tempo" ,
	"24" => "Addrees_1" ,
	"25" => "Address_2" ,
	"26" => "Address_3" ,
	"27" => "Address_4" ,
	"28" => "HOME CITY" ,
	"29" => "HOME ZIPCODE" ,
	"30" => "Kode Area" ,
	"31" => "Home Phone" ,
	"32" => "OFFICE NAME" ,
	"33" => "OFFICE ADDR1" , 
	"34" => "OFFICE ADDR2" ,
	"35" => "OFFICE ADDR3" ,
	"37" => "OFFICE ADDR4" ,
	"38" => "OFFICE CITY" ,
	"39" => "OFFICE ZIPCODE" ,
	"40" => "Kode Area" ,
	"41" => "OFFICE PHONE" ,
	"42" => "HAND PHONE" ,
	"43" => "Emergency Contact" ,
	"44" => "HUBUNGAN" ,
	"45" => "TELP EMERGENCY CONTACT" ,
	"46" => "KIRIM BILLING" ,
	"47" => "KIRIM KARTU" ,
	"48" => "Nama Bank Lain" ,
	"49" => "Card Lain" ,
	"50" => "SPV" ,
	"51" => "QC" ,
	"52" => "Program" ,
	"53" => "File" 
);


$set_alias_header_addon = array(
	"0"  => "NO" ,
	"1"  => "Customer Number" ,
	"2"  => "Customer Name" ,
	"3"  => "PIC SPV" ,
	"4"  => "PIC TSR" ,
	"5"  => "PIC QC" ,
	"6"  => "Name" ,
	"7"  => "DOB" ,
	"8"  => "Gender" ,
	"9"  => "Mobile No." ,
	"10"  => "LOGO" ,
	"11" => "Deal Date" ,
	"12" => "Relation"
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
	$row_data_ntb = "";
	if ( $data_ntb != false ) {
		$no = 1;		
		foreach ( $data_ntb->result_array() as $dn ) {
			$obj_ntb = Objective($dn);
			$row_data_ntb .= "<tr>";
			$row_data_ntb .= "<td>" . $no++ . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("DB_Org") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("LOGO") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("AppId") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("DB_CustNum") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("SourceCode") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("DM_FirstName") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("CC_Nama_Yang_Diinginkan") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("DM_Dob") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("CONTACT_Jenis_Kelamin") . "</td>";
			$row_data_ntb .= "<td style =\"mso-number-format:'\@';\">" . $obj_ntb->get_value("CONTACT_No_Ktp") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("CONTACT_Nama_Ibu_Kandung") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("WORK_Jabatan") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("FINANCE_Penghasilan_Sekarang") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("CONTACT_Tgl_Jatuh_Tempo") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("CONTACT_Alamat_Rumah_1") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("CONTACT_Alamat_Rumah_2") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("CONTACT_Alamat_Rumah_3") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("CONTACT_Alamat_Rumah_4") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("CONTACT_Kota") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("CONTACT_Kode_Post") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("CONTACT_Kode_Area_Tlp") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("CONTACT_Tlp_Rumah") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("CONTACT_Mobile_Phone") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("WORK_Nama_Kantor") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("WORK_Almat_Kantor_1") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("WORK_Almat_Kantor_2") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("WORK_Almat_Kantor_3") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("WORK_Almat_Kantor_4") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("WORK_Kota_Kantor") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("WORK_Kode_Pos_Kantor") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("WORK_Kode_Area_Tlp_Kantor") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("WORK_Tlp_Kantor") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("CONTACT_Mobile_Phone") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("EC_Nama") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("dulur") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("EC_Telp") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("EC_Alamat") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("EC_Kota") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("WORK_Alamat_Biling") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("WORK_Alamat_Kartu") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("CreatedTs") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("CONTACT_Nama_Ibu_Kandung") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("CONTACT_Lama_Tinggal_Tahun") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("CONTACT_Lama_Tinggal_Bulan") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("ownership") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("CONTACT_Status_Tempat_Tinggal_Other") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("ngewong") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("CONTACT_Pendidikan_Terakhir") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("CONTACT_Pendidikan_Terakhir_Other") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("CONTACT_Jumlah_Tanggungan") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("FINANCE_Penghasilan_Lain") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("FINANCE_Sumber_Penghasilan_Lain") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("FINANCE_No_Kartu_Kredit_Dimiliki1_1") . $obj_ntb->get_value("FINANCE_No_Kartu_Kredit_Dimiliki1_2") .$obj_ntb->get_value("FINANCE_No_Kartu_Kredit_Dimiliki1_3") .$obj_ntb->get_value("FINANCE_No_Kartu_Kredit_Dimiliki1_4") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("FINANCE_Kartu_Kredit_Sejak1") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("FINANCE_Kartu_Kredit_Expired1") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("FINANCE_Bank_Kartu_Kredit1") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("FINANCE_No_Kartu_Kredit_Dimiliki2_1") . $obj_ntb->get_value("FINANCE_No_Kartu_Kredit_Dimiliki2_2") .$obj_ntb->get_value("FINANCE_No_Kartu_Kredit_Dimiliki2_3") .$obj_ntb->get_value("FINANCE_No_Kartu_Kredit_Dimiliki2_4") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("FINANCE_Kartu_Kredit_Sejak2") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("FINANCE_Kartu_Kredit_Expired2") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("FINANCE_Bank_Kartu_Kredit2") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("FINANCE_No_Rekening_Tabungan") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("CONTACT_Tempat_Lahir") . "</td>";
			// " / " . $obj_ntb->get_value("CONTACT_Tgl_Lahir") . "</td>";
			// $row_data_ntb .= "<td>" . $obj_ntb->get_value("WORK_Jenis_Pekerjaan") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("gawean") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("WORK_Jenis_Pekerjaan_Other") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("CONTACT_Kewarganegaraan") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("perusahaan") . "</td>";
			
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("WORK_Jenis_Perusahaan_Other") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("WORK_Bidang_Usaha") . "</td>";
			$row_data_ntb .= "<td style =\"mso-number-format:'\@';\">" . $obj_ntb->get_value("WORK_Nonpwp") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("SPV_Code") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("Agent_Code") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("QA_Code") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("") . "</td>";
			$row_data_ntb .= "<td>" . getUploadFilename($obj_ntb->get_value("FTP_UploadFilename")) . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("") . "</td>";
			$row_data_ntb .= "<td>" . ($obj_ntb->get_value("CallHistoryNotes")?$obj_ntb->get_value("CallHistoryNotes"):"NOTES TIDAK DIISI") . "</td>";
			//new line
			$row_data_ntb .= "<td>" . ($obj_ntb->get_value("OTHER_Perisai_Plus")==1?"Ya":"Tidak") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("OTHER_Nama_Asuransi") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("OTHER_Other1") . "</td>";
			$row_data_ntb .= "<td>" . $obj_ntb->get_value("OTHER_Other2") . "</td>";
			$row_data_ntb .= "</tr>";
		}	
	}

	echo $row_data_ntb;
	?>
</table>
<h4>Reporting - Data Dual Card NTB</h4>
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
				echo "<td>" . $dc_obj->get_value("JenisKartu") . "</td>";
				echo "<td>" . $dc_obj->get_value("CARD") . "</td>";
															 
				echo "<td>" . $dc_obj->get_value("LOGODualCard") . "</td>";
				echo "<td>" . $dc_obj->get_value("LIMIT") . "</td>";
				echo "<td>" . $dc_obj->get_value("NamaDiKTP") . "</td>";
				echo "<td>" . $dc_obj->get_value("NamaDiKartu") . "</td>";
				echo "<td>" . $dc_obj->get_value("DOBCustomer") . "</td>";
				echo "<td>" . $dc_obj->get_value("JenisKelamin") . "</td>";
				echo "<td style =\"mso-number-format:'\@';\">" . $dc_obj->get_value("NoKTP") . "</td>";
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
<h4>Reporting - Data Addon NTB</h4>
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
		if ( is_array($data_addon_ntb_1) AND count($data_addon_ntb_1) > 0 ) {
			$nos = 1;
			foreach ( $data_addon_ntb_1 as $order => $dan ) {
				$dan = Objective($dan);
				echo "<tr>";
				echo "<td>" . $nos++ . "</td>";
				echo "<td>" . $dan->get_value("TR_CustomerNumber") . "</td>";
				echo "<td>" . $dan->get_value("DM_FirstName") . "</td>";
				echo "<td>" . $dan->get_value("SpvCode") . "</td>";
				echo "<td>" . $dan->get_value("AgentCode") . "</td>";
				echo "<td>" . $dan->get_value("QACode") . "</td>";
				echo "<td>" . $dan->get_value("ADDON_Nama_Kartu") . "</td>";
				echo "<td>" . $dan->get_value("ADDON_DOB") . "</td>";
				echo "<td>" . $dan->get_value("Gender") . "</td>";
				echo "<td>" . $dan->get_value("ADDON_No_Hp") . "</td>";
				echo "<td>" . 'Pertama' . "</td>"; //$dan->get_value("ADDON_Jenis_Kartu") . "</td>";
				echo "<td>" . $dan->get_value("AddOnDate") . "</td>";
				echo "<td>" . $dan->get_value("RelationshipTypeDesc") . "</td>";
				echo "</tr>";
			}
		}
		?>
	
</table>

<h4>Reporting - Data Addon Ke Dua NTB</h4>
<table>
	<tr>
		<?php  
		foreach ( $set_alias_header_addon as $saha => $header_addon ) {
			echo "<th>" . $header_addon . "</th>";
		}
		?>
	</tr>
	
		<?php  
		// print_r($data_addon_ntb);
		if ( is_array($data_addon_ntb_2) AND count($data_addon_ntb_2) > 0 ) {
			$nos = 1;
			foreach ( $data_addon_ntb_2 as $order => $dan ) {
				$dan = Objective($dan);
				echo "<tr>";
				echo "<td>" . $nos++ . "</td>";
				echo "<td>" . $dan->get_value("TR_CustomerNumber") . "</td>";
				echo "<td>" . $dan->get_value("DM_FirstName") . "</td>";
				echo "<td>" . $dan->get_value("SpvCode") . "</td>";
				echo "<td>" . $dan->get_value("AgentCode") . "</td>";
				echo "<td>" . $dan->get_value("QACode") . "</td>";
				echo "<td>" . $dan->get_value("ADDON_Nama_Kartu") . "</td>";
				echo "<td>" . $dan->get_value("ADDON_DOB") . "</td>";
				echo "<td>" . $dan->get_value("Gender") . "</td>";
				echo "<td>" . $dan->get_value("ADDON_No_Hp") . "</td>";
				echo "<td>" . 'Kedua' . "</td>"; //$dan->get_value("ADDON_Jenis_Kartu") . "</td>";
				echo "<td>" . $dan->get_value("AddOnDate") . "</td>";
				echo "<td>" . $dan->get_value("RelationshipTypeDesc") . "</td>";
				echo "</tr>";
			}
		}
		?>
	
</table>
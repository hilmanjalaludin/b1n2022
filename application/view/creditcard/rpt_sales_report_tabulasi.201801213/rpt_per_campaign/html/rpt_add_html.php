<?php  

/**
 *
 * 
NO
Customer ID
Nama Kartu Utama/Basic
Suplemen Nama Tambahan
Jenis Kelamin
Jenis Card
Jenis Card 2
Hubungan
DOB
Mobile No.
Home Phone
WkPhone
HP
Status Call
Reason Call
Date Agree
Alamat Kirim Kartu
New Home Number
New Mobile Number
New Office Number
Pic SPV
Pic QC
Agent ID
Source Code
Last Update
File
CC Expired

 */

echo "<title>Report ADDON </title>";  


$set_alias_header_addon = array(
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
	"26" => "CC Expired" 
);


?>

<p>Date from : <?php echo $param->get_value("start_date" , "_getDateEnglish"); ?> <br>
To        : <?php echo $param->get_value("end_date" , "_getDateEnglish"); ?></p>


<h4>Reporting - Data Addon</h4>
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
				echo "<td>" . $dan->get_value("ADDON_Nama_Kartu") . "</td>";
				echo "<td>" . $dan->get_value("SPV_Code") . "</td>";
				echo "<td>" . $dan->get_value("Agent_Code") . "</td>";
				echo "<td>" . $dan->get_value("QA_Code") . "</td>";
				
				echo "<td>" . $dan->get_value("ADDON_DOB") . "</td>";
				echo "<td>" . $dan->get_value("ADDON_Jenis_Kelamin") . "</td>";
				echo "<td>" . $dan->get_value("ADDON_No_Hp") . "</td>";
				echo "<td>" . $dan->get_value("ADDON_Jenis_Kartu") . "</td>";
				echo "<td>" . $dan->get_value("CreatedTs") . "</td>";
				echo "<td>" . $dan->get_value("ADDON_Hubungan") . "</td>";
				echo "<td>" . $dan->get_value("ADDON_Hubungan") . "</td>";
				echo "<td>" . $dan->get_value("ADDON_Hubungan") . "</td>";
				echo "<td>" . $dan->get_value("ADDON_Hubungan") . "</td>";
				echo "<td>" . $dan->get_value("ADDON_Hubungan") . "</td>";
				echo "<td>" . $dan->get_value("ADDON_Hubungan") . "</td>";
				echo "<td>" . $dan->get_value("ADDON_Hubungan") . "</td>";
				echo "<td>" . $dan->get_value("ADDON_Hubungan") . "</td>";
				echo "<td>" . $dan->get_value("ADDON_Hubungan") . "</td>";
				echo "<td>" . $dan->get_value("ADDON_Hubungan") . "</td>";
				echo "<td>" . $dan->get_value("ADDON_Hubungan") . "</td>";
				echo "<td>" . $dan->get_value("ADDON_Hubungan") . "</td>";
				echo "<td>" . $dan->get_value("ADDON_Hubungan") . "</td>";
				echo "<td>" . $dan->get_value("ADDON_Hubungan") . "</td>";
				echo "<td>" . $dan->get_value("ADDON_Hubungan") . "</td>";
				echo "<td>" . $dan->get_value("ADDON_Hubungan") . "</td>";
				echo "</tr>";
			}
		}
		?>
	
</table>
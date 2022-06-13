<?php
// echo $param->field('campaign_id'); die();
echo "<title>Report Balcon </title>";  

function valusername( $userid = 0 ){
	$CI  = &CI(); 
	$sql = sprintf("select a.full_name from tms_agent a where a.UserId = %d", $userid);
	$qry = $CI->db->query( $sql );
	if( $qry && $qry->num_rows() > 0 ) {
		return (string)$qry->result_singgle_value();
	}
	return null;
	
  }


function datestring( $date  = null){
	return sprintf("%s", date('d/m/Y', strtotime($date)) );
}

$set_alias_header_balcon = array(
	"0"=>"No",
	"1"=>"Fix ID",
	"2"=>"Merchant",
	"3"=>"AMOUNT",
	"4"=>"TrxDate",
	"5"=>"MID",
	"6"=>"Refno",
	"7"=>"AgenDate",
	"8"=>"AgenID",
	"9"=>"Cicilan",
	"10"=>"CodeUser",
);

function getUploadFilename($val){
	$pathname = explode("/",$val);
	$filename = array_pop((array_slice($pathname, -1)));
	
	return $filename;
}
?>

<p>Date from : <?php echo $param->get_value("start_date" , "_getDateEnglish"); ?> <br>
To        : <?php echo $param->get_value("end_date" , "_getDateEnglish"); ?></p>

<h4>Reporting - Data BALCON</h4>
<table>
	<tr>
		<?php  
		foreach ( $set_alias_header_balcon as $sah => $header ) {
			echo "<th>" . $header . "</th>";
		}
		?>
	</tr>

	
	<?php 
	$row_data_balcon = "";
	if ( $data_balcon != false ) {
		$no = 1;		
		foreach ( $data_balcon->result_array() as $blc ) {
			$obj_blc = Objective($blc);
            $row_data_balcon .= "<tr>";
			$row_data_balcon .= "<td>" . $no++ . "</td>";
			$row_data_balcon .= "<td>" . $obj_blc->get_value("TX_Usg_FixID") . "</td>";
			if($param->field('campaign_id')==87){
				$row_data_balcon .= "<td>" . $obj_blc->get_value('TX_Usg_Block') . "</td>";
			}else{
				$row_data_balcon .= "<td>" . "PROG INST KK".$obj_blc->get_value('TX_Usg_ProgramValue') . "</td>";
			}

			if($param->field('campaign_id')==87){
				$row_data_balcon .= "<td>" . $obj_blc->get_value('TxAvailableXD') . "</td>";
			}else{
				$row_data_balcon .= "<td>" . $obj_blc->get_value('TX_Usg_JumlahDana') . "</td>";

			}
			
			if($param->field('campaign_id')==87){
				$row_data_balcon .= "<td>" . $obj_blc->get_value('TX_Usg_Tigabulan') . "</td>";

			}else{
				$row_data_balcon .= "<td>" . datestring($obj_blc->get_value('TX_Usg_CreatedTs')) . "</td>";

			}
			
			if($param->field('campaign_id')==87){
				$row_data_balcon .= "<td>1516</td>";
			}else{
				if($obj_blc->get_value('TX_Usg_Tenor') == '3'){
					$row_data_balcon .= "<td>1415</td>";
				}elseif($obj_blc->get_value('TX_Usg_Tenor') == '6'){
					$row_data_balcon .= "<td>1415</td>";
				}elseif($obj_blc->get_value('TX_Usg_Tenor') == '9'){
					$row_data_balcon .= "<td>1415</td>";
				}elseif($obj_blc->get_value('TX_Usg_Tenor') == '12'){
					$row_data_balcon .= "<td>1415</td>";
				}elseif($obj_blc->get_value('TX_Usg_Tenor') == '18'){
					$row_data_balcon .= "<td>1528</td>";
				}elseif($obj_blc->get_value('TX_Usg_Tenor') == '24'){
					$row_data_balcon .= "<td>1529</td>";
				}elseif($obj_blc->get_value('TX_Usg_Tenor') == '36'){
					$row_data_balcon .= "<td>1529</td>";
				}
			}

			if($param->field('campaign_id')==87){
				$row_data_balcon .= "<td>" . $obj_blc->get_value('TxAvailableSS') . "0</td>";
			}else{
				$var = "888888888888";
				$row_data_balcon .= "<td>".$var."&nbsp</td>";
			}
			$row_data_balcon .= "<td>" . datestring($obj_blc->get_value('TX_Usg_CreatedTs')) . "</td>";

			$row_data_balcon .= "<td>" . $obj_blc->get_value('TX_Usg_SellerKode') . "</td>";
			// $row_data_balcon .= "<td>" . valusername($obj_blc->get_value('TX_Usg_SellerId')) . "</td>";

			// $writefix->write_content( $i, 8, $row->field('TX_Usg_SellerId',array('valusername','strtoupper')));
			$row_data_balcon .= "<td>" . $obj_blc->get_value('TX_Usg_Tenor') . "</td>";
			$row_data_balcon .= "<td>" . $obj_blc->get_value('TX_Usg_SellerKode') . "</td>";

			$row_data_balcon .= "</tr>";
			
			$jumlah_row = count($obj_blc->get_value("TX_Usg_FixID"));
			$rownya += $jumlah_row;

			if($param->field('campaign_id')==87){

				$TotalDana += $obj_blc->get_value("TxAvailableXD");
			}else{

				$TotalDana += $obj_blc->get_value("TX_Usg_JumlahDana");

			}
        }
    }
    echo $row_data_balcon;
    ?>
</table>

<p>
	<b>Jumlah account adalah <?php echo $rownya; ?></b><br>
	<b>Total dana adalah <?php echo number_format($TotalDana); ?></b>
</p?
<!DOCTYPE html>
<html>
<head>
	<style>
		html {
			font-family: Trebuchet MS,Arial,sans-serif;
			font-size: 12px;
		}
		table, th, td {
			border: 1px solid black;
			border-collapse: collapse;
		}
		th, td {
			padding: 5px;
		}
		.kanan {
			text-align: right;
		}
		.tengah {
			text-align: center;
		}
	</style>
<title>Tabulasi Report</title>
</head>
<body>
	<h4>CALL HISTORY BNI <?php echo date("2021-02-05"); ?> s/d <?php echo date("2021-02-05"); ?></h4>
	<table>
		<thead>
			<tr>
				<th>Campaign</th>
				<th>Cust No</th>
				<th>Fix Id</th>
				<th>Card Type</th>
				<th>Available XD</th>
				<th>Amount closing</th>
				<th>Nama</th>
				<th>Call Category</th>
				<th>Call Reason</th>
				<th>Category Reason</th>
				<th>Reason Desc</th>
				<th>Agent Code</th>
				<th>SPV Code</th>
				<th>History Calldate</th>
				<th>Durasi</th>
			
				<!-- t h>Kartu Tambahan</t h -->
			</tr>
		</thead>
		<tbody>
		<?php
		$start_date = date("2021-02-05 01:00:00");
	    $end_date = date("2021-02-05 23:00:00");

        $sql = "SELECT
            a.DM_CampaignId AS Campaign,
            b.CV_Data_Custno AS CustNo,
            b.CV_Data_FixID AS FixId,
            b.CV_Data_CardType AS CardType,
            b.CV_Data_AvailXD AS AvailableXD,
            c.TX_Usg_JumlahDana AS Amountclosing,
            a.DM_FirstName AS Nama,
            d.CallCategoryId AS CallCategory,
            d.CallReasonId AS CallReason,
            f.CallReasonCategoryName AS CategoryName,
            g.CallReasonDesc AS ReasonDesc,
            d.AgentCode AS AgentCode,
            d.SPVCode AS SPVCode,
            d.CallHistoryCallDate AS HistoryCalldate,
            SEC_TO_TIME(e.duration) AS Duration
            FROM
            t_gn_customer_master a
            INNER JOIN t_gn_customer_verification b ON a.DM_Id = b.CV_Data_CustId
            left JOIN t_gn_frm_usage c ON a.DM_Id = c.TX_Usg_CustId
            INNER JOIN t_gn_callhistory d ON a.DM_Id = d.CustomerId
            INNER JOIN cc_recording e ON e.session_key=d.CallSessionId
            INNER JOIN t_lk_callreasoncategory f ON f.CallReasonCategoryId = d.CallCategoryId
            INNER JOIN t_lk_callreason g ON g.CallReasonId = d.CallReasonId
            WHERE 
            d.CallHistoryCreatedTs >= '".$start_date."'
            and d.CallHistoryCreatedTs <= '".$end_date."'
            GROUP BY e.id
        ";
        $res = $this->db->query($sql)->result();
		// var_dump($this->db->last_query());
		// echo count($res);
		// die;
		foreach ($res as $value):
			// var_dump($value['CustNo']);
			?>
			<tr>
			
			<td class="kanan"><?php echo $value->Campaign; ?></td>
			<td class="kanan"><?php echo $value->CustNo; ?></td>
			<td class="kanan"><?php echo $value->FixId; ?></td>
			<td class="kanan"><?php echo $value->CardType; ?></td>
			<td class="kanan"><?php echo $value->AvailableXD; ?></td>
			<td class="kanan"><?php echo $value->Amountclosing; ?></td>
			<td class="kanan"><?php echo $value->Nama; ?></td>
			<td class="kanan"><?php echo $value->CallCategory; ?></td>
			<td class="kanan"><?php echo $value->CallReason; ?></td>
			<td class="kanan"><?php echo $value->CategoryName; ?></td>
			<td class="kanan"><?php echo $value->ReasonDesc; ?></td>
			<td class="kanan"><?php echo $value->AgentCode; ?></td>
			<td class="kanan"><?php echo $value->SPVCode; ?></td>
			<td class="kanan"><?php echo $value->HistoryCalldate; ?></td>
			<td class="kanan"><?php echo $value->Duration; ?></td>
		
			</tr>
		<?php 
			endforeach;
		?>
		</tbody>
		</table>

</body>
</html>
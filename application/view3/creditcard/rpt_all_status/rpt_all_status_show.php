<!DOCTYPE html>
<html>
<head>
	<style>
		table.grid{}
	td.header { background-color:#2182bf;font-family:Arial;font-weight:bold;color:#f1f5f8;font-size:12px;padding:5px;} 
	td.sub { background-color:#82B4FF;font-family:Arial;font-weight:bold;color:#000000;font-size:12px;padding:5px;} 
	td.content { padding:2px;height:24px;font-family:Arial;font-weight:normal;color:#456376;font-size:12px;background-color:#f9fbfd;-mso-format-text:'number' ;

	} 
	td.first {border-left:1px solid #dddddd;border-top:1px solid #dddddd;border-bottom:0px solid #dddddd;}
	td.middle {border-left:1px solid #dddddd;border-bottom:0px solid #dddddd;border-top:1px solid #dddddd;}
	td.lasted {border-left:1px solid #dddddd; border-bottom:0px solid #dddddd; border-right:1px solid #dddddd; border-top:1px solid #dddddd;}
	td.agent{font-family:Arial;font-weight:normal;font-size:12px;padding-top:5px;padding-bottom:5px;border-left:0px solid #dddddd; 
			border-bottom:0px solid #dddddd; border-right:0px solid #dddddd; border-top:0px solid #dddddd;
			background-color:#fcfeff;padding-left:2px;color:#06456d;font-weight:bold;}
	h1.agent{font-style:inherit; font-family:Trebuchet MS;color:blue;font-size:14px;color:#2182bf;}
	
	td.total{
				padding:2px;font-family:Arial;font-weight:normal;font-size:12px;padding-top:5px;padding-bottom:5px;border-left:0px solid #dddddd; 
			border-bottom:1px solid #dddddd; border-top:1px solid #dddddd;  
			border-right:1px solid #dddddd; border-top:1px solid #dddddd;
			background-color:#2182bf;padding-left:2px;color:#f1f5f8;font-weight:bold;}
	
	.middle{color:#306407;font-family:Trebuchet MS;font-size:14px;line-height:18px;}
	
	td.subtotal{ font-family:Arial;font-weight:bold;color:#3c8a08;height:30px;background-color:#FFFCCC;}
	td.tanggal{ font-weight:bold;color:#FF4321;height:22px;background-color:#FFFFFF;height:30px;}
	h3{color:#306407;font-family:Trebuchet MS;font-size:14px;}
	h4{color:#FF4321;font-family:Trebuchet MS;font-size:14px;}
	</style>
<title>Report All Status</title>
</head>
<body>
	<h4>Report All Status</h4>
	<h4>Interval: <?php echo $_REQUEST['start_date']; ?> s/d <?php echo $_REQUEST['end_date']; ?></h4>
	<table>
		<tr>
			<td class="header middle" align="center">No.</td>
			<td class="header middle" align="center">CUST_ID</td>
			<td class="header middle" align="center">FIX_ID</td>
			<td class="header middle" align="center">NAMA_CH</td>
			<td class="header middle" align="center">EXPIRE_DATE</td>
			<td class="header middle" align="center">MMN</td>
			<td class="header middle" align="center">DOB</td>
			<td class="header middle" align="center">H_PHONE</td>
			<td class="header middle" align="center">B_PHONE</td>
			<td class="header middle" align="center">HP</td>
			<td class="header middle" align="center">MEMBAL</td>
			<td class="header middle" align="center">KREDIT_LIMIT</td>
			<td class="header middle" align="center">DLDATE</td>
			<td class="header middle" align="center">RZIPCODE</td>
			<td class="header middle" align="center">LZIPCODE</td>
			<td class="header middle" align="center">BLOCK</td>
			<td class="header middle" align="center">OPDATE</td>
			<td class="header middle" align="center">NO_OF_MONTH</td>
			<td class="header middle" align="center">AVAIL_XD</td>
			<td class="header middle" align="center">AVAIL_SS</td>
			<td class="header middle" align="center">JENIS_KARTU</td>
			<td class="header middle" align="center">CYCLE</td>
			<td class="header middle" align="center">Penawaran</td>
			<td class="header middle" align="center">Note</td>
			<td class="header middle" align="center">Call_Reason</td>
			<td class="header middle" align="center">Call_Result</td>
			<td class="header middle" align="center">Last_Update</td>
			<td class="header middle" align="center">Agent_Code</td>
		</tr>
		<?php
			$no = 1;
			if(is_array($AllStatus)) foreach ($AllStatus as $CampaignId => $rows):
		?>
		<tr>
			<td class="content middle" align="center"><?php echo $no; ?></td>
			<td class="content middle" align="center"><?php __($rows['CUST_ID']); ?></td>
			<td class="content middle" align="center"><?php __($rows['FIX_ID']); ?></td>
			<td class="content middle" align="center"><?php __($rows['NAMA_CH']); ?></td>
			<td class="content middle" align="center"><?php __($rows['EXPIRE_DATE']); ?></td>
			<td class="content middle" align="center"><?php __($rows['MMN']); ?></td>
			<td class="content middle" align="center"><?php __($rows['DOB']); ?></td>
			<td class="content middle" align="center"><?php __($rows['H_PHONE']); ?></td>
			<td class="content middle" align="center"><?php __($rows['B_PHONE']); ?></td>
			<td class="content middle" align="center"><?php __($rows['HP']); ?></td>
			<td class="content middle" align="center"><?php __($rows['MEMBAL']); ?></td>
			<td class="content middle" align="center"><?php __($rows['KREDIT_LIMIT']); ?></td>
			<td class="content middle" align="center"><?php __($rows['DLDATE']); ?></td>
			<td class="content middle" align="center"><?php __($rows['RZIPCODE']); ?></td>
			<td class="content middle" align="center"><?php __($rows['LZIPCODE']); ?></td>
			<td class="content middle" align="center"><?php __($rows['BLOCK']); ?></td>
			<td class="content middle" align="center"><?php __($rows['OPDATE']); ?></td>
			<td class="content middle" align="center"><?php __($rows['NO_OF_MONTH']); ?></td>
			<td class="content middle" align="center"><?php __($rows['AVAIL_XD']); ?></td>
			<td class="content middle" align="center"><?php __($rows['AVAIL_SS']); ?></td>
			<td class="content middle" align="center"><?php __($rows['JENIS_KARTU']); ?></td>
			<td class="content middle" align="center"><?php __($rows['CYCLE']); ?></td>
			<td class="content middle" align="center"><?php __($rows['Penawaran']); ?></td>
			<td class="content middle" align="center"><?php __($rows['Note']); ?></td>
			<td class="content middle" align="center"><?php __($rows['Call_Reason']); ?></td>
			<td class="content middle" align="center"><?php __($rows['Call_Result']); ?></td>
			<td class="content middle" align="center"><?php __($rows['Last_Update']); ?></td>
			<td class="content middle" align="center"><?php __($rows['AgentCode']); ?></td>
		</tr>
		<?php $no++; endforeach; ?>
	</table>

</body>
</html>
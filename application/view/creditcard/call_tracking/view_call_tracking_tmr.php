<?php
	$this->load->view('call_tracking/view_call_tracking_style');
?>
<title>Call Tracking Summary per TMR</title>
Call Tracking Summary by Recsource per TMR Periode of 2016-05-02 to 2016-05-02 <br>
Printed By:18A <br>
Print Date:03/05/2016 06:55:46 <p></p>

<?php
	$Datasize		= 0;
	$Utilize		= 0;
	
	// Call Initiated
	$Contacted		= 0;
	$Freq_1			= 0;
	$Uncontacted	= 0;
	$Freq_2			= 0;
	$Total			= 0;
	$Freq_3			= 0;
	$PercentageUtil	= 0;
	
	// Contacted
	$D				= 0;
	$ST				= 0;
	$CB				= 0;
	$SA				= 0;
	$PU				= 0;
	$GPU			= 0;	
	$CPGP			= 0;
	$INC			= 0;
	$R				= 0;
	$B				= 0;
	$TotalContact	= 0;
	$PercentageCont	= 0;
	
	// Uncontacted
	$NP				= 0;
	$BT				= 0;
	$NA				= 0;
	$MV				= 0;
	$WN				= 0;
	$IDR				= 0;
	$TotalUncontact	= 0;
	$PercentageUn	= 0;
	
	// ETC
	$AddOn			= 0;
	$DL0			= 0;
	$DL1			= 0;
	$DL2			= 0;
	$DL3			= 0;
	$DL4			= 0;
	$DL5			= 0;
	$DL6			= 0;
	$DL7			= 0;
	$DL8			= 0;
	$DL9			= 0;
	$DL10			= 0;
	$DL11			= 0;
	$DL12			= 0;
	$DL13			= 0;
	$DL14			= 0;
	$DL15			= 0;
	$DL16			= 0;
	$DL17			= 0;
	$DL18			= 0;
	$DL19			= 0;
	$DL20			= 0;
	$DL21			= 0;
	$Etc			= 0;
	$LoanAmount		= 0;
	$POD			= 0;
	
	if(is_array($LoopUser) || is_object($LoopUser)) {
		foreach($LoopUser as $ID => $rows) {
		echo $rows;
?>

<table border=0 cellpadding=0 cellspacing=0 style='border-collapse:collapse;'>
	<tr>
		<td rowspan=2 class=xl66>Recsource</td>
		<td rowspan=2 class=xl66>Data Size</td>
		<td rowspan=2 class=xl66>Utilized</td>
		<td colspan=6 class=xl66>Call Initiated</td>
		<td rowspan=2 class=xl67>% Utilized</td>
		<td colspan=12 class=xl66>Contacted</td>
		<td colspan=8 class=xl66>Not Contacted</td>
		<td rowspan=2 class=xl67>ADDON</td>
	<?php for($a=0; $a<=21; $a++) 
			{
	?>
		<td rowspan=2 class=xl67>DL<?php echo $a; ?></td>
	<?php
			}
	?>
		<td rowspan=2 class=xl67>Lain-lain</td>
		<td rowspan=2 class=xl67>Loan Amount</td>
		<td rowspan=2 class=xl67>POD</td>
	</tr>
	<tr>
		<td class=xl66>Contacted</td>
		<td class=xl66>Freq call/lead</td>
		<td class=xl66>Un Contacted</td>
		<td class=xl66>Freq call/lead</td>
		<td class=xl66>Total</td>
		<td class=xl66>Freq call/lead</td>
		<td class=xl66>D</td>
		<td class=xl66>ST</td>
		<td class=xl66>CB</td>
		<td class=xl66>SA</td>
		<td class=xl66>PU</td>
		<td class=xl66>GPU</td>
		<td class=xl66>CPGP</td>
		<td class=xl66>INC</td>
		<td class=xl66>R</td>
		<td class=xl66>B</td>
		<td class=xl66>Total</td>
		<td class=xl66>%</td>
		<td class=xl66>NP</td>
		<td class=xl66>BT</td>
		<td class=xl66>NA</td>
		<td class=xl66>MV</td>
		<td class=xl66>WN</td>
		<td class=xl66>ID</td>
		<td class=xl66>Total</td>
		<td class=xl66>%</td>
	</tr>
	<?php
			// echo "<pre>";
			// print_r($RowData1);
			// echo "</pre>";
			
			if(is_array($RowData1) || is_object($RowData1))
			{
				foreach($RowData1[$ID] as $Data => $rows1)
				{
			
			$Recsource		= ($rows1['Recsource'] ? $rows1['Recsource'] : 0);
			$Datasize		= ($rows1['datasize'] ? $rows1['datasize'] : 0);
			$Utilize		= ($RowData2[$ID][$Data]['utilize'] ? $RowData2[$ID][$Data]['utilize'] : 0);
			
			// Contacted
			$D				= ($RowData3[$ID][$Data]['D'] ? $RowData3[$ID][$Data]['D'] : 0);
			$ST				= ($RowData3[$ID][$Data]['ST'] ? $RowData3[$ID][$Data]['ST'] : 0);
			$CB				= ($RowData3[$ID][$Data]['CB'] ? $RowData3[$ID][$Data]['CB'] : 0);
			$SA				= ($RowData3[$ID][$Data]['SA'] ? $RowData3[$ID][$Data]['SA'] : 0);
			$PU				= ($RowData3[$ID][$Data]['PU'] ? $RowData3[$ID][$Data]['PU'] : 0);
			$GPU			= ($RowData3[$ID][$Data]['GPU'] ? $RowData3[$ID][$Data]['GPU'] : 0);	
			$CPGP			= ($RowData3[$ID][$Data]['CPGP'] ? $RowData3[$ID][$Data]['CPGP'] : 0);
			$INC			= ($RowData3[$ID][$Data]['INC'] ? $RowData3[$ID][$Data]['INC'] : 0);
			$R				= ($RowData3[$ID][$Data]['R'] ? $RowData3[$ID][$Data]['R'] : 0);
			$B				= ($RowData3[$ID][$Data]['B'] ? $RowData3[$ID][$Data]['B'] : 0);
			$TotalContact	= ($D + $ST + $CB + $SA + $PU + $GPU + $CPGP + $INC + $R + $B);
			$PercentageCont	= (($TotalContact / 10) * 100);
			
			// Uncontacted
			$NP				= ($RowData3[$ID][$Data]['NP'] ? $RowData3[$ID][$Data]['NP'] : 0);
			$BT				= ($RowData3[$ID][$Data]['BT'] ? $RowData3[$ID][$Data]['BT'] : 0);
			$NA				= ($RowData3[$ID][$Data]['NA'] ? $RowData3[$ID][$Data]['NA'] : 0);
			$MV				= ($RowData3[$ID][$Data]['MV'] ? $RowData3[$ID][$Data]['MV'] : 0);
			$WN				= ($RowData3[$ID][$Data]['WN'] ? $RowData3[$ID][$Data]['WN'] : 0);
			$IDR				= ($RowData3[$ID][$Data]['ID'] ? $RowData3[$ID][$Data]['ID'] : 0);
			$TotalUncontact	= ($NP + $BT + $NA + $MV + $WN + $IDR);
			$PercentageUn	= (($TotalUncontact / 6) * 100);
			
			// ETC
			// $AddOn			= ($RowData3[$ID][$Data]['AddOn'] ? $RowData3[$ID][$Data]['AddOn'] : 0);
			// echo "<pre>";
			// print_r($RowData3);
			// echo "</pre>";
			$AddOn			= ($RowData3[$ID][$Data]['NP'] ? $RowData3[$ID][$Data]['NP'] : 0);
			$DL0			= ($RowData3[$ID][$Data]['DL0'] ? $RowData3[$ID][$Data]['DL0'] : 0);
			$DL1			= ($RowData3[$ID][$Data]['DL1'] ? $RowData3[$ID][$Data]['DL1'] : 0);
			$DL2			= ($RowData3[$ID][$Data]['DL2'] ? $RowData3[$ID][$Data]['DL2'] : 0);
			$DL3			= ($RowData3[$ID][$Data]['DL3'] ? $RowData3[$ID][$Data]['DL3'] : 0);
			$DL4			= ($RowData3[$ID][$Data]['DL4'] ? $RowData3[$ID][$Data]['DL4'] : 0);
			$DL5			= ($RowData3[$ID][$Data]['DL5'] ? $RowData3[$ID][$Data]['DL5'] : 0);
			$DL6			= ($RowData3[$ID][$Data]['DL6'] ? $RowData3[$ID][$Data]['DL6'] : 0);
			$DL7			= ($RowData3[$ID][$Data]['DL7'] ? $RowData3[$ID][$Data]['DL7'] : 0);
			$DL8			= ($RowData3[$ID][$Data]['DL8'] ? $RowData3[$ID][$Data]['DL8'] : 0);
			$DL9			= ($RowData3[$ID][$Data]['DL9'] ? $RowData3[$ID][$Data]['DL9'] : 0);
			$DL10			= ($RowData3[$ID][$Data]['DL10'] ? $RowData3[$ID][$Data]['DL10'] : 0);
			$DL11			= ($RowData3[$ID][$Data]['DL11'] ? $RowData3[$ID][$Data]['DL11'] : 0);
			$DL12			= ($RowData3[$ID][$Data]['DL12'] ? $RowData3[$ID][$Data]['DL12'] : 0);
			$DL13			= ($RowData3[$ID][$Data]['DL13'] ? $RowData3[$ID][$Data]['DL13'] : 0);
			$DL14			= ($RowData3[$ID][$Data]['DL14'] ? $RowData3[$ID][$Data]['DL14'] : 0);
			$DL15			= ($RowData3[$ID][$Data]['DL15'] ? $RowData3[$ID][$Data]['DL15'] : 0);
			$DL16			= ($RowData3[$ID][$Data]['DL16'] ? $RowData3[$ID][$Data]['DL16'] : 0);
			$DL17			= ($RowData3[$ID][$Data]['DL17'] ? $RowData3[$ID][$Data]['DL17'] : 0);
			$DL18			= ($RowData3[$ID][$Data]['DL18'] ? $RowData3[$ID][$Data]['DL18'] : 0);
			$DL19			= ($RowData3[$ID][$Data]['DL19'] ? $RowData3[$ID][$Data]['DL19'] : 0);
			$DL20			= ($RowData3[$ID][$Data]['DL20'] ? $RowData3[$ID][$Data]['DL20'] : 0);
			$DL21			= ($RowData3[$ID][$Data]['DL21'] ? $RowData3[$ID][$Data]['DL21'] : 0);
			$Etc			= ($RowData3[$ID][$Data]['Dll'] ? $RowData3[$ID][$Data]['Dll'] : 0);
			$LoanAmount		= ($RowData3[$ID][$Data]['LoadAmount'] ? $RowData3[$ID][$Data]['LoadAmount'] : 0);
			$POD			= ($RowData3[$ID][$Data]['POD'] ? $RowData3[$ID][$Data]['POD'] : 0);
			$Total			= $TotalContact + $TotalUncontact;
			$Freq_1			= (($TotalContact / $Datasize) * 100);
			$Freq_2			= (($TotalUncontact / $Datasize) * 100);
			$Freq_3			= (($Total / $Datasize) * 100);
			$PercentageUtil	= (($Utilize / $Datasize) * 100);
	?>
	<tr class=xl74>
		<td class=xl71><?php echo $Recsource; ?></td>
		<td class=xl71><?php echo $Datasize; ?></td>
		<td class=xl71><?php echo $Utilize; ?></td>
		<td class=xl71><?php echo $TotalContact; ?></td>
		<td class=xl72><?php echo round($Freq_1,2); ?> %</td>
		<td class=xl71><?php echo $TotalUncontact; ?></td>
		<td class=xl72><?php echo round($Freq_2,2); ?> %</td>
		<td class=xl71><?php echo $Total; ?></td>
		<td class=xl72><?php echo round($Freq_3,2); ?> %</td>
		<td class=xl73><?php echo round($PercentageUtil,2); ?> %</td>
		<td class=xl71><?php echo $D; ?></td>
		<td class=xl71><?php echo $ST; ?></td>
		<td class=xl71><?php echo $CB; ?></td>
		<td class=xl71><?php echo $SA; ?></td>
		<td class=xl71><?php echo $PU; ?></td>
		<td class=xl71><?php echo $GPU; ?></td>
		<td class=xl71><?php echo $CPGP; ?></td>
		<td class=xl71><?php echo $INC; ?></td>
		<td class=xl71><?php echo $R; ?></td>
		<td class=xl71><?php echo $B; ?></td>
		<td class=xl71><?php echo $TotalContact; ?></td>
		<td class=xl73><?php echo round($PercentageCont,2); ?> %</td>
		<td class=xl71><?php echo $NP; ?></td>
		<td class=xl71><?php echo $BT; ?></td>
		<td class=xl71><?php echo $NA; ?></td>
		<td class=xl71><?php echo $MV; ?></td>
		<td class=xl71><?php echo $WN; ?></td>
		<td class=xl71><?php echo $IDR; ?></td>
		<td class=xl71><?php echo $TotalUncontact; ?></td>
		<td class=xl73><?php echo round($PercentageUn,2); ?> %</td>
		<td class=xl71><?php echo $AddOn; ?></td>		
		<td class=xl71><?php echo $DL0; ?></td>
		<td class=xl71><?php echo $DL1; ?></td>
		<td class=xl71><?php echo $DL2; ?></td>
		<td class=xl71><?php echo $DL3; ?></td>
		<td class=xl71><?php echo $DL4; ?></td>
		<td class=xl71><?php echo $DL5; ?></td>
		<td class=xl71><?php echo $DL6; ?></td>
		<td class=xl71><?php echo $DL7; ?></td>
		<td class=xl71><?php echo $DL8; ?></td>
		<td class=xl71><?php echo $DL9; ?></td>
		<td class=xl71><?php echo $DL10; ?></td>
		<td class=xl71><?php echo $DL11; ?></td>
		<td class=xl71><?php echo $DL12; ?></td>
		<td class=xl71><?php echo $DL13; ?></td>
		<td class=xl71><?php echo $DL14; ?></td>
		<td class=xl71><?php echo $DL15; ?></td>
		<td class=xl71><?php echo $DL16; ?></td>
		<td class=xl71><?php echo $DL17; ?></td>
		<td class=xl71><?php echo $DL18; ?></td>
		<td class=xl71><?php echo $DL19; ?></td>
		<td class=xl71><?php echo $DL20; ?></td>
		<td class=xl71><?php echo $DL21; ?></td>
		<td class=xl71><?php echo $Etc; ?></td>
		<td class=xl71><?php echo $LoanAmount; ?></td>
		<td class=xl71><?php echo $POD; ?></td>
	</tr>
	<?php
				}
			}
	?>
	<tr>
		<td class=xl66>Total</td>
		<td class=xl66>&nbsp;</td>
		<td class=xl66>&nbsp;</td>
		<td class=xl66>&nbsp;</td>
		<td class=xl69>&nbsp;</td>
		<td class=xl66>&nbsp;</td>
		<td class=xl69>&nbsp;</td>
		<td class=xl66>&nbsp;</td>
		<td class=xl69>&nbsp;</td>
		<td class=xl70>&nbsp;</td>
		<td class=xl66>&nbsp;</td>
		<td class=xl66>&nbsp;</td>
		<td class=xl66>&nbsp;</td>
		<td class=xl66>&nbsp;</td>
		<td class=xl66>&nbsp;</td>
		<td class=xl66>&nbsp;</td>
		<td class=xl66>&nbsp;</td>
		<td class=xl66>&nbsp;</td>
		<td class=xl66>&nbsp;</td>
		<td class=xl66>&nbsp;</td>
		<td class=xl66>&nbsp;</td>
		<td class=xl70>&nbsp;</td>
		<td class=xl66>&nbsp;</td>
		<td class=xl66>&nbsp;</td>
		<td class=xl66>&nbsp;</td>
		<td class=xl66>&nbsp;</td>
		<td class=xl66>&nbsp;</td>
		<td class=xl66>&nbsp;</td>
		<td class=xl66>&nbsp;</td>
		<td class=xl70>&nbsp;</td>
		<td class=xl66>&nbsp;</td>
		<td class=xl66>&nbsp;</td>
		<td class=xl66>&nbsp;</td>
		<td class=xl66>&nbsp;</td>
		<td class=xl66>&nbsp;</td>
		<td class=xl66>&nbsp;</td>
		<td class=xl66>&nbsp;</td>
		<td class=xl66>&nbsp;</td>
		<td class=xl66>&nbsp;</td>
		<td class=xl66>&nbsp;</td>
		<td class=xl66>&nbsp;</td>
		<td class=xl66>&nbsp;</td>
		<td class=xl66>&nbsp;</td>
		<td class=xl66>&nbsp;</td>
		<td class=xl66>&nbsp;</td>
		<td class=xl66>&nbsp;</td>
		<td class=xl66>&nbsp;</td>
		<td class=xl66>&nbsp;</td>
		<td class=xl66>&nbsp;</td>
		<td class=xl66>&nbsp;</td>
		<td class=xl66>&nbsp;</td>
		<td class=xl66>&nbsp;</td>
		<td class=xl66>&nbsp;</td>
		<td class=xl66>&nbsp;</td>
		<td class=xl66>&nbsp;</td>
		<td class=xl66>&nbsp;</td>
	</tr>
</table>
<?php
		}
	}
?>
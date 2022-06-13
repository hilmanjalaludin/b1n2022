<style>
	table.grid{}
	td.header { background-color:#2182bf;font-family:Arial;font-weight:bold;color:#f1f5f8;font-size:12px;padding:5px;} 
	td.sub { background-color:#82B4FF;font-family:Arial;font-weight:bold;color:#000000;font-size:12px;padding:5px;} 
	td.content { padding:2px;height:24px;font-family:Arial;font-weight:normal;color:#456376;font-size:12px;background-color:#f9fbfd;} 
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
<?php
	$Today = date("d-m-Y");
 ?>
<pre><font class="middle">
	Report Type	   : Raw Data Report
	Filter		   : <?php __(_get_post('filter')); ?>
	
	User Insert	   : <?php __(_get_post('mode')); ?>
	
	User Insert Date : <?php __(_get_post('start_date')); ?> s/d <?php __(_get_post('end_date')); ?>
	
	Show Date	   : <?php echo $Today; ?>
	</font>
</pre>
<table class="grid" cellpadding="0" cellspacing="0" width="90%">
	<!-- <tr>
		<td colspan="91" class="sub" align="left">Agent</td>
	</tr> -->
	<tr>
		<td rowspan=3 class="header first" align="center" align="center">No.</td>
		<td rowspan=3 class="header middle" align="center">Campaign ID</td>
		<td rowspan=3 class="header middle" align="center" align="center">Campaign Name</td>
		<td rowspan=3 class="header middle" align="center" align="center">Batch ID</td>
		<td rowspan=3 class="header middle" align="center" align="center">Batch Name</td>
		<td rowspan=3 class="header middle" align="center" align="center">Upload Data</td>
		<td colspan=3 class="header middle" align="center" align="center">Data New Today</td>
		<td colspan=2 class="header middle" align="center">Data Old</td>
		<td rowspan=3 class="header middle" align="center">Total Utilized</td>
		<td rowspan=3 class="header middle" align="center">Call Attempt</td>
		<td rowspan=3 class="header middle" align="center">AVG Call</td>
		<td colspan=5 class="header middle" align="center">Connect</td>
		<td rowspan=3 class="header middle" align="center">Connect Rate</td>
		<td colspan=7 class="header middle" align="center">Contact</td>
		<td rowspan=3 class="header middle" align="center">Contact Rate</td>
		<td colspan=2 class="header middle" align="center">Follow UP</td>
		<td colspan=12 class="header middle" align="center">Interest</td>
		<td rowspan=3 class="header middle" align="center">Respon Rate</td>
		<td rowspan=3 class="header middle" align="center">Confersion Rate</td>
		<td colspan=7 class="header middle" align="center">Not Qualified</td>
		<td colspan=2 class="header middle" align="center">New Database</td>
		<td colspan=2 class="header middle" align="center">Old Database</td>
		<td colspan=2 class="header middle" align="center">Grand Database</td>
		<td colspan=23 class="header middle" align="center">Profile Customer</td>
		<td colspan=8 class="header middle" align="center">QA Monitoring</td>
		<td colspan=2 class="header lasted" align="center">Cancel On Grand Spot</td>
	</tr>
	<tr>
		<td rowspan=2 class="header middle" align="center">Today</td>
		<td rowspan=2 class="header middle" align="center">Utilized</td>
		<td rowspan=2 class="header middle" align="center">Remaining</td>
		<td rowspan=2 class="header middle" align="center">Utilized</td>
		<td rowspan=2 class="header middle" align="center">Remaining</td>
		<td rowspan=2 class="header middle" align="center">Y</td>
		<td colspan=4 class="header middle" align="center">N</td>
		<td rowspan=2 class="header middle" align="center">Y</td>
		<td colspan=6 class="header middle" align="center">N</td>
		<td rowspan=2 class="header middle" align="center">Thinking (301)</td>
		<td rowspan=2 class="header middle" align="center">Call Back Later (302)</td>
		<td colspan=3 class="header middle" align="center">Y</td>
		<td colspan=9 class="header middle" align="center">N</td>
		<td rowspan=2 class="header middle" align="center">Reject BMI (501)</td>
		<td rowspan=2 class="header middle" align="center">Med. Questions (502)</td>
		<td rowspan=2 class="header middle" align="center">Overage / Underage (503)</td>
		<td rowspan=2 class="header middle" align="center">Unqualified Health Questions (504)</td>
		<td rowspan=2 class="header middle" align="center">Others (505)</td>
		<td rowspan=2 class="header middle" align="center">Out Of Courier Area (506)</td>
		<td rowspan=2 class="header middle" align="center">Request Case Payment (507)</td>
		<td rowspan=2 class="header middle" align="center">Cases</td>
		<td rowspan=2 class="header middle" align="center">Anp</td>
		<td rowspan=2 class="header middle" align="center">Cases</td>
		<td rowspan=2 class="header middle" align="center">Anp</td>
		<td rowspan=2 class="header middle" align="center">Cases</td>
		<td rowspan=2 class="header middle" align="center">Anp</td>
		<td colspan=2 class="header middle" align="center">Coverage</td>
		<td colspan=9 class="header middle" align="center">Range</td>
		<td colspan=2 class="header middle" align="center">Gender</td>
		<td colspan=6 class="header middle" align="center">Payment Media</td>
		<td colspan=4 class="header middle" align="center">Pay Mode</td>
		<td colspan=4 class="header middle" align="center">Verified</td>
		<td colspan=2 class="header middle" align="center">Follow up</td>
		<td colspan=2 class="header middle" align="center">Reject</td>
		<td rowspan=2 class="header middle" align="center">Cases</td>
		<td rowspan=2 class="header middle" align="center">Tarp</td>
	</tr>
	<tr>
		<td class="header middle" align="center">Invalid No (101)</td>
		<td class="header middle" align="center">Busy Line (102)</td>
		<td class="header middle" align="center">Fax No (103)</td>
		<td class="header middle" align="center">No Answer (104)</td>
		<td class="header middle" align="center">Wrong No (201)</td>
		<td class="header middle" align="center">Already Moved (202)</td>
		<td class="header middle" align="center">Resign (203)</td>
		<td class="header middle" align="center">Mailbox(204)</td>
		<td class="header middle" align="center">Meeting (205)</td>
		<td class="header middle" align="center">Can`t Be Reach (299)</td>
		<td class="header middle" align="center">Trust Bank (901)</td>
		<td class="header middle" align="center">Trust Insurance (902)</td>
		<td class="header middle" align="center">Cheap (903)</td>
		<td class="header middle" align="center">Reject In Front (401)</td>
		<td class="header middle" align="center">Spouse Doesnt Agree (402)</td>
		<td class="header middle" align="center">Not Buy Via Phone (403)</td>
		<td class="header middle" align="center">Already Insured (404)</td>
		<td class="header middle" align="center">No Money (405)</td>
		<td class="header middle" align="center">Need High Benefit (406)</td>
		<td class="header middle" align="center">Expensive (407)</td>
		<td class="header middle" align="center">Reluctant To Give CC No (408)</td>
		<td class="header middle" align="center">Pending Info (808)</td>
		<td class="header middle" align="center">Buy Self</td>
		<td class="header middle" align="center">Buy Others</td>
		<td class="header middle" align="center">0-10</td>
		<td class="header middle" align="center">11-20</td>
		<td class="header middle" align="center">21-30</td>
		<td class="header middle" align="center">31-40</td>
		<td class="header middle" align="center">41-49</td>
		<td class="header middle" align="center">50-55</td>
		<td class="header middle" align="center">56-60</td>
		<td class="header middle" align="center">61-65</td>
		<td class="header middle" align="center">65-70</td>
		<td class="header middle" align="center">M</td>
		<td class="header middle" align="center">F</td>
		<td class="header middle" align="center">Credit Card</td>
		<td class="header middle" align="center">Direct Debit</td>
		<td class="header middle" align="center">Transfer</td>
		<td class="header middle" align="center">ANP - Credit Card</td>
		<td class="header middle" align="center">ANP - Direct Debit</td>
		<td class="header middle" align="center">ANP - Transfer</td>
		<td class="header middle" align="center">Monthly</td>
		<td class="header middle" align="center">Quarter</td>
		<td class="header middle" align="center">Semi Annual</td>
		<td class="header middle" align="center">Annual</td>
		<td class="header middle" align="center">Monitored</td>
		<td class="header middle" align="center">%</td>
		<td class="header middle" align="center">Verified</td>
		<td class="header middle" align="center">%</td>
		<td class="header middle" align="center">Cases</td>
		<td class="header middle" align="center">Tarp</td>
		<td class="header middle" align="center">Cases</td>
		<td class="header middle" align="center">Tarp</td>
	</tr>
	
	<?php
		$no=1;
		$sToday = 0;
		
		if(is_array($view)) foreach ($view as $CampaignId => $rows) :
		/* Start Data New Today */
			$Today = ($view2[$CampaignId]['Today']?$view2[$CampaignId]['Today']:0);
			$TodayUtilized = ($view2[$CampaignId]['Utilized']?$view2[$CampaignId]['Utilized']:0);
			$TodayRemaining = ($view2[$CampaignId]['Remaining']?$view2[$CampaignId]['Remaining']:0);
		/* End Data New Today */
		
		/* Start Old Data */
			$OldUtilized = ($view3[$CampaignId]['OldUtilized']?$view3[$CampaignId]['OldUtilized']:0);
			$OldRemaining = ($view3[$CampaignId]['OldRemaining']?$view3[$CampaignId]['OldRemaining']:0);
		/* End Old Data */
		
		/* Start Total Utilized */
			$TotUtilized = ($view4[$CampaignId]['TotUtilized']?$view4[$CampaignId]['TotUtilized']:0);
		/* End Total Utilized */
		
		/* Start Call Attempt */
			$CallAttempt = ($view4[$CampaignId]['CallAttempt']?$view4[$CampaignId]['CallAttempt']:0);
		/* End Call Attempt */
		
		/* Start Rumus */
			$AvgCall = $view4[$CampaignId]['CallAttempt'] / $view4[$CampaignId]['TotUtilized'];
			$ConnectRate = (($view4[$CampaignId]['WrongNum']+$view4[$CampaignId]['AlreadyMove']+$view4[$CampaignId]['Resign']+
							$view4[$CampaignId]['Mailbox']+$view4[$CampaignId]['Meeting']+$view4[$CampaignId]['CantBeReached']) / $view4[$CampaignId]['TotUtilized']);
			$GrandCases = ($view5[$CampaignId]['NewCases'] + $view6[$CampaignId]['OldCases']);
			$GrandAnp = ($view5[$CampaignId]['NewANP'] + $view6[$CampaignId]['OldANP']);
			$YesConnect = ($view4[$CampaignId]['WrongNum']+$view4[$CampaignId]['AlreadyMove']+$view4[$CampaignId]['Resign']+
							$view4[$CampaignId]['Mailbox']+$view4[$CampaignId]['Meeting']+$view4[$CampaignId]['CantBeReached']);
			$YesContact = 	($view4[$CampaignId]['Thinking'] + $view4[$CampaignId]['CallBack']) +
							($view4[$CampaignId]['TrustBank'] + $view4[$CampaignId]['TrustInsurance'] + $view4[$CampaignId]['Cheap']) +
							($view4[$CampaignId]['RejectUpFront'] + $view4[$CampaignId]['SpouseDoesnt'] + $view4[$CampaignId]['NotBuy'] +
							$view4[$CampaignId]['AlreadyInsured'] + $view4[$CampaignId]['NoMoney'] + $view4[$CampaignId]['NeedHighBenefit'] +
							$view4[$CampaignId]['Expensive'] + $view4[$CampaignId]['Reluctant'] + $view4[$CampaignId]['PendingInfo']) +
							($view4[$CampaignId]['RejectBMI'] + $view4[$CampaignId]['MedQuestion'] + $view4[$CampaignId]['Overage']+
							$view4[$CampaignId]['Unqualified'] + $view4[$CampaignId]['Other'] + $view4[$CampaignId]['OutOfCourier']+
							$view4[$CampaignId]['RequestCase']);
			$ContactRate = ((($view4[$CampaignId]['Thinking'] + $view4[$CampaignId]['CallBack']) +
							($view4[$CampaignId]['TrustBank'] + $view4[$CampaignId]['TrustInsurance'] + $view4[$CampaignId]['Cheap']) +
							($view4[$CampaignId]['RejectUpFront'] + $view4[$CampaignId]['SpouseDoesnt'] + $view4[$CampaignId]['NotBuy'] +
							$view4[$CampaignId]['AlreadyInsured'] + $view4[$CampaignId]['NoMoney'] + $view4[$CampaignId]['NeedHighBenefit'] +
							$view4[$CampaignId]['Expensive'] + $view4[$CampaignId]['Reluctant'] + $view4[$CampaignId]['PendingInfo']) +
							($view4[$CampaignId]['RejectBMI'] + $view4[$CampaignId]['MedQuestion'] + $view4[$CampaignId]['Overage']+
							$view4[$CampaignId]['Unqualified'] + $view4[$CampaignId]['Other'] + $view4[$CampaignId]['OutOfCourier']+
							$view4[$CampaignId]['RequestCase'])) / $view4[$CampaignId]['TotUtilized']);
			$ResponRate = ($GrandCases / $TotUtilized);
			$ConfersionRate = ($GrandCases / $YesContact);
		/* End Rumus */
		
		/* Start Reason Connect */
			$Invalid = ($view4[$CampaignId]['Invalid']?$view4[$CampaignId]['Invalid']:0);
			$Busy = ($view4[$CampaignId]['BusyLine']?$view4[$CampaignId]['BusyLine']:0);
			$FaxNo = ($view4[$CampaignId]['FaxNum']?$view4[$CampaignId]['FaxNum']:0);
			$NoAnswer = ($view4[$CampaignId]['NoAnswer']?$view4[$CampaignId]['NoAnswer']:0);
			$WrongNo = ($view4[$CampaignId]['WrongNum']?$view4[$CampaignId]['WrongNum']:0);
			$AlreadyMove =  ($view4[$CampaignId]['AlreadyMove']?$view4[$CampaignId]['AlreadyMove']:0);
			$Resign = ($view4[$CampaignId]['Resign']?$view4[$CampaignId]['Resign']:0);
			$Mailbox = ($view4[$CampaignId]['Mailbox']?$view4[$CampaignId]['Mailbox']:0);
			$Meeting = ($view4[$CampaignId]['Meeting']?$view4[$CampaignId]['Meeting']:0);
			$CantBeReached = ($view4[$CampaignId]['CantBeReached']?$view4[$CampaignId]['CantBeReached']:0);
			$Thinking = ($view4[$CampaignId]['Thinking']?$view4[$CampaignId]['Thinking']:0);
			$Callback = ($view4[$CampaignId]['CallBack']?$view4[$CampaignId]['CallBack']:0);
			$TrustBank = ($view4[$CampaignId]['TrustBank']?$view4[$CampaignId]['TrustBank']:0);
			$TrustInsurance = ($view4[$CampaignId]['TrustInsurance']?$view4[$CampaignId]['TrustInsurance']:0);
			$Cheap = ($view4[$CampaignId]['Cheap']?$view4[$CampaignId]['Cheap']:0);
			$Reject = ($view4[$CampaignId]['RejectUpFront']?$view4[$CampaignId]['RejectUpFront']:0);
			$SpouseDoesnt = ($view4[$CampaignId]['SpouseDoesnt']?$view4[$CampaignId]['SpouseDoesnt']:0);
			$NotBuy = ($view4[$CampaignId]['NotBuy']?$view4[$CampaignId]['NotBuy']:0);
			$AlreadyInsured = ($view4[$CampaignId]['AlreadyInsured']?$view4[$CampaignId]['AlreadyInsured']:0);
			$NoMoney = ($view4[$CampaignId]['NoMoney']?$view4[$CampaignId]['NoMoney']:0);
			$NeedHighBenefit = ($view4[$CampaignId]['NeedHighBenefit']?$view4[$CampaignId]['NeedHighBenefit']:0);
			$Expensive = ($view4[$CampaignId]['Expensive']?$view4[$CampaignId]['Expensive']:0);
			$Reluctant = ($view4[$CampaignId]['Reluctant']?$view4[$CampaignId]['Reluctant']:0);
			$PendingInfo = ($view4[$CampaignId]['PendingInfo']?$view4[$CampaignId]['PendingInfo']:0);
			$RejectBMI = ($view4[$CampaignId]['RejectBMI']?$view4[$CampaignId]['RejectBMI']:0);
			$MedQuestion = ($view4[$CampaignId]['MedQuestion']?$view4[$CampaignId]['MedQuestion']:0);
			$Overage = ($view4[$CampaignId]['Overage']?$view4[$CampaignId]['Overage']:0);
			$Unqualified = ($view4[$CampaignId]['Unqualified']?$view4[$CampaignId]['Unqualified']:0);
			$Other = ($view4[$CampaignId]['Other']?$view4[$CampaignId]['Other']:0);
			$OutOfCourier = ($view4[$CampaignId]['OutOfCourier']?$view4[$CampaignId]['OutOfCourier']:0);
			$RequestCase = ($view4[$CampaignId]['RequestCase']?$view4[$CampaignId]['RequestCase']:0);
		/* End Reason Connect */
		
		/* Start New Database */
			$NewCases = ($view5[$CampaignId]['NewCases']?$view5[$CampaignId]['NewCases']:0);
			$NewAnp = ($view5[$CampaignId]['NewANP']?$view5[$CampaignId]['NewANP']:0);
		/* End New Database */
		
		/* Start Old Database */
			$OldCases = ($view6[$CampaignId]['OldCases']?$view6[$CampaignId]['OldCases']:0);
			$OldAnp = ($view6[$CampaignId]['OldANP']?$view6[$CampaignId]['OldANP']:0);
		/* End Old Database */
		
		/* Start Coverage */
			$BuySelf = ($view7[$CampaignId]['BuySelf']?$view7[$CampaignId]['BuySelf']:0);
			$BuyOther = ($view7[$CampaignId]['BuyOthers']?$view7[$CampaignId]['BuyOthers']:0);
		/* End Coverage */
		
		/* Start Range Age */
			$U10 = ($view8[$CampaignId]['U10']?$view8[$CampaignId]['U10']:0);
			$U20 = ($view8[$CampaignId]['U20']?$view8[$CampaignId]['U20']:0);
			$U30 = ($view8[$CampaignId]['U30']?$view8[$CampaignId]['U30']:0);
			$U40 = ($view8[$CampaignId]['U40']?$view8[$CampaignId]['U40']:0);
			$U49 = ($view8[$CampaignId]['U49']?$view8[$CampaignId]['U49']:0);
			$U55 = ($view8[$CampaignId]['U55']?$view8[$CampaignId]['U55']:0);
			$U60 = ($view8[$CampaignId]['U60']?$view8[$CampaignId]['U60']:0);
			$U65 = ($view8[$CampaignId]['U65']?$view8[$CampaignId]['U65']:0);
			$U70 = ($view8[$CampaignId]['U70']?$view8[$CampaignId]['U70']:0);
		/* End Range Age */
		
		/* Start Gender */
			$Male = ($view9[$CampaignId]['Male']?$view9[$CampaignId]['Male']:0);
			$Female = ($view9[$CampaignId]['Female']?$view9[$CampaignId]['Female']:0);
		/* End Gender */
		
		/* Start Payment Media */
			$Kredit = ($view10[$CampaignId]['Female']?$view10[$CampaignId]['Female']:0);
			$AnpKredit = ($view10[$CampaignId]['Female']?$view10[$CampaignId]['Female']:0);
			$Debit = ($view10[$CampaignId]['Female']?$view10[$CampaignId]['Female']:0);
			$AnpDebit = ($view10[$CampaignId]['Female']?$view10[$CampaignId]['Female']:0);
			$Transfer = ($view10[$CampaignId]['Female']?$view10[$CampaignId]['Female']:0);
			$AnpTransfer = ($view10[$CampaignId]['Female']?$view10[$CampaignId]['Female']:0);
		/* End Payment Media */
		
		/* Start Paymode */
			$Annual = ($view11[$CampaignId]['Annual']?$view11[$CampaignId]['Annual']:0);
			$Monthly = ($view11[$CampaignId]['Monthly']?$view11[$CampaignId]['Monthly']:0);
			$Quarterly = ($view11[$CampaignId]['Quarterly']?$view11[$CampaignId]['Quarterly']:0);
			$SemiAnnual = ($view11[$CampaignId]['SemiAnnual']?$view11[$CampaignId]['SemiAnnual']:0);
		/* End Paymode */
		
		/* Start QA Monitoring */
			$Monitored = ($view12[$CampaignId]['Monitored']?$view12[$CampaignId]['Monitored']:0);
			$Verified = ($view12[$CampaignId]['Verified']?$view12[$CampaignId]['Verified']:0);
			$CaseFollowup = ($view12[$CampaignId]['CasesFollowup']?$view12[$CampaignId]['CasesFollowup']:0);
			$TarpFollowup = ($view12[$CampaignId]['TarpFollowup']?$view12[$CampaignId]['TarpFollowup']:0);
			$CaseReject = ($view12[$CampaignId]['CasesReject']?$view12[$CampaignId]['CasesReject']:0);
			$TarpReject = ($view12[$CampaignId]['TarpReject']?$view12[$CampaignId]['TarpReject']:0);
		/* End QA Monitoring */
		
		/* Start Cancel Grand Spot */
			$CasesCancel = ($view13[$CampaignId]['CasesCancel']?$view13[$CampaignId]['CasesCancel']:0);
			$TarpCancel = ($view13[$CampaignId]['TarpCancel']?$view13[$CampaignId]['TarpCancel']:0);
		/* End Cancel Grand Spot */
		
			// $YesConnect = ($rows['InvalidNo'] + $rows['BusyLine'] + $rows['FaxNum'] + $rows['NoAnswer']);
			//$ConnectRate = ($YesConnect / $rows['TotUtilized']);
			$M = ($rows['Thinking'] + $rows['CallBack']);
			$N = ($rows['TrustBank'] + $rows['TrustInsurance'] + $rows['Cheap'] + $rows['Other']);
			$O = ($rows['RejectUpFront']+$rows['SpouseDoesnt']+$rows['NotBuy']+$rows['AlreadyInsured']+$rows['NoMoney']+$rows['NeedHighBenefit']+$rows['Expensive']+$rows['Reluctant']);
			$R = ($rows['RejectBMI']+$rows['MedQuestion']+$rows['Overage']+$rows['Unqualified']+$rows['Other']+$rows['OutOfCourier']+$rows['RequestCase']);
	?>
	<tr>
		<td class="content first" align="left">&nbsp;<?php __($no); ?></td>
		<td class="content middle" align="left">&nbsp;<?php __($rows['CampaignNo']); ?></td>
		<td class="content middle" align="left">&nbsp;<?php __($rows['CampaignName']); ?></td>
		<td class="content middle" align="left">&nbsp;<?php __($rows['BatchId']); ?></td>
		<td class="content middle" align="left">&nbsp;<?php __($rows['BatchName']); ?></td>
		<td class="content middle" align="right">&nbsp;<?php echo number_format($rows['UploadData']); ?></td>
		
		<td class="content middle" align="right">&nbsp;<?php echo number_format($Today); ?></td>
		<td class="content middle" align="right">&nbsp;<?php echo number_format($TodayUtilized); ?></td>
		<td class="content middle" align="right">&nbsp;<?php echo number_format($TodayRemaining); ?></td>
			
		<td class="content middle" align="right">&nbsp;<?php echo $OldUtilized; ?></td>
		<td class="content middle" align="right">&nbsp;<?php echo $OldRemaining; ?></td>
		
		<td class="content middle" align="right">&nbsp;<?php echo number_format($TotUtilized); ?></td>
		<td class="content middle" align="right">&nbsp;<?php echo number_format($CallAttempt); ?></td>
		<td class="content middle" align="right">&nbsp;<?php echo round(($AvgCall),2); ?></td>
		
		<td class="content middle" align="right">&nbsp;<?php echo ($YesConnect); ?></td>
		<td class="content middle" align="right">&nbsp;<?php echo number_format($Invalid); ?></td>
		<td class="content middle" align="right">&nbsp;<?php echo number_format($Busy); ?></td>
		<td class="content middle" align="right">&nbsp;<?php echo number_format($FaxNo); ?></td>
		<td class="content middle" align="right">&nbsp;<?php echo number_format($NoAnswer); ?></td>
		
		<td class="content middle" align="right">&nbsp;<?php echo round(($ConnectRate),2); ?></td>
		
		<td class="content middle" align="right">&nbsp;<?php echo ($YesContact); ?></td>
		<td class="content middle" align="right">&nbsp;<?php echo number_format($WrongNo); ?></td>
		<td class="content middle" align="right">&nbsp;<?php echo number_format($AlreadyMove); ?></td>
		<td class="content middle" align="right">&nbsp;<?php echo number_format($Resign); ?></td>
		<td class="content middle" align="right">&nbsp;<?php echo number_format($Mailbox); ?></td>
		<td class="content middle" align="right">&nbsp;<?php echo number_format($Meeting); ?></td>
		<td class="content middle" align="right">&nbsp;<?php echo number_format($CantBeReached); ?></td>
		
		<td class="content middle" align="right">&nbsp;<?php echo round(($ContactRate),2); ?></td>
		
		<td class="content middle" align="right">&nbsp;<?php echo number_format($Thinking); ?></td>
		<td class="content middle" align="right">&nbsp;<?php echo number_format($Callback); ?></td>
		
		<td class="content middle" align="right">&nbsp;<?php echo number_format($TrustBank); ?></td>
		<td class="content middle" align="right">&nbsp;<?php echo number_format($TrustInsurance); ?></td>
		<td class="content middle" align="right">&nbsp;<?php echo number_format($Cheap); ?></td>
		
		<td class="content middle" align="right">&nbsp;<?php echo number_format($Reject); ?></td>
		<td class="content middle" align="right">&nbsp;<?php echo number_format($SpouseDoesnt); ?></td>
		<td class="content middle" align="right">&nbsp;<?php echo number_format($NotBuy); ?></td>
		<td class="content middle" align="right">&nbsp;<?php echo number_format($AlreadyInsured); ?></td>
		<td class="content middle" align="right">&nbsp;<?php echo number_format($NoMoney); ?></td>
		<td class="content middle" align="right">&nbsp;<?php echo number_format($NeedHighBenefit); ?></td>
		<td class="content middle" align="right">&nbsp;<?php echo number_format($Expensive); ?></td>
		<td class="content middle" align="right">&nbsp;<?php echo number_format($Reluctant); ?></td>
		<td class="content middle" align="right">&nbsp;<?php echo number_format($PendingInfo); ?></td>
		
		<td class="content middle" align="right">&nbsp;<?php echo round(($ResponRate),2); ?></td>
		<td class="content middle" align="right">&nbsp;<?php echo ($ConfersionRate?round($ConfersionRate,2):0); ?></td>
		
		<td class="content middle" align="right">&nbsp;<?php echo number_format($RejectBMI); ?></td>
		<td class="content middle" align="right">&nbsp;<?php echo number_format($MedQuestion); ?></td>
		<td class="content middle" align="right">&nbsp;<?php echo number_format($Overage); ?></td>
		<td class="content middle" align="right">&nbsp;<?php echo number_format($Unqualified); ?></td>
		<td class="content middle" align="right">&nbsp;<?php echo number_format($Other); ?></td>
		<td class="content middle" align="right">&nbsp;<?php echo number_format($OutOfCourier); ?></td>
		<td class="content middle" align="right">&nbsp;<?php echo number_format($RequestCase); ?></td>
		
		<td class="content middle" align="right">&nbsp;<?php echo number_format($NewCases); ?></td>
		<td class="content middle" align="right">&nbsp;<?php echo number_format($NewAnp); ?></td>
		
		<td class="content middle" align="right">&nbsp;<?php echo number_format($OldCases); ?></td>
		<td class="content middle" align="right">&nbsp;<?php echo number_format($OldAnp); ?></td>
		
		<td class="content middle" align="right">&nbsp;<?php echo number_format($GrandCases); ?></td>
		<td class="content middle" align="right">&nbsp;<?php echo number_format($GrandAnp); ?></td>
		
		<td class="content middle" align="right">&nbsp;<?php echo number_format($BuySelf); ?></td>
		<td class="content middle" align="right">&nbsp;<?php echo number_format($BuyOther); ?></td>
		
		<td class="content middle" align="right">&nbsp;<?php echo number_format($U10); ?></td>
		<td class="content middle" align="right">&nbsp;<?php echo number_format($U20); ?></td>
		<td class="content middle" align="right">&nbsp;<?php echo number_format($U30); ?></td>
		<td class="content middle" align="right">&nbsp;<?php echo number_format($U40); ?></td>
		<td class="content middle" align="right">&nbsp;<?php echo number_format($U49); ?></td>
		<td class="content middle" align="right">&nbsp;<?php echo number_format($U55); ?></td>
		<td class="content middle" align="right">&nbsp;<?php echo number_format($U60); ?></td>
		<td class="content middle" align="right">&nbsp;<?php echo number_format($U65); ?></td>
		<td class="content middle" align="right">&nbsp;<?php echo number_format($U70); ?></td>
		
		<td class="content middle" align="right">&nbsp;<?php echo number_format($Male); ?></td>
		<td class="content middle" align="right">&nbsp;<?php echo number_format($Female); ?></td>
		
		<td class="content middle" align="right">&nbsp;<?php echo number_format($Kredit); ?></td>
		<td class="content middle" align="right">&nbsp;<?php echo number_format($Debit); ?></td>
		<td class="content middle" align="right">&nbsp;<?php echo number_format($Transfer); ?></td>
		<td class="content middle" align="right">&nbsp;<?php echo number_format($AnpKredit); ?></td>
		<td class="content middle" align="right">&nbsp;<?php echo number_format($AnpDebit); ?></td>
		<td class="content middle" align="right">&nbsp;<?php echo number_format($AnpTransfer); ?></td>
		
		<td class="content middle" align="right">&nbsp;<?php echo number_format($Monthly); ?></td>
		<td class="content middle" align="right">&nbsp;<?php echo number_format($Quarterly); ?></td>
		<td class="content middle" align="right">&nbsp;<?php echo number_format($SemiAnnual); ?></td>
		<td class="content middle" align="right">&nbsp;<?php echo number_format($Annual); ?></td>
		
		<td class="content middle" align="right">&nbsp;<?php echo number_format($Monitored); ?></td>
		<td class="content middle" align="right">&nbsp;</td>
		<td class="content middle" align="right">&nbsp;<?php echo number_format($Verified); ?></td>
		<td class="content middle" align="right">&nbsp;</td>
		
		<td class="content middle" align="right">&nbsp;<?php echo number_format($CaseFollowup); ?></td>
		<td class="content middle" align="right">&nbsp;<?php echo number_format($TarpFollowup); ?></td>
		
		<td class="content middle" align="right">&nbsp;<?php echo number_format($CaseReject); ?></td>
		<td class="content middle" align="right">&nbsp;<?php echo number_format($TarpReject); ?></td>
		
		<td class="content middle" align="right">&nbsp;<?php echo number_format($CasesCancel); ?></td>
		<td class="content lasted" align="right">&nbsp;<?php echo number_format($TarpCancel); ?></td>
	</tr>
	<?php
		$no++;
		
		$sUpload += $rows['UploadData'];
		$sToday += $Today;
		$sUtToday += $TodayUtilized;
		$sRemToday += $TodayRemaining;
		$sUtOld += $OldUtilized;
		$sRemOld += $OldRemaining;
		$sTotUtilized += $TotUtilized;
		$sAttempt += $CallAttempt;
		$sAvgCall += ($sAttempt / $sUtToday);
		$sYesConnect;
		$sInvalid += $Invalid;
		$sBusy += $Busy;
		$sFax += $FaxNo;
		$sNoAnswer += $NoAnswer;
		$sWrongNo += $WrongNo;
		$sAlreadyMove += $AlreadyMove;
		$sResign += $Resign;
		$sMailbox += $Mailbox;
		$sMeeting += $Meeting;
		$sCantBeReached += $CantBeReached;
		$sThinking += $Thinking;
		$sCallback += $Callback;
		$sTrustBank += $TrustBank;
		$sTrustInsurance += $TrustInsurance;
		$sCheap += $Cheap;
		$sReject += $Reject;
		$sSpouseDoesnt += $SpouseDoesnt;
		$sNotBuy += $NotBuy;
		$sAlreadyInsured += $AlreadyInsured;
		$sNoMoney += $NoMoney;
		$sNeedHighBenefit += $NeedHighBenefit;
		$sExpensive += $Expensive;
		$sReluctant += $Reluctant;
		$sPendingInfo += $PendingInfo;
		$sRejectBMI += $RejectBMI;
		$sMedQuestion += $MedQuestion;
		$sOverage += $Overage;
		$sUnqualified += $Unqualified;
		$sOther += $Other;
		$sOutOfCourier += $OutOfCourier;
		$sRequestCase += $RequestCase;
		$sBuySelf += $BuySelf;
		$sBuyOther += $BuyOther;
		$sU10 += $U10;
		$sU20 += $U20;
		$sU30 += $U30;
		$sU40 += $U40;
		$sU49 += $U49;
		$sU55 += $U55;
		$sU60 += $U60;
		$sU65 += $U65;
		$sU70 += $U70;
		$sMale += $Male;
		$sFemale += $Female;
		$sKredit += $Kredit;
		$sDebit += $Debit;
		$sTransfer += $Transfer;
		$sAnpKredit += $AnpKredit;
		$sAnpDebit += $AnpDebit;
		$sAnpTransfer += $AnpTransfer;
		$sMonthly += $Monthly;
		$sQuarterly += $Quarterly;
		$sSemiAnnual += $SemiAnnual;
		$sAnnual += $Annual;
		$sMonitored += $Monitored;
		$sVerified += $Verified;
		$sCaseFollowup += $CaseFollowup;
		$sTarpFollowup += $TarpFollowup;
		$sCaseReject += $CaseReject;
		$sTarpReject += $TarpReject;
		$sCasesCancel += $CasesCancel;
		$sTarpCancel += $TarpCancel;
		$sNewCases += $NewCases;
		$sNewAnp += $NewAnp;
		$sOldCases += $OldCases;
		$sOldAnp += $OldAnp;
		$sGrandCases += $GrandCases;
		$sGrandAnp += $GrandAnp;
		$sAvgCall += $AvgCall;
		$sYesConnect += $YesConnect;
		$sConnectRate += $ConnectRate;
		$sYesContact += $YesContact;
		$sContactRate += $ContactRate;
		$sResponRate += $ResponRate;
		$sConfersionRate += $ConfersionRate;
		
		endforeach; 
	?>
	<tr>
		<td colspan="5" class="total middle" align="center">Total</td>
		<td class="total middle" align="right"><?php echo number_format($sUpload); ?></td>
		<td class="total middle" align="right"><?php echo number_format($sToday); ?></td>
		<td class="total middle" align="right"><?php echo number_format($sUtToday); ?></td>
		<td class="total middle" align="right"><?php echo number_format($sRemToday); ?></td>
		<td class="total middle" align="right"><?php echo number_format($sUtOld); ?></td>
		<td class="total middle" align="right"><?php echo number_format($sRemOld); ?></td>
		<td class="total middle" align="right"><?php echo number_format($sTotUtilized); ?></td>
		<td class="total middle" align="right"><?php echo number_format($sAttempt); ?></td>
		<td class="total middle" align="right"><?php echo round(($sAvgCall),2); ?></td>
		<td class="total middle" align="right"><?php echo ($sYesConnect); ?></td>
		<td class="total middle" align="right"><?php echo number_format($sInvalid); ?></td>
		<td class="total middle" align="right"><?php echo number_format($sBusy); ?></td>
		<td class="total middle" align="right"><?php echo number_format($sFax); ?></td>
		<td class="total middle" align="right"><?php echo number_format($sNoAnswer); ?></td>
		<td class="total middle" align="right"><?php echo round(($sConnectRate),2); ?></td>
		<td class="total middle" align="right"><?php echo ($sYesContact); ?></td>
		<td class="total middle" align="right"><?php echo number_format($sWrongNo); ?></td>
		<td class="total middle" align="right"><?php echo number_format($sAlreadyMove); ?></td>
		<td class="total middle" align="right"><?php echo number_format($sResign); ?></td>
		<td class="total middle" align="right"><?php echo number_format($sMailbox); ?></td>
		<td class="total middle" align="right"><?php echo number_format($sMeeting); ?></td>
		<td class="total middle" align="right"><?php echo number_format($sCantBeReached); ?></td>
		<td class="total middle" align="right"><?php echo round(($sContactRate),2); ?></td>
		<td class="total middle" align="right"><?php echo number_format($sThinking); ?></td>
		<td class="total middle" align="right"><?php echo number_format($sCallback); ?></td>
		<td class="total middle" align="right"><?php echo number_format($sTrustBank); ?></td>
		<td class="total middle" align="right"><?php echo number_format($sTrustInsurance); ?></td>
		<td class="total middle" align="right"><?php echo number_format($sCheap); ?></td>
		<td class="total middle" align="right"><?php echo number_format($sReject); ?></td>
		<td class="total middle" align="right"><?php echo number_format($sSpouseDoesnt); ?></td>
		<td class="total middle" align="right"><?php echo number_format($sNotBuy); ?></td>
		<td class="total middle" align="right"><?php echo number_format($sAlreadyInsured); ?></td>
		<td class="total middle" align="right"><?php echo number_format($sNoMoney); ?></td>
		<td class="total middle" align="right"><?php echo number_format($sNeedHighBenefit); ?></td>
		<td class="total middle" align="right"><?php echo number_format($sExpensive); ?></td>
		<td class="total middle" align="right"><?php echo number_format($sReluctant); ?></td>
		<td class="total middle" align="right"><?php echo number_format($sPendingInfo); ?></td>
		<td class="total middle" align="right"><?php echo round(($sResponRate),2); ?></td>
		<td class="total middle" align="right"><?php echo ($sConfersionRate?round($sConfersionRate,2):0); ?></td>
		<td class="total middle" align="right"><?php echo number_format($sRejectBMI); ?></td>
		<td class="total middle" align="right"><?php echo number_format($sMedQuestion); ?></td>
		<td class="total middle" align="right"><?php echo number_format($sOverage); ?></td>
		<td class="total middle" align="right"><?php echo number_format($sUnqualified); ?></td>
		<td class="total middle" align="right"><?php echo number_format($sOther); ?></td>
		<td class="total middle" align="right"><?php echo number_format($sOutOfCourier); ?></td>
		<td class="total middle" align="right"><?php echo number_format($sRequestCase); ?></td>
		<td class="total middle" align="right"><?php echo number_format($sNewCases); ?></td>
		<td class="total middle" align="right"><?php echo number_format($sNewAnp); ?></td>
		<td class="total middle" align="right"><?php echo number_format($sOldCases); ?></td>
		<td class="total middle" align="right"><?php echo number_format($sOldAnp); ?></td>
		<td class="total middle" align="right"><?php echo number_format($sGrandCases); ?></td>
		<td class="total middle" align="right"><?php echo number_format($sGrandAnp); ?></td>
		<td class="total middle" align="right"><?php echo number_format($sBuySelf); ?></td>
		<td class="total middle" align="right"><?php echo number_format($sBuyOther); ?></td>
		<td class="total middle" align="right"><?php echo number_format($sU10); ?></td>
		<td class="total middle" align="right"><?php echo number_format($sU20); ?></td>
		<td class="total middle" align="right"><?php echo number_format($sU30); ?></td>
		<td class="total middle" align="right"><?php echo number_format($sU40); ?></td>
		<td class="total middle" align="right"><?php echo number_format($sU49); ?></td>
		<td class="total middle" align="right"><?php echo number_format($sU55); ?></td>
		<td class="total middle" align="right"><?php echo number_format($sU60); ?></td>
		<td class="total middle" align="right"><?php echo number_format($sU65); ?></td>
		<td class="total middle" align="right"><?php echo number_format($sU70); ?></td>
		<td class="total middle" align="right"><?php echo number_format($sMale); ?></td>
		<td class="total middle" align="right"><?php echo number_format($sFemale); ?></td>
		<td class="total middle" align="right"><?php echo number_format($sKredit); ?></td>
		<td class="total middle" align="right"><?php echo number_format($sDebit); ?></td>
		<td class="total middle" align="right"><?php echo number_format($sTransfer); ?></td>
		<td class="total middle" align="right"><?php echo number_format($sAnpKredit); ?></td>
		<td class="total middle" align="right"><?php echo number_format($sAnpDebit); ?></td>
		<td class="total middle" align="right"><?php echo number_format($sAnpTransfer); ?></td>
		<td class="total middle" align="right"><?php echo number_format($sMonthly); ?></td>
		<td class="total middle" align="right"><?php echo number_format($sQuarterly); ?></td>
		<td class="total middle" align="right"><?php echo number_format($sSemiAnnual); ?></td>
		<td class="total middle" align="right"><?php echo number_format($sAnnual); ?></td>
		<td class="total middle" align="right"><?php echo number_format($sMonitored); ?></td>
		<td class="total middle" align="right">&nbsp;</td>
		<td class="total middle" align="right"><?php echo number_format($sVerified); ?></td>
		<td class="total middle" align="right">&nbsp;</td>
		<td class="total middle" align="right"><?php echo number_format($sCaseFollowup); ?></td>
		<td class="total middle" align="right"><?php echo number_format($sTarpFollowup); ?></td>
		<td class="total middle" align="right"><?php echo number_format($sCaseReject); ?></td>
		<td class="total middle" align="right"><?php echo number_format($sTarpReject); ?></td>
		<td class="total middle" align="right"><?php echo number_format($sCasesCancel); ?></td>
		<td class="total lasted" align="right"><?php echo number_format($sTarpCancel); ?></td>
	</tr>
</table>

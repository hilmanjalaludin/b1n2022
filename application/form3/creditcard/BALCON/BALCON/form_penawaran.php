<?php

// var_dump($Detail);die();
//$Detail = DetailVerification(); 


// ambil dana setiap membuat transaksi baru.       
$DanaTotal = 0;
foreach ($DetailTransaction as $key => $data) {
	$Newss = Objective($DetailTransaction[$key]);
	$DanaTotal += $Newss->field('TX_Usg_JumlahDana');
}

// jika lebih dari nol 	
if ($DanaTotal > 0) {
	$AvailDana = round(($Detail->field('TX_Usg_AvailableXD') / 2) - $DanaTotal);
} else {
	$AvailDana = round($Detail->field('TX_Usg_AvailableXD') * 50 / 100);
}

// calcualte data dikurangin dengan dana yang sudah di ambil. 

$AvailDana = Objective(($AvailDana < 0 ? 0 : $AvailDana));
if (count($DetailTransaction) > 0) {
	$TX_Usg_Sisadana = ($Detail->field('TX_Usg_AvailableXD', 'intval') / 2);
} else {
	$TX_Usg_Sisadana = ($Detail->field('TX_Usg_AvailableXD', 'intval'));
}

?>
<form name="frmXTradana">
	<?php echo form()->hidden('TX_Usg_VerId',    NULL, $Detail->field('TX_Usg_VerId')); ?>
	<?php echo form()->hidden('DanaTotal',		  NULL, $DanaTotal); ?>
	<?php echo form()->hidden('TX_Usg_Sisadana', NULL, $TX_Usg_Sisadana); ?>

	<?php echo form()->hidden('TX_Usg_CustId',   NULL, $Detail->field('TX_Usg_CustId')); ?>
	<?php echo form()->hidden('TX_Usg_Custno',   NULL, $Detail->field('TX_Usg_Custno')); ?>
	<?php echo form()->hidden('TX_Usg_FixID',    NULL, $Detail->field('TX_Usg_FixID')); ?>
	<?php echo form()->hidden('TX_Usg_Membal',   NULL, $Detail->field('TX_Usg_Membal')); ?>
	<?php echo form()->hidden('TX_US_AvailDana', NULL, $Detail->field('TX_Usg_AvailableXD', 'AvailXtradana')); ?>
	<?php echo form()->hidden('TX_Usg_TransId',  NULL, $Detail->field('TX_Usg_TransId')); ?>

	<?php echo form()->hidden('TX_Usg_TransSeq', NULL, '0'); //$Detail->field('TX_Usg_TransSeq'));
	?>
	<?php echo form()->hidden('TX_Usg_Program', 'input_text tolong', ($Detail->field('TX_Usg_Program', 'strlen') ?  $Detail->field('TX_Usg_Program')  : 'BALCON')); ?>
	<table class="paperworktable">
		
	   <tr>
			<td class="ui-data-cell-1"><?php echo lang('Jenis Kartu'); ?></td>
			<td class="ui-data-cell-2" colspan="3">
				<?php echo form()->input(
														'TX_Usg_JenisKartu',
														'input_text tolong ui-disabled ui-normal',
														$Detail->field('TX_Usg_JenisKartu', 'SetCapital')
													); ?> 
				</td>
		</tr>
		

		<tr>
			<td class="ui-data-cell-1"><?php echo lang('Expired Date'); ?></td>
			<?php if(_get_session('HandlingType') != '19'){  ?>
			<td class="ui-data-cell-2" colspan="3"><?php echo form()->input_password(
														'TX_Usg_ExpiredKartu',
														'input_ tolong ui-disabled ui-normal',
														$Detail->field('TX_Usg_ExpiredKartu')
													); ?> </td>
		   <?php } else{?>
			<td class="ui-data-cell-2" colspan="3"><?php echo form()->input(
														'TX_Usg_ExpiredKartu',
														'input_ tolong ui-disabled ui-normal',
														$Detail->field('TX_Usg_ExpiredKartu')
													); ?> </td>
		   <?php } ?>
		</tr>

		<tr>
			<td class="ui-data-cell-1"><?php echo lang('Kredit Limit'); ?></td>
			<td class="ui-data-cell-2" colspan="3"><?php echo form()->input(
														'TX_Usg_KreditLimit',
														'input_text tolong ui-disabled ui-normal',
														$Detail->field('TX_Usg_KreditLimit', 'SetCurrency')
													); ?> </td>
		</tr>

		<tr>
			<td class="ui-data-cell-1">Balonce</td>
			<td class="ui-data-cell-2" colspan="3"><?php echo form()->input(
														'TX_Usg_AvailableXD',
														'input_text tolong ui-disabled ui-normal',
														$Detail->field('TX_Usg_AvailableXD', 'SetCurrency')
													); ?> </td>
		</tr>

		<tr>
			<td class="ui-data-cell-1"><?php echo lang('Available SS'); ?></td>
			<td class="ui-data-cell-2" colspan="3">
				<?php echo form()->input(
					'TX_Usg_AvailableSS',
					'input_text tolong ui-disabled ui-normal',
					$Detail->field('TX_Usg_AvailableSS', 'SetCurrency')
				); ?> </td>
		</tr>

		<tr>
			<td class="ui-data-cell-1"><?php echo lang('Penawaran'); ?></td>
			<td class="ui-data-cell-2" colspan="3"><?php echo form()->input(
														'TX_Usg_Penawaran',
														'input_text tolong ui-disabled ui-normal',
														$Detail->field('TX_Usg_Penawaran')
													); ?> </td>
		</tr>

		


		<!-- test -->
		<tr>
			<td class="ui-data-cell-1"><?php echo lang('Cycle'); ?></td>
			<td class="ui-data-cell-0"><?php echo form()->input(
											'TX_Usg_Cycle',
											'input_text tolong ui-disabled ui-unormal',
											$Detail->field('TX_Usg_Cycle')
										); ?> </td>

			<td class="ui-data-cell-3"><?php echo lang('Block'); ?></td>
			<td class="ui-data-cell-4"><?php echo form()->input(
											'TX_Usg_Block',
											'input_text tolong ui-disabled ui-unormal',
											$Detail->field('TX_Usg_Block')
										); ?> </td>
		</tr>

		<tr>
			<td class="ui-data-cell-1" colspan='4'>&nbsp;</td>
		</tr>

		
		<tr>
			<td class="ui-data-cell-1"><?php echo lang('Status Penawaran'); ?></td>
			<td class="ui-data-cell-2" colspan="3"><?php echo form()->combo(
														'TX_Usg_Statement',
														'select superlong',
														array('Y' => 'SETUJU', 'N' => 'TIDAK SETUJU'),
														$Detail->field('TX_Usg_Statement')
													); ?> </td>
		</tr>

		<!-- <tr>
			<td class="ui-data-cell-1"><?php //echo lang('Tenor'); ?></td>
			<td class="ui-data-cell-4" colspan="3"><?php //echo form()->combo(
														// 'TX_Usg_Tenor',
														// 'select long ui-select-data',
														// Tenorbalcon(),
														// $Detail->field('TX_Usg_Tenor')
													//); ?> </td>
		</tr> -->

		<tr>
			<td class="ui-data-cell-1"><?php echo lang('Tenor'); ?></td>
			<td class="ui-data-cell-2" colspan="3">
				<?php echo form()->combo(
					'TX_Usg_Tenor',
					'select long ui-select-data',
					ProgramDetailTenordetail(),
					$Detail->field('TX_Usg_Tenor'),
					array('change' => 'window.EventCallculator(this);')
				) ?>
				<input type="hidden" class="select superlong" id="TX_Usg_Tenors" name="TX_Usg_Tenors" value="">	
			</td>
		</tr>

	

		<tr> 
		<td class="ui-data-cell-1"><?php echo lang('Program');?></td>
		<td class="ui-data-cell-2" colspan="3">
		<!-- <?php //echo form()->combo('TX_Usg_ProgramData', 'select superlong', 
			//ProgramDetailBalcon($Detail->field('TX_Usg_Penawaran','SetRealPercent')), 
			//$Detail->field('TX_Usg_ProgramData'), array('change' => 'window.EventCallculator(this);')) ?> </td> -->
			<input type="text" class="select superlong" id="TX_Usg_ProgramData" name="TX_Usg_ProgramData" value="" disabled>
			<input type="hidden" class="select superlong" id="PRD_Data_Id" name="PRD_Data_Id">
	</tr>



		<tr>
			<td class="ui-data-cell-1">Ballance
				<span class='paperworknote'>( Rp. )</span>
				<!-- s pan class='paperworknote'><br>(<?#php echo "max dana : Rp. ".$AvailDana->field('0',array('SetNominal','SetCurrency')); ?>)</spa n-->
			</td>
			<td class="ui-data-cell-2" colspan="3">
				<?php echo form()->input(
					'TX_Usg_JumlahDana',
					'input_text tolong ui-normal',
					$Detail->field('TX_Usg_AvailableXD', 'SetCurrency'),
					array('keyup' => 'window.EventBallance(this);')
				); ?> </td>

			<!-- <td class="ui-data-cell-3"><?php //echo lang('Tenor'); 
											?></td> -->
			<!-- <td class="ui-data-cell-4"><?php //echo form()->combo(
											// 'TX_Usg_Tenor',
											// 'select long ui-select-data',
											// Tenorbalcon(),
											// $Detail->field('TX_Usg_Tenor')
											//	); 
											?> </td> -->
		</tr>

		<!-- <tr>
			<td class="ui-data-cell-1">Setuju Transaksi 3 Bulan</td>
			<td class="ui-data-cell-2" colspan="3">
				<?php //echo form()->combo('TX_Usg_Tigabulan', 'select superlong', array('YA' => 'YA', 'TIDAK' => 'TIDAK SETUJU')) ?>
			</td>
		</tr> -->

	</table>
</form>
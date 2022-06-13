<table class="paperworktable" nowrap>
<!-- <?php 
  //var_dump(_get_session('HandlingType'));
  //die;
?> -->
<?php echo form()->hidden('TotalTrans', NULL, sizeof($DetailTransaction));?>
			<tr>
				<td class="ui-data-cell-1 center">Transaksi No.</td>
				<td class="ui-data-cell-1">Program</td>
				<!-- t d class="ui-data-cell-1">No. Rekening</td>
				<td class="ui-data-cell-1">Nama Bank</td>
				<td class="ui-data-cell-1">Cabang</t d -->
				<td class="ui-data-cell-1">Jumlah</td>
				<td class="ui-data-cell-1 center">Tenor</td>
				<td class="ui-data-cell-1 center">Action</td>
			</tr>
<?php 
	foreach($DetailTransaction as $key => $data){
		$Newss = Objective($DetailTransaction[$key]);
		// total dana yang sudah di setujui
		// $DanaTotal += $Newss->field('TX_Usg_JumlahDana');
?>
<tr>
	<?php echo form()->hidden('TXTX_Usg_TransId'.$Newss->field('TX_Usg_TransSeq'),  NULL, $Newss->field('TX_Usg_TransId'));?>
	<?php echo form()->hidden('TXTX_Usg_VerId'.$Newss->field('TX_Usg_TransSeq'),  NULL, $Newss->field('TX_Usg_VerId'));?>
	<?php echo form()->hidden('TXTX_Usg_TransSeq'.$Newss->field('TX_Usg_TransSeq'), NULL, $Newss->field('TX_Usg_TransSeq'));?>
	<?php echo form()->hidden('TXTX_Usg_Statement'.$Newss->field('TX_Usg_TransSeq'), NULL, $Newss->field('TX_Usg_Statement'));?>
	<?php echo form()->hidden('TXTX_Usg_ProgramData'.$Newss->field('TX_Usg_TransSeq'), NULL, $Newss->field('TX_Usg_ProgramData'));?>
	
	<?php echo form()->hidden('TXTX_Usg_NamaRekening'.$Newss->field('TX_Usg_TransSeq'), NULL, $Newss->field('TX_Usg_NamaRekening'));?>
	<?php echo form()->hidden('TXTX_Usg_NoRekening'.$Newss->field('TX_Usg_TransSeq'), NULL, $Newss->field('TX_Usg_NoRekening'));?>
	<?php echo form()->hidden('TXTX_Usg_NamaBank'.$Newss->field('TX_Usg_TransSeq'), NULL, $Newss->field('TX_Usg_NamaBank'));?>
	<?php echo form()->hidden('TXTX_Usg_Cabang'.$Newss->field('TX_Usg_TransSeq'), NULL, $Newss->field('TX_Usg_Cabang'));?>
	<?php echo form()->hidden('TXTX_Usg_JumlahDana'.$Newss->field('TX_Usg_TransSeq'), NULL, $Newss->field('TX_Usg_JumlahDana',array('SetNominal','SetCurrency') ));?>
	<?php echo form()->hidden('TXTX_Usg_Tenor'.$Newss->field('TX_Usg_TransSeq'), NULL, $Newss->field('TX_Usg_Tenor')." Bln");?>
</tr>		
			<tr>
				<td class="ui-data-cell-1 center"><?php echo $Newss->field('TX_Usg_TransSeq'); ?></td>
				<td class="ui-data-cell-1"><?php echo $Newss->field('TX_Usg_ProgramValue'); ?></td>
				<!-- <td class="ui-data-cell-1"><?php //echo $Newss->field('TX_Usg_NamaRekening'); ?></td> -->
				<!-- t d class="ui-data-cell-1"><#?php echo $Newss->field('TX_Usg_NoRekening'); ?></td>
				<td class="ui-data-cell-1"><#?php echo $Newss->field('TX_Usg_NamaBank'); ?></td>
				<td class="ui-data-cell-1"><#?php echo $Newss->field('TX_Usg_Cabang'); ?></t d -->
				<td class="ui-data-cell-1"><?php echo $Newss->field('TX_Usg_JumlahDana',array('SetNominal','SetCurrency') ); ?></td>
				<td class="ui-data-cell-1 center"><?php echo $Newss->field('TX_Usg_Tenor'); ?></td>
				<td class="ui-data-cell-1">
				<?php if(_get_session('HandlingType') != '19'){  ?>
					<button name="btnEditXTradana" class="btn btn-success btn-xs button4" onclick="window.EditTrans(<?php echo $Newss->field('TX_Usg_TransSeq'); ?>);">
						<i class="fa fa-edit"></i>&nbsp;Edit</button>
						<button name="btnDeleteXTradana" class="btn btn-danger btn-xs button4" onclick="window.DeleteTransBalcon(<?php echo $Newss->field('TX_Usg_TransSeq'); ?>, <?php echo $Newss->field('TX_Usg_Id'); ?>, <?php echo $Newss->field('TX_Usg_VerId'); ?> );">
						<i class="fa fa-delete"></i>&nbsp;Delete</button>
				<?php } ?>		
				</td>
			</tr>
<?php
	}
	?>
	</table>
	
<?php

	// if($DanaTotal>0){
		// $AvailDana = round(($Detail->field('TX_Usg_AvailableXD')/2)-$DanaTotal);
	// }else{
		// $AvailDana = round($Detail->field('TX_Usg_AvailableXD')*50/100);
	// }
	
	// $AvailDana = Objective(($AvailDana<0?0:$AvailDana));

	// echo "** Sisa maximal dana : Rp. ".$AvailDana->field('0',array('SetNominal','SetCurrency'));
	
?>
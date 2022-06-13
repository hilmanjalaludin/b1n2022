<table class="paperworktable" nowrap>
<?php echo form()->hidden('TotalTrans', NULL, sizeof($DetailTransaction2));?>
			<tr>
				<td class="ui-data-cell-1 center">##</td>
				<td class="ui-data-cell-1">Merchant</td>
				<td class="ui-data-cell-1">Amount</td>
				<td class="ui-data-cell-1">Tanggal Transaksi</td>
				<td class="ui-data-cell-1">Rate</td>
				<td class="ui-data-cell-1">Tenor</td>
				<td class="ui-data-cell-1 center">Action</td>
			</tr>
<?php 
	$tenorExplode = explode(',',$tenor['PRD_Data_Tenor']);
	foreach($DetailTransaction2 as $key => $data){
		$Newss = Objective($DetailTransaction2[$key]);
?>
<!-- <tr>
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
</tr>		 -->
			<tr>
				<td class="ui-data-cell-1 center">
					<?php echo $key+1;?>
				</td>
				<td class="ui-data-cell-1"><?php echo $Newss->field('MERCHANT_ID'); ?></td>
				<td class="ui-data-cell-1"><?php echo number_format(($Newss->field('AMOUNT'))); ?></td>
				<td class="ui-data-cell-1"><?php echo $Newss->field('TGL_TRANSAKSI'); ?></td>
				<td class="ui-data-cell-1"><?php echo $Newss->field('TX_Data_Penawaran'); ?></td>
				<td class="ui-data-cell-1"><?php echo $Newss->field('TX_Usg_Tenor'); ?></td>
				<td class="ui-data-cell-1 center">
				<?php if(_get_session('HandlingType') != '19'){  ?>
					<!-- <button name="btnEditXTradana" class="btn btn-success btn-xs button4" onclick="window.EditTrans(<?php echo $Newss->field('TX_Usg_TransSeq'); ?>);">
						<i class="fa fa-edit"></i>&nbsp;Edit</button> -->
						<button name="btnDeleteXTradana" class="btn btn-danger btn-xs button4" onclick="window.DeleteTransPCTD('<?php echo $Newss->field('TX_Usg_Id'); ?>', '<?php echo $Newss->field('REF_ID'); ;?>');">
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
<form action="<?php echo site_url('ProductController/postFrmPctd') ?>" method="POST">
<table class="paperworktable" nowrap>
<?php echo form()->hidden('TotalTrans', NULL, sizeof($DetailTransaction));?>
			<tr>
				<td class="ui-data-cell-1 center">##</td>
				<td class="ui-data-cell-1">Merchant</td>
				<td class="ui-data-cell-1">Amount</td>
				<td class="ui-data-cell-1">Tanggal Transaksi</td>
				<td class="ui-data-cell-1">Rate</td>
				<td class="ui-data-cell-1">Tenor</td>
				<td class="ui-data-cell-1">Installment</td>
			</tr>
<?php 
	// echo '<pre>';
	// print_r($DetailTransaction);
	// die;
	$tenorExplode = explode(',',$tenor['PRD_Data_Tenor']);
	foreach($DetailTransaction as $key => $data){
		$Newss = Objective($DetailTransaction[$key]);
?>
			<tr>
				<td class="ui-data-cell-1 center">
					<input type="checkbox" name="cbx[]" id="checkbox_<?php echo $key+1;?>" value="<?php echo $key;?>" onchange="window.Pick('<?php echo $key+1;?>')"/>
				</td>
				<td class="ui-data-cell-1">
					<?php echo $Newss->field('MERCHANT_ID'); ?>
					<input type="hidden" name="Id[]" id="Id_<?php echo $key+1;?>" value="<?php echo $Newss->field('Id'); ?>"/>
					<input type="hidden" name="REF_ID[]" id="REF_ID_<?php echo $key+1;?>" value="<?php echo $Newss->field('REF_ID'); ?>"/>
					<input type="hidden" name="MERCHANT_ID[]" id="MERCHANT_ID_<?php echo $key+1;?>" value="<?php echo $Newss->field('MERCHANT_ID'); ?>"/>
					<input type="hidden" name="CV_Data_FixID[]" id="CV_Data_FixID_<?php echo $key+1;?>" value="<?php echo $Newss->field('CV_Data_FixID'); ?>"/>
					<input type="hidden" name="CV_Data_Custno[]" id="CV_Data_Custno_<?php echo $key+1;?>" value="<?php echo $Newss->field('CV_Data_Custno'); ?>"/>
					<input type="hidden" name="CV_Data_CustId[]" id="CV_Data_CustId_<?php echo $key+1;?>" value="<?php echo $Newss->field('CV_Data_CustId'); ?>"/>
					<input type="hidden" name="TRX_ID[]" id="TRX_ID_<?php echo $key+1;?>" value="<?php echo $Newss->field('TRX_ID'); ?>"/>
				</td>
				<td class="ui-data-cell-1">
					<?php echo number_format($Newss->field('AMOUNT')); ?>
					<input type="hidden" name="AMOUNT[]" id="AMOUNT_<?php echo $key+1;?>" value="<?php echo $Newss->field('AMOUNT'); ?>"/>
				</td>
				<td class="ui-data-cell-1">
					<?php echo $Newss->field('TGL_TRANSAKSI'); ?>
					<input type="hidden" name="TGL_TRANSAKSI[]" id="TGL_TRANSAKSI_<?php echo $key+1;?>" value="<?php echo $Newss->field('TGL_TRANSAKSI'); ?>"/>
				</td>
				<td class="ui-data-cell-1">
					<?php echo $tenor['PRD_Data_Kode'].'%'; ?>
					<input type="hidden" name="PRD_Data_Kode[]" id="PRD_Data_Kode_<?php echo $key+1;?>" value="<?php echo $tenor['PRD_Data_Kode'].'%'; ?>"/>
				</td>
				<td class="ui-data-cell-1">
					<select class="select long ui-select-data" name="TX_Usg_Tenor[]" id="TX_Usg_Tenor_<?php echo $key+1;?>" disabled onchange="window.pickTenor(this, '<?php echo $key+1;?>')">
						<option value="">---Choose----</option>
						<?php
							foreach($tenorExplode as $item):
						?>
						<option value="<?php echo $item;?>"><?php echo $item;?></option>
						<?php
							endforeach;
						?>
					</select>
				</td>
				<td class="ui-data-cell-1" id="installment_<?php echo $key+1;?>">
					
				</td>
				<!-- <td class="ui-data-cell-1">
				<?php if(_get_session('HandlingType') != '19'){  ?>
					<button name="btnEditXTradana" class="btn btn-success btn-xs button4" onclick="window.EditTrans(<?php echo $Newss->field('TX_Usg_TransSeq'); ?>);">
						<i class="fa fa-edit"></i>&nbsp;Edit</button>
						<button name="btnDeleteXTradana" class="btn btn-danger btn-xs button4" onclick="window.DeleteTransBalcon(<?php echo $Newss->field('TX_Usg_TransSeq'); ?>, <?php echo $Newss->field('TX_Usg_Id'); ?>, <?php echo $Newss->field('TX_Usg_VerId'); ?> );">
						<i class="fa fa-delete"></i>&nbsp;Delete</button>
				<?php } ?>		
				</td> -->
			</tr>
<?php
	}
	?>
	</table>

	<table class="paperworktable" style="margin-top:25px;">
	<tr> 
		<td style="border:0px solid #000;text-align:center;">
		<?php if(_get_session('HandlingType') != '19'){  ?>
		<!-- <button name="btnSubmitXTradana" class="btn btn-info btn-sm button1" onclick="window.EventSubmit();">
		<i class="fa fa-save"></i>&nbsp;Save</button> -->
		<button type="submit" name="btnSubmitXTradana" class="btn btn-info btn-sm button1">
		<i class="fa fa-save"></i>&nbsp;Save</button>
		<!-- <input type="submit" class="btn btn-info btn-sm button1" value="Save" /> -->
		<?php } ?>
			
		<button name="btnSubmitXTradana" class="btn btn-info btn-sm button2" onclick="window.EventCancel();">
		<i class="fa fa-close"></i>&nbsp;Exit</button>
		
		<!-- <button name="btnSubmitXTradana" class="btn btn-info btn-sm button1" onclick="window.Eventaddnew();">
		<i class="fa fa-save"></i>&nbsp;New</button>
		 -->
		<!--
		<button name="btnKalXTradana" class="btn btn-info btn-sm button3" onclick="window.EventSimulasi();">
		<i class="fa fa-calculator"></i>&nbsp;Simulasi</button>
			-->
		</td>
	</tr>
</table>
	</form>
<?php

	// if($DanaTotal>0){
		// $AvailDana = round(($Detail->field('TX_Usg_AvailableXD')/2)-$DanaTotal);
	// }else{
		// $AvailDana = round($Detail->field('TX_Usg_AvailableXD')*50/100);
	// }
	
	// $AvailDana = Objective(($AvailDana<0?0:$AvailDana));

	// echo "** Sisa maximal dana : Rp. ".$AvailDana->field('0',array('SetNominal','SetCurrency'));
	
?>
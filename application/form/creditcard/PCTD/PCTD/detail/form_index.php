<?php
/**
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */

 $this->load->form( sprintf('%s%s%s', $folder, $subfolder, 'form_function'));
 $this->load->form( sprintf('%s%s%s', $folder, $subfolder, 'form_header'));


?>
<form name="frmDataUsage">
<?php echo form()->hidden('ProductMaster', NULL, rtrim( $folder,'/'));?>
<?php echo form()->hidden('ProductDetail', NULL, rtrim( $subfolder, '/'));?>
</form>
<div class="wraplable">
	<div class="paperworktitle">Detail Transaksi PCTD</div>
	<table class="paperworktable" nowrap>
        <tr>
            <td class="ui-data-cell-1 center">No.</td>
            <td class="ui-data-cell-1">Merchand</td>
            <td class="ui-data-cell-1">Amount</td>
            <td class="ui-data-cell-1">Tanggal Transaksi</td>
        </tr>
<?php 
	foreach($DetailTransaction as $key => $data){
		$Newss = Objective($DetailTransaction[$key]);
?>
        <tr>
            <td class="ui-data-cell-1 center"><?php echo $key+1; ?></td>
            <td class="ui-data-cell-1"><?php echo $Newss->field('MERCHANT_ID'); ?></td>
            <td class="ui-data-cell-1"><?php echo number_format($Newss->field('AMOUNT')); ?></td>
            <td class="ui-data-cell-1 center"><?php echo $Newss->field('TGL_TRANSAKSI'); ?></td>
        </tr>
<?php
	}
	?>
	</table>
</div>

<?php

/**
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */

  $this->load->form( sprintf("%s%s%s", $folder, $subfolder, "form_footer"));
?>

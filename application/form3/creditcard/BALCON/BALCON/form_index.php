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

<!-- wraplable --> 
<div class="wraplable">
	<div class="paperworktitle">Detail Penawaran ( BALCON )</div>
	<?php $this->load->form( sprintf("%s%s%s",  $folder, $subfolder, "form_penawaran")); ?>
	
</div>

<div class="wraplable">
	<div class="paperworktitle">Calculator</div>
	<?php $this->load->form( sprintf("%s%s%s",  $folder , $subfolder, "form_calculator")); ?>
</div>

<div class="wraplable">
	<div class="paperworktitle">Transaksi</div>
	<?php $this->load->form( sprintf("%s%s%s",  $folder , $subfolder, "form_transaksi")); ?>
</div>

<?php 

/**
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
  $this->load->form( sprintf("%s%s%s", $folder, $subfolder, "form_footer")); 
?>
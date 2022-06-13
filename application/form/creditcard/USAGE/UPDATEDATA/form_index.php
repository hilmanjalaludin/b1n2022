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
	<div class="paperworktitle">Data Customer ( XTradana )</div>
	<?php $this->load->form( sprintf("%s%s%s",  $folder, $subfolder, "form_customer")); ?>
</div>



<div class="wraplable">
	<div class="paperworktitle">Data Kartu ( XTradana )</div>
	<?php $this->load->form( sprintf("%s%s%s",  $folder, $subfolder, "form_datakartu")); ?>
</div>

<div class="wraplable">
	<?php $this->load->form( sprintf("%s%s%s",  $folder , $subfolder, "form_buttons")); ?>
</div>


<?php 

/**
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
  $this->load->form( sprintf("%s%s%s", $folder, $subfolder, "form_footer")); 
?>
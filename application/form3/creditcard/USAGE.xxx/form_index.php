<?php  
  $this->load->form("UI/styleform.php");
  $this->load->form("UI/USAGE_JS.php");
  $this->load->form("USAGE/form_function.php");
?>
<div class="wraplable">
	<div class="paperworktitle">Data Verifikasi </div>
	<?php $this->load->form( sprintf("%s/%s",  rtrim($folder,"/"), "form_verification")); ?>
	
	<div class="paperworktitle">Daftar Kartu</div>
	<?php $this->load->form( sprintf("%s/%s",  rtrim($folder,"/"), "form_daftarkartu")); ?>
</div>	
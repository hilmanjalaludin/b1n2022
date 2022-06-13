<?php  
  $this->load->form("UI/styleform.php");
  $this->load->form("UI/TAPENAS_JS.php");
  $this->load->form("TAPENAS/form_function.php");
?>
<div class="wraplable">	
	<div class="paperworktitle">Daftar Kartu</div>
	<?php $this->load->form( sprintf("%s/%s",  rtrim($folder,"/"), "form_daftarkartu")); ?>
</div>	
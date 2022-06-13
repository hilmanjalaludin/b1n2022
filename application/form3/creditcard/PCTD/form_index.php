<?php
  $this->load->form("UI/styleform.php");
  $this->load->form("UI/PCTD_JS.php");
  $this->load->form("PCTD/form_function.php");
?>
<div style="position:relative;" class="wraplable">
	<div class="paperworktitle">Data Verifikasi</div>
	<?php $this->load->form( sprintf("%s/%s",  rtrim($folder,"/"), "form_verification")); ?>

	<div class="paperworktitle">Daftar Kartu</div>
	<?php $this->load->form( sprintf("%s/%s",  rtrim($folder,"/"), "form_daftarkartu")); ?>
</div>

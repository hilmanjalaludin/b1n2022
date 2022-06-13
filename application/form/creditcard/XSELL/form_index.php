<?php // Load user interface form 
$this->load->form("UI/styleform.php");
$this->load->form("UI/GENERAL_JS.php"); 
$this->load->form("UI/XSELL_JS.php"); 

echo "<form id='submitxsell' enctype='multipart/form-data'>";
$this->load->form($folder . "form_data_maintain.php");
$this->load->form($folder . "form_data_changed.php");
$this->load->form($folder . "form_additional_xsell.php");
echo "</form>";

?>




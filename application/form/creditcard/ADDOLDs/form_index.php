<?php // Load user interface form

$this->load->form("UI/styleform.php");
$this->load->form("UI/GENERAL_JS.php");
$this->load->form("UI/ADD_JS.php");

echo "<form id='submitdatachanged' enctype='multipart/form-data'>";
$this->load->form($folder."form_data_changed.php");
echo "</form>";

echo "<form id='submitadditionalcard1' enctype='multipart/form-data'>";
$this->load->form($folder."form_kartu_tambahan1.php");
echo "</form>";
echo "<form id='submitadditionalcard2' enctype='multipart/form-data'>";
$this->load->form($folder."form_kartu_tambahan2.php");
echo "</form>";
echo "<form id='submitadditionalcard3' enctype='multipart/form-data'>";
$this->load->form($folder."form_kartu_tambahan3.php");
echo "</form>";


?>

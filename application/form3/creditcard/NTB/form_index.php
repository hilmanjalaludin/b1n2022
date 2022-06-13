<?php // Load user interface form 
$this->load->form("UI/styleform.php");
$this->load->form("UI/GENERAL_JS.php"); 
$this->load->form("UI/NTB_JS.php"); ?>

<div class="paperwork">

<?php  
/**
 * DATA MANDATORY
 * KARTU KREDIT
 * DATA MAINTAIN
 * EC INFORMASI
 * OTHER INFORMATION
 * INFORMASI KEUANGAN
 * DUAL CARD // If Credit Limit - Limit NTBD = Credit Limit  
 * ADDITIONAL ADDON
 */

echo "<form id='submitcreditcard' enctype='multipart/form-data'>";
$this->load->form($folder."form_kartu_kredit");

if ( $CM->get_value("DM_CcLimit") != "0.00" ) $this->load->form($folder."form_dual_card"); // If Credit Limit - Limit NTBD = Credit Limit  

$this->load->form($folder."form_data_maintain");
$this->load->form($folder."form_keluarga_tidak_serumah");
$this->load->form($folder."form_other_information");
$this->load->form($folder."form_informasi_keuangan");
echo "</form>";

echo "<form id='submitaddon' enctype='multipart/form-data'>";
$this->load->form($folder."form_additional_addon");
echo "</form>";

?>


</div>

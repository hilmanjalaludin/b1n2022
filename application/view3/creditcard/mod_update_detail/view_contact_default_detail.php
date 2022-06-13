<?php get_view(array('mod_update_detail','view_customer_info'));?>

<form name="frmInfoCustomer">
	<?php echo form()->hidden('DM_Id',NULL, $Detail->get_value('DM_Id') );?>
	<?php echo form()->hidden('MasterDataId',NULL, $Detail->get_value('DM_Id') );?>
	<?php echo form()->hidden('CustomerId',NULL, $Detail->get_value('DM_Id') );?>
	<?php echo form()->hidden('DM_Custno',NULL, $Detail->get_value('DM_Custno') );?>
	<?php echo form()->hidden('DM_ProductId',NULL, $Detail->get_value('DM_ProductId') );?>
	<?php echo form()->hidden('DM_ProductName',NULL, $Detail->get_value('DM_ProductId','ProductCodeById') );?>
	<?php echo form()->hidden('DM_CampaignId',NULL, $Detail->get_value('DM_CampaignId') );?>
	
</form>


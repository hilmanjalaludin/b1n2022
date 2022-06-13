<fieldset class="corner" style="margin-top:-3px;border-radius:5px;padding:3px 0px 20px 0px;">
<?php echo form()->legend(lang(array('Customer','Information')), "fa-info"); ?>

<form name="frmInfoCustomer">
<?php echo form()->hidden('CustomerId',NULL, $Detail->get_value('CustomerId') );?>
<?php echo form()->hidden('CustomerNumber',NULL, $Detail->get_value('CustomerNumber') );?>
<?php echo form()->hidden('Retry',NULL, $Retry->get_value('value') );?>


<div class="ui-widget-form-table ui-widget-box">
	<div class="ui-widget-form-row baris1">
		<div class="ui-widget-form-cell text_caption ui-widget-label1"><?php echo lang('Recsource');?></div>
		<div class="ui-widget-form-cell text_caption center ui-widget-label2">:</div>
		<div class="ui-widget-form-cell bottom ui-widget-label3"><?php echo $Detail->get_value('Recsource','_setCapital');?></div>
	</div>
	
	<div class="ui-widget-form-row baris1">
		<div class="ui-widget-form-cell text_caption ui-widget-label1"><?php echo lang('Customer ID');?></div>
		<div class="ui-widget-form-cell text_caption center ui-widget-label2">:</div>
		<div class="ui-widget-form-cell bottom ui-widget-label3"><?php echo $Detail->get_value('CustomerNumber','_setCapital');?></div>
	</div>
	
		
	<div class="ui-widget-form-row baris2">
		<div class="ui-widget-form-cell text_caption"><?php echo lang('Customer Name');?></div>
		<div class="ui-widget-form-cell text_caption center">:</div>
		<div class="ui-widget-form-cell bottom ui-widget-label3"><?php echo $Detail->get_value('CustomerFirstName','_setCapital');?></div>
	</div>
	
	<div class="ui-widget-form-row baris2">
		<div class="ui-widget-form-cell text_caption ui-widget-label1"><?php echo lang('DOB');?></div>
		<div class="ui-widget-form-cell text_caption center">:</div>
		<div class="ui-widget-form-cell bottom ui-widget-label3"><?php echo $Detail->get_value('CustomerDOB','_getDateIndonesia');?></div>
	</div>
	
	<div class="ui-widget-form-row baris2">
		<div class="ui-widget-form-cell text_caption ui-widget-label1"><?php echo lang('Age');?></div>
		<div class="ui-widget-form-cell text_caption center">:</div>
		<div class="ui-widget-form-cell bottom ui-widget-label3"><?php echo $Detail->get_value('CustomerDOB','_getAge');?></div>
	</div>
	
</div>

<div class="ui-widget-form-table ui-widget-box">
	<div class="ui-widget-form-row baris2">
		<div class="ui-widget-form-cell text_caption ui-widget-label1"><?php echo lang('Gender');?></div>
		<div class="ui-widget-form-cell text_caption center ui-widget-label2">:</div>
		<div class="ui-widget-form-cell bottom ui-widget-label3"><?php echo $Detail->get_value('GenderId','_getGenderLabel');?></div>
	</div>
	
	<div class="ui-widget-form-row baris2">
		<div class="ui-widget-form-cell text_caption ui-widget-label1"><?php echo lang('Address1');?></div>
		<div class="ui-widget-form-cell text_caption center ui-widget-label2">:</div>
		<div class="ui-widget-form-cell bottom ui-widget-label3"><?php echo $Detail->get_value('CustomerAddressLine1','_setCapital');?></div>
	</div>
	
	<div class="ui-widget-form-row baris1">
		<div class="ui-widget-form-cell text_caption ui-widget-label1"><?php echo lang('Address2');?></div>
		<div class="ui-widget-form-cell text_caption center">:</div>
		<div class="ui-widget-form-cell bottom ui-widget-label3"><?php echo $Detail->get_value('CustomerAddressLine2','_setCapital');?></div>
	</div>
	
	<div class="ui-widget-form-row baris2">
		<div class="ui-widget-form-cell text_caption ui-widget-label1"><?php echo lang('Address3');?></div>
		<div class="ui-widget-form-cell text_caption center ui-widget-label2">:</div>
		<div class="ui-widget-form-cell bottom ui-widget-label3"><?php echo $Detail->get_value('CustomerAddressLine3','_setCapital');?></div>
	</div>
	
	<div class="ui-widget-form-row baris1">
		<div class="ui-widget-form-cell text_caption ui-widget-label1"><?php echo lang('Address4');?></div>
		<div class="ui-widget-form-cell text_caption center">:</div>
		<div class="ui-widget-form-cell bottom ui-widget-label3"><?php echo $Detail->get_value('CustomerAddressLine4','_setCapital');?></div>
	</div>
	
</div>

<div class="ui-widget-form-table ui-widget-box">
	
	<div class="ui-widget-form-row baris2">
		<div class="ui-widget-form-cell text_caption ui-widget-label1"><?php echo lang('City');?></div>
		<div class="ui-widget-form-cell text_caption center ui-widget-label2">:</div>
		<div class="ui-widget-form-cell bottom ui-widget-label3"><?php echo $Detail->get_value('CustomerCity','_setCapital');?></div>
	</div>
	
	<div class="ui-widget-form-row baris1">
		<div class="ui-widget-form-cell text_caption ui-widget-label1"><?php echo lang('Zip Code');?></div>
		<div class="ui-widget-form-cell text_caption center">:</div>
		<div class="ui-widget-form-cell bottom ui-widget-label3"><?php echo $Detail->get_value('CustomerZipCode','_setCapital');?></div>
	</div>
	
	<div class="ui-widget-form-row baris1">
		<div class="ui-widget-form-cell text_caption ui-widget-label1"><?php echo lang('Upload Date');?></div>
		<div class="ui-widget-form-cell text_caption center">:</div>
		<div class="ui-widget-form-cell bottom ui-widget-label3"><?php echo $Detail->get_value('CustomerUploadedTs','_getDateTime');?></div>
	</div>
	
	<div class="ui-widget-form-row baris1">
		<div class="ui-widget-form-cell text_caption ui-widget-label1"><?php echo lang('Last Call Date');?></div>
		<div class="ui-widget-form-cell text_caption center">:</div>
		<div class="ui-widget-form-cell bottom ui-widget-label3"><?php echo $Detail->get_value('CustomerUpdatedTs','_getDateTime');?></div>
	</div>
</div>


<!-- stop: detail default -->
</form>
</fieldset>	

<?php get_view(array('mod_contact_detail','view_customer_info'));?>
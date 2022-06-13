<fieldset class="corner ui-field-bucket-top" style="width:auto;padding: 4px 4px 2px 4px;margin:-5px -11px 10px 5px !important;">
	<?php echo form()->legend(lang(array("Filter","Assignment")),"fa-search");?>
	<form name="frmBucketFilter">
		<?php get_view(array("mgt_bucket_data", "view_bucket_right_top"));?>
	</form>
</fieldset>


<fieldset class="corner ui-field-bucket-bottom" style="width:auto;margin:-5px -11px  10px 5px !important;">
	<?php echo form()->legend(lang(array("Option","Assignment")),"fa-gear");?>
	<form name="frmBucketOption">
		<?php get_view(array("mgt_bucket_data","view_bucket_right_bottom"));?>
	</form>
</fieldset>
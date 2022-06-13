
<?php get_view(array("transfer_fixid","view_tf_fixid_jsv"));?>
<div id="ui-widget-user-tf-fixid" class="tabs corner ui-frame-with">
	<ul>
		<li class="ui-tab-li-none">
			<a href="#ui-widget-tf-fixid-cm">
			<span class="ui-icon ui-icon-newwin"></span><?php echo lang("Customer Master");?> </a>
		</li>
		

		<li class="ui-tab-li-none">
			<a href="#ui-widget-tf-fixid-cv">
			<span class="ui-icon ui-icon-newwin"></span><?php echo lang("Customer Verifikasi");?> </a>
		</li>
	</ul>

	<!-- start content data ------>
	<div id="ui-widget-tf-fixid-cm"><?php get_view(array("transfer_fixid","view_tf_fixid_cm"));?></div>	
	<div id="ui-widget-tf-fixid-cv"><?php get_view(array("transfer_fixid","view_tf_fixid_cv"));?></div>
	
</div>
	
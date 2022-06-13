<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
echo javascript(array( array('_file' => base_spl_plugin().'/extToolbars.js', 'eui_'=> version(), 'time'=>time()) ));
?>

<?php get_view(array('mod_approval_phone','view_approve_phone_javascript') );?>

<!-- formMainActivity -->
<form name="formMainActivity">	
	<?php echo form()->hidden("ControllerId", null, $Header->field("ControllerId") );?>
	<?php echo form()->hidden("CampaignId", null, $Detail->field("DM_CampaignId") );?>
</form>

<!-- tabs:formMainActivity -->
<div id="ui-content-tab-data">
	<ul>
		<li class="ui-tab-li-lasted">
			<a href="#ui-widget-content-detail">
				<span class="ui-icon ui-icon-newwin"></span> <?php echo lang("Add Contact Detail")?>
			</a>
		</li>
	</ul>
	
	<!-- load kontent disini -->
	
	<div id="ui-widget-content-detail" class="ui-content-tab-data" style="margin-top:-20px;">
		<div class="ui-widget-form-table-compact" style="margin-top:-5px;width:100%;">
			<div class="ui-widget-form-row">
				<div class="ui-widget-form-cell" style="width:70%;vertical-align:top;">
					<?php get_view(array('mod_approval_phone','view_approve_phone_detail'));?>
				</div>
				
				<div class="ui-widget-form-cell" style="width:30%;vertical-align:top;">
					<?php get_view(array('mod_approval_phone','view_approve_phone_activity'));?>
				</div>
			</div>
		</div>
	</div>
	
	
</div>
	

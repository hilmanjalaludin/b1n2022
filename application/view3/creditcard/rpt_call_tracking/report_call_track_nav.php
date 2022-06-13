
<?php get_view(array("rpt_call_tracking","report_call_track_jsv"));
// echo $this->EUI_Session->_get_session('HandlingType');
?>

<div id="ui-report-tab-panel" class="ui-widget-panel-class-tabs">
	<ul>
		<li class="ui-tab-li-lasted"> <a href="#ui-widget-report-navigation"> 
			<span class="ui-icon ui-icon-newwin"></span><?php echo lang("Report / Call Tracking");?> </a>
		</li>
		
		<li class="ui-tab-li-lasted"> <a href="#ui-widget-report-absen-navigation"> 
			<span class="ui-icon ui-icon-newwin"></span><?php echo lang("Report / User Tracking"); ?> </a>
		</li>

		<li class="ui-tab-li-lasted"> <a href="#ui-widget-report-navigation1"> 
			<span class="ui-icon ui-icon-newwin"></span><?php echo "Report Call Tracking New"; ?> </a>
		</li>

		<li class="ui-tab-li-lasted"> <a href="#ui-widget-report-navigation-new"> 
			<span class="ui-icon ui-icon-newwin"></span><?php echo lang("Report / Call Tracking New"); ?> </a>
		</li>
		
		<?php 			

			if( $this->EUI_Session->_get_session('HandlingType') == '8'){
			?>
		<li class="ui-tab-li-lasted"> <a href="#ui-widget-report-navigation2"> 
			<span class="ui-icon ui-icon-newwin"></span><?php echo lang("Report / Call Tracking 2"); ?> </a>
		</li>
		<?php } ?>
	</ul>
	
	<div id="ui-widget-report-navigation" class="ui-widget-panel-class-tabs"> 
		<?php get_view(array('rpt_call_tracking','report_call_tracking_group'));?>
	</div>
	
	<div id="ui-widget-report-absen-navigation" class="ui-widget-panel-class-tabs"> 
		<?php get_view(array('rpt_call_tracking','report_absensi_agent'));?>
	</div>
	
	<div id="ui-widget-report-navigation1" class="ui-widget-panel-class-tabs"> 
		<?php get_view(array('rpt_call_tracking','rpt_call_tracking_group1'));?>
	</div>

	<div id="ui-widget-report-navigation-new" class="ui-widget-panel-class-tabs"> 
		<?php get_view(array('rpt_call_tracking','report_call_tracking_group_new'));?>
	</div>
	<?php 			
			if( $this->EUI_Session->_get_session('HandlingType') == '8'){
			?>
	<div id="ui-widget-report-navigation2" class="ui-widget-panel-class-tabs"> 
		<?php get_view(array('rpt_call_tracking','report_call_tracking_group2'));?>
	</div>
	<?php } ?>
</div>

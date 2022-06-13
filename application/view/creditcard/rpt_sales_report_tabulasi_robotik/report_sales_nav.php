<?php get_view(array("rpt_sales_report_tabulasi_robotik","report_sales_jsv"));?>

<div id="ui-report-tab-panel" class="ui-widget-panel-class-tabs">
	<ul>
		<li class="ui-tab-li-lasted"> <a href="#ui-widget-report-navigation"> 
			<span class="ui-icon ui-icon-newwin"></span><?php echo lang("Report Output");?> </a>
		</li>
		
	</ul>
	
	<div id="ui-widget-report-navigation" class="ui-widget-panel-class-tabs"> 
		<?php get_view(array('rpt_sales_report_tabulasi_robotik','report_sales_group'));?>
	</div>
	
	
</div>

<?php
if( $this->EUI_Session->_get_session('HandlingType') == '8' || $this->EUI_Session->_get_session('HandlingType') == '9'){
?>
<style> .ui-widget-display-none { display:none; } .ui-widget-display-yes { display:yes; } </style>
<fieldset class="corner ui-widget-fieldset" style="width:auto;margin:5px; border-radius:5px;">
<?php echo form()->legend(lang(array("Filter","Of", "Report")),"fa-file-text-o");?>

 <form name="frmReport2">
	<div class="ui-widget-form-table-compact">
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption">Report Type</div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo('report_type2','select auto', $report_type_new, null, array("change" => "ShowFilterReport2(this);"));?></div>
		</div>


		<div id="ui-widget-row-product" class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption" id="ui-widget-label-row-product">Product</div>
			<div class="ui-widget-form-cell text_caption center" id="ui-widget-separator-row-product">:</div>
			<div class="ui-widget-form-cell" id="ui-widget-content-row-product"><?php echo form()->chooseall('ProductId','select tolong',  $report_product);?></div>
		</div>
		
		
		<div id="ui-widget-row-new" class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption" id="ui-widget-label-rowx-new">Campaign Status</div>
			<div class="ui-widget-form-cell text_caption center" id="ui-widget-separator-rowx-new">:</div>
			<div class="ui-widget-form-cell" id="ui-widget-content-rowx-new">
				<?php
					echo form()->combo('CampaignStatus','select tolong', array("2"=>"All","1"=>"Aktif","0"=>"Non Aktif") , null, array('change' => 'FilterCampaignStatus(this)'));
				?>
			</div>
		</div>

		<div id="ui-widget-row-new" class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption" id="ui-widget-label-row0-new">CampaignId</div>
			<div class="ui-widget-form-cell text_caption center" id="ui-widget-separator-row0-new">:</div>
			<div class="ui-widget-form-cell" id="ui-widget-content-row0-new">
				<?php
					echo form()->chooseall('CampaignId2','select tolong',  $report_campaign, null, array("change" => "ShowFilterProduct(this);"));
				?>
			</div>
		</div>

		
				
		<div id="ui-widget-row1" class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption" id="ui-widget-label-row1">Account Manager</div>
			<div class="ui-widget-form-cell text_caption center" id="ui-widget-separator-row1">:</div>
			<div class="ui-widget-form-cell" id="ui-widget-content-row1">
				<?php echo form()->combo('ManagerId2','select tolong',$report_atm, 
																	 $report_user->get_value('spv_id'), 
																	 array("change"=>"ShowSpvReportByMangerNew(this);"));?> </div>
		</div>
		
		
		<div id="ui-widget-row3" class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption" id="ui-widget-label-row3">Supervisor</div>
			<div class="ui-widget-form-cell text_caption center" id="ui-widget-separator-row3">:</div>
			<div class="ui-widget-form-cell" id="ui-widget-content-row-spv"><?php echo form()->combo('spvid2','select tolong', $report_spv, $report_user->get_value('tl_id'),
				array("change" => "ShowAgentReportBySpvNew(this);") );?></div>
		</div>
		
		<div id="ui-widget-row4" class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption" id="ui-widget-label-row4">Agent</div>
			<div class="ui-widget-form-cell text_caption center" id="ui-widget-separator-row4">:</div>
			<div class="ui-widget-form-cell" id="ui-widget-content-row-tmr"><?php echo form()->combo('TmrId2','select tolong', $report_agent);?></div>
		</div>
		
		<div id="ui-widget-row5" class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption" id="ui-widget-label-row5">Interval</div>
			<div class="ui-widget-form-cell text_caption center" id="ui-widget-separator-row5">:</div>
			<div class="ui-widget-form-cell" id="ui-widget-content-row5"> <?php echo form()->input('start_date2','input_text box date');?> &nbsp- <?php echo form()->input('end_date2','input_text box date');?></div>
			
		</div>
		
		<div id="ui-widget-row6" class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption" id="ui-widget-label-row6">Mode</div>
			<div class="ui-widget-form-cell text_caption center" id="ui-widget-separator-row6">:</div>
			<div class="ui-widget-form-cell" id="ui-widget-content-row6"><?php echo form()->combo('interval2','select auto', $report_mode);?></div>
		</div>
		
		<div id="ui-widget-row7" class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption" id="ui-widget-label-row7"></div>
			<div class="ui-widget-form-cell text_caption center" id="ui-widget-separator-row7"></div>
			<div class="ui-widget-form-cell" id="ui-widget-content-row7"> 
			<?php /*echo form()->button_role( '_SUB_TOOL_', $report_button);?>
			<?php echo form()->button_role( '_XLS_TOOL_', $report_button);*/?>
			
				<?php echo form()->button('','page-go button','Show',array("click"=>"new ShowReport2();"));?>
					<?php echo form()->button('','excel button','Export',array("click"=>"new ShowExcel2();"));?>
				
			</div>
		</div>
		
		
	</div>
</form>

</fieldset>
<?php 
}else{
	echo "<h1>Data tidak ada</h1>";
}
?>
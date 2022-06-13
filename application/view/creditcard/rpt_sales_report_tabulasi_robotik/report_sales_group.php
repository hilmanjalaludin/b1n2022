<style> .ui-widget-display-none { display:none; } .ui-widget-display-yes { display:yes; } </style>
<fieldset class="corner ui-widget-fieldset" style="width:auto;margin:5px; border-radius:5px;">
<?php echo form()->legend(lang(array("Filter","Of", "Report")),"fa-file-text-o");
// print_r($Transaksi);
?>

 <form name="frmReportTab2">
	<div class="ui-widget-form-table-compact">
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption">Product</div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo('product_id','select auto x-select', Product() ,null, array("change" => "window.showCampaignByProductId(this);"));?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption">Campaign</div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell" id="filter-data-campaign"><?php echo form()->combo('campaign_id','select auto x-select', array(), null, 
				array("change" => "window.showRecsourceByCampaignId(this);"), array('title' => '') );?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption">Transaksi</div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell" id="filter-data-transaksi"><?php echo form()->combo('transaksi','select auto x-select', $Transaksi );?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption">Source</div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell" id="filter-data-recsource"><?php echo form()->combo('recsource_id','select auto x-select', array() ,null, null, array('title' => '') );?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption">Supervisor</div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo('supervisor_id','select auto', $Supervisor, null, array("change" => "ShowAgentReportBySpv(this);") );?></div>
		</div>
		
		<div id="ui-widget-row4" class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption" id="ui-widget-label-row4">Agent</div>
			<div class="ui-widget-form-cell text_caption center" id="ui-widget-separator-row4">:</div>
			<div class="ui-widget-form-cell" id="ui-widget-content-row4"><?php echo form()->combo('TmrId','select tolong', $report_agent);?></div>
		</div>
		
		<div id="ui-widget-row5" class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption" id="ui-widget-label-row5">Interval</div>
			<div class="ui-widget-form-cell text_caption center" id="ui-widget-separator-row5">:</div>
			<div class="ui-widget-form-cell" id="ui-widget-content-row5"> <?php echo form()->input('start_date','input_text box date');?> &nbsp- <?php echo form()->input('end_date','input_text box date');?></div>
			
		</div>

		<div id="ui-widget-row7" class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption" id="ui-widget-label-row7"></div>
			<div class="ui-widget-form-cell text_caption center" id="ui-widget-separator-row7"></div>
			<div class="ui-widget-form-cell" id="ui-widget-content-row7"> 
				<!-- perubahan 12-08-2020 -->
					<?php 
                    if($this->EUI_Session->_get_session('HandlingType') != '22'&& $this->EUI_Session->_get_session('UserId')!='685'){
			 		echo form()->button('buttonshow','page-go button','Show',array("click"=>"new ShowReport();"));
					}?>
				<!-- end -->
				<?php echo form()->button('buttonhtml','excel button','Export',array("click"=>"new ShowExcel();"));?>
				<!-- perubahan 12-08-2020 -->
				<?php 
                    if($this->EUI_Session->_get_session('HandlingType') != '22' && $this->EUI_Session->_get_session('UserId')!='685'){
			 			echo form()->button('buttontext','page-blank button','Text',array("click"=>"new ShowText();"));
					}?>
				<!-- end -->
			</div>
		</div>
		
		
		
	</div>
</form>

</fieldset>

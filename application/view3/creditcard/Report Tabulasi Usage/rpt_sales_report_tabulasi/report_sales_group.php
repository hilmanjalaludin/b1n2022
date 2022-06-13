<style> .ui-widget-display-none { display:none; } .ui-widget-display-yes { display:yes; } </style>
<fieldset class="corner ui-widget-fieldset" style="width:auto;margin:5px; border-radius:5px;">
<?php echo form()->legend(lang(array("Filter","Of", "Report")),"fa-file-text-o");?>

 <form name="frmReport">
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
			<div class="ui-widget-form-cell text_caption">Source</div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell" id="filter-data-recsource"><?php echo form()->combo('recsource_id','select auto x-select', array() ,null, null, array('title' => '') );?></div>
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
				<?php echo form()->button('','page-go button','Show',array("click"=>"new ShowReport();"));?>
				<?php echo form()->button('','excel button','Export',array("click"=>"new ShowExcel();"));?>
			</div>
		</div>
		
		
		
	</div>
</form>

</fieldset>

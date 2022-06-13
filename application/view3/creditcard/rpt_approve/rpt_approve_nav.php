<style> .ui-widget-display-none { display:none; } .ui-widget-display-yes { display:yes; } </style>
<fieldset class="corner ui-widget-fieldset" style="width:auto;margin:5px; border-radius:5px;">
<?php echo form()->legend(lang(array("Filter","Of", "Report")),"fa-file-text-o");?>
	<form name="frmReport">
		<div class="ui-widget-form-table-compact">
			<div class="ui-widget-form-row">
				<div class="ui-widget-form-cell text_caption">Campaign</div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell" id="filter-data-campaign">
				<?php //echo form()->checkbox('campaign_id','field_checkbox', $CampaignList);?>
				<input type="checkbox" name="check_all" id="check_all" onchange="Ext.DOM.CheckAll()"> #All <br />
				<?php 
					// echo "<pre>";
					//  var_dump($CampaignList);
					foreach ($CampaignList as $key => $value) {
						// echo "<pre>";
						// var_dump($key);
						//echo form()->checkbox('campaign_id','field_checkbox', $key,null,$value);
						echo '<input type="checkbox" class="field_checkbox" name="campaign_id" id="campaign_id" value="'.$key.'">'.$value.' <br/>';
					}
				//echo form()->combo('campaign_id','select auto x-select', $CampaignList );
				?>
					<?php //echo form()->checkbox('campaign_id','frm-field-agent-show',$CampaignList);?>
				
				</div>
			</div>

			<div id="ui-widget-row5" class="ui-widget-form-row">
				<div class="ui-widget-form-cell text_caption" id="ui-widget-label-row5">Interval</div>
				<div class="ui-widget-form-cell text_caption center" id="ui-widget-separator-row5">:</div>
				<div class="ui-widget-form-cell" id="ui-widget-content-row5"> <?php echo form()->input('start_date','input_text box date');?> &nbsp- <?php echo form()->input('end_date','input_text box date');?></div>
			</div>
			
			<div class="ui-widget-form-row">
				<div class="ui-widget-form-cell text_caption">Status</div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell" id="filter-data-campaign"><?php echo form()->combo('mode','select auto x-select', array(1 => 'Approve', 2 => 'Approve Appoinment', 3 => 'Reject',4 =>'New') );?></div>
			</div>

			<div id="ui-widget-row7" class="ui-widget-form-row">
				<div class="ui-widget-form-cell text_caption" id="ui-widget-label-row7"></div>
				<div class="ui-widget-form-cell text_caption center" id="ui-widget-separator-row7"></div>
				<div class="ui-widget-form-cell" id="ui-widget-content-row7"> 
					<?php echo form()->button('buttonshow','page-go button','Show',array("click"=>"new ShowReport();"));?>
					<?php echo form()->button('buttonhtml','excel button','Export',array("click"=>"new ShowExcel();"));?>
				</div>
			</div>
		</div>
	</form>
</fieldset>

<?php $this -> load -> view('rpt_approve/rpt_approve_js') ?>

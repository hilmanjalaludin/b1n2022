<?php
	$dataCycle = array();
	if($this->EUI_Session->_get_session('ProfileId') == 1 || $this->EUI_Session->_get_session('ProfileId') == 8){
		$cycle = $this->db->query('SELECT a.CV_Data_Cycle FROM t_gn_customer_verification a 
		GROUP BY a.CV_Data_Cycle')->result_array();
		foreach($cycle as $item) {
			if($item['CV_Data_Cycle'] != null || $item['CV_Data_Cycle'] != '') {
				// array_push($dataCycle, $item['CV_Data_Cycle']);
				$dataCycle[$item['CV_Data_Cycle']] = $item['CV_Data_Cycle'];
			}
		}
	}
?>
<fieldset class="corner ui-fieldset-dis-top" style="width:auto;padding: 4px 4px 2px 4px;margin:-12px -5px 5px 0px;">
<?php echo form()->legend(lang("Filter Data"),"fa-search");?>
	<form name="formDisFilter">
	<div class="ui-widget-form-table" style="margin-top:-5px;width:100%;">
		
		<!-- <div class="ui-widget-form-row">
			<div class="ui-widget-form-cell ui-widget-content-top text_caption">
				<?php
					// echo lang("LB_Recsource");
				?>
			</div>
			<div class="ui-widget-form-cell ui-widget-content-top text_caption">:</div>
			<div class="ui-widget-form-cell ui-widget-content-top">
				<?php
					// echo form()->combo("dis_recsource_name", "select xselect tolong",FileRecsourceTrans(), null, null, array('multiple' => true ));
				?>
			</div>
		</div> -->
		
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("LB_CampaignId");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo("dis_campaign_name", "select xselect tolong",CampaignId(), null, null, array('multiple' => true ) );?></div>
			
		</div>	
		
	
		
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('LB_CallReasonCategoryName'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell text_caption left"><?php echo form() -> combo('dis_call_status','select xselect tolong', CategoryCallNew(), null, null, array('multiple' => true) );?></div>
		</div>
		<?php
			if($this->EUI_Session->_get_session('ProfileId') == 1 || $this->EUI_Session->_get_session('ProfileId') == 8){
		?>
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Cycle");?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell text_caption left">
				<?php
					echo form()->combo('cycle', 'select xselect tolong', $dataCycle, null, null, array('multiple' => true));
				?>
			</div>
		</div>
		<?php
			}
		?>
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('LB_AvailSS'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell text_caption left">
			
			    <?php //echo form() -> fieldinteraval('dis_avail_ss','select box', AllCallStatus(), null, null, array('multiple' => true) );?>
			    <select name="dis_avail_ss_start" id="dis_avail_ss_start" class="select box">
                      <option value="">Choose</option>
                      <option value="0">0</option>
                      <option value="1000000.00">1</option>
                      <option value="3000000.00">3</option>
                      <option value="5000000.00">5</option>
                      <option value="10000000.00">10</option>
                      <option value="15000000.00">15</option>
                      <option value="25000000.00">25</option>
                      <option value="50000000.00">50</option>
                      <option value="100000000.00">100</option>
                      <option value="150000000.00">150</option>
                      <option value="250000000.00">250</option>
                      <option value="1000000000.00">1000</option>
			   </select>
			   &nbsp;&nbsp;to&nbsp;&nbsp; 
			   <select name="dis_avail_ss_stop" id="dis_avail_ss_stop" class="select box">
         			 <option value="">Choose</option>
					  <option value="0">0</option>
					  <option value="1000000.00">1</option>
                      <option value="3000000.00">3</option>
                      <option value="5000000.00">5</option>
                      <option value="10000000.00">10</option>
                      <option value="15000000.00">15</option>
                      <option value="25000000.00">25</option>
                      <option value="50000000.00">50</option>
                      <option value="100000000.00">100</option>
                      <option value="150000000.00">150</option>
                      <option value="250000000.00">250</option>
                      <option value="1000000000.00">1000</option>
			   </select>
			</div>
		</div>
		
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('LB_KreditLimit'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell text_caption left"><?php echo form() -> fieldinteraval('dis_kredit_limit','select box', AllCallStatus(), null, null, array('multiple' => true) );?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('LB_RangeAge'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell text_caption left"><?php echo form() -> fieldinteraval('dis_range_age','select box', AllCallStatus(), null, null, array('multiple' => true) );?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("LB_DateAssignment");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->interval('dis_assign_date', "input_text date");?></div>
		</div>
		
		<div class="ui-widget-form-row">			
			<div class="ui-widget-form-cell ui-widget-content-top text_caption"><?php echo lang("LB_CustomerUpdatedTs");?></div>
			<div class="ui-widget-form-cell ui-widget-content-top text_caption">:</div>
			<div class="ui-widget-form-cell ui-widget-content-top"> <?php echo form()->interval('dis_update','input_text date' );?> </div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell ui-widget-content-top text_caption"><?php echo lang("Record/page");?></div>
			<div class="ui-widget-form-cell ui-widget-content-top text_caption">:</div>
			<div class="ui-widget-form-cell ui-widget-content-top"><?php echo form()->input("dis_record_page", "input_text long", 20);?></div>
		</div>	
		
		<div class="ui-widget-form-row ui-display-none">
			<div class="ui-widget-form-cell ui-widget-content-top text_caption"><?php echo lang("Call Atempt");?></div>
			<div class="ui-widget-form-cell ui-widget-content-top text_caption">:</div>
			<div class="ui-widget-form-cell ui-widget-content-top ui-widget-content-top">
				<?php echo form()->input("dis_start_atempt", "input_text box");?>
				<span style="margin:0px 8px 0px 8px;"><?php echo lang("to"); ?></span>
				<?php echo form()->input("dis_end_atempt", "input_text box");?>
			</div>
			
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"></div>
			<div class="ui-widget-form-cell text_caption"></div>
			<div class="ui-widget-form-cell">
				<?php echo form()->button("BtnDisFilter","button search", lang("Search"), array('click' => 'Ext.DOM.SearchDataDist();'));?>
				<?php echo form()->button("BtnDisReset","button clear", lang(array("Clear","&nbsp;&nbsp;")), array('click' => 'Ext.DOM.ClearDataDist();'));?>	
			</div>
		</div>
	</div>
	</form>
</fieldset>

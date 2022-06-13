<?php
get_view(array("second_product", "view_jsv"));
// $this->result_array = array();
// foreach( $campaign as $key => $val )
// {
// 	// $this->result_array = $val->CampaignCode;
// 	$data = array(
// 		'id' => $val->CampaignId,
// 		'code' => $val->CampaignCode
// 	);
// 	array_push($this->result_array, $data);
// }
// echo  '<pre>';
// print_r($campaign);
// echo  '</pre>';
?>
<div id="ui-widget-add-campaign" class="tabs corner ui-frame-with">
	<div id="ui-widget-add-content" class="ui-widget-add-content ui-frame-with">
		<fieldset class="corner ui-widget-fieldset" style="margin:5px; border-radius:5px;">
			<?php echo form()->legend(lang("Edit"), "fa-edit"); ?>
			<form name="frmEditLayout">
				<?php echo form()->hidden('CV_Data_Id', null, $row->get_value('CV_Data_Id')); ?>
				<?php echo form()->hidden('CV_Data_Custno', null, $row->get_value('CV_Data_Custno')); ?>
				<div class="ui-widget-form-table">
					<div class="ui-widget-form-row">
						<div class="ui-widget-form-cell text_caption">Old Campaign</div>
						<div class="ui-widget-form-cell center">:</div>
						<div class="ui-widget-form-cell left"><?php echo form()->input('Old_CampaignCode', 'input_text superlong', $row->get_value('CampaignCode')); ?></div>
					</div>
					<div class="ui-widget-form-row">
						<div class="ui-widget-form-cell text_caption">New Campaign</div>
						<div class="ui-widget-form-cell center">:</div>
						<div class="ui-widget-form-cell left">
							<?php
							// echo form()->combo('New_CampaignCode', 'select superlong', $this->result_array);
							?>
							<select name="New_CampaignCode" id="New_CampaignCode" class="select superlong">
								<option value=""> --choose -- </option>
								<?php
								foreach ($campaign as $item) {
									echo '<option value="' . $item->CampaignId . '">' . $item->CampaignCode . '</option>';
								}
								?>
							</select>
						</div>
					</div>
					<div class="ui-widget-form-row">
						<div class="ui-widget-form-cell text_caption">Old CustId</div>
						<div class="ui-widget-form-cell center">:</div>
						<div class="ui-widget-form-cell left"><?php echo form()->input('Old_CV_Data_CustId', 'input_text superlong', $row->get_value('CV_Data_CustId')); ?></div>
					</div>
					<div class="ui-widget-form-row">
						<div class="ui-widget-form-cell text_caption">New CustId</div>
						<div class="ui-widget-form-cell center">:</div>
						<div class="ui-widget-form-cell left"><?php echo form()->input('New_CV_Data_CustId', 'input_text superlong', ''); ?></div>
					</div>
					<div class="ui-widget-form-row">
						<div class="ui-widget-form-cell"></div>
						<div class="ui-widget-form-cell"></div>
						<input type="button" class="save button" onclick="Ext.DOM.UpdateLayout();" value="Save"></td>
					</div>
				</div>
			</form>
		</fieldset>
	</div>
</div>
<fieldset class="corner ui-widget-fieldset" style="margin:-5px 5px 5px 5px;  ">
		<?php echo form()->legend(lang("Upload"),"fa-upload");?>
		<div class="ui-widget-form-table-compact">
			
			<div class="ui-widget-form-row">
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('LB_Browsefile'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell "><?php echo form() -> upload('fileToupload'); ?></div>
			</div>
			
			<div class="ui-widget-form-row">
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('LB_CampaignId'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell "><?php echo form()->combo('upload_campaignId','select superlong xzselect', CampaignId(), null); ?></div>
			</div>
			
			<div class="ui-widget-form-row">
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('LB_Template'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell "><?php echo form() -> combo('upload_template','select superlong xzselect', InsertTemplate() ); ?></div>
			</div>
			<?php /*
			<div class="ui-widget-form-row">
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('LB_ExpiredDate'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell "><?php echo form()->input('upload_expired','input_text date'); ?></div>
			</div>
			*/?>
			<div class="ui-widget-form-row">
				<div class="ui-widget-form-cell text_caption"></div>
				<div class="ui-widget-form-cell text_caption center"></div>
				<div class="ui-widget-form-cell" id="ui-widget-image-loading"></div>
			</div>
			
			<div class="ui-widget-form-row">
				<div class="ui-widget-form-cell text_caption"></div>
				<div class="ui-widget-form-cell text_caption center"></div>
				<div class="ui-widget-form-cell ">
					<?php echo form()->button_role('_UPL_TOOL_', $Button);?>
				</div>
			</div>
		</div>
		</fieldset>
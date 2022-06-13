<fieldset class="corner ui-widget-fieldset" style="margin:-5px 5px 5px 5px;  ">
	<?php echo form()->legend(lang("Upload"),"fa-upload");?>
	<form name="frmUploadRefresh" onsubmit="return false;">	
	<div class="ui-widget-form-table-compact">
			<div class="ui-widget-form-row">
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('LB_Browsefile'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell "><?php echo form() -> upload('fileTorefresh'); ?></div>
			</div>
			
			<div class="ui-widget-form-row">
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('LB_CampaignId'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell "><?php echo form()->combo('refresh_campaignId','select superlong xzselect', AllCampaignRefresh(), null); ?></div>
			</div>
			
			<div class="ui-widget-form-row">
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('LB_Template'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell "><?php echo form() -> combo('refresh_template','select superlong xzselect', UpdateTemplate() ); ?></div>
			</div>
			
			
			<div class="ui-widget-form-row">
				<div class="ui-widget-form-cell text_caption"></div>
				<div class="ui-widget-form-cell text_caption center"></div>
				<div class="ui-widget-form-cell" id="ui-widget-image-loading2"></div>
			</div>
			
			<div class="ui-widget-form-row">
				<div class="ui-widget-form-cell text_caption"></div>
				<div class="ui-widget-form-cell text_caption center"></div>
				<div class="ui-widget-form-cell ">
				<?php
				
				// add new button component on role User 
				// customization User Button : example 	
				
					$Button->add('_REU_TOOL_', new EUI_Object( array( 'Index'  => 'REU_TOOL27',
																	  'Event'  => 'EventReupload',
																	  'Label'  => 'BT_Cap_Upload',
																	  'Icons'  => 'button save ui-window') ));
														
					printf('%s', form()->button_role( '_REU_TOOL_', $Button ));
					
					?>
				</div>
			</div>
	</div>
	 </form>	
 </fieldset>
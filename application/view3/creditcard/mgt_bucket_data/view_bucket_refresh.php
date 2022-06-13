<fieldset class="corner ui-widget-fieldset" style="margin:-5px 5px 5px 5px;  ">
	<?php echo form()->legend(lang("Data Refresh"),"fa-upload");?>
	<form name="frmUploadRefresh" onsubmit="return false;">	
	<div class="ui-widget-form-table-compact">
			<div><?php echo form()->hidden('refresh_campaignId',null, 'Allin', null);?></div>
			<div class="ui-widget-form-row">
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('LB_Browsefile'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell "><?php echo form() -> upload('fileTorefresh'); ?></div>
			</div>
			
			<!-- div class="ui-widget-form-row">
				<div class="ui-widget-form-cell text_caption"></?php echo lang(array('LB_CampaignId'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell "></div>
			</div -->
			
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
					
					$Button->add('_REU_TOOL_', new EUI_Object( array( 'Index'  => 'REU_TOOL27',
																	  'Event'  => 'downloadFixId',
																	  'Label'  => 'BT_Cap_Download',
																	  'Icons'  => 'button save ui-window') ));
					printf('%s', form()->button_role( '_REU_TOOL_', $Button ));
					
					?>
				</div>
			</div>
	</div>
	 </form>	
 </fieldset>
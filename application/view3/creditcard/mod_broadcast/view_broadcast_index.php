<?php 
// echo "<pre>";
// print_r($button);
// echo "</pre>";
?>
 
<div class="contact_detail" style="margin-left:-8px;">

	<!-- start : detail -->
	<div class="ui-widget-form-table-compact" style="width:99%;">
		
		<div class="ui-widget-form-row" style="vertical-align:top;">
			
			<div class="ui-widget-form-cell" style="width:65%;vertical-align:top;">
					<fieldset class="corner" style="margin-top:-3px;border-radius:5px;padding:3px 0px 20px 0px;">
					<?php echo form()->legend(lang(array('Users')), "fa-users"); ?>
						<div class="ui-widget-form-table" id="ui-window-users" style="width:99%"></div>
					</fieldset>	
			</div>
			
			<div class="ui-widget-form-cell" style="vertical-align:top;width:35%;">
				<fieldset class="corner" style="margin-left:10px;margin-top:-3px;border-radius:5px;padding:-5px 10px 0px 12px;">
					<?php echo form()->legend(lang(array('Text Message')), "fa-comments"); ?>
					
					<div class="ui-widget-form-table-compact">
						<div class="ui-widget-form-row" style="text-align:center;vertical-align:top;">
							<div class="ui-widget-form-cell text_caption center"> -- User State -- </div>
						</div>
						
						<div class="ui-widget-form-row" style="text-align:center;vertical-align:top;">
							<div class="ui-widget-form-cell"><?php echo form()->combo("frm-field-agent-state", "select x-select-boot", array('1' => 'Login', 0=>'Logout'), null, array("change"=>"window.EventShowAgent();") );?></div>
						</div>
						
						<div class="ui-widget-form-row" style="text-align:center;vertical-align:top;">
							<div class="ui-widget-form-cell text_caption center"> -- Show All Page -- </div>
						</div>
						
						<div class="ui-widget-form-row" style="vertical-align:top;">
							<div class="ui-widget-form-cell center">
								<?php echo form()->checkbox('frm-field-agent-show',null,1, array("change"=>"window.EventShowAgent();"));?>
							</div>
						</div>
					</div>
					
					<div class="ui-widget-form-table-compact">
						
						<div class="ui-widget-form-row" style="vertical-align:top;">
							<div class="ui-widget-form-cell">
								<textarea class="textarea" name="text_message" id="text_message" 
								style="border-radius:5px;border:1px solid #dddddd; font-family:consolas;
								font-size:12px;margin-right:2px;margin-left:2px;margin-top:-5px;
								color:green;height:200px;width:400px;"></textarea>
							</div>
						</div>
							
						<div class="ui-widget-form-row" style="vertical-align:top;">
							<div class="ui-widget-form-cell" style="padding-left:5px;text-align:center;">
							<?php echo form()->button_role("_SUB_TOOL_", $button);?>
							<?php echo form()->button_role("_CLR_TOOL_", $button);?>
							</div>
						</div>
					</div>
				</fieldset>
			</div>
			
		</div>
	</div>
</div>
 
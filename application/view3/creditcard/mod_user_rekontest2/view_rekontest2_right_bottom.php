<div class="ui-widget-form-table-compact">
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Option Action");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->ListCheckbox("torek_useraction", DistribusiAction(), null, array("change" =>"Ext.Cmp('torek_useraction').oneChecked(this);window.EventOnBucket('RekontestId', this);")); ?></div>
		</div>
		
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array("Avail","Data"));?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->input("torek_availdata", "input_text tolong readonly");?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array("Share Data"));?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->input("torek_sharedata", "input_text tolong");?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"></div>
			<div class="ui-widget-form-cell text_caption"></div>
			<div class="ui-widget-form-cell"></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array("Call Status ID"));?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo("torek_callstatusid", "select tolong", AllCallStatus(), null, array('change' => 'window.ToEventCallStatus(this);')  );?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array("Call Reason ID"));?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell" id="to-call-reason-id"><?php echo form()->combo("torek_callreasonid", "select tolong");?></div>
		</div>
		
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array("Date Time"));?></div>
			<div class="ui-widget-form-cell text_caption"></div>
			<div class="ui-widget-form-cell">
				<?php echo form()->input('DateLater','input_text box date ui-disfield'); ?>&nbsp;
				<?php echo form()->combo('HourLater','select boox ui-disfield',ListHour(), '00', null,array('style'=>'margin-top:2px;', 'title'=> '' )); ?> :
				<?php echo form()->combo('MinuteLater','select boox ui-disfield',ListMinute(),'00', null, array('style'=>'margin-top:2px;', 'title'=> '' ));?>
			
			</div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"></div>
			<div class="ui-widget-form-cell text_caption"></div>
			<div class="ui-widget-form-cell"></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Group User");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo("torek_groupuser", "select xzselect tolong", @call_user_func('SetCapital', DitributeUserLevel()), null, array('change' => 'window.EventToUserGroup(this);') );?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("User ID");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell" id="torek_userlist_html"><?php echo form()->combo("torek_userlist", "select xzselect tolong", array(), null );?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"></div>
			<div class="ui-widget-form-cell text_caption"></div>
			<div class="ui-widget-form-cell">
				<?php echo form()->button_role("_SUB_TOOL_", $Button);?>
				<?php echo form()->button_role("_CLS_TOOL_", $Button);?>
			</div>
		</div>
</div>

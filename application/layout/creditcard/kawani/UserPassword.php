<?php

/*
 * @ def 	: User Password 
 * -----------------------------------
 * @ param 	: layout section
 * @ aksess : public
 * @ author	: razaki team
 */
 
?>
<div id="pass" title="<i class='fa fa-unlock-alt' aria-hidden=true></i>&nbsp;Change Password" style="display:none;width:400px;">
  	
	<div class="ui-widget-form-table-compact">
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption right">* Current Password</div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell left"><input type="password" name="curr_password" id="curr_password" class="input_text"/></div>	
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption right">* New Password</div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell left"><input type="password" name="new_password" id="new_password" value="" class="input_text" /></div>	
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption right">* Re-type New Pass.</div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell left"><input type="password" name="re_new_password" id="re_new_password" value="" class="input_text" /></div>	
		</div>		
	</div>
	
</div> 
 <div id="password_confirm" title="Change Password"> </div>
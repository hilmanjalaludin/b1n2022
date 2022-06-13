<!-- add menu Help -> about as -->
	<div class="ribbon-tab" id="help-about">
		<span class="ribbon-title">
			<i class="fa fa-question-circle" aria-hidden="true"></i>&nbsp;Help</span>	
		
		<div class="ribbon-sectionx"> 
		<div class="ribbon-buttonx ribbon-button-large" id="help-application-menu" >
			<div class="ui-widget-form-table ui-help-application-menu">
				<div class="ui-widget-form-row">
					<div class="ui-widget-form-cell"><i class="fa fa-search" aria-hidden="true"></i>&nbsp;&nbsp;Menu&nbsp;</div>
					<div class="ui-widget-form-cell"><?php  echo form()->input("HelpApplicationMenuId", "input_text superlong help-application-menu", null, null, array('placeholder'=> '') );?></div>
					
				</div>
			</div>	
			</div>		
		</div>
		
		<div class="ribbon-section"> 
			<div class="ribbon-button ribbon-button-large" onclick="Ext.MyProfile();" id="user-profile-id" >
				<span class="button-title">
				<i class="fa fa-external-link" aria-hidden="true"></i>
				&nbsp;&nbsp;My Profile</span>
			</div>		
		</div>	
		
		<div class="ribbon-section"> 
			<div class="ribbon-button ribbon-button-large" onclick="Ext.DOM.ChangeMyPassword();" id="user-logout-id" >
				<span class="button-title">
				<i class="fa fa-external-link" aria-hidden="true"></i>
				&nbsp;&nbsp;Change Password</span>
			</div>		
		</div>	
		
		<div class="ribbon-section"> 
		<div class="ribbon-button ribbon-button-large" onclick="window.UserModal();" id="about-id" >
				<span class="button-title">
				<i class="fa fa-external-link" aria-hidden="true"></i>&nbsp;&nbsp;About Us</span>
			</div>		
		</div>	
		
		
		
		
	</div>

	
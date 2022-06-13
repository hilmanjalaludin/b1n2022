<?php $this->load->layout(base_layout()."/UserLoginHeader");?>
<body>
<div id="loginModal" class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header"><span>
			<img class="ribbon-icon ribbon-normal" src="<?php echo base_image_layout();?>/favicon.png"   width="36" height="36"/>
			<span class="title-form-login"><?php echo description();?> </span> 
		</span>		
		 
      </div>
      <div class="modal-body">
          <form id="frmChgLogin" name="frmChgLogin" class="form center-block"  >
		   <div class="form-group">
				<input type="text" id="username" name="username" value="<?php echo _get_session('old_user_agent'); ?>" class="form-control input-form-login" placeholder="User ID" disabled>
            </div>
			
            <div class="form-group">
              <input type="password" id="password" name="password" value="<?php echo _get_session('old_password','base64_encode'); ?>"  class="form-control input-form-login" placeholder="Old Password" disabled >
            </div>
			
			 <div class="form-group">
              <input type="password" id="newpassword" name="newpassword" class="form-control input-form-login" placeholder="New Password">
            </div>
            
			<div class="form-group">
              <input type="button" value="<?php echo lang("Change password"); ?>" onclick="Ext.DOM.ChangePassword();" class="btn btn-primary btn-block button-login">
            </div>
			<div class="form-group" style="text-align:center;height:0px;">
				
			</div>
          </form>
      </div>
  </div>
  </div>
</div>
     
</body>
</html>
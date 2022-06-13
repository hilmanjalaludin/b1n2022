<?php $this->load->layout(base_layout()."/UserLoginHeader");?>
<body>
<div class="pen-title">
	<span>
		<img class="ribbon-icon ribbon-normal" src="<?php echo base_image_logo();?>"  width="160" height="60"/>
	</span>		
	<p class="title">
		 
		<?php printf("Welcome To %s", vendors('vendor')->field('vendor.title'));?> 
	</p>
	
</div>

<!-- Form Module-->
<div class="module form-module">
  <div class="toggle">
	<i class="fa fa-times fa-pencil"></i>
    <div class="tooltip">Click Me</div>
  </div>
   <div class="form">
    <h2><i class="fa fa-user"></i>&nbsp;&nbsp;<?php echo lang('Login to your account');?></h2>
    <form  id="frmLogin" name="frmLogin" onSubmit="return false;">
      <input type="text" id="username" name="username" placeholder="Username"/>
      <input type="password" id="password" name="password"   placeholder="Password"/>
      <button onclick="window.UserLogin();"><?php echo lang("Login"); ?></button>
    </form>
  </div>
  
  <div class="form">
    <h2><i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo lang('Create an account');?></h2>
    <form onSubmit="return false;">
      <input type="text" 	   placeholder="Username"/>
      <input type="password"   placeholder="Password"/>
      <input type="email" 		placeholder="Email Address"/>
      <input type="tel" 		placeholder="Phone Number"/>
      <button>Register</button>
    </form>
  </div>
  <div class="cta"><a href="javascript:void(0);">
	<?php echo copyright();?></a></div>
  
</div>


<script>
// Toggle Function
$('.toggle').click(function(){
  $(this).children('i').toggleClass('fa-pencil');
  $('.form').animate ({ height: "toggle", 'padding-top': 'toggle', 'padding-bottom': 'toggle', opacity: "toggle" }, "slow");
  
});
</script>
	
     
</body>
</html>
<?php echo javascript(); ?>
<script type="text/javascript">


// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
 Ext.DOM.onload= (function(){
	Ext.Cmp('ui-widget-title').setText( Ext.System.view_file_name());
 })()
 
//-----------------------------------------------------------------------

/*
 * modul  		 	method get User Role 
 *
 * @akses 			public & of run window  
 * @author 			uknown 
 */

var Role = new Ext.Role("SysUser");
	Role.extend([
		{ title: " ", icon :"", event: "", key :'UserId' } // if you have other extends event 
	]);
   
 	
// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
Ext.DOM.datas = 
{
	user_active 	: "<?php echo _get_exist_session('user_active');?>",
	user_address 	: "<?php echo _get_exist_session('user_address');?>",
	user_id 		: "<?php echo _get_exist_session('user_id');?>",
	user_login 		: "<?php echo _get_exist_session('user_login');?>",
	user_name 		: "<?php echo _get_exist_session('user_name');?>",
	user_privileges : "<?php echo _get_exist_session('user_privileges');?>",
	order_by 		: "<?php echo _get_exist_session('order_by');?>",
	type	 		: "<?php echo _get_exist_session('type');?>"
}

	

//-----------------------------------------------------------------------

/*
 * modul  		 	Uplaod Template
 *
 * @akses 			public & of run window  
 * @author 			uknown 
 */
 
$(function(){
 $('#toolbars').extToolbars
({
	extUrl    : Role.image(),  
	extTitle  : Role.title(),
	extMenu   : Role.event(), 
	extIcon   : Role.icon(), 
	extText   : true,
	extInput  : true,
	extOption : [{
			render  : Role.last(), 
			type	: 'label',
			label	: '',
			id		: 'load_images_id',
			name	: 'load_images_id'		
		}]
	});
	
	 // $('.date').datepicker
	 // ({
		// showOn: 'button', 
		// changeYear:true,
		// changeMonth:true,
		// buttonImage: Ext.Image("calendar.gif"), 
		// buttonImageOnly: true, 
		// dateFormat:'dd-mm-yy',
		// readonly:true
	 // });
	 
	 $('.select').chosen();
	 
});

// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
 Ext.EQuery.TotalPage = '<?php echo $page -> _get_total_page(); ?>';
 Ext.EQuery.TotalRecord = '<?php echo $page -> _get_total_record(); ?>';


// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
Ext.DOM.navigation =  {
	custnav	 : Role.pageIndex(),
	custlist : Role.pageContent()
}
// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
Ext.EQuery.construct( Ext.DOM.navigation, Ext.DOM.datas )
Ext.EQuery.postContentList();



// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
 window.EventSearch = function() {
	$.cookie('selected',0)	
	var FrmUserRegistration = Ext.Serialize('FrmUserRegistration').getElement();
		Ext.Progress("load_images_id").start();
		Ext.EQuery.construct( Ext.DOM.navigation, Ext.Join(new Array(FrmUserRegistration)).object());
		Ext.EQuery.postContent();
}

// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
window.EventClear = function(){
	Ext.Serialize('FrmUserRegistration').Clear();
	window.EventSearch();
}


// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
 
 window.EventEnable = function()
 {
	var UserId = Ext.Cmp('ID').getValue();
	if( UserId !='') {
		Ext.Ajax({
			url 	: Ext.DOM.INDEX+'/SysUser/enable_user',
			method 	: 'POST',
			param 	: { UserId : UserId },
			ERROR	: function(e) {
				var ERROR = JSON.parse(e.target.responseText);
				if( ERROR.success ) {
					alert('Success, Enable User');
					Ext.EQuery.postContent();
				}
				else{
					alert('Failed, Enable User');
				}
			}	
		}).post();
	}	
	else{
		alert('Please select rows..!'); return false;
	}
}
// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */

window.EventDetail =function(){
	Ext.ShowMenu(new Array("SysUser","UserDetail"), "User Detail", {
		UserId : Ext.Cmp('ID').getValue(),
		Controller : Role.ctrl()
	});
}

// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
window.EventResetIP = function()
 {
	var UserId = Ext.Cmp('ID').getValue();
	if( UserId !='')
	{
	  if( confirm('Do you want to reset user login ?') ) 
	  {		
		Ext.Ajax({
			url 	: Ext.DOM.INDEX+'/SysUser/reset_ip',
			method 	: 'POST',
			param 	: { UserId : UserId },
			ERROR	: function(e) 
			{
				var ERROR = JSON.parse(e.target.responseText);
				if( ERROR.success ) {
					alert('Success, Reset User Login ');
					window.EventSearch();
				}
				else{
					alert('Failed, Reset Password User ');
				}
			}
			
		}).post();
	   }	
	}
	else{
		alert('Please select rows..!'); return false;
	}
}
// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
window.EventRegisterPBX = function()
{
	var UserId = Ext.Cmp('ID').getValue();
	
	if( UserId !='')
	{
		if( confirm('Do you want to User Register In PBX ?')  ) 
		{	
			Ext.Cmp('load_images_id').setText("<span style='color:red;'><img src='"+Ext.DOM.LIBRARY+"/gambar/loading.gif' height='15'> Please wait...</span>");
			Ext.Ajax({
				url 	: Ext.DOM.INDEX+'/SysUser/register_pbx',
				method 	: 'POST',
				param 	: { UserId : UserId },
				ERROR	: function(e) 
				{
					var ERROR = JSON.parse(e.target.responseText);
					if( ERROR.success ) {
						Ext.Cmp('load_images_id').setText('');
					
						var _error_html = ''
						for( var i in ERROR.error ){
							_error_html += ERROR.error[i].username+" ,__"+ERROR.error[i].status +" \n";
						}
						alert(_error_html);
					}
					else{
						alert('Failed, Reset Password User ');
					}
				}
				
			}).post();
		}	
	}
	 else{
		alert('Please select rows..!'); return false;
    }
}
// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
 window.EventResetPwd = function()
 {
	var UserId = Ext.Cmp('ID').getValue();
	if( UserId !='')
	{
	  if( confirm('Do you want to reset user password to ( 1234 ) ?') ) 
	  {		
		Ext.Ajax({
			url 	: Ext.DOM.INDEX+'/SysUser/reset_password',
			method 	: 'POST',
			param 	: { UserId : UserId },
			ERROR	: function(e) 
			{
				var ERROR = JSON.parse(e.target.responseText);
				if( ERROR.success ) {
					alert('Success, Reset Password User ');
					window.searchAgent();
				}
				else{
					alert('Failed, Reset Password User ');
				}
			}
			
		}).post();
	   }	
	}
	else{
		alert('Please select rows..!'); return false;
	}
}	
// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 window.EventDisable=function()
 {
	var UserId = Ext.Cmp('ID').getValue();
	if( UserId !='')
	{
		Ext.Ajax({
			url 	: Ext.DOM.INDEX+'/SysUser/disable_user',
			method 	: 'POST',
			param 	: { UserId : UserId },
			ERROR	: function(e) {
				var ERROR = JSON.parse(e.target.responseText);
				if( ERROR.success ) {
					alert('Success, Disable User');
					window.EventSearch();
				}
				else{
					alert('Failed, Disable User');
				}
			}	
		}).post();
	}	
	else{
		alert('Please select rows..!'); return false;
	}
}
	
// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 window.EventDelete = function() 
 {
	var UserId = Ext.Cmp('ID').getValue();
	if( UserId !='')
	{
	  if( confirm('Do you want to remove this user ?') ) 
	  {	
		Ext.Ajax({
			url 	: Ext.DOM.INDEX+'/SysUser/remove_user',
			method 	: 'POST',
			param 	: { UserId : UserId },
			ERROR	: function(e) {
				var ERROR = JSON.parse(e.target.responseText);
				try{
					if( ERROR.success ) {
						alert('Success, Remove User');
						window.EventSearch();
					}
					else{
						alert('Failed, Remove User, \nERROR : '+ ERROR.error );
					}
				}
				catch(e){
					alert(e);
				}
			}	
		}).post();
	  }	
	}	
	else{
		alert('Please select rows..!'); return false;
	}
}

// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
 Ext.DOM.UserCapacity = function() {
	return Ext.Ajax ({  url : Ext.EventUrl(['SysUser','UserCapacity']).Apply(),  method  : 'POST', param   : {
			act : Ext.Date().getDuration()
		}
	}).json();
 }
 
// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
 window.EventAdd = function() 
{
  var UserCapacity = Ext.DOM.UserCapacity();
  if( !UserCapacity ){
	Ext.Msg("Over load User Capacity!").Info();
	return false;
  }
	
	Ext.ShowMenu(new Array('SysUser','tpl_add_user'), 
	Ext.System.view_file_name(),{
		time : 	Ext.Date().getDuration()
	});
}

// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
 
 window.EventEdit = function()  
{
  var UserId = Ext.Cmp('ID').getValue();
  if(UserId.length == 1 )  
  {
		Ext.ShowMenu(new Array('SysUser','tpl_edit_user'), 
		Ext.System.view_file_name(),{
			time 	: Ext.Date().getDuration(),
			UserId  : UserId, 
		});
  } else {
	Ext.Msg('Please select a rows !').Info();
	return false;
  }
}



// $(document).ready( function(){
	// $('#toolbars').extToolbars
	// ({
		// extUrl  : Ext.DOM.LIBRARY+'/gambar/icon',
		// extTitle:[['Search'],['Clear'],['Enable'],['Disable'],['Add'],['Remove'],['Edit'],['Reset Password'],['Reset IP'],['PBX Register']],
		// extMenu :[['searchAgent'],['Clear'],['enabledUser'],['disabledUser'],['addUser'],['removeUser'],['changeGroup'],['resetPassword'],['resetIP'],['extRegiter']],
		// extIcon :[['zoom.png'],['zoom_out.png'],['accept.png'],['cancel.png'],['add.png'],['cross.png'],['group_edit.png'],['page_key.png'],['connect.png'],['phone_add.png']],
		// extText :true,
		// extInput:true,
		// extOption:[]
	// });
	
	// $('.select').chosen();
// });
	
</script>
	
<!-- start : content -->
<fieldset class="corner">
<?php echo form()->legend(lang(""), "fa-users"); ?>
 <div id="result_content_add" class="ui-widget-panel-form"> 
	<form name="FrmUserRegistration">
	<div class="ui-widget-table-compact">
		
		<div class="ui-widget-form-row">
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('User ID'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->input("user_id", "input_text long", _get_exist_session('user_id') );?></div>
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Privileges'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo("user_privileges", "select superlong", _setCapital(UserSessionPrivilege()), _get_exist_session('user_privileges') );?></div>
			
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('IP Address'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->input("user_address", "input_text superlong",_get_exist_session('user_address') );?></div>
		
		
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('User Name'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->input("user_name", "input_text long", _get_exist_session('user_name') );?></div>
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('User Active'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo("user_active", "select superlong", Flags(), _get_exist_session('user_active') );?></div>
		
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Login Status'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo("user_login", "select superlong", Flags(), _get_exist_session('user_login') );?></div>
		
		</div>
		
	</div>
	</form>
 </div>
 
<div class="ui-widget-toolbars" id="toolbars"></div>
<div class="ui-widget-panel-content" id="#panel-content"></div>
<div class="content_table" id="ui-widget-content_table"></div>
<div class="ui-widget-pager" id="pager"></div>
<div class="ui-widget-component" id="ui-widget-component"></div>
</fieldset>	
<!--
	<fieldset class="corner" style="background-color:white;">
	<legend class="icon-userapplication">&nbsp;&nbsp;<span id="legend_title"></span></legend>
		<div id="toolbars" class="toolbars"></div>
		<div id="panel-content" style="margin:4px;"></div>
		<div class="content_table"></div>
		<div id="pager"></div>
		<div id="UserTpl"></div>
	</fieldset>	
	-->
<!-- END OF FILE  -->
<!-- location : // ../application/layout/view_user_nav/welcome.php -->
	
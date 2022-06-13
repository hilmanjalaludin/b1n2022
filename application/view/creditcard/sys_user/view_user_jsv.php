<script>
/*
 * [Recovery data failed upload AJMI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
Ext.DOM.RoleBack = function() {
	if( Ext.Msg('Are you sure ?').Confirm() )
	{
		var is_home = Ext.Cmp('is_home').getValue();
		if( is_home == 1 ){
			new Ext.BackHome();
		} else {
			new Ext.ShowMenu("SysUser", Ext.System.view_file_name());	
		}
	}
}


/*
 * [Recovery data failed upload AJMI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
 Ext.DOM.UserCapacity = function() {
	return Ext.Ajax ({  url : Ext.EventUrl(['SysUser','UserCapacity']).Apply(),  method  : 'POST', param   : {
			act : Ext.Date().getDuration()
		}
	}).json();
 }
 
/*
 * [Recovery data failed upload AJMI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
 Ext.DOM.addUser = function() 
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

/*
 * [Recovery data failed upload AJMI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
 
window.EventUserPrivilege = function( field ){
	
	// get on edit event 
	var row = window.EventUserDetail( Ext.Cmp('where_id').getValue() );
	// userid
	// console.log( row );
	
	//console.log( field.value );
	
	
	var userLevel = field.value, config = window.LEVEL, 
		rowObject = {
		disabled  : [],
		enabled   : ['account_manager', 'user_mgr', 'team_leader', 'user_spv', 'user_admin'],
		valuedata : {
			'account_manager' 	: 0, 
			'user_mgr' 			: 0, 
			'team_leader'		: 0, 
			'user_spv'			: 0, 
			'user_admin'		: 0 }
	}	
 
// jika user tidak memilih user level field.		
	var emptyVal = ['account_manager', 'user_mgr', 'team_leader', 'user_spv', 'user_admin'];
	if( userLevel == '' ){
		$( emptyVal ).each( function(i, field ){
			Ext.Cmp(field).disabled(1);
			Ext.Cmp(field).setValue(0); 
		});
		return false;
	}	
	
	// @ User LEVEL config.USER_ROOT  
	if( userLevel == config.USER_ADMIN  ){
		console.log(window.sprintf("%s == %s", userLevel, config.USER_ADMIN  ) )
		rowObject = {
			disabled : ['account_manager', 'user_mgr', 'team_leader', 'user_spv','user_admin'],
			enabled  : []
		}
		
	// get handle by detail ]
		if( row.success == 1 ){
			rowObject.valuedata = {
				'user_admin'		: row.data.admin_id,
				'account_manager' 	: 0,
				'user_mgr' 			: 0,
				'team_leader'		: 0,
				'user_spv'			: 0
			}
		}
	}
	
	// @ User LEVEL config.USER_ROOT  
	if( userLevel == config.USER_ROOT  ){
		console.log(window.sprintf("%s == %s", userLevel, config.USER_ROOT  ) )
		rowObject = {
			disabled : ['account_manager', 'user_mgr', 'team_leader', 'user_spv','user_admin'],
			enabled  : []
		}
		// get handle by detail ]
		if( row.success == 1 ){
			rowObject.valuedata = {
				'account_manager' 	: 0,
				'user_mgr' 			: 0,
				'team_leader'		: 0,
				'user_spv'			: 0,
				'user_admin'		: 0
			}
		}
	}
	
	// @ User LEVEL config.USER_GENERAL_MANAGER  
	if( userLevel == config.USER_GENERAL_MANAGER  ){
		console.log(window.sprintf("%s == %s", userLevel, config.USER_GENERAL_MANAGER  ) )
		rowObject = {
			disabled : ['account_manager', 'user_mgr', 'team_leader', 'user_spv'],
			enabled  : ['user_admin']
		}
		
		// get handle by detail ]
		if( row.success == 1 ){
			rowObject.valuedata = {
				'account_manager' 	: row.data.act_mgr, 
				'user_admin'		: row.data.admin_id,
				'user_mgr' 			: 0, 
				'team_leader'		: 0, 
				'user_spv'			: 0
			}
		}
	}
	
	// @ User LEVEL config.USER_ACCOUNT_MANAGER 
	if( userLevel == config.USER_ACCOUNT_MANAGER ){
		console.log(window.sprintf("%s == %s", userLevel, config.USER_ACCOUNT_MANAGER  ) )
		
		rowObject = {
			disabled : ['user_mgr', 'team_leader', 'user_spv'],
			enabled  : ['user_admin', 'account_manager']
		}
		
		// get handle by detail ]
		if( row.success == 1 ){
			rowObject.valuedata = {
				'account_manager' 	: row.data.act_mgr, 
				'user_mgr' 			: row.data.mgr_id, 
				'user_admin'		: row.data.admin_id,
				'team_leader'		: 0, 
				'user_spv'			: 0
			}
		}
	}
	
	// @ User LEVEL config.USER_SUPERVISOR 
	if( userLevel == config.USER_SUPERVISOR ){
		console.log(window.sprintf("%s == %s", userLevel, config.USER_SUPERVISOR  ) )
		rowObject = {
			disabled : ['team_leader', 'user_spv'],
			enabled  : ['user_admin', 'account_manager', 'user_mgr']
		}
		
		// get handle by detail ]
		if( row.success == 1 ){
			rowObject.valuedata = {
				'account_manager' 	: row.data.act_mgr, 
				'user_mgr' 			: row.data.mgr_id, 
				'user_spv'			: row.data.spv_id, 
				'user_admin'		: row.data.admin_id,
				'team_leader'		: 0,
				
			}
		}
	}
	
	// @ User LEVEL config.USER_LEADER 
	if( userLevel == config.USER_LEADER ){
		console.log(window.sprintf("%s == %s", userLevel, config.USER_LEADER  ) )
		rowObject = {
			disabled : ['team_leader'],
			enabled  : ['user_admin', 'account_manager', 'user_mgr']
		}
		
		// get handle by detail ]
		if( row.success == 1 ){
			rowObject.valuedata = {
				'account_manager' 	: row.data.act_mgr, 
				'user_mgr' 			: row.data.mgr_id, 
				'team_leader'		: row.data.tl_id, 
				'user_spv'			: row.data.spv_id, 
				'user_admin'		: row.data.admin_id
			}
		}
	}
	
	
	// @ User LEVEL config.USER_AGENT_OUTBOUND 
	if( userLevel == config.USER_AGENT_OUTBOUND ){
		console.log(window.sprintf("%s == %s", userLevel, config.USER_AGENT_OUTBOUND  ) )
		
		rowObject = {
			disabled : [],
			enabled  : ['user_admin', 'account_manager', 'user_mgr', 'user_spv','team_leader']
		}
		
		// get handle by detail ]
		if( row.success == 1 ){
			rowObject.valuedata = {
				'account_manager' 	: row.data.act_mgr, 
				'user_mgr' 			: row.data.mgr_id, 
				'team_leader'		: row.data.tl_id, 
				'user_spv'			: row.data.spv_id, 
				'user_admin'		: row.data.admin_id
				
			}
		}
	}
	
	// @ User LEVEL config.USER_ADMIN_FOLLOWUP 
	if( userLevel == config.USER_ADMIN_FOLLOWUP ){
		console.log(window.sprintf("%s == %s", userLevel, config.USER_ADMIN_FOLLOWUP  ) )
		rowObject = {
			disabled : ['team_leader'],
			enabled  : ['user_admin', 'account_manager', 'user_mgr', 'user_spv']
		}
		
		// get handle by detail ]
		if( row.success == 1 ){
			rowObject.valuedata = {
				'account_manager' 	: 0, 
				'user_mgr' 			: 0, 
				'team_leader'		: 0, 
				'user_spv'			: 0, 
				'user_admin'		: 0
			}
		}
	}
	// test data process set value after get 'Json'
	$( rowObject.valuedata ).each( function(i, row ){
			for( var field in row ){
				// console.log( row[field] )
				Ext.Cmp(field).setValue( row[field]);
			}
		});
	// disabled attribute 	
		$( rowObject.disabled ).each( function(i, field ){
			Ext.Cmp(field).disabled(true);
		});
	
	// attribute enabled
		$( rowObject.enabled ).each( function(i, field ){
			Ext.Cmp(field).disabled(false);
		});
		
	//}
}	

/*
 * [Recovery data failed upload AJMI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
 
 
 // ambil data MGR dan LAIN LAIN OK 
window.EventUserSupervisor = function( data ){
var UserId = data.value;	
	var dataURL = Ext.EventUrl( new Array('SysUser', 'DetailUser') ).Apply() 
		var dataJson = Ext.Json(dataURL, {
			UserId : UserId	
			
		});
// @mabil data json jika ada .	
	dataJson.dataItemEach( function(  item ){
	// jika success data berhasil dan berisi array 	
	
	if( !item.success ){ // jika bernilai salah  = 0  
		Ext.Cmp('user_admin').setValue( 0);
		Ext.Cmp('account_manager').setValue( 0 );
		Ext.Cmp('user_mgr').setValue( 0);
	}
	
	// jika berhasil benar 
	if( item.success ){
			var row = ( typeof( item.data) == 'object' ?
							item.data  : { } );
			/*  : field 
				user_mgr
				account_manager
				user_admin
			*/
			Ext.Cmp('user_admin').setValue( row.admin_id);
			Ext.Cmp('account_manager').setValue( row.act_mgr );
			Ext.Cmp('user_mgr').setValue( row.mgr_id );
		}
		//console.log( row );
		
	});
	//window.alert(data.value);
	
}
/*
 * [Recovery data failed upload AJMI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
 
window.EventUserAccountManager = function( data ){
var UserId = data.value;	
	var dataURL = Ext.EventUrl( new Array('SysUser', 'DetailUser') ).Apply() 
		var dataJson = Ext.Json(dataURL, {
			UserId : UserId	
			
		});
// @mabil data json jika ada .	
	dataJson.dataItemEach( function(  item ){
	// jika success data berhasil dan berisi array 	
	
	if( !item.success ){ // jika bernilai salah  = 0  
		Ext.Cmp('user_admin').setValue( 0);
		Ext.Cmp('account_manager').setValue( 0 );
		Ext.Cmp('user_mgr').setValue( 0);
	}
	
	// jika berhasil benar 
	if( item.success ){
		 console.log( item.data );
			var row = ( typeof( item.data) == 'object' ?
							item.data  : { } );
			/*  : field 
				user_mgr
				account_manager
				user_admin
			*/
			Ext.Cmp('user_admin').setValue( row.admin_id);
			Ext.Cmp('account_manager').setValue( row.act_mgr );
			 
		}
		//console.log( row );
		
	});
	//window.alert(data.value);
	
}

/*
 * [Recovery data failed upload AJMI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
 
window.EventUserGeneralManager = function( data ){
var UserId = data.value;	
	var dataURL = Ext.EventUrl( new Array('SysUser', 'DetailUser') ).Apply() 
		var dataJson = Ext.Json(dataURL, {
			UserId : UserId	
			
		});
// @mabil data json jika ada .	
	dataJson.dataItemEach( function(  item ){
	// jika success data berhasil dan berisi array 	
	
	if( !item.success ){ // jika bernilai salah  = 0  
		Ext.Cmp('user_admin').setValue( 0);
		Ext.Cmp('account_manager').setValue( 0 );
		Ext.Cmp('user_mgr').setValue( 0);
	}
	
	// jika berhasil benar 
	if( item.success ){
			var row = ( typeof( item.data) == 'object' ?
							item.data  : { } );
			/*  : field 
				user_mgr
				account_manager
				user_admin
			*/
			Ext.Cmp('user_admin').setValue( row.admin_id);
		}
		//console.log( row );
		
	});
	//window.alert(data.value);
	
}

/*
 * [Recovery data failed upload AJMI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
 
 window.EventUserDetail = function( UserId ){
	var dataURL = Ext.EventUrl( new Array('SysUser', 'DetailUser') ).Apply(),
		dataJson = Ext.Json(dataURL, {
			UserId : UserId	
		});
	var dataJsonRow = dataJson.dataItem();	
	if( typeof( dataJsonRow ) == 'object' ){
		return dataJsonRow;
	}
	return { 'success' : 0 };
 }

// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
 Ext.DOM.Update = function()
{
	
 var frmEditUser = Ext.Serialize('frmEditUser'),
     frmAddCond = frmEditUser.Required( new Array (
		'userid','fullname',
		'textAgentcode','password', 
		'repassword','profile',
		'user_active'
	));
 
 if( !frmAddCond )
 { 
	Ext.Msg('form input not complete!').Info();
	return false; }	 
 
  if( Ext.Cmp('password').getValue() != Ext.Cmp('repassword').getValue() )
 {
	Ext.Msg('check your password!').Info();
	return false; }


// ------------- save data user ----------------------------------------------
	
    Ext.Ajax
   ({
	   url 	 	: Ext.EventUrl(['SysUser','update_user']).Apply(),
	   method 	: 'POST',
	   param  	: Ext.Join(new Array(
					frmEditUser.getElement() 
				 )).object(),
				 
	   ERROR	: function (e) 
	   {
		  Ext.Util(e).proc(function( response )
		  {
			  if( response.success ) {
				  Ext.Msg("Update User").Success();
				  Ext.ShowMenu(new Array('SysUser','tpl_edit_user'), 
				  Ext.System.view_file_name(),{
					UserId  : Ext.Cmp('where_id').getValue(), 
				  });
			  } 
			  else {
				Ext.Msg("Update User").Failed();
				return false;
			  }
		  });
	  } 	
   }).post(); 
   
 }
 

// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
 Ext.DOM.SaveUser = function()
{
	
 var frmAddUser = Ext.Serialize('frmAddUser'),
     frmAddCond = frmAddUser.Required( new Array (
		'userid','fullname','textAgentcode',
		'password', 'repassword','profile',
		'user_telphone','user_active',
		'cc_group'
	 ));
 
 if( !frmAddCond )
 { 
	Ext.Msg('form input not complete!').Info();
	return false; }	 
 
  if( Ext.Cmp('password').getValue() != Ext.Cmp('repassword').getValue() )
 {
	Ext.Msg('check your password!').Info();
	return false; }


// ------------- save data user ----------------------------------------------
	
    Ext.Ajax
   ({
	   url 	 	: Ext.EventUrl(['SysUser','add_user']).Apply(),
	   method 	: 'POST',
	   param  	: Ext.Join(new Array(
					frmAddUser.getElement() 
				 )).object(),
				 
	   ERROR	: function (e) 
	   {
		  Ext.Util(e).proc(function( response )
		  {
			  if( response.success )
			  {
				  Ext.Msg("Add User").Success();
				  if( Ext.Msg('Do you want to add again ?').Confirm()  ){
					  new Ext.DOM.addUser();
				  }
			  } 
			  else {
				Ext.Msg("Add User").Failed();
				return false;
			  }
		  });
	  } 	
   }).post(); 
	
} 

// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
 Ext.DOM.UpdatePassword =function() 
{
  var frmChangePassword = Ext.Serialize('frmChangePassword');
  
  if( frmChangePassword.Required(['new_password','renew_password']) )	
  {
		if( Ext.Cmp('new_password').getValue().length <4 ){
		  Ext.Msg("Minimum password 4 ( four ) character").Info();
		  return false;
		}
	  
		if( Ext.Cmp('renew_password').getValue().length <4 ){
		  Ext.Msg("Minimum password 4 ( four ) character").Info();
		  return false;
		}
		
	   if( Ext.Cmp('new_password').getValue() ==  Ext.Cmp('renew_password').getValue()  )
	  {
		  if( Ext.Msg('Are you sure to change Password?').Confirm() ) 
		  {
			  Ext.Ajax
			 ({
				   url 	 	: Ext.EventUrl(['SysUser','ChangePassword']).Apply(),
				   method 	: 'POST',
				   param  	: Ext.Join([ frmChangePassword.getElement() ]).object(),
				   ERROR	: function (e) 
				   {
					  Ext.Util(e).proc(function( response )
					  {
						  if( response.success )
						  {
							  Ext.Msg("Change Password").Success();
							  if( Ext.Msg('Do you want to close from this session?').Confirm()  ){
								 Ext.BackHome();
							  }
						  } 
						  else {
							Ext.Msg("Change Password").Failed();
							return false;
						  }
					  });
				  } 	
			   }).post();   
		  }
		  return false;
	  }
	   else {
			Ext.Msg('Wrong password!').Info();
			return false;
	  }	  
  } else {
	  Ext.Msg('Input form not complete!').Info();
	  return false;
  }
}

// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
$(document).ready( function()
{
  $('#ui-widget-add-campaign').mytab().tabs();
  $('#ui-widget-add-campaign').mytab().tabs("option", "selected", 0);
  $('#ui-widget-add-campaign').css({'background-color':'#FFFFFF'});
  $('#ui-widget-add-content').css({'background-color':'#FFFFFF'});
  $("#ui-widget-add-campaign").mytab().close(function(){
	  Ext.DOM.RoleBack();
  });
  
 //-------- disabled by select class --------------------
  $('.cell-disabled').each(function(){
	  $(this).attr('disabled','true');
  });
  $('.select').chosen();
});
</script>
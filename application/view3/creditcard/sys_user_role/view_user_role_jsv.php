
<script>


// ------------- on role get message its  ----------------------------------

/*
 * @ pack : get all labels -  array header 
 */
 
 window.EventSave = function()  
{
	
 var frmAddRoleUser = Ext.Serialize('frmAddRoleUser');
 if(!frmAddRoleUser.Complete() ) {
	Ext.Msg("Input Not Complete").Info();
	return false;
 }

  Ext.Ajax
 ({
	url    : Role.action("Save"),
	method : "POST",
	param  : Ext.Join([ frmAddRoleUser.getElement()]).object(),
	ERROR  : function( e ) {
		Ext.Util(e).proc(function( response ){
			if( response.success )
			{
				Ext.Msg("Save User Role").Success();
				if( Ext.Msg("Do you want to add again?").Confirm() )  {
					
					Ext.ShowMenu( Role.Url("Add"), 
					Ext.System.view_file_name(), {
						ControllerId : Role.ctrl()
					});
					
				} else {
					Ext.ShowMenu( Role.Url("Edit"), 
					Ext.System.view_file_name(), {
						UserRoleId : response.RoleId,
						ControllerId : Role.ctrl()
					});
				}
				
			} else {
				Ext.Msg("Save User Role").Failed();
				return false;
			}
		});
	}
 }).post();
	
}
// ------------- on role get message its  ----------------------------------

/*
 * @ pack : get all labels -  array header 
 */
 
 window.EventSetRoleMenu  = function ( obj )
{
	var UserAction = "Delete";
	if( obj.obj_id.checked ){
		UserAction = "Add";	
	} 
	var UserRoleId = Ext.Cmp("UserRoleGroup").getValue();
	if( UserRoleId == '' ){ 
		Ext.Msg('User Role Group Is empty!').Info();
		return false;
	}
	
	Ext.Ajax
	({
		url 	: Ext.EventUrl(Role.Url('AddRoleMenu')).Apply(),
		method  : 'POST',
		param   : {
			UserRoleId  : UserRoleId,
			UserMenuId  : obj.mnu_id,
			UserAction  : UserAction		
		},
		
		ERROR 	: function( e ){	
			Ext.Util(e).proc(function( data ){
				if( data.success ){
					window.PageToolbar({ orderby : '',  type: '', page: 0 });
					window.PageFormbar({ orderby : '',  type: '', page: 0 });
				} 
			});
		}
	}).post();	
} 

// ----------------------------------------------------------------------------------------------

/*
 * @ pack : get all labels -  array header 
 */

 window.DelMenuToolbarOnUserRole = function( obj )
{
	var UserRoleId = Ext.Cmp("UserRoleGroup").getValue();
	Ext.Ajax
	({
		url 	: Ext.EventUrl(new Array('SysUserRole', 'DelToolbarOnRole') ).Apply(),
		method  : 'POST',
		param   : {
			UserRoleId  : UserRoleId,
			UserMenuId  : obj.mnu_id,
			UserActId   : obj.act_id		
		},
		
		ERROR 	: function( e ){	
			Ext.Util(e).proc(function( data ){
				if( data.success ){
					console.log("Del Role Menu Sucess");
				} else {
					console.log("Del Role Menu Failed");
				}	
			});
		}
	}).post();	 
 }
 

 
// ----------------------------------------------------------------------------------------------

/*
 * @ pack : get all labels -  array header 
 */

 window.AddMenuToolbarOnUserRole = function( obj )
{
	var UserRoleId = Ext.Cmp("UserRoleGroup").getValue();
	Ext.Ajax
	({
		url 	: Ext.EventUrl(Role.Url('AddToolbarOnRole')).Apply(),
		method  : 'POST',
		param   : {
			UserRoleId  : UserRoleId,
			UserMenuId  : obj.mnu_id,
			UserActId   : obj.act_id		
		},
		
		ERROR 	: function( e ){	
			Ext.Util(e).proc(function( data ){
				if( data.success ){
					console.log("Add Role Menu Sucess");
				} else {
					console.log("Add Role Menu Failed");
				}	
			});
		}
	}).post();	 
 }
 

 
// ----------------------------------------------------------------------------------------------

/*
 * @ pack : get all labels -  array header 
 */

window.SetUserToobarMenu = function( obj ) {
	if( obj.obj_id.checked ){
		window.AddMenuToolbarOnUserRole( obj );
	} else {
		window.DelMenuToolbarOnUserRole( obj );
	}
}

// ----------------------------------------------------------------------------------------------

/*
 * @ pack : get all labels -  array header 
 */

 window.DelMenuFormbarOnUserRole = function( obj )
{
	var UserRoleId = Ext.Cmp("UserRoleGroup").getValue();
	Ext.Ajax
	({
		url 	: Ext.EventUrl(Role.Url('DelFormbarOnRole')).Apply(),
		method  : 'POST',
		param   : {
			UserRoleId  : UserRoleId,
			UserMenuId  : obj.mnu_id,
			UserActId   : obj.act_id		
		},
		
		ERROR 	: function( e ){	
			Ext.Util(e).proc(function( data ){
				if( data.success ){
					console.log("Del Role Menu Sucess");
				} else {
					console.log("Del Role Menu Failed");
				}	
			});
		}
	}).post();	 
} 
// ----------------------------------------------------------------------------------------------
/*
 * @ pack : get all labels -  array header 
 */

window.AddMenuFormbarOnUserRole = function( obj )
{
	var UserRoleId = Ext.Cmp("UserRoleGroup").getValue();
	Ext.Ajax
	({
		url 	: Ext.EventUrl(Role.Url('AddFormbarOnRole')).Apply(),
		method  : 'POST',
		param   : {
			UserRoleId  : UserRoleId,
			UserMenuId  : obj.mnu_id,
			UserActId   : obj.act_id		
		},
		ERROR 	: function( e ){	
			Ext.Util(e).proc(function( data ){
				if( data.success ){
					console.log("Add Role Menu Sucess");
				} else {
					console.log("Add Role Menu Failed");
				}	
			});
		}
	}).post();	 
} 


// ----------------------------------------------------------------------------------------------

/*
 * @ pack : get all labels -  array header 
 */

window.SetUserFormbars =function( obj ){
	if( obj.obj_id.checked ){
		window.AddMenuFormbarOnUserRole( obj );
	} else {
		window.DelMenuFormbarOnUserRole( obj );
	}
}

// ----------------------------------------------------------------------------------------------

/*
 * @ pack : get all labels -  array header 
 */

 window.PageFormbar = function( obj )
{
	if( !Ext.Cmp('ui-widget-role-formbar').IsNull() )
	{
		var UserRoleGroup = Ext.Cmp("UserRoleGroup").getValue();
		var GroupName = Ext.Cmp("user_on_bottom_menu_group").getValue();
		var MenuName  = Ext.Cmp("user_on_bottom_menu_name").getValue();
		var Detail = Ext.Cmp('UserRoleDetail').getValue();
		
		$('#ui-widget-role-formbar').Spiner 
		({
			url 	: Role.Url('PageFormbar'),
			param 	: { 
				UserRoleGroup : UserRoleGroup, 
				GroupName : GroupName, 
				MenuName : MenuName,
				Detail : Detail
			}, 
			
			order   : {
				order_type : obj.type,
				order_by   : obj.orderby,
				order_page : obj.page	
			}, 
			complete : function( obj ){
				//console.log(obj);
			}
		});		
	}
} 



// ----------------------------------------------------------------------------------------------

/*
 * @ pack : get all labels -  array header 
 */

 window.PageToolbar = function ( obj )
{
	if( !Ext.Cmp('ui-widget-role-toobar').IsNull() )
	{
	 
		var UserRoleGroup = Ext.Cmp("UserRoleGroup").getValue();
		var GroupName = Ext.Cmp("user_on_role_menu_group").getValue();
		var MenuName  = Ext.Cmp("user_on_role_menu_name").getValue();
		var Detail = Ext.Cmp('UserRoleDetail').getValue();
		
		$('#ui-widget-role-toobar').Spiner 
		({
			url 	: Role.Url('PageToolbar'),
			param 	: { 
				UserRoleGroup : UserRoleGroup, 
				GroupName : GroupName, 
				MenuName : MenuName,
				Detail : Detail
			}, 
			order   : {
				order_type : obj.type,
				order_by   : obj.orderby,
				order_page : obj.page	
			}, 
			complete : function( obj ){
				//console.log(obj);
			}
		});	
	}	
} 

// ----------------------------------------------------------------------------------------------

/*
 * @ pack : get all labels -  array header 
 */

 window.PageMenuSystem = function( obj )
{
	if( !Ext.Cmp('ui-widget-role-menu-system').IsNull() )
	{
		var UserRoleGroup = Ext.Cmp("UserRoleGroup").getValue();
		var GroupName = Ext.Cmp("user_role_menu_group").getValue();
		var MenuName  = Ext.Cmp("user_role_menu_name").getValue();
		var Detail = Ext.Cmp('UserRoleDetail').getValue();
		
		$('#ui-widget-role-menu-system').Spiner 
		({
			url 	: Role.Url('PageMenuSystem'),
			param 	: { 
				UserRoleGroup : UserRoleGroup, 
				GroupName : GroupName, 
				MenuName : MenuName,
				Detail : Detail
			}, 
			order   : {
				order_type : obj.type,
				order_by   : obj.orderby,
				order_page : obj.page	
			}, 
			complete : function( obj ){
				//console.log(obj);
			}
		});		
	}
}

// ------------- on role get message its  ----------------------------------
/*
 * @ pack : get all labels -  array header 
 */
window.FindPageMenuSystem = function(){
	window.PageMenuSystem({orderby : '',  type: '', page: 0});
}

// ------------- on role get message its  ----------------------------------
/*
 * @ pack : get all labels -  array header 
 */
 
window.FindPageToolbar = function(){
	window.PageToolbar({ orderby : '',  type: '', page: 0 }); 
}


// ------------- on role get message its  ----------------------------------
/*
 * @ pack : get all labels -  array header 
 */
 
window.FindPageFormbar = function(){
	window.PageFormbar({ orderby : '',  type: '', page: 0 }); 
}


// ----------------------------------------------------------------------------------------------

/*
 * @ pack : get all labels -  array header 
 */
 
 window.UserLayout = function()
{
  $('#ui-widget-wiki-tabs').css({ "background-color" : "#FBFEFF", "padding-bottom" : "15px" });
  $('.ui-widget-wiki-content').css({"background-color" : "#FBFEFF"});
  $(".ui-widget-fieldset").css({"border-radius":"3px","margin": "12px 5px 5px 5px", "padding" : "5px 5px 15px 5px"});
  $('.date').datepicker ({ showOn: 'button', buttonImage: Ext.Image('calendar.gif'),  buttonImageOnly: true, dateFormat:'dd-mm-yy', readonly:true });
  $('.ui-filter-status').chosen();		
  $('.ui-filter-order').chosen();
  $('.select').chosen();
  $('.readonly').attr('readonly', true);
  $('.readonly').attr('disabled', true);
  $('.readonly').css('color', '#DDDDDD');
}

// ----------------------------------------------------------------------------------------------

/*
 * @ pack : get all labels -  array header 
 */
 
 
$(window).bind("resize", function(){ 
	window.UserLayout();
 });

 
// ------------- on role get message its  ----------------------------------

/*
 * @ pack : get all labels -  array header 
 */
 
 window.EventUpdate = function()
 {
	var frmEditRoleUser = Ext.Serialize('frmEditRoleUser');

	if(!frmEditRoleUser.Complete() ) {
		Ext.Msg("Input Not Complete").Info();
		return false;
	}
	
	Ext.Ajax
	({
		url    : Role.action("Update"),
		method : "POST",
		param  : Ext.Join([ frmEditRoleUser.getElement()]).object(),
		ERROR  : function( e ) {
			Ext.Util(e).proc(function( response ){
				if( response.success ){
					Ext.Msg("Update User Role").Success();
				} else {
					Ext.Msg("Update User Role").Failed();
					return false;
				}
			});
		}
	}).post();
 }	 
 
 
		
// ----------------------------------------------------------------------------------------------

/*
 * @ pack : get all labels -  array header 
 */
 
 $(document).ready(function() 
{
   $("#ui-widget-wiki-tabs").mytab().tabs();
   $("#ui-widget-wiki-tabs").mytab().tabs("option", "selected", 0);
   $("#ui-widget-wiki-tabs").mytab().close(function(e) {
		if( Ext.Msg('Are you sure?').Confirm() ) {  
			Role.roleback();  
		} 
	}, true);
	
	window.UserLayout();
	
// ------------------------------------------------------ 
	
	window.PageMenuSystem({ orderby : '',  type: '', page: 0 });
	window.PageToolbar({ orderby : '',  type: '', page: 0 });
	window.PageFormbar({ orderby : '',  type: '', page: 0 });
	
 });
</script>
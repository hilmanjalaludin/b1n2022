<script>
// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
Ext.DOM.RoleBack = function()
{
	if( Ext.Msg('Are you sure ?').Confirm() )
	{
		var is_home = Ext.Cmp('is_home').getValue();
		if( is_home == 1 ){
			new Ext.BackHome();
		} else {
			new Ext.ShowMenu("SysMenu", Ext.System.view_file_name());	
		}
	}
}


// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
 function EventUpdate()
{
  //var menu_toolbar = Ext.Cmp('').getChecked();
  var frmEditMenu = Ext.Serialize('frmEditMenu');
	  frmEditCond = frmEditMenu.Required
	  ([ 
			'menu_controller',
			'menu_group',
			'menu_id',
			'menu_name', 
			'menu_order',
			'menu_status'
	  ]);
	  
 if( !frmEditCond ) {  
	Ext.Msg('form input not complete!').Info();
	return false;
 }
 
 Ext.Ajax
	({
	   url 	 	: Ext.EventUrl(new Array('SysMenu','update_menu')).Apply(),
	   method 	: 'POST',
	   param  	: Ext.Join(new Array(
					frmEditMenu.getElement() 
				 )).object(),
				 
	   ERROR	: function (e) 
	   {
		  Ext.Util(e).proc(function( response )
		  {
			  if( response.success ) {
				  Ext.Msg("Update Menu").Success();
			  } 
			  else {
				Ext.Msg("Update Menu").Failed();
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
 
 function EventSave()
{
  var frmAddMenu = Ext.Serialize('frmAddMenu');
	  frmAddCond = frmAddMenu.Required
	  ([ 
			'menu_controller',
			'menu_group',
			'menu_id',
			'menu_name', 
			'menu_order',
			'menu_status'
	  ]);
	  
 if( !frmAddCond ) {  
	Ext.Msg('form input not complete!').Info();
	return false;
 }
 
 Ext.Ajax
	({
	   url 	 	: Ext.EventUrl(new Array('SysMenu','add_menu')).Apply(),
	   method 	: 'POST',
	   param  	: Ext.Join(new Array(
					frmAddMenu.getElement() 
				 )).object(),
				 
	   ERROR	: function (e) 
	   {
		  Ext.Util(e).proc(function( response )
		  {
			  if( response.success ) {
				  Ext.Msg("Add Menu").Success();
				  
					if( Ext.Msg('Continue Add Menu ?').Confirm() ) {
					 	Ext.ShowMenu(new Array('SysMenu','addMenuTpl'), 
						Ext.System.view_file_name(),{
							menu_id  : 0
						});
					}	  
			  } 
			  else {
				Ext.Msg("Add Menu").Failed();
				return false;
			  }
		  });
	  } 	
    }).post(); 
 }
 
// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	load data menu page .
 * @ note		eweh note.
 */
 
 function ActionShowMenu( obj )
{ 
	var frmMenuOnList = Ext.Serialize('frmMenuOnList');
	$('#menu_lists').Spiner 
	({
		url 	: new Array('SysMenu','PageMenuList'),
		param 	: Ext.Join(new Array( frmMenuOnList.getElement())).object(),
		order   : {
			order_type : obj.type,
			order_by   : obj.orderby,
			order_page : obj.page	
		}, 
		complete : function( obj ){
			console.log(obj);
		}
	});		
	
}


// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	load data menu page .
 * @ note		eweh note.
 */ 
 
function ActionMenuUser( obj )
{
	var frmMenuOnRole = Ext.Serialize('frmMenuOnRole');
	$('#menu_user_group').Spiner 
	({
		url 	: new Array('SysMenu','PageMenuUser'),
		param 	: Ext.Join(new Array( frmMenuOnRole.getElement())).object(),
		order   : {
			order_type : obj.type,
			order_by   : obj.orderby,
			order_page : obj.page	
		}, 
		complete : function( obj ){
			console.log(obj);
		}
	});		
}
// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	load data menu page .
 * @ note		eweh note.
 */
 
function ShowMenuPrivilege() {
	new ActionMenuUser({ orderby : '',  type	: '',  page	: 0 });
	
}	
// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	load data menu page .
 * @ note		eweh note.
 */
 
function ShowMenuList(){
	 new ActionShowMenu({ orderby : '',  type: '', page: 0 });
}


// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	load data menu page .
 * @ note		eweh note.
 */ 
 
function ActionMenuPush()
{
	fromMenuId  = Ext.Cmp('MenuId').getChecked();
	toUserGroup = Ext.Cmp('group_menu_on_user').getValue();	
	
	if( fromMenuId.length ==0 ){
		Ext.Msg('Please select a rows menu ID.').Info();
		return false;	
	}	
	
	if( toUserGroup =='' ){
		Ext.Msg('Please select User Group.').Info();
		return false;	
	}
	
// ----------------- action  --------------------	
	Ext.Ajax
	({
		url 	: Ext.EventUrl(new Array('SysMenu','AssignMenu')).Apply(),
		param 	: {
			MenuId   : fromMenuId,
			GroupId  : toUserGroup
		},
		ERROR   : function( e ){
			Ext.Util(e).proc(function( res ){
				if( res.success ){
					new ShowMenuPrivilege();
					
				}	
			});
		}
	}).post();
	
}


// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	load data menu page .
 * @ note		eweh note.
 */ 
 
function ActionMenuPool()
{
	fromMenuId  = Ext.Cmp('MenuUserId').getChecked();
	toUserGroup = Ext.Cmp('group_menu_on_user').getValue();	
	
	if( fromMenuId.length ==0 ){
		Ext.Msg('Please select a rows menu ID.').Info();
		return false;	
	}	
	
	if( toUserGroup =='' ){
		Ext.Msg('Please select User Group.').Info();
		return false;	
	}	
// ----------------- action  --------------------	
	Ext.Ajax
	({
		url 	: Ext.EventUrl(new Array('SysMenu','RemoveMenu')).Apply(),
		param 	: {
			MenuId   : fromMenuId,
			GroupId  : toUserGroup
		},
		ERROR   : function( e ){
			Ext.Util(e).proc(function( res ){
				if( res.success ){
					new ShowMenuPrivilege();
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
  
  if( !Ext.Cmp("AssignMenuLookUp").IsNull() ){
	new ActionShowMenu({ orderby : '',  type: '', page: 0 });
	new ActionMenuUser({ orderby : '',  type: '', page: 0 });
  }
});
</script>
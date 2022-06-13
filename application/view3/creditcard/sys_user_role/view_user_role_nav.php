<?php echo javascript(); ?>
	
<script type="text/javascript">
//-----------------------------------------------------------------------

/*
 * modul  		 	Uplaod Template
 *
 * @akses 			public & of run window  
 * @author 			uknown 
 */
 
Ext.DOM.onload = (function(){
	Ext.Cmp('ui-widget-title').setText( Ext.System.view_file_name());
})();
 
//-----------------------------------------------------------------------

/*
 * modul  		 	method get User Role 
 *
 * @akses 			public & of run window  
 * @author 			uknown 
 */

var Role = new Ext.Role("SysUserRole");
	Role.extend([
		{ title: " ", icon :"", event: "", key :'UserRoleId' } // if you have other extends event 
	]);
  
//-----------------------------------------------------------------------

/*
 * modul  		 	Uplaod Template
 *
 * @akses 			public & of run window  
 * @author 			uknown 
 */
 
Ext.DOM.datas = {
	user_role_desc    : "<?php echo _get_post('user_role_desc');?>",
	user_role_flags   : "<?php echo _get_post('user_role_flags');?>",
	user_role_startts : "<?php echo _get_post('user_role_startts');?>",
	user_role_endts   : "<?php echo _get_post('user_role_endts');?>",
	order_by 		  : "<?php echo _get_post('order_by');?>",
	type			  : "<?php echo _get_post('type');?>"
	
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
	
	 $('.date').datepicker
	 ({
		showOn: 'button', 
		changeYear:true,
		changeMonth:true,
		buttonImage: Ext.Image("calendar.gif"), 
		buttonImageOnly: true, 
		dateFormat:'dd-mm-yy',
		readonly:true
	 });
	 
	 $('.filter-ui-paket').chosen();
	 $('.filter-ui-status').chosen();
	 $('.filter-ui-spcl').chosen();
	 
});

//-----------------------------------------------------------------------

/*
 * modul  		 	Uplaod Template
 *
 * @akses 			public & of run window  
 * @author 			uknown 
 */
 
		
Ext.EQuery.TotalPage   = '<?php echo (INT)$page -> _get_total_page(); ?>';
Ext.EQuery.TotalRecord = '<?php echo (INT)$page -> _get_total_record(); ?>';

//-----------------------------------------------------------------------

/*
 * modul  		 	Uplaod Template
 *
 * @akses 			public & of run window  
 * @author 			uknown 
 */
 
Ext.DOM.navigation =  {
	custnav	 : Role.pageIndex(),
	custlist : Role.pageContent()
}
//-----------------------------------------------------------------------

/*
 * modul  		 	Uplaod Template
 *
 * @akses 			public & of run window  
 * @author 			uknown 
 */
 
 
Ext.EQuery.construct( Ext.DOM.navigation, Ext.DOM.datas )
Ext.EQuery.postContentList();


//-----------------------------------------------------------------------

/*
 * modul  		 	EventSearch
 *
 * @akses 			public & of run window  
 * @author 			uknown 
 */
 
 function EventSearch()
{
	Ext.Progress("load_images_id").start();
	var formListData = Ext.Serialize("FrmUserRole").getElement();
	Ext.EQuery.construct( Ext.DOM.navigation, 
		Ext.Join([  formListData ]).object() );
	
	Ext.EQuery.postContent();
}

//-----------------------------------------------------------------------

/*
 * modul  		 	EventAdd
 *
 * @akses 			public & of run window  
 * @author 			uknown 
 */
 
 function EventClear() 
{
	Ext.Serialize("FrmUserRole").Clear();	
	Ext.DOM.EventSearch();
}

//-----------------------------------------------------------------------

/*
 * modul  		 	EventAdd
 *
 * @akses 			public & of run window  
 * @author 			uknown 
 */
 
 function EventAdd()
{
	Ext.Ajax 
	({
		url 	 : Role.action("Add"),
		method  : "POST",
		param   : {
			time : Ext.Date().getDuration()
		}
	}).load("main_content");
 
}

//-----------------------------------------------------------------------

/*
 * modul  		 	EventEdit
 *
 * @akses 			public & of run window  
 * @author 			uknown 
 */
 
 function EventEdit()
{
  var UserRoleId = Role.getValue();  
  if( (UserRoleId=='') || (UserRoleId.length > 1) ){
	Ext.Msg("Please select a rows ").Info();
	return false;
  }
 

 if( UserRoleId )
 {
	Ext.ShowMenu( Role.Url("Edit"), 
	Ext.System.view_file_name(), {
		UserRoleId : UserRoleId,
		ControllerId : Role.ctrl()
	});
  }
}

 
//-----------------------------------------------------------------------

/*
 * modul  		 	EventDelete
 *
 * @akses 			public & of run window  
 * @author 			uknown 
 */
 
 function EventDelete() 
{
  var UserRoleId = Role.getValue();
  if( UserRoleId.length ==0 ) {
	Ext.Msg("Please select a rows").Info();
	return false; }
	 
   if( !Ext.Msg("Are you Sure?").Confirm() ){ 
	return false; }
	
  // --- on ajax handler -------------------------------
   Ext.Progress("load_images_id").start();
   Ext.Ajax
   ({
		url    : Role.action("Delete"),
		method : 'POST', 
		param  : {
			UserRoleId : UserRoleId
		},
		ERROR : function( fn )
		{
			Ext.Util(fn).proc( function( response ){
				Ext.Progress("load_images_id").stop();
				if( response.success ){
					Ext.Msg("Delete User Role").Success();
					Ext.Progress("load_images_id").start();
					Ext.EQuery.postContent();
				} else {
					Ext.Msg("Delete User Role").Failed();
				}
		    });
		}	
   }).post();
}
 
 
//-----------------------------------------------------------------------

/*
 * modul  		 	EventDelete
 *
 * @akses 			public & of run window  
 * @author 			uknown 
 */
 
 
 function EventDetail() 
{
  var UserRoleId = Role.getValue();
  if( UserRoleId.length ==0 ) {
	Ext.Msg("Please select a rows").Info();
	return false; 
  }
   if( UserRoleId.length > 1 ) {
	   Ext.Msg("Please select a one rows").Info();
		return false; 
   }
  
  if( UserRoleId ) {
	Ext.ShowMenu( Role.Url("Detail"), 
	Ext.System.view_file_name(), {
		UserRoleId : UserRoleId,
		ControllerId : Role.ctrl()
	});
  }
  
}
 
//-----------------------------------------------------------------------

/*
 * modul  		 	EventDelete
 *
 * @akses 			public & of run window  
 * @author 			uknown 
 */
 
 function EventDisable()
{
  var UserRoleId = Role.getValue();
  
   if( UserRoleId.length ==0 ) {
	 Ext.Msg("Please select a rows").Info();
	 return false; }
	 
   if( !Ext.Msg("Are you Sure?").Confirm() ){ 
	return false; }
	
  // --- on ajax handler -------------------------------
   Ext.Progress("load_images_id").start();
   Ext.Ajax
   ({
		url    : Role.action("Disable"),
		method : 'POST', 
		param  : {
			UserRoleId : UserRoleId
		},
		ERROR : function( fn )
		{
			Ext.Util(fn).proc( function( response ){
				Ext.Progress("load_images_id").stop();
				if( response.success ){
					Ext.Msg("Disable User Role").Success();
					Ext.Progress("load_images_id").start();
					Ext.EQuery.postContent();
				} else {
					Ext.Msg("Disable User Role").Failed();
				}
		    });
		}	
   }).post();
}
 
//-----------------------------------------------------------------------

/*
 * modul  		 	EventDelete
 *
 * @akses 			public & of run window  
 * @author 			uknown 
 */
 
 function EventEnable()
{
  var UserRoleId = Role.getValue();
  
   if( UserRoleId.length ==0 ) {
	 Ext.Msg("Please select a rows").Info();
	 return false; }
	 
   if( !Ext.Msg("Are you Sure?").Confirm() ){ 
	return false; }
	
  // --- on ajax handler -------------------------------
   Ext.Progress("load_images_id").start();
   Ext.Ajax
   ({
		url    : Role.action("Enable"),
		method : 'POST', 
		param  : {
			UserRoleId : UserRoleId
		},
		ERROR : function( fn )
		{
			Ext.Util(fn).proc( function( response ){
				Ext.Progress("load_images_id").stop();
				if( response.success ){
					Ext.Msg("Enable User Role").Success();
					Ext.Progress("load_images_id").start();
					Ext.EQuery.postContent();
				} else {
					Ext.Msg("Enable User Role").Failed();
				}
		    });
		}	
   }).post();
}
  
</script>
<!-- start : content -->
<fieldset class="corner">
<?php echo form()->legend(lang(""), "fa-file-text-o"); ?>
<div id="result_content_add" class="ui-widget-panel-form" >
  <form name="FrmUserRole">
  <div class="ui-widget-form-table-compact">
		<div class="ui-widget-form-row">
		
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array("Role","Name"));?></div>
			<div class="ui-widget-form-cell">:</div>
			<div class="ui-widget-form-cell"><?php echo form()-> input('user_role_desc','input_text superlong ', _get_exist_session('book_class_code'));?></div>
			
			<div class="ui-widget-form-cell text_caption"> <?php echo lang("Date Created");?></div>
			<div class="ui-widget-form-cell">:</div>
			<div class="ui-widget-form-cell">
				<?php echo form()->input('user_role_startts','input_text date', _get_exist_session('user_role_startts'));?>&nbsp;-	
				<?php echo form()->input('user_role_endts','input_text date', _get_exist_session('user_role_endts'));?>
			</div>
			
		</div>
		
		
		<div class="ui-widget-form-row">	
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Status");?></div>
			<div class="ui-widget-form-cell">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo('user_role_flags','select filter-ui-status superlong', Flags(), (string)_get_exist_session('user_role_flags'));?></div>
			
			
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
		
	<!-- stop : content -->
	
	
	
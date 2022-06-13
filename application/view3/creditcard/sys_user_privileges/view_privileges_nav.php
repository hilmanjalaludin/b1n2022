<?php echo javascript(); ?>
<script type="text/javascript">


// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
 Ext.DOM.onload= (function(){
	Ext.Cmp('ui-widget-title').setText( Ext.System.view_file_name());
 })();
 
// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
 
var Role = new Ext.Role("SysPrivileges");
	Role.extend([
		{ title: " ", icon :"", event: "", key :'PrivilegeId' } // if you have other extends event 
	]);
   
// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 /*
 PrivilegeKd
 PrivilegeName
 PrivilegeStatus
 PrivilegeUpdateTs_End
 PrivilegeUpdateTs_Start
 */
 
Ext.DOM.datas = {
	
	PrivilegeUpdateTs_Start : "<?php echo _get_exist_session('PrivilegeUpdateTs_Start');?>", 
	PrivilegeUpdateTs_End : "<?php echo _get_exist_session('PrivilegeUpdateTs_End');?>",
	PrivilegeStatus  : "<?php echo _get_exist_session('PrivilegeStatus');?>", 
	PrivilegeName : "<?php echo _get_exist_session('PrivilegeName');?>", 
	PrivilegeKd : "<?php echo _get_exist_session('PrivilegeKd');?>", 
	order_by : "<?php echo _get_post('order_by');?>",
	type : "<?php echo _get_exist_session('type');?>",
	
}
 	
	
// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
 
$(document).ready( function(){
	
 $('#toolbars').extToolbars ({
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
	
	
 $('.date').datepicker ({
	showOn: 'button',  changeYear:true,
	changeMonth:true, buttonImage: Ext.Image("calendar.gif"), 
	buttonImageOnly: true,  dateFormat:'dd-mm-yy',
	readonly:true
 });
 $('.select').chosen();
 
});


// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
 
Ext.EQuery.TotalPage   = '<?php echo (INT)$page -> _get_total_page(); ?>';
Ext.EQuery.TotalRecord = '<?php echo (INT)$page -> _get_total_record(); ?>';


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
 
window.EventAdd = function()
{
	Role.showMenu('Add', {
		duration : Ext.Date().getDuration()
	});	
}

// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
 window.EventEdit = function() 
{
 if( Role.getValue().length ==0   ){
	Ext.Msg('Please select a row(s) ').Info();
	return false
 }	
	
 if( Role.getValue().length > 1   ){
	Ext.Msg('Please select a one row(s) ').Info();
	return false
 }
	
// ------ show on event spesifik ----------------------------
	
 Role.showMenu('Edit', {
	PrivilegeId  : Role.getValue() 
 });	

}

// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
 window.EventSearch = function()
{
	$.cookie('selected',0)	
	var FrmGroupPrivilege = Ext.Serialize('FrmGroupPrivilege').getElement();
	console.log(FrmGroupPrivilege);
		Ext.Progress("load_images_id").start();
		Ext.EQuery.construct( Ext.DOM.navigation, Ext.Join(new Array(FrmGroupPrivilege)).object());
		Ext.EQuery.postContent();
}

// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
window.EventClear = function(){
	Ext.Serialize('FrmGroupPrivilege').Clear();
	window.EventSearch();
}



// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
 window.EventDisable = function() 
{
 if( Role.getValue().length ==0   ){
	Ext.Msg('Please select a row(s) ').Info();
	return false
 }	
// ------ show on event spesifik ----------------------------
	
	Ext.Ajax 
	({
		url 	: Role.action("Disable"), 
		method 	: 'POST',
		param 	: { 
			PrivilegeId  : Role.getValue()  
		},
		ERROR	: function( e )  
		{
			Ext.Util(e).proc(function( data ){
				if( data.success ){
					Ext.Msg("Disable Privilege").Success();
					window.EventSearch();
				} else {
					Ext.Msg("Disable Privilege").Failed();
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
 
 window.EventEnable = function() 
{
 if( Role.getValue().length ==0   ){
	Ext.Msg('Please select a row(s) ').Info();
	return false
 }	
// ------ show on event spesifik ----------------------------
	
	Ext.Ajax 
	({
		url 	: Role.action("Enable"), 
		method 	: 'POST',
		param 	: { 
			PrivilegeId  : Role.getValue()  
		},
		ERROR	: function( e )  
		{
			Ext.Util(e).proc(function( data ){
				if( data.success ){
					Ext.Msg("Enable Privilege").Success();
					window.EventSearch();
				} else {
					Ext.Msg("Enable Privilege").Failed();
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
 
 window.EventDelete = function() 
{
 if( Role.getValue().length ==0   ){
	Ext.Msg('Please select a row(s) ').Info();
	return false
 }	
// ------ show on event spesifik ----------------------------
	
	Ext.Ajax 
	({
		url 	: Role.action("Delete"), 
		method 	: 'POST',
		param 	: { 
			PrivilegeId  : Role.getValue()  
		},
		ERROR	: function( e )  
		{
			Ext.Util(e).proc(function( data ){
				if( data.success ){
					Ext.Msg("Delete Privilege").Success();
					window.EventSearch();
				} else {
					Ext.Msg("Delete Privilege").Failed();
				}	
		    });
		}	
	}).post();
}
</script>

<fieldset class="corner">
<?php echo form()->legend(lang(""), "fa-file-text-o"); ?>
<div id="result_content_add" class="ui-widget-panel-form" >
  <form name="FrmGroupPrivilege">
  <div class="ui-widget-form-table-compact">
	
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array("Privilege","Name"));?></div>
			<div class="ui-widget-form-cell">:</div>
			<div class="ui-widget-form-cell"><?php echo form()-> input('PrivilegeName','input_text superlong ', _get_exist_session('PrivilegeName'));?></div>
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Status");?></div>
			<div class="ui-widget-form-cell">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo('PrivilegeStatus','select filter-ui-status superlong', Flags(), (string)_get_exist_session('PrivilegeStatus'));?></div>
			
		</div>
		
		
		<div class="ui-widget-form-row">	
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array("Privilege","ID"));?></div>
			<div class="ui-widget-form-cell">:</div>
			<div class="ui-widget-form-cell"><?php echo form()-> input('PrivilegeKd','input_text superlong ', _get_exist_session('PrivilegeKd'));?></div>
			
			<div class="ui-widget-form-cell text_caption"> <?php echo lang("Date Created");?></div>
			<div class="ui-widget-form-cell">:</div>
			<div class="ui-widget-form-cell">
				<?php echo form()->input('PrivilegeUpdateTs_Start','input_text date', _get_exist_session('PrivilegeUpdateTs_Start'));?>&nbsp;-	
				<?php echo form()->input('PrivilegeUpdateTs_End','input_text date', _get_exist_session('PrivilegeUpdateTs_End'));?>
			</div>
			
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

	
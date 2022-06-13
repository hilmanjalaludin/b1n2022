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
 

var Role = new Ext.Role("SysMenuGroup");
	Role.extend([
		{ title: " ", icon :"", event: "", key :'GU_Id' } // if you have other extends event 
	]);
// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */

Ext.DOM.datas = 
{
	CR_Kategory	: "<?php printf("%s", _get_exist_session('CR_Kategory')); ?>",
	CR_Kode		: "<?php printf("%s", _get_exist_session('CR_Kode')); ?>",
	CR_Desc		: "<?php printf("%s", _get_exist_session('CR_Desc')); ?>",
	CR_Flags	: "<?php printf("%s", _get_exist_session('CR_Flags')); ?>", 
	order_by 	: "<?php printf("%s", _get_exist_session('order_by')); ?>",  
	type 	 	: "<?php printf("%s", _get_exist_session('type')); ?>" 
}

//-----------------------------------------------------------------------

/*
 * modul  		 	method get User Role 
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
	
	 $('.date').datepicker ({ showOn: 'button',  changeYear:true, changeMonth:true, buttonImage: Ext.Image("calendar.gif"),  buttonImageOnly: true,  dateFormat:'dd-mm-yy', readonly:true });
	 $('.select').chosen();
	 $('.date').css("width", "85px");
	
	 
});


//-----------------------------------------------------------------------

/*
 * modul  		 	Uplaod Template
 *
 * @akses 			public & of run window  
 * @author 			uknown 
 */
   
Ext.EQuery.TotalPage   = '<?php echo $page ->_get_total_page(); ?>';
Ext.EQuery.TotalRecord = '<?php echo $page ->_get_total_record(); ?>';

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
   
   
Ext.EQuery.construct(Ext.DOM.navigation,Ext.DOM.datas)
Ext.EQuery.postContentList();


//-----------------------------------------------------------------------

/*
 * modul  		 	Uplaod Template
 *
 * @akses 			public & of run window  
 * @author 			uknown 
 */
 
 window.EventSearch = function()
 {
	$.cookie('selected',0)	
	
	var frmGroupMenu  = Ext.Serialize("frmGroupMenu");
	frmGroupMenu.Debuger();
	
	//	console.log( FrmGroupLayout.Initialize());
	Ext.EQuery.construct( navigation, Ext.Join(new Array(
			frmGroupMenu.Initialize() 
		)).object());
	Ext.EQuery.postContent();	
}

// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
 window.EventClear = function() {
	Ext.Serialize("frmGroupMenu").Clear();
	 window.EventSearch();
}


// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
window.EventDisable = function()
{
	Ext.Ajax
	({
		url 	: Role.action('Aktivasi'),  
		method  : 'POST',
		param   : {
			GU_Id 	: Role.getValue(),
			Aktive 	: 0
		},
		
		success : function( xhr ) 
		{
			Ext.Util( xhr ).proc(function( data ) 
			{
				if( data.success == 1 ){
					Ext.Msg("Disable row(s)").Success();
					window.EventSearch();
				} else {
					Ext.Msg("Disable row(s)").Failed();
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
	Ext.Ajax
	({
		url 	: Role.action('Aktivasi'),  
		method  : 'POST',
		param   : {
			GU_Id : Role.getValue(),
			Aktive : 1
		},
		
		success : function( xhr ) {
			Ext.Util( xhr ).proc(function( data ) {
				if( data.success == 1 ){
					Ext.Msg("Enable row(s)").Success();
					window.EventSearch();
				} else {
					Ext.Msg("Enable row(s)").Failed();
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
 

 window.EventEdit = function()
{
	var GU_Id = Role.getValue();
	
	if( GU_Id.length == 0 ){
		Ext.Msg("Please select a rows").Info();
		return false;
	}
	Ext.ShowMenu(Role.Url('Edit'),   
		Ext.System.view_file_name(), {
			GU_Id : GU_Id
	});
}

// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 

 window.EventDelete = function()
{
 var GU_Id = Role.getValue(); 
 if( GU_Id.length == 0 ){
	Ext.Msg("Please select rows! ").Info();
	return false;
	
 }
 
 if( !Ext.Msg('Do you want to delete this row?').Confirm() ){
	 return false;
 }
 
 // ---- delete action process  ---- 
 
  Ext.Ajax
	({
		url 	: Role.action('Delete'),  
		method  : 'POST',
		param   : {
			GU_Id : GU_Id 
		},
		
		success : function( xhr ) {
			Ext.Util( xhr ).proc(function( data ) {
				if( data.success == 1 ){
					Ext.Msg("Delete row(s)").Success();
					window.EventSearch();
				} else {
					Ext.Msg("Delete row(s)").Failed();
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
 	
 window.EventAdd = function()
{
	Ext.ShowMenu(Role.Url('Add'),  
		Ext.System.view_file_name(), {
			act : 'add-layout-user'
	});
}

</script>

<!-- start : content -->
<fieldset class="corner">
<?php echo form()->legend(lang(""), "fa-gear"); ?>
  <div id="result_content_add" class="ui-widget-panel-form"> 
	<form name="frmGroupMenu">
		<div class="ui-widget-table-compact">
			<div class="ui-widget-form-row">		
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('GM_Label_Name'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell"><?php echo form()->input("GU_Name", "input_text superlong", _get_exist_session('GU_Name') );?></div>
				
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('GM_Label_Ordering'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell"><?php echo form()->combo("GU_Ordering", "select superlong", Order(), _get_exist_session('GU_Ordering') );?></div>
			</div>
			
			<div class="ui-widget-form-row">
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('GM_Label_Description'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell"><?php echo form()->input("GU_Desc", "input_text superlong", _get_exist_session('GU_Desc') );?></div>
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('GM_Flags'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell"><?php echo form()->combo("GU_Flags", "select superlong", Flags(), _get_exist_session('GU_Flags') );?></div>
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
<fieldset class="corner">
	<legend class="icon-menulist">&nbsp;&nbsp;<span id="legend_title"></span></legend>
	<div id="toolbars"></div>
	<div id="panel-content"></div>
	<div class="content_table"></div>
	<div id="pager"></div>
	<div class="box-shadow" style="background-color:#FFFFFF;margin-top:5px;" >
	 
		<table>
			<tr>
				<td valign="top">
					<fieldset style="background-color:#FFFFFF;border:1px solid #dddddd;margin:5px;padding:8px;">
					<legend> Privileges </legend> 	
						<?php echo form()-> listCombo('privileges','style',$privileges, $_value='', array('change'=>'ShowGroupMenu(this);'), array());?>
						<input type="button" class="assign button" value="Assign" onclick="Ext.DOM.AssignGroupMenu();">
					</fieldset>
				</td>
				<td valign="top"> 
					<fieldset style="background-color:#FFFFFF;border:1px solid #dddddd;margin:5px;padding:8px;">
					<legend> Group Menu </legend> 
						<span id="showOnActive"> <?php echo form()-> listCombo('group_menu','',$menugroup, null, NULL, array());?> </span>
						<input type="button" class="remove button" value="&nbsp;Remove" onclick="Ext.DOM.RemoveGroupMenu();">
					</fieldset>
				</td>
			</tr>	
		</table>	 
	</div>
	<div id="ExtDialogMenu"></div>
</fieldset>
-->

	
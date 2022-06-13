<?php printf("%s",javascript()); ?>
<script type="text/javascript">

// ----------------------------------------------------------------------------------------------------------------
 /*
  * @ pack ............... : get Account Status By User Login 
  * @ auth ............... : uknown 
  * @ date ............... : 2016-11-16 
  *
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
 

var Role = new Ext.Role("SysThemes");
	Role.extend([
		{ title: " ", icon :"", event: "", key :'ThemeId' } // if you have other extends event 
	]);

//-----------------------------------------------------------------------

/*
 * modul  		 	method get User Role 
 *
 * @akses 			public & of run window  
 * @author 			uknown 
 */
Ext.DOM.datas =  {
	TH_Layout_Name  : "<?php printf('%s', _get_exist_session('TH_Layout_Name'));?>",
	TH_Layout_Flag  : "<?php printf('%s', _get_exist_session('TH_Layout_Flag'));?>",
	order_by 	    : "<?php printf('%s', _get_exist_session('order_by'));?>",
	type			: "<?php printf('%s', _get_exist_session('type'));?>"
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
   
Ext.EQuery.TotalPage   = '<?php echo (int)$page -> _get_total_page(); ?>';
Ext.EQuery.TotalRecord = '<?php echo (int)$page -> _get_total_record(); ?>';

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
	var FrmGroupLayout  = Ext.Serialize("frmUserThemes");
	Ext.EQuery.construct( navigation, Ext.Join(new Array(
			FrmGroupLayout.Initialize() 
		)).object());
	Ext.EQuery.postContent();	
}

// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
 window.EventClear = function() {
	Ext.Serialize("frmUserThemes").Clear();
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
		method 	: 'POST',
		param 	: {
			ThemeId : Role.getValue(),
			Aktive   : 0
		},
		success : function( response )
		{
			Ext.Util( response ).proc(function( data ){
				if( data.success ){
					Ext.Msg("Disable Layout").Success();
					window.EventSearch();
				}
				else{
					Ext.Msg("Disable Layout").Failed();
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
		method 	: 'POST',
		param 	: {
			ThemeId : Role.getValue(),
			Aktive  : 1
		},
		success : function( response )
		{
			Ext.Util( response ).proc(function( data ){
				if( data.success ){
					Ext.Msg("Enable Layout").Success();
					window.EventSearch();
				}
				else{
					Ext.Msg("Enable Layout").Failed();
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
	Ext.ShowMenu( Role.Url('Edit'),  
		Ext.System.view_file_name(), {
			ThemeId : Role.getValue()
		}	
	);
}

// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 

 window.EventDelete = function()
{
 var ThemeId = Role.getValue();
 if( ThemeId.length == 0 ){
	Ext.Msg("Please select rows! ").Info();
	return false;
	
 }
 
 if( !Ext.Msg('Do you want to delete this row?').Confirm() ){
	 return false;
 }
 
	 Ext.Ajax
	({
		url 	: Role.action('Delete'), // Ext.EventUrl(['SysUserLayout','DeleteLayout']).Apply(),  //Ext.DOM.INDEX +'/SysUserLayout/UpdateLayout/',
		method 	: 'POST',
		param 	: {
			ThemeId : Role.getValue()
		},
		success : function( response ){
			Ext.Util( response ).proc(function( data ){
				if( data.success ){
					Ext.Msg("Delete Layout").Success();
					window.EventSearch();
				}
				else{
					Ext.Msg("Delete Layout").Failed();
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
	Ext.ShowMenu( Role.Url('Add'),  
		Ext.System.view_file_name(), { 
			time : ''
		}	
	);
}
	
</script>

<!-- html markup data content --->
<fieldset class="corner">
<?php echo form()->legend(lang(""), "fa-bars"); ?>
<div id="result_content_add" class="ui-widget-panel-form" style="margin:5px 0px 10px 0px;">
	<form name="frmUserThemes">
		<div class="ui-widget-table-compact">
			<div class="ui-widget-form-row">		
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('GM_Label_Name'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell"><?php echo form()->input("TH_Layout_Name", "input_text long", _get_exist_session('TH_Layout_Name') );?></div>
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('GM_Flags'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell"><?php echo form()->combo("TH_Layout_Flag", "select long", Flags(), _get_exist_session('TH_Layout_Flag') );?></div>
			</div>
		</div>
	</form> 
</div>

<div class="ui-widget-toolbars" id="toolbars"></div>
<div class="content_table" id="ui-widget-content_table"></div>
<div class="ui-widget-pager" id="pager"></div> 
</fieldset>	

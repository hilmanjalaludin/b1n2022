<?php echo javascript(); ?>
<script type="text/javascript">

/**
 ** javscript prototype system
 ** version v.0.1
 **/
 
 Ext.DOM.onload= (function(){
	Ext.Cmp('ui-widget-title').setText( Ext.System.view_file_name());
 })();
 
 
// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
 
var Role = new Ext.Role("Configuration");
	Role.extend([
		{ title: " ", icon :"", event: "", key :'ConfigID' } // if you have other extends event 
	]);
   
// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
 
Ext.DOM.datas = {
	 
	ConfigIDX 	 : "<?php echo _get_exist_session('ConfigIDX');?>", 
	ConfigCode 	 : "<?php echo _get_exist_session('ConfigCode');?>",
	ConfigName   : "<?php echo _get_exist_session('ConfigName');?>", 
	ConfigValue  : "<?php echo _get_exist_session('ConfigValue');?>", 
	ConfigType   : "<?php echo _get_exist_session('ConfigType');?>", 
	ConfigStatus : "<?php echo _get_exist_session('ConfigStatus');?>", 
	order_by 	 : "<?php echo _get_exist_session('order_by');?>",
	type 		 : "<?php echo _get_exist_session('type');?>"
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
 
 
 window.EventSearch = function() 
{
	
 $.cookie('selected',0)	
	var frmConfigUser = Ext.Serialize('frmConfigUser').getElement();
		Ext.Progress("load_images_id").start();
		Ext.EQuery.construct( Ext.DOM.navigation, Ext.Join(new Array(frmConfigUser)).object());
		Ext.EQuery.postContent();
}

// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
 
window.EventClear = function() {
	Ext.Serialize('frmConfigUser').Clear();
	window.EventSearch();
}

// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
 
 window.EventAdd = function() 
{
	Role.showMenu("Add", {
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
  Role.showMenu("Edit", {
	ConfigID : Role.getValue(),	
  });
  
}

// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
// Ext.DOM.UpdateConfig = function()
// {

	// if(Ext.Cmp('ConfigCode').empty() ){ 
		// Ext.Msg('Config Code is empty').Info(); }
	// else if( Ext.Cmp('ConfigName').empty() ){ 
		// Ext.Msg('Config Name is empty').Info();
	// }	
	// else if(Ext.Cmp('ConfigValue').empty() ){ 
		// Ext.Msg('Config Value is empty').Info(); }
	// else 
	// {
		// Ext.Ajax({
			// url 	: Ext.DOM.INDEX +'/Configuration/UpdateConfig/',
			// method 	: 'POST',
			// param 	: Ext.Join([Ext.Serialize('frmEditConfig').getElement()]).object(),
			// ERROR 	: function(fn) {
				// Ext.Util(fn).proc(function(save){
					// if( save.success){
						// Ext.Msg("Update Configuration").Success();
						// Ext.EQuery.postContent();
					// }
					// else{
						// Ext.Msg("Update Configuration").Failed();
					// }
				// });
			// }
		// }).post();
		
	// }
// }

// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
		
 window.EventDelete = function()
{	
	var ConfigID = Role.getValue();
	
	if( ConfigID == '') {
		Ext.Msg("Please select a row!").Info();
		return false; 
	}
	
	if( !Ext.Msg('Do you want to deleted this rows ').Confirm() ) {
		return false; 
	}
	
	Ext.Ajax 
	({
		url 	: Role.action('Delete'),  
		method 	: 'POST',
		param 	: { 
			ConfigID : Role.getValue() 
		},
		ERROR : function( e )
		{
			Ext.Util(e).proc(function( data ){
				if( data.success ){
					Ext.Msg("Delete Configuration").Success();
					Ext.EQuery.postContent();
				} else {
					Ext.Msg("Delete Configuration ").Failed();
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
 
// Ext.DOM.SaveConfig=function()
// {
	// if(Ext.Cmp('ConfigCode').empty() ){ 
		// Ext.Msg('Config Code is empty').Info(); }
	// else if( Ext.Cmp('ConfigName').empty() ){ 
		// Ext.Msg('Config Name is empty').Info();
	// }	
	// else if(Ext.Cmp('ConfigValue').empty() ){ 
		// Ext.Msg('Config Value is empty').Info(); }
	// else 
	// {
		// Ext.Ajax
		// ({
			// url 	: Ext.DOM.INDEX +'/Configuration/SaveConfig/',
			// method 	: 'POST',
			// param 	: Ext.Join([Ext.Serialize('config').getElement()]).object(),
			// ERROR 	: function(fn) {
				// Ext.Util(fn).proc(function(save){
					// if( save.success){
						// Ext.Msg("Add Config").Success();
						// Ext.EQuery.postContent();
					// }
					// else{
						// Ext.Msg("Add Config").Failed();
					// }
				// });
			// }
		// }).post();
		
	// }	
// }


		
// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
	
</script>

<fieldset class="corner">
<?php echo form()->legend(lang(""), "fa-file-text-o"); ?>
<div id="result_content_add" class="ui-widget-panel-form" >
  <form name="frmConfigUser">
  <div class="ui-widget-form-table-compact">
	
		<div class="ui-widget-form-row">
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array("Config","IDX"));?></div>
			<div class="ui-widget-form-cell">:</div>
			<div class="ui-widget-form-cell"><?php echo form()-> input('ConfigIDX','input_text long ', _get_exist_session('ConfigIDX'));?></div>
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array("Config","Name"));?></div>
			<div class="ui-widget-form-cell">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->input('ConfigName','input_text long', _get_exist_session('ConfigName'));?></div>
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array("Config","Status"));?></div>
			<div class="ui-widget-form-cell">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo('ConfigStatus','select filter-ui-status long', Flags(), (string)_get_exist_session('ConfigStatus'));?></div>
			
			
		</div>
		
		
		<div class="ui-widget-form-row">	
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array("Config","Code"));?></div>
			<div class="ui-widget-form-cell">:</div>
			<div class="ui-widget-form-cell"><?php echo form()-> combo('ConfigCode','select long ', AllConfigCode(), _get_exist_session('ConfigCode'));?></div>
			
			<div class="ui-widget-form-cell text_caption"> <?php echo lang(array("Config","Value"));?></div>
			<div class="ui-widget-form-cell">:</div>
			<div class="ui-widget-form-cell"> <?php echo form()-> input('ConfigValue','input_text long ', _get_exist_session('ConfigValue'));?></div>
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array("Config","Type"));?></div>
			<div class="ui-widget-form-cell">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo('ConfigType','select filter-ui-status long', ConfigType(), (string)_get_exist_session('ConfigType'));?></div>
			
			
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
	
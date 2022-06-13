<?php printf("%s", javascript()); ?>
<script type="text/javascript">

// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
 Ext.DOM.onload= (function(){
	Ext.Cmp('ui-widget-title').setText( Ext.System.view_file_name());
 })()
 	
// http://10.10.10.250/bni-tele-ans/index.php/SysMenu	
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */

var Role = new Ext.Role("SysMenu");
	Role.extend([
		{ title: " ", icon :"", event: "", key :'IDs' } // if you have other extends event 
	]);
  
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */

 
Ext.DOM.datas = {
	group_menu 	 : "<?php echo _get_exist_session('group_menu');?>",
	menu_id 	 : "<?php echo _get_exist_session('menu_id');?>",
	menu_name 	 : "<?php echo _get_exist_session('menu_name');?>",
	menu_status  : "<?php echo _get_exist_session('menu_status');?>",
	order_by 	 : "<?php echo _get_exist_session('order_by');?>",
	type	 	 : "<?php echo _get_exist_session('type');?>"
}


/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
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
	
	 $('.date').datepicker ({ showOn: 'button',  
			changeYear:true, changeMonth:true, 
			buttonImage: Ext.Image("calendar.gif"),  
			buttonImageOnly: true,  
			dateFormat:'dd-mm-yy', readonly:true });
	 $('.select').chosen();
	 $('.date').css("width", "75px");
	
	 
});

 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */

 
 Ext.EQuery.TotalPage = '<?php printf('%d', $page->_get_total_page()); ?>';
 Ext.EQuery.TotalRecord = '<?php printf('%d', $page->_get_total_record()); ?>';

/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
   
Ext.DOM.navigation =  {
	custnav	 : Role.pageIndex(),
	custlist : Role.pageContent()
}
/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */   
   
Ext.EQuery.construct(Ext.DOM.navigation,Ext.DOM.datas)
Ext.EQuery.postContentList();
 
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */

window.EventSearch = function(){
 $.cookie('selected',0)		
 var FrmMenuUser = Ext.Serialize('FrmMenuUser');
	Ext.EQuery.construct( Ext.DOM.navigation, Ext.Join([
		FrmMenuUser.getElement()
	]).object())
 
	Ext.EQuery.postContent();
 
}
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */

window.EventClear = function(){
	$.cookie('selected',0)
	Ext.Serialize('FrmMenuUser').Clear();
	window.EventSearch();
}

 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */

 window.EventEnable = function(){
	var IDs = Ext.Cmp('IDs').getChecked();
	
	if( IDs.length ==0  ){
		Ext.Msg('Please select a row !').Success();
		return false;
	}
	
	if( IDs.length != 0 )
	{
		Ext.Ajax
		({
			url 	: Ext.EventUrl(new Array('SysMenu', 'EnabledMenu') ).Apply(),
			method	: 'POST',
			param   : {
				menuid : IDs	
			},
			ERROR 	: function( e )
			{
				Ext.Util(e).proc(function(response){
					if( response.success ==  1 ){
						Ext.Msg('Enable Menu').Success();
						new Search();
					} else {
						Ext.Msg('Enable Menu').Failed();
					}	
				});
			}	
		}).post();
	}
 }

 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */

 window.EventDisable = function() {	
	var IDs = Ext.Cmp('IDs').getChecked();
	
	if( IDs.length ==0  ){
		Ext.Msg('Please select a row !').Success();
		return false;
	}
	
	if( IDs.length != 0 )
	{
		Ext.Ajax
		({
			url 	: Ext.EventUrl(new Array('SysMenu', 'DisabledMenu') ).Apply(),
			method	: 'POST',
			param   : {
				menuid : IDs	
			},
			ERROR 	: function( e )
			{
				Ext.Util(e).proc(function(response){
					if( response.success ==  1 ){
						Ext.Msg('Disable Menu').Success();
						new Search();
					} else {
						Ext.Msg('Disable Menu').Failed();
					}	
				});
			}	
		}).post();
	}
}		
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */

 window.EventEdit = function() {	 
	var IDs = Ext.Cmp('IDs').getChecked();
	if( IDs.length ==0  ){ Ext.Msg('Please select a row !').Success();
		return false; }
	
	if( IDs.length > 1  ){ Ext.Msg('Please select a one row!').Success();
		return false; }
	
	Ext.ShowMenu(new Array('SysMenu','EditMenuTpl'), 
	Ext.System.view_file_name(),{
		menu_id  : IDs
	});
}
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */

 window.EventAdd = function() {
	Ext.ShowMenu(new Array('SysMenu','addMenuTpl'), 
	Ext.System.view_file_name(),{
		menu_id  : 0
	});
}
 
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */

  window.EventDelete = function() {
 var IDs = Ext.Cmp('IDs').getChecked();
 
 if( IDs.length ==0  ){ 
	Ext.Msg('Please select a row !').Success();
	return false; 
 }
	
 if( !Ext.Msg('Do you want to remove this menu ').Confirm() ) {
	return false;
 }

	Ext.Ajax 
	({
		url 	: Ext.EventUrl(new Array('SysMenu', 'DeleteMenu') ).Apply(),
		method	: 'POST',
		param   : { menu_uid : IDs },
		ERROR 	: function( e ) {
			Ext.Util(e).proc(function(response){
				if( response.success ==  1 ){
					Ext.Msg('Delete Menu').Success();
					Search();
				} else {
					Ext.Msg('Delete Menu').Failed();
				}	
			});
		}	
	}).post();
}

 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */

  window.EventAssign = function() {
	  
//function Assign(){
	Ext.ShowMenu(new Array('SysMenu','AssignMenuTpl'), 
	Ext.System.view_file_name(),{
		UserId : Ext.Session('UserId').getSession()	
	});
} 

// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
// $(document).ready( function()
// {
	// $('#toolbars').extToolbars({
		// extUrl    : Ext.DOM.LIBRARY+'/gambar/icon',
		// extTitle  : [['Enable'],['Disable'],['Edit'],['Add'],['Delete'],['Assign'], ['Clear'], ['Search']],
		// extMenu   : [['EnableMenu'],['DisableMenu'],['EditMenu'],['AddMenu'],['DeleteMenu'],['Assign'], ['Clear'],['Search']],
		// extIcon   : [['accept.png'],['cancel.png'],['application_form_edit.png'],['add.png'],['cross.png'],['application_edit.png'], ['zoom_out.png'], ['zoom_in.png']],
		// extText   : true,
		// extInput  : false,
		// extOption : []
	// });
	
	// $('.select').chosen();
	
 // });

</script>

<fieldset class="corner">
<?php echo form()->legend(lang(""), "fa-bars"); ?>
 <div id="result_content_add" class="ui-widget-panel-form"> 
	<form name="FrmMenuUser">
	<div class="ui-widget-table-compact">
	
		<div class="ui-widget-form-row">	
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Menu ID'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->input("menu_id", "input_text long", _get_exist_session('menu_id') );?></div>		
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Group Menu'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo("group_menu", "select superlong", GroupMenu(), _get_exist_session('group_menu') );?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Menu Name'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->input("menu_name", "input_text long", _get_exist_session('menu_name') );?></div>	
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Status'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo("menu_status", "select superlong", Flags(), _get_exist_session('menu_status') );?></div>
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

<?php echo javascript(); ?>
<script type="text/javascript">
	
 //-----------------------------------------------------------------------

/*
 * modul  		 	method get User Role 
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
 

var Role = new Ext.Role("CtiExtension");
	Role.extend([
		{ title: " ", icon :"", event: "", key :'ExtId' } // if you have other extends event 
	]);
  

  


//-----------------------------------------------------------------------

/*
 * modul  		 	method get User Role 
 *
 * @akses 			public & of run window  
 * @author 			uknown 
 */
 

 
Ext.DOM.datas = {
	frm_ext_location 		: "<?php echo _get_exist_session('frm_ext_location');?>",
	frm_ext_number 			: "<?php echo _get_exist_session('frm_ext_number');?>",
	frm_ext_pbx_server 		: "<?php echo _get_exist_session('frm_ext_pbx_server');?>",
	frm_ext_status 			: "<?php echo _get_exist_session('frm_ext_status');?>",
	frm_ext_type 			: "<?php echo _get_exist_session('frm_ext_type');?>",
	frm_ext_user_state 		: "<?php echo _get_exist_session('frm_ext_user_state');?>",
	frm_ext_description     : "<?php echo _get_exist_session('frm_ext_description');?>",
	order_by 				: "<?php echo _get_exist_session('order_by');?>",
	type	 				: "<?php echo _get_exist_session('type');?>"
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
	 $('.date').css("width", "75px");
	
	 
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
 var frmFilterBy = Ext.Serialize("FrmAgentExtension").getElement();
	
	console.log(frmFilterBy);
	Ext.EQuery.construct( navigation, Ext.Join([  
		Ext.Serialize("FrmAgentExtension").getElement() 
	]).object() );
	Ext.EQuery.postContent();
}

//-----------------------------------------------------------------------

/*
 * modul  		 	Uplaod Template
 *
 * @akses 			public & of run window  
 * @author 			uknown 
 */
 window.EventClear = function()
{
	Ext.Serialize('FrmAgentExtension').Clear();
	window.EventSearch();
}


// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
 
window.EventRealease = function() 
 {
	var ExtensionId  = Role.getValue();
	if( ExtensionId !='')
	{
	  if( Ext.Msg('Do you want to realease this Extension ?').Confirm()) 
	  {	
			$('#load_images_id').html("<span style='color:red;'><img src='"+Ext.Image('loading.gif')+"' height='15'> Please wait...</span>");
			Ext.Ajax
		({
			url 	: Role.action('SetEventRelease'),
			method 	: 'POST',
			param 	: { ExtId : ExtensionId },
			ERROR	: function(e) 
			{
				Ext.Util(e).proc(function( data )
				{
					if( data.success == 1)
					{
						var sMessage = "\n"; for( var sExt in data.message ){
							sMessage +="Extension : "+ sExt +" , Message : "+ data.message[sExt]+"\n";
						}
						$('#load_images_id').html("");
						Ext.Msg(sMessage).Info();
						return false;
					} else {
						Ext.Msg("Release Extension").Failed();
						return false;
					}
				});
			}	
		}).post();
	  }	
	}	
	else{
		Ext.Msg('Please select rows.').Info();
		return false;
	}
}

// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
 window.EventDelete = function() 
 {
	var ExtensionId  = Role.getValue();
	if( ExtensionId !='')
	{
	  if( Ext.Msg('Do you want to remove this Extension ?').Confirm()) 
	  {	
			Ext.Ajax
		({
			url 	: Role.action('SetEventDelete'),
			method 	: 'POST',
			param 	: { ExtId : ExtensionId },
			ERROR	: function(e) {
				Ext.Util(e).proc(function( data ){
					if( data.success){
						Ext.Msg('Remove Extension').Success();
						window.EventSearch();
					} else {
						Ext.Msg('Remove Extension').Failed();
						return false;
					}
				});
			}	
		}).post();
	  }	
	}	
	else{
		Ext.Msg('Please select rows.').Info();
		return false;
	}
}

// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
 window.EventEdit = function()  
{
  var ExtensionId  = Role.getValue();
  if(ExtensionId.length == 1 )  
  {
		Ext.ShowMenu( Role.Url('SetEventEdit'),
		Ext.System.view_file_name(),{
			time   : Ext.Date().getDuration(),
			ExtId  : ExtensionId, 
		});
  } else {
	Ext.Msg('Please select a rows !').Info();
	return false;
  }
}

window.EventDownload = function()
{
	var filetype = "Excel";
	 if( Ext.Msg('Do you want to download -- *.conf  -- file extension').Confirm() )
	{
		filetype = "Conf"
	}
	
	Ext.Window
	({
		url : Role.action('SetEventDownload/'+ filetype +'/'),
		param : {
			download : 'ALL' 
		}
	}).newtab();
}

// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
 window.EventAdd = function() 
{
	Ext.ShowMenu(  Role.Url('SetEventAdd'), 
	Ext.System.view_file_name(),{
		time : 	Ext.Date().getDuration()
	});
}

	
</script>

<fieldset class="corner">
<?php echo form()->legend(lang(""), "fa-asterisk"); ?>
<div id="result_content_add" class="ui-widget-panel-form"> 
 <form name="FrmAgentExtension">
	<div class="ui-widget-form-table-compact">
		<div class="ui-widget-form-row baris-1">
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('PABX Server'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell text_caption left"><?php echo form() -> combo('frm_ext_pbx_server','select tolong', PabxServer(), _get_exist_session('frm_ext_pbx_server'));?></div>
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang('Ext. Number');?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell left"><?php echo form() -> input('frm_ext_number', 'input_text tolong',_get_exist_session('frm_ext_number')) ?></div>
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Ext. Type'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell text_caption left"><?php echo form() -> combo('frm_ext_type','select tolong', PabxType(), _get_exist_session('frm_ext_type'));?></div>
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang('User State');?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell left"><?php echo form() -> combo('frm_ext_user_state','select tolong',User(), _get_exist_session('frm_ext_user_state'));?></div>
			
			
		</div>
		
		<div class="ui-widget-form-row baris-2">
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Description'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell text_caption left"><?php echo form() -> combo('frm_ext_description','select tolong', PabxDescription(),  _get_exist_session('frm_ext_description'));?></div>
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Ext. Location'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell left"><?php echo form() -> input('frm_ext_location','input_text tolong', _get_exist_session('frm_ext_location'));?></div>
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Ext. Status'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell text_caption left"><?php echo form() -> combo('frm_ext_status','select tolong', PabxStatus(), _get_exist_session('frm_ext_status'));?></div>
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
		<legend class="icon-userapplication" >&nbsp;&nbsp;<span id="legend_title"></span></legend>
			<div id="toolbars" class="toolbars"></div>
			<div id="tpl_header"></div>
			<div class="content_table"></div>
			<div id="pager"></div>
			<div id="UserTpl"></div>
	</fieldset>	-->
	
	
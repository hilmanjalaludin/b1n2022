<?php echo javascript(); ?>
<script type="text/javascript">

 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
    
 
Ext.DOM.onload = (function(){
	Ext.Cmp('ui-widget-title').setText( Ext.System.view_file_name());
})();

 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */

var Role = new Ext.Role("CampaignPerUser");
	Role.extend([
		{ title: " ", icon :"", event: "", key :'PerUserId' } // if you have other extends event 
	]);
  


 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
    
Ext.DOM.datas =  {
	CPU1_filter_value		: "<?php printf('%s', get_cokie_exist('CPU1_filter_value'));?>",
	CPU1_filter_field		: "<?php printf('%s', get_cokie_exist('CPU1_filter_field'));?>",
	CPU2_filter_value		: "<?php printf('%s', get_cokie_exist('CPU2_filter_value'));?>",
	CPU2_filter_field		: "<?php printf('%s', get_cokie_exist('CPU2_filter_field'));?>",
	CPU_UpdateTs_start_date	: "<?php printf('%s', get_cokie_exist('CPU_UpdateTs_start_date'));?>",
	CPU_UpdateTs_end_date	: "<?php printf('%s', get_cokie_exist('CPU_UpdateTs_end_date'));?>",
	CPU_UserGroup			: "<?php printf('%s', get_cokie_exist('CPU_UserGroup'));?>",
	order_by 				: "<?php printf('%s', get_cokie_exist('order_by')); ?>",
	type 					: "<?php printf('%s', get_cokie_exist('type')); ?>"
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
  
Ext.EQuery.TotalPage   = '<?php printf('%d', $page->_get_total_page()); ?>';
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
  
 window.EventSetFollowup = function( MasterDataId ) {
	// lepas aja ya 
	var callDataResponse = 0, row = Ext.Json( Role.Url('SetFollowup'), {
		MasterDataId : MasterDataId
	});
	
	// return each data process .
	row.dataItemEach( function( item ){
		console.log( item.success )
		if( item.success ){
			callDataResponse++;
		}
	});
	return callDataResponse;
}

 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 window.EventAdd = function(){
	Ext.ShowMenu( Role.Url('Add'), 
		Ext.System.view_file_name(),  {
		ControllerId : Role.ctrl()
	}); 	 
 } 
 
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
 window.EventSearch = function() 
{
 var frmPerUser = Ext.Serialize("frmPerUser");
 frmPerUser.Debuger();
	//console.log();
	Ext.EQuery.construct( navigation, Ext.Join([  
		frmPerUser.Data() 
	]).object() );
	Ext.EQuery.postContent();
}
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 window.EventClear = function()
{
	Ext.Serialize('frmPerUser').Clear();
	window.EventSearch();
}
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
window.EventEdit = function(){
	var PerUserId =  Role.getValue().toString();
	if( PerUserId == ''){
		Ext.Msg('Please select a row !').Info();
		return false;
	}
	Ext.ShowMenu( Role.Url('Edit'), 
		Ext.System.view_file_name(),  {
		ControllerId : Role.ctrl(),
		PerUserId : PerUserId
	}); 
}

/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
 
 window.EventDelete = function( dataURI ){
	var PerUserId =  Role.getValue().toString();
	if( PerUserId=='' ){
		Ext.Msg('Please select a row !').Info();
		return false;
	}
	
	var callBackMsg = Ext.Msg("Are you sure ?").Confirm();
	if( !callBackMsg ){
		return false;
	}
	// get data process on ajax 
	Ext.Ajax({
		url   : Role.action('Delete'),
		method: 'POST',
		param : {
			PerUserId : PerUserId
		},
		success : function( xhr ){
			Ext.Util(xhr).proc(function( data ){
				if( data.success == 1  ){
					Ext.Msg('Delete Campaign PerUser').Success();
					window.EventSearch();
				} 
				// jika process delete gagal 
				// keluarkan informasi ini.
				else {
					Ext.Msg('Delete Campaign PerUser').Failed();
					return;
				}
			});
		}
	}).post()	
	// console.log(dataURI);
 }  

/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
 
 window.EventDisable = function( dataURI ){
	var PerUserId =  Role.getValue().toString();
	if( PerUserId=='' ){
		Ext.Msg('Please select a row !').Info();
		return false;
	}
	
	var callBackMsg = Ext.Msg("Are you sure ?").Confirm();
	if( !callBackMsg ){
		return false;
	}
	// get data process on ajax 
	Ext.Ajax({
		url   : Role.action('Disable'), 
		method : 'POST',
		param : {
			PerUserId : PerUserId
		},
		success : function( xhr ){
			Ext.Util(xhr).proc(function( data ){
				if( data.success == 1  ){
					Ext.Msg('Disable Campaign PerUser').Success();
					window.EventSearch();
				} 
				// jika process delete gagal 
				// keluarkan informasi ini.
				else {
					Ext.Msg('Disable Campaign PerUser').Failed();
					return;
				}
			});
		}
	}).post()	
	// console.log(dataURI);
 }  

/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
 
 window.EventEnable = function( dataURI ){
	var PerUserId =  Role.getValue().toString();
	if( PerUserId=='' ){
		Ext.Msg('Please select a row !').Info();
		return false;
	}
	
	var callBackMsg = Ext.Msg("Are you sure ?").Confirm();
	if( !callBackMsg ){
		return false;
	}
	// get data process on ajax 
	//console.log(Role.Url('Enable'));
	 Ext.Ajax
	({
		url   : Role.action('Enable'), 
		method : 'POST',
		param : {
			PerUserId : PerUserId
		},
		success : function( xhr ){
			Ext.Util(xhr).proc(function( data ){
				if( data.success == 1  ){
					Ext.Msg('Enable Campaign PerUser').Success();
					window.EventSearch();
				} 
				// jika process delete gagal 
				// keluarkan informasi ini.
				else {
					Ext.Msg('Enable Campaign PerUser').Failed();
					return;
				}
			});
		}
	}).post()	
	// console.log(dataURI);
 }  

		
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 
  window.EventDetail = function( MasterDataId )
{
	if( MasterDataId  == '' ){
		Ext.Msg("No Customers Selected !").Info();
		return false;
	}
	
	// push set data followup set = 1 
	var responseDataConn = window.EventSetFollowup( MasterDataId ); 
	if( !responseDataConn ){
		Ext.Msg('Sorry, Data On Followup by other User ').Info();
		return false;
	}
		
	// then will set not active menu process .	
	Ext.ActiveMenu().NotActive();
	Ext.ShowMenu( Role.Url('ContactDetail'), 
		Ext.System.view_file_name(),  {
		MasterDataId : MasterDataId,
		ControllerId : Role.ctrl()
	}); 	
	 
 }

		
</script>
	
<fieldset class="corner">
<?php echo form()->legend(lang(""), "fa-gear"); ?>
<div id="result_content_add" class="ui-widget-panel-form"> 
 <form name="frmPerUser">
	<div class="ui-widget-form-table-compact">
		<div class="ui-widget-form-row baris-1">
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('LB_Global_SearchBy'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell text_caption left"> <?php echo form()->field("CPU1", "input_text middle", "DataPerUser", null);?></div>
			 
			<div class="ui-widget-form-cell text_caption"><?php echo lang('CPU_UserGroup');?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell left"><?php echo form()->combo('CPU_UserGroup','select tolong',UserPrivilege(), _get_exist_session('CPU_UserGroup'));?></div>
		</div>
		
		<div class="ui-widget-form-row baris-2">
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('LB_Global_SearchBy'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell text_caption left"> <?php echo form()->field("CPU2", "input_text middle", "DataPerUser", null);?></div>
			
			<div class="ui-widget-form-cell text_caption right"><?php echo lang(array('CPU_UpdateTs'));?></div>
			<div class="ui-widget-form-cell center">:</div>
			<div class="ui-widget-form-cell left"> <?php echo form()->interval("CPU_UpdateTs", "input_text date","CPU_UpdateTs"); ?></div>
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
	
	
	
	
	
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

var Role = new Ext.Role("CallDisposition");
	Role.extend([
		{ title: " ", icon :"", event: "", key :'DS_CallId' } // if you have other extends event 
	]);
  


 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 
Ext.DOM.datas =  {
	DS_CallUserUpdateTs_start_date 	: "<?php printf( '%s', get_cokie_exist('DS_CallUserUpdateTs_start_date')); ?>",
	DS_CallUserUpdateTs_end_date 	: "<?php printf( '%s', get_cokie_exist('DS_CallUserUpdateTs_end_date')); ?>",
	DS1_filter_field 				: "<?php printf( '%s', get_cokie_exist('DS1_filter_field')); ?>",
	DS1_filter_value 				: "<?php printf( '%s', get_cokie_exist('DS1_filter_value')); ?>",
	DS2_filter_field 				: "<?php printf( '%s', get_cokie_exist('DS2_filter_field')); ?>", 
	DS2_filter_value 				: "<?php printf( '%s', get_cokie_exist('DS2_filter_value')); ?>",
	DS_CallUserGroup 				: "<?php printf( '%s', get_cokie_exist('DS_CallUserGroup')); ?>",
	order_by 						: "<?php printf( '%s', get_cokie_exist('order_by')); ?>",
	type 							: "<?php printf( '%s', get_cokie_exist('type')); ?>"
	
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
}

 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 window.EventAdd = function(){
	Ext.ShowMenu( Role.Url('AddDisposition'), 
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
 var frmFilterBy = Ext.Serialize("frmCalldisposition");
 frmFilterBy.Debuger();
	//console.log();
	Ext.EQuery.construct( navigation, Ext.Join([  
		frmFilterBy.Data() 
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
	Ext.Serialize('frmCalldisposition').Clear();
	window.EventSearch();
}
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
window.EventEdit = function(){
	var DS_CallId =  Role.getValue().toString();
	if( DS_CallId == ''){
		Ext.Msg('Please select a row !').Info();
		return false;
	}
	Ext.ShowMenu( Role.Url('EditDisposition'), 
		Ext.System.view_file_name(),  {
		ControllerId : Role.ctrl(),
		DS_CallId : DS_CallId
	}); 
}

/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
 
 window.EventDelete = function( dataURI ){
	var DS_CallId =  Role.getValue().toString();
	if( DS_CallId=='' ){
		Ext.Msg('Please select a row !').Info();
		return false;
	}
	
	var callBackMsg = Ext.Msg("Are you sure ?").Confirm();
	if( !callBackMsg ){
		return false;
	}
	// get data process on ajax 
	Ext.Ajax({
		url   : Role.action('DeleteDisposition'), 
		method : 'POST',
		param : {
			DS_CallId : DS_CallId
		},
		success : function( xhr ){
			Ext.Util(xhr).proc(function( data ){
				if( data.success == 1  ){
					Ext.Msg('Delete Call Status Group').Success();
					window.EventSearch();
				} 
				// jika process delete gagal 
				// keluarkan informasi ini.
				else {
					Ext.Msg('Delete Call Status Group').Failed();
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
 
  window.EventDetail = function( MasterDataId ) {
 }

		
</script>
	
<fieldset class="corner">
<?php echo form()->legend(lang(""), "fa-phone"); ?>
<div id="result_content_add" class="ui-widget-panel-form"> 
 <form name="frmCalldisposition">
	<div class="ui-widget-form-table-compact">
		<div class="ui-widget-form-row baris-1">
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('LB_Global_SearchBy'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell text_caption left"> <?php echo form()->field("DS1", "input_text middle", "UserCallDisposition", null);?></div>
			 
			<div class="ui-widget-form-cell text_caption"><?php echo lang('DS_CallUserGroup');?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell left"><?php echo form()->combo('DS_CallUserGroup','select tolong',UserPrivilege(), _get_exist_session('DS_CallUserGroup'));?></div>
		</div>
		
		<div class="ui-widget-form-row baris-2">
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('LB_Global_SearchBy'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell text_caption left"> <?php echo form()->field("DS2", "input_text middle", "UserCallDisposition", null);?></div>
			
			<div class="ui-widget-form-cell text_caption right"><?php echo lang(array('DS_CallUserUpdateTs'));?></div>
			<div class="ui-widget-form-cell center">:</div>
			<div class="ui-widget-form-cell left"> <?php echo form()->interval("DS_CallUserUpdateTs", "input_text date","DS_CallUserUpdateTs"); ?></div>
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
	
	
	
	
	
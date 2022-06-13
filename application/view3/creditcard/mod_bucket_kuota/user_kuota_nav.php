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

var Role = new Ext.Role("BucketKuota");
	Role.extend([
		{ title: " ", icon :"", event: "", key :'KuotaId' } // if you have other extends event 
	]);
  


 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
    
Ext.DOM.datas =  {
	BK_Kuota_UpdateTs_start_date : "<?php printf( '%s', get_cokie_exist('BK_Kuota_UpdateTs_start_date')); ?>",
	BK_Kuota_UpdateTs_end_date	 : "<?php printf( '%s', get_cokie_exist('BK_Kuota_UpdateTs_end_date')); ?>",
	BK1_filter_field : "<?php printf( '%s', get_cokie_exist('BK1_filter_field')); ?>",
	BK1_filter_value : "<?php printf( '%s', get_cokie_exist('BK1_filter_value')); ?>",
	BK2_filter_field : "<?php printf( '%s', get_cokie_exist('BK2_filter_field')); ?>", 
	BK2_filter_value : "<?php printf( '%s', get_cokie_exist('BK2_filter_value')); ?>",
	BK_Kuota_Group : "<?php printf( '%s', get_cokie_exist('BK_Kuota_Group')); ?>",
	order_by : "<?php printf( '%s', get_cokie_exist('order_by')); ?>",
	type : "<?php printf( '%s', get_cokie_exist('type')); ?>"
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
	Ext.ShowMenu( Role.Url('AddKuota'), 
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
 var frmFilterBy = Ext.Serialize("frmUserKuota");
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
	Ext.Serialize('frmUserKuota').Clear();
	window.EventSearch();
}
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
window.EventEdit = function(){
	var KuotaId =  Role.getValue().toString();
	if( KuotaId == ''){
		Ext.Msg('Please select a row !').Info();
		return false;
	}
	Ext.ShowMenu( Role.Url('EditKuota'), 
		Ext.System.view_file_name(),  {
		ControllerId : Role.ctrl(),
		KuotaId : KuotaId
	}); 
}

/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
 
 window.EventDelete = function( dataURI ){
	var KuotaId =  Role.getValue().toString();
	if( KuotaId=='' ){
		Ext.Msg('Please select a row !').Info();
		return false;
	}
	
	var callBackMsg = Ext.Msg("Are you sure ?").Confirm();
	if( !callBackMsg ){
		return false;
	}
	// get data process on ajax 
	var dataURI = Ext.EventUrl( new Array('BucketKuota','DeleteKuota') )
	Ext.Ajax({
		url   : dataURI.Apply(), 
		param : {
			KuotaId : KuotaId
		},
		success : function( xhr ){
			Ext.Util(xhr).proc(function( data ){
				if( data.success == 1  ){
					Ext.Msg('Delete User Kuota').Success();
					window.EventSearch();
				} 
				// jika process delete gagal 
				// keluarkan informasi ini.
				else {
					Ext.Msg('Delete User Kuota').Failed();
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
<?php echo form()->legend(lang(""), "fa-phone"); ?>
<div id="result_content_add" class="ui-widget-panel-form"> 
 <form name="frmUserKuota">
	<div class="ui-widget-form-table-compact">
		<div class="ui-widget-form-row baris-1">
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('LB_Global_SearchBy'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell text_caption left"> <?php echo form()->field("BK1", "input_text middle", "UserKuotaData", null);?></div>
			 
			<div class="ui-widget-form-cell text_caption"><?php echo lang('BK_Kuota_Group');?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell left"><?php echo form()->combo('BK_Kuota_Group','select tolong',UserSessionPrivilege(), _get_exist_session('BK_Kuota_Group'));?></div>
		</div>
		
		<div class="ui-widget-form-row baris-2">
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('LB_Global_SearchBy'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell text_caption left"> <?php echo form()->field("BK2", "input_text middle", "UserKuotaData", null);?></div>
			
			<div class="ui-widget-form-cell text_caption right"><?php echo lang(array('BK_Kuota_UpdateTs'));?></div>
			<div class="ui-widget-form-cell center">:</div>
			<div class="ui-widget-form-cell left"> <?php echo form()->interval("BK_Kuota_UpdateTs", "input_text date","BK_Kuota_UpdateTs"); ?></div>
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
	
	
	
	
	
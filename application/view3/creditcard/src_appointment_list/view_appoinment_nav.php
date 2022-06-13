<?php echo javascript(); ?>
<script type="text/javascript">
/* create object **/


Ext.document('document').ready( function(){
	Ext.Cmp('ui-widget-title').setText( Ext.System.view_file_name());
 }); 

//-----------------------------------------------------------------------

/*
 * modul  		 	method get User Role 
 *
 * @akses 			public & of run window  
 * @author 			uknown 
 */
 

var Role = new Ext.Role("SrcAppoinment");
	Role.extend([
		{ title: " ", icon :"", event: "", key :'AppoinmentId' } // if you have other extends event 
	]);
  
/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */

Ext.DOM.datas =   {
	CLBK1_filter_value		: "<?php printf('%s', get_cokie_exist('CLBK1_filter_value') );?>",
	CLBK1_filter_field		: "<?php printf('%s', get_cokie_exist('CLBK1_filter_field') );?>",
	CLBK2_filter_field		: "<?php printf('%s', get_cokie_exist('CLBK2_filter_field') );?>",
	CLBK2_filter_value		: "<?php printf('%s', get_cokie_exist('CLBK2_filter_value') );?>",
	CLBK_update_start_date	: "<?php printf('%s', get_cokie_exist('CLBK_update_start_date') );?>",
	CLBK_update_end_date	: "<?php printf('%s', get_cokie_exist('CLBK_update_end_date') );?>",
	CLBK_call_status		: "<?php printf('%s', get_cokie_exist('CLBK_call_status') );?>",
	CLBK_user_agent			: "<?php printf('%s', get_cokie_exist('CLBK_user_agent') );?>",
	CLBK_quality_status		: "<?php printf('%s', get_cokie_exist('CLBK_quality_status') );?>",
	order_by 				: "<?php printf('%s', get_cokie_exist('order_by'));?>",
	type	 				: "<?php printf('%s', get_cokie_exist('type'));?>"
	
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
	
	 $('.date').datepicker ({ showOn: 'button',  changeYear:true, changeMonth:true, buttonImage: Ext.Image("calendar.gif"),  buttonImageOnly: true,  dateFormat:'dd-mm-yy', readonly:true });
	 $('.select').chosen();
	 $('.date').css("width", "75px");
	
	 
});

/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
   
Ext.EQuery.TotalPage   = '<?php printf('%s', $page->_get_total_page()); ?>';
Ext.EQuery.TotalRecord = '<?php printf('%s', $page->_get_total_record()); ?>';
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
	// lepas aja ya Role.Url('SetFollowup')
	var callDataResponse = 0, row = Ext.Json( 
		new Array('SrcCustomerList','SetFollowup'), {
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
window.EventSearch = function() 
{
	$.cookie('selected',0)
	var frmCallbackLater = new Ext.Serialize("frmCallbackLater");
		frmCallbackLater.Debuger();

	Ext.EQuery.construct( navigation, Ext.Join(new Array(frmCallbackLater.Data() ) ).object() );
	Ext.EQuery.postContent();
}
		
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
window.EventClear = function() {
	Ext.Serialize('frmCallbackLater').Clear();
	window.EventSearch();
}

 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
  window.EventCallbackDetail = function( MasterDataId )
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
	Ext.ShowMenu( new Array('SrcCustomerList','ContactDetail'), 
		Ext.System.view_file_name(),  {
		MasterDataId : MasterDataId,
		ControllerId : Role.ctrl()
	}); 	
} 
/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
 window.EventDetail = function( AppoinmentId )  {
	 
	// lepas aja ya 
	var callDataResponse = 0, row = Ext.Json( Role.Url('Update'), {
		AppoinmentId : AppoinmentId
	});
	
	// return each data process .
	row.dataItemEach( function( item ){
		if( item.CustomerId ){
			window.EventCallbackDetail( item.CustomerId );
		}
	});
	
} 

 
</script>
	
<fieldset class="corner">
<?php echo form()->legend(lang(""), "fa-calendar"); ?>
<div id="result_content_add" class="ui-widget-panel-form"> 
 <form name="frmCallbackLater">
	<div class="ui-widget-form-table-compact">
		<div class="ui-widget-form-row baris-1">
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('LB_Global_SearchBy'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell text_caption left"> <?php echo form()->field("CLBK1", "input_text middle", "CallbackLaterFollowup", null);?></div>
				
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('DM_CallCategoryId'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell text_caption left"><?php echo form()->combo('CLBK_call_status','select tolong', AllCallStatus(), get_cokie_exist('CLBK_call_status'));?></div>
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang('DM_SellerId');?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell left"><?php echo form()->combo('CLBK_user_agent','select tolong',User(), get_cokie_exist('CLBK_user_agent'));?></div>
		</div>
		
		<div class="ui-widget-form-row baris-2">
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('LB_Global_SearchBy'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell text_caption left"> <?php echo form()->field("CLBK2", "input_text middle", "CallbackLaterFollowup", null);?></div>
			 
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('DM_QualityCategoryId'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell text_caption left"><?php echo form()->combo('CLBK_quality_status','select tolong', CallStatusDisposition(), get_cokie_exist('CLBK_quality_status'));?></div>
			
			<div class="ui-widget-form-cell text_caption right"><?php echo lang(array('AP_CallBackDateTime'));?></div>
			<div class="ui-widget-form-cell center">:</div>
			<div class="ui-widget-form-cell left"> <?php echo form()->interval("CLBK_update", "input_text date","CLBK_update"); ?></div>
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
	
	
	
	
	
	
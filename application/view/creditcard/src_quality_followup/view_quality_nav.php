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

var Role = new Ext.Role("QualityFollowup");
	Role.extend([
		{ title: " ", icon :"", event: "", key :'CustomerId' } // if you have other extends event 
	]);
  


 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
    
Ext.DOM.datas = 
 {
	QTY1_filter_field 		:"<?php printf('%s', get_cokie_exist('QTY1_filter_field'))?>",
	QTY1_filter_value 		:"<?php printf('%s', get_cokie_exist('QTY1_filter_value'))?>",
	QTY2_filter_field 		:"<?php printf('%s', get_cokie_exist('QTY2_filter_field'))?>",
	QTY2_filter_value 		:"<?php printf('%s', get_cokie_exist('QTY2_filter_value'))?>",
	QTY_call_status 		:"<?php printf('%s', get_cokie_exist('QTY_call_status'))?>",
	QTY_quality_status		:"<?php printf('%s', get_cokie_exist('QTY_quality_status'))?>",
	QTY_update_end_date 	:"<?php printf('%s', get_cokie_exist('QTY_update_end_date'))?>",
	QTY_update_start_date   :"<?php printf('%s', get_cokie_exist('QTY_update_start_date'))?>",
	QTY_user_agent			:"<?php printf('%s', get_cokie_exist('QTY_user_agent'))?>", 
	order_by 				:"<?php printf('%s', get_cokie_exist('order_by'));?>",
	type	 				:"<?php printf('%s', get_cokie_exist('type'));?>"
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
  
Ext.EQuery.TotalPage   = '<?php echo (int)$page -> _get_total_page(); ?>';
Ext.EQuery.TotalRecord = '<?php echo (int)$page -> _get_total_record(); ?>';
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
  
 window.EventQualityFollowup = function( CustomerId ) {
	// lepas aja ya 
	var callDataResponse = 0, row = Ext.Json( Role.Url('Followup'), {
		CustomerId : CustomerId
	});
	
	// return each data process .
	row.dataItemEach( function( item ){
		console.log( item.success )
		if( item.success ){
			callDataResponse++;
		} 
		else {
			Ext.Msg( window.sprintf("Data Sedang/Sudah Di Followup Oleh < %s >",item.UserId )).Info();
			return false;
		}
	});
	return callDataResponse;
}

//-----------------------------------------------------------------------

/*
 * modul  		 	Uplaod Template
 *
 * @akses 			public & of run window  
 * @author 			uknown 
 */
 window.EventSearch = function() 
{
 var frmFilterBy = Ext.Serialize("FrmCustomerCall").getElement();
	console.log(frmFilterBy);
	Ext.EQuery.construct( navigation, Ext.Join([  
		Ext.Serialize("FrmCustomerCall").getElement() 
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
	Ext.Serialize('FrmCustomerCall').Clear();
	window.EventSearch();
}

		
//-----------------------------------------------------------------------

/*
 * modul  		 	Uplaod Template
 *
 * @akses 			public & of run window  
 * @author 			uknown 
 */
 
  window.EventDetail = function( CustomerId )
{
	if( CustomerId  == '' ){
		Ext.Msg("No Customers Selected !").Info();
		return false;
	}
	
	// push set data followup set = 1 
	var responseDataConn = window.EventQualityFollowup( CustomerId ); 
	if( !responseDataConn ){
		return false;
	}
		
	// then will set not active menu process .	
	Ext.ActiveMenu().NotActive();
	Ext.ShowMenu( new Array('QualityDetail/index'), 
		Ext.System.view_file_name(),  {
		CustomerId : CustomerId,
		ControllerId : Role.ctrl()
	}); 	
	 
 }

		
</script>
	
<fieldset class="corner">
<?php echo form()->legend(lang(""), "fa-phone"); ?>
<div id="result_content_add" class="ui-widget-panel-form"> 
 <form name="FrmCustomerCall">
	<div class="ui-widget-form-table-compact">
		<div class="ui-widget-form-row baris-1">
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('LB_Global_SearchBy'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell text_caption left"> <?php echo form()->field("QTY1", "input_text middle", "QualityFollowup", null);?></div>
				
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('DM_CallCategoryId'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell text_caption left"><?php echo form()->combo('QTY_call_status','select tolong', AllCallStatus(), _get_exist_session('QTY_call_status'));?></div>
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang('DM_SellerId');?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell left"><?php echo form()->combo('QTY_user_agent','select tolong',User(), _get_exist_session('QTY_user_agent'));?></div>
		</div>
		
		<div class="ui-widget-form-row baris-2">
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('LB_Global_SearchBy'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell text_caption left"> <?php echo form()->field("QTY2", "input_text middle", "QualityFollowup", null);?></div>
			 
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('DM_QualityCategoryId'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell text_caption left"><?php echo form() -> combo('QTY_quality_status','select tolong', CallStatusDisposition(), _get_exist_session('QTY_quality_status'));?></div>
			
			<div class="ui-widget-form-cell text_caption right"><?php echo lang(array('DM_UpdatedTs'));?></div>
			<div class="ui-widget-form-cell center">:</div>
			<div class="ui-widget-form-cell left"> <?php echo form()->interval("QTY_update", "input_text date","QTY_update"); ?></div>
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
	
	
	
	
	
<?php echo javascript(); ?>

<script type="text/javascript">
	
//-----------------------------------------------------------------------

/*
 * modul  		 	Uplaod Template
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
 

var Role = new Ext.Role("SrcCustomerClosing");
	Role.extend([
		{ title: " ", icon :"", event: "", key :'CustomerId' } // if you have other extends event 
	]);
  

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
Ext.DOM.datas = {
	SEL1_filter_field			: "<?php printf('%s', get_cokie_exist('SEL1_filter_field') ); ?>",
	SEL1_filter_value			: "<?php printf('%s', get_cokie_exist('SEL1_filter_value') ); ?>",
	SEL2_filter_field			: "<?php printf('%s', get_cokie_exist('SEL2_filter_field') ); ?>",
	SEL2_filter_value			: "<?php printf('%s', get_cokie_exist('SEL2_filter_value') ); ?>",
	SEL_UpdateTs_start_date 	: "<?php printf('%s', get_cokie_exist('SEL_UpdateTs_start_date') ); ?>",
	SEL_UpdateTs_end_date		: "<?php printf('%s', get_cokie_exist('SEL_UpdateTs_end_date') ); ?>",
	SEL_CallKategoryId			: "<?php printf('%s', get_cokie_exist('SEL_CallKategoryId') ); ?>",
	SEL_AdmCategoryId			: "<?php printf('%s', get_cokie_exist('SEL_AdmCategoryId') ); ?>",
	SEL_QualityCategoryId		: "<?php printf('%s', get_cokie_exist('SEL_QualityCategoryId') ); ?>",
	order_by 		 			: "<?php printf('%s', get_cokie_exist('order_by') ); ?>",
	type	 		 			: "<?php printf('%s', get_cokie_exist('type') ); ?>"
	
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
	 $('.filter-ui-status')
	 
});
		
  
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
Ext.EQuery.TotalPage = "<?php printf('%d', $page->_get_total_page()); ?>";
Ext.EQuery.TotalRecord = "<?php printf('%d', $page->_get_total_record()); ?>";

				
		
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 	
Ext.DOM.navigation =  {
	custnav : Role.pageIndex(),
	custlist : Role.pageContent()	
}
		


		
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
Ext.EQuery.construct( Ext.DOM.navigation, Ext.DOM.datas )
Ext.EQuery.postContentList();


//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 Ext.DOM.SetSuspendUp = function( CustomerId )
{
	var data = Ext.Ajax
	({
		url 	: Ext.EventUrl(['SrcCustomerClosing','SuspendType']).Apply(),
		method  : 'POST',
		param	: {
			CustomerId : CustomerId
		}	
	}).json();
	
	return ( typeof ( data ) == 'object' ? data : {});
}


 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
 window.EventSetFollowup = function( MasterDataId ) {
	// lepas aja ya 
	var callDataResponse = 0, row = Ext.Json( Role.action('SetFollowup'), {
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
	var frmSellingData = Ext.Serialize("frmSellingData");
	//	frmSellingData.Debuger();
	$.cookie('selected', 0);
	Ext.EQuery.construct( navigation, Ext.Join( new Array( frmSellingData.Data() )).object() );
	Ext.EQuery.postContent();
}
	
	
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
 window.EventClear = function() {
	Ext.Serialize('frmSellingData').Clear();
	window.EventSearch();
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
<?php echo form()->legend(lang(""), "fa-check"); ?>
<div id="result_content_add" class="ui-widget-panel-form"> 
 <form name="frmSellingData">
	 <div class="ui-widget-form-table-compact">
		<div class="ui-widget-form-row baris-1">
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('LB_Global_SearchBy'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell text_caption left"> <?php echo form()->field("SEL1", "input_text middle", "SellingFollowup", null);?></div>
			
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang('DM_CallCategoryKode');?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell left"><?php echo form()->combo('SEL_CallKategoryId','select long',AllCallStatus(), get_cokie_exist('SEL_CallKategoryId'), null );?></div>
			

			<div class="ui-widget-form-cell text_caption"><?php echo lang('DM_AdmCategoryId');?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell left"><?php echo form()->combo('SEL_AdmCategoryId','select long',AllCallStatus(), get_cokie_exist('SEL_AdmCategoryId'));?></div>
		
		</div>
			
		<div class="ui-widget-form-row baris-1">
			
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('LB_Global_SearchBy'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell text_caption left"> <?php echo form()->field("SEL2", "input_text middle", "SellingFollowup", null);?></div>
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang('DM_QualityCategoryId');?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell left"><?php echo form()->combo('SEL_QualityCategoryId','select long',AllCallStatus(), get_cokie_exist('SEL_QualityCategoryId'));?></div>
		
		
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('DM_UpdatedTs'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell left"><?php echo form()->interval("SEL_UpdateTs", "input_text date","SEL_LastUpdateTs"); ?></div>
			
			
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

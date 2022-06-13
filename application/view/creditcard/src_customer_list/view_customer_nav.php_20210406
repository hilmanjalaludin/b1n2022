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

var Role = new Ext.Role("SrcCustomerList");
	Role.extend([
		{ title: " ", icon :"", event: "", key :'CustomerId' } // if you have other extends event 
	]);
  


 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
    
Ext.DOM.datas =  {
	MSD1_filter_field	: "<?php printf( '%s', ('c.CampaignCode'));	?>",
	MSD1_filter_value	: "<?php printf( '%s', get_cokie_exist('MSD1_filter_value'));	?>",
	MSD2_filter_field	: "<?php printf( '%s', get_cokie_exist('MSD2_filter_field'));	?>",
	MSD2_filter_value	: "<?php printf( '%s', get_cokie_exist('MSD2_filter_value'));	?>",
	MSD_call_start_date	: "<?php printf( '%s', get_cokie_exist('MSD_call_start_date'));	?>",
	MSD_call_end_date	: "<?php printf( '%s', get_cokie_exist('MSD_call_end_date'));	?>",
	MSD_call_category	: "<?php printf( '%s', get_cokie_exist('MSD_call_category'));	?>",
	MSD_user_agent		: "<?php printf( '%s', get_cokie_exist('MSD_user_agent'));		?>",
	MSD_last_category	: "<?php printf( '%s', get_cokie_exist('MSD_last_category'));	?>",
	order_by 			: "<?php printf( '%s', get_cokie_exist('order_by'));			?>",
	type	 			: "<?php printf( '%s', get_cokie_exist('type'));				?>"
}
 
//-----------------------------------------------------------------------

/*
 * modul  		 	Uplaod Template
 *
 * @akses 			public & of run window  
 * @author 			uknown 
 */
  
 window.EventOrder = function() {
	Ext.AutoCall( Role, { param : Ext.DOM.datas }).Utils.Init();
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

// $(document).ready(function() {
// 	$('#toolbars').extToolbars
// 	({
// 		extUrl    : Ext.DOM.LIBRARY+'/gambar/icon',
// 		extTitle  : [['Search'],['Clear'],['Start Dial']],
// 		extMenu   : [['EventSearch'],['EventClear'],['StartDial']],
// 		extIcon   : [['zoom.png'],['zoom_out.png'],['telephone_add.png']],
// 		extText   : true,
// 		extInput  : true,
// 		extOption : []
// 	});
// 	$('.select').chosen();
// 	$('.date').datepicker ({ showOn: 'button',  
// 			changeYear:true, changeMonth:true, 
// 			buttonImage: Ext.Image("calendar.gif"),  
// 			buttonImageOnly: true,  
// 			dateFormat:'dd-mm-yy', readonly:true });
// 	 $('.select').chosen();
// 	 $('.date').css("width", "75px");
//  });

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
  
 window.EventSearch = function() 
{
 var frmFilterBy = Ext.Serialize("FrmCustomerCall");
 frmFilterBy.Debuger();
	//console.log();
	Ext.EQuery.construct( navigation, Ext.Join([  
		frmFilterBy.Data() 
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
 
//  Ext.DOM.StartDial = function()
// {	
// 	Ext.Ajax 
// 	({
// 		url 	: Ext.DOM.INDEX+'/SrcCustomerList/getAutoCustomer',
// 		method  : 'POST',
// 		ERROR : function( e ){
// 			Ext.Util(e).proc(function(response)
// 			{
// 				MasterDataId = response.result;
				
// 				var responseDataConn = window.EventSetFollowup( MasterDataId ); 
// 				if( !responseDataConn ){
// 					Ext.Msg('Sorry, Data On Followup by other User ').Info();
// 					return false;
// 				}

// 				window.EventOrder();
// 				Ext.ActiveMenu().NotActive();
// 				Ext.ShowMenu( Role.Url('ContactDetail'), 
// 					Ext.System.view_file_name(),  {
// 					MasterDataId : response.result,
// 					ControllerId : Role.ctrl()
// 				}); 	

// 			});
// 		}
// 	}).post();
	
// }
 
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
	window.EventOrder();
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
 <form name="FrmCustomerCall">
	<div class="ui-widget-form-table-compact">
		<div class="ui-widget-form-row baris-1">
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('LB_Global_SearchBy'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell text_caption left"> <?php echo form()->field("MSD1", "input_text middle", "MasterFollowup", null);?></div>
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('DM_CallCategoryKode'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell text_caption left"><?php echo form()->combo('MSD_call_category','select tolong', AllCallStatus(), _get_exist_session('MSD_call_category'));?></div>
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang('DM_SellerId');?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell left"><?php echo form()->combo('MSD_user_agent','select tolong',User(), _get_exist_session('MSD_user_agent'));?></div>
		</div>
		
		<div class="ui-widget-form-row baris-2">
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('LB_Global_SearchBy'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell text_caption left"> <?php echo form()->field("MSD2", "input_text middle", "MasterFollowup", null);?></div>
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('DM_LastCategoryKode'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell text_caption left"><?php echo form()->combo('MSD_last_category','select tolong', AllCallStatus(), _get_exist_session('MSD_last_category'));?></div>
			
			<div class="ui-widget-form-cell text_caption right"><?php echo lang(array('DM_UpdatedTs'));?></div>
			<div class="ui-widget-form-cell center">:</div>
			<div class="ui-widget-form-cell left"> <?php echo form()->interval("MSD_call", "input_text date","MSD_call"); ?></div>
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
	
	
	
	
	
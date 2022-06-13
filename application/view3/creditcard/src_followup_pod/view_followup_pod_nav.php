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
 

var Role = new Ext.Role("SrcFollowupPod");
	Role.extend([
		{ title: " ", icon :"", event: "", key :'DM_Id' } // if you have other extends event 
	]);
  


//-----------------------------------------------------------------------

/*
 * modul  		 	method get User Role 
 *
 * @akses 			public & of run window  
 * @author 			uknown 
 */
 
Ext.DOM.datas = 
 {
	FO1_filter_field		: "<?php printf('%s', get_cokie_exist('FO1_filter_field'));?>",
	FO1_filter_value		: "<?php printf('%s', get_cokie_exist('FO1_filter_value'));?>", 
	FO2_filter_field		: "<?php printf('%s', get_cokie_exist('FO2_filter_field'));?>",
	FO2_filter_value		: "<?php printf('%s', get_cokie_exist('FO2_filter_value'));?>", 
	FO_UpdateTs_start_date	: "<?php printf('%s', get_cokie_exist('FO_UpdateTs_start_date'));?>",
	FO_UpdateTs_end_date	: "<?php printf('%s', get_cokie_exist('FO_UpdateTs_end_date'));?>", 
	FO_User_SellerId		: "<?php printf('%s', get_cokie_exist('FO_User_SellerId'));?>",
	FO_User_AdminId			: "<?php printf('%s', get_cokie_exist('FO_User_AdminId'));?>",
	FO_User_Quality			: "<?php printf('%s', get_cokie_exist('FO_User_Quality'));?>",
	order_by 				: "<?php printf('%s', get_cokie_exist('order_by'));?>",
	type	 			 	: "<?php printf('%s', get_cokie_exist('type'));?>"
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
	  $('.date').css({"width":"80px"});
	 
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
 
 window.EventSetFollowup = function( CustomerId )
{
	// default nilai data untuk process awal .
	var callDataPositionID = 0, 
		row  = Ext.Json( "SrcFollowupPod/Followup", {
		CustomerId : CustomerId
	});
	
	row.dataItemEach( function( item, data , xhr ){
		if( item.success == 1 )	{
			callDataPositionID++; 
		}
	});
	
	// return datacallback 
	return callDataPositionID;
	
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
 var frmFilterBy = Ext.Serialize("FrmFollowupPOD").getElement();
	console.log(frmFilterBy);
	Ext.EQuery.construct( navigation, Ext.Join([  
		Ext.Serialize("FrmFollowupPOD").getElement() 
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
	Ext.Serialize('FrmFollowupPOD').Clear();
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
	if( CustomerId =='' )  {
		 Ext.Msg("No Customers Selected !").Info();	
		return false;
	}
	
	// get response from server .
	var responseDataServer = window.EventSetFollowup( CustomerId );
	if( !responseDataServer )   {
		Ext.Msg('Sorry, Data On Followup by other User ').Info();
		return false;
	}
	
	// set not active menu ketika data sedang di followup 
	// then will go.
	
	Ext.ActiveMenu().NotActive();
	Ext.ShowMenu( new Array('AdminDetail','index'),  Ext.System.view_file_name(),  {
		DataDisAllowed : 0,
		CustomerId     : CustomerId,
		ControllerId   : Role.ctrl()
	});
	
 }
 
//-----------------------------------------------------------------------

/*
 * modul  		 	Uplaod Template
 *
 * @akses 			public & of run window  
 * @author 			uknown 
 */
 
 
 window.EventBarcode = function( Barcode )
{
	
}	
//-----------------------------------------------------------------------

/*
 * modul  		 	Uplaod Template
 *
 * @akses 			public & of run window  
 * @author 			uknown 
 */
 

 
 
</script>
	
<fieldset class="corner">
<?php echo form()->legend(lang(""), "fa-phone"); ?>
<div id="result_content_add" class="ui-widget-panel-form" style="margin-top:-10px;"> 
 <form name="FrmFollowupPOD">
	<div class="ui-widget-form-table-compact">
		<div class="ui-widget-form-row baris-1">
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('LB_Global_SearchBy'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell text_caption left"> <?php echo form()->field("FO1", "input_text middle", "AdminFollowupNav", null);?></div>
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('DM_SellerId'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell text_caption left"><?php echo form()->combo('FO_User_SellerId','select tolong', AllTelemarketing(),  get_cokie_exist('FO_User_SellerId'));?></div>
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('DM_AdmId'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell text_caption left"><?php echo form()->combo('FO_User_AdminId','select tolong', AdminFollowup(),  get_cokie_exist('FO_User_AdminId'));?></div>
			
			
		</div>
		
		<div class="ui-widget-form-row baris-2">
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('LB_Global_SearchBy'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell text_caption left"> <?php echo form()->field("FO2", "input_text middle", "AdminFollowupNav", null);?></div>
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('DM_QualityUserId'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell text_caption left"><?php echo form()->combo('FO_User_Quality','select tolong', QualityAllStaff(), get_cokie_exist('FO_User_Quality'));?></div>
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('DM_UpdatedTs'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell text_caption left"><?php echo form()->interval('FO_UpdateTs','input_text date', 'FO_UpdateTs');?></div>
		</div>
	</div>
	</form>
</div>

<div class="ui-widget-toolbars" id="toolbars"></div> 
<div class="content_table" id="ui-widget-content_table"></div>
<div class="ui-widget-pager" id="pager"></div>
<div class="ui-widget-component" id="ui-widget-component"></div>
</fieldset>	
		
	<!-- stop : content -->
	
	
	
	
	
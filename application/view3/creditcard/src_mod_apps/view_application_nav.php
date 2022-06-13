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
 

var Role = new Ext.Role("SrcApplication");
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
	FA1_filter_field		: "<?php printf('%s', get_cokie_exist('FA1_filter_field'));?>",
	FA1_filter_value		: "<?php printf('%s', get_cokie_exist('FA1_filter_value'));?>", 
	FA2_filter_field		: "<?php printf('%s', get_cokie_exist('FA2_filter_field'));?>",
	FA2_filter_value		: "<?php printf('%s', get_cokie_exist('FA2_filter_value'));?>", 
	FA_UpdateTs_start_date	: "<?php printf('%s', get_cokie_exist('FA_UpdateTs_start_date'));?>",
	FA_UpdateTs_end_date	: "<?php printf('%s', get_cokie_exist('FA_UpdateTs_end_date'));?>", 
	FA_User_SellerId		: "<?php printf('%s', get_cokie_exist('FA_User_SellerId'));?>",
	FA_User_AdminId			: "<?php printf('%s', get_cokie_exist('FA_User_AdminId'));?>",
	FA_User_Quality			: "<?php printf('%s', get_cokie_exist('FA_User_Quality'));?>",
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
	 $('.date').css("width","80px");
	 
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
	var data = Ext.Ajax
	({
		url 	: Ext.EventUrl(new Array('SrcCustomerList', 'SetFollowup')).Apply(),
		method  : 'POST',
		param	: {
			CustomerId : CustomerId
		}	
	}).json();
	
	return ( typeof ( data ) == 'object' ? data : {});
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
 var frmFilterBy = Ext.Serialize("FrmPrintPOD").getElement();
 console.log(Ext.Serialize("FrmPrintPOD").Debuger() );
	Ext.EQuery.construct( navigation, Ext.Join([  
		Ext.Serialize("FrmPrintPOD").getElement() 
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
	Ext.Serialize('FrmPrintPOD').Clear();
	window.EventSearch();
}

// buka window baru untuk Process approval Data Agar Ada Reason Di History 
// untuk di catat di loger "call_history"

window.EventApproval = function(){
	
// variable tambahan untuk di buka di window popup 
	
	var CustomerId  = Ext.Cmp('DM_Id').getValue(),
		WinUserName = Ext.Session('Username').getSession().toUpperCase(),
		WindowPopup = 1;
// open new window data 	
	
	Ext.Window ({
		name   		: 'winApprovalData',
		url    		: Role.action('Approval'),
		top			: 0,    left 	  : 0,
		scrollbars 	: 1,    resizable : 1,
		height 		: $(window).innerHeight(),  width  	  : 600,
		param  		: {
			CustomerId 	: CustomerId,
			WindowPopup : WindowPopup,
			Username	: WinUserName	
		}
	}).popup();
	// return new window 
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
		DataDisAllowed : 1,
		CustomerId     : CustomerId,
		ControllerId   : Role.ctrl()
	});
	
 }

</script>
	
<fieldset class="corner">
<?php echo form()->legend(lang(""), "fa-share-square-o"); ?>
<div id="result_content_add" class="ui-widget-panel-form" style="margin-top:-10px;"> 
 <form name="FrmPrintPOD">
	<div class="ui-widget-form-table-compact">
		<div class="ui-widget-form-row baris-1">
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('LB_Global_SearchBy'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell text_caption left"> <?php echo form()->field("FA1", "input_text middle", "AdminApprovalNav", null);?></div>
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('DM_SellerId'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell text_caption left"><?php echo form()->combo('FA_User_SellerId','select tolong', AllTelemarketing(),  get_cokie_exist('FA_User_SellerId'));?></div>
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('DM_AdmId'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell text_caption left"><?php echo form()->combo('FA_User_AdminId','select tolong', AdminFollowup(),  get_cokie_exist('FA_User_AdminId'));?></div>
			
			
		</div>
		
		<div class="ui-widget-form-row baris-2">
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('LB_Global_SearchBy'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell text_caption left"> <?php echo form()->field("FA2", "input_text middle", "AdminApprovalNav", null);?></div>
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('DM_QualityUserId'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell text_caption left"><?php echo form()->combo('FA_User_Quality','select tolong', QualityAllStaff(), get_cokie_exist('FA_User_Quality'));?></div>
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('DM_UpdatedTs'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell text_caption left"><?php echo form()->interval('FA_UpdateTs','input_text date', 'FA_UpdateTs');?></div>
			
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
	
	
	
	
	
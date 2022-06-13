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
 

var Role = new Ext.Role("SrcPrintPod");
	Role.extend([
		{ title: " ", icon :"", event: "", key :'PodId' } // if you have other extends event 
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
	 cust_agent_id_pod 		: "<?php echo _get_exist_session('cust_agent_id_pod');?>",
	 cust_campaign_pod 		: "<?php echo _get_exist_session('cust_campaign_pod');?>",
	 cust_doc_type_pod 		: "<?php echo _get_exist_session('cust_doc_type_pod');?>",
	 cust_id_pod 			: "<?php echo _get_exist_session('cust_id_pod');?>",
	 cust_name_pod 			: "<?php echo _get_exist_session('cust_name_pod');?>",
	 cust_recsource_pod 	: "<?php echo _get_exist_session('cust_recsource_pod');?>",
	 cust_ref_no_pod 		: "<?php echo _get_exist_session('cust_ref_no_pod');?>",	
	 cust_tujuan_kirim_pod 	: "<?php echo _get_exist_session('cust_tujuan_kirim_pod');?>",
	 cust_wilayah_pod 		: "<?php echo _get_exist_session('cust_wilayah_pod');?>",
	 
	 pickup_pod_end_date 	: "<?php echo _get_exist_session('pickup_pod_end_date');?>",
	 pickup_pod_start_date 	: "<?php echo _get_exist_session('pickup_pod_start_date');?>",
	 print_pod_end_date  	: "<?php echo _get_exist_session('print_pod_end_date');?>",
	 print_pod_start_date   : "<?php echo _get_exist_session('print_pod_start_date');?>",
	 write_pod_end_date     : "<?php echo _get_exist_session('write_pod_end_date');?>",
	 write_pod_start_date   : "<?php echo _get_exist_session('write_pod_start_date');?>",
	 
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
 console.log(frmFilterBy);
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

		
//-----------------------------------------------------------------------

/*
 * modul  		 	Uplaod Template
 *
 * @akses 			public & of run window  
 * @author 			uknown 
 */
 
  window.EventCustomer = function( CustomerId )
{
	if( CustomerId!='') 
	{	
		var response = window.EventSetFollowup( CustomerId );
		if( response.success == 1)  
		{
			Ext.ActiveMenu().NotActive();
			Ext.ShowMenu( Role.Url('ContactDetail'), 
				Ext.System.view_file_name(), 
			{
				CustomerId : CustomerId,
				ControllerId : Role.ctrl()
			}); 
			
		} else {
			Ext.Msg('Sorry, Data On Followup by other User ').Info();
		}	
	}
	else{ Ext.Msg("No Customers Selected !").Info(); }	
 }
	
	
//-----------------------------------------------------------------------

/*
 * modul  		 	Uplaod Template
 *
 * @akses 			public & of run window  
 * @author 			uknown 
 */
 
window.EventPrint = function( CustomerId )
{
	var WindowWidth = 925;
	var WindowHeight = $(window).height();
	var WindowScript = new Ext.Window 
	({
		url     	: Role.action('PreviewPod'), //Ext.EventUrl(new Array("SrcWritePod", "ActionWritePod")).Apply(), 
		name    	: 'WinPrintPod',
		height  	: (WindowHeight), 
		width   	: ((WindowWidth)),  
		left    	: ($(window).width()/2),
		top	    	: ($(window).height()/2),
		resizable	: 1,
		scrollbars	: 1,
		param   	: {
			CustomerId : CustomerId
		}
	}).popup();	
}

</script>
	
<fieldset class="corner">
<?php echo form()->legend(lang(""), "fa-print"); ?>
<div id="result_content_add" class="ui-widget-panel-form"> 
 <form name="FrmPrintPOD">
	<div class="ui-widget-form-table-compact">
		<div class="ui-widget-form-row baris-1">
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Campaign ID'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell text_caption left"><?php echo form() -> combo('cust_campaign_pod','select tolong', Campaign(), _get_exist_session('cust_campaign_pod'));?></div>
			
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang('Reff. POD');?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell left"><?php echo form() -> input('cust_ref_no_pod', 'input_text tolong',_get_exist_session('cust_ref_no_pod')) ?></div>
			
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Customer Name'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell left"><?php echo form() -> input('cust_name_pod','input_text tolong', _get_exist_session('cust_name_pod'));?></div>
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang('Jenis Dokument');?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell left"><?php echo form() -> combo('cust_doc_type_pod','select tolong',EventDokument(), _get_exist_session('cust_doc_type_pod'));?></div>
		</div>
		
		<div class="ui-widget-form-row baris-2">
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Recsource'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell text_caption left"><?php echo form() -> combo('cust_recsource_pod','select tolong', Recsource(),  _get_exist_session('cust_recsource_pod'));?></div>
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Customer ID'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell text_caption left"><?php echo form() -> input('cust_id_pod','input_text tolong',  _get_exist_session('cust_id_pod'));?></div>
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Wilayah'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell text_caption left"><?php echo form() -> combo('cust_wilayah_pod','select tolong', EventWilayah(), _get_exist_session('cust_wilayah_pod'));?></div>
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang('Agent ID');?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell left"><?php echo form() -> combo('cust_agent_id_pod','select tolong',User(), _get_exist_session('cust_agent_id_pod'));?></div>
		</div>
		
		
		<div class="ui-widget-form-row baris-3">
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Tujuan Kirim'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell text_caption left"><?php echo form() -> combo('cust_tujuan_kirim_pod','select tolong', EventBillSender(),  _get_exist_session('cust_tujuan_kirim_pod'));?></div>
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('PickUp Date'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell left"> <?php echo form()->interval("pickup_pod", "input_text date","pickup_pod"); ?></div>
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('POD Date'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>			
			<div class="ui-widget-form-cell left"> <?php echo form()->interval("write_pod", "input_text date","write_pod"); ?></div>
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang('Print Date');?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell left"> <?php echo form()->interval("print_pod", "input_text date","print_pod"); ?></div>
			
			
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
	
	
	
	
	
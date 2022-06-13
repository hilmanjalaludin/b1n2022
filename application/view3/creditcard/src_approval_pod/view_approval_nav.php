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
 

var Role = new Ext.Role("SrcApprovalPod");
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
	 aprv_agent_id_pod 				: "<?php echo _get_exist_session('aprv_agent_id_pod');?>",
	 aprv_campaign_pod 				: "<?php echo _get_exist_session('aprv_campaign_pod');?>",
	 aprv_doc_type_pod 				: "<?php echo _get_exist_session('aprv_doc_type_pod');?>",
	 aprv_id_pod 					: "<?php echo _get_exist_session('aprv_id_pod');?>",
	 aprv_name_pod 					: "<?php echo _get_exist_session('aprv_name_pod');?>",
	 aprv_recsource_pod 			: "<?php echo _get_exist_session('aprv_recsource_pod');?>",
	 aprv_ref_no_pod 				: "<?php echo _get_exist_session('aprv_ref_no_pod');?>",	
	 aprv_tujuan_kirim_pod 			: "<?php echo _get_exist_session('aprv_tujuan_kirim_pod');?>",
	 aprv_wilayah_pod 				: "<?php echo _get_exist_session('aprv_wilayah_pod');?>",
	 
	 aprv_pickup_pod_end_date 		: "<?php echo _get_exist_session('aprv_pickup_pod_end_date');?>",
	 aprv_pickup_pod_start_date 	: "<?php echo _get_exist_session('aprv_pickup_pod_start_date');?>",
	 aprv_print_pod_end_date  		: "<?php echo _get_exist_session('aprv_print_pod_end_date');?>",
	 aprv_print_pod_start_date   	: "<?php echo _get_exist_session('aprv_print_pod_start_date');?>",
	 aprv_write_pod_end_date     	: "<?php echo _get_exist_session('aprv_write_pod_end_date');?>",
	 aprv_write_pod_start_date   	: "<?php echo _get_exist_session('aprv_write_pod_start_date');?>",
	 
	 order_by 						: "<?php echo _get_exist_session('order_by');?>",
	 type	 						: "<?php echo _get_exist_session('type');?>"
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
 
window.EventApprove = function( CustomerId )
{
	Ext.Ajax
	({
		url 	: Role.action('EventApprovePod'),
		method  : 'POST',
		param	: {
			CustomerId : CustomerId
		},
		ERROR 	: function( e ){
			Ext.Util( e ).proc(function( data ){
				if( data.success == 1 ){
					Ext.Msg("Approve POD ").Success();
					window.EventSearch();
				} else {
					Ext.Msg("Approve POD ").Failed();
				}
			})
		}	
	}).post();
}
		
//-----------------------------------------------------------------------

/*
 * modul  		 	Uplaod Template
 *
 * @akses 			public & of run window  
 * @author 			uknown 
 */
 
  window.EventReject = function( CustomerId )
{
	 Ext.Ajax
	({
		url 	: Role.action('EventRejectPod'),
		method  : 'POST',
		param	: {
			CustomerId : CustomerId
		},
		ERROR 	: function( e ){
			Ext.Util( e ).proc(function( data ){
				if( data.success == 1 ){
					Ext.Msg("Reject POD ").Success();
					window.EventSearch();
				} else {
					Ext.Msg("Reject POD ").Failed();
				}
			})
		}	
	}).post();
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
	var WindowWidth = 500;
	var WindowHeight = $(window).height();
	var WindowScript = new Ext.Window 
	({
		url     	: Ext.EventUrl(new Array("SrcWritePod", "ActionWritePod")).Apply(), 
		name    	: 'WinWritePod',
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
<?php echo form()->legend(lang(""), "fa-check"); ?>
<div id="result_content_add" class="ui-widget-panel-form"> 
 <form name="FrmPrintPOD">
	<div class="ui-widget-form-table-compact">
		<div class="ui-widget-form-row baris-1">
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Campaign ID'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell text_caption left"><?php echo form() -> combo('aprv_campaign_pod','select tolong', Campaign(), _get_exist_session('aprv_campaign_pod'));?></div>
			
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang('Reff. POD');?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell left"><?php echo form() -> input('aprv_ref_no_pod', 'input_text tolong',_get_exist_session('aprv_ref_no_pod')) ?></div>
			
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Customer Name'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell left"><?php echo form() -> input('aprv_name_pod','input_text tolong', _get_exist_session('aprv_name_pod'));?></div>
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang('Jenis Dokument');?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell left"><?php echo form() -> combo('aprv_doc_type_pod','select tolong',EventDokument(), _get_exist_session('aprv_doc_type_pod'));?></div>
		</div>
		
		<div class="ui-widget-form-row baris-2">
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Recsource'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell text_caption left"><?php echo form() -> combo('aprv_recsource_pod','select tolong', Recsource(),  _get_exist_session('aprv_recsource_pod'));?></div>
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Customer ID'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell text_caption left"><?php echo form() -> input('aprv_id_pod','input_text tolong',  _get_exist_session('aprv_id_pod'));?></div>
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Wilayah'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell text_caption left"><?php echo form() -> combo('aprv_wilayah_pod','select tolong', EventWilayah(), _get_exist_session('aprv_wilayah_pod'));?></div>
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang('Agent ID');?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell left"><?php echo form() -> combo('aprv_agent_id_pod','select tolong',User(), _get_exist_session('aprv_agent_id_pod'));?></div>
		</div>
		
		
		<div class="ui-widget-form-row baris-3">
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Tujuan Kirim'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell text_caption left"><?php echo form() -> combo('aprv_tujuan_kirim_pod','select tolong', EventBillSender(),  _get_exist_session('aprv_tujuan_kirim_pod'));?></div>
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('PickUp Date'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell left"> <?php echo form()->interval("aprv_pickup_pod", "input_text date","aprv_pickup_pod"); ?></div>
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('POD Date'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>			
			<div class="ui-widget-form-cell left"> <?php echo form()->interval("aprv_write_pod", "input_text date","aprv_write_pod"); ?></div>
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang('Print Date');?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell left"> <?php echo form()->interval("aprv_print_pod", "input_text date","print_pod"); ?></div>
			
			
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
	
	
	
	
	
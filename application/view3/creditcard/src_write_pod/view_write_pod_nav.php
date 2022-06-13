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
 

var Role = new Ext.Role("SrcWritePod");
	Role.extend([
		{ title: " ", icon :"", event: "", key :'CustomerId' } // if you have other extends event 
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
	wp_call_start_date    : "<?php echo _get_exist_session('wp_call_start_date');?>", 
	wp_call_end_date      : "<?php echo _get_exist_session('wp_call_end_date');?>",	
	wp_campaign_id 		  : "<?php echo _get_exist_session('wp_campaign_id');?>",
	wp_cust_name 		  : "<?php echo _get_exist_session('wp_cust_name');?>",
	wp_cust_source 		  : "<?php echo _get_exist_session('wp_cust_source');?>",
	wp_user_agent 		  : "<?php echo _get_exist_session('wp_user_agent');?>",
	wp_cust_id 			  : "<?php echo _get_exist_session('wp_cust_id');?>",
	wp_cust_call_category : "<?php echo _get_exist_session('wp_cust_call_category');?>",
	wp_cust_call_status   : "<?php echo _get_exist_session('wp_cust_call_status');?>",
	order_by 			  : "<?php echo _get_exist_session('order_by');?>",
	type	 			  : "<?php echo _get_exist_session('type');?>"
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
 var frmFilterBy = Ext.Serialize("FrmCustomerCall").getElement();
	console.log( frmFilterBy );
	
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
	
		
</script>
	
<fieldset class="corner">
<?php echo form()->legend(lang(""), "fa-pencil-square-o"); ?>
<div id="result_content_add" class="ui-widget-panel-form"> 
 <form name="FrmCustomerCall">
	<div class="ui-widget-form-table-compact">
		<div class="ui-widget-form-row baris-1">
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Campaign ID'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell text_caption left"><?php echo form() -> combo('wp_campaign_id','select tolong', Campaign(), _get_exist_session('wp_campaign_id'));?></div>
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang('Customer ID');?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell left"><?php echo form() -> input('wp_cust_id', 'input_text tolong',_get_exist_session('wp_cust_id')) ?></div>
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Call Category'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell text_caption left"><?php echo form() -> combo('wp_cust_call_category','select tolong', OutboundCategory(), _get_exist_session('wp_cust_call_category'));?></div>
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang('Agent ID');?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell left"><?php echo form() -> combo('wp_user_agent','select tolong',User(), _get_exist_session('wp_user_agent'));?></div>
			
		</div>
		
		<div class="ui-widget-form-row baris-2">
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Recsource'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell text_caption left"><?php echo form() -> combo('wp_cust_source','select tolong', Recsource(),  _get_exist_session('wp_cust_source'));?></div>
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Customer Name'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell left"><?php echo form() -> input('wp_cust_name','input_text tolong', _get_exist_session('wp_cust_name'));?></div>
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Call Status'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell text_caption left"><?php echo form() -> combo('wp_cust_call_status','select tolong', CallResultWritePod(), _get_exist_session('wp_cust_call_status'));?></div>
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Call','Date'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell text_caption left"> <?php echo form()->interval("wp_call", "input_text date","wp_call"); ?></div>
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
	
	
	
	
	
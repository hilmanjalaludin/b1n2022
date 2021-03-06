<?php echo javascript(); ?>
<script type="text/javascript">
var OUTBOUND = 2;
/**
 ** javscript prototype system
 ** version v.0.1
 **/
 
Ext.DOM.onload = (function(){
	Ext.Cmp('ui-widget-title').setText( Ext.System.view_file_name());
 })();
 
/**
 ** javscript prototype system
 ** version v.0.1
 **/
 
var status_campaign = '<?php echo _get_post("status_campaign"); ?>';


// ----------------------------------------------------------------

 
Ext.DOM.datas = { 
	CampaignName 	 : "<?php echo _get_exist_session('CampaignName');?>",
	CampaignStatus	 : "<?php echo _get_exist_session('CampaignStatus');?>",
	Direction		 : "<?php echo _get_exist_session('Direction');?>",
	EndExpiredDate	 : "<?php echo _get_exist_session('EndExpiredDate');?>",
	StartExpiredDate : "<?php echo _get_exist_session('StartExpiredDate');?>",
	order_by  		 : "<?php echo _get_exist_session('order_by');?>",
	type 			 : "<?php echo _get_exist_session('type');?>"
}


// ----------------------------------------------------------------
 
Ext.EQuery.TotalPage   = '<?php echo $page -> _get_total_page(); ?>';
Ext.EQuery.TotalRecord = '<?php echo $page -> _get_total_record(); ?>';

// ----------------------------------------------------------------
Ext.DOM.navigation = {
	custnav	 : Ext.DOM.INDEX+'/SetCampaign/index/',
	custlist : Ext.DOM.INDEX+'/SetCampaign/Content/',
}



// ----------------------------------------------------------------
Ext.DOM.getDataInbound = function(Campaign)
{
	Ext.Ajax
	({
		url		: Ext.DOM.INDEX+'/SetCampaign/getDataInbound/',
		method  : 'GET',
		param	: { 
			CampaignId :  Campaign.value
		},
		
		ERROR : function(e){
			Ext.Util(e).proc(function(counter){
				Ext.Cmp('total_data').setValue(counter.data);
				Ext.Cmp('assign_data').setValue(0);
				Ext.Cmp('total_data').disabled(true);
			});
		}
	}).post();
}
		

// ----------------------------------------------------------------

 
Ext.EQuery.construct(Ext.DOM.navigation,Ext.DOM.datas)
Ext.EQuery.postContentList();


// ----------------------------------------------------------------

Ext.DOM.CampaignType = function( CampaignId ){
	var INBOUND = ( Ext.Ajax
	({
		url 	: Ext.DOM.INDEX +'/MgtAssignment/CampaignType',

		method 	: 'POST',
		param 	: {
			CampaignId : CampaignId
		}	
	}).json());
	
	return INBOUND;
}


/*
 * @ def	 : function ready 
 * 
 * @ params	 : method on ready pages 
 * @ package : bucket datas 
 */
 
Ext.DOM.Manage = function()
{
	if( Ext.Cmp('CampaignId').getValue().length > 0 )
	{
		if( Ext.DOM.CampaignType(Ext.Cmp('check_list_cmp').getValue()).type != OUTBOUND ) 
		{
			Ext.System.view_name_url("Manage Inbound to Outbound ");
			Ext.Ajax ({
				url		: Ext.DOM.INDEX+'/ManageInboundOutbound/index/',
				method  : 'GET',
				param	: { 
					CampaignId : Ext.Cmp('check_list_cmp').getValue()
				}
			
			}).load("main_content");
		}
		else{
			Ext.Msg("Avalaible for Inbound Only ").Info();
		}	
	}
	else{
		Ext.Msg("Please select rows").Info();
	}
}
		
// ----------------------------------------------------------------
 
 Ext.DOM.BucketData = function()
 {
	Ext.ShowMenu(new Array("MgtBucket"), 
		Ext.System.view_file_name(),
	{
		time : Ext.Date().getDuration()	
	});
}	
	

		
/* 
 * @ assign show list content 
 * @ extends jequery modul
 */
Ext.DOM.cleanListBox = function (fo, to) {		
	var fo_l;
	var to_l = to.length;

	// alert('fol '+fo_l);

	for (var i = to_l - 1; i >= 0; i--) {
		fo_l = fo.length;

		for (var j = fo_l - 1; j >= 0; j--) {
			if (fo.options[j].text == to.options[i].text) 
				{ fo.options[j]=null; };
		}
	}
}

/* 
 * @ assign show list content 
 * @ extends jequery modul
 */
 
Ext.DOM.preListBox = function () 
{
	var fo = Ext.Cmp('ProductId').getElementId();
	var to = Ext.Cmp('ListProduct').getElementId();
	Ext.DOM.cleanListBox(fo,to);
	 fo = Ext.Cmp('PaymentChannel').getElementId();
	 to = Ext.Cmp('ListPaymentChannel').getElementId();
	Ext.DOM.cleanListBox(fo,to);
}

/* 
 * @ assign show list content 
 * @ extends jequery modul
 */
Ext.DOM.ExportExcel = function()
{
	var CampaignId = Ext.Cmp('CampaignId').getChecked();
	if( CampaignId!='' )
	{
		Ext.Window
		({
			url : Ext.DOM.INDEX +'/SetCampaign/Export/',
			param :{
				CampaignId : CampaignId
			}	
		}).newtab();
	}
	else{
		Ext.Msg('Please Select Campaign').Info();
	}	
}		
// **** 

Ext.DOM.ShowRowData = function()
{
 var CampaignId = Ext.Cmp('CampaignId').getChecked();
 if( CampaignId!='' )
	{
		Ext.Window
		({
			url : Ext.DOM.INDEX +'/SetCampaign/View/',
			param :{
				CampaignId : CampaignId
			}	
		}).newtab();
	}
	else{
		Ext.Msg('Please Select Campaign').Info();
	}	
}

Ext.DOM.viewCampaign = function(){
	var status_campaign = Ext.Cmp('combo_filter_campaign').getValue();
	if( status_campaign )
	{
		datas = { status_campaign: status_campaign }
		Ext.EQuery.construct(navigation,datas)
		Ext.EQuery.postContent();
	}	
}
		
//cancel
		
Ext.DOM.cancel = function(){
	Ext.Cmp('span_top_nav').setText('');
}


// -------------------------------------------------------------------
// -------------------------------------------------------------------

 Ext.DOM.Add = function()
{
   Ext.ShowMenu(new Array('SetCampaign','Add'), 
	  Ext.System.view_file_name(), {
		time : Ext.Date().getDuration()
   });
}


// -------------------------------------------------------------------
// -------------------------------------------------------------------
		
Ext.DOM.Edit = function()
{
  var CampaignId =Ext.Cmp('CampaignId').getValue();
  if( CampaignId == '' ){
	Ext.Msg("Please select a rows ").Info();
	return false;
  }	 
  Ext.ShowMenu(new Array('SetCampaign','Edit'), 
	Ext.System.view_file_name(), {	
		CampaignId : CampaignId 
  });
}	

// -------------------------------------------------------------------
// -------------------------------------------------------------------

 Ext.DOM.EditTarget = function()
{
  var CampaignId =Ext.Cmp('CampaignId').getValue();
  if( CampaignId == '' ){
	 Ext.Msg("Please select a rows ").Info();
	 return false;
  }	 
  Ext.ShowMenu(new Array('SetCampaign','EditTarget'), 
	Ext.System.view_file_name(), {	
		CampaignId : CampaignId 
  });
  
}	


// --------------------------------------------------------------
// SaveProcess

Ext.DOM.SaveProcess = function(){
	if( Ext.Cmp('InboundCampaignId').empty())
	{
		Ext.Msg("Inbound Campaign is empty!").Info();
		Ext.Cmp("InboundCampaignId").setFocus(); }
	else if( Ext.Cmp('OutboundCampaignId').empty())
	{
		Ext.Msg("Outbound Campaign is empty!").Info();
		Ext.Cmp("OutboundCampaignId").setFocus();}
	else if( Ext.Cmp('total_data').empty())
	{
		Ext.Msg("Total Data!").Info();
		Ext.Cmp("total_data").setFocus();}
	else if( Ext.Cmp('assign_data').empty())
	{
		Ext.Msg("Assign Data!").Info();
		Ext.Cmp("assign_data").setFocus();}	
	else if( Ext.Cmp('ActionType').empty())
	{
		Ext.Msg("Action Type!").Info();
		Ext.Cmp("ActionType").setFocus(); }
	else{
		Ext.Ajax
		({
			url 	: Ext.DOM.INDEX+'/SetCampaign/ManageCampaign/',
			method 	: 'POST',
			param 	: {
				InboundCampaignId : Ext.Cmp('InboundCampaignId').getValue(),
				OutboundCampaignId : Ext.Cmp('OutboundCampaignId').getValue(),
				TotalData : Ext.Cmp('total_data').getValue(),
				AssignData : Ext.Cmp('assign_data').getValue(),
				DirectAction : Ext.Cmp('ActionType').getValue()
			},
			ERROR : function(e){
				Ext.Util(e).proc(function(process){
					if( process.success==1){
						Ext.DOM.getDataInbound( { value : InboundCampaignId });
						Ext.Msg("Assign data, Count ( "+ process.data +")").Success();
					}
					else{
						Ext.Msg("Assign data").Failed();
					}
				});
			}
			
		}).post();
	}
}

// ----------------------------------------------------------------

Ext.DOM.Search = function(){
	Ext.EQuery.construct(Ext.DOM.navigation,Ext.Join([
		Ext.Serialize('FrmCampaignSetup').getElement()
	]).object() );
	Ext.EQuery.postContent();
}
// ----------------------------------------------------------------
Ext.DOM.Clear = function(){
	Ext.Serialize('FrmCampaignSetup').Clear()
	Ext.DOM.Search();
}

// ----------------------------------------------------------------
// ----------------------------------------------------------------

 Ext.DOM.Delete = function()
{
	
 var CampaignId = Ext.Cmp("CampaignId").getValue();
 if( CampaignId.length == 0 ){
	Ext.Msg("Please select a rows ").Info();	
	return false;
 }	
 
  var conds = Ext.Msg("Are you sure ?").Confirm();
  if(  conds ) {
	  Ext.Ajax 
	 ({
		url 	: Ext.EventUrl(["SetCampaign","Delete"]).Apply(),
		method 	: 'POST',
		param 	: {
			CampaignId : CampaignId
		},
		ERROR : function( e )
		{
			Ext.Util(e).proc(function( response ){
				if( response.success  ){
					Ext.Msg("Delete Campaign").Success();
					Ext.EQuery.postContent();
				} else {
					Ext.Msg("Delete Campaign").Failed();
					return false;
				}
			});	
		}
	 }).post();
  }
}

// ----------------------------------------------------------------

 $(document).ready(function()
 {
	$('#toolbars').extToolbars({
		extUrl   : Ext.DOM.LIBRARY+'/gambar/icon',
		extTitle :[['Search'],['Clear'],['Add'],['Edit'],['Delete'],['Edit Target'],['Bucket Data'],['Inbound to Outbound'],['Detail Data'],['Export']],
		extMenu  :[['Search'],['Clear'],['Add'],['Edit'],['Delete'],['EditTarget'],['BucketData'],['Manage'],['ShowRowData'],['ExportExcel']],
		extIcon  :[['zoom.png'],['cancel.png'],['add.png'],['application_form_edit.png'],['delete.png'],['application_form_edit.png'],['database_go.png'],['table_go.png'],['table_go.png'],['page_white_excel.png']],
		extText  :true,
		extInput :true,
		extOption:[]
	});	
	
	$('.date').datepicker({  showOn: 'button',  buttonImage: Ext.DOM.LIBRARY+'/gambar/calendar.gif',  buttonImageOnly: true,  dateFormat:'dd-mm-yy', readonly:true, changeYear:true, changeMonth:true  });
	$('.select').chosen();	
	
});

</script>
	
<!-- start : content -->
<fieldset class="corner">
<?php echo form()->legend(lang(""), "fa-gear"); ?>
 <div id="result_content_add" class="ui-widget-panel-form"> 
	<form name="FrmCampaignSetup">
	<div class="ui-widget-table-compact">
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Campaign Name'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->input("CampaignName", "input_text superlong", _get_exist_session('CampaignName') );?></div>
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Direction'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo("Direction", "select superlong", CallDirection(), _get_exist_session('Direction') );?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Campaign Status'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo("CampaignStatus", "select superlong", Flags(), _get_exist_session('CampaignStatus') );?></div>
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Expired Date'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell">
				<?php echo form()->input("StartExpiredDate", "input_text date",_get_exist_session('StartExpiredDate') );?>
				<?php echo form()->input("EndExpiredDate", "input_text date",_get_exist_session('EndExpiredDate') );?>
			</div>
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
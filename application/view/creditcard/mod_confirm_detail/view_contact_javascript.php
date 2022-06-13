<script>
/* 
 * @ def : toolbars on navigation 
 * ------------------------------------------
 *
 * @ param : no define
 * @ aksess : procedure  
 */
 
var reason = [];
var AgentScript = { };


/* 
 * @ def : toolbars on navigation 
 * ------------------------------------------
 *
 * @ param : no define
 * @ aksess : procedure  
 */
 
 Ext.DOM.Play  = function( RecordId ) 
 {
	var WinUrl  = new Ext.EventUrl([ "QtyApprovalInterest",  "VoicePlay"]), WinHeight = 100;
	var WinPlay = new Ext.Window
	({
		url    : WinUrl.Apply(),
		name   : 'winplay',
		top    : 0,
		left   : $(window).width(),  
		width  : ($(window).width()/2),
		height : (($(window).height()/2) - WinHeight),
		param  :  {
			RecordId : RecordId
		} 
	});
	
	WinPlay.popup();
	
 }
 

// -----------------------------------------------------------

/* 
 * Method 		AddUser 
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
 
 Ext.DOM.PageCallRecording = function( obj )
{
	var CustomerId = Ext.Cmp('CustomerId').getValue();
	Ext.Ajax 
	({
		url    : Ext.EventUrl(['ModCallHistory','PageCallRecording']).Apply(),
		method : 'GET',
		param  : {
			CustomerId 	: CustomerId,
			page 		: obj.page,
			orderby 	: obj.orderby,
			type 		: obj.type
		}
	}).load('tabs-2');
}

//-------------------------------------------------------------------------------------- 
/*  
 * @ pack 			reset on followup data  
 *
 */
 
 Ext.DOM.UnsetFollowup = function( CustomerId )
{
	var data = Ext.Ajax
	({
		url 	: Ext.EventUrl(['SrcCustomerList','UnsetFollowup']).Apply(),
		method  : 'POST',
		param	: {
			CustomerId : CustomerId
		}	
	}).json();
	
	return ( typeof ( data ) == 'object' ? data : {});
} 


//-------------------------------------------------------------------------------------- 
/*  
 * @ pack 			reset on followup data  
 *
 */

 
Ext.DOM.initFunc = 
{ 
	validParam 	: false,
	isCallPhone : false,
	isRunCall 	: false,
	isHangup 	: false,
	isCancel 	: true,
	isSave 		: false,
	isDial	: false	
}

/* 
 * @ def : toolbars on navigation 
 * ------------------------------------------
 *
 * @ param : no define
 * @ aksess : procedure  
 */
 
Ext.DOM.DisabledActivity = function() {
	$('.ui-disabled').each(function(){
		Ext.Cmp( $(this).attr('id') ).disabled(true);
	});
}

/* 
 * @ def : ShowWindowScript
 * ------------------------------------------
 *
 * @ param : no define
 * @ aksess : procedure  
 */

Ext.DOM.ShowWindowScript = function(ScriptId)
{
	var WindowScript = new Ext.Window ({
			url    : Ext.DOM.INDEX +'/SetProductScript/ShowProductScript/',
			name    : 'WinProduct',
			height  : (Ext.Layout(window).Height()),
			width   : (Ext.Layout(window).Width()),
			left    : (Ext.Layout(window).Width()/2),
			top	    : (Ext.Layout(window).Height()/2),
			param   : {
				ScriptId : Ext.BASE64.encode(ScriptId),
				Time	 : Ext.Date().getDuration()
			}
		}).popup();
		
	if( ScriptId =='' ) {
		window.close();
	}
}


 /* 
 * @ def : toolbars on navigation 
 * ------------------------------------------
 *
 * @ param : no define
 * @ aksess : procedure  
 */
window.EventCall = function()
{
 if( (Ext.DOM.initFunc.isDial==false ) )
 {
	ExtApplet.setData({   
		Phone : Ext.Cmp("CallingNumber").getValue(), 
		CustomerId  : Ext.Cmp("CustomerId").getValue() 
	}).Call();
	
	Ext.DOM.initFunc.isCallPhone = true;
	Ext.DOM.initFunc.isCancel = false;
	window.setTimeout(function(){
		Ext.DOM.DisabledActivity();
		Ext.DOM.initFunc.isRunCall = true;
		Ext.DOM.initFunc.isDial = true;
	},1000);
  }
  else{
	console.log('on dial');
 }  
 
 
}

/* 
 * @ def : toolbars on navigation 
 * ------------------------------------------
 *
 * @ param : no define
 * @ aksess : procedure  
 */

window.EventHangup =function()
{
	Ext.DOM.initFunc.isDial = false;
	Ext.DOM.initFunc.isRunCall = false;
	Ext.DOM.initFunc.isCancel = false;
	ExtApplet.setHangup();
	return;
} 
 /* 
 * @ def : toolbars on navigation 
 * ------------------------------------------
 *
 * @ param : no define
 * @ aksess : procedure  
 */
 
Ext.DOM.getCallReasultId = function(combo)
{
	Ext.Ajax
	({
		url 	: Ext.DOM.INDEX +'/SrcCustomerList/setCallResult/',
		method  : 'GET',
		param  : {
			CategoryId : combo.value
		}	
	}).load("DivCallResultId");	
	$('.select-chosen').chosen();
}

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */

 
Ext.DOM.CallSessionId = function(){
	return ( typeof (ExtApplet.getCallSessionId() ) =='undefined' ? 
			'NULL': ExtApplet.getCallSessionId() );
}

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */

 
 
 window.EventSubmit=function() 
{
	
 var ActivityCall = [],
	 ActivityForm = Ext.Serialize('frmActivityCall').Complete
	 ([
		'ProductForm','CallingNumber',
		'PhoneNumber','AddPhoneNumber','date_call_later',
		'hour_call_later','minute_call_later',
		'edit_policy_box','CustomerEmail','pending_policy_box'
     ]);
	
 
   ActivityCall['CustomerId']= Ext.Cmp('CustomerId').getValue();
   ActivityCall['CallingNumber'] = Ext.Cmp('CallingNumber').getValue();
   ActivityCall['CallSessionId'] =  0;  
   
// ------------ next form --------------------
	
	if( !ActivityForm ){ 
		Ext.Msg('Input form not complete').Info(); 
		return false;
	}
	
	
	
	Ext.Ajax 
   ({
		url 	: Ext.EventUrl(new Array('ModSaveActivity','SaveSpvActivity')).Apply(),
		method : 'POST',
		param 	: Ext.Join(new Array (
						Ext.Serialize('frmActivityCall').getElement(), ActivityCall  
					)).object(),
					
	ERROR  : function( err )
	{
		Ext.Util( err ).proc(function(save)
		{
			if( save.success )  {
				Ext.Msg("Save Activity").Success();
				$("#tabs").mytab().tabs("option", "selected", 0);
				window.CallHistory({page : 0, orderby : "", type : ""});
			}
			else{
				Ext.Msg("Save Activity").Failed();
			}
		});
	}
 }).post();
 
}

	
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */

 
 Ext.DOM.CallHistory = function( obj )
{
   var CustomerId = Ext.Cmp('CustomerId').getValue();
   Ext.Ajax 
   ({
		url    : Ext.EventUrl(['ModCallHistory','PageCallHistory']).Apply(),
		method : "GET",
		param  : {
			CustomerId 	: CustomerId,
			page 		: obj.page,
			orderby 	: obj.orderby,
			type 		: obj.type
		}
   }).load("tabs-1");
}

	
// -----------------------------------------------------------

/* 
 * Method 		AddUser 
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
$(document).ready( function()
{
	Ext.DOM.CallHistory({page : 0, orderby : "", type : ""});
	Ext.DOM.PageCallRecording({page : 0, orderby : "", type : ""});
});

	
// -----------------------------------------------------------

/* 
 * Method 		AddUser 
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
window.EeventFromProduct = function(e)
{
	if( e.value !='' )
	{
		Ext.Window ({
			url 		: Ext.EventUrl(new Array('ProductForm','index')).Apply(),	
			method 		: 'POST',
			width  		: (Ext.query(window).width()-(Ext.query(window).width()/4)), 
			height 		: Ext.query(window).height(),
			left  		: (Ext.query(window).width()/2),
			scrollbars 	: 1,
			resizable   : 1,  
			param  		:  {
				ViewLayout 	: 'ADD_FORM',	
				ProductId	: Ext.Cmp('ProductForm').getValue(),
				CustomerId 	: Ext.Cmp('CustomerId').Encrypt(),
			}
		}).popup();
	}
}

/* 
 * @ def : toolbars on navigation 
 * ------------------------------------------
 *
 * @ param : no define
 * @ aksess : procedure  
 */
 
 window.getEventSale = function(object) {
	return true;	
}

/* 
 * @ def : toolbars on navigation 
 * ------------------------------------------
 *
 * @ param : no define
 * @ aksess : procedure  
 */
 
Ext.DOM.EventClose =function()
{
	var ControllerId = Ext.Cmp('ControllerId').getValue();
	if( (Ext.DOM.initFunc.isCancel==true ) ) 
	{
		Ext.ActiveMenu().Active();
		Ext.DOM.UnsetFollowup( Ext.Cmp('CustomerId').getValue() );
		Ext.ShowMenu(new Array(ControllerId), 
			Ext.System.view_file_name(), {
			time : Ext.Date().getDuration()	
		});
	}	
	else { 
		Ext.Msg('Please Save Activity').Info();
	}	
 }

 /* 
 * @ def : toolbars on navigation 
 * ------------------------------------------
 *
 * @ param : no define
 * @ aksess : procedure  
 */
 
Ext.DOM.UserWindow = function(){
	Ext.DOM.AdditionalPhone( Ext.Cmp('CustomerId').getValue() );
	return false;
}
// ----------------------------------------------------------------------------------------------

/*
 * @ pack : get all labels -  array header 
 */
 
 window.UserLayout = function()
{
  $('#ui-widget-contact-tabs').css({ "background-color" : "#FBFEFF", "padding-bottom" : "15px" });
  $('.ui-widget-contact-tabs').css({"background-color" : "#FBFEFF"});
  $(".ui-widget-fieldset").css({"border-radius":"3px","margin": "12px 5px 5px 5px", "padding" : "5px 5px 15px 5px"});
  $('.date').datepicker ({ showOn: 'button', buttonImage: Ext.Image('calendar.gif'),  buttonImageOnly: true, dateFormat:'dd-mm-yy', readonly:true });
  
  $('.ui-window').css({"width":"45%","text-align":"left"});
  $(".ui-widget-box").css({"width":"30%" });
  $('.ui-widget-label3').css({"width":"99%","padding": "5px 2px 5px 5px"});
  $('.bottom').css({"border-bottom": "1px dashed #dddddd" });
  //$('.ui-disabled').each(function(){ 
 // Ext.Cmp( $(this).attr('id')).disabled(true); });
  
 
   
}


/* 
 * @ def : toolbars on navigation 
 * ------------------------------------------
 *
 * @ param : no define
 * @ aksess : procedure  
 */
 
 $(document).ready( function()
{	
  $('.select-chosen').chosen();
// --- tab informasi ----------------------------------------
  
  $("#ui-widget-contact-tabs").mytab().tabs();
  $("#ui-widget-contact-tabs").mytab().tabs("option", "selected", 0);
  $("#ui-widget-contact-tabs").mytab().close({}, true);
 
// ----------------------------------------------------------- 
 window.UserLayout();
   
	
  $("#tabs").mytab().tabs();
  $("#tabs").mytab().tabs("option", "selected", 0);
  $("#tabs").mytab().close({}, true);
  
 // --------------------------- test toolbars ------------------------------------------------
  $('#toolbars').extToolbars 
  ({
		extUrl    : Ext.DOM.LIBRARY +'/gambar/icon',
		extTitle  : [[],[]],
		extMenu   : [[],[]],
		extIcon   : [['page_white_acrobat'],[]],
		extInput  : true,
		extOption  : [{
			render : 1,
			type   : 'combo',
			header : 'Script ',
			id     : 'v_result_script', 	
			name   : 'v_result_script',
			triger : 'ShowWindowScript',
			width  : 220,
			store  : [Ext.Ajax 
			({
				url   : Ext.EventUrl(new Array('SetProductScript','getScript')).Apply(),
				param : {
					CampaignId : Ext.Cmp('CampaignId').getValue()
				}
			}).json()]
		}]
	});
	
	
	$('.ui-disabled').each(function(){
		if( $(this).attr('id') != undefined ) {
			$(this).prop('disabled', true).trigger("liszt:updated");
			$(this).prop('disabled', true).trigger("chosen:updated");
			$(this).css({"cursor": "no-drop"}); 
		}
	});
	
   $('div.ui-disabled').each(function(){
	   if( $(this).first() ) {
			$( ".date" ).datepicker( "option", "disabled", true );
			$( "#_SUB_TOOL_14" ).css({"color" : "silver","cursor": "no-drop"}); 
			Ext.Cmp( "_SUB_TOOL_14" ).disabled( true );
	   } 
	});
  
  
  
});
</script>
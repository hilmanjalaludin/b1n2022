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

//-------------------------------------------------------------------------------------- 
/*  
 * @ pack 			reset on followup data  
 *
 */

	Ext.DOM.CallInterest = function()
{
	return( Ext.Ajax ({
		url 	: Ext.EventUrl( new Array( 'SetCallResult','getEventType') ).Apply(),
		method 	: 'GET',
		param 	: {
			CallResultId : Ext.Cmp('CallResult').getValue()
		}	
	}).json());	
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

 
window.PolicyReady = function()
{
  try
  {	
	  return ( Ext.Ajax  ({
			url 	: Ext.EventUrl( new Array('SrcCustomerList','PolicyStatus')).Apply(),
			method 	: 'GET',
			param 	: {
				CustomerId : Ext.Cmp('CustomerId').getValue()
			}
	 }).json());
  } catch( e ){
	  return false;
  } 
 
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

// ---------------------------------------------------------------------------------------------------
/* 
 * @ package 				toolbars on navigation 
 *
 * @ param 					no define
 * @ aksess 				procedure  
 */
 
 window.EventRefreshPhone = function() 
{
	var object = $('#AddPhoneNumber');
	$("#ui-add-phone-list").loader
	({
		url 	: new Array('ModApprovePhone','RefreshPhoneNumber'),
		param 	:{
			FieldName  : object.attr('id'),
			FieldValue : object.attr('value'),  
			FieldStyle : object.attr('class'),
			CustomerId : Ext.Cmp('CustomerId').getValue()
		},
		complete : function( obj ){
			$('.select-chosen').chosen();
		}
	});
}



// ---------------------------------------------------------------------------------------------------
/* 
 * @ package 				toolbars on navigation 
 *
 * @ param 					no define
 * @ aksess 				procedure  
 */
 
Ext.DOM.ShowWindowScript = function(ScriptId)
{
	var WindowScript = new Ext.Window 
	({
			url     : Ext.EventUrl( new Array('SetProductScript','ShowProductScript')).Apply(), 
			name    : 'WinProduct',
			height  : (Ext.Layout(window).Height()),
			width   : (Ext.Layout(window).Width()),
			left    : (Ext.Layout(window).Width()/2),
			top	    : (Ext.Layout(window).Height()/2),
			resizable: 1,
			scrollbars: 1,
			param   : {
				ScriptId : Ext.BASE64.encode(ScriptId),
				Time	 : Ext.Date().getDuration()
			}
		}).popup();
		
	if( ScriptId =='' ) {
		window.close();
	}
}


// ---------------------------------------------------------------------------------------------------
/* 
 * @ package 				toolbars on navigation 
 *
 * @ param 					no define
 * @ aksess 				procedure  
 */
 
 Ext.DOM.getLastCall = function()
 {
	var conds = false;
	 
	if( Ext.Ajax
	({
		url 	: Ext.EventUrl(['SrcCustomerList','CheckLastCall']).Apply(),
		method  : 'POST',
		param	: {}	
	}).json().result )
	{ conds = true; }
	
	return conds;
 }
 
 

// ---------------------------------------------------------------------------------------------------
/* 
 * @ package 				toolbars on navigation 
 *
 * @ param 					no define
 * @ aksess 				procedure  
 */
 
 
  
window.ButtonCloseStyle = function( flag )
{
	if( flag ){
		$('#_CLS_TOOL_19')
			.attr("disabled", true)
			.css({"color":'silver' });
	} else{
		$('#_CLS_TOOL_19')
			.attr("disabled", false)
			.css({"color": "#067346"});
	}
}
 
// ------------------------------------------------------------
/* 
 * @ def : toolbars on navigation 
 * ------------------------------------------
 *
 * @ param : no define
 * @ aksess : procedure  
 */
 
window.ButtonSaveStyle = function( flag )
{
	if( flag ){
		$('#_SAV_TOOL_15')
			.attr("disabled", true)
			.css({"color":'silver' });
	} else{
		$('#_SAV_TOOL_15')
			.attr("disabled", false)
			.css({"color": "#067346"});
	}
}
// ------------------------------------------------------------
/* 
 * @ def : toolbars on navigation 
 * ------------------------------------------
 *
 * @ param : no define
 * @ aksess : procedure  
 */
 
window.ButtonHangupStyle = function( flag )
{
	if( flag ){
		$('#_HAG_TOOL_18')
			.attr("disabled", true)
			.css({"color":'silver' });
	} else{
		$('#_HAG_TOOL_18')
			.attr("disabled", false)
			.css({"color": "#067346"});
	}
}
 
// ------------------------------------------------------------
/* 
 * @ def : toolbars on navigation 
 * ------------------------------------------
 *
 * @ param : no define
 * @ aksess : procedure  
 */
 
window.ButtonDialStyle = function( flag )
{
	if( flag ){
		$('#_CAL_TOOL_17')
			.attr("disabled", true)
			.css({"color":'silver' });
	} else{
		$('#_CAL_TOOL_17')
			.attr("disabled", false)
			.css({"color": "#067346"});
	}
}
 
 /* 
 * @ def : toolbars on navigation 
 * ------------------------------------------
 *
 * @ param : no define
 * @ aksess : procedure  
 */
 
window.EventCall  = function() 
{
	window.ButtonCloseStyle(1);
	window.ButtonSaveStyle(1);
	window.ButtonDialStyle(1);
	window.ButtonHangupStyle(0);
	
	if( (Ext.DOM.initFunc.isDial==false ) ) 
	{
		ExtApplet.setData
		({   
			Phone 		: Ext.Cmp("CallingNumber").getValue(), 
			CustomerId  : Ext.Cmp("CustomerNumber").getValue() 
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

 window.EventHangup=function()
{
	window.ButtonCloseStyle(0);
	window.ButtonSaveStyle(0);
	window.ButtonDialStyle(0);
	window.ButtonHangupStyle(1);
	
	if( Ext.DOM.initFunc.isDial )
	{
		Ext.DOM.initFunc.isDial = false;
		Ext.DOM.initFunc.isRunCall = false;
		Ext.DOM.initFunc.isCancel = false;
		
		try {  ExtApplet.setHangup();
		} catch( e ){
			console.log( e )
		}	
	}
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
	
	//Ext.Cmp('create_policy').disabled(true);
	Ext.Cmp('date_call_later').setValue('');
	Ext.Cmp('hour_call_later').setValue('');
	Ext.Cmp('minute_call_later').setValue('');
	Ext.Cmp('date_call_later').disabled(true);
	Ext.Cmp('hour_call_later').disabled(true);
	Ext.Cmp('minute_call_later').disabled(true);
	$('.select-chosen').chosen();
}

 /* 
 * @ def : toolbars on navigation 
 * ------------------------------------------
 *
 * @ param : no define
 * @ aksess : procedure  
 */

 
Ext.DOM.CallSessionId = function(){
	return ( typeof (ExtApplet.getCallSessionId() ) =='undefined' ? 
			'NULL': ExtApplet.getCallSessionId() );
}


/* 
 * @ def : toolbars on navigation 
 * ------------------------------------------
 *
 * @ param : no define
 * @ aksess : procedure  
 */

 Ext.DOM.CekPolicyForm = function(){
	return(
		Ext.Ajax
		({
			url : Ext.DOM.INDEX +'/SrcCustomerList/CekPolicyForm/',
			method : 'POST',
			param :{
				CustomerId : Ext.Cmp('CustomerId').getValue(),
				CallReasonId : Ext.Cmp('CallResult').getValue()
			}
		}).json() );
 }
// ------------------------------------------------------------------------------------------------------------
/* 
 * @ package			this.EventCreatePod
 * @ param 				no define
 * @ aksess 			procedure  
 */

 
 window.EventCreatePod = function( obj )
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
			CustomerId : Ext.Cmp('CustomerId').getValue()
		}
	}).popup();	
 }
 
/* 
 * @ def : toolbars on navigation 
 * ------------------------------------------
 *
 * @ param : no define
 * @ aksess : procedure  
 */
 
 
 
 window.EventSave =function() 
{
 var CallEventTriger = Ext.DOM.CallInterest(),
	 ActivityCall = [],
	 ActivityForm = Ext.Serialize('frmActivityCall').Complete([
		'QualityStatus','ProductForm','CallingNumber',
		'PhoneNumber','AddPhoneNumber','date_call_later',
		'hour_call_later','minute_call_later','CustomerEmail',
		'frm_create_pod', 'frm_edit_form'
    ]);
	
  if( CallEventTriger.event.CallReasonLater==1 ){
	 ActivityForm = Ext.Serialize('frmActivityCall').Complete([
		'QualityStatus','ProductForm','CallingNumber',
		'PhoneNumber','AddPhoneNumber','CustomerEmail'
    ]);
  }
  
  ActivityCall['CustomerId']= Ext.Cmp('CustomerId').getValue();
  ActivityCall['CallingNumber'] = Ext.Cmp('CallingNumber').getValue();
  ActivityCall['CallSessionId'] =  Ext.DOM.CallSessionId();
 
 if( !ActivityForm ){ 
		Ext.Msg('Input form not complete').Info(); }
	else 
	{
		// if( (Ext.DOM.initFunc.isCallPhone==true)
			// && (Ext.DOM.initFunc.isRunCall==false) )
		// {
		//	if( (CallEventTriger.event.CallReasonEvent == 1) && 
		//		( window.PolicyReady().PolicyReady ==0)){
		//		 Ext.Msg('No Policy Data').Info();
		//	}
		//	else
		//	{
			  var Forbiden = Ext.Cmp('CallResult').getValue(); 
			  if( Forbiden == window.CONFIG.NEW_STATUS){
				Ext.Msg("Please select other status").Info();
				return false;
			  }		
			 
			  // ------------ > handle call < -----------------------------------
			  Ext.DOM.initFunc.isSave = true;
			  Ext.DOM.initFunc.isCallPhone = false;
			  Ext.DOM.initFunc.isCancel = true;
			  Ext.Ajax
			  ({
				 url 	: Ext.DOM.INDEX +'/ModSaveActivity/SavePodActivity/',
				 method : 'POST',
				 param 	: Ext.Join(new Array
						( 
							Ext.Serialize('frmActivityCall').getElement(),
							Ext.Serialize('frmInfoCustomer').getElement(),
							ActivityCall 
						)).object(),
				 ERROR  : function(fn)
				 {
						Ext.Util(fn).proc(function(save){
							if( save.success ) {
								Ext.Msg("Save Activity").Success();
								$("#tabs").mytab().tabs().tabs("option", "selected", 0);
								Ext.DOM.CallHistory({page : 0, orderby : "", type : ""});
								
							}
							else{
								Ext.Msg("Save Activity").Failed();
							}
						});
					}
			  }).post();
		  // }
		// }
		// else{
			// Ext.Msg("Theres No Call Activity OR Call Is Running").Info();
		// }	
	}	
}

	
// -----------------------------------------------------------

/* 
 * Method 		AddUser 
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
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
Ext.DOM.ProdPreview = function( ProductId ){
	Ext.Ajax
	({
		url 	: Ext.DOM.INDEX+"/ModSaveActivity/ProdPreview/",
		method 	: 'GET',
		param 	: {
			ProductId 	 : ProductId,
			CustomerId 	 : Ext.Cmp('CustomerId').getValue(),
			CustomerDOB	 : Ext.Cmp('CustomerDOB').getValue(),
			GenderId	 : Ext.Cmp('GenderId').getValue()
		}
	}).load("product_list_preview");
}
	
// -----------------------------------------------------------

/* 
 * Method 		AddUser 
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
Ext.DOM.ProdSum = function(){
	Ext.Ajax ({
		url 	: Ext.DOM.INDEX+"/ModSaveActivity/ProdSum/",
		method 	: 'GET',
		param 	: {
			CustomerId : Ext.Cmp('CustomerId').getValue()
		}
	}).load("tabs-2");
}  
	


	
// -----------------------------------------------------------

/* 
 * Method 		AddUser 
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
Ext.DOM.EeventFromProduct = function(e){
	if( e.value !='' )
	{
		Ext.Window ({
			url 		: Ext.DOM.INDEX+'/ProductForm/index/',	
			method 		: 'POST',
			width  		: (Ext.query(window).width()-(Ext.query(window).width()/4)), 
			height 		: Ext.query(window).height(),
			left  		: (Ext.query(window).width()/2),
			scrollbars 	: 1,
			resizable  : 1,  
			param  		: 
			{
				ViewLayout 	: 'ADD_FORM',	
				ProductId	: Ext.Cmp(e.id).getValue(),
				CustomerId 	: Ext.Cmp('CustomerId').Encrypt(),
			}
		}).popup();
		
	 /* disabled on user show form data **/
		Ext.Cmp('CallStatus').disabled(true);
		Ext.Cmp('CallResult').disabled(true);
		Ext.Cmp('ProductForm').disabled(true);
		Ext.Cmp('ButtonUserCancel').disabled(true);
		Ext.Cmp('ButtonUserSave').disabled(true);
	}
}

/* 
 * @ def : toolbars on navigation 
 * ------------------------------------------
 *
 * @ param : no define
 * @ aksess : procedure  
 */
 
 Ext.DOM.getEventSale = function(object) 
{
	Ext.Ajax({
		url : Ext.DOM.INDEX +'/SetCallResult/getEventType/',
		method : 'GET',
		param :{
			CallResultId : object.value
		},
		ERROR : function(fn){
			try
			{
				var ERR = JSON.parse(fn.target.responseText);
				if( ERR.success)
				{
					if( typeof(ERR.event)=='object')
					{
						if( ERR.event.CallReasonEvent==1 ){ 
							Ext.Cmp('ProductForm').disabled(false);
						}
						else{
							Ext.Cmp('ProductForm').disabled(true);
							Ext.Cmp('ProductForm').setValue('');
						}
							
						if( ERR.event.CallReasonLater==1){
							Ext.Cmp('date_call_later').disabled(false);
							Ext.Cmp('hour_call_later').disabled(false);
							Ext.Cmp('minute_call_later').disabled(false);
						}
						else{
							Ext.Cmp('date_call_later').setValue('');
							Ext.Cmp('hour_call_later').setValue('');
							Ext.Cmp('minute_call_later').setValue('');
							Ext.Cmp('date_call_later').disabled(true);
							Ext.Cmp('hour_call_later').disabled(true);
							Ext.Cmp('minute_call_later').disabled(true);
						}
					}
				}
				else{
					
				}	
			}
			catch(e){
				Ext.Msg(e).Error();
			}
		}
	}).post();	
}

// -------------------------------------------------------------------------------------
/* 
 * @ def : toolbars on navigation 
 *
 * @ param : no define
 * @ aksess : procedure  
 */

 
window.EventEditForm = function( obj ){

	if( obj.value !='' )
{
	Ext.Window 
	({
		url 		: Ext.EventUrl(new Array('ProductForm','index')).Apply(), 
		method 		: 'POST',
		width  		: (Ext.query(window).width()-(Ext.query(window).width()/4)), 
		height 		: Ext.query(window).height(),
		left  		: (Ext.query(window).width()/2),
		scrollbars 	: 1,
		resizable   : 1,  
		param  		:  {
			ViewLayout 	: 'ADD_FORM',	
			ProductId	: Ext.Cmp(obj.id).getValue(),
			CustomerId 	: Ext.Cmp('CustomerId').Encrypt(),
		}
	}).popup();		
 }
}

// -------------------------------------------------------------------------------------
/* 
 * @ def : toolbars on navigation 
 *
 * @ param : no define
 * @ aksess : procedure  
 */
 
 window.EventRetry = function()
{
     Ext.Ajax
   ({
		url 	: Ext.EventUrl(new Array('SrcWritePod','RetrySendEmail')).Apply(), 
		method 	: 'POST',
		param 	: {
			CustomerId : Ext.Cmp("CustomerId").getValue(),
			ProductId  : Ext.Cmp("ProductForm").getValue()
		},
		ERROR 	: function( e ) {
			Ext.Util( e ).proc(function( data ) {
				if( data.success == 1 ){
					Ext.Msg("Retry send email").Success();
				} else {
					Ext.Msg("Retry send email").Failed();
				}
			});
		}
   }).post();	
}


// -------------------------------------------------------------------------------------
/* 
 * @ def : toolbars on navigation 
 *
 * @ param : no define
 * @ aksess : procedure  
 */

window.EventClose=function()
{
	var ControllerId = Ext.Cmp('ControllerId').getValue();
	
	if( Ext.DOM.initFunc.isCancel == true )  
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
  $('.ui-window').css({"width":"43%","text-align":"left"});
  $(".ui-widget-box").css({"width":"30%" });
  $('.ui-widget-label3').css({"width":"99%","padding": "5px 2px 5px 5px"});
  $('.bottom').css({"border-bottom": "1px dashed #dddddd" });
  $('.retry').css({"width": "92%","margin-top": "2px", "text-align": "left", "padding-left": "25px"});
  $('.retry').attr("value","Retry Send Email");
  
  // -- get on retry --  
   if( Ext.Cmp('Retry').getValue() == 1 )
  {
	  $('.retry').attr('disabled', true);
	  $('.retry').css({ "color": "silver" });
  }
  
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
	
  window.UserLayout();
	
// ---------- tab history ------------------------
	
  $("#tabs").mytab().tabs();
  $("#tabs").mytab().tabs().tabs("option", "selected", 0);
  $("#tabs").mytab().close({}, true);
  
 // --- disabled image drag ----
 
 $('.ui-disabled').each(function(){
	 Ext.Cmp( $(this).attr("id")).disabled(true); 
  });
  
  Ext.DOM.DisabledActivity();
  Ext.DOM.CallHistory({page : 0, orderby : "", type : ""});
  
  
});
</script>
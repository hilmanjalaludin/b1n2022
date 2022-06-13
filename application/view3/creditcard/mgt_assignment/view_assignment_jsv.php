<script>
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
   
var gTotalData = {
	distribusi : 0,
	transfer  : 0,
	pulldata : 0
}
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
   
window.percentData = {
	distribusi : 0,
	transfer : 0,
	pull : 0
}
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
   
window.checkKuota = function( obj ){
	if( !obj.checked ){
		return false;
	}
	var UserId = Ext.Cmp('dis_user_list').getValue();
	if( UserId == ''){
		Ext.Msg("Please select user").Info();
		return false;
		
	}
	// var new window to the cehck 
	var dataURI = Ext.EventUrl( new Array('BucketKuota', 'UserKuota') ),
		DataURL = 'MgtAssignment';
	Ext.Window({
		name   		: 'winCheckKuotaData',
		url    		: dataURI.Apply(),
		width  		: ($(window).innerWidth() - ( $(window).innerWidth()/3)), 
		height 		: 600,
		left   		: 0, 
		top	   		: 0,
		scrollbars	: 1,
		resizeable  : 1,
		param  		: {
			UserId  : UserId,
			DataURL : DataURL
		}	
		
	}).popup();
	//console.log(UserId);
}

 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
   
window.EventSetCallResult = function( option, html, object  ){
	
	var objectHtmlID = window.sprintf('#%s', html);
	console.log(objectHtmlID);
	var dataURL = Ext.EventUrl( new Array('MgtAssignment', 'CallReasonId')).Apply();
	var CallStatus  = Ext.Cmp(option).getValue();
	console.log( CallStatus );
	
	$(objectHtmlID).loader({
		url 	: dataURL,
		method 	: 'POST',
		param 	: {
			CallStatus : CallStatus,
			ObjectId : object
		},
		complete : function( xhr ){
			$(xhr)
			.css({ 'height' :'100%'  });
			$('.xselect').chosen();
		}
		
	});
	
	// console.log( option );
	// console.log( html );
	// console.log( object );
}
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
   
 Ext.DOM.RoleBack = function() 
{
	if( Ext.Msg('Are you sure ?').Confirm() ){
		new Ext.BackHome();
	}
}
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
   
 window.ViewDistributeData = function( obj )
{
  var formDisFilter = Ext.Serialize('formDisFilter');
	$('#ui-widget-dis-list').Spiner  ({
		url 	: new Array('MgtAssignment','PageDistribute'),
		param 	: Ext.Join(new Array( formDisFilter.getElement() ) ).object(),
		order   : {
			order_type : obj.type,
			order_by   : obj.orderby,
			order_page : obj.page	
		}, 
		handler : 'ViewDistributeData',
		complete : function( obj ){
			
		// get total to set on right of page 
			this.dataSize = parseInt( $('#ui-total-ui-pager-distribusi-data-record').text() );
			
		// tambahan slider untuk wrap table 
		// add customize for scroll testing 
		
			if( !$('.ui-widget-scroll-top-table-distribusi').length ){
				$("<div class='ui-widget-scroll-top-table-distribusi'>"+
					"<div class='ui-wdget-slider-top-distribusi' style='width:99%;'></div>").insertBefore(obj);
			}
			
				// callculate of height this 
		  this.protectedHeighes = $('#ui-pager-distribusi-data').innerHeight()+$('#ui-pager-distribusi-data-bottom').innerHeight();
		  this.protectedHeights = this.protectedHeighes+15;
		  this.protectedWidths  = $(window).innerWidth() - ($(window).innerWidth()/3);
		  
		    // replace styleSheets of overflow method 	
		
			$(".ui-widget-dis-list").css({  
				width: Math.round(this.protectedWidths), 
				height :  Math.round(this.protectedHeights) 
			});
			$(".ui-widget-dis-list").addClass("ui-scroller-width-right-border-fixed");
			
			if( this.dataSize == 0 ){
				this.maxWidthPager = (($('.ui-fieldset-dis-top').innerHeight()+$('.ui-fieldset-dis-bot').innerHeight()) - 25); 
				$(".ui-widget-dis-list").css({   
					height: this.maxWidthPager
				});
			}
			if( this.dataSize > 0 ){
				this.maxWidthPager = (($('.ui-fieldset-dis-top').innerHeight()+$('.ui-fieldset-dis-bot').innerHeight()) - 25); 
				$(".ui-widget-dis-list").css({   
					height: this.maxWidthPager
				});
			}
			//console.log(window.percentData.perDis);
			if( window.percentData.distribusi ){
				$('.ui-widget-dis-list').scrollLeft( window.percentData.distribusi );
			}	
				
			
			// create slider data process 
			$(".ui-wdget-slider-top-distribusi").slider({
				slide: function( event, ui ) {
					this.widthData = $('.ui-pager-distribusi-data-headers').innerWidth(); 
					//this.widthData = $('.ui-widget-dis-list').innerWidth();
					 
						window.percentData.distribusi = ((this.widthData * ui.value) /100);
						//console.log(window.percentData.distribusi);
							$('.ui-widget-dis-list').scrollLeft( window.percentData.distribusi );
				}
			});	
			
			// set data on pager distribusi process 
			// isi ke object global di atas .
			
			gTotalData.distribusi = this.dataSize;

			// components attributes process 
			Ext.Cmp('dis_user_quantity').setValue(0);
			Ext.Cmp('dis_user_total').setValue(this.dataSize);
			Ext.Cmp('dis_user_total').disabled(true);
			
			
			
		}
	});		
}
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
   
 window.ViewTransferData = function( obj )
{
  var formTransFilter = Ext.Serialize('formTransFilter');
	$('#ui-widget-trans-list').Spiner 
	({
		url 	: new Array('MgtAssignment','PageTransfer'),
		param 	: Ext.Join( new Array( formTransFilter.getElement()  )).object(),
		order : {
			order_type : obj.type,
			order_by   : obj.orderby,
			order_page : obj.page	
		}, 
		handler : 'ViewTransferData',
		complete : function( obj ){
			
			// get total to set on right of page 
			this.dataSize = parseInt( $('#ui-total-ui-pager-transfer-data-record').text() );
			
			// tambahan slider untuk wrap table 
			// add customize for scroll testing 
		
			if( !$('.ui-widget-scroll-top-table-trans').length ){
				$("<div class='ui-widget-scroll-top-table-trans'>"+
					"<div class='ui-wdget-slider-top-trans' style='width:99%;'></div>").insertBefore(obj);
			}
			
		  // callculate of height this 
		  
		if( $('#ui-pager-transfer-data').innerHeight() == 0 ){
			this.protectedHeights = $('.main-content-process').innerHeight(); //($('.ui-fieldset-trans-top').innerHeight()+$('.ui-fieldset-trans-bottom').innerHeight());
			this.protectedWidths  = $(window).innerWidth() - ($(window).innerWidth()/3);
		} 
		  else {
			this.protectedHeights = (($('.ui-fieldset-trans-top').innerHeight()+$('.ui-fieldset-trans-bottom').innerHeight()) - 55);
			this.protectedWidths  = $(window).innerWidth() - ($(window).innerWidth()/3);
		}
		  console.log(this.protectedHeights);
		
		 // replace styleSheets of overflow method 	
			$(".ui-widget-trans-list").css({  
				width: Math.round(this.protectedWidths), 
				height : this.protectedHeights  
			});
			$(".ui-widget-trans-list").addClass("ui-scroller-width-right-border-fixed");
			
			
			if( this.dataSize == 0 ){
				this.maxWidthPager = (($('.ui-fieldset-trans-top').innerHeight()+$('.ui-fieldset-trans-bottom').innerHeight()) - 55); 
				$(".ui-widget-trans-list").css({   
					height: this.maxWidthPager
				});
			}
			
			if( this.dataSize > 0 ){
				this.maxWidthPager = (($('.ui-fieldset-trans-top').innerHeight()+$('.ui-fieldset-trans-bottom').innerHeight()) - 55); 
				$(".ui-widget-trans-list").css({   
					height: this.maxWidthPager
				});
			}
			//console.log(window.percentData.perDis);
			if( window.percentData.transfer ){
				$('.ui-widget-trans-list').scrollLeft( window.percentData.transfer );
			}	
				
			
			// create slider data process 
			$(".ui-wdget-slider-top-trans").slider({
				slide: function( event, ui ) {
					this.widthData = $('.ui-pager-transfer-data-headers').innerWidth();
					 
						window.percentData.transfer = ((this.widthData * ui.value) /100);
						//console.log(window.percentData.transfer);
							$('.ui-widget-trans-list').scrollLeft( window.percentData.transfer );
				}
			});	
			
			// set data on pager distribusi process 
			// isi ke object global di atas .
			
			gTotalData.transfer = this.dataSize;

			// components attributes process 
			Ext.Cmp('trans_user_quantity').setValue(0);
			Ext.Cmp('trans_user_total').setValue(this.dataSize);
			Ext.Cmp('trans_user_total').disabled(true);
			
			// var TotalDatas = $('#ui-total-trans-record').text();
				// gTotalData.transfer = $('#ui-total-trans-record').text();
				// Ext.Cmp('trans_user_quantity').setValue(0);
				// Ext.Cmp('trans_user_total').setValue(TotalDatas);
				// Ext.Cmp('trans_user_total').disabled(true);
		}
	});		
}

/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
   
 window.ViewPullData = function( obj )
{
  var formPullFilter = Ext.Serialize('formPullFilter');
	$('#ui-widget-pull-list').Spiner 
	({
		url 	: new Array('MgtAssignment','PagePullData'),
		param 	: Ext.Join( new Array( formPullFilter.getElement() )).object(),
		order : {
			order_type : obj.type,
			order_by   : obj.orderby,
			order_page : obj.page	
		}, 
		handler : 'ViewPullData',
		complete : function( obj ){
			
			// get total to set on right of page 
			this.dataSize = parseInt( $('#ui-total-ui-pager-pull-data-record').text() );
			
			// tambahan slider untuk wrap table 
			// add customize for scroll testing 
		
			if( !$('.ui-widget-scroll-top-table-pull').length ){
				$("<div class='ui-widget-scroll-top-table-pull'>"+
					"<div class='ui-wdget-slider-top-pull' style='width:99%;'></div>").insertBefore(obj);
			}
			
		  // callculate of height this 
		  
		if( $('#ui-pager-pull-data').innerHeight() == 0 ){
			this.protectedHeights = $('.main-content-process').innerHeight(); //($('.ui-fieldset-trans-top').innerHeight()+$('.ui-fieldset-trans-bottom').innerHeight());
			this.protectedWidths  = $(window).innerWidth() - ($(window).innerWidth()/3);
		} 
		  else {
			this.protectedHeights = (($('.ui-fieldset-pull-top').innerHeight()+$('.ui-fieldset-pull-bottom').innerHeight()) - 55);
			this.protectedWidths  = $(window).innerWidth() - ($(window).innerWidth()/3);
		}
		  console.log(this.protectedHeights);
		
		 // replace styleSheets of overflow method 	
			$(".ui-widget-pull-list").css({  
				width: Math.round(this.protectedWidths), 
				height : this.protectedHeights  
			});
			$(".ui-widget-pull-list").addClass("ui-scroller-width-right-border-fixed");
			
			
			if( this.dataSize == 0 ){
				this.maxWidthPager = (($('.ui-fieldset-pull-top').innerHeight()+$('.ui-fieldset-pull-bottom').innerHeight()) - 55); 
				$(".ui-widget-pull-list").css({   
					height: this.maxWidthPager
				});
			}
			//console.log(window.percentData.perDis);
			if( window.percentData.transfer ){
				$('.ui-widget-pull-list').scrollLeft( window.percentData.transfer );
			}	
				
			
			// create slider data process 
			$(".ui-wdget-slider-top-pull").slider({
				slide: function( event, ui ) {
					this.widthData = $('.ui-pager-pull-data-headers').innerWidth();
						window.percentData.transfer = ((this.widthData * ui.value) /100);
						//console.log(window.percentData.transfer);
							$('.ui-widget-pull-list').scrollLeft( window.percentData.transfer );
				}
			});	
			
			// set data on pager distribusi process 
			// isi ke object global di atas .
			
			gTotalData.pulldata = this.dataSize;

			// components attributes process 
			Ext.Cmp('pull_user_quantity').setValue(0);
			Ext.Cmp('pull_user_total').setValue(this.dataSize);
			Ext.Cmp('pull_user_total').disabled(true);
			
			// var TotalDatas = $('#ui-total-pull-record').text();
				// gTotalData.pulldata = $('#ui-total-pull-record').text();
				// Ext.Cmp('pull_user_quantity').setValue(0);
				// Ext.Cmp('pull_user_total').setValue(TotalDatas);
				// Ext.Cmp('pull_user_total').disabled(true);
		}
	});		
}

 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
   
 Ext.DOM.ActionCheckDist = function( obj ) 
 {
	if( obj.checked && obj.value == 2 )
	{
		var BoxList = Ext.Cmp("DistAssignId").getValue()
		if( BoxList.length == 0 ){
			Ext.Cmp('DistAssignId').setChecked();
			BoxList = Ext.Cmp("DistAssignId").getValue();
		}
		
		Ext.Cmp('dis_user_quantity').setValue(0);
		Ext.Cmp('dis_user_total').setValue(BoxList.length);
		Ext.Cmp('dis_user_total').disabled(true);
			
	} else {
		Ext.Cmp('dis_user_quantity').setValue(0);
		Ext.Cmp('dis_user_total').setValue(gTotalData.distribusi);
		Ext.Cmp('dis_user_total').disabled(true);
	}	
 }
 
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
   
 window.SearchDataDist = function() {
	new window.ViewDistributeData ({ orderby : '',  type: '', page: 0	 });	
}
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
   
 window.ClearDataDist = function()  {
	Ext.Serialize('formDisFilter').Clear(new Array('dis_record_page'));
	new Ext.DOM.SearchDataDist();
}
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
   
 window.SubmitDistribute = function()
{
 var frmDistFilter = Ext.Serialize("formDisFilter"),
	 frmDistOption = Ext.Serialize("frmDistOption"),
	 frmDistGrid = new Array();
	
	
// kecuali dta yang berikut ini.
 var dataNotRequired = new Array('dis_check_kuota');
 
 if( !frmDistOption.Complete(dataNotRequired) )	{
	Ext.Msg('Form Option Not Complete !').Info();
	return false;
 }
 
 frmDistGrid['AssignId'] = Ext.Cmp('DistAssignId').getValue();
 
 var Data = new Array(
	frmDistFilter.getElement(), 
	frmDistOption.getElement(),
	frmDistGrid
  );
  
// set distribusi data 
  $('.assign').attr('disabled', true);
  
   Ext.Ajax  ({
	 url 	 : Ext.EventUrl( new Array('UserDistribusi', 'index')).Apply(),
	 method  : 'POST',
	 param 	 : Ext.Join( Data ).object(),
	 success : function( xhr )  {
		 
		// konverting data to object process Ok 
		// then will get.
		
		Ext.Util( xhr ).proc(function( row ){
			if( row.success ) {
				var datRow = row.report, dataMsg = new Array(), ptr = 0;	
				if( typeof( datRow ) == 'object' )
					for( var user in datRow  ) {
					dataMsg[ptr] = window.sprintf("User : < %s > Process : < %s > Success : < %s > Failed : < %s > Kuota : < %s > Sisa Kuota : < %s >\n", user, 
												   datRow[user].total,
												   datRow[user].success,
												   datRow[user].failed,
												   datRow[user].limit,
												   datRow[user].sisa );
					ptr++;
				}
				
			// return message / callMessageUser OK 	
				var callMessageUser = window.sprintf("\n=====================================================================================\n%s", dataMsg.join(''));
					Ext.Msg( callMessageUser ).Info();
					$('.assign').attr('disabled', false);
					new Ext.DOM.SearchDataDist();
			}
			else {
				// return false OK 
				Ext.Msg("Process Distribusi Data.\nPlease check your parameter").Failed();
				$('.assign').attr('disabled', false);
				return false;
			}
		});
	}
  }).post();
} 
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
   
 window.SearchDataTrans =function()  {	
	//var cond = Ext.Serialize('formTransFilter').Required(new Array('trans_from_campaign_id') );
	new window.ViewTransferData ({  orderby : '',   type : '',  page : 0 });
	
}
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
   
Ext.DOM.SubmitTransfer = function()
{
	var formTransFilter = Ext.Serialize("formTransFilter"),
	 frmTransOption = Ext.Serialize("frmTransOption"),
	 frmTransGrid = new Array();
	
 if( !frmTransOption.Complete() )	{
	Ext.Msg('Form Option Not Complete !').Info();
	return false;
 }
 
 frmTransGrid['AssignId'] = Ext.Cmp('TransAssignId').getValue();
 
 var Data = new Array(
	formTransFilter.getElement(), 
	frmTransOption.getElement(),
	frmTransGrid
  );
// --------- set distribusi data ----> 
	
   Ext.Ajax 
 ({
	 url 	: Ext.EventUrl(['UserTransfer', 'index']).Apply(),
	 method : 'POST',
	 param 	: Ext.Join( Data ).object(),
	 ERROR 	: function( e )
	 {
		Ext.Util( e ).proc(function( response ){
			if(  response.success ){
				var transferHeight = (($('.ui-fieldset-trans-top').innerHeight()+$('.ui-fieldset-trans-bottom').innerHeight()) - 55);
				$(".ui-widget-trans-list").css({  
					height : transferHeight  
				});
				Ext.Msg("Transfer Data ").Success();
				new Ext.DOM.SearchDataTrans();
				
			} else {
				Ext.Msg("Transfer Data Or Check User Kuota Data").Failed();
			}
		});
	}
  }).post();
}

 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
   
Ext.DOM.ClearDataTrans = function(){
	Ext.Serialize('formTransFilter').Clear(new Array('trans_record_page'));
}

 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
   
 Ext.DOM.ActionCheckTrans = function( obj )
{
	if( obj.checked && obj.value == 2 )
	{
		var BoxList = Ext.Cmp("TransAssignId").getValue()
		if( BoxList.length == 0 ){
			Ext.Cmp('TransAssignId').setChecked();
			BoxList = Ext.Cmp("TransAssignId").getValue()
		}
		
		Ext.Cmp('trans_user_quantity').setValue(0);
		Ext.Cmp('trans_user_total').setValue(BoxList.length);
		Ext.Cmp('trans_user_total').disabled(true);
			
	} else {
		Ext.Cmp('trans_user_quantity').setValue(0);
		Ext.Cmp('trans_user_total').setValue(gTotalData.transfer);
		Ext.Cmp('trans_user_total').disabled(true);
	}	
}

 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
   
 
 Ext.DOM.SelectUserTransByGroup = function( obj )
{
	$('#trans_form_user_list').toogle ({ 
		url : 'MgtAssignment/SelectFromTrfUserByLevel',
		param :  {
			time 	 : Ext.Date().getDuration(),
			trans_from_user_group : obj.value
		},
		elval:['trans_from_user_group']
	});	
}	

 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
   
 Ext.DOM.SelectUserTransToByGroup = function( obj )
{	
	var trans_user_type = Ext.Cmp('trans_user_type').getValue();
	
	$('#trans_to_user_list').toogle ({ 
		url : 'MgtAssignment/SelectTrfUserByLevel',
		param :  {
			time 	 : Ext.Date().getDuration(),
			trans_to_user_group : Ext.Cmp(obj.id).getValue(),
			trans_user_type : trans_user_type
		},
		elval:['trans_to_user_group','trans_user_type']
	});	
}
 

 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
   
 window.SearchPullData = function() {
  var cond = true; //Ext.Serialize('formPullFilter').Required(new Array('') );
  new window.ViewPullData ({  orderby : '',   type : '',  page : 0	  });
}

 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
   
 Ext.DOM.ClearPullData = function() { 
	new Ext.Serialize('formPullFilter').Clear(new Array('pull_record_page') );
}
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
   
 Ext.DOM.ActionCheckPull = function( obj )
{
	if( obj.checked && obj.value == 2 )
	{
		var BoxList = Ext.Cmp("PullAssignId").getValue()
		if( BoxList.length == 0 ){
			Ext.Cmp('PullAssignId').setChecked();
			BoxList = Ext.Cmp("PullAssignId").getValue()
		}
		
		Ext.Cmp('pull_user_quantity').setValue(0);
		Ext.Cmp('pull_user_total').setValue(BoxList.length);
		Ext.Cmp('pull_user_total').disabled(true);
			
	} else {
		Ext.Cmp('pull_user_quantity').setValue(0);
		Ext.Cmp('pull_user_total').setValue(gTotalData.pulldata);
		Ext.Cmp('pull_user_total').disabled(true);
	}	
}
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
   
 Ext.DOM.SelectUserPullByGroup = function( obj )
 {
	$('#pull_form_user_list').toogle 
	({ 
		url : 'MgtAssignment/SelectPullFromUserByLevel',
		param :  {
			time : Ext.Date().getDuration(),
			pull_from_user_group : Ext.Cmp(obj.id).getValue()
		},
		elval:['pull_from_user_group']
	});	
	 
 }
 
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
   
 Ext.DOM.SelectUserToByGroup = function( obj )
{
	var pull_user_type = Ext.Cmp('pull_user_type').getValue();
	 
	$('#pull_to_user_list').toogle 
	({ 
		url : 'MgtAssignment/SelectPullToUserByLevel',
		param :  {
			pull_user_type : pull_user_type,
			time : Ext.Date().getDuration(),
			pull_to_user_group : Ext.Cmp(obj.id).getValue()
		},
		elval:['pull_to_user_group','pull_user_type']
	});	
	 
 }
 
Ext.DOM.LoadCallReasonID = function( obj )
{
	$('#trans_call_result_id').toogle ({ 
		url : 'MgtAssignment/LoadCallReason',
		param :  {
			time 	 : Ext.Date().getDuration(),
			trans_call_category : obj.value
		},
		elval:['trans_call_category_id']
	});	
} 
 
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
   

 Ext.DOM.SelectUserDistByGroup = function( obj )
 {
	var dis_user_type = Ext.Cmp('dis_user_type').getValue();
	$('#dis_user_list').toogle  ({ 
		url : 'MgtAssignment/SelectUserByLevel',
		param :  {
			dis_user_type : dis_user_type,
			time : Ext.Date().getDuration(),
			dis_user_group : Ext.Cmp(obj.id).getValue()
		},
		elval:['dis_user_group','dis_user_type']
	});	
	 
 } 
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
   
  Ext.DOM.SubmitPullData = function()
{
	Ext.Progress( "ui-widget-image-loadings", {
		height  : '17px',  
		title   : 'Please Wait...'
	}).start();
 
 var formPullFilter = Ext.Serialize("formPullFilter"),
	 frmPullOption = Ext.Serialize("frmPullOption"),
	 frmPullGrid = new Array();
	
	if( !frmPullOption.Complete() )	{
		Ext.Msg('Form Option Not Complete !').Info();
		return false;
	 }
	 
	 frmPullGrid['AssignId'] = Ext.Cmp('PullAssignId').getValue();
	 
 var Data = new Array(
		formPullFilter.getElement(), 
		frmPullOption.getElement(),
		frmPullGrid
	);

	// --------- set distribusi data ----> 	
    Ext.Ajax 
   ({
		url 	: Ext.EventUrl(['UserPullData', 'index']).Apply(),
		method : 'POST',
		param 	: Ext.Join( Data ).object(),
		ERROR 	: function( e )
		{
			 Ext.Util( e ).proc(function( response )
			{
				if(  response.success )
				{
					Ext.Msg("Pull The Data ").Success();
					new Ext.DOM.SearchPullData();
					
				} else {
					Ext.Msg("Pull The Data Or Check User Kuota Data").Failed();
				}
				Ext.Progress("ui-widget-image-loadings").stop();
			});
		}
	  }).post(); 
 }
 
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
   
$(document).ready( function() {
  $('#ui-widget-user-assigment').mytab().tabs();
  $('#ui-widget-user-assigment').mytab().tabs("option", "selected", 0);
  $('#ui-widget-user-assigment').css({'background-color':'#FFFFFF'});
  $("#ui-widget-user-assigment").mytab().close(function(){
	  Ext.DOM.RoleBack();
  }, true);
  
  $('#ui-widget-asg-distribute').css({'background-color':'#FFFFFF'});
  $('#ui-widget-asg-transfer').css({'background-color':'#FFFFFF'});
  $('#ui-widget-asg-pooling').css({'background-color':'#FFFFFF'});
  $('#ui-widget-cmp-distribute').css({'background-color':'#FFFFFF'});
  $('.xselect').chosen();
  $('.corner').css({'border-radius': '0'});
  $('.date').datepicker({showOn: 'button',  changeYear:true, 
		changeMonth:true, buttonImage: Ext.Image('calendar.gif'),  
		buttonImageOnly: true,  dateFormat:'dd-mm-yy',readonly:true
  });
  
  // handler onlclick tab by user client.
  $('#ui-widget-user-assigment').bind('tabsshow', function(event, ui) { 
	if( typeof( ui ) == 'object' ){
		// untuk tab transfer data 
		if( ui.index ==  1){
			var transferHeight = (($('.ui-fieldset-trans-top').innerHeight()+$('.ui-fieldset-trans-bottom').innerHeight()) - 55);
			$(".ui-widget-trans-list").css({  
				height : transferHeight  
			});
		}
		// untuk tab pull pager process 
		else if( ui.index ==  2){ 
			var pullHeight = (($('.ui-fieldset-pull-top').innerHeight()+$('.ui-fieldset-pull-bottom').innerHeight()) - 55);
			$(".ui-widget-pull-list").css({  
				height : pullHeight  
			});
		}
	}
  });
  
// open data view tab process on handle 
// assigment data OK 	
   window.SearchDataDist();
   window.SearchDataTrans();
   window.SearchPullData();
});
	
	
</script>
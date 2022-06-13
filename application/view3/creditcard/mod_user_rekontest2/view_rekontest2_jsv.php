<script>
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */

window.percentData  = {
	Bucket : 0	
}

 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */

var objPage = {
	total_page : 0
}

 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
var Role = new Ext.Role("Rekontest2");
	Role.extend([
		{ title: " ", icon :"", event: "", key :'RekontestId' } // if you have other extends event 
	]);
	
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
Ext.DOM.RoleBack = function(){
	if( Ext.Msg('Are you sure ?').Confirm() ){
		Ext.BackHome();	
	}
}

 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
window.EventClose = function(){
	Ext.DOM.RoleBack();
}


 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
window.EventRekontestData  = function( obj ) {
	var frmBucketFilter = Ext.Serialize('frmBucketFilter').getElement();
	$('#ui-widget-bucket-page-id').Spiner 
	({
		url 	: Role.Url('Pager'),
		param 	: Ext.Join(new Array(frmBucketFilter)).object(),
		order   : {
			order_type : obj.type,
			order_by   : obj.orderby,
			order_page : obj.page	
		}, 
		handler : "EventRekontestData",
		complete : function( obj ){
			objPage.total_page = $('#ui-total-id-rekontest-data-record').html();
			
			// tambahan slider untuk wrap table 
			// add customize for scroll testing 
			if( !$('.ui-widget-scroll-top-table-trans').length ){
				$("<div class='ui-widget-scroll-top-table-trans'>"+
					"<div class='ui-wdget-slider-top-trans' style='width:99%;'></div>").insertBefore(obj);
			}
			
		// callculate of height this 	
			this.protectedHeighes = $('.ui-field-bucket-top').height()+$('.ui-field-bucket-bottom').height();
			
		//this.protectedHeighes = height
		//$('#id-bucket-data').innerHeight()+$('#id-bucket-data-bottom').innerHeight();
		  this.protectedHeights = this.protectedHeighes+15;
		  this.protectedWidths  = $(window).innerWidth() - ($(window).innerWidth()/3);
		  
		   // replace styleSheets of overflow method 	
		
			$(".ui-widget-bucket-page-id").css({  
				width: Math.round(this.protectedWidths), 
				height :  Math.round(this.protectedHeights) 
			});
			
			$(".ui-widget-bucket-page-id").addClass("ui-scroller-width-right-border-fixed");
			//$(".ui-widget-fieldset").addClass("ui-group-width-right-border ui-group-width-right-righter");
				
			// jika total = 0 default height;
			
				if( objPage.total_page == 0 ){
					$(".ui-widget-bucket-page-id").css({  
						height: (($('.ui-field-bucket-top').innerHeight() + $('.ui-field-bucket-bottom').innerHeight() ) - 55)
					});
				}
			//console.log(window.percentData.perDis);
				if( window.percentData.Bucket ){
					$('.ui-widget-bucket-page-id').scrollLeft( window.percentData.Bucket );
				}	
				
				$(".ui-wdget-slider-top-trans").slider({
					slide: function( event, ui ) {
						var widthData = $('.ui-widget-bucket-page-id').innerWidth();
							window.percentData.Bucket = ((widthData * ui.value) /100);
						$('.ui-widget-bucket-page-id').scrollLeft( window.percentData.Bucket );
					}
				});	
			
			
			//$("#frm_bucket_user_total").val(objPage.total_page);
		}
	});	
}  


 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
window.EventOnBucket = function(RekontestId, obj ) {
	var total_box = Ext.Cmp(RekontestId).getValue().length;
	var var_action = Ext.Cmp('torek_useraction').getValue();
	
	if( obj.checked ){
		if( var_action ==  1 ){
			Ext.Cmp('torek_availdata').setValue(objPage.total_page); 
		} else if( var_action ==  2 ){
			Ext.Cmp('torek_availdata').setValue(total_box);
		}
	} else {
		Ext.Cmp('torek_availdata').setValue(objPage.total_page); 
	}
	
}

 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
window.EventLookup = function( field ) {
	var checkedbox = Ext.Cmp(field).getValue().length;
	if( checkedbox != 0 ){
	    Ext.Cmp('torek_availdata').setValue(checkedbox);
	} else {
		Ext.Cmp('torek_availdata').setValue(objPage.total_page);  
	}
 }
 
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
 window.EventClear = function(){
	 Ext.Serialize('frmBucketFilter').Clear(new Array('frmrek_from_recordpage'));
 }
 
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 
 window.EventSearch = function(){
	 window.EventRekontestData({ orderby : '',  type: '', page: 0 }); 
 }
 
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 
window.EventSubmit = function() {
	
 var frmBucketOption = Ext.Serialize('frmBucketOption');
 var frmBucketFilter = Ext.Serialize('frmBucketFilter');
 var frmButtonAction = Ext.Cmp('torek_useraction').getValue();
 
 
 //console.log( frmButtonAction );
 
 if( !frmBucketOption.Complete( new Array('DateLater', 'HourLater', 'MinuteLater') )){
	 Ext.Msg("Form input not complete").Info();
	 return false;
 }
 
 var frmAddVariable = new Array();
 if( frmButtonAction == 2 ){
	 frmAddVariable['AssignId'] = Ext.Cmp( 'RekontestId' ).getValue()
 }
 
 // process ajax data process ok 
	Ext.Ajax ({
		url 	: Ext.EventUrl( Role.Url('Submit') ).Apply(),
		method 	: 'POST',
		param 	: Ext.Join( new Array( frmBucketOption.getElement(), 
									   frmBucketFilter.getElement(),
									   frmAddVariable )).object(),
		success   : function( xhr ) {
			Ext.Util( xhr ).proc(function( data ){
				if( data.success == 1 ){
					var callMsgData = window.sprintf("Share Data .\nTotal:%s", data.row );
					Ext.Msg(callMsgData).Success();
					window.EventSearch();
				}
				else {
					Ext.Msg("Share Data").Failed();
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
   
 
 window.SelectUserRekByGroup = function( obj ) {
	 
	$('#frmrek_from_userlist-html').toogle ({ 
		url : 'Rekontest2/UserunderGroup',
		param :  {
			frmrek_from_usergroup : obj.value
		},
		elval:['frmrek_from_usergroup']
	});	
}	
/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
window.EventToUserGroup = function( obj ){
	
	$('#torek_userlist_html').toogle ({ 
		url : 'Rekontest2/EventUnderGroup',
		param :  {
			torek_groupuser : obj.value
		},
		elval:['torek_groupuser']
	});	
}

//SelectUserRekByGroup

/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
window.UnderCallStatus = function( data ){
	
	var datURL = Ext.EventUrl( new Array('Rekontest2', 'CallReasonId') ).Apply(),
		dataCallStatus = data.value;
	
	$('#frmrek_from_callreason-html').loader({
		url : datURL,
		method : 'POST',
		param : {
			callStatus : dataCallStatus 
		},	
		complete : function( xhr ){
			$( xhr ).css({ 'height' : '100%'});
			$('.xselect').chosen();
			
		}	
	});
	
}

 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  

window.ToEventCallStatus = function( option ){
	
	var datURL = Ext.EventUrl( new Array('Rekontest2', 'CallReasonDataId') ).Apply(),
		dataCallStatus = option.value;
	
	$('#to-call-reason-id').loader({
		url : datURL,
		method : 'POST',
		param : {
			callStatus : dataCallStatus 
		},	
		complete : function( xhr ){
			$( xhr ).css({ 'height' : '100%'});
			$('.xselect').chosen();
			
		}	
	});
}


 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
window.EventUpload = function(){
	
	Ext.Progress( "ui-widget-image-loading", {
		height  : '17px',  
		title   : 'Please Wait...'
	}).start();
	
	
	Ext.Ajax ({
		url 	: Ext.EventUrl(new Array("MgtBucket", "UploadReguler") ).Apply(), 
		file 	: ['fileToupload'], 
		method 	: 'POST',
		param	: {
			TemplateId  : Ext.Cmp('upload_template').getValue(),
			CampaignId  : Ext.Cmp('upload_campaignId').getValue(), 
			ExpiredDate : Ext.Cmp('upload_expired').getValue() 
		},
		complete : function( xhr  ) {
			 Ext.Util( xhr ).proc( function( data ){
				 if( data.success ){
					 console.log(typeof( data.mesages ));
					 if( typeof( data.mesages ) == 'object' ){
						 var rowResultData = data.mesages,
							 totalRowData = rowResultData.R,
							 totalSuccess = rowResultData.Y,
							 totalFailed = rowResultData.N,
							 totalDuplicate = rowResultData.D;
								
						// result to window alert data user client .		
							Ext.Msg( window.sprintf("\nTotal Row : %s\nTotal Success: %s\nTotal Failed : %s\nTotal Duplicate : %s",  
									totalRowData, totalSuccess,  
									totalFailed,  totalDuplicate )).Info();
									
					 } 
					 else {
						 Ext.Msg( data.mesages ).Info();
					 }
				 }else {
					 Ext.Msg( data.mesages ).Info();
				 }
				 Ext.Progress("ui-widget-image-loading").stop();
				 
			 });
		}
	}).upload();
	
 }
 
// ----------------------------------------------------------------------------------------------
/*
 * @ pack : get all labels -  array header 
 */
 
 window.UserLayout = function()
{
  $('#ui-widget-page-bucket').css({ "background-color" : "#FBFEFF", "padding-bottom" : "15px" });
  $('.ui-widget-fieldset').css({"margin": "0px 0px 0px 0px", "padding" : "5px 5px 15px 5px"});
  $('.ui-widget-class-content').css({'background-color':'#FFFFFF'});
  $('.date').datepicker ({ showOn: 'button',changeYear:true, changeMonth:true, buttonImage: Ext.Image('calendar.gif'),  buttonImageOnly: true, dateFormat:'dd-mm-yy', readonly:true });
  $('.readonly').attr('readonly', true);
  $('.readonly').attr('disabled', true);
  
 
  $('.button').css({ 'width' : '40%'});
  $('.boox').css({ 'width' : '58px'});
  
  $('.xselect').chosen();
  $('.fieldmultiple').css({
	  'height' : '20px',
	  'width'  : '216px'
	   
  })
  
}
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
window.EventSetCallBackLater = function( data ){
	
	
// window.EventSetCallBackLater 	
	var callDataPosition = data.value;
	var callDataCallback = window.CONFIG.CALL_REASONID.APMT;
	
	
	if( !callDataPosition.localeCompare(callDataCallback) ){
		$( '.ui-disfield' ).each( function(){
			Ext.Cmp( $(this).attr('id') ).disabled( false ); 
		});
	}
// window.EventSetCallBackLater 	
	else {
		$( '.ui-disfield' ).each( function(){
			Ext.Cmp( $(this).attr('id') ).setValue(''); 
			Ext.Cmp( $(this).attr('id') ).disabled( true ); 
		});
	}	
}

 
 
 /*
  * @ def	 : function ready 
  * 
  * @ params	 : method on ready pages 
  * @ package : bucket datas 
  */
 
$(document).ready( function()
{
  var date = new Date();
  $('#ui-widget-page-bucket').mytab().tabs();
  $('#ui-widget-page-bucket').mytab().tabs("option", "selected", 0);
  $("#ui-widget-page-bucket").mytab().close(function(){ 
		Ext.DOM.RoleBack();
  }, true);
  
  window.UserLayout();
  window.EventRekontestData({ 
	orderby : '',  type: '', page: 0 
  });
  
  
});

</script>
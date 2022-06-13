<script>
/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */

window.percentData  = {
	Bucket : 0	
}

/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */

var objPage = {
	total_page : 0
}

/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
var Role = new Ext.Role("AdminAssignment");
	Role.extend([
		{ title: " ", icon :"", event: "", key :'AssignId' } // if you have other extends event 
	]);
	
/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
Ext.DOM.RoleBack = function(){
	if( Ext.Msg('Are you sure ?').Confirm() ){
		Ext.BackHome();	
	}
}

/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
window.EventClose = function(){
	Ext.DOM.RoleBack();
}


/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 window.EventAdminData  = function( obj )
{
	var frmBucketFilter = Ext.Serialize('frmBucketFilter').getElement();
	$('#ui-widget-bucket-page-id').Spiner 
	({
		url 	: Role.Url('Assign'),
		param 	: Ext.Join(new Array(frmBucketFilter)).object(),
		order   : {
			order_type : obj.type,
			order_by   : obj.orderby,
			order_page : obj.page	
		}, 
		handler : "EventAdminData",
		complete : function( obj ){
			objPage.total_page = $('#ui-total-id-bucket-data-record').html();
			
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


/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
window.EventOnBucket = function(AssignId, obj )
{
	var total_box = Ext.Cmp(AssignId).getValue().length;
	var var_action = Ext.Cmp('frm_bucket_user_action').getValue();
	
	if( obj.checked ){
		if( var_action ==  1 ){
			Ext.Cmp('frm_bucket_user_total').setValue(objPage.total_page); 
		} else if( var_action ==  2 ){
			Ext.Cmp('frm_bucket_user_total').setValue(total_box);
		}
	} else {
		Ext.Cmp('frm_bucket_user_total').setValue(objPage.total_page); 
	}
	
}

/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 window.EventLookup = function( field )
 {
	var checkedbox = Ext.Cmp(field).getValue().length;
	if( checkedbox != 0 ){
	    Ext.Cmp('frm_bucket_user_total').setValue(checkedbox);
	} else {
		Ext.Cmp('frm_bucket_user_total').setValue(objPage.total_page);  
	}
 }
/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  window.ClearDataAdmin = function(){
	 Ext.Serialize('frmBucketFilter').Clear(new Array('frm_admin_record'));
	 new Ext.DOM.SearchDataAdmin();
 }
 
/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 
 window.SearchDataAdmin = function(){
	 new window.EventAdminData({ orderby : '',  type: '', page: 0 }); 
 }
 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 
window.EventSubmit = function()
{
 var frmBucketOption = Ext.Serialize('frmBucketOption');
 var frmBucketFilter = Ext.Serialize('frmBucketFilter');
 var frmButtonAction = Ext.Cmp('frm_bucket_user_action').getValue();
 
 
 //console.log( frmButtonAction );
 
 if( !frmBucketOption.Complete()){
	 Ext.Msg("Form input not complete").Info();
	 return false;
 }
 
 var frmAddVariable = new Array();
 
 if( frmButtonAction == 2 ){
	 frmAddVariable['frm_bucket_id'] = Ext.Cmp("DM_AssignId").getValue()
 }
 
 // ------ process ----------------
  Ext.Ajax
  ({
		url 	: Ext.EventUrl( Role.Url('Submit') ).Apply(),
		method 	: 'POST',
		param 	: Ext.Join( new Array( frmBucketOption.getElement(), 
									   frmBucketFilter.getElement(),
									   frmAddVariable )).object(),
		success   : function( xhr ) {
			Ext.Util( xhr ).proc(function( data ){
				if( data.success == 1 ){
					var callMsgData = window.sprintf("Assign Data .\nTotal:%s", data.row );
					Ext.Msg(callMsgData).Success();
					window.EventSearch();
				}
				else {
					Ext.Msg("Assign Data").Failed();
					return false;
				}
				
			});
		}
  }).post();
	
	
} 

/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
window.EventUpload = function() 
{
	
	Ext.Progress( "ui-widget-image-loading", {
		height  : '17px',  
		title   : 'Please Wait...'
	}).start();
	
// --------------------------------------------------------------
	
	Ext.Ajax
	({
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
			 
			 /*
			var ERR = eval(fn.target.DONE);
			try {	
				if( ERR )
				{
					var CALLBACK = JSON.parse(fn.target.responseText);
					if( (typeof CALLBACK.mesages == "object") && (CALLBACK.mesages !== null) ){
						var msg = "\n";
						for(var i in  CALLBACK.mesages ){
							msg += "Failed : "+ CALLBACK.mesages[i].N +", Success : "+CALLBACK.mesages[i].Y +"\n Blacklist : "+ CALLBACK.mesages[i].B +", Duplicate : "+  CALLBACK.mesages[i].D  +"\n CIF Duplicate(s) : "+CALLBACK.mesages[i].X+"\n";
						}	
						Ext.Msg(msg).Info();
					}
					else{
						Ext.Msg(CALLBACK.mesages).Info();
					}	
					
					Ext.Progress("ui-widget-image-loading").stop();
					
				}	
			}
			catch(e){ alert(e); }*/
			//Ext.Progress("ui-widget-image-loading").stop();
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
  $('.xzselect').chosen();
  $('.select').chosen();
  //$('#frm_bucket_fileupload').toogle();
  //$('#frm_bucket_recsource').toogle();
  
  
  $('.button').css({ 'width' : '40%'});
}

 
 
// ---------------------------------------------------------------------------------------------------------------
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
  
  
 // --------------------------------------------------------------------------------------------------------------
  window.UserLayout();
  window.SearchDataAdmin();
  
  
});

</script>
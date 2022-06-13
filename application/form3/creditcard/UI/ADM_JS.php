<script type="text/javascript">

/* @script JS 	untuk Admin Paper Work 
 * @date 		2017/08/23	
 * @project 	bni tele ANS 
 */

window.EventPaperWorkReload = function(){
	if( typeof( window.AdminPaperWork ) == 'function' ){
		window.AdminPaperWork({});
		window.setTimeout( function(){
			var GlobalScrollTop = $('.main-content-process').innerHeight();
			$('.main-content-process').scrollTop(GlobalScrollTop);
		}, 200);
	}
	return false;
}
/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */	
window.EventRadioValid = function( radio ){	
	if( Ext.Cmp("SV_Cust_KoresValue").getValue() != '' ){
		window.KeepDataValue = Ext.Cmp("SV_Cust_KoresValue").getValue();
	}
	if( radio.value == 605 ){
		Ext.Cmp("SV_Cust_KoresValue").setValue(window.KeepDataValue);
	} else {
		Ext.Cmp("SV_Cust_KoresValue").setValue("");
	}
}
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */		
window.EventPaperWorkSubmit = function(){
	var frmAdminPaperWork = Ext.Serialize('frmAdminPaperWork');
	
	if( !frmAdminPaperWork.Complete(new Array('SV_Cust_KoresValue') ) ){
		Ext.Msg("Form Data Not Complete").Info();
		return false;
	}
	
	var dataConnectUrl = new Ext.EventUrl( new Array('AdminPaperWork','Submit') ); 
		Ext.Ajax
	({
		url 	 : dataConnectUrl.Apply(),
		method	 : 'POST',
		param 	 :	frmAdminPaperWork.Data(),
		complete : function( xhr ){
			Ext.Util( xhr ).proc(function( data ){
				if( data.success ){
					Ext.Msg("Save Paper Work Data").Success();
					window.EventPaperWorkReload();
					return false;
				} else {
					Ext.Msg("Save Paper Work Data").Failed();
					return false;
				}
			});
		}
	}).post();
	
	//console.log(frmAdminPaperWork.Data());
	//window.alert("hello submit");
}
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */		
window.EventPaperWorkReset = function(){
	
// confirmasi ke user apakah yakin mau mengcancel data tersebut.	
	var callMsgData  = Ext.Msg('Are you sure to cancel this form ?').Confirm();
	if( !callMsgData ){
		return false;
	}
	
	
	// delete data Or cancel process konfirm 
	var dataConnectUrl = new Ext.EventUrl( new Array('AdminPaperWork','Cancel') ); 
		Ext.Ajax
	({
		url 	 : dataConnectUrl.Apply(),
		method	 : 'POST',
		param 	 :	{
			SV_Cust_Id : Ext.Cmp('SV_Cust_Id').getValue()
		},
		complete : function( xhr ){
			Ext.Util( xhr ).proc(function( data ){
				if( data.success ){
					Ext.Msg("Cancel Paper Work Data").Success();
					window.EventPaperWorkReload();
					return false;
				} else {
					Ext.Msg("Cancel Paper Work Data").Failed();
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
  
// call may function if ready State 
$(document).ready( function(){
	if( $('form[name="frmAdminPaperWork"]').attr('id') ){
		console.log('load paper work ok');
	}
});

</script>
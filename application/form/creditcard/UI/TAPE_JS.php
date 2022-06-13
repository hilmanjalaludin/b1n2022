<script type="text/javascript">

/**
  * Process Verifikasi Data hanya Terjadi di sisi Client 
  * Browser Menghindari Koneksi Ke DB terus Menerus.
  
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
  
var TAPE = function(){}; 

/**
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
window.EventSubmit = function(){

	var  frmTapenas = Ext.Serialize('frmTapenas');
	var dataConnUrl = Ext.EventUrl( new Array('ProductController','Save'));
	
	var cond = frmTapenas.Required(new Array('txt2','txt5'));
	if( !cond){
		Ext.Msg("Form not complete!").Info();	
		return false;
	}
	Ext.Ajax
	({
		url 	: dataConnUrl.Apply(), 
		method	: 'POST',
		param   : frmTapenas.Data(),
		success  : function( xhr ) {
			Ext.Util( xhr ).proc(function( dataConnServer ){
			if( dataConnServer.success ) {
				Ext.Msg("Save").Success();
				window.location.reload(true);
								
			} else{
				Ext.Msg("Save").Failed();
				return false;
			}
			});
		}
	}).post();

}

window.EventCancel = function(){
	var callbackMsg = Ext.Msg("Do you want to exit from this form.\nAre you sure?").Confirm();
	if( !callbackMsg ){
		return false;
	}
	window.close(this);
	// var asdf=Ext.Cmp('TX_Usg_TransSeq').getValue();
	// alert(asdf);
}

/**
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
$(document).ready(function(){
	
// customize css 	
	$('body').css({
		'padding' : "8px 10px 8px 25px"
	});
	$('.ui-data-cell-1')
	.css({  'width' : '25%' })
	
	$('.ui-data-cell-2')
	.css({  'width' : '75%' }) 
	
	
	// $('.input_text')
	// .css({'background-color': '#FCFDFE' })
	$('.ui-disabled')
	.attr('disabled', true);
	
	
	// on set timeout process 
	// window.setTimeout( function(){
		// window.EventCallculator();
	// }, 500);
	
	
	
});
</script>
 
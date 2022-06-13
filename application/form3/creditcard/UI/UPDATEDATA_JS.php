<script type="text/javascript">

/**
  * Process Verifikasi Data hanya Terjadi di sisi Client 
  * Browser Menghindari Koneksi Ke DB terus Menerus.
  
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
  
var  EXTRADANA = function(){}; 

/**
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
var format = function(num){
    var str = num.toString().replace("$", ""), parts = false, output = [], i = 1, formatted = null;
    if(str.indexOf(",") > 0) {
        parts = str.split(",");
        str = parts[0];
    }
    str = str.split("").reverse();
    for(var j = 0, len = str.length; j < len; j++) {
        if(str[j] != ".") {
            output.push(str[j]);
            if(i%3 == 0 && j < (len - 1)) {
                output.push(".");
            }
            i++;
        }
    }
    formatted = output.reverse().join('');
    return( '' + formatted + ((parts) ? ',' + parts[1].substr(0, 2) : ''));
}

/**
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
window.EventSubmit = function(){

}
/**
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
window.toUcFirst = function( string ) {
    return string.substring(0, 1).toUpperCase() + string.substring(1).toLowerCase();
 }
/**
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
window.EventCancel = function(){
	var callbackMsg = Ext.Msg("Do you want to exit from this form.\nAre you sure?").Confirm();
	if( !callbackMsg ){
		return false;
	}
	window.close(this);
}

/**
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
window.EventUpdate = function (){
	// UpdateCustomer 
	
	var frmDataCustomer = Ext.Serialize('frmDataCustomer'),
		frmDataKartu = Ext.Serialize('frmDataKartu');
		
	console.log( frmDataCustomer.Data() );
	console.log( frmDataKartu.Data() );
	
	var msgUser = Ext.Msg('Pastikan kembali data entry sudah benar !\nApakah Anda yakin akan melanjutkan ?').Confirm();
	if( !msgUser ){
		return false;
	}
	// jika konfirmasi sudah di baca oleh user maka tahap
	// selanjutnya adalah update data tersebut .
	var dataURL = Ext.EventUrl( new Array('UpdateCustomer', 'UpdateData'));
	Ext.Ajax({
		url : dataURL.Apply(),
		method : 'POST',
		param : Ext.Join( new Array( frmDataCustomer.Data(), 
									 frmDataKartu.Data() )).object(),
									 
		success : function( xhr ){
			Ext.Util( xhr ).proc(function( data ){
				if( data.success ){
					Ext.Msg('Update Data').Success();
					return true;
				}
				else {
					Ext.Msg('Update Data').Success();
					return false;
				}
			});
		}
	}).post();
	
	
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
	
});
</script>
 
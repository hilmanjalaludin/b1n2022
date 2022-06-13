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
  
var formatNominal = function( dataval ){
	var dataNominal = dataval.toString().replace(/\./g, "");
	return parseInt(dataNominal);
}

/**
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
window.EventSubmit = function(){
	
// @data from [ok]	
var frmXTradana = Ext.Serialize('frmXTradana'),
	frmDataUsage = Ext.Serialize('frmDataUsage');

 if( !frmXTradana.Complete( new Array('TX_Usg_Penawaran','TX_Usg_Program','TX_Usg_TransId') ) ){
	Ext.Msg("Data Form tidak komplit").Info();
	return false;
 }
 
 // data ajax testing OK sent to object 
 // from process .
 var ProductMaster = frmDataUsage.Data().ProductMaster, 
	 ProductDetail = frmDataUsage.Data().ProductDetail;
	 
 var dataURL = Ext.EventUrl( new Array('ProductController',ProductMaster, ProductDetail) ); 
   Ext.Ajax
 ({
	url 	: dataURL.Apply(),
	method 	: 'POST',
	param 	: frmXTradana.Data(),
	success : function( xhr )  {
	 Ext.Util( xhr ).proc( function( row ){
		// jika proces data form save benar
		// then will test .
		if( row.success ){
			Ext.Msg("Save Form data").Success();
			var TX_Usg_TransId = row.data.TX_Usg_TransId;
			if( parseInt( TX_Usg_TransId ) ){
				Ext.Cmp('TX_Usg_TransId').setValue( TX_Usg_TransId );
			}
			return false;
		}
		// jika proces data form save salah
		// then will test .
		else {
			Ext.Msg("Save Form data").Failed();
			return false;
		}
	});
  }
 }).post();
 
	//console.log( frmXTradana.Data() );
	
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
window.EventCallculatorBatas = function(){
	var jumlahDanaYangDiambil = formatNominal( Ext.Cmp('TX_Usg_JumlahDana').getValue()),
		jumlahDanaYangTersedia = formatNominal( Ext.Cmp('TX_US_AvailDana').getValue());
	
	if( jumlahDanaYangDiambil > jumlahDanaYangTersedia ){
		Ext.Msg("Jumlah dana tidak boleh lebih dari 50% dari Available XD").Info();
		Ext.Cmp('TX_Usg_JumlahDana').setValue( 0 );
		Ext.Cmp('TX_Usg_SimulDana').setValue( 0 );
	}	
} 
/**
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
window.EventSetJumlahDana = function ( data ){
	$(data).val( format($(data).val()));
	Ext.Cmp('TX_Usg_SimulDana').setValue( $(data).val() );
	// window.EventCallculatorBatas 
	window.EventCallculatorBatas();
}
/**
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */

window.EventGetSimulDana = function( data ){
	$(data).val( format($(data).val()));
	Ext.Cmp('TX_Usg_JumlahDana').setValue( $(data).val() );
	window.EventCallculatorBatas();
}

/**
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
window.EventCallculator = function(){
	
// @ver_id  = ''
// @ver_program = '' 

var frmDataUsage = Ext.Serialize('frmDataUsage'),
	frmXTradana = Ext.Serialize('frmXTradana');
	
//setup object data On here .
	
 var dataServerHeader  = {
	VerifyId    : Ext.Cmp('TX_Usg_VerId').getValue(),
	ProgramId   : Ext.Cmp('TX_Usg_ProgramData').getValue(),
	JumlahDana  : Ext.Cmp('TX_Usg_JumlahDana').getValue(),
	SimulDana 	 : Ext.Cmp('TX_Usg_SimulDana').getValue(),
	JumlahTenor : Ext.Cmp('TX_Usg_Tenor').getValue(),
	Penawaran   : Ext.Cmp('TX_Usg_Penawaran').getValue() 
 };

 var ProductMaster = frmDataUsage.getValue('ProductMaster');
 var ProgramDataId = frmDataUsage.getValue('ProductDetail');
 var dataServerURL = Ext.EventUrl( new Array('Simulasi', 'Calculator', ProgramDataId )); 
 
 $('#ui-sim-calculator').loader({
		url : dataServerURL.Apply(),
		method : 'GET',
		param :  dataServerHeader,
		complete : function( xhr ) {
			console.log(xhr);
			$(xhr).css({'height' : '100%' });
		}	
	});
}


/**
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
window.EventSimulasi = function(){
	
	// @ver_id  = ''
	// @ver_program = '' 
var frmDataUsage = Ext.Serialize('frmDataUsage'),
	frmXTradana = Ext.Serialize('frmXTradana');
	
//setup object data On here .
	
 var dataServerHeader  = {
	 VerifyId    : frmXTradana.getValue('TX_Usg_VerId'),
	 ProgramId   : frmDataUsage.getValue('ProductDetail'),
	 JumlahDana  : frmXTradana.getValue('TX_Usg_JumlahDana'),
	 JumlahTenor : frmXTradana.getValue('TX_Usg_Tenor')
 };

 var ProductMaster = frmDataUsage.getValue('ProductMaster');
 var dataServerURL = Ext.EventUrl( new Array('Simulasi', toUcFirst(ProductMaster) )); 
 
// create object window "open"
 var windowSimulasi = Ext.Window({
		url   : dataServerURL.Apply(),
		name  : window.sprintf('windowSimulasi%s',dataServerHeader.VerifyId ),
		left  : 0, top : 0,
		width : 500, height: ($(window).innerHeight()),
		scrollbars : 1, resizeable : 1,
		param: dataServerHeader
 });
 // launher window open
windowSimulasi.popup();
	
//window.alert('under construction');
//return false;
	
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
	window.setTimeout( function(){
		window.EventCallculator();
	}, 500);
	
	
	
});
</script>
 
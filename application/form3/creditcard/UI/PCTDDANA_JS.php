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
	// var values = Ext.Cmp('checkbox_1').getValue();
	// console.log(values)
	// return false
if(Ext.Cmp('TotalTrans').getValue() >= 1 && Ext.Cmp('TX_Usg_TransSeq').getValue()==0){
	alert('Maksimal Transaksi adalah 1');
	return false;
}else{
var frmXTradana = Ext.Serialize('frmXTradana'),
	frmDataUsage = Ext.Serialize('frmDataUsage');
 var TX_Usg_Tigabulan =Ext.Cmp('TX_Usg_Tigabulan').getValue();
 if( !frmXTradana.Complete( new Array( 'TX_Usg_Penawaran',
									   'TX_Usg_Program',
									   'TX_Usg_TransId',
									   'DanaTotal',
									   'TX_Usg_CustId',
									   'TX_Usg_Custno',
									   'TX_Usg_FixID',
									   'TX_Usg_Membal',
									   'TX_US_AvailDana',
									   'TX_Usg_TransSeq',
									   'TX_Usg_Program',
									   'TX_Usg_Sisadana',
									   'TX_Usg_Block') ) ){
	Ext.Msg("Data Form tidak komplit").Info();
	return false;
 }

	// var dataServerHeader  = {
	// 	VerifyId    : Ext.Cmp('TX_Usg_VerId').getValue(),
	// 	ProgramId   : Ext.Cmp('TX_Usg_Tenor').getValue(),
	// 	JumlahDana  : Ext.Cmp('TX_Usg_JumlahDana').getValue(),
	// 	SimulDana 	 : Ext.Cmp('TX_Usg_SimulDana').getValue(),
	// 	JumlahTenor : Ext.Cmp('TX_Usg_Tenor').getValue(),
	// 	Penawaran   : Ext.Cmp('TX_Usg_Penawaran').getValue()
	// };
     var TX_Usg_JumlahDana= Ext.Cmp('TX_Usg_JumlahDana').getValue();

     //var tenors= Ext.Cmp('TX_Usg_Tenors').getValue();
     var tenors= Ext.Cmp('TX_Usg_Tenors').getValue();
     if(tenors == '3' && TX_Usg_JumlahDana < '500.000'){
		Ext.Msg("Gagal  Min Ballance 500.000").Info();
		return false;
	 }else if(tenors == '6' && TX_Usg_JumlahDana < '500.000'){
		Ext.Msg("Gagal  Min Ballance 500.000").Info();
		return false;
	 }else if(tenors == '12' && TX_Usg_JumlahDana < '500.000'){
		Ext.Msg("Gagal  Min Ballance 500.000").Info();
		return false;
	 }else if(tenors == '18' && TX_Usg_JumlahDana < '1.500.000'){
		Ext.Msg("Gagal  Min Ballance 1.500.000").Info();
		return false;
	 }else if(tenors == '24' && TX_Usg_JumlahDana < '1.500.000'){
		Ext.Msg("Gagal  Min Ballance 1.500.000").Info();
		return false;
	 }else if(tenors == '36' && TX_Usg_JumlahDana < '2.000.000'){
		Ext.Msg("Gagal  Min Ballance 2.000.000").Info();
		return false;
	 }

     var ProductMaster = frmDataUsage.Data().ProductMaster,
	 ProductDetail = frmDataUsage.Data().ProductDetail;
     var dataURL = Ext.EventUrl( new Array('ProductController',ProductMaster, ProductDetail) );
	 alert(dataURL)
	 return false
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
			// return false;
			window.location.reload(true);
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
}

window.EditTrans = function(sequence){
	var TXTX_Usg_TransSeq = parseInt(sequence,10);
	var frmedit = Ext.Serialize('frmEdit_'+TXTX_Usg_TransSeq);

	var TX_Usg_Statement = Ext.Cmp('TXTX_Usg_Statement'+TXTX_Usg_TransSeq).getValue();
	var TX_Usg_ProgramData = Ext.Cmp('TXTX_Usg_ProgramData'+TXTX_Usg_TransSeq).getValue();
	var TX_Usg_NamaRekening = Ext.Cmp('TXTX_Usg_NamaRekening'+TXTX_Usg_TransSeq).getValue();
	var TX_Usg_NoRekening = Ext.Cmp('TXTX_Usg_NoRekening'+TXTX_Usg_TransSeq).getValue();
	var TX_Usg_NamaBank = Ext.Cmp('TXTX_Usg_NamaBank'+TXTX_Usg_TransSeq).getValue();
	var TX_Usg_Cabang = Ext.Cmp('TXTX_Usg_Cabang'+TXTX_Usg_TransSeq).getValue();
	var TX_Usg_JumlahDana = Ext.Cmp('TXTX_Usg_JumlahDana'+TXTX_Usg_TransSeq).getValue();
	var TX_Usg_Tenor = parseInt(Ext.Cmp('TXTX_Usg_Tenor'+TXTX_Usg_TransSeq).getValue(),10);

	Ext.Cmp('TX_Usg_Statement').setValue( TX_Usg_Statement );
	Ext.Cmp('TX_Usg_ProgramData').setValue( TX_Usg_ProgramData );
	Ext.Cmp('TX_Usg_NamaRekening').setValue( TX_Usg_NamaRekening );
	Ext.Cmp('TX_Usg_NoRekening').setValue( TX_Usg_NoRekening );
	Ext.Cmp('TX_Usg_NamaBank').setValue( TX_Usg_NamaBank );
	Ext.Cmp('TX_Usg_Cabang').setValue( TX_Usg_Cabang );
	Ext.Cmp('TX_Usg_JumlahDana').setValue( TX_Usg_JumlahDana );
	Ext.Cmp('TX_Usg_Tenor').setValue( TX_Usg_Tenor );
	Ext.Cmp('TX_Usg_TransSeq').setValue( TXTX_Usg_TransSeq );
	// $("#TX_Usg_TransSequence").val("tinkumaster");

	window.scrollTo(10, 10);
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

window.Eventaddnew = function(){
	window.location.reload(true);
	Ext.Cmp('TX_Usg_TransSeq').setValue('0');
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

window.DeleteTrans = function(sequence, transid, verid){
	var callbacksm = Ext.Msg("Are You Sure?").Confirm();
	if(!callbacksm){
		return false;
	}else{
		// alert("Deleting..."+sequence+transid+verid);
		// var ProductMaster = frmDataUsage.Data().ProductMaster, ProductDetail = frmDataUsage.Data().ProductDetail;
		var dataURL = Ext.EventUrl( new Array('ProductController','DeleteTransaction') );

		Ext.Ajax({
			url		: dataURL.Apply(),
			method	: 'POST',
			param	: {
				SequenceNo : sequence,
				TransacId  : transid,
				VerifycaId : verid
			},
			success	: function( xhr ) {
				console.log(xhr);
				Ext.Util( xhr ).proc( function( row ){
					if( row.success ){
						Ext.Msg("Delete Transaction").Success();
						window.location.reload(true);
					} else {
						Ext.Msg("Delete Transaction").Failed();
						return false;
					}
				});
			}
		}).post();
	}
}

window.Pick = function(key) {
	var check = document.getElementById('checkbox_'+key).checked
	var tenor = document.getElementById('TX_Usg_Tenor_'+key)
	if(check === true) {
		$('#TX_Usg_Tenor_'+key).prop('disabled', false)
	} else {
		$('#TX_Usg_Tenor_'+key).prop('disabled', true)
	}
}

window.pickTenor = function(tenor, key) {
	var amount = document.getElementById('AMOUNT_'+key).value
	var rate = document.getElementById('PRD_Data_Kode_'+key).value
	var replaceRate = rate.replace('%', '')
	var installment = null;
	if(replaceRate == 0 || replaceRate == '0') {
		installment = (amount/tenor.value)+0
	} else {
		installment = (amount/tenor.value)+(amount*(replaceRate/100))
	}
	document.getElementById('installment_'+key).innerHTML = window.formatRP(installment.toFixed())
}

window.formatRP = function(bilangan) {
	var	number_string = bilangan.toString(),
	sisa 	= number_string.length % 3,
	rupiah 	= number_string.substr(0, sisa),
	ribuan 	= number_string.substr(sisa).match(/\d{3}/g);
		
	if (ribuan) {
		separator = sisa ? ',' : '';
		rupiah += separator + ribuan.join(',');
	}
	return rupiah
}

window.DeleteTransPCTD = function(id_frm_pctd, ref_id){
	var callbacksm = Ext.Msg("Are You Sure?").Confirm();
	if(!callbacksm){
		return false;
	}else{
		var dataURL = Ext.EventUrl( new Array('ProductController','DeleteTransactionPctd') );

		Ext.Ajax({
			url		: dataURL.Apply(),
			method	: 'POST',
			param	: {
				id_frm_pctd : id_frm_pctd,
				ref_id : parseInt(ref_id)
			},
			success	: function( xhr ) {
				console.log(xhr);
				Ext.Util( xhr ).proc( function( row ){
					if( row.success ){
						Ext.Msg("Delete Transaction").Success();
						window.location.reload(true);
					} else {
						Ext.Msg("Delete Transaction").Failed();
						return false;
					}
				});
			}
		}).post();
	}
}
/**
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
window.EventCallculatorBatas = function(){

	var jumlahDanaYangDiambil = formatNominal( Ext.Cmp('TX_Usg_JumlahDana').getValue());
	var jumlahDanaYangTersedia = formatNominal( Ext.Cmp('TX_US_AvailDana').getValue());
	var DanaTotal = formatNominal( Ext.Cmp('DanaTotal').getValue());
	var jumlahDana = 0;

	// kalo mau 50% dibagi 2 transaksi hapus remark dari kondisi dibawah
	// if(DanaTotal > 0){
		// jumlahDana = jumlahDanaYangTersedia - DanaTotal;
	// }else if(!DanaTotal){
		// jumlahDana = jumlahDanaYangTersedia;
	// }

	//remark var dibawah ini kalo kondisi diatas ngga di remark
	var TX_Usg_Sisadana = Ext.Cmp('TX_Usg_Sisadana').getValue();
		TX_Usg_Sisadana = parseInt(TX_Usg_Sisadana);

	//jumlahDana = jumlahDanaYangTersedia;
	if( jumlahDanaYangDiambil > TX_Usg_Sisadana ){
		Ext.Msg("Jumlah dana tidak Mencukupi").Info();
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


window.EventBallance = function( data ){
	$(data).val(format($(data).val()));
	var tot= Ext.Cmp('TX_Usg_JumlahDana').getValue();
	// console.log(tot)
	Ext.Cmp('TX_Usg_SimulDana').setValue(tot)
	// window.EventCallculatorBatas();
}

/**
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */

window.EventCallculator = function(){

var frmDataUsage = Ext.Serialize('frmDataUsage'),
	frmXTradana = Ext.Serialize('frmXTradana');

 var dataServerHeader  = {
	VerifyId    : Ext.Cmp('TX_Usg_VerId').getValue(),
	ProgramId   : Ext.Cmp('TX_Usg_Tenor').getValue(),
	JumlahDana  : Ext.Cmp('TX_Usg_JumlahDana').getValue(),
	SimulDana 	 : Ext.Cmp('TX_Usg_SimulDana').getValue(),
	JumlahTenor : Ext.Cmp('TX_Usg_Tenor').getValue(),
	Penawaran   : Ext.Cmp('TX_Usg_Penawaran').getValue()
 };
 var dataServers  = {
	ProgramId   : Ext.Cmp('TX_Usg_Tenor').getValue(),
  };
 var ProductMaster = frmDataUsage.getValue('ProductMaster');
 var ProgramDataId = frmDataUsage.getValue('ProductDetail');


 var idprogram=Ext.EventUrl(new Array('Simulasi', 'getDataValue', Ext.Cmp('TX_Usg_Tenor').getValue()));
  $.ajax({
	  method : 'GET',
	  param:dataServers,
	  url : idprogram.Apply(),
	  success:function(data){
		var json = data,
			obj = JSON.parse(json);
			console.log('slsllsl',obj.kode)
			$("#TX_Usg_ProgramData").val(obj.kode);
			$("#TX_Usg_Tenors").val(obj.tenor);
			$("#PRD_Data_Id").val(obj.PRD_Data_Id);
	  }
  });

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

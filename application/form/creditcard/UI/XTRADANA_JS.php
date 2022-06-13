<script type="text/javascript">
	/**
  * Process Verifikasi Data hanya Terjadi di sisi Client 
  * Browser Menghindari Koneksi Ke DB terus Menerus.
  
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */


	var EXTRADANA = function() {};

	/**
	 * @param  [type] $CustomerId [description]
	 * @return [type]             [description]
	 */

	var format = function(num) {
		var str = num.toString().replace("$", ""),
			parts = false,
			output = [],
			i = 1,
			formatted = null;
		if (str.indexOf(",") > 0) {
			parts = str.split(",");
			str = parts[0];
		}
		str = str.split("").reverse();
		for (var j = 0, len = str.length; j < len; j++) {
			if (str[j] != ".") {
				output.push(str[j]);
				if (i % 3 == 0 && j < (len - 1)) {
					output.push(".");
				}
				i++;
			}
		}
		formatted = output.reverse().join('');
		return ('' + formatted + ((parts) ? ',' + parts[1].substr(0, 2) : ''));
	}

	/**
	 * @param  [type] $CustomerId [description]
	 * @return [type]             [description]
	 */

	var formatNominal = function(dataval) {
		var dataNominal = dataval.toString().replace(/\./g, "");
		return parseInt(dataNominal);
	}

	/**
	 * @param  [type] $CustomerId [description]
	 * @return [type]             [description]
	 */
	window.EventSubmit = function() {
		if (Ext.Cmp('TotalTrans').getValue() >= 2 && Ext.Cmp('TX_Usg_TransSeq').getValue() == 0) {
			alert('Maksimal Transaksi adalah 2');
			return false;
		} else {
			// @data from [ok]	
			var frmXTradana = Ext.Serialize('frmXTradana'),
				frmDataUsage = Ext.Serialize('frmDataUsage');

			if (!frmXTradana.Complete(new Array('TX_Usg_Penawaran',
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
					'TX_Usg_PerisaiPlus',
					'TX_Usg_Block'))) {
				Ext.Msg("Data Form tidak komplit").Info();
				return false;
			}

			// data ajax testing OK sent to object 
			// from process .
			var ProductMaster = frmDataUsage.Data().ProductMaster,
				ProductDetail = frmDataUsage.Data().ProductDetail;

			var dataURL = Ext.EventUrl(new Array('ProductController', ProductMaster, ProductDetail));
			Ext.Ajax({
				url: dataURL.Apply(),
				method: 'POST',
				param: frmXTradana.Data(),
				success: function(xhr) {
					Ext.Util(xhr).proc(function(row) {
						// jika proces data form save benar
						// then will test .
						if (row.success) {
							Ext.Msg("Save Form data").Success();
							var TX_Usg_TransId = row.data.TX_Usg_TransId;
							if (parseInt(TX_Usg_TransId)) {
								Ext.Cmp('TX_Usg_TransId').setValue(TX_Usg_TransId);
							}
							// localstorage control status usage di daftar kartu
							// add dida localstorage
							localStorage.setItem('statusApproved_<?php echo $_GET['VerificationId'];?>', 1)
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

	window.EditTrans = function(sequence) {
		var TXTX_Usg_TransSeq = parseInt(sequence, 10);
		var frmedit = Ext.Serialize('frmEdit_' + TXTX_Usg_TransSeq);

		var TX_Usg_Statement = Ext.Cmp('TXTX_Usg_Statement' + TXTX_Usg_TransSeq).getValue();
		var TX_Usg_ProgramData = Ext.Cmp('TXTX_Usg_ProgramData' + TXTX_Usg_TransSeq).getValue();
		var TX_Usg_NamaRekening = Ext.Cmp('TXTX_Usg_NamaRekening' + TXTX_Usg_TransSeq).getValue();
		var TX_Usg_NoRekening = Ext.Cmp('TXTX_Usg_NoRekening' + TXTX_Usg_TransSeq).getValue();
		var TX_Usg_NamaBank = Ext.Cmp('TXTX_Usg_NamaBank' + TXTX_Usg_TransSeq).getValue();
		var TX_Usg_Cabang = Ext.Cmp('TXTX_Usg_Cabang' + TXTX_Usg_TransSeq).getValue();
		var TX_Usg_JumlahDana = Ext.Cmp('TXTX_Usg_JumlahDana' + TXTX_Usg_TransSeq).getValue();
		var TX_Usg_Tenor = parseInt(Ext.Cmp('TXTX_Usg_Tenor' + TXTX_Usg_TransSeq).getValue(), 10);

		Ext.Cmp('TX_Usg_Statement').setValue(TX_Usg_Statement);
		Ext.Cmp('TX_Usg_ProgramData').setValue(TX_Usg_ProgramData);
		Ext.Cmp('TX_Usg_NamaRekening').setValue(TX_Usg_NamaRekening);
		Ext.Cmp('TX_Usg_NoRekening').setValue(TX_Usg_NoRekening);
		Ext.Cmp('TX_Usg_NamaBank').setValue(TX_Usg_NamaBank);
		Ext.Cmp('TX_Usg_Cabang').setValue(TX_Usg_Cabang);
		Ext.Cmp('TX_Usg_JumlahDana').setValue(TX_Usg_JumlahDana);
		Ext.Cmp('TX_Usg_Tenor').setValue(TX_Usg_Tenor);
		Ext.Cmp('TX_Usg_TransSeq').setValue(TXTX_Usg_TransSeq);
		// $("#TX_Usg_TransSequence").val("tinkumaster");

		window.scrollTo(10, 10);
	}
	/**
	 * @param  [type] $CustomerId [description]
	 * @return [type]             [description]
	 */

	window.toUcFirst = function(string) {
		return string.substring(0, 1).toUpperCase() + string.substring(1).toLowerCase();
	}
	/**
	 * @param  [type] $CustomerId [description]
	 * @return [type]             [description]
	 */

	window.Eventaddnew = function() {
		window.location.reload(true);
		Ext.Cmp('TX_Usg_TransSeq').setValue('0');
	}
	
	window.EventCancel = function() {
		var callbackMsg = Ext.Msg("Do you want to exit from this form.\nAre you sure?").Confirm();
		if (!callbackMsg) {
			return false;
		}
		window.close(this);
		// var asdf=Ext.Cmp('TX_Usg_TransSeq').getValue();
		// alert(asdf);
	}

	window.DeleteTrans = function(sequence, transid, verid, tot_trans, custID) {
		//var callbacksm = Ext.Msg("Are You Sure?").Confirm();
		var callbacksm;
		if (sequence == 1 && tot_trans > 1) {
			callbacksm = Ext.Msg("If you delete this transaction, it will delete all transaction data, are you sure?").Confirm();
		} else {
			callbacksm = Ext.Msg("Are You Sure?").Confirm();
		}
		if (!callbacksm) {
			return false;
		} else {
			// alert("Deleting..."+sequence+transid+verid);
			// var ProductMaster = frmDataUsage.Data().ProductMaster, ProductDetail = frmDataUsage.Data().ProductDetail;
			var dataURL = Ext.EventUrl(new Array('ProductController', 'DeleteTransaction'));

			Ext.Ajax({
				url: dataURL.Apply(),
				method: 'POST',
				param: {
					SequenceNo: sequence,
					TransacId: transid,
					VerifycaId: verid,
					custID: custID
				},
				success: function(xhr) {
					console.log(xhr);
					Ext.Util(xhr).proc(function(row) {
						if (row.success) {
							if (sequence == 1 && tot_trans > 1) {
								Ext.Msg("Delete All Transaction").Success();
							} else {
								Ext.Msg("Delete Transaction").Success();
							}
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
	window.EventCallculatorBatas = function() {
		var jumlahDanaYangDiambil = formatNominal(Ext.Cmp('TX_Usg_JumlahDana').getValue());
		var jumlahDanaYangTersedia = formatNominal(Ext.Cmp('TX_US_AvailDana').getValue());
		var DanaTotal = formatNominal(Ext.Cmp('DanaTotal').getValue());
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
		if (jumlahDanaYangDiambil > TX_Usg_Sisadana) {
			Ext.Msg("Jumlah dana tidak Mencukupi").Info();
			Ext.Cmp('TX_Usg_JumlahDana').setValue(0);
			Ext.Cmp('TX_Usg_SimulDana').setValue(0);
		}
	}
	/**
	 * @param  [type] $CustomerId [description]
	 * @return [type]             [description]
	 */

	window.EventSetJumlahDana = function(data) {
		$(data).val(format($(data).val()));
		Ext.Cmp('TX_Usg_SimulDana').setValue($(data).val());
		// window.EventCallculatorBatas 
		window.EventCallculatorBatas();
	}
	/**
	 * @param  [type] $CustomerId [description]
	 * @return [type]             [description]
	 */

	window.EventGetSimulDana = function(data) {
		$(data).val(format($(data).val()));
		Ext.Cmp('TX_Usg_JumlahDana').setValue($(data).val());
		window.EventCallculatorBatas();
	}

	/**
	 * @param  [type] $CustomerId [description]
	 * @return [type]             [description]
	 */

	window.EventCallculator = function() {

		// @ver_id  = ''
		// @ver_program = '' 

		var frmDataUsage = Ext.Serialize('frmDataUsage'),
			frmXTradana = Ext.Serialize('frmXTradana');

		//setup object data On here .

		var dataServerHeader = {
			VerifyId: Ext.Cmp('TX_Usg_VerId').getValue(),
			ProgramId: Ext.Cmp('TX_Usg_ProgramData').getValue(),
			JumlahDana: Ext.Cmp('TX_Usg_JumlahDana').getValue(),
			SimulDana: Ext.Cmp('TX_Usg_SimulDana').getValue(),
			JumlahTenor: Ext.Cmp('TX_Usg_Tenor').getValue(),
			Penawaran: Ext.Cmp('TX_Usg_Penawaran').getValue()
		};

		Ext.Ajax({
			url: Ext.EventUrl(['DataVerification', 'pencarian_programdetail']).Apply(),
			method: 'POST',
			param: {
				ProgramId: Ext.Cmp('TX_Usg_ProgramData').getValue(),
			},
			ERROR: function(e) {

				Ext.Util(e).proc(function(response) {

					// console.log(JSON.stringify(response.status['PRD_Data_Id']))
					var cekData = response.status['PRD_Data_Tenor'].split(",")
					var content = "<select type='combo' name='TX_Usg_Tenor' id='TX_Usg_Tenor' class='select long ui-select-data'><option value=''> --choose -- </option>"
					for (var index = 0; index < cekData.length; index++) {
						var element = cekData[index];
						content += "<option value='" + element + "'> " + element + " </option>"
					}
					content += "</select>"
					document.getElementById('tenorss').innerHTML = content;
				});

				// Ext.Util(e).proc(function(response) {
				// 	// alert(response.status);
				// 	alert(JSON.stringify(response.status['PRD_Data_Tenor']));
				// });

			}
		}).post();



		//  if(Ext.Cmp('TX_Usg_ProgramData').getValue() == 31){
		// 	document.getElementById('tenorss').innerHTML = "<select type='combo' name='TX_Usg_Tenor' id='TX_Usg_Tenor' class='select long ui-select-data'><option value=''> --choose -- </option><option value='3'>3</option><option value='6'>6</option><option value='9'>9</option></select>";
		//  }
		//  else if(Ext.Cmp('TX_Usg_ProgramData').getValue() == 56){
		// 	document.getElementById('tenorss').innerHTML = "<select type='combo' name='TX_Usg_Tenor' id='TX_Usg_Tenor' class='select long ui-select-data'><option value=''> --choose -- </option><option value='3'>3</option><option value='6'>6</option><option value='9'>9</option><option value='12'>12</option></select>";
		//  }
		//  else if(Ext.Cmp('TX_Usg_ProgramData').getValue() == 57){
		// 	document.getElementById('tenorss').innerHTML = "<select type='combo' name='TX_Usg_Tenor' id='TX_Usg_Tenor' class='select long ui-select-data'><option value=''> --choose -- </option><option value='3'>3</option><option value='6'>6</option><option value='9'>9</option><option value='12'>12</option></select>";
		//  }
		//  else if(Ext.Cmp('TX_Usg_ProgramData').getValue() == 32){
		// 	document.getElementById('tenorss').innerHTML = "<select type='combo' name='TX_Usg_Tenor' id='TX_Usg_Tenor' class='select long ui-select-data'><option value=''> --choose -- </option><option value='12'>12</option><option value='18'>18</option><option value='24'>24</option></select>";
		//  }
		//  else if(Ext.Cmp('TX_Usg_ProgramData').getValue() == 22){
		// 	document.getElementById('tenorss').innerHTML = "<select type='combo' name='TX_Usg_Tenor' id='TX_Usg_Tenor' class='select long ui-select-data'><option value=''> --choose -- </option><option value='12'>12</option><option value='18'>18</option><option value='24'>24</option><option value='36'>36</option></select>";
		//  }else if(Ext.Cmp('TX_Usg_ProgramData').getValue() == 5){
		// 	document.getElementById('tenorss').innerHTML = "<select type='combo' name='TX_Usg_Tenor' id='TX_Usg_Tenor' class='select long ui-select-data'><option value=''> --choose -- </option><option value='3'>3</option><option value='6'>6</option><option value='9'>9</option><option value='12'>12</option><option value='18'>18</option></select>";
		//  }else if(Ext.Cmp('TX_Usg_ProgramData').getValue() == 15){
		// 	document.getElementById('tenorss').innerHTML = "<select type='combo' name='TX_Usg_Tenor' id='TX_Usg_Tenor' class='select long ui-select-data'><option value=''> --choose -- </option><option value='3'>3</option><option value='6'>6</option><option value='9'>9</option><option value='12'>12</option><option value='18'>18</option><option value='24'>24</option></select>";
		//  }
		//  else if(Ext.Cmp('TX_Usg_ProgramData').getValue() == 52){
		// 	document.getElementById('tenorss').innerHTML = "<select type='combo' name='TX_Usg_Tenor' id='TX_Usg_Tenor' class='select long ui-select-data'><option value=''> --choose -- </option><option value='3'>3</option><option value='6'>6</option><option value='9'>9</option><option value='12'>12</option></select>";
		//  }
		//  else if(Ext.Cmp('TX_Usg_ProgramData').getValue() == 58){
		// 	document.getElementById('tenorss').innerHTML = "<select type='combo' name='TX_Usg_Tenor' id='TX_Usg_Tenor' class='select long ui-select-data'><option value=''> --choose -- </option><option value='3'>3</option><option value='6'>6</option><option value='9'>9</option><option value='12'>12</option></select>";
		//  }
		//  else{
		// 	document.getElementById('tenorss').innerHTML = "<select type='combo' name='TX_Usg_Tenor' id='TX_Usg_Tenor' class='select long ui-select-data'><option value=''> --choose -- </option><option value='12'>12</option><option value='18'>18</option><option value='24'>24</option></select>";
		//  }

		var ProductMaster = frmDataUsage.getValue('ProductMaster');
		var ProgramDataId = frmDataUsage.getValue('ProductDetail');
		var dataServerURL = Ext.EventUrl(new Array('Simulasi', 'Calculator', ProgramDataId));

		$('#ui-sim-calculator').loader({
			url: dataServerURL.Apply(),
			method: 'GET',
			param: dataServerHeader,
			complete: function(xhr) {
				console.log(xhr);
				$(xhr).css({
					'height': '100%'
				});
			}
		});
	}


	/**
	 * @param  [type] $CustomerId [description]
	 * @return [type]             [description]
	 */

	window.EventSimulasi = function() {

		// @ver_id  = ''
		// @ver_program = '' 
		var frmDataUsage = Ext.Serialize('frmDataUsage'),
			frmXTradana = Ext.Serialize('frmXTradana');

		//setup object data On here .

		var dataServerHeader = {
			VerifyId: frmXTradana.getValue('TX_Usg_VerId'),
			ProgramId: frmDataUsage.getValue('ProductDetail'),
			JumlahDana: frmXTradana.getValue('TX_Usg_JumlahDana'),
			JumlahTenor: frmXTradana.getValue('TX_Usg_Tenor')
		};

		var ProductMaster = frmDataUsage.getValue('ProductMaster');
		var dataServerURL = Ext.EventUrl(new Array('Simulasi', toUcFirst(ProductMaster)));

		// create object window "open"
		var windowSimulasi = Ext.Window({
			url: dataServerURL.Apply(),
			name: window.sprintf('windowSimulasi%s', dataServerHeader.VerifyId),
			left: 0,
			top: 0,
			width: 500,
			height: ($(window).innerHeight()),
			scrollbars: 1,
			resizeable: 1,
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
	
	//event Perisai Plus Confirmation 20211126
	window.updatePerisaiPlus = function(pplus){
		var dataURL		= Ext.EventUrl(new Array('ProductController', 'updatePerisaiPlus'));
		var CustomerId	= Ext.Cmp('TX_Usg_CustId').getValue();
		var Fixid	= Ext.Cmp('TX_Usg_FixID').getValue();
		
		Ext.Ajax({
			url: dataURL.Apply(),
			method: 'POST',
			param: {CustomerId:CustomerId, Fixid:Fixid, pplus:pplus},
			success: function(xhr) {
				Ext.Util(xhr).proc(function(row) {
					console.info(row);
					if (row.success) {
						// $('#TX_Usg_PerisaiPlus').attr('checked', true);
						// $('#btnPerisaiPlus').attr('disabled', false);
						// $('#btnPerisaiPlus').css('background-color','#0D98B0');
					}
					else {
						// $('#TX_Usg_PerisaiPlus').attr('checked', false);
						// $('#btnPerisaiPlus').attr('disabled', true);
						// $('#btnPerisaiPlus').css('background-color','#D3D3D3');
					}
				});
			}
		}).post();
	}
	
	window.EventPerisaiPlus = function(){
		$( "#dialog-confirm" ).dialog({
			resizable: false,
			height: "auto",
			width: 400,
			modal: true,
			buttons: {
				"Batal": function() {
					$( this ).dialog( "close" );
				},
				"Tidak Setuju": function() {
					var pplus = 0;
					window.updatePerisaiPlus(pplus);
					$( this ).dialog( "close" );
					$('#TX_Usg_PerisaiPlus').attr('checked', false);
				},
				"Setuju": function() {
					var pplus = 1;
					window.updatePerisaiPlus(pplus);
					$( this ).dialog( "close" );
					// $('#TX_Usg_PerisaiPlus').attr('checked');
					$('#TX_Usg_PerisaiPlus').attr('checked', true);
				}
			}
		});
	}
	
	window.checkFormUsage = function(){
		var dataURL		= Ext.EventUrl(new Array('ProductController', 'checkFormUsage'));
		var CustomerId	= Ext.Cmp('TX_Usg_CustId').getValue();
		var Fixid	= Ext.Cmp('TX_Usg_FixID').getValue();
		
		Ext.Ajax({
			url: dataURL.Apply(),
			method: 'POST',
			param: {CustomerId:CustomerId, Fixid:Fixid},
			success: function(xhr) {
				Ext.Util(xhr).proc(function(row) {
					console.log('perisaiplus',row.jumlah);
					if (row.jumlah>0) {
						if(row.PerisaiPlus>0){
							$('#TX_Usg_PerisaiPlus').attr('checked', true);
							$('#btnPerisaiPlus').attr('disabled', true);
							$('#btnPerisaiPlus').css('background-color','#D3D3D3');
						}else if(row.PerisaiPlus<1){
							$('#TX_Usg_PerisaiPlus').attr('checked', false);
						}
						// $('#btnPerisaiPlus').attr('disabled', false);
						// $('#btnPerisaiPlus').css('background-color','#0D98B0');
					}
					else {
						$('#TX_Usg_PerisaiPlus').attr('checked', false);
						$('#btnPerisaiPlus').attr('disabled', true);
						$('#btnPerisaiPlus').css('background-color','#D3D3D3');
					}
				});
			}
		}).post();
	}
	
	window.getPerisaiPlusStatus = function(){
		var dataURL		= Ext.EventUrl(new Array('ProductController', 'getPerisaiPlusStatus'));
		var CustomerId	= Ext.Cmp('TX_Usg_CustId').getValue();
		var Fixid	= Ext.Cmp('TX_Usg_FixID').getValue();
		
		Ext.Ajax({
			url: dataURL.Apply(),
			method: 'POST',
			param: {CustomerId:CustomerId, Fixid:Fixid},
			success: function(xhr) {
				Ext.Util(xhr).proc(function(row) {
					console.info(row);
					if (row.status == 'Y') {
						// $('#TX_Usg_PerisaiPlus').attr('checked', true);
						$('#btnPerisaiPlus').attr('disabled', true);
						$('#btnPerisaiPlus').css('background-color','#D3D3D3');
					}
					else if(row.status == 'T') {
						window.checkFormUsage();
						// $('#TX_Usg_PerisaiPlus').attr('checked', false);
						$('#btnPerisaiPlus').attr('disabled', false);
						$('#btnPerisaiPlus').css('background-color','#0D98B0');
					}
				});
			}
		}).post();
	}
	//end event Perisai Plus Confirmation 20211126
	
	
	$(document).ready(function() {

		// customize css 	
		$('body').css({
			'padding': "8px 10px 8px 25px"
		});
		$('.ui-data-cell-1')
			.css({
				'width': '25%'
			})

		$('.ui-data-cell-2')
			.css({
				'width': '75%'
			})


		// $('.input_text')
		// .css({'background-color': '#FCFDFE' })
		$('.ui-disabled')
			.attr('disabled', true);


		// on set timeout process 
		window.setTimeout(function() {
			window.EventCallculator();
		}, 500);

		// add dida localstorage
		if($("#TotalTrans").val() >= 1) {
			localStorage.setItem('statusApproved_<?php echo $_GET['VerificationId'];?>', 1)
		}
		
		window.getPerisaiPlusStatus();
	});
</script>
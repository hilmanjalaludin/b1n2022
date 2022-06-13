<script type="text/javascript">
	/**
  * Process Verifikasi Data hanya Terjadi di sisi Client 
  * Browser Menghindari Koneksi Ke DB terus Menerus.
  
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */


	var USAGE = function() {},
		verifyDataJsonServer = {},
		verifyKartuJsonServer = {};

	/**
	 * @param  [type] $CustomerId [description]
	 * @return [type]             [description]
	 */
	window.VerificationSessionLoger = function(dataSession) {
		var dataClientMasterLogerUrl = Ext.EventUrl(new Array('DataVerification', 'DataSessionLoger'));
		Ext.Ajax({
			url: dataClientMasterLogerUrl.Apply(),
			method: 'POST',
			param: {
				VS_SessionId: dataSession.session,
				VS_CustId: dataSession.custid,
				VS_Status: dataSession.status
			},
			success: function(xhr) {
				Ext.Util(xhr).proc(function(data) {
					if (data.success) {
						console.log('session loger OK');
					}
				});
			}
		}).post();
	}

	/**
	 * @param  [type] $CustomerId [description]
	 * @return [type]             [description]
	 */

	window.VerificationDataKartuLoger = function(dataClientKartu) {

		// console.log(dataClientKartu);
		// setiap data yang di verifikasi akan di catat hasil
		// status -nya, namun hanya untuk data kartu saja tidak 
		// untuk master.

		var dataVerifikasi = {
			VH_Data_Session: dataClientKartu.session,
			VH_Data_CustId: dataClientKartu.custid,
			VH_Data_VerStatus: dataClientKartu.status,
			VH_Data_Name: dataClientKartu.field,
			VH_Data_Value: dataClientKartu.value,
			VH_Data_SetupId: dataClientKartu.setupid,
			VH_Data_VerId: dataClientKartu.verifyid
		}
		// process data on here <kirim data ke server> 
		var dataClientMasterLogerUrl = Ext.EventUrl(new Array('DataVerification', 'DataKartuLoger'));
		Ext.Ajax({
			url: dataClientMasterLogerUrl.Apply(),
			method: 'POST',
			param: dataVerifikasi,
			success: function(xhr) {
				console.log(xhr);
			}
		}).post();
	}

	/**
	 * @param  [type] $CustomerId [description]
	 * @return [type]             [description]
	 */

	window.VerificationDataMasterLoger = function(dataClientMaster) {

		// 	console.log(dataClientMaster);
		// setiap data yang di verifikasi akan di catat hasil
		// status-nya , namun hanya untuk data master saja tidak 
		// untuk daftar kartu.

		var dataVerifikasi = {
			VH_Data_Session: dataClientMaster.session,
			VH_Data_CustId: dataClientMaster.custid,
			VH_Data_VerStatus: dataClientMaster.status,
			VH_Data_SetupId: dataClientMaster.id,
			VH_Data_Name: dataClientMaster.field,
			VH_Data_Value: dataClientMaster.value
		};
		// kirim data ke server 
		// dataClientMasterLogerSite.post(); 
		var dataClientMasterLogerUrl = Ext.EventUrl(new Array('DataVerification', 'DataMasterLoger'));
		Ext.Ajax({
			url: dataClientMasterLogerUrl.Apply(),
			method: 'POST',
			param: dataVerifikasi,
			success: function(xhr) {
				console.log(xhr);
			}
		}).post();
	}

	/**
	 * @param  [type] $CustomerId [description]
	 * @return [type]             [description]
	 */

	window.VerificationIdentify = function() {
		// sent data to server for request confirm proces 
		// check validation data .
		var CustomerId = Ext.Cmp('CustomerId').getValue(), // cross ID::<view:?/*_contact_detail/>
			CampaignId = Ext.Cmp('CampaignId').getValue(), // cross ID::<view:?/*_contact_detail/>
			ProductId = Ext.Cmp('ProductId').getValue(),
			ProductName = Ext.Cmp('ProductName').getValue();

		var row = Ext.Json('DataVerification/VerificationIdentify', {
			CustomerId: CustomerId,
			CampaignId: CampaignId,
			ProductId: ProductId
		});
		// row.dataItemEach data row 
		row.dataItemEach(function(row, xhr) {
			verifyDataJsonServer = row[CustomerId];
		});
	}

	/**
	 * @param  [type] $CustomerId [description]
	 * @return [type]             [description]
	 */

	window.VerificationDataRefresh = function() {
		// bagi dengan data yang harus di verifikasi 
		// jika nilai sama dengan total_yang salah = total_yang_harus di verifikasi 
		// maka load data .


		var dataTotDataCounter = verifyDataJsonServer.total,
			dataTotDataProcess = verifyDataJsonServer.process,
			dataTotDataVerify = verifyDataJsonServer.verify;

		console.log(window.sprintf('total:%s, proces : %s, verify : %s', dataTotDataCounter, dataTotDataProcess, dataTotDataVerify));
		if ((dataTotDataVerify < dataTotDataCounter) &&
			(dataTotDataProcess == dataTotDataCounter)) {
			// jika user memilih untuk reload data  
			if (typeof(window.PaperWork) == 'function') {
				var callBackMsgVerification = Ext.Msg("Data Yang di verifikasi belum Komplit ..!\nApakah anda akan melakukan Verifikasi Ulang ?").Confirm();
				if (!callBackMsgVerification) {
					return false;
				}
				window.PaperWork({});
			}
		}
	}

	/**
	 * @param  [type] $CustomerId [description]
	 * @return [type]             [description]
	 */

	window.VerifikasiDaftarKartuStyle = function() {
		// jika peocess verifikasi data gagal maka disabled button untuk 
		// check verifikasi daftar kartu.
		if (window.VerifikasiDataMasterStatus()) {
			$('.field-after-verifikasi').each(function() {
				$(this).attr('disabled', false);
			});

			$('.field-after-state').each(function() {
				$(this).attr('disabled', true);
			});

		} else {
			$('.field-after-verifikasi').each(function() {
				$(this).attr('disabled', true);
			});
		}
	}

	/**
	 * @param  [type] $CustomerId [description]
	 * @return [type]             [description]
	 */
	window.VerifikasiDataMasterStatus = function() {

		// seluruh verifikasi data akan di catat disini.	
		var dataTotalDiverifikasi = verifyDataJsonServer.total,
			dataSuccessDiverifikasi = verifyDataJsonServer.verify;
		if (dataSuccessDiverifikasi == dataTotalDiverifikasi) {
			return true;
		}
		return false;
	}

	/**
	 * @param  [type] $CustomerId [description]
	 * @return [type]             [description]
	 */
	window.VerifikasiDataSuccessField = function(rowDataJsonClientField, dataClientJsonId, dataClientConsole) {


		// ambil dan proces counter disini ya .	
		var rowDataJsonClientSuccess = rowDataJsonClientField.success,
			rowDataJsonClientName = rowDataJsonClientField.field,
			rowDataJsonClientLabel = rowDataJsonClientField.label;
		//console.log('rowDataJsonClientField',rowDataJsonClientField.field);		
		// ambil data object input field nya OK 	
		var dataInputClientData = window.sprintf('%s_%s', rowDataJsonClientName, dataClientJsonId);
		// bandingkan ya .
		// console.log(rowDataJsonClientSuccess);
		if (rowDataJsonClientSuccess > 0) {

			//  if(rowDataJsonClientField.field != 'DM_Dob'){
			var elementsss = document.getElementById("ceklis1");
			elementsss.style.visibility = "visible";
			//if(rowDataJsonClientField.field == 'DM_MotherName_3'){

			//}
			//  }
			// jika bukan kosole process .
			if (!dataClientConsole) {
				Ext.Msg(window.sprintf("Verifikasi Data \"%s\" ", rowDataJsonClientLabel)).Success();
			}

			verifyDataJsonServer.verify += 1;
			verifyDataJsonServer.process += 1;

			//console.log('so',window.sprintf('.%s', dataInputClientData));
			$(window.sprintf('.%s', dataInputClientData))
				.attr('disabled', true);
			if(Ext.Session("HandlingType").getSession() != 19){
               document.getElementById(dataInputClientData).type = 'password';
			}
		}

		// jika process all verifikasi OK 
		if (verifyDataJsonServer.verify == verifyDataJsonServer.total) {

			// jika yang request berasal dari button bukan 'console'  
			Ext.Msg('Verifikasi Data Komplit').Success();
			if (!dataClientConsole) {
				// update status
				verifyDataJsonServer.status = 1;
				window.VerificationSessionLoger({
					custid: verifyDataJsonServer.custid,
					session: verifyDataJsonServer.session,
					status: verifyDataJsonServer.status
				});
			}

			// karena ini trigger dari konsole maka gak perlu 
			// ada alert atau di catet lagi 'STOP'.
			else {
				console.log('ini dari Konsole');
			}
		}
		// buka table yang ada di table "daftar kartu"
		window.VerifikasiDaftarKartuStyle();
	}

	/**
	 * @param  [type] $CustomerId [description]
	 * @return [type]             [description]
	 */

	window.VerifikasiDataFailField = function(rowDataJsonClientField, dataClientJsonId) {

     		var rowDataJsonClientFailed = rowDataJsonClientField.failed,
			rowDataJsonClientCounter = rowDataJsonClientField.count,
			rowDataJsonClientName = rowDataJsonClientField.field,
			rowDataJsonClientLabel = rowDataJsonClientField.label;

		// ambil data object input field nya OK 	
		var dataInputClientData = window.sprintf('%s_%s', rowDataJsonClientName, dataClientJsonId);
		// bandingkan ya .

		var rowDataJsonClientSisaCounter = (rowDataJsonClientCounter - rowDataJsonClientFailed);
		if (rowDataJsonClientFailed >= rowDataJsonClientCounter) {
			verifyDataJsonServer.process += 1;
            Ext.Msg(window.sprintf("Verifikasi Data \"%s\" Gagal", rowDataJsonClientLabel)).Confirm();
			// if (rowDataJsonClientField.field == 'DM_Dob') {
				// edit hilman
				if (rowDataJsonClientField.field == 'CV_Data_Usia') {
				if (typeof(window.PaperWork) == 'function') {

					var callBackMsgVerification = Ext.Msg("Data Yang di verifikasi belum Komplit ..!\nApakah anda akan melakukan Verifikasi Ulang ?").Confirm();
					if (!callBackMsgVerification) {
						return false;
					}
					window.PaperWork({});
				}
			}
			//penmabahan icon xx
			// if (rowDataJsonClientField.field != 'DM_Dob') {
				// edit hilman 
				if (rowDataJsonClientField.field != 'CV_Data_Usia') {
				var elementsss = document.getElementById("show2");
				elementsss.style.visibility = "visible";
			}

			$(window.sprintf('.%s', dataInputClientData))
				.attr('disabled', true);

		} else {
			// if (rowDataJsonClientField.field != 'DM_Dob') {
				// edit hilman
				if (rowDataJsonClientField.field != 'CV_Data_Usia') {
				var elementsss = document.getElementById("show1");
				elementsss.style.visibility = "visible";
			}
			var rowClientMessage = window.sprintf("Anda memiliki %sx kesempatan lagi.\nUntuk Verifikasi Data \"%s\" ", rowDataJsonClientSisaCounter, rowDataJsonClientLabel);
			Ext.Msg(rowClientMessage).Info();

		}

		// check juga disini. 
		window.VerifikasiDaftarKartuStyle(); // disabled | enable data kartu

	}

	/**
	 * @param  [type] $CustomerId [description]
	 * @return [type]             [description]
	 */
	window.VerifikasiDataMaster = function(dataClientMaster, dataClientConsole, from = null) {

		// console.log(dataClientMaster.field);
		// return false;
		// jika yang aksess bukan konsole default nilai = 0 	
		if (typeof(dataClientConsole) == 'undefined') {
			dataClientConsole = false;
		}
		
		var rowDataVerificationSuccess = 0,
			rowFieldDataProcess = window.sprintf('%s_%s', dataClientMaster.field, dataClientMaster.id);

		// jika input kosong 	
		if (dataClientMaster.value == '') {
			$(window.sprintf('#%s', rowFieldDataProcess))
				.addClass('form-required');
			return false;
		}

		if (dataClientMaster.value.length < 1) {
			$(window.sprintf('#%s', rowFieldDataProcess))
				.addClass('form-required');
			return false;
		}

		// jika tidak kosong 
		$(window.sprintf('#%s', rowFieldDataProcess))
			.removeClass('form-required');

		// ambil id nya dan cari di json data 

		if (typeof(verifyDataJsonServer) != 'object') {
			return false;
		}

		// push data kedalam fungsi local function .	
		var rowDataJsonClientID = dataClientMaster.id,
			rowDataJsonServer = verifyDataJsonServer[rowDataJsonClientID];
		if (typeof(rowDataJsonServer) == 'object') {

			var rowDataJsonField = rowDataJsonServer.field,
				rowDataJsonValue = rowDataJsonServer.value;

			// check apakah field yang di cari ada di client JSON data. 
			if (!rowDataJsonField.localeCompare(dataClientMaster.field)) {
				//final process 
				// edit hilman
				if(dataClientMaster.field == 'CV_Data_Usia') {
					console.log('dataClientMaster.value', dataClientMaster.value)
					console.log('rowDataJsonValue', rowDataJsonValue)
					if (!rowDataJsonValue.localeCompare(dataClientMaster.value) || parseInt(dataClientMaster.value) - parseInt(rowDataJsonValue) == 1 || parseInt(dataClientMaster.value) - parseInt(rowDataJsonValue) == -1) {
						rowDataVerificationSuccess = 1;
						verifyDataJsonServer[rowDataJsonClientID].success += 1;
					} else {
						verifyDataJsonServer[rowDataJsonClientID].failed += 1;
						rowDataVerificationSuccess = 0;
					}
				} else {
				if (!rowDataJsonValue.localeCompare(dataClientMaster.value)) {
					rowDataVerificationSuccess = 1;
					verifyDataJsonServer[rowDataJsonClientID].success += 1;
				} else {
					verifyDataJsonServer[rowDataJsonClientID].failed += 1;
					rowDataVerificationSuccess = 0;
				}
			}
		}

			// check data setiap kesalahan pada field  yang akan nantinya di block id 
			if (rowDataVerificationSuccess) {
				window.VerifikasiDataSuccessField(
					verifyDataJsonServer[rowDataJsonClientID],
					rowDataJsonClientID,
					dataClientConsole);
			}
			// jika process gagal masukan ke sini.
			else {
				window.VerifikasiDataFailField(
					verifyDataJsonServer[rowDataJsonClientID],
					rowDataJsonClientID,
					dataClientConsole);
				document.getElementById(dataClientMaster.field).type = 'text';
			}
			// catat data verifikasi process di database untuk 
			// kepentingan crosscheck .
			dataClientMaster.status = rowDataVerificationSuccess;
			dataClientMaster.custid = verifyDataJsonServer.custid;
			dataClientMaster.session = verifyDataJsonServer.session;
			//push data loger 
			//console.log("dataClientConsole",dataClientConsole);
			if (!dataClientConsole) {
				window.VerificationDataMasterLoger(dataClientMaster);
			}
			window.VerificationDataRefresh() // cross function : jika ok akan di reload 
		}
	}

	/**
	 * @param  [type] $CustomerId [description]
	 * @return [type]             [description]
	 */
	window.VerifikasiExpiredKartu = function(dataKartuJsonClient) {
		
		// check expired kartu hanya boleh di verifikasi jika process verifikasi
		// di master berhasil.
		var clientKartuLogerData = {};
		if (!window.VerifikasiDataMasterStatus()) {
			Ext.Msg("Data Verifikasi Belum Komplit!").Info();
			document.getElementById(dataClientMaster.field).type = 'text';
			return false;
		}

		// check apakah ini Json data 	
		if (typeof(verifyDataJsonServer.kartu) != 'object') {
			return false;
		}

		// simpan data ke object baru. Agar tidak check ke server lagi.	
		verifyKartuJsonServer = verifyDataJsonServer.kartu;

		// ambil data pertiap kartu 
		var dataKartuJsonServer = verifyKartuJsonServer[dataKartuJsonClient.id];
		if (typeof(dataKartuJsonServer) == 'object') {

			// define all attribute ya .
			var dataKartuJsonClientField = dataKartuJsonClient.field,
				dataKartuJsonServerField = dataKartuJsonServer.field,
				dataKartuJsonClientValue = dataKartuJsonClient.value,
				// dataKartuJsonServerValue = dataKartuJsonServer.value;
				// edit hilman 
				dataKartuJsonServerValue = dataKartuJsonServer.value,
				dataKartuJsonClientId = dataKartuJsonClient.id;


			// disabled or enable data object 
			var callAttrDataClient = window.sprintf("%s_%s", dataKartuJsonClient.field, dataKartuJsonClient.id),
				callAttrButtonClient = window.sprintf("button_%s", callAttrDataClient);
			    callAttrCheckClient = window.sprintf("check_%s", callAttrDataClient);
					Ext.Ajax({
				url: Ext.EventUrl(['DataVerification', 'pencarian_membersince']).Apply(),
				method: 'POST',
				param: {
					ProgramId: dataKartuJsonClient.id,
				},
				ERROR: function(e) {


					Ext.Util(e).proc(function(response) {
						// alert(dataKartuJsonClientField + ' ||| ' +dataKartuJsonServerField + ' -|||- ' + dataKartuJsonClientValue + ' ||| ' +dataKartuJsonServerValue);
						// return false						
						// console.log('valuenya', dataKartuJsonClientValue)
						// console.log('usiany', response.status['CV_Data_MemberSince'])
						// alert(response.status['CV_Data_MemberSince'] == dataKartuJsonClientValue)
						if (parseInt(response.status['CV_Data_MemberSince']) == parseInt(dataKartuJsonClientValue)) {


			// console.log(callAttrDataClient);
			// apakah field name sudah benar ?	
			if (!dataKartuJsonClientField.localeCompare(dataKartuJsonServerField) &&
				!dataKartuJsonClientValue.localeCompare(dataKartuJsonServerValue)) {
				Ext.Msg("Validasi Kartu").Success();
                 
				$(window.sprintf("#%s", callAttrDataClient))
					.attr('disabled', true)

				$(window.sprintf(".%s", callAttrCheckClient))
					.attr('disabled', true)

				$(window.sprintf(".%s", callAttrButtonClient))
					.attr('disabled', false)
					.addClass('btn-success')
					.css({
						'color': '#FFFFFF'
					});

				// true "data"
				clientKartuLogerData.status = 1;
			}
			// jika process check data gagal
			else {
				Ext.Msg("Validasi Kartu").Failed();
				document.getElementById(callAttrDataClient).type = 'text';    
				$(window.sprintf("#%s", callAttrDataClient))
					.attr('disabled', false)
                 $(window.sprintf(".%s", callAttrCheckClient))
					.attr('disabled', false)

				$(window.sprintf(".%s", callAttrButtonClient))
					.attr('disabled', true)
					.addClass('btn-default')

				// false "data"
				clientKartuLogerData.status = 0;
			}

			// catat loger nye :: set data untuk dikirim ke loger di database 
			// catat semuanya 

			clientKartuLogerData.session = verifyDataJsonServer.session;
			clientKartuLogerData.setupid = dataKartuJsonServer.setupid;
			clientKartuLogerData.custid = dataKartuJsonServer.custid;
			clientKartuLogerData.field = dataKartuJsonClient.field;
			clientKartuLogerData.value = dataKartuJsonClient.value;
			clientKartuLogerData.verifyid = dataKartuJsonClient.id;

			// kemudian kirim datanya ke server 
			window.VerificationDataKartuLoger(clientKartuLogerData);
			// edit hilman 
		} else {
							alert('Member since Salah Input')
							return false
						}
					});

				}
			}).post();

		}
		return false;
	}

	/**
	 * @param  [type] $CustomerId [description]
	 * @return [type]             [description]
	 */
	window.ActionPaperWork = function(VerificationId, Program) {
		// open window extra dana form 	with diffrent name row 
		var windowName = window.sprintf("%s%s", Program, VerificationId);


		// get customer ID from Cross ID .	
		var CustomerId = Ext.Cmp('CustomerId').getValue(),
			CampaignName = Ext.Cmp('CampaignName').getValue(),
			ProductId = Ext.Cmp('ProductId').getValue(),
			ProductName = Ext.Cmp('ProductName').getValue()
     		dataURL = Ext.EventUrl(new Array('ProductController', 'FormControl', ProductName, Program, VerificationId)),

			// then will get an here 

			dataPaperWork = Ext.Window({
				name: windowName,
				url: dataURL.Apply(),
				left: 0,
				top: 0,
				width: 700,
				height: $(window).innerHeight(),
				scrollbars: 1,
				resizeable: 1,
				param: {
					VerificationId: VerificationId,
					CustomerId: CustomerId
				}
			});

		// then will open here 	
		dataPaperWork.popup();

	}

	/**
	 * @param  [type] $CustomerId [description]
	 * @return [type]             [description]
	 */
	window.VerifikasiDaftarKartu = function(item) {
		var callDataId = window.sprintf("%s_%s", item.field, item.id);
		if (Ext.Cmp(callDataId).getValue() != '') {
		item.value = Ext.Cmp(callDataId).getValue();
	} else {
			alert('Member since tidak boleh kosong')
			return false
		}
	
		// check apakah data tersebut data object 
		if (typeof(item) == 'object') {
			var dataUsage = {
				id: item.id,
				field: item.field,
				value: item.value
			}
			document.getElementById(callDataId).type = 'password';
			window.VerifikasiExpiredKartu(dataUsage);
		}

	}

	/**
	 * @param  [type] $CustomerId [description]
	 * @return [type]             [description]
	 */
	window.VerifikasiMaster = function(item) {
		// var callDataId = window.sprintf("%s_%s", item.field, item.id);
		// add dida
		var callDataId = null
		var callDataIdTahun = null
		var callDataIdBulan = null

		if (item.field == 'CV_Data_Usia') {
			callDataIdTahun = window.sprintf("tahun_%s_%s", item.field, item.id);
			callDataIdBulan = window.sprintf("bulan_%s_%s", item.field, item.id);

			var concat = Ext.Cmp(callDataIdTahun).getValue() + Ext.Cmp(callDataIdBulan).getValue();
			item.value = concat;
			// console.log('test', item.value)
			// var convert = window.dayToDate(Ext.Cmp(callDataIdTahun).getValue(), Ext.Cmp(callDataIdBulan).getValue());
			// item.value = convert;
		} else {
			callDataId = window.sprintf("%s_%s", item.field, item.id);
			// item.value = window.masks(Ext.Cmp(callDataId).getValue());
			item.value = Ext.Cmp(callDataId).getValue();
		}
		// item.value = Ext.Cmp(callDataId).getValue();
		// check apakah data tersebut data object 
		if (typeof(item) == 'object') {
			var dataUsage = {
				id: item.id,
				field: item.field,
				value: item.value
			}
			console.log(dataUsage)
			console.log(verifyDataJsonServer)
			window.VerifikasiDataMaster(dataUsage, false, 'verifPaperWork');
			if (item.field == 'CV_Data_Usia') {
				document.getElementById(callDataIdTahun).type = 'password';
				document.getElementById(callDataIdBulan).type = 'password';
			} else {

				// document.getElementById(callDataId).value = dataUsage.value
				document.getElementById(callDataId).value = window.masks(dataUsage.value)

			}
			// window.VerifikasiDataMaster(dataUsage, false);
			// document.getElementById(callDataId).type = 'password';
		}
	}

	/**
	 * @param  [type] $CustomerId [description]
	 * @return [type]             [description]
	 */
	window.VerifikasiMasterConsole = function() {

		var CustomerId = Ext.Cmp('CustomerId').getValue();

		// konversi kebentuk ini untuk data master 
		// yang di verifikasi. 

		var dataServerMasterStore = verifyDataJsonServer;
		if (typeof(dataServerMasterStore) == 'object') {

			// looping data rekursive .
			for (var key in dataServerMasterStore) {
				if (!key.localeCompare('kartu')) {
					continue;
				}
				// ambil data Y masing2 field.
				var dataJsonRow = dataServerMasterStore[key];
				if (typeof(dataJsonRow) == 'object' && dataJsonRow.valid.status == 'Y') {
					// sent to trigger 
					var dataUsage = dataJsonRow.valid;
					window.VerifikasiDataMaster(dataUsage, true);

					// masukan nilai data - nya 
					if(dataUsage.field != 'CV_Data_Usia') {
						$(window.sprintf('#%s_%s', dataUsage.field,
							dataUsage.id)).val(dataUsage.value);
					} else {
						var valDataTahun = dataUsage.value.substring(0, 2)
						var valDataBulan = dataUsage.value.substring(2, 4)
						$(window.sprintf('#tahun_%s_%s', dataUsage.field,
							dataUsage.id)).val(valDataTahun);
						$(window.sprintf('#bulan_%s_%s', dataUsage.field,
						dataUsage.id)).val(valDataBulan);
					}

				}
			}
		}

		// konversi kebentuk ini untuk data kartu 
		// yang di verifikasi. 
		if (typeof(dataServerMasterStore.kartu) == 'object') {
			var dataServerDaftarKartu = dataServerMasterStore.kartu;
			for (var key in dataServerDaftarKartu) {
				var dataRow = dataServerDaftarKartu[key];
				if (!dataRow.verify.localeCompare('Y')) {
					$(window.sprintf('#%s_%s', dataRow.field, dataRow.id))
						.val(dataRow.value)
						.attr('disabled', true)
				}
			}
		}

		// end console.
	}

	// add dida
	window.dayToDate = function(year, month) {
		var now = new Date()
		var years = now.getFullYear() - year
		var months = (now.getMonth() + 1) - month
		var res = null
		if (months < 0) {
			var monthx = (months + 12)
			var yearx = (years - 1)
			res = (monthx < 10 ? '0' + monthx : monthx) + "" + yearx
		} else if (months == 0) {
			var yearx = years - 1
			res = "12" + yearx
		} else {
			var monthx = (months < 10) ? '0' + months : months
			res = monthx + "" + years
		}
		return res
	}
	window.masks = function(str) {
		var split = str.split(" ")
		var arr_mask = []
		for (var i = 0; i < split.length; i++) {
			var str_length = split[i].length
			var substr = ''
			var str_replace = ''
			if (str_length == 2) {
				substr = split[i]
				str_replace = substr
			} else if (str_length == 3) {
				substr = split[i].substring(1, str_length)
				str_replace = split[i].replace(substr, generate_x(substr))
			} else if (str_length == 4) {
				substr = split[i].substring(2, str_length)
				str_replace = split[i].replace(/..$/, generate_x(substr))
			} else if (str_length == 1) {
				substr = split[i].substring(1, str_length)
				str_replace = split[i].replace(/..$/, generate_x(substr))
			} else {
				console.log('masuk sini')
				substr = split[i].substring(2, str_length - 1)
				str_replace = split[i].replace(substr, generate_x(substr))
				console.log('str_replace', str_replace)
			}
			arr_mask.push(str_replace)
		}
		var arrJoin = arr_mask.join()
		return arrJoin.replace(/\,/g, " ")
	}

	window.generate_x = function(str) {
		var str_length = str.length
		var this_mask = ''
		for (var i = 0; i < str_length; i++) {
			this_mask += '*'
		}
		return this_mask
	}
	// add dida localstorage status approved
	window.pickStatusApproved = function(verId) {
		var status = Ext.Cmp("CV_Data_Status_"+verId).getValue()
		// localstorage control status usage di daftar kartu
		var statusUsage = localStorage.getItem('statusApproved_'+verId)
		if(statusUsage == 1) {
			if(status == 1) {
				window.saveStatusUsage(verId, status)
			} else {
				Ext.Cmp("CV_Data_Status_"+verId).setValue('')
				alert('Status harus memilih approved')
			}
		} else {
			if(status != 1) {
				window.saveStatusUsage(verId, status)
			} else {
				Ext.Cmp("CV_Data_Status_"+verId).setValue('')
				alert('Status tidak boleh memilih approved')
			}
		}
	}
	// add dida localstorage status approved
	window.saveStatusUsage = function(verId, status) {
    Ext.Ajax({
      url: Ext.EventUrl(['ProductController', 'saveStatusUsage']).Apply(),
      method: 'POST',
      param 	: {
				'verId': verId,
				'status': status
			},
      ERROR: function(e) {
        Ext.Util(e).proc(function(response) {
          if(response.status == 1) {
						// localstorage control status usage di daftar kartu
            localStorage.removeItem('statusApproved_'+verId)
						if(status == 1) {
							$("#CV_Data_Status_"+verId).attr('disabled', true);
							$("#CV_Data_MemberSince_"+verId).attr('disabled', true);
						}
						localStorage.setItem('status_daftarkartu', JSON.stringify(status))
          } else {
						Ext.Cmp("CV_Data_Status_"+verId).setValue('')
            alert('Opss, something wrong');
          }
        });
      }
    }).post();
	} 


	/**
	 * @param  [type] $CustomerId [description]
	 * @return [type]             [description]
	 */
	$(function() {
		// untuk pertamakalinya simpan data di client untuk Process Verifikasi data . 
		// proces check dan richeck hanya terjadi di sisi client saja .
		// server hanya menerima action untuk mencatat log setiap user melakukan
		// verifikasi .
		// add dida localstorage
		localStorage.clear()

		window.VerificationIdentify();
		window.VerifikasiMasterConsole();
		window.VerifikasiDaftarKartuStyle();
	});
</script>
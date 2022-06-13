<script type="text/javascript">

/**
  * Process Verifikasi Data hanya Terjadi di sisi Client
  * Browser Menghindari Koneksi Ke DB terus Menerus.

  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */


var  USAGE = function(){}, verifyDataJsonServer = {}, verifyKartuJsonServer = {};

/**
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
window.VerificationSessionLoger = function( dataSession ){
 var dataClientMasterLogerUrl = Ext.EventUrl( new Array( 'DataVerification','DataSessionLoger' ) );
	Ext.Ajax({
		url 	: dataClientMasterLogerUrl.Apply(),
		method 	: 'POST',
		param   : {
			VS_SessionId : dataSession.session,
			VS_CustId : dataSession.custid,
			VS_Status : dataSession.status
		},
		success : function( xhr ){
			Ext.Util(xhr).proc(function( data ){
				if( data.success ){
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

window.VerificationDataKartuLoger = function( dataClientKartu ){

 // console.log(dataClientKartu);
 // setiap data yang di verifikasi akan di catat hasil
 // status -nya, namun hanya untuk data kartu saja tidak
 // untuk master.

	var dataVerifikasi = {
		VH_Data_Session 	: dataClientKartu.session,
		VH_Data_CustId  	: dataClientKartu.custid,
		VH_Data_VerStatus 	: dataClientKartu.status,
		VH_Data_Name  		: dataClientKartu.field,
		VH_Data_Value 		: dataClientKartu.value,
		VH_Data_SetupId 	: dataClientKartu.setupid,
		VH_Data_VerId		: dataClientKartu.verifyid
	}
	// process data on here <kirim data ke server>
	var dataClientMasterLogerUrl = Ext.EventUrl( new Array( 'DataVerification','DataKartuLoger' ) );
		Ext.Ajax ({
			url 	: dataClientMasterLogerUrl.Apply(),
			method 	: 'POST',
			param   : dataVerifikasi,
			success : function( xhr ){
				console.log( xhr );
			}
		}).post();
}

/**
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */

window.VerificationDataMasterLoger = function( dataClientMaster ){

// 	console.log(dataClientMaster);
 // setiap data yang di verifikasi akan di catat hasil
 // status-nya , namun hanya untuk data master saja tidak
 // untuk daftar kartu.

	var dataVerifikasi = {
		VH_Data_Session 	: dataClientMaster.session,
		VH_Data_CustId  	: dataClientMaster.custid,
		VH_Data_VerStatus 	: dataClientMaster.status,
		VH_Data_SetupId 	: dataClientMaster.id,
		VH_Data_Name  		: dataClientMaster.field,
		VH_Data_Value 		: dataClientMaster.value
	};
	// kirim data ke server
	// dataClientMasterLogerSite.post();
	var dataClientMasterLogerUrl = Ext.EventUrl( new Array( 'DataVerification','DataMasterLoger' ) );
		Ext.Ajax ({
			url 	: dataClientMasterLogerUrl.Apply(),
			method 	: 'POST',
			param   : dataVerifikasi,
			success : function( xhr ){
				console.log( xhr );
			}
		}).post();
}

/**
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */

 window.VerificationIdentify = function(){
 // sent data to server for request confirm proces
 // check validation data .
	var CustomerId  = Ext.Cmp('CustomerId').getValue(), // cross ID::<view:?/*_contact_detail/>
		CampaignId  = Ext.Cmp('CampaignId').getValue(), // cross ID::<view:?/*_contact_detail/>
		ProductId   = Ext.Cmp('ProductId').getValue(),
		ProductName = Ext.Cmp('ProductName').getValue();

	// var	row = Ext.Json( 'DataVerification/VerificationIdentify_pctd', {
	var	row = Ext.Json( 'DataVerification/VerificationIdentify_pctd', {
		CustomerId : CustomerId,
		CampaignId : CampaignId,
		ProductId  : ProductId
	});
	// row.dataItemEach data row
	row.dataItemEach( function( row, xhr ){
		verifyDataJsonServer = row[CustomerId];
		console.log('row',row);
	});
 }

/**
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */

window.VerificationDataRefresh = function(){
 // bagi dengan data yang harus di verifikasi
 // jika nilai sama dengan total_yang salah = total_yang_harus di verifikasi
 // maka load data .


  var dataTotDataCounter  = verifyDataJsonServer.total,
	  dataTotDataProcess = verifyDataJsonServer.process,
	  dataTotDataVerify  = verifyDataJsonServer.verify;

	 console.log(window.sprintf('total:%s, proces : %s, verify : %s', dataTotDataCounter, dataTotDataProcess, dataTotDataVerify));
	 if((dataTotDataVerify < dataTotDataCounter)
	   &&(dataTotDataProcess == dataTotDataCounter))
	 {
		// jika user memilih untuk reload data
		if( typeof( window.PaperWork ) == 'function' ){
			var callBackMsgVerification = Ext.Msg("Data Yang di verifikasi belum Komplit ..!\nApakah anda akan melakukan Verifikasi Ulang ?").Confirm();
			if( !callBackMsgVerification ){
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

window.VerifikasiDaftarKartuStyle =function(){
	// jika peocess verifikasi data gagal maka disabled button untuk
	// check verifikasi daftar kartu.
	if( window.VerifikasiDataMasterStatus() ){
		$('.field-after-verifikasi').each(function(){
			$(this).attr('disabled', false);
		});

		$('.field-after-state').each(function(){
			$(this).attr('disabled', true);
		});

	} else {
		$('.field-after-verifikasi').each(function(){
			$(this).attr('disabled', true);
		});
	}
}

 /**
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
window.VerifikasiDataMasterStatus = function(){

// seluruh verifikasi data akan di catat disini.
	var dataTotalDiverifikasi = verifyDataJsonServer.total,
		dataSuccessDiverifikasi = verifyDataJsonServer.verify;

	if( dataSuccessDiverifikasi == dataTotalDiverifikasi ){
		return true;
	}
	return false;
}

 /**
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
window.VerifikasiDataSuccessField = function( rowDataJsonClientField, dataClientJsonId, dataClientConsole ){


// ambil dan proces counter disini ya .
	 var rowDataJsonClientSuccess  = rowDataJsonClientField.success,
		 rowDataJsonClientName   = rowDataJsonClientField.field,
		 rowDataJsonClientLabel = rowDataJsonClientField.label;

	// ambil data object input field nya OK
		var dataInputClientData = window.sprintf('%s_%s', rowDataJsonClientName, dataClientJsonId );
	// bandingkan ya .
	// console.log(rowDataJsonClientSuccess);
	 if( rowDataJsonClientSuccess > 0 ){
		var elementsss = document.getElementById("ceklis1");
			elementsss.style.visibility = "visible";
		 // jika bukan kosole process .
		 if( !dataClientConsole ) {
			Ext.Msg(window.sprintf("Verifikasi Data \"%s\" ", rowDataJsonClientLabel )).Success();
		 }

		 verifyDataJsonServer.verify+=1;
		 verifyDataJsonServer.process+=1;

		 //console.log(dataInputClientData);
			$( window.sprintf('.%s', dataInputClientData) )
				.attr('disabled', true);
			if(Ext.Session("HandlingType").getSession() != 19){
               document.getElementById(dataInputClientData).type = 'password';
			}
	 }

	 // jika process all verifikasi OK
	 if( verifyDataJsonServer.verify == verifyDataJsonServer.total ){

		// jika yang request berasal dari button bukan 'console'
		Ext.Msg('Verifikasi Data Komplit').Success();

		if( !dataClientConsole ) {
			// update status
			verifyDataJsonServer.status = 1;
			window.VerificationSessionLoger({
				custid  : verifyDataJsonServer.custid,
				session : verifyDataJsonServer.session,
				status  : verifyDataJsonServer.status
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

 window.VerifikasiDataFailField = function( rowDataJsonClientField, dataClientJsonId ){

// ambil dan proces counter disini ya .
	 var rowDataJsonClientFailed  = rowDataJsonClientField.failed,
		 rowDataJsonClientCounter = rowDataJsonClientField.count,
		 rowDataJsonClientName   = rowDataJsonClientField.field,
		 rowDataJsonClientLabel = rowDataJsonClientField.label;

	// ambil data object input field nya OK
		var dataInputClientData = window.sprintf('%s_%s', rowDataJsonClientName, dataClientJsonId );
	// bandingkan ya .

	var rowDataJsonClientSisaCounter = ( rowDataJsonClientCounter-rowDataJsonClientFailed );
	 if( rowDataJsonClientFailed >= rowDataJsonClientCounter ){
		 verifyDataJsonServer.process+=1;
		 Ext.Msg(window.sprintf("Verifikasi Data \"%s\" ", rowDataJsonClientLabel )).Confirm();
		 if (rowDataJsonClientField.field == 'DM_Dob') {
				if (typeof(window.PaperWork) == 'function') {

					var callBackMsgVerification = Ext.Msg("Data Yang di verifikasi belum Komplit ..!\nApakah anda akan melakukan Verifikasi Ulang ?").Confirm();
					if (!callBackMsgVerification) {
						return false;
					}
					window.PaperWork({});
				}
			}
			//penmabahan icon xx
			if (rowDataJsonClientField.field != 'DM_Dob') {
				var elementsss = document.getElementById("show2");
				elementsss.style.visibility = "visible";
			}

		 $( window.sprintf('.%s', dataInputClientData) )
		 .attr('disabled', true);

	 } else {
		if (rowDataJsonClientField.field != 'DM_Dob') {
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
window.VerifikasiDataMaster = function( dataClientMaster, dataClientConsole ){


// jika yang aksess bukan konsole default nilai = 0
	if( typeof( dataClientConsole ) =='undefined' ){
		dataClientConsole = false;
	}
	var rowDataVerificationSuccess = 0,
		rowFieldDataProcess = window.sprintf('%s_%s', dataClientMaster.field, dataClientMaster.id);

// jika input kosong
	if( dataClientMaster.value == '' ){
		$( window.sprintf('#%s', rowFieldDataProcess))
		.addClass('form-required');
		return false;
	}

	if( dataClientMaster.value.length < 1 ){
		$( window.sprintf('#%s', rowFieldDataProcess))
		.addClass('form-required');
		return false;
	}

	// jika tidak kosong
	$( window.sprintf('#%s', rowFieldDataProcess))
		.removeClass('form-required');

	// ambil id nya dan cari di json data
	// console.log("verifyDataJsonServer",verifyDataJsonServer);
	// return false;
	if( typeof(verifyDataJsonServer) !='object' ){
		return false;
	}

    // push data kedalam fungsi local function .
	//console.log('verifyDataJsonServer',verifyDataJsonServer);
	var rowDataJsonClientID = dataClientMaster.id,
		rowDataJsonServer = verifyDataJsonServer[rowDataJsonClientID];
	if( typeof( rowDataJsonServer ) == 'object' ){

		var rowDataJsonField = rowDataJsonServer.field,
			rowDataJsonValue = rowDataJsonServer.value;
		// console.log('ddd',rowDataJsonServer = verifyDataJsonServer[rowDataJsonClientID]);
		// return false;
		// check apakah field yang di cari ada di client JSON data.
		if( !rowDataJsonField.localeCompare( dataClientMaster.field)){
			//final process
			if( !rowDataJsonValue.localeCompare( dataClientMaster.value ) ){
				rowDataVerificationSuccess = 1;
				verifyDataJsonServer[rowDataJsonClientID].success+=1;
			} else{
				verifyDataJsonServer[rowDataJsonClientID].failed+=1;
				rowDataVerificationSuccess = 0;
			}
		}

		// check data setiap kesalahan pada field  yang akan nantinya di block id
		if( rowDataVerificationSuccess ){
			window.VerifikasiDataSuccessField(
				verifyDataJsonServer[rowDataJsonClientID],
				rowDataJsonClientID,
				dataClientConsole );
		}
		// jika process gagal masukan ke sini.
		else {
			window.VerifikasiDataFailField(
				verifyDataJsonServer[rowDataJsonClientID],
				rowDataJsonClientID,
				dataClientConsole );
				document.getElementById(dataClientMaster.field).type = 'text';
		}
	// catat data verifikasi process di database untuk
	// kepentingan crosscheck .
		dataClientMaster.status = rowDataVerificationSuccess;
		dataClientMaster.custid = verifyDataJsonServer.custid;
		dataClientMaster.session = verifyDataJsonServer.session;
	  //push data loger
	  if( !dataClientConsole ){
		window.VerificationDataMasterLoger( dataClientMaster );
	  }
		window.VerificationDataRefresh() // cross function : jika ok akan di reload
	}
}

/**
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
window.VerifikasiExpiredKartu = function( dataKartuJsonClient ){

// check expired kartu hanya boleh di verifikasi jika process verifikasi
// di master berhasil.
var clientKartuLogerData = {};
	if( !window.VerifikasiDataMasterStatus() ){
		Ext.Msg("Data Verifikasi Belum Komplit!").Info();
		document.getElementById(dataClientMaster.field).type = 'text';
		return false;
	}

	// check apakah ini Json data
	if( typeof( verifyDataJsonServer.kartu ) != 'object' ){
		return false;
	}

 // simpan data ke object baru. Agar tidak check ke server lagi.
	verifyKartuJsonServer = verifyDataJsonServer.kartu;

 // ambil data pertiap kartu
	var dataKartuJsonServer = verifyKartuJsonServer[dataKartuJsonClient.id];
	if( typeof(dataKartuJsonServer) =='object' ) {

		// define all attribute ya .
		var dataKartuJsonClientField = dataKartuJsonClient.field,
			dataKartuJsonServerField = dataKartuJsonServer.field,
			dataKartuJsonClientValue = dataKartuJsonClient.value,
			dataKartuJsonServerValue = dataKartuJsonServer.value;


		// disabled or enable data object
		var callAttrDataClient = window.sprintf("%s_%s", dataKartuJsonClient.field, dataKartuJsonClient.id ),
			callAttrButtonClient = window.sprintf("button_%s", callAttrDataClient );
			callAttrCheckClient = window.sprintf("check_%s", callAttrDataClient );


		// console.log(callAttrDataClient);
		// apakah field name sudah benar ?
		if( !dataKartuJsonClientField.localeCompare(dataKartuJsonServerField)
			&& !dataKartuJsonClientValue.localeCompare(dataKartuJsonServerValue) )
		{
			Ext.Msg("Validasi Kartu").Success();

			$( window.sprintf("#%s", callAttrDataClient) )
			.attr('disabled', true)

			$( window.sprintf(".%s", callAttrCheckClient) )
			.attr('disabled', true)

			$( window.sprintf(".%s", callAttrButtonClient) )
			.attr('disabled', false)
			.addClass('btn-success')
			.css({'color' : '#FFFFFF'});

			// true "data"
			clientKartuLogerData.status = 1;
		}
		// jika process check data gagal
		else {
			Ext.Msg("Validasi Kartu").Failed();
			document.getElementById(callAttrDataClient).type = 'text';
			$( window.sprintf("#%s", callAttrDataClient) )
			.attr('disabled', false)
			$( window.sprintf(".%s", callAttrCheckClient) )
			.attr('disabled', false)

			$( window.sprintf(".%s", callAttrButtonClient) )
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
		window.VerificationDataKartuLoger( clientKartuLogerData );

	}
	return false;
}

/**
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
window.ActionPaperWork = function( custID, fixID, penawaran, VerificationId, Program ){
// open window extra dana form 	with diffrent name row
	// alert(Program)
	// return false
	var windowName = window.sprintf("%s%s", Program, VerificationId);

// get customer ID from Cross ID .
	var CustomerId 	 = Ext.Cmp('CustomerId').getValue(),
		CampaignName = Ext.Cmp('CampaignName').getValue(),
		ProductId    = Ext.Cmp('ProductId').getValue(),
		ProductName  = Ext.Cmp('ProductName').getValue()
		dataURL  	 = Ext.EventUrl( new Array('ProductController', 'FormControlPCTD', ProductName, Program, VerificationId ) ),

	// then will get an here

	dataPaperWork = Ext.Window({
		name : windowName,
		url : dataURL.Apply(),
		left : 0,
		top : 0,
		width : $(window).innerWidth(),
		height : $(window).innerHeight(),
		scrollbars : 1,
		resizeable : 1,
		param	: {
			VerificationId : VerificationId,
			CustomerId : custID,
			fixID: fixID,
			penawaran: penawaran
		}
	});

// then will open here
	dataPaperWork.popup();

}

window.ActionDetailPenawaran = function( custID, fixID, VerificationId, Program ){
	var windowName = window.sprintf("%s%s", Program, VerificationId);
	var CustomerId 	 = Ext.Cmp('CustomerId').getValue(),
		CampaignName = Ext.Cmp('CampaignName').getValue(),
		ProductId    = Ext.Cmp('ProductId').getValue(),
		ProductName  = Ext.Cmp('ProductName').getValue()
		dataURL  	 = Ext.EventUrl( new Array('ProductController', 'FormControlDetailPCTD', ProductName, Program, VerificationId ) ),

	dataPaperWork = Ext.Window({
		name : windowName,
		url : dataURL.Apply(),
		left : 0,
		top : 0,
		width : $(window).innerWidth(),
		height : $(window).innerHeight(),
		scrollbars : 1,
		resizeable : 1,
		param	: {
			VerificationId : VerificationId,
			CustomerId : custID,
			fixID: fixID
		}
	});
	dataPaperWork.popup();
}

/**
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
window.VerifikasiDaftarKartu = function( item ){
	var callDataId = window.sprintf("%s_%s", item.field, item.id );
		item.value = Ext.Cmp(callDataId).getValue();

	// check apakah data tersebut data object
	if( typeof( item ) == 'object' ){
		var dataUsage = {
			id : item.id,
			field : item.field,
			value : item.value
		}
		document.getElementById(callDataId).type = 'password';
		window.VerifikasiExpiredKartu(dataUsage);
	}

 }

/**
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
window.VerifikasiMaster = function( item ) {
 	var callDataId = window.sprintf("%s_%s", item.field, item.id );
		item.value = Ext.Cmp(callDataId).getValue();

		// console.log('test',item);
	// alert(callDataId);
	// return false;

	// check apakah data tersebut data object
	if( typeof( item ) == 'object' ){
		var dataUsage = {
			id : item.id,
			field : item.field,
			value : item.value
		}
		window.VerifikasiDataMaster(dataUsage, false);
		document.getElementById(callDataId).type = 'password';
	}
}

/**
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 window.VerifikasiMasterConsole = function(){

	var CustomerId = Ext.Cmp('CustomerId').getValue();

	// konversi kebentuk ini untuk data master
	// yang di verifikasi.

	 var dataServerMasterStore = verifyDataJsonServer;
	 if( typeof( dataServerMasterStore ) == 'object' )  {

		 // looping data rekursive .
		  for( var key in dataServerMasterStore ) {
			 if( !key.localeCompare( 'kartu' ) ){
				continue;
			 }
			 // ambil data Y masing2 field.
			 var dataJsonRow = dataServerMasterStore[key];
			 if( typeof( dataJsonRow ) == 'object' && dataJsonRow.valid.status =='Y' )  {
				// sent to trigger
				var dataUsage = dataJsonRow.valid;
				window.VerifikasiDataMaster( dataUsage, true);

				// masukan nilai data - nya
				$(window.sprintf('#%s_%s',dataUsage.field,
										  dataUsage.id )).val( dataUsage.value );

			}
		 }
	 }

	// konversi kebentuk ini untuk data kartu
	// yang di verifikasi.
	if( typeof(dataServerMasterStore.kartu) == 'object' ){
		var dataServerDaftarKartu = dataServerMasterStore.kartu;
		for( var key in dataServerDaftarKartu ){
			var dataRow = dataServerDaftarKartu[key];
			if( !dataRow.verify.localeCompare('Y') ){
				$(window.sprintf('#%s_%s',dataRow.field, dataRow.id ))
				.val( dataRow.value )
				.attr('disabled', true)
			}
		}
	}

	// end console.
  }


 /**
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 $(function(){
	// untuk pertamakalinya simpan data di client untuk Process Verifikasi data .
	// proces check dan richeck hanya terjadi di sisi client saja .
	// server hanya menerima action untuk mencatat log setiap user melakukan
	// verifikasi .

	window.VerificationIdentify();
	window.VerifikasiMasterConsole();
	window.VerifikasiDaftarKartuStyle();
 });
</script>

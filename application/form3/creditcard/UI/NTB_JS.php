<script type="text/javascript">


var NTB = function () {}

/**
 * [ChangeField description]
 * @param {[type]} ObjElement    [description]
 * @param {[type]} statusElement [description]
 * @param {[type]} typeElement   [description]
 */
NTB.prototype.ChangeField = function ( ObjElement , statusElement , typeElement ) {

	if ( typeof( ObjElement) == "object" ) {
		if ( statusElement == "disabled" ) {
			$.each( ObjElement , function ( key , val ) {
				$(typeElement+""+val).attr("disabled" , "disabled");
			});
		} 

		if ( statusElement == "enabled" ) {
			$.each( ObjElement , function ( key , val ) {
				$(typeElement+""+val).removeAttr("disabled");
			});
		}
	}

}

/**
 * [ObjElement description]
 * @type {Object}
 */
NTB.prototype.ObjElement = {
	cardtype     : "typecard" , 
	affinitycard : "affinitycard" , 
	cardlevel    : "cardlevel" 
};

/**
 * [FormReady description]
 */
NTB.prototype.FormReady = function () {
	//$("#affinitycard").hide();
	//$("#cardlevel").hide();
	//$("#orgaffinity").hide();
	this.ChangeField([ 
		"affinitycard" , 
		"cardlevel" ,
		"orgaffinity" , 
	] , "disabled" , "#");
}

/**
 * [CardType description]
 */
NTB.prototype.MandatoryForm = function () {
	var requireForm = [
		"CONTACT_Jenis_Kelamin" , 
		"CONTACT_Tgl_Jatuh_Tempo" , 
		"CONTACT_Alamat_Rumah_1" , 
		"CONTACT_Kota" , 
		"CONTACT_Kode_Post" ,
		"CONTACT_Kode_Area_Tlp" , 
		"CONTACT_Tlp_Rumah" , 
		"WORK_Jabatan" , 
		"WORK_Nama_Kantor" , 
		"WORK_Almat_Kantor_1" , 
		"WORK_Kota_Kantor" , 
		"WORK_Kode_Pos_Kantor" , 
		"WORK_Kode_Area_Tlp_Kantor" , 
		"WORK_Tlp_Kantor",
		"EC_Nama", 
		"EC_Telp"
	];
	$.each( requireForm , function ( key , val ) {
		$("#"+val).attr("required","required");
	});
}


/**
 * [CardType description]
 */
NTB.prototype.CardType = function () {

	var changeContent = $("#"+this.ObjElement.cardtype);
	var me = this;
	$(changeContent).change(function (e) {
		e.preventDefault();
		var trigger = $("option:selected" , this).attr("trigger");
		var value   = $(this).val();

		if ( trigger == "affcard" ) {
			//$("#affinitycard").fadeIn();
			//$("#cardlevel").fadeIn();
			//$("#orgaffinity").fadeIn();
			me.ChangeField([ 
				"affinitycard" , 
				"cardlevel" ,
				"orgaffinity" , 
			] , "enabled" , "#");

		} else if ( trigger == "0" ) {
			//$("#affinitycard").fadeOut();		
			//$("#cardlevel").fadeOut();
			//$("#orgaffinity").fadeOut();
			me.ChangeField([ 
				"affinitycard" , 
				"cardlevel" ,
				"orgaffinity" , 
			] , "disabled" , "#");
		} 

	});

}

/**
 * [ChangeFieldDualCard description]
 * @param {[type]} typeCard [description]
 */
NTB.prototype.ChangeFieldDualCard = function ( typeCard ) {
	if ( typeCard == "AFF" ) {
		$(".affinity_enabled_choose").removeAttr("disabled");
		$(".affinity_select_choose").removeAttr("disabled");
	}

	if ( typeCard == "COB" ) {
		$(".cobrand_enabled_choose").removeAttr("disabled");
		$(".cobrand_select_choose").removeAttr("disabled");
	}
}


/**
 * [SpreadForm description]
 */
NTB.prototype.SpreadForm = function ( json_data ) {

	$("#submitcreditcard input").each(function () {
		var thisName = $(this).attr("name");
		var thisId = $(this).attr("id");
		if ( typeof(thisId) == "undefined" ) {
			$(this).attr("id" , thisName);
		}
	});

	$("#submitaddon input").each(function () {
		var thisName = $(this).attr("name");
		if ( typeof(thisId) == "undefined" ) {
			$(this).attr("id" , thisName);
		}
	});

	$("#submitcreditcard select").each(function () {
		var thisName = $(this).attr("name");
		var thisId = $(this).attr("id");
		if ( typeof(thisId) == "undefined" ) {
			$(this).attr("id" , thisName);
		}
	});


	var obj = json_data;
	if ( typeof(json_data) == "object" ) {
		if ( obj.hasOwnProperty("ntb") ) {
			
			var thispro = this;
			$.each( obj.ntb , function (key,val) {
				var TagId = $("#"+key);
				var typeInput = $(TagId).attr("type");
				

				setTimeout(function () {
					if ( key == "DC_Dual_Card_Type" ) thispro.ChangeFieldDualCard(val);
				} , 3000)
				

				if ( $(TagId).is("select") ) $(TagId).val(val);
				if ( key == "CC_Kartu_Yang_Diinginkan" ) $("#typecard").val(val);
				if ( key == "CC_Afinity" ) $("#affinitycard").val(val);
				if ( key == "CC_Card_Level" ) $("#cardlevel").val(val);
				if ( key == "CC_Relation_Afinity" ) $("#orgaffinity").val(val);

				if ( key == "FINANCE_Kartu_Kredit_Sejak1" ) $(".FINANCE_Kartu_Kredit_Sejak1").val(val);
				if ( key == "FINANCE_Kartu_Kredit_Expired1" ) $(".FINANCE_Kartu_Kredit_Expired1").val(val); 
				if ( key == "FINANCE_Kartu_Kredit_Sejak2" ) $(".FINANCE_Kartu_Kredit_Sejak2").val(val); 
				if ( key == "FINANCE_Kartu_Kredit_Expired2" ) $(".FINANCE_Kartu_Kredit_Expired2").val(val); 
				if ( key == "CONTACT_Tgl_Jatuh_Tempo" ) $(".CONTACT_Tgl_Jatuh_Tempo").val(val); 
				if ( key == "CONTACT_Tgl_Lahir" ) $(".CONTACT_Tgl_Lahir").val(val); 

				if ( key == "DC_Dual_Card_Propose" ) {
					$(".DC_Dual_Card_Propose").val(val);
				}
				 

				if ( typeInput == "radio" ) {
					var $radio = $('input:radio[name='+key+']');
				    if($radio.is(':checked') === false) {
				        $radio.filter('[value='+val+']').attr('checked', true);
				    }
				}

				if ( key == "DC_Dual_Card_Agree" ) $("#dualcardagree").prop("checked" , true);



				if ( typeInput == "checkbox" ) {
					var valueInput = $(TagId).attr("value");
					if ( valueInput == val ) {
						$(TagId).prop("checked", true);
					}
				}

				if ( typeInput == "text" || typeInput == "hidden" ) $(TagId).val(val);
				if ( key == "TR_NTBID" ) $("#ntbid").val(val);
				if ( key == "TR_CustomerNumber" ) $("#CustomerNumber").val(val);
				if ( key == "TR_Total_ADDON" ) $("#totaladdon").val(val);

			})
		} 
			document.NtbShow.DualCard();
		if ( obj.hasOwnProperty("addon") ) {
			
			var lengthAddon = obj.addon.length;
			lengthAddon = parseInt(lengthAddon);
			/**
			 * [totalAddonObj description]
			 * @type {[type]}
			 *  "ADDON"
			 *  "ADDON_Nama_Kartu" ,
				"ADDON_Umur" ,
				"ADDON_DOB" ,
				"ADDON_Jenis_Kartu" ,
				"ADDON_Hubungan" ,
				"ADDON_Jenis_Kelamin" ,
				"ADDON_No_Hp"
			 */
			
			for ( var addon_length = 0; addon_length <= 4 ; addon_length++ ) {
				if ( obj.addon.hasOwnProperty(addon_length) ) {
					var addonValue = obj.addon[addon_length];
					var keysAddon = Object.keys(obj.addon);
					
					
					$.each(addonValue , function ( keys , values ) {
						var idAddonEach = $("#"+keys+"_"+addon_length);
						if ( $(idAddonEach).attr("type") == "checkbox" ) {
							$(idAddonEach).prop("checked" , true);
							$(idAddonEach).val(values);
						}
						if ( $(idAddonEach).attr("type") == "text" || $(idAddonEach).attr("type") == "hidden" ) $(idAddonEach).val(values);
						if ( $(idAddonEach).is("select") ) $(idAddonEach).val(values);
						if ( $(idAddonEach).attr("type") == "radio" ) {
							var $radio = $('input:radio[name='+keys+"_"+addon_length+']');
						    if($radio.is(':checked') === false) {
						        $radio.filter('[value='+values+']').attr('checked', true);
						    }
						}

					})
				}
				


			}
		}
	} else {
		console.log("Bukan object");
	}

}


/**
 * [CardLevel description]
 */
NTB.prototype.CardLevel = function () {
	var changeContent = $("#"+this.ObjElement.affinitycard);

	$(changeContent).change(function (e) {
		e.preventDefault();
		var level = $("option:selected" , this).attr("level");
		var value   = $(this).val();

		var urlSend = document.indexController + "getLK/cardlevel";
		document.JsForm.AjaxAuto( urlSend , function (data) {
			$("#cardlevel").html(data);
		} , { id : level } , "html" );

	});
}


/**
 * [DualCard description]
 */
NTB.prototype.DualCard = function () {

	this.ChangeField([ 
		"DC_Dual_Card_Type" , 
		"DC_Dual_Card_Propose" ,
		"DC_Dual_Card_Propose_Type" , 
		"DC_Dual_Card_Limit"
	] , "disabled" , ".");

	var me = this;


	if ( $("#dualcardagree").is(":checked") ) {
		$(".cardtypeaddon").append("<option value='2'>Kartu Kedua</option><option value='1,2'>Kartu Pertama dan Kedua</option>");
	}


	$("#dualcardagree").change(function () {

		if ( $(this).is(":checked") == false ) {

			me.ChangeField([ 
				"DC_Dual_Card_Type" , 
				"DC_Dual_Card_Propose" ,
				"DC_Dual_Card_Propose_Type" , 
				"DC_Dual_Card_Limit"
			] , "disabled" , ".");
			
			$(".cobrand_enabled_choose").prop("checked" , false);
			$(".affinity_enabled_choose").prop("checked" , false);

			$(".cardtypeaddon").html("<option value='0'>- PILIH -</option><option value='1'>Kartu Pertama</option>");



		} else if ( $(this).is(":checked") == true ) {
			//$(".DC_Dual_Card_Propose").removeAttr("disabled");
			//$(".DC_Dual_Card_Propose_Type").removeAttr("disabled");

			$(".cardtypeaddon").append("<option value='2'>Kartu Kedua</option><option value='1,2'>Kartu Pertama dan Kedua</option>");

			me.ChangeField([ 
				"DC_Dual_Card_Type" , 
				"DC_Dual_Card_Limit"
			] , "enabled" , ".");

		}
	});

	//$(this).prop('checked', false);

	$(".affinity_enabled_choose").click(function () {
		$(".affinity_select_choose").removeAttr("disabled");
		$(".cobrand_select_choose").attr("disabled" , "disabled");
		$(this).attr("status" , 1);
	});

	$(".cobrand_enabled_choose").click(function () {
		$(".cobrand_select_choose").removeAttr("disabled");
		$(".affinity_select_choose").attr("disabled" , "disabled");
		$(this).attr("status" , 1);
	});
}

/**
 * [OtherTrigger description]
 * @param {[type]} ObjElement [description]
 */
NTB.prototype.OtherTrigger = function (ObjElement) {
	if ( typeof( ObjElement ) == "object" ) {

		var element 	   = $("#" + new String(ObjElement.elements) );
		var triggerElement = $("#" + new String(ObjElement.trigger) );
		this.ChangeField( [ObjElement.trigger] , "disabled" , "#");
		var me = this;


		$(element).change(function () {
			var values = $(this).val();
			if ( values == "LN" || values == "OTH" ) {
				me.ChangeField( [ObjElement.trigger] , "enabled" , "#");
			} else {
				me.ChangeField( [ObjElement.trigger] , "disabled" , "#");
			}
		});

	} 
}

/**
 * [AddOn description]
 */
NTB.prototype.AddOn = function () {

	var me = this;

	var TotAddon = [1,2,3];
	var fieldAddon = [
						"ADDON" ,
						"ADDON_Nama_Kartu" ,
						"ADDON_Umur" ,
						"ADDON_DOB" ,
						"ADDON_Jenis_Kartu" ,
						"ADDON_Hubungan" ,
						"ADDON_Jenis_Kelamin" ,
						"ADDON_No_Hp"
					]; 
 

	// each all addon first input disabled
	$.each(TotAddon , function (keys,vals) {
	var checkAgreeAddon = $("#ADDON_"+vals).is(":checked");

		$.each(fieldAddon , function ( key , val ) {
			if ( checkAgreeAddon == false ) {
				if ( val != "ADDON" ) {
					if ( val == "ADDON_Jenis_Kelamin" ) {
						$("."+val+"_"+vals).attr("disabled" , "disabled");
						$("."+val+"_"+vals).prop("checked", false);
					} else {
						$("#"+val+"_"+vals).attr("disabled" , "disabled");
					}
				}
			} else {
				if ( val != "ADDON" ) {
					if ( val == "ADDON_Jenis_Kelamin" ) {
						$("."+val+"_"+vals).removeAttr("disabled");
						$("."+val+"_"+vals).attr("required" , "required");
					} else {
						$("#"+val+"_"+vals).removeAttr("disabled");
						$("#"+val+"_"+vals).attr("required" , "required");
					}
				}
			}
		})

		
	})

	var totalAddon = 0;
	$(".dualcardagree").click(function () {
		$(this).each(function () {
			var propAgreeStatus = $(this).is(":checked");
			if ( propAgreeStatus == true ) {
				totalAddon += 1;
			} else {
				totalAddon -= 1;
			}
		});

		$("#totaladdon").val(totalAddon); // append totaladdon
	});

	$(".dualcardagree").each(function () {
		var propAgreeStatus = $(this).is(":checked");
		if ( propAgreeStatus == true ) {
			totalAddon += 1;
		}
	});

	$("#totaladdon").val(totalAddon); // append totaladdon

	// on change enable or disable form addon
	$(".dualcardagree").change( function (e) {
		e.preventDefault();

		var valueAddon = $(this).attr("addon");
		var valueAddonDb = $(this).val();

		

		
		$.each(fieldAddon , function (key,val) {
				if ( val == "ADDON" ) return false;
				if ( val == "ADDON_Jenis_Kelamin" ) {
					$("."+val+"_"+valueAddon).attr("disabled" , "disabled");
					$("."+val+"_"+valueAddon).removeAttr("required" , "required");
					$("."+val+"_"+valueAddon).prop("checked", false);
				} else {
					$("#"+val+"_"+valueAddon).removeAttr("required" , "required");
					$("#"+val+"_"+valueAddon).attr("disabled" , "disabled");
				}
		})

		var propStatus = $(this).is(":checked"); 

		
		var totRemoveAddon = "";
		$.each( TotAddon , function ( number , valueOfNumber ) {
			var tagRemoveAddon = $("#ADDON_"+valueOfNumber);
			var tagValRemoveAddon = $(tagRemoveAddon).val();
			var tagStatusProp  = $(tagRemoveAddon).is(":checked");

			if ( tagValRemoveAddon != "" && tagStatusProp == false ) {
				totRemoveAddon += tagValRemoveAddon + ",";
			}
		})

		totRemoveAddon = totRemoveAddon.replace(/,\s*$/, "");
		$("#addoncancel").val(totRemoveAddon);
		
		if ( propStatus == false ) {
			$.each(fieldAddon , function (key,val) {
				if ( val != "ADDON"  ) {
					if ( val == "ADDON_Jenis_Kelamin" ) {
						$("."+val+"_"+valueAddon).attr("disabled" , "disabled");
						$("."+val+"_"+valueAddon).prop("checked", false);
						$("."+val+"_"+valueAddon).removeAttr("required" , "required");
					} else {
						$("#"+val+"_"+valueAddon).attr("disabled" , "disabled");
						$("#"+val+"_"+valueAddon).removeAttr("required" , "required");
					}
				}
			})
		} 

		if ( propStatus == true ) {
			$.each(fieldAddon , function (key,val) {
				if ( val != "ADDON"  ) {
					if ( val == "ADDON_Jenis_Kelamin" ) {
						$("."+val+"_"+valueAddon).removeAttr("disabled");
						$("."+val+"_"+valueAddon).attr("required" , "required");
					} else {
						$("#"+val+"_"+valueAddon).removeAttr("disabled");
						$("#"+val+"_"+valueAddon).attr("required" , "required");
					}
				}
			})
		}


	});
}

/**
 * [Submit description]
 */
NTB.prototype.Submit = function () {

	var checkExists = $("#FRM_NTB_Id").val();
	checkExists = new String(checkExists);
	checkExists = checkExists.length;
	var selfPrototype = this;

	if ( checkExists == 0 ) {

		// save statement 
		
		$("#submitcreditcard").submit(function (e) {
			e.preventDefault();

			$( "button" , this).attr("disabled","disabled");

			var forus = this;
			setTimeout(function () {
				$( "button" , forus).removeAttr("disabled");
			} , 3000);

			var CustomerId = $("#CustomerId").val();
			var ntbid = $("#ntbid").val();
			var dataCreditCard = $(this).serialize();
			dataCreditCard["CustomerNumber"] = CustomerId;
			dataCreditCard["ntbid"] = ntbid;
			dataCreditCard["totaladdon"] = totaladdon;

			var sendParam = {
				url : Ext.DOM.INDEX + "/ProductController/RouteCard/NTB" , 
				dataType : "json" , 
				data : dataCreditCard ,
				type : "POST"  , 
				success : function (d) {
					if ( d.success == 1 ) {
						$("#ntbid").val(d.ntbid);	
						$("#transactionid").val(d.transactionid);		
						window.alert(d.message);							
					} else {
						window.alert("Save, Failed..");
					}
				}
			};

			var transactionid = $("#transactionid").val();
			transactionid = new String(transactionid);
			transactionid = transactionid.trim();
			if ( transactionid == "" || transactionid.length == 0 ) {
				$.ajax(sendParam);
			} else {
				window.alert("Anda sudah melakukan transaksi sebelumnya ..");
			}

			return false;
		});


		$("#submitaddon").submit(function (e) {
			e.preventDefault();

			$( "button" , this).attr("disabled","disabled");

			var forus = this;
			setTimeout(function () {
				$( "button" , forus).removeAttr("disabled");
			} , 3000);

			var CustomerId = $("#CustomerId").val();
			var ntbid = $("#ntbid").val();
			var totaladdon = $("#totaladdon").val();
			var transactionid = $("#transactionid").val();
			var dataAddon = $(this).serialize();
			dataAddon["CustomerNumber"] = CustomerId;
			dataAddon["ntbid"] = ntbid;
			dataAddon["totaladdon"] = totaladdon;
			dataAddon["transactionid"] = transactionid;
			
			var sendParam = {
				url : Ext.DOM.INDEX + "/ProductController/RouteCard/ADDONNTB" , 
				dataType : "json" , 
				data : dataAddon ,
				type : "POST"  , 
				success : function (d) {
					if ( d.success == 1 ) {
						window.alert(d.message);							
					} else {
						window.alert(d.message);
					}
				}
			};

			$.ajax(sendParam);
			return false;
		});
	} else {
		// update statement 
		$("#submitcreditcard").submit(function (e) {
			e.preventDefault();
			
			$( "button" , this).attr("disabled","disabled");

			var forus = this;
			setTimeout(function () {
				$( "button" , forus).removeAttr("disabled");
			} , 3000);

			var CustomerId = $("#CustomerId").val();
			var ntbid = $("#ntbid").val();
			var dataCreditCard = $(this).serialize();
			var sendParam = {
				url : Ext.DOM.INDEX + "/ProductController/RouteCard/NTBUPDATE" , 
				dataType : "json" , 
				data : dataCreditCard ,
				type : "POST"  , 
				success : function (d) {
					if ( d.success == 1 ) {
						window.alert(d.message);		
										
					} else {
						window.alert("Update, Failed..");
					}
				}
			};

			$.ajax(sendParam);
			return false;
		});

		$("#submitaddon").submit(function (e) {
			e.preventDefault();

			$( "button" , this).attr("disabled","disabled");

			var forus = this;
			setTimeout(function () {
				$( "button" , forus).removeAttr("disabled");
			} , 3000);

			var dataAddon = $(this).serialize();
			var sendParam = {
				url : Ext.DOM.INDEX + "/ProductController/RouteCard/ADDONNTBUPDATE" , 
				dataType : "json" , 
				data : dataAddon ,
				type : "POST"  , 
				success : function (d) {
					if ( d.success == 1 ) {
						window.alert(d.message);
						selfPrototype.SpreadForm(d.rowntb);	
					} else {
						window.alert(d.message);
					}
				}
			};

			$.ajax(sendParam);
			return false;
		});
	}






}

// call all object
document.NtbShow = new NTB();
document.NtbShow.SpreadForm(<?php echo json_encode($DetailJs); ?>);
document.NtbShow.CardType();
document.NtbShow.FormReady();
document.NtbShow.CardLevel();

// document.NtbShow.DualCard(); di pindah ke dalam fungsi SpreadForm soalnya blm ke apend udah ke set duluan valuenya

document.NtbShow.AddOn();
document.NtbShow.MandatoryForm();
document.NtbShow.Submit();


// other trigger
document.NtbShow.OtherTrigger({ // rumah
	elements : "CONTACT_Status_Tempat_Tinggal" , 
	trigger  : "CONTACT_Status_Tempat_Tinggal_Other" 
});

document.NtbShow.OtherTrigger({ // pendidikan
	elements : "CONTACT_Pendidikan_Terakhir" , 
	trigger  : "CONTACT_Pendidikan_Terakhir_Other" 
});

document.NtbShow.OtherTrigger({ // pekerjaan
	elements : "WORK_Pekerjaan" , 
	trigger  : "WORK_Jenis_Pekerjaan_Other" 
});

document.NtbShow.OtherTrigger({ // jenis perusahaan
	elements : "WORK_Jenis_Perusahaan" , 
	trigger  : "WORK_Jenis_Perusahaan_Other" 
});

</script>
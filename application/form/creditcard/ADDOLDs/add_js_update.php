<script type="text/javascript">


var ADDON = function () {}

/**
 * [Submit description]
 */
ADDON.prototype.ChangeField = function ( ObjElement , statusElement , typeElement ) {

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

ADDON.prototype.Submit = function () {

	
		$("#submitdatachanged").submit(function (e) {
			e.preventDefault();
			// alert('atas');
			var submittedid = $(".FRM_ADDON_Id").val();
			submittedid = new String(submittedid);


			// if ( submittedid == 0 ) {
				var dataCreditCard = $(this).serialize();
				var sendParam = {
					url : Ext.DOM.INDEX + "/ProductController/RouteCard/ADDON" ,
					dataType : "json" ,
					data : dataCreditCard ,
					type : "POST"  ,
					success : function (d) {
						console.log(d);
						if ( d.success == "1" ) {
							$(".FRM_ADDON_Id").val(d.insert_id);
							window.alert(d.message);
						} else {
							window.alert(d.message);
						}
					}
				};

				$.ajax(sendParam);
			// } else {
				// $("#submitdatachanged").submit(function (e) {
					// e.preventDefault();
					// alert('atas2');
					// var dataCreditCard = $(this).serialize();
					// var sendParam = {
						// url : Ext.DOM.INDEX + "/ProductController/RouteCard/ADDONUPDATE" ,
						// dataType : "json" ,
						// data : dataCreditCard ,
						// type : "POST"  ,
						// success : function (d) {
							// console.log(d);
							// if ( d.success == "1" ) {
								// window.alert(d.message);
							// } else {
								// window.alert(d.message);
							// }
						// }
					// };

					// $.ajax(sendParam);
					// return false;
				// });
			// }



			
			return false;
		});
	



	$("#submitadditionalcard1").submit(function (e) {
		e.preventDefault();
		// alert('add');
		// alert($(this));
		var checkInsertAddon = $(".FRM_ADDON_Id").val();
		var checkInsertXsell =  checkInsertXsell.length;
		var ObjPrototype = this;
		var dataAddon = $(this).serialize();
		if( checkInsertAddon == 0 ) {
			var sendParam = {
			url : Ext.DOM.INDEX + "/ProductController/RouteCard/ADDONADDITIONALCARD" ,
			dataType : "json" ,
			data : dataAddon ,
			type : "POST"  ,
			success : function (d) {
				if ( d.success == "1" ) {
					window.alert(d.message);
					document.ADDON.ChangeField([ 
						"ADDON_Nama_Kartu_2" , 
						"ADDON_Hubungan_2" , 
						"ADDON_Umur_2" , 
						"ADDON_DOB_2" , 
						"ADDON_Jenis_Kartu_2" , 
						"ADDON_Jenis_Kelamin_2" , 
						"ADDON_No_Hp_2"
					] , "enabled" , "#");
				} else {
					window.alert(d.message);
				}
			}
		};
		} else {
			var sendParam = {
			url : Ext.DOM.INDEX + "/ProductController/RouteCard/ADDONADDITIONALCARDUPDATE" ,
			dataType : "json" ,
			data : dataAddon ,
			type : "POST"  ,
			success : function (d) {
				if ( d.success == "1" ) {
					window.alert(d.message);
					document.ADDON.ChangeField([ 
						"ADDON_Nama_Kartu_2" , 
						"ADDON_Hubungan_2" , 
						"ADDON_Umur_2" , 
						"ADDON_DOB_2" , 
						"ADDON_Jenis_Kartu_2" , 
						"ADDON_Jenis_Kelamin_2" , 
						"ADDON_No_Hp_2"
					] , "enabled" , "#");
				} else {
					window.alert(d.message);
				}
			}
		};
		}
		$.ajax(sendParam);


		return false;
	});
	
	$("#submitadditionalcard2").submit(function (e) {
		e.preventDefault();
		// alert('add');
		// alert($(this));
		var dataAddon = $(this).serialize();
		var sendParam = {
			url : Ext.DOM.INDEX + "/ProductController/RouteCard/ADDONADDITIONALCARD" ,
			dataType : "json" ,
			data : dataAddon ,
			type : "POST"  ,
			success : function (d) {
				if ( d.success == "1" ) {
					window.alert(d.message);
					document.ADDON.ChangeField([ 
						"ADDON_Nama_Kartu_3" , 
						"ADDON_Hubungan_3" , 
						"ADDON_Umur_3" , 
						"ADDON_DOB_3" , 
						"ADDON_Jenis_Kartu_3" , 
						"ADDON_Jenis_Kelamin_3" , 
						"ADDON_No_Hp_3"
					] , "enabled" , "#");
				} else {
					window.alert(d.message);
				}
			}
		};

		$.ajax(sendParam);


		return false;
	});
	
	$("#submitadditionalcard3").submit(function (e) {
		e.preventDefault();
		// alert('add');
		// alert($(this));
		var dataAddon = $(this).serialize();
		var sendParam = {
			url : Ext.DOM.INDEX + "/ProductController/RouteCard/ADDONADDITIONALCARD" ,
			dataType : "json" ,
			data : dataAddon ,
			type : "POST"  ,
			success : function (d) {
				if ( d.success == "1" ) {
					window.alert(d.message);
				} else {
					window.alert(d.message);
				}
			}
		};

		$.ajax(sendParam);


		return false;
	});

	
}

ADDON.prototype.SpreadForm = function ( json_data ) {


	$("#submitdatachanged input").each(function () {
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

	if(json_data == null) return false;
	var obj = json_data;
	var lengthAddon = Object.keys(obj).length;
			lengthAddon = parseInt(lengthAddon);
	if ( typeof(json_data) == "object" && typeof(obj) == "object" && lengthAddon > 0) {
		// if ( obj.hasOwnProperty("addon") ) {
			// var lengthAddon = obj.addon.length;
			// var lengthAddon = Object.keys(obj).length;
			// lengthAddon = parseInt(lengthAddon);
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
			
			for ( var addon_length = 0; addon_length <= 3 ; addon_length++ ) {
				if ( obj.hasOwnProperty(addon_length) ) {
					var addonValue = obj[addon_length];
					var keysAddon = Object.keys(obj);
					
					
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
		// }
	} else {
		console.log("Bukan object");
	}

}




document.ADDON = new ADDON();
document.ADDON.Submit();
document.ADDON.SpreadForm(<?php echo json_encode($DetailJs); ?>);

document.ADDON.ChangeField([ 
		"ADDON_Nama_Kartu_2" , 
		"ADDON_Hubungan_2" , 
		"ADDON_Umur_2" , 
		"ADDON_DOB_2" , 
		"ADDON_Jenis_Kartu_2" , 
		"ADDON_Jenis_Kelamin_2" , 
		"ADDON_No_Hp_2"
	] , "disabled" , "#");

document.ADDON.ChangeField([ 
		"ADDON_Nama_Kartu_3" , 
		"ADDON_Hubungan_3" , 
		"ADDON_Umur_3" , 
		"ADDON_DOB_3" , 
		"ADDON_Jenis_Kartu_3" , 
		"ADDON_Jenis_Kelamin_3" , 
		"ADDON_No_Hp_3"
	] , "disabled" , "#");

	
	
</script>

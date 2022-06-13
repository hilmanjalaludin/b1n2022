<script type="text/javascript">


var XSELL = function () {}

$('.date').datepicker ({ 
	showOn : 'button', buttonImage : Ext.Image("calendar.gif"),  buttonImageOnly	: true, 
	dateFormat : 'yy-mm-dd'
});

/**
 * [AddOn description]
 */
/**
 * [AddOn description]
 */
XSELL.prototype.AddOn = function () {

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
		
		$.each(fieldAddon , function (key,val) {
			if ( val != "ADDON" ) {
				if ( val == "ADDON_Jenis_Kelamin" ) {
					$("."+val+"_"+valueAddon).attr("disabled" , "disabled");
					$("."+val+"_"+valueAddon).removeAttr("required" , "required");
					$("."+val+"_"+valueAddon).prop("checked", false);
				} else {
					$("#"+val+"_"+valueAddon).removeAttr("required" , "required");
					$("#"+val+"_"+valueAddon).attr("disabled" , "disabled");
				}
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
 * [SpreadForm description]
 */
XSELL.prototype.SpreadForm = function ( json_data ) {



	$("#submitxsell input").each(function () {
		var thisName = $(this).attr("name");
		var thisId = $(this).attr("id");
		if ( typeof(thisId) == "undefined" ) {
			$(this).attr("id" , thisName);
		}
	});

	$("#submitxsell select").each(function () {
		var thisName = $(this).attr("name");
		var thisId = $(this).attr("id");
		if ( typeof(thisId) == "undefined" ) {
			$(this).attr("id" , thisName);
		}
	});

	var obj = json_data;
	if ( typeof(json_data) == "object" ) { 


		if ( obj.hasOwnProperty("xsell") ) {
			var thispro = this;
			$.each( obj.xsell , function (key,val) {
				var TagId = $("#"+key);
				var typeInput = $(TagId).attr("type");
					
				if ( $(TagId).is("select") ) {
					$(TagId).val(val);
				}

				if ( typeInput == "radio" ) {
					var $radio = $('input:radio[name='+key+']');
				    if($radio.is(':checked') === false) {
				        $radio.filter('[value='+val+']').attr('checked', true);
				    }
				}

				if ( typeInput == "checkbox" ) {
					var valueInput = $(TagId).attr("value");
					if ( valueInput == val ) {
						$(TagId).prop("checked", true);
					}
				}

				if ( typeInput == "text" || typeInput == "hidden" ) $(TagId).val(val);
			})
		}


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
						if ( $(idAddonEach).attr("type") == "text" ) $(idAddonEach).val(values);
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
 * [Submit description]
 */
XSELL.prototype.Submit = function () {
		

	var checkInsertXsell = $(".FRM_XSell_Id").val();
	var checkInsertXsell = checkInsertXsell.length;
	var ObjPrototype = this;

	if ( checkInsertXsell == 0 ) {
		$("#submitxsell").submit(function (e) {
			e.preventDefault();

			$( "button" , this).attr("disabled","disabled");

			var forus = this;
			setTimeout(function () {
				$( "button" , forus).removeAttr("disabled");
			} , 3000);

			var dataCreditCard = $(this).serialize();
			var sendParam = {
				url : Ext.DOM.INDEX + "/ProductController/RouteCard/XSELL" , 
				dataType : "json" , 
				data : dataCreditCard ,
				type : "POST"  , 
				success : function (d) {
					if ( d.success == "1" ) {
						$(".FRM_XSell_Id").val(d.insert_id);
						alert(d.message);
					} else {
						alert(d.message);
					}
				}
			};

			$.ajax(sendParam);
			return false;
		});
	} else {
		$("#submitxsell").submit(function (e) {
			e.preventDefault();

			$( "button" , this).attr("disabled","disabled");

			var forus = this;
			setTimeout(function () {
				$( "button" , forus).removeAttr("disabled");
			} , 3000);

			var dataCreditCard = $(this).serialize();
			var sendParam = {
				url : Ext.DOM.INDEX + "/ProductController/RouteCard/XSELLUPDATE" , 
				dataType : "json" , 
				data : dataCreditCard ,
				type : "POST"  , 
				success : function (d) {
					if ( d.success == "1" ) {
						alert(d.message);
						ObjPrototype.SpreadForm(d.xsellupdate);
					} else {
						alert(d.message);
					}
				}
			};

			$.ajax(sendParam);
			return false;
		});
	}

	

}

document.XSELLPro = new XSELL();
document.XSELLPro.SpreadForm(<?php echo json_encode($DetailJs); ?>);
document.XSELLPro.AddOn();
document.XSELLPro.Submit();


</script>
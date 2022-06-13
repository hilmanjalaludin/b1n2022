<script type="text/javascript">

var ADDON = function () {}

/*
 * [Submit description]
 */
 
ADDON.prototype.ChangeField = function ( ObjElement , statusElement , typeElement, sqc=null ) {
	
	// untuk addnew addon
	if(sqc){
		if ( typeof( ObjElement) == "object" ) {
			if ( statusElement == "disabled" ) {
				$.each( ObjElement , function ( key , val ) {
					$(typeElement+""+val+sqc).attr("disabled" , "disabled");
				});
			} 

			if ( statusElement == "enabled" ) {
				$.each( ObjElement , function ( key , val ) {
					$(typeElement+""+val+sqc).removeAttr("disabled");
				});
			}
		}
	// untuk addon pertama
	}else{
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
}

ADDON.prototype.Submit = function () {

		$("#FormAddonTemplate").submit(function (e) {
			e.preventDefault();
			var val = e.originalEvent.explicitOriginalTarget.id;
			var Addsequence = val.substr(val.length -2);
			var ReplaceAddsequence = Addsequence.replace("n", "");
			var dataAddon = $("#addon_"+ReplaceAddsequence).find("select, textarea, input").serialize()+ '&addonseq=' + ReplaceAddsequence;
			console.log(dataAddon);
			
			var sendParam = {
				url : Ext.DOM.INDEX + "/ProductController/RouteCard/ADDON" ,
				dataType : "json" ,
				data : dataAddon ,
				type : "POST"  ,
				success : function (d) {
					if ( d.success == "1" ) {
						window.alert(d.message);
						$(".FRM_ADDON_Id").val(d.insert_id);
						document.ADDON.ChangeField([ "addnew", "cancel"], "enabled", "#", ReplaceAddsequence);
					} else {
						window.alert(d.message);
					}
				}
			};

			$.ajax(sendParam);
			return false;
		});
		
		
		$("#submitdatachanged").submit(function (e) {
			e.preventDefault();
			var submittedid = $(".FRM_ADDON_Id").val();
			submittedid = new String(submittedid);
			// if ( submittedid == 0 ) {
				var dataCreditCard = $(this).serialize();
				var sendParam = {
					url : Ext.DOM.INDEX + "/ProductController/RouteCard/ADDONIF" ,
					dataType : "json" ,
					data : dataCreditCard ,
					type : "POST"  ,
					success : function (d) {
						console.log(d);
						if ( d.success == "1" ) {
							// $(".FRM_ADDON_Id").val(d.insert_id);
							window.alert(d.message);
						} else {
							window.alert(d.message);
						}
					}
				};
				$.ajax(sendParam);
			return false;
		});
	


	/*
	$("#submitadditionalcard1o").submit(function (e) {
		e.preventDefault();
		var Addsequence = $("button").closest("div").prop("id");
		alert(Addsequence);
		return false;
		var Addsequence = myString.substr(myString.length -1);
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
	*/
	
}

ADDON.prototype.SpreadForm = function ( json_data ) {
	
	$("#submitdatachanged input").each(function () {
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
			// alert(lengthAddon);
	if ( typeof(json_data) == "object" && typeof(obj) == "object" && lengthAddon > 0) {
			// if ( obj.hasOwnProperty("addon") ) {
			// var lengthAddon = obj.addon.length;
			// var lengthAddon = Object.keys(obj).length;
			// lengthAddon = parseInt(lengthAddon);

			/*
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
			for ( var addon_sqc = 1; addon_sqc < lengthAddon ; addon_sqc++ ) {
				duplicates();
				document.ADDON.ChangeField([ "addnew", "cancel"], "enabled", "#", lengthAddon);
			}
			// alert(lengthAddon);
			for ( var addon_length = 1; addon_length <= lengthAddon ; addon_length++ ) {
				if ( obj.hasOwnProperty(addon_length) ) {
					var addonValue = obj[addon_length];
					var keysAddon = Object.keys(obj);
					
					$.each(addonValue , function ( keys , values ) {
						// console.log("addon list");
						// console.log(keys);
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
			
	} else {
		console.log("Bukan object");
	}

}

ADDON.prototype.MandatoryForm = function (sequence) {
	var requireForm = [
		"ADDON_Nama_Kartu_1" ,
		"ADDON_Hubungan_1" ,
		"ADDON_Umur_1" ,
		"ADDON_DOB_1" ,
		"ADDON_Jenis_Kartu_1" ,
		"ADDON_Jenis_Kelamin_1",
		"ADDON_No_Hp_1"
	];
	
	$.each( requireForm , function ( key , val ) {
		$("#"+val).attr("required","required");
	});
}

	/* duplicater */	
	function duplicates() {
		var original = $("#addon_1");
		var countCopies = $("[id^='addon_']").length + 1;
		var cloned = original.clone();
		cloned.attr("id", "addon_" + countCopies);
		
		$(cloned).find("[id]").each(function(){
			var current = $(this);
			var currentId = current.attr("id");
			var ids = $("[id='" + currentId + "']");
			/* if(ids.length > 1 && ids[0]==$(this)){ */
				var newId = currentId.substring(0, currentId.length - 1);
				/* console.log(newId); */
				current.attr("id", newId + countCopies);
		});
		
		// console.log(original);
		$(cloned).find("[name]").each(function(){
			var current = $(this);
			var currentId = current.attr("name");
			var ids = $("[name='" + currentId + "']");
			/* if(ids.length > 1 && ids[0]==$(this)){ */
				var newId = currentId.substring(0, currentId.length - 1);
				/* console.log(newId); */
				current.attr("name", newId + countCopies);
		});
		
		$(cloned).find("input:text").val("").end();
		original.parent().append(cloned);
		
		var text = $('#titles_'+countCopies).text();
		text=text.substring(0, text.length - 1);
		$('#titles_'+countCopies).text(text+" "+countCopies);
		$('#FRM_ADDON_Ke_'+countCopies).val(countCopies);

		// The datepicker fields are flagged and so will not be re-initialised. You could remove the flag and then continue
		$(cloned).find('input.fate').removeClass('hasDatepicker');//.datepicker();
		document.JsForm.GetAge("ADDON_DOB_"+countCopies , "ADDON_Umur_"+countCopies , 17 , 65)
		document.ADDON.ChangeField([ "addnew" ], "disabled", "#", countCopies);
	}
	
	function removeAddon(dumper){
		var parentDiv = $("#"+dumper).closest("div").prop("id");
		var hiddenfield = {};
		var Addsequence = "";
		
		$("#"+parentDiv).find("input[type='hidden']").each(function(){
			Addsequence = $(this).attr("id").substr($(this).attr("id").length -2);
			ReplaceAddsequence = Addsequence.replace("_", "");
			hiddenfield[$(this).attr("id")] = $('#'+$(this).attr("id")).val();
		});
		hiddenfield['Addsequence'] = ReplaceAddsequence;
		
		var sendParam = {
				url : Ext.DOM.INDEX + "/ProductController/RouteCard/DELADDON" ,
				dataType : "json" ,
				data : hiddenfield ,
				type : "POST"  ,
				success : function (d) {
					if ( d.success == "1" ) {
						window.alert(d.message);
					} else if ( d.success == "2" ) {
						window.alert(d.message);
					} else {
						window.alert(d.message);
					}
				}
			};

			$.ajax(sendParam);
		console.log(hiddenfield);
		$( "#"+parentDiv ).remove();
	}
	
	function SaveAddon(e){
		// e.preventDefault();
		var Addsequence = e.substr(e.length -1);
		// var dataAddon = $('#divId :input').serialize();
		var dataAddon = $("#addon_"+Addsequence).find("select, textarea, input").serialize()+ '&addonseq=' + Addsequence;
		console.log(dataAddon);
		
		var sendParam = {
			url : Ext.DOM.INDEX + "/ProductController/RouteCard/ADDON" ,
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


		// return false;
	}
	
	
document.ADDON = new ADDON();
document.ADDON.Submit();
document.ADDON.SpreadForm(<?php echo json_encode($DetailJs); ?>);
console.log(<?php echo json_encode($DetailJs); ?>);
document.ADDON.MandatoryForm();

var AddonTrans = <?php echo json_encode($DetailJs); ?>;
var buttons = "disabled";
if(AddonTrans != null && typeof(AddonTrans) == "object"){
var lengthAddon = Object.keys(AddonTrans).length;
	lengthAddon = parseInt(lengthAddon);
	if ( typeof(AddonTrans) == "object" && lengthAddon > 0) {
		var buttons = "enabled";
	}
}
document.ADDON.ChangeField([ "addnew" ], buttons, "#", 1);
	
</script>
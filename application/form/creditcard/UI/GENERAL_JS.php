<script type="text/javascript">

// send manual ajax

document.indexController = "ProductController/";


var FormJs = document.FormJs = function () {}

/**
 * [AjaxAuto description]
 * @param {[type]} urlSend      [description]
 * @param {[type]} responseData [description]
 * @param {[type]} sendData     [description]
 * @param {[type]} typeData     [description]
 */
FormJs.prototype.AjaxAuto = function ( urlSend , responseData , sendData , typeData ) {
	var error = 0;
	var AutoSend;

	if ( typeof( urlSend ) != "string" ) {
		error = error + 1;
	}

	if ( typeof(responseData) != "function" ) {
		erorr = error + 1;
	}

	if ( error == 0 ) {
		if ( sendData == "" ) { sendData = ""; }
		if ( typeData == "" ) { typeData = "json"; }

		/*
		 * [AutoSend description]
		 * @type {Object}
		 */

		AutoSend = {
			url : Ext.DOM.INDEX + "/" + urlSend ,
			type : "POST" ,
			data : sendData ,
			dataType : typeData ,
			success : function (data) {
				eval( 'responseData("' + data + '")' );
			}
		};

		$.ajax(AutoSend);

	}
}

/*
 * [DatePicker description]
 * @param {[type]} divElement [description]
 */
FormJs.prototype.DatePicker = function ( divElement , Month , Type ) {
	var elementDatePicker = $("."+divElement);

	if ( Type == "MY" ) {
		$(elementDatePicker).datepicker( {
        changeMonth: true,
        changeYear: true,
        yearRange: '2000:2100',
        showButtonPanel: true,
        dateFormat: 'mm-yy',
       	   onClose: function(dateText, inst) { 
              $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
           }
    	});
	} else if ( Type == "DMY" ) {
		$(elementDatePicker).datepicker( {
        changeMonth: true,
        changeYear: true,
        yearRange: '1930:2100',
        showButtonPanel: true,
        dateFormat: 'dd-mm-yy',
       	   onClose: function(dateText, inst) { 
              $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
           }
    	});
		
	} else {

		if ( typeof( elementDatePicker )  == 'object' && elementDatePicker != "0" ) {

			if ( Month == true ) {
				var Format = 'mm-yy';
				$(elementDatePicker).datepicker({
		  			showOn: 'button',
		  			yearRange: '2000:2100',
		  			changeMonth: true,
	          		changeYear: true,
		  			buttonImage: Ext.Image('calendar.gif'),
		  			buttonImageOnly: true,
		  			dateFormat: Format ,
		  			readonly:true
		  			});
			} else {
				var Format = 'dd-mm-yy';
				$(elementDatePicker).datepicker({
		  			showOn: 'button',
		  			buttonImage: Ext.Image('calendar.gif'),
		  			buttonImageOnly: true,
		  			dateFormat: Format ,
		  			readonly:true
		  		});
			}
		}
	}

}

/*
 * [Money description]
 * @param {[type]} fieldData [description]
 */
FormJs.prototype.Money = function ( fieldData ) {
	var elementField = $("."+fieldData);
	if ( typeof( elementField ) == "object" && elementField.length != "0" ) {

	}
}

/*
 * [NumberType description]
 * @param {[type]} fieldData [description]
 */
FormJs.prototype.NumberType = function ( fieldData ) {
	var elementField = $("."+fieldData);
	if ( typeof( elementField ) == "object" && elementField.length != "0" ) {
		$(elementField).keydown(function (e) {
	        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
	            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
	            (e.keyCode >= 35 && e.keyCode <= 40)) {
	                 return;
	        }
	        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
	            e.preventDefault();
	        }
	    });
	}
}

FormJs.prototype.Chosen  = function () {
	$('.select-chosen').chosen();
}

/*
 * [GetAge description]
 * @param {[type]} append [description]
 */
FormJs.prototype.GetAge = function ( datePick , append , minage , maxage ) {
	function GetAge(birthDate) {
	    var today = new Date();
	    var age = today.getFullYear() - birthDate.getFullYear();
	    var m = today.getMonth() - birthDate.getMonth();
	    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
	        age--;
	    }
	    return age;
	}

	$( "#" + datePick ).datepicker({
	    changeMonth: true,
	    changeYear: true,
	    dateFormat: 'yy-mm-dd',
	    yearRange: '1945:2020',
	    onSelect: function (date) {
	        var dob = new Date(date);
	        var today = new Date();
	        var AgeNow = GetAge(new Date(date));
	        AgeNow = parseInt(AgeNow); 

	        if ( minage != "" && AgeNow < minage ) {
	        	alert("Minimum Age is "+ minage +"...");
				$("#"+append).val('');
	        } else {
	        	$("#"+append).val(AgeNow);
	        }
			
			if ( maxage != '' && AgeNow > maxage ) {
				alert("Maximum Age is "+ maxage +"...");
				$("#"+append).val('');
			} else {
				$("#"+append).val(AgeNow);
			}


	    }

	 });
}


/*
 * [GetAge description]
 * @param {[type]} append [description]
 */
FormJs.prototype.GetAgeBydate = function ( datePick , minage , maxage ) {
	function GetAge(birthDate) {
	    var today = new Date();
	    var age = today.getFullYear() - birthDate.getFullYear();
	    var m = today.getMonth() - birthDate.getMonth();
	    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
	        age--;
	    }
	    return age;
	}

	$( "#" + datePick ).datepicker({
	    changeMonth: true,
	    changeYear: true,
	    dateFormat: 'yy-mm-dd',
	    yearRange: '1945:2020',
	    onSelect: function (date) {
			
			var dob = new Date(date);
	        var today = new Date();
	        var AgeNow = GetAge(new Date(date));
	        AgeNow = parseInt(AgeNow); 
			
			//alert(AgeNow);
			
	        if ( minage != "" && AgeNow < minage ) {
	        	alert("Minimum Age is "+ minage +"...");
				$("#"+datePick).val('');
	        } else {
	        	$("#"+datePick).val(date);
	        }
			
			if ( maxage != '' && AgeNow > maxage ) {
				alert("Maximum Age is "+ maxage +"...");
				$("#"+datePick).val('');
			} else {
				$("#"+datePick).val(date);
			}


	    }

	 });
}



document.JsForm = new FormJs();
document.JsForm.NumberType("number");
document.JsForm.DatePicker("date");
document.JsForm.DatePicker("datemm",true);
document.JsForm.DatePicker("datemy",true , "MY");
document.JsForm.DatePicker("datedmy",true , "DMY");

document.JsForm.GetAge("ADDON_DOB_1" , "ADDON_Umur_1" , 17 , 65);
document.JsForm.GetAge("ADDON_DOB_2" , "ADDON_Umur_2" , 17 , 65);
document.JsForm.GetAge("ADDON_DOB_3" , "ADDON_Umur_3" , 17 , 65);

document.JsForm.GetAgeBydate("CONTACT_Tgl_Lahir" , 21 , 65);

document.JsForm.GetAge("ADDON_DOB" , "ADDON_Umur");




</script>

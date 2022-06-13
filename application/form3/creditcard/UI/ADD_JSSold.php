<script type="text/javascript">


var ADDON = function () {}

/**
 * [Submit description]
 */
ADDON.prototype.Submit = function () {

	
		$("#submitdatachanged").submit(function (e) {
			e.preventDefault();

			var submittedid = $(".FRM_ADDON_Id").val();
			submittedid = new String(submittedid);


			if ( submittedid == 0 ) {
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
			} else {
				$("#submitdatachanged").submit(function (e) {
					e.preventDefault();

					var dataCreditCard = $(this).serialize();
					var sendParam = {
						url : Ext.DOM.INDEX + "/ProductController/RouteCard/ADDONUPDATE" ,
						dataType : "json" ,
						data : dataCreditCard ,
						type : "POST"  ,
						success : function (d) {
							console.log(d);
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



			
			return false;
		});
	



	$("#submitadditionalcard").submit(function (e) {
		e.preventDefault();
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


document.ADDON = new ADDON();
document.ADDON.Submit();


</script>

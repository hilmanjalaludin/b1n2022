<script>
	// ---------------------------------------------------------------------------------------------------------------
	/*
	 * @ def	 : $.RoleBack
	 * 
	 * @ params	 : method on ready pages 
	 * @ package : bucket datas 
	 */

	Ext.DOM.RoleBack = function() {
		if (Ext.Msg('Are you sure ?').Confirm()) {
			Ext.ShowMenu("TlkProgram", Ext.System.view_file_name());
		}
	}


	// ---------------------------------------------------------------------------------------------------------------
	/*
	 * @ def	 : function ready 
	 * 
	 * @ params	 : method on ready pages 
	 * @ package : bucket datas 
	 */

	Ext.DOM.Continue = function() {
		Ext.ShowMenu(new Array('TlkProgram', 'AddPrefix'),
			Ext.System.view_file_name(), {
				time: Ext.Date().getDuration()
			});
	}


	// ---------------------------------------------------------------------------------------------------------------
	/*
	 * @ def	 : function ready 
	 * 
	 * @ params	 : method on ready pages 
	 * @ package : bucket datas 
	 */

	Ext.DOM.UpdatePrefix = function() {
		Ext.Ajax({
			url: Ext.EventUrl(new Array("TlkProgram", "Update")).Apply(),
			method: 'POST',
			param: Ext.Join([Ext.Serialize("frmEditPrefix").getElement()]).object(),
			ERROR: function(fn) {
				try {
					var ERR = JSON.parse(fn.target.responseText);
					if (ERR.success) {
						Ext.Msg("Update Product Program ").Success();
					} else {
						Ext.Msg("Update Product Program ").Failed();
					}
				} catch (e) {
					Ext.Msg(e).Error();
				}
			}
		}).post();
	}


	// ---------------------------------------------------------------------------------------------------------------
	/*
	 * @ def	 : function ready 
	 * 
	 * @ params	 : method on ready pages 
	 * @ package : bucket datas 
	 */
	Ext.DOM.savePrefix = function() {
		var frmProductPrefix = Ext.Serialize('frmProductPrefix');
		if (!frmProductPrefix.Complete(new Array('form_edit'))) {
			Ext.Msg("Form Input not completed!").Info();
			return false;
		}
		// console.log(frmProductPrefix)

		if (Ext.Msg("Do you want to save this Program").Confirm()) {
			Ext.Ajax({
				url: Ext.EventUrl(new Array("TlkProgram", "SavePrefix")).Apply(),
				method: 'POST',
				param: {
					PRD_Data_Master: Ext.Cmp('PRD_Data_Master').getValue(),
					PRD_Data_Kode: Ext.Cmp('PRD_Data_Kode').getValue(),
					PRD_Data_Value: Ext.Cmp('PRD_Data_Value').getValue(),
					PRD_Data_Tenor: Ext.Cmp('PRD_Data_Tenor').getValue(),
					PRD_Data_Rate: Ext.Cmp('PRD_Data_Rate').getValue(),
					PRD_Data_Sort: Ext.Cmp('PRD_Data_Sort').getValue(),
					status_active: Ext.Cmp('status_active').getValue()
				},
				ERROR: function(e) {
					var ERR = JSON.parse(e.target.responseText);
					if (ERR.success) {
						Ext.Msg("Save Program").Success();
						if (Ext.Msg("Do you want to add again?").Confirm()) {
							Ext.DOM.Continue();
						}
					} else {
						Ext.Msg("Save Program").Failed();
						return false;
					}
				}

			}).post();
		}
	}

	// ---------------------------------------------------------------------------------------------------------------
	/*
	 * @ def	 : $.ready
	 * 
	 * @ params	 : method on ready pages 
	 * @ package : bucket datas 
	 */

	$(document).ready(function() {
		var date = new Date();
		$('#ui-widget-add-campaign').mytab().tabs();
		$('#ui-widget-add-campaign').mytab().tabs("option", "selected", 0);
		$('#ui-widget-add-campaign').css({
			'background-color': '#FFFFFF'
		});
		$('#ui-widget-add-content').css({
			'background-color': '#FFFFFF'
		});

		$("#ui-widget-add-campaign").mytab().close(function() {
			Ext.DOM.RoleBack();
		});

		$('.select').chosen();
	});
</script>
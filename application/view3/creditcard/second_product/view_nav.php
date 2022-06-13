<?php echo javascript(); ?>
<script type="text/javascript">
	var Role = new Ext.Role("SecondProduct");
	Role.extend([{
			title: " ",
			icon: "",
			event: "",
			key: 'PerUserId'
		} // if you have other extends event 
	]);
	// --------------------------------------------------------------------------------------------------------------------------
	/*
	 * @ package  	user searc data .
	 * @ note		eweh note.
	 */

	Ext.DOM.onload = (function() {
		Ext.Cmp('ui-widget-title').setText(Ext.System.view_file_name());
	})()


	// --------------------------------------------------------------------------------------------------------------------------
	/*
	 * @ package  	user searc data .
	 * @ note		eweh note.
	 */

	Ext.DOM.datas = {
		CV_Data_CustId: "<?php echo _get_exist_session('CV_Data_CustId'); ?>",
		CV_Data_Custno: "<?php echo _get_exist_session('CV_Data_Custno'); ?>",
		DM_FirstName: "<?php echo _get_exist_session('DM_FirstName'); ?>",
		CV_Data_CardType: "<?php echo _get_exist_session('CV_Data_CardType'); ?>",
		CallReasonDesc: "<?php printf('%s', _get_exist_session('CallReasonDesc')); ?>",
		DM_UploadedTs: "<?php printf('%s', _get_exist_session('DM_UploadedTs')); ?>",
		CampaignCode: "<?php printf('%s', _get_exist_session('CampaignCode')); ?>"
	}

	// --------------------------------------------------------------------------------------------------------------------------
	/*
	 * @ package  	user searc data .
	 * @ note		eweh note.
	 */

	Ext.DOM._content_page = {
		custnav: Ext.EventUrl(['SecondProduct', 'index']).Apply(),
		custlist: Ext.EventUrl(['SecondProduct', 'Content']).Apply()
	}
	// --------------------------------------------------------------------------------------------------------------------------
	/*
	 * @ package  	user searc data .
	 * @ note		eweh note.
	 */

	Ext.EQuery.TotalPage = '<?php echo $page->_get_total_page(); ?>';
	Ext.EQuery.TotalRecord = '<?php echo $page->_get_total_record(); ?>';
	// --------------------------------------------------------------------------------------------------------------------------
	/*
	 * @ package  	user searc data .
	 * @ note		eweh note.
	 */

	Ext.DOM.searchWork = function() {
		$.cookie('selected', 0)

		var FrmGroupLayout = Ext.Serialize("FrmGroupLayout");
		console.log(FrmGroupLayout.getElement());
		Ext.EQuery.construct(Ext.DOM._content_page, Ext.Join([
			FrmGroupLayout.getElement()
		]).object());
		Ext.EQuery.postContent();
	}

	// --------------------------------------------------------------------------------------------------------------------------
	/*
	 * @ package  	user searc data .
	 * @ note		eweh note.
	 */

	Ext.DOM.Clear = function() {
		Ext.Serialize("FrmGroupLayout").Clear();
		new Ext.DOM.searchWork();
	}

	// --------------------------------------------------------------------------------------------------------------------------
	/*
	 * @ package  	user searc data .
	 * @ note		eweh note.
	 */

	Ext.EQuery.construct(Ext.DOM._content_page, datas)
	Ext.EQuery.postContentList();

	// --------------------------------------------------------------------------------------------------------------------------
	/*
	 * @ package  	user searc data .
	 * @ note		eweh note.
	 */

	Ext.DOM.DisableUserLayout = function() {
		Ext.Ajax({
			url: Ext.DOM.INDEX + '/SecondProduct/SetLayout/',
			method: 'POST',
			param: {
				SetLayout: 0,
				LayoutId: Ext.Cmp('KurirID').getValue()
			},
			ERROR: function(fn) {
				var ERR = JSON.parse(fn.target.responseText);
				if (ERR.success) {
					Ext.Msg("Disable Layout").Success();
					Ext.EQuery.construct(Ext.DOM._content_page, datas)
					Ext.EQuery.postContent();
				} else {
					Ext.Msg("Disable Layout").Failed();
				}
			}
		}).post();
	}

	// --------------------------------------------------------------------------------------------------------------------------
	/*
	 * @ package  	user searc data .
	 * @ note		eweh note.
	 */


	Ext.DOM.EditLayout = function() {

		var KurirID = Ext.Cmp('KurirID').getValue();
		console.log(KurirID)
		if (KurirID == '') {
			Ext.Msg("Please select a rows ").Info();
			return false;
		}
		Ext.ShowMenu(new Array('SecondProduct', 'Edit'),
			Ext.System.view_file_name(), {
				KurirID: KurirID
			});

	}
	// --------------------------------------------------------------------------------------------------------------------------
	/*
	 * @ package  	user searc data .
	 * @ note		eweh note.
	 */

	$(document).ready(function() {
		$('#toolbars').extToolbars({
			extUrl: Ext.DOM.LIBRARY + '/gambar/icon',
			extTitle: [
				['Search'],
				['Clear'],
				['Edit'],
			],
			extMenu: [
				['searchWork'],
				['Clear'],
				['EditLayout'],
			],
			extIcon: [
				['zoom.png'],
				['zoom_out.png'],
				['calendar_edit.png'],
			],
			extText: true,
			extInput: false,
			extOption: []
		});
		$('.select').chosen();
	});
</script>

<!-- start : content -->
<fieldset class="corner">
	<?php echo form()->legend(lang(""), "fa-users"); ?>
	<div id="result_content_add" class="ui-widget-panel-form">
		<form name="FrmGroupLayout">
			<div class="ui-widget-table-compact">
				<div class="ui-widget-form-row">
					<div class="ui-widget-form-cell text_caption">Nama Customer</div>
					<div class="ui-widget-form-cell text_caption center">:</div>
					<div class="ui-widget-form-cell"><?php echo form()->input("DM_FirstName", "input_text superlong", _get_exist_session('layout_name')); ?></div>
					<div class="ui-widget-form-cell text_caption">Customer No</div>
					<div class="ui-widget-form-cell text_caption center">:</div>
					<div class="ui-widget-form-cell"><?php echo form()->input("CV_Data_Custno", "input_text superlong", _get_exist_session('layout_name')); ?></div>

				</div>

				<div class="ui-widget-form-row">
				</div>
			</div>
		</form>
	</div>

	<div class="ui-widget-toolbars" id="toolbars"></div>
	<div class="ui-widget-panel-content" id="#panel-content"></div>
	<div class="content_table" id="ui-widget-content_table"></div>
	<div class="ui-widget-pager" id="pager"></div>
	<div class="ui-widget-component" id="ui-widget-component"></div>
</fieldset>
<!DOCTYPE html>
<html>
 <head>
 <meta charset="UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
 <title><?php echo title_header("Add Contact");?></title>
 <meta name="viewport" content="width=device-width" />
 
 <link type="text/css" rel="stylesheet" href="<?php echo base_layout_style();?>/styles.plugin.css?version=<?php echo version();?>&amp;time=<?php echo time();?>"/>
 <link type="text/css" rel="stylesheet" href="<?php echo base_themes_style( themes() );?>/ui.all.css?time=<?php echo time();?>" />
 <link type="text/css" rel="stylesheet" href="<?php echo base_fonts_style();?>/font-awesome.min.css?version=<?php echo version();?>&amp;time=<?php echo time();?>"/>
 <link type="text/css" rel="stylesheet" href="<?php echo base_layout_style();?>/styles.overwriter.css?time=<?php echo time();?>" />
 <link type="text/css" rel="shortcut icon" href="<?php echo base_image_layout();?>/favicon.png?version=<?php echo version();?>&amp;time=<?php echo time();?>">
 
 <script type="text/javascript" src="<?php echo base_spl_cores(); ?>/jquery-1.4.4.js?version=<?php echo version();?>&amp;time=<?php echo time();?>"></script>
 <script type="text/javascript" src="<?php echo base_spl_loader();?>?version=<?php echo version();?>&amp;time=<?php echo time();?>"></script>
 <script type="text/javascript" src="<?php echo base_ext_cores(); ?>/EUI.1.3.15.js?version=<?php echo version();?>&amp;time=<?php echo time();?>"></script>
 <script type="text/javascript" src="<?php echo base_ext_cores(); ?>/EUI.Loader.1.3.15.js?version=<?php echo version();?>&amp;time=<?php echo time();?>"></script> 
 <script type="text/javascript" src="<?php echo base_ext_other();?>?version=<?php echo version();?>&amp;time=<?php echo time();?>"></script> 
 <script>
// --------------------------------------------------------------------------------------------
/* 
 * @ package			add view additional phone by user 
 
 * @ auth 				uknown 
 * @ param 				$CustomerId
 * @ aksess 			public   
 */
 // window.PhoneSelectType = function(obj)
// {
	// Ext.Ajax
	// ({
		// url 	: Ext.EventUrl(new Array('ModApprovePhone', 'PhoneNumber')).Apply(),	
		// method  : 'POST',
		// param	: {
			// CustomerId : Ext.Cmp('AddCustomerId').getValue(),
			// FieldName  : obj.value
		// },
		// ERROR 	: function(e){
			// Ext.Util(e).proc(function(select){
				// $('#PhoneAddTypeValueId').val(select.phoneNumber);
			// });
		// }
	// }).post();
// } 

 /*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
 
 window.AddContactLayout = function()  { 
	$('body').css ({ "padding" : "8px" });
	$('.page-wrapper').css({ 
		'margin' : '8px',
		'border' : '1px solid #ddd'	
	});
	$('a.ui-user-chat').css({"color" : "green" });
	$('a.ui-user-chat:hover').css({"color" : "red" });
	
	$('.button-data').css({'width' : '47%' });
	$('.right-cond').css({"margin-left" : "10px" });
	$('.autorizer').css({ 'height' : ($(window).innerHeight()-20), 
		'padding' : '0px 5px 0px 5px'
	});
 }
 
/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
 $(window).bind("resize", function(e){ 
	window.AddContactLayout();
 }); 
/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
$(document).ready(  function() {
	window.AddContactLayout();
});
/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
window.SubmitAddContact = function(){

// simpan data ke bentuk object untuk di kirim ke process 
// penyimpanan data .
	
	var dataURL = Ext.EventUrl( new Array('ModApprovePhone', 'Submit')),
		CustomerId = Ext.dataURI('CustomerId').getValue(),
		ContactType = Ext.Cmp('PhoneSelectTypeId').getValue(),
		ContactNumber = Ext.Cmp('PhoneAddTypeValueId').getValue();
		ContactNumber = ContactNumber.replace(/\s/g,'');
	
	var frmAddContact = Ext.Serialize('frmAddContact'),
	 conds = frmAddContact.Complete([
		'ContactType', 'ContactNumber'
	]);

	// alert(ContactNumber);
	
	//---cek input additional phone
	if( !conds ){ 
		Ext.Msg("Input form not complete!").Info(); 
		return false; 
	}
	
// process kirim data ke modul .ajax 		
	 Ext.Ajax ({
		url 	: dataURL.Apply(),
		method 	: 'POST',
		param 	: {
			CustomerId : CustomerId,
			ContactType : ContactType,
			ContactNumber : ContactNumber
		},
		success : function( xhr ){
			Ext.Util(xhr).proc(function( data ){
				if( data.success == 1){
					Ext.Msg("Add Contact").Success();
					return false;
				} else {
					Ext.Msg("Add Contact").Failed();
					return false;
				}
			});
		}
	}).post();
}
/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
window.CancelAddContact = function(){
	var callBackMsg = Ext.Msg("Do you want to close ?").Confirm();
	if( !callBackMsg ){
		return false;
	}
	window.close(this);
}

</script>
</head>
<body>
<div class="pager-wrapper">
	<fieldset class="corner autorizer">
	<?php echo form()->legend(lang('Add Contact'), "fa-phone"); ?>
	
	<form name="frmAddContact" onsubmit = "return false;">	
		<div class="ui-widget-form-table">
			<div class="ui-widget-form-row">
				<div class="ui-widget-form-cell text_caption">* <?php echo lang('DM_ContactType');?></div>
				<div class="ui-widget-form-cell center">:</div>
				<div class="ui-widget-form-cell left"><?php echo form()->combo('PhoneSelectTypeId','select superlong', PhoneType());?></div>
			</div>
		
			<div class="ui-widget-form-row ui-cols-baris2">
				<div class="ui-widget-form-cell text_caption">* <?php echo lang('DM_ContactNumber');?></div>
				<div class="ui-widget-form-cell center">:</div>
				<div class="ui-widget-form-cell left"><?php echo form()->input('PhoneAddTypeValueId','input_text superlong', null);?></div>
			</div>
		<!-- jika button data add OK -->	
		<?php //if( $btn->find_value('_ADD_TOOL_') )  : ?>	
			<div class="ui-widget-form-row">
				<div class="ui-widget-form-cell"></div>
				<div class="ui-widget-form-cell"></div>
				<div class="ui-widget-form-cell"> </div>
			</div>
			<div class="ui-widget-form-row">
				<div class="ui-widget-form-cell"></div>
				<div class="ui-widget-form-cell"></div>
				<div class="ui-widget-form-cell"> </div>
			</div>
			<div class="ui-widget-form-row">
				<div class="ui-widget-form-cell"></div>
				<div class="ui-widget-form-cell"></div>
				<div class="ui-widget-form-cell left"> 
					<button class="btn btn-info btn-sm left-cond button-data" onclick="window.SubmitAddContact();"><i class="fa fa-floppy-o"></i>&nbsp;Submit</button>
					<button class="btn btn-info btn-sm right-cond button-data" onclick="window.CancelAddContact();"><i class="fa fa-close"></i>&nbsp;Close</button>
				</div>
			</div>
		<?php //endif; ?>
		
		</div>
	</form>	
	
	</fieldset>	
</div>
</body>
</html>


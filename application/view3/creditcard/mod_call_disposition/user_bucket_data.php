<!DOCTYPE html>
<html>
 <head>
 <meta charset="UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
 <title><?php echo title_header("User Kuota");?></title>
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
  

 
/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
 window.UserKuotaPage = function( Pager )  {  
  // ambil attribute dari parent window yang di kirim 
  // via parameter header .
  
	var dataUser = Ext.dataURI('UserId').getValue(),
		dataURL = Ext.dataURI('DataURL').getValue();
		
	// set URL location untuk Process Ajax Ke Controller 
	// dan model data di server .
	var dataURI  = Ext.EventUrl(new Array('BucketKuota','DataKuota'));
	
	// spiner data on work .
	$('#kuota-pager-data').Spiner({
		url 	: dataURI.Apply(),
		param 	: {
			dataUser : dataUser,
			dataURL  : dataURL
		},
		order   : {
			order_type : Pager.type,
			order_by   : Pager.orderby,
			order_page : Pager.page	
		}, 
		handler : 'UserKuotaPage',
		complete : function( html ){
			console.log(html);
			$(html).css({'height': '100%','margin-top':'10px', 'padding-left':'6px' });
		}
	});
 }
/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
 
 window.EventDelete = function( dataURI ){
	var KuotaId =  dataURI;
	if( !KuotaId ){
		return false;
	}
	
	var callBackMsg = Ext.Msg("Are you sure ?").Confirm();
	if( !callBackMsg ){
		return false;
	}
	// get data process on ajax 
	var dataURI = Ext.EventUrl( new Array('BucketKuota','DeleteKuota') )
	Ext.Ajax({
		url   : dataURI.Apply(), 
		param : {
			KuotaId : KuotaId
		},
		success : function( xhr ){
			Ext.Util(xhr).proc(function( data ){
				if( data.success == 1  ){
					Ext.Msg('Delete Bucket Kuota').Success();
					window.UserKuotaPage({  orderby : '',   type : '',  page : 0 }); 
				} 
				// jika process delete gagal 
				// keluarkan informasi ini.
				else {
					Ext.Msg('Delete Bucket Kuota').Failed();
					return;
				}
			});
		}
	}).post()	
	// console.log(dataURI);
 }  
 /*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
 
 window.UserKuotaData = function()  { 
	$('body').css ({ "padding" : "8px" });
	$('.page-wrapper').css({ 
		'margin' : '8px',
		'border' : '1px solid #ddd'	
	});
	$('a.ui-user-chat').css({"color" : "green" });
	$('a.ui-user-chat:hover').css({"color" : "red" });
 }
/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	 
 $(document).ready(function() { 
	window.UserKuotaData();	
	window.UserKuotaPage({  orderby : '',   type : '',  page : 0 }); 
 });
 
/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
 $(window).bind("resize", function(e){ 
	window.UserKuotaData()
 });

</script>
</head>
<body>
 <div class="pager-wrapper">
	<fieldset class="corner">
		<?php echo form()->legend(lang('Bucket Kuota'), "fa-users"); ?>
		<div id="kuota-pager-data"></div>
	</fieldset>
 </div>
</body>
</html>
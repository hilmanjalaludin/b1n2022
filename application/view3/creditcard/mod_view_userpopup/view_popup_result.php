<!DOCTYPE html>
<html>
 <head>
 <meta charset="UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
 <title><?php echo title_header(UR()->field('origin','AllCallStatus'));?></title>
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
 <script type="text/javascript" src="<?php echo base_ext_other(); ?>?version=<?php echo version();?>&amp;time=<?php echo time();?>"></script>  
 <script>

 /*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
 
 window.WindowPopupLayout = function()  { 
	$('body').css ({ "padding" : "8px" });
	$('.page-wrapper').css({ 
		'margin' : '8px',
		'border' : '1px solid #ddd'	
	});
	$('a.ui-user-chat').css({"color" : "green" });
	$('a.ui-user-chat:hover').css({"color" : "red" });
	
	$('.button-data').css({'width' : '47%' });
	$('.right-cond').css({"margin-left" : "10px" });
	
 }
 
/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
 $(window).bind("resize", function(e){ 
	window.WindowPopupLayout();
 }); 
/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
$(document).ready(  function() {
	window.WindowPopupLayout();
	console.log( ); 
	
	var newheight = ($('.form-control-popup-field').innerHeight()+100),
		newwidth  = $(window).width();
	// rekonstucksi with of window 
	 window.resizeTo( newwidth, newheight);
});

/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
window.EventHandler = function( data ){ 
var targetID = Ext.System.URL('target').getValue();
 if( targetID ){
	window.opener.Ext.Cmp(targetID).setValue( data.value );
 }

}
/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
window.EventClose = function(){
	window.close(this);
}
</script>
 </head>
<body>
<div class="pager-wrapper">
	<fieldset class="corner form-control-popup-field">
	<?php echo form()->legend(lang( UR()->field('origin','AllCallStatus') ), "fa-book"); ?>
		<?php echo form()->formpopup('callid', '', $row); ?>
	
	
	</fieldset>
</div>
</body>
</html>

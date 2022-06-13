<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title><?php echo title_header("Approval Data");?></title>
	<meta name="title" content="<?php echo description();?>"/>
	<meta name="description" content="<?php echo description();?>"/>
	<meta name="version" content="<?php echo version();?>"/>
	<meta name="author" content="<?php echo author();?>"/>
	<meta name="date" content="<?php echo dsinstall();?>"/>
	<meta name="theme" content="<?php echo themes(); ?>"/>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
	<meta http-equiv="Content-Style-Type" content="text/css"/>
	<meta http-equiv="Content-Script-Type" content="text/javascript">
	
	<link type="text/css" rel="stylesheet" href="<?php echo base_themes_style();?>/ui.all.css?time=<?php echo time();?>" />
	<link type="text/css" rel="stylesheet" href="<?php echo base_fonts_style();?>/font-awesome.min.css?time=<?php echo time();?>" />
	<link type="text/css" rel="stylesheet" href="<?php echo base_layout_style();?>/styles.overwriter.css?time=<?php echo time();?>" />
	<link type="text/css" rel="shortcut icon"  href="<?php echo base_image_layout();?>/favicon.png?version=<?php echo version();?>&amp;time=<?php echo time();?>">
	
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
window.FlexibelData = function(){ 
	$('body').css ({ "padding" :  "8px" });
	
	$('.corner').css({ "height" : ($(window).innerHeight()-50) });
	$('.select').css({"height":"25",'width' : '90%'});
	$('.textarea').css({"height":"120",'width' : '88%'});
	
	$('.ui-row-col1').css({"width":"20%"});
	$('.ui-row-col2').css({"width":"1%"});
	$('.ui-row-col3').css({"width":"79%"});
	
	$('.button').css({"height":"24","width" : "44%"});
	
} 
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
window.EventSaleHandler = function(){
	return null;
}
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
window.EventCallResultID = function( dropdown ) {
	var urlDataWindow = new Ext.EventUrl( new Array( 'SrcCustomerList','SelectCallResultId'));
	  $('#ui-call-result-id').loader
	  ({
			url 	: urlDataWindow.Apply(),
			method 	: 'POST',
			param 	: {
				CallStatusId : dropdown.value
			},	
			complete : function( html ){
				$(html).css({'height' : '100%'});
				window.FlexibelData();
			}
	 }); 
}

/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
window.EventSubmit = function(){
	
	// will render by javascript on tag form 
	var dataSubmitUrl = new Ext.EventUrl( new Array('ModSaveActivity/SaveApprovalActivity') );
	Ext.Serialize('frmUserApproval').Submit
	({
		procedure:{ arg : 'Complete',  
					val : [] },
					
		callback : {
			url    	: dataSubmitUrl.Apply(),
			method 	: 'POST', 
			success : function( xhr ){
				Ext.Util( xhr ).proc( function( data ){
					if( data.success == 1){
						Ext.Msg("Approval Data").Success();
						return false;
					}
					else {
						Ext.Msg("Approval Data").Failed();
						return false;
					}
				});
			}
		}
	});
}

/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
window.EventClose =function(){
	var callBackMsg	= Ext.Msg('Are you sure exit from this from ?').Confirm();
	if( !callBackMsg ){
		return false;
	}
	// then will get of process 
	window.opener.EventSearch();
	window.close(this);
}

/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */ 
$(document).ready(function() { 
	window.FlexibelData();
	//$('.select').chosen();
});
/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */ 
$(window).bind("resize", function(e){ 
	window.FlexibelData(); 
	//$('.select').chosen();
});

	</script>
 </head>
<body>
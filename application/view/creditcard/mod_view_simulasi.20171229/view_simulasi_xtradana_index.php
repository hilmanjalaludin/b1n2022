<!DOCTYPE html>
<html>
<head>
 <meta charset="UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
 <title><?php echo title_header(sprintf("Simulasi %s", $program));?></title>
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
 <style>
	body{ padding:9px;} .page-wraper .ui-panel-page{
		margin-top: -10px !important;
	} 
	.page-wraper .input_text{ height:22px !important;}
	button.button-max{
		width:125px !important;
		margin-top:-2px !important;
		height : 26px !important;
	}
	input.u-max-length{ 
		width : 120px !important;
	}
	select.u-max-length{ 
		width : 125px !important;
	}
	div.right{  padding-right:4px !important; }
 </style>
 
 <!-- local javascript data -->
 <!-- local javascript data -->
 
 <script type="text/javascript">		
/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
 
 window.EventPagerXtradana = function( obj ){
	 
   var dataURL  = Ext.EventUrl( new Array('Simulasi', 'PagerXtradana')); 
    $('#ui-panel-body-xtradana').Spiner
   ({
		url    : dataURL.Apply(),
		method : 'POST',
		param  : {
		  txJsDana  : Ext.Cmp('txJsDana').getValue(), 
		  txJsTenor : Ext.Cmp('txJsTenor').getValue(),
		  txJsRate  : Ext.Cmp('txJsRate').getValue()
		},
		complete  : function( html ){
			$(html).css({'height' : '100%'})
		}
	});
 }
		
/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
 
 window.EventProcessXtradana = function( obj ){
   window.EventPagerXtradana(); 
 }		
 
 /*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	 
 
window.EventAutoSetupData = function(){
	// Ext.Cmp('txJsDana').setValue( Ext.dataURI('JumlahDana').getValue() );
	// Ext.Cmp('txJsTenor').setValue( Ext.dataURI('JumlahTenor').getValue() );
} 
/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	 
 
 $(document).ready(function(){
	window.EventAutoSetupData();
	window.EventPagerXtradana(); 
	$('.select').chosen();
	
	$('.disabled').each(function(){
		Ext.Cmp( $(this).attr('id') ).disabled( true );
	});
 });
 
</script> 
</head> 

<body> 

 <div class="page-wraper"> 
 <fieldset class="corner">
	<?php echo form()->legend(lang(sprintf("Simulasi %s", $program)), "fa-users"); ?>
	<div class="ui-widget-form-table ui-panel-page" style="margin-left:-1px;width:99%;">
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell" style="vertical-align:top;">
				<?php get_view(array("mod_view_simulasi","view_simulasi_xtradana_header"));?>
			</div>	
		</div>
			
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell">
				<?php get_view(array("mod_view_simulasi","view_simulasi_xtradana_body"));?>
			</div>
		</div>
	</div>
  </fieldset>
 </div>
  
</body>
</html>
 
 
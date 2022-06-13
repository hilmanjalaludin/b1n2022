<!DOCTYPE html>
<html>
<head>
 <meta charset="UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
 <title><?php echo title_header(sprintf("Callculator %s", $program));?></title>
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
	 
   var dataURL  = Ext.EventUrl( new Array('Simulasi', 'PagerBalcon')); 
    $('#ui-panel-body-xtradana').Spiner
   ({
		url    : dataURL.Apply(),
		method : 'POST',
		param  : {
		  txJsDana  : Ext.Cmp('txJsDana').getValue(), 
		  txJsTenor : Ext.Cmp('txJsTenor').getValue(),
		  txJsRate  : Ext.Cmp('txJsRatess').getValue()
		},
		complete  : function( html ){
			$(html).css({'height' : '100%'});
			
			var newheight = ($('.autoheight-popup-data').innerHeight()+160),
		newwidth  = 600;
	// rekonstucksi with of window 
			window.resizeTo( newwidth, newheight);
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
 window.EventProcessBalconss = function( obj ){
   //window.EventPagerXtradana(); 
   if(obj.value == '3'){
	  Ext.Cmp('txJsRate').setValue('BC 0%');
	  Ext.Cmp('txJsRatess').setValue('0.0');
   }else if(obj.value == '6' || obj.value == '9' || obj.value == '12'){
	  Ext.Cmp('txJsRate').setValue('BC 0.8%');
	  Ext.Cmp('txJsRatess').setValue('0.8');
   }else if(obj.value == '18'){
	  Ext.Cmp('txJsRate').setValue('BC 0.75%');
	  Ext.Cmp('txJsRatess').setValue('0.75');
   }else if(obj.value == '24'){
	  Ext.Cmp('txJsRate').setValue('BC 0.7%');
	  Ext.Cmp('txJsRatess').setValue('0.7');
   }else if(obj.value == '36'){
	  Ext.Cmp('txJsRate').setValue('BC 0.65%');
	  Ext.Cmp('txJsRatess').setValue('0.65');
   }else{
	Ext.Cmp('txJsRate').setValue('');
	Ext.Cmp('txJsRatess').setValue('');
   }
 }	
 /*
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
var format = function(num){
    var str = num.toString().replace("$", ""), parts = false, output = [], i = 1, formatted = null;
    if(str.indexOf(",") > 0) {
        parts = str.split(",");
        str = parts[0];
    }
    str = str.split("").reverse();
    for(var j = 0, len = str.length; j < len; j++) {
        if(str[j] != ".") {
            output.push(str[j]);
            if(i%3 == 0 && j < (len - 1)) {
                output.push(".");
            }
            i++;
        }
    }
    formatted = output.reverse().join('');
    return( '' + formatted + ((parts) ? ',' + parts[1].substr(0, 2) : ''));
}

 /*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	 
 
window.checkAllTenor = function( obj ){
	if( obj.checked ){
		$('option').prop('selected', true);
		$('#txJsTenor').trigger('chosen:updated');
		 
	}
	else {
		$('option').prop('selected', false);
		$('#txJsTenor').trigger('chosen:updated');
	}
	
} 
 /*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	 
window.checkAllRate = function( obj ){
	if( obj.checked ){
		$('option').prop('selected', true);
		$('#txJsRate').trigger('chosen:updated'); 
	}
	else {
		$('option').prop('selected', false);
		$('#txJsRate').trigger('chosen:updated');
	}
}

 /*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	 
 
 
 window.setCalculatorDana = function( data ){
	$(data).val( format($(data).val()));
	//Ext.Cmp('TX_Usg_SimulDana').setValue( $(data).val() );
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
	//window.EventPagerXtradana(); 
	$('.select').chosen();
	
	// autoheight form adapt user popup resize to
	
	var newheight = ($('.autoheight-popup-data').innerHeight()+160),
		newwidth  = $(window).width()+100;
	// rekonstucksi with of window 
		window.resizeTo( newwidth, newheight);
	
 });
 
</script> 
</head> 

<body> 

 <div class="page-wraper"> 
 <fieldset class="corner autoheight-popup-data">
	<?php echo form()->legend(lang(sprintf("Callculator %s", $program)), "fa-calculator"); ?>
	<div class="ui-widget-form-table ui-panel-page" style="margin-left:-1px;width:99%;">
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell" style="vertical-align:top;">
				<?php get_view(array("mod_view_simulasi","view_simulasi_balcon_header"));?>
			</div>	
		</div>
			
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell">
				<?php get_view(array("mod_view_simulasi","view_simulasi_balcon_body"));?>
			</div>
		</div>
	</div>
  </fieldset>
 </div>
  
</body>
</html>
 
 
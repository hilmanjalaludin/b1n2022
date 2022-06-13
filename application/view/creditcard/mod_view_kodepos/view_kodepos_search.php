<!DOCTYPE html>
<html>
<head>
 <meta charset="UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
 <title><?php echo title_header(sprintf("Search %s", 'Zip Kode'));?></title>
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
		width:48% !important;
		margin-top:-2px !important;
		height : 26px !important;
	}
	input.u-max-length{ 
		width : 95% !important;
	}
	select.u-max-length{ 
		width : 99% !important;
	}
	div.right{  padding-right:4px !important; }
	fieldset.ui-panel-group-header{
		padding :5px !important;
		margin: 8px !important;
	}
	
	fieldset.ui-panel-group-content{
		padding :5px 5px 5px 10px !important;
		margin: 8px !important;
	}
	
	div.ui-panel-body{
		margin-top:4px !important;
	}
 </style>
 
 <!-- local javascript data -->
 <!-- local javascript data -->
 
 <script type="text/javascript">		
/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
 
 window.EventKodeSearch = function( Pager ){
// get all proces serialize data
	var frmKodepos = Ext.Serialize('frmKodepos');
	
   var dataURL  = Ext.EventUrl( new Array('KodePos', 'Pager')); 
    $('#ui-panel-body-kodepos').Spiner
   ({
		url    : dataURL.Apply(),
		method : 'POST',
		order   : {
			order_type : Pager.type,
			order_by   : Pager.orderby,
			order_page : Pager.page	
		}, 
		param    : frmKodepos.Data(),
		handler  : 'EventKodeSearch',
		complete : function( html ){
			$(html).css({'height' : '100%'})
		}
	});
 }
/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	  
window.EventClearData = function(){
	Ext.Serialize('frmKodepos').Clear();
	window.EventKodeSearch({  orderby : '',   type : '',  page : 0 });
}
/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	 
window.EventSearchData = function(){
	window.EventKodeSearch({  orderby : '',   type : '',  page : 0 });
} 

/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	 
 
 $(document).ready(function(){
	window.EventKodeSearch({  orderby : '',   type : '',  page : 0 });
	console.log(window.name);
});
 
</script> 
</head> 

<body> 

 <div class="page-wraper"> 
 <!--<fieldset class="corner">
 
	<?php echo form()->legend(lang("Search"), "fa-search"); ?>-->
	
	<div class="ui-widget-form-table ui-panel-page" style="margin-left:-1px;width:99%;">
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell" style="vertical-align:top;">
				<?php $this->load->view("mod_view_kodepos/view_kodepos_header");?> 
			</div>	
		</div>
			
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell">
				<?php $this->load->view("mod_view_kodepos/view_kodepos_body");?>  
			</div>
		</div>
	</div>
  <!--</fieldset>-->
  
 </div>
  
</body>
</html>
 
 
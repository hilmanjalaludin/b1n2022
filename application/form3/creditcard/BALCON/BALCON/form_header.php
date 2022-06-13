<!DOCTYPE html>
<html>
 <head>
 <meta charset="UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
 <title><?php echo title_header("Detail Penawaran");?></title>
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
 <?php 
 
 /**
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 
 $this->load->form("UI/styleform.php"); 
 $this->load->form("UI/BALCONDANA_JS.php"); 
 
 ?>
 
 <style>
 .paperworktitle{ padding:4px !important;}
 
 .paperworktable td { 
	padding:2px 2px 2px 4px !important ;}
 
 .paperworktable td.ui-data-cell-1{ 
	padding:4px 2px 4px 8px !important ;}
  
 .paperworktable td.ui-data-cell-3{
	width:15% !important;	
	padding: 5px 4px 6px 4px !important; 
 } 
 .paperworktable td.ui-data-cell-4{
	width:10% !important;	
	padding: 5px 4px 6px 4px !important; 
 }
 
  .paperworktable td.ui-data-cell-5{
	width:60% !important;	
	padding: 5px 4px 6px 4px !important; 
 }
 
 .paperworktable input[type="text"]{
	height:18px !important;	
}
 .paperworktable td.header-cell-1{
	white-space:normal !Important;	
}

 
 .paperworktable input[type="text"].ui-normal{
	 padding:1px 1px 1px 3px !important;
	width:95% !important;
	margin:2px;
}
 .paperworktable input[type="text"].ui-unormal{
	width:85% !important;
	padding:1px 1px 1px 3px !important;
	margin:2px;
}
.paperworktable select{
	width:97% !important;
	height:22px !important;	
	margin:2px;
}
.paperworktable .btn{
	width:90px !important;
}
.paperworktable .button1 {
	margin-right:5px;
}
.paperworktable .button2 {
	margin-left:5px;
}
.paperworktable .button3 {
	margin-left:5px;
	width:50px !important;
}
.paperworktable select.ui-select-data{
	width:88% !important;
}


.paperworktable td.header-cell-1,
.paperworktable td.header-cell-2,
.paperworktable td.header-cell-3,
.paperworktable td.header-cell-4{ 
	text-align:center !important;
}

 td.ui-data-center{
	padding : 5px 5px 0px 5px !important; 
	vertical-align:middle !important;
	text-align:center !important;
} 
.label-bold{
	font-weight:bold !important;
	background: #ffffff none repeat scroll 0% 0% !important;
	 
}
.ui-text-autolong{
	width:90px !Important;
}

td.ui-data-lasted{
	padding: 4px 4px 6px 4px !important; 
}
 
 .button4{
	 margin:0px 0px 4px 0px !important;
	}
 

 </style>	
 
 </head>
 <body> 
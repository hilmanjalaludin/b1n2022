<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo lang(array('Change & Relese'));?></title>

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
<meta http-equiv="X-UA-Compatible" content="IE=9,IE=10,chrome=1">

<link type="text/css" rel="shortcut icon" href="<?php echo base_image_layout();?>/favicon.png?version=<?php echo version();?>&amp;time=<?php echo time();?>">
<style type="text/css">

::selection{ background-color: #E13300; color: white; }
::moz-selection{ background-color: #E13300; color: white; }
::webkit-selection{ background-color: #E13300; color: white; }

body {
	background-color: #fff;
	margin: 40px;
	font: 13px/20px normal Helvetica, Arial, sans-serif;
	color: #4F5155;
}

a {
	color: #003399;
	background-color: transparent;
	font-weight: normal;
}

h1 {
	color: #444;
	background-color: transparent;
	border-bottom: 1px solid #D0D0D0;
	font-size: 19px;
	font-weight: normal;
	margin: 0 0 14px 0;
	padding: 14px 15px 10px 15px;
}

code {
	font-family: Consolas, Monaco, Courier New, Courier, monospace;
	font-size: 12px;
	background-color: #f9f9f9;
	border: 1px solid #D0D0D0;
	color: #002166;
	display: block;
	margin: 0px 0 14px 0;
	padding: 0px 10px 12px 10px;
	border-radius:3px;
}

#container {
	margin: 10px;
	border: 1px solid #D0D0D0;
	padding : 8px;
	-webkit-box-shadow: 0 0 8px #D0D0D0;
}
.content-error {
	margin: 10px;
	padding : 8px;
	font-family:Consolas;
	line-height : 26px;
	-webkit-box-shadow: 0 0 8px #D0D0D0;
}

p {
	margin: 2px 15px 2px 15px;
	line-height:12px;
}
br{
 margin-top:-10px;	
 line-height:0;	
}
</style>
</head>
<body>
	<div id="container">
		<h1> <?php echo $error_page['release']; ?> :: <?php echo description(); ?></h1>
		<p class="content-error"> <?php echo nl2br($error_page['version']); ?></p>
	</div>
</body>
</html>
<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title><?php echo title_header( sprintf("Product Script / %s / %s", CK()->field('Username','strtoupper'), $Data->field('Description')));?></title>
<meta name="viewport" content="width=device-width" />
<script type="text/javascript" src="<?php echo base_spl_cores();?>/jquery-2.1.3.js?time=<?php echo time();?>"></script>
<script type="text/javascript" src="<?php echo base_ext_cores();?>/EUI.1.3.15.js?version=<?php echo date('Ymd');?>&amp;time=<?php echo time();?>"></script> 
<script>

/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
 $(document).ready(function() {
	$('#frame').attr('width', $(window).innerWidth());
	$('#frame').attr('height',$(window).innerHeight());	
 });
 /*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
 
 $(window).bind("resize", function(){
	$('#frame').attr('width', $(window).innerWidth());
	$('#frame').attr('height',$(window).innerHeight());	
 });
 /*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
</script>


</head>
<body style="margin:0px;" oncontextmenu="return false;">
<?php 
$pathUrlData = sprintf('%s/application/script/%s', rtrim(BASEPATH, '/system'), $Data->field('ScriptFileName'));
if( !file_exists( $pathUrlData ) ){
	exit('file data not exist');
}
// set an url data 
$dataUrlPath = sprintf("%s/application/script/%s", rtrim( base_url(), '/'), $Data->field('ScriptFileName'));
?>
 <div style="margin:-8">
	<embed id="frame" src="<?php printf('%s', $dataUrlPath);?>"></embed>
 </div>	
</body>
</html>
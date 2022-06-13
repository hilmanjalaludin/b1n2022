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
	
	<link type="text/css" rel="stylesheet" href="<?php echo base_layout_style();?>/styles.plugin.css?version=<?php echo version();?>&amp;time=<?php echo time();?>"/>
	<link type="text/css" rel="stylesheet" href="<?php echo base_themes_style();?>/ui.all.css?time=<?php echo time();?>" />
	<link type="text/css" rel="stylesheet" href="<?php echo base_fonts_style();?>/font-awesome.min.css?time=<?php echo time();?>" />
	<link type="text/css" rel="stylesheet" href="<?php echo base_layout_style();?>/styles.overwriter.css?time=<?php echo time();?>" />
	<link type="text/css" rel="shortcut icon"  href="<?php echo base_image_layout();?>/favicon.png?version=<?php echo version();?>&amp;time=<?php echo time();?>">
	
	<script type="text/javascript" src="<?php echo base_spl_cores(); ?>/jquery-1.4.4.js?version=<?php echo version();?>&amp;time=<?php echo time();?>"></script>
	<script type="text/javascript" src="<?php echo base_spl_loader();?>?version=<?php echo version();?>&amp;time=<?php echo time();?>"></script>
	<script type="text/javascript" src="<?php echo base_ext_cores(); ?>/EUI.1.3.15.js?version=<?php echo version();?>&amp;time=<?php echo time();?>"></script>
	<script type="text/javascript" src="<?php echo base_ext_cores(); ?>/EUI.Loader.1.3.15.js?version=<?php echo version();?>&amp;time=<?php echo time();?>"></script> 
	<script type="text/javascript" src="<?php echo base_ext_other();?>?version=<?php echo version();?>&amp;time=<?php echo time();?>"></script> 
	
<!-- local script : 2015 -->
 <script>
var data = {};  
 window.PlayObjectData = function( url ){
	 
	 //on url data process 
	 var urlDataServerIndex = url.getValue(),
		 urlDataPlayerObject = Ext.Media( 'ui-play-user-voice', { 
			url 	: urlDataServerIndex,
			width 	: '98%',
			height 	: '120px',
				options : {
					ShowControls  : 'true',
					ShowStatusBar : 'true',
					ShowDisplay   : 'true',
					autoplay 	  : 'true'
				}
		});
		
	// cek apakah browser yang digunakan versi IE 
	// atau bukan.
	
		var BrowserExplorer = ( Ext.Browser().getName() == 'Microsoft Internet Explorer' );
		if( BrowserExplorer ){ 
			urlDataPlayerObject.WAVPlayer();
		} else { 
			urlDataPlayerObject.WAVPlayer(); 
		}
	//compile process data an HTML wraper 	
		Ext.Tpl( "ui-play-user-voice", {} ).Compile();
		$('.ui-label-text').css({
			'padding' : '3px 2px 3px 2px'
		});
 }
 
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
 $(document).ready(function() {
	window.window.PlayObjectData( Ext.Cmp('QR_Voice_Url') );
	// notallowed $('.notallowed') 
	$('.notallowed').each(function(key,item){
		Ext.Cmp(item).disabled(1);
	});
	
	//$('.select').chosen();
 });		
 
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
 //frmVlsVerification
 
window.EventSubmit =function(){
	
	var urlDataServer = Ext.EventUrl( new Array('QualityApproveInterest','SubmitRate') );	
	 Ext.Serialize('frmVlsVerification').Submit
	({
		procedure :{ 
			arg: 'Required', val : [	
				 'QR_Voice_RatingNum', 
				 'QR_Voice_CreateNotes'
			] 
		},
		callback 	: {
			url 	: urlDataServer.Apply(), 
			method  : 'POST',
			success : function( xhr ) {
				Ext.Util(xhr).proc(function( data ){
					if( data.success == 1 ){
						Ext.Msg("Save Voice Rate").Success();
						return false;
					} else {
						Ext.Msg("Save Voice Rate").Failed();
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
  
window.EventClose  =  function(){
	var callBackMsg = Ext.Msg('Do you want to close this session ?').Confirm();
	if( !callBackMsg ){
		return false;
	}
	window.close(this);
}

</script>
 
<style type="text/css">
.paperwork {
	float:center;
	margin-top:8px;
	width:99%;
}
.paperworktable {
	width:98%;
	border-collapse: collapse;
	table-layout:fixed;
	margin-left:8px;
	margin-right:8px;
	margin-bottom:10px;
}
.paperworktable input[type="text"] {
	width:95%;
	margin:2px;
}
.paperworktable input[type="radio"] {
	width:10%;
	display: inline-block;
	vertical-align: top;
}
.paperworktable input[type="radio"] {
	width:10%;
	display: inline-block;
	vertical-align: top;
}
.paperwork .smallinput input[type="text"] {
	width:15%;
}
.paperworknote {
	font-size: 10px;
	font-style: italic;
	color:#b6babf;
}
.paperworktable tr td {
	padding:3px;
	border:1px solid #aed0ea;
	width:25%;
	font-weight: bold;
}
.wraplable {
	width:98%;
}
.paperworktitle {
	background:#aed0ea;
	font-size: 16px;
	font-weight: bold;
	padding:8px;
	color:white;
	width: 94%;
	margin:auto;
	border-top-left-radius: 5px;
	border-top-right-radius: 5px;
}
.ui-play-user-voice{
	display:table;
	 float:center;
	margin-left:10px; 
	width:99%;
}
.overlaping{
	width:95% !important;
}
.select-cst{
	width:95% !important;
}
</style> 
</head>
<body>

<div class="paperwork">
<form name="frmVlsVerification">
  <?php echo form()->hidden('QR_Voice_Url', null, $row->field('file_url_data')); ?>
  <?php echo form()->hidden('QR_Voice_CustId', null, $row->field('DM_Id')); ?>
  <?php echo form()->hidden('QR_Voice_CustNum',null, $row->field('DM_Custno'));?>
  <?php echo form()->hidden('QR_Voice_Record',null, $row->field('id'));?>
  <?php echo form()->hidden('QR_Voice_PathName',null, $row->field('file_voc_loc'));?>
  
   <div class="wraplable">	
		<div class="paperworktitle">Voice File</div>
		<table class="paperworktable">
			<tr>	
				<td style="padding:10px 5px 10px 5px;" align ="center">
				<div id="ui-play-user-voice" class="ui-play-user-voice"></div>
				</td>
			</tr>
		</table>
	</div>
	
	<div class="wraplable" style="margin-top:10px;">		
		<table class="paperworktable">
			<tr>
				<td style="padding:2px 5px 2px 20px;"><?php echo lang('VLS_Call_Number');?></td>
				<td><?php echo form()->input('QR_Voice_FileName', 'input_text tolong notallowed', $row->field('anumber') );?> </td>
			</tr>	
			
			<tr>
				<td style="padding:2px 2px 2px 20px;"><?php echo lang('VLS_Start_Time');?></td>
				<td><?php echo form()->input('VLS_Start_Time', 'input_text tolong notallowed', $row->field('start_time','SetDateTime') );?></td>
			</tr>
			
			<tr>
				<td style="padding:2px 5px 2px 20px;"><?php echo lang('VLS_Duration_Time');?></td>
				<td><?php echo form()->input('VLS_Duration_Time', 'input_text tolong notallowed', $row->field('duration','SetDuration') );?> </td>
			</tr>
			
			<tr>
				<td style="padding:2px 5px 2px 20px;"><?php echo lang('VLS_File_Name');?></td>
				<td><?php echo form()->input('QR_Voice_FileName', 'input_text tolong notallowed', $row->field('file_voc_name','_setMaskingRecording') );?> </td>
			</tr>	
			
			<tr>
				<td style="padding:2px 5px 2px 20px;"><?php echo lang('VLS_Voice_Size');?></td>
				<td><?php echo form()->input('VLS_File_Size', 'input_text tolong notallowed', $row->field('file_voc_size','SetFormatSize') );?></td>
			</tr>
		</table>	
	</div>
	
	<div class="wraplable" style="margin-top:30px;">		
		<div class="paperworktitle">Voice Rate</div>
		<table class="paperworktable">
			<tr>
				<td style="padding:2px 5px 2px 20px;">Rate</td>
				<td><?php echo form()->combo('QR_Voice_RatingNum', 'select tolong select-cst', QualityRate(), $row->field('QR_Voice_RatingNum') );?> </td>
			</tr>
			
			<tr>
				<td style="padding:2px 5px 2px 20px;">Note</td>
				<td><?php echo form()->textarea('QR_Voice_CreateNotes', 'textarea tolong overlaping', $row->field('QR_Voice_CreateNotes') );?></td>
			</tr>	
		</table>	
	</div>
	</form>
	<!-- button data process jika ada play options -->
	
	<div class="wraplable" style="margin-top:0px;margin-bottom:20px">
		<div class="ui-widget-form-table" style="margin-right:18px;float:right !important;">
			<div class="ui-widget-form-row">
				
				<?php  if( $btn->find_value('_PLAY_TOOL_') 
						and CK()->cookie(array( USER_ROOT, USER_MANAGER, USER_ACCOUNT_MANAGER, USER_ADMIN, USER_QUALITY_STAFF, USER_QUALITY_HEAD ) ) )  : ?>
				<div class="ui-widget-form-cell">
					<button class="btn btn-default btn-sm" 
							id="button-submit" 
							onclick="window.EventSubmit();" 
							style="margin-left:10px;width:70px;"><i class="fa fa-save">&nbsp;&nbsp;</i>Save</button>
				</div>
				<?php endif; ?>
				
				<div class="ui-widget-form-cell">
					<button class="btn btn-default btn-sm" 
							id="button-reset" 
							onclick="window.EventClose();" 	
							style="margin-left:10px;width:70px;"><i class="fa fa-close">&nbsp;&nbsp;</i>Cancel</button>
				</div>
			</div>
		</div>	
	</div>	
	
	<!-- button data process jika ada play options -->
	
</div>
	
</body>
</html>
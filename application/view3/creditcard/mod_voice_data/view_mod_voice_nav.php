<?php 
echo javascript(array( 
	array('_file' => base_spl_plugin() .'/extToolbars.js', 'eui_'=> version(), 'time'=>time()),
	array('_file' => base_spl_plugin() .'/Paging.js', 'eui_'=> version(), 'time'=>time()),
	array('_file' => base_ext_helper() .'/EUI.Media.js', 'eui_'=> version(), 'time'=>time())
));

?>

<script type="text/javascript">


Ext.document('document').ready( function(){
	Ext.Cmp('ui-widget-title').setText( Ext.System.view_file_name());
 }); 
 
/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
var Role = new Ext.Role("Recording");
	Role.extend([
		{ title: " ", icon :"", event: "", key :'CC_RecId' } // if you have other extends event 
	]);
  
/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
Ext.DOM.datas = {
	VLS1_filter_field	: "<?php printf('%s', get_cokie_exist('VLS1_filter_field'));	?>",
	VLS1_filter_value	: "<?php printf('%s', get_cokie_exist('VLS1_filter_value'));	?>",
	VLS2_filter_field	: "<?php printf('%s', get_cokie_exist('VLS2_filter_field'));	?>",
	VLS2_filter_value	: "<?php printf('%s', get_cokie_exist('VLS2_filter_value'));	?>",
	VLS_Data_start_date : "<?php printf('%s', get_cokie_exist('VLS_Data_start_date'));	?>",
	VLS_Data_end_date	: "<?php printf('%s', get_cokie_exist('VLS_Data_end_date'));	?>",
	VLS_Duration_Start	: "<?php printf('%s', get_cokie_exist('VLS_Duration_Start'));	?>",
	MSD_call_category	: "<?php printf('%s', get_cokie_exist('MSD_call_category'));	?>",
	VLS_Duration_End	: "<?php printf('%s', get_cokie_exist('VLS_Duration_End'));		?>",
	order_by 			: '<?php printf('%s', get_cokie_exist('order_by'));				?>',
	type	 			: '<?php printf('%s', get_cokie_exist('type'));					?>'
}

/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
$(function(){
 $('#toolbars').extToolbars
({
	extUrl    : Role.image(),  
	extTitle  : Role.title(),
	extMenu   : Role.event(), 
	extIcon   : Role.icon(), 
	extText   : true,
	extInput  : true,
	extOption : [{
			render  : Role.last(), 
			type	: 'label',
			label	: 'secara default data yang di tampilkan hanya per hari ini.',
			id		: 'load_images_id',
			name	: 'load_images_id'		
		}]
	});
	
	 $('.date').datepicker ({ showOn: 'button',  changeYear:true, changeMonth:true, buttonImage: Ext.Image("calendar.gif"),  buttonImageOnly: true,  dateFormat:'dd-mm-yy', readonly:true });
	 $('.select').chosen();
	 $('.date').css("width", "75px");
	 $('.customize-text').css("width", "75px");
	
	 
});

/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
Ext.EQuery.TotalPage   = '<?php echo (int)$page -> _get_total_page(); ?>';
Ext.EQuery.TotalRecord = '<?php echo (int)$page -> _get_total_record(); ?>';

/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  

Ext.DOM.navigation =  {
	custnav	 : Role.pageIndex(),
	custlist : Role.pageContent()
}
/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
Ext.EQuery.construct(Ext.DOM.navigation,Ext.DOM.datas)
Ext.EQuery.postContentList();
/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
window.EventSearch = function()
{	

	$('#load_images_id').html( '... progress ...' );
var frmVoiceSearch = Ext.Serialize('frmVoiceSearch'); 
	//window.conditionPager = true;
	Ext.EQuery.construct(Ext.DOM.navigation, frmVoiceSearch.Data() );
	Ext.EQuery.postContent();
}

/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 window.EventClear = function() {
	Ext.Serialize('frmVoiceSearch').Clear();
	window.EventSearch();	
}

/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 window.EventPlay = function()
{
	
  var dataURL  = new Ext.EventUrl(new Array("QualityApproveInterest",  "VoicePlay"));
  var RecordId = Role.getValue();
  
// jika RecordId kosong 	
 if( RecordId == ''){
	Ext.Msg('Please select a row data ').Info();
	return false;
 }	
	
// open window popup on action by user to play 
// recording voice on 'GRID'	
	 Ext.Window 
	({
		url    : dataURL.Apply(),
		name   : 'winplay',
		top    : 0,
		left   : $(window).width(),  
		width  : ($(window).width()/2),
		height : ($(window).innerHeight()-25),
		param  :  {
			RecordId : RecordId,
			ControllerId : Role.ctrl()
		} 
	}).popup();
}
/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 
 window.EventDownload = function() 
{
  
  var RecordId = Role.getValue();
// jika RecordId kosong 	
 if( RecordId == ''){
	Ext.Msg('Please select a row data ').Info();
	return false;
 }	
	
// will process to data WAV file type if OK 
// convert by SOX MIX then will get and download file.
// like this.
	
    Ext.Ajax 
   ({
	 url 	 : Role.action('Process'),
	 method  : 'GET',
	 param 	 : { 
				RecordId : RecordId 
			},
	 success : function( xhr )  {
		// set UTILS : process on helper JS data "JSON"
		Ext.Util( xhr ).proc(function( conSeverHeader ) {
			if( conSeverHeader.success )  {
				console.log(conSeverHeader.data);
				var dataEncryptionHeaders = Ext.BASE64.encode( conSeverHeader.data.path_destination_tmp);
				// alert(dataEncryptionHeaders);
				if( !dataEncryptionHeaders ){
				   return false;
				}
			// constant then will extract data to process on here  OK .
				Ext.Window 
				({
					url 	: Role.action('Download'), 
					width 	: 100, 
					height	: 100,
					param 	: {
						path : dataEncryptionHeaders
					}
				}).newtab();
			} 
			// file tidak ada pada saat download lupkan saja ya 
			else {
				Ext.Msg('File Not found to download!').Info();
				return false;
			}
		});
	}
 }).post();
}


</script> 
<fieldset class="corner">
<?php echo form()->legend(lang(""), "fa-microphone-slash"); ?> 
 <div id="result_content_add" class="ui-widget-panel-form" style="margin-top:-8px;"> 
	<form name="frmVoiceSearch">
		<div class="ui-widget-form-table-compact">
			<div class="ui-widget-form-row baris-1">
				
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('LB_Global_SearchBy'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell text_caption left"> <?php echo form()->field("VLS1", "input_text middle", "Recording", null);?></div>
				
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('CC_DateTime'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell left"> <?php echo form()->interval('VLS_Data','input_text date', 'VLS_Data'); ?></div>

				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('DM_CallCategoryKode'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell text_caption left"><?php echo form()->combo('MSD_call_category','select tolong', AllCallStatus(), _get_exist_session('MSD_call_category'));?></div>
				
				
			</div>
			
			<div class="ui-widget-form-row baris-2">
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('LB_Global_SearchBy'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell text_caption left"> <?php echo form()->field("VLS2", "input_text middle", "Recording", null);?></div>
				
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('CC_Duration'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell left">
					<?php echo form()->input('VLS_Duration_Start','input_text box customize-text',_get_exist_session('VLS_Duration_Start')); ?> <?php echo lang(array('&nbsp;&nbsp;&nbsp;to&nbsp;'))?>
					<?php echo form()->input('VLS_Duration_End','input_text box customize-text',_get_exist_session('VLS_Duration_End')); ?> 
				</div>
			</div>
		</div>
	</form>
 </div>

<div class="ui-widget-toolbars" id="toolbars"></div>
<div class="ui-widget-panel-content" id="#panel-content"></div>
<div class="content_table" id="ui-widget-content_table"></div>
<div class="ui-widget-pager" id="pager"></div>
<div class="ui-widget-component" id="ui-widget-component"></div>

</fieldset>	
<?php echo javascript(); ?>
<script type="text/javascript">

 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
    
 
$(function(){ 
	Ext.Cmp('ui-widget-title').setText( Ext.System.view_file_name());
});

// http://<index>ModUploadDetail
/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */

var Role = new Ext.Role("ModUploadDetail");
	Role.extend([
		{ title: " ", icon :"", event: "", key :'UPL_UploadId' } // if you have other extends event 
	]);
  

 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
    
Ext.DOM.datas =  {	
	USD1_filter_field : "<?php printf('%s', get_cokie_exist('USD1_filter_field')); ?>",
	USD1_filter_value : "<?php printf('%s', get_cokie_exist('USD1_filter_value')); ?>",
	USD2_filter_field : "<?php printf('%s', get_cokie_exist('USD2_filter_field')); ?>",
	USD2_filter_value : "<?php printf('%s', get_cokie_exist('USD2_filter_value')); ?>",
	USD3_filter_field : "<?php printf('%s', get_cokie_exist('USD3_filter_field')); ?>",
	USD3_filter_value : "<?php printf('%s', get_cokie_exist('USD3_filter_value')); ?>",
	USD4_filter_field : "<?php printf('%s', get_cokie_exist('USD4_filter_field')); ?>",
	USD4_filter_value : "<?php printf('%s', get_cokie_exist('USD4_filter_value')); ?>",
	order_by 		  : "<?php printf('%s', get_cokie_exist('order_by')); ?>",
	type	 		  : "<?php printf('%s', get_cokie_exist('type')); ?>"
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
			label	: '',
			id		: 'load_images_id',
			name	: 'load_images_id'		
		}]
	});
	
	 $('.date').datepicker ({ showOn: 'button',  
			changeYear:true, changeMonth:true, 
			buttonImage: Ext.Image("calendar.gif"),  
			buttonImageOnly: true,  
			dateFormat:'dd-mm-yy', readonly:true });
	 $('.select').chosen();
	 $('.date').css("width", "75px");
	
	 
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
 var frmFilterBy = Ext.Serialize("frmDataUpload");
 frmFilterBy.Debuger();
	//console.log();
	Ext.EQuery.construct( navigation, Ext.Join([  
		frmFilterBy.Data() 
	]).object() );
	Ext.EQuery.postContent();
}
//-----------------------------------------------------------------------

/*
 * modul  		 	Uplaod Template
 *
 * @akses 			public & of run window  
 * @author 			uknown 
 */
 window.EventClear = function() {
	Ext.Serialize('frmDataUpload').Clear();
	window.EventSearch();
}
 
/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */  
  
window.EventDelete= function(){
 
var UPL_UploadId = Role.getValue();
 if( UPL_UploadId =='' ){
	Ext.Msg('Please select a row ').Info();
	return false;
}

var callNote = window.sprintf(
		"This Process will delete all data\n"+
		"==============================\n"+
		" * Customer Master\t\t\t\t\t\n"+
		" * Customer History\t\t\t\t\t\n"+
		" * Customer Verifikasi\t\t\t\t\n"+
		" * Customer Assignment\t\t\t\t\n"+
		" * Customer Selling, etc\t\t\t\t\n"+
		"==============================\n"+
		"\n"+
		"Are you sure ... ?");
		
var callMsg = Ext.Msg(callNote).Confirm();
if( !callMsg ){
	return false;
}
	
 $.blockUI({css:{border:'none', padding:'15px',  backgroundColor:'#000','-webkit-border-radius':'10px', '-moz-border-radius':'10px',  opacity:.8, color:'#fff'} });
 
// ================== START POST DELETE ================================
   Ext.Ajax
 ({
	url 	: Role.action('Delete'), 
	method 	: 'POST',
	param 	: {
		UPL_UploadId : UPL_UploadId
	},
	success : function( xhr ){
		Ext.Util( xhr ).proc(function( data ){
			if( data.success ) {
				$.unblockUI({ fadeOut: 50 }); 
				Ext.Msg("Delete rows").Success();
				Ext.EQuery.postContent();
			}
			else{
				$.unblockUI({ fadeOut: 50 });
				Ext.Msg("Delete rows").Failed();
			}
			
		//	$.unblockUI({ fadeOut: 50 }); 
		});
	}
  }).post();	
 // ================== END POST DELETE ================================
	
}

/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */  
 
 window.EventAktivasi = function( data )  
{
	 Ext.Ajax 
   ({
		url 	: Role.action('Aktivasi'), 
		method 	: 'POST',
		param 	: {
			UPL_UploadId : data.UPL_UploadId,
			UPL_Flags : data.UPL_Flags
		},
		success : function( xhr ){
			Ext.Util( xhr ).proc(function( data ){
				if( data.success ) {
					Ext.Msg("Aktivasi rows").Success();
					Ext.EQuery.postContent();
				}
				else{
					$.unblockUI({ fadeOut: 50 });
					Ext.Msg("Aktivasi rows").Failed();
				}
			});
		}
  }).post();	
}
/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */  
 
window.EventDisable = function(){
	
// get data process on here like this .	
 var UPL_UploadId = Role.getValue().toString();
 if( UPL_UploadId =='' ){
	Ext.Msg('Please select a row ').Info();
	return false;
 }
// enable data process .	
  window.EventAktivasi({ UPL_UploadId : UPL_UploadId,  UPL_Flags : 0  });

} 

/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */  
 
window.EventEnable = function(){
	
// get data process on here like this .	
 var UPL_UploadId = Role.getValue().toString();
 if( UPL_UploadId =='' ){
	Ext.Msg('Please select a row ').Info();
	return false;
 }
// enable data process .	
  window.EventAktivasi({ UPL_UploadId : UPL_UploadId,  UPL_Flags : 1  });

} 


/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */  		
window.EventDownload = function() {
	var UPL_UploadId = Role.getValue();
	if( UPL_UploadId == ''){
		return false;
	}	
	
// new event Ext.Window 
var dataURL = Ext.EventUrl( new Array('ModUploadDetail/Download') ); 
	Ext.Window ({ 
		url 	: dataURL.Apply(),
		param 	: {
			UPL_UploadId : UPL_UploadId
		}
	}).newtab();

}

window.EventDownloadList = function() {
	var frmFilterBy = Ext.Serialize("frmDataUpload");
	frmFilterBy.Debuger();
	//console.log();
	var dataURL = Ext.EventUrl( new Array('ModUploadDetail/DownloadList') ); 
	Ext.Window ({ 
		url 	: dataURL.Apply(),
		param 	: 
			Ext.Join([frmFilterBy.Data()]).object()
	}).newtab();
}

/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */ 	
// --------------------------------------------------------
var CheckDuplicateData = function()
	{
		var ChecklistId = doJava.checkedValue('ftp_upload_id');
		if( ChecklistId !='')
		{
			doJava.File = '../class/class.ftpupload.info.php';
			doJava.Params ={
				action:'check_duplicate',
				Ftp_upload_id : ChecklistId
			}
			window.open(doJava.File+'?'+doJava.ArrVal())
		}
	}	
// --------------------------------------------------------
		
</script>
<fieldset class="corner">
<?php echo form()->legend(lang(""), "fa-upload"); ?>
<div id="result_content_add" class="ui-widget-panel-form"> 
 <form name="frmDataUpload">
	<div class="ui-widget-form-table-compact">
		<div class="ui-widget-form-row baris-1">
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('LB_Global_SearchBy'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell text_caption left"> <?php echo form()->field("USD1", "input_text middle", "DetailUpload", null);?></div>
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('LB_Global_SearchBy'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell text_caption left"> <?php echo form()->field("USD3", "input_text middle", "DetailUpload", null);?></div>
			
		</div>
		
		<div class="ui-widget-form-row baris-2">
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('LB_Global_SearchBy'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell text_caption left"> <?php echo form()->field("USD2", "input_text middle", "DetailUpload", null);?></div>
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('LB_Global_SearchBy'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell text_caption left"> <?php echo form()->field("USD4", "input_text middle", "DetailUpload", null);?></div>
			
		</div>
		
	</div>
	</form>
</div>	
	
<div class="ui-widget-toolbars" id="toolbars"></div>
<div class="content_table" id="ui-widget-content_table"></div>
<div class="ui-widget-pager" id="pager"></div> 
</fieldset>	
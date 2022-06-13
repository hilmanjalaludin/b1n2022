<?php echo javascript(); ?>
	
<script type="text/javascript">
//-----------------------------------------------------------------------

/*
 * modul  		 	Uplaod Template
 *
 * @akses 			public & of run window  
 * @author 			uknown 
 */
 
Ext.DOM.onload = (function(){
	Ext.Cmp('ui-widget-title').setText( Ext.System.view_file_name());
})();
 
//-----------------------------------------------------------------------

/*
 * modul  		 	method get User Role 
 *
 * @akses 			public & of run window  
 * @author 			uknown 
 */

var Role = new Ext.Role("MailInbox");
	Role.extend([
		{ title: " ", icon :"", event: "", key :'MailInboxId' } // if you have other extends event 
	]);
  
//-----------------------------------------------------------------------

/*
 * modul  		 	Uplaod Template
 *
 * @akses 			public & of run window  
 * @author 			uknown 
 */
 
Ext.DOM.datas = {
	book_class_code  : "<?php echo _get_post('book_class_code');?>",
	book_class_desc  : "<?php echo _get_post('book_class_desc');?>",
	book_class_flags : "<?php echo _get_post('book_class_flags');?>",
	end_create		 : "<?php echo _get_post('end_create');?>",
	start_create 	 : "<?php echo _get_post('start_create');?>",
	order_by 		 : "<?php echo _get_post('order_by');?>",
	type			 : "<?php echo _get_post('type');?>"
	
}

//-----------------------------------------------------------------------

/*
 * modul  		 	Uplaod Template
 *
 * @akses 			public & of run window  
 * @author 			uknown 
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
			label	: '..',
			id		: 'load_images_id',
			name	: 'load_images_id'		
		}]
	});
	
	 $('.date').datepicker
	 ({
		showOn: 'button', 
		buttonImage: Ext.Image("calendar.gif"), 
		buttonImageOnly: true, dateFormat:'dd-mm-yy',
		readonly:true
	 });
	 
	 $('.filter-ui-paket').chosen();
	 $('.filter-ui-status').chosen();
	 $('.filter-ui-spcl').chosen();
	 
});

//-----------------------------------------------------------------------

/*
 * modul  		 	Uplaod Template
 *
 * @akses 			public & of run window  
 * @author 			uknown 
 */
 
		
Ext.EQuery.TotalPage   = '<?php echo (INT)$page -> _get_total_page(); ?>';
Ext.EQuery.TotalRecord = '<?php echo (INT)$page -> _get_total_record(); ?>';

//-----------------------------------------------------------------------

/*
 * modul  		 	Uplaod Template
 *
 * @akses 			public & of run window  
 * @author 			uknown 
 */
 
Ext.DOM.navigation =  {
	custnav	 : Role.pageIndex(),
	custlist : Role.pageContent()
}
//-----------------------------------------------------------------------

/*
 * modul  		 	Uplaod Template
 *
 * @akses 			public & of run window  
 * @author 			uknown 
 */
 
 
Ext.EQuery.construct( Ext.DOM.navigation, Ext.DOM.datas )
Ext.EQuery.postContentList();


//-----------------------------------------------------------------------

/*
 * modul  		 	EventSearch
 *
 * @akses 			public & of run window  
 * @author 			uknown 
 */
 
 function EventSearch()
{
	Ext.Progress("load_images_id").start();
	var formListData = Ext.Serialize("FrmBookClassList").getElement();
	Ext.EQuery.construct( Ext.DOM.navigation, 
		Ext.Join([  formListData ]).object() );
	
	Ext.EQuery.postContent();
}

//-----------------------------------------------------------------------

/*
 * modul  		 	EventAdd
 *
 * @akses 			public & of run window  
 * @author 			uknown 
 */
 
 function EventClear() 
{
	Ext.Serialize("FrmBookClassList").Clear();	
	Ext.DOM.EventSearch();
}

//-----------------------------------------------------------------------

/*
 * modul  		 	EventAdd
 *
 * @akses 			public & of run window  
 * @author 			uknown 
 */
 
 function EventAdd()
{
	Ext.Ajax 
	({
		url 	 : Role.action("Add"),
		method  : "POST",
		param   : {
			time : Ext.Date().getDuration()
		}
	}).load("main_content");
 
}
//-----------------------------------------------------------------------

/*
 * modul  		 	EventAdd
 *
 * @akses 			public & of run window  
 * @author 			uknown 
 */
 
 
 function EventNewEmail()
{
	Ext.ShowMenu( new Array('MailCompose','index'), 
		Ext.System.view_file_name(), {
		EventRoleback : 'MailInbox'
	}); 
}

//-----------------------------------------------------------------------

/*
 * modul  		 	EventEdit
 *
 * @akses 			public & of run window  
 * @author 			uknown 
 */
 
 function EventEdit()
{
  var BookClassId = Role.getValue();  
  if( (BookClassId=='') || (BookClassId.length > 1) ){
	Ext.Msg("Please select a rows ").Info();
	return false;
  }
 

 if( BookClassId )
 {
	 Ext.Ajax
	({
		 url 	 : Role.action("Edit"),
		 method  : "POST",
		 param   : {
			BookClassId : BookClassId,
			time : Ext.Date().getDuration()
		 }
	}).load("main_content");
  }
}

 
//-----------------------------------------------------------------------

/*
 * modul  		 	EventDelete
 *
 * @akses 			public & of run window  
 * @author 			uknown 
 */
 
 function EventDelete() 
{
  var MailInboxId = Role.getValue();
  if( MailInboxId.length ==0 ) {
	Ext.Msg("Please select a rows").Info();
	return false; }
	 
   if( !Ext.Msg("Are you Sure?").Confirm() ){ 
	return false; }
	
  // --- on ajax handler -------------------------------
   Ext.Progress("load_images_id").start();
   Ext.Ajax
   ({
		url    : Role.action("Delete"),
		method : 'POST', 
		param  : {
			MailInboxId : MailInboxId
		},
		ERROR : function( fn )
		{
			Ext.Util(fn).proc( function( response ){
				Ext.Progress("load_images_id").stop();
				if( response.success ){
					Ext.Msg("Delete Mail Inbox").Success();
					Ext.Progress("load_images_id").start();
					Ext.EQuery.postContent();
				} else {
					Ext.Msg("Delete Mail Inbox").Failed();
				}
		    });
		}	
   }).post();
}
 
 
//-----------------------------------------------------------------------

/*
 * modul  		 	EventDelete
 *
 * @akses 			public & of run window  
 * @author 			uknown 
 */
 
 
 function EventOpenEmail() 
{
  var MailInboxId = Role.getValue();
  if( MailInboxId.length ==0 ) {
	Ext.Msg("Please select a rows").Info();
	return false; 
  }
  
  Ext.Window
 ({
		url 	: Role.action('Detail'),
		width 	: 675,
		height 	: 600,
		left 	: ($(window).width()/2),
		scrollbars: 1,
		top     : 0,
		param   :{
			MailInboxId : MailInboxId 
		}
	}).popup();
	
}
 
//-----------------------------------------------------------------------

/*
 * modul  		 	EventDelete
 *
 * @akses 			public & of run window  
 * @author 			uknown 
 */
 
 function EventDisable()
{
  var BookClassId = Role.getValue();
  
   if( BookClassId.length ==0 ) {
	 Ext.Msg("Please select a rows").Info();
	 return false; }
	 
   if( !Ext.Msg("Are you Sure?").Confirm() ){ 
	return false; }
	
  // --- on ajax handler -------------------------------
   Ext.Progress("load_images_id").start();
   Ext.Ajax
   ({
		url    : Role.action("Disable"),
		method : 'POST', 
		param  : {
			BookClassId : BookClassId
		},
		ERROR : function( fn )
		{
			Ext.Util(fn).proc( function( response ){
				Ext.Progress("load_images_id").stop();
				if( response.success ){
					Ext.Msg("Disable Booking Class").Success();
					Ext.Progress("load_images_id").start();
					Ext.EQuery.postContent();
				} else {
					Ext.Msg("Disable Booking Class").Failed();
				}
		    });
		}	
   }).post();
}
 
//-----------------------------------------------------------------------

/*
 * modul  		 	EventDelete
 *
 * @akses 			public & of run window  
 * @author 			uknown 
 */
 
 function EventReply()
{
  var MailInboxId = Role.getValue();
  if( MailInboxId.length ==0 ) {
	Ext.Msg("Please select a rows").Info();
	return false; 
  }
  
	Ext.Ajax
	({
		url 	: Ext.EventUrl(["MailCompose", "Reply"]).Apply(),
		method 	:'GET',
		param 	: {
			MailInboxId : MailInboxId
		}
	}).load("main_content");
 } 
//-----------------------------------------------------------------------

/*
 * modul  		 	EventDelete
 *
 * @akses 			public & of run window  
 * @author 			uknown 
 */
 
 function EventForward()
{
  var MailInboxId = Role.getValue();
  if( MailInboxId.length ==0 ) {
	Ext.Msg("Please select a rows").Info();
	return false; 
  }
  
	Ext.Ajax
	({
		url 	: Ext.EventUrl(["MailCompose", "Forward"]).Apply(),
		method 	:'GET',
		param 	: {
			MailInboxId : MailInboxId
		}
	}).load("main_content");
 }
  
//-----------------------------------------------------------------------

/*
 * modul  		 	EventDelete
 *
 * @akses 			public & of run window  
 * @author 			uknown 
 */
 
 function EventEnable()
{
  var BookClassId = Role.getValue();
  
   if( BookClassId.length ==0 ) {
	 Ext.Msg("Please select a rows").Info();
	 return false; }
	 
   if( !Ext.Msg("Are you Sure?").Confirm() ){ 
	return false; }
	
  // --- on ajax handler -------------------------------
   Ext.Progress("load_images_id").start();
   Ext.Ajax
   ({
		url    : Role.action("Enable"),
		method : 'POST', 
		param  : {
			BookClassId : BookClassId
		},
		ERROR : function( fn )
		{
			Ext.Util(fn).proc( function( response ){
				Ext.Progress("load_images_id").stop();
				if( response.success ){
					Ext.Msg("Enable Booking Class").Success();
					Ext.Progress("load_images_id").start();
					Ext.EQuery.postContent();
				} else {
					Ext.Msg("Enable Booking Class").Failed();
				}
		    });
		}	
   }).post();
}
  
</script>
<!-- start : content -->
<fieldset class="corner">
<?php echo form()->legend(lang(""), "fa-file-text-o"); ?>
<div id="result_content_add" class="ui-widget-panel-form" >
  <form name="FrmBookClassList">
  <div class="ui-widget-form-table-compact">
		<div class="ui-widget-form-row">
		
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array("Email","Address"));?></div>
			<div class="ui-widget-form-cell">:</div>
			<div class="ui-widget-form-cell"><?php echo form()-> combo('book_class_code','select filter-ui-paket superlong ', AllEmailAddress(), _get_exist_session('book_class_code'));?></div>
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Status");?></div>
			<div class="ui-widget-form-cell">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo('book_class_flags','select filter-ui-status superlong', array('1' => 'Read', '0' => 'Unread'), (string)_get_exist_session('book_class_flags'));?></div>
		
		</div>
		
		
		<div class="ui-widget-form-row">	
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Subject");?></div>
			<div class="ui-widget-form-cell">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->input('book_class_desc','input_text superlong', (string)_get_exist_session('book_class_desc'));?></div>
		
			<div class="ui-widget-form-cell text_caption"> <?php echo lang("Date Created");?></div>
			<div class="ui-widget-form-cell">:</div>
			<div class="ui-widget-form-cell">
				<?php echo form()->input('start_create','input_text date', _get_exist_session('start_create'));?>&nbsp;-	
				<?php echo form()->input('end_create','input_text date', _get_exist_session('end_create'));?>
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
		
	<!-- stop : content -->
	
	
	
<?php echo javascript(); ?>
<script type="text/javascript">
	
/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
   
Ext.document('document').ready( function(){
	Ext.Cmp('ui-widget-title').setText( Ext.System.view_file_name());
}); 
 	
/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
   
var Role = new Ext.Role("ModApprovePhone");
	Role.extend([
		{ title: " ", icon :"", event: "", key :'ApprovalHistoryId' } // if you have other extends event 
	]);
  
	
/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
   
 Ext.DOM.datas = 
{
	ADD1_filter_field			  : "<?php printf('%s', get_cokie_exist('ADD1_filter_field')); ?>",
	ADD1_filter_value			  : "<?php printf('%s', get_cokie_exist('ADD1_filter_value')); ?>",
	ADD2_filter_field			  : "<?php printf('%s', get_cokie_exist('ADD2_filter_field')); ?>",
	ADD2_filter_value			  : "<?php printf('%s', get_cokie_exist('ADD2_filter_value')); ?>",
	DM_ContactCreateTs_start_date : "<?php printf('%s', get_cokie_exist('DM_ContactCreateTs_start_date')); ?>",
	DM_ContactCreateTs_end_date	  : "<?php printf('%s', get_cokie_exist('DM_ContactCreateTs_end_date')); ?>",
	DM_ContactType				  : "<?php printf('%s', get_cokie_exist('DM_ContactType')); ?>",
	DM_ContactReqByUser			  : "<?php printf('%s', get_cokie_exist('DM_ContactReqByUser')); ?>",
	DM_ContactStatus			  : "<?php printf('%s', get_cokie_exist('DM_ContactStatus')); ?>",
	order_by					  : "<?php printf('%s', get_cokie_exist('order_by')); ?>",
	type						  : "<?php printf('%s', get_cokie_exist('type')); ?>"
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
	
	 $('.date').datepicker ({ showOn: 'button',  changeYear:true, changeMonth:true, buttonImage: Ext.Image("calendar.gif"),  buttonImageOnly: true,  dateFormat:'dd-mm-yy', readonly:true });
	 $('.select').chosen();
	 $('.date').css("width", "130px");
	
	 
});

	
/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
   
Ext.EQuery.TotalPage   = '<?php echo $page -> _get_total_page(); ?>';
Ext.EQuery.TotalRecord = '<?php echo $page -> _get_total_record(); ?>';
	
	
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
	$.cookie('selected', 0);
	var frmAprvPhoneList = Ext.Serialize('frmAprvPhoneList');
	frmAprvPhoneList.Debuger();
	Ext.EQuery.construct(navigation,
		Ext.Join( new Array(frmAprvPhoneList.Data()) ).object()
	);
	Ext.EQuery.postContent();
}
	
/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
   
 window.EventClear= function(){
	Ext.Serialize('frmAprvPhoneList').Clear();
	window.EventSearch(); 
 }
 
	
/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
   
 window.EventDetail = function( ApprovalHistoryId )  {
	Ext.ShowMenu(new Array('ModApprovePhone', 'ContactDetail'),
		Ext.System.view_file_name(),  {
		ApproveId : ApprovalHistoryId,
		ControllerId : 'ModApprovePhone'
	})
 }

</script>
	
<fieldset class="corner">
<?php echo form()->legend(lang(""), "fa-plus"); ?>
<div id="result_content_add" class="ui-widget-panel-form"> 
 <form name="frmAprvPhoneList">
	<div class="ui-widget-form-table-compact">
		<div class="ui-widget-form-row baris-1">
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('LB_Global_SearchBy'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell text_caption left"> <?php echo form()->field("ADD1", "input_text middle", "AdditionalContact", null);?></div>
			
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('DM_ContactType'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell left"><?php echo form() -> combo('DM_ContactType','select long', PhoneType(), _get_exist_session('DM_ContactType'));?></div>
		
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang('DM_ContactReqByUser');?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell left"><?php echo form() -> combo('DM_ContactReqByUser','select superlong', Call( AllUser(), 'SetCapital'), _get_exist_session('DM_ContactReqByUser'));?></div>
		</div>
		
		<div class="ui-widget-form-row baris-2">
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('LB_Global_SearchBy'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell text_caption left"> <?php echo form()->field("ADD2", "input_text middle", "AdditionalContact", null);?></div>
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('DM_ContactStatus'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell left"><?php echo form() -> combo('DM_ContactStatus','select long', AddContactStatus(), _get_exist_session('DM_ContactStatus'));?></div>
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('DM_ContactCreateTs'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell left"> <?php echo form()->interval('DM_ContactCreateTs','input_text date','DM_ContactCreateTs');?></div>
		</div>
	</div>
	</form>
</div>

<div class="ui-widget-toolbars" id="toolbars"></div>
<div class="ui-widget-panel-content" id="#panel-content"></div>
<div class="content_table" id="ui-widget-content_table"></div>
<div class="ui-widget-pager" id="pager"></div>
<div class="ui-widget-component" id="ui-widget-component"></div>	
<!--	
	<div id="toolbars"></div>
	<div class="content_table"></div>
	<div id="pager"></div>
-->
	
</fieldset>	
	
	
	
<?php echo javascript(); ?>
<script type="text/javascript">
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */

 Ext.DOM.onload= (function(){
	Ext.Cmp('ui-widget-title').setText( Ext.System.view_file_name());
 })()
 
/**
 ** javscript prototype system
 ** version v.0.1
 **/
		
var datas = { 
	keywords : '<?php echo _get_post('keywords'); ?>',
	order_by : '<?php echo _get_post('order_by'); ?>',
	type 	 : '<?php echo _get_post('type'); ?>',
}
 
/**
 ** javscript prototype system
 ** version v.0.1
 **/
 		
$(function(){
	$('#toolbars').extToolbars({
		extUrl   : Ext.DOM.LIBRARY+'/gambar/icon',
		extTitle :[['Add'],['Edit'],['Delete'],['Search']],
		extMenu  :[['Add'],['Edit'],['Delete'],['Search']],
		extIcon  :[['add.png'],['application_edit.png'],['delete.png'],['zoom.png']],
		extText  :true,
		extInput :true,
		extOption: [{
			render	: 3,
			type	: 'text',
			id		: 'keywords', 	
			name	: 'keywords',
			value	: datas.keywords,
			width	: 200
		}]
	});
});


Ext.EQuery.TotalPage   = <?php echo (INT)$page -> _get_total_page(); ?>;
Ext.EQuery.TotalRecord = <?php echo (INT)$page -> _get_total_record(); ?>;
	
/* assign navigation filter **/
var navigation = {
	custnav	 : Ext.DOM.INDEX +'/CtiPBXSetting/index/',
	custlist : Ext.DOM.INDEX +'/CtiPBXSetting/content/',
}
		
/* assign show list content **/

Ext.EQuery.construct(navigation,datas)
Ext.EQuery.postContentList();


// Search

Ext.DOM.Search = function(){
  Ext.EQuery.construct(navigation,{
	keywords : Ext.Cmp('keywords').getValue()
  });
  Ext.EQuery.postContent();
}

// cancelResult
		
var cancelResult = function(){
	Ext.Cmp('top-panel').setText("");
}


// Edit

Ext.DOM.Edit = function(){
	Ext.Ajax
	({
		url    : Ext.DOM.INDEX +"/CtiPBXSetting/Edit/",
		method : "GET",
		param  : {
			Id : Ext.Cmp('chk_skill').getValue(),
			time : '<?php echo time(); ?>' 
		}
	}).load("top-panel");
}


// AddScript

Ext.DOM.Add = function(){
	Ext.Ajax
	({
		url    : Ext.DOM.INDEX +"/CtiPBXSetting/Add/",
		method : "GET",
		param  : {
			time : '<?php echo time(); ?>' 
		}
	}).load("top-panel");
}

//Delete
		
Ext.DOM.Delete = function()
{
	var Id = Ext.Cmp('chk_skill').getValue();
	if(Ext.Cmp('chk_skill').empty()!=true)
	{
		if( Ext.Msg("Do you want delete this rows").Confirm() )
		{
			Ext.Ajax({
				url 	: Ext.DOM.INDEX+'/CtiPBXSetting/Delete/',
				method 	:'POST',
				param 	: { Id : Id },
				ERROR : function(e){
					var ERR = JSON.parse(e.target.responseText);
					if( ERR.success ) {
						Ext.Msg("Delete CC PBX Setting").Success();
						Ext.EQuery.postContent();
					}
					else{
						Ext.Msg("Delete CC PBX Setting").Failed();
						return false;
					}
				}
			}).post();
		}
	}
	else{
		Ext.Msg("Please select Rows").Error();
	}
}

//Delete
		
Ext.DOM.Save = function() {
  Ext.Ajax 
  ({
		url 	: Ext.DOM.INDEX+ '/CtiPBXSetting/Save/',
		method 	:'POST',
		param 	: Ext.Join([Ext.Serialize('frmAddReasonType').getElement()]).object(),
		ERROR : function(e) {
			Ext.Util(e).proc(function(save){
				if( save.success){
					Ext.Msg("Save CC PBX Setting").Success();
					Ext.EQuery.postContent();
				}
				else{
						Ext.Msg("Save CC PBX Setting").Failed();	
				}	
			});
		}	
	}).post();
}


//Delete
		
Ext.DOM.Update = function() {
	Ext.Ajax 
	({
		url 	: Ext.DOM.INDEX+ '/CtiPBXSetting/Update/',
		method 	:'POST',
		param 	: Ext.Join([Ext.Serialize('frmEditReasonType').getElement()]).object(),
		ERROR : function(e) {
			Ext.Util(e).proc(function(Update){
				if( Update.success){
					Ext.Msg("Update CC PBX Setting").Success();
					Ext.EQuery.postContent();
				}
				else{
					Ext.Msg("Update CC PBX Setting").Failed();	
				}	
			});
		}	
	}).post();
}
		
</script>
	<!-- start : content -->
	
<fieldset class="corner">
<?php echo form()->legend(lang(""), "fa-gear"); ?>	
				<div id="toolbars"></div>
				<div id="top-panel"></div>
				<div class="content_table"></div>
				<div id="pager"></div>
		</fieldset>	
		
	<!-- stop : content -->
	
	
	

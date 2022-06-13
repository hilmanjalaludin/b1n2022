<?php echo javascript(); ?>
<script type="text/javascript">

var Role = new Ext.Role("CourierList");
	Role.extend([
		{ title: " ", icon :"", event: "", key :'PerUserId' } // if you have other extends event 
	]);
// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
 Ext.DOM.onload= (function(){
	Ext.Cmp('ui-widget-title').setText( Ext.System.view_file_name());
 })()
 

// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */

Ext.DOM.datas = 
{
	KurirCode 		: "<?php echo _get_exist_session('KurirCode'); ?>",
	KurirDesc		: "<?php echo _get_exist_session('KurirDesc'); ?>",
	flag		    : "<?php echo _get_exist_session('flag'); ?>",
	order_by 	    : "<?php printf('%s', _get_exist_session('order_by'));?>",
	type			: "<?php printf('%s', _get_exist_session('type'));?>"
}

// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
  Ext.DOM._content_page = 
{
	custnav  : Ext.EventUrl(['CourierList','index']).Apply(),  
	custlist : Ext.EventUrl(['CourierList','Content']).Apply()  	
 }	
// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */

 Ext.EQuery.TotalPage   = '<?php echo $page -> _get_total_page(); ?>';
 Ext.EQuery.TotalRecord = '<?php echo $page -> _get_total_record(); ?>';
// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
 Ext.DOM.searchWork = function()
 {
	$.cookie('selected',0)	
	
	var FrmGroupLayout  = Ext.Serialize("FrmGroupLayout");
		console.log( FrmGroupLayout.getElement());
	Ext.EQuery.construct( Ext.DOM._content_page,Ext.Join([ 
			FrmGroupLayout.getElement() 
		]).object());
	Ext.EQuery.postContent();	
}

// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
 Ext.DOM.Clear = function()
 {
	Ext.Serialize("FrmGroupLayout").Clear();
	new Ext.DOM.searchWork();
}

// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
Ext.EQuery.construct(Ext.DOM._content_page, datas )
Ext.EQuery.postContentList();

// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
Ext.DOM.DisableUserLayout = function()
{
	Ext.Ajax
	({
		url : Ext.DOM.INDEX +'/CourierList/SetLayout/',
		method : 'POST',
		param :{
			SetLayout : 0,
			LayoutId : Ext.Cmp('KurirID').getValue()		
		},
		ERROR : function(fn){
			var ERR = JSON.parse(fn.target.responseText);
			if(ERR.success){
				Ext.Msg("Disable Layout").Success();
				Ext.EQuery.construct(Ext.DOM._content_page, datas )
				Ext.EQuery.postContent();
			}
			else{
				Ext.Msg("Disable Layout").Failed();
			}
		}
	}).post();
} 	

// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
		
Ext.DOM.EditLayout = function()
{

	  var KurirID =Ext.Cmp('KurirID').getValue();
	  if( KurirID == '' ){
		Ext.Msg("Please select a rows ").Info();
		return false;
	  }	 
	  Ext.ShowMenu(new Array('CourierList','Edit'), 
		Ext.System.view_file_name(), {	
			KurirID : KurirID 
	  });

}
// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 

 Ext.DOM.Delete = function()
{
 var KurirID = Ext.Cmp('KurirID').getValue();
 if( KurirID.length == 0 ){
	Ext.Msg("Please select rows! ").Info();
	return false;
	
 }
 
 if( !Ext.Msg('Do you want to delete this row?').Confirm() ){
	 return false;
 }
 
	 Ext.Ajax
	({
		url 	: Ext.EventUrl(['CourierList','Delete']).Apply(),  //Ext.DOM.INDEX +'/CourierList/UpdateLayout/',
		method 	: 'POST',
		param 	: {
			KurirID : KurirID
		},
		ERROR : function( err ){
			Ext.Util( err ).proc(function( response ){
				if( response.success ){
					// console.log(response);
					Ext.Msg("Delete Courier").Success();
					Ext.EQuery.postContent();	
				} else {
					Ext.Msg("Delete Courier").Failed();
				}	
			});
		}
	}).post();
}


// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 	
 Ext.DOM.addUserLayout = function()
{
	Ext.ShowMenu( new Array('CourierList','AddCourierLayout'), 
		Ext.System.view_file_name(), {
			act : 'add-layout-user'
		}	
	);
}
	


// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
 $(document).ready(function() {
	$('#toolbars').extToolbars
	({
		extUrl    : Ext.DOM.LIBRARY+'/gambar/icon',
		extTitle  : [['Search'],['Clear'] ,['Add'],['Edit'],['Delete']],
		extMenu   : [['searchWork'],['Clear'],['addUserLayout'],['EditLayout'],['Delete']],
		extIcon   : [['zoom.png'],['zoom_out.png'], ['add.png'],['calendar_edit.png'],['delete.png']],
		extText   : true,
		extInput  : false,
		extOption : []
	});
	$('.select').chosen();
 });
 
	
</script>

<!-- start : content -->
<fieldset class="corner">
<?php echo form()->legend(lang(""), "fa-users"); ?>
  <div id="result_content_add" class="ui-widget-panel-form"> 
	<form name="FrmGroupLayout">
		<div class="ui-widget-table-compact">
			<div class="ui-widget-form-row">		
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Kurir Name'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell"><?php echo form()->input("KurirDesc", "input_text superlong", _get_exist_session('layout_name') );?></div>
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Kurir Code'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell"><?php echo form()->input("KurirCode", "input_text superlong", _get_exist_session('layout_name') );?></div>
				
			</div>
			
			<div class="ui-widget-form-row">
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
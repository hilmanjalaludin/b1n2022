<script>
 
/**
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
Ext.DOM.RoleBack = function(){
	if( Ext.Msg('Are you sure ?').Confirm() ){
		Ext.ShowMenu("SetUpload", Ext.System.view_file_name());	
	}
}
 
/**
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
 Ext.DOM.OrderBy = function()
{
	var select = {};
	$('.jlistbox').each(function() {
		if( $(this).attr('checked')  == 'checked' ){		
			var obj = $(this).val();
			var cell = $(".tpl-"+ obj).val();
			select[new Array(obj, cell).join('-')] = new Array(obj, cell).join('-');
		}
	});
	
	return Object.keys(select);
}
 
/**
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */

window.Insert = function() {

 var table_name 	= Ext.Cmp('table_name').getValue();
 var mode_input 	= Ext.Cmp('mode_input').getValue();
 var templ_name 	= Ext.Cmp('templ_name').getValue();
 var file_type  	= Ext.Cmp('file_type').getValue();
 var black_list 	= Ext.Cmp('black_list').getValue();
 var expired_days 	= Ext.Cmp('expired_days').getValue();
 var bucket_data 	= Ext.Cmp('bucket_data').getValue();
 var delimiter_type = Ext.Cmp('delimiter_type').getValue();
  
  if( Ext.Msg('Do you want to save this template').Confirm() ) 
  {	
		var DataServerObject = {},  DataServerField = {}
		
	// data on object sent data post 	
		DataServerObject = {
			table_name	: table_name,
			mode_input  : mode_input,
			templ_name 	: templ_name, 
			file_type	: file_type,
			delimiter	: delimiter_type, 
			expired_days: expired_days,
			black_list	: black_list,
			bucket_data	: bucket_data 
		}
		
		 
		DataServerField = Ext.Serialize('frmCreateTemplate').Data();
		
	// sent data via ajax session process 
	
		Ext.Ajax
		({
			url 	: Ext.EventUrl( new Array('SetUpload','Submit') ).Apply(), // Ext.DOM.INDEX +'/SetUpload/saveTemplate/',
			method  : 'POST',
			param   : Ext.Join(new Array( DataServerObject, DataServerField )).object(),
			success : function( xhr ){
				Ext.Util( xhr ).proc(function( data ){
					if( data.success == 1 ){
						Ext.Msg('Save Template Upload').Success();
						Ext.EQuery.construct(Ext.DOM._content_page,Ext.DOM.datas )
						Ext.EQuery.postContent();	
					}
					//jika gagal save 
					else {
						 Ext.Msg('Save Template Upload').Failed();
					}
				}); 
			}
		}).post();
	}
}

 
/**
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
	
Ext.DOM.Update = function()
{
	var list_check 	= Ext.Cmp('columns').getValue();
	var list_keys  	= Ext.Cmp('columns_keys').getValue();
	var table_name 	= Ext.Cmp('table_name').getValue();
	var mode_input 	= Ext.Cmp('mode_input').getValue();
	var templ_name 	= Ext.Cmp('templ_name').getValue();
	var file_type  	= Ext.Cmp('file_type').getValue();
	var order_by	= Ext.DOM.OrderBy();
	var bucket_data = Ext.Cmp('bucket_data').getValue();
	var delimiter_type= Ext.Cmp('delimiter_type').getValue();
	var black_list 	 = Ext.Cmp('black_list').getValue();
	var expired_days = Ext.Cmp('expired_days').getValue();
 
	 
	if( Ext.Msg('Do you want to save this template').Confirm() )
	{	
		var param = [], alias = [];
		param['table_name'] = table_name;
		param['mode_input'] = mode_input;
		param['templ_name'] = templ_name;
		param['list_check'] = list_check;
		param['file_type']	= file_type;
		param['list_keys']  = list_keys;
		param['delimiter']  = delimiter_type;	
		param['order_by']   = order_by;
		param['expired_days'] = expired_days;
		param['black_list'] = black_list;
		param['bucket_data'] = bucket_data;
			
		
			Ext.Ajax
			({
				url 	: Ext.DOM.INDEX +'/SetUpload/saveTemplate/',
				method  : 'POST',
				param   : Ext.Join(new Array( param,_getAliasName())).object(),
				ERROR : function(e){
					var ERR = JSON.parse(e.target.responseText);
					if( ERR.success ){
						Ext.Msg('Save Template Upload').Success();
						Ext.EQuery.construct(Ext.DOM._content_page,Ext.DOM.datas )
						Ext.EQuery.postContent();	
					}
					else{
						Ext.Msg('Save Template Upload').Failed();
					}
				}
			}).post();
	}
}

 
/**
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
Ext.DOM.SaveTemplate = function()
{
	switch ( Ext.Cmp('mode_input').getValue() )
	{
		case 'insert' :  Ext.DOM.Insert(); break;
		case 'update' :  Ext.DOM.Update(); break;
		default : 
			Ext.Msg("Please select mode input !").Info();
		break;
	}
}

/**
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
 window.DataServerOrder = function() {
	var data = {}, 
		element = Ext.Cmp('columns').getValue();
		for( var i = 0; i< element.length; i++ ) {
			data[element[i]] = Ext.Cmp(element[i]).getValue(); 
		} 
		
	return data;	
 }
// ---------------------------------------------------------------------	
/*
 * @ package : 	
 * ---------------------------------------------------------------------
 *
 * @ param 	 :  
 * @ param 	 :  
 */
 window.DataServerField = function() {
	var selectFieldData = {};
	$('.jlistbox').each(function() {
		if( $(this).attr('checked')  == 'checked' ){	
			var val = $(this).val(), obj = window.sprintf("fld-%s", val);
			var dta = $(window.sprintf("#%s", obj)).val();
			selectFieldData[obj] = dta; 
		}
	});
	
	return selectFieldData;
 }
// ---------------------------------------------------------------------	
/*
 * @ package : 	
 * ---------------------------------------------------------------------
 *
 * @ param 	 :  
 * @ param 	 :  
 */
window.getTableColumns = function(select)
{

 var tables = Ext.Cmp('table_name').getValue(),
	 total = Ext.Cmp('jumlah_column').getValue();
	 
 if( tables =='' ) {
	 Ext.Msg("Table Name Is empty").Info();
	return false;
 }
 
 if(total=='' || total==0  ) {
	 Ext.Msg("Number  Of field").Info();
	return false;
 }
 
 // if selected data is OK 
 if( select.value!='' ) {
		$('#list_columns').Spiner ({
			url : new Array('SetUpload','setTemplate'),
			param : {
				tables : tables,
				total  : total, 
				method : select.value
			},  
			order : {
				order_type : '',
				order_by   : '',
				odrer_page : ''	
			},
			complete : function( html ){
				$(html).find('.select').css({'width': '99%'});
				$(html).find('.input_text').css({'width': '97%'});
			}
		});	
	}
	else{
		$('#list_columns').html("");
	}
  
}

	
// ---------------------------------------------------------------------	
/*
 * @ package : 	
 * ---------------------------------------------------------------------
 *
 * @ param 	 :  
 * @ param 	 :  
 */
 var getListCheck = function(object)
{
	var alias_name = 'alias_name_'+object.value;
	var order_name = 'order_name_'+object.value;
	
	if( object.checked) {
		Ext.dom(alias_name).value = object.value;
		Ext.dom(order_name).value = 0;
	}
	else{
		Ext.dom(alias_name).value = '';
		Ext.dom(order_name).value = '';
	}	
}
// ---------------------------------------------------------------------	
/*
 * @ package : 	
 * ---------------------------------------------------------------------
 *
 * @ param 	 :  
 * @ param 	 :  
 */

 var ReturnNextForm = function(object) {
	Ext.checkedAll(object);
	var list_html_data = '';
	var list_check_data = Ext.checkedValue(object);
}
// ---------------------------------------------------------------------------------------------------------------
/*
 * @ def	 : function ready 
 * 
 * @ params	 : method on ready pages 
 * @ package : bucket datas 
 */
 
$(document).ready( function()
{
  $('#ui-widget-template-tabs').mytab().tabs();
  $('#ui-widget-template-tabs').mytab().tabs("option", "selected", 0);
  
  $('#ui-widget-template-tabs').css({'background-color':'#FFFFFF'});
  $('#ui-widget-template-content').css({'background-color':'#FFFFFF'});
  
  $("#ui-widget-template-tabs").mytab().close(function(){ 
		Ext.DOM.RoleBack();
  }, true);
  
  $('.select').chosen();
});

</script>
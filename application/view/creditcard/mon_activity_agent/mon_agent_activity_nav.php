<?php echo javascript(); ?>
<script type="text/javascript">
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
var Role = new Ext.Role("MonAgentActivity");
	Role.extend([
		{ title: " ", icon :"", event: "", key :'MonitorId' } // if you have other extends event 
	]);
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 
Ext.DOM.RoleBack = function(){
	if( Ext.Msg('Are you sure ?').Confirm() ){
		window.clearInterval(window.setTimeOutId);
		Ext.BackHome();
	}
}

 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
window.EventActivity = function() {
	
// buat string baru untuk create object koneksi	
 var dataServerConnection =  Ext.Json( 'MonAgentActivity/Store',{
	order_type   : '',
	order_status : ''
 });
	
	
 // if object koneksi OK kemudian ambil semua attribut
 // dengan method ajax .
 dataServerConnection.dataItemEach( function( data ){
	 for( var UserId in data ) { 
	 
		// get row data item json 
		var row = data[UserId];
		if( typeof( row ) == 'object' ) {
	
		// style on css toogle data row if logout 
		// silver color .
		
			if( row.logstate == 0 ){
				$( window.sprintf('.panel-%s',    UserId ) )
				.hide()
				
				$( window.sprintf('.%s',   UserId ) )
				.css({'color':'silver'})
				
			// style button 	
				$( window.sprintf('.ext-%s',    UserId ) )
				.html( row.extension )
				.css({'color' : 'silver'})
				
				
				$( window.sprintf('.status-%s', UserId ) )
				.html( row.agentstatus )
				.css({'color' : 'silver'})
				
				$( window.sprintf('.time-%s',   UserId ) )
				.html( row.timestatus )
				.css({'color' : 'silver'})
				 
				
				$( window.sprintf('.exts-%s',   UserId ) )
				.html( row.extstatus )
				.css({'color' : 'silver'})
				 
				
				$( window.sprintf('.data-%s',   UserId ) )
				.html( row.datastatus )
				.css({'color' : 'silver'})
			}
			
		// style on css toogle data row if logout 
		// green color .	
			if( row.logstate == 1){
				$( window.sprintf('.panel-%s',    UserId ) )
				.show()
				
				$( window.sprintf('.%s',   UserId ) )
				.css({'color':'green'})
				
			
				
				$( window.sprintf('.ext-%s',    UserId ) )
				.html( row.extension )
				.css({'color' : 'green', 'font-weight':'bold'})
				
				
				$( window.sprintf('.status-%s', UserId ) )
				.html( row.agentstatus )
				.css({'color' : 'green'})
				
				$( window.sprintf('.time-%s',   UserId ) )
				.html( row.timestatus )
				.css({'color' : 'green'})
				 
				
				$( window.sprintf('.exts-%s',   UserId ) )
				.html( row.extstatus )
				.css({'color' : 'green'})
				 
				
				$( window.sprintf('.data-%s',   UserId ) )
				.html( row.datastatus )
				.css({'color' : 'green'})
				
				
			// button style di triger oleh status extension 
			// button role. pada system .
			 // console.log(row.extstate);
			  if( row.extstate == 7 ) {
					$(window.sprintf('.btn-style-%s', UserId))
					.addClass('btn-info')	
					.removeClass('btn-danger')
					.attr('disabled', false)
					
					// then will state button process 
					if( typeof( row.handler['_SPY_TOOL_'] ) =='object' ){
						var dataButton  = row.handler['_SPY_TOOL_'];
							$(window.sprintf('.btn-style-%s', UserId))
							.attr("onClick", window.sprintf("window.EventSpy('%s', '%s')",dataButton.stt_extension,  dataButton.src_extension ))
					}
					// on coach data 
					if( typeof( row.handler['_COC_TOOL_'] ) =='object' ){
						var dataButton  = row.handler['_COC_TOOL_'];
						$(window.sprintf('.btn-style-%s', UserId))
						.attr('onClick', window.sprintf("window.EventCoach('%s', '%s')",dataButton.stt_extension,  dataButton.src_extension ))
					}
					//console.log( row.handler );
					
			  }
			  else {
				$(window.sprintf('.btn-style-%s', UserId))
					.addClass('btn-default')	
					.removeClass('btn-info')  
					.css({'color' : '#000000'})
					.attr('disabled', true)
			  }
			  
			 // end style button 
			}
			 
		}
	 }
  });
	
}

 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
window.ActivityAgent = function( data )
{
	// window.ActivityAgent({ order_type : "DESC", order_content : 'box' }); 
  window.clearInterval(Ext.DOM.setTimeOutId);
  
  // get status agent yang di filter .
 data.order_kode = ''; // Ext.Cmp('AgentActivityCode').getValue().join(",");
 $('#content-activity').Spiner ({
		url 	: Role.action('Content'), //new Array('MonAgentActivity','Content'),
		param 	: { 
			order_type 	  : data.order_type,
			order_content : data.order_content,
			order_kode 	  : data.order_kode
		},
		order   : {
			order_type : '',
			order_by   : '',
			order_page : ''	
		}, 
		complete : function( obj ){
			console.log( obj );
			
		// after load data then will call this 
		 // function get data process .
			window.setTimeOutId = window.setInterval(function(){
				new window.EventActivity();
			}, 1000)
		}
	});		
	
	
	
	
} 
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 
window.RefreshData = function() {
	window.ActivityAgent({ order_type : "DESC", order_content : 'list' });
}

 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 
window.EventSpy = function( ExtSite, ExtSrc ) 
{
	
// cek extension  -test juga ya 	
  if( ExtSite == '' ){
	 Ext.Msg("State Extension Not Found.").Info();
	 return false;
  }

  // cek extension  -nya 
 if( ExtSrc == '' ){
	 Ext.Msg("Destination Extension Not Found.").Info();
	 return false;
  }  
  
 // tanya lagi yakin mau denger 
  if( !Ext.Msg("Do you want to listen ?").Confirm() ) {
	 return false;
   }
	
// buat object link untuk memerintahkan ke server 	
	var dataURL = Ext.EventUrl( new Array('MonAgentActivity','SpyAgent') ); 
	 Ext.Ajax 
	({
		url 	: dataURL.Apply(),
		method  : 'POST',
		param 	: {
			FromExtension  : ExtSite,
			ToExtension	 : ExtSrc
		},
		success : function( xhr ){
			Ext.Util( xhr ).proc(function( data ){
				console.log( data.success );
			});
		}
	}).post();
}
 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
window.EventCoach = function( ExtSite, ExtSrc )  {
	
// check by richek data process 	
if( ExtSite == '' ){
	 Ext.Msg("State Extension Not Found.").Info();
	 return false;
  }

 // check by richek data process 
 if( ExtSrc == '' ){
	 Ext.Msg("Destination Extension Not Found.").Info();
	 return false;
  }  
    
 // tanya lagi yakin mau denger 
  if( !Ext.Msg("Do you want to listen ?").Confirm() ) {
	 return false;
   }
   // buat object link untuk memerintahkan ke server 	
	var dataURL = Ext.EventUrl( new Array( 'MonAgentActivity', 'CoachAgent' ) ); 
	
	Ext.Ajax 
	({
		url 	: dataURL.Apply(),  
		method  : 'POST',
		param 	: {
			FromExtension  : ExtSite,
			ToExtension	 : ExtSrc
		},
		success : function( xhr ){
			Ext.Util( xhr ).proc(function( data ){
				console.log( data.success );
			});
		}
	}).post();
}

 /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 $(document).ready( function() {
  $('#ui-widget-template-tabs').mytab().tabs();
  $('#ui-widget-template-tabs').mytab().tabs("option", "selected", 0);
  $('#ui-widget-template-tabs').css({'background-color':'#FFFFFF'});
  $('#ui-widget-template-content').css({'background-color':'#FFFFFF'});
  $("#ui-widget-template-tabs").mytab().close(function(){  Ext.DOM.RoleBack(); }, true);
  Ext.Cmp('legend_title').setText( Ext.System.view_file_name());
  window.RefreshData();
  $('.select').chosen();
  
 });
 
</script> 	

<div id="ui-widget-template-tabs" class="tabs corner ">
	<ul>
		<li class="ui-tab-li-lasted">
			<a href="#ui-widget-template-content">
			<span class="ui-icon ui-icon-newwin"></span><span id="legend_title"></span></a>
		</li>
	</ul>	
	
	<div id="ui-widget-template-content" style="width:98.2%;">
		<div class="ui-widget-form-table-compact" style="width:100%;margin-left:-5px;">
			<div class="ui-widget-form-row">
				<div class="ui-widget-form-cell ui-widget-content-top center" id="content-activity" 
					style="padding-top:8px;">
				</div>
			</div>
		</div>
	</div>
</div>	
	

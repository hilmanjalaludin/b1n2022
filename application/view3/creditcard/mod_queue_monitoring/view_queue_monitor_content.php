<?php 
$out = new EUI_Object( $row );
echo "<div id=\"ui-content-queue-monitoring\" class=\"ui-widget-form-table table-body-content\"> ";
		
	
echo "<div class=\"ui-widget-form-row ui-widget-header table-row-header\">".
		"<div class=\"ui-widget-form-cell ui-corner-top table-cell-header center\">No</div>".
		"<div class=\"ui-widget-form-cell ui-corner-top table-cell-header left\"><span class=\"fa fa-phone-square\" style=\"margin:0px 4px 0px 4px;\"></span>Caller Id</div>".
		"<div class=\"ui-widget-form-cell ui-corner-top table-cell-header center\"><span class=\"fa fa-clock-o\" style=\"margin:0px 4px 0px 4px;\"></span>Duration</div>".
		"<div class=\"ui-widget-form-cell ui-corner-top table-cell-header left\"><span class=\"fa fa-users\" style=\"margin:0px 4px 0px 4px;\"></span>Destination</div>".
	"</div>";		

	
//--------- on content -----------------------
	
$num  = 0;	
 if(is_array($row) )
	 foreach( $row as $field => $rows )
{
  $num_page = $num+1;	
  $row_select = ( ( $num %2 == 0 ) ? "table-cell-selcted-one" : "table-cell-selcted-two" );
  
  $outs =& new EUI_Object( $rows );
  echo "<div class=\"ui-widget-form-row $row_select onselect\">".
			"<div class=\"ui-widget-form-cell table-cell-content center\">".$num_page ."</div>".
			"<div class=\"ui-widget-form-cell table-cell-content left\"><b>". $outs->get_value('caller_number','trim') ."</b></div>".
			"<div class=\"ui-widget-form-cell table-cell-content center\">".$outs->get_value('duration','_getDuration') ."</div>".
			"<div class=\"ui-widget-form-cell table-cell-content left\">". $outs->get_value('description') ."</div>".
		"</div>";
$num++;	
}	
echo "</div>";
?>
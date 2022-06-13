<?php 
//---------------------------------------------------------------------------------------

/* properties		: Submit 
 *
 * @param 			: ${_REQUEST}
 * @author			: -
 */
 
 
$out =& new EUI_Object( $row );

//---------------------------------------------------------------------------------------

/* properties		: Submit 
 *
 * @param 			: ${_REQUEST}
 * @author			: -
 */
 
 if( !function_exists('_getCallfunction') )  {
	function _getCallfunction() 
 {	
	$vars =& func_get_args();
	if( $vars[1] < 3 ) {
		return $vars[1];
	}
	
	$Id = (int)$vars[0];
	
	return form()->formtoolbar(
		array( 
			"SubmitRetry" => array("class" => "fa fa-sign-in ui-widget-awesome-toolbar", "value" => $Id, "label" => "Retry"),
			"SubmitCancel" => array("class" => "fa fa-remove ui-widget-awesome-toolbar", "value" => $Id, "label" => "Cancel")
		));
		
	//return "<span>TEST Button</span>";
 }
 
}	
//---------------------------------------------------------------------------------------

/* properties		: Submit 
 *
 * @param 			: ${_REQUEST}
 * @author			: -
 */
 
 $ar_label = array(
  'QueueId'			=> '# Queue ID',	 
  'EmailCreateTs' 	=> 'Date Created',
  'SentTo' 			=> "Destination",
  'EmailSubject'   	=> 'Subject',
  'EmailStatusName' => 'Status',
  'QueueReason'		=> 'Reason',
  'QueueTimeTs' 	=> 'Queue Time',
  'QueueTrying' 	=> '# Retry'
);

//---------------------------------------------------------------------------------------

/* properties		: Submit 
 *
 * @param 			: ${_REQUEST}
 * @author			: -
 */
 
$ar_align = array(
  'QueueId'			=> 'center',	 
  'EmailCreateTs' 	=> 'center',
  'SentTo' 			=> "left",
  'EmailSubject'   	=> 'left',
  'EmailStatusName' => 'center',
  'QueueTimeTs' 	=> 'center',
  'QueueReason'		=> 'left',
  'QueueTrying' 	=> 'center'
);

$ar_fn = array(
  'QueueTimeTs' => '_getDuration',
  'QueueTrying'	=> '_getCallfunction'
 );

$total = count($row);
if( count($out->fetch_field())==0 ){
	exit("No Record.");
}	
	
echo "<div class=\"ui-widget-form-row ui-widget-header table-row-header\">";
	echo "<div class=\"ui-widget-form-cell ui-corner-top table-cell-header center\">No</div>";
foreach( $out->fetch_field() as $k => $label ){
  echo "<div class=\"ui-widget-form-cell ui-corner-top table-cell-header $ar_align[$label] \">{$ar_label[$label]}</div>";
}
echo "</div>";
	
//--------- on content -----------------------
	
$num  = 0;	
 if(is_array($row) )
	 foreach( $row as $field => $rows )
{
  $num_page = $num+1;	
  $row_select = ( ( $num %2 == 0 ) ? "table-cell-selcted-one" : "table-cell-selcted-two" );
  
  $outs =& new EUI_Object( $rows );
  
	echo "<div class=\"ui-widget-form-row $row_select onselect\">";
	
	echo " <div class=\"ui-widget-form-cell table-cell-content center\">".  $num_page ."</div>";
	foreach( $out->fetch_field() as $k => $field )
	{
		if(in_array($field, array_keys($ar_label) ) )
		{
			if(!in_array($field, array('QueueTrying') ) ){
				echo " <div class=\"ui-widget-form-cell table-cell-content $ar_align[$field]\">". $outs->get_value($field, $ar_fn[$field]) ."</div>";
			} else {
				echo " <div class=\"ui-widget-form-cell table-cell-content $ar_align[$field]\">". call_user_func_array("_getCallfunction", array(
					$outs->get_value('QueueId'),
					$outs->get_value('QueueTrying')
				))."</div>";
			}
		}	
	}
	echo "</div>";
$num++;	
}	

?>
<?php 
global $Buttons;
 
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 $this->load->helpers(array("EUI_Object","EUI_Extendpager")); 
 $pager =& EUI_Extendpager::Instance();
 $Buttons = $button;
 
 //---------------------------------------------------------------------------------------

/* properties		local function  
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 
 if( !function_exists('_setEventPrint') )
{
	function _setEventPrint( $PodId ) 
	{
		global $Buttons;
		$arr_button = "&nbsp;";
		if( $Buttons->find_value('_PRT_TOOL_') ){
			$arr_button = form()->formtoolbar (
				array(  $Buttons->get_value('_PRT_TOOL_')->get_value('Event') => array("class" => "fa fa-print ui-widget-awesome-toolbar", "value" => $PodId, "label" => "Print") )
			);
		}
		return (string)$arr_button;
		
	}
 } 
 
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
  
  $pager->set_source_table($page, $num);
  $pager->set_title_row_content('click row for detail');
  $pager->set_width_table('100%');
  $pager->set_class_table('custom-grid');
  
  
//  $pager->select_pager_debug();
  
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */  
 
  $pager->set_order_style(array
 (
	'background-color' 	=> '#FFFCCC',
	'color' 			=> '#8a1b08',
	'cursor' 			=> 'pointer'
 ));
 
 
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
  $pager->set_align_cols( array
 (
	'Recsource'		=> 'left',
	'ReffPodNo'     => 'left',
	'CustomerName' 	=> 'left',
	'Wilayah' 		=> 'left',
	'TujuanKirim'	=> 'left',
	'Document' 		=> 'left',
	'PickupDate' 	=> 'center',
	'PodWrite'		=> 'center',
	'PrintDate'		=> 'center',
	'AgentId'		=> 'left',
	'CallStatus'	=> 'left',
	'ProductCode'	=> 'left',
	'ProductType'	=> 'center',
	'CustomerNumber'=> 'left',
	'PrintId'		=> 'center'
	
	
  ));

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 

  $pager->set_row_format( array
 (
	'Recsource'		=> array('_setCapital'),
	'ReffPodNo'     => array('_setCapital','_setBoldColor'),
	'CustomerNumber'=> array('_setCapital','_setBoldColor'),
	'ProductCode'	=> array('_setCapital','_setBoldColor'),
	'ProductType'	=> array('_setCapital','_setBoldColor'),
	'CustomerName' 	=> array('_setCapital'),
	'Wilayah' 		=> array('_setCapital'),
	'TujuanKirim'	=> array('_setCapital'),
	'Document' 		=> array('_setCapital'),
	'PickupDate' 	=> array('_setCapital','_getDateIndonesia'),
	'PodWrite'		=> array('_setCapital','_getDateIndonesia'),
	'PrintDate'		=> array('_setCapital','_getDateIndonesia'),
	'AgentId'		=> array('_setCapital'),
	'PrintId'		=> array('_setEventPrint')
	
  ));  

  
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
if( $button->find_value('_DTL_TOOL_') ) {
   $pager->set_event_row_click(array('onclick' => $button->get_value('_DTL_TOOL_')->get_value('Event')));
}


//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 $pager->select_pager_content();
 $pager->reset_pager_object();
 
// ------------------------------------END VIEW ---------------------------------
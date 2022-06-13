<?php 
/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 $this->load->helpers(array("EUI_Object","EUI_Extendpager")); 
 $pager =& EUI_Extendpager::Instance();
/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 if( SystemTableCheck() ){ 
  $pager->set_checkbox_func(true, true);
 }

/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  $pager->set_source_table($page, $num);
  $pager->set_title_row_content('set checkbox for play or download');
  $pager->set_width_table('100%');
  $pager->set_class_table('custom-grid');
  
/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
   $pager->set_disable_order(array(
	'CC_DateTime'		=> true,
	'CC_Destination'	=> true,
	'CC_Extension' 		=> true,
	'CC_AgentId' 		=> true,
	'CC_Duration'		=> true,
	'CC_FileSize'		=> true,
	'CC_FileName'		=> true,
	'CC_CampaignId'		=> true,
	'CC_Custno'			=> true,
	'CC_FirstName'		=> true
  ));
  
 //$pager->select_pager_debug();
 $pager->set_order_style(array (
	'background-color' 	=> '#FFFCCC',
	'color' => '#8a1b08',
	'cursor' => 'pointer'
 ));
  
 /*DUMP :
	[CC_RecId] => CC_RecId
    [CC_DateTime] => CC_DateTime
    [CC_Destination] => CC_Destination
    [CC_Extension] => CC_Extension
    [CC_AgentId] => CC_AgentId
    [CC_Duration] => CC_Duration
    [CC_FileSize] => CC_FileSize
    [CC_FileName] => CC_FileName
    [CC_CampaignId] => CC_CampaignId
    [CC_Custno] => CC_Custno
    [CC_FirstName] => CC_FirstName
*/

 $pager->set_align_header(array(
	'CC_FileSize' => 'center'
 ));
/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  $pager->set_align_cols( array (
	'CC_DateTime'		=> 'left',
	'CC_Destination'	=> 'left',
	'CC_Extension' 		=> 'center',
	'CC_AgentId' 		=> 'left',
  'DM_CallCategoryId' => 'left',
	'CC_Duration'		=> 'center',
	'CC_FileSize'		=> 'right',
	'CC_FileName'		=> 'left',
	'CC_CampaignId'		=> 'left',
	'CC_Custno'			=> 'left',
	'CC_FirstName'		=> 'left'
  ));

/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  $pager->set_row_format( array(
  
	'CC_DateTime'		=> array('SetDateTime'),
	'CC_Destination'	=> array('SetMasking'),
	'CC_Extension' 		=> array('SetCapital'),
	'CC_AgentId' 		=> array('SetCapital'),
  'DM_CallCategoryId' => array('AllCallStatus','SetCaptionKode','SetCapital'),
	'CC_Duration'		=> array('SetDuration'),
	'CC_FileSize'		=> array('SetFormatSize'),
	'CC_FileName'		=> array('SetCapital','_setMaskingRecording'),
	'CC_CampaignId'		=> array('CampaignId','SetCapital'),
	'CC_Custno'			=> array('SetCapital'),
	'CC_FirstName'		=> array('SetCapital')
	 
  ));  
  
 
  
/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 $pager->set_event_row_click(null);
/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 $pager->select_pager_content();
 $pager->reset_pager_object();
 
// ------------------------------------END VIEW ---------------------------------
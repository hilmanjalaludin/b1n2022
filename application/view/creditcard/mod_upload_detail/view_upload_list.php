
<?php 
/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 $this->load->helpers(array("EUI_Object","EUI_Extendpager")); 
 $pager=&Singgleton('EUI_Extendpager');
 
/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
  $pager->set_source_table($page, $num);
  
  $pager->set_title_row_content('click row for detail');
  $pager->set_width_table('100%');
  $pager->set_class_table('custom-grid');
  
/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 $pager->set_checkbox_func(true, false);  
 $pager->set_role_table(SystemTableRole() );
 
/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  $pager->set_order_style(array (
	'background-color' 	=> '#FFFCCC',
	'color' 			=> '#8a1b08',
	'cursor' 			=> 'pointer'
 ));
 
 //$pager->select_pager_debug();
  
/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
  $pager->set_align_cols( array (
	'UPL_DataID' 			=> 'center',
    'UPL_Recsource' 		=> 'left',
    'UPL_UploadRows' 		=> 'center',
    'UPL_UploadSuccess' 	=> 'center',
    'UPL_UploadFailed' 		=> 'center',
    'UPL_UploadDuplicate' 	=> 'center',
    'UPL_UploadDateTs' 		=> 'center',
    'UPL_UploadFilename' 	=> 'left',
    'UPL_UploadType' 		=> 'center',
    'UPL_UploadBy' 			=> 'left',
    'UPL_Flags' 			=> 'center'
  ));

/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */

  $pager->set_row_format( array (
	'UPL_DataID' 			=> array('SetBoldColor'),
    'UPL_UploadDateTs' 		=> array('SetDateTime'),
	'UPL_UploadBy' 			=> array('SetCapital'),
	'UPL_UploadFilename'	=> array('basename'),
	'UPL_Flags' 			=> array('Flags')
  ));

/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
    $pager->set_header_wrap(array(
		'UPL_DataID' 			=> 'wrap',
		'UPL_Recsource' 		=> 'wrap',
		'UPL_UploadRows' 		=> 'wrap',
		'UPL_UploadSuccess' 	=> 'wrap',
		'UPL_UploadFailed' 		=> 'wrap',
		'UPL_UploadDuplicate' 	=> 'wrap',
		'UPL_UploadDateTs' 		=> 'wrap',
		'UPL_UploadFilename' 	=> 'wrap',
		'UPL_UploadType' 		=> 'wrap',
		'UPL_UploadBy' 			=> 'wrap',
		'UPL_Flags' 			=> 'wrap'		
	));

/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */	
   $pager->set_content_wrap(array(
		'UPL_DataID' 			=> 'wrap',
		'UPL_Recsource' 		=> 'wrap',
		'UPL_UploadRows' 		=> 'wrap',
		'UPL_UploadSuccess' 	=> 'wrap',
		'UPL_UploadFailed' 		=> 'wrap',
		'UPL_UploadDuplicate' 	=> 'wrap',
		'UPL_UploadDateTs' 		=> 'wrap',
		'UPL_UploadFilename' 	=> 'wrap',
		'UPL_UploadType' 		=> 'wrap',
		'UPL_UploadBy' 			=> 'wrap',
		'UPL_Flags' 			=> 'wrap' ));
  
/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
  //debug($button);
 // if( $button->find_value('_DTL_TOOL_') ) {
   // $pager->set_event_row_click(array('onclick' => $button->get_value('_DTL_TOOL_')->get_value('Event')));
// }



//$pager->set_event_row_click(array('onclick' => 'EventCustomer') );
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 $pager->select_pager_content();
 $pager->reset_pager_object();
 
// ------------------------------------END VIEW ---------------------------------
?>

<!--
<table width="100%" class="custom-grid" cellspacing="0">
<thead>
	<tr height="20"> 
		
		<th nowrap class="custom-grid th-first center">&nbsp;<a href="javascript:void(0);" onclick="Ext.Cmp('ftp_upload_id').setChecked();" >#</a></th>  
		<th nowrap class="custom-grid th-middle">&nbsp;No</th>
		<th nowrap class="custom-grid th-middle" align="left">&nbsp;<span class="header_order" onclick="JavaScript:Ext.EQuery.orderBy('a.FTP_UploadType');"><b style='color:#608ba9;'>Source</b></span></th>
		<th nowrap class="custom-grid th-middle" align="left">&nbsp;<span class="header_order" onclick="JavaScript:Ext.EQuery.orderBy('a.FTP_UploadFilename');"><b style='color:#608ba9;'>File Name</b></span></th>
		<th nowrap class="custom-grid th-middle" align="left">&nbsp;<span class="header_order" onclick="JavaScript:Ext.EQuery.orderBy('a.FTP_UploadRows');"><b style='color:#608ba9;'>Total Data</b></span></th>
		<th nowrap class="custom-grid th-middle" align="left">&nbsp;<span class="header_order" onclick="JavaScript:Ext.EQuery.orderBy('a.FTP_UploadSuccess');"><b style='color:#608ba9;'>Success</b></span></th>
		<th nowrap class="custom-grid th-middle" align="left">&nbsp;<span class="header_order" onclick="JavaScript:Ext.EQuery.orderBy('a.FTP_UploadDuplicate');"><b style='color:#608ba9;'>Duplicate</b></span></th>
		<th nowrap class="custom-grid th-middle" align="left">&nbsp;<span class="header_order" onclick="JavaScript:Ext.EQuery.orderBy('a.FTP_UploadFailed');"><b style='color:#608ba9;'>Failed</b></span></th>
		<th nowrap class="custom-grid th-middle" align="left">&nbsp;<b style='color:#608ba9;'>Status</b></th>
		<th nowrap class="custom-grid th-middle" align="left">&nbsp;<span class="header_order" onclick="JavaScript:Ext.EQuery.orderBy('a.FTP_Flags');"><b style='color:#608ba9;'>Hidden</b></span></th>
		<th nowrap class="custom-grid th-lasted" align="left">&nbsp;<span class="header_order" onclick="JavaScript:Ext.EQuery.orderBy('a.FTP_UploadDateTs');"><b style='color:#608ba9;'>Upload Date</b></span></th>
		
	</tr>
</thead>	
<tbody>
<##?php
$no = $num;
foreach( $page -> result_assoc() as $rows )
{ 
  $color = ($no%2!=0?'#FFFEEE':'#FFFFFF');
  
  // file information status 
  
  $_full_name = basename($rows['FTP_UploadFilename']);
  $_full_path = str_replace('system/', APPPATH, BASEPATH).'temp/'. $_full_name;
	
 // status 
 
  $file_existing = ( file_exists($_full_path) ? 'files are still available': 'files have been deleted');  	
		
 ?>
	<tr class="onselect">
		<td class="content-first center"><#?php echo form() -> checkbox('ftp_upload_id',null, $rows['FTP_UploadId']); ?>
		<td class="content-middle">&nbsp;<#?php echo $no; ?></td>	
		<td align="left" class="content-middle"><b style="color:green;"><#?php echo $rows['FTP_UploadType'];?></td>
		<td align="left" class="content-middle"><b style="color:green;"><#?php echo $rows['FTP_UploadFilename'];?></td>
		<td align="left" class="content-middle right"><#?php echo ($rows['FTP_UploadRows'] ?$rows['FTP_UploadRows']:0); ?></td>
		<td align="left" class="content-middle right"><#?php echo ($rows['FTP_UploadSuccess']?$rows['FTP_UploadSuccess']:0); ?></td>
		<td align="left" class="content-middle right"><#?php echo ($rows['FTP_UploadDuplicate']?$rows['FTP_UploadDuplicate']:0); ?></td>
		<td align="left" class="content-middle right"><#?php echo ($rows['FTP_UploadFailed']?$rows['FTP_UploadFailed']:0); ?></td>
		<td align="left" class="content-middle"><#?php echo $file_existing; ?></td>
		<td align="left" class="content-middle"><#?php echo ($rows['FTP_Flags']?'Show':'Hidden'); ?></td>
		<td align="left" class="content-lasted left"><#?php echo ($rows['FTP_UploadDateTs']?$rows['FTP_UploadDateTs']:'-'); ?></td>
	</tr>	
			
</tbody><#?php
	$no++;
};
?>
</table>

-->




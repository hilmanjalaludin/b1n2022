<?php 

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 $this->load->helpers(array("EUI_Object","EUI_Extendpager")); 
 $pager =& EUI_Extendpager::Instance();
  
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
  $pager->set_role_table($role);
  $pager->set_checkbox_func(true, false);
  $pager->set_source_table($page, $num);
  $pager->set_title_row_content('click row for detail');
  $pager->set_width_table('100%');
  $pager->set_class_table('custom-grid');
  //$pager->select_pager_debug();
  
  
  // 
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
 
  $pager->set_align_cols( array
 (
	'ConfigIDX'     => 'center',
	'ConfigCode' 	=> 'left',
	'ConfigName' 	=> 'left',
	'ConfigValue' 	=> 'left',
	'ConfigFlags'	=> 'center'
  ));

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 

  $pager->set_row_format( array
 (
	'ConfigIDX'     => array('_setCapital','_setBoldColor'),
	'ConfigCode' 	=> array('_setCapital','_setBoldColor'),
	'ConfigFlags'	=> array('_setCapital')
  ));  

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 $pager->set_event_row_click(null);
 
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 $pager->select_pager_content();
 $pager->reset_pager_object();
 
?>
<!--
<table width="100%" class="custom-grid" cellspacing="0">
<thead>
	<tr height="20"> 
		<th nowrap class="custom-grid th-first" width="5%" align="center">&nbsp;<a href="javascript:void(0);" onclick="Ext.Cmp('chk_config').setChecked();">#</a></th>	
		<th nowrap class="custom-grid th-middle center">&nbsp;No</th>	
		<th nowrap class="custom-grid th-middle" align="left"><span class="header_order" id ="a.CallReasonCode" onclick="Ext.EQuery.orderBy(this.id);">Config Code </b></span></th>        
        <th nowrap class="custom-grid th-middle" align="left"><span class="header_order" id ="a.CallReasonDesc" onclick="Ext.EQuery.orderBy(this.id);">Config Name </b></span></th>
		  <th nowrap class="custom-grid th-middle" align="left"><span class="header_order" id ="a.CallReasonDesc" onclick="Ext.EQuery.orderBy(this.id);">Config Value </b></span></th>
		<th nowrap class="custom-grid th-lasted center" align="left"><span class="header_order" id ="a.CallReasonContactedFlag" onclick="Ext.EQuery.orderBy(this.id);">Status</span></th>
	</tr>
</thead>	
<tbody>
<?php
 $no  = $num;
 foreach( $page -> result_assoc() as $rows ) { 
	$color = ($no%2!=0?'#FFFEEE':'#FFFFFF');
?>	
	<tr CLASS="onselect" bgcolor="<?php echo $color;?>">
		<td class="content-first"><input type="checkbox" value="<?php echo $rows['ConfigID']; ?>" name="chk_config" id="chk_config"></td>
		<td class="content-middle center"><?php echo $no ?></td>
		<td class="content-middle"><b><?php echo $rows['ConfigCode']; ?></b></td>
		<td class="content-middle"><?php echo $rows['ConfigName']; ?></td>
		<td class="content-middle"><?php echo $rows['ConfigValue']; ?></td>
		<td class="content-lasted center"><?php echo ($rows['ConfigFlags'] ? 'Actiive':'Not Active'); ?></td>
	</tr>	
</tbody>
	<?php
		$no++;
		};
	?>
</table>->




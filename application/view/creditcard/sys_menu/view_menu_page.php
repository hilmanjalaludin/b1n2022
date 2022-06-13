<?php 
// -------------------------------------------------
 if(!function_exists('_setWordCut') ) {
  function _setWordCut( $text ){
	return _setBreakWord($text, 20);
  }
}

// -------------------------------------------------
 if(!function_exists('_setAgentCut') ) {
  function _setAgentCut( $text ){
	return _setBreakWord($text, 12);
  }
}


// -------------------------------------------------
 if(!function_exists('_setCheckBox') ) {
  function _setCheckBox( $AssignId ='' ){
	$arr = "<a href=\"javascript:void(0);\" ". 
			" onclick=\"Ext.Cmp('$AssignId').setChecked();\" style=\"cursor:pointer;\">".
			"<i class=\"fa fa-check-square\"></i></a>";	
	return (string)$arr;
  }
}

// ---------------------------------------------------------------------------- 
/*
 * @ pack : load helpers
 */
 
 $this->load->helpers(array('EUI_Object','EUI_Page'));
 $arr_obj = new EUI_Object($content_pages);
 
// ---------------------------------------------------------------------------- 
/*
 * @ pack : load helpers
 */
 
 
 $type 	= _get_post('type');
 $orderby = _get_post('orderby');
 $next_order = ($type=='ASC'?'DESC':'ASC');
 
 //$arr_header = $arr_obj->fetch_field();
 
 
// ---------------------------------------------------------------------------- 
/*
 * @ pack : load helpers
 */
 
 $arr_header = array(
	"MenuName" => lang("Menu Name"),
	"MenuGroup" => lang(array("Menu Group")),
    "MenuStatus" => lang(array("Status"))
 ); 
 
// ---------------------------------------------------------------------------- 
/*
 * @ pack : load helpers
 */
 
  $arr_class = array(
    "MenuName" => "content-middle",
	"MenuGroup" => "content-middle",
    "MenuStatus" => "content-lasted"
 ); 
 
// ---------------------------------------------------------------------------- 
/*
 * @ pack : load helpers
 */
   
 $arr_align = array (
    "MenuName" => "left",
	"MenuGroup" => "left",
    "MenuStatus" => "center"
 ); 
 
 
// ---------------------------------------------------------------------------- 
/*
 * @ pack : load helpers
 */
 
$arr_width = array( );
 
// -------------- generate label on grid ----------------> 

echo "<table border=0 cellspacing=1 width=\"99%\">".
	"<tr height=\"30\"> ";
		
		
		echo "<th class=\"ui-corner-top ui-state-default center th-first\" width=\"2%\" nowrap>". _setCheckBox('MenuId')."</th>";
		echo "<th class=\"ui-corner-top ui-state-default center th-middle\" width=\"2%\" nowrap>". lang("label_data_no") ."</th>";
		
		
foreach( $arr_header as $field => $value ){
	if( in_array($orderby, array($field) ))
	{
		echo "<th class=\"ui-corner-top ui-state-default th-middle {$arr_align[$field]}\" width=\"{$arr_width[$field]}\"><span class=\"header_order ".strtolower($type)."\" onclick=\"Ext.DOM.ActionShowMenu({page:0,  orderby:'{$field}', type:'{$next_order}'});\">&nbsp;{$value}</span></th>";
	} else {
		echo "<th class=\"ui-corner-top ui-state-default th-lasted {$arr_align[$field]}\" width=\"{$arr_width[$field]}\"><span class=\"header_order\" title=\"Sort By {$value}\" onclick=\"Ext.DOM.ActionShowMenu({page:0, orderby:'{$field}', type:'{$next_order}' });\">&nbsp;{$value}</span></th>";
	}
}
	
echo "</tr>";

// ---------------- content ----------------

 if( is_array($content_pages) ) 
{ 
 $no = $start_page+1;
 foreach( $content_pages as $num => $rows )
{
 $row = new EUI_Object( $rows );
// @ pack : of list color 
 $back_color = ( $num%2!=0 ? '#FFFFFF' :'#FFFEEE');
 echo " <tr bgcolor=\"{$back_color}\" class=\"onselect\" height=\"35\">";
 echo "<td class=\"content-first\" align=\"center\" nowrap >&nbsp;". form()->checkbox("MenuId", null, $row->get_value('MenuId'))."</td>";	
 echo "<td class=\"content-middle\" nowrap>{$no}</td>";
  
 	
 foreach( array_keys($arr_header) as $k => $fields )
 {
   if(strcmp( $fields, $orderby )== 0 ){
	  echo  "<td class=\"$arr_class[$fields] ui-widget-select-order {$arr_align[$fields]}\" ${arr_wrap[$fields]}>{$row->get_value($fields, $arr_function[$fields])}</td>";
   }else{
	  echo  "<td class=\"$arr_class[$fields] ui-widget-unselect-order {$arr_align[$fields]}\" ${arr_wrap[$fields]}>{$row->get_value($fields,$arr_function[$fields])}</td>";
   }
 }
 
// ---------- on event ------------------------------------------------
	echo "</tr>";
	$no++;	
 }	
 
}

/* @ pack : -------------------------------------------------------
 * @ pack : # get list off page #----------------------------------
 * @ pack : -------------------------------------------------------
 */

 $max_page = 5;
 
// @ pack : start html  

 $_li_create = " <div class='page-web-voice' style='margin-left:-5px;margin-top:2px;border-top:0px solid #FFFEEE;'><ul>";
 
// @ pack : list 
 
 $start =(int)(!$select_pages ? 1: ((($select_pages%$max_page ==0) ? ($select_pages/$max_page) : intval($select_pages/$max_page)+1)-1)*$max_page+1);
 $end   =(int)((($start+$max_page-1)<=$total_pages) ? ($start+$max_page-1) : $total_pages );
	
// @ pack : like here 

 if( $select_pages > 1) 
 {
	$post = (int)(($select_pages)-1);
	$_li_create .="<li class=\"page-web-voice-normal\" onClick=\"Ext.DOM.ActionShowMenu({page: 1, orderby:'${orderby}', type:'${type}'});\" ><a href=\"javascript:void(0);\">&lt;&lt;</a></li>";
		
	$_li_create .="<li class=\"page-web-voice-normal\" onClick=\"Ext.DOM.ActionShowMenu({page: ${post}, orderby:'${orderby}', type:'${type}'});\" ><a href=\"javascript:void(0);\">&lt;</a></li>";
 }

// @ pack : check its 

 if($start>$max_page){
	$_li_create.="<li cclass=\"page-web-voice-normal\"  onClick=\"Ext.DOM.ActionShowMenu({page:(${start}-1), orderby :'${orderby}', type:'${type}'});\" ><a href=\"javascript:void(0);\">...</a></li>";
 }

// @ pack : check its 
 
 for( $p = $start; $p<=$end; $p++)
 { 
	if( $p == $select_pages ){ 
		$_li_create .="<li class=\"page-web-voice-current\" id=\"${p}\" onClick=\"Ext.DOM.ActionShowMenu({page:${p}, orderby :'${orderby}', type:'${type}'});\"> <a href=\"javascript:void(0);\">{$p}</a></li>";
	 } else {
		$_li_create .=" <li class=\"page-web-voice-normal\" id=\"${p}\" onClick=\"Ext.DOM.ActionShowMenu({page:${p}, orderby :'${orderby}', type:'${type}'});\"><a href=\"javascript:void(0);\">{$p}</a></li>";
	}
 }

// @ pack : check its 
  
 if($end<$total_pages){
	$_li_create .="<li class=\"page-web-voice-normal\" onClick=\"Ext.DOM.ActionShowMenu({page:${end}, orderby :'${orderby}', type:'${type}'});\"><a href=\"javascript:void(0);\" >...</a></li>";
 }

// @ pack : check its 
 
 if($select_pages<$total_pages){
	$_li_create .="<li class=\"page-web-voice-normal\" onClick=\"Ext.DOM.ActionShowMenu({page:(${select_pages}+1),  orderby :'${orderby}', type:'${type}'});\"><a href=\"javascript:void(0);\" title=\"Next page\">&gt;</a></li>";
	$_li_create .="<li class=\"page-web-voice-normal\" onClick=\"Ext.DOM.ActionShowMenu({page:${total_pages},orderby :'${orderby}', type:'${type}'});\"><a href=\"javascript:void(0);\" title=\"Last page\">&gt;&gt;</a></li>";
 }
		
// @ pack : check its 
	
 $_li_create .="</ul></div>";
 echo "<tr>".
		"<td colspan='3'>{$_li_create}</td> ".
		"<td colspan='2'style='color:brown;' nowrap>". lang('button_record') ."&nbsp;: <span class='input_text' style='padding:2px;' id='ui-total-pull-record'>{$total_records}</span></td>".
	"</tr>	";
?>

</table>
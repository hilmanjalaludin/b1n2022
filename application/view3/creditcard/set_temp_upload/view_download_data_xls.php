<?php 
$this->load->helper(array('EUI_ExcelWorksheet','EUI_ExcelWorkbookBig')); 
/**
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
$base_xls_path = rtrim(BASEPATH, '/system');
$title_xls_tpl = sprintf("%s_%s.xls", str_replace(" ", "_", $filename), date('YmdHis'));
$file_xls_force = sprintf("%s/application/temp/%s", $base_xls_path, $title_xls_tpl);
 
// load mybook excel 
 $workbook =& new writeexcel_workbookbig($file_xls_force);
 $worksheet =& $workbook->addworksheet();

/* pack header format every file **/
 $header_format =& $workbook->addformat();
 $header_format ->set_bold();
 $header_format->set_size(10);
 $header_format->set_color('white');
 $header_format->set_align('left');
 $header_format->set_align('vcenter');
 $header_format->set_pattern();
 $header_format->set_fg_color('black');

 // get start num 

$row_num = 0; $coll_num = 0;
if(is_array($template)) 
	foreach( $template as $key => $value )
{
	$worksheet->write_string(0, $coll_num, $value, $header_format );
	$coll_num++;
}

$row_num+=1;

// if OK then will the download 
//exit;
 $filetmp = $workbook->_worksheets[0]->filtemp;
 $workbook->close(); // end book  
 if( file_exists($file_xls_force)) {
	header("Pragma: public");
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("Content-Type: application/force-download");
	header("Content-Type: application/octet-stream");
	header("Content-Type: application/download");
	header("Content-type: application/vnd.ms-excel; charset=UTF-16");
	header("Content-Disposition: attachment; filename=". basename( $file_xls_force ));
	header("Content-Transfer-Encoding: binary");
	header("Content-Length: " . filesize($file_xls_force));
	readfile($file_xls_force); 
	ob_clean();
	@unlink($filetmp);
	@unlink($file_xls_force);
}
?>
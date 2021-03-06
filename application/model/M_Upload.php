<?php
/* 
 * @ def 	: class Upload Modul ALL DATA 
 * ----------------------------------------
 *
 * @ author : razaki team 
 * @ param  : class properties 
 */

/*
 * @ update : 2014-08-31 optimize logic method constans
 * -------------------------------------------------------------
 */ 
 
/* set memory iniated  &&  set time exexcute 
 * --------------------------------------------
 */

ini_set("memory_limit",-1);
set_time_limit(3600);

class M_Upload extends EUI_Model 
{

// @private object variable 

 private static $_attributes;
 private static $_request;
 private static $_reportid;
 private static $instance = null;
 
// @singgleton / public static instance
/**
 * Parse out the attributes
 *
 * Some of the functions use this
 *
 * @access	private
 * @param	array
 * @param	bool
 * @return	string
 */
 public static function &instance(){
	if( is_null( self::$instance ) ){
		self::$instance = new self();
	}
	return 	self::$instance;
 } 
 
// @ contruct function  
/**
 * Parse out the attributes
 *
 * Some of the functions use this
 *
 * @access	private
 * @param	array
 * @param	bool
 * @return	string
 */
 function __construct() {
	$this->load->model(array('M_BlackList','M_XDays','M_Tools'));
	
 }

/**
 * Parse out the attributes
 *
 * Some of the functions use this
 *
 * @access	private
 * @param	array
 * @param	bool
 * @return	string
 */

 function _report_log_data( $type='FTP' ) {
	 
	$cok = CK();
	$_insertid = 0;
	$this->db->reset_write();
	$this->db->set('FTP_Recsource', $this->val->field('recsource'));
	$this->db->set('FTP_UploadType', $type);
	$this->db->set('FTP_UploadFilename', $this->pathurls);
	$this->db->set('FTP_UploadBy', $cok->field('Username'));
	$this->db->set('FTP_UploadDateTs', date('Y-m-d H:i:s'));
	
	
	$this->db->insert('t_gn_upload_report_ftp');
	if( $this->db->affected_rows()>0 ) {
		$_insertid = $this->db->insert_id();	
	}
	//else{
	// if( mysql_errno() ){
		// return mysql_error();
	// }	
	//}
	if( $_insertid ){
		self::$_reportid = $_insertid;
	}
	return (int)$_insertid;
 }
 
 
 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */

private function _copy_file() {
	if( !isset(self::$_attributes['fileToupload']['name'])) {
		return false;
	}
	//j ika berhasil terkopy 
	if( copy(self::$_attributes['fileToupload']['tmp_name'], APPPATH . 'temp/'. self::$_attributes['fileToupload']['name'])) {
		return true;
	}
	return false;
} 
 
 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */

function _read_excel_header()
{
	$this->attr = self::$_attributes;
	$this->name = $this->attr['fileToupload']['name'];
	
	// define callback
	
	$callback = null;
	if( !$this->_copy_file() ) {
		$callback = "Failed to copy data ";
	}
	
	//call my reff 
	$selfie =& Singgleton('M_Upload');
	
	// define attr path 
	
	$this->basepath = rtrim( dirname(__FILE__), '/model');
	$this->pathfile = sprintf("%s/temp/%s", $this->basepath, $this->name);
	$this->pathurls = sprintf("%s/%s/temp/%s", rtrim( base_url(), '/'), rtrim( APPPATH, '/'), $this->name);
	
	//var_dump($this->pathfile);
	// read && process data 
	
	$callDataXls = ExcelImport();
	$callDataXls->_ReadData($this->pathfile);
	
	//print_r($callDataXls);
	
	// then will first row data on here 
	$num_row = $callDataXls->rowcount(0);
	$num_col = $callDataXls->colcount(0);
	
	
	// ambil header -nya 
	$num_start = 1;
    while( $num_start <= $num_row ){  
	
		if( $num_start == 1 ){
			for( $icol = 1; $icol <= $num_col; $icol++ ){
				$callback[$icol] = $callDataXls->val( $num_start ,$icol ); 	
			}
			break;
		}	
		// column pertama 
		$num_start++;
	}
	
	//jika hasilnya  = array ? var_dump($callback);
	if( is_array( $callback )){
		return (array)$callback;
	}
	return $callback;
} 


 
 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
function _read_text_header()
{
	$this->attr = self::$_attributes;
	$this->name = $this->attr['fileToupload']['name'];
	
	// define callback
	
	$callback = null;
	$copy = $this->_copy_file();  
	if( !$copy ) {
		$callback = "Failed to copy data ";
	}
	
	//call my reff 
	$selfie =& Singgleton('M_Upload');
	
	// define attr path 
	
	$this->basepath = rtrim( dirname(__FILE__), '/model');
	$this->pathfile = sprintf("%s/temp/%s", $this->basepath, $this->name);
	$this->pathurls = sprintf("%s/%s/temp/%s", rtrim( base_url(), '/'), rtrim( APPPATH, '/'), $this->name);
	
	// read && process data 
	
	$callDataTxt = TextImport();
	$callDataTxt->ReadText($this->pathfile);
	$callDataTxt->setDelimiter($selfie->TplDetail->field('TemplateSparator'));
	$callback = $callDataTxt->getHeader();
	
	// jika hasilnya  = array ?
	if( is_array( $callback )){
		return $callback;
	}
	return $callback;
} 


 
 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 
function _read_table_data() {
	
// reset cache data process OK SIP 
	
 $this->db->reset_select();
 $this->db->select('TemplateTableName');
 $this->db->from('t_gn_template');
 $this->db->where('TemplateId', self::$_request['TemplateId']);
 
 $qry = $this->db->get();
 if( $qry && $qry->num_rows() > 0 ){
	return $qry->result_singgle_value();
 }
 return null;
}
 
 
/*
 * @ def 		: UploadDataExcel
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function _read_column_data()
{
	 
	$_fields = array();
	
	if(isset(self::$_request['TemplateId']) )
	{
		$this -> db ->select('UploadColsName, UploadColsAlias');
		$this -> db ->from('t_gn_detail_template');
		$this -> db ->where('UploadTmpId', self::$_request['TemplateId']);
		$this -> db ->order_by('UploadColsOrder','ASC');
		
		foreach( $this ->db ->get() ->result_assoc() as $rows )
		{
			$_fields[$rows['UploadColsName']] = $rows['UploadColsAlias'];	
		}
	}	
	
	return $_fields;
}


/*
 * @ def 		: UploadDataExcel
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */

function _read_upload_data( $combine = array(), $add_columns = null, $Template = NULL )
{
	
// jika data bukan object 	
	if( !is_object($Template)){
		$Template = Objective($Template);
	}
	
	$result_array  = array();
	
	// type upload data excel mode 1998 - 2013 
	// excel read data only 
	
	$selfie = &Singgleton('M_Upload');
	$extens = $Template->field('TemplateFileType', 'strtolower');
	
	// if file typem is excel 
	// var_dump($extens);
	if( !strcmp( $extens, 'xls' ) ) {
		
	// call lib data excel 	
	
		$Excel =& ExcelImport();
		$Excel->_ReadData( $selfie->pathfile );
			
	 // define size data row excel 
		$xls_row 	= 2;  
		$xls_index 	= 1; 
		$xls_size 	= $Excel->rowcount(0);
		
	// looping data proces 
		
		while( $xls_row <= $xls_size ) {
			$xls_col = 1;
			foreach( $combine as $key => $val ){
				$result_array[$xls_index][$val] = mysql_real_escape_string( $Excel->val( $xls_row, $xls_col )); 
				// print_r($result_array[$xls_index][$val]);
				$xls_col++;
			}
			
	 // add columns data process 
	 
			if( is_array($add_columns) AND count( $add_columns )> 0 )  {
				foreach( $add_columns as $field => $value ){
					$result_array[$xls_index][$field] = $value;
					// print_r($result_array[$xls_index][$field]);
				}
			}
			
			// looping data on bottom
			$xls_index++;  
			$xls_row++; 
		}
	}	
	
	/// type upload data excel mode 1998 - 2013 
	if( !strcmp( $extens, 'txt' ) )  {
		
		$Text =& TextImport();
		$Text->ReadText($selfie->pathfile);
		$Text->setDelimiter($selfie->TplDetail->field('TemplateSparator'));
		
		
		// define data object 
		
		$xls_row 	= 2;  
		$xls_index 	= 1; 
		
	 // total data size of rows 
		
		$xls_size 	= $Text->getCount(0);
		 
		while( $xls_row <= $xls_size )  {
			// main process body data /
			$xls_col = 0;
			foreach( $combine as $key => $val ){
				$result_array[$xls_index][$val] = $Text->getValue( $xls_row, $xls_col ); 
				$xls_col++;
			}
			
			// add data tamabahan jika ada .
			if( is_array($add_columns) AND count($add_columns)> 0 )  {
				foreach( $add_columns as $field => $value ) {
					$result_array[$n][$field] = $value;  	
				}
			}	 
			// looping data on bottom
			$xls_index++;  
			$xls_row++;  
		}
	}	
	
	// return body data .
	 // print_r($result_array);
	 // exit;
	return (array)$result_array;
}
 
/*
 * @ def 		: UploadDataExcel
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
public function UploadDataBucket( $param = null )
{	

 ob_start(); // start over buffer
 
 
 self::$_attributes = $param['file_attribut'];
 self::$_request = $param['request_attribut'];

 $_tables_input = self::_read_table_data();
 if( !is_null(self::$_attributes) ) 
 {
	$Template =& $this -> M_Template -> _getDetailTemplate(self::$_request['TemplateId']);
	$_read_header = ( $Template['TemplateFileType']=='txt' ? self::_read_text_header() : self::_read_excel_header() );
	
	$_read_column = self::_read_column_data();
		
   /*	
	* @ def 	: return callback to client	
	* ------------------------------------------
	* @ if file cant be copy to server directory 
	*	and then will break;
	*/ 
	
	if( !is_array($_read_header) )  { 
		return $_read_header;  break;
	}	
	
   /*	
	* @ def 	: return callback to client	
	* ------------------------------------------
	* @ if templat is not active OR not found on database then must 
	*	be create template ;
	*/ 
	
	else if( !is_array($_read_column) ) {
		return 'Template Not Found.'; break;
	}	
	else 
	{
		$_keys_read_column = array_keys($_read_column);
		$_values_read_columns = array_values($_read_column);
		
		if( count($_read_header) == count($_values_read_columns))
		{
			$_header = array(); $tots = 0; $_totals = 0;
			foreach( $_read_header as $k => $v ) 
			{
				if(in_array(trim($v),$_values_read_columns) ) 
					$tots +=1; 	
				else 
				{
					$_header[$_totals]= array('N'=>$v, 'Y' => $_values_read_columns[$_totals]); 
				}
					
				$_totals++;
			}
			
			
		if(($_totals==$tots) ) {
		
		// then process upload 
				self::_report_log_data('MNL');
				
		// set read class 
		
		($Template['TemplateFileType']=='txt' ? null : ExcelImport() -> _ReadData(APPPATH .'temp/'.self::$_attributes['fileToupload']['name']));
		
		// then read and process 
		
			$pos = 2; $num=1; $data = array(); $_numrows = 0; $_success = 0; $_failed = 0;	$_blacklist = 0; $_duplicate = 0; $xdays = 0;
			$count = ( $Template['TemplateFileType']=='txt' ? TextImport() -> getCount() :  ExcelImport()->rowcount(0));
			
			while( $pos<=$count ) 
			{
				
				$_cols = 0;
				foreach( $_keys_read_column as $k => $v )
				{
					$set_text_value = ( $Template['TemplateFileType']=='txt' ? TextImport()->getValue($pos,$_cols) : ExcelImport() ->val($pos,$_cols));
					if(trim($set_text_value)!=''){
						$data[$pos][$v] = $this->M_Tools->__tools_format($v,$set_text_value); 
					}
					
					$_cols++;
				}
			/*	
			 * @ def 	: additional columns 
			 * ------------------------------------------
			 * @ spesific column if not found on section template
			 *	user must be check data validation  && header is unique
			*/ 
				$data[$pos]['CustomerUploadedTs'] = date('Y-m-d H:i:s');
				$data[$pos]['FTP_UploadId'] = self::$_reportid;
				$data[$pos]['UploadedById'] = $this->EUI_Session->_get_session('UserId');
				
			/*	
			 * @ def 	: insert tables 
			 * ------------------------------------------
			 * @ spesific column if not found on section template
			 *	user must be check data validation  && header is unique
			*/ 
				if( !is_null($_tables_input) ) 
				{
				
				/** cek blacklist == FALSE // not found -***/ 
					
					$M_BlackList =& M_BlackList::get_instance();
					$M_XDays =& M_XDays::get_instance();
					
					if( $M_BlackList -> get_count($data[$pos], self::$_reportid )!=TRUE )
					{
						// cek of the days data interval
						$ExistData = $M_XDays -> X_Existing($data[$pos]);
						if( $ExistData )
						{
							$X_ListDays = $M_XDays -> X_ExistListingDays($data[$pos], $Template);
							if( isset($X_ListDays['diffrent_days']) AND $X_ListDays['diffrent_days'] < 0 )
							{
								// add new interval by tempalate 
								$X_ListingDays = $M_XDays ->X_ListingDays($Template);
								
								$data[$pos]['x_days'] = $X_ListingDays['interval_days'];
								$data[$pos]['Expire_DateTs'] = $X_ListingDays['expired_days'];
								
								// then insert 
								if( $this -> db -> insert( $_tables_input, $data[$pos] ))
									$_success++;
								 else 
								 {
									$_error = $this->db->_error_message(); // get error 
									if( preg_match('/\Dup/i', $_error ) ) 
										$_duplicate++;
									 else
										$_failed++;
								  }
							}
							
							/** cek x-day == FALSE // is found -***/ 
							else{
								 $_failed++;  $xdays++; $_blacklist++;
							}
						} 
						
						/*** start :: X- DAYS : if new data not identified by x-days **/
						else  
						{
							// add new interval by tempalate 
							$X_ListingDays = $M_XDays ->X_ListingDays($Template);
							$data[$pos]['x_days'] = $X_ListingDays['interval_days'];
							$data[$pos]['Expire_DateTs'] = $X_ListingDays['expired_days'];
							
							if( $this -> db -> insert($_tables_input,$data[$pos]) ) 
								$_success++;  
							else
							{
								$_error = $this->db->_error_message(); 
								$_failed++; 
							}
						}		
					 }	
					  
					 /** cek blacklist == FALSE // is found -***/ 
					  else 
					  {
						 $_failed++; 
						 $_blacklist++;
					   }
					}
					
					$pos++; $num++;
				}
				
			// save all data to info ***
			
				$ftp['FTP_UploadRows']  	= $num;
				$ftp['FTP_UploadFailed'] 	= $_failed;
				$ftp['FTP_UploadBlacklist'] = $_blacklist;
				$ftp['FTP_UploadSuccess'] 	= $_success;
				$ftp['FTP_UploadDateTs'] 	= date('Y-m-d H:i:s');
				
				if( $this -> db -> update('t_gn_upload_report_ftp',$ftp, array('FTP_UploadId'=>self::$_reportid) )){
					$_done = "OK";
				}
				
				$_conds = array(0=>array( 'N' => $_failed,  'Y' => $_success, 'B' => $_blacklist,  'D' => $_duplicate, 'X' => $xdays ));
				return $_conds;
			}
   /*	
	* @ def 	: return callback to client	
	* ------------------------------------------
	* @ spesific column if not found on section template
	*	user must be check data validation  && header is unique
	*/ 
			else
			{
				return $_header;
			}	
		}
   /*	
	* @ def 	: return callback to client	
	* ------------------------------------------
	* @ header column on DB not match with Tempalate selected  
	*	data upload Or data source 
	*/ 
			else
			{
				return 'Column identification not match. Please check your file.';
				break;
			}
		}
	}
	else
	{
		return 'No paramater included .';
	}	
	
	// end buffer 
	ob_end_clean();
}
 
/**
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
  
function setRegulerUpload( $result_array =null, $add_columns=null )
{
	ob_start();
	
	self::$_attributes = $result_array['file_attribut'];
	self::$_request = $result_array['request_attribut'];
	
// this 
 
	$this->val = Objective( $result_array['request_attribut'] );	
	 
  // convert data on proces segmenttation.
	
	$this->TemplateName = $this->_read_table_data();
	$this->TemplateId = $this->val->field('TemplateId');
	
 // default nilai pertama kondisi.	
	$this->callBackCond	= FALSE;
	if(!is_null( self::$_attributes ) )
	{
		
		
	// convert to object data on detail Tempalate 
	// on here OK 
	
		$this->TplDetail = Objective( Singgleton("M_Template")->_getDetailTemplate( $this->TemplateId) );
		
	// call may class libs 	
		$this->UplClass  = Singgleton("M_Template")->_getTemplateModul( $this->TemplateId ); 
		

	
	 // select modul class then newer this class 	
		if( strlen( $this->UplClass ) ) {
			$this->load->upload( $this->UplClass );
		}
		
	 // check apakah klass itu ada atau tidak ada jika tidak ada 
	 // di keluarkan aletr -nya .
	 
		if( !class_exists( $this->UplClass ) ) {
				$this->_rename_file_upload();
				return sprintf("\n\rmodul class <%s> not_found.", $this->UplClass);
			break;
		}
		
		
	// wil the check type off file 
		$this->TempalateTypeId = $this->TplDetail->field('TemplateFileType', array('strtoupper'));
		
		// case cade on file type on here TEXT 		
		if( !strcmp( $this->TempalateTypeId, TEXT )){
			//printf("my file is %s\n\r", $this->TempalateTypeId);
			$this->ExcelHeader = array_map( 'trim', $this->_read_text_header() );
			$this->TemplColumn = array_map( 'trim', $this->_read_column_data() );
		}
		
		// case cade on file type on here EXCEL 
 
		if( !strcmp( $this->TempalateTypeId, EXCEL))	{
			//printf("my file is %s\n\r", $this->TempalateTypeId);
			$this->ExcelHeader = array_map( 'trim', $this->_read_excel_header() );
			$this->TemplColumn = array_map( 'trim', $this->_read_column_data() );
		}
		
		// case cade on file type on here CSV 
			
		if( !strcmp( $this->TempalateTypeId, CSV))	{
			//printf("my file is %s\n\r", $this->TempalateTypeId);
			$this->ExcelHeader = array_map( 'trim', $this->_read_text_header() );
			$this->TemplColumn = array_map( 'trim', $this->_read_column_data() );
		}
	
		// data upload tidak complete ?? 
		if( !is_array($this->TemplColumn) OR is_null($this->TemplColumn) )   {
			$this->_rename_file_upload();		
			return 'Template not found.';
			break;
		}
		
		
	// apakah data heeader string varchar(200) ?
	   if( is_string( $this->ExcelHeader ) ) {
			$this->_rename_file_upload();
			return $this->ExcelHeader;
			break;
	   }   
		
	 // pack : is match of upload with exist templates 
	 // modern process upload literature on enigma colllection
	 
	  $this->total_header  = count($this->ExcelHeader);
	  $this->total_column  = count($this->TemplColumn);
		
	// jika jumlah yang di database tidak sama dengan yg 
	// di upload .
	   // var_dump($this->total_header);
	   // var_dump($this->total_column);
	  
	   if( $this->total_header < $this->total_column ) {
			$this->_rename_file_upload();
			return sprintf("\n\rColumn on <%s> {%s} --> template {%s}\nIdentification not match. Please check your file.", 
							$this->TempalateTypeId,  
							$this->total_header,  
							$this->total_column ); 
			break;
		}
		
	// kemudian bandingkan label dan kolomnya pakah benar2 
	// sama atau justru malah tidak sama .
	
		$this->LabelMatch = false; 
		$this->LabelMatch = Singgleton('M_Template')->_getMatch( $this->ExcelHeader, $this->TemplColumn , TRUE );
		//var_dump($this->LabelMatch);
		
		if( !is_bool( $this->LabelMatch ) )
		{
			$this->_rename_file_upload(); // rename 
			
			// define data process You OK 
			
			$this->file = self::$_attributes['fileToupload']['name'];
			$this->stsz = count($this->TemplColumn);
			$this->size = count($this->LabelMatch);
			
			// catat setiap error yang di dapat.
			$this->msg = array();
			$this->msg[]= sprintf("\n\rYou <%s> not have {%s}  label in file :\n\r<%s> :\n\r",
								 $this->TempalateTypeId,   $this->size,  $this->file );
			
			$i = 1;
			foreach( $this->LabelMatch as $key => $label ) { 
				$this->msg[] = sprintf("%s # %s\n\r", $i, $label);
				$i++;
			}
			
			 $this->msg[] = "\n\r";
			 $this->msg[] = sprintf("minimum %s label must match.\n\rPlease chek you file", $this->stsz);
			
			return join('', $this->msg);
			break;
		 }
		 
		 
		 
	// set order field by process OK 
	
		 $LabelOrder = Singgleton('M_Template')->_getOrder( $this->ExcelHeader, $this->TemplColumn, TRUE );
		 if( !$LabelOrder )  {
				$this->_rename_file_upload();
			return $LabelOrder;
			break;
			
		 }
		 
	  // validation again 
	   
	    $this->rowData = array();
		$this->rowData = $this->_read_upload_data( array_keys($this->TemplColumn), array(), $this->TplDetail );
		 
		if( !count( $this->rowData ) ) {
			$this->_rename_file_upload();
			return '\n\rData empty .';
			break;
		}	
		
		
	// yes will call this function upload .
	
		$this->Uploader = call_user_func(array($this->UplClass, "Instance"));
		if( !is_object( $this->Uploader ) )  {
			$this->_rename_file_upload();
			return sprintf("\n\rNo call_user_func %s::Instance.", $this->UplClass);
			break;
		}
			
	// generate log first :: Upload Data ID Global 
	// generate upload ID
	
	    $this->ReportId = self::_report_log_data('IGT');  
		
		if( !$this->ReportId ) {
			$this->_rename_file_upload();
			return sprintf("Failed !\n\rPlease input other Recsource No OR %s", mysql_error());
			break;
		} 
	// then sent data attribute to object class Upload idetification
	
		$this->Uploader->_set_uploadId( $this->ReportId ); 
		$this->Uploader->_set_expired_date($this->val->field('expireddate', array('SetDate') ));
		$this->Uploader->_set_recsource($this->val->field('recsource', array('SetCapital') )); 
		$this->Uploader->_set_campaignId($this->val->field('CampaignId', array('SetCapital')));
		$this->Uploader->_set_table( $this->TemplateName);
		$this->Uploader->_set_content( $this->rowData);
		
	// if data is complete proces data .
		
		if( $this->Uploader->_get_is_complete() ) {
			$this->Uploader->_set_process( $this->rowData );
		}
		
	 // pack : result object   
	 
		$this->callBackCond = false;
		$this->callBackData = $this->Uploader->_get_class_callback();
		if( is_object( $this->callBackData ) )
		{
		  // push to the DB 
			
			$this->db->reset_write();
			$this->db->set('FTP_UploadRows',	   $this->callBackData->TOTAL_UPLOAD );
			$this->db->set('FTP_UploadSuccess',    $this->callBackData->TOTAL_SUCCES);
			$this->db->set('FTP_UploadFailed', 	   $this->callBackData->TOTAL_FAILED);
			$this->db->set('FTP_UploadDuplicate',  $this->callBackData->TOTAL_DUPLICATE);
			$this->db->set('FTP_UploadEndDateTs',  date('Y-m-d H:i:s'));
			$this->db->where('FTP_UploadId', 	   $this->ReportId);
			$this->db->update('t_gn_upload_report_ftp');
		// rename file with name not failed  
		
			if(($this->db->affected_rows() > 0)) {
				$this->_rename_file_upload(TRUE);
				$this->callBackCond = TRUE;
			}else{
				echo mysql_error();
			}
			
		}
		
	 // @ pack : if not read and insert to table.  	
	 
		 $this->callResponseData = array();
		 if( $this->callBackCond = FALSE 
			OR $this->callBackCond = TRUE )
		{
			// set data row process on here OK 
			 $this->callResponseData['R'] = $this->callBackData->TOTAL_UPLOAD;
			 $this->callResponseData['N'] = $this->callBackData->TOTAL_FAILED;
			 $this->callResponseData['Y'] = $this->callBackData->TOTAL_SUCCES;
			 $this->callResponseData['V'] = $this->callBackData->TOTAL_SUCCES_VERIFICATION;
			 $this->callResponseData['D'] = $this->callBackData->TOTAL_DUPLICATE;
			 $this->callResponseData['B'] = $this->callBackData->TOTAL_BLACKLIST;
			 $this->callResponseData['X'] = $this->callBackData->TOTAL_EXPIRED;
		}
		// return callback to client Site:
		return (array)$this->callResponseData;
	}
	
	ob_end_clean();
}
	
 /**
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
function setInsertUpload( $result_array =null, $add_columns=null )
{
	ob_start();
	
	self::$_attributes = $result_array['file_attribut'];
	self::$_request = $result_array['request_attribut'];
	
// this 
 
	$this->val = Objective( $result_array['request_attribut'] );	
  // convert data on proces segmenttation.
	
	$this->TemplateName = $this->_read_table_data();
	$this->TemplateId = $this->val->field('TemplateId');
	
 // default nilai pertama kondisi.	
	$this->callBackCond	= FALSE;
	if(!is_null( self::$_attributes ) )
	{
		
		
	// convert to object data on detail Tempalate 
	// on here OK 
	
		$this->TplDetail = Objective( Singgleton("M_Template")->_getDetailTemplate( $this->TemplateId) );
		
	// call may class libs 	
		$this->UplClass  = Singgleton("M_Template")->_getTemplateModul( $this->TemplateId ); 
		

	
	 // select modul class then newer this class 	
		if( strlen( $this->UplClass ) ) {
			$this->load->upload( $this->UplClass );
		}
		
	 // check apakah klass itu ada atau tidak ada jika tidak ada 
	 // di keluarkan aletr -nya .
	 
		if( !class_exists( $this->UplClass ) ) {
				$this->_rename_file_upload();
				return sprintf("\n\rmodul class <%s> not_found.", $this->UplClass);
			break;
		}
		
		
	// wil the check type off file 
		$this->TempalateTypeId = $this->TplDetail->field('TemplateFileType', array('strtoupper'));
		
		// case cade on file type on here TEXT 		
		if( !strcmp( $this->TempalateTypeId, TEXT )){
			//printf("my file is %s\n\r", $this->TempalateTypeId);
			$this->ExcelHeader = array_map( 'trim', $this->_read_text_header() );
			$this->TemplColumn = array_map( 'trim', $this->_read_column_data() );
		}
		
		// case cade on file type on here EXCEL 
 
		if( !strcmp( $this->TempalateTypeId, EXCEL))	{
			//printf("my file is %s\n\r", $this->TempalateTypeId);
			$this->ExcelHeader = array_map( 'trim', $this->_read_excel_header() );
			$this->TemplColumn = array_map( 'trim', $this->_read_column_data() );
		}
		
		// case cade on file type on here CSV 
			
		if( !strcmp( $this->TempalateTypeId, CSV))	{
			//printf("my file is %s\n\r", $this->TempalateTypeId);
			$this->ExcelHeader = array_map( 'trim', $this->_read_text_header() );
			$this->TemplColumn = array_map( 'trim', $this->_read_column_data() );
		}
	
		// data upload tidak complete ?? 
		if( !is_array($this->TemplColumn) OR is_null($this->TemplColumn) )   {
			$this->_rename_file_upload();		
			return 'Template not found.';
			break;
		}
		
		
	// apakah data heeader string varchar(200) ?
	   if( is_string( $this->ExcelHeader ) ) {
			$this->_rename_file_upload();
			return $this->ExcelHeader;
			break;
	   }   
		
	 // pack : is match of upload with exist templates 
	 // modern process upload literature on enigma colllection
	 
	  $this->total_header  = count($this->ExcelHeader);
	  $this->total_column  = count($this->TemplColumn);
		
	// jika jumlah yang di database tidak sama dengan yg 
	// di upload .
	   // var_dump($this->total_header);
	   // var_dump($this->total_column);
	  
	   if( $this->total_header < $this->total_column ) {
			$this->_rename_file_upload();
			return sprintf("\n\rColumn on <%s> {%s} --> template {%s}\nIdentification not match. Please check your file.", 
							$this->TempalateTypeId,  
							$this->total_header,  
							$this->total_column ); 
			break;
		}
		
	// kemudian bandingkan label dan kolomnya pakah benar2 
	// sama atau justru malah tidak sama .
	
		$this->LabelMatch = false; 
		$this->LabelMatch = Singgleton('M_Template')->_getMatch( $this->ExcelHeader, $this->TemplColumn , TRUE );
		//var_dump($this->LabelMatch);
		
		if( !is_bool( $this->LabelMatch ) )
		{
			$this->_rename_file_upload(); // rename 
			
			// define data process You OK 
			
			$this->file = self::$_attributes['fileToupload']['name'];
			$this->stsz = count($this->TemplColumn);
			$this->size = count($this->LabelMatch);
			
			// catat setiap error yang di dapat.
			$this->msg = array();
			$this->msg[]= sprintf("\n\rYou <%s> not have {%s}  label in file :\n\r<%s> :\n\r",
								 $this->TempalateTypeId,   $this->size,  $this->file );
			
			$i = 1;
			foreach( $this->LabelMatch as $key => $label ) { 
				$this->msg[] = sprintf("%s # %s\n\r", $i, $label);
				$i++;
			}
			
			 $this->msg[] = "\n\r";
			 $this->msg[] = sprintf("minimum %s label must match.\n\rPlease chek you file", $this->stsz);
			
			return join('', $this->msg);
			break;
		 }
		 
		 
		 
	// set order field by process OK 
	
		 $LabelOrder = Singgleton('M_Template')->_getOrder( $this->ExcelHeader, $this->TemplColumn, TRUE );
		 if( !$LabelOrder )  {
				$this->_rename_file_upload();
			return $LabelOrder;
			break;
			
		 }
		 
	  // validation again 
	   
	    $this->rowData = array();
		$this->rowData = $this->_read_upload_data( array_keys($this->TemplColumn), array(), $this->TplDetail );
		 
		if( !count( $this->rowData ) ) {
			$this->_rename_file_upload();
			return '\n\rData empty .';
			break;
		}	
		
		
	// yes will call this function upload .
	
		$this->Uploader = call_user_func(array($this->UplClass, "Instance"));
		if( !is_object( $this->Uploader ) )  {
			$this->_rename_file_upload();
			return sprintf("\n\rNo call_user_func %s::Instance.", $this->UplClass);
			break;
		}
			
	// generate log first :: Upload Data ID Global 
	// generate upload ID
	
	    $this->ReportId = self::_report_log_data('IGT');  
		if( !$this->ReportId ) {
			$this->_rename_file_upload();
			return "Failed !\n\rPlease input other Recsource No";
			break;
		} 
	// then sent data attribute to object class Upload idetification
	
		$this->Uploader->_set_uploadId( $this->ReportId ); 
		$this->Uploader->_set_expired_date($this->val->field('expireddate', array('SetDate') ));
		$this->Uploader->_set_recsource($this->val->field('recsource', array('SetCapital') )); 
		$this->Uploader->_set_campaignId($this->val->field('CampaignId', array('SetCapital')));
		$this->Uploader->_set_table( $this->TemplateName);
		$this->Uploader->_set_content( $this->rowData);
		
	// if data is complete proces data .
		
		if( $this->Uploader->_get_is_complete() ) {
			$this->Uploader->_set_process( $this->rowData );
		}
		
	 // pack : result object   
	 
		$this->callBackCond = false;
		$this->callBackData = $this->Uploader->_get_class_callback();
		//print_r($this->callBackData);
		//die();
		if( is_object( $this->callBackData ) )
		{
		  // push to the DB 
			
			$this->db->reset_write();
			$this->db->set('FTP_UploadRows',	   $this->callBackData->TOTAL_UPLOAD );
			$this->db->set('FTP_UploadSuccess',    $this->callBackData->TOTAL_SUCCES);
			$this->db->set('FTP_UploadFailed', 	   $this->callBackData->TOTAL_FAILED);
			$this->db->set('FTP_UploadDuplicate',  $this->callBackData->TOTAL_DUPLICATE);
			$this->db->set('FTP_UploadEndDateTs',  date('Y-m-d H:i:s'));
			$this->db->where('FTP_UploadId', 	   $this->ReportId);
			$this->db->update('t_gn_upload_report_ftp');
		// rename file with name not failed  
		
			if(($this->db->affected_rows() > 0)) {
				$this->_rename_file_upload(TRUE);
				$this->callBackCond = TRUE;
			}else{
				echo mysql_error();
			}
			
		}
		
	 // @ pack : if not read and insert to table.  	
	 
		 $this->callResponseData = array();
		 if( $this->callBackCond = FALSE 
			OR $this->callBackCond = TRUE )
		{
			// set data row process on here OK 
			 $this->callResponseData['R'] = $this->callBackData->TOTAL_UPLOAD;
			 $this->callResponseData['N'] = $this->callBackData->TOTAL_FAILED;
			 $this->callResponseData['Y'] = $this->callBackData->TOTAL_SUCCES;
			 $this->callResponseData['V'] = $this->callBackData->TOTAL_SUCCES_VERIFICATION;
			 $this->callResponseData['D'] = $this->callBackData->TOTAL_DUPLICATE;
			 $this->callResponseData['B'] = $this->callBackData->TOTAL_BLACKLIST;
			 $this->callResponseData['X'] = $this->callBackData->TOTAL_EXPIRED;
		} else {
			$this->callResponseData['R'] = 'ngok';
		}
		// return callback to client Site:
		return (array)$this->callResponseData;
	}
	
	ob_end_clean();
}
 
 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
function setUpdateUpload($result_array =null, $add_columns=null ) {

	ob_start();
	self::$_attributes = $result_array['file_attribut'];
	self::$_request = $result_array['request_attribut'];
	
	$this->val = Objective( $result_array['request_attribut'] );	

	$this->TemplateName = $this->_read_table_data();
	$this->TemplateId = $this->val->field('TemplateId');
	
	$this->callBackCond	= FALSE;
	if(!is_null( self::$_attributes )){
		$this->TplDetail = Objective( Singgleton("M_Template")->_getDetailTemplate( $this->TemplateId) );
		$this->UplClass  = Singgleton("M_Template")->_getTemplateModul( $this->TemplateId ); 
		
		if( strlen( $this->UplClass ) ) {
			$this->load->upload( $this->UplClass );
		}
		
		if( !class_exists( $this->UplClass ) ) {
			$this->_rename_file_upload();
			return sprintf("\n\rmodul class <%s> not_found.", $this->UplClass);
			break;
		}

		$this->TempalateTypeId = $this->TplDetail->field('TemplateFileType', array('strtoupper'));
		// case cade on file type on here TEXT 		
		if( !strcmp( $this->TempalateTypeId, TEXT )){
			//printf("my file is %s\n\r", $this->TempalateTypeId);
			$this->ExcelHeader = array_map( 'trim', $this->_read_text_header() );
			$this->TemplColumn = array_map( 'trim', $this->_read_column_data() );
		}
		// case cade on file type on here EXCEL
		if( !strcmp( $this->TempalateTypeId, EXCEL))	{
			//printf("my file is %s\n\r", $this->TempalateTypeId);
			$this->ExcelHeader = array_map( 'trim', $this->_read_excel_header() );
			$this->TemplColumn = array_map( 'trim', $this->_read_column_data() );
		}
		// case cade on file type on here CSV 		
		if( !strcmp( $this->TempalateTypeId, CSV))	{
			//printf("my file is %s\n\r", $this->TempalateTypeId);
			$this->ExcelHeader = array_map( 'trim', $this->_read_text_header() );
			$this->TemplColumn = array_map( 'trim', $this->_read_column_data() );
		}
		// data upload tidak complete ?? 
		if( !is_array($this->TemplColumn) OR is_null($this->TemplColumn) )   {
			$this->_rename_file_upload();		
			return 'Template not found.';
			break;
		}
		
		// apakah data heeader string varchar(200) ?
		if( is_string( $this->ExcelHeader ) ) {
			$this->_rename_file_upload();
			return $this->ExcelHeader;
			break;
		}   
		
		// pack : is match of upload with exist templates 
		// modern process upload literature on enigma colllection
	 
		$this->total_header  = count($this->ExcelHeader);
		$this->total_column  = count($this->TemplColumn);
		
		// jika jumlah yang di database tidak sama dengan yg 
		// di upload .
	 
		// printf("%s => %s", $this->total_header, $this->total_column);
		if( $this->total_header < $this->total_column ) {
			$this->_rename_file_upload();
			return sprintf("\n\rColumn on <%s> {%s} --> template {%s}\nIdentification not match. Please check your file.", 
							$this->TempalateTypeId,  
							$this->total_header,  
							$this->total_column ); 
			break;
		}
		
		// kemudian bandingkan label dan kolomnya pakah benar2 
		// sama atau justru malah tidak sama .
		
		$this->LabelMatch = false; 
		$this->LabelMatch = Singgleton('M_Template')->_getMatch( $this->ExcelHeader, $this->TemplColumn , TRUE );
		if( !is_bool( $this->LabelMatch ) ) {
			$this->_rename_file_upload(); // rename 
			
			// define data process You OK
			$this->file = self::$_attributes['fileToupload']['name'];
			$this->stsz = count($this->TemplColumn);
			$this->size = count($this->LabelMatch);
			
			// catat setiap error yang di dapat.
			$this->msg = array();
			$this->msg[]= sprintf("\n\rYou <%s> not have {%s}  label in file :\n\r<%s> :\n\r",
								 $this->TempalateTypeId,   $this->size,  $this->file );
			
			$i = 1;
			foreach( $this->LabelMatch as $key => $label ) { 
				$this->msg[] = sprintf("%s # %s\n\r", $i, $label);
				$i++;
			}
			
			$this->msg[] = "\n\r";
			$this->msg[] = sprintf("minimum %s label must match.\n\rPlease chek you file", $this->stsz);
			
			return join('', $this->msg);
			break;
		}
 
		// set order field by process OK 
	
		$LabelOrder = Singgleton('M_Template')->_getOrder( $this->ExcelHeader, $this->TemplColumn, TRUE );
		if( !$LabelOrder )  {
			$this->_rename_file_upload();
			return $LabelOrder;
			break;
		}
		 
		// validation again
		$this->rowData = array();
		$this->rowData = $this->_read_upload_data( array_keys($this->TemplColumn), array(), $this->TplDetail );
		 
		if( !count( $this->rowData ) ) {
			$this->_rename_file_upload();
			return '\n\rData empty .';
			break;
		}	
		
		$this->Uploader = call_user_func(array($this->UplClass, "Instance"));
		if( !is_object( $this->Uploader ) )  {
			$this->_rename_file_upload();
			return sprintf("\n\rNo call_user_func %s::Instance.", $this->UplClass);
			break;
		}
			
		// generate log first :: Upload Data ID Global 
		// generate upload ID
		$this->ReportId = self::_report_log_data('UGT');  
		if( !$this->ReportId ) {
			$this->_rename_file_upload();
			return "Failed !\n\rPlease input other Recsource No";
			break;
		} 
		
		// then sent data attribute to object class Upload idetification
		$this->Uploader->_set_uploadId( $this->ReportId ); 
		$this->Uploader->_set_expired_date($this->val->field('expireddate', array('SetDate') ));
		$this->Uploader->_set_recsource($this->val->field('recsource', array('SetCapital') )); 
		$this->Uploader->_set_campaignId($this->val->field('CampaignId', array('SetCapital')));
		$this->Uploader->_set_table( $this->TemplateName);
		$this->Uploader->_set_content( $this->rowData);
		
		// if data is complete proces data .
		if( $this->Uploader->_get_is_complete() ) {
			$this->Uploader->_set_process( $this->rowData );
		}
		
		// pack : result object
		$this->callBackCond = false;
		$this->callBackData = $this->Uploader->_get_class_callback();
		if( is_object( $this->callBackData ) ){
		  // push to the DB 
			
			$this->db->reset_write();
			$this->db->set('FTP_UploadRows',	   $this->callBackData->TOTAL_UPLOAD );
			$this->db->set('FTP_UploadSuccess',    $this->callBackData->TOTAL_SUCCES);
			$this->db->set('FTP_UploadFailed', 	   $this->callBackData->TOTAL_FAILED);
			$this->db->set('FTP_UploadDuplicate',  $this->callBackData->TOTAL_DUPLICATE);
			$this->db->set('FTP_UploadEndDateTs',  date('Y-m-d H:i:s'));
			$this->db->where('FTP_UploadId', 	   $this->ReportId);
			$this->db->update('t_gn_upload_report_ftp');
		// rename file with name not failed  
		
			if(($this->db->affected_rows() > 0)) {
				$this->_rename_file_upload(TRUE);
				$this->callBackCond = TRUE;
			}else{
				echo mysql_error();
			}
			
		}
		
	 // @ pack : if not read and insert to table.  	
	 
		 $this->callResponseData = array();
		 if( $this->callBackCond = FALSE 
			OR $this->callBackCond = TRUE )
		{
			// set data row process on here OK 
			 $this->callResponseData['R'] = $this->callBackData->TOTAL_UPLOAD;
			 $this->callResponseData['N'] = $this->callBackData->TOTAL_FAILED;
			 $this->callResponseData['Y'] = $this->callBackData->TOTAL_SUCCES;
			 $this->callResponseData['V'] = $this->callBackData->TOTAL_SUCCES_VERIFICATION;
			 $this->callResponseData['D'] = $this->callBackData->TOTAL_DUPLICATE;
			 $this->callResponseData['B'] = $this->callBackData->TOTAL_BLACKLIST;
			 $this->callResponseData['X'] = $this->callBackData->TOTAL_EXPIRED;
		}
		// return callback to client Site:
		return (array)$this->callResponseData;
	}
	
	ob_end_clean();
	
/*
  self::$_attributes = $_array['file_attribut'];
  self::$_request = $_array['request_attribut'];
	
  $template_name_table = self::_read_table_data();
  
  if( !is_null(self::$_attributes) )
  {
	$_read_excel_header = self::_read_excel_header();
	$_read_column_data  = self::_read_column_data();
	
	if( is_array($_read_excel_header) AND is_array($_read_column_data) ) 
	{
		if( (count($_read_excel_header) == count($_read_column_data))  )
		{
			$is_match =& M_Template::_getMatch($_read_excel_header, $_read_column_data);
			if( !is_array($is_match) AND $is_match!=FALSE )
			{
				$is_order =& M_Template::_getOrder($_read_excel_header, $_read_column_data);
				$is_keys  =& M_Template::_getKeys(self::$_request['TemplateId']);
				
				if( !is_array($is_order) AND $is_order!=FALSE ) 
				{
					$result =& self::_read_upload_data( array_keys($_read_column_data), $add_columns);
					if(count($result) > 0 ) 
					{
						self::_report_log_data('UGT'); // insert global tables;
						
						$_success = 0; $_failed = 0; $_duplicate = 0;  $num =1; 
						foreach( $result as $k => $data)
						{
							foreach($data as $cols => $value) {
								if(in_array($cols, $is_keys))
									$this -> db -> where($cols, $value);
								else
									$this -> db -> set($cols, $value);
							}
							
							$this->db->update($template_name_table);
							
							if( $this->db->affected_rows() > 0)
							{
								if( $this -> db -> update('t_gn_upload_report_ftp',array(
									'FTP_UploadRows' 	=> $num,
									'FTP_UploadSuccess' => ($_success+1),
									'FTP_UploadDateTs' 	=> date('Y-m-d H:i:s')
									), 
									array('FTP_UploadId'=>self::$_reportid )))
								{
									$_success++; 
								}
							}
							else
							{
								$_error = $this->db->_error_message(); // get error 
								if( $this -> db -> update('t_gn_upload_report_ftp',array(
									'FTP_UploadRows' 	=> $num,
									'FTP_UploadFailed' 	=> ($_failed+1),
									'FTP_UploadDateTs' 	=> date('Y-m-d H:i:s')
									), 
									array('FTP_UploadId'=>self::$_reportid )))
								{
									if( preg_match('/\Dup/i',$_error ) ) $_duplicate++;
									else
										$_failed++;
								}
							}
							
							$num++;
						}
						
						$_conds = array(0=>array('N' => $_failed, 'Y' => $_success));
						return $_conds;
					}
					else { return 'Data empty .'; }
				}
				else { return $is_order; }
			}
			else { return $is_match; }
		}
		// column not match 
		else 
		{	 
			return 'Column identification not match. Please check your file.'; 
			break;
		}
	}
	
	// cek avail template 
	else
	{
		return 'Tempalate not found.';
		break;
	}
	
  }
  
  */
  
  
}

 /* FROM BNILIFE AMAR <COPAS> :D */
 public function FileExploits( $file_name  = null, $strict = null )
{
	$arrs_filename = null;
	$arr_files_process = explode(".", $file_name);
	
	if( is_array($arr_files_process))
	{
		if( is_null($strict) ){
			$arrs_filename = date('Y-m-dHi') ."_". $arr_files_process[0] . "." .$arr_files_process[count($arr_files_process)-1];
		} else {
			$arrs_filename = date('Y-m-dHi') ."_". $strict ."_". $arr_files_process[0] . "." .$arr_files_process[count($arr_files_process)-1];
		}	
	}
	
	$this->_FileExploits =  $arrs_filename;
	return $this->_FileExploits;
 }
 
  protected function _rename_file_upload( $conds = FALSE )
{
  
  $file_upload = self::$_attributes['fileToupload']['name'];
   
   if( $conds ) 
  {
	 $file_restruct = self::FileExploits( $file_upload );
	 $file_original = APPPATH . "temp/$file_upload";
	 $file_destination = APPPATH . "temp/$file_restruct";
	 
	 // cek file exist 
	 
	 if( file_exists($file_original) ) 
	 {
		rename( $file_original, $file_destination);
	 }
	 
  } 
  else 
  {
	$file_restruct = self::FileExploits( $file_upload, "failed");
	$file_original = APPPATH . "temp/$file_upload";
	$file_destination = APPPATH . "temp/$file_restruct";
	
	if( file_exists($file_original) ) 
	{
		rename( $file_original, $file_destination);
	 }
	 
  }
   
   
} 
 
}	
?>
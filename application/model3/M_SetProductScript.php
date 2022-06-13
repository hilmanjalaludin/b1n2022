<?php
/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
class M_SetProductScript extends EUI_Model
{
	
var $set_limit_page = 10;
/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
private static $Instance   = null; 
 public static function &Instance()
{
	if( is_null(self::$Instance) ){
		self::$Instance = new self();
	}	
	return self::$Instance;
}

/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
function __construct() {
  $this->load->model(array('M_SetProduct','M_SetPrefix'));
}

/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
function _get_default()
{
 // ------------------------------------------------------	
  
  $out  = new EUI_Object(_get_all_request());
  
 // ------------------------------------------------------

 
 $this->EUI_Page->_setPage($this->set_limit_page); 
 $this->EUI_Page->_setSelect("a.ScriptId");
 $this->EUI_Page->_setFrom("t_gn_product_script a");
 $this->EUI_Page->_setJoin("t_gn_product_master b", "a.ProductId=b.ProductId","LEFT", true);
 
 // --------------- set filter ----------------------
 
 $this->EUI_Page->_setAndCache("a.ProductId", "script_product_id", true);
 $this->EUI_Page->_setAndCache("a.UploadBy", "script_user_id", true);
 $this->EUI_Page->_setAndCache("a.ScriptFlagStatus", "script_status", true);
 $this->EUI_Page->_setLikeCache("b.ProductName", "script_product_name", true);
 $this->EUI_Page->_setLikeCache("a.Description", "script_product_title", true);
 $this->EUI_Page->_setLikeCache("a.ScriptFileName", "script_file_name", true);
 
 //echo $this->EUI_Page->_getCompiler();
 return $this->EUI_Page;
 
}

/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
 
function _get_content()
{

 // ------------------------------------------------------	
  
  $out  = new EUI_Object(_get_all_request());
  
 // ------------------------------------------------------

  $this->EUI_Page->_setPage($this->set_limit_page);	
  $this->EUI_Page->_postPage(_get_post('v_page') );
  $this->EUI_Page->_setArraySelect(array(
	"a.ScriptId as ScriptId" => array("ScriptId", "ScriptId", "primary"),
	"b.ProductCode as ProductCode" => array("ProductCode","Product Code"), 
	"b.ProductName as ProductName" => array("ProductName", "Product Name"),
	"a.Description as Description" => array("Description", "Title"),
	"a.ScriptFileName as ScriptFileName" => array("ScriptFileName", "File Name"),
	"a.UploadDate as UploadDate" => array("UploadDate","Upload Date Time"),
	"( SELECT ts.full_name FROM tms_agent ts WHERE ts.UserId=a.UploadBy  ) as UploadBy" => array("UploadBy","Upload By"),
	"IF( a.ScriptFlagStatus = 1, 'Active','Not Active') as Status" => array("Status","Status")
  ));
  
   $this->EUI_Page->_setFrom("t_gn_product_script a");
   $this->EUI_Page->_setJoin("t_gn_product_master b", "a.ProductId=b.ProductId","LEFT", true);
  
  // --------------- set filter ----------------------
   $this->EUI_Page->_setAndCache("a.ProductId", "script_product_id", true);
   $this->EUI_Page->_setAndCache("a.UploadBy", "script_user_id", true);
   $this->EUI_Page->_setAndCache("a.ScriptFlagStatus", "script_status", true);
   $this->EUI_Page->_setLikeCache("b.ProductName", "script_product_name", true);
   $this->EUI_Page->_setLikeCache("a.Description", "script_product_title", true);
   $this->EUI_Page->_setLikeCache("a.ScriptFileName", "script_file_name", true);
 
  // --------------- set order  -------------------
 
  if( !_get_have_post('order_by')){
	$this->EUI_Page->_setOrderBy('a.ScriptId','DESC');
  } else {
	$this->EUI_Page->_setOrderBy(_get_post('order_by'), _get_post('type'));
  }
  
  // echo $this->EUI_Page->_getCompiler();
 // --------------- set limit  ------------------- 
   $this->EUI_Page->_setLimit();
  
}
/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
function _get_resource()
 {
	self::_get_content();
	if( $this -> EUI_Page -> _get_query()!='') 
	{
		return $this -> EUI_Page -> _result();
	}	
 }
 
/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
function _get_page_number() 
 {
	if( $this -> EUI_Page -> _get_query()!='' ) {
		return $this -> EUI_Page -> _getNo();
	}	
 }
 
/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
 
 
 function _setUpload( $out = null, $dfl = null )
 {
	 
// define data client return /
	 
	$this->callCond = 0;
// get all atrributedata process on here 	
	$this->out = $out;
	$this->dfl = $dfl;
	$this->cok = CK();
	
// et attr 
	$this->atr = $this->dfl->field('ScriptFileName', 'Objective');
	if( !is_object($this->atr)){
		return false;
	}
	
	
// push data add On 
	$this->out->add('UploadBy', $this->cok->field('UserId'));
	$this->out->add('UploadDate', date('Y-m-d H:i:s'));
// reset data to insert cache .

	
	$this->db->reset_write();
	$this->db->set('ScriptFileName', 	$this->atr->field('name'));
	$this->db->set('ScriptUpload', 		$this->atr->field('name'));
	$this->db->set('ProductId', 		$this->out->field('ProductName'));
	$this->db->set('Description', 		$this->out->field('ScriptTitle'));
	$this->db->set('ScriptFlagStatus', 	$this->out->field('Active'));
	$this->db->set('UploadDate', 		$this->out->field('UploadDate'));
	$this->db->set('UploadBy', 			$this->out->field('UploadBy'));
	
	// tehn inserton table "this";
	$this->db->insert('t_gn_product_script');
	if( $this->db->affected_rows() > 0 ){
		$this->callCond++;
	}
	
	return (bool)$this->callCond;
 }
 
/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
 function _setActive($_post = null)
 {
	$_conds = 0;
	if(!is_null($_post))
	{
		foreach($_post['ScriptId'] as $keys => $ScriptId )
		{
			if( $this -> db -> update('t_gn_product_script', 
			 array( 'ScriptFlagStatus'=>$_post['Flags']), 
			 array( 'ScriptId' => $ScriptId)))
			{
				$_conds+=1;	
			}
		}
	}
	
	return $_conds;
 }

/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
 function _setDelete($_post = null)
 {
	$_conds = 0;
	if(!is_null($_post))
	{
		foreach($_post['ScriptId'] as $keys => $ScriptId )
		{
			if( $this -> db -> delete('t_gn_product_script',array('ScriptId'=>$ScriptId)))
			{
				$_conds+=1;	
			}
		}
	}
	
	return $_conds;
 }
 
/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
 
 public function _select_row_campaign_product( $ProductId  = null )
{
   $arr_campaign = array();
   if( !is_null($ProductId) 
	   OR ($ProductId ==0) 
	   OR ($ProductId==='') )
  {
	 return (array)$arr_campaign;
  }
  
 //  -------------- next proces  ------------------------------
 
  if( !is_array($ProductId) ){
	  $ProductId = array($ProductId);
  }
  
  $this->db->reset_select();
  $this->db->where_in('ProductId', $ProductId);
  $this->db->select("CampaignId", FALSE);
  $this->db->from("t_gn_campaignproduct");
  $rs = $this->db->get();
  if( $rs->num_rows() > 0 ) 
	  foreach( $rs->result_assoc() as $rows ) 
 {
	$arr_campaign[$rows['CampaignId']] = (int)$rows['CampaignId'];
	
  }
  return (array)$arr_campaign;
  
} 
 
/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
 public function _select_row_product_campaign( $CampaignId  = null )
{
   $arr_product = array();  
  if( is_null($CampaignId)  OR ($CampaignId ==0) OR ($CampaignId == '' ) )
  {
	 return (array)$arr_product;
  }
  
 //  -------------- next proces  ------------------------------
 
  if( !is_array($CampaignId) ){
	  $CampaignId = array($CampaignId);
  }
  
  $this->db->reset_select();
  $this->db->where_in('CampaignId', $CampaignId);
  $this->db->select("ProductId", FALSE);
  $this->db->from("t_gn_campaignproduct");
 
  $rs = $this->db->get();
  if( $rs->num_rows() > 0 ) 
	  foreach( $rs->result_assoc() as $rows ) 
 {
	$arr_product[$rows['ProductId']]	 = (int)$rows['ProductId'];
	
  }
  return (array)$arr_product;
  
} 
/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
 public function _getScript( $CampaignId = null )
{
 
 $ProductId = array();
 if( !is_null($CampaignId) AND (int)$CampaignId > 0 ) {
	$ProductId = $this->_select_row_product_campaign( $CampaignId );
 }
 
 
 // result_array response 
 
 $result_array = array();
 $this->db->reset_select();
 $this->db-> select('a.ScriptId,( SELECT pr.ProductName FROM t_gn_product_master pr WHERE pr.ProductId=a.ProductId ) as ProductName',  FALSE);
 $this->db->from('t_gn_product_script a');
 $this->db->join('t_gn_product_master b','a.ProductId=b.ProductId','LEFT');
 $this->db->where('a.ScriptFlagStatus', 1);
 //$this->db->print_out();
 
// -------- if have data posted -----------------------------------
 
  if( is_array( $ProductId ) AND count( $ProductId ) > 0 ) { 
	$this->db->where_in('a.ProductId', $ProductId);
  }
  
// ---- debug  echo $this->db->print_out(); ------------------

 $qry = $this->db->get();
 if( $qry && $qry->num_rows() > 0 ) 
  foreach( $qry->result_assoc() as $row ) {
	 $result_array[$row['ScriptId']] = $row['ProductName'];
  }
  
   return (array)$result_array;
}
 
/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
 function _getDataScript( $ScriptId=0 )
 {	
 
 // default callback to client process 
	$thies->result_array = array();
	
// reseting process query select 	
	$this->db->reset_select();
	$this->db->select('a.*');
	$this->db->from('t_gn_product_script a');
	$this->db->where('a.ScriptId', $ScriptId );
// will try get error an MySQL server .
	$qry = $this->db->get();
	if( !$qry ){
		exit( mysql_error() );
	}
	
	// return trowing data 
	$this->result_array = (array)$qry->result_first_assoc();
	return Objective($this->result_array);
 }
 /*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	
 // ========================================================= END CLASS =========================================================
}

?>
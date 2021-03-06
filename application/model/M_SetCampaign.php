<?php
/*
 * E.U.I 
 *
 
 * subject	: get SetCampaign modul 
 * 			  extends under EUI_Controller class
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/model/sysuser/
 */
 
class M_SetCampaign extends EUI_Model
{

/*
 * EUI :: _get_product() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
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
 * EUI :: _get_default() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */	
function __construct()
{
	$this -> load->model('M_SysUser');
}

/*
 * EUI :: _get_default() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */	
 
function _get_campaign_name()
{
	$datas = array();
	
	$this -> db ->select("a.CampaignId, a.CampaignName");
	$this -> db ->from("t_gn_campaign a ");
	$this -> db ->join("t_lk_outbound_goals b", "a.OutboundGoalsId=b.OutboundGoalsId","LEFT");
	$this -> db ->where("a.CampaignStatusFlag",1);
	$this -> db ->where("Name", "outbound");
	
	foreach( $this -> db ->get() ->result_assoc() as $rows )
	{
		$datas[$rows['CampaignId']] = $rows['CampaignName'];
	}
	
	return $datas;
}

/*
 * EUI :: _get_default() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */	
 
function _get_default()
{
// ------------------------------------------------------	
  $out  = new EUI_Object(_get_all_request());

// ------------------------------------------------------
  
  $this->EUI_Page->_setPage(10); 
  $this->EUI_Page->_setSelect("distinct(a.CampaignId)", false);
  $this->EUI_Page->_setFrom("t_gn_campaign a ");
  $this->EUI_Page->_setJoin("t_lk_campaigntype c "," a.CampaignTypeId=c.CampaignTypeId","LEFT", true);
 
 // ------------ set filter data ---------------
  
  $this->EUI_Page->_setLikeCache("a.CampaignName", "CampaignName", true);
  $this->EUI_Page->_setAndCache("a.CampaignStatusFlag", "CampaignStatus", true);
  $this->EUI_Page->_setAndCache("a.OutboundGoalsId", "Direction", true);
  $this->EUI_Page->_setAndOrCache("a.CampaignStartDate>='{$out->get_value('StartExpiredDate','StartDate')}'", "StartExpiredDate", true);
  $this->EUI_Page->_setAndOrCache("a.CampaignEndDate>='{$out->get_value('EndExpiredDate','EndDate')}'", "EndExpiredDate", true);
  return $this->EUI_Page;
}

/*
 * EUI :: _get_content() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */		
 
function _get_content()
{
 // ------------------------------------------------------	
  $out  = new EUI_Object(_get_all_request());
  
// ------------------------------------------------------
  
	$this->EUI_Page->_postPage(_get_post('v_page'));
	$this->EUI_Page->_setPage(10);
	$this->EUI_Page->_setArraySelect(array(
		"a.CampaignId As CampaignId" 			=> array("CampaignId", "CampaignId","primary"),
		"a.CampaignNumber As CampaignNumber" 	=> array("CampaignNumber","Campaign Number"),
		"a.CampaignCode As CampaignCode" 		=> array("CampaignCode", "Campaign Code"),
		"a.CampaignName as CampaignName" 		=> array("CampaignName","Campaign Name"),
		"a.CampaignDesc As CampaignDesc" 		=> array("CampaignDesc","Description"),
		"a.CampaignEndDate As CampaignEndDate" 	=> array("CampaignEndDate","Expired Date"),
		"(SELECT count(cs.DM_Id) as jumlah 
			FROM t_gn_customer_master cs
			WHERE cs.DM_CampaignId=a.CampaignId ) 
		 As DataSize" 							=> array("DataSize", "Data Size"),
		"IF(a.CampaignStatusFlag=0,'Not Active','Active') 
		 As CmpStatus" 							=> array("CmpStatus","Status")
	));
	
	$this->EUI_Page->_setFrom("t_gn_campaign a");
	$this->EUI_Page->_setJoin("t_lk_campaigntype c "," a.CampaignTypeId=c.CampaignTypeId","LEFT");
	$this->EUI_Page->_setJoin("t_lk_outbound_goals f "," a.OutboundGoalsId=f.OutboundGoalsId","LEFT");
	$this->EUI_Page->_setJoin("t_lk_direction_action g "," a.DirectAction=g.ActionCode","LEFT");
	$this->EUI_Page->_setJoin("t_lk_direct_method h "," a.DirectMethod=h.MethodCode","LEFT");
	$this->EUI_Page->_setJoin("t_gn_campaign k "," a.AvailCampaignId=k.CampaignId","LEFT", true);
 
 // ------------ set filter data ---------------
  
   $this->EUI_Page->_setLikeCache("a.CampaignName", "CampaignName", true);
   $this->EUI_Page->_setAndCache("a.CampaignStatusFlag", "CampaignStatus", true);
   $this->EUI_Page->_setAndCache("a.OutboundGoalsId", "Direction", true);
   $this->EUI_Page->_setAndOrCache("a.CampaignStartDate>='{$out->get_value('StartExpiredDate','StartDate')}'", "StartExpiredDate", true);
   $this->EUI_Page->_setAndOrCache("a.CampaignEndDate>='{$out->get_value('EndExpiredDate','EndDate')}'", "EndExpiredDate", true);
 
 // --------------- set order  -------------------
 
   if( !_get_have_post('order_by')){
	 $this->EUI_Page->_setOrderBy('a.CampaignId','DESC');
  } else {
	 $this->EUI_Page->_setOrderBy(_get_post('order_by'), _get_post('type'));
  }	
	//echo $this->EUI_Page->_getCompiler();
	
	$this->EUI_Page->_setLimit();
}	

/*
 * EUI :: _get_resource_query() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */
 
function _get_resource_query()
 {
	$res = false;
	self::_get_content();
	if( $this -> EUI_Page -> _get_query()!='') {
		$res = $this -> EUI_Page -> _result();
		if($res) return $res;
	}	
 }
 
/*
 * EUI :: _get_page_number() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */
 
function _get_page_number()
  {
	if( $this -> EUI_Page -> _get_query()!='' )
	{
		return $this -> EUI_Page -> _getNo();
	}	
  }
  
   
/*
 * EUI :: _get_page_number() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */
 
 public function _set_event_update_campaign( $out= null)
{
 
  if( is_null( $out) ) {  return false;  }
  if( !$out->fetch_ready() ){ return false; }
  
  
  $objPro =& get_class_instance('M_SetProduct');
  
// ------------ exist data payment list && data -------------------------------

  $CampaignId  = $out->get_value('CampaignId', 'trim');
  $ProductList = $objPro->_getProductCampaignId($CampaignId);
  $PayTypeList = $objPro->_getCampaignChannel($CampaignId);
  
// ---------------- reset write -----------------------

  $this->db->reset_write();
  $this->db->where("CampaignId", $CampaignId);
  $this->db->set("CampaignCode", $out->get_value('CampaignCode') );
  $this->db->set("CampaignDesc",$out->get_value('CampaignDesc'));
  $this->db->set("CampaignNumber",$out->get_value('CampaignNumber'));
  $this->db->set("CampaignName",$out->get_value('CampaignName'));
  $this->db->set("CampaignStartDate",$out->get_value('StartDate','_getDateEnglish'));
  $this->db->set("CampaignEndDate",$out->get_value('ExpiredDate','_getDateEnglish'));
  $this->db->set("CampaignStatusFlag",$out->get_value('StatusActive'));
  $this->db->set("OutboundGoalsId", '2'); //$out->get_value('OutboundGoalsId')
  //$this->db->set("DirectMethod",$out->get_value('DirectMethod'));
  //$this->db->set("DirectAction",$out->get_value('DirectAction'));
  //$this->db->set("AvailCampaignId",$out->get_value('AvailCampaignId'));
  
// -------------- data compacted --------------------------
  
  if(  $this->db->update("t_gn_campaign") ){
	$CampaignId  = $out->get_value('CampaignId', 'trim');
  } 
  
 // echo $this->db->last_query();
  
// --------- insert into t_gn_campaignproduct ---------------------

   if( $CampaignId ) 
   {
	   
	// ------------ delete and insert again -------------------
	   $ListProduct = $out->get_array_value('ListProduct');
	   if( is_array($ListProduct) and count($ListProduct) > 0  ) 
		 foreach( $ListProduct as $k => $ProductId ) 
	  {
		  if( !in_array($ProductId,  $ProductList ) ) 
		 {
			// $this->db->reset_write();
			// $this->db->set("CampaignId", $CampaignId);
			// $this->db->set("ProductId", $ProductId);
			// $this->db->insert("t_gn_campaignproduct");
			$this->db->duplicate("CampaignId", $CampaignId);
			$this->db->duplicate("ProductId", $ProductId);
			$this->db->insert_on_duplicate("t_gn_campaignproduct");
		 }
	  }
		
	// ----------- remove product --------------------
		$Product = $out->get_array_value('ProductId');  
		if( is_array($Product) and count($Product) > 0  ) 
		 foreach( $Product as $k => $ProductId ) 
		{
		    $this->db->reset_write();
			$this->db->where("CampaignId", $CampaignId);
			$this->db->where("ProductId", $ProductId);
			$this->db->delete("t_gn_campaignproduct");
		}
    }
	
// --------- insert into t_gn_campaignpaychannel ---------------------
	/*if( $CampaignId ) 
	{
	   $PaymentType = $out->get_array_value('ListPaymentChannel');
	   if( is_array($PaymentType) and count($PaymentType) > 0  ) 
		 foreach( $PaymentType as $k => $PaymentTypeId ) 
	  {
		  if( !in_array($PaymentTypeId,  $PayTypeList ) ) 
		 {
			$this->db->reset_write();
			$this->db->set("CampaignId", $CampaignId);
			$this->db->set("PaymentChannelId", $PaymentTypeId);
			$this->db->insert("t_gn_campaignpaychannel");
		 }
	  } 
	  
	  // ----------- remove chanel --------------------
	  
		$Channel = $out->get_array_value('PaymentChannel');  
		if( is_array($Channel) and count($Channel) > 0  ) 
		 foreach( $Channel as $k => $ChannelId ) 
		{
		    $this->db->reset_write();
			$this->db->where("CampaignId", $CampaignId);
			$this->db->where("PaymentChannelId", $ChannelId);
			$this->db->delete("t_gn_campaignpaychannel");
		}
    }*/
	
// ------------ insert on clampaign ID ---------------------------
	
  if( $CampaignId ) { return TRUE; }
  else {
	  return FALSE;
  } 
	
}

/*
 * EUI :: _get_page_number() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */
 
 public function _set_event_delete_campaign( $out  = null ) 
{
	if( is_null( $out) ) {  return false;  }
	if( !$out->fetch_ready() ){ return false; }
	
// --------- default callback ---------------------	
	$cond = 0; 
	
	$arr_data = $out->get_array_value('CampaignId');
	if( is_array( $arr_data ) AND count( $arr_data ) > 0 ) 
		foreach( $arr_data as $k => $CampaignId )
	{
		// ---------- delete on product campaign 
		
		$this->db->reset_write();
		$this->db->where("CampaignId", $CampaignId);
		$this->db->delete("t_gn_campaignproduct");
		
		// ----------- delete chanel 
		
		$this->db->reset_write();
		$this->db->where("CampaignId", $CampaignId);
		$this->db->delete("t_gn_campaignpaychannel");
		
		// ----------- delete target  
		
		$this->db->reset_write();
		$this->db->where("CampaignId", $CampaignId);
		$this->db->delete("t_gn_campaign_target");
		
		// delete campaign 
		
		$this->db->reset_write();
		$this->db->where("CampaignId", $CampaignId);
		if( $this->db->delete("t_gn_campaign") ){
			$cond++;	
		}
	}
	return $cond;
} 

/*
 * EUI :: _get_page_number() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */
 
 public function _set_save_campaign( $out  = null )
{
	if( is_null( $out) ) {  return false;  }
	if( !$out->fetch_ready() ){ return false; }
	
// ---------------- reset write -----------------------

	$CampaignId  = 0;

	$this->db->reset_write();
	$this->db->set("CampaignCode", $out->get_value('CampaignCode') );
	$this->db->set("CampaignDesc",$out->get_value('CampaignDesc'));
	$this->db->set("CampaignNumber",$out->get_value('CampaignNumber'));
	$this->db->set("CampaignName",$out->get_value('CampaignName'));
	$this->db->set("CampaignStartDate",$out->get_value('StartDate','_getDateEnglish'));
	$this->db->set("CampaignEndDate",$out->get_value('ExpiredDate','_getDateEnglish'));
	$this->db->set("CampaignStatusFlag",$out->get_value('StatusActive'));
	$this->db->set("OutboundGoalsId",'2'); //$out->get_value('OutboundGoalsId')
	//$this->db->set("DirectMethod",$out->get_value('DirectMethod'));
	//$this->db->set("DirectAction",$out->get_value('DirectAction'));
	//$this->db->set("AvailCampaignId",$out->get_value('AvailCampaignId'));
	
	if( $this->db->insert("t_gn_campaign") ) {
		$CampaignId = $this->db->insert_id();	
	}	
	
// --------- insert into t_gn_campaignproduct ---------------------

   if( $CampaignId ) 
   {
	   $ListProduct = $out->get_array_value('ListProduct');
	   if( is_array($ListProduct) and count($ListProduct) > 0  ) 
		 foreach( $ListProduct as $k => $ProductId ) 
	  {
		 $this->db->reset_write();
		 $this->db->set("CampaignId", $CampaignId);
		 $this->db->set("ProductId", $ProductId);
		 $this->db->insert("t_gn_campaignproduct");
	  } 
	  
    }
	
// --------- insert into t_gn_campaignpaychannel ---------------------
	/*if( $CampaignId ) 
	{
	   $PaymentType = $out->get_array_value('ListPaymentChannel');
	   if( is_array($PaymentType) and count($PaymentType) > 0  ) 
		 foreach( $PaymentType as $k => $PaymentTypeId ) 
	  {
		 $this->db->reset_write();
		 $this->db->set("CampaignId", $CampaignId);
		 $this->db->set("PaymentChannelId", $PaymentTypeId);
		 $this->db->insert("t_gn_campaignpaychannel");
	  } 
    }*/
	
// ------------ insert on clampaign ID ---------------------------
	
  if( $CampaignId ) { return true; }
  else {
	  return FALSE;
  } 
  
 } 
 //=========== END SUBMIT ===============>  

/*
 * EUI :: _get_page_number() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */
 
 function getTarget($cmp_id='')
 {
 	$this -> db -> select(" * ");
 	$this -> db -> from('t_gn_campaign_target');
 	$this -> db -> where('CampaignId', $cmp_id);
 	$res = array();

 	foreach ($this->db->get() -> result_assoc() as $rows) {
 		$res = $rows;
 	}

 	return $res;
 }
 
 /*
 * EUI :: _get_page_number() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */
 
 function set_save_event_target($post=array())
 {
 	$_conds = 0;

 	$_conds = $this -> update_target($post);

 	if ($_conds == 0) {	// no cmp target updated, new target
 		$_conds = $this -> save_target($post);
 	}

 	return $_conds;
 }
 
/*
 * EUI :: _get_page_number() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */
 
 function update_target($post=array())
 {
 	$_set = array();
 	$_where = array();

 	$_set['Target1']= $post['target1'];
 	$_set['Target2']= $post['target2'];
 	$_set['Target3']= $post['target3'];
 	$_set['Target4']= $post['target4'];
 	$_set['Target5']= $post['target5'];
 	$_set['Target6']= $post['target6'];
 	$_set['Target7']= $post['target7'];
 	$_set['Target8']= $post['target8'];
 	$_set['Target9']= $post['target9'];
 	$_set['Target10']= $post['target10'];
 	$_set['UpdatedTs']= date("Y-m-d h:i:s");

 	$_where['CampaignId']= $post['CampaignId'];

 	$this -> db -> where($_where);
 	$this -> db -> update('t_gn_campaign_target', $_set);

 	$_ret = $this-> db -> affected_rows();

 	return $_ret;
 }

 /*
 * EUI :: _get_page_number() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */
 
 function save_target($post=array())		
 {
 	$_set = array();
 	$_where = array();

 	$_set['Target1']= $post['target1'];
 	$_set['Target2']= $post['target2'];
 	$_set['Target3']= $post['target3'];
 	$_set['Target4']= $post['target4'];
 	$_set['Target5']= $post['target5'];
 	$_set['Target6']= $post['target6'];
 	$_set['Target7']= $post['target7'];
 	$_set['Target8']= $post['target8'];
 	$_set['Target9']= $post['target9'];
 	$_set['Target10']= $post['target10'];
 	$_set['UpdatedTs']= date("Y-m-d h:i:s");
 	$_set['CampaignId']= $post['CampaignId'];

	$this -> db -> insert('t_gn_campaign_target', $_set);

	$_ret = $this-> db ->insert_id();

 	return $_ret;
 }
 
 /*
 * EUI :: _get_page_number() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */
function _get_size_campaign()
{ 
	$_conds = array();
	
	// $sql = " SELECT COUNT(a.CustomerId) as SizeCount, a.CampaignId FROM t_gn_customer a GROUP BY a.CampaignId ";
	$sql = " SELECT COUNT(a.DM_Id) as SizeCount, a.DM_CampaignId FROM t_gn_customer_master a GROUP BY a.DM_CampaignId ";
	$qry = $this->db->query($sql);
	foreach($qry -> result_assoc() as $rows ) {
		$_conds[$rows['DM_CampaignId']] = ( $rows['SizeCount'] ? $rows['SizeCount'] : 0 );	
	}
	
	return $_conds;
}	
/*
 * EUI :: _get_page_number() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */

function getAttribute($CampaignId=null )
{
	$_conds = array();
	if( isset($_conds))
	{
		$sql = "SELECT * FROM (`t_gn_campaign`) WHERE `CampaignId` = '$CampaignId'";
		$qry = $this -> db -> query($sql);
		if($qry !=FALSE) 
		{
			$_conds = $qry -> result_first_assoc();
		}	
	}
	
	return $_conds;
}

/*
 * EUI :: _get_page_number() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */

/*
 * EUI :: _get_page_number() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */
 
function _getDataCampaignId($CampaignId = array())
{
	$_conds = array();
	$this -> db -> select
	(
		"a.CustomerNumber, a.CustomerFirstName,
		 a.CustomerLastName, a.CustomerDOB,
		 a.CustomerIdentificationNum, a.CustomerAddressLine1,
		 a.CustomerAddressLine2, a.CustomerAddressLine3,
	     a.CustomerAddressLine4, a.CustomerCity,
		 a.CustomerZipCode, a.CustomerHomePhoneNum,
		 a.CustomerMobilePhoneNum, a.CustomerWorkFaxNum,
		 a.CustomerWorkExtPhoneNum, a.CustomerWorkPhoneNum,
		 a.CustomerFaxNum, a.CustomerEmail,
		 a.CustomerOfficeName, a.CustomerOfficeLine1,
		 a.CustomerOfficeLine2, a.CustomerOfficeLine3,
		 a.CustomerOfficeLine4, a.CustomerOfficeCity,
		 a.CustomerOfficeZipCode,a.CustomerArea,
		 a.CustomerUploadedTs, a.CustomerCcNumber,
		 b.CampaignName"
	);
	
	$this -> db -> from("t_gn_customer a");
	$this -> db -> join("t_gn_campaign b ","a.CampaignId=b.CampaignId","LEFT");
	$this -> db -> where_in("a.CampaignId",$CampaignId);
	
	$i = 0;
	foreach( $this -> db -> get() -> result_assoc() as $rows )
	{
		foreach($rows as $fields => $values ) {
			$_conds[$i][$fields] = $values;
		}	
		$i++;
	}
	
	return $_conds;
}

/*
 * EUI :: _getMethodDirection() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */
 
 function _getMethodDirection()
 {
	$_conds = array();
	
	$this->db->select('a.MethodCode, a.MethodName'); 
	$this->db->from('t_lk_direct_method a');
	$this->db->where('a.MenthodFlags',1);
	
	foreach( $this ->db->get()->result_assoc() as $rows)
	{
		$_conds[$rows['MethodCode']] = $rows['MethodName'];
	}
	
	return $_conds;
	
	
 }
 
/*
 * EUI :: _getMethodDirection() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */
 
 function _getMethodAction()
 {
	$_conds = array();
	
	$this->db->select('a.ActionCode, a.ActionName'); 
	$this->db->from('t_lk_direction_action a');
	$this->db->where('a.ActionFlags',1);
	
	foreach( $this ->db->get()->result_assoc() as $rows)
	{
		$_conds[$rows['ActionCode']] = $rows['ActionName'];
	}
	
	return $_conds;
 }
 
 
 /*
 * EUI :: _getOutboundGoals() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */
 
 function _getCampaignGoals( $OutboundGoalsId = 0 )
 {
	$_conds = array();
	
	$this->db->select('a.CampaignId, a.CampaignName');
	$this->db->from('t_gn_campaign a');
	$this->db->where('a.OutboundGoalsId', $OutboundGoalsId);
	foreach( $this ->db->get()->result_assoc() as $rows)
	{
		$_conds[$rows['CampaignId']] = $rows['CampaignName'];
	}
	
	return $_conds;
	
 }
 

 
/*
 * EUI :: _getDataInbound() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */
  
 function _getDataInbound($CampaignId)
 {
	$_counter = 0;
	
	$this -> db -> select('COUNT(a.CustomerId) as Counter ');
	$this -> db -> from('t_gn_customer a');
	$this -> db -> join('t_gn_assignment b ', 'a.CustomerId=b.CustomerId','INNER');
	$this -> db -> where('a.CampaignId',$CampaignId);
	
	if( $rows = $this -> db -> get()->result_first_assoc() )
	{
		$_counter = $rows['Counter'];
	}
	
	return $_counter;
 }
 
/*
 * EUI :: _setManageCampaign() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */
 
private function _getDataByCampaign($post)
{
	$_assign_customer = array();
	
	$this ->db ->select('*');
	$this ->db ->from('t_gn_customer a');
	$this ->db ->join('t_gn_assignment b', 'a.CustomerId=b.CustomerId', 'INNER');
	$this ->db ->where('a.CampaignId',$post['InboundCampaignId']);	
	$this ->db ->limit($post['AssignData']);
	
	$i = 0;
	foreach( $this ->db ->get() -> result_assoc() as $rows )
	{
		$_assign_customer[$i] = $rows;
		$i++;
	}
	
	return $_assign_customer;
}
 
/*
 * EUI :: _setManageCampaign() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */ 
private function _getAssignByCampaign($CampaignId)
{
	$_assign_data = array();
	
	$this ->db ->select('*');
	$this ->db ->from('t_gn_customer a');
	$this ->db ->join('t_gn_assignment b', 'a.CustomerId=b.CustomerId', 'INNER');
	$this ->db ->where('a.CampaignId',$CampaignId);	
	
	$i = 0;
	foreach( $this ->db ->get() -> result_assoc() as $rows )
	{
		$_assign_data[$i] = $rows;
		$i++;
	}
	
	return $_assign_data;
}
 
/*
 * EUI :: _setManageCampaign() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */ 
function _setManageCampaign($post=null)
{

	$_conds = 0;
	
 // define of parameter
	if(!defined('DIRECT')) define('DIRECT',2);
	if(!defined('DUPLICATE')) define('DUPLICATE',1);
	if(!defined('REPLACE')) define('REPLACE',2);
	
  // then process copy data 
	
	if(!is_null($post))
	{
		// method duplicate 
			
			if($post['DirectAction']==DUPLICATE)
			{
				// filtering data 
				
				$_array_filter = array
				(
					'CustomerId', 'UpdatedById','CampaignId','CallReasonId',
					'CallReasonQue','QueueId', 'SellerId','QaProsess',
					'InitDays','CustomerUpdatedTs','AssignId','AssignAdmin',
					'AssignMgr', 'AssignSpv', 'AssignSelerId','AssignDate',
					'AssignMode', 'AssignBlock'
				);
				
				// maping data 
				
				$avail_columns = ARRAY(); $assign_columns = ARRAY();
				$DataCustomers = ARRAY_VALUES(self::_getDataByCampaign($post));
				$nums = 0;
				
				foreach( $DataCustomers as $k => $values ) 
				{
					foreach($values as $fieldname => $fielvalues ) 
					{
						if(!in_array($fieldname, $_array_filter) ) 
						{
							$avail_columns[$nums][$fieldname] = $fielvalues;
						}
						else{
							$assign_columns[$nums][$fieldname] = $fielvalues;
						}
						
						$avail_columns[$nums]['CampaignId'] = $post['OutboundCampaignId'];
					}
					
				/* 
				 * @ def 	: insert to customer data 
				 * -------------------------------------
				 * @ param  : array()
				 * @ aksess : public
				 */	
				 
				 $_UserDetail = array_keys($this ->M_SysUser ->_get_administrator());
				 if( $this ->db->insert('t_gn_customer',$avail_columns[$nums]))
				 {
					$CustomerId = $this ->db->insert_id();
					
					/* insert to assign data  */
						
					if( $this -> db->insert('t_gn_assignment',
							array
							(
								'CustomerId' 	=> $CustomerId, 
								'AssignAdmin' 	=> $_UserDetail[count($_UserDetail)-1],
								'AssignMode' 	=> 'DIS'
							)
						))
					{
						/* insert to log data  */
						if( $this -> db -> insert("t_gn_direct_campaign",
							array
							(
								'CustomerIdNew' 	 => $CustomerId, 
								'DirectCampaignFrom' => $post['InboundCampaignId'], 
								'DirectCampaignTo' 	 => $post['OutboundCampaignId'],  
								'CustomerIdOld' 	 => $assign_columns[$nums]['CustomerId'], 
								'SellerId' 			 => $assign_columns[$nums]['SellerId'],  
								'CallReasonId'		 => $assign_columns[$nums]['CallReasonId'],  
								'CreateByUserId' 	 => $this -> EUI_Session ->_get_session('UserId'),
								'CreateDateTs' 		 => date('Y-m-d H:i:s'),
								'DirectAction' 		 => DUPLICATE,
								'DirectMethode' 	 => DIRECT
							)
						)){
							$_conds++;
						}
					 }
				   }
					$nums++;
				}
				
			}
			
		// method replace 	
			
			if($post['DirectAction']==REPLACE)
			{
				// filtering data 
				
				$_array_filter = array (
					'CustomerId','UpdatedById','CampaignId','CallReasonId',
					'CallReasonQue','QueueId', 'SellerId','QaProsess',
					'InitDays','CustomerUpdatedTs','AssignId','AssignAdmin',
					'AssignMgr', 'AssignSpv', 'AssignSelerId','AssignDate',
					'AssignMode', 'AssignBlock'
				);
				
				// maping data 
				
				$_avc = ARRAY(); 
				$_mls = ARRAY(); 
				$where_avails 	= ARRAY();
				$DataCustomers  = ARRAY_VALUES(self::_getDataByCampaign($post));
				
				
				$_UserDetail = array_keys($this ->M_SysUser ->_get_administrator());
				
				$nums = 0;
				foreach( $DataCustomers as $k => $values ) 
				{
					$_mls['DirectCampaignFrom'] = $post['InboundCampaignId'];
					$_mls['DirectCampaignTo']   = $post['OutboundCampaignId'];
					$_mls['CustomerIdOld']	 	= $values['CustomerId'];
					$_mls['SellerId']			= $values['SellerId'];
					$_mls['CustomerIdNew'] 	 	= $values['CustomerId'];
					$_mls['CallReasonId']		= $values['CallReasonId'];
					$_mls['DirectAction'] 		= REPLACE;
					$_mls['DirectMethode'] 	 	= DIRECT;
					$_mls['CreateByUserId'] 	= $this -> EUI_Session ->_get_session('UserId');
					$_mls['CreateDateTs']		= date('Y-m-d H:i:s');
					
					foreach($values as $fieldname => $fielvalues ) 
					{
						if(!in_array($fieldname, $_array_filter) ) 
						{
							$this->db->set($fieldname,$fielvalues,true);
							$this->db->set('CallReasonId','NULL',FALSE);
							$this->db->set('SellerId','NULL',FALSE);
							$this->db->set('CampaignId', $post['OutboundCampaignId'],FALSE);							
						}
						else 
						{
							if( $fieldname=='CustomerId') {
								$this->db->where($fieldname,$fielvalues,FALSE);
							}
						}
					}
					
					$this -> db -> update('t_gn_customer'); 
					if( $this->db->affected_rows() > 0 )
					{
						$this->db->set('AssignMgr','NULL',FALSE);
						$this->db->set('AssignSpv','NULL',FALSE);
						$this->db->set('AssignSelerId','NULL',FALSE);
						$this->db->set('AssignAdmin',$_UserDetail[count($_UserDetail)-1],FALSE);
						$this->db->set('AssignMode','DIS',TRUE);
						$this->db->set('AssignDate',date('Y-m-d H:i:s'),TRUE);
						$this->db->where('CustomerId',$values['CustomerId']);
						$this->db->update('t_gn_assignment');
						if( $this->db->affected_rows() > 0)
						{
							$_conds++;
							if( $this -> db ->insert('t_gn_direct_campaign', $_mls) )
							{
								$_conds++;
							}
						}
					}	
					
				  $nums++;
				}
				
			}
		
	}
	
	return $nums;
	
}
 
}

?>
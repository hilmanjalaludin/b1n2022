<?php
/*
 * E.U.I 
 * -----------------------------------------------
 *
 * subject	: M_QtyApprovalInterest
 * 			  extends under Controller class
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/controller/sysuser/
 */

/**
 * Flow Assignment 
1. QA akan bagikan data berdasarkan closing anaknya
	- Parameter
		-> tl_id
		-> Agree
	- _getDataByChecked
	- 
2. List Score 
	- List Score akan muncul di SPV jika datanya sudah dibagikan ke SPV
		-> Berdasarkan QualityAssignment , t_gn_quality_assignment di SPV_id
		-> Berikan Informasi Nama Agent dan Status Closing , Product Apa yang di tawarkan
	- M_QtyScoring Content and Default 
		- Table yang bersangkutan
			-> t_gn_quality_assignment , berdasarkan tl_id
			-> t_gn_customer
			-> t_gn_score_acurate
			-> cc_recording
			-> t_gn_product
			-> t_lk_call_reason
			-> t_gn_campaign
 */
 
class M_QtyScoring extends EUI_Model
{
	
var $set_limit_page  = 10;	

// --------------------------------------------------------------

  private static $Instance   = null; 
  public static function &Instance()
 {
	if( is_null(self::$Instance) ){
		self::$Instance = new self();
	}	
	return self::$Instance;
 }
/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 public function M_QtyScoring()
 {
	$this -> load -> model(array(
		'M_ModOutBoundGoal', 'M_Combo','M_SrcCustomerList', 'M_SetProduct', 'M_SetResultCategory',
		'M_ModSaveActivity', 'M_Payers','M_Benefiecery','M_Insured','M_QtyPoint','M_Pbx'));
 }
 
 
 
/*
 * @ def 		: _getEventSale
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */

function _getAgentReady()
{
	$AgentId = array();
	$this -> db->select("a.Agent_User_Id ");
	$this -> db->from("t_gn_quality_agent a ");
	$this -> db->where("a.Quality_Staff_Id",$this -> EUI_Session->_get_session('UserId'));
	foreach( $this -> db->get() -> result_assoc()  as $rows )
	{
		$AgentId[$rows['Agent_User_Id']] = $rows['Agent_User_Id'];
	}
	
	return $AgentId;
	
} 
 
/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function Sale()
{
	$_a = array(); $_b = array();
	if( class_exists('M_SetCallResult'))
	{
		$_a = $this -> M_SetCallResult -> _getInterestSale(); 
		foreach( $_a as $_k => $_v )
		{
			$_b[$_k] = $_k;  
		}	
	}
	
	return $_b;
} 
 
/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */

public function _getAgentByQualityStaff()
{
	$_list_agents = false;
	
	if( $this -> EUI_Session->_have_get_session('UserId') )
	{
		$this -> db -> select("b.UserId");
		$this -> db -> from("t_gn_quality_agent a");
		$this -> db -> join("tms_agent b","a.Agent_User_Id=b.UserId","LEFT");
		$this -> db -> where("a.Quality_Staff_Id", $this -> EUI_Session->_get_session('UserId') );
		foreach( $this -> db ->get() -> result_assoc() as $rows )
		{
			$_list_agents[$rows['UserId']] = $rows['UserId'];
		}	
	}
	
	return $_list_agents;
} 
 
/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 
 private function _getApprovalInterest()
 {
	$_conds = array();
	if(class_exists('M_SetCallResult'))
	{
		$i = 0;
		foreach( $this -> M_SetCallResult -> _getEventSale() as $k => $rows )
		{
			$_conds[$i] = $k;
			$i++;
		}
	}
	return $_conds;
 }
 
 /*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 
 private function _getQualityConfirm()
 {
	$_conds = array();
	if(class_exists('M_SetResultQuality'))
	{
		$i = 0;
		foreach( $this -> M_SetResultQuality -> _getQualityConfirm() as $k => $rows )
		{
			$_conds[$i] = $k;
			$i++;
		}
	}
	return $_conds;
 }
 
 /*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
public function _get_default()
{
	/* get instance class outbound **/	
	
	$CallDirection =& M_ModOutBoundGoal::get_instance();
	$this->EUI_Page->_setPage($this->set_limit_page);
	$this->EUI_Page->_setSelect("a.AssignId",FALSE);
	$this->EUI_Page->_setFrom("t_gn_assignment a ");
	$this->EUI_Page->_setJoin("t_gn_customer b ","a.CustomerId=b.CustomerId","INNER");
	$this->EUI_Page->_setJoin("tms_agent c ","b.SellerId=c.UserId","INNER");
	$this->EUI_Page->_setJoin("tms_agent d ","c.tl_id=d.UserId","LEFT");
	$this->EUI_Page->_setJoin("t_lk_callreason e ","b.CallReasonId=e.CallReasonId","LEFT");
	$this->EUI_Page->_setJoin("t_gn_campaign f ","b.CampaignId=f.CampaignId","INNER");
	$this->EUI_Page->_setJoin("t_gn_quality_assignment g ","g.Assign_Data_Id=b.CustomerId","LEFT");

	$this->EUI_Page->_setWhere("AND e.CallReasonId BETWEEN 44 AND 107" , "");
	$this->EUI_Page->_setWhereNotIn("e.CallReasonId" , array("99") );
	/* 	level login quality staff **/

	if( $this -> EUI_Session->_get_session('HandlingType') == USER_LEADER ){
		$this -> EUI_Page->_setAnd("g.SPV_Id", $this -> EUI_Session->_get_session('UserId') );
	}
	
// ------------------- filtring by keep session  ---------------------------------------
	
	$this->EUI_Page->_setAndCache("b.CustomerFirstName", "qty_cust_name", true);
	$this->EUI_Page->_setAndCache("b.CustomerNumber", "qty_cust_number", true);
	$this->EUI_Page->_setAndCache("f.CampaignId", "qty_campaign_id", true);
	$this->EUI_Page->_setAndCache("b.ProductId", "qty_category_id", true);
	$this->EUI_Page->_setAndOrCache("a.AssignSelerId", "qty_user_id", true);
	$this->EUI_Page->_setAndCache("e.CallReasonId", "qty_call_result", true);
	
// ------- set group by ------------------------------------------------------------------
	
	$this->EUI_Page->_setGroupBy('b.CustomerId');  
	if($this -> EUI_Page -> _get_query())
	{
		return $this -> EUI_Page;
	}	 
	
	
 }
 
 /*
 * @ def 		: _get_resource // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
  
 public function _get_content()
 {
 
   // instance of class **/
   	
/*
select 
f.CampaignName as CampaignName ,
b.Recsource as Recsource , 
b.CustomerFirstName as CustomerName , 
c.code_user as AgentId , 
d.code_user as SPVId , 
e.CallReasonDesc as CallReason , 
sum(g.duration) as TalkTime 
from t_gn_assignment a
inner join t_gn_customer b on a.CustomerId=b.CustomerId
inner join tms_agent c on b.SellerId=c.UserId
left join tms_agent d on c.tl_id=d.UserId
left join t_lk_callreason e on b.CallReasonId=e.CallReasonId
inner join t_gn_campaign f on b.CampaignId=f.CampaignId
left join cc_recording g on a.CustomerId=g.assignment_data
where a.AssignLeader in(31,32)
and e.CallReasonId between 44 and 107
and e.CallReasonId not in(99)
group by a.CustomerId;
*/

	
	$this->EUI_Page->_postPage(_get_post('v_page') );
	$this->EUI_Page->_setPage($this->set_limit_page);
	$this->EUI_Page->_setArraySelect(array(
		"b.CustomerId as CustomerId" => array("CustomerId","CustomerId", "primary"),
		"f.CampaignName as CampaignName" => array("CampaignName", "Campaign Name"), 
		//"c.CustomerNumber as CustomerNumber" => array("CustomerNumber", "CIF"),
		"b.CustomerFirstName as CustomerFirstName" => array("CustomerFirstName", "Customer Name"), 
		//"c.CustomerDOB as CustomerDOB" => array("CustomerDOB","DOB"),
		"b.CustomerDOB as CustomerAge" => array("CustomerAge","Age"),
		"c.code_user as AgentId" =>  array("AgentId","Agent ID"),
		"d.code_user as SPVId" =>  array("SPVId","SPV ID"),
		"h.StatusAccurate as StatusAccurate" =>  array("StatusAccurate","Status Accurate"),	
		"(SELECT SUM(a.duration) as Duration FROM cc_recording a 
			WHERE a.assignment_data = b.CustomerId
			GROUP BY a.assignment_data ) As Duration"=> array("Duration","Duration")
	));
	
	$this->EUI_Page->_setFrom("t_gn_assignment a ");
	$this->EUI_Page->_setJoin("t_gn_customer b ","a.CustomerId=b.CustomerId","INNER");
	$this->EUI_Page->_setJoin("tms_agent c ","b.SellerId=c.UserId","INNER");
	$this->EUI_Page->_setJoin("tms_agent d ","c.tl_id=d.UserId","LEFT");
	$this->EUI_Page->_setJoin("t_lk_callreason e ","b.CallReasonId=e.CallReasonId","LEFT");
	$this->EUI_Page->_setJoin("t_gn_campaign f ","b.CampaignId=f.CampaignId","INNER");
	$this->EUI_Page->_setJoin("t_gn_quality_assignment g ","g.Assign_Data_Id=b.CustomerId","LEFT");
	$this->EUI_Page->_setJoin("t_gn_score_accurated h ","h.CustomerId=b.CustomerId","LEFT");
	$this->EUI_Page->_setWhere("AND e.CallReasonId BETWEEN 44 AND 107" , "");
	$this->EUI_Page->_setWhereNotIn("e.CallReasonId" , array("99") );

	/* 	level login quality staff **/

	if( $this -> EUI_Session->_get_session('HandlingType') == USER_LEADER ){
		$this -> EUI_Page->_setAnd("g.SPV_Id", $this -> EUI_Session->_get_session('UserId') );
	}
	
	/* filter next data if not empty filter **/
	
	$QualityId = array_keys($this->M_SetResultQuality->_getQualityResult());
	
	
// --- filtring by keep session 
	$this->EUI_Page->_setAndCache("b.CustomerFirstName", "qty_cust_name", true);
	$this->EUI_Page->_setAndCache("b.CustomerNumber", "qty_cust_number", true);
	$this->EUI_Page->_setAndCache("f.CampaignId", "qty_campaign_id", true);
	$this->EUI_Page->_setAndCache("b.ProductId", "qty_category_id", true);
	$this->EUI_Page->_setAndOrCache("a.AssignSelerId", "qty_user_id", true);
	$this->EUI_Page->_setAndCache("e.CallReasonId", "qty_call_result", true);
	$this->EUI_Page->_setGroupBy('b.CustomerId');
	
// -----------if have order sorted ---------------------------------

  if( _get_have_post("order_by") ){
	$this->EUI_Page->_setOrderBy(_get_post("order_by"), _get_post("type"));
   } else {
	$this->EUI_Page->_setOrderBy("a.AssignId", "DESC");
  }	

   $this->EUI_Page ->_setLimit();

	//echo $this->EUI_Page ->_getCompiler();

	
 }
 
 
/*
 * @ def 		: _get_resource // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
public function _get_resource()
 {
	self::_get_content();
	if( $this -> EUI_Page -> _get_query()!='') 
	{
		return $this -> EUI_Page -> _result();
	}	
 }
 
/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
public function _get_page_number() 
 {
	if( $this -> EUI_Page -> _get_query()!='' ) {
		return $this -> EUI_Page -> _getNo();
	}	
 }
 
/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 function _getCountVoice($CustomerId=0)
 {
	$_count = 0;
	$this -> db -> select("count(a.id) as jumlah",FALSE);
	$this -> db -> from("cc_recording a");
	
	if( $rows = $this -> db -> get() -> result_first_assoc() ){
		$_count = (INT)$rows['jumlah']; 
	}
	
	return $_count;
 }
 
/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 function _getPages($CustomerId=0)
 {
	$PagesList = array();
	
	$record = $this -> _getCountVoice();
	$counts = ceil($record/5);
	
	for($p = 1; $p <= (INT)$counts; $p++) {
		$PagesList[$p] = $p;
	}
	
	return $PagesList;
	
 }
 

/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 function _getLastCallHistory($CustomerId)
 {
	$_conds = array();
	
	$this -> db -> select('*');
	$this -> db -> from('t_gn_callhistory');
	$this -> db -> where('CustomerId',$CustomerId);
	
	if( $avail = $this -> db -> get()->result_first_assoc() )
	{
		$_conds = $avail;
	}
	
	return $_conds;
 }
 
/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
  function _getListVoice($param = array() )
 {
	$_voice = array();
	
 // $start
	$start = 0; $perpages = 5; 
	
 // total page 
	
	$record = $this -> _getCountVoice();
	$pages = ceil($record/$perpages);
	
	//  get start pages 
	
	if( isset($param['pages']) ){
		if( (INT)$param['pages'] > 0 )
			$start = ( (($param['pages'])-1) * $perpages); 
		else
			$start = 0;
	}
	
	// run data 
	
	$this -> db -> select("*");
	$this -> db -> from("cc_recording a");
	$this -> db -> limit($perpages,$start);
	
	// get query result
	
	$qry = $this->db->get();
	$num = $start+1;
	foreach($qry -> result_assoc() as $rows )
	{
		$_voice[$num] = $rows;	
		$num++;
	}	
	return $_voice;
 }
 
 
 
 /* get rows data **/
 
 function _getVoiceResult($VoiceId=0 )
 {
	$this -> db -> select("*");
	$this -> db -> from("cc_recording a");
	$this -> db -> where('id',$VoiceId);
	
	$_result =  array();
	
	if( $_conds = $this -> db->get() -> result_first_assoc() )
	{
		foreach($_conds as $fld => $values )
		{
			if( $fld=='file_voc_size' ) 
				$_result[$fld] = $this->EUI_Tools->_get_format_size($values);
				
			else if( $fld=='duration' ) 
				$_result[$fld] = $this->EUI_Tools->_set_duration($values);
				
			else if( $fld=='anumber' ) 
				$_result[$fld] = $this->EUI_Tools->_getPhoneNumber($values);	
				
			else if( $fld=='start_time' ) 
				$_result[$fld] = $this->EUI_Tools->_datetime_indonesia($values);	
				
			else 
				$_result[$fld] = $values;
		}
		
		return $_result;
	}
	else
		return null;
 }
 

 
public function _getQtyCount( $CustomerId = 0 )
{
	$count = 0;
	
	$this->db->select("COUNT(a.Id) as jumlah",FALSE);
	$this->db->from("t_gn_scoring_point a ");
	$this->db->where("a.CustomerId",$CustomerId); 
	
	if( $rows = $this->db->get()->result_first_assoc() ) 
	{
		$count = (INT)$rows['jumlah'];
	}
	
	return $count;
} 



 /*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */ 
 

 public function _saveQualityValues( $param = null  )
 {
   $InsertId = 0;
   if( is_array($param) ) 
   {
		$this->db->set('CustomerId',$param['CustomerId']);
		$this->db->set('ScoringRemark',strtoupper($param['remarks']));
		$this->db->set('ScroingQualityId',$this -> EUI_Session->_get_session('UserId'));
		$this->db->set('ScoringCreateTs',date('Y-m-d H:i:s'));
		$this->db->insert('t_gn_qa_scoring');
		if( $this->db->affected_rows() > 0 )
			$InsertId = $this -> db->insert_id();
	}	
		
	return $InsertId;
 }
 /*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */ 
 
 public function _setSaveScoreQuality( $param = NULL )
 {
	$_conds = 0;
	 if( !is_null($param) AND is_array( $param ) ) {

		$header_score  = isset($param["header_score"]) ? $param["header_score"] : null;
		$section1	   = isset($param["section1"])  ? $param["section1"] : null;
		$section2 	   = isset($param["section2"])  ? $param["section2"] : null;
		$section3 	   = isset($param["section3"])  ? $param["section3"] : null;
		$section4 	   = isset($param["section4"])  ? $param["section4"] : null;
		$section5 	   = isset($param["section5"])  ? $param["section5"] : null;
		$Rapport       = isset($param["Rapport"])   ? $param["Rapport"] : null;
		$Ownership     = isset($param["Ownership"]) ? $param["Ownership"] : null;
		$Communication = isset($param["Communication"]) ? $param["Communication"] : null;

		if ( !is_null($header_score) AND is_array($header_score) ) {
			$this->db->set("Name_Of_Agent" , $header_score["Name_Of_Agent"]);
			$this->db->set("Agent_ID" 	, $header_score["Agent_ID"]);
			$this->db->set("Evaluator_Name" , $header_score["Evaluator_Name"]);
			$this->db->set("Customer_Segment" , $header_score["Customer_Segment"]);
			$this->db->set("New_Skill" , $header_score["New_Skill"]);
			$this->db->set("PVC" , $header_score["PVC"]);
			$this->db->set("In_Academy" , $header_score["In_Academy"]);
			$this->db->set("Language" , $header_score["Language"]);
			$this->db->set("Date_Of_Call" , $header_score["Date_Of_Call"]);
			$this->db->set("Time_Of_Call" , $header_score["Time_Of_Call"]);
			$this->db->set("Date_Of_Evaluation" , $header_score["Date_Of_Evaluation"]);
			$this->db->set("Time_Of_Evaluation" , $header_score["Time_Of_Evaluation"]);
			$this->db->set("Site" , $header_score["Site"]);
			$this->db->set("Call_Type" , $header_score["Call_Type"]);
			$this->db->set("Risk_Type" , $header_score["Risk_Type"]);
			$this->db->set("In_Score" , $header_score["In_Score"]);
			$this->db->set("Enter_New_Score" , $header_score["Enter_New_Score"]);
			$this->db->set("General_Call_Feedback" , $header_score["General_Call_Feedback"]);
		}

		if ( !is_null($section1) AND is_array($section1) ) {
				$this->db->set("Score_Section1" , json_encode($section1) );
		} else {
			echo 1;
		}

		if ( !is_null($section2) AND is_array($section2) ) {
				$this->db->set("Score_Section2" , json_encode($section2) );
		}

		if ( !is_null($section3) AND is_array($section3) ) {
				$this->db->set("Score_Section3" , json_encode($section3) );
		}

		if ( !is_null($section4) AND is_array($section4) ) {
				$this->db->set("Score_Section4" , json_encode($section4) );
		}

		if ( !is_null($section5) AND is_array($section5) ) {
				$this->db->set("Score_Section5" , json_encode($section5) );
		}

		if ( !is_null($Rapport) AND is_array($Rapport) ) {
				$this->db->set("Rapport_Attr1" , $Rapport["Rapport_Attr1"] );
				$this->db->set("Rapport_Attr2" , $Rapport["Rapport_Attr2"] );
				$this->db->set("Rapport_Attr3" , $Rapport["Rapport_Attr3"] );
				$this->db->set("Rapport_Attr4" , $Rapport["Rapport_Attr4"] );
				$this->db->set("Rapport_Attr5" , $Rapport["Rapport_Attr5"] );
		}
		if ( !is_null($Ownership) AND is_array($Ownership) ) {
				$this->db->set("Ownership_Attr1" , $Ownership["Ownership_Attr1"]);
				$this->db->set("Ownership_Attr2" , $Ownership["Ownership_Attr2"]);
				$this->db->set("Ownership_Attr3" , $Ownership["Ownership_Attr3"]);
				$this->db->set("Ownership_Attr4" , $Ownership["Ownership_Attr4"]);
				$this->db->set("Ownership_Attr5" , $Ownership["Ownership_Attr5"]);
		}
		if ( !is_null($Communication) AND is_array($Communication) ) {
				$this->db->set("Communication_Attr1" , $Communication["Communication_Attr1"] );
				$this->db->set("Communication_Attr2" , $Communication["Communication_Attr2"]);
				$this->db->set("Communication_Attr3" , $Communication["Communication_Attr3"]);
				$this->db->set("Communication_Attr4" , $Communication["Communication_Attr4"]);
				$this->db->set("Communication_Attr5" , $Communication["Communication_Attr5"]);
		}

		$this->db->set("CustomerId" , $param["CustomerId"]);
		$this->db->set("CreateById" , _get_session("UserId"));
		$this->db->set("Status_Callmon" , $param["Status_Callmon"] );

		$this->db->insert_on_duplicate("t_gn_score_result");

		//echo $this->db->last_query();
		
		if( $this->db->affected_rows() > 0 )
			$CheckItInsert = $this->db->affected_rows();
		echo $CheckItInsert;

	}
	
	
	return $_conds;
 }
 
 
}
?>
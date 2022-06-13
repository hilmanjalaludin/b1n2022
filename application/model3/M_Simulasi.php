<?php 
class M_Simulasi extends EUI_Model
{
	
	
 private static $Instance = null;	
 
// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
 
 public static function &Instance()
{
 
 if( is_null(self::$Instance) ){
	self::$Instance = new self();
 }
 return self::$Instance;
}

// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
 
function __construct(){ }	

// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
 public function _select_attr_product( $ProductPlanId = 0 )
{
	$this->db->reset_select();
	$this->db->select("a.*, b.ProductName", FALSE);
	$this->db->from("t_gn_productplan a ");
	$this->db->join("t_gn_product b ","a.ProductId=b.ProductId","LEFT");
	$this->db->where("a.ProductPlanId", $ProductPlanId);
	
	$rs = $this->db->get();
	 if( $rs->num_rows() > 0 )
	{
		return new EUI_Object( $rs->result_first_assoc() );
	}
	return new EUI_Object( array() );
} 

// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
 
function _select_page_product_benefit( $out = null )
{	
	$attr = $this->_select_attr_product( $out->get_value('ProductPlanId'));
	
	$arr_call_history = array();
	$this->db->reset_select();
	
	$this->db->select("	
		a.ProductPlan as PlanId,
		(select pln.ProductPlanName 
			from t_gn_productplan pln 
		where pln.ProductPlan=a.ProductPlan 
		limit 1 )  as Plan,
		a.ProductPlanBenefitDesc as ProductPlanBenefitDesc,
		a.ProductPlanBenefit as ProductPlanBenefit", 
	FALSE);
	
	$this->db->from("t_gn_productplanbenefit a ");
	$this->db->where("a.ProductId", $attr->get_value('ProductId','intval')); 
	$this->db->where("a.ProductPlan", $attr->get_value('ProductPlan','intval')); 
	
  if( _get_have_post("orderby") ){
	$this->db->order_by(_get_post("orderby"), _get_post("type"));
   } else {
	$this->db->order_by("a.ProductPlan", "ASC");
   }
	
	$rs = $this->db->get();
	 if( $rs->num_rows() > 0 )
	  {
		  $arr_call_history = (array)$rs->result_assoc();
	  }
	  return (array)$arr_call_history;

}

// -----------------------------------------------------------

/* 
 * Method 		AddUser 
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
function _select_page_product_premi( $out = null )
{
   $arr_call_history = array();
  
   if( !$out->fetch_ready()) 
  { 
	return (array)$arr_call_history;
  }
  
  if( !_get_have_post('ProductId') ){
	  return (array)$arr_call_history;
  }
  
  
  $this->db->reset_select();
  $this->db->select("
	a.ProductPlanId As ProductPlanId, 
	b.ProductName As ProductName, 
	c.PayMode As PayMode, 
	d.Gender As Gender, 
	e.PremiumGroupName As PremiGroup, 
	( SELECT pn.ProductPlanLevel 
		FROM t_gn_plan_name pn 
	 WHERE pn.ProductPlanId=a.ProductPlan 
		AND pn.ProductId =a.ProductId 
	) as PlanLevel,
	a.ProductPlanName As PlanName, 
	a.ProductPlanAgeStart As StartAge, 
	a.ProductPlanAgeEnd As EndAge, 
	a.ProductPlanPremium As Premi", 
	FALSE);
	
// from t_gn_productplan a

  $this->db->from('t_gn_productplan a');
  $this->db->join('t_gn_product b','a.ProductId=b.ProductId','LEFT');
  $this->db->join('t_lk_paymode c','a.PayModeId=c.PayModeId','LEFT');
  $this->db->join('t_lk_gender d ','a.GenderId=d.GenderId','LEFT');
  $this->db->join('t_lk_premiumgroup e','a.PremiumGroupId=e.PremiumGroupId', 'LEFT');
	
// -----------------------------------------------------------
	
  if( _get_have_post('ProductId') ){
	$this->db->where("a.ProductId", $out->get_value('ProductId', 'intval'));
	
  }
// -----------------------------------------------------------
  if( _get_have_post('GroupPremi') ){
	$this->db->where("a.PremiumGroupId", $out->get_value('GroupPremi', 'intval'));
  }
// -----------------------------------------------------------  
  if( _get_have_post('PaymentMode') ){
	$this->db->where("a.PayModeId", $out->get_value('PaymentMode', 'intval'));
  }
  
 // ----------------------------------------------------------- 
  if( _get_have_post('GenderId') ){
	$this->db->where("a.GenderId", $out->get_value('GenderId', 'intval'));
  }  
  
 // ----------------------------------------------------------- 
  
  if( _get_have_post('AgeStart') ){
	$StartAge = $out->get_value('AgeStart');
	$this->db->where("a.ProductPlanAgeStart>='{$StartAge}' 
		AND a.ProductPlanAgeStart<='{$StartAge}'", "", FALSE);
  }  
 // -----------------------------------------------------------

  if( _get_have_post('AgeEnd') ){
	$EndAge = $out->get_value('AgeEnd');
	$this->db->where("a.ProductPlanAgeEnd>='{$EndAge}' 
		AND a.ProductPlanAgeEnd<='{$EndAge}'", "", FALSE);
  }   
// -----------------------------------------------------------	
 if( _get_have_post("orderby") ){
	$this->db->order_by(_get_post("orderby"), _get_post("type"));
  } else {
	$this->db->order_by("a.ProductPlanId", "ASC");
  }
 
 // echo $this->db->print_out();

  $rs = $this->db->get();
  if( $rs->num_rows() > 0 ){
	  $arr_call_history = (array)$rs->result_assoc();
  }
  return (array)$arr_call_history;

}


 
// ============= END CLASS ==========================	
}

?>
<?php 
class M_ProductBniLifeActive extends EUI_Model
{
	
// ------------------------------------------------------------
/*
 * @ package get age my insured selected row .
 */
 
 
 private static $Instance = null;
 public static function & Instance() 
{
	if( is_null(self::$Instance))
	{
		self::$Instance = new self();
	}
	return self::$Instance;
}


// ------------------------------------------------------------
/*
 * @ package get age my insured selected row .
 */
 
 
function __construct() { 
	$this->load->model(array('M_ProductForm'));
}

// -------------------------- get insured ID By ref Policy ID -----------------------------------


 protected function _select_insured_policy( $PolicyId  = 0 )
{
	$this->db->reset_select();
	$this->db->select("a.*", FALSE);
	$this->db->from("t_gn_insured a ");
	$this->db->where("a.PolicyId", $PolicyId);
	$rs = $this->db->get();
	if( $rs->num_rows() > 0 ){
		return new EUI_Object( $rs->result_first_assoc() );
	} else {
		return new EUI_Object( array() );
	}
}
 
// ---------------------- Personal Premi Data ---------------------------------------------------
  
 function _select_personal_premi( $arr_cond = array() )
{	

	$out = new EUI_Object( $arr_cond );
	$totals = array( 'ProductPlanId' => 0, 'ProductPlanPremium' => 0);
	
	$this->db->reset_select();
	$this->db->select('a.ProductPlanId, a.ProductPlanPremium');
	$this->db->from('t_gn_productplan a');
	
// --------- ProductId  --------------		
	$this->db->where('a.ProductId', $out->get_value('ProductId','intval'), FALSE);
	$this->db->where('a.PremiumGroupId', $out->get_value('GroupPremi','intval'), FALSE);
	$this->db->where('a.PayModeId', $out->get_value('PayMode','intval'), FALSE);
	$this->db->where('a.ProductPlan', $out->get_value('PlanId','intval'), FALSE);
	$this->db->where('a.GenderId', $out->get_value('GenderId','intval'), FALSE);
	$this->db->where("{$out->get_value('PersonalAge','intval')} BETWEEN a.ProductPlanAgeStart AND a.ProductPlanAgeEnd", NULL , FALSE);	
	
	//echo $this->db->print_out();
	
	$rs = $this->db->get();
	 if( $rs->num_rows() == 1 )
	{
		return new EUI_Object((array)$rs->result_first_assoc());
	}	
	
	return array();	
}

// ------------------------------------------------------------
/* @ package 		set_save_row_policy_autogen  <t_gn_beneficiary>
 *
 */
 
protected function _set_save_row_policy_benefiecery( $out=null, $PolicyNumber = ""  )
{
 if( !is_object($out) OR !$out->fetch_ready() 
	OR strlen($PolicyNumber) == 0  )
{
	return FALSE;
 }
	
 $Benefiecery = $out->get_array_value('Benefiecery');
 if( count( $Benefiecery) == 0 ){
	return FALSE;
 } 
	
// ---------- set data benefiecery -----------------------------------------\
	
 $cond = 0;
 if( is_array( $Benefiecery ) )
	foreach( $Benefiecery as $key => $Prefix ) 
{
	$this->db->reset_write();	
	$this->db->set("BenefieceryPrefix", $Prefix);
	$this->db->set("PolicyNumber", $PolicyNumber); 
	$this->db->set("CustomerId", $out->get_value('CustomerId','intval')); 
	$this->db->set("SalutationId", $out->get_value(join("_", array("BenefSalutationId", $Prefix)),'intval'));
	$this->db->set("GenderId", $out->get_value(join("_", array("BenefGenderId", $Prefix)),'intval'));
	$this->db->set("RelationshipTypeId", $out->get_value(join("_", array("BenefRelationshipTypeId", $Prefix)),'intval'));
	$this->db->set("BeneficiaryFirstName", $out->get_value(join("_", array("BenefFirstName", $Prefix)),'strtoupper'));
	$this->db->set("BeneficiaryLastName", $out->get_value(join("_", array("BenefLastName", $Prefix)),'strtoupper'));
	$this->db->set("BeneficiaryDOB", $out->get_value(join("_", array("BenefDOB", $Prefix)),'_getDateEnglish'));
	$this->db->set("BeneficiaryAge", $out->get_value(join("_", array("BenefAge", $Prefix)),'strval'));
	$this->db->set("BeneficieryPercentage", $out->get_value(join("_", array("BeneficieryPercentage", $Prefix)),'strval'));
	$this->db->set("CreatedById", _get_session('UserId'));
	$this->db->set("BeneficiaryCreatedTs", date('Y-m-d H:i:s'));
	
	// --------- jika terjadi duplikasi data ------------------------------
		
	$this->db->duplicate("SalutationId", $out->get_value(join("_", array("BenefSalutationId", $Prefix)),'intval'));
	$this->db->duplicate("GenderId", $out->get_value(join("_", array("BenefGenderId", $Prefix)),'intval'));
	$this->db->duplicate("RelationshipTypeId", $out->get_value(join("_", array("BenefRelationshipTypeId", $Prefix)),'intval'));
	$this->db->duplicate("BeneficiaryFirstName", $out->get_value(join("_", array("BenefFirstName", $Prefix)),'strtoupper'));
	$this->db->duplicate("BeneficiaryLastName", $out->get_value(join("_", array("BenefLastName", $Prefix)),'strtoupper'));
	$this->db->duplicate("BeneficiaryDOB", $out->get_value(join("_", array("BenefDOB", $Prefix)),'_getDateEnglish'));
	$this->db->duplicate("BeneficiaryAge", $out->get_value(join("_", array("BenefAge", $Prefix)),'strval'));
	$this->db->duplicate("BeneficieryPercentage", $out->get_value(join("_", array("BeneficieryPercentage", $Prefix)),'strval'));
	$this->db->duplicate("UpdatedById", _get_session('UserId'));
	$this->db->duplicate("BeneficiaryUpdatedTs", date('Y-m-d H:i:s'));
	
	if( $this->db->insert_on_duplicate("t_gn_beneficiary") ){
		$cond ++;
	}

 }
 
 return (int)$cond;
}


// ------------------------------------------------------------
/* @ package 		set_save_row_policy_autogen  <t_gn_policy>
 *
 */
 
protected function _select_policy_number_product_customer($ProductId = 0, $CustomerId = 0)
{
	$this->db->reset_select();
	$this->db->select("count(a.PolicyAutoGenId) as jumlah, a.PolicyNumber, a.PolicyLastNumber", FALSE);
	$this->db->from("t_gn_policyautogen a");
	$this->db->where("a.ProductId", $ProductId);
	$this->db->where("a.CustomerId", $CustomerId);
	$rs = $this->db->get();
	
	if($rs->num_rows() > 0 ){
	   if( $rows = $rs->result_first_assoc() )
	   {	
		   if( (int)$rows['jumlah'] > 0  ) {
				return (array)$rows;	
		   } else {
			   return FALSE;
		   }	   
	   }
	}
	return FALSE;

} 
// ------------------------------------------------------------
/* @ package 		set_save_row_policy_autogen  <t_gn_policy>
 *
 */
 
 public function _select_row_policy_number_autogen_id( $AutogenId = 0 ) 
{
	$this->db->reset_select();
	$this->db->select("PolicyNumber", false);
	$this->db->from("t_gn_policyautogen");
	$this->db->where("PolicyAutoGenId", $AutogenId);
	
	$rs = $this->db->get();
	if( $rs->num_rows() > 0 )
	{
		$PolicyAutoGenId = $rs->result_singgle_value(); 
		if( strlen($PolicyAutoGenId) > 0 )
		{
			return (string)$PolicyAutoGenId;
		} else {
			return FALSE;
		}
	}
	return false;
}	

// ------------------------------------------------------------
/* @ package 		set_save_row_policy_autogen  <t_gn_policy>
 *
 */
 
 public function _select_row_policy_number_autogen_policy( $PolicyNumber = 0 ) 
{
	$this->db->reset_select();
	$this->db->select("PolicyAutoGenId", false);
	$this->db->from("t_gn_policyautogen");
	$this->db->where("PolicyNumber", $PolicyNumber);

	$rs = $this->db->get();
	if( $rs->num_rows() > 0 )
	{
		$PolicyAutoGenId = $rs->result_singgle_value(); 
		if( strlen($PolicyAutoGenId) > 0 )
		{
			return (string)$PolicyAutoGenId;
		} else {
			return FALSE;
		}
	}
	return false;
}	


// ------------------------------------------------------------
/* @ package 		set_save_row_policy_autogen  <t_gn_policy>
 *
 */
 
 protected function _set_save_row_policy_general( $out = null ) 
{
 $cond = 0;
 if( !is_array($out) ) {  return $cond; }
	
 $out = new EUI_Object( $out );
	
 // --- reset cache --------------------------------------------------------
	
 $this->db->reset_write();
 $this->db->set("PolicyId", $out->get_value('PolicyId','intval'));
 $this->db->set("ProductPlanId",$out->get_value('ProductPlanId','intval')); 
 $this->db->set("PolicyNumber", $out->get_value('PolicyNumber','strval'));
 $this->db->set("PolicySalesDate", $out->get_value('PolicyEffectiveDate','strval'));
 $this->db->set("PolicyEffectiveDate", $out->get_value('PolicyEffectiveDate','strval'));
 $this->db->set("PolicyPremi",$out->get_value('PolicyPremi','strval'));
 $this->db->set("PolicyPrefix", $out->get_value('PolicyPrefix','strval'));

// jika terjadi duplikasi data  --------------------------------
 
 $this->db->duplicate("ProductPlanId",$out->get_value('ProductPlanId','intval')); 
 $this->db->duplicate("PolicyNumber", $out->get_value('PolicyNumber','strval'));
 $this->db->duplicate("PolicyEffectiveDate", $out->get_value('PolicyEffectiveDate','strval'));
 $this->db->duplicate("PolicyPremi",$out->get_value('PolicyPremi','strval'));
 
 $this->db->insert_on_duplicate("t_gn_policy");

  if( $this->db->affected_execute() ) {
	 $cond = (int)$this->db->insert_id();	
 }

return $cond;

}
// ------------------------------------------------------------
/* @ package 		set_save_row_policy_autogen  <t_gn_beneficiary>
 *
 */
 
protected function _set_save_row_policy_payer( $out=null ) {
	$cond = 0;
	if( !is_array($out) ) { 
		return $cond;
	}
	
	$out = new EUI_Object( $out );
	
// ------- saving data --------------------------------
	
	$this->db->reset_write();
	$this->db->set("CustomerId", $out->get_value('CustomerId','strval'));
	$this->db->set("PolicyNumber", $out->get_value('PolicyNumber','strval'));
	$this->db->set("PolicyPrefix", $out->get_value('PolicyPrefix','strval'));
	$this->db->set("SalutationId", $out->get_value('SalutationId','strval'));
	$this->db->set("GenderId", $out->get_value('GenderId','strval'));
	$this->db->set("IdentificationTypeId", $out->get_value('IdentificationTypeId','strval'));
	$this->db->set("PremiumGroupId", $out->get_value('PremiumGroupId','strval'));
	$this->db->set("RelationshipTypeId", $out->get_value('RelationshipTypeId','strval'));
	$this->db->set("PaymentTypeId", $out->get_value('PaymentTypeId','strval'));
	$this->db->set("PayersBankId", $out->get_value('PayersBankId','strval'));
	$this->db->set("CreditCardTypeId", $out->get_value('CreditCardTypeId','strval'));
	$this->db->set("ValidCCPrefixId", $out->get_value('ValidCCPrefixId','strval'));
	$this->db->set("PayerFirstName", $out->get_value('PayerFirstName','strval'));
	$this->db->set("PayerLastName", $out->get_value('PayerLastName','strval'));
	$this->db->set("PayerDOB", $out->get_value('PayerDOB','strval'));
	$this->db->set("PayerAge", $out->get_value('PayerAge','strval'));
	$this->db->set("PayerIdentificationNum", $out->get_value('PayerIdentificationNum','strval'));
	$this->db->set("PayerAddressLine1", $out->get_value('PayerAddressLine1','strval'));
	$this->db->set("PayerAddressLine2", $out->get_value('PayerAddressLine2','strval'));
	$this->db->set("PayerAddressLine3", $out->get_value('PayerAddressLine3','strval'));
	$this->db->set("PayerAddressLine4", $out->get_value('PayerAddressLine4','strval'));
	$this->db->set("ProvinceId", $out->get_value('ProvinceId','strval'));
	$this->db->set("PayerZipCode", $out->get_value('PayerZipCode','strval'));
	$this->db->set("PayerCity", $out->get_value('PayerCity','strval'));
	$this->db->set("PayerCountry", $out->get_value('PayerCountry','strval'));
	$this->db->set("PayerHomePhoneNum", $out->get_value('PayerHomePhoneNum','strval'));
	$this->db->set("PayerMobilePhoneNum", $out->get_value('PayerMobilePhoneNum','strval'));
	$this->db->set("PayerWorkPhoneNum", $out->get_value('PayerWorkPhoneNum','strval'));
	$this->db->set("PayerOfficePhoneNum", $out->get_value('PayerOfficePhoneNum','strval'));
	$this->db->set("PayerWorkExtPhoneNum", $out->get_value('PayerWorkExtPhoneNum','strval'));
	$this->db->set("PayerFaxNum", $out->get_value('PayerFaxNum','strval'));
	$this->db->set("PayerAdditionalPhone1", $out->get_value('PayerAdditionalPhone1','strval'));
	$this->db->set("PayerAdditionalPhone2", $out->get_value('PayerAdditionalPhone2','strval'));
	$this->db->set("PayerEmail", $out->get_value('PayerEmail','strval'));
	$this->db->set("PayerCreditCardNum", $out->get_value('PayerCreditCardNum','strval'));
	$this->db->set("PayerOfficeName", $out->get_value('PayerOfficeName','strval'));
	$this->db->set("PayerCreditCardExpDate", $out->get_value('PayerCreditCardExpDate','strval'));
	$this->db->set("PayerCreatedTs", $out->get_value('PayerCreatedTs','strval'));
	$this->db->set("PayersKodeAreaHome", $out->get_value('PayersKodeAreaHome','strval'));
	$this->db->set("PayersKodeAreaOffice", $out->get_value('PayersKodeAreaOffice','strval'));
	$this->db->set("PayerPlaceOfBirth", $out->get_value('PayerPlaceOfBirth','strval'));
	$this->db->set("PayerAddressState", $out->get_value('PayerAddressState','strval'));
	$this->db->set("PayerOptOut", $out->get_value('PayerOptOut','strval'));
	$this->db->set("PayerEfulfillmentIndicator", $out->get_value('PayerEfulfillmentIndicator','strval'));
	$this->db->set("PayerMaritalStatus", $out->get_value('PayerMaritalStatus','strval'));
	$this->db->set("PayerValidation", $out->get_value('PayerValidation','strval'));
	$this->db->set("PayerValidDate", $out->get_value('PayerValidation','strval'));
	$this->db->set("CreatedById", $out->get_value('CreatedById','strval'));
	$this->db->set("PayerPreferedComunication", $out->get_value('CreatedById','strval'));
	$this->db->set("PayerAddrType", $out->get_value('PayerAddrType','strval'));
	
	$this->db->set("PayerMobilePhoneNum2", $out->get_value('PayerMobilePhoneNum2','strval'));
	$this->db->set("PayerHomePhoneNum2", $out->get_value('PayerHomePhoneNum2','strval'));
	$this->db->set("PayerOfficePhoneNum2", $out->get_value('PayerOfficePhoneNum2','strval'));
	
// ------------- jika duplikasidata  -----------------------------------------------------------

	$this->db->duplicate("SalutationId", $out->get_value('SalutationId','strval'));
	$this->db->duplicate("GenderId", $out->get_value('GenderId','strval'));
	$this->db->duplicate("IdentificationTypeId", $out->get_value('IdentificationTypeId','strval'));
	$this->db->duplicate("PremiumGroupId", $out->get_value('PremiumGroupId','strval'));
	$this->db->duplicate("RelationshipTypeId", $out->get_value('RelationshipTypeId','strval'));
	$this->db->duplicate("PaymentTypeId", $out->get_value('PaymentTypeId','strval'));
	$this->db->duplicate("PayersBankId", $out->get_value('PayersBankId','strval'));
	$this->db->duplicate("CreditCardTypeId", $out->get_value('CreditCardTypeId','strval'));
	$this->db->duplicate("ValidCCPrefixId", $out->get_value('ValidCCPrefixId','strval'));
	$this->db->duplicate("PayerFirstName", $out->get_value('PayerFirstName','strval'));
	$this->db->duplicate("PayerLastName", $out->get_value('PayerLastName','strval'));
	$this->db->duplicate("PayerDOB", $out->get_value('PayerDOB','strval'));
	$this->db->duplicate("PayerAge", $out->get_value('PayerAge','strval'));
	$this->db->duplicate("PayerIdentificationNum", $out->get_value('PayerIdentificationNum','strval'));
	$this->db->duplicate("PayerAddressLine1", $out->get_value('PayerAddressLine1','strval'));
	$this->db->duplicate("PayerAddressLine2", $out->get_value('PayerAddressLine2','strval'));
	$this->db->duplicate("PayerAddressLine3", $out->get_value('PayerAddressLine3','strval'));
	$this->db->duplicate("PayerAddressLine4", $out->get_value('PayerAddressLine4','strval'));
	$this->db->duplicate("ProvinceId", $out->get_value('ProvinceId','strval'));
	$this->db->duplicate("PayerZipCode", $out->get_value('PayerZipCode','strval'));
	$this->db->duplicate("PayerCity", $out->get_value('PayerCity','strval'));
	$this->db->duplicate("PayerCountry", $out->get_value('PayerCountry','strval'));
	$this->db->duplicate("PayerHomePhoneNum", $out->get_value('PayerHomePhoneNum','strval'));
	$this->db->duplicate("PayerMobilePhoneNum", $out->get_value('PayerMobilePhoneNum','strval'));
	$this->db->duplicate("PayerWorkPhoneNum", $out->get_value('PayerWorkPhoneNum','strval'));
	$this->db->duplicate("PayerOfficePhoneNum", $out->get_value('PayerOfficePhoneNum','strval'));
	$this->db->duplicate("PayerWorkExtPhoneNum", $out->get_value('PayerWorkExtPhoneNum','strval'));
	$this->db->duplicate("PayerFaxNum", $out->get_value('PayerFaxNum','strval'));
	$this->db->duplicate("PayerAdditionalPhone1", $out->get_value('PayerAdditionalPhone1','strval'));
	$this->db->duplicate("PayerAdditionalPhone2", $out->get_value('PayerAdditionalPhone2','strval'));
	$this->db->duplicate("PayerEmail", $out->get_value('PayerEmail','strval'));
	$this->db->duplicate("PayerCreditCardNum", $out->get_value('PayerCreditCardNum','strval'));
	$this->db->duplicate("PayerOfficeName", $out->get_value('PayerOfficeName','strval'));
	$this->db->duplicate("PayerCreditCardExpDate", $out->get_value('PayerCreditCardExpDate','strval'));
	$this->db->duplicate("PayersKodeAreaHome", $out->get_value('PayersKodeAreaHome','strval'));
	$this->db->duplicate("PayersKodeAreaOffice", $out->get_value('PayersKodeAreaOffice','strval'));
	$this->db->duplicate("PayerPlaceOfBirth", $out->get_value('PayerPlaceOfBirth','strval'));
	$this->db->duplicate("PayerAddressState", $out->get_value('PayerAddressState','strval'));
	$this->db->duplicate("PayerOptOut", $out->get_value('PayerOptOut','strval'));
	$this->db->duplicate("PayerEfulfillmentIndicator", $out->get_value('PayerEfulfillmentIndicator','strval'));
	$this->db->duplicate("PayerMaritalStatus", $out->get_value('PayerMaritalStatus','strval'));
	$this->db->duplicate("PayerValidation", $out->get_value('PayerValidation','strval'));
	$this->db->duplicate("PayerValidDate", $out->get_value('PayerValidation','strval'));
	$this->db->duplicate("PayerPreferedComunication", $out->get_value('CreatedById','strval'));
	$this->db->duplicate("PayerAddrType", $out->get_value('PayerAddrType','strval'));
	$this->db->duplicate("PayerUpdatedTs",$out->get_value('PayerUpdatedTs','strval'));
	$this->db->duplicate("UpdatedById", _get_session('UserId'));
	$this->db->duplicate("PayerMobilePhoneNum2", $out->get_value('PayerMobilePhoneNum2','strval'));
	$this->db->duplicate("PayerHomePhoneNum2", $out->get_value('PayerHomePhoneNum2','strval'));
	$this->db->duplicate("PayerOfficePhoneNum2", $out->get_value('PayerOfficePhoneNum2','strval'));
	
	return $this->db->insert_on_duplicate("t_gn_payer");
}	

// ------------------------------------------------------------
/*
 * @ package 		set_save_row_policy_autogen .< t_gn_insured >
 */
   
 protected function _set_save_row_policy_insured( $out = null ) 
{
	$cond = 0;
	if( !is_array($out) ) { 
		return $cond;
	}
	
	$out = new EUI_Object( $out );
	
	$this->db->reset_write();
	$this->db->set("PolicyId",$out->get_value('PolicyId')); 
	$this->db->set("PolicyPrefix", $out->get_value('PolicyPrefix'));
	$this->db->set("PolicyNumber", $out->get_value('PolicyNumber')); 
	$this->db->set("CustomerId",$out->get_value('CustomerId')); 
	$this->db->set("InsuredPayMode",$out->get_value('InsuredPayMode'));
	$this->db->set("PremiumGroupId",$out->get_value('PremiumGroupId'));
	$this->db->set("RelationshipTypeId",$out->get_value('RelationshipTypeId'));
	$this->db->set("InsuredFirstName",$out->get_value('InsuredFirstName'));
	$this->db->set("InsuredLastName",$out->get_value('InsuredLastName'));
	$this->db->set("SalutationId",$out->get_value('SalutationId'));
	$this->db->set("GenderId",$out->get_value('GenderId'));
	$this->db->set("InsuredDOB",$out->get_value('InsuredDOB'));
	$this->db->set("InsuredAge",$out->get_value('InsuredAge'));
	$this->db->set("CreatedById",$out->get_value('CreatedById'));
	$this->db->set("InsuredCreatedTs",$out->get_value('InsuredCreatedTs'));
	$this->db->set("asPayers",$out->get_value('IsPayers'));
	
	
// --------- jika duplikasi data --------------------------------------------------------
		
	$this->db->duplicate("InsuredPayMode",$out->get_value('InsuredPayMode'));
	$this->db->duplicate("PremiumGroupId",$out->get_value('PremiumGroupId'));
	$this->db->duplicate("RelationshipTypeId",$out->get_value('RelationshipTypeId'));
	$this->db->duplicate("InsuredFirstName",$out->get_value('InsuredFirstName'));
	$this->db->duplicate("InsuredLastName",$out->get_value('InsuredLastName'));
	$this->db->duplicate("SalutationId",$out->get_value('SalutationId'));
	$this->db->duplicate("GenderId",$out->get_value('GenderId'));
	$this->db->duplicate("InsuredDOB",$out->get_value('InsuredDOB'));
	$this->db->duplicate("InsuredAge",$out->get_value('InsuredAge'));
	$this->db->duplicate("UpdatedById",$out->get_value('UpdatedById'));
	$this->db->duplicate("InsuredUpdatedTs",$out->get_value('InsuredUpdatedTs'));
    
	$this->db->insert_on_duplicate("t_gn_insured");
	
}
 
// ------------------------------------------------------------
/*
 * @ package 		set_save_row_policy_autogen .< t_gn_policyautogen >
 */
 
 protected function _set_save_row_policy_autogen( $out = null )
{
	
	$cond = 0;
	if( !is_array($out) ) { 
		return $cond;
	}
	
	$out = new EUI_Object( $out );
	
// --- reset cache --------------------------------------------------------
	
	$this->db->reset_write();
	$this->db->set("CustomerId", $out->get_value('CustomerId','intval'));
	$this->db->set("PolicyLastNumber",$out->get_value('PolicyLastNumber','intval')); 
	$this->db->set("ProductId", $out->get_value('ProductId','intval'));
	$this->db->set("MemberGroup", $out->get_value('MemberGroup','intval'));
	$this->db->set("PolicyNumber",$out->get_value('PolicyNumber','strval'));
	$this->db->set("PolicyPrefix",$out->get_value('PolicyPrefix','strval'));
	
// ---------------------------------------
	$this->db->insert_on_duplicate("t_gn_policyautogen");
	if( $this->db->affected_execute() )  {
		$cond = (int)$this->db->insert_id();	
	}  else {
		return $this->_select_row_policy_number_autogen_policy( $out->get_value('PolicyNumber','strval') );
	}
	return $cond;
	
 }
// ------------------------------------------------------------
/*
 * @ package get age my insured selected row .
 */
 
 
 public function _select_row_range_age( $Age = 0 , $ProductId = 0 , $GroupPremi = 0 )
{
  $select_age = 0;
  $this->db->reset_select();
  $this->db->select("COUNT(a.ProductPlanId) as Jumlah", FALSE);
  $this->db->from("t_gn_productplan a ");
  $this->db->where(" $Age BETWEEN a.ProductPlanAgeStart AND a.ProductPlanAgeEnd", "", FALSE);
  $this->db->where("a.ProductId", $ProductId);
  $this->db->where("a.PremiumGroupId", $GroupPremi);
  
  $rs = $this->db->get();
  
  if($rs->num_rows() > 0 
	AND (int)$rs->result_singgle_value()  > 0 ) 
  {
		return true;
 }
  return FALSE;
	
}

// ------------------------------------------------------------
/*
 * @ package get age my insured selected row .
 */
 

 public function _set_row_save_policy_data( $out = null ) 
{
 $cond = FALSE;
 
 if( !is_object($out) ){ 
	return FALSE;
 } 
 
 if( !$out->get_value('ProductId', 'intval') ){
	return FALSE;
 }
 
 
// -- generateor -----------------------
 
 
 $clsAutogen =& get_class_instance('M_Generator','get_instance');
 // $clsAutogen->_set_polis_number($out->get_value('ProductId', 'intval'),'N' ); 
 
// --- arr_ group premi  ----
 
 $arr_var_group = $out->get_array_value('GroupPremi');
 if( is_array($arr_var_group) 
	 AND !in_array('2_1', $arr_var_group) )
 {
	return FALSE;	
 }
 
// --- generator data policy --------------------------------------------
 
 $validates = $this->_select_policy_number_product_customer($out->get_value('ProductId'), $out->get_value('CustomerId'));
 $PolicyNumber = '';
 if($validates == FALSE )
 {
	$clsAutogen->_set_polis_number($out->get_value('ProductId', 'intval'),'N' ); 
	$PolicyNumber = (string)$clsAutogen->_get_polis_number();
	$PolicyLastId = (int)$clsAutogen->_get_last_number();
 } 
 else {
	 $PolicyNumber = (string)$validates['PolicyNumber'];
	 $PolicyLastId = (int)$validates['PolicyLastNumber'];
 }
 
// --- then process its  --------------------------------------------
 
 if( is_array($arr_var_group) ) 
	 foreach( $arr_var_group as $k => $GroupPremi )
 {
	$PolicyAutoGenId = 0;
	$spl =& Spliter($GroupPremi, "_", array('GroupPremi', 'enum'));
	
// =============================================================================================
// ============== MAIN IN INSURED 	============================================================
// =============================================================================================

	if( in_array($spl->get_value('GroupPremi','intval'), array(INS_CODE_MAIN) ) )
	{
		 $PolicyAutoGenId  = $this->_set_save_row_policy_autogen( array
		(
			'ProductId' => $out->get_value('ProductId', 'intval'), 
			'CustomerId' => $out->get_value('CustomerId', 'intval'),
			'MemberGroup' => $spl->get_value('GroupPremi','intval'),
			'PolicyNumber' => $PolicyNumber,
			'PolicyPrefix' => $GroupPremi,
			'PolicyLastNumber' => $PolicyLastId
			
		));
		
	// --- policy created ----------------------	
		 if( $PolicyAutoGenId )
		{
			$clsProduct =& get_class_instance('M_ProductForm');
			$output = new EUI_Object( $clsProduct->_getPremi(array (
				'ProductId'=> $out->get_value("ProductId", 'intval'),  
				'PremiumGroupId' => $spl->get_value('GroupPremi','intval'), 
				'PayModeId' => $out->get_value("InsuredPayMode", 'intval'), 
				'ProductPlan' => $out->get_value("InsuredPlanType", 'intval'), 
				'GenderId' => $out->get_value( join( "_", array("GenderId", $GroupPremi )), 'intval'), 
				'Age' => $out->get_value(join( "_", array("InsuredAge", $GroupPremi )), 'intval')
			)) );
			
		
		///  ------------ next process -------------------------------------
			$PolicyId = 0;
			if( is_object($output) AND $output->fetch_ready()  )
			{
				$PolicyNumber = $this->_select_row_policy_number_autogen_id( $PolicyAutoGenId );
				if( is_string($PolicyNumber) != FALSE )
				{
					$PolicyId = $this->_set_save_row_policy_general(array(
							'ProductPlanId' => $output->get_value('ProductPlanId'), 
							'PolicyPremi' => $output->get_value('ProductPlanPremium'),
							'PolicyEffectiveDate' => date('Y-m-d H:i:s'), 
							'PolicySalesDate' => date('Y-m-d H:i:s'), 
							'PolicyPrefix' => $GroupPremi,
							'PolicyNumber' => $PolicyNumber
					));	
					
				}
			}

		// ----- save data insured  -------------------- 
		 if( $PolicyId ) 
		 {
			$PolicyNumber = $this->_select_row_policy_number_autogen_id( $PolicyAutoGenId ); 
			$this->_set_save_row_policy_insured(array
			(
					"PolicyId" 			 => $PolicyId,
					"PolicyNumber"		 => $PolicyNumber,	
					"PolicyPrefix"		 => $GroupPremi,
					"InsuredPayMode" 	 => $out->get_value("InsuredPayMode", 'intval'), 
					"PremiumGroupId" 	 => $spl->get_value('GroupPremi','intval'),
					"CustomerId" 		 => $out->get_value("CustomerId", 'intval'), 
					"SalutationId" 		 => $out->get_value( join( "_", array("SalutationId", $GroupPremi )), 'intval'),
					"GenderId" 			 => $out->get_value( join( "_", array("GenderId", $GroupPremi )), 'intval'),
					"InsuredDOB" 		 => $out->get_value( join( "_", array("InsuredDOB",$GroupPremi)), '_getDateEnglish'),
					"InsuredAge" 		 => $out->get_value( join( "_", array("InsuredAge",$GroupPremi)), 'intval'),
					"RelationshipTypeId" => $out->get_value( join( "_", array("RelationshipTypeId", $GroupPremi)), 'intval'),
					"InsuredFirstName"   => $out->get_value( join( "_", array("InsuredFirstName", $GroupPremi)), 'strtoupper'),
					"InsuredLastName" 	 => $out->get_value( join( "_", array("InsuredLastName", $GroupPremi )), 'strtoupper'),
					"CreatedById" 		 => _get_session('UserId'),
					"UpdatedById" 		 => _get_session('UserId'),
					"InsuredCreatedTs" 	 => date('Y-m-d H:i:s'), 
					"InsuredUpdatedTs" 	 => date('Y-m-d H:i:s'),
					"IsPayers" 			 => 1 
			));
		  }	
		    
		
		// ----------------- save data payer untuk product bni life Active  ------------------------------------------------------
		  if( $PolicyId AND strlen($PolicyNumber) > 0  )  
		  {	
			  $this->_set_save_row_policy_payer(array
			 (	
				'PolicyNumber'				=> $PolicyNumber,
				'PolicyPrefix'				=> $GroupPremi,
				'PremiumGroupId'			=> $spl->get_value('GroupPremi','intval'),
				'CustomerId'				=> $out->get_value('CustomerId','intval'),
				'SalutationId'				=> $out->get_value('PayerSalutationId','intval'),
				'GenderId'					=> $out->get_value('PayerGenderId','intval'),
				'IdentificationTypeId'		=> $out->get_value('PayerIdentificationTypeId','intval'),
				'ProvinceId'				=> $out->get_value('PayerProvinceId','intval'),
				'PaymentTypeId'				=> $out->get_value('PayersBankId','intval'),
				'PayersBankId'				=> $out->get_value('PayersBankId','intval'),
				'CreditCardTypeId'			=> $out->get_value('CreditCardTypeId','intval'),
				'ValidCCPrefixId'			=> $out->get_value('CreditCardTypeId','intval'),
				'PayerFirstName'			=> $out->get_value('PayerFirstName','strtoupper'),
				'PayerLastName'				=> $out->get_value('PayerLastName','strtoupper'),
				'PayerDOB'					=> $out->get_value('PayerDOB','_getDateEnglish'),
				'PayerAge'					=> $out->get_value('PayerAge','intval'),
				'PayerIdentificationNum'	=> $out->get_value('PayerIdentificationNum','strtoupper'),
				'PayerAddressLine1'			=> $out->get_value('PayerAddressLine1','strtoupper'),
				'PayerAddressLine2'			=> $out->get_value('PayerAddressLine2','strtoupper'),
				'PayerAddressLine3'			=> $out->get_value('PayerAddressLine3','strtoupper'),
				'PayerAddressLine4'			=> $out->get_value('PayerAddressLine4','strtoupper'),
				'PayerZipCode'				=> $out->get_value('PayerZipCode','strtoupper'),
				'PayerCity'					=> $out->get_value('PayerCity','strtoupper'),
				'PayerHomePhoneNum'			=> $out->get_value('PayerHomePhoneNum','strtoupper'),
				'PayerMobilePhoneNum'		=> $out->get_value('PayerMobilePhoneNum','strtoupper'),
				'PayerWorkPhoneNum'			=> $out->get_value('PayerWorkPhoneNum','strtoupper'),
				'PayerOfficePhoneNum'		=> $out->get_value('PayerOfficePhoneNum','strtoupper'),
				'PayerWorkExtPhoneNum'		=> $out->get_value('PayerWorkExtPhoneNum','strtoupper'),
				'PayerAdditionalPhone1'		=> $out->get_value('PayerAdditionalPhone1','strtoupper'),
				'PayerAdditionalPhone2'		=> $out->get_value('PayerAdditionalPhone2','strtoupper'),
				'PayerMobilePhoneNum2'		=> $out->get_value('PayerMobilePhoneNum2','strtoupper'),
				'PayerHomePhoneNum2'		=> $out->get_value('PayerHomePhoneNum2','strtoupper'),
				'PayerOfficePhoneNum2'		=> $out->get_value('PayerOfficePhoneNum2','strtoupper'),
				'PayerFaxNum'				=> $out->get_value('PayerFaxNum','strtoupper'),
				'PayerEmail'				=> $out->get_value('PayerEmail'),
				'PayerCreditCardNum'		=> $out->get_value('PayerCreditCardNum','strtoupper'),
				'PayerCreditCardExpDate'	=> $out->get_value('PayerCreditCardExpDate','strtoupper'),
				'PayerPlaceOfBirth'			=> $out->get_value('PayerPlaceOfBirth','strtoupper'),
				'PayerAddrType'				=> $out->get_value('PayerAddrType','strtoupper'),	
				'PayerOfficeName'			=> $out->get_value('PayerOfficeName','strtoupper'),
				'PayersKodeAreaHome'		=> $out->get_value('PayersKodeAreaHome','strtoupper'),
				'PayersKodeAreaOffice'		=> $out->get_value('PayersKodeAreaOffice','strtoupper'),
				'PayerPreferedComunication'	=> $out->get_value('PayerPreferedComunication','strtoupper'),
				'PayerAddressState'			=> $out->get_value('PayerAddressState','strtoupper'),
				'PayerOptOut'				=> $out->get_value('PayerOptOut','strtoupper'),
				'PayerMaritalStatus'		=> $out->get_value('PayerMaritalStatus','strtoupper'),
				'PayerValidation'			=> $out->get_value('PayerValidation','strtoupper'),
				'PayerValidDate'			=> $out->get_value('PayerValidDate','strtoupper'),
				'CreatedById'				=> _get_session('UserId'),
				'UpdatedById'				=> _get_session('UserId'),
				'PayerCreatedTs'			=> date('Y-m-d H:i:s'),
				'PayerUpdatedTs'			=> date('Y-m-d H:i:s')
			));
		  }	
		  // === end save payer 
		  // --------------------------------------- save data Underwriting -----------------------------------
		  
		   if( $PolicyId AND strlen($PolicyNumber) > 0  )  
		  {	
			 $this->_set_row_save_underwriting_data( $out, array (
				 'PolicyNumber' => $PolicyNumber,
				 'PolicyPrefix' => $GroupPremi,
				 'PolicyId' => $PolicyId
			 ));  
		  }
		  
		  // === end underwriting  ============>
		  
		}
	}
	
// =============================================================================================
// ============== SPOUSE INSURED 	============================================================
// =============================================================================================

	 else if( in_array($spl->get_value('GroupPremi','intval'), array(INS_CODE_SPOUSE) ) )
	{
		 $PolicyAutoGenId  = $this->_set_save_row_policy_autogen( array
		(
			'ProductId' => $out->get_value('ProductId', 'intval'), 
			'CustomerId' => $out->get_value('CustomerId', 'intval'),
			'MemberGroup' => $spl->get_value('GroupPremi','intval'),
			'PolicyPrefix' => $GroupPremi,
			'PolicyNumber' => $PolicyNumber,
			'PolicyLastNumber' => $PolicyLastId
		));
		
	// --- policy created ----------------------	
		 if( $PolicyAutoGenId )
		{
			$clsProduct =& get_class_instance('M_ProductForm');
			$output = new EUI_Object( $clsProduct->_getPremi(array (
				'ProductId'=> $out->get_value("ProductId", 'intval'),  
				'PremiumGroupId' => $spl->get_value('GroupPremi','intval'), 
				'PayModeId' => $out->get_value("InsuredPayMode", 'intval'), 
				'ProductPlan' => $out->get_value("InsuredPlanType", 'intval'), 
				'GenderId' => $out->get_value( join( "_", array("GenderId", $GroupPremi )), 'intval'), 
				'Age' => $out->get_value(join( "_", array("InsuredAge", $GroupPremi )), 'intval')
			)) );
			
		
		///  ------------ next process -------------------------------------
			$PolicyId = 0;
			if( is_object($output) AND $output->fetch_ready()  )
			{
				$PolicyNumber = $this->_select_row_policy_number_autogen_id( $PolicyAutoGenId );
				if( is_string($PolicyNumber) != FALSE )
				{
					$PolicyId = $this->_set_save_row_policy_general(array(
							'ProductPlanId' => $output->get_value('ProductPlanId'), 
							'PolicyPremi' => $output->get_value('ProductPlanPremium'),
							'PolicyEffectiveDate' => date('Y-m-d H:i:s'), 
							'PolicySalesDate' => date('Y-m-d H:i:s'), 
							'PolicyPrefix' => $GroupPremi,
							'PolicyNumber' => $PolicyNumber
					));	
					
				}
			}

		// ----- save data insured  -------------------- 
		 if( $PolicyId ) 
		 {
			$PolicyNumber = $this->_select_row_policy_number_autogen_id( $PolicyAutoGenId ); 
			$this->_set_save_row_policy_insured(array
			(
					"PolicyId" 			 => $PolicyId,
					"PolicyNumber"		 => $PolicyNumber,	
					"PolicyPrefix"		 => $GroupPremi,
					"InsuredPayMode" 	 => $out->get_value("InsuredPayMode", 'intval'), 
					"PremiumGroupId" 	 => $spl->get_value('GroupPremi','intval'),
					"CustomerId" 		 => $out->get_value("CustomerId", 'intval'), 
					"SalutationId" 		 => $out->get_value( join( "_", array("SalutationId", $GroupPremi )), 'intval'),
					"GenderId" 			 => $out->get_value( join( "_", array("GenderId", $GroupPremi )), 'intval'),
					"InsuredDOB" 		 => $out->get_value( join( "_", array("InsuredDOB",$GroupPremi)), '_getDateEnglish'),
					"InsuredAge" 		 => $out->get_value( join( "_", array("InsuredAge",$GroupPremi)), 'intval'),
					"RelationshipTypeId" => $out->get_value( join( "_", array("RelationshipTypeId", $GroupPremi)), 'intval'),
					"InsuredFirstName"   => $out->get_value( join( "_", array("InsuredFirstName", $GroupPremi)), 'strtoupper'),
					"InsuredLastName" 	 => $out->get_value( join( "_", array("InsuredLastName", $GroupPremi )), 'strtoupper'),
					"CreatedById" 		 => _get_session('UserId'),
					"UpdatedById" 		 => _get_session('UserId'),
					"InsuredCreatedTs" 	 => date('Y-m-d H:i:s'), 
					"InsuredUpdatedTs" 	 => date('Y-m-d H:i:s'),
					"IsPayers" 			 => 0
			));
		  }	
		}
	}	
	
// =============================================================================================
// ============== DEPENDENT 	============================================================
// =============================================================================================

	else if( in_array($spl->get_value('GroupPremi','intval'), array(INS_CODE_DEPEND) ) )
	{
		 $PolicyAutoGenId  = $this->_set_save_row_policy_autogen( array
		(
			'ProductId' => $out->get_value('ProductId', 'intval'), 
			'CustomerId' => $out->get_value('CustomerId', 'intval'),
			'MemberGroup' => $spl->get_value('GroupPremi','intval'),
			'PolicyNumber' => $PolicyNumber,
			'PolicyPrefix' => $GroupPremi,
			'PolicyLastNumber' => $PolicyLastId
		));
		
	// --- policy created ----------------------	
		 if( $PolicyAutoGenId )
		{
			$clsProduct =& get_class_instance('M_ProductForm');
			$output = new EUI_Object( $clsProduct->_getPremi(array (
				'ProductId'=> $out->get_value("ProductId", 'intval'),  
				'PremiumGroupId' => $spl->get_value('GroupPremi','intval'), 
				'PayModeId' => $out->get_value("InsuredPayMode", 'intval'), 
				'ProductPlan' => $out->get_value("InsuredPlanType", 'intval'), 
				'GenderId' => $out->get_value( join( "_", array("GenderId", $GroupPremi )), 'intval'), 
				'Age' => $out->get_value(join( "_", array("InsuredAge", $GroupPremi )), 'intval')
			)));
			
		
		///  ------------ next process -------------------------------------
			$PolicyId = 0;
			if( is_object($output) AND $output->fetch_ready()  )
			{
				$PolicyNumber = $this->_select_row_policy_number_autogen_id( $PolicyAutoGenId );
				if( is_string($PolicyNumber) != FALSE )
				{
					$PolicyId = $this->_set_save_row_policy_general(array(
							'ProductPlanId' => $output->get_value('ProductPlanId'), 
							'PolicyPremi' => $output->get_value('ProductPlanPremium'),
							'PolicyEffectiveDate' => date('Y-m-d H:i:s'), 
							'PolicySalesDate' => date('Y-m-d H:i:s'), 
							'PolicyPrefix' => $GroupPremi,
							'PolicyNumber' => $PolicyNumber
					));	
					
				}
			}

		// ----- save data insured  -------------------- 
		 if( $PolicyId ) 
		 {
			$PolicyNumber = $this->_select_row_policy_number_autogen_id( $PolicyAutoGenId ); 
			$this->_set_save_row_policy_insured(array
			(
					"PolicyId" 			 => $PolicyId,
					"PolicyNumber"		 => $PolicyNumber,	
					"PolicyPrefix"		 => $GroupPremi,
					"InsuredPayMode" 	 => $out->get_value("InsuredPayMode", 'intval'), 
					"PremiumGroupId" 	 => $spl->get_value('GroupPremi','intval'),
					"CustomerId" 		 => $out->get_value("CustomerId", 'intval'), 
					"SalutationId" 		 => $out->get_value( join( "_", array("SalutationId", $GroupPremi )), 'intval'),
					"GenderId" 			 => $out->get_value( join( "_", array("GenderId", $GroupPremi )), 'intval'),
					"InsuredDOB" 		 => $out->get_value( join( "_", array("InsuredDOB",$GroupPremi)), '_getDateEnglish'),
					"InsuredAge" 		 => $out->get_value( join( "_", array("InsuredAge",$GroupPremi)), 'intval'),
					"RelationshipTypeId" => $out->get_value( join( "_", array("RelationshipTypeId", $GroupPremi)), 'intval'),
					"InsuredFirstName"   => $out->get_value( join( "_", array("InsuredFirstName", $GroupPremi)), 'strtoupper'),
					"InsuredLastName" 	 => $out->get_value( join( "_", array("InsuredLastName", $GroupPremi )), 'strtoupper'),
					"CreatedById" 		 => _get_session('UserId'),
					"UpdatedById" 		 => _get_session('UserId'),
					"InsuredCreatedTs" 	 => date('Y-m-d H:i:s'), 
					"InsuredUpdatedTs" 	 => date('Y-m-d H:i:s'),
					"IsPayers" 			 => 0
			));
		  }	
		}
	}
 }
 
// ----------- if succes save policy data then save benefiecery ------------

 if( !is_null($PolicyNumber) AND strlen( $PolicyNumber )  >  0 )
{
	$this->_set_save_row_policy_benefiecery( $out, $PolicyNumber );
}  

return (string)$PolicyNumber;
 
}



// ----------- Under Writing data Policy ------------

 public function _set_row_save_underwriting_data( $out = null, $attr = null ) 
{
	if( is_object( $out ) 
		AND is_array( $attr ) )
	{
		if( !$out->fetch_ready() ) { return FALSE; }
		
		$attr = new EUI_Object( $attr );
		if( !$attr->fetch_ready() ) { return FALSE; }
		
		$Insured = $this->_select_insured_policy( $attr->get_value('PolicyId'));
		if( !$Insured->fetch_ready() ) { return FALSE; }
		
		$IsUnderwriting = $out->get_value('isunderwriting', 'intval');
		if( $IsUnderwriting != 1 ) { return FALSE; }
		
		$arr_underwriting = $out->get_array_value('ListUnderwriting');
		
	// ------------ while looping data ---------------------
	
		$cond = 0;
		if(is_array( $arr_underwriting) 
			AND count($arr_underwriting) > 0 ) 
			foreach( $arr_underwriting as $UnderKeys => $UnderwritingCode )
		{
			$Underwriting = join("_", array("Underwriting", $UnderwritingCode));	
			$UnderwritingVal = $out->get_value($Underwriting,'strtoupper');
			
			if( strlen(trim($UnderwritingVal)) > 0  )
			{	
				$this->db->reset_write();
				$this->db->set("UWCustomerId", $Insured->get_value('CustomerId'));
				$this->db->set("UWInsuredId", $Insured->get_value('InsuredId'));
				$this->db->set("UWPolicyPrefix", $Insured->get_value('PolicyPrefix'));
				$this->db->set("UWPolicyNumber",$Insured->get_value('PolicyNumber')); 
				$this->db->set("UWProductId", $out->get_value('ProductId'));
				$this->db->set("UWCode", $UnderwritingCode);
				$this->db->set("UWAnswer", $UnderwritingVal);
				
				// --- jika duplikasi data ---------------
				$this->db->duplicate("UWCode", $UnderwritingCode);
				$this->db->duplicate("UWAnswer", $UnderwritingVal);
				 if( $this->db->insert_on_duplicate("t_gn_underwriting_answer") )
				{
					$cond++;
				}
			}
		}
		
		if( $cond ){ return TRUE; }
	} 
	
	return FALSE;
}

// ---------------- delete policy data attribute --------------------------------------------

 public function _set_row_deleted_policy_data( $out  = null )
{
  $cond = 0;
  if( !is_object($out) OR !$out->fetch_ready() ){
	 return FALSE;
	}
	
  if( $out->get_value('PolicyNumber','strlen') <= 3 ){
	return FALSE;
  }	
  
	
  $InsuredBox = $out->get_array_value('InsuredBox');
  $BenfitBox = $out->get_array_value('BenefitBox');

  $cond = 0; 
  
// ------------------ deleted benefiecery ----------------------------
  
  if( count($BenfitBox) > 0  ) 
	  foreach( $BenfitBox as $k => $BeneficiaryIndex  )
 {
	  $this->db->reset_select();
	  $this->db->select(" 
			 BeneficiaryId,	
			 CustomerId, 
			 PolicyNumber, 
			 BenefieceryPrefix, 
			 SalutationId, 
			 GenderId, 
			 RelationshipTypeId, 
			 BeneficiaryFirstName, 
			 BeneficiaryLastName, 
			 BeneficiaryDOB, 
			 BeneficiaryAge", 
	  FALSE);
	  
	  $this->db->from("t_gn_beneficiary");
	  $this->db->where("CustomerId", $out->get_value('CustomerId','intval') );
	  $this->db->where("PolicyNumber",$out->get_value('PolicyNumber','strval'));
	  $this->db->where("BenefieceryPrefix", $BeneficiaryIndex);
	  $rs = $this->db->get();
	  if( $rs->num_rows() )
	 {
		$row = new EUI_Object( $rs->result_first_assoc() );
		if( $row->fetch_ready() ) 
		{
				EventLoger("DEL", array("delete data benefiecery 
					[{$row->get_value('BeneficiaryId')}:{  
						'PolicyNumber':'{$row->get_value('PolicyNumber')}',
						'CustomerId':'{$row->get_value('CustomerId')}',
						'BenefieceryPrefix':'{$row->get_value('BenefieceryPrefix')}',
						'SalutationId':'{$row->get_value('SalutationId')}',
						'GenderId':'{$row->get_value('GenderId')}',
						'RelationshipTypeId':'{$row->get_value('RelationshipTypeId')}',
						'BeneficiaryFirstName':'{$row->get_value('BeneficiaryFirstName')}',
						'BeneficiaryLastName':'{$row->get_value('BeneficiaryLastName')}',
						'BeneficiaryDOB':'{$row->get_value('BeneficiaryDOB')}',
						'BeneficiaryAge':'{$row->get_value('BeneficiaryAge')}' 
					}]"
				)); 
				$this->db->delete("t_gn_beneficiary", array('BeneficiaryId' => $row->get_value('BeneficiaryId','intval')) );
		}
	 }
  } 
  
// ------------ deleted on insured ------------------------------------
    
  if( count($InsuredBox) > 0  ) 
	  foreach( $InsuredBox as $k => $InsuredIndex  )
 {
	$this->db->reset_write();
	$this->db->reset_select();
	$this->db->select("
		InsuredId,
		CustomerId,
		PolicyNumber,
		PolicyPrefix,
		PolicyId,
		SalutationId,
		GenderId,
		RelationshipTypeId,
		InsuredFirstName,
		InsuredLastName,
		PremiumGroupId,
		InsuredPayMode,
		InsuredDOB,
		InsuredAge", 
	FALSE);
	
	$this->db->from("t_gn_insured");
	$this->db->where("CustomerId", $out->get_value('CustomerId','intval') );
	$this->db->where("PolicyNumber",$out->get_value('PolicyNumber','strval'));
	$this->db->where("PolicyPrefix", $InsuredIndex);
	
	$rs = $this->db->get();
	if( $rs->num_rows() )
	{
		$row = new EUI_Object( $rs->result_first_assoc() );
		if( $row->fetch_ready() )
		{
				EventLoger("DEL", array("delete data insured  
					[{$row->get_value('InsuredId')}: {  
						'PolicyNumber':'{$row->get_value('PolicyNumber')}',
						'CustomerId':'{$row->get_value('CustomerId')}',
						'PolicyPrefix':'{$row->get_value('PolicyPrefix')}',
						'SalutationId':'{$row->get_value('SalutationId')}',
						'GenderId':'{$row->get_value('GenderId')},
						'RelationshipTypeId':'{$row->get_value('RelationshipTypeId')}',
						'InsuredFirstName':'{$row->get_value('InsuredFirstName')}',
						'InsuredLastName':'{$row->get_value('InsuredLastName')}',
						'PremiumGroupId':'{$row->get_value('PremiumGroupId')}',
						'InsuredPayMode':'{$row->get_value('InsuredPayMode')}',
						'InsuredDOB':'{$row->get_value('InsuredDOB')}',
						'InsuredAge':'{$row->get_value('InsuredAge')}' 
					}]"
				)); 
				
			$this->db->delete("t_gn_insured", array('InsuredId' => $row->get_value('InsuredId','intval')) );
			$this->db->delete("t_gn_policy", array('PolicyId' => $row->get_value('PolicyId','intval')) );
		}
	 }
  } 
  
  if( !$cond ){
	  return FALSE;
  }
  
  return TRUE;
}

// ====================== END CLASS ==============================
	
}

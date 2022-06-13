<?php
/*
 * E.U.I 
 *
 
 * subject	: get model data for SysUser 
 * 			  extends under Controller class
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/controller/sysuser/
 */
 define('PREVIEW_FORM' , 'PREVIEW');
 
class M_ProductForm extends EUI_Model 
{
	
// ---------------------------------------------

private static $Instance = null;

public static function & Instance()
{
	if( is_null(self::$Instance))
	{
		self::$Instance = new self();
	}
	return self::$Instance;
}
/*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 */

 
 function __construct()
{
	$this->load->model(array( 'M_FormLayout', 'M_SetProduct'));
}

/*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 */
 
function _getCampaignId( $CustomerId=0 )
{
	$_conds = null;
	
	$this->db->select('b.CampaignId');
	$this->db->from('t_gn_customer a ');
	$this->db->join('t_gn_campaign b', 'a.CampaignId=b.CampaignId', 'LEFT');
	$this->db->where('a.CustomerId', $CustomerId);
	
	if( $rows = $this -> db->get()-> result_first_assoc())
	{
		$_conds =(INT)$rows['CampaignId'];
	}
	
	return $_conds;
 }
  
 function _getProductId($CampaignId=0)
 {
	$_conds = null;
	$ProductId = $this -> M_SetProduct -> _getProductCampaignId($CampaignId);
	if( $ProductId )
	{
		$setId = array_keys($ProductId);
		if( count($setId) )
		{
			$_conds = $setId[0];
		}	
	}
	
	return $_conds;
 }
 
 
 
 /*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 */
 
 function _getLayout($ProductId=0)
 {
	$_conds = null;
	
	$_avail = $this -> M_FormLayout -> _getProductLayout($ProductId);
	if( is_array($_avail)) {
		$_conds = $_avail;
	}
	
	return $_conds;
	
 }
 /*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 */
 
 function _getAddFormLayout($ProductId=0)
 {
	$_conds = null;
	$_avail = $this -> M_FormLayout -> _getProductLayout($ProductId);
	if( is_array($_avail))
	{
		$_conds = $_avail['AddView'];
	} 
	return $_conds;
 }
 
 
/*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 */
 
 function _getTableNameProduct ( $ProductId=0 , $get = "" )
 {
	$this -> db -> select('a.ProductTableName');
	$this -> db -> select('a.ProductId');
	$this -> db -> select('a.ProductCode');
 	$this -> db -> from('t_gn_product a');
	$this -> db -> where('a.ProductId',$ProductId);
	if( $rows = $this -> db -> get() -> result_first_assoc() )
	{
		if ( $get != "" ) {
			$productName = strtolower($rows[$get]);
		} else {
			$productName = strtolower($rows['ProductTableName']);
		}
	} else {
		$productName = "";
	}
	
	return $productName;
 }
 

  
 /*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 */
 
 function _getEditFormLayout($ProductId=0)
 {
	$_conds = null;
	$_avail = $this -> M_FormLayout -> _getProductLayout($ProductId);
	if( is_array($_avail))
	{
		$_conds = $_avail['EditView'];
	} 
	
	return $_conds;
 }

 
public function _SetLabel ( $table = '' ) {
	$selectColumnPil = $this->db->query("SELECT * FROM $table");
	return ($selectColumnPil->list_fields());
}

  
 /*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 */
 
function _getProduct()
 {
	$_conds = array();
	
	$avail = $this -> M_SetProduct -> _getOutboundProductId();
	foreach($avail as $key => $rows )
	{
		$_conds[$key] = $rows['name'];	
	}
	
	return $_conds;
 }


 /**
  * [_getAppCustomer get app customer input by agent]
  * @param  string $CustomerId [get spcific by CustomerId]
  * @param  string $ProductId  [GetProductId Specific On t_lk_product]
  * @return [type]             [description]
  */
 public function _getAppCustomer ( $CustomerId = '' , $ProductId = '' , $status = '' ) {

 	// ProductId above is ProductId from Open Form
 	
 	/* Procedure For More CONSTANT
 		take ProductId from t_gn_customer and then join to t_lk_product
 	*/
 	
 	$sip = '';

 	if ( $CustomerId != "" AND (int)$CustomerId AND !empty($CustomerId) ) {
 		
 		if ( $status == "ADDDOC" ) {
 			$selectCustomer = $this->db->query("
	 			SELECT 
	 			* 
	 			FROM t_gn_additional_doc a 
	 			WHERE a.CustomerId='$CustomerId' 
	 		");
	 		if ( $selectCustomer->num_rows() > 0 ) {
				$sip = $selectCustomer->row();
			} 
 		} else {
	 		// this is Comparison data from ProductId open and ProductId on t_gn_customer
	 		// start check to t_gn_customer
					
	 		$selectCustomer = $this->db->query("
	 			SELECT 
	 			a.ProductId ,
	 			a.CustomerId , 
	 			a.Recsource , 
	 			a.SellerId , 
	 			a.POD   
	 			FROM t_gn_customer a 
	 			WHERE a.CustomerId='$CustomerId' 
	 		");

	 		// checking result from t_gn_customer by specific Customer
	 		// if there is no results from t_gn_customer then new Create Form without take a ProductId

	 		if ( $selectCustomer->num_rows() > 0 ) {
				// starts object t_gn_customer by $CustomerId

				$sc = $selectCustomer->row();		
				
	 			if ( $sc->ProductId != "" AND !empty($sc->ProductId) ) {
					// comparison product id start here
					if ( $ProductId != $sc->ProductId ) {
						echo 'Cannot Return , Because Product has Inserted by other Agent! Customer Id : ' . $sc->CustomerId;
						exit();
					} else {
						$TableName = $this->_getTableNameProduct( $sc->ProductId );
						if ( $TableName != "" OR !empty($TableName) ) {
							
							$selectInputAgent  = $this->db->query(
								"SELECT *
								FROM $TableName a
								WHERE a.Customer_ID='".$sc->CustomerId."'
								"
							);

							if ( $selectInputAgent->num_rows() > 0 ) {
								$sip = $selectInputAgent->row();
							} else {
								// Nothing to do here
			 					echo "NOTHING TO PREVIEW ...";
			 					exit();
							}

						} 
					}
	 			} else {
	 				if ( $status == PREVIEW_FORM ) {
	 					echo "NOTHING TO PREVIEW ...";
	 					exit();
	 				} else {
	 					
	 				}	
	 			}
	 		} 

 		}




 	}

 	return $sip;

 }


/*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 */


function _getDefault($CustId = null,$ProductId=0)
{
	$_count = 0;
	
	if( !is_null($CustId) )
	{
		$this -> db -> select('a.PolicyAutoGenId');
		$this -> db -> from('t_gn_policyautogen a');
		$this -> db -> where('a.CustomerId',$CustId);
		$this -> db -> where('a.ProductId',$ProductId);
		
		if( $_avail = $this -> db ->get() -> result_first_assoc() )
		{
			$_count = $_avail['PolicyAutoGenId'];
		}	
	}
	
	return $_count;
}



function _getPaymentModeByProduct($ProductId = 0)
{
	$_conds = array();
	
	
	$sql = "select distinct(a.PayModeId) as PayModeId, b.PayMode from t_gn_productplan a
			left join t_lk_paymode b on a.PayModeId = b.PayModeId
			where a.ProductId = '$ProductId'";
		
	$qry = $this->db->query($sql);
	
	if($qry->num_rows() > 0)
	{
		foreach($qry->result_assoc() as $rows)
		{
			$_conds[$rows['PayModeId']] = $rows['PayMode'];
		}
	}
	
	return $_conds;
}	


// -------------------------------------------------------------

/* 
 * Method 		_select_count_page
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
 
 
 function _checkValidPrefix($input)
  {
	$count = 0;
	
	$sql = "select a.ValidCCPrefixId from t_lk_validccprefix a where a.ValidCCPrefix = '".$input."'";
	$qry = $this->db->query($sql);
	
	if($qry->num_rows() > 0)
	{
		$count = 1;
	}
	
	return $count;
  }
// -------------------------------------------------------------

/* 
 * Method 		_select_count_page
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
 
   
  function _GetZip($id)
  {
		$zip = array();
		
		$qry = $this -> db -> query("select concat( a.ZipKotaKab,', ',a.ZipKecamatan,', ',a.ZipKelurahan,', ',a.ZipCode) as ZipFull from t_lk_zip a where a.ZipProvinceId = '".$id."'");
		foreach( $qry -> result_assoc() as $rows ){
				$zip[trim($rows['ZipFull'])] = $rows['ZipFull'];
		}
		
		return $zip;
  }
 // -------------------------------------------------------------

/* 
 * Method 		_select_count_page
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
 
  
  function _getGenderByTitle($id)
  {
	$gen_id = 0;
	
	$sql = "select a.GenderId from t_lk_salutation a where a.SalutationId = '".$id."'";
	$qry = $this->db->query($sql);
	
	if($qry->num_rows() > 0)
	{
		$gen_id = $qry->result_singgle_value();
	}
	
	return $gen_id;
  }
  


public function _detailAddon ( $CustomerId =0 ) {
	if ( $CustomerId != 0 ) {
		$selectToDetailAddon = $this->db->query(
			"SELECT * FROM t_gn_app_addon_detail a WHERE a.Customer_ID='$CustomerId'"
		);
		if ( $selectToDetailAddon == true AND $selectToDetailAddon->num_rows() > 0 ) {
			return $selectToDetailAddon;
		} else {
			return "error";
		}
	} else {
		return "error";	
	}
}

// -------------------------------------------------------------

/* 
 * Method 		_select_count_page
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
 
 
 public function _SearchAddressNew( $out )
{
  $arr_address = array(); // default data 
  if( !$out->fetch_ready() ){ 
	return (array)$arr_address; 
  }
   
 // ---------- kep data on parameter -----------------------
 
    $ProvinceId = (int)$out->get_value('ProvinceId');
    $Keyword = $out->get_value('keyword');
 
// ------------------ default spelect ---------------------- 
    $this->db->reset_select();
    $this->db->select(" a.ZipId, a.ZipCode, a.ZipProvinceId, b.Province,
					   a.ZipKelurahan, a.ZipKecamatan, a.ZipDT, a.ZipKotaKab", FALSE);
					   
	$this->db->from("t_lk_zip a ");
	$this->db->join("t_lk_province b "," a.ZipProvinceId = b.ProvinceId", "LEFT");
	$this->db->where("a.ZipProvinceId", $ProvinceId);
	$this->db->where("( 
			a.ZipCode REGEXP ('^$Keyword') 
			OR a.ZipKelurahan REGEXP ('^$Keyword') 
			OR a.ZipKecamatan REGEXP ('^$Keyword')
			OR a.ZipKotaKab REGEXP ('^$Keyword') )", "", FALSE);
	$this->db->order_by('a.ZipKelurahan','ASC');
	$this->db->limit(10);
	
	$rs  = $this->db->get();
	if( $rs->num_rows() > 0 ) {
		$arr_address = $rs->result_assoc();
	}
	
	return (array)$arr_address;
 }
  


 	public function _SendAdditionalDoc ( $paramInserts = ""  ) {
 		if ( is_array( $paramInserts ) ) {
 			extract($paramInserts);
			$this->db->set("Need_KTP" , $Need_KTP); 
			$this->db->set("Need_NPWP" , $Need_NPWP); 
			$this->db->set("Need_Other_Bank_Card" , $Need_Other_Bank_Card); 
			$this->db->set("Need_Income_Doc" , $Need_Income_Doc); 
			$this->db->set("CreatedById" , $CreatedById); 
			$this->db->set("ProductId" , $ProductId); 
			$this->db->set("CustomerId" , $CustomerId); 

			$this->db->duplicate("Need_KTP" , $Need_KTP); 
			$this->db->duplicate("Need_NPWP" , $Need_NPWP); 
			$this->db->duplicate("Need_Other_Bank_Card" , $Need_Other_Bank_Card); 
			$this->db->duplicate("Need_Income_Doc" , $Need_Income_Doc); 
			$this->db->duplicate("CreatedById" , $CreatedById); 
			$this->db->duplicate("ProductId" , $ProductId); 
			
 			$this->db->insert_on_duplicate("t_gn_additional_doc");
 		} else {

 		}
 	}	


 	// long form start from here
	public function sendPill ( $result_post = "" , $tableName = '' ) {
		if ( is_array( $result_post ) ) {
			// set mandatory 
			extract($result_post);

			// Check if Customer ID is not empty 
			if ( $Customer_ID != "" AND (int)$Customer_ID AND !empty($Customer_ID) ) {


				// Set Customer Specific ID
			    $this->db->set('Customer_ID'  , $Customer_ID);
			    $this->db->set('CreatedTs'  , date("Y-m-d H:i:s"));
			    $this->db->set('CreatedById'  , _have_get_session("UserId") );
			    $this->db->set('Name_ID'  , $Name_ID);
			    $this->db->set('Name_Nick'  , $Name_Nick);
			    $this->db->set('Name_Other'  , $Name_Other);
			    $this->db->set('Title'  , $Title);
			    $this->db->set('No_ID'  , $No_ID);
			    $this->db->set('No_NPWP'  , $No_NPWP);
			    $this->db->set('Place_Birth'  , $Place_Birth);
			    $this->db->set('DOB'  , $DOB);
			    $this->db->set('Home_Addr_1'  , $Home_Addr_1);
			    $this->db->set('Home_Addr_2'  , $Home_Addr_2);
			    $this->db->set('Home_RT'  , $Home_RT);
			    $this->db->set('Home_RW'  , $Home_RW);
			    $this->db->set('Home_Zip'  , $Home_Zip);
			    $this->db->set('Home_Kel'  , $Home_Kel);
			    $this->db->set('Home_Kec'  , $Home_Kec);
			    $this->db->set('Home_City'  , $Home_City);
			    $this->db->set('Current_Addr'  , $Current_Addr);
			    $this->db->set('Current_Addr_is_Home'  , $Current_Addr_is_Home);
			    $this->db->set('Current_RT'  , $Current_RT);
			    $this->db->set('Current_RW'  , $Current_RW);
			    $this->db->set('Current_Zip'  , $Current_Zip);
			    $this->db->set('Current_Kel'  , $Current_Kel);
			    $this->db->set('Current_Kec'  , $Current_Kec);
			    $this->db->set('Current_City'  , $Current_City);
			    $this->db->set('Mobile_Ph'  , $Mobile_Ph);
			    $this->db->set('Ph_1'  , $Ph_1);
			    $this->db->set('Ph_1_Area'  , $Ph_1_Area);
			    $this->db->set('Ph_2'  , $Ph_2);
				$this->db->set("Mobile_Ph_Area" , $Mobile_Ph_Area ); 
				$this->db->set("Mobile_Ph" , $Mobile_Ph ); 
			    $this->db->set('Email'  , $Email);
			    $this->db->set('Mother_Name'  , $Mother_Name);
			    $this->db->set('Education_Level'  , $Education_Level);
			    $this->db->set('Education_Other'  , $Education_Other);
			    $this->db->set('Marital_Status'  , $Marital_Status);
			    $this->db->set('Number_Dependent'  , $Number_Dependent);
			    $this->db->set('Home_Status'  , $Home_Status);
			    $this->db->set('Length_Stay_Year'  , $Length_Stay_Year);
			    $this->db->set('Length_Stay_Month'  , $Length_Stay_Month);
			    $this->db->set('Nationality_ID_Flag'  , $Nationality_ID_Flag);
			    $this->db->set('Nationality_Other'  , $Nationality_Other);
			    $this->db->set('Office_Employer'  , $Office_Employer);
			    $this->db->set('Office_Division'  , $Office_Division);
			    $this->db->set('Office_Building'  , $Office_Building);
			    $this->db->set('Office_Floor'  , $Office_Floor);
			    $this->db->set('Office_Address'  , $Office_Address);
			    $this->db->set('Office_Kel'  , $Office_Kel);
			    $this->db->set('Office_Kec'  , $Office_Kec);
			    $this->db->set('Office_City'  , $Office_City);
			    $this->db->set('Office_Zip'  , $Office_Zip);
			    $this->db->set('Office_Ph_Area'  , $Office_Ph_Area);
			    $this->db->set('Office_Ph_Ext'  , $Office_Ph_Ext);
			    $this->db->set('Office_Ph'  , $Office_Ph);
			    $this->db->set('Office_Fax_Area'  , $Office_Fax_Area);
			    $this->db->set('Office_Fax'  , $Office_Fax);
			    $this->db->set('Office_Jabatan'  , $Office_Jabatan);
			    $this->db->set('Income_Anual'  , $Income_Anual);
			    $this->db->set('Employer_Age_Year'  , $Employer_Age_Year);
			    $this->db->set('Corespondence'  , $Corespondence);
			    $this->db->set('Working_Year'  , $Working_Year);
			    $this->db->set('Working_Month'  , $Working_Month);
			    $this->db->set('Job'  , $Job);
			    $this->db->set('Job_Other'  , $Job_Other);
			    $this->db->set('Job_Sector'  , $Job_Sector);
			    $this->db->set('Job_Sector_Other'  , $Job_Sector_Other);
			    $this->db->set('Job_Status'  , $Job_Status);
			    $this->db->set('Employer_Prev'  , $Employer_Prev);
			    $this->db->set('Working_Year_Prev'  , $Working_Year_Prev);
			    $this->db->set('Employer_Ph_Area_Prev'  , $Employer_Ph_Area_Prev);
			    $this->db->set('Employer_Ph_Prev'  , $Employer_Ph_Prev);
			    $this->db->set('Relative_Name'  , $Relative_Name);
			    $this->db->set('Relative_Ph_Area'  , $Relative_Ph_Area);
			    $this->db->set('Relative_Ph'  , $Relative_Ph);
			    $this->db->set('Relative_Relation'  , $Relative_Relation);
			    $this->db->set('Relative_Addr1'  , $Relative_Addr1);
			    $this->db->set('Relative_Addr2'  , $Relative_Addr2);
			    $this->db->set('Relative_RT'  , $Relative_RT);
			    $this->db->set('Relative_RW'  , $Relative_RW);
			    $this->db->set('Relative_Zip'  , $Relative_Zip);
			    $this->db->set('Relative_City'  , $Relative_City);
			    $this->db->set('Loan_Amount'  , $Loan_Amount);
			    $this->db->set('Loan_Tenor_Year'  , $Loan_Tenor_Year);
			    $this->db->set('Agree_Lower_Loan'  , $Agree_Lower_Loan);
			    $this->db->set('Customer_HSBC'  , $Customer_HSBC);
			    $this->db->set('Acc_HSBC_Ceklist'  , $Acc_HSBC_Ceklist);
			    $this->db->set('Acc_Bank_Other_Ceklist'  , $Acc_Bank_Other_Ceklist);
			    $this->db->set('Acc_No_HSBC'  , $Acc_No_HSBC);
			    $this->db->set('Acc_No_Other'  , $Acc_No_Other);
			    $this->db->set('Acc_Bank_Other'  , $Acc_Bank_Other);
			    $this->db->set('Acc_Beneficiery_Other'  , $Acc_Beneficiery_Other);
			    $this->db->set('Acc_Branch_Other'  , $Acc_Branch_Other);
			    $this->db->set('Acc_Bank_Reff'  , $Acc_Bank_Reff);
			    $this->db->set('Acc_No_Reff'  , $Acc_No_Reff);
			    $this->db->set('Acc_Type_Reff'  , $Acc_Type_Reff);
			    $this->db->set('Acc_Length_Reff'  , $Acc_Length_Reff);
			    $this->db->set('Acc_Bank_Reff2'  , $Acc_Bank_Reff2);
			    $this->db->set('Acc_No_Reff2'  , $Acc_No_Reff2);
			    $this->db->set('Acc_Type_Reff2'  , $Acc_Type_Reff2);
			    $this->db->set('Acc_Length_Reff2'  , $Acc_Length_Reff2);
			    $this->db->set('CC_Bank_Reff'  , $CC_Bank_Reff);
			    $this->db->set('CC_No_Reff'  , $CC_No_Reff);
			    $this->db->set('CC_Pagu_Reff'  , $CC_Pagu_Reff);
			    $this->db->set('CC_Since_MMYY'  , $CC_Since_MMYY);
			    $this->db->set('CC_Bank_Reff2'  , $CC_Bank_Reff2);
			    $this->db->set('CC_No_Reff2'  , $CC_No_Reff2);
			    $this->db->set('CC_Pagu_Reff2'  , $CC_Pagu_Reff2);
			    $this->db->set('CC_Since_MMYY2'  , $CC_Since_MMYY2);
			    $this->db->set('Relative_Director'  , $Relative_Director);

			    // If Duplicate in Customer_ID
			    
			    $this->db->duplicate('Name_ID'  , $Name_ID);
			    $this->db->duplicate('Name_Nick'  , $Name_Nick);
			    $this->db->duplicate('Name_Other'  , $Name_Other);
			    $this->db->duplicate('Title'  , $Title);
			    $this->db->duplicate('No_ID'  , $No_ID);
			    $this->db->duplicate('No_NPWP'  , $No_NPWP);
			    $this->db->duplicate('Place_Birth'  , $Place_Birth);
			    $this->db->duplicate('DOB'  , $DOB);
			    $this->db->duplicate('Home_Addr_1'  , $Home_Addr_1);
			    $this->db->duplicate('Home_Addr_2'  , $Home_Addr_2);
			    $this->db->duplicate('Home_RT'  , $Home_RT);
			    $this->db->duplicate('Home_RW'  , $Home_RW);
			    $this->db->duplicate('Home_Zip'  , $Home_Zip);
			    $this->db->duplicate('Home_Kel'  , $Home_Kel);
			    $this->db->duplicate('Home_Kec'  , $Home_Kec);
			    $this->db->duplicate('Home_City'  , $Home_City);
			    $this->db->duplicate('Current_Addr'  , $Current_Addr);
			    $this->db->duplicate('Current_Addr_is_Home'  , $Current_Addr_is_Home);
			    $this->db->duplicate('Current_RT'  , $Current_RT);
			    $this->db->duplicate('Current_RW'  , $Current_RW);
			    $this->db->duplicate('Current_Zip'  , $Current_Zip);
			    $this->db->duplicate('Current_Kel'  , $Current_Kel);
			    $this->db->duplicate('Current_Kec'  , $Current_Kec);
			    $this->db->duplicate('Current_City'  , $Current_City);
			    $this->db->duplicate('Mobile_Ph'  , $Mobile_Ph);
			    $this->db->duplicate('Ph_1'  , $Ph_1);
			    $this->db->duplicate('Ph_1_Area'  , $Ph_1_Area);
			    $this->db->duplicate('Ph_2'  , $Ph_2);
				$this->db->duplicate("Mobile_Ph_Area" , $Mobile_Ph_Area ); 
				$this->db->duplicate("Mobile_Ph" , $Mobile_Ph ); 
			    $this->db->duplicate('Email'  , $Email);
			    $this->db->duplicate('Mother_Name'  , $Mother_Name);
			    $this->db->duplicate('Education_Level'  , $Education_Level);
			    $this->db->duplicate('Education_Other'  , $Education_Other);
			    $this->db->duplicate('Marital_Status'  , $Marital_Status);
			    $this->db->duplicate('Number_Dependent'  , $Number_Dependent);
			    $this->db->duplicate('Home_Status'  , $Home_Status);
			    $this->db->duplicate('Length_Stay_Year'  , $Length_Stay_Year);
			    $this->db->duplicate('Length_Stay_Month'  , $Length_Stay_Month);
			    $this->db->duplicate('Nationality_ID_Flag'  , $Nationality_ID_Flag);
			    $this->db->duplicate('Nationality_Other'  , $Nationality_Other);
			    $this->db->duplicate('Office_Employer'  , $Office_Employer);
			    $this->db->duplicate('Office_Division'  , $Office_Division);
			    $this->db->duplicate('Office_Building'  , $Office_Building);
			    $this->db->duplicate('Office_Floor'  , $Office_Floor);
			    $this->db->duplicate('Office_Address'  , $Office_Address);
			    $this->db->duplicate('Office_Kel'  , $Office_Kel);
			    $this->db->duplicate('Office_Kec'  , $Office_Kec);
			    $this->db->duplicate('Office_City'  , $Office_City);
			    $this->db->duplicate('Office_Zip'  , $Office_Zip);
			    $this->db->duplicate('Office_Ph_Area'  , $Office_Ph_Area);
			    $this->db->duplicate('Office_Ph_Ext'  , $Office_Ph_Ext);
			    $this->db->duplicate('Office_Ph'  , $Office_Ph);
			    $this->db->duplicate('Office_Fax_Area'  , $Office_Fax_Area);
			    $this->db->duplicate('Office_Fax'  , $Office_Fax);
			    $this->db->duplicate('Office_Jabatan'  , $Office_Jabatan);
			    $this->db->duplicate('Income_Anual'  , $Income_Anual);
			    $this->db->duplicate('Employer_Age_Year'  , $Employer_Age_Year);
			    $this->db->duplicate('Corespondence'  , $Corespondence);
			    $this->db->duplicate('Working_Year'  , $Working_Year);
			    $this->db->duplicate('Working_Month'  , $Working_Month);
			    $this->db->duplicate('Job'  , $Job);
			    $this->db->duplicate('Job_Other'  , $Job_Other);
			    $this->db->duplicate('Job_Sector'  , $Job_Sector);
			    $this->db->duplicate('Job_Sector_Other'  , $Job_Sector_Other);
			    $this->db->duplicate('Job_Status'  , $Job_Status);
			    $this->db->duplicate('Employer_Prev'  , $Employer_Prev);
			    $this->db->duplicate('Working_Year_Prev'  , $Working_Year_Prev);
			    $this->db->duplicate('Employer_Ph_Area_Prev'  , $Employer_Ph_Area_Prev);
			    $this->db->duplicate('Employer_Ph_Prev'  , $Employer_Ph_Prev);
			    $this->db->duplicate('Relative_Name'  , $Relative_Name);
			    $this->db->duplicate('Relative_Ph_Area'  , $Relative_Ph_Area);
			    $this->db->duplicate('Relative_Ph'  , $Relative_Ph);
			    $this->db->duplicate('Relative_Relation'  , $Relative_Relation);
			    $this->db->duplicate('Relative_Addr1'  , $Relative_Addr1);
			    $this->db->duplicate('Relative_Addr2'  , $Relative_Addr2);
			    $this->db->duplicate('Relative_RT'  , $Relative_RT);
			    $this->db->duplicate('Relative_RW'  , $Relative_RW);
			    $this->db->duplicate('Relative_Zip'  , $Relative_Zip);
			    $this->db->duplicate('Relative_City'  , $Relative_City);
			    $this->db->duplicate('Loan_Amount'  , $Loan_Amount);
			    $this->db->duplicate('Loan_Tenor_Year'  , $Loan_Tenor_Year);
			    $this->db->duplicate('Agree_Lower_Loan'  , $Agree_Lower_Loan);
			    $this->db->duplicate('Customer_HSBC'  , $Customer_HSBC);
			    $this->db->duplicate('Acc_HSBC_Ceklist'  , $Acc_HSBC_Ceklist);
			    $this->db->duplicate('Acc_Bank_Other_Ceklist'  , $Acc_Bank_Other_Ceklist);
			    $this->db->duplicate('Acc_No_HSBC'  , $Acc_No_HSBC);
			    $this->db->duplicate('Acc_No_Other'  , $Acc_No_Other);
			    $this->db->duplicate('Acc_Bank_Other'  , $Acc_Bank_Other);
			    $this->db->duplicate('Acc_Beneficiery_Other'  , $Acc_Beneficiery_Other);
			    $this->db->duplicate('Acc_Branch_Other'  , $Acc_Branch_Other);
			    $this->db->duplicate('Acc_Bank_Reff'  , $Acc_Bank_Reff);
			    $this->db->duplicate('Acc_No_Reff'  , $Acc_No_Reff);
			    $this->db->duplicate('Acc_Type_Reff'  , $Acc_Type_Reff);
			    $this->db->duplicate('Acc_Length_Reff'  , $Acc_Length_Reff);
			    $this->db->duplicate('Acc_Bank_Reff2'  , $Acc_Bank_Reff2);
			    $this->db->duplicate('Acc_No_Reff2'  , $Acc_No_Reff2);
			    $this->db->duplicate('Acc_Type_Reff2'  , $Acc_Type_Reff2);
			    $this->db->duplicate('Acc_Length_Reff2'  , $Acc_Length_Reff2);
			    $this->db->duplicate('CC_Bank_Reff'  , $CC_Bank_Reff);
			    $this->db->duplicate('CC_No_Reff'  , $CC_No_Reff);
			    $this->db->duplicate('CC_Pagu_Reff'  , $CC_Pagu_Reff);
			    $this->db->duplicate('CC_Since_MMYY'  , $CC_Since_MMYY);
			    $this->db->duplicate('CC_Bank_Reff2'  , $CC_Bank_Reff2);
			    $this->db->duplicate('CC_No_Reff2'  , $CC_No_Reff2);
			    $this->db->duplicate('CC_Pagu_Reff2'  , $CC_Pagu_Reff2);
			    $this->db->duplicate('CC_Since_MMYY2'  , $CC_Since_MMYY2);
			    $this->db->duplicate('Relative_Director'  , $Relative_Director);

			    

				// Update t_gn_customer
				$ParamUpdate = array(
					"CustomerEmail" => $Email , 
					"ProductId" 	=> $ProductId , 
					"SalesDate"		=> date("Y-m-d H:i:s")
				);

				$this->db->insert_on_duplicate($tableName);

				//print_r($this->db->last_query());
				$UpdateMailCustomer = $this->MailUpdateCustomer($Customer_ID , $ParamUpdate);

			    // Check if Data has Insert !
			    if ( $this->db->affected_rows() >= 0 AND $UpdateMailCustomer == true ) {
			    	echo 1;
			    } else {
			    	echo 0;
			    }

			} else {
				echo 0;      
			}

		} else {
			// nothing to do error 
			echo 0;
		}
		

	}


	public function sendCard ( $result_post = "" , $tableName = "" ) {
		if ( is_array( $result_post ) ) {
			// set mandatory 

			extract($result_post);

			if ( $Customer_ID != "" AND (int)$Customer_ID AND !empty($Customer_ID)  ) {

				// Set Insert Into Database
				
			    //$this->db->set('Customer_ID'  , $Customer_ID);
			    // CC_HSBC_Level
				$this->db->set("CC_HSBC_Level" , $CC_HSBC_Level ); //12
				$this->db->set("Customer_ID" , $Customer_ID ); //12
				$this->db->set("No_ID" , $No_ID ); //12
				$this->db->set("Title" , $Title ); //Bapak
				$this->db->set("Marital_Status" , $Marital_Status ); //Kawin
				$this->db->set("Name_ID" , $Name_ID ); //Name_ID
				$this->db->set("Mother_Name" , $Mother_Name ); //Mother_Name
				$this->db->set("Name_Other" , $Name_Other ); //Name_Other
				$this->db->set("Number_Dependent" , $Number_Dependent ); //12
				$this->db->set("Nationality_Indonesia" , $Nationality_Indonesia ); //Lainnya
				$this->db->set("Nationality_Other" , $Nationality_Other ); //Nationality_Other
				$this->db->set("Education_Level" , $Education_Level ); //Akademi
				$this->db->set("Place_Birth" , $Place_Birth ); //Place_Birth
				$this->db->set("DOB" , $DOB ); //DOB
				$this->db->set("Home_Status" , $Home_Status ); //Milik keluarga
				$this->db->set("Home_Stay_Month" , $Home_Stay_Month ); //12
				$this->db->set("Home_Stay_Year" , $Home_Stay_Year ); //12
				$this->db->set("Home_Addr_1" , $Home_Addr_1 ); //Home_Addr_1
				$this->db->set("Nationality_Other_Name" , $Nationality_Other_Name ); //Nationality_Other_Name
				$this->db->set("Home_RT" , $Home_RT ); //12
				$this->db->set("Home_RW" , $Home_RW ); //12
				$this->db->set("Home_Kec" , $Home_Kec ); //Home_Kec
				$this->db->set("Home_City" , $Home_City ); //Home_City
				$this->db->set("Home_Zip" , $Home_Zip ); //12
				$this->db->set("Home_Addr_Other_Country" , $Home_Addr_Other_Country ); //Home_Addr_Other_Country
				$this->db->set("Job" , $Job ); //Karyawan Kontrak
				$this->db->set("Job_Profesional" , $Job_Profesional ); //Job_Profesional
				$this->db->set("Job_Other" , $Job_Other ); //Job_Other
				$this->db->set("Job_Position" , $Job_Position ); //Job_Position
				$this->db->set("Job_Income_Anual" , $Job_Income_Anual ); //12
				$this->db->set("Job_Sector" , $Job_Sector ); //Lainnya
				$this->db->set("Job_Sector_Other" , $Job_Sector_Other ); //Job_Sector_Other
				$this->db->set("Office_Employer" , $Office_Employer ); //Office_Employer
				$this->db->set("Office_Addr_1" , $Office_Addr_1 ); //Office_Addr_1
				$this->db->set("Office_Floor" , $Office_Floor ); //Office_Floor
				$this->db->set("Office_City" , $Office_City ); //Office_City
				$this->db->set("Office_Zip" , $Office_Zip ); //12
				$this->db->set("Office_Departement" , $Office_Departement ); //Office_Departement
				$this->db->set("Home_Ph_Area" , $Home_Ph_Area ); //12
				$this->db->set("Home_Ph" , $Home_Ph ); //12
				$this->db->set("Office_Ph_Area" , $Office_Ph_Area ); //12
				$this->db->set("Office_Ph" , $Office_Ph ); //12
				$this->db->set("Office_Ph_Ext" , $Office_Ph_Ext ); //12
				$this->db->set("Email" , $Email ); //Email
				$this->db->set("Mobile_Ph_Area" , $Mobile_Ph_Area ); //12
				$this->db->set("Mobile_Ph" , $Mobile_Ph ); //12
				$this->db->set("Corespondence" , $Corespondence ); //Rumah
				$this->db->set("Agree_Biaya_Kertas" , $Agree_Biaya_Kertas ); //TIDAK
				$this->db->set("Relative_Name" , $Relative_Name ); //Relative_Name
				$this->db->set("Relative_Relation" , $Relative_Relation ); //Relative_Relation
				$this->db->set("Relative_Area_Ph" , $Relative_Area_Ph ); //12
				$this->db->set("Relative_Ph" , $Relative_Ph ); //12
				$this->db->set("Agree_Debet_Acc" , $Agree_Debet_Acc ); //Tidak

				$this->db->set("CC_No_HSBC" , $CC_No_HSBC ); //CC_No_HSBC

				$this->db->set("CC_Other_Bank" , $CC_Other_Bank ); //CC_Other_Bank
				$this->db->set("CC_Other_No_Col_1" , $CC_Other_No_Col_1 ); //12
				$this->db->set("CC_Other_No_Col_2" , $CC_Other_No_Col_2 ); //12
				$this->db->set("CC_Other_No_Col_3" , $CC_Other_No_Col_3 ); //12
				$this->db->set("CC_Other_No_Col_4" , $CC_Other_No_Col_4 ); //12
				$this->db->set("CC_Other_Member_Since" , $CC_Other_Member_Since ); //CC_Other_Member_Since

				$this->db->set("CC_Other_Bank2" , $CC_Other_Bank2 ); //CC_Other_Bank2
				$this->db->set("CC_Other_No2_Col_1" , $CC_Other_No2_Col_1 ); //12
				$this->db->set("CC_Other_No2_Col_2" , $CC_Other_No2_Col_2 ); //12
				$this->db->set("CC_Other_No2_Col_3" , $CC_Other_No2_Col_3 ); //12
				$this->db->set("CC_Other_No2_Col_4" , $CC_Other_No2_Col_4 ); //12
				$this->db->set("CC_Other_Member_Since2" , $CC_Other_Member_Since2 ); //CC_Other_Member_Since2

				$this->db->set("Relative_Director" , $Relative_Director ); //Tidak
				$this->db->set("Member_Director" , $Member_Director ); //Tidak
				$this->db->set("Additional_Title" , $Additional_Title ); //Bapak
				$this->db->set("Additional_Name_ID" , $Additional_Name_ID ); //Additional_Name_ID
				$this->db->set("Additional_Name_Other" , $Additional_Name_Other ); //Additional_Name_Other
				$this->db->set("Additional_Relation" , $Additional_Relation ); //Lainnya
				$this->db->set("Additional_Relation_Other" , $Additional_Relation_Other ); //Additional_Relation_Other
				$this->db->set("Additional_DOB" , $Additional_DOB ); //Additional_DOB
				$this->db->set("Additional_Place_Birth" , $Additional_Place_Birth ); //Additional_Place_Birth
				$this->db->set("Additional_Mother_Name" , $Additional_Mother_Name ); //Additional_Mother_Name
				$this->db->set("Additional_No_ID" , $Additional_No_ID ); //12
				$this->db->set("Additional_Mobile_Ph_Kode" , $Additional_Mobile_Ph_Kode ); //12
				$this->db->set("Additional_Mobile_Ph" , $Additional_Mobile_Ph ); //12
				$this->db->set("Additional_Addr1" , $Additional_Addr1 ); //Additional_Addr1
				$this->db->set("Additional_RT" , $Additional_RT ); //12
				$this->db->set("Additional_RW" , $Additional_RW ); //12
				$this->db->set("Additional_Kec" , $Additional_Kec ); //Additional_Kec
				$this->db->set("Additional_City" , $Additional_City ); //Additional_City
				$this->db->set("Additional_state" , $Additional_state ); //Additional_state
				$this->db->set("Additional_Zipcode" , $Additional_Zipcode ); //12
				$this->db->set("Additional_Addr_Other_Country" , $Additional_Addr_Other_Country ); //Additional_Addr2
				//Additional_Nationality
				$this->db->set("Additional_Nationality" , $Additional_Nationality ); //Additional_Addr2
				$this->db->set("Additional_Nationality_Other" , $Additional_Nationality_Other ); //Additional_Addr2

				// set duplicate data 
				// 
				$this->db->duplicate("No_ID" , $No_ID ); //12
				$this->db->duplicate("CC_HSBC_Level" , $CC_HSBC_Level ); //12
				$this->db->duplicate("Title" , $Title ); //Bapak
				$this->db->duplicate("Marital_Status" , $Marital_Status ); //Kawin
				$this->db->duplicate("Name_ID" , $Name_ID ); //Name_ID
				$this->db->duplicate("Mother_Name" , $Mother_Name ); //Mother_Name
				$this->db->duplicate("Name_Other" , $Name_Other ); //Name_Other
				$this->db->duplicate("Number_Dependent" , $Number_Dependent ); //12
				$this->db->duplicate("Nationality_Indonesia" , $Nationality_Indonesia ); //Lainnya
				$this->db->duplicate("Nationality_Other" , $Nationality_Other ); //Nationality_Other
				$this->db->duplicate("Education_Level" , $Education_Level ); //Akademi
				$this->db->duplicate("Place_Birth" , $Place_Birth ); //Place_Birth
				$this->db->duplicate("DOB" , $DOB ); //DOB
				$this->db->duplicate("Home_Status" , $Home_Status ); //Milik keluarga
				$this->db->duplicate("Home_Stay_Month" , $Home_Stay_Month ); //12
				$this->db->duplicate("Home_Stay_Year" , $Home_Stay_Year ); //12
				$this->db->duplicate("Home_Addr_1" , $Home_Addr_1 ); //Home_Addr_1
				$this->db->duplicate("Nationality_Other_Name" , $Nationality_Other_Name ); //Nationality_Other_Name
				$this->db->duplicate("Home_RT" , $Home_RT ); //12
				$this->db->duplicate("Home_RW" , $Home_RW ); //12
				$this->db->duplicate("Home_Kec" , $Home_Kec ); //Home_Kec
				$this->db->duplicate("Home_City" , $Home_City ); //Home_City
				$this->db->duplicate("Home_Zip" , $Home_Zip ); //12
				$this->db->duplicate("Home_Addr_Other_Country" , $Home_Addr_Other_Country ); //Home_Addr_Other_Country
				$this->db->duplicate("Job" , $Job ); //Karyawan Kontrak
				$this->db->duplicate("Job_Profesional" , $Job_Profesional ); //Job_Profesional
				$this->db->duplicate("Job_Other" , $Job_Other ); //Job_Other
				$this->db->duplicate("Job_Position" , $Job_Position ); //Job_Position
				$this->db->duplicate("Job_Income_Anual" , $Job_Income_Anual ); //12
				$this->db->duplicate("Job_Sector" , $Job_Sector ); //Lainnya
				$this->db->duplicate("Job_Sector_Other" , $Job_Sector_Other ); //Job_Sector_Other
				$this->db->duplicate("Office_Employer" , $Office_Employer ); //Office_Employer
				$this->db->duplicate("Office_Addr_1" , $Office_Addr_1 ); //Office_Addr_1
				$this->db->duplicate("Office_Floor" , $Office_Floor ); //Office_Floor
				$this->db->duplicate("Office_City" , $Office_City ); //Office_City
				$this->db->duplicate("Office_Zip" , $Office_Zip ); //12
				$this->db->duplicate("Office_Departement" , $Office_Departement ); //Office_Departement
				$this->db->duplicate("Home_Ph_Area" , $Home_Ph_Area ); //12
				$this->db->duplicate("Home_Ph" , $Home_Ph ); //12
				$this->db->duplicate("Office_Ph_Area" , $Office_Ph_Area ); //12
				$this->db->duplicate("Office_Ph" , $Office_Ph ); //12
				$this->db->duplicate("Office_Ph_Ext" , $Office_Ph_Ext ); //12
				$this->db->duplicate("Email" , $Email ); //Email
				$this->db->duplicate("Mobile_Ph_Area" , $Mobile_Ph_Area ); //12
				$this->db->duplicate("Mobile_Ph" , $Mobile_Ph ); //12
				$this->db->duplicate("Corespondence" , $Corespondence ); //Rumah
				$this->db->duplicate("Agree_Biaya_Kertas" , $Agree_Biaya_Kertas ); //TIDAK
				$this->db->duplicate("Relative_Name" , $Relative_Name ); //Relative_Name
				$this->db->duplicate("Relative_Relation" , $Relative_Relation ); //Relative_Relation
				$this->db->duplicate("Relative_Area_Ph" , $Relative_Area_Ph ); //12
				$this->db->duplicate("Relative_Ph" , $Relative_Ph ); //12
				$this->db->duplicate("Agree_Debet_Acc" , $Agree_Debet_Acc ); //Tidak

				$this->db->duplicate("CC_No_HSBC" , $CC_No_HSBC ); //CC_No_HSBC

				$this->db->duplicate("CC_Other_Bank" , $CC_Other_Bank ); //CC_Other_Bank
				$this->db->duplicate("CC_Other_No_Col_1" , $CC_Other_No_Col_1 ); //12
				$this->db->duplicate("CC_Other_No_Col_2" , $CC_Other_No_Col_2 ); //12
				$this->db->duplicate("CC_Other_No_Col_3" , $CC_Other_No_Col_3 ); //12
				$this->db->duplicate("CC_Other_No_Col_4" , $CC_Other_No_Col_4 ); //12
				$this->db->duplicate("CC_Other_Member_Since" , $CC_Other_Member_Since ); //CC_Other_Member_Since

				$this->db->duplicate("CC_Other_Bank2" , $CC_Other_Bank2 ); //CC_Other_Bank2
				$this->db->duplicate("CC_Other_No2_Col_1" , $CC_Other_No2_Col_1 ); //12
				$this->db->duplicate("CC_Other_No2_Col_2" , $CC_Other_No2_Col_2 ); //12
				$this->db->duplicate("CC_Other_No2_Col_3" , $CC_Other_No2_Col_3 ); //12
				$this->db->duplicate("CC_Other_No2_Col_4" , $CC_Other_No2_Col_4 ); //12
				$this->db->duplicate("CC_Other_Member_Since2" , $CC_Other_Member_Since2 ); //CC_Other_Member_Since2

				$this->db->duplicate("Relative_Director" , $Relative_Director ); //Tidak
				$this->db->duplicate("Member_Director" , $Member_Director ); //Tidak
				$this->db->duplicate("Additional_Title" , $Additional_Title ); //Bapak
				$this->db->duplicate("Additional_Name_ID" , $Additional_Name_ID ); //Additional_Name_ID
				$this->db->duplicate("Additional_Name_Other" , $Additional_Name_Other ); //Additional_Name_Other
				$this->db->duplicate("Additional_Relation" , $Additional_Relation ); //Lainnya
				$this->db->duplicate("Additional_Relation_Other" , $Additional_Relation_Other ); //Additional_Relation_Other
				$this->db->duplicate("Additional_DOB" , $Additional_DOB ); //Additional_DOB
				$this->db->duplicate("Additional_Place_Birth" , $Additional_Place_Birth ); //Additional_Place_Birth
				$this->db->duplicate("Additional_Mother_Name" , $Additional_Mother_Name ); //Additional_Mother_Name
				$this->db->duplicate("Additional_No_ID" , $Additional_No_ID ); //12
				$this->db->duplicate("Additional_Mobile_Ph_Kode" , $Additional_Mobile_Ph_Kode ); //12
				$this->db->duplicate("Additional_Mobile_Ph" , $Additional_Mobile_Ph ); //12
				$this->db->duplicate("Additional_Addr1" , $Additional_Addr1 ); //Additional_Addr1
				$this->db->duplicate("Additional_RT" , $Additional_RT ); //12
				$this->db->duplicate("Additional_RW" , $Additional_RW ); //12
				$this->db->duplicate("Additional_Kec" , $Additional_Kec ); //Additional_Kec
				$this->db->duplicate("Additional_City" , $Additional_City ); //Additional_City
				$this->db->duplicate("Additional_state" , $Additional_state ); //Additional_state
				$this->db->duplicate("Additional_Zipcode" , $Additional_Zipcode ); //12
				$this->db->duplicate("Additional_Addr_Other_Country" , $Additional_Addr_Other_Country ); //Additional_Addr2
				$this->db->duplicate("Additional_Nationality" , $Additional_Nationality ); //Additional_Addr2
				$this->db->duplicate("Additional_Nationality_Other" , $Additional_Nationality_Other ); //Additional_Addr2



				$this->db->insert_on_duplicate($tableName);
				//print_r($this->db->last_query());

				//print_r($result_post);

				// update t_gn_customer 
				
				$ParamUpdate = array(
					"CustomerEmail" => $Email , 
					"ProductId" 	=> $ProductId , 
					"SalesDate"		=> date("Y-m-d H:i:s")				
				);

				$UpdateMailCustomer = $this->MailUpdateCustomer($Customer_ID , $ParamUpdate);
				
				if ( $this->db->affected_rows() >= 0 AND $UpdateMailCustomer == true ) {
			    	echo 1;
			    } else {
			    	echo 0;
			    }

			} else {
				echo 0;
			}
		} else {
			// nothing to do error 
			return 0;
		}

		
	}


	// short form start from here
	public function sendAddon ( $result_post = "" , $tableName = "" ) {
		if ( is_array( $result_post ) ) {
			// set mandatory 
			$TabledetailAddon = "t_gn_app_addon_detail";
			extract($result_post);

			if ( $Customer_ID != "" AND (int)$Customer_ID AND !empty($Customer_ID)  ) {

				// Set Insert Into Database
				
				$insert_addon["Customer_ID"] = $Customer_ID;
				$insert_addon["Holder_Name"] = $Holder_Name;
				$insert_addon["Holder_Card_No"] = $Holder_Card_No;
				$insert_addon["Holder_Mobile_Ph"] = $Holder_Mobile_Ph;
				$insert_addon["Holder_Home_Ph"] = $Holder_Home_Ph;
				$insert_addon["Holder_Office_Ph"] = $Holder_Office_Ph;
				$insert_addon["Applicant_Additional_Offer"] = $Applicant_Additional_Offer;

				$this->db->insert_on_duplicate($tableName , $insert_addon);

				$totalApp = count($Applicant_Title);

			    for ($i=0; $i < $totalApp ; $i++) { 
			    	// set detail applicant
					$insert_detail['Customer_ID']					 = $Customer_ID;
			        $insert_detail['Previx_App']  					 = isset($Previx_App[$i]) ? $Previx_App[$i] : null;
			        $insert_detail['Applicant_Title']  				 = isset($Applicant_Title[$i]) ? $Applicant_Title[$i] : null;
			        $insert_detail['Applicant_Name_ID'] 			 = isset($Applicant_Name_ID[$i]) ? $Applicant_Name_ID[$i] : null;
			        $insert_detail['Applicant_Name_Card'] 			 = isset($Applicant_Name_Card[$i]) ? $Applicant_Name_Card[$i] : null;
			        $insert_detail['Applicant_No_ID'] 				 = isset($Applicant_No_ID[$i]) ? $Applicant_No_ID[$i] : null;
			        $insert_detail['Applicant_Mobile_No'] 			 = isset($Applicant_Mobile_No[$i]) ? $Applicant_Mobile_No[$i]: null;
			        $insert_detail['Applicant_DOB']					 = isset($Applicant_DOB[$i]) ? $Applicant_DOB[$i] : null;
			        $insert_detail['Applicant_Gender'] 				 = isset($Applicant_Gender[$i]) ? $Applicant_Gender[$i] : null;
			        $insert_detail['Applicant_Nationality'] 		 = isset($Applicant_Nationality[$i]) ? $Applicant_Nationality[$i] : null;
			        $insert_detail['Applicant_Relation_To_CH'] 		 = isset($Applicant_Relation_To_CH[$i]) ? $Applicant_Relation_To_CH[$i] : null;
			        $insert_detail['Applicant_Relation_To_CH_Other'] = isset($Applicant_Relation_To_CH_Other[$i]) ? $Applicant_Relation_To_CH_Other[$i] : null;
			        $insert_detail['Applicant_Mother_Name'] 		 = isset($Applicant_Mother_Name[$i]) ? $Applicant_Mother_Name[$i] : null;
			        $insert_detail['CreatedTs'] 		 			 = date("Y-m-d");
			        $this->db->insert_on_duplicate( $TabledetailAddon ,$insert_detail);
			    }

				// update t_gn_customer 
				
				$ParamUpdate = array(
					"ProductId" 	=> $ProductId , 
					"SalesDate"		=> date("Y-m-d H:i:s")
				);


				$UpdateCustomer = $this->MailUpdateCustomer($Customer_ID , $ParamUpdate);
				

				if ( $this->db->affected_rows() >= 0 AND $UpdateCustomer == true ) {
			    	echo 1;
			    } else {
			    	echo 0;
			    }

			} else {
			    echo 0;
			}

		} else {
			echo 0;
		}
	}

	public function sendXsell ( $result_post = "" , $tableName = "" ) {
		if ( is_array( $result_post ) ) {
			// set mandatory 

			extract($result_post);

			if ( $Customer_ID != "" AND (int)$Customer_ID AND !empty($Customer_ID)  ) {

				// Set Insert Into Database
				$this->db->set("Customer_ID" , $Customer_ID);
				$this->db->set("Card_Level" , $Card_Level);
				$this->db->set("Name_ID" , $Name_ID);
				$this->db->set("Place_Birth" , $Place_Birth);
				$this->db->set("Card_No_HSBC" , $Card_No_HSBC);
				$this->db->set("Occupation" , $Occupation);
				$this->db->set("Mobile_Ph" , $Mobile_Ph);
				$this->db->set("Mobile_Ph_Area" , $Mobile_Ph_Area);
				$this->db->set("Income_Yearly" , $Income_Yearly);
				$this->db->set("Agree_Share_Limit" , $Agree_Share_Limit);

				$this->db->duplicate("Customer_ID" , $Customer_ID);
				$this->db->duplicate("Card_Level" , $Card_Level);
				$this->db->duplicate("Name_ID" , $Name_ID);
				$this->db->duplicate("Place_Birth" , $Place_Birth);
				$this->db->duplicate("Card_No_HSBC" , $Card_No_HSBC);
				$this->db->duplicate("Occupation" , $Occupation);
				$this->db->duplicate("Mobile_Ph" , $Mobile_Ph);
				$this->db->duplicate("Mobile_Ph_Area" , $Mobile_Ph_Area);
				$this->db->duplicate("Income_Yearly" , $Income_Yearly);
				$this->db->duplicate("Agree_Share_Limit" , $Agree_Share_Limit);


				// update t_gn_customer 
				
				$ParamUpdate = array(
					"ProductId" 	=> $ProductId , 
					"SalesDate"		=> date("Y-m-d H:i:s")
				);

				$this->db->insert_on_duplicate($tableName);

				$UpdateCustomer = $this->MailUpdateCustomer($Customer_ID , $ParamUpdate);
				

				if ( $this->db->affected_rows() >= 0 AND $UpdateCustomer == true ) {
			    	echo 1;
			    } else {
			    	echo 0;
			    }
			    
			} else {
				echo 0;
			}
		}


	}

	/**
	 * [MailUpdateCustomer description]
	 * @param string $Customer_ID [Set Customer ID for Update Customer On specific]
	 * @param string $setValue     [Set Mail for Value Updated]
	 */
	public function MailUpdateCustomer ( $Customer_ID = "" , $setValue = "" ) {

		// check if customer is Not Empty !
		if ( $Customer_ID != "" AND (int)$Customer_ID AND !empty($Customer_ID) ) {

				// Set Mail For Value Update Mail
				if ( $setValue == "" OR empty($setValue) ) {
					$ReturnData = false;
				} else {

					// Check if Set Value is Array
					if ( is_array( $setValue ) ) {

						$setValues = '';

						foreach ( $setValue as $column => $value ) {
							//"a.CustomerEmail='$setValue'"
							if ( $column != "" ) {
								$setValues .= $column."='$value',";
							} else {

							}
						} 

						$setValues .= '';
						$setValues = rtrim( $setValues , ',' );

						$checkSalesDate = $this->db->query("
								SELECT a.SalesDate 
								FROM t_gn_customer a
								WHERE a.CustomerId='$Customer_ID' 
						");

						if ( $checkSalesDate == true AND $checkSalesDate->num_rows() > 0 ) {
							$csd = $checkSalesDate->row();
							if ( $csd->SalesDate != "" AND $csd->SalesDate != NULL ) {
								$UpdateCustomer = "UPDATE t_gn_customer SET ".str_replace("SalesDate","UpdateSalesDate",$setValues)." ";
								$UpdateCustomer .= " WHERE CustomerId='$Customer_ID'";
							} else {
								$UpdateCustomer = "UPDATE t_gn_customer SET ".$setValues." ";
								$UpdateCustomer .= " WHERE CustomerId='$Customer_ID'";
							}
						} 

						// Start Update Here
						$this->db->query($UpdateCustomer);
						
						if ( $this->db->query($UpdateCustomer) == true ) {
							return true;
						} else {
							$ReturnData = false;
						}

					} else {
						// Start Update Here
						$UpdateMail = $this->db->query(	
							"UPDATE t_gn_customer a 
							SET a.CustomerEmail='$setValue'
							WHERE a.CustomerId='$Customer_ID'"
						);

						// Check if Has Updated
						if ( $UpdateMail == true  ) {
							$ReturnData = true;
						} else {
							$ReturnData = false;
						}
						
					}

					

				}

		} else {
			$ReturnData = false;
		}

		return $ReturnData;
	}
 





  // ==================== END CLASS ===========================
}
?>
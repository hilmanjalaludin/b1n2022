<?php
/*
 * E.U.I 
 *
 
 * subject	: ProductForm
 * 			  extends under Controller class
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/controller/ProductForm/
 */
 


class ProductForm extends EUI_Controller
{

private static $ProductId = null;
private static $CustomerId = null;
private static $ViewLayout = null;

/*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : null
 * @ author : razaki team
 * 
 */
 
 public function __construct()
{
	parent::__construct();
	
// ------------ load attribute ----------------------
	
	$this->load->model(array('M_ProductForm' , 'M_Combo' , 'M_Generator') );
	$this->load->helper(array('EUI_Object'));
	
// ------------ load attribute ----------------------

	$objProd =& get_class_instance('M_ProductForm');
	if( is_null(self::$CustomerId)){
		self::$CustomerId =& _get_64post('CustomerId');
	}
	
	self::$ProductId =_get_post('ProductId'); 
	 if(!is_null(self::$ProductId)) 
	{
		self::$ViewLayout = $objProd->_getAddFormLayout(self::$ProductId);
	}	
} 

public function index()
{
	if( $this -> URI->_get_have_post('CustomerId')) 
	{
		$ViewLayout = $this -> URI->_get_post('ViewLayout');
		switch($ViewLayout)
		{
			case 'ADD_FORM' 	: 
				$this -> FormAddLayout();  
			break;
			
			case 'EDIT_FORM' 	: 
				$this -> FormEditLayout(); 
			break;

			case 'PREVIEW_FORM' 	: 
				$this -> FormPreview(); 
			break;
		}
	}
}


/**
 * [FormSave description]
 * @param string $ketForm [description]
 */
public function FormSave ( $ketForm = '' ) {
	$result_post = _get_all_request();


	if ( $ketForm == 'PILL' 
		|| $ketForm == 'CC' ) {
		// Need_KTP
		// Need_NPWP
		// Need_Other_Bank_Card
		// Need_Income_Doc
		$Need_KTP 			  = isset($_POST['Need_KTP']) ? $_POST['Need_KTP'] : null;
		$Need_NPWP 			  = isset($_POST['Need_NPWP']) ? $_POST['Need_NPWP'] : null;;
		$Need_Other_Bank_Card = isset($_POST['Need_Other_Bank_Card']) ? $_POST['Need_Other_Bank_Card'] : null;;
		$Need_Income_Doc 	  = isset($_POST['Need_Income_Doc']) ? $_POST['Need_Income_Doc'] : null;
		$CreatedById 		  = _have_get_session("UserId");
		$ProductId			  = isset($_POST['ProductId']) ? $_POST['ProductId'] : null;
		$Customer_ID		  = isset($_POST['Customer_ID']) ? $_POST['Customer_ID'] : null;

		$InsertsToAdditionalDoc = array(
			"Need_KTP"			   =>  $Need_KTP, 
			"Need_NPWP"			   =>  $Need_NPWP, 
			"Need_Other_Bank_Card" =>  $Need_Other_Bank_Card, 
			"Need_Income_Doc" 	   =>  $Need_Income_Doc, 
			"CreatedById" 		   =>  $CreatedById, 
			"ProductId" 		   =>  $ProductId, 
			"CustomerId" 		   =>  $Customer_ID 
		);
		
		if ( is_array( $InsertsToAdditionalDoc ) ) {
			$InsertsAdditional = $this->M_ProductForm->_SendAdditionalDoc($InsertsToAdditionalDoc);
			// Check insert is true 
			if ( $InsertsAdditional == true ) {
				$this->InsertsAdditional = true;
			} else {
				$this->InsertsAdditional = false;
			}
		} 

	}

	if ( $ketForm == 'PILL' ) {
		$tableName = 't_gn_app_pil';
		$this->tableName = $tableName;
		if ( is_array( $result_post ) ) {
			$this->M_ProductForm->sendPill($result_post , $tableName);

		} else {
			echo 0;
		}
	} 

	elseif ( $ketForm == 'CC' ) {
		$tableName = 't_gn_app_card';
		$this->tableName = $tableName;

		if ( is_array( $result_post ) ) {
			//print_r($result_post);
			//return false;
			$this->M_ProductForm->sendCard($result_post , $tableName);
		} else {
			echo 0;
		}
	}

	elseif ( $ketForm == 'ADDON' ) {
		$tableName = 't_gn_app_addon';
		$this->tableName = $tableName;

		if ( is_array( $result_post ) ) {
			$this->M_ProductForm->sendAddon($result_post , $tableName);
		} else {
			echo 0;
		}

	} 

	elseif ( $ketForm == 'XSELL' ) {
		$tableName = 't_gn_app_xsell';
		$this->tableName = $tableName;

		if ( is_array( $result_post ) ) {
			$this->M_ProductForm->sendXsell($result_post , $tableName);
		} else {
			echo 0;		
		}
	}

	else {
		echo 0;
	}

	
}


 public function FormAddLayout()
{
	$obClass =& get_class_instance(base_class_model($this));
	
	if( !is_null(self::$ViewLayout) 
		AND !empty(self::$ViewLayout) ) 
	{
		$form = array
		(
			"CustomerId" 		=> self::$CustomerId , 
			'form' 				=> self::$ViewLayout,
			"ProductId"			=> self::$ProductId , 
			"SalesForceCode"	=> $this->M_Generator->_getSalesForce(self::$CustomerId,self::$ProductId) , 
			'Product' 			=> $this->getProductForm() , 
			'labelField'		=> $this->{base_class_model($this)}->_SetLabel($this->M_ProductForm->_getTableNameProduct(self::$ProductId)) , 
			'AppCustomer'		=> $this->M_ProductForm->_getAppCustomer(self::$CustomerId , self::$ProductId),
			'AdditionalDoc'		=> $this->M_ProductForm->_getAppCustomer(self::$CustomerId , self::$ProductId , 'ADDDOC')
		);
		
		$this -> load -> form('add_form/'. self::$ViewLayout .'/form_content',$form);
	}	
}


 // Funtion Form Edit
 public function FormEditLayout()
{
	
	$obClass =& get_class_instance(base_class_model($this));
	
	if( !is_null(self::$ViewLayout) 
		AND !empty(self::$ViewLayout) ) 
	{
		$form = array
		(
			'form' 				=> self::$ViewLayout
		);
		//echo 'edit_form/'. self::$ViewLayout .'/form_content';
		$this -> load -> form('add_form/'. self::$ViewLayout .'/form_content',$form);
	}
	
 }


// Funtion Form Input Preview Pdf
 public function FormPreview()
{
	
	$obClass =& get_class_instance(base_class_model($this));
	
	if( !is_null(self::$ViewLayout) 
		AND !empty(self::$ViewLayout) ) 
	{

		$load_form = 'preview_form/'. self::$ViewLayout .'/form_preview';
		
		$NamaProduct = $this->M_ProductForm->_getTableNameProduct( self::$ProductId , "ProductCode" );

		$form = array(
			"CustomerId"  => self::$CustomerId , 
			"Status" 	  => "Preview" , 
			"base_style_preview" => base_url()."library/gambar/form/".self::$ViewLayout."/" , 
			'form'		  => self::$ViewLayout,
			"AppCustomer" => $this->M_ProductForm->_getAppCustomer(self::$CustomerId , self::$ProductId , 'PREVIEW')
		);

		if ( $NamaProduct == "addon" ) {
			$form = array_merge($form , array(
				"detailAddon" => $this->M_ProductForm->_detailAddon(self::$CustomerId),
				"SalesForceCode" => $this->M_Generator->_getSalesForce(self::$CustomerId , 'addon'), 
				"MarketingCode"  => $this->M_Generator->generatorAddon( "mktcode" , self::$CustomerId),
				"CustomerIds"    => $this->M_Generator->_getCustomerInformation( self::$CustomerId , "CustomerNumber" ),
				"STP"    => $this->M_Generator->_getCustomerInformation( self::$CustomerId , "STP" )
			));
		} elseif ( $NamaProduct == "pil" ) {
			$form = array_merge($form , array(
				"SalesForceCode" => $this->M_Generator->_getSalesForce(self::$CustomerId), 
				"MarketingCode"  => $this->M_Generator->generatorPil( "mktcode" , self::$CustomerId) , 
				"STP"    => $this->M_Generator->_getCustomerInformation( self::$CustomerId , "STP" )
			));
		} elseif ( $NamaProduct == "card" ) {
			$form = array_merge($form , array(
				"SalesForceCode" => $this->M_Generator->_getSalesForce(self::$CustomerId), 
				
				"SF1" => $this->M_Generator->_getSalesForce(self::$CustomerId , "SF1"), 
				"SF2" => $this->M_Generator->_getSalesForce(self::$CustomerId , "SF2"), 
				"SF3" => $this->M_Generator->_getSalesForce(self::$CustomerId , "SF3"), 
				"SF4" => $this->M_Generator->_getSalesForce(self::$CustomerId , "SF4"), 
				"SF5" => $this->M_Generator->_getSalesForce(self::$CustomerId , "SF5"), 
				"SF6" => $this->M_Generator->_getSalesForce(self::$CustomerId , "SF6"), 

				"MarketingCode"  => $this->M_Generator->generatorCard( "mktcode" , self::$CustomerId), 
				"CustomerIds"    => $this->M_Generator->_getCustomerInformation( self::$CustomerId , "CustomerNumber" ), 
				"STP"    => $this->M_Generator->_getCustomerInformation( self::$CustomerId , "STP" )
			));
		} elseif ( $NamaProduct == "xsell" ) {
			$form = array_merge($form , array(
				"CustomerIds"    => $this->M_Generator->_getCustomerInformation( self::$CustomerId , "CustomerNumber" ) , 
				"SalesForceCode" => $this->M_Generator->_getSalesForce(self::$CustomerId), 
				"MarketingCode"  => $this->M_Generator->generatorXsell( "mktcode" , self::$CustomerId), 
				"STP"    => $this->M_Generator->_getCustomerInformation( self::$CustomerId , "STP" )
			));
		}

		
		
		//print_r($form);

		//echo 'edit_form/'. self::$ViewLayout .'/form_content';
		$this -> load -> form($load_form,$form);
	}
	
 }






/*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 * 
 */
 

function getProductForm()
{
	$array = array 
	(
		'ProductId' => $this->{base_class_model($this)}->_getProduct(),
		'ProductName' => 'Product Name Here' , 
		'SalesDate' => date('d-m-Y'),
		'EfectiveDate' => date('d-m-Y') , 
		'PolicyNumber' => "" 
	);
	return $array;
}




// === SHOW ALL INFORMATION ABOUT FORM HERE === //


/*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 * 
 */
 
function _getCampaignId()
{
	$_conds = null;
	if( is_null($_conds))
	{
		if( self::$CustomerId )
		{
			$_conds = $this->{base_class_model($this)}-> _getCampaignId(self::$CustomerId);
		}	
	}
	
	return $_conds;
}

/*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 * 
 */

 
function getCombo()
{	
	$_serialize = array();
	$_combo = $this -> M_Combo -> _getSerialize();
	foreach( $_combo as $keys => $method )
	{
		if((STRTOLOWER($keys)!='serialize') AND (STRTOLOWER($keys)!='instance') 
			AND (STRTOLOWER($keys)!='nstruct') AND (STRTOLOWER($keys)!='t'))
		{
			$_serialize[$keys] = $this -> M_Combo -> $method(); 	
		}
	}
	
	return $_serialize;
}



// ======== GETTING ZIP AREA HERE ==== //
  
 function GetZip()
 {
	$_results = array();
	
	$_address = $this -> {base_class_model($this)} -> _GetZip($this->URI->_get_post('province'));
	
	if( is_array($_address) )
	{
		foreach( array_keys($_address) as $index => $zip ) {
			$_results[] = trim($zip);	
		}
	}
	
	
	echo json_encode($_results);
 }
 
 function getGenderByTitle()
 {
	$result = array(
		'gender_id' => $this->{base_class_model($this)}->_getGenderByTitle($this->URI->_get_post('id'))
	);
	
	__(json_encode($result));
 }
 
 function LuhnStartHere()
 {
	$conds = array('result' => 0);
	
	$ganjil = 0;
	$genap = 0;
	
	$num = $this->URI->_get_post('number');
	$kopi = str_split($num);
	
	foreach($kopi as $key => $value)
	{
		if($key%2 == 1)
		{
			$ganjil += (int)$value;
		}
		else{
			$genap += (int)(strlen($value*2)>1?(($value*2)-9):($value*2));
		}
	}
	
	if( (($genap+$ganjil)%10) == 0 )
	{
		$conds['result'] = 1;
	}
	
	__(json_encode($conds));
 }


// -------------- end class 
 
}
?>
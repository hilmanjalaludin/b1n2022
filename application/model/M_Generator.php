<?php

/* @ def 	: class Policy
 *
 * @ param  : generator policy parameter
 * @ author : razaki team 
 */ 
 
/**
 * First thnik of Generate is 
 * 	-> View on t_lk_salesforce 
 * 	-> Generate Berdasarkan Recsource , Marketing Code and Jenis Card
 */

define('ERROR_SELECTED' , 'error');

class M_Generator extends EUI_Model 
{

	static $ProducId;

	/**
	 * [_getCustomerInformation description]
	 * @param  string $setBy      [description]
	 * @param  string $CustomerId [description]
	 * @return [type]             [description]
	 * This method is for Get Informations of Customer
	 * By CustomerId 
	 * Get Product By CustomerId
	 * Get Pod By CustomerId
	 * Get GetCallReason By CustomerId
	 * Get Seller By CustomerId
	 * Get Customer By Customer Number
	 * Get Marketing Code
	 * Format Salesforce 
	 */

	public function _getCustomerInformation ( $CustomerId =0 , $get = '') {
		if ( $CustomerId!=0 ) {
			$getCustomer = $this->db->query("SELECT * FROM t_gn_customer a WHERE a.CustomerId='$CustomerId'");
			if ( $getCustomer == true AND $getCustomer->num_rows() > 0 ) {
				$rowcust = $getCustomer->row();
				if ( $get!='' ) :
					return $rowcust->{$get};
				else :
					return $rowcust;
				endif;
			} else {
				return  'error';
			}
		} else {
			return 'error';
		}
	}

	public function generatorPil ( $status = "" , $CustomerId=0 ) {
		// Pil berdasarkan Recsource dan Product
		// ELSE XYBC
		if ( $status == 'mktcode' ) {	
			if ( empty($CustomerId) AND $CustomerId == 0 ) :
				$ReturnData = "error";
			else :

				$Mktcode_Card = 
				"SELECT  
				b.CardType ,
				a.Customer_ID , 
				b.Rec_Source , 
				b.MktCode , 
				c.Recsource
				FROM t_gn_app_pil a 
				INNER JOIN t_gn_customer c on a.Customer_ID=c.CustomerId
				INNER JOIN t_lk_marketing_code b on c.ProductId=b.ProductId
				WHERE c.Recsource=b.Rec_Source
				AND c.CustomerId='$CustomerId'";

				// start select to get marketing code 
				$selectMarketingCode = $this->db->query($Mktcode_Card);
				$selectToNeed_Income_Doc = $this->db->query("SELECT * FROM t_gn_additional_doc a WHERE a.CustomerId='$CustomerId'");
				
				if ( $selectToNeed_Income_Doc == true AND $selectToNeed_Income_Doc->num_rows() > 0 ) {
					$sid = $selectToNeed_Income_Doc->row();
					if ( $sid->Need_Income_Doc == "2" ) {
						$ReturnData = "DSAR";
					} else {
						if ( $selectMarketingCode == true AND $selectMarketingCode->num_rows() > 0 ) :
							if ( $selectMarketingCode == true AND $selectMarketingCode->num_rows() > 0 ) :
								$ReturnData = $selectMarketingCode->row();
							else :	
								$ReturnData = 'error';
							endif;	

						else :
							$ReturnData = 'XYBC';
						endif;
					}
				} else {
					$ReturnData = "error";
				}
			endif; 
		} else {
			$ReturnData = "error";
		}

		return $ReturnData;
	}


	public function generatorCard ( $status = '' , $CustomerId=0 ) {
		// Marketing Code by Select Level Card
		// Berdasarkan Recsource , Product dan CardType
		if ( $status == 'mktcode' ) {
			if ( empty($CustomerId) AND $CustomerId == 0 ) :
				$ReturnData = "error";
			else :

				$Mktcode_Card = 
				"SELECT  b.CardType , a.Customer_ID , b.Rec_Source , 
						 b.MktCode , a.CC_HSBC_Level , c.Recsource
				FROM t_gn_app_card a 
				INNER JOIN t_lk_marketing_code b on a.CC_HSBC_Level=b.CardType
				INNER JOIN t_gn_customer c on a.Customer_ID=c.CustomerId
				WHERE c.Recsource=b.Rec_Source
				AND c.CustomerId='$CustomerId'";

				// start select to get marketing code 
				$selectMarketingCode = $this->db->query($Mktcode_Card);
				if ( $selectMarketingCode == true AND $selectMarketingCode->num_rows() > 0 ) :
					if ( $selectMarketingCode == true AND $selectMarketingCode->num_rows() > 0 ) :
						$ReturnData = $selectMarketingCode->row();
					else :	
						$ReturnData = 'error';
					endif;	

				else :
					$ReturnData = 'STSP';
				endif;
			endif; 

		} else {
			
		}

		return $ReturnData;
		
	}

	public function generatorAddon ( $status = '' , $CustomerId=0  ) {
		// Marketing Code by Benefit Choose By Agent
		// Parameter by Insert Agent
		if ( $status == 'mktcode' ) {
				if ( empty($CustomerId) AND $CustomerId == 0 ) :
					$ReturnData = "error";
				else :

					$Mktcode_Card = 
					"SELECT 
					b.CardType ,
					a.Customer_ID , 
					b.Rec_Source , 
					b.MktCode , 
					c.Recsource
					FROM t_gn_app_addon a 
					INNER JOIN t_gn_customer c on a.Customer_ID=c.CustomerId
					INNER JOIN t_lk_marketing_code b on c.ProductId=b.ProductId
					WHERE a.Applicant_Additional_Offer=b.CardType 
					AND a.Customer_ID='$CustomerId'";

					// start select to get marketing code 
					$selectMarketingCode = $this->db->query($Mktcode_Card);
					
					if ( $selectMarketingCode == true AND $selectMarketingCode->num_rows() > 0 ) :
						$ReturnData = $selectMarketingCode->row();
					else :
						$ReturnData = 'error';
					endif;

				endif; 
		} else {
			$ReturnData = "error";
			
		}
			return $ReturnData;

	}


	public function generatorXsell ( $status='' , $CustomerId=0 ) {
		// Marketing Code By Level Card HSBC
		// Berdasarkan Recsource , Product dan CardType
		if ( $status == 'mktcode' ) {
			if ( empty($CustomerId) AND $CustomerId == 0 ) :
				$ReturnData = "error";
			else :

				$Mktcode_Card = 
				"SELECT 
				b.CardType ,
				a.Customer_ID , 
				b.Rec_Source , 
				b.MktCode , 
				c.Recsource
				FROM t_gn_app_xsell a 
				INNER JOIN t_gn_customer c on a.Customer_ID=c.CustomerId
				INNER JOIN t_lk_marketing_code b on c.ProductId=b.ProductId
				WHERE a.Card_Level=b.CardType
				AND a.Customer_ID='$CustomerId'";

				// start select to get marketing code 
				$selectMarketingCode = $this->db->query($Mktcode_Card);
				if ( $selectMarketingCode == true AND $selectMarketingCode->num_rows() > 0 ) :
					if ( $selectMarketingCode == true AND $selectMarketingCode->num_rows() > 0 ) :
						$ReturnData = $selectMarketingCode->row();
					else :	
						$ReturnData = 'error';
					endif;	

				else :
					$ReturnData = 'STSP';
				endif;
			endif; 

		} else {
			
		}

		return $ReturnData;
	}

	/**
	 * [_getSalesForce description]
	 * @return [type] [description]
	 */
	public function _getSalesForce ( $CustomerId =0 , $Val = "" ) {
		$MergeSalesForce = "";

		if ( $CustomerId != 0 ) {
			$Customer = $this->_getCustomerInformation($CustomerId);
			if ( $Customer != 'error' ) {

				$Recsource = $Customer->Recsource;
				$Recsource = explode("-" , $Recsource);
				$Recsource = $Recsource[0];

				$SellerId  = $Customer->SellerId;

				// start select to salesforce
				$Salesforce = $this->db->query("SELECT 
												* FROM t_lk_sales_force a 
												WHERE 
												a.SF_Rec_Source='$Recsource'");
				if ( $Salesforce == true AND $Salesforce->num_rows() > 0 ) {
					$sf = $Salesforce->row();
					$SelectAgent = $this->db->query("SELECT a.code_user 
													 FROM tms_agent a 
													 WHERE a.UserId='$SellerId';");
					
					if ( $SelectAgent == true AND $SelectAgent->num_rows() > 0 ) {
						$SelectAgent = $SelectAgent->row();

						$sf_first  = $sf->SF_Field1 . $sf->SF_Field2;
						$sf_second = strtoupper(str_replace(" " , "" , $SelectAgent->code_user ));
						$sf_third  = $sf->SF_Field6 . 
									 $sf->SF_Field7 . 
									 $sf->SF_Field8 .
									 $sf->SF_Field9 .
									 $sf->SF_Field10;

						if ( $Val == 'addon' ) {
							$MergeSalesForce = "U".$sf->SF_Field2.$sf_second."9A999";
						} else {
							$MergeSalesForce = $sf_first.$sf_second.$sf_third;
						}

						switch ( $Val ) {
							case "SF1" : $MergeSalesForce = $sf->SF_Field1 . $sf->SF_Field2 ; break ; 
							case "SF2" : $MergeSalesForce = $sf_second; break;
							case "SF3" : $MergeSalesForce = $sf->SF_Field6; break;
							case "SF4" : $MergeSalesForce = $sf->SF_Field7; break;
							case "SF5" : $MergeSalesForce = $sf->SF_Field8.$sf->SF_Field9; break;
							case "SF6" : $MergeSalesForce = $sf->SF_Field10; break;
						}	

					} else {

					}

				} else {
					$SelectAgents = $this->db->query("SELECT a.code_user 
													 FROM tms_agent a 
													 WHERE a.UserId='$SellerId';");
					
					if ( $SelectAgents == true AND $SelectAgents->num_rows() > 0 ) {
						$SelectAgents = $SelectAgents->row();
						$sf_second = str_replace( " " , "" , $SelectAgents->code_user);
						$MergeSalesForce = "UC".$sf_second."CATEX";
					} else {
						$MergeSalesForce = "UC0000CATEX";
					}

				}
			} else {

			}
		} else {

		}

		return $MergeSalesForce;


	}	




}

?>
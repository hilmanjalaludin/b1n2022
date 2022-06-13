<?php 

/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
class M_AdminAssignment extends EUI_Model{

 private static $params = null;

 
 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 private static $Instance   = null; 
 public static function &Instance() {
	if( is_null(self::$Instance) ){
		self::$Instance = new self();
	}	
	return self::$Instance;
}


/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
function __construct(){
 $this->load->model(array('M_UserRole'));	
}	

/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
function _select_row_bucket_page( $out = null, $ar = null  ) {
	
 // define array result data 
	$result_array = array();	
	
// reset cache 	
	$this->db->reset_select();
	
// jika data bbukan null dan bertipe arrray 

	if( !is_null( $ar ) and is_array($ar)  ){
		$this->db->select($ar,false);
	}
// selain kondisi di atas.	
	else {  
		$this->db->select(" 
			a.Assign_Sell_Id as DM_AssignId,
			b.DM_CampaignId, 
			b.DM_FirstName,
			b.DM_Custno,
			b.DM_DataType,
			b.DM_AddressLine1,
			b.DM_AddressLine2,
			b.DM_AddressLine3,						
			b.DM_SellerKode,
			b.DM_CallCategoryKode,
			b.DM_QualityUserId,
			b.DM_QualityCategoryKode,
			b.DM_AdmId,
			b.DM_AdmCategoryKode,
			b.DM_QualityUpdateTs", false);
							
	}					
	$this->db->from("t_gn_selling_assignment a");
	$this->db->join("t_gn_customer_master b ", "a.Assign_Sell_CustId=b.DM_Id", "inner");
	
  // default data 	
	$this->db->where('a.Assign_Sell_AdminId', 0);
	$this->db->where('a.Assign_Sell_IsReady', 1);
	$this->db->where('b.DM_CampaignId', 29);
	
	//filter by recsource jika memang ada
	if( $out->find_value('dis_recsource_name') ){
	 	$this->db->where_in('b.DM_Recsource', $out->fields('dis_recsource_name'));
 	}
	
	if( $out->find_value('frm_admin_customerno') ){
	 	$this->db->where_in('b.DM_Custno', $out->fields('frm_admin_customerno'));
 	}

	if( $out->find_value('frm_admin_campaignid') ) {
		$this->db->where_in('b.DM_CampaignId', $out->fields('frm_admin_campaignid'));
	}
	
	if( $out->find_value('frm_bucket_start_date') ){
		$this->db->where(sprintf("b.DM_QualityUpdateTs>='%s'", $out->get_value('frm_bucket_start_date','StartDate')), "", FALSE); 
    }
	
	if( $out->find_value('frm_bucket_end_date') ){
		$this->db->where(sprintf("b.DM_QualityUpdateTs<='%s'", $out->get_value('frm_bucket_end_date','EndDate')), "", FALSE); 
    }

	if( $out->find_value('frm_admin_data_type') ) {
		$this->db->where('b.DM_DataType', $out->get_value('frm_admin_data_type'));
	}
	 // filter data by user process
   if( $out->find_value('orderby') ) {
	 $this->db->order_by( $out->get_value('orderby'), $out->get_value('type') );		
   } else {
	 $this->db->order_by( "a.Assign_Sell_Id", "DESC"); 
   }
	// get source data processs on here .
	// echo "<pre>";
	// echo $this -> db -> _get_var_dump();
	// echo "</pre>";
	$qry = $this->db->get();
	if( $qry && $qry->num_rows() > 0 ) {
		$result_array = $qry->result_assoc();
	}

	return (array)$result_array;
 
}

/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 function _set_row_update_admin( $UserID = 0, $result_array = null ) 
 {
	// total setiap user 
    $total = 0;	
	// update table t_gn_selling_assignment
	$callDateData  = date( 'Y-m-d H:i:s');
	
	if( is_array( $result_array ) )  foreach(  $result_array as $key => $row ){
		$this->row = Objective( $row );
		if( !$this->row->field('DM_AssignId')  ){
			continue;
		}
		
		// add select row data process 
		$this->val = Dropdown()->_getUserKode( $UserID);
		
		// additional iobject 
		$this->row->add('Assign_Sell_GroupId', 	$this->val->field('tl_id'));
		$this->row->add('Assign_Sell_Id', 		$this->row->field('DM_AssignId'));
		$this->row->add('Assign_Sell_AdminId', 	$UserID);
		$this->row->add('Assign_Sell_UpdateTs', $callDateData);
		
		// on process if data found !.
		//print_r($row);
		$sql  = sprintf("UPDATE t_gn_selling_assignment SET 
							Assign_Sell_GroupId  = '%s',
							Assign_Sell_AdminId  = '%s', 
							Assign_Sell_UpdateTs = '%s'
						WHERE Assign_Sell_Id ='%s' ",  
							$this->row->field( 'Assign_Sell_GroupId' ),	
							$this->row->field( 'Assign_Sell_AdminId' ),
							$this->row->field( 'Assign_Sell_UpdateTs' ),
							$this->row->field( 'Assign_Sell_Id' ));
						
		// jika process update berasil update juga di custiomner master 					
		if(  $this->db->query( $sql ) ){
			$total++;
			
			
			// update data di customer Master .
			$sql = sprintf("UPDATE t_gn_customer_master a 
							INNER JOIN t_gn_selling_assignment b ON a.DM_Id=b.Assign_Sell_CustId
							SET a.DM_AdmId = '%s',
								a.DM_AdmUpdateTs = '%s',
								b.Assign_Sell_UpdateTs = NOW()
							WHERE b.Assign_Sell_Id = '%s' ", 
								$this->row->field( 'Assign_Sell_AdminId' ),
								$this->row->field( 'Assign_Sell_UpdateTs' ),
								$this->row->field( 'Assign_Sell_Id' ) );
			//debug($sql);
										
								
			$this->db->query( $sql );
		} 
	}
	// return callback process OK 
	return (int)$total;
 } 
/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
function _set_row_admin_quantity( $out = null ){
	//debug( $out);
	
	
	
//  define all variable data on here pager 
	
	$total_row_size = $out->field('frm_bucket_user_total');
	$total_row_data = $out->field('frm_admin_user_quantity');
	
//	jumlah user yang di pilih 
	$array_row_user = $out->fields('frm_admin_user_id');
	$total_row_user = count( $array_row_user );
	
// jika parameter ini berisi niai 0 return false. saja .	
	if( !$total_row_data OR !$total_row_size ){
		return false;
	}
	
// jika jumlah user lebih bayak dari data 
   if( $total_row_user > $total_row_data)	{
	   return false;
   }
   
 // bagikan untuk dapet petiap user  jumlah data di bagi user 
 // per_data_user  = 0
  $total_per_user = floor($total_row_data/$total_row_user);
  if( !$total_per_user){
	  return false;
  }
  
 // lanjut ke process looping data  untuk bucket 
 // data .
 
  $result_array = $this->_select_row_bucket_page( $out , array('a.Assign_Sell_Id as DM_AssignId') );
  if( !is_array($result_array) or !count($result_array) ) {
	return false; 
  }
  
 // masukan data tersebut ke masing masing user . 
  $total = 0;
  $start = 0 ;
  if( is_array($array_row_user) ) 
  foreach( $array_row_user as $ID ){
	// jika start  = 0  offset    = 0 
	if( !$start ){
		$offset = 0;
    }		
	$offset = ($start * $total_per_user );
	
	// ambil jadi source data array 
	$row_user_assoc = array();
	$row_user_assoc = array_slice( $result_array, $offset, $total_per_user);
	if( is_array( $row_user_assoc ) ){
		// then will update source data admin 
		$total += $this->_set_row_update_admin($ID,  $row_user_assoc);
	}
   
	$start++;
  }
  
  // return callback to user client OK .
  return (int)$total;
  
}



/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */

	
// end class process 	
}
?>
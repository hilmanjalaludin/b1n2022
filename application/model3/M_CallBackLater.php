<?php 
/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
class M_CallBackLater extends EUI_Model
{
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
 function _update_call_back_later( $out = null )
{
	
// jika data bukan object 	
 $this->cond = 0;
 if( !is_object($out) ){
	return false;
 }
 
// update t_gn_appoinment -nya ya . 
 $sql = sprintf("update t_gn_appoinment a set a.ApoinmentFlag = 1  where a.AppoinmentId='%s' and a.CustomerId='%s'", $out->field('AppointmentId'),   $out->field('CustomerId'));
 $qry = $this->db->query( $sql );
 if( $qry ){
	$this->cond++;
 } 
 return (bool)$this->cond;

}


/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
 function _select_call_back_later() {
	 
// ambil semua data session user.	 
	$this->cok = CK(); 
	
// push data ke dalam bentuk object sebelum di fetch 

	$this->cok->add('ApoinmentFlag', 0);	
	$this->cok->add('DM_CallCategoryId', array(APRV,CLOS,YCOM,NCOM ));
	
// get define of data process 	
	$this->result_array = array();

// ambil data query  -nya 

	$this->db->reset_select();
	$this->db->select(" a.AppoinmentId,  a.CustomerId,  date_format(a.ApoinmentDate,'%H:%i') as TryCallAgain,  b.DM_CampaignId as CampaignId,  b.DM_FirstName as CustomerName",  FALSE);
	$this->db->from("t_gn_appoinment a");
	$this->db->join("t_gn_customer_master  b ", "a.CustomerId=b.DM_Id","INNER");
	$this->db->join("t_gn_assignment c ", "a.CustomerId=c.AssignCustId","INNER");
	
// where data kondisi untuk get appointment 
// biar nggak berat saat waittime console.
	$this->db->where("a.ApoinmentFlag", $this->cok->field('ApoinmentFlag'));
	$this->db->where("DATE(a.ApoinmentDate) !='0000-00-00'" , '',false);
	$this->db->where("a.ApoinmentDate is not null" , '',false);
	$this->db->where( sprintf(" a.ApoinmentDate >='%s 00:00:00'  and a.ApoinmentDate <='%s 23:59:59'", date('Y-m-d'), date('Y-m-d')), '', false);
	$this->db->where("DATE_ADD(NOW(), INTERVAL 5 MINUTE)>=a.ApoinmentDate", '', false);
	$this->db->where("YEAR(a.ApoinmentDate)>0", '', false);	
	$this->db->where("c.AssignSelerId", $this->cok->field('UserId'));
	$this->db->where_not_in("b.DM_CallCategoryId", $this->cok->field('DM_CallCategoryId'));
	
	// $this->db->where("NOW()<=a.ApoinmentDate", '', false);
	// $this->db->where("c.AssignSelerId", $this->cok->field('UserId'));
	// $this->db->where("a.ApoinmentFlag", $this->cok->field('ApoinmentFlag'));
	// $this->db->where_not_in("b.DM_CallCategoryId", $this->cok->field('DM_CallCategoryId'));
	
	
	// echo $this->db->print_out();
	
	$qry = $this->db->get();
	if( $qry && $qry->num_rows() > 0 
		&& ( $row = $qry->result_first_record())) 
	{
		// ambil dan masukan ke table JSON data .
		$this->num_row = $qry->num_rows();
		
		if( $row->field('CustomerId') ){
			$this->result_array['CustomerId']	= $row->field('CustomerId');
			$this->result_array['CampaignId']   = $row->field('CampaignId');
			$this->result_array['CustomerName'] = $row->field('CustomerName');
			$this->result_array['PrimaryID']    = $row->field('AppoinmentId');
			$this->result_array['TryCallAgain'] = $row->field('TryCallAgain');
			$this->result_array['counter'] 		= (int)$this->num_row;
			
			// $_conds['counter'] 		= (INT)$num_rows;	
			// ambil total data seluruhnya di row record.
		}
		
		// $num_rows = $rs -> num_rows();
		// if( $vol_rows = $rs -> result_first_assoc() )
		// {
			// $_conds['CustomerId'] 	= $vol_rows['CustomerId'];
			// $_conds['CampaignId'] 	= $vol_rows['CampaignId'];
			// $_conds['CustomerName'] = $vol_rows['CustomerFirstName'];
			// $_conds['PrimaryID'] 	= $vol_rows['AppoinmentId'];
			// $_conds['TryCallAgain']	= $vol_rows['TryCallAgain'];
			// $_conds['counter'] 		= (INT)$num_rows;	
		// }
	}
	
	return (array)$this->result_array;
 }		
 
}
?>
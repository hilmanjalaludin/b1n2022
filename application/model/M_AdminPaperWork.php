<?php 
class M_AdminPaperWork extends EUI_Model{

	
/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 private static $Instance = null;
 public static function &Instance()  {
  if( is_null(self::$Instance) ) {
	self::$Instance = new self();
  }
  return self::$Instance;
}

	
/*
  * [@contructor class adminpaperwork]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
// pertama kali class di aksess 	
function __construct(){
	
}	
	
/*
  * [@contructor class adminpaperwork]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
function _select_admin_paper_work( $CustomerId = 0 ){
	$result_array = array();
	$sql = sprintf("select * from t_gn_customer_master a 
					left join t_gn_selling_verification b on a.DM_Id=b.SV_Cust_Id
					where a.DM_Id= %s", $CustomerId);
					
					// left join t_lk_kurir c on c.KurirID=b.SV_Cust_Kurir
	$qry = $this->db->query($sql);
	if( $qry && $qry->num_rows() > 0 ){
		$result_array = $qry->result_first_assoc();
	}
	// return data by object 
	return Objective($result_array);
	// echo $this->EUI_Page->_getCompiler();
} 
 /*
 Public Function getSupervisor()
{
	$sql = "select a.KurirID, a.KurirDesc
			from t_lk_kurir a
			where a.flag = 1";
	$qry = $this->db->query($sql);
			
	if($qry->num_rows() > 0)
	{
		foreach($qry->result_array() as $rows)
		{
			$sql[$rows['KurirID']] = $rows['KurirDesc'];
		}
	}
			
	return $supervisor;
}
*/
 
 function _select_row_layout_data( $SV_Cust_Id = null)
 {	
	$this->db->reset_select();
	$this->db->select("a.KurirID, a.KurirCode, a.KurirDesc, b.SV_Cust_Id");
	$this->db->from('t_lk_kurir a');
	$this->db->join("t_gn_selling_verification b "," a.KurirID=b.SV_Kurir_Id", "LEFT");
	$this->db->where("a.flag" , 1 );
	$this->db->where("SV_Cust_Id", $SV_Cust_Id );
	
	$rs =$this->db->get();
	return $rs->row_array();
	
 }

 function _select_kurir(){
 	$this->db->reset_select();
 	$this->db->select("*");
 	$this->db->from("t_lk_kurir a");
 	$this->db->where("a.flag", 1);
 	
 	$rs = $this->db->get();
 	return $rs->result_array();
 }
 
 function _select_row_coverage_data( $SV_Cust_Id = null)
 {	
	$this->db->reset_select();
	$this->db->select("a.CoverageId, a.Area, b.SV_Cust_Id");
	$this->db->from('t_lk_coverage a');
	$this->db->join("t_gn_selling_verification b "," a.CoverageId=b.SV_Coverage_Id", "LEFT");
	$this->db->where("a.flag" , 1 );
	$this->db->where("SV_Cust_Id", $SV_Cust_Id );
	
	$rs =$this->db->get();
	return $rs->row_array();
	
 }

 function _select_coverage(){
 	$this->db->reset_select();
 	$this->db->select("*");
 	$this->db->from("t_lk_coverage a");
 	$this->db->where("a.flag", 1);
 	
 	$rs = $this->db->get();
 	return $rs->result_array();
 }


 function _select_kores_id()
 {
 	$this->db->reset_select();
	$this->db->select("*");
	$this->db->from('t_lk_kores a');
	$this->db->where("a.flag" , 1 );
	
	$rs =$this->db->get();
	return $rs->result_array();
 }

	public function _get_customer ( $CustomerId = "" )
	{
		$data_cust = array();

		$this->db->select("*");
		$this->db->from("t_gn_customer_master a");
		$this->db->where("a.DM_Id" , $CustomerId);
		$cm = $this->db->get()->result_array();
		return $cm;

		// echo $this->db->last_query();

		// if ( !empty($CustomerId) ) {

		// 	$this->db->select("*");
		// 	$this->db->from("t_gn_customer_master a");
		// 	$this->db->where("a.DM_Id" , $CustomerId);
		// 	$cm = $this->db->get();
		// 	if ( $cm->num_rows() > 0 ) {
		// 		$data_cust = new EUI_Object($cm->row_array());
		// 	}
		// }

		// if ( !is_object( $data_cust ) ) $data_cust = new EUI_Object($data_cust);  

		// return $data_cust;
	}

/*
  * [@contructor class adminpaperwork]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
// pertama kali class di aksess 	
function _submit_admin_paper_work( $out = null, $SV_Cust_Id = "" ){
	
	$this->callBackData = 0;
// add data addisional 
	
	$out->add('SV_Cust_CreatorId', CK()->field('UserId',array('strtoupper')));
	$out->add('SV_Cust_CreatorKode', CK()->field('Username',array('strtoupper')));
	//$out->add('SV_Cust_Kurir', CK()->field('KurirDesc', array('strtoupper')));
	$out->add('SV_Cust_UpdateTs', date('Y-m-d H:i:s'));
 // reseting data 
 
	$this->db->reset_write();
	$this->db->set('SV_Cust_Id', 			$out->field('SV_Cust_Id'));
	$this->db->set('SV_Cust_Num', 			$out->field('SV_Cust_Num'));
	$this->db->set('SV_Cust_MailAddress',	$out->field('SV_Cust_MailAddress')); 
	$this->db->set('SV_Coverage_Id',		$out->field('SV_Coverage_Id'));
	$this->db->set('SV_Cust_FaxNum', 		$out->field('SV_Cust_FaxNum')); 
	//$this->db->set('SV_Cust_Kurir', 		$out->field('SV_Cust_Kurir'));
	$this->db->set('SV_Kurir_Id',			$out->field('SV_Kurir_Id'));
	$this->db->set('SV_WA', 				$out->field('SV_WA'));
	$this->db->set('SV_Cust_KoresKode', 	$out->field('SV_Cust_KoresKode'));
	$this->db->set('SV_Cust_KoresValue', 	$out->field('SV_Cust_KoresValue','strtoupper'));
	$this->db->set('SV_Cust_KonfirmKartu', 	$out->field('SV_Cust_KonfirmKartu'));
	$this->db->set('SV_Cust_CreatorId', 	$out->field('SV_Cust_CreatorId'));
	$this->db->set('SV_Cust_CreatorKode', 	$out->field('SV_Cust_CreatorKode'));
	$this->db->set('SV_Cust_UpdateTs', 		$out->field('SV_Cust_UpdateTs'));
		
	// jika terjadi duplicate 	
	$this->db->duplicate('SV_Cust_MailAddress',		$out->field('SV_Cust_MailAddress'));
	$this->db->duplicate('SV_Coverage_Id',			$out->field('SV_Coverage_Id')); 
	$this->db->duplicate('SV_Cust_FaxNum', 			$out->field('SV_Cust_FaxNum')); 
	//$this->db->duplicate('SV_Cust_Kurir', 			$out->field('SV_Cust_Kurir','strtoupper'));
	$this->db->duplicate('SV_Kurir_Id',				$out->field('SV_Kurir_Id'));
	$this->db->duplicate('SV_WA', 					$out->field('SV_WA'));
	$this->db->duplicate('SV_Cust_KoresKode', 		$out->field('SV_Cust_KoresKode','strtoupper'));
	$this->db->duplicate('SV_Cust_KoresValue', 		$out->field('SV_Cust_KoresValue','strtoupper'));
	$this->db->duplicate('SV_Cust_KonfirmKartu', 	$out->field('SV_Cust_KonfirmKartu'));
	$this->db->duplicate('SV_Cust_UpdateTs',		$out->field('SV_Cust_UpdateTs'));
	$this->db->duplicate('SV_Cust_CreatorId', 		$out->field('SV_Cust_CreatorId'));
	$this->db->duplicate('SV_Cust_CreatorKode', 	$out->field('SV_Cust_CreatorKode'));
	
	if( $this->db->insert_on_duplicate('t_gn_selling_verification') ){
		$this->callBackData++; 
	}
	// return data to callback 
	return $this->callBackData;
	//echo $this -> db -> last_query();
}

/*
  * [@contructor class adminpaperwork]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
function _cancel_admin_paper_work( $out  = null ){
	
	// jika data null / bukan object 
	if( is_null( $out ) or !is_object( $out ) ){
		return false;
	}
	
	$sql = sprintf("delete from t_gn_selling_verification where SV_Cust_Id='%d'", $out->field('SV_Cust_Id'));
	$qry = $this->db->query( $sql );
	if( $qry && $this->db->affected_rows() > 0 ){
		return true;
	}
	return false;
}
	
/*
  * [@contructor class adminpaperwork]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
// pertama kali class di aksess 	

	
}
?>
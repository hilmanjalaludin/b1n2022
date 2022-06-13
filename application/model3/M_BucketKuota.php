<?php 
/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	 
class M_BucketKuota extends EUI_Model{
/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	 
private static $Instance = null;	

/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	 	
function __construct(){ 
	$this->load->model(array('M_UserRole'));
}
	
/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	 
public static function &Instance(){
	if( is_null(self::$Instance ) ){
		self::$Instance = new self();
	}
	return self::$Instance;
}


 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
    
function _select_bucket_count_page() {
	
 // get data object 	
	$out = UR();  $cok = CK();  $cnf = CF();
// get all data not contacted 
	$this->EUI_Page->_setPage(DEFAULT_COUNT_PAGE); 
	$this->EUI_Page->_setCount(TRUE);
	$this->EUI_Page->_setSelect("count(a.BK_Kuota_Id) as tot");
	$this->EUI_Page->_setFrom("t_gn_bucket_kuota a");
	$this->EUI_Page->_setJoin("tms_agent_profile b ","a.BK_Kuota_Group=b.id", "LEFT" );
	$this->EUI_Page->_setJoin("tms_agent c ","a.BK_Kuota_UserId=c.UserId", "LEFT", true);
	
// default query for all user data yang di munculkan adalah data2 non close 
// atau approve

//  ADMIN / ROOT 		
	if( $cok->cookie(array(USER_ROOT, USER_ADMIN)) ){
		//$this->EUI_Page->_setWhereIn("c.admin_id", $cnf->field('default_admin'));	
	}

// filter data pager :  ACC MANAGER   
	if(  $cok->cookie(USER_GENERAL_MANAGER) ){ 
		$this->EUI_Page->_setAnd("c.act_mgr",$cok->field('UserId'));
	}

// filter data pager :  MANAGER  
	if( $cok->cookie( USER_MANAGER ) OR $cok->cookie(USER_ACCOUNT_MANAGER) ){  
		$this->EUI_Page->_setAnd("c.mgr_id", $cok->field('UserId'));
	}	
	
// filter data pager :  SPV -- 
	if( $cok->cookie(USER_SUPERVISOR) ){ 
		$this->EUI_Page->_setAnd("c.spv_id", $cok->field('UserId'));
	}	
// filter data pager :  LEADER ( TL )	-- 
	if( $cok->cookie(USER_LEADER) ){ 
		$this->EUI_Page->_setAnd("c.tl_id", $cok->field('UserId'));
	}
// filter data pager :  AGENT ( TSR )	-- 
	if( $cok->cookie(array(USER_AGENT_OUTBOUND, USER_AGENT_INBOUND))){ 
		$this->EUI_Page->_setAnd("b.UserId", $cok->field('UserId'));	
	}
//  post filter  --------------------------------------------------------------	
/*	FIELD	:
			[BK_Kuota_UpdateTs_start_date] => 
            [BK_Kuota_UpdateTs_end_date] => 
            [BK1_filter_field] => a.BK_Kuota_UserKode
            [BK1_filter_value] => 
            [BK2_filter_field] => 
            [BK2_filter_value] => 
            [BK_Kuota_UserId] =>
	*/
	$this->EUI_Page->_setAndCache("a.BK_Kuota_Group", 'BK_Kuota_Group', TRUE);
    $this->EUI_Page->_setBeginCache("a.BK_Kuota_UpdateTs", 'BK_Kuota_UpdateTs_start_date', TRUE);
    $this->EUI_Page->_setStopCache("a.BK_Kuota_UpdateTs", 'BK_Kuota_UpdateTs_end_date', 	TRUE);
	$this->EUI_Page->_setFieldCache('LIKE', 'BK1_filter_field', 'BK1_filter_value', TRUE);
    $this->EUI_Page->_setFieldCache('LIKE', 'BK2_filter_field', 'BK2_filter_value', TRUE);
	
	
// return page data -------------------------------------
   // echo $this->EUI_Page->_getCompiler();
	return $this->EUI_Page;
}

 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
    
function _select_bucket_content_page()
{
	
// get data object 	
// get all define not interested on here 
	$out = UR();  $cok = CK();  $cnf = CF(); 
	
// get all define not interested on here 
// call object page 
	
	$this->EUI_Page->_postPage( $out->field('v_page') );
	$this->EUI_Page->_setPage(DEFAULT_COUNT_PAGE);
	$this->EUI_Page->_setArraySelect(array(
		"a.BK_Kuota_Id as KuotaId"					=> array("KuotaId",	"KuotaId","primary"),
		"b.name as BK_Kuota_Group"					=> array("BK_Kuota_Group",		"BK_Kuota_Group"),
		"c.id as BK_Kuota_UserId"					=> array("BK_Kuota_UserId",		"BK_Kuota_UserId"),
		"c.full_name as BK_Kuota_UserKode"			=> array("BK_Kuota_UserKode",	"BK_Kuota_UserKode"),
		"a.BK_Kuota_Size as BK_Kuota_Size"			=> array("BK_Kuota_Size",		"BK_Kuota_Size"),
		"a.BK_Kuota_Data as BK_Kuota_Data"			=> array("BK_Kuota_Data",		"BK_Kuota_Data"),
		"a.BK_Kuota_Creator as BK_Kuota_Creator"	=> array("BK_Kuota_Creator",	"BK_Kuota_Creator"),
		"a.BK_Kuota_UpdateTs as BK_Kuota_UpdateTs"	=> array("BK_Kuota_UpdateTs",	"BK_Kuota_UpdateTs"),
		"a.BK_Kuota_Flags as BK_Kuota_Flags"	=> array("BK_Kuota_Flags",	"BK_Kuota_Flags"),
		
	));
	
	$this->EUI_Page->_setFrom("t_gn_bucket_kuota a");
	$this->EUI_Page->_setJoin("tms_agent_profile b ","a.BK_Kuota_Group=b.id", "LEFT" );
	$this->EUI_Page->_setJoin("tms_agent c ","a.BK_Kuota_UserId=c.UserId", "LEFT", true);
	 
// default query for all user data yang di munculkan adalah data2 non close 
// atau approve

//  ADMIN / ROOT 		
	if( $cok->cookie(array(USER_ROOT, USER_ADMIN)) ){
		//$this->EUI_Page->_setWhereIn("c.admin_id", $cnf->field('default_admin'));	
	}
	

// filter data pager :  ACC MANAGER   
	if(  $cok->cookie(USER_GENERAL_MANAGER) ){ 
		$this->EUI_Page->_setAnd("c.act_mgr",$cok->field('UserId'));
	}

// filter data pager :  MANAGER  
	if( $cok->cookie( USER_MANAGER ) OR $cok->cookie(USER_ACCOUNT_MANAGER) ){  
		$this->EUI_Page->_setAnd("c.mgr_id", $cok->field('UserId'));
	}	
		
// filter data pager :  SPV -- 
	if( $cok->cookie(USER_SUPERVISOR) ){ 
		$this->EUI_Page->_setAnd("c.spv_id", $cok->field('UserId'));
	}
	

	
// filter data pager :  LEADER ( TL )	-- 
	if( $cok->cookie(USER_LEADER) ){ 
		$this->EUI_Page->_setAnd("c.tl_id", $cok->field('UserId'));
	}
	
// filter data pager :  AGENT ( TSR )	-- 
	if( $cok->cookie(array(USER_AGENT_OUTBOUND, USER_AGENT_INBOUND))){ 
		$this->EUI_Page->_setAnd("b.UserId", $cok->field('UserId'));	
	}
	
	
// customize filter data by post user 
/*	FIELD	:
			[BK_Kuota_UpdateTs_start_date] => 
            [BK_Kuota_UpdateTs_end_date] => 
            [BK1_filter_field] => a.BK_Kuota_UserKode
            [BK1_filter_value] => 
            [BK2_filter_field] => 
            [BK2_filter_value] => 
            [BK_Kuota_UserId] =>
	*/
	
	//debug($out);	
	
	$this->EUI_Page->_setAndCache("a.BK_Kuota_Group", 'BK_Kuota_Group', TRUE);
    $this->EUI_Page->_setBeginCache("a.BK_Kuota_UpdateTs", 'BK_Kuota_UpdateTs_start_date', TRUE);
    $this->EUI_Page->_setStopCache("a.BK_Kuota_UpdateTs", 'BK_Kuota_UpdateTs_end_date', 	TRUE);
	$this->EUI_Page->_setFieldCache('LIKE', 'BK1_filter_field', 'BK1_filter_value', TRUE);
    $this->EUI_Page->_setFieldCache('LIKE', 'BK2_filter_field', 'BK2_filter_value', TRUE);

	
// customize filter data order by user 
  if( $out->find_value("order_by") ){
	  $this->EUI_Page->_setOrderBy($out->field("order_by"), $out->field("type"));
  } 
  else {
	  $this->EUI_Page->_setOrderBy("a.BK_Kuota_Id", "DESC");
  }
  
   
//  then limit on here  
  $this->EUI_Page->_setLimit();
  //echo $this->EUI_Page->_getCompiler();
	
}


/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	 
function _select_bucket_number_page()  {
	if( strlen($this->EUI_Page->_get_query() ) > 0 ) {
		return $this->EUI_Page->_getNo();
	}	
 }
  
/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	 
 
function _select_bucket_source_page() {
 $this->_select_bucket_content_page();
 if( strlen($this->EUI_Page->_get_query())>0 )  {
	return $this->EUI_Page->_result();
 }
} 

/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	 

function _update_bucket_user_kuota( $out = null ){
	
// jika bukan object data yang di kirim.	
 if( !is_object($out) ){
	return false;
 }	

// get user detail 
 $usr = UserDetail( $out->field('BK_Kuota_UserKode') );
 
// then will push 
 $out->add('BK_Kuota_UserKode', $usr->field('id'));
 $out->add('BK_Kuota_UserId', 	$usr->field('UserId'));
 $out->add('BK_Kuota_Creator',  CK()->field('UserId'));
 $out->add('BK_Kuota_UpdateTs', date('Y-m-d H:i:s'));
 
//reset data 	
 $this->db->reset_write();
 $this->db->set('BK_Kuota_Group', 		$out->field('BK_Kuota_Group'));
 $this->db->set('BK_Kuota_UserId', 		$out->field('BK_Kuota_UserId'));
 $this->db->set('BK_Kuota_UserKode', 	$out->field('BK_Kuota_UserKode'));
 $this->db->set('BK_Kuota_Size', 		$out->field('BK_Kuota_Size'));
 $this->db->set('BK_Kuota_Data', 		$out->field('BK_Kuota_Data'));
 $this->db->set('BK_Kuota_Creator', 	$out->field('BK_Kuota_Creator'));
 $this->db->set('BK_Kuota_UpdateTs', 	$out->field('BK_Kuota_UpdateTs'));
 $this->db->set('BK_Kuota_Flags', 		$out->field('BK_Kuota_Flags'));
 
 // jika duplicate 
 $this->db->where('BK_Kuota_Id', $out->field('BK_Kuota_Id'));
 // then will the insert value data to table 
 $this->db->update('t_gn_bucket_kuota');
 if( $this->db->affected_rows() > 0 ){
	 return true;
 }
 return false;
	
}
/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	 

function _submit_bucket_user_kuota( $out = null ){
	
// jika bukan object data yang di kirim.	
 if( !is_object($out) ){
	return false;
 }	

// get user detail 
 $usr = UserDetail( $out->field('BK_Kuota_UserKode') );
 
// then will push 
 $out->add('BK_Kuota_UserKode', $usr->field('id'));
 $out->add('BK_Kuota_UserId', $usr->field('UserId'));
 $out->add('BK_Kuota_Creator', CK()->field('UserId'));
 $out->add('BK_Kuota_UpdateTs', date('Y-m-d H:i:s'));
 
//reset data 	
 $this->db->reset_write();
 $this->db->set('BK_Kuota_Group', 		$out->field('BK_Kuota_Group'));
 $this->db->set('BK_Kuota_UserId', 		$out->field('BK_Kuota_UserId'));
 $this->db->set('BK_Kuota_UserKode', 	$out->field('BK_Kuota_UserKode'));
 $this->db->set('BK_Kuota_Size', 		$out->field('BK_Kuota_Size'));
 $this->db->set('BK_Kuota_Data', 		$out->field('BK_Kuota_Data'));
 $this->db->set('BK_Kuota_Creator', 	$out->field('BK_Kuota_Creator'));
 $this->db->set('BK_Kuota_UpdateTs', 	$out->field('BK_Kuota_UpdateTs'));
 $this->db->set('BK_Kuota_Flags', 		$out->field('BK_Kuota_Flags'));
 
 // jika duplicate 
 $this->db->duplicate('BK_Kuota_UserKode', 	$out->field('BK_Kuota_UserKode'));
 $this->db->duplicate('BK_Kuota_Size', 		$out->field('BK_Kuota_Size'));
 $this->db->duplicate('BK_Kuota_Data', 		$out->field('BK_Kuota_Data'));
 
 
 // then will the insert value data to table 
 $this->db->insert_on_duplicate('t_gn_bucket_kuota');
 if( $this->db->affected_rows() > 0 ){
	 return true;
 }
 return false;
 
 
 
 	
	
}

/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	 
 
 function _delete_bucket_user_kuota( $dataURI  = null  )
{
	
// check by richeck data OK .
 if( !is_object($dataURI)){
	return false;
 }
 // query data on model delete bucket kuota  user process 
 // tested on here .
 
 $sql = sprintf("delete from t_gn_bucket_kuota where BK_Kuota_Id='%s'",$dataURI->field('KuotaId'));
 $qry = $this->db->query( $sql );
 if( $this->db->affected_rows() > 0 ){
	return true;
 }
 return false;
}
/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	 
 
function _select_bucket_kuota_detail( $dataURI = null ){
	
	$result_array = array();
	$sql = sprintf("select *, d.id as CreatorKode  from t_gn_bucket_kuota a
					left join tms_agent_profile b on a.BK_Kuota_Group=b.id
					left join tms_agent c on a.BK_Kuota_UserId=c.UserId
					left join tms_agent d on a.BK_Kuota_Creator=d.UserId
					where a.BK_Kuota_Id = '%s'", $dataURI->field('KuotaId')); 
	$qry = $this->db->query( $sql );
	if( $qry && $qry->num_rows()> 0 ){
		$result_array = $qry->result_first_assoc();
	 }
	return Objective ( $result_array );
}
/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	 
 
 
function _select_bucket_kuota_role( $kode = null ) {
	return SystemRoleFrm($kode, 'Objective');
}

/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	 
 
 private function _select_bucket_size_kuota($GroupId=0, $UserId = 0  )
{
// set array maping from here .
	$this->total_data = 0;
	
// get data process on here .	
	$this->array_field = array(
		USER_ADMIN 				=> 'AssignAdmin', 
		USER_ACCOUNT_MANAGER 	=> 'AssignAmgr',
		USER_MANAGER 			=> 'AssignMgr',  
		USER_SUPERVISOR 		=> 'AssignSpv',
		USER_LEADER 			=> 'AssignLeader', 
		USER_AGENT_OUTBOUND 	=> 'AssignSelerId', 
		USER_AGENT_INBOUND 		=> 'AssignSelerId' );
		
	// parameter yang akan dimasukan 
	
	$field  = $this->array_field[$GroupId];	
	$status = array( APRV, CLOS, RDPC, BLCK, YCOM, NCOM, RJCK );
	$status = SetWhereIn( $status, true);
	
 // will get maping data on here .
	$sql = sprintf("select count(a.AssignCustId) as total  from t_gn_assignment a   
				    inner join t_gn_customer_master b on a.AssignCustId=b.DM_Id
					where a.%s = '%s' and b.DM_LastCategoryId NOT IN(%s)", 
					$field, $UserId, $status );
	// debug($sql);					
    $qry = $this->db->query( $sql );
	if( $qry && $qry->num_rows() > 0 ){
		$this->total_data = $qry->result_singgle_value();
	}	
	
	return (int)$this->total_data;
} 


/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	 

 private function _select_bucket_setup_kuota()
{	
// nilai awal 
	$result_array = array();
// source data process 	
	$sql = sprintf("select a.BK_Kuota_UserId from t_gn_bucket_kuota a where a.BK_Kuota_Flags ='%d'", 1);
	$qry = $this->db->query($sql);
	
// get list of user 	
	if( $qry && $qry->num_rows()>0)
	foreach( $qry->result_record() as $row ){
		$result_array[$row->field('BK_Kuota_UserId')] = $row->field('BK_Kuota_UserId');
	}
	return (array)$result_array;
} 
/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	 
 
function _select_bucket_update_kuota( $UserId = null ){

// jika isikan data ke bentuk object untuk Process 
// data import ke table .
 
 $this->result_process = 0;
 $this->result_users =  $UserId;
 
 if( is_null($UserId) ){
	$this->result_users = $this->_select_bucket_setup_kuota();
 } 	
   
// var_dump($this->result_users);
// function ini untuk process perhitungan stiap kali
  $this->result_array = array();

  $this->result_users = SetWhereIn( $this->result_users, false ); 
  $sql = sprintf("select a.BK_Kuota_Group, a.BK_Kuota_UserId,  a.BK_Kuota_Size,  a.BK_Kuota_Data 
				  from t_gn_bucket_kuota a  where a.BK_Kuota_UserId IN('%s')", $this->result_users );
	
  	
  $qry = $this->db->query($sql);
  if( $qry && $qry->num_rows()>0)
  foreach( $qry->result_assoc() as $row ){
	$this->result_array[] = $row;
  }
	
	//var_dump($this->result_array);	
// then will callculation on here 
 if( is_array($this->result_array) ) 
  foreach( $this->result_array as $key => $row )
 {
  // konversi data kebentuk object std.
	$this->row = Objective( $row );
	if( !$this->row->field('BK_Kuota_UserId') ){
		continue;
	}
	
 // then will get data master OK 
	$BK_Kuota_Data = $this->_select_bucket_size_kuota( $this->row->field('BK_Kuota_Group'), 
													   $this->row->field('BK_Kuota_UserId') );
													
 // then will push data 
	$this->row->add('BK_Kuota_Data', $BK_Kuota_Data);
	$this->row->add('BK_Kuota_UpdateTs', date('Y-m-d H:i:s'));
	
	
 // update table 								
	$this->db->reset_write();												
	$this->db->set('BK_Kuota_Data', $this->row->field('BK_Kuota_Data'));
	$this->db->set('BK_Kuota_UpdateTs', $this->row->field('BK_Kuota_UpdateTs'));
	$this->db->where('BK_Kuota_Group', $this->row->field('BK_Kuota_Group'));
	$this->db->where('BK_Kuota_UserId', $this->row->field('BK_Kuota_UserId'));
	
// if have 'affected_rows 'MySQL(0)' 	
	$this->db->update('t_gn_bucket_kuota');
	if($this->db->affected_rows() >0 ){
		
	// update date jika ada update kuota .
	   $this->result_process += $BK_Kuota_Data;
	}
 }
 // result && return proccess .
 return (int)$this->result_process; 
}// end function .

/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	 
 function _select_bucket_user_kuota()
{
  $this->result_array  = array();
  $this->dataURI = UR();
  
// define data process untuk queryke bucket user 
  $this->db->reset_select();
  $this->db->select('c.name AS  BK_Kuota_Group, 
					 b.id AS BK_Kuota_UserId, 
					 b.full_name AS  BK_Kuota_UserKode, 
					 a.BK_Kuota_Size AS BK_Kuota_Size, 
					 a.BK_Kuota_Data AS BK_Kuota_Data, 
					 a.BK_Kuota_Creator AS BK_Kuota_Creator, 
					 a.BK_Kuota_UpdateTs AS BK_Kuota_UpdateTs, 
					 a.BK_Kuota_Flags AS BK_Kuota_Flags,
					 a.BK_Kuota_Id AS BK_Kuota_Action', 
				FALSE);
  $this->db->from('t_gn_bucket_kuota a');
  $this->db->join('tms_agent b','a.BK_Kuota_UserId=b.UserId', 'LEFT');
  $this->db->join('tms_agent_profile c ',' a.BK_Kuota_Group=c.id','LEFT');
  $this->db->where('a.BK_Kuota_Flags', 1);
  
  
 // if have filter data user 
 //debug($this->dataURI);
 
if( $this->dataURI->find_value('dataUser')  ){
	$this->db->where_in('BK_Kuota_UserId',$this->dataURI->fields('dataUser'), false );
}
  
// set order pager on page 
   if( $this->dataURI->find_value('orderby') ) {
		$this->db->order_by( $this->dataURI->field('orderby'), $this->dataURI->field('type') );		
   } else {
		$this->db->order_by( "a.BK_Kuota_Id", "ASC"); 
   }
   
// get result data Array . 
//$this->db->print_out();
 $this->rs = $this->db->get();
  if( $this->rs && $this->rs->num_rows()>0 ) {
	$this->result_array = $this->rs->result_assoc();
  }
  
// return result data array.
 return (array)$this->result_array;
   
 
}

/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */	 
}
?>
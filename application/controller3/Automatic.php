<?php 
  /**
  * [Recovery data failed upload BNI TELE]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  * /opt/enigma/webapps/telemarketing-applikasi/bni-tele-cc-ans/bni-tele-ans3.1.4.r1/system/helper
  * -------------------------------------------------------------------------------------------------------
  * -------------------------------------------------------------------------------------------------------
  
  * php -q /opt/enigma/webapps/bni-tele-ans3.1.4.r1/index.php Automatic DeleteThreeChat
  * php -q /opt/enigma/webapps/bni-tele-ans3.1.4.r1/index.php Automatic DeleteThreeBroadcastMessage
  * php -q /opt/enigma/webapps/bni-tele-ans3.1.4.r1/index.php Automatic DeleteThreeActivityLoger
  * php -q /opt/enigma/webapps/bni-tele-ans3.1.4.r1/index.php Automatic DeleteThreeAppointment
  * php -q /opt/enigma/webapps/bni-tele-ans3.1.4.r1/index.php Automatic DeleteThreeSgsHistory
  * php -q /opt/enigma/webapps/bni-tele-ans3.1.4.r1/index.php Automatic DeclineSystemData
  * php -q /opt/enigma/webapps/bni-tele-ans3.1.4.r1/index.php Automatic UpdateAgeData
  
  
  php -q /opt/enigma/webapps/telemarketing-applikasi/bni-tele-cc-ans/bni-tele-ans3.1.4.r1/index.php Automatic UpdateAgeData
  
  */
  
  /**
  * [Recovery data failed upload BNI TELE]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
    
	
class Automatic extends EUI_Controller 
{
	
 var $del_start_date  = null;
 var $del_end_date = null;

 /**
  * [Recovery data failed upload BNI TELE]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
 function __construct()  { 
	parent::__construct();

// define process on diffrent proces 
// bucket kustomer 
	
	$this->del_start_date = _getPrevDate( date('Y-m-d'), -180); 
	$this->del_end_date = _getPrevDate( date('Y-m-d'), -90); // delete data 2 bulan yang lalu . 
	
 // load model data Process OK 
 // get sekunce 
 
	$this->load->model(array('M_SeqNumber'));
	
}

 /**
  * [Recovery data failed upload BNI TELE]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
    
 public function DeleteThreeChat()
{ 
	$del = sprintf("delete from tms_agent_chat where sent>='%s 00:00:00' and sent<='%s 23:59:59'", 
				   $this->del_start_date, 
				   $this->del_end_date );
	$this->db->query( $del );
}

 /**
  * [Recovery data failed upload BNI TELE]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
    
 public function DeleteThreeBroadcastMessage()
{  
   $del = sprintf("delete from tms_agent_msgbox where sent>='%s 00:00:00' and sent<='%s 23:59:59'",
				 $this->del_start_date, 
				 $this->del_end_date );
   $this->db->query( $del );
}

 /**
  * [Recovery data failed upload BNI TELE]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
    
 public function DeleteThreeActivityLoger()
{  
   $del = sprintf("delete from t_gn_activitylog where ActivityDate>='%s 00:00:00' 
				   and ActivityDate<='%s 23:59:59'
				   and ActivityEvent='ACTION_EVENT_REFRESH'",
				   $this->del_start_date, 
				   $this->del_end_date 
				);
				
   $this->db->query( $del );
}

 /**
  * [Recovery data failed upload BNI TELE]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
    
 
 public  function DeleteThreeAppointment()
{ 
	$del = sprintf("delete from t_gn_appoinment 
				   where ApoinmentFlag = 1
				   and ApoinmentCreate>='%s 00:00:00' 
				   and ApoinmentCreate<='%s 23:59:59'",
				   $this->del_start_date, 
				   $this->del_end_date 
				);
	$this->db->query( $del );
 }
 /**
  * [Recovery data failed upload BNI TELE]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
    
 public  function DeleteThreeSgsHistory()
{ 
	$del = sprintf("delete from egs_history 
				   where HistoryCreateTs>='%s 00:00:00' 
				   and HistoryCreateTs<='%s 23:59:59'",
				   $this->del_start_date, 
				   $this->del_end_date 
				);
	$this->db->query( $del );
 }
  /**
  * [Recovery data failed upload BNI TELE]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 function DeclineDataDetail( $Kode = 'DCLS' ) 
{
	
  // get source data process 	
	$sql  = sprintf("SELECT 
						a.CallReasonId as DM_CallReasonId, 
						a.CallReasonCode as DM_CallReasonKode,
						b.CallReasonCategoryId as DM_CallCategoryId,
						b.CallReasonCategoryCode  as DM_CallCategoryKode
					FROM t_lk_callreason a 
					LEFT JOIN t_lk_callreasoncategory b ON a.CallReasonCategoryId=b.CallReasonCategoryId
					WHERE a.CallReasonCode = '%s'", $Kode);
					 
	$qry = $this->db->query( $sql );
	if( $qry and $qry->num_rows() > 0 ){
		return $qry->result_first_record();
	}				
	return null;
}


 
 /**
  * [Recovery data failed upload BNI TELE]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
     
function DeclineDataTotal( $DM_Id = 0 ){
	
// define process OK 	
	$total  = 0;
// get source data process 	
	$sql  = sprintf('select count(a.DD_Id) total from t_gn_customer_decline a 
					 where a.DD_ProcessStatus = 0  and a.DM_Id = %d', $DM_Id);
					 
	$qry = $this->db->query( $sql );
	if( $qry and $qry->num_rows() > 0 and ( $row = $qry->result_first_record() )) {
		$total = $row->field('total','intval');
	}				
	// return data callback process ok 	
	return $total;

} 
 /**
  * [data dengan status kategory followup setelah tiga hari tidak ada update akan 
	 dimasukan ke bucket admin/AM/AMGR menjadi decline by SYSTEM < DCLS > 
	 yang kemudian akan di distribusi ulang 
	 dengan status ke sebelumnya BNI TELE]
	 
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
function DeclineSystemData(){
	 
// defina batas waktu yang di inginkan 
	$BatasWaktu = 3;
	$BatasKondisi = 0;
	
 // get source all data process on this process 
 // all acoount data 
	
  	$sql = sprintf("SELECT  
					 a.DM_Id,
					 a.DM_CampaignId,
					 a.DM_Custno,
					 a.DM_SellerId,
					 a.DM_SellerKode,
					 a.DM_UpdatedTs,
					 a.DM_CallSellerUpdateTs,
					 a.DM_CallReasonId,
					 a.DM_CallReasonKode,
					 a.DM_CallCategoryId,
					 a.DM_CallCategoryKode,
					 a.DM_LastReasonId,
					 a.DM_LastReasonKode,
					 a.DM_LastCategoryId,
					 a.DM_LastCategoryKode,
					 b.AssignAdmin as DM_AdminId,
					 b.AssignAmgr as DM_AccountMgrId,
					 b.AssignMgr as DM_ManagerId,
					 b.AssignSpv as DM_SupervisorId 
					FROM t_gn_customer_master a 
					LEFT JOIN t_gn_assignment b ON a.DM_Id=b.AssignCustId
					WHERE a.DM_CallCategoryId=%s
					and a.DM_CampaignId != 35", FOLW);
	//echo $sql;				 
	$qry = $this->db->query( $sql );
	if( $qry && $qry->num_rows() > 0 ) 
		foreach( $qry->result_record() as $row ){
		
	// jika data CustomerId ID kosong lanjut ke process berikutnya 
	// atau skip saja.
		
		if( !$row->find_value( 'DM_Id' ) ){
			continue;
		}
		
	 // jika data benar maka 'checkdate' apakah sudah ada tiga hari 
	 // atau kurang dari 3 hari .
		// musti di ubah yang ini.
		// ke - DM_CallSellerUpdateTs ?
		// $result_array = @call_user_func_array( '_getDateDiff', array(date('Y-m-d'), $row->field('DM_UpdatedTs') )); 
		$result_array = @call_user_func_array( '_getDateDiff', array(date('Y-m-d'), $row->field('DM_CallSellerUpdateTs') )); 
		
		if( !is_array($result_array) ){
			printf("data tidak bisa di process <%s>.\n", $row->field('DM_Custno')); 
			continue;
		}
		// data 
		if( is_array($result_array) && ( $day = Objective( $result_array ) ) ){
			if( $day->field( 'days', 'intval') < $BatasWaktu  ){	
				// data kurang dari tiga hari mka data tersebut di skip saja 
				// dari process ini.
				printf("data kurang dari tiga hari <%s>.\n", $row->field('DM_Custno'));  
				continue;
			}
		}
	// check apaklah data tersebut masih di bucket decline 
	// system 
	
	$IsDecline = $this->DeclineDataTotal( $row->field('DM_Id') );
	if( $IsDecline ){
		printf("data masih aktive di bucket decline <%s>.\n", $row->field('DM_Custno')); 
		continue;
	}
	
	// create sequence data ID 
	 $KeySequenId = $this->M_SeqNumber->CreatSeqVerID('DEC');
	 if( !$KeySequenId ){
		printf("data sequence prcess gagal <%s>\n", $row->field('DM_Custno')); 
		continue; 
	 }
	 
	// add and push Off keys untuk mempermudah 
	// process saja 
	  $row->add('DM_Key', sprintf('%018d', $KeySequenId));
	  $row->add('DD_DateCreateTs', date('Y-m-d H:i:s'));
	
	// ambil data tersebut masukan ke log history dan insert 
	// ke table log decline sebagai 'temporary file data'
	
	  printf("data sudah bisa di process key <%s>.\n", $KeySequenId);
	// reset write data on cache process on this event triger 
	// Ok process sip.
	
	  $this->db->reset_write();
	  $this->db->set('DD_Key', 				$row->field('DM_Key')); 
	  $this->db->set('DM_Id', 				$row->field('DM_Id')); 
	  $this->db->set('DM_CampaignId', 		$row->field('DM_CampaignId')); 
	  $this->db->set('DM_Custno', 			$row->field('DM_Custno')); 
	  $this->db->set('DM_SellerId', 		$row->field('DM_SellerId')); 
	  $this->db->set('DM_SellerKode', 		$row->field('DM_SellerKode')); 
	  
	  $this->db->set('DM_SupervisorId', 	$row->field('DM_SupervisorId')); 
	  $this->db->set('DM_SupervisorKode', 	$row->field('DM_SupervisorId','UserKode')); 
	  $this->db->set('DM_ManagerId', 		$row->field('DM_ManagerId')); 
	  $this->db->set('DM_ManagerKode', 		$row->field('DM_ManagerId','UserKode')); 
	  $this->db->set('DM_AccountMgrId', 	$row->field('DM_AccountMgrId'));
	  $this->db->set('DM_AccountMgrKode', 	$row->field('DM_AccountMgrId','UserKode')); 
	  $this->db->set('DM_AdminId', 			$row->field('DM_AdminId')); 
	  $this->db->set('DM_AdminKode', 		$row->field('DM_AdminId','UserKode')); 
	  
	  $this->db->set('DM_UpdatedTs', 		$row->field('DM_UpdatedTs')); 
	  $this->db->set('DM_CallReasonId', 	$row->field('DM_CallReasonId')); 
	  $this->db->set('DM_CallReasonKode', 	$row->field('DM_CallReasonKode')); 
	  $this->db->set('DM_CallCategoryId', 	$row->field('DM_CallCategoryId')); 
	  $this->db->set('DM_CallCategoryKode', $row->field('DM_CallCategoryKode')); 
	  $this->db->set('DM_LastReasonId', 	$row->field('DM_LastReasonId')); 
	  $this->db->set('DM_LastReasonKode', 	$row->field('DM_LastReasonKode')); 
	  $this->db->set('DM_LastCategoryId', 	$row->field('DM_LastCategoryId')); 
	  $this->db->set('DM_LastCategoryKode', $row->field('DM_LastCategoryKode')); 
	  $this->db->set('DD_DateCreateTs', 	$row->field('DD_DateCreateTs'));  
	  
	// insert data process jika berhasil update 
	// data kustomer -nya .
	  $this->db->insert('t_gn_customer_decline');
	  if( $this->db->affected_rows() > 0 ){
		$BatasKondisi++;
	  } 
	  
	// jika insert gagal maka lanjutkan ke process 
	// sebelumnya atau skip 
	  if( !$BatasKondisi ){
		printf("data sequence prcess gagal <%s>\n", $row->field('DM_Custno'));   
		continue;
	  }
	  
	  
	// update data custome k status DECLINE BY SYSTEM 
	// update data custome k status DECLINE BY SYSTEM 
	 printf("prcess data decline berhasil <%s> . OK\n", $row->field('DM_Custno'));
	 
	// get datail row DECL STATUS 
	
     $dtl = $this->DeclineDataDetail();
	 if( !$dtl->find_value( 'DM_CallReasonId' ) ){
		printf( "data sequence prcess gagal <%s>\n", $row->field('DM_Custno')); 
		continue;
	 } 
	 
	 $this->db->reset_write();
	 $this->db->set('DM_CallReasonId',		$dtl->field('DM_CallReasonId') );
	 $this->db->set('DM_CallReasonKode', 	$dtl->field('DM_CallReasonKode') );
	 $this->db->set('DM_CallCategoryId', 	$dtl->field('DM_CallCategoryId') );
	  
	 $this->db->set('DM_CallCategoryKode',	$dtl->field('DM_CallCategoryKode' ));
	 $this->db->set('DM_LastReasonId', 		$dtl->field('DM_CallReasonId') );
	 $this->db->set('DM_LastReasonKode', 	$dtl->field('DM_CallReasonKode') );
	 $this->db->set('DM_LastCategoryId', 	$dtl->field('DM_CallCategoryId') );
	 $this->db->set('DM_LastCategoryKode',	$dtl->field('DM_CallCategoryKode') );
	  
	// updata data kustomer OK SIP  
	 $this->db->where('DM_Id', $row->field('DM_Id'));
	 if( $this->db->update( 't_gn_customer_master' ) ){
		 
		$sql = sprintf("UPDATE t_gn_assignment ag 
						SET ag.AssignSelerId = 0,
							ag.AssignSelerId = 0,
							ag.AssignSpv = 0
						WHERE ag.AssignCustId ='%s'", $row->field('DM_Id'));
		$this->db->query( $sql );		
		printf("%s\n", '.'); 
	 }
	 
	}
	// end loop proces done.
} 


 /**
  * [Recovery data failed upload BNI TELE]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
function UpdateAgeData(){
	
// set date now data 	
	$tanggal= date('Y-m-d');
	
// query process 	
	$sql = sprintf("select a.DM_Id, a.DM_Dob from t_gn_customer_master a %s", null);
	$qry = $this->db->query( $sql );
	
	$kondition = 1;
	if( $qry && $qry->num_rows() > 0 ) 
	foreach( $qry->result_record() as $row ) {
		
		
		// skip data to process OK 
		if( !is_object( $row ) ){
			$kondition++;
			continue;
		}
		
		// if age have an result_array 
		$age = @call_user_func('SetAge', $row->field('DM_Dob'));
		if( !$age ){
			printf("%s\r\n", 'age undefined.');
			$kondition++;
			continue;
		}
		
		// update database every result_array 
		$row->add('DM_Age', $age);
		$sql = sprintf("update t_gn_customer_master 
								set DM_Age=%d where DM_Id='%s' ", $row->field('DM_Age'),
																  $row->field('DM_Id'));	
		//echo $sql;																			  
		if( $this->db->query( $sql ) ){
			printf("%016d => update age OK\r\n", $kondition);
		}
		
		$kondition++;
	}
}

 /**
  * [Recovery data failed upload BNI TELE]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
    
}

?>

<?php
class M_ModSaveActivity extends EUI_Model
{


/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  	
var $AllowProductAdmin = array();
var $approval_quality_code = '505';


/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
var $ProductDataKodeId = 0;

/**
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
/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  //DM_ProductId
 function __construct() {
	parent::__construct();
	$this->load->model(array( 'M_SysUser', 'M_SetResultQuality', 
							  'M_SetCallResult', 'M_MaskingNumber' ));
							  
	// then will the kips on here like this ;
	$this->ProductDataKodeId = UR()->field('DM_ProductId');
	
 // data yang masuk ke admin hanya data "NTB/ADD/XSELL" 
 // untuk Usage cukup samapai Quality Saja OK BOS .
	
	$this->AllowProductAdmin = array(NTB, ADD, XSELL); 
 }
 
   
 /**
  * [_set_row_update_admin_status]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
protected function _select_last_row_history_data( $CustomerId = 0 ){
	
	// define array 
	$result_array = array();
	
	// process query data 
	$sql = sprintf("select d.* from t_gn_callhistory d
					where d.CallHistoryId = ( select max(ts.CallHistoryId) as ID
										 from t_gn_callhistory ts where ts.CustomerId=%d)", $CustomerId);
									//	debug($sql); 
	$qry = $this->db->query( $sql );
	if( $qry && $qry->num_rows() > 0 ) {
		$result_array = (array)$qry->result_first_assoc(); 
	}
	// return an Object Data 
	return Objective( $result_array);
}  

/**
  * [_set_row_update_admin_status]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
 function _set_row_update_admin_approval( $out = null ){
	 
	//s debug($out);	
	$cok = CK();
	
	
// karena data yang di post adalah bertipe str 
	$this->dataTotals    = 0;
	$this->dataCreateTs  = date('Y-m-d H:i:s');
	$this->dataHistoryTp = QUALITY_DATA; 
	$this->dataMaster 	 = $out->fields('CustomerId'); 
	
// check by cehck proces to next step 
	if( !$this->dataMaster ){
		return false;
	}
	
	// then will process when Update And to history 
	if(is_array( $this->dataMaster ))
	foreach( $this->dataMaster as $key => $CustomerId ){
		
			$this->CustomerId = (int)$CustomerId;
			//check  validation 
			if( !$this->CustomerId){
				continue;
			}
			// ambil last history untuk data nya 
			$this->row = $this->_select_last_row_history_data( $this->CustomerId );
			if( !$this->row->field('CustomerId') ){
				continue;
			}
			
		// then on process data 
			//debug($this->row);
			
		// from object URL 	
			
			$this->row->add('CallHistoryNotes', 	$out->field('CallRemarks', array('mysql_real_escape_string')));
			$this->row->add('CallReasonId', 		$out->field('CallResultId', array('trim'))); // => 22
            $this->row->add('CallCategoryId', 		$out->field('CallStatusId',array('trim'))); // => 5 
            
		// from session 	
			$this->row->add('CreatedById', 			$cok->field('UserId','strtoupper'));
			$this->row->add('UpdatedById', 			$cok->field('UserId','strtoupper'));
			$this->row->add('AgentCode', 			$cok->field('Username','strtoupper'));
			$this->row->add('SPVCode', 				$cok->field('SupervisorId',array('UserKode','strtoupper')));
			$this->row->add('ATMCode', 				$cok->field('SupervisorId',array('UserKode','strtoupper')));
			$this->row->add('AMGRCode', 			$cok->field('AccountManager',array('UserKode','strtoupper')));
			$this->row->add('MGRCode', 				$cok->field('ManagerId',array('UserKode','strtoupper')));
			$this->row->add('ADMINCode', 			$cok->field('AdministratorId',array('UserKode','strtoupper')));
		
		// on set to next process 
			$this->row->add('CallResultId', 		$out->field('CallResultId', array('trim'))); // => 22
            $this->row->add('CallStatusId', 		$out->field('CallStatusId', array('trim'))); // => 5 
            
		// from session time server 
			$this->row->add('MasterDataId',			$this->CustomerId);
			$this->row->add('CallHistoryCreatedTs', $this->dataCreateTs);  
            $this->row->add('CallHistoryUpdatedTs', $this->dataCreateTs);  
			$this->row->add('CallHistoryCallDate',  $this->dataCreateTs);  
			$this->row->add('HistoryType',			$this->dataHistoryTp);  
			$this->row->add('CreateTs', 			$this->dataCreateTs);
				
			
		// then will create on history with this object set "before"		
		// then will create on history with this object set "before"
		
			$this->db->reset_write();
			$this->db->set('CallSessionId',			$this->row->field('CallSessionId') );
			$this->db->set('CustomerId', 			$this->row->field('CustomerId') );
			$this->db->set('CallReasonId', 			$this->row->field('CallReasonId') );
			$this->db->set('CallCategoryId', 		$this->row->field('CallCategoryId') ); 
			$this->db->set('CallNumber', 			$this->row->field('CallNumber') );
			$this->db->set('CreatedById', 			$this->row->field('CreatedById') );
			$this->db->set('UpdatedById', 			$this->row->field('UpdatedById') );
			$this->db->set('AgentCode', 			$this->row->field('AgentCode') );
			$this->db->set('SPVCode', 				$this->row->field('SPVCode') );
			$this->db->set('ATMCode', 				$this->row->field('ATMCode') );
			$this->db->set('AMGRCode', 				$this->row->field('AMGRCode') );
			$this->db->set('MGRCode', 				$this->row->field('MGRCode') );
			$this->db->set('ADMINCode', 			$this->row->field('ADMINCode') );
			$this->db->set('CallHistoryNotes',		$this->row->field('CallHistoryNotes','strtoupper') ); 
			$this->db->set('CallHistoryCallDate',	$this->row->field('CallHistoryCallDate') ); 
			$this->db->set('CallHistoryCreatedTs',	$this->row->field('CallHistoryCreatedTs') );  
			$this->db->set('HistoryType',			$this->row->field('HistoryType') );  
			
			// insert into history data process , If success to insert table history
			// then will update data t_gn_customer_master 
			// and last response status 
			
			$this->db->insert('t_gn_callhistory');
			if( $this->db->affected_rows() > 0 ){
				$this->dataTotals++;
				
				// call my function to update overall process admin.
				$this->_set_row_update_master_admin_activity( $this->row ); // updaet last admin 
				$this->_set_row_update_master_last_activity( $this->row ); // update last response 
			}
	}
	
	
	// return callback to client data 
	return (int)$this->dataTotals;
	
 }
 
 
  
/**
  * [_set_row_update_admin_status]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
// jika QA approve Close / OR REDISPATCH 
function _set_row_update_admin_status( $out = null ){
	
 $this->isAdmin = false;	
 $this->resultID = 0;
 if( !is_object( $out) ){
	return false;
 }
 
 // then will update di sini. jika close status krim ke bucket admin
 // jika redispatch krim ke agent / balikin 
 
 // status "CLOS" hanya untuk data non USAGE 
 // Jika Data Usage Cukup samapai Quality saja 
 // Mungkin Kira2 Gitu DUlu ya .
 
  $this->KondisiDataAdmin = false;
  $this->KondisiDataAdmin = @in_array( $this->ProductDataKodeId, 
									   $this->AllowProductAdmin);
									   
  if( !strcmp( $out->field('CallStatusId'), CLOS ))  
  {
	  
	// jika data bukan USAGE   
	if( $this->KondisiDataAdmin ){
	 // reset write on sql handler 
		$this->db->reset_write();
		$this->db->set('DM_AdmReasonId', NSTS);
		$this->db->set('DM_AdmCategoryId', NSTS);
		$this->db->set('DM_AdmReasonKode', 'NSTS'); 
		$this->db->set('DM_AdmCategoryKode', 'NSTS'); 
		$this->db->set('DM_AdmUpdateTs', 'NOW()', false);
	 
	 // where customer di ganti ya 
	 
		$this->db->where('DM_Id',  $out->field('MasterDataId', 'strtoupper'));
		$this->db->update('t_gn_customer_master');
		if( $this->db->affected_rows() > 0 ){
			
		  // masukan ke table assignment Admin yang nantinya akan di bagikan oleh leader admin
			$sql = sprintf("INSERT INTO t_gn_selling_assignment( 
								Assign_Sell_CustId,  Assign_Sell_DataType, 
								Assign_Sell_CreatorId, Assign_Sell_CreateTs )
							SELECT 
								a.DM_Id as Assign_Sell_CustId,
								a.DM_DataType as Assign_Sell_DataType,
								a.DM_UpdatedById as Assign_Sell_CreatorId,
								a.DM_UpdatedTs as Assign_Sell_CreateTs
							FROM t_gn_customer_master a WHERE a.DM_Id = '%s'
							ON DUPLICATE KEY UPDATE Assign_Sell_CreateTs= NOW()", 
							$out->field('MasterDataId') );
			// ok push data ya 			
			 //echo $sql;	
			$qry  = $this->db->query( $sql );
			if( $this->db->affected_rows() > 0 ){
				$this->Assign_Sell_Id = $this->db->insert_id();
				if( $this->Assign_Sell_Id ){
					$this->_set_row_update_admin_datatype( $this->Assign_Sell_Id );
				}
				// ambil jenis data - nya 
				$this->resultID++;
			}
		}
		
	}
	
	// jika data Product USAGE  
	// Bypass tanpa melalui Admin  
	
	if( !$this->KondisiDataAdmin ){
		$this->db->reset_write();
		$this->db->set('DM_AdmReasonId', CLOS);
		$this->db->set('DM_AdmCategoryId', CLOS);
		$this->db->set('DM_AdmReasonKode', 'CLOS'); 
		$this->db->set('DM_AdmCategoryKode', 'CLOS'); 
		$this->db->set('DM_AdmUpdateTs', 'NOW()', false);
		$this->db->where('DM_Id',  $out->field('MasterDataId', 'strtoupper'));
		if( $this->db->update('t_gn_customer_master') ){
			return true;
		}
	}
	
	
 }
 
 // if not an close "status like Approve Complete Not Komplite etc."
 // if not an close "status like Approve Complete Not Komplite etc."
  
 
 // status "RDPC"
 return $this->resultID;
 
} 

/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 
 
// jika status APRV dari Agent  maka update 
// di QA menjadi New status .

function _set_row_update_quality_status( $out = null ){

  $this->resultID = 0;
  if( !is_object( $out) ){
	return false;
 }
 
 
 // jika status nya adalah Approve Update Data di Agent 
  if( !strcmp( $out->field('CallStatusId'), APRV ) ) 
 {
 // reset write on sql handler 
	$this->db->reset_write();
	$this->db->set('DM_QualityReasonId', NSTS);
	$this->db->set('DM_QualityCategoryId', NSTS);
	$this->db->set('DM_QualityReasonKode', 'NSTS'); 
	$this->db->set('DM_QualityCategoryKode', 'NSTS');
	$this->db->set('DM_QualityProcess', 0);
	
 
 // where customer di ganti ya 
	$this->db->where('DM_Id',  $out->field('MasterDataId', 'strtoupper'));
	$this->db->update('t_gn_customer_master');
	if( $this->db->affected_rows() > 0 ){
	   $this->resultID++;
	}
	
	// end if;
  }
  // return data false;
  return $this->resultID;
 
}

 
/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 

 function _set_row_concat_callback_activity( $out = null )
{

	if( !$out->field('DateLater')  OR !$out->field('HourLater') 
		OR !$out->field('MinuteLater') )  {
		return false;		
	}
	
	// then will get on here data process .
	
	$arr_callback_hour  = array(
		$out->get_value('HourLater', 'trim'), 
		$out->get_value('MinuteLater', 'trim'), '00' );	
  
	// then we go ...
	
	$arr_callback_later = array ( 
		$out->get_value('DateLater', 'SetDate'),
		join(":", $arr_callback_hour)
	);	
  
	// then OK  // 
	if( $arr_callback_later ){
		$call_back_later = (string)join(" ", $arr_callback_later);
		return $call_back_later;
	}
	
   return false;
 
}
 
 
 /**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 function _set_row_update_admin_datatype( $Assign_Sell_Id  = 0 ){
	 
	// jika tidak benar  
	if( !$Assign_Sell_Id ){
		return false;
	} 
	$this->row = array(); 
	// selectd data to process 
	$sql = sprintf("select a.*  from t_gn_selling_assignment a  where a.Assign_Sell_Id = '%s'", $Assign_Sell_Id );
	$qry = $this->db->query($sql);
	if( $qry AND $qry->num_rows()>0 ) {		
		$this->row = $qry->result_first_record();
	}
	
	// then will convert data 
	if( !is_object( $this->row ) ){
		return false;
	}
	// debug($this->row);
	// jika data reg update jadi 1 
	if( !strcmp( $this->row->field('Assign_Sell_DataType'), 'CAP' ) ){
		$sql = sprintf("update t_gn_selling_assignment a 
							set a.Assign_Sell_IsReady = 0, 
								a.Assign_Sell_UpdateTs = NOW()
						where a.Assign_Sell_Id = '%s'", $Assign_Sell_Id);
		// echo $sql;				
		$qry = $this->db->query( $sql );
	}
	return true;
 } 
 
/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 
  function _set_row_update_callback_activity( $out  = null )
{
  // if isnull data 
  
  if( !is_object( $out ) ){
	return false;
  } 
  
  // merge string callback later on data process 
  $dateLater = $this->_set_row_concat_callback_activity( $out );
  if( is_null($dateLater) OR !$dateLater ){
	  return false;
  } 
  
  $out->add('CallbackLater', $dateLater);
  $out->add('ApoinmentFlag', 0);
  
  // if null back return false;
   // reset write data process   
  $this->db->reset_write(); 
  
  $this->db->set("CustomerId",  	$out->field('CustomerId') );
  $this->db->set("ApoinmentDate", 	$out->field('CallbackLater') );
  $this->db->set("ApoinmentCreate", $out->field('CreateTs') );
  $this->db->set("UserId", 			$out->field('CreatedById') );
  $this->db->set("ApoinmentFlag",   $out->field('ApoinmentFlag'));
  
  $this->db->insert('t_gn_appoinment');
  if( $this->db->affected_rows() >0 )   {
	 return TRUE;
  }
  
  return FALSE;
}

/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 
 // public function _set_row_save_spv_activity_call( $out = null  )  { }
 // public function _set_row_save_pod_activity_call( $out ) { }

/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 function _set_row_update_master_last_activity( $out = null ){
	// reset data of cache 

	$this->db->reset_write();
	$this->db->set('DM_UpdatedTs', $out->field('CreateTs'));
	$this->db->set('DM_UpdatedById', $out->field('CreatedById'));
	$this->db->set('DM_LastReasonId', $out->field('CallResultId'));
	$this->db->set('DM_LastCategoryId', $out->field('CallStatusId'));
	$this->db->set('DM_LastReasonKode', $out->field('CallResultId',array('ResultKode')));
	$this->db->set('DM_LastCategoryKode', $out->field('CallStatusId', array('KategoryKode')));
	
 // where data prcoess 
	
	$this->db->where('DM_Id', $out->field('MasterDataId'));
	$this->db->update('t_gn_customer_master');
	if( $this->db->affected_rows() > 0 ){
		return true;
	}
	return false;
 }  

  

/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 function _set_row_update_master_agent_activity( $out = null ){
	
	
// reset data of cache 

	$this->db->reset_write();
	$this->db->set('DM_UpdatedTs',		  	$out->field('CreateTs'));
	$this->db->set('DM_CallDateTs',		  	$out->field('CreateTs')); 
	$this->db->set('DM_CallSellerUpdateTs', $out->field('CreateTs'));
	
	
	$this->db->set('DM_CallReasonId', 	 	$out->field('CallResultId'));
	$this->db->set('DM_CallCategoryId',  	$out->field('CallStatusId'));
	
	$this->db->set('DM_CallReasonKode',	  	$out->field('CallResultId', array('ResultKode'))); 
	$this->db->set('DM_CallCategoryKode', 	$out->field('CallStatusId', array('KategoryKode')));
	
	$this->db->set('DM_UpdatedById', 	  	$out->field('CreatedById'));
	$this->db->set('DM_SellerId', 		  	$out->field('CreatedById'));
	$this->db->set('DM_SellerKode', 	  	$out->field('AgentCode'));
	
 // where data prcoess 
	
	$this->db->where('DM_Id', $out->field('MasterDataId'));
	$this->db->update('t_gn_customer_master');
	if( $this->db->affected_rows() > 0 ){
		return true;
	}
	return false;
} 


/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 function _set_row_update_master_quality_activity( $out = null ){
	
// reset data of cache 

	$this->db->reset_write();
	$this->db->set('DM_UpdatedTs', $out->field('CreateTs'));
	$this->db->set('DM_QualityUpdateTs', $out->field('CreateTs')); 
	$this->db->set('DM_QualityReasonId',  $out->field('CallResultId'));
	$this->db->set('DM_QualityCategoryId',$out->field('CallStatusId'));
	$this->db->set('DM_QualityReasonKode', $out->field('CallResultId', array('ResultKode'))); 
	$this->db->set('DM_QualityCategoryKode', $out->field('CallStatusId', array('KategoryKode')));
	$this->db->set('DM_UpdatedById', $out->field('CreatedById'));
	$this->db->set('DM_QualityUserId', $out->field('CreatedById')); 
	
 // where data prcoess 
	
	$this->db->where('DM_Id', $out->field('MasterDataId'));
	$this->db->update('t_gn_customer_master');
	if( $this->db->affected_rows() > 0 ){
		return true;
	}
	return false;
} 


/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 function _set_row_update_master_admin_activity( $out = null ){
	
// reset data of cache 

	$this->db->reset_write();
	$this->db->set('DM_UpdatedTs', $out->field('CreateTs'));
	$this->db->set('DM_AdmUpdateTs', $out->field('CreateTs')); 
	$this->db->set('DM_AdmReasonId',  $out->field('CallResultId'));
	$this->db->set('DM_AdmCategoryId',$out->field('CallStatusId'));
	$this->db->set('DM_AdmReasonKode', $out->field('CallResultId', array('ResultKode'))); 
	$this->db->set('DM_AdmCategoryKode', $out->field('CallStatusId', array('KategoryKode')));
	$this->db->set('DM_UpdatedById', $out->field('CreatedById'));
	$this->db->set('DM_AdmId', $out->field('CreatedById')); 
	
 // where data prcoess 
	
	$this->db->where('DM_Id', $out->field('MasterDataId'));
	$this->db->update('t_gn_customer_master');
	if( $this->db->affected_rows() > 0 ){
		return true;
	}
	return false;
} 

/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 
 public function _set_row_save_agent_activity_call( $out = null )
{
  
 // jika bukan object 
 
 $this->cond = 0;
 if( !is_object( $out ) ){
	return false;
 }
 
//set session data process data on here 
 $cok = CK();
 $CallBeforeReasonId =  $this->_select_call_before_status( $out->field('MasterDataId') );
 
// push data process on this OK 
 $out->add('CallBeforeReasonId', $CallBeforeReasonId);
 
 $out->add('CreatedById', 	$cok->field('UserId','strtoupper'));
 $out->add('UpdatedById', 	$cok->field('UserId','strtoupper'));
 $out->add('AgentCode', 	$cok->field('Username','strtoupper'));
 $out->add('SPVCode', 		$cok->field('SupervisorId',array('UserKode','strtoupper')));
 $out->add('ATMCode', 		$cok->field('SupervisorId',array('UserKode','strtoupper')));
 $out->add('AMGRCode', 		$cok->field('AccountManager',array('UserKode','strtoupper')));
 $out->add('MGRCode', 		$cok->field('ManagerId',array('UserKode','strtoupper')));
 $out->add('ADMINCode', 	$cok->field('AdministratorId',array('UserKode','strtoupper')));
 $out->add('CreateTs', 		date('Y-m-d H:i:s'));
 
 // all data process on here on call history data process 
 // all data process on here on call history data process 
 
 $this->db->reset_write();
 $this->db->set('CallSessionId',		$out->field('CallSessionId') );
 $this->db->set('CustomerId', 			$out->field('MasterDataId') );
 $this->db->set('CallReasonId', 		$out->field('CallResultId') );
 $this->db->set('CallCategoryId', 		$out->field('CallStatusId') ); 
 $this->db->set('CallNumber', 			$out->field('CallingNumber') );
 
 $this->db->set('CreatedById', 			$out->field('CreatedById') );
 $this->db->set('UpdatedById', 			$out->field('UpdatedById') );
 $this->db->set('AgentCode', 			$out->field('AgentCode') );
 $this->db->set('SPVCode', 				$out->field('SPVCode') );
 $this->db->set('ATMCode', 				$out->field('ATMCode') );
 $this->db->set('AMGRCode', 			$out->field('AMGRCode') );
 $this->db->set('MGRCode', 				$out->field('MGRCode') );
 $this->db->set('ADMINCode', 			$out->field('ADMINCode') );
 
 $this->db->set('CallBeforeReasonId', 	$out->field('CallBeforeReasonId') );
 $this->db->set('CallHistoryNotes',		$out->field('CallRemarks','strtoupper') ); 
 $this->db->set('CallHistoryCallDate',	$out->field('CreateTs') ); 
 $this->db->set('CallHistoryCreatedTs',	$out->field('CreateTs') );  
 
// insert into history data process 

 $this->db->insert('t_gn_callhistory');
 
 if( $this->db->affected_rows() > 0 ){
	 
	// update table master dari customer 
	$this->_set_row_update_master_agent_activity( $out ); 
	$this->_set_row_update_callback_activity( $out ); 
	$this->_set_row_update_quality_status( $out ); 
	$this->_set_row_update_master_last_activity( $out );
	$this->cond++;
	
 }
//  edit andi hilman 05112020
 if($out->field('ispublish','strtoupper')){
    $ispublis=array(
		'DM_FixId'=>$out->field('ispublish','strtoupper')
	);
	$this->db->where('DM_Id',$out->field('MasterDataId'));
	$this->db->update('t_gn_customer_master',$ispublis);
 }
 
 
 // return data to process on here .
 return (int)$this->cond;
 }



/**
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */

// method untuk menyimpan data QA yang berasal dari QA Detail->QualityDetail
// mod save actiivity.
  
function _set_row_save_quality_activity_call( $out = null )
{
  

 // jika bukan object 
 
 $this->cond = 0;
 if( !is_object( $out ) ){
	return false;
 }
 
//set session data process data on here 
 $cok = CK();
 
// push data process on this OK 
 
 $out->add('CreatedById', 	$cok->field('UserId','strtoupper'));
 $out->add('UpdatedById', 	$cok->field('UserId','strtoupper'));
 $out->add('AgentCode', 	$cok->field('Username','strtoupper'));
 $out->add('SPVCode', 		$cok->field('SupervisorId',array('UserKode','strtoupper')));
 $out->add('ATMCode', 		$cok->field('SupervisorId',array('UserKode','strtoupper')));
 $out->add('AMGRCode', 		$cok->field('AccountManager',array('UserKode','strtoupper')));
 $out->add('MGRCode', 		$cok->field('ManagerId',array('UserKode','strtoupper')));
 $out->add('ADMINCode', 	$cok->field('AdministratorId',array('UserKode','strtoupper')));
 $out->add('HistoryType', 	QUALITY_ACTIVITY);
 $out->add('CreateTs', 		date('Y-m-d H:i:s'));
 
 
 // all data process on here on call history data process 
 // all data process on here on call history data process 
 
 $this->db->reset_write();
 $this->db->set('CallSessionId',		$out->field('CallSessionId') );
 $this->db->set('CustomerId', 			$out->field('MasterDataId') );
 $this->db->set('CallReasonId', 		$out->field('CallResultId') );
 $this->db->set('CallCategoryId', 		$out->field('CallStatusId') ); 
 $this->db->set('CallNumber', 			$out->field('CallingNumber') );
 
 $this->db->set('CreatedById', 			$out->field('CreatedById') );
 $this->db->set('UpdatedById', 			$out->field('UpdatedById') );
 $this->db->set('AgentCode', 			$out->field('AgentCode') );
 $this->db->set('SPVCode', 				$out->field('SPVCode') );
 $this->db->set('ATMCode', 				$out->field('ATMCode') );
 $this->db->set('AMGRCode', 			$out->field('AMGRCode') );
 $this->db->set('MGRCode', 				$out->field('MGRCode') );
 $this->db->set('ADMINCode', 			$out->field('ADMINCode') );
 
 $this->db->set('CallHistoryNotes',		$out->field('CallRemarks','strtoupper') ); 
 $this->db->set('CallHistoryCallDate',	$out->field('CreateTs') ); 
 $this->db->set('CallHistoryCreatedTs',	$out->field('CreateTs') );  
 $this->db->set('HistoryType',			$out->field('HistoryType') );  
 
 
// insert into history data process 

 $this->db->insert('t_gn_callhistory');
 
 if( $this->db->affected_rows() > 0 ){
	 
	// update table master dari customer 
	$this->_set_row_update_master_quality_activity( $out ); 
	$this->_set_row_update_callback_activity( $out ); 
	$this->_set_row_update_admin_status( $out ); 
	$this->_set_row_update_master_last_activity( $out );
	$this->_update_tapenas($out->field('MasterDataId'));
	
	$this->cond++;
 }
 
 
 // return data to process on here .
 return (int)$this->cond;
 }

 function _update_tapenas ($CustomerId = "")
{
	$id = $this -> EUI_Session ->_get_session('UserId');
	$qry = "update t_gn_frm_tapenas a SET a.TR_QCID = '".$id."'
			where a.TR_CustId = '".$CustomerId."' ";
	//echo $qry;
	return $this->db->query($qry);
}

//-------------------------------------------------------------------------------------------------------
/*
 * @ package 	Save Call Activity by User  
 *
 * @ auth 		uknown 
 * @ return 	boolean
 */

 public function _set_row_save_doc_submit( $out = null)
 {	

    $sql = "UPDATE 
    			t_gn_selling_verification a 
    		INNER JOIN t_gn_customer_master b ON a.SV_Cust_Id = b.DM_Id 
    		SET SV_DocSubmit1 = '".$out->field('SV_DocSubmit1')."', SV_DocSubmit2 = '".$out->field('SV_DocSubmit2')."' ,
    		SV_DocSubmit3 = '".$out->field('SV_DocSubmit3')."', SV_DocSubmit4 = '".$out->field('SV_DocSubmit4')."' WHERE a.SV_Cust_Id = '".$out->field('MasterDataId')."' ";
    
    $qry = $this->db->query($sql);

    //echo $this->db->last_query();
    return $qry;
    

 }
 
 function _set_row_save_admin_activity_call( $out = null)
{
 
 
 // jika bukan object 
 
 $this->cond = 0;
 if( !is_object( $out ) ){
	return false;
 }
 
//set session data process data on here 
 $cok = CK();
 
// push data process on this OK 
 
 $out->add('CreatedById', 	$cok->field('UserId','strtoupper'));
 $out->add('UpdatedById', 	$cok->field('UserId','strtoupper'));
 $out->add('AgentCode', 	$cok->field('Username','strtoupper'));
 $out->add('SPVCode', 		$cok->field('SupervisorId',array('UserKode','strtoupper')));
 $out->add('ATMCode', 		$cok->field('SupervisorId',array('UserKode','strtoupper')));
 $out->add('AMGRCode', 		$cok->field('AccountManager',array('UserKode','strtoupper')));
 $out->add('MGRCode', 		$cok->field('ManagerId',array('UserKode','strtoupper')));
 $out->add('ADMINCode', 	$cok->field('AdministratorId',array('UserKode','strtoupper')));
 $out->add('HistoryType', 	QUALITY_ACTIVITY);
 $out->add('CreateTs', 		date('Y-m-d H:i:s'));
 
 
 // all data process on here on call history data process 
 // all data process on here on call history data process 
 
 $this->db->reset_write();
 $this->db->set('CallSessionId',		$out->field('CallSessionId') );
 $this->db->set('CustomerId', 			$out->field('MasterDataId') );
 $this->db->set('CallReasonId', 		$out->field('CallResultId') );
 $this->db->set('CallCategoryId', 		$out->field('CallStatusId') ); 
 $this->db->set('CallNumber', 			$out->field('CallingNumber') );
 
 $this->db->set('CreatedById', 			$out->field('CreatedById') );
 $this->db->set('UpdatedById', 			$out->field('UpdatedById') );
 $this->db->set('AgentCode', 			$out->field('AgentCode') );
 $this->db->set('SPVCode', 				$out->field('SPVCode') );
 $this->db->set('ATMCode', 				$out->field('ATMCode') );
 $this->db->set('AMGRCode', 			$out->field('AMGRCode') );
 $this->db->set('MGRCode', 				$out->field('MGRCode') );
 $this->db->set('ADMINCode', 			$out->field('ADMINCode') );
 
 $this->db->set('CallHistoryNotes',		$out->field('CallRemarks','strtoupper') ); 
 $this->db->set('CallHistoryCallDate',	$out->field('CreateTs') ); 
 $this->db->set('CallHistoryCreatedTs',	$out->field('CreateTs') );  
 $this->db->set('HistoryType',			$out->field('HistoryType') );  
 
 
// insert into history data process 

 $this->db->insert('t_gn_callhistory');
 
 
 
 if( $this->db->affected_rows() > 0 ){
	 
	// update table master dari customer 
	$this->_set_row_update_master_admin_activity( $out ); 
	$this->_set_row_update_callback_activity( $out ); 
	$this->_set_row_update_admin_status( $out ); 
	$this->_set_row_update_master_last_activity( $out );
	$this->_set_row_save_doc_submit( $out);
	
	$this->cond++;
 }
 
 
 // return data to process on here .
 return (int)$this->cond;
}
 


  public function _select_call_before_status( $CustomerId = 0 )
{
  $arr_call_status = 0;
  $sql = sprintf("select a.DM_CallReasonId from t_gn_customer_master a
					where a.DM_Id=%d", $CustomerId);
  $rs = $this->db->query($sql);
 // var_dump($rs->result_first_record()); die();
   if( $rs->num_rows() > 0 )
  {
	  $arr_call_status = (int)$rs->result_singgle_value();
  }
   
   return $arr_call_status;
  
 }
// ========================= END CLASS OK =================================================
}

?>

<?php 

/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
 
class M_Xtradana extends EUI_Model  {
	
/**
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
 	
 var $TrxDispositonId = null;
 var $TrxUsageId = 0;

/**
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
 
 private static $Instance = null;
  
/**
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
 
 public static function &Instance()  {
  if( is_null(self::$Instance) ) {
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
	$this->load->model(array('M_SeqNumber'));
	$this->dataURI = UR();
}

/**
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
function _select_ver_master( $VerId = 0 ){
 $result_array = array();
 $sql = sprintf("select * from t_gn_customer_verification a 
				inner join t_gn_customer_master b on a.CV_Data_CustId=b.DM_Id
				where a.CV_Data_Id ='%d'", $VerId);
				
	$qry = $this->db->query( $sql );
	if( $qry && $qry->num_rows() > 0 ){
		$result_array = $qry->result_first_assoc();
	}	
	return Objective( $result_array );
} 

/**
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
 
function _create_trasaction_usage( $customerkartu = 0 ){
	$this->TrxUsageId  = $this->M_SeqNumber->CreateTrxSeqUsageID( $customerkartu );
	return $this->TrxUsageId;
} 

/**
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
 function _submit_paper_work( $dataURI = null )
{	

// get data @dataURI  = from url header .
  $this->dataURI = $dataURI;
  $this->dataCOK = CK(); // get session user submit.
  
 // kemudian check validation data -nya 
 if(!is_object( $this->dataURI ) ){
	 return false;
  }

  // then will exit data OK . 
  $this->dataVerId =  $this->dataURI->field('TX_Usg_VerId');
  if(!$this->dataVerId) {
	return false;
  }
  
// ambil Program data ID -nya 
  
 $this->dataProgramId  = $this->dataURI->field('TX_Usg_ProgramData');
  
 // get select data dari 't_gn_customer_verification' untuk detail 
 // yang tidak ada pada form. seperti nama kustomer .
 
 $this->dataVER = $this->_select_ver_master( $this->dataVerId );
 $this->dataPRG = $this->_select_program_detail_lookup( $this->dataProgramId );

// get data user semua -nye
 $this->dataUSR = UserDetail($this->dataCOK->field('UserId'));
 

// pusdata kesini dulu ke dalam bentuk OBJECT ini .
// untuk mempermudah . =======================================================
			
 $this->dataURI->add('TX_Usg_KreditLimit',	$this->dataURI->field('TX_Usg_KreditLimit','SetNominal') );
 $this->dataURI->add('TX_Usg_AvailableXD',	$this->dataURI->field('TX_Usg_AvailableXD','SetNominal') );
 $this->dataURI->add('TX_Usg_AvailableSS',	$this->dataURI->field('TX_Usg_AvailableSS','SetNominal') );
 $this->dataURI->add('TX_Usg_JumlahDana',	$this->dataURI->field('TX_Usg_JumlahDana','SetNominal') );
 $this->dataURI->add('TX_Usg_CustomerName',	$this->dataVER->field('DM_FirstName','strtoupper') );
 $this->dataURI->add('TX_Usg_MotherName', 	$this->dataVER->field('CV_Data_MotherName','strtoupper') );
 $this->dataURI->add('TX_Usg_DOB', 			$this->dataVER->field('CV_Data_Dob','strtoupper') );
 
 $this->dataURI->add('TX_Usg_Rate',			$this->dataPRG->field('PRD_Data_Rate','strtoupper') );
 $this->dataURI->add('TX_Usg_ProgramValue', $this->dataPRG->field('PRD_Data_Value','strtoupper') );
 
 
 $this->dataURI->add('TX_Usg_AmgrKode', 	$this->dataUSR->field('amgr_kode',array('SetEvalute', 'strtoupper') ));
 $this->dataURI->add('TX_Usg_MgrKode', 		$this->dataUSR->field('mgr_kode',array('SetEvalute', 'strtoupper')));
 $this->dataURI->add('TX_Usg_SpvKode', 		$this->dataUSR->field('spv_kode',array('SetEvalute', 'strtoupper')));
 $this->dataURI->add('TX_Usg_LeaderKode', 	$this->dataUSR->field('leader_kode',array('SetEvalute', 'strtoupper')));
 $this->dataURI->add('TX_Usg_SellerId', 	$this->dataUSR->field('UserId',array('SetEvalute', 'strtoupper')));
 $this->dataURI->add('TX_Usg_SellerKode', 	$this->dataUSR->field('id',array('SetEvalute', 'strtoupper')));
 $this->dataURI->add('TX_Usg_CreatorKode', 	$this->dataUSR->field('id',array('SetEvalute', 'strtoupper')));
 $this->dataURI->add('TX_Usg_CreatedTs', 	date('Y-m-d H:i:s'));
 
// ================= baru masukan data tersebut ke table berikut ini.
// "t_gn_frm_usage". this reset data process. ====================================

 $this->db->reset_write();
 $this->db->set('TX_Usg_TransId',		$this->dataURI->field('TX_Usg_TransId'));
 $this->db->set('TX_Usg_VerId',			$this->dataURI->field('TX_Usg_VerId'));
 $this->db->set('TX_Usg_Custno',		$this->dataURI->field('TX_Usg_Custno'));
 $this->db->set('TX_Usg_CustId',		$this->dataURI->field('TX_Usg_CustId'));
 $this->db->set('TX_Usg_CustomerName',	$this->dataURI->field('TX_Usg_CustomerName'));
 $this->db->set('TX_Usg_MotherName',	$this->dataURI->field('TX_Usg_MotherName'));
 $this->db->set('TX_Usg_DOB', 			$this->dataURI->field('TX_Usg_DOB'));
 $this->db->set('TX_Usg_FixID',			$this->dataURI->field('TX_Usg_FixID'));
 $this->db->set('TX_Usg_JenisKartu',	$this->dataURI->field('TX_Usg_JenisKartu'));
 $this->db->set('TX_Usg_ExpiredKartu',	$this->dataURI->field('TX_Usg_ExpiredKartu'));
 $this->db->set('TX_Usg_KreditLimit',	$this->dataURI->field('TX_Usg_KreditLimit'));
 $this->db->set('TX_Usg_AvailableXD',	$this->dataURI->field('TX_Usg_AvailableXD'));
 $this->db->set('TX_Usg_AvailableSS',	$this->dataURI->field('TX_Usg_AvailableSS'));
 $this->db->set('TX_Usg_Cycle',			$this->dataURI->field('TX_Usg_Cycle'));
 $this->db->set('TX_Usg_Block',			$this->dataURI->field('TX_Usg_Block'));
 $this->db->set('TX_Usg_Membal',		$this->dataURI->field('TX_Usg_Membal'));
 
 $this->db->set('TX_Usg_Program',		$this->dataURI->field('TX_Usg_Program'));
 $this->db->set('TX_Usg_ProgramData',	$this->dataURI->field('TX_Usg_ProgramData'));
 $this->db->set('TX_Usg_ProgramValue',  $this->dataURI->field('TX_Usg_ProgramValue'));
 $this->db->set('TX_Usg_Penawaran',		$this->dataURI->field('TX_Usg_Penawaran'));
 
 $this->db->set('TX_Usg_Statement',		$this->dataURI->field('TX_Usg_Statement'));
 $this->db->set('TX_Usg_NamaRekening',	$this->dataURI->field('TX_Usg_NamaRekening'));
 $this->db->set('TX_Usg_NoRekening',	$this->dataURI->field('TX_Usg_NoRekening'));
 $this->db->set('TX_Usg_NamaBank',		$this->dataURI->field('TX_Usg_NamaBank'));
 $this->db->set('TX_Usg_Cabang',		$this->dataURI->field('TX_Usg_Cabang'));
 $this->db->set('TX_Usg_JumlahDana',	$this->dataURI->field('TX_Usg_JumlahDana'));
 $this->db->set('TX_Usg_Tenor',			$this->dataURI->field('TX_Usg_Tenor'));
 $this->db->set('TX_Usg_Rate',			$this->dataURI->field('TX_Usg_Rate'));
 
 $this->db->set('TX_Usg_AmgrKode',		$this->dataURI->field('TX_Usg_AmgrKode'));
 $this->db->set('TX_Usg_MgrKode',		$this->dataURI->field('TX_Usg_MgrKode'));
 $this->db->set('TX_Usg_SpvKode',		$this->dataURI->field('TX_Usg_SpvKode'));
 $this->db->set('TX_Usg_LeaderKode',	$this->dataURI->field('TX_Usg_LeaderKode'));
 $this->db->set('TX_Usg_SellerId',		$this->dataURI->field('TX_Usg_SellerId'));
 $this->db->set('TX_Usg_SellerKode',	$this->dataURI->field('TX_Usg_SellerKode'));
 $this->db->set('TX_Usg_CreatorKode',	$this->dataURI->field('TX_Usg_CreatorKode'));
 $this->db->set('TX_Usg_CreatedTs',		$this->dataURI->field('TX_Usg_CreatedTs'));
 
 // insert data untuk pertma kalinya 
 $this->db->insert( 't_gn_frm_usage' );
 if( $this->db->affected_rows() > 0 ){
	$this->TrxDispositonId = $this->db->insert_id(); 
	
	// check untuk nilai dari tiap transaksi.
	$this->TrxUsageTrxSeqId = ( $this->dataURI->field('TX_Usg_TransId') ?
								$this->dataURI->field('TX_Usg_TransId') : $this->TrxDispositonId);
								
	// create_function sequen untuk transaksi key no kartu / ver ID 
	$this->TrxUsageSeqId = $this->_create_trasaction_usage( $this->dataURI->field('TX_Usg_VerId') );
	
	// jika berhasil insert masukan nilai trans ID , dan Sequenya  --
	$sql = sprintf("UPDATE t_gn_frm_usage SET TX_Usg_TransSeq = %s, TX_Usg_TransId = '%s' 
				    WHERE TX_Usg_Id=%d",  $this->TrxUsageSeqId, $this->TrxUsageTrxSeqId,  $this->TrxDispositonId);
	$this->db->query( $sql );	
	
	// add and push back data 
	// jika sudah ada tidak perlu dimasukan lagi .
	$this->dataURI->add('TX_Usg_TransId',  $this->TrxUsageTrxSeqId);
	$this->dataURI->add('TX_Usg_TransSeq', $this->TrxUsageSeqId);
 }
 
 // jika terjadi duplikasi Process Akan di handle di sini.
 else if( !strcmp( mysql_errno(),  1062) ){
 // keep on client object Browser 
 // catch OK 	
	$this->TrxDispositonId = $this->dataURI->field('TX_Usg_TransId');
	
 // onduplicate Error Process like this;
 // jika data di insert dan terjadi duplikasi update field
 // berikut ini.
	$this->db->reset_write();
	$this->db->set('TX_Usg_Program',		$this->dataURI->field('TX_Usg_Program'));
	$this->db->set('TX_Usg_Statement',	 	$this->dataURI->field('TX_Usg_Statement'));
	$this->db->set('TX_Usg_NamaRekening',   $this->dataURI->field('TX_Usg_NamaRekening'));
	$this->db->set('TX_Usg_NoRekening',	 	$this->dataURI->field('TX_Usg_NoRekening'));
	$this->db->set('TX_Usg_NamaBank',		$this->dataURI->field('TX_Usg_NamaBank'));
	$this->db->set('TX_Usg_Cabang',		 	$this->dataURI->field('TX_Usg_Cabang'));
	$this->db->set('TX_Usg_JumlahDana',	 	$this->dataURI->field('TX_Usg_JumlahDana','SetNominal'));
	$this->db->set('TX_Usg_Tenor',		 	$this->dataURI->field('TX_Usg_Tenor'));
	$this->db->set('TX_Usg_AmgrKode',	 	$this->dataURI->field('TX_Usg_AmgrKode'));
	$this->db->set('TX_Usg_MgrKode',		$this->dataURI->field('TX_Usg_MgrKode'));
	$this->db->set('TX_Usg_SpvKode',		$this->dataURI->field('TX_Usg_SpvKode'));
	$this->db->set('TX_Usg_LeaderKode',	 	$this->dataURI->field('TX_Usg_LeaderKode'));
	$this->db->set('TX_Usg_EditorKode',	 	$this->dataURI->field('TX_Usg_CreatorKode'));
	$this->db->set('TX_Usg_UpdatedTs',	 	$this->dataURI->field('TX_Usg_CreatedTs'));
	$this->db->set('TX_Usg_ProgramData',	$this->dataURI->field('TX_Usg_ProgramData'));
	$this->db->set('TX_Usg_ProgramValue', 	$this->dataURI->field('TX_Usg_ProgramValue'));
	$this->db->set('TX_Usg_Membal',		 	$this->dataURI->field('TX_Usg_Membal'));
	$this->db->set('TX_Usg_Rate',		 	$this->dataURI->field('TX_Usg_Rate'));
	 
  // where on duplicate 
	$this->db->where('TX_Usg_VerId', $this->dataURI->field('TX_Usg_VerId'));
	$this->db->where('TX_Usg_Program', $this->dataURI->field('TX_Usg_Program'));
	$this->db->where('TX_Usg_Custno', $this->dataURI->field('TX_Usg_Custno'));
	$this->db->update('t_gn_frm_usage');
	
 }
 // then will uptodate 
 
 return $this->TrxDispositonId;
 	
} 
/**
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
 function _callback_paper_work( ){
	return (array)$this->dataURI->fetch_assoc();
} 


/**
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
function _select_program_detail_lookup( $ProgramId = 0 ){
	
	$result_array = array();
	$sql = sprintf("select a.PRD_Data_Kode, a.PRD_Data_Rate, a.PRD_Data_Value from t_lk_program_detail a 
				    where a.PRD_Data_Id =%d", $ProgramId );
	$qry = $this->db->query($sql);				
	if( $qry && $qry->num_rows() > 0 ) {
		$result_array = $qry->result_first_assoc();
	}
	return @call_user_func('Objective', $result_array );
} 
 
/**
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
 
function _select_tenor_berdasarkan_penawaran( $penawaran = '' ){
	
	$result_array = array();
	$sql = sprintf("select a.PRD_Data_Id from t_lk_program_detail a 
					where a.PRD_Data_Kode = '%s' and a.PRD_Data_Master = 'EXTRADANA'
					order by a.PRD_Data_Sort ASC", $penawaran);
					
	$qry = $this->db->query( $sql );
	if( $qry && $qry->num_rows() > 0 ) 
		foreach( $qry->result_assoc() as $row ){
		$result_array[$row['PRD_Data_Id']] = $row['PRD_Data_Id'];
	}
	return (array)$result_array;
}

/**
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */ 
 
function _select_callculator( $out = null ){
	
 //  debug( $out);	
	$result_assoc = array();
	$ProgramId = $out->field('ProgramId', 'intval');
	$Penawaran = $out->field('Penawaran');
	
	if( !$ProgramId ){
		$ProgramId = $this->_select_tenor_berdasarkan_penawaran($Penawaran);
	}
	else {
		$ProgramId = array($ProgramId);
	}
// query data for selector query && Process SIP 	
	$this->db->reset_select();
	$this->db->select('*');
	$this->db->from('t_lk_program_detail a');
	$this->db->where('a.PRD_Data_Master', 'EXTRADANA');
	$this->db->where_in('a.PRD_Data_Id', array_map('intval', $ProgramId) );
	 
	$qry = $this->db->get();
	if( $qry && $qry->num_rows() > 0 )
	foreach( $qry->result_assoc() as $result_data ) {
		$result_assoc[$result_data['PRD_Data_Id']] = (array)$result_data;
		
	}
	 
 // jika data bentuk array 
	$num = 0;
	$result_callback = array();
	if( is_array( $result_assoc ) ) 
	foreach( $result_assoc as $key => $rows )  {
		
		// --- section two ---- 
		$row = Objective( $rows );
		$result_tenor = $row->fields('PRD_Data_Tenor');
		if( is_array($result_tenor )) 
		foreach( $result_tenor as $key => $tenor ){
			
			// define process looping 
			$jmldana = $out->field('SimulDana','SetNominal');
			$rating  = $row->field('PRD_Data_Rate');
			$label   = sprintf("%s Bln<br> ( %s %% )", $tenor, $rating);
			
			$pokok  = round(($jmldana/$tenor) );
			$bunga  = round((($jmldana*$rating)/100));
			$total  = ($pokok+$bunga);
			
		 // on this process OK ;
			
			$result_callback[$num]['number'] = $num;
			$result_callback[$num]['label']  = $label;
			$result_callback[$num]['pokok']  = $pokok;
			$result_callback[$num]['bunga']  = $bunga;
			$result_callback[$num]['total']  = $total;
			
		// looping number data 
			$num++;
		}
		 
		
	}
	
	// return callback data process SIP .
	return (array)$result_callback;
}

/**
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */ 
}
?>
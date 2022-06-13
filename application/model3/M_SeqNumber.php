<?php 
	
/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */	
class M_SeqNumber extends EUI_Model{
	
/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */	
function __construct(){ }

/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
function CreatSeqVerID( $Data ){
	// manage of sequence 
	return $this->CreateSeqID($Data);
}

/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
function CreateTrxSeqUsageID( $Data ){
	// manage of sequence 
	return $this->CreateTrxSeqUsage($Data);
}

/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */

 protected function CreateTrxSeqUsage( $context = 'VER', $seqname='t_gn_frm_transaction_usage', $start=1 )
{  
// nilai awal untuk generate data process OK .
  $this->SeqNumberID = 0;
// defaultny a
  $this->_genIDSQL ="UPDATE %s 
					SET seq_value=LAST_INSERT_ID(seq_value+1), 
						seq_createts=NOW() 
					WHERE seq_name='$context' ";
					
  $this->_SqlGetNext = sprintf($this->_genIDSQL, $seqname);
  
  // then will result 
  $this->res_val = mysql_query( $this->_SqlGetNext );
  $this->sql_val = mysql_affected_rows();
  
  // jika process update gagal artinya tabel kosong ya .
  if( $this->sql_val <= 0 ) {
	  
    //update gagal, asumsinya tabel tidak ada, create table sequence
    $this->_genSeq1SQL = "CREATE TABLE %s (
							seq_name VARCHAR(15) NOT NULL DEFAULT 0, 
							seq_value INT(15) NOT NULL,
							seq_createts DATETIME NULL DEFAULT NULL,
						  INDEX idx_seq (seq_value,seq_name)
						  ) ENGINE=MyISAM;";
						
					
    $this->_genSeq2SQL = "INSERT INTO %s VALUES ( '%s', %s,'%s');";
	$this->_SqlTable   = sprintf( $this->_genSeq1SQL, $seqname);
	
	mysql_query($this->_SqlTable );  
	
	// jika berhasil create tabel kemudian insert data pertama 
	
	$this->_Sqlinsert  = sprintf($this->_genSeq2SQL,  $seqname, $context, $start-1, date('Y-m-d H:i:s'));
	mysql_query( $this->_Sqlinsert ); 
	
	// jika OK lanjut dengan methode UPDATE .
	$this->res_val = mysql_query($this->_SqlGetNext);
  }
	
// ambil sequen terakhir 
	
  $this->SeqNumberID = mysql_insert_id();
  return $this->SeqNumberID;	
}

/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */

 protected function CreateSeqID( $context = 'VER', $seqname='t_gn_verification_sequence', $start=1 )
{  
// nilai awal untuk generate data process OK .
  $this->SeqNumberID = 0;
// defaultny a
  $this->_genIDSQL ="UPDATE %s 
					SET seq_value=LAST_INSERT_ID(seq_value+1), 
						seq_createts=NOW() 
					WHERE seq_name='$context' ";
					
  $this->_SqlGetNext = sprintf($this->_genIDSQL, $seqname);
  
  // then will result 
  $this->res_val = mysql_query( $this->_SqlGetNext );
  $this->sql_val = mysql_affected_rows();
  
  // jika process update gagal artinya tabel kosong ya .
  if( $this->sql_val <= 0 ) {
	  
    //update gagal, asumsinya tabel tidak ada, create table sequence
    $this->_genSeq1SQL = "CREATE TABLE %s (
							seq_name VARCHAR(15) NOT NULL DEFAULT 0, 
							seq_value INT(15) NOT NULL,
							seq_createts DATETIME NULL DEFAULT NULL,
						  INDEX idx_seq (seq_value,seq_name)
						  ) ENGINE=MyISAM;";
						
					
    $this->_genSeq2SQL = "INSERT INTO %s VALUES ( '%s', %s,'%s');";
	$this->_SqlTable   = sprintf( $this->_genSeq1SQL, $seqname);
	
	mysql_query($this->_SqlTable );  
	
	// jika berhasil create tabel kemudian insert data pertama 
	
	$this->_Sqlinsert  = sprintf($this->_genSeq2SQL,  $seqname, $context, $start-1, date('Y-m-d H:i:s'));
	mysql_query( $this->_Sqlinsert ); 
	
	// jika OK lanjut dengan methode UPDATE .
	$this->res_val = mysql_query($this->_SqlGetNext);
  }
	
// ambil sequen terakhir 
	
  $this->SeqNumberID = mysql_insert_id();
  return $this->SeqNumberID;	
}
	
/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */	
	
}

?>
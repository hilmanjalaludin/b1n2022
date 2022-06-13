<?php 
 
/**
 * [PaperWork description]
 * structure url for get url form 
 * get data and post form 
 * Method / CampaignName / CustomerId
 */
class M_DataVerification extends EUI_Model {
 
var $CustomerId = null;	
var $CallbackMsg = array();
var $VerDataStatus = array();
 
/**
 * [RouteForm description]
 * get data post and route form
 */	
 var $SeqNumSessionId = 0;
 
/**
 * [RouteForm description]
 * get data post and route form
 */	 
private static $Instance = null;
public static function &Instance(){
	if( is_null( self::$Instance ) ){
		self::$Instance = new self();
	}
	return self::$Instance;
} 
 
/**
 * [RouteForm description]
 * get data post and route form
 */	 
function __construct(){
	$this->load->model(array('M_SeqNumber'));
}	

function _select_ver_row_pctd( $CustomerId = 0 )
{
  $result_array = array();
  $tmp = array();
  $sqlCv = sprintf("SELECT * FROM t_gn_customer_verification WHERE CV_Data_CustId=".$CustomerId);
  // var_dump($sqlCv);
  // die;
  $cv = $this->db->query($sqlCv)->result_array();
	foreach($cv as $item) {
	$sql = sprintf("SELECT *, (
		SELECT COUNT(MERCHANT_ID) from t_gn_attr_pctd 
		WHERE CV_Data_CustId = ".$item['CV_Data_CustId']." AND status = 1 AND CV_Data_FixID = '".$item['CV_Data_FixID']."') AS jumlahTransaksi FROM t_gn_customer_verification b
		WHERE  b.CV_Data_FixID = '".$item['CV_Data_FixID']."'
		AND b.CV_Data_CustId = ".$CustomerId."
		GROUP BY b.CV_Data_CardType");
	$qry = $this->db->query( $sql );
	if( $qry && $qry->num_rows() > 0 ) 
		foreach( $qry->result_assoc() as $row ){  
			$result_array[$item['CV_Data_Id']] = $row;
		}
	}

   return array($result_array);
}
/**
 * [RouteForm description]
 * get data post and route form
 */	 
function _select_ver_status( $CustId = 0 ){
	$sql = sprintf("select b.VH_Data_Name, b.VH_Data_Value, b.VH_Data_VerStatus, b.VH_Data_Session 
					from t_gn_verification_session a 
					left join t_gn_verification_history b on a.VS_SessionId=b.VH_Data_Session
					WHERE a.VS_CustId=%s  AND VH_Data_VerStatus=1 ", $CustId);
	$qry = $this->db->query( $sql );

	if( $qry && $qry->num_rows() >0 ) 
	foreach( $qry->result_record() as $row ){
	  // untuk sequen session jika sudah ada ambil dari sini.
	   $this->SeqNumSessionId = $row->field('VH_Data_Session');
 
	  // ini untuk data Processnya jika bernilai "1"
	  if( $row->field('VH_Data_VerStatus', 'intval') ){
		$this->VerDataStatus[] = $row->field('VH_Data_Name');  
	  }
	}
	return (array)$this->VerDataStatus;
}
 
/**
 * [RouteForm description]
 * get data post and route form
 */
 
 function _select_ver_row( $CustomerId = 0 )
{
  $result_array = array();
  $sql = sprintf("select * from t_gn_customer_verification a 
				 where a.CV_Data_CustId ='%d' 
				 order by a.CV_Data_Id ASC", $CustomerId);
//echo $sql;				 
   $qry = $this->db->query( $sql );
  if( $qry && $qry->num_rows() > 0 ) 
	foreach( $qry->result_assoc() as $row ){
		$result_array[$row['CV_Data_Id']] = $row;     
	}
	//debug($result_array);
   return (array)$result_array;
}
 
 
/**
 * [RouteForm description]
 * get data post and route form
 */
function _select_ver_detail( $verifikasiId = 0 ) {
 $this->result_verification = array();
 return Objective($this->result_verification);
} 
 
function _select_ver_rows( $CustomerId = 0 )
{
  $result_array = array();
  $sql = sprintf("select a.*, b.DM_FirstName from t_gn_customer_tapenas a
  				 join t_gn_customer_master b ON a.TapensasCustId = b.DM_Id 
				 where a.TapensasCustId ='%d' 
				 order by a.TapenasId ASC", $CustomerId);
   //echo $sql;				 
   $qry = $this->db->query( $sql );
  	if( $qry && $qry->num_rows() > 0 ) 
		foreach( $qry->result_assoc() as $row ){
			$result_array[$row['TapenasId']] = $row;     
	}
   //debug($result_array);
   return (array)$result_array;
}
/**
 * [RouteForm description]
 * get data post and route form
 */
 
function _select_ver_master( $CustomerId ){
	$sql = sprintf("select (SELECT count(mc.VH_Data_Value) FROM t_gn_verification_history mc 
	WHERE mc.VH_Data_CustId=$CustomerId  AND mc.VH_Data_Name='DM_MotherName' AND  mc.VH_Data_VerStatus=0) AS total_failed, 
	(SELECT count(mc.VH_Data_Value) FROM t_gn_verification_history mc 
	WHERE mc.VH_Data_CustId=$CustomerId  AND mc.VH_Data_Name='DM_MotherName' AND  mc.VH_Data_VerStatus=1 )AS total_benar, a.*,c.VH_Data_VerStatus,cv.CV_Data_VerficationStatus ,b.DM_MotherName from t_gn_verification_setup a
	LEFT JOIN  t_gn_customer_master b ON b.DM_ProductId = a.SV_Data_ProductId
	LEFT JOIN t_gn_verification_history c ON c.VH_Data_CustId = b.DM_Id
	LEFT JOIN t_gn_customer_verification cv ON cv.CV_Data_CustId = b.DM_Id
						where  
						a.SV_Data_Context=1 AND
						 a.SV_Data_Flags=1
						 AND b.DM_Id= $CustomerId
						 GROUP BY a.SV_Data_Id
						order by a.SV_Data_Sort ASC", 1);
//   echo "<pre>";						
//   var_dump($sql);											
  $qry = $this->db->query( $sql );
  if( $qry && $qry->num_rows() > 0 ) {
	  $result_array = (array)$qry->result_assoc();
  }
   return (array)$result_array;
   
}  

function _select_ver_master_pctd( $CustomerId ){
	$sql = sprintf("select (SELECT count(mc.VH_Data_Value) FROM t_gn_verification_history mc 
	WHERE mc.VH_Data_CustId=$CustomerId  AND mc.VH_Data_Name='DM_MotherName' AND  mc.VH_Data_VerStatus=0) AS total_failed, 
	(SELECT count(mc.VH_Data_Value) FROM t_gn_verification_history mc 
	WHERE mc.VH_Data_CustId=$CustomerId  AND mc.VH_Data_Name='DM_MotherName' AND  mc.VH_Data_VerStatus=1 )AS total_benar,
	a.*,c.VH_Data_VerStatus,cv.CV_Data_VerficationStatus ,b.DM_MotherName from t_gn_verification_setup_pctd a
	LEFT JOIN  t_gn_customer_master b ON b.DM_ProductId = a.SV_Data_ProductId
	LEFT JOIN t_gn_verification_history c ON c.VH_Data_CustId = b.DM_Id
	LEFT JOIN t_gn_customer_verification cv ON cv.CV_Data_CustId = b.DM_Id
						where  
						a.SV_Data_Context=1 AND
						 a.SV_Data_Flags=1
						 AND b.DM_Id= $CustomerId
						 GROUP BY a.SV_Data_Id
						order by a.SV_Data_Sort ASC", 1);
//   echo "<pre>";						
//   var_dump($sql);											
  $qry = $this->db->query( $sql );
  if( $qry && $qry->num_rows() > 0 ) {
	  $result_array = (array)$qry->result_assoc();
  }
   return (array)$result_array;
   
}  



function _select_ver_master_balcon( $CustomerId ){
	$sql = sprintf("select (SELECT count(mc.VH_Data_Value) FROM t_gn_verification_history mc 
	WHERE mc.VH_Data_CustId=$CustomerId  AND mc.VH_Data_Name='DM_MotherName' AND  mc.VH_Data_VerStatus=0) AS total_failed, 
	(SELECT count(mc.VH_Data_Value) FROM t_gn_verification_history mc 
	WHERE mc.VH_Data_CustId=$CustomerId  AND mc.VH_Data_Name='DM_MotherName' AND  mc.VH_Data_VerStatus=1 )AS total_benar,a.*,c.VH_Data_VerStatus,cv.CV_Data_VerficationStatus ,b.DM_MotherName from t_gn_verification_setup_balcon a
	LEFT JOIN  t_gn_customer_master b ON b.DM_ProductId = a.SV_Data_ProductId
	LEFT JOIN t_gn_verification_history c ON c.VH_Data_CustId = b.DM_Id
	LEFT JOIN t_gn_customer_verification cv ON cv.CV_Data_CustId = b.DM_Id
						where  
						a.SV_Data_Context=1 AND
						 a.SV_Data_Flags=1
						 AND b.DM_Id= $CustomerId
						 GROUP BY a.SV_Data_Id
						order by a.SV_Data_Sort ASC", 1);
// get query data proces on siphin 

// echo "<pre>";
// var_dump($sql);
$qry = $this->db->query( $sql );

if( $qry && $qry->num_rows() > 0 ) {
$result_array = (array)$qry->result_assoc();
}
// print_r($result_array);

return (array)$result_array;
   
}  
/**
 * [RouteForm description]
 * get data post and route form
 */
function _select_ver_kartu( $CustId = 0, $setup = null ){
 
 
 
// query untuk ambil semua data kartu di customer berdasarkan 
// customerID 
 $result_array = array();
 
 $sql = sprintf("select a.* from t_gn_customer_verification a 
	where a.CV_Data_CustId = %s order by a.CV_Data_Id ASC", $CustId );
 $qry = $this->db->query( $sql );
 if( $qry && $qry->num_rows() > 0 ) 
 foreach( $qry->result_assoc() as $row ){
 
	// konvert to object data .
	$kartu = Objective( $row );
 
	// kombine from setupid 
	$kartu->add('SV_Data_Field', $setup->field('SV_Data_Field'));
	$kartu->add('SV_Data_Id', $setup->field('SV_Data_Id'));
 
	// then will get back its.
	$result_array[$kartu->field('CV_Data_Id')]['id']  	  = $kartu->field('CV_Data_Id');
	$result_array[$kartu->field('CV_Data_Id')]['verify']  = $kartu->field('CV_Data_VerficationStatus');
	$result_array[$kartu->field('CV_Data_Id')]['value']   = $kartu->field('CV_Data_CcExpired');
	$result_array[$kartu->field('CV_Data_Id')]['field']   = $kartu->field('SV_Data_Field');
	$result_array[$kartu->field('CV_Data_Id')]['setupid'] = $kartu->field('SV_Data_Id');
	$result_array[$kartu->field('CV_Data_Id')]['custid']  = $kartu->field('CV_Data_CustId');
 
 
 }
 
 return (array)$result_array;
} 
 
/**
 * [RouteForm description]
 * get data post and route form
 */
function _select_ver_value( $CustId = 0, $ver = null ){
 
// defaul ver value
 $this->value = "";	
 
// data akan di simpan di data JSON 	
 $this->db->reset_select();
 $this->db->select($ver->field('SV_Data_Field'));
 $this->db->from($ver->field('SV_Data_Table'));
 $this->db->where($ver->field('SV_Data_Keys'), $CustId);
 
// echo $this->db->print_out();
// get an recsource data on here .
 $qry = $this->db->get();
 if( $qry && $qry->num_rows() > 0 )  {
	// ambil row data -nya 
	$this->row = $qry->result_first_record();
 
	// jika tipe data tanggal dengan format tertentu
	if( $this->row && !strcmp($ver->field('SV_Data_Field'), 'DM_Dob') ){
		$this->value = $this->row->field( $ver->field('SV_Data_Field'), 'ddmmyyyy');
	}
 
	// jika tipe data Bukan tanggal dengan format tertentu	
	if( $this->row && strcmp($ver->field('SV_Data_Field'), 'DM_Dob') ){
		$this->value = $this->row->field( $ver->field('SV_Data_Field'));
	}
 }
 
  return strtoupper($this->value);
} 
 
/**
 * [RouteForm description]
 * get data post and route form
 */

 

function _select_ver_identifycation_balcon( $out = null )
{
	// var_dump($this->VerDataStatus,'laslask');
	// die;
$this->result_array = array();
 
// ambil sequen data untuk sesion di history
// ketika verifikasi .
$this->CusId = $out->field('CustomerId');
$this->ProductId = $out->field('ProductId');
$this->CampaignId = $out->field('CampaignId');
 
// get ver by custid
$this->VerStatus = $this->_select_ver_status( $this->CusId );
if(!$this->SeqNumSessionId ){
$this->SeqNumSessionId = $this->M_SeqNumber->CreatSeqVerID('VER');
}
 
// on query data process
$sql = sprintf(" select
a.SV_Data_Id,
a.SV_Data_Field,
a.SV_Data_Counter,
a.SV_Data_Point,
a.SV_Data_Label,
a.SV_Data_Table,
a.SV_Data_Keys
from t_gn_verification_setup_balcon a
where a.SV_Data_ProductId = '%s'
and a.SV_Data_Context=1
and a.SV_Data_Flags=1
order by a.SV_Data_Sort ASC ",
$this->ProductId );
 
$qry = $this->db->query( $sql );
if( $qry && $qry->num_rows() > 0)
foreach( $qry->result_record() as $row ) {
 
// ambil nilai value dari field tersebut ============================================
$row->add('SV_Data_Value', $this->_select_ver_value($out->field('CustomerId'), $row));
$row->add('SV_Data_Success', 0);
$row->add('SV_Data_Failed', 0);
 
// then will row data proces OK ============================================
$this->result_array[$this->CusId][$row->field('SV_Data_Id')]['field'] = $row->field('SV_Data_Field');
$this->result_array[$this->CusId][$row->field('SV_Data_Id')]['count'] = $row->field('SV_Data_Counter','intval');
$this->result_array[$this->CusId][$row->field('SV_Data_Id')]['point'] = $row->field('SV_Data_Point','intval');
$this->result_array[$this->CusId][$row->field('SV_Data_Id')]['label'] = $row->field('SV_Data_Label');
$this->result_array[$this->CusId][$row->field('SV_Data_Id')]['value'] = $row->field('SV_Data_Value');
$this->result_array[$this->CusId][$row->field('SV_Data_Id')]['success'] = $row->field('SV_Data_Success');
$this->result_array[$this->CusId][$row->field('SV_Data_Id')]['failed'] = $row->field('SV_Data_Failed');
 
// chek masing after verifikasi ============================================
// nilai Default JIka data Belum Pernah Verifikasi.
 
$this->result_array[$this->CusId][$row->field('SV_Data_Id')]['valid']['id'] = $row->field('SV_Data_Id');
$this->result_array[$this->CusId][$row->field('SV_Data_Id')]['valid']['field'] = $row->field('SV_Data_Field');
$this->result_array[$this->CusId][$row->field('SV_Data_Id')]['valid']['value'] = '';
$this->result_array[$this->CusId][$row->field('SV_Data_Id')]['valid']['status'] = 'N';
 
// jika data sudah terverfifikasi maka step berikunya
// dalah process maping saja OK .
// var_dump($row->field('SV_Data_Field'));
if( in_array($row->field('SV_Data_Field'), $this->VerDataStatus )) {
	// var_dump('masuk array');die;
$this->result_array[$this->CusId][$row->field('SV_Data_Id')]['valid']['id'] = $row->field('SV_Data_Id');
$this->result_array[$this->CusId][$row->field('SV_Data_Id')]['valid']['field'] = $row->field('SV_Data_Field');
$this->result_array[$this->CusId][$row->field('SV_Data_Id')]['valid']['value'] = $row->field('SV_Data_Value');
$this->result_array[$this->CusId][$row->field('SV_Data_Id')]['valid']['status'] = 'Y';
}
// jumlahkan point untuk semua keterangan benar.
$this->result_array[$this->CusId]['total'] += $row->field('SV_Data_Point','intval');
}
 
// ambil semua daftar kartu berdasarkan customerID
$this->kartu = array();
$sql = sprintf(" select * from t_gn_verification_setup_balcon a where a.SV_Data_Context = 2
and a.SV_Data_ProductId='%s'", $this->ProductId );
 
$qry = $this->db->query($sql);
if( $qry && $qry->num_rows() > 0 ){
$this->kartu = $qry->result_first_record();
if( is_object($this->kartu) ){
$this->result_array[$this->CusId]['kartu'] = $this->_select_ver_kartu( $this->CusId, $this->kartu );
}
}
 
// return data assoc . data tanmbaahn untuk process di sisi client
// yang di process oleh JS .
 
// jika data sudah Komplite maka ambil session yang Kompliteitu
$this->result_array[$this->CusId]['session'] = $this->SeqNumSessionId;
$this->result_array[$this->CusId]['custid'] = $this->CusId;
$this->result_array[$this->CusId]['verify'] = 0;
$this->result_array[$this->CusId]['process'] = 0;
 
return (array)$this->result_array;
 
} 


 

function _select_ver_identifycation( $out = null )
{
$this->result_array = array();
 
// ambil sequen data untuk sesion di history
// ketika verifikasi .
$this->CusId = $out->field('CustomerId');
$this->ProductId = $out->field('ProductId');
$this->CampaignId = $out->field('CampaignId');
 
// get ver by custid
$this->VerStatus = $this->_select_ver_status( $this->CusId );
if(!$this->SeqNumSessionId ){
$this->SeqNumSessionId = $this->M_SeqNumber->CreatSeqVerID('VER');
}
 
// on query data process
$sql = sprintf(" select
a.SV_Data_Id,
a.SV_Data_Field,
a.SV_Data_Counter,
a.SV_Data_Point,
a.SV_Data_Label,
a.SV_Data_Table,
a.SV_Data_Keys
from t_gn_verification_setup a
where a.SV_Data_ProductId = '%s'
and a.SV_Data_Context=1
and a.SV_Data_Flags=1
order by a.SV_Data_Sort ASC ",
$this->ProductId );
 
$qry = $this->db->query( $sql );
if( $qry && $qry->num_rows() > 0)
foreach( $qry->result_record() as $row ) {
 
// ambil nilai value dari field tersebut ============================================
$row->add('SV_Data_Value', $this->_select_ver_value($out->field('CustomerId'), $row));
$row->add('SV_Data_Success', 0);
$row->add('SV_Data_Failed', 0);
 
// then will row data proces OK ============================================
$this->result_array[$this->CusId][$row->field('SV_Data_Id')]['field'] = $row->field('SV_Data_Field');
$this->result_array[$this->CusId][$row->field('SV_Data_Id')]['count'] = $row->field('SV_Data_Counter','intval');
$this->result_array[$this->CusId][$row->field('SV_Data_Id')]['point'] = $row->field('SV_Data_Point','intval');
$this->result_array[$this->CusId][$row->field('SV_Data_Id')]['label'] = $row->field('SV_Data_Label');
$this->result_array[$this->CusId][$row->field('SV_Data_Id')]['value'] = $row->field('SV_Data_Value');
$this->result_array[$this->CusId][$row->field('SV_Data_Id')]['success'] = $row->field('SV_Data_Success');
$this->result_array[$this->CusId][$row->field('SV_Data_Id')]['failed'] = $row->field('SV_Data_Failed');
 
// chek masing after verifikasi ============================================
// nilai Default JIka data Belum Pernah Verifikasi.
 
$this->result_array[$this->CusId][$row->field('SV_Data_Id')]['valid']['id'] = $row->field('SV_Data_Id');
$this->result_array[$this->CusId][$row->field('SV_Data_Id')]['valid']['field'] = $row->field('SV_Data_Field');
$this->result_array[$this->CusId][$row->field('SV_Data_Id')]['valid']['value'] = '';
$this->result_array[$this->CusId][$row->field('SV_Data_Id')]['valid']['status'] = 'N';
 
// jika data sudah terverfifikasi maka step berikunya
// dalah process maping saja OK .
if( in_array($row->field('SV_Data_Field'), $this->VerDataStatus )) {
$this->result_array[$this->CusId][$row->field('SV_Data_Id')]['valid']['id'] = $row->field('SV_Data_Id');
$this->result_array[$this->CusId][$row->field('SV_Data_Id')]['valid']['field'] = $row->field('SV_Data_Field');
$this->result_array[$this->CusId][$row->field('SV_Data_Id')]['valid']['value'] = $row->field('SV_Data_Value');
$this->result_array[$this->CusId][$row->field('SV_Data_Id')]['valid']['status'] = 'Y';
}
// jumlahkan point untuk semua keterangan benar.
$this->result_array[$this->CusId]['total'] += $row->field('SV_Data_Point','intval');
}
 
// ambil semua daftar kartu berdasarkan customerID
$this->kartu = array();
$sql = sprintf(" select * from t_gn_verification_setup a where a.SV_Data_Context = 2
and a.SV_Data_ProductId='%s'", $this->ProductId );
 
$qry = $this->db->query($sql);
if( $qry && $qry->num_rows() > 0 ){
$this->kartu = $qry->result_first_record();
if( is_object($this->kartu) ){
$this->result_array[$this->CusId]['kartu'] = $this->_select_ver_kartu( $this->CusId, $this->kartu );
}
}
 
// return data assoc . data tanmbaahn untuk process di sisi client
// yang di process oleh JS .
 
// jika data sudah Komplite maka ambil session yang Kompliteitu
$this->result_array[$this->CusId]['session'] = $this->SeqNumSessionId;
$this->result_array[$this->CusId]['custid'] = $this->CusId;
$this->result_array[$this->CusId]['verify'] = 0;
$this->result_array[$this->CusId]['process'] = 0;
 
return (array)$this->result_array;
 
} 


function _select_ver_identifycation_pctd( $out = null )
{
$this->result_array = array();
 
// ambil sequen data untuk sesion di history
// ketika verifikasi .
$this->CusId = $out->field('CustomerId');
$this->ProductId = $out->field('ProductId');
$this->CampaignId = $out->field('CampaignId');
 
// get ver by custid
$this->VerStatus = $this->_select_ver_status( $this->CusId );
if(!$this->SeqNumSessionId ){
$this->SeqNumSessionId = $this->M_SeqNumber->CreatSeqVerID('VER');
}
 
// on query data process
$sql = sprintf(" select
a.SV_Data_Id,
a.SV_Data_Field,
a.SV_Data_Counter,
a.SV_Data_Point,
a.SV_Data_Label,
a.SV_Data_Table,
a.SV_Data_Keys
from t_gn_verification_setup_pctd a
where a.SV_Data_ProductId = '%s'
and a.SV_Data_Context=1
and a.SV_Data_Flags=1
order by a.SV_Data_Sort ASC ",
$this->ProductId );
 
$qry = $this->db->query( $sql );
if( $qry && $qry->num_rows() > 0)
foreach( $qry->result_record() as $row ) {
 
// ambil nilai value dari field tersebut ============================================
$row->add('SV_Data_Value', $this->_select_ver_value($out->field('CustomerId'), $row));
$row->add('SV_Data_Success', 0);
$row->add('SV_Data_Failed', 0);
 
// then will row data proces OK ============================================
$this->result_array[$this->CusId][$row->field('SV_Data_Id')]['field'] = $row->field('SV_Data_Field');
$this->result_array[$this->CusId][$row->field('SV_Data_Id')]['count'] = $row->field('SV_Data_Counter','intval');
$this->result_array[$this->CusId][$row->field('SV_Data_Id')]['point'] = $row->field('SV_Data_Point','intval');
$this->result_array[$this->CusId][$row->field('SV_Data_Id')]['label'] = $row->field('SV_Data_Label');
$this->result_array[$this->CusId][$row->field('SV_Data_Id')]['value'] = $row->field('SV_Data_Value');
$this->result_array[$this->CusId][$row->field('SV_Data_Id')]['success'] = $row->field('SV_Data_Success');
$this->result_array[$this->CusId][$row->field('SV_Data_Id')]['failed'] = $row->field('SV_Data_Failed');
 
// chek masing after verifikasi ============================================
// nilai Default JIka data Belum Pernah Verifikasi.
 
$this->result_array[$this->CusId][$row->field('SV_Data_Id')]['valid']['id'] = $row->field('SV_Data_Id');
$this->result_array[$this->CusId][$row->field('SV_Data_Id')]['valid']['field'] = $row->field('SV_Data_Field');
$this->result_array[$this->CusId][$row->field('SV_Data_Id')]['valid']['value'] = '';
$this->result_array[$this->CusId][$row->field('SV_Data_Id')]['valid']['status'] = 'N';
 
// jika data sudah terverfifikasi maka step berikunya
// dalah process maping saja OK .
if( in_array($row->field('SV_Data_Field'), $this->VerDataStatus )) {
$this->result_array[$this->CusId][$row->field('SV_Data_Id')]['valid']['id'] = $row->field('SV_Data_Id');
$this->result_array[$this->CusId][$row->field('SV_Data_Id')]['valid']['field'] = $row->field('SV_Data_Field');
$this->result_array[$this->CusId][$row->field('SV_Data_Id')]['valid']['value'] = $row->field('SV_Data_Value');
$this->result_array[$this->CusId][$row->field('SV_Data_Id')]['valid']['status'] = 'Y';
}
// jumlahkan point untuk semua keterangan benar.
$this->result_array[$this->CusId]['total'] += $row->field('SV_Data_Point','intval');
}
 
// ambil semua daftar kartu berdasarkan customerID
$this->kartu = array();
$sql = sprintf(" select * from t_gn_verification_setup_pctd a where a.SV_Data_Context = 2
and a.SV_Data_ProductId='%s'", $this->ProductId );
 
$qry = $this->db->query($sql);
if( $qry && $qry->num_rows() > 0 ){
$this->kartu = $qry->result_first_record();
if( is_object($this->kartu) ){
$this->result_array[$this->CusId]['kartu'] = $this->_select_ver_kartu( $this->CusId, $this->kartu );
}
}
 
// return data assoc . data tanmbaahn untuk process di sisi client
// yang di process oleh JS .
 
// jika data sudah Komplite maka ambil session yang Kompliteitu
$this->result_array[$this->CusId]['session'] = $this->SeqNumSessionId;
$this->result_array[$this->CusId]['custid'] = $this->CusId;
$this->result_array[$this->CusId]['verify'] = 0;
$this->result_array[$this->CusId]['process'] = 0;
 
return (array)$this->result_array;
 
} 


 
/**
 * [RouteForm description]
 * get data post and route form
 */
 function _select_ver_validation( $out  = null )
{
 
// reset select akan saya catat jika benar ataupun salah 	
	$this->db->reset_select();
	$this->db->select('count(*) as total', false );
	$this->db->from('t_gn_customer_verification');
	$this->db->where($out->field('field'), $out->field('value'));
 
	$qry = $this->db->get();
	if( $qry && ($row = $qry->result_first_record() ) ){
		// data field object rows 
		if( $row->field('total') ) {
			// jika verifikasi bernilai salah 
			$this->CallbackMsg = array( 'success' => 1, 
										'process' => array( 'id' 	=> $out->field('id'),
															'field' => $out->field('field'),
															'value' => $out->field('value')) );
			return (array)$this->CallbackMsg;												
		}	
	}
 
	// jika verifikasi bernilai salah 
	$this->CallbackMsg = array( 'success' => 0, 
								'process' => array( 'id' 	=> $out->field('id'),
													'field' => $out->field('field'),
													'value' => $out->field('value')) );
	return $this->CallbackMsg;					
}
 
/**
 * [RouteForm description]
 * get data post and route form
 */
function _submit_kartu_loger_verification( $out = null ){
 $cok = CK();
//  var_dump($cok);
//  die;
 // push data dari session 	
 $out->add('VH_Data_CreatorId', $cok->field('UserId','SetCapital'));
 $out->add('VH_Data_CreatorKode', $cok->field('Username','SetCapital'));
 $out->add('VH_Data_CreateTs', date('Y-m-d H:i:s') );
 
 // then will push data with lop array 
 
 // will try of process 
 $this->db->reset_write();
 $this->result_array = $out->fetch_assoc();
 if( is_array( $this->result_array ) )
 foreach( $this->result_array as $field => $value ){
	$this->db->set($field, $value);
 }
 //$this->db->insert('t_gn_verification_history');
 //var_dump($this->db->last_query());
 // insert process OK 
 if( $this->db->insert('t_gn_verification_history') ){
 
	// jika status sama dengan satu maka update verifikasinya dengan 
	// menjadi Y 	
 
	$out->add('VH_Data_VerficationStatus', 'N');
	if( $out->field('VH_Data_VerStatus') ) {
		$out->add('VH_Data_VerficationStatus', 'Y');
	}
 
	//kemudian update data pada table verifikasi.
 
	$this->db->reset_write();
	$this->db->set('CV_Data_VerficationStatus', $out->field('VH_Data_VerficationStatus'));
	$this->db->set('CV_Data_VerificationCreator', $out->field('VH_Data_CreatorId'));
	$this->db->set('CV_Data_VerficationDateTs', $out->field('VH_Data_CreateTs'));
	$this->db->where('CV_Data_Id', $out->field('VH_Data_VerId'));
	$this->db->where('CV_Data_CustId', $out->field('VH_Data_CustId'));
	$this->db->update('t_gn_customer_verification');
 
	// stop disini untuk loger kartu. 
	return true;
 }
 return false;
}
 
 
 
/**
 * [RouteForm description]
 * get data post and route form
 */
function _submit_master_loger_verification( $out = null ){
 $cok = CK();
 
 // push data dari session 	
 $out->add('VH_Data_CreatorId', $cok->field('UserId','SetCapital'));
 $out->add('VH_Data_CreatorKode', $cok->field('Username','SetCapital'));
 $out->add('VH_Data_CreateTs', date('Y-m-d H:i:s') );
 
 // then will push data with lop array 
//  var_dump($out);

//  die;
 // will try of process 
 $this->db->reset_write();
 
 $this->result_array = $out->fetch_assoc();
 if( is_array( $this->result_array ) )
 foreach( $this->result_array as $field => $value ){
	$this->db->set($field, $value);
 }
 // insert process OK 
 if( $this->db->insert('t_gn_verification_history') ){
	 return true;
 }
 return false;
}
 
/**
 * [RouteForm description]
 * get data post and route form
 */ 
 function _submit_session_loger_verification( $out = null)
{
 // reset cache 	
	$this->db->reset_write(); 
// update field berikut ini 	
	$this->db->set('VS_SessionId', $out->field('VS_SessionId') );
	$this->db->set('VS_CustId', $out->field('VS_CustId') );
	$this->db->set('VS_Status', $out->field('VS_Status'));
 
	// jika duplicate 
	$this->db->duplicate('VS_SessionId', $out->field('VS_SessionId'));
	$this->db->duplicate('VS_Status', $out->field('VS_Status'));
	if( $this->db->insert_on_duplicate('t_gn_verification_session') ){
		// verifikasi data master selesai update di table t_gn_master menjadi  = Y 
		$this->db->reset_write();
		$this->db->set('DM_VerificationStatus', 'Y');
		$this->db->where('DM_Id', $out->field('VS_CustId'));
		$this->db->update('t_gn_customer_master');
	}
// return callback to client Site JSON.
   return true;
 
}
 
/**
 * [RouteForm description]
 * get data post and route form
 */
function _select_call_back_process( $function = null ){
	if( !is_null($function ) ){
		return call_user_func('Objective', $this->CallbackMsg);
	}
	return (array)$this->CallbackMsg;
}
function pencarian_programdetail($ProgramId)
	{
		// SELECT * FROM t_lk_program_detail r
		// WHERE r.PRD_Data_Id=''

		$this->db->reset_select();
		$this->db->select('PRD_Data_Id,PRD_Data_Tenor');
		$this->db->from('t_lk_program_detail');
		$this->db->where('PRD_Data_Id', $ProgramId);

		$qry = $this->db->get();
		foreach ($qry->result_assoc() as $row) {
			return $row;
		}
	}
/**
 * [RouteForm description]
 * get data post and route form
 */ 
}

<?php 
/*
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
 
class M_KodePos extends EUI_Model  {

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
	$this->dataURI = UR();
}
/**
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
function _select_count_kode_pos( $URL = null ){
  
 // reset select of cahce 
 $result_num = 0;
 $this->db->reset_select();
 // get seleect query data 
 $this->db->select("count(ZipId) as total", false);
 $this->db->from("t_lk_zip a");
 $this->db->join('t_lk_province b','a.ZipProvinceId=b.ProvinceId', 'LEFT');
 
 // if have filter "KDP_Provinsi"
 if( $URL->dataURI->find_value('KDP_Provinsi') ){
	$this->db->like('b.Province', $URL->dataURI->field('KDP_Provinsi'));
 }
 
 // if have filter "KDP_Kabupaten"
 if( $URL->dataURI->find_value('KDP_Kabupaten') ){
	$this->db->like('a.ZipKotaKab', $URL->dataURI->field('KDP_Kabupaten'));
 }
 
 // if have filter "KDP_Kecamatan"
 if( $URL->dataURI->find_value('KDP_Kecamatan') ){
	$this->db->like('a.ZipKecamatan', $URL->dataURI->field('KDP_Kecamatan'));
 }
 
 // if have filter "KDP_Kelurahan"
 if( $URL->dataURI->find_value('KDP_Kelurahan') ){
	$this->db->like('a.ZipKelurahan', $URL->dataURI->field('KDP_Kelurahan'));
 }
 
 //if have filter "KDP_ZipKode"
 if( $URL->dataURI->find_value('KDP_ZipKode') ){
	$this->db->like('a.ZipCode', $URL->dataURI->field('KDP_ZipKode'));
 }
 
 
// get my source   
// $this->db->print_out(); 
 $qry = $this->db->get();
 if( $qry && $qry->num_rows()>0 ){
	 $result_num = $qry->result_singgle_value(); 
 }
 // will return this ;
 return $result_num;
 
 
}
/**
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
 
function _select_page_kode_pos( $URL = null ){
	
// define setup	
 $result_array = array();
 
 // reset select of cahce 
 $this->db->reset_select();
 
 // get seleect query data 
 $this->db->select("
		a.ZipCode as KDP_ZipKode,
		a.ZipKelurahan as KDP_Kelurahan,
		a.ZipKecamatan as KDP_Kecamatan,
		a.ZipKotaKab as KDP_Kabupaten,
		a.ZipDT as KDP_KabuptenType,
		b.Province as KDP_Provinsi ", 
		false);

 $this->db->from("t_lk_zip a");
 $this->db->join('t_lk_province b','a.ZipProvinceId=b.ProvinceId', 'LEFT');
 
 // if have filter "KDP_Provinsi"
 if( $URL->dataURI->find_value('KDP_Provinsi') ){
	$this->db->like('b.Province', $URL->dataURI->field('KDP_Provinsi'));
 }
 
 // if have filter "KDP_Kabupaten"
 if( $URL->dataURI->find_value('KDP_Kabupaten') ){
	$this->db->like('a.ZipKotaKab', $URL->dataURI->field('KDP_Kabupaten'));
 }
 
 // if have filter "KDP_Kecamatan"
 if( $URL->dataURI->find_value('KDP_Kecamatan') ){
	$this->db->like('a.ZipKecamatan', $URL->dataURI->field('KDP_Kecamatan'));
 }
 
 // if have filter "KDP_Kelurahan"
 if( $URL->dataURI->find_value('KDP_Kelurahan') ){
	$this->db->like('a.ZipKelurahan', $URL->dataURI->field('KDP_Kelurahan'));
 }
 
 //if have filter "KDP_ZipKode"
 if( $URL->dataURI->find_value('KDP_ZipKode') ){
	$this->db->like('a.ZipCode', $URL->dataURI->field('KDP_ZipKode'));
 }
 
// get my order style 
 if( $URL->dataURI->find_value('orderby') ){
	$this->db->order_by( $URL->dataURI->field('orderby'), $URL->dataURI->field('type'));
 } else {
	$this->db->order_by("a.ZipId", "ASC");
 }

// set limit data process on here . 
 $this->db->limit( $URL->per_page, $URL->start_page); 
 
// get my source  
// $this->db->print_out(); 
 
 $qry = $this->db->get();
 if( $qry && $qry->num_rows()>0 ){
	 $result_array = (array)$qry->result_assoc(); 
 }
 // will return this ;
 return $result_array;
} 

/**
 * [Recovery data failed upload HSBC TAMAN SARI]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
 
}

?>

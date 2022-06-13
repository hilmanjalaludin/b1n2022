<?php 
class DataVerification extends EUI_Controller{
	
/**
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */	
	function __construct(){
		parent::__construct();
		display(0);
		$this->load->model(array(base_class_model($this)));
	}

/**
  * @param  [type] $CustomerId [description]
  * @return [type] $CampaignId [description]
  */
function VerificationIdentify(){
	$this->msg = Singgleton($this)->_select_ver_identifycation( UR() );
	if( is_array( $this->msg ) ){
		printf('%s', json_encode($this->msg) );
		return false; 
	} 
}

function VerificationIdentify_pctd(){
	$this->msg = Singgleton($this)->_select_ver_identifycation_pctd( UR() );
	if( is_array( $this->msg ) ){
		printf('%s', json_encode($this->msg) );
		return false; 
	} 
}


function VerificationIdentify_balcon(){
  $this->msg = Singgleton($this)->_select_ver_identifycation_balcon( UR() );
  // var_dump($this->msg);
  // die;
	if( is_array( $this->msg ) ){
		printf('%s', json_encode($this->msg) );
		return false; 
	} 
}	


/**
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 function VerificationKartu()
{
	
  // get UR process on selected verification --
  $out = UR();

  // data callback json 
  $this->msg = array('success' => 0, 'process' => array( 'id' 	 => $out->field('id'),
														 'field' => $out->field('field'),
														 'value' => $out->field('value') ));
  if( is_object( $out )) {
	// then will get data proces OK  
	$this->msg = Singgleton($this)->_select_ver_validation( $out );
	printf("%s", json_encode($this->msg));
	return false;
 }
 
 // return callback server 
  printf("%s", json_encode( $this->msg ) );
  return false;
 
}

/**
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
function DataKartuLoger(){
 // get UR process on selected verification --
  $out = UR();
  // var_dump('berhasil get');
  // die;
  
  $this->msg = array('success' => 0 );
  if( is_object( $out )) {
  // then will get data proces OK  
  $condition = Singgleton($this)->_submit_kartu_loger_verification( $out );
  // var_dump($this->db->last_query(),'okokokokokokok');
  // die;
	if( $condition ){
		$this->msg = array('success' => 1 );
	}
	
 }
 // return client 
 
 printf("%s", json_encode( $this->msg ));
 return false;
	
}
/**
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
function DataMasterLoger(){
 // get UR process on selected verification --
  $out = UR();
  // var_dump($out);
  // die;
  
  $this->msg = array('success' => 0 );
  if( is_object( $out )) {
	// then will get data proces OK  
	$condition = Singgleton($this)->_submit_master_loger_verification( $out );
	if( $condition ){
		$this->msg = array('success' => 1 );
	}
	
 }
 // return client 
 
 printf("%s", json_encode( $this->msg ));
 return false;
	
}
/**
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */

function DataSessionLoger(){
	// get UR process on selected verification --
  $out = UR();
  
  $this->msg = array('success' => 0 );
  if( is_object( $out )) {
	// then will get data proces OK  
	$condition = Singgleton($this)->_submit_session_loger_verification( $out );
	if( $condition ){
		$this->msg = array('success' => 1 );
	}
	
 }
 // return client 
 
 printf("%s", json_encode( $this->msg ));
 return false;
}

function pencarian_programdetail()
{
  // echo json_encode(array('status' => 1));
  // die;
  $ProgramId = $this->URI->_get_post('ProgramId');
  // var_dump($ProgramId);


  // $pencarian = $this->M_ProductLookup->AffinityCardLevel($gd->get_value("id"));
  $pencarian = Singgleton($this)->pencarian_programdetail($ProgramId);
  echo json_encode(array('status' => $pencarian));
}
function pencarian_membersince()
  {
    // echo json_encode(array('status' => 1));
    // die;
    $ProgramId = $this->URI->_get_post('ProgramId');
    // var_dump($ProgramId);


    // $pencarian = $this->M_ProductLookup->AffinityCardLevel($gd->get_value("id"));
    $pencarian = Singgleton($this)->pencarian_membersinceDb($ProgramId);
    echo json_encode(array('status' => $pencarian));
  }

// END DATA OF 
 
}

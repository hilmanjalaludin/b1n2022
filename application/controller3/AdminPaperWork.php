<?php 
/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 
class AdminPaperWork extends EUI_Controller{
  public $CustomerId;

  
/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 
function __construct(){
  parent::__construct();
  $this->load->model(array(base_class_model($this)));
}

/*
  * [@launcher data view form admin followup]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
 
 function index($CustomerId = "", $SV_Cust_Id="")
{
  $CustomerId =  UR()->field('CustomerId');
  $SV_Cust_Id = UR()->field('CustomerId');
  $row = Singgleton($this)->_select_admin_paper_work( UR()->field('CustomerId'));
  $get = Singgleton($this)->_select_row_layout_data($SV_Cust_Id);
  $data = Singgleton($this)->_select_kurir();
  $area = Singgleton($this)->_select_row_coverage_data($SV_Cust_Id);
  $row_area = Singgleton($this)->_select_coverage();
  $kores = Singgleton($this)-> _select_kores_id();
  $getCust = Singgleton($this)->_get_customer(  $CustomerId);
  //debug($row);
  $this->load->form('ADM/paper_work_index', array(
    'row' => $row,
    'get' => $get,
    'data' => $data,
    'getCust' => $getCust,
    'area' => $area,
    'row_area' => $row_area,
    'kores' => $kores
  ));
}

/*
  * [@submit form data verifikation by admin ]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
function Submit(){
  
 $this->out = UR();
 $this->msg = array('success' => 0 );
 
 if( !$this->out->find_value('SV_Cust_Id') ) {
  printf("%s", json_encode($this->msg) );
  return false;
 }
 
 $this->cond = Singgleton($this)->_submit_admin_paper_work( $this->out );
 if( $this->cond ){
  $this->msg = array('success' => 1); 
 }

 // return client process data OK 
 printf("%s", json_encode($this->msg) );
 return false;
  
} 

/*
  * [@submit form data verifikation by admin ]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
function Cancel(){
  
 $this->out = UR();
 $this->msg = array('success' => 0 );
 
 if( !$this->out->find_value('SV_Cust_Id') ) {
  printf("%s", json_encode($this->msg) );
  return false;
 }
 
 $this->cond = Singgleton($this)->_cancel_admin_paper_work( $this->out );
 if( $this->cond ){
  $this->msg = array('success' => 1); 
 }
 // return client process data OK 
 printf("%s", json_encode($this->msg) );
 return false;
  
} 
// end class object data process 
  
}

?>
<?php
/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */

class Editfrm extends EUI_Controller
{
  /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */

  function __construct()
  {
    parent::__construct();
    display(0);
    $this->load->model(array(base_class_model($this)));
    $this->load->helper(array('EUI_Object'));
  }
  
  function index()
  {

    $this->callBackConn = Singgleton($this);
    if (!is_object($this->callBackConn)) {
      exit(0);
    }

    // sent view data process on this OK 
    $this->load->view('src_editfrm/view_tf_fixid_index', array());
  }

  function Content()
  {
    if ($this->EUI_Session->_have_get_session('UserId')) {
        $EUI['page'] = $this->{base_class_model($this)}->_get_resource_query(); // load content data by pages 
        $EUI['num']  = $this->{base_class_model($this)}->_get_page_number();     // load content data by pages 

        $this->load->view('set_TlkProgram/page_data', $EUI);
    }
  }

  function PageCm()
  {
      
    $this->start_page = 0;
    $this->per_page   = 10;

    // get data process URI 
    $this->dataURI = UR();
    $this->dataOBJ = Singgleton($this);

    // define data array .

    $this->arr_result = array();

    //  customize page data ------------------------ 
    if ($this->dataURI->field('cm_record_page')) {
      $this->per_page = $this->dataURI->field('cm_record_page');
    }

    // get post data pager result array.
    if ($this->post_page) {
      $this->start_page = (($this->post_page - 1) * $this->per_page);
    } else {
      $this->start_page = 0;
    }

    // then result data ---------------------------------
    $this->post_page  = $this->dataURI->field('page', 'intval');
    // $this->arr_result = $this->dataOBJ->_select_page_cm($this->dataURI, null, $this);
    $this->arr_result = $this->dataOBJ->_select_page_cm($this -> URI -> _get_post('cust_no'), $this->dataURI, null, $this);

    // untuk process lebih cepat "more then faster process query data" 
    // $this->tot_result  = $this->dataOBJ->_select_count_cm($this->dataURI);
    $this->tot_result  = $this->dataOBJ->_select_count_cm($this -> URI -> _get_post('cust_no'), $this->dataURI);

    // counter off get pagging data cell attribute.
    $this->page_counter = ceil($this->tot_result / $this->per_page);
    // print_r('test data',$this->arr_result);
    // print_r('test data',$this->tot_result);
    // print_r('test data',$this->page_counter);
    // set data view client porcess  
    $this->load->view("src_editfrm/view_tf_fixid_cm_page", array(
      'content_pages' => $this->arr_result,
      'total_records' => $this->tot_result,
      'total_pages'   => $this->page_counter,
      'select_pages'  => $this->post_page,
      'start_page'   => $this->start_page
    ));
  }

  function PageCv()
  {
    

    $this->start_page = 0;
    $this->per_page   = 10;

    // get data process URI 
    $this->dataURI = UR();
    $this->dataOBJ = Singgleton($this);

    // define data array .

    $this->arr_result = array();

    //  customize page data ------------------------ 
    if ($this->dataURI->field('cv_record_page')) {
      $this->per_page = $this->dataURI->field('cv_record_page');
    }

    // get post data pager result array.
    if ($this->post_page) {
      $this->start_page = (($this->post_page - 1) * $this->per_page);
    } else {
      $this->start_page = 0;
    }

    // then result data ---------------------------------
    $this->post_page  = $this->dataURI->field('page', 'intval');
    // $this->arr_result = $this->dataOBJ->_select_page_cv($this->dataURI, null, $this);
    $this->arr_result = $this->dataOBJ->_select_page_cv($this -> URI -> _get_post('cust_no_cv'), $this->dataURI, null, $this);
    
    // untuk process lebih cepat "more then faster process query data" 
    // $this->tot_result  = $this->dataOBJ->_select_count_cv($this->dataURI);
    $this->tot_result  = $this->dataOBJ->_select_count_cv($this -> URI -> _get_post('cust_no_cv'), $this->dataURI);
    
    // counter off get pagging data cell attribute.
    $this->page_counter = ceil($this->tot_result / $this->per_page);
    // print_r('test data',$this->arr_result);
    // print_r('test data',$this->tot_result);
    // print_r('test data',$this->page_counter);

    // set data view client porcess  
    $this->load->view("src_editfrm/view_tf_fixid_cv_page", array(
      'content_pages' => $this->arr_result,
      'total_records' => $this->tot_result,
      'total_pages'   => $this->page_counter,
      'select_pages'  => $this->post_page,
      'start_page'   => $this->start_page
    ));
  }

  function getCmDetail() {
    // echo "<pre>";
    // print_r($this->URI->_get_post);
    
    $detail = $this -> {base_class_model($this)} -> get_cm_detail($this->URI->_get_post('TX_Usg_Id'));
    echo json_encode(array('status' => 1, 'data' => $detail));
  }

  function updateCm() {
    // echo "<pre>";
    // print_r($this -> URI -> _get_post('seller_new'));
    // print_r($this -> URI -> _get_post('spv_new'));
    // $update = $this -> {base_class_model($this)} -> update_cm($this->URI,$this -> URI -> _get_post('spv_new'),$this -> URI -> _get_post('seller_new'));
    $update = $this -> {base_class_model($this)} -> update_cm($this->URI);
    if($update == true) {
      echo json_encode(array('status' => 1));
    } else {
      echo json_encode(array('status' => 0));
    }
  }

  // assignment
  function getAgent() {
    $agent = $this -> {base_class_model($this)} -> _get_agent($this -> URI);
    echo json_encode(array('status' => 1, 'data' => $agent));
  }

  function updateCmAssignment() {
    $update = $this -> {base_class_model($this)} -> update_cm_assignment($this -> URI);
    if($update == true) {
      echo json_encode(array('status' => 1));
    } else {
      echo json_encode(array('status' => 0));
    }
  }

  function getCvDetail() {
    $detail = $this -> {base_class_model($this)} -> get_cv_detail($this -> URI -> _get_post('CV_Data_Id'));
    echo json_encode(array('status' => 1, 'data' => $detail));
  }

  function updateCv() {
    $update = $this -> {base_class_model($this)} -> update_cv($this -> URI);
    if($update == true) {
      echo json_encode(array('status' => 1));
    } else {
      echo json_encode(array('status' => 0));
    }
  }
  // ============================= END CLASS ===================================
}

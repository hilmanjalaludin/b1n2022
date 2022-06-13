

    <?php
    Class WallBoard Extends EUI_Controller {
     
    public function WallBoard() {
    header('Access-Control-Allow-Origin: *');
    parent::__construct();
    $this -> load -> model(array(base_class_model($this)));
    }
     
    public function index() {
    echo json_encode(array('success', 1));
    }
     
    public function TopAgent() {
    // $data['cip'] = $this -> {base_class_model($this)} -> _get_top_agent_cip();
    $data['pil'] = $this -> {base_class_model($this)} -> _get_top_agent_pil();
    $data['spv'] = $this -> {base_class_model($this)} -> _get_top_spv_pil();
    // $data['pil_top'] = $this -> {base_class_model($this)} -> _get_top_agent_pil_top();
    $data['spv_loan'] = $this -> {base_class_model($this)} ->_spv_amount_pil();
    // $data['spv_loan_top'] = $this -> {base_class_model($this)} ->_spv_amount_pil_top();
    // $data['spv_cip'] = $this -> {base_class_model($this)} ->_spv_amount_cip();
    // $data['spv_loan2'] = $this -> {base_class_model($this)} ->_spv_amount2('pil');
    // $data['spv_cip2'] = $this -> {base_class_model($this)} ->_spv_amount2('cip');
    // echo "<pre>";
    // var_dump($data);die();
     
    echo json_encode(array('success' => 1, 'data' => $data));
    }
     
    public function TopSpv() {
    // $data['get_bestbill_rumus'] = $this -> {base_class_model($this)} -> _get_bestbill_rumus();
    // $data['top_spv_cip'] = $this -> {base_class_model($this)} -> _get_spv_cip();
    $data['top_spv_pil'] = $this -> {base_class_model($this)} -> _get_spv_pil();
    $data['top_agent_pil'] = $this -> {base_class_model($this)} -> _get_agent_pil();
    // $data['get_daily_today_basebill'] = $this -> {base_class_model($this)} -> _get_daily_today_basebill();
    // $data['top_spv_pil_top'] = $this -> {base_class_model($this)} -> _get_spv_pil_top();
    // $data['top_spv_pil_top_up_count'] = $this -> {base_class_model($this)} -> _get_spv_pil_top_up_count();
    // echo "<pre>";
    // var_dump($data);die();
    echo json_encode(array('success' => 1, 'data' => $data));
    }
     
    public function Modiv(){
     
    $data['get_modif'] = $this -> {base_class_model($this)} -> _get_modif_cip();
    echo json_encode(array('success' => 1, 'data' => $data));
     
    }
     
    public function get_daily_today() {
     
    // $data['get_daily_today_cip'] = $this -> {base_class_model($this)} -> _get_daily_today_cip();
    // $data['get_daily_today_basebill'] = $this -> {base_class_model($this)} -> _get_daily_today_basebill();
    $data['get_daily_today_pil'] = $this -> {base_class_model($this)} -> _get_daily_today_pil();
     
    // $data['get_daily_today_pil_topcount'] = $this -> {base_class_model($this)} -> _get_daily_today_pil_topcount();
    // $data['get_daily_today_pi_top'] = $this -> {base_class_model($this)} ->_pil_count();
    // $data['get_mtd'] = $this -> {base_class_model($this)} -> _get_mtd();
    // $data['get_month_target'] = $this -> {base_class_model($this)} -> _get_month_target();
     
    // echo "<pre>";
    // var_dump($data);die();
    echo json_encode(array('success' => 1, 'data' => $data));
    }
     
    }
    ?> 


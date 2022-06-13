<?php
/*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
class M_Editfrm extends EUI_Model
{

  /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  private static $Instance = null;
  private static $arr_usr_level = null;

  /*
  * [Recovery data failed upload HSBC TAMAN SARI]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */

  public static function &Instance()
  {
    if (is_null(self::$Instance)) {
      self::$Instance = new self();
    }
    return self::$Instance;
  }

  function _select_page_cm($custno = null, $out = null, $field = null, $std = null)
  {
    // tankap semua varibale dari process search
    $this->out = $out;
    $this->cok = CK();
    $this->cof = CF();
    // if ($this->out->find_value('cust_no')) {
    $result_array = array();
    $this->db->reset_select();
  
    $this->db->select('u.TX_Usg_Id,c.CallReasonDesc,u.TX_Usg_SpvKode,u.TX_Usg_SellerKode,a.*, b.CampaignDesc, b.CampaignStatusFlag');
    $this->db->from("t_gn_customer_master a");
    $this->db->join("t_gn_frm_usage u", " a.DM_Id=u.TX_Usg_CustId", "INNER");
    $this->db->join("t_gn_campaign b", " b.CampaignId=a.DM_CampaignId", "INNER");
    $this->db->join("t_lk_callreason c", " c.CallReasonId=a.DM_CallReasonId", "INNER");
    $this->db->where('a.DM_LastReasonId', 44);
    $this->db->where('(u.TX_Usg_SellerKode IS NULL OR u.TX_Usg_SpvKode IS NULL OR u.TX_Usg_SellerKode ="" OR  u.TX_Usg_SpvKode ="" OR u.TX_Usg_SellerKode ="0" OR u.TX_Usg_SpvKode ="0") ');
    // filter data yang pertama by cust_no
   
   
    if (is_object($std)) {
    if ($std->post_page) {
        $std->start_page = (($std->post_page - 1) * $std->per_page);
    } else {
        $std->start_page = 0;
    }
    // set on limite data
    $this->db->limit($std->per_page, $std->start_page);
    }
    // cetak untuk debugging saja .
    $qry = $this->db->get();
    // echo "<pre>";
    // print_r($this->db->last_query());
    // jika terjadi error maka tampilkan errornya
    if (!$qry) {
    debug($this->db->_error_message());
    }
    // ambil query dataprocess result OK
    if ($qry && $qry->num_rows() > 0) {
    $result_array = array();
    foreach ((array)$qry->result_assoc() as $item) {
        $_datas['TX_Usg_Id'] = $item['TX_Usg_Id'];
        $_datas['DM_Id'] = $item['DM_Id'];
        $_datas['DM_Custno'] = $item['DM_Custno'];
        $_datas['DM_FirstName'] = $item['DM_FirstName'];
        $_datas['TX_Usg_SpvKode'] = $item['TX_Usg_SpvKode'];
        $_datas['TX_Usg_SellerKode'] = $item['TX_Usg_SellerKode'];
        $_datas['CallReasonDesc'] = $item['CallReasonDesc'];
          $_datas['DM_DataFixID'] = $item['DM_DataFixID'];
        array_push($result_array, $_datas);
    }
    // $result_array2 = (array)$qry->result_assoc();
    }
    // echo "<pre>";
    // print_r($result_array);
    return (array)$result_array;
  }

  function _select_count_cm($custno = null, $out = null)
  {
    // tankap semua varibale dari process search 
    $this->out = $out;
    $this->cok = CK();
    $this->cof = CF();

    $result_total = 0;
    // if ($this->out->find_value('cust_no')) {
      $this->db->reset_select();
      $this->db->select("count(u.TX_Usg_Id) as total", FALSE);
      $this->db->from("t_gn_customer_master a");
      $this->db->join("t_gn_frm_usage u", " a.DM_Id=u.TX_Usg_CustId", "INNER");
      $this->db->join("t_gn_campaign b", " b.CampaignId=a.DM_CampaignId", "INNER");
      $this->db->join("t_lk_callreason c", " c.CallReasonId=a.DM_CallReasonId", "INNER");
      $this->db->where('a.DM_LastReasonId', 44);
      $this->db->where('(u.TX_Usg_SellerKode IS NULL OR u.TX_Usg_SpvKode IS NULL OR u.TX_Usg_SellerKode ="" OR  u.TX_Usg_SpvKode ="" OR u.TX_Usg_SellerKode ="0" OR u.TX_Usg_SpvKode ="0" )');
      // filter data yang pertama by campaign 
      $this->db->like("a.DM_Custno", $custno);
      $qry = $this->db->get();
      // jika terjadi error maka tampilkan errornya 
      if (!$qry) {
        debug($this->db->_error_message());
      }
      // ambil query dataprocess result OK 
      if ($qry && $qry->num_rows() > 0) {
        $result_total = $qry->result_singgle_value();
      }
    
    return (int)$result_total;
  }

  function _select_page_cv($custno = null, $out = null, $field = null, $std = null)
  {
    // tankap semua varibale dari process search
    $this->out = $out;
    $this->cok = CK();
    $this->cof = CF();
    // if ($this->out->find_value('cust_no_cv')) {
    if($custno != null || $custno != '') {
      $result_array = array();
      $this->db->reset_select();
      $this->db->select('b.*, a.DM_FirstName, a.DM_CallReasonKode, c.CampaignDesc, c.CampaignStatusFlag');
      $this->db->from("t_gn_customer_verification b");
      $this->db->join("t_gn_customer_master a", " b.CV_Data_CustId=a.DM_Id", "INNER");
      $this->db->join("t_gn_campaign c", " b.CV_Data_Campaign_Id=c.CampaignId", "INNER");
      // filter data yang pertama by cust_no_cv
      $this->db->like("b.CV_Data_Custno", $custno);
      // $this->db->where_in("a.DM_CallReasonKode", $this->out->fields('customer_name_cv'));
      if ($this->out->find_value("group_by")) {
        $this->db->group_by($this->out->field("orderby"), $this->out->field("type"));
      } else {
        $this->db->group_by("b.CV_Data_Id,");
      }
      if ($this->out->find_value("orderby")) {
        $this->db->order_by($this->out->field("orderby"), $this->out->field("type"));
      } else {
        $this->db->order_by("b.CV_Data_Id", "DESC");
      }
      // query limit untuk page langsung di tuju ke query
      // selector saja , untuk performance data ketika
      // user melakukan select data .
      if (is_object($std)) {
        if ($std->post_page) {
          $std->start_page = (($std->post_page - 1) * $std->per_page);
        } else {
          $std->start_page = 0;
        }
        // set on limite data
        $this->db->limit($std->per_page, $std->start_page);
      }
      // cetak untuk debugging saja .
      $qry = $this->db->get();
      // var_dump($this->db->last_query());
      // jika terjadi error maka tampilkan errornya
      if (!$qry) {
        debug($this->db->_error_message());
      }
      // ambil query dataprocess result OK
      if ($qry && $qry->num_rows() > 0) {
        $result_array = array();
        foreach ((array)$qry->result_assoc() as $item) {
          $_datas['CV_Data_Id'] = $item['CV_Data_Id'];
          $_datas['CV_Data_CardType'] = $item['CV_Data_CardType'];
          $_datas['CV_Data_CustId'] = $item['CV_Data_CustId'];
          $_datas['CV_Data_Custno'] = $item['CV_Data_Custno'];
          $_datas['DM_FirstName'] = $item['DM_FirstName'];
          $_datas['CV_Data_Campaign_Id'] = $item['CV_Data_Campaign_Id'];
          $_datas['CampaignDesc'] = $item['CampaignDesc'];
          $_datas['DM_CallReasonKode'] = $item['DM_CallReasonKode'];
          if ($item['CampaignStatusFlag'] == 1) {
            $_datas['CampaignStatusFlag'] = "Active";
          } else {
            $_datas['CampaignStatusFlag'] = "Non Active";
          }
          array_push($result_array, $_datas);
        }
        // $result_array = (array)$qry->result_assoc();
      }
    } else {
      $result_array = array();
    }
    return (array)$result_array;
  }

  function _select_count_cv($custno = null, $out = null)
  {
    // tankap semua varibale dari process search 
    $this->out = $out;
    $this->cok = CK();
    $this->cof = CF();

    $result_total = 0;
    // if ($this->out->find_value('cust_no_cv')) {
    if($custno != null || $custno != '') {
      $this->db->reset_select();
      $this->db->select("count(b.CV_Data_Id) as total", FALSE);
      $this->db->from("t_gn_customer_master a");
      $this->db->join("t_gn_customer_verification b", " b.CV_Data_CustId=a.DM_Id", "INNER");
      // filter data yang pertama by customer_name 
      $this->db->like("b.CV_Data_Custno", $custno);
      $qry = $this->db->get();
      // jika terjadi error maka tampilkan errornya 
      if (!$qry) {
        debug($this->db->_error_message());
      }
      // ambil query dataprocess result OK 
      if ($qry && $qry->num_rows() > 0) {
        $result_total = $qry->result_singgle_value();
      }
    }
    return (int)$result_total;
  }

  function get_cm_detail($TX_Usg_Id = null) {
    $sql = "SELECT `u`.`TX_Usg_Id`, `c`.`CallReasonDesc`, `u`.`TX_Usg_SpvKode`, `u`.`TX_Usg_SellerKode`, `a`.*, `b`.`CampaignDesc`, `b`.`CampaignStatusFlag`
    FROM (`t_gn_customer_master` a)
    INNER JOIN `t_gn_frm_usage` u ON `a`.`DM_Id`=`u`.`TX_Usg_CustId`
    INNER JOIN `t_gn_campaign` b ON `b`.`CampaignId`=`a`.`DM_CampaignId`
    INNER JOIN `t_lk_callreason` c ON `c`.`CallReasonId`=`a`.`DM_CallReasonId`
     WHERE u.TX_Usg_Id = ".(int)$TX_Usg_Id;
    $data = $this->db->query($sql)->result_first_assoc();
    // print_r($this->db->last_query())."<br>";
    // print_r($data);
    return $data;
  }

  function update_cm($out = null)
  {
    
    // $spv = ($out->_get_post('spv_new') == '' || $out->_get_post('spv_new') == null) ? NULL ? $out->_get_post('spv_new');
    // $seller = ($out->_get_post('seller_new') == '' || $out->_get_post('seller_new') == null) ? NULL ? $out->_get_post('seller_new');
    $sqlCm = "UPDATE t_gn_frm_usage 
    SET TX_Usg_SpvKode = '" . $out->_get_post('spv_new') . "' 
        ,TX_Usg_SellerKode = '" .$out->_get_post('seller_new') . "' 
        WHERE TX_Usg_Id = " . (int)$out->_get_post('custid');
    $updateCm = $this->db->query($sqlCm);
    // print_r($this->db->last_query());

    if ($updateCm) {
      // $this->insert_log_change_campaign($out);
      return true;
    } else {
      return false;
    }
  }

  function get_cv_detail($cv_data_id)
  {
    // var_dump($cv_data_id);

    $sql = "SELECT * FROM t_gn_customer_verification WHERE CV_Data_Id = " . (int)$cv_data_id;
    $data = $this->db->query($sql)->result_first_assoc();
    return $data;
  }

  function update_cv($out = null)
  {
    $sqlCv = "UPDATE t_gn_customer_verification SET CV_Data_CustId = " . (int)$out->_get_post('custid_new_cv') . ", CV_Data_Campaign_Id = " . (int)$out->_get_post('campaign_new_cv') . " WHERE CV_Data_Id = " . (int)$out->_get_post('cv_dataid');
    $updateCv = $this->db->query($sqlCv);
    if ($updateCv) {
      // $this->insert_log_change_fixid($out);
      return true;
    } else {
      return false;
    }
  }

  function insert_log_change_fixid($data = null)
  {
    $this->db->reset_write();
    $this->db->set("custid_old", $data->_get_post('custid_old_cv'));
    $this->db->set("custid_new", $data->_get_post('custid_new_cv'));
    $this->db->set("campaign_old", $data->_get_post('campaign_old_cv'));
    $this->db->set("campaign_new", $data->_get_post('campaign_new_cv'));
    $this->db->set("by", _get_session('Username'));
    $this->db->insert("t_gn_log_change_fixid");
  }

  function insert_log_change_campaign($data)
  {
    $this->db->reset_write();
    $this->db->set("custid", $data->_get_post('custid'));
    $this->db->set("campaign_old", $data->_get_post('campaign_old'));
    $this->db->set("campaign_new", $data->_get_post('campaign_new'));
    $this->db->set("by", _get_session('Username'));
    $this->db->insert("t_gn_log_change_campaign");
  }

  // assignment
  function _get_agent($out = null) {
    $this->db->where('spv_id', $out -> _get_post('spv_id'));
    return $this->db->get('tms_agent')->result_array();
  }

  function update_cm_assignment($out = null) {
    $this->db->reset_write();
    $this->db->set("AssignSpv", $out->_get_post('spv_new'));
    $this->db->set("AssignSelerId", (int)$out->_get_post('seller_new'));
    $this->db->where('AssignCustId', (int)$out->_get_post('custid_assignment'));
    $updateCmassignment = $this->db->update("t_gn_assignment");
    if($updateCmassignment) {
      // $this->insert_log_change_assignment($out);
      return true;
    } else {
      return false;
    }
  }

  function insert_log_change_assignment($out = null) {
    $this->db->reset_write();
    $this->db->set("custid", $out->_get_post('custid_assignment'));
    $this->db->set("spv_old", $out->_get_post('spv_old'));
    $this->db->set("spv_new", $out->_get_post('spv_new'));
    $this->db->set("seller_old", $out->_get_post('seller_old'));
    $this->db->set("seller_new", $out->_get_post('seller_new'));
    $this->db->set("by", _get_session('Username'));
    $this->db->insert("t_gn_log_change_assignment");
  }
}

<?php

/**
 * [M_UserDistribusi :: class ]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */

class M_UserTransferCampaign extends EUI_Model
{
  var $totalProcessed = array();
  var $arr_kuota_user = array();

  /**
   * [Recovery data failed upload HSBC TAMAN SARI]
   * @param  [type] $CustomerId [description]
   * @return [type]             [description]
   */
  private static $Instance   = null;
  public static function &Instance()
  {
    if (is_null(self::$Instance)) {
      self::$Instance = new self();
    }
    return self::$Instance;
  }

  /**
   * [Recovery data failed upload HSBC TAMAN SARI]
   * @param  [type] $CustomerId [description]
   * @return [type]             [description]
   */
  public function __construct()
  {
    $this->load->model(array('M_MgtAssignment', 'M_SysUser'));
  }
  public function update_campaign($out = null)
  {
    $objAsg = &get_class_instance('M_MgtAssignment');
    $rowTC = $objAsg->_select_page_transfer_campaign($out, array('a.DM_Id'));
    // Get on selected grid ------------- 
    if ($out->get_value('transfer_campaign_user_action') == 2) {
      $arr_Asg = $out->get_array_value('DM_CampaignId');
      if (is_array($arr_Asg)) foreach ($arr_Asg as $k => $DM_CampaignId) {
        $rowTC[] = array('DM_Id' => $DM_CampaignId);
      }
    }
    if( is_array($rowTC) AND count($rowTC) == 0 ) {
      return FALSE;
    }
    $total_tc = & $out->get_value('transfer_campaign_user_quantity');
    $arr_data_avail = array_slice( $rowTC, 0, $total_tc);
    $successCustomer = 0;
    $failedCustomer = 0;
    $successCustomerVerif = 0;
    $failedCustomerVerif = 0;
    foreach($arr_data_avail as $item) {
      $update_customer = $this->update_customer($out, $item['DM_Id']);
      $update_customer_verif = $this->update_customer_verif($out, $item['DM_Id']);
      if($update_customer) {
        $successCustomer += 1;
      } else{
        $failedCustomer += 1;
      }

      if($update_customer_verif) {
        $successCustomerVerif += 1;
      } else{
        $failedCustomerVerif += 1;
      }
    }
    return array('successCustomer' => $successCustomer, 'failedCustomer' => $failedCustomer, 'successCustomerVerif' => $successCustomerVerif, 'failedCustomerVerif' => $failedCustomerVerif);
  }

  private function update_customer($out = null, $custID = null) {
    $this->db->reset_write();
    $this->db->set('DM_CampaignId', $out->get_value('transfer_campaign_new_campaign'));
    $this->db->where('DM_Id', $custID);
    if($this->db->update('t_gn_customer_master')) {
      return true;
    }
    return false;
  }

  private function update_customer_verif($out = null, $custID = null) {
    $this->db->reset_write();
    $this->db->set('CV_Data_Campaign_Id', $out->get_value('transfer_campaign_new_campaign'));
    $this->db->where('CV_Data_CustId', $custID);
    if($this->db->update('t_gn_customer_verification')) {
      return true;
    }
    return false;
  }
  // ============================== END CLASS ==================================================
}

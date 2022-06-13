<?php
/*
 * E.U.I 
 * --------------------------------------------------------------
 * 
 * subject	: get model data for M_SetPrefix modul 
 * 			  extends under model class
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/model/sysuser/
 */

class M_TlkProgram extends EUI_Model
{
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

    function __construct()
    {
    }
    /**
     * [Recovery data failed upload HSBC TAMAN SARI]
     * @param  [type] $CustomerId [description]
     * @return [type]             [description]
     */

    function _get_default()
    {

        $this->EUI_Page->_setPage(20);
        $this->EUI_Page->_setArraySelect(array(
            "a.PRD_Data_Id as PRD_Data_Id " => array("PRD_Data_Id", "PRD_Data_Id", "primary"),
            "a.PRD_Data_Master as PRD_Data_Master" => array("PRD_Data_Master", "Data Master"),
            "a.PRD_Data_Kode  as ProductCode" => array("ProductCode", "Data Kode"),
            "a.PRD_Data_Value as PRD_Data_Kode" => array("PRD_Data_Kode", "Data Value"),
            "a.PRD_Data_Tenor as PrefixMethod" => array("PrefixMethod", "Tenor"),
            "a.PRD_Data_Rate as PrefixLength" => array("PrefixLength", "Data Rate"),
            "a.PRD_Data_Sort as AddView" => array("AddView", "Data Sort"),

            "a.PRD_Data_Status as Status" => array("Status", "Status")
        ));
        $this->EUI_Page->_setFrom("t_lk_program_detail a");
        // $this->EUI_Page->_setJoin("t_gn_product_master b ", " a.ProductId=b.ProductId", "LEFT");
        // $this->EUI_Page->_setJoin("t_gn_formlayout c ", " a.PRD_Data_Id=c.PrefixId", "LEFT", true);
        $this->EUI_Page->_setJoin("t_gn_formlayout c ", " a.PRD_Data_Id=c.PrefixId", "LEFT", true);
        // ------ set filter -------------------------
        $this->EUI_Page->_setAndCache("a.PRD_Data_Kode", "prefix_kode_number", true);
        $this->EUI_Page->_setAndCache("a.PRD_Data_Master", "prefix_product_id", true);
        $this->EUI_Page->_setAndCache("a.PRD_Data_Value", "prefix_product_name", true);
        $this->EUI_Page->_setAndCache("a.PRD_Data_Status", "prefix_status", true);

        return $this->EUI_Page;
        // echo $this->EUI_Page->_getCompiler();
    }
    /**
     * [Recovery data failed upload HSBC TAMAN SARI]
     * @param  [type] $CustomerId [description]
     * @return [type]             [description]
     */

    function _get_content()
    {
        // No		 Product Code 	 Product Name 	 Prefix 	
        // Max Length 	 Method 	 Form Input 	 Form Edit 	 
        // Prefix Status 

        $this->EUI_Page->_postPage(_get_post('v_page'));
        $this->EUI_Page->_setPage(20);
        $this->EUI_Page->_setArraySelect(array(
            "a.PRD_Data_Id as PRD_Data_Id " => array("PRD_Data_Id", "PRD_Data_Id", "primary"),
            "a.PRD_Data_Master as PRD_Data_Master" => array("PRD_Data_Master", "Data Master"),
            "a.PRD_Data_Kode  as ProductCode" => array("ProductCode", "Data Kode"),
            "a.PRD_Data_Value as PRD_Data_Kode" => array("PRD_Data_Kode", "Data Value"),
            "a.PRD_Data_Tenor as PrefixMethod" => array("PrefixMethod", "Tenor"),
            "a.PRD_Data_Rate as PrefixLength" => array("PrefixLength", "Data Rate"),
            "a.PRD_Data_Sort as AddView" => array("AddView", "Data Sort"),

            "a.PRD_Data_Status as Status" => array("Status", "Status")
        ));

        $this->EUI_Page->_setFrom("t_lk_program_detail a");
        // $this->EUI_Page->_setJoin("t_gn_product_master b ", " a.ProductId=b.ProductId", "LEFT");
        $this->EUI_Page->_setJoin("t_gn_formlayout c ", " a.PRD_Data_Id=c.PrefixId", "LEFT", true);

        // ------ set filter ------------


        // $this->EUI_Page->_setLikeCache("a.PRD_Data_Id", "prefix_kode_number", true);
        // $this->EUI_Page->_setWhere(" 1=1");

        $this->EUI_Page->_setAndCache("a.PRD_Data_Kode", "prefix_kode_number", true);
        $this->EUI_Page->_setAndCache("a.PRD_Data_Kode", "prefix_kode_number", true);
        $this->EUI_Page->_setAndCache("a.PRD_Data_Master", "prefix_product_id", true);
        $this->EUI_Page->_setAndCache("a.PRD_Data_Value", "prefix_product_name", true);
        $this->EUI_Page->_setAndCache("a.PRD_Data_Status", "prefix_status", true);


        // ---------- set order by -------------------

        if (_get_have_post('order_by')) {
            $this->EUI_Page->_setOrderBy(_get_post('order_by'), _get_post('type'));
        } else {
            $this->EUI_Page->_setOrderBy("a.PRD_Data_Id", "DESC");
        }

        $this->EUI_Page->_setLimit();
        // echo $this->EUI_Page->_getCompiler();
    }


    /**
     * [Recovery data failed upload HSBC TAMAN SARI]
     * @param  [type] $CustomerId [description]
     * @return [type]             [description]
     */

    function _get_resource_query()
    {
        $res = false;

        self::_get_content();

        if ($this->EUI_Page->_get_query() != '') {
            $res = $this->EUI_Page->_result();
            if ($res) return $res;
            else {
                exit("Error :" . mysql_error());
            }
        }
    }
    /**
     * [Recovery data failed upload HSBC TAMAN SARI]
     * @param  [type] $CustomerId [description]
     * @return [type]             [description]
     */

    function _get_page_number()
    {
        // var_dump($this->EUI_Page->_get_query());
        // var_dump($this->EUI_Page->_getNo());
        // die;
        if ($this->EUI_Page->_get_query() != '') {
            return $this->EUI_Page->_getNo();
        }
    }

    /**
     * [Recovery data failed upload HSBC TAMAN SARI]
     * @param  [type] $CustomerId [description]
     * @return [type]             [description]
     */

    function _get_avail_product()
    {
        $datas = array();
        $sql = "select a.ProductId, a.PRD_Data_Kode FROM t_gn_product_master a";
        $qry = $this->db->query($sql);
        foreach ($qry->result_assoc() as $rows) {
            $datas[$rows['ProductId']] = $rows['PRD_Data_Kode'];
        }
        return $datas;
    }
    /**
     * [Recovery data failed upload HSBC TAMAN SARI]
     * @param  [type] $CustomerId [description]
     * @return [type]             [description]
     */

    function _get_method_prefix()
    {
        return array(
            'one-to-one' => 'One to One ',
            'one-to-many' => 'One to Many',
            'take-customize' => 'Customize'
        );
    }

    /**
     * [Recovery data failed upload HSBC TAMAN SARI]
     * @param  [type] $CustomerId [description]
     * @return [type]             [description]
     */

    function _getPrefixId($ProductId = 0)
    {
        $PrefixId = null;

        $this->db->select('a.PRD_Data_Id');
        $this->db->from('t_lk_program_detail a');
        $this->db->where('a.ProductId', $ProductId);

        if ($avail = $this->db->get()->result_first_assoc()) {
            $PrefixId = $avail['PRD_Data_Id'];
        }

        return $PrefixId;
    }

    /**
     * [Recovery data failed upload HSBC TAMAN SARI]
     * @param  [type] $CustomerId [description]
     * @return [type]             [description]
     */

    function _get_status_prefix()
    {
        return array(
            '0' => 'Not Active',
            '1' => 'Active'
        );
    }
    /**
     * [Recovery data failed upload HSBC TAMAN SARI]
     * @param  [type] $CustomerId [description]
     * @return [type]             [description]
     */

    function _get_avail_form($prefix = null)
    {
        $form = array();
        $form_avail_list = array();
        $_list_strips = array();

        if (isset($form_avail_list)) {
            if (!is_null($prefix)) {
                $form_avail_list = $this->EUI_Tools->_ls_get_dir(array("form/$prefix"), true);
                foreach ($form_avail_list as $k => $v) {
                    $_list_strips = explode('.', $v);
                    if (is_array($_list_strips)) {
                        $form[$_list_strips[0]] = $_list_strips[0];
                    }
                }
            }
        }

        return $form;
    }
    /**
     * [Recovery data failed upload HSBC TAMAN SARI]
     * @param  [type] $CustomerId [description]
     * @return [type]             [description]
     */

    public function _seDelete()
    {
        $data = $this->URI->_get_array_post('PrefixId');
        $ambl = $data[0];
        // var_dump($data[0]);
        // die;
        // $rows = $this->db->get()->result_first_assoc();

        $_conds = 0;
        $this->db->reset_write();
        $this->db->where('PRD_Data_Id', $data[0]);
        if ($this->db->delete('t_lk_program_detail')) {
            // var_dump($this->db->last_query());
            // die;
            $_conds++;
        }
        // $this->db->where('PRD_Data_Id', $rows['PRD_Data_Id']);
        // $this->db->delete('t_lk_program_detail');

        $_conds++;


        // if ($this->URI->_get_array_post('PrefixId')) foreach ($this->URI->_get_array_post('PrefixId') as  $key => $PrefixId) {
        //     $this->db->select('*');
        //     $this->db->from('t_lk_program_detail a ');
        //     $this->db->where('a.PRD_Data_Id', $PrefixId);
        // var_dump($this->db->last_query());
        // die;

        // if ($rows = $this->db->get()->result_first_assoc()) {
        // $this->db->where('PrefixId', $rows['PRD_Data_Id']);
        // if ($this->db->delete('t_lk_program_detail')) {
        //     $this->db->where('PRD_Data_Id', $rows['PRD_Data_Id']);
        //     if ($this->db->delete('t_lk_program_detail')) {
        //         $_conds++;
        //     }
        // }
        // }
        // }

        return $_conds;
    }



    /**
     * [Recovery data failed upload HSBC TAMAN SARI]
     * @param  [type] $CustomerId [description]
     * @return [type]             [description]
     */


    private function _save_product_form($_post = null, $_insertid = 0)
    {

        $_conds = false;
        if ((!is_null($_post)) && ($_insertid != 0)) {
            if ($this->db->insert(
                "t_gn_formlayout",
                array(
                    'PrefixId' => $_insertid,
                    'EditView' => $_post['form_edit'],
                    'AddView' => $_post['form_input'],
                    'UrlView' => base_url()
                )
            )) {
                $_conds = true;
            }
        }

        return $_conds;
    }



    /**
     * [Recovery data failed upload HSBC TAMAN SARI]
     * @param  [type] $CustomerId [description]
     * @return [type]             [description]
     */

    private function _get_char_prefix($_code = null, $_length = 0)
    {
        $_ret = null;
        if ((!is_null($_code)) && ($_length != 0)) {
            $P = null;
            for ($n = 1; $n <= $_length; $n++) {
                $P .= '0';
            }

            $L = null;
            if (!is_null($P)) {
                $L = $_code . substr($P, strlen($_code), strlen($P));
            }

            if (!is_null($L))
                $_ret = $L;
        }

        return $_ret;
    }

    /**
     * [Recovery data failed upload HSBC TAMAN SARI]
     * @param  [type] $CustomerId [description]
     * @return [type]             [description]
     */

    function _set_save_prefix_number($_prefix_post = null)
    {
        // var_dump($_prefix_post);
        // die;
        $tot = 0;
        $_get_chars = null;
        if (!is_null($_prefix_post)) {
            // $_get_chars = self::_get_char_prefix($_prefix_post['result_code'],  $_prefix_post['result_length']);
            // var_dump($_get_chars);
            // die;
            //  if (!is_null($_get_chars)) {
            //----------- reset write -----------
            $dtm = $_prefix_post['PRD_Data_Master'];
            $this->db->reset_select();
            $this->db->select("a.ProductCode");
            $this->db->from("t_gn_product_master a");
            $this->db->where("a.ProductId", $dtm);
            $dt_master = $this->db->get()->row_array();
            // var_dump($dt_master['ProductCode']);
            // die;

            $this->db->reset_write();
            // $this->db->set("PRD_Data_Master", $_get_chars);
            // $this->db->set("PRD_Data_Master", $_prefix_post['PRD_Data_Master']);
            $this->db->set("PRD_Data_Master",   $_prefix_post['PRD_Data_Master']);
            $this->db->set("PRD_Data_Kode",     $_prefix_post['PRD_Data_Kode']);
            $this->db->set("PRD_Data_Value",    $_prefix_post['PRD_Data_Value']);
            $this->db->set("PRD_Data_Tenor",    $_prefix_post['PRD_Data_Tenor']);
            $this->db->set("PRD_Data_Rate",     $_prefix_post['PRD_Data_Rate']);
            $this->db->set("PRD_Data_Sort",     $_prefix_post['PRD_Data_Sort']);
            $this->db->set("PRD_Data_Status",   $_prefix_post['status_active']);

            $this->db->insert("t_lk_program_detail");
            $prefixId = $this->db->insert_id();
            // var_dump($this->db->last_query());
            // var_dump($prefixId);
            // var_dump(($prefixId) and $this->_save_product_form($_prefix_post, $prefixId));
            // die;
            // ----------- set prefix data ----------------------

            // if (($prefixId) and $this->_save_product_form($_prefix_post, $prefixId)
            if (!is_null($prefixId)) {
                $tot++;
            }
            // }
        }

        return $tot;
    }

    // -------------------------------------------------------------------

    /*
 * @ package		_getPrefix() 
 * -------------------------------------------------------------------
 *
 * @ def			 
 * @ param			 
 */

    public function _getPrefix()
    {


        $arr_product_prefix = array();

        $out = new EUI_Object(_get_all_request());
        // var_dump($out);
        // die;
        if (!$out->fetch_ready()) {
            return $arr_product_prefix;
        }

        // ------- reset select ---------------
        $this->db->reset_select();

        $this->db->select("*");
        $this->db->from("t_lk_program_detail a ");
        // $this->db->join("t_gn_formlayout b ", "a.PRD_Data_Id=b.PrefixId", "LEFT");
        // $this->db->join("t_gn_product_master c ", "a.ProductId=c.ProductId", "LEFT");
        $this->db->where("a.PRD_Data_Id", $out->get_value('PrefixId'));

        $rs = $this->db->get();
        // var_dump($this->db->last_query());
        // die;
        if ($rs->num_rows() >  0) {
            $arr_product_prefix = (array)$rs->result_first_assoc();
        }

        return $arr_product_prefix;
    }


    // -------------------------------------------------------------------

    /*
 * @ package		_getPrefix() 
 * -------------------------------------------------------------------
 *
 * @ def			 
 * @ param			 
 */

    function _setUpdate($_prefix_post = null)
    {
        $_conds = false;
        // $_get_chars = self::_get_char_prefix($_prefix_post['result_code'],  $_prefix_post['result_name']);
        // echo "<pre>";
        // var_dump($_prefix_post);
        // die;

        if ($this->db->update(
            "t_lk_program_detail",
            array(
                'PRD_Data_Master' => $_prefix_post['PRD_Data_Master'],
                'PRD_Data_Kode' => $_prefix_post['PRD_Data_Kode'],
                'PRD_Data_Value' => $_prefix_post['PRD_Data_Value'],
                'PRD_Data_Tenor' => $_prefix_post['PRD_Data_Tenor'],
                'PRD_Data_Rate' => $_prefix_post['PRD_Data_Rate'],
                'PRD_Data_Sort' => $_prefix_post['PRD_Data_Sort'],
                'PRD_Data_Status' => $_prefix_post['status_active'],

            ),
            array("PRD_Data_Id" => $_prefix_post['PRD_Data_Id'])
        )) {
            $_conds = true;
        }

        return $_conds;
    }

    // _setActive

    function _setActive($_params = null)
    {
        // var_dump($_params['PrefixId']);
        // var_dump($_params);
        // die;
        $_conds = 0;
        if (
            !is_null($_params)
            and is_array($_params)
        ) {
            foreach ($_params['PrefixId'] as $PRD_Data_Id) {
                if ($this->db->update(
                    "t_lk_program_detail",
                    array("PRD_Data_Status" => $_params['Active']),
                    array("PRD_Data_Id" => $PRD_Data_Id)
                )) {
                    $_conds += 1;
                }
            }
        }

        return $_conds;
    }
}

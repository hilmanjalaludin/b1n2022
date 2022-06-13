<?php
/*
 * E.U.I 
 *
 
 * subject	: get model data for WallBoard modul 
 */
 
class M_WallBoard extends EUI_Model {
 
 
    function M_WallBoard() {
        $this -> load -> helper('EUI_Socket');
    }  
 
 
 
    public function _get_modif_cip()
    {
 
      $_data = NULL;
        $date = date('Y-m-d');
        $awal = date('Y-m-01');
        $start = ' 06:00:00';
        $end = ' 23:59:58';
 
 
 
        $sql="        
           SELECT b.code_user AS spv_code,
            b.full_name as SPV, 
 
                COUNT(DISTINCT bill.CustomerId) AS BESTBILL_COUNT,
            COUNT(bill.CustomerId) AS Enroll_bestbill
            from t_gn_customer cs
 
            inner join tms_agent a on cs.SellerId=a.UserId
            inner join tms_agent b on  a.spv_id=b.UserId
            inner join tms_agent c on b.mgr_id=c.UserId
            left join t_gn_frm_cip cip on cs.CustomerId=cip.CustomerId 
            LEFT JOIN t_gn_frm_best_bill bill ON bill.CustomerId=cs.CustomerId 
             --LEFT JOIN t_gn_wallboard bord ON bord.spv_code=c.spv_id
 
 
            where
             cs.CallReasonId=13 
 
           and
            cs.CustomerUpdatedTs BETWEEN '$awal 06:00:00' AND '$date 23:59:00'
 
            group by b.full_name, C.full_name,b.UserId,b.code_user 
            ORDER BY b.code_user asc
          ";
 
        $qry = $this -> db -> query($sql);  
        // var_dump($this->db->last_query());die();
        if($qry->num_rows()>0) {
            foreach($qry->result() as $row => $key) {
                 if ($key->BESTBILL_COUNT > 0 )   {
                     $_data[] = $key;
                 }
            }
             // $_data = $qry->result_first_assoc();
        }
 
        return $_data;   
    }
 
    function _get_top_agent_cip() {
        $_data = NULL;
        $date = date('Y-m-d');
        // $date = '2019-12-04';
        $start = ' 06:00:00';
        $end = ' 23:59:58';
 
        // $sql = "SELECT TOP 5
        // a.code_user,a.full_name,
        // COUNT(c.CustomerId) as CIP_COUNT, SUM(CONVERT(INT, c.TransferAmount)) as CIP_AMOUNT
        // FROM tms_agent a 
        // LEFT JOIN t_gn_frm_cip c ON a.UserId=c.CreateBy AND c.CreateDate BETWEEN '$date 06:00:00' AND '$date 23:59:00'
        // WHERE
        // a.handling_type=4
        // GROUP BY a.code_user, a.full_name
        // ORDER BY CIP_AMOUNT DESC";
 
//         $sql = "SELECT TOP 5
//         a.code_user,a.full_name,    
//          COUNT(DISTINCT bill.CustomerId) AS Count_basebill,
//          COUNT(bill.CustomerId) AS Enroll_bestbill,
 
//           (SELECT COUNT(DISTINCT acyu.CustomerId)
//                     FROM t_gn_frm_cip acyu
//                     INNER JOIN tms_agent agyu ON acyu.CreateBy=agyu.UserId
//                     WHERE acyu.CampaignId=3 AND acyu.CustomerId != 0
//                      AND agyu.UserId=a.UserId 
//                      AND acyu.CreateDate BETWEEN '$date 06:00:00' AND '$date 23:59:00'
//             )+ 
//             COUNT(iif(cs.CampaignId=5,1, NULL)) +
//             COUNT(iif(c.CampaignId=2,1, NULL)) + 
//             COUNT(iif(c.CampaignId=16,1, NULL)) + 
//             COUNT(iif(c.CampaignId=4,1, NULL)) + 
//             COUNT(iif(c.CampaignId=17,1, NULL)) + 
//             COUNT(iif(c.CampaignId=20,1, NULL)) +
//             COUNT(iif(c.CampaignId=1,1, NULL)) +
//             COUNT(iif(cs.CampaignId=6,1, NULL)) + 
//             COUNT(iif(cs.CampaignId=9,1, NULL))         
//              as CIP_COUNT,     
//          SUM(CONVERT(INT, c.TransferAmount)) as CIP_AMOUNT,
 
//          SUM(iif(c.CampaignId=3,c.AmountLogged, NULL))  
//             + SUM(iif(c.CampaignId=2,c.AmountLogged, NULL)) 
//          AS CIP_AMOUNT_DATA,
 
// (SELECT COUNT(DISTINCT acyu.CustomerId)
//          FROM t_gn_frm_cip acyu
//          INNER JOIN tms_agent agyu ON acyu.CreateBy=agyu.UserId
//          WHERE acyu.CampaignId=3 AND acyu.CustomerId != 0
//          AND agyu.UserId=a.UserId 
//          AND acyu.CreateDate BETWEEN '$date 06:00:00' AND '$date 23:59:00') 
// AS Count_cip_cc,
 
//          SUM(iif(c.CampaignId=3,c.AmountLogged, NULL)) AS Loan_cip_cc,
//          COUNT(iif(cs.CampaignId=5,1, NULL)) AS Count_pil_xsel,
//          SUM(xs.Loan) AS Loan_pil_xsel,
//          COUNT(iif(c.CampaignId=1,1, NULL)) AS Count_cip_reg, 
//          SUM(iif(c.CampaignId=1,c.AmountLogged, NULL)) AS Loan_cip_reg, 
//          COUNT(iif(c.CampaignId=2,1, NULL)) AS Count_cip_ntb, 
//          SUM(iif(c.CampaignId=2,c.AmountLogged, NULL)) AS Loan_cip_ntb,        
 
 
//             --count(iif(c.CampaignId=3,1,null)) as Count_cip_cc,
//             --SUM(iif(c.CampaignId=3,c.AmountLogged, NULL)) AS Loan_cip_cc,
//          COUNT(iif(c.CampaignId=16,1, NULL)) AS Count_cip_dormant, 
//          SUM(iif(c.CampaignId=16,c.AmountLogged, NULL)) AS Loan_cip_dormant, 
//          COUNT(iif(c.CampaignId=4,1, NULL)) AS Count_cip_top_up, 
//          SUM(iif(c.CampaignId=4,c.AmountLogged, NULL)) AS Loan_cip_top_up, 
//          COUNT(iif(c.CampaignId=17,1, NULL)) AS Count_cip_spc, 
//          SUM(iif(c.CampaignId=17,c.AmountLogged, NULL)) AS Loan_cip_spc, 
//          COUNT(iif(c.CampaignId=20,1, NULL)) AS Count_cip_mlt, 
//          SUM(iif(c.CampaignId=20,c.AmountLogged, NULL)) AS Loan_cip_mlt, 
//          COUNT(iif(cs.CampaignId=6,1, NULL)) AS Count_pil_topup,
//          SUM(tp.Loan) AS Loan_pil_topup,
//          COUNT(iif(cs.CampaignId=9,1, NULL)) AS Count_flexi, SUM(fx.Loan) AS Loan_flexi
 
 
 
//          FROM tms_agent a 
//         LEFT JOIN t_gn_frm_cip c ON a.UserId=c.CreateBy 
//           AND c.CreateDate BETWEEN '2020-06-17 06:00:00' AND '2020-06-17 23:59:00'     
//         LEFT JOIN t_gn_customer cs ON a.UserId=cs.SellerId
//         AND cs.CustomerUpdatedTs BETWEEN '2020-06-17 06:00:00' AND '2020-06-17 23:59:00' 
//       -- left join t_gn_frm_cip cip on cs.CustomerId=cip.CustomerId 
//         LEFT JOIN t_gn_frm_pil_xsel xs ON cs.CustomerId=xs.CustomerId
//         AND cs.CustomerUpdatedTs BETWEEN '2020-06-17 06:00:00' AND '2020-06-17 23:59:00'
//         LEFT JOIN t_gn_frm_pil_topup tp ON cs.CustomerId=tp.CustomerId
//         AND cs.CustomerUpdatedTs BETWEEN '2020-06-17 06:00:00' AND '2020-06-17 23:59:00'
//          --left join t_gn_frm_hospin hp on cs.CustomerId=hp.CustomerId
//         LEFT JOIN t_gn_frm_flexi fx ON cs.CustomerId=fx.CustomerId
//         AND cs.CustomerUpdatedTs BETWEEN '2020-06-17 06:00:00' AND '2020-06-17 23:59:00'
//         LEFT JOIN t_gn_frm_best_bill bill ON bill.CustomerId=cs.CustomerId 
//         AND cs.CustomerUpdatedTs BETWEEN '2020-06-17 06:00:00' AND '2020-06-17 23:59:00'
//         WHERE
//         a.handling_type=4
//         GROUP BY a.code_user, a.full_name,a.UserId
//         ORDER BY Enroll_bestbill DESC";
 
        $sql="
        SELECT TOP 5
            a.UserId, a.code_user, a.full_name,a.init_name,
            b.full_name as SPV,
            c.full_name as MGR,
 
            COUNT(DISTINCT bill.CustomerId) AS Count_basebill,
            COUNT(bill.CustomerId) AS Enroll_bestbill,
 
 
            (SELECT COUNT(DISTINCT acyu.CustomerId)
                    FROM t_gn_frm_cip acyu
                    INNER JOIN tms_agent agyu ON acyu.CreateBy=agyu.UserId
                    WHERE acyu.CampaignId=3 AND acyu.CustomerId != 0
                     AND agyu.UserId=a.UserId 
                     AND acyu.CreateDate BETWEEN '$date 06:00:00' AND '$date 23:59:00'
            )+ 
           COUNT(iif(cs.CampaignId=5,1, NULL)) +
           COUNT(iif(cip.CampaignId=2,1, NULL)) + 
          COUNT(iif(cip.CampaignId=16,1, NULL)) + 
            COUNT(iif(cip.CampaignId=4,1, NULL)) + 
            COUNT(iif(cip.CampaignId=17,1, NULL)) + 
           COUNT(iif(cip.CampaignId=20,1, NULL)) +
            COUNT(iif(cip.CampaignId=1,1, NULL)) +
           COUNT(iif(cs.CampaignId=6,1, NULL)) + 
            COUNT(iif(cs.CampaignId=9,1, NULL))         
             as CIP_COUNT,     
 
            SUM(CONVERT(INT, cip.TransferAmount)) as CIP_AMOUNT,
 
            count(iif(cs.CampaignId=5,1,null)) as Count_pil_xsel,
            sum(xs.Loan) as Loan_pil_xsel,
 
            count(iif(cip.CampaignId=1,1,null)) as Count_cip_reg,
            SUM(iif(cip.CampaignId=1,cip.AmountLogged,null)) AS Loan_cip_reg,
 
            count(iif(cip.CampaignId=2,1,null)) as Count_cip_ntb,
            SUM(iif(cip.CampaignId=2,cip.AmountLogged,null)) AS Loan_cip_ntb,
 
            SUM(iif(cip.CampaignId=3,cip.AmountLogged, NULL)) AS Loan_cip_cc, 
 
            (SELECT COUNT(DISTINCT acyu.CustomerId) FROM t_gn_frm_cip acyu INNER JOIN 
            tms_agent agyu ON acyu.CreateBy=agyu.UserId WHERE acyu.CampaignId=3
            AND acyu.CustomerId != 0 AND agyu.UserId=a.UserId AND acyu.CreateDate BETWEEN '$date 06:00:00' AND '$date 23:59:00') AS Count_cip_cc,
 
            --count(iif(cip.CampaignId=3,1,null)) as Count_cip_cc, 
            SUM(iif(cip.CampaignId=3,cip.AmountLogged,NULL)) AS Loan_cip_cc,
 
            count(iif(cip.CampaignId=16,1,null)) as Count_cip_dormant,
            SUM(iif(cip.CampaignId=16,cip.AmountLogged,NULL)) AS Loan_cip_dormant,  
 
            count(iif(cip.CampaignId=4,1,null)) as Count_cip_top_up,
            SUM(iif(cip.CampaignId=4,cip.AmountLogged,NULL)) AS Loan_cip_top_up,
 
            count(iif(cip.CampaignId=17,1,null)) as Count_cip_spc,
            SUM(iif(cip.CampaignId=17,cip.AmountLogged,NULL)) AS Loan_cip_spc,
 
            count(iif(cip.CampaignId=20,1,null)) as Count_cip_mlt,
            SUM(iif(cip.CampaignId=20,cip.AmountLogged,NULL)) AS Loan_cip_mlt,                      
 
            count(iif(cs.CampaignId=6,1,null)) as Count_pil_topup,
            sum(tp.Loan) as Loan_pil_topup,
            --  count(iif(cs.CampaignId=7,1,null)) as HOSPIN,
            --  sum(hp.monthly_premium) as HospinAmount,
            count(iif(cs.CampaignId=9,1,null)) as Count_flexi,
            sum(fx.Loan) as Loan_flexi
 
            from t_gn_customer cs
            left join t_gn_frm_pil_xsel xs on cs.CustomerId=xs.CustomerId 
            left join t_gn_frm_pil_topup tp on cs.CustomerId=tp.CustomerId
            --left join t_gn_frm_hospin hp on cs.CustomerId=hp.CustomerId
            left join t_gn_frm_flexi fx on cs.CustomerId=fx.CustomerId
            inner join tms_agent a on cs.SellerId=a.UserId
            inner join tms_agent b on  a.spv_id=b.UserId
            inner join tms_agent c on b.mgr_id=c.UserId
            left join t_gn_frm_cip cip on cs.CustomerId=cip.CustomerId 
              LEFT JOIN t_gn_frm_best_bill bill ON bill.CustomerId=cs.CustomerId 
 
 
            where cs.CallReasonId=13 
            AND cs.CustomerUpdatedTs BETWEEN '$date 06:00:00' AND '$date 23:59:00'
            group by a.UserId, a.full_name, a.init_name, b.full_name,c.full_name,a.code_user
            ORDER BY Count_basebill DESC
          ";
 
        $qry = $this -> db -> query($sql);	
        #var_dump($this->db->last_query());die();
        if($qry->num_rows()>0) {
            foreach($qry->result() as $row => $key) {
                if ($key->CIP_AMOUNT > 0 && $key->CIP_COUNT > 0 || $key->Count_basebill > 0 && $key->Enroll_bestbill > 0)   {
                     $_data[] = $key;
                }
            }
			//$_data = $qry->result_first_assoc();
		}
 
		return $_data;
    }

    // menampilkan data agent daily perhari
    function _get_top_agent_pil() {
        $_data = NULL;
        $date = date('Y-m-d');
        // $date = '2019-12-04';
        $start = ' 06:00:00';
        $end = ' 23:59:58';
 
        $sql = "
        SELECT 
            a.code_user,a.full_name,
             #COALESCE(SUM(tu.TX_Usg_JumlahDana), 0) AS AMOUNT, 
             #COALESCE(COUNT(tu.TX_Usg_CustId), 0) AS COUNT
             SUM(IF(cr.CallReasonCode = 'CLOS',1,0)) AS COUNT, 
             SUM(IF(cr.CallReasonCode='CLOS', tu.TX_Usg_JumlahDana, 0)) AS AMOUNT

            FROM t_gn_frm_usage tu
            INNER  JOIN t_gn_customer_master cs ON cs.DM_Id=tu.TX_Usg_CustId
            INNER JOIN tms_agent a ON cs.DM_SellerId=a.UserId

            #INNER  JOIN t_gn_frm_usage tu ON cs.DM_Id=tu.TX_Usg_CustId
            LEFT JOIN t_gn_callhistory c ON tu.TX_Usg_CustId = c.CustomerId
            LEFT JOIN t_lk_callreason cr ON c.CallReasonId = cr.CallReasonId
            INNER JOIN (
            SELECT MAX(chn.CallHistoryId) AS maxId
            FROM t_gn_callhistory chn
            WHERE chn.CallHistoryCallDate>='$date 00:00:00' 
            AND chn.CallHistoryCallDate<='$date 23:59:59'
            GROUP BY chn.CustomerId) ch ON c.CallHistoryId = ch.maxId


            WHERE 
            #cs.DM_LastReasonId=44 
            #AND 
            cs.DM_ProductId in (23) 
            and c.CallHistoryCallDate BETWEEN '$date 06:00:00' AND '$date 23:59:00'
            GROUP BY a.code_user,a.full_name
            ORDER BY AMOUNT DESC
            LIMIT 5
        ";
 
        $qry = $this -> db -> query($sql);	
        #oke
        // var_dump($this->db->last_query());die();
        if($qry->num_rows()>0) {
            foreach($qry->result() as $row => $key) {
                // if ($key->AMOUNT > 0 && $key->COUNT >0) {
                    $_data[] = $key;
                // }   
            }
            // $_data = $qry->result_first_assoc();
        }
 
        return $_data;
    }
 
//  menmpilkan data spv daily harian
    function _get_top_spv_pil() {
        $_data = NULL;
        $date = date('Y-m-d');
        // $date = '2019-12-04';
        $start = ' 06:00:00';
        $end = ' 23:59:58';
 
        $sql = "
        SELECT 
        spv.code_user,spv.full_name, 
        COALESCE(COUNT(tu.TX_Usg_CustId), 0) as COUNT,
        COALESCE(SUM(tu.TX_Usg_JumlahDana), 0) as AMOUNT
        FROM t_gn_customer_master cs
        INNER JOIN  t_gn_frm_usage tu ON cs.DM_Id=tu.TX_Usg_CustId         
 
        LEFT JOIN tms_agent ag ON ag.UserId=cs.DM_SellerId
        LEFT JOIN tms_agent spv ON spv.UserId=ag.spv_id
        WHERE 
        cs.DM_LastReasonId=44 and
         cs.DM_UpdatedTs BETWEEN '$date 06:00:00' AND '$date 23:59:00'
		  GROUP BY spv.code_user, spv.full_name
        ORDER BY AMOUNT DESC LIMIT 5
        ";
 
        $qry = $this -> db -> query($sql);	
        #oke
        // var_dump($this->db->last_query());die();
        if($qry->num_rows()>0) {
            foreach($qry->result() as $row => $key) {
                // if ($key->AMOUNT > 0 && $key->COUNT >0) {
                    $_data[] = $key;
                // }   
            }
            // $_data = $qry->result_first_assoc();
        }
 
        return $_data;
    }
 
    function _get_top_agent_pil_top() {
        $_data = NULL;
        $date = date('Y-m-d');
        // $date = '2019-12-04';
        $start = ' 06:00:00';
        $end = ' 23:59:58';
 
        $sql = " SELECT TOP 5
        ag.code_user,ag.full_name,
 
         ISNULL(COUNT(xs.CustomerId), 0)
          as AMOUNT
 
        FROM t_gn_customer cs
        LEFT JOIN  t_gn_frm_pil_topup xs ON cs.CustomerId=xs.CustomerId 
 
        LEFT JOIN tms_agent ag ON ag.UserId=cs.SellerId
        WHERE 
        ag.full_name != 'TEST SATU'
        AND ag.full_name != 'IT_TEST'
        and cs.CustomerUpdatedTs BETWEEN '$date 06:00:00' AND '$end 23:59:00'
        AND (cs.CallReasonQue=1 OR xs.vartiering=100)
          GROUP BY ag.code_user, ag.full_name
        ORDER BY AMOUNT DESC
        ";
 
        $qry = $this -> db -> query($sql);  
        #oke
        // var_dump($this->db->last_query());die();
        if($qry->num_rows()>0) {
            foreach($qry->result() as $row => $key) {
                if ($key->AMOUNT > 0 && $key->COUNT >0) {
                    $_data[] = $key;
                }   
            }
            // $_data = $qry->result_first_assoc();
        }
 
        return $_data;
    }
 
    // function _get_top_agent_pil_lama() {
    //     $_data = NULL;
    //     $date = date('Y-m-d');
    //     // $date = '2019-12-04';
    //     $start = ' 06:00:00';
    //     $end = ' 23:59:58';
 
    //     $sql = "SELECT TOP 5
    //     a.code_user,a.full_name,
    //     ISNULL(COUNT(xs.CustomerId), 0)+ISNULL(COUNT(fx.CustomerId), 0)+ISNULL(COUNT(tu.CustomerId), 0) as COUNT,
    //     ISNULL(SUM(xs.Loan), 0)+ISNULL(SUM(fx.Loan), 0)+ISNULL(SUM(tu.Loan), 0) as AMOUNT
    //     FROM tms_agent a
    //     LEFT JOIN t_gn_frm_flexi fx ON a.UserId=fx.CreateBy AND fx.CreateDate BETWEEN '$date 06:00:00' AND '$date 23:59:00'
    //     LEFT JOIN t_gn_frm_pil_xsel xs ON a.UserId=xs.CreateBy AND xs.CreateDate BETWEEN '$date 06:00:00' AND '$date 23:59:00'
    //     LEFT JOIN t_gn_frm_pil_topup tu ON a.UserId=tu.CreateBy AND tu.CreateDate BETWEEN '$date 06:00:00' AND '$date 23:59:00'
    //     WHERE
    //     a.handling_type=4
    //     GROUP BY a.code_user, a.full_name
    //     ORDER BY AMOUNT DESC";
 
    //     $qry = $this -> db -> query($sql);	
    //     // var_dump($this->db->last_query());die();
    //     if($qry->num_rows()>0) {
    //         foreach($qry->result() as $row => $key) {
    //             if ($key->AMOUNT > 0 && $key->COUNT >0) {
    //                 $_data[] = $key;
    //             }   
    //         }
    //         // $_data = $qry->result_first_assoc();
    //     }
 
    //     return $_data;
    // }
 
    function _get_spv_cip() { 
        $_data = NULL;
        $date = date('Y-m-d');
        // $date = '2019-12-04';
        $start = $date.' 06:00:00';
        $end = $date.' 23:59:58';
        // $sql = "SELECT
        // a.code_user, a.full_name, COUNT(c.CustomerId) as CIP_COUNT,
        // COUNT(DISTINCT bill.CustomerId) AS BESTBILL_COUNT
        // FROM
        // tms_agent a
        // INNER JOIN tms_agent b ON a.UserId=b.spv_id
        // LEFT JOIN t_gn_frm_cip c ON b.UserId=c.CreateBy AND c.CreateDate BETWEEN '$start' AND '$end'
        // LEFT JOIN t_gn_frm_best_bill bill ON b.UserId=bill.CreatedBy AND bill.CreatedAt BETWEEN '$start' AND '$end'
        // WHERE a.handling_type=3
        // GROUP BY a.code_user, a.full_name
        // ORDER BY CIP_COUNT DESC";
 
 
        $sql="
        select
            b.full_name as SPV, 
 
               COUNT(cip.CustomerId) as CIP_COUNT,
                COUNT(DISTINCT bill.CustomerId) AS BESTBILL_COUNT,
            COUNT(bill.CustomerId) AS Enroll_bestbill
            from t_gn_customer cs
            left join t_gn_frm_pil_xsel xs on cs.CustomerId=xs.CustomerId 
            left join t_gn_frm_pil_topup tp on cs.CustomerId=tp.CustomerId
            left join t_gn_frm_hospin hp on cs.CustomerId=hp.CustomerId
            left join t_gn_frm_flexi fx on cs.CustomerId=fx.CustomerId
            inner join tms_agent a on cs.SellerId=a.UserId
            inner join tms_agent b on  a.spv_id=b.UserId
            inner join tms_agent c on b.mgr_id=c.UserId
            left join t_gn_frm_cip cip on cs.CustomerId=cip.CustomerId 
             LEFT JOIN t_gn_frm_best_bill bill ON bill.CustomerId=cs.CustomerId 
 
 
            where cs.CallReasonId=13          
            and
            cs.CustomerUpdatedTs BETWEEN '$date 06:00:00' AND '$date 23:59:00'            
            group by b.full_name, C.full_name,b.UserId 
             ORDER BY BESTBILL_COUNT DESC";			
        $qry = $this -> db -> query($sql);	
        // var_dump($this->db->last_query());die();
        if($qry->num_rows()>0) {
            foreach($qry->result() as $row => $key) {
                if ($key->CIP_COUNT > 0 || $key->BESTBILL_COUNT) {
                    $_data[] = $key;
                }   
            }
            // $_data = $qry->result_first_assoc();
        }
 
        return $_data;
    }
    function _get_bestbill_rumus() { 
        $_data = NULL;
        $date = date('Y-m-d');
        // $date = '2019-12-04';
        $start = $date.' 06:00:00';
        $end = $date.' 23:59:58';
        // $sql = "SELECT
        // a.code_user, a.full_name, COUNT(c.CustomerId) as CIP_COUNT,
        // COUNT(DISTINCT bill.CustomerId) AS BESTBILL_COUNT
        // FROM
        // tms_agent a
        // INNER JOIN tms_agent b ON a.UserId=b.spv_id
        // LEFT JOIN t_gn_frm_cip c ON b.UserId=c.CreateBy AND c.CreateDate BETWEEN '$start' AND '$end'
        // LEFT JOIN t_gn_frm_best_bill bill ON b.UserId=bill.CreatedBy AND bill.CreatedAt BETWEEN '$start' AND '$end'
        // WHERE a.handling_type=3
        // GROUP BY a.code_user, a.full_name
        // ORDER BY CIP_COUNT DESC";
 
 
        $sql="
        select
            b.full_name as SPV, 
            (SELECT daily_today FROM t_gn_wallboard WHERE id=18 AND product='bestbill') as daily_today1, 
        	(SELECT daily_today FROM t_gn_wallboard WHERE id=19 AND product='bestbill') as daily_today2,         
 
 
               COUNT(cip.CustomerId) as CIP_COUNT,
                COUNT(DISTINCT bill.CustomerId) AS BESTBILL_COUNT,
            COUNT(bill.CustomerId) AS Enroll_bestbill
            from t_gn_customer cs
            left join t_gn_frm_pil_xsel xs on cs.CustomerId=xs.CustomerId 
            left join t_gn_frm_pil_topup tp on cs.CustomerId=tp.CustomerId
            left join t_gn_frm_hospin hp on cs.CustomerId=hp.CustomerId
            left join t_gn_frm_flexi fx on cs.CustomerId=fx.CustomerId
            inner join tms_agent a on cs.SellerId=a.UserId
            inner join tms_agent b on  a.spv_id=b.UserId
            inner join tms_agent c on b.mgr_id=c.UserId
            left join t_gn_frm_cip cip on cs.CustomerId=cip.CustomerId 
             LEFT JOIN t_gn_frm_best_bill bill ON bill.CustomerId=cs.CustomerId 
 
 
            where cs.CallReasonId=13          
            and
            cs.CustomerUpdatedTs BETWEEN '$date 06:00:00' AND '$date 23:59:00'            
            group by b.full_name, C.full_name,b.UserId 
             ORDER BY BESTBILL_COUNT DESC";	
        $qry = $this -> db -> query($sql);	
         if($qry->num_rows()>0) {
            $row = $qry->row();
            #var_dump($row);die();
            $_data['SPV'] = $row->SPV;
            $_data['CIP_COUNT'] = $row->CIP_COUNT;
            $_data['daily_today1'] = $row->daily_today1;
            $_data['daily_today2'] = $row->daily_today2;
 
            $_data['BESTBILL_COUNT'] = $row->BESTBILL_COUNT;
            $_data['Enroll_bestbill'] = $row->Enroll_bestbill;
            // $_data['BESTBILL_COUNT_rumus'] = $row->daily_today1 / $row->BESTBILL_COUNT;
            $_data['BESTBILL_COUNT_rumus'] = ($row->BESTBILL_COUNT / $row->daily_today1) * 100 ;
            $_data['Enroll_bestbill_rumus'] = ($row->Enroll_bestbill / $row->daily_today2) * 100;
 
 
 
        }
 
        // var_dump($this->db->last_query());die();
        // if($qry->num_rows()>0) {
        //     foreach($qry->result() as $row => $key) {
        //         if ($key->CIP_COUNT > 0 || $key->BESTBILL_COUNT) {
        //             $_data[] = $key;
        //         }   
        //     }
        //     // $_data = $qry->result_first_assoc();
        // }
 
        return $_data;
    }
    
//  menampilkan data spv dalam 1 bulan 
    function _get_spv_pil() { 
        $_data = NULL;
        $date = date('Y-m-d');
        $awal = date('Y-m-01');
        // $date = '2019-12-04';
        $start = $date.' 06:00:00';
        $end = $date.' 23:59:58';
        $sql = " SELECT 
        spv.code_user,spv.full_name, 
        COALESCE(COUNT(tu.TX_Usg_CustId), 0) as COUNT,
        COALESCE(SUM(tu.TX_Usg_JumlahDana), 0) as PIL_AMOUNT
        FROM t_gn_customer_master cs
        INNER JOIN  t_gn_frm_usage tu ON cs.DM_Id=tu.TX_Usg_CustId         
 
        LEFT JOIN tms_agent ag ON ag.UserId=cs.DM_SellerId
        LEFT JOIN tms_agent spv ON spv.UserId=ag.spv_id
        WHERE 
        cs.DM_QualityUpdateTs BETWEEN '$awal 06:00:00' AND '$date 23:59:00'
        and cs.DM_QualityReasonKode = 'clos' 
		  GROUP BY spv.code_user, spv.full_name
        ORDER BY PIL_AMOUNT DESC LIMIT 5
        ";
 
        $qry = $this -> db -> query($sql);	
        #oke
        #var_dump($this->db->last_query());die();
        if($qry->num_rows()>0) {
            foreach($qry->result() as $row => $key) {
                if ($key->COUNT > 0) {
                    $_data[] = $key;
                }   
            }
            // $_data = $qry->result_first_assoc();
        }
 
        return $_data;
    }
 //menampilkan data agent dalam 1 bulan
    function _get_agent_pil() { 
        $_data = NULL;
        $date = date('Y-m-d');
        $awal = date('Y-m-01');
        // $date = '2019-12-04';
        $start = $date.' 06:00:00';
        $end = $date.' 23:59:58';

        $sqlx = "SELECT 
        a.code_user,a.full_name,
       SUM(IF(cr.CallReasonCode = 'CLOS',1,0)) AS COUNT, SUM(IF(cr.CallReasonCode='CLOS', tu.TX_Usg_JumlahDana, 0)) AS PIL_AMOUNT
       FROM t_gn_frm_usage tu
       INNER JOIN t_gn_customer_master cs ON cs.DM_Id=tu.TX_Usg_CustId
       INNER JOIN tms_agent a ON cs.DM_SellerId=a.UserId
       LEFT JOIN t_gn_callhistory c ON tu.TX_Usg_CustId = c.CustomerId
       LEFT JOIN t_lk_callreason cr ON c.CallReasonId = cr.CallReasonId
       INNER JOIN (
       SELECT MAX(chn.CallHistoryId) AS maxId
       FROM t_gn_callhistory chn
       WHERE chn.CallHistoryCallDate>='$awal 00:00:00' AND chn.CallHistoryCallDate<='$date 23:59:59'
       GROUP BY chn.CustomerId) ch ON c.CallHistoryId = ch.maxId
       WHERE  
        cs.DM_ProductId in (23)
       AND c.CallHistoryCallDate BETWEEN '$awal 06:00:00' AND '$date 23:59:00'
       GROUP BY a.code_user,a.full_name
       ORDER BY PIL_AMOUNT DESC
       LIMIT 5";

        $sql="SELECT
        d.full_name, a.TX_Usg_SellerKode AS code_user, 
        count(a.TX_Usg_Id)  as COUNT, 
        sum(a.TX_Usg_JumlahDana) AS PIL_AMOUNT
    from t_gn_frm_usage a
        inner join t_gn_customer_master b on a.TX_Usg_CustId = b.DM_Id
        inner join tms_agent c on a.TX_Usg_SpvKode = c.id
        inner join tms_agent d on a.TX_Usg_SellerKode = d.id
    where b.DM_QualityUpdateTs BETWEEN '$awal 06:00:00' AND '$date 23:59:00'
        and b.DM_QualityReasonKode = 'clos' and c.UserId = '688'
        
    group by a.TX_Usg_SellerKode
     ORDER BY PIL_AMOUNT DESC LIMIT 5";

        $sqlku = "SELECT  
        a.code_user,a.full_name,
     COALESCE(SUM(tu.TX_Usg_JumlahDana), 0) as PIL_AMOUNT,
     COALESCE(COUNT(tu.TX_Usg_CustId), 0) 
     as COUNT
 
       FROM t_gn_customer_master cs	
       INNER join tms_agent a on cs.DM_SellerId=a.UserId
       LEFT JOIN t_gn_frm_usage tu ON cs.DM_Id=tu.TX_Usg_CustId 
 
       where 
       cs.DM_LastReasonId=44 and
       cs.DM_UpdatedTs BETWEEN '$awal 06:00:00' AND '$date 23:59:00'
       group by 	 a.code_user,a.full_name
         ORDER BY PIL_AMOUNT DESC LIMIT 5
            ";
 
        $qry = $this -> db -> query($sqlx);
        #oke
        #var_dump($this->db->last_query());die();
        if($qry->num_rows()>0) {
            foreach($qry->result() as $row => $key) {
                if ($key->COUNT > 0) {
                    $_data[] = $key;
                }   
            }
            // $_data = $qry->result_first_assoc();
        }
 
        return $_data;
    }
 
 
 
 
     function _get_spv_pil_top() { 
        $_data = NULL;
        $date = date('Y-m-d');
        // $date = '2019-12-04';
        $start = $date.' 06:00:00';
        $end = $date.' 23:59:58';
        $sql = "SELECT  TOP 5
             b.code_user,b.full_name,
 
        ISNULL(COUNT(flexi.CustomerId), 0)+ISNULL(COUNT(xs.CustomerId), 0) 
          +ISNULL(COUNT(fx.CustomerId), 0)+ISNULL(COUNT(tu.CustomerId), 0) 
          as COUNT
 
            FROM t_gn_customer cs
            LEFT join t_gn_frm_pil_xsel xs on cs.CustomerId=xs.CustomerId AND (xs.vartiering=100 OR cs.CallReasonQue=1)
            LEFT join t_gn_frm_flexi fx on cs.CustomerId=fx.CustomerId
 
            LEFT join tms_agent a on cs.SellerId=a.UserId
            LEFT join tms_agent b on  a.spv_id=b.UserId
            LEFT join tms_agent c on b.mgr_id=c.UserId
            LEFT JOIN t_gn_frm_flexi_single flexi ON flexi.CustomerId = cs.CustomerId
             LEFT JOIN t_gn_frm_pil_topup tu ON cs.CustomerId=tu.CustomerId AND (tu.vartiering=100 OR cs.CallReasonQue=1)
 
            where cs.CallReasonId=13 
 
        and
            cs.CustomerUpdatedTs BETWEEN '$start' AND '$end' 
             group by    b.code_user,b.full_name
              ORDER BY COUNT DESC
        ";
 
        $qry = $this -> db -> query($sql);  
        #oke
        #var_dump($this->db->last_query());die();
        if($qry->num_rows()>0) {
            foreach($qry->result() as $row => $key) {
                if ($key->COUNT > 0) {
                    $_data[] = $key;
                }   
            }
            // $_data = $qry->result_first_assoc();
        }
 
        return $_data;
    }
    function _get_spv_pil_top_up_count() { 
        $_data = NULL;
        $date = date('Y-m-d');
        // $date = '2019-12-04';
        $start = $date.' 06:00:00';
        $end = $date.' 23:59:58';
        $sql = "SELECT  TOP 5
             b.code_user,b.full_name,
 
             ISNULL(COUNT(tu.CustomerId), 0) 
          as COUNT
 
            FROM t_gn_customer cs
 
            LEFT join tms_agent a on cs.SellerId=a.UserId
            LEFT join tms_agent b on  a.spv_id=b.UserId
            LEFT join tms_agent c on b.mgr_id=c.UserId
            LEFT JOIN t_gn_frm_pil_topup tu ON cs.CustomerId=tu.CustomerId 
 
            where cs.CallReasonId=13 
 
        and
            cs.CustomerUpdatedTs BETWEEN '$start' AND '$end' 
            AND (cs.CallReasonQue=1 or tu.vartiering=100)
             group by    b.code_user,b.full_name
              ORDER BY COUNT DESC
 
        ";
 
        $qry = $this -> db -> query($sql);  
        #oke
        #var_dump($this->db->last_query());die();
        if($qry->num_rows()>0) {
            foreach($qry->result() as $row => $key) {
                if ($key->COUNT > 0) {
                    $_data[] = $key;
                }   
            }
            // $_data = $qry->result_first_assoc();
        }
 
        return $_data;
    }
 
	 function _get_daily_today_cip() { 
        $_data = NULL;
        $date = date('Y-m-d');
        // $date = '2019-12-04';
        $start = $date.' 06:00:00';
        $end = $date.' 23:59:58';
        $sql = "SELECT (SELECT daily_today FROM t_gn_wallboard WHERE id=1 AND product='cip') as daily_today, 
        (SELECT mtd_h1 FROM t_gn_wallboard WHERE id=1 AND product='cip') as mtd_h1,
        (SELECT month_target FROM t_gn_wallboard WHERE id=1 AND product='cip') as monthly_target,
        COUNT(c.CustomerId) as CIP_COUNT, SUM(CONVERT(INT, c.TransferAmount)) as CIP_AMOUNT 
        FROM t_gn_frm_cip c 
        WHERE c.CreateDate BETWEEN '$date 06:00:00' AND '$date 23:59:00'";
 
        $qry = $this -> db -> query($sql);	
        #var_dump($this->db->last_query());die();
        if($qry->num_rows()>0) {
            $row = $qry->row();
            #var_dump($row);die();
            $_data['CIP_COUNT'] = $row->CIP_COUNT;
            $_data['CIP_AMOUNT'] = $row->CIP_AMOUNT == null ? 0 : $row->CIP_AMOUNT;
            $_data['daily_today'] = round(($row->CIP_AMOUNT/$row->daily_today)*100, 2);
 
            if($row->CIP_AMOUNT == 0){
                $_data['mtd_h1'] = $row->mtd_h1;    
            }else{
                $_data['mtd_h1'] = $row->CIP_AMOUNT == null ? 0 : $row->mtd_h1+$row->CIP_AMOUNT;
            }
            $_data['monthly_target'] = round((($row->mtd_h1+$row->CIP_AMOUNT)/$row->monthly_target)*100, 2);
        }
 
        return $_data;
    }
 
     function _get_daily_today_basebill() { 
        $_data = NULL;
        $date = date('Y-m-d');
        $datefirst = date('Y-m-01');
        // $date = '2019-12-04';
        $start = $date.' 06:00:00';
        $end = $date.' 23:59:58';
       //  $sql = "SELECT 
       //          (
       //          SELECT TOP 1 daily_today
       //          FROM t_gn_wallboard tw
       //          WHERE  tw.product='bestbill' ORDER BY tw.id desc) AS daily_today, 
       //           (
       //          SELECT TOP 1 mtd_h1
       //          FROM t_gn_wallboard tb
       //          WHERE tb.product='bestbill' ORDER BY tb.id desc) AS mtd_h1,
       //           (
       //          SELECT TOP 1 month_target
       //          FROM t_gn_wallboard rd
       //          WHERE rd.product='bestbill' ORDER BY rd.id desc) AS monthly_target, 
       //         -- COUNT(c.CustomerId) AS BESTBILL_COUNT_DAY, 
       //          --SUM(CONVERT(INT, C.CustomerId )) BESTBILL_AMOUNT
       //          COUNT(DISTINCT c.CustomerId) AS BESTBILL_COUNT_DAY,
       //          COUNT(c.CustomerId) AS Enroll_bestbill_day,
       //          (SELECT 
       //      COUNT(DISTINCT bill.CustomerId) AS BESTBILL_COUNT
       // --     COUNT(bill.CustomerId) AS Enroll_bestbill
       //      from t_gn_customer cs
 
       //       LEFT JOIN t_gn_frm_best_bill bill ON bill.CustomerId=cs.CustomerId 
       //      where
       //       cs.CallReasonId=13            
       //     and
       //      cs.CustomerUpdatedTs BETWEEN '$datefirst 06:00:00' AND '$date 23:59:00') AS BESTBILL_COUNT,
       //      (SELECT 
       //      --COUNT(DISTINCT bill.CustomerId) AS BESTBILL_COUNT,
       //      COUNT(bill.CustomerId) AS Enroll_bestbill
       //      from t_gn_customer cs
       //       LEFT JOIN t_gn_frm_best_bill bill ON bill.CustomerId=cs.CustomerId 
       //      where
       //       cs.CallReasonId=13 
       //     and
       //      cs.CustomerUpdatedTs BETWEEN '$datefirst 06:00:00' AND '$date 23:59:00') AS Enroll_bestbill
       //          FROM t_gn_frm_best_bill c
 
       //          WHERE c.CreatedAt BETWEEN '$date 06:00:00' AND '$date 23:59:00' ";
 
 
 
                $sql="
                SELECT rd.id,rd.daily_today,rd.mtd_h1,rd.month_target,
 (SELECT  COUNT(DISTINCT bill.CustomerId) AS BESTBILL_COUNT
            from t_gn_customer cs        
             LEFT JOIN t_gn_frm_best_bill bill ON bill.CustomerId=cs.CustomerId 
             --LEFT JOIN t_gn_wallboard bord ON bord.spv_code=c.spv_id
                where
             cs.CallReasonId=13            
           and
            cs.CustomerUpdatedTs BETWEEN '$datefirst 06:00:00' AND '$date 23:59:00'
           ) AS BESTBILL_COUNT_DAY, 
 (SELECT  COUNT(bill.CustomerId) 
            from t_gn_customer cs        
             LEFT JOIN t_gn_frm_best_bill bill ON bill.CustomerId=cs.CustomerId 
             --LEFT JOIN t_gn_wallboard bord ON bord.spv_code=c.spv_id
                where
             cs.CallReasonId=13            
           and
            cs.CustomerUpdatedTs BETWEEN '$datefirst 06:00:00' AND '$date 23:59:00'
           ) AS Enroll_bestbill
FROM t_gn_wallboard rd
WHERE rd.product='bestbill'
                ";
 
        $qry = $this -> db -> query($sql);  
        #var_dump($this->db->last_query());die();
        if($qry->num_rows()>0) {
            $row = $qry->result_Array();
            //var_dump($row[0]['month_target']);die();
            //  $_data['BESTBILL_COUNT_ASLI'] = $row->BESTBILL_COUNT;
            //  $_data['Enroll_bestbill_ASLI'] = $row->Enroll_bestbill == null ? 0 : $row->Enroll_bestbill;
            // $_data['daily_today'] = round(($row->Enroll_bestbill/$row->daily_today)*100, 2);
 
            // if($row->CIP_AMOUNT == 0){
            //     $_data['mtd_h1'] = $row->mtd_h1;    
            // }else{
            //     $_data['mtd_h1'] = $row->Enroll_bestbill == null ? 0 : $row->mtd_h1+$row->Enroll_bestbill;
            // }
            // $_data['monthly_target'] = round((($row->mtd_h1+$row->Enroll_bestbill)/$row->monthly_target)*100, 2);
            // $month=$_data['monthly_target'] = round((($row->mtd_h1+$row->Enroll_bestbill)/$row->monthly_target)*100, 2);
             //$_data['BESTBILL_COUNT'] =   $_data['monthly_target'] / $row->BESTBILL_COUNT ;
             // $_data['monthly_target'] = $row[0]['daily_today'] ; 
             // $_data['monthly_targetdua'] = $row[1]['daily_today'] ; 
 
             $_data['BESTBILL_COUNT_DAY'] = $row[1]['BESTBILL_COUNT_DAY'] ;
             $_data['Enroll_bestbill_day'] =$row[1]['Enroll_bestbill'] ;
 
             $_data['BESTBILL_COUNT'] = round(($row[1]['BESTBILL_COUNT_DAY']  * 100 ) / $row[0]['month_target']);
             $_data['Enroll_bestbill'] =round(($row[1]['Enroll_bestbill'] * 100) / $row[1]['month_target']);            
 
             $_data['mtd_h1'] = round(($row[1]['BESTBILL_COUNT_DAY']  * 100 ));
 
             $_data['daily_today'] = round(($row[1]['BESTBILL_COUNT_DAY'] / $row[0]['daily_today'])*100);
        }
 
        return $_data;
    }
 
    function _get_daily_today_pil() { 
        $_data = NULL;
        $date = date('Y-m-d');
        // $date = '2019-12-04';
        $start = $date.' 06:00:00';
        $end = $date.' 23:59:58';
        // $sql = "
        // SELECT 
        // (SELECT daily_today FROM t_gn_wallboard WHERE id=2 AND product='usage') as daily_today, 
        // (SELECT mtd_h1 FROM t_gn_wallboard WHERE id=2 AND product='usage') as mtd_h1,
        // (SELECT month_target FROM t_gn_wallboard WHERE id=2 AND product='usage') as monthly_target,
        // COALESCE(COUNT(tu.TX_Usg_CustId), 0) as PIL_COUNT,
        // SUM(tu.TX_Usg_JumlahDana) as PIL_AMOUNT
 
        // FROM tms_agent a
        // INNER JOIN t_gn_customer_master cs ON cs.DM_SellerId=a.UserId AND cs.DM_UpdatedTs BETWEEN '$date 06:00:00' AND '$date 23:59:00'
        // INNER JOIN t_gn_frm_usage tu ON tu.TX_Usg_CustId=cs.DM_Id AND tu.TX_Usg_CreatedTs BETWEEN '$date 06:00:00' AND '$date 23:59:00'
        // where cs.DM_LastReasonId=44
        // AND cs.DM_ProductId in (23)
        // ";

        $sql= "
        SELECT (
            SELECT daily_today
            FROM t_gn_wallboard
            WHERE id=2 AND product='usage') AS daily_today, (
            SELECT mtd_h1
            FROM t_gn_wallboard
            WHERE id=2 AND product='usage') AS mtd_h1, (
            SELECT month_target
            FROM t_gn_wallboard
            WHERE id=2 AND product='usage') AS monthly_target,
            SUM(IF(cr.CallReasonCode = 'CLOS' ,1,0)) AS PIL_COUNT,
            sum(IF(cr.CallReasonCode='CLOS', a.TX_Usg_JumlahDana, 0)) AS PIL_AMOUNT
            FROM t_gn_frm_usage a
            
            LEFT JOIN t_gn_callhistory c ON a.TX_Usg_CustId = c.CustomerId
            INNER JOIN (
            SELECT MAX(chn.CallHistoryId) AS maxId
            FROM t_gn_callhistory chn
            WHERE chn.CallHistoryCallDate>='$date 00:00:00' AND chn.CallHistoryCallDate<='$date 23:59:59'
            GROUP BY chn.CustomerId) ch ON c.CallHistoryId = ch.maxId
            LEFT JOIN t_gn_customer_master b ON c.CustomerId = b.DM_Id
            LEFT JOIN t_lk_callreason cr ON c.CallReasonId = cr.CallReasonId
            LEFT JOIN tms_agent d ON a.TX_Usg_SpvKode = d.id
            LEFT JOIN tms_agent e ON a.TX_Usg_MgrKode = e.id
            WHERE 
            c.CallHistoryCallDate >= '$date 00:00:00' AND c.CallHistoryCallDate <= '$date 23:59:59' 
            AND b.DM_ProductId in (23)
            #GROUP BY b.DM_CampaignId, a.TX_Usg_Id
        ";
 
        $qry = $this -> db -> query($sql);	
        // var_dump($this->db->last_query());
        if($qry->num_rows()>0) {
            $row = $qry->row();
            #var_dump($row);die();
            $_data['PIL_COUNT'] = $row->PIL_COUNT;
            $_data['PIL_AMOUNT'] = $row->PIL_AMOUNT == null ? 0 : $row->PIL_AMOUNT;
            $_data['daily_today'] = round(($row->PIL_AMOUNT/$row->daily_today)*100);
            //$_data['monthly_target'] = '125000000';
             $_data['monthly_target'] = $row->monthly_target;
            $_data['JUMLAH'] =  $row->mtd_h1 + $row->PIL_AMOUNT;
            $_data['mtd_h1'] =  $row->mtd_h1 + $row->PIL_AMOUNT;
            $_data['achievment'] =  ($_data['mtd_h1']/$_data['monthly_target'])*100  ;
 
            // $_data['daily_today'] = round(($row->daily_today/$row->PIL_AMOUNT)*100, 2);
            // if($row->PIL_AMOUNT == 0)
            // {
            //     // echo "ok";
            //     // echo $_data['mtd_h1'] = $row->PIL_AMOUNT;    
            //     $_data['mtd_h1'] = $row->mtd_h1;
 
            // }else
            // {
            //     // echo "kemana";
            //      $_data['mtd_h1'] = $row->PIL_AMOUNT == null ? 0 : $row->mtd_h1+$row->PIL_AMOUNT;
            //   // $_data['mtd_h1'] = $row->CIP_AMOUNT == null ? 0 : $row->mtd_h1+$row->CIP_AMOUNT;
            // }
                // $_data['monthly_target'] = round((($row->mtd_h1+$row->CIP_AMOUNT)/$row->monthly_target)*100, 2);
        }
 
        return $_data;
    } 
 
 
 
 
    function _get_daily_today_pil_topcount() { 
        $_data = NULL;
        $date = date('Y-m-d');
        // $date = '2019-12-04';
        $start = $date.' 06:00:00';
        $end = $date.' 23:59:58';
        $sql = "SELECT 
        (SELECT daily_today FROM t_gn_wallboard WHERE id=4 AND product='pil') as daily_today, 
        (SELECT mtd_h1 FROM t_gn_wallboard WHERE id=4 AND product='pil') as mtd_h1,
        (SELECT month_target FROM t_gn_wallboard WHERE id=4 AND product='pil') as monthly_target,
 
        +ISNULL(SUM(tu.Loan), 0) as PIL_AMOUNT
 
        FROM tms_agent a
        LEFT JOIN t_gn_customer cs ON cs.SellerId=a.UserId AND cs.CustomerUpdatedTs BETWEEN '$start' AND '$end'
        LEFT JOIN t_gn_frm_pil_topup tu ON tu.CustomerId=cs.CustomerId AND tu.CreateDate BETWEEN '$start' AND '$end'
        where
        (tu.vartiering=100 OR cs.CallReasonQue=1)
        ";
 
        $qry = $this -> db -> query($sql);  
        // var_dump($this->db->last_query());
        if($qry->num_rows()>0) {
            $row = $qry->row();
            #var_dump($row);die();
            $_data['PIL_COUNT'] = $row->PIL_COUNT;
            $_data['PIL_AMOUNT'] = $row->PIL_AMOUNT == null ? 0 : $row->PIL_AMOUNT;
            $_data['daily_today'] = round(($row->PIL_AMOUNT/$row->daily_today)*100);
 
            // $_data['daily_today'] = round(($row->daily_today/$row->PIL_AMOUNT)*100, 2);
            if($row->PIL_AMOUNT == 0)
            {
                // echo "ok";
                // echo $_data['mtd_h1'] = $row->PIL_AMOUNT;    
                $_data['mtd_h1'] = $row->mtd_h1;
 
            }else
            {
                // echo "kemana";
                 $_data['mtd_h1'] = $row->PIL_AMOUNT == null ? 0 : $row->mtd_h1+$row->PIL_AMOUNT;
              // $_data['mtd_h1'] = $row->CIP_AMOUNT == null ? 0 : $row->mtd_h1+$row->CIP_AMOUNT;
            }
                $_data['monthly_target'] = round((($row->mtd_h1+$row->PIL_AMOUNT)/$row->monthly_target)*100, 2);
                // $_data['monthly_target'] = round((($row->mtd_h1+$row->CIP_AMOUNT)/$row->monthly_target)*100, 2);
        }
 
        return $_data;
    }
 
 
	  function _pil_count(){
        $date = date('Y-m-d');
        // $date = '2019-12-04';
        $start = $date.' 06:00:00';
        $end = $date.' 23:59:58';
        $sql = "SELECT  
        ISNULL(COUNT(tu.CustomerId), 0) + 
        ISNULL(COUNT(flexi.CustomerId), 0) + 
 
               ISNULL(SUM(flexi.Loan), 0)+ ISNULL(SUM(xs.Loan), 0)+ISNULL(SUM(fx.Loan), 0)+ISNULL(SUM(tu.Loan), 0) as PIL_AMOUNTS
 
        FROM tms_agent a
        LEFT JOIN t_gn_customer cs ON cs.SellerId=a.UserId AND cs.CustomerUpdatedTs BETWEEN '$start' AND '$end'
        LEFT JOIN t_gn_frm_flexi fx ON fx.CustomerId=cs.CustomerId AND fx.CreateDate BETWEEN '$start' AND '$end' 
        LEFT JOIN t_gn_frm_pil_xsel xs ON xs.CustomerId=cs.CustomerId AND xs.CreateDate BETWEEN '$start' AND '$end' AND (xs.vartiering=100 OR cs.CallReasonQue=1)
        LEFT JOIN t_gn_frm_pil_topup tu ON tu.CustomerId=cs.CustomerId AND tu.CreateDate BETWEEN '$start' AND '$end' AND (tu.vartiering=100 OR cs.CallReasonQue=1)
        LEFT JOIN t_gn_frm_flexi_single flexi ON flexi.CustomerId=cs.CustomerId    AND flexi.CreateDate BETWEEN '$start' AND '$end'
 
        WHERE cs.CustomerUpdatedTs BETWEEN '$start' AND '$end'
        ";
          $qry = $this -> db -> query($sql);
          #oke	
          #var_dump($this->db->last_query());die();
          if($qry->num_rows()>0) {
              $row = $qry->row();
              #var_dump($row);die();
              $_data['PIL_COUNTS'] = $row->PIL_COUNTS;
              $_data['PIL_AMOUNTS'] = $row->PIL_AMOUNTS == null ? 0 : $row->PIL_AMOUNTS;
              }
 
          return $_data;
    }
 
    function _spv_amount_pil() {
        $date = date('Y-m-d');
        // $date = '2019-12-04';
        $start = $date.' 06:00:00';
        $end = $date.' 23:59:58';
 
        $_data = null;
 
        $sql = "SELECT  a.spv_code ,b.full_name, a.spv_amount,
        (SELECT SUM(frm.TX_Usg_JumlahDana) FROM t_gn_frm_usage frm
                INNER JOIN tms_agent frm2 ON frm.TX_Usg_SellerId=frm2.UserId
                WHERE 
                      #frm2.spv_id=b.UserId AND 
                      frm.TX_Usg_CreatedTs BETWEEN '$date 06:00:00' AND '$date 23:59:00'
            ) as tuLoan
            FROM t_gn_wallboard a
            left JOIN tms_agent b ON a.spv_code=b.UserId
            WHERE 
            a.product='usage'
            AND a.spv_code IS NOT NULL ORDER BY a.spv_amount DESC limit 5";
        $qry = $this -> db -> query($sql);  
        foreach($qry->result() as $row => $key) {
            $_data[] = $key;
        }
        return $_data;
    }
 
    function _spv_amount_pil_top() {
        $date = date('Y-m-d');
        // $date = '2019-12-04';
        $start = $date.' 06:00:00';
        $end = $date.' 23:59:58';
 
        $_data = null;
 
        $sql = "SELECT a.spv_code, 
		b.full_name, 
		a.spv_amount,
                (SELECT SUM(frm.Loan) FROM t_gn_frm_pil_topup frm
                    LEFT JOIN t_gn_customer css ON css.CustomerId=frm.CustomerId
                    INNER JOIN tms_agent frm2 ON frm.CreateBy=frm2.UserId
                    WHERE 
                       frm2.spv_id=b.UserId
                         AND  (frm.vartiering=100 OR css.CallReasonQue=1)
                          AND 
                            frm.CreateDate BETWEEN '$start' AND '$end') as tuLoan
                FROM t_gn_wallboard a
                INNER JOIN tms_agent b ON a.spv_code=b.code_user
                WHERE 
                a.product='pil'
 
                AND a.spv_code IS NOT NULL 
                     ORDER BY a.spv_amount DESC";
        $qry = $this -> db -> query($sql);  
        foreach($qry->result() as $row => $key) {
            $_data[] = $key;
        }
        return $_data;
    }
 
    function _spv_amount_cip() {
        $date = date('Y-m-d');
        // $date = '2019-12-04';
        $start = $date.' 06:00:00';
        $end = $date.' 23:59:58';
 
        $_data = null;
 
        $sql = "SELECT a.spv_code, b.full_name, a.spv_amount,
                (SELECT SUM(frm.AmountLogged) FROM t_gn_frm_cip frm
                    INNER JOIN tms_agent frm2 ON frm.CreateBy=frm2.UserId
                    WHERE frm2.spv_id=b.UserId AND frm.CampaignId=1 AND frm.CreateDate BETWEEN '$start' AND '$end') as regLoan,
                (SELECT SUM(frm.AmountLogged) FROM t_gn_frm_cip frm
                    INNER JOIN tms_agent frm2 ON frm.CreateBy=frm2.UserId
                    WHERE frm2.spv_id=b.UserId AND frm.CampaignId=2 AND frm.CreateDate BETWEEN '$start' AND '$end') as ntbLoan,
                (SELECT SUM(frm.AmountLogged) FROM t_gn_frm_cip frm
                    INNER JOIN tms_agent frm2 ON frm.CreateBy=frm2.UserId
                    WHERE frm2.spv_id=b.UserId AND frm.CampaignId=3 AND frm.CreateDate BETWEEN '$start' AND '$end') as accLoan,
                (SELECT SUM(frm.AmountLogged) FROM t_gn_frm_cip frm
                    INNER JOIN tms_agent frm2 ON frm.CreateBy=frm2.UserId
                    WHERE frm2.spv_id=b.UserId AND frm.CampaignId=16 AND frm.CreateDate BETWEEN '$start' AND '$end') as dormantLoan,
                (SELECT SUM(frm.AmountLogged) FROM t_gn_frm_cip frm
                    INNER JOIN tms_agent frm2 ON frm.CreateBy=frm2.UserId
                    WHERE frm2.spv_id=b.UserId AND frm.CampaignId=17 AND frm.CreateDate BETWEEN '$start' AND '$end') as spcLoan,
                (SELECT SUM(frm.AmountLogged) FROM t_gn_frm_cip frm
                    INNER JOIN tms_agent frm2 ON frm.CreateBy=frm2.UserId
                    WHERE frm2.spv_id=b.UserId AND frm.CampaignId=20 AND frm.CreateDate BETWEEN '$start' AND '$end') as mltLoan
                FROM t_gn_wallboard a
                INNER JOIN tms_agent b ON a.spv_code=b.code_user
                WHERE 
                a.product='cip'
                AND a.spv_code IS NOT NULL ORDER BY a.spv_amount DESC";
        $qry = $this -> db -> query($sql);  
          if($qry->num_rows()>0) {
            foreach($qry->result() as $row => $key) {
                 if ($key->spv_amount > 0 )   {
                     $_data[] = $key;
                 }
            }
             // $_data = $qry->result_first_assoc();
        }
 
 
        // foreach($qry->result() as $row => $key) {
 
        //     $_data[] = $key;
 
        // }
        return $_data;
    }
 
}
 
// END OF FILE 
// location :./application/model/M_WallBoard.php
 
?>
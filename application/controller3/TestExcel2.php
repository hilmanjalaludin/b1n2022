<?php

class TestExcel2 extends EUI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helpers("EUI_Object");

    }

    function index()
    {
        // ini_set('error_reporting', E_ALL );
        $excelData = $this->getData();
        $judul = 'CALL HISTORY BNI'.date("Y-m-d");
        $fileName = 'CALL_HISTORY_BNI_'.date("Y-m-d");
        $this->load->library("Excel");
        $object = new PHPExcel();
        // $object->getProperties()->setCreator("Aseanindo")->setLastModifiedBy("Aseanindo")
        // ->setTitle($judul)->setSubject($judul)->setDescription($judul)->setKeywords($judul)
        // ->setCategory($judul);
        $object->setActiveSheetIndex(0);
        $object->getActiveSheet()
			->setCellValue('A1', 'Campaign')
			->setCellValue('B1', 'Cust No')
			->setCellValue('C1', 'Fix Id')
			->setCellValue('D1', 'Card Type')
			->setCellValue('E1', 'Available XD')
			->setCellValue('F1', 'Amount Closing')
			->setCellValue('G1', 'Nama')
			->setCellValue('H1', 'Call Category')
            ->setCellValue('I1', 'Call Reason')
            ->setCellValue('J1', 'Category Reason')
			->setCellValue('K1', 'Reason Desc')
			->setCellValue('L1', 'Agent Code')
			->setCellValue('M1', 'SPV Code')
			->setCellValue('N1', 'History Calldate')
			->setCellValue('O1', 'Durasi')
		;
        $row_size = count($excelData);
        for($i=0; $i<$row_size; $i++){
            $object->getActiveSheet()->setCellValueExplicit('A'.($i+2), $excelData[$i]['Campaign']);
            $object->getActiveSheet()->setCellValue('B'.($i+2), $excelData[$i]['CustNo']);
            $object->getActiveSheet()->setCellValue('C'.($i+2), $excelData[$i]['FixId']);
            $object->getActiveSheet()->setCellValue('D'.($i+2), $excelData[$i]['CardType']);
            $object->getActiveSheet()->setCellValue('E'.($i+2), $excelData[$i]['AvailableXD']);
            $object->getActiveSheet()->setCellValue('F'.($i+2), $excelData[$i]['Amountclosing']);
            $object->getActiveSheet()->setCellValue('G'.($i+2), $excelData[$i]['Nama']);
            $object->getActiveSheet()->setCellValue('H'.($i+2), $excelData[$i]['CallCategory']);
            $object->getActiveSheet()->setCellValueExplicit('I'.($i+2), $excelData[$i]['CallReason']);
            $object->getActiveSheet()->setCellValue('J'.($i+2), $excelData[$i]['CategoryName']);
            $object->getActiveSheet()->setCellValueExplicit('K'.($i+2), $excelData[$i]['ReasonDesc']);
            $object->getActiveSheet()->setCellValueExplicit('L'.($i+2), $excelData[$i]['AgentCode']);
            $object->getActiveSheet()->setCellValueExplicit('M'.($i+2), $excelData[$i]['SPVCode']);
            $object->getActiveSheet()->setCellValue('N'.($i+2), $excelData[$i]['HistoryCalldate']);
            $object->getActiveSheet()->setCellValue('O'.($i+2), $excelData[$i]['Duration']);
        } 
        
        // $object->getActiveSheet()->setTitle($judul);
        $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel2007');
        $object_writer->save(dirname(__FILE__) . '/../../row_data/' . $fileName . '.xlsx');
        //echo 'export '.$judul.' selesai </br> data : '.$row_size;
            //    ob_end_clean();
    }

    function getData()
    {
        // $start_date = "2021-02-09 08:00:00";
        // $end_date = "2021-02-09 23:00:00";
        $start_date = date("Y-m-d 01:00:00");
        $end_date = date("Y-m-d 23:00:00");

        $sql = "SELECT
            a.DM_CampaignId AS Campaign,
            b.CV_Data_Custno AS CustNo,
            b.CV_Data_FixID AS FixId,
            b.CV_Data_CardType AS CardType,
            b.CV_Data_AvailXD AS AvailableXD,
            c.TX_Usg_JumlahDana AS Amountclosing,
            a.DM_FirstName AS Nama,
            d.CallCategoryId AS CallCategory,
            d.CallReasonId AS CallReason,
            f.CallReasonCategoryName AS CategoryName,
            g.CallReasonDesc AS ReasonDesc,
            d.AgentCode AS AgentCode,
            d.SPVCode AS SPVCode,
            d.CallHistoryCallDate AS HistoryCalldate,
            SEC_TO_TIME(e.duration) AS Duration
            FROM
            t_gn_customer_master a
            INNER JOIN t_gn_customer_verification b ON a.DM_Id = b.CV_Data_CustId
            left JOIN t_gn_frm_usage c ON a.DM_Id = c.TX_Usg_CustId
            INNER JOIN t_gn_callhistory d ON a.DM_Id = d.CustomerId
            INNER JOIN cc_recording e ON e.session_key=d.CallSessionId
            INNER JOIN t_lk_callreasoncategory f ON f.CallReasonCategoryId = d.CallCategoryId
            INNER JOIN t_lk_callreason g ON g.CallReasonId = d.CallReasonId
            WHERE 
            d.CallHistoryCreatedTs >= '".$start_date."'
            and d.CallHistoryCreatedTs <= '".$end_date."'
            GROUP BY e.id 
        ";
        $res = $this->db->query($sql)->result_array();
        return $res;
    }
    
    function coba()
    {
        Excel() -> HTML_Excelxlsx();
        $this->load->view('rpt_tabulasi/rpt_rawdata');
    }
}

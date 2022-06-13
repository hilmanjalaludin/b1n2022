<?php
// ini_set('display_errors', 0);
ini_set('display_errors', 1);
// ini_set("error_reporting", 0);
ini_set("error_reporting", E_ALL); 

class Copy_xlsx_to_ftp extends EUI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helpers("EUI_Object");
    }

    function index()
    {
 		$ftp_server     = "192.168.17.5";
		$ftp_port       = 21;
		$ftp_username = "admin46";
		$ftp_userpass = "pejompongan46";

		$ftp_conn = ftp_connect($ftp_server) or die("Could not connect to $ftp_server");
		$login = ftp_login($ftp_conn, $ftp_username, $ftp_userpass);

		$src_dir = "/opt/enigma/webapps/bni-tele-ans3.1.4.r1/row_data/";
		$dest_dir = "/opt/share/admin/rawdata/";

		 // echo "\nDATE => ".date("h:i:s"); die();
		// var_dump( glob( $src_dir."*". date('Ymd', strtotime('-1 day', strtotime(date('Y-m-d')))) ."*.xlsx" )  ); 

		//var_dump( "*". date('Ymd', strtotime('-1 day', strtotime(date('Y-m-d')))) ."*.xlsx" ); die();
		//var_dump( glob($src_dir."*".date('Ymd', strtotime('-1 day', strtotime(date('Y-m-d'))))."*.xlsx'")  ); die();

		// echo $src_dir."*".date('Ymd', strtotime('-1 day', strtotime(date('Y-m-d'))))."*.xlsx \n";
		// foreach (glob($src_dir."*".date('Ymd', strtotime(date('Y-m-d') . ' -1 day'))."*.xls") as $filename) {

		//foreach (glob($src_dir."*".date('Ymd', strtotime('-1 day', strtotime(date('Y-m-d'))))."*.xlsx'") as $filename) {
		
		
 		foreach (  glob( $src_dir."*". date('Y-m-d', strtotime('-1 day', strtotime(date('Y-m-d')))) ."*.xlsx" )  as $filename) {
			echo "\nCOPYING $filename SIZE " . filesize($filename) . " TO FTP SERVER\n";

				$this->copy_to_ftp($ftp_conn, $filename, $dest_dir);
		}
		
		
		// close connection
		// if($login){
				// echo "login";
		// }else{
				// echo "asdfasdf";
		// }


		ftp_close($ftp_conn);


    }
	
	
 	function copy_to_ftp($con="", $long_file="", $dest="") {
			$short_name = end(explode("/", $long_file));

			// upload file
			// echo "\ndest short_file => ".$dest.$short_name."\n";
			$result = ftp_put($con, $dest.$short_name, $long_file, FTP_ASCII);
			// var_dump($result);
			// print_r($con);
			echo $long_file."\n";
			if ($result)
					echo "\nSUCCESSFULLY UPLOADING $dest$short_name";
			else echo "\nERROR UPLOADING $dest$short_name \n";
	} /**/
    

}

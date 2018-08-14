<?php


function __Construct() {
	$this->load->model("PDH ILKOM 2015");
	$MIN_ORDER = 25;
	$ORDER = 0;

	//General Information
	$price = 120000;
	$material = "Japan Drill";
	$open_PO = "2018-08-10";
	$close_PO = "2018-08-17";

	//ACCOUNT
	$account_number = "0395619281";
	$account_bank =  "BNI";
	$account_name = "karina natasha";

	if($ORDER < $MIN_ORDER) {
		$price = $price + 10000;
	}

	//ORDER FORMAT
	$YOUR_SIZE = 0;
	$nama = "YOUR_NAME";
	$ukuran = array("S", "M", "L", "XL", "XXL");
	$format = "PDH ILKOM " .$nama. " UKURAN " .$ukuran[$YOUR_SIZE]. " Kirim ke kelikisc ";
}

/**
 * Created by PhpStorm.
 * User: PANITIA PDH ANJAY
 * Date: 8/10/2018
 * Time: 10:34 AM
 */
?>



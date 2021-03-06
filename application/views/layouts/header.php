<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>PSDP | Pengolaan Surat dan Data Pusdatinmas</title>
	<!-- Favicon for better exp -->
	<link rel="shortcut icon" href="http://pngimg.com/uploads/envelope/envelope_PNG18414.png" type="image/x-icon">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css">
	<!-- Bootstrap core CSS -->
	<link href="<?php echo base_url('assets/css/bootstrap.css')?>" rel="stylesheet">
	<!-- Material Design Bootstrap -->
	<link href="<?php echo base_url('assets/css/mdb.css')?>" rel="stylesheet">
	<!-- Multiple Selected Item-->
	<link href="<?php echo base_url('assets/css/multiselect/multi-select.css')?>" rel="stylesheet">
	<link href="<?php echo base_url('assets/css/multiselect/multi-select.dev.css')?>" rel="stylesheet">
	<link href="<?php echo base_url('assets/css/multiselect/multi-select.dist.css')?>" rel="stylesheet">
	<!-- Your custom styles (optional) -->
	<link href="<?php echo base_url('assets/css/style.css')?>"  type="text/css" rel="stylesheet">

	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.3/dist/leaflet.css" 
			integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ=="
   			crossorigin=""/>
	<!-- SCRIPTS -->
    <!-- JQuery -->

    <!-- Sweetalert2 -->
	<link rel="stylesheet" href="<?php echo base_url('assets/css/sweetalert2.css') ?>">
    <script src="<?php echo base_url('assets/js/sweetalert2.all.min.js')?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.26.11/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.26.11/package.json"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.26.11/sweetalert2.d.ts"></script>
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/sweetalert2@7.26.11/dist/sweetalert2.all.min.js">
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/sweetalert2@7.26.11/package.json">
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/sweetalert2@7.26.11/sweetalert2.d.ts">
    <!-- Sweetalert2 -->

	<!-- Optional: include a polyfill for ES6 Promises for IE11 and Android browser -->
	<script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>
	<script
		src="https://code.jquery.com/jquery-3.3.1.js"
		integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
		crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css"
		  integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ"
		  crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
	
	<script type="text/javascript" src="<?php echo base_url('assets/js/mdb.js')?>"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="<?php echo base_url('assets/js/popper.min.js')?>"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js')?>"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="<?php echo base_url('assets/js/mdb.min.js')?>"></script>
	<!--Multiselect JavaScript -->
	<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.multi-select.js')?>"></script>
    <!-- Initializations -->
	<!-- Custom js	-->
	<script type="text/javascript" src="<?php echo base_url('assets/js/popper.min.js')?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js')?>"></script>
	<script type=”text/javascript” src="<?php echo base_url('assets/js/mdb.min.js')?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/custom.js')?>"></script>
	<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.3.1.js"></script>
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
	<!-- <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.1/semantic.min.js"></script> -->
<style>
	.html {
        position: relative;
        min-height: 100%;
    }
    .footer {
        position: absolute;
        bottom: 0;
        width: 100%;
        /* Set the fixed height of the footer here */
        height: 50px;
        background-color: #7D80DA;
    }
	.center {
    	position: absolute;
        top: 50%;
        left: 50%;
        transform: translateX(-50%) translateY(-50%);
    }
    .margin{
    	margin-bottom: 5%;
    	margin-top: 5%;
    }

	.judul {
		margin: 2%;
	}
	
	.body {
        /* Margin bottom by footer height */
        margin-bottom: 60px;
        color: #eceff1; 
    }

    .btn-group-sm .btn-fab{
	  position: fixed !important;
	  left: 59px;
	}
	.btn-group .btn-fab{
	  position: fixed !important;
	  left: 50px;
	}
	#main{
	  bottom: 30px;
	}

	.dropdown:hover>.dropdown-menu {
		display: block;
	}

	.dropup:hover>.dropdown-menu {
		display: block;
	}

	.dropdown>.dropdown-toggle:active {
		/*Without this, clicking will make it sticky*/
		pointer-events: none;
	}

	.dropdup>.dropdown-toggle:active {
		/*Without this, clicking will make it sticky*/
		pointer-events: none;
	}


</style>
</head>


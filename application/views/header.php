<!DOCTYPE html>
<html lang="en">

<head>
	<link rel="shortcut icon" href="<?php echo base_url('assets/img/logo.png')?>">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Surat Tugas</title>
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

	<!-- SCRIPTS -->
    <!-- JQuery -->
	<script
		src="https://code.jquery.com/jquery-3.3.1.js"
		integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
		crossorigin="anonymous"></script>
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
<script type=”text/javascript” src=”js/jquery-3.1.1.min.js”></script>
<script type=”text/javascript” src=”js/popper.min.js”></script>
<script type=”text/javascript” src=”js/bootstrap.min.js”></script>
<script type=”text/javascript” src=”js/mdb.min.js”></script>
	<script type="text/javascript" src="<?php echo base_url('assets/css/custom.js')?>"></script>
	<script>
	  // Data Picker Initialization
	  $( document ).ready(function() {
		  $('.datepicker').pickadate({
			  selectMonths: true, // Creates a dropdown to control month
			  selectYears: 3 // Creates a dropdown of 15 years to control year
		  });
	  });
	</script>
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
    .body {
        /* Margin bottom by footer height */
        margin-bottom: 60px;
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
	</style>
</head>


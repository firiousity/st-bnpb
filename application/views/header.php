<!DOCTYPE html>
<html lang="en">

<head>
	<style>
	.html {
        position: relative;
        min-height: 100%;
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
	</style>
	<link rel="shortcut icon" href="<?php echo base_url('assets/img/logo.png')?>">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
            <!-- Intro Section -->
            <div class="view hm-black-light jarallax" data-jarallax='{"speed": 0.2}' style="background-image: url(https://mdbootstrap.com/img/Photos/Others/img%20%2848%29.jpg);">
                <div class="full-bg-img">
                    <div class="container flex-center">
                        <div class="row pt-5 mt-3">
                            <div class="col-md-12">
                                <div class="text-center">
                                    <h1 class="h1-reponsive white-text text-uppercase font-weight-bold mb-3 wow fadeInDown" data-wow-delay="0.3s"><strong>Minimalist intro</strong></h1>
                                    <hr class="hr-light mt-4 wow fadeInDown" data-wow-delay="0.4s">
                                    <h5 class="text-uppercase mb-5 white-text wow fadeInDown" data-wow-delay="0.4s"><strong>Photography & design</strong></h5>
                                    <a class="btn btn-outline-white wow fadeInDown" data-wow-delay="0.4s">portfolio</a>
                                    <a class="btn btn-outline-white wow fadeInDown" data-wow-delay="0.4s">About me</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>	
	<!-- SCRIPTS -->
    <!-- JQuery -->
	<script
		src="https://code.jquery.com/jquery-3.3.1.js"
		integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
		crossorigin="anonymous"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="<?php echo base_url('assets/css/popper.min.js')?>"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="<?php echo base_url('assets/css/bootstrap.min.js')?>"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="<?php echo base_url('assets/css/mdb.min.js')?>"></script>
	<!--Multiselect JavaScript -->
	<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.multi-select.js')?>"></script>
    <!-- Initializations -->
	<!-- Custom js	-->
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
</head>


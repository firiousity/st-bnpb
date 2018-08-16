<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>SPJ Pusdatinmas</title>
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
	<link rel="stylesheet" href="<?php echo base_url() ?>/assets/css/sweetalert2.css">
    <script src="<?php echo base_url() ?>assets/js/sweetalert2.js"></script>
    <!-- Sweetalert2 -->

	<!-- Optional: include a polyfill for ES6 Promises for IE11 and Android browser -->
	<script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>
	<script src="https://unpkg.com/leaflet@1.3.3/dist/leaflet.js" 
			integrity="sha512-tAGcCfR4Sc5ZP5ZoVz0quoZDYX5aCtEm/eu1KhSLj2c9eFrylXZknQYmxUssFaVJKvvc0dJQixhGjG2yXWiV9Q=="
		   	crossorigin=""></script>
	<script
		src="https://code.jquery.com/jquery-3.3.1.js"
		integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
		crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css"
		  integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ"
		  crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
	
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
	<script type=”text/javascript” src=”js/popper.min.js”></script>
	<script type=”text/javascript” src=”js/bootstrap.min.js”></script>
	<script type=”text/javascript” src=”js/mdb.min.js”></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/custom.js')?>"></script>
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
	<script>
		var i = 1;
		function additem() {
//                menentukan target append
			var itemlist = document.getElementById('itemlist');

//                membuat element
			var row = document.createElement('tr');
			var nama = document.createElement('td');
			var tempat = document.createElement('td');
			var mulai = document.createElement('td');
			var akhir = document.createElement('td');
			var aksi = document.createElement('td');

//                meng append element
			itemlist.appendChild(row);
			row.appendChild(nama);
			row.appendChild(tempat);
			row.appendChild(mulai);
			row.appendChild(akhir);
			row.appendChild(aksi);

//                membuat element input
			var nama_input = document.createElement('input');
			nama_input.setAttribute('name', 'nama_input[' + i + ']');
			nama_input.setAttribute('class', 'input-block-level');
			nama_input.setAttribute('type', 'text');

			var tempat_input = document.createElement('input');
			tempat_input.setAttribute('name', 'tempat_input[' + i + ']');
			tempat_input.setAttribute('class', 'input-block-level');
			tempat_input.setAttribute('type', 'text');

			var mulai_input = document.createElement('input');
			mulai_input.setAttribute('name', 'mulai_input[' + i + ']');
			mulai_input.setAttribute('class', 'input-block-level');
			mulai_input.setAttribute('type', 'date');

			var akhir_input = document.createElement('input');
			akhir_input.setAttribute('name', 'akhir_input[' + i + ']');
			akhir_input.setAttribute('class', 'input-block-level');
			akhir_input.setAttribute('type', 'date');

			var hapus = document.createElement('span');

//                meng append element input
			nama.appendChild(nama_input);
			tempat.appendChild(tempat_input);
			mulai.appendChild(mulai_input);
			akhir.appendChild(akhir_input);
			aksi.appendChild(hapus);

			hapus.innerHTML = '<button class="btn btn-small btn-default"><i class="fas fa-trash-alt"></i></button>';
//                membuat aksi delete element
			hapus.onclick = function () {
				row.parentNode.removeChild(row);
			};

			i++;
		}

		function showMe() {
			var chboxs = document.getElementById("isReimburse");
			var vis = "none";
			for(var i=0;i<chboxs.length;i++) {
				if(chboxs[i].checked){
					vis = "block";
					break;
				}
			}
			document.getElementById('sudahbayar').style.display = vis;
		}


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
    }

	.mapid {
		height: 400px;
	}

	.dropdown:hover>.dropdown-menu {
		display: block;
	}

	.dropdown>.dropdown-toggle:active {
		/*Without this, clicking will make it sticky*/
		pointer-events: none;
	}


</style>
</head>


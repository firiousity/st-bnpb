<?php
/**
 * Created by PhpStorm.
 * User: MNurilmanBaehaqi
 * Date: 8/1/2018
 * Time: 3:49 PM
 */
?>

<body>
<div class="container" style="margin-top: 10%">

	<?php foreach ($pegawai as $row) {
		$url = "home/edit_pegawai/".$row->id_pegawai;
		echo "
			<form action=".base_url($url)." method=\"post\">
			<div class=\"modal-body mx-5\">
			<div class=\"md-form mb-4\">
			<!-- <i class=\"fa fa-user prefix grey-text\"></i> -->
			<input type=\"text\" id=\"orangeForm-name\" class=\"form-control validate\" name=\"nama\" value=\"$row->nama_pegawai\">
			<label data-error=\"wrong\" data-success=\"right\" for=\"orangeForm-name\">Nama Lengkap</label>
			</div>
			<div class=\"md-form mb-4\">
			<!-- <i class=\"fa fa-address-card prefix grey-text\"></i> -->
			<input type=\"text\" id=\"orangeForm-email\" class=\"form-control validate\" name=\"nip\" value='$row->nip_pegawai'>
			<label data-error=\"wrong\" data-success=\"right\" for=\"orangeForm-email\">NIP</label>
			</div>
		
			<div class=\"md-form mb-4\">
			<!-- <i class=\"fa fa-lock prefix grey-text\"></i> -->
			<input type=\"text\" id=\"orangeForm-pass\" class=\"form-control validate\" name=\"jabatan\" value='$row->jabatan_pegawai'>
			<label data-error=\"wrong\" data-success=\"right\" for=\"orangeForm-pass\">Jabatan</label>
			</div>
		
			<div class=\"md-form mb-4\">
			<!-- <i class=\"fa fa-lock prefix grey-text\"></i> -->
			<input type=\"text\" id=\"orangeForm-pass\" class=\"form-control validate\" name=\"gol\" value='$row->golongan_pegawai'>
			<label data-error=\"wrong\" data-success=\"right\" for=\"orangeForm-pass\">Golongan</label>
			</div>

			
			</div>
			<div class=\"modal-footer d-flex justify-content-center\">
			<button class=\"btn btn-indigo\">Edit</button>
			</div>
		</form>";
	}
	?>
</div>
</body>

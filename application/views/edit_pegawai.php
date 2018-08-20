<body>
<div class="container" style="padding-top: 20vh;">
	<div class="card mb-4">
		<div class="card-body">
			<?php foreach ($pegawai as $row) {
		$url = "home/edit_pegawai/".$row->id_pegawai;
		echo "
			<form action=".base_url($url)." method=\"post\">
			<div class=\"card-body mx-5\">
			<div class=\"md-form mb-4\">
			<input type=\"text\" class=\"form-control\" name=\"nama\" value=\"$row->nama_pegawai\">
			<label data-error=\"wrong\" data-success=\"right\">Nama Lengkap</label>
			</div>
			<div class=\"md-form mb-4\">
			<input type=\"text\" class=\"form-control\" name=\"nip\" value='$row->nip_pegawai'>
			<label data-error=\"wrong\" data-success=\"right\">NIP</label>
			</div>
		
			<div class=\"md-form mb-4\">
			<input type=\"text\" class=\"form-control\" name=\"jabatan\" value='$row->jabatan_pegawai'>
			<label data-error=\"wrong\" data-success=\"right\">Jabatan</label>
			</div>
		
			<div class=\"md-form mb-4\">
			<input type=\"text\" class=\"form-control\" name=\"gol\" value='$row->golongan_pegawai'>
			<label data-error=\"wrong\" data-success=\"right\">Golongan</label>
			</div>

			
			</div>
			<div class=\"d-flex justify-content-center\">
			<button class=\"btn btn-indigo\">Edit</button>
			</div>
		</form>";
	}
	?>	
		</div>
	</div>
	<a href="../pegawai"><button class="btn btn-indigo"><i class="fa fa-angle-left" arria-hidden="true"></i> Kembali</button></a>
	
</div>
</body>

<body>
<div class="container margin">
	<div class="card mb-4">
		<div class="card-body">
			<?php foreach ($pegawai as $row) {
		$url = "home/edit_pegawai/".$row->id_pegawai;
		echo "
			<form action=".base_url($url)." method=\"post\">
			<div class=\"modal-body mx-5\">
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
			<div class=\"modal-footer d-flex justify-content-center\">
			<button class=\"btn btn-indigo\">Edit</button>
			</div>
		</form>";
	}
	?>	
		</div>
	</div>
	
</div>
</body>
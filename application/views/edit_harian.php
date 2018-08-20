<body>
<div class="container" style="padding-top: 20vh;">
	<div class="card mb-4">
		<div class="card-body">
			<?php foreach ($uang_harian as $row) {
		$url = "home/edit_harian/".$row->id;
		echo "
			<form action=".base_url($url)." method=\"post\">
			<div class=\"card-body mx-5\">
			<div class=\"md-form mb-4\">
			<input type=\"text\" class=\"form-control\" name=\"provinsi\" value=\"$row->provinsi\">
			<label data-error=\"wrong\" data-success=\"right\">Provinsi</label>
			</div>

			<div class=\"md-form mb-4\">
			<input type=\"text\" class=\"form-control\" name=\"luar_kota\" value='$row->luar_kota'>
			<label data-error=\"wrong\" data-success=\"right\">Luar Kota</label>
			</div>

			<div class=\"md-form mb-4\">
			<input type=\"text\" class=\"form-control\" name=\"dalam_kota\" value='$row->dalam_kota'>
			<label data-error=\"wrong\" data-success=\"right\">Dalam Kota</label>
			</div>

			<div class=\"md-form mb-4\">
			<input type=\"text\" class=\"form-control\" name=\"diklat\" value='$row->diklat'>
			<label data-error=\"wrong\" data-success=\"right\">Diklat</label>
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
	<a href="../uang_harian"><button class="btn btn-indigo"><i class="fa fa-angle-left" arria-hidden="true"></i> Kembali</button></a>
</div>
</body>

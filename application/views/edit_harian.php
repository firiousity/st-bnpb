<body>
<div class="container" style="margin-top: 10%">

	<?php foreach ($uang_harian as $row) {
		$url = "home/edit_harian/".$row->id;
		echo "
			<form action=".base_url($url)." method=\"post\">
			<div class=\"modal-body mx-5\">
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
			<input type=\"text\" class=\"form-control\" name=\"diklat\" value='$row->luar_kota'>
			<label data-error=\"wrong\" data-success=\"right\">Diklat</label>
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

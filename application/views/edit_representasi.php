<body>
<div class="container" style="padding-top: 20vh;">
	<div class="card mb-4">
		<div class="card-body">
			<?php foreach ($uang_representasi as $row) {
		$url = "home/edit_representasi/".$row->id;
		echo "
			<form action=".base_url($url)." method=\"post\">
			<div class=\"card-body mx-5\">
			<div class=\"md-form mb-4\">
			<input type=\"text\" class=\"form-control\" name=\"uraian\" value=\"$row->uraian\">
			<label data-error=\"wrong\" data-success=\"right\">Uraian</label>
			</div>

			<div class=\"md-form mb-4\">
			<input type=\"text\" class=\"form-control\" name=\"luar_kota\" value='$row->luar_kota'>
			<label data-error=\"wrong\" data-success=\"right\">Luar Kota</label>
			</div>

			<div class=\"md-form mb-4\">
			<input type=\"text\" class=\"form-control\" name=\"dalam_kota\" value='$row->dalam_kota'>
			<label data-error=\"wrong\" data-success=\"right\">Dalam Kota</label>
			</div>

			<div class=\"d-flex row\">
			<a href=\"../uang_representasi\"><button class=\"btn btn-indigo\"><i class=\"fa fa-angle-left\" arria-hidden=\"true\"></i>  Kembali</button></a>
			<div class=\"col\"></div>
			<button class=\"btn btn-indigo\"><i class=\"fa fa-check\" aria-hidden=\"true\"></i>  Edit</button>
			</div>
			</div>
		</form>";
	}
	?>
		</div>
	</div>
</div>
</body>

<body>
<div class="container" style="padding-top: 15vh; padding-bottom: 10vh">
	<div class="card mb-4">
		<div class="card-body">
			<?php foreach ($biaya_penginapan as $row) {
		$url = "home/edit_penginapan/".$row->id;
		echo "
			<form action=".base_url($url)." method=\"post\">
			<div class=\"card-body mx-5\">
			<div class=\"md-form mb-4\">
			<input type=\"text\" class=\"form-control\" name=\"provinsi\" value=\"$row->provinsi\">
			<label data-error=\"wrong\" data-success=\"right\">Provinsi</label>
			</div>

			<div class=\"md-form mb-4\">
			<input type=\"text\" class=\"form-control\" name=\"eselon_1\" value='$row->eselon_1'>
			<label data-error=\"wrong\" data-success=\"right\">Eselon I</label>
			</div>
		
			<div class=\"md-form mb-4\">
			<input type=\"text\" class=\"form-control\" name=\"eselon_2\" value='$row->eselon_2'>
			<label data-error=\"wrong\" data-success=\"right\">Eselon II</label>
			</div>

			<div class=\"md-form mb-4\">
			<input type=\"text\" class=\"form-control\" name=\"eselon_3\" value='$row->eselon_3'>
			<label data-error=\"wrong\" data-success=\"right\">Eselon III</label>
			</div>

			<div class=\"md-form mb-4\">
			<input type=\"text\" class=\"form-control\" name=\"eselon_4\" value='$row->eselon_4'>
			<label data-error=\"wrong\" data-success=\"right\">Eselon IV</label>
			</div>

			<div class=\"md-form mb-4\">
			<input type=\"text\" class=\"form-control\" name=\"eselon_5\" value='$row->eselon_5'>
			<label data-error=\"wrong\" data-success=\"right\">Golongan I/II</label>
			</div>

			<div class=\"d-flex row\">
			<a href=\"../biaya_penginapan\"><button class=\"btn btn-indigo\"><i class=\"fa fa-angle-left\" arria-hidden=\"true\"></i>  Kembali</button></a>
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

<body>
<div class="container" style="margin-top: 10%">

	<?php foreach ($biaya_transport as $row) {
		$url = "home/edit_transport/".$row->id;
		echo "
			<form action=".base_url($url)." method=\"post\">
			<div class=\"modal-body mx-5\">
			<div class=\"md-form mb-4\">
			<input type=\"text\" class=\"form-control\" name=\"provinsi\" value=\"$row->provinsi\">
			<label data-error=\"wrong\" data-success=\"right\">Provinsi</label>
			</div>

			<div class=\"md-form mb-4\">
			<input type=\"text\" class=\"form-control\" name=\"besaran\" value='$row->besaran'>
			<label data-error=\"wrong\" data-success=\"right\">Besaran</label>
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

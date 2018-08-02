<body>
<div class="container margin">
	<div class="card mb-4">
		<div class="card-body">
			<?php foreach ($tiket_pesawat as $row) {
		$url = "home/edit_tiket/".$row->id;
		echo "
			<form action=".base_url($url)." method=\"post\">
			<div class=\"modal-body mx-5\">
			<div class=\"md-form mb-4\">
			<input type=\"text\" class=\"form-control\" name=\"kota\" value=\"$row->kota\">
			<label data-error=\"wrong\" data-success=\"right\">Kota</label>
			</div>

			<div class=\"md-form mb-4\">
			<input type=\"text\" class=\"form-control\" name=\"biaya_tiket\" value='$row->biaya_tiket'>
			<label data-error=\"wrong\" data-success=\"right\">Harga Tiket</label>
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

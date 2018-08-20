<body>
<div class="container" style="padding-top: 20vh;">
	<div class="card mb-4">
		<div class="card-body">
			<?php foreach ($tiket_pesawat as $row) {
		$url = "home/edit_tiket/".$row->id;
		echo "
			<form action=".base_url($url)." method=\"post\">
			<div class=\"card-body mx-5\">
			<div class=\"md-form mb-4\">
			<input type=\"text\" class=\"form-control\" name=\"rute\" value=\"$row->rute\">
			<label data-error=\"wrong\" data-success=\"right\">Rute</label>
			</div>

			<div class=\"md-form mb-4\">
			<input type=\"text\" class=\"form-control\" name=\"biaya_tiket\" value='$row->biaya_tiket'>
			<label data-error=\"wrong\" data-success=\"right\">Harga Tiket</label>
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
	<a href="../tiket_pesawat"><button class="btn btn-indigo"><i class="fa fa-angle-left" arria-hidden="true"></i> Kembali</button></a>
</div>
</body>

<body>
<div class="container" style="padding-top: 20vh;">
	<div class="card mb-4">
		<div class="card-body">
			<?php foreach ($hukum as $row) {
		$url = "home/edit_hukum/".$row->id;
		echo "
			<form action=".base_url($url)." method=\"post\">
			<div class=\"card-body mx-5\">
			
			<div class=\"md-form mb-4\">
			<input type=\"text\" class=\"form-control\" name=\"hukum\" value=\"$row->hukum\">
			<label data-error=\"wrong\" data-success=\"right\">Hukum</label>
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
	<a href="../ppk"><button class="btn btn-indigo"><i class="fa fa-angle-left" arria-hidden="true"></i> Kembali</button></a>
	
</div>
</body>

<body>
<div class="container" style="padding-top: 20vh;">
	<div class="card mb-4">
		<div class="card-body">
			<?php foreach ($ppk as $row) {
		$url = "home/edit_ppk/".$row->id;
		echo "
			<form action=".base_url($url)." method=\"post\">
			<div class=\"card-body mx-5\">
			
			<div class=\"md-form mb-4\">
			<input type=\"text\" class=\"form-control\" name=\"jabatan\" value=\"$row->jabatan\">
			<label data-error=\"wrong\" data-success=\"right\">Jabatan</label>
			</div>
			
			<div class=\"md-form mb-4\">
			<input type=\"text\" class=\"form-control\" name=\"nama\" value='$row->nama'>
			<label data-error=\"wrong\" data-success=\"right\">Nama</label>
			</div>
		
			<div class=\"md-form mb-4\">
			<input type=\"text\" class=\"form-control\" name=\"nip\" value='$row->nip'>
			<label data-error=\"wrong\" data-success=\"right\">NIP</label>
			</div>

			<div class=\"d-flex row\">
			<a href=\"../ppk\"><button class=\"btn btn-indigo\"><i class=\"fa fa-angle-left\" arria-hidden=\"true\"></i>  Kembali</button></a>
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

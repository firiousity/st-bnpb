<?php

?>
<body>
	<div class="container margin">
		<div class="card mb-6">
			<h1>
				<?php  ?>
			</h1>
			<!-- Default form contact -->
			<form class="needs-validation"  style="margin: 1%"
				  action="<?php echo base_url('C_PDF/print_rampung/'.$slug) ?>"
				  method="post">
				<h2 class="judul">ISIAN FORM RAMPUNG</h2>
				<table class="table table-responsive" width="100%">
					<!-- BAGIAN FORM DINAMIS INI AKAN MUNCUL JIKA USER MENGKLIK OPSI BANYAK TEMPAT-->
					<!--elemet sebagai target append-->
					<tbody id="itemlist">
					<tr>
						<td>
							<label for="validationCustom02">Uang Penginapan</label>
							<input type="number" class="form-control" id="validationCustom02" required name="penginapan"
								   placeholder="Rp. " required>
						</td>
						<td>
							<label for="validationCustom02">Tiket Pesawat</label>
							<input type="number" class="form-control" id="validationCustom02" required name="tiket"
								   placeholder="Rp. " required></td>
					</tr>
					<tr>
						<td>
							<button class="btn btn-blue" id="btn_tambah" onclick="additem(); return false"><i class="fas fa-plus-square"></i></i></button>
						</td>
					</tr>
					</tbody>
				</table>

				<button class="btn btn-indigo" type="submit" name="rsubmit">Print Surat</button>
			</form>
		</div>

	</div>
<script>
	var i = 1;
	function additem() {
//                menentukan target append
		var itemlist = document.getElementById('itemlist');

//                membuat element
		var row = document.createElement('tr');
		var penginapan = document.createElement('td');
		var aksi = document.createElement('td');

//                meng append element
		itemlist.appendChild(row);
		row.appendChild(penginapan);
		row.appendChild(aksi);


		var penginapan_input = document.createElement('input');
		penginapan_input.setAttribute('name', 'penginapan['+ i +']');
		penginapan_input.setAttribute('type', 'number');
		penginapan_input.setAttribute('class', 'form-control');


		var hapus = document.createElement('span');

//                meng append element input
		penginapan.appendChild(penginapan_input);
		aksi.appendChild(hapus);

		hapus.innerHTML = '<button class="btn btn-small btn-default"><i class="fas fa-trash-alt"></i></button>';
//                membuat aksi delete element
		hapus.onclick = function () {
			row.parentNode.removeChild(row);
		};

		i++;
	}

</script>
</body>


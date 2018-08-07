<?php
/**
 * Created by PhpStorm.
 * User: MNurilmanBaehaqi
 * Date: 8/6/2018
 * Time: 9:08 AM
 */
?>
<!doctype html>
<html>
<head>
	<title>Dinamic Form - harviacode.com</title>
	<style>
		body{
			padding: 15px
		}
		input[type="text"]{
			margin-bottom: 0px !important;
		}
	</style>
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
		  rel="stylesheet"
		  integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
		  crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css"
		  integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ"
		  crossorigin="anonymous">
</head>
<body>
<div class="row-fluid">
	<div class="span6">
		<form action="#" method="post">
			<table class="table table-responsive	">
				<thead>
				<tr>
					<th>Nama</th>
					<th>Tempat</th>
					<th>Tgl Mulai</th>
					<th>Tgl Akhir</th>
					<th></th>
				</tr>
				</thead>
				<!--elemet sebagai target append-->
				<tbody id="itemlist">
				<tr>
					<td><input name="nama_input[0]" class="input-block-level" type="text"/></td>
					<td><input name="tempat_input[0]" class="input-block-level" type="text"/></td>
					<td><input name="mulai_input[0]" class="input-block-level" type="date"/></td>
					<td><input name="akhir_input[0]" class="input-block-level" type="date" /></td>
					<td></td>
				</tr>
				</tbody>
				<tfoot>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td>
						<button class="btn btn-small btn-default" onclick="additem(); return false"><i class="fas fa-plus-square"></i></i></button>
						<button name="submit" class="btn btn-small btn-primary"><i class="fas fa-check-circle"></i></button>
					</td>
				</tr>
				</tfoot>
			</table>
		</form>


	</div>
	<div class="span6">
		<p>Hasil submit bisa anda lihat di sini. Hasil ini bisa anda simpan dalam tabel atau digunakan untuk kepentingan lain.</p>
		<p>
			<?php
			if (isset($_POST['submit'])) {
				$nama = $_POST['nama_input'];
				$tempat = $_POST['tempat_input'];
				$mulai = $_POST['mulai_input'];
				$akhir = $_POST['akhir_input'];

				var_dump($nama, $tempat, $mulai, $akhir);
				echo  implode('-', array_reverse(explode('-', $mulai[0])));

				/*foreach ($nama as $key => $j) {
					echo "<p>" . $j . "</p>";
				}
				foreach ($tempat as $key => $j) {
					echo "<p>" . $j . "</p>";
				}
				foreach ($mulai as $key => $j) {
					echo "<p>" . $j . "</p>";
				}
				foreach ($akhir as $key => $j) {
					echo "<p>" . $j . "</p>";
				}*/
			}
			?>
		</p>
	</div>
</div>
<script>
	var i = 1;
	function additem() {
//                menentukan target append
		var itemlist = document.getElementById('itemlist');

//                membuat element
		var row = document.createElement('tr');
		var nama = document.createElement('td');
		var tempat = document.createElement('td');
		var mulai = document.createElement('td');
		var akhir = document.createElement('td');
		var aksi = document.createElement('td');

//                meng append element
		itemlist.appendChild(row);
		row.appendChild(nama);
		row.appendChild(tempat);
		row.appendChild(mulai);
		row.appendChild(akhir);
		row.appendChild(aksi);

//                membuat element input
		var nama_input = document.createElement('input');
		nama_input.setAttribute('name', 'nama_input[' + i + ']');
		nama_input.setAttribute('class', 'input-block-level');
		nama_input.setAttribute('type', 'text');

		var tempat_input = document.createElement('input');
		tempat_input.setAttribute('name', 'tempat_input[' + i + ']');
		tempat_input.setAttribute('class', 'input-block-level');
		tempat_input.setAttribute('type', 'text');

		var mulai_input = document.createElement('input');
		mulai_input.setAttribute('name', 'mulai_input[' + i + ']');
		mulai_input.setAttribute('class', 'input-block-level');
		mulai_input.setAttribute('type', 'date');

		var akhir_input = document.createElement('input');
		akhir_input.setAttribute('name', 'akhir_input[' + i + ']');
		akhir_input.setAttribute('class', 'input-block-level');
		akhir_input.setAttribute('type', 'date');

		var hapus = document.createElement('span');

//                meng append element input
		nama.appendChild(nama_input);
		tempat.appendChild(tempat_input);
		mulai.appendChild(mulai_input);
		akhir.appendChild(akhir_input);
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
</html>

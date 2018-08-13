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
		body
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
			<table class="table table-responsive">
				<!-- BAGIAN SURAT YANG TIDAK BERUBAH -->
				<tr>
					<th>Nomor Surat</th>
					<th>Jenis </th>
					<th>Opsi</th>
				</tr>
				<tbody>
				<tr>
					<td><input name="nomor" class="input-block-level" type="text"/></td>
					<td><input
							id="jenisPembayaran"
							name="jenisPembayaran"
							onClick="bayar()"
							type="checkbox" value="0" /> Bayar di depan ? <br /></td>
					<td><input
							id="check"
							name="check"
							onClick="toggle('check', 'labelitemlist', 'itemlist')"
							type="checkbox" value="0" /> Banyak tempat ? <br /></td>
				</tr>
				</tbody>
			</table>
			<table class="table table-responsive">
				<!-- BAGIAN INI HANYA MUNCUL JIKA OPSI BANYAK TEMPAT TIDAK DI PILIH. -->
				<tbody id="itemgeneral" style="display: block">
				<tr>
					<td><label>Nama Kegiatan</label><br/><input name="kegiatan" class="input-block-level" type="text"/></td>
					<td><label>Tanggal Mulai</label><br/><input name="mulai" class="input-block-level" type="date"/></td>
					<td><label>Tanggal Akhir</label><br/><input name="akhir" class="input-block-level" type="date" /></td>
					<td style="display: block" id="moxspoy">
						<label>Nama Pegawai yang di tugaskan</label><br/>
						<select multiple="multiple" id="moxs"  name="my-select[]">
							<?php foreach ($pegawai as $row) {
								echo
								"<option value='$row->id_pegawai'>$row->nama_pegawai</option>" ;
							}
							?>
						</select></td>
					<td><label>Nama Tempat</label><br/><input name="tempat" class="input-block-level" type="text"/></td>
				</tr>
				<tr>
					<td>
						<label >Uang Harian: </label>
						<div class="input-group">
							<select name="my-select-harian[]">
								<?php foreach ($harian as $row) {
									echo
									"<option value='$row->luar_kota'>$row->provinsi</option>" ;
								}
								?>
							</select>
						</div>
					</td>
					<td>
						<label >Uang Penginapan: </label>
						<div class="input-group">
							<select name="my-select-penginapan[]">
								<?php foreach ($penginapan as $row) {
									echo
									"<option value='$row->eselon_4'>$row->provinsi</option>" ;
								}
								?>
							</select>
						</div>
					</td>
					<td>
						<label >Tiket Pesawat: </label>
						<div class="input-group">
							<select name="my-select-tiket[]">
								<?php foreach ($tiket as $row) {
									echo
									"<option value='$row->biaya_tiket'>$row->rute</option>" ;
								}
								?>
							</select>
						</div>
					</td>
					<td>
						<label >Uang Transportasi: </label>
						<div class="input-group">
							<select name="my-select-transport[]">
								<?php foreach ($transport as $row) {
									echo
									"<option value='$row->besaran'>$row->provinsi</option>" ;
								}
								?>
							</select>
						</div>
					</td>
				</tr>
				</tbody>
			</table>

			<table class="table table-responsive">
				<!-- BAGIAN FORM DINAMIS INI AKAN MUNCUL JIKA USER MENGKLIK OPSI BANYAK TEMPAT-->
				<thead id="labelitemlist" style="display: none">
				<tr>
					<th>Tempat</th>
					<th>Tgl Mulai</th>
					<th>Tgl Akhir</th>
					<th>Nama Pegawai yang ditugaskan</th>
				</tr>
				</thead>

				<!--elemet sebagai target append-->
				<tbody id="itemlist" style="display: none;">
				<tr>
					<td><input name="tempat_input[0]" class="input-block-level" type="text"/></td>
					<td><input name="mulai_input[0]" class="input-block-level" type="date"/></td>
					<td><input name="akhir_input[0]" class="input-block-level" type="date" /></td>
					<td><select  name="my-select[0]">
							<?php foreach ($pegawai as $row) {
								echo
								"<option value='$row->id_pegawai'>$row->nama_pegawai</option>" ;
							}
							?>
						</select></td>
				</tr>
				</tbody>
				<tfoot>
				<tr>
					<td>
						<button class="btn btn-small btn-default" id="btn_tambah" disabled onclick="additem(); return false"><i class="fas fa-plus-square"></i></i></button>
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
		var tempat = document.createElement('td');
		var mulai = document.createElement('td');
		var akhir = document.createElement('td');
		var pegawai = document.createElement('td');
		var aksi = document.createElement('td');

//                meng append element
		itemlist.appendChild(row);
		row.appendChild(tempat);
		row.appendChild(mulai);
		row.appendChild(akhir);
		row.appendChild(pegawai);
		row.appendChild(aksi);

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


		var pegawai_input = document.createElement('select');
		pegawai_input.setAttribute('name', 'my-select['+ i +']');

		<?php foreach ($pegawai as $row) { ?>
		var option_pegawai = document.createElement('option');
		option_pegawai.setAttribute('value', '<?php echo $row->id_pegawai?>' );
		option_pegawai.innerHTML = "<?php echo $row->nama_pegawai ?>";
		pegawai_input.appendChild(option_pegawai);
		<?php }
		?>

		var hapus = document.createElement('span');

//                meng append element input
		tempat.appendChild(tempat_input);
		mulai.appendChild(mulai_input);
		akhir.appendChild(akhir_input);
		pegawai.appendChild(pegawai_input);
		aksi.appendChild(hapus);

		hapus.innerHTML = '<button class="btn btn-small btn-default"><i class="fas fa-trash-alt"></i></button>';
//                membuat aksi delete element
		hapus.onclick = function () {
			row.parentNode.removeChild(row);
		};

		i++;
	}

	//Button tambah ga bisa di klik kalo opsi Banyak tempat tidak di ceklis
	function toggle(checkboxID, labelID, inputID) {
		var checkbox = document.getElementById(checkboxID);
		var label = document.getElementById(labelID);
		var input = document.getElementById(inputID);
		var btntambah = document.getElementById('btn_tambah');
		var itemgeneral = document.getElementById('itemgeneral');
		if(checkbox.checked) {
			label.style.display = "block";
			input.style.display = "block";
			btntambah.disabled = false;
			itemgeneral.style.display = "none";

		} else {
			label.style.display = "none";
			input.style.display = "none";
			btntambah.disabled = true;
			itemgeneral.style.display = "block";
		}
		//updateToggle = checkbox.checked ? toggle.disabled=false : toggle.disabled=true;
		//updateSelect = checkbox.checked ? select_pegawai.disabled=true : select_pegawai.disabled=false;
	}

	$('#moxs').multiSelect();

</script>
</body>
</html>

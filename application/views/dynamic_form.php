<?php
/**
 * Created by PhpStorm.
 * User: MNurilmanBaehaqi
 * Date: 8/6/2018
 * Time: 9:08 AM
 */
?>
<body>
<?php
//Get value
$tanggal = date("m");
$tahun = date("Y");

//cek jika nomor ada nilainya untuk menghindari ofset error
if ($nomor != NULL) {
	$json = $nomor[0]->nomor;
} else {
	$json = "0";
}

$json = (int) $json;
$json = $json + 1;
$nomor_surat = " /KADIH/".$tanggal."/".$tahun;

?>
<div class="container">
	<div class="row" style="padding-top: 15vh">
		<form action="<?php echo base_url('surat/exec_surat') ?>" method="post">
		<!-- BAGIAN SURAT YANG TIDAK BERUBAH -->
				<table class="table table-responsive" cellspacing="0" width="100%">
					<thead>
						<tr>
						<th class="th-sm" scope="col">Nomor Surat</th>
						<th class="th-sm" scope="col">Kegiatan</th>
						<th class="th-sm" scope="col">Jenis </th>
						<th class="th-sm" scope="col">Opsi</th>
						<th class="th-sm" scope="col">Pos Kegiatan</th>
					</tr>
					</thead>
					<tbody>
					<tr>
						<div>
							<td><input name="nomor" class="input-block-level form-control"
									   value="<?php echo $nomor_surat ?>"  type="text"/></td>
						</div>
						<div>
							<td><input name="kegiatan" class="input-block-level form-control"  type="text"/></td>
						</div>
						
						<td><input
								id="jenisPembayaran"
								name="jenisPembayaran"
								onClick="bayar()"
								type="checkbox" value="0"/> Bayar di depan ? <br/></td>
						<td><input
								id="check"
								name="check"
								onClick="toggle('check', 'labelitemlist', 'itemlist')"
								type="checkbox" value="0"/> Banyak tempat ? <br/></td>
						<td><select name="pos" class="form-control	">
								<option value="1">
									Melakukan Monitoring dan Evaluasi Teknologi
									Informasi dan Komunikasi</option>
								<option value="2">
									Menyediakan Akses Sistem Informasi Kebencanaan</option>
						</td>
					</tr>
					</tbody>
				</table>
				<table class="table table-responsive">
					<!-- BAGIAN INI HANYA MUNCUL JIKA OPSI BANYAK TEMPAT TIDAK DI PILIH. -->
					<tbody id="itemgeneral" style="display: block">
					<tr>
						<td><label>Tanggal Mulai</label><br/><input name="mulai" class="input-block-level form-control"
																	 type="date"/></td>
						<td><label>Tanggal Akhir</label><br/><input name="akhir" class="input-block-level form-control"
																	type="date" /></td>
						<td style="display: block" id="moxspoy">
							<label>Nama Pegawai yang di tugaskan</label><br/>
							<select multiple="multiple" id="moxs" name="my-select[]">
								<?php foreach ($pegawai as $row) {
									echo
									"<option value='$row->id_pegawai'>$row->nama_pegawai</option>" ;
								}
								?>
							</select></td>
						<td><label>Nama Tempat</label><br/><input name="tempat" class="input-block-level form-control"
																   type="text"/></td>
					</tr>
					<tr>
						<td>
							<div class="form-group">
								<label >Uang Harian: </label>
								<select name="harian" class="form-control">
									<?php foreach ($harian as $row) {
										echo
										"<option value='$row->id'>$row->provinsi</option>" ;
									}
									?>
								</select>
							</div>
						</td>
						<td>
							<label >Uang Penginapan: </label>
							<div class="form-group">
								<select name="penginapan" class="form-control">
									<?php foreach ($penginapan as $row) {
										echo
										"<option value='$row->id'>$row->provinsi</option>" ;
									}
									?>
								</select>
							</div>
						</td>
						<td>
							<div class="form-group">
								<label >Tiket Pesawat: </label>
								<select name="tiket" class="form-control">
									<?php foreach ($tiket as $row) {
										echo
										"<option value='$row->id'>$row->rute</option>" ;
									}
									?>
								</select>
							</div>
						</td>
						<td>
							<label >Uang Transport Awal: </label>
							<div class="form-group">
								<select name="transport" class="form-control">
									<?php foreach ($transport as $row) {
										echo
										"<option value='$row->id'>$row->provinsi</option>" ;
									}
									?>
								</select>
							</div>
						</td>
						<td>
							<label >Uang Transport Akhir: </label>
							<div class="form-group">
								<select name="transport2" class="form-control">
									<?php foreach ($transport as $row) {
										echo
										"<option value='$row->id'>$row->provinsi</option>" ;
									}
									?>
								</select>
							</div>
						</td>
					</tr>
					</tbody>
				</table>

				<table class="table table-responsive" width="100%">
					<!-- BAGIAN FORM DINAMIS INI AKAN MUNCUL JIKA USER MENGKLIK OPSI BANYAK TEMPAT-->
					<thead id="labelitemlist" style="display: none">
					</thead>

					<!--elemet sebagai target append-->
					<tbody id="itemlist" style="display: none;">
					<tr>
						<td><label>Tempat</label><input name="tempat_input[0]" class="input-block-level" type="text"/></td>
						<td><label>Tanggal Mulai</label><input name="mulai_input[0]" class="input-block-level"  type="date"/></td>
						<td><label>Tanggal Akhir</label><input name="akhir_input[0]" class="input-block-level"  type="date"/></td>
						<td><label>Pilih Pegawai</label><select  name="my-select-pegawai[0]">
								<?php foreach ($pegawai as $row) {
									echo
									"<option value='$row->id_pegawai'>$row->nama_pegawai</option>" ;
								}
								?>
							</select></td>
						<td>
							<label >Uang Harian: </label>
							<div>
								<select name="my-select-harian[0]" >
									<?php foreach ($harian as $row) {
										echo
										"<option value='$row->id'>$row->provinsi</option>" ;
									}
									?>
								</select>
							</div>
						</td>
						<td>
							<label >Uang Penginapan: </label>
							<div>
								<select name="my-select-penginapan[0]">
									<?php foreach ($penginapan as $row) {
										echo
										"<option value='$row->id'>$row->provinsi</option>" ;
									}
									?>
								</select>
							</div>
						</td>
						<td>
							<label >Tiket Pesawat: </label>
							<div>
								<select name="my-select-tiket[0]">
									<?php foreach ($tiket as $row) {
										echo
										"<option value='$row->id'>$row->rute</option>" ;
									}
									?>
								</select>
							</div>
						</td>
						<td>
							<label>Uang Transportasi Awal: </label>
							<div>
								<select name="my-select-transport[0]" >
									<?php foreach ($transport as $row) {
										echo
										"<option value='$row->id'>$row->provinsi</option>" ;
									}
									?>
								</select>
							</div>
						</td>
						<td>
							<label >Uang Transportasi Akhir: </label>
							<div>
								<select name="my-select-transport2[0]">
									<?php foreach ($transport as $row) {
										echo
										"<option value='$row->id'>$row->provinsi</option>" ;
									}
									?>
								</select>
							</div>
						</td>
					</tr>
					</tbody>
					<tfoot>
					<tr>
						<td>
							<button class="btn btn-light-blue" id="btn_tambah" disabled onclick="additem(); return false"><i class="fas fa-plus-square"></i></i></button>
							<button name="submit" type="submit" class="btn btn-indigo"><i class="fas fa-check-circle"></i> Buat</button>
						</td>
					</tr>
					</tfoot>
				</table>
			</form>
	</div>
	
<!--Multiselect JavaScript -->
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.multi-select.js')?>"></script>
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
		var harian = document.createElement('td');
		var penginapan = document.createElement('td');
		var tiket = document.createElement('td');
		var transport = document.createElement('td');
		var transport2 = document.createElement('td');
		var aksi = document.createElement('td');

//                meng append element
		itemlist.appendChild(row);
		row.appendChild(tempat);
		row.appendChild(mulai);
		row.appendChild(akhir);
		row.appendChild(pegawai);
		row.appendChild(harian);
		row.appendChild(penginapan);
		row.appendChild(tiket);
		row.appendChild(transport);
		row.appendChild(transport2);
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
		pegawai_input.setAttribute('name', 'my-select-pegawai['+ i +']');

		var harian_input = document.createElement('select');
		harian_input.setAttribute('name', 'my-select-harian['+ i +']');

		var penginapan_input = document.createElement('select');
		penginapan_input.setAttribute('name', 'my-select-penginapan['+ i +']');

		var tiket_input = document.createElement('select');
		tiket_input.setAttribute('name', 'my-select-tiket['+ i +']');

		var transport_input = document.createElement('select');
		transport_input.setAttribute('name', 'my-select-transport['+ i +']');

		var transport2_input = document.createElement('select');
		transport2_input.setAttribute('name', 'my-select-transport2['+ i +']');


		<?php foreach ($pegawai as $row) { ?>
		var option_pegawai = document.createElement('option');
		option_pegawai.setAttribute('value', '<?php echo $row->id_pegawai?>' );
		option_pegawai.innerHTML = "<?php echo $row->nama_pegawai ?>";
		pegawai_input.appendChild(option_pegawai);
		<?php }
		?>

		<?php foreach ($harian as $row) { ?>
		var option_harian = document.createElement('option');
		option_harian.setAttribute('value', '<?php echo $row->id?>' );
		option_harian.innerHTML = "<?php echo $row->provinsi ?>";
		harian_input.appendChild(option_harian);
		<?php }
		?>

		<?php foreach ($penginapan as $row) { ?>
		var option_penginapan = document.createElement('option');
		option_penginapan.setAttribute('value', '<?php echo $row->id?>' );
		option_penginapan.innerHTML = "<?php echo $row->provinsi ?>";
		penginapan_input.appendChild(option_penginapan);
		<?php }
		?>

		<?php foreach ($tiket as $row) { ?>
		var option_tiket = document.createElement('option');
		option_tiket.setAttribute('value', '<?php echo $row->id?>' );
		option_tiket.innerHTML = "<?php echo $row->rute?>";
		tiket_input.appendChild(option_tiket);
		<?php }
		?>

		<?php foreach ($transport as $row) { ?>
		var option_transport = document.createElement('option');
		option_transport.setAttribute('value', '<?php echo $row->id?>' );
		option_transport.innerHTML = "<?php echo $row->provinsi ?>";
		transport_input.appendChild(option_transport);
		<?php }
		?>

		<?php foreach ($transport as $row) { ?>
		var option_transport2 = document.createElement('option');
		option_transport2.setAttribute('value', '<?php echo $row->id?>' );
		option_transport2.innerHTML = "<?php echo $row->provinsi ?>";
		transport2_input.appendChild(option_transport2);
		<?php }
		?>

		var hapus = document.createElement('span');

//                meng append element input
		tempat.appendChild(tempat_input);
		mulai.appendChild(mulai_input);
		akhir.appendChild(akhir_input);
		pegawai.appendChild(pegawai_input);
		harian.appendChild(harian_input);
		penginapan.appendChild(penginapan_input);
		tiket.appendChild(tiket_input);
		transport.appendChild(transport_input);
		transport2.appendChild(transport2_input);
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

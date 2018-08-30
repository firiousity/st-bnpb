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

//create default value for tanggal
$def_start_date = date('Y-m-d',
	mktime(0, 0, 0, date('m'), date('d') + 2, date('Y')));
$def_end_date = date('Y-m-d',
	mktime(0, 0, 0, date('m'), date('d') + 5, date('Y')));

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
					<thead class="mdb-color darken-3 white-text">
						<tr>
						<th class="th-sm" scope="col">Nomor Surat*</th>
						<th class="th-sm" scope="col">Kegiatan*</th>
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
							<td><input name="kegiatan" class="input-block-level form-control" required type="text"/></td>
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
								<?php foreach ($pos as $row) {
									echo "<option value='$row->idi'>$row->kegiatan</option>";
								}?>

						</td>
					</tr>
					</tbody>
				</table>
				<table class="table table-responsive">
					<!-- BAGIAN INI HANYA MUNCUL JIKA OPSI BANYAK TEMPAT TIDAK DI PILIH. -->
					<tbody id="itemgeneral" style="display: block">
					<tr>
						<td><label>Tanggal Mulai*</label><br/><input name="mulai" value="<?php echo $def_start_date ?>" class="input-block-level form-control"
																	 type="date"/></td>
						<td><label>Tanggal Akhir*</label><br/><input name="akhir" value="<?php echo $def_end_date ?>" class="input-block-level form-control"
																	type="date" /></td>
						<td style="display: block" id="moxspoy">
							<label>Nama Pegawai yang di tugaskan*</label><br/>
							<select multiple="multiple" id="moxs"  name="my-select[]">
								<?php foreach ($pegawai as $row) {
									echo
									"<option value='$row->id_pegawai'>$row->nama_pegawai</option>" ;
								}
								?>
							</select></td>
						<td><label>Nama Tempat*</label><br/><input name="tempat"  class="input-block-level form-control"
																  type="text"/></td>
					</tr>
					<tr>
						<td>
							<div class="form-group">
								<label >Uang Harian* </label>
								<select name="harian" class="form-control" >
									<option value=''>Pilih Uang Harian</option>
									<?php foreach ($harian as $row) {
										echo
										"<option value='$row->id'>$row->provinsi</option>" ;
									}
									?>
								</select>
							</div>
						</td>
						<td>
							<label >Uang Penginapan* </label>
							<div class="form-group">
								<select name="penginapan" class="form-control" >
									<option value=''>Pilih Uang Penginapan</option>
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
								<label >Tiket Pesawat* </label>
								<select name="tiket" class="form-control">
									<option value=''>Pilih Tiket</option>
									<?php foreach ($tiket as $row) {
										echo
										"<option value='$row->id'>$row->rute</option>" ;
									}
									?>
								</select>
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<label >Dari* </label>
							<div class="form-group">
								<select name="transport" class="form-control">
									<option value=''>Pilih Keberangkatan</option>
									<?php foreach ($transport as $row) {
										echo
										"<option value='$row->id'>$row->provinsi</option>" ;
									}
									?>
								</select>
							</div>
						</td>
						<td>
							<label >Ke: </label>
							<div class="form-group">
								<select name="transport2" class="form-control">
									<option value=''>Pilih Tujuan</option>
									<?php foreach ($transport as $row) {
										echo
										"
										<option value='$row->id'>$row->provinsi</option>" ;
									}
									?>
								</select>
							</div>
						</td>
						<td>
							<label >Tranport Lokal: </label>
							<div class="form-group">
								<select name="transport-lokal" class="form-control">
									<option value=''>Pilih Transport Lokal</option>
									<?php foreach ($lokal as $row) {
										echo
										"
										<option value='$row->id'>$row->provinsi - $row->kabupaten</option>" ;
									}
									?>
								</select>
							</div>
						</td>
					</tr>
					</tbody>
				</table>

				<table class="table table-responsive table-striped" width="100%">
					<!-- BAGIAN FORM DINAMIS INI AKAN MUNCUL JIKA USER MENGKLIK OPSI BANYAK TEMPAT-->
					<thead id="labelitemlist" class="mdb-color darken-3 white-text" style="display: none">
					</thead>

					<!--elemet sebagai target append-->
					<tbody id="itemlist" style="display: none;">
					<tr>
						<td><label>Tempat*</label><input name="tempat_input[0]" class="form-control" type="text"/></td>
						<td><label>Tanggal Mulai*</label><input name="mulai_input[0]"
															   value="<?php echo $def_start_date ?>" class="form-control"  type="date"/></td>
						<td><label>Tanggal Akhir*</label><input name="akhir_input[0]"
															   value="<?php echo $def_end_date ?>" class="form-control"  type="date"/></td>
						<td><label>Pegawai*</label><select  name="my-select-pegawai[0]" class="form-control">
								<option value=''>Pegawai</option>
								<?php foreach ($pegawai as $row) {
									echo
									"<option value='$row->id_pegawai'>$row->nama_pegawai</option>" ;
								}
								?>
							</select></td>
						<td>
							<label >Uang Harian* </label>
							<div>
								<select name="my-select-harian[0]" class="form-control" >
									<option value=''>Harian</option>
									<?php foreach ($harian as $row) {
										echo
										"<option value='$row->id'>$row->provinsi</option>" ;
									}
									?>
								</select>
							</div>
						</td>
						<td>
							<label >Uang Penginapan* </label>
							<div>
								<select name="my-select-penginapan[0]" class="form-control" >
									<option value=''>Penginapan</option>
									<?php foreach ($penginapan as $row) {
										echo
										"<option value='$row->id'>$row->provinsi</option>" ;
									}
									?>
								</select>
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<label >Tiket Pesawat* </label>
							<div>
								<select name="my-select-tiket[0]" class="form-control">
									<option value=''>Tiket Pesawat</option>
									<?php foreach ($tiket as $row) {
										echo
										"<option value='$row->id'>$row->rute</option>" ;
									}
									?>
								</select>
							</div>
						</td>
						<td>
							<label>Dari* </label>
							<div>
								<select name="my-select-transport[0]" class="form-control" >
									<option value=''>Keberangkatan</option>
									<?php foreach ($transport as $row) {
										echo
										"<option value='$row->id'>$row->provinsi</option>" ;
									}
									?>
								</select>
							</div>
						</td>
						<td>
							<label >Ke: </label>
							<div>
								<select name="my-select-transport2[0]" class="form-control">
									<option value=''>Tujuan</option>
									<?php foreach ($transport as $row) {
										echo
										"
									<option value='$row->id'>$row->provinsi</option>" ;
									}
									?>
								</select>
							</div>
						</td>
						<td>
							<label >Trasport Lokal: </label>
							<div>
								<select name="my-select-transport-lokal[0]" class="form-control">
									<option value=''>Transport Lokal</option>
									<?php foreach ($lokal as $row) {
										echo
										"
										<option value='$row->id'>$row->provinsi - $row->kabupaten</option>" ;
									}
									?>
								</select>
							</div>
						</td>
					</tr>
					</tbody>					
				</table>
				<div style="float: right;">
							<button class="btn btn-primary" id="btn_tambah" disabled onclick="additem(); return false"><i class="fas fa-plus"></i></i></button>
							<button name="submit" type="submit" class="btn btn-indigo"><i class="fas fa-check"></i> Buat</button>
						</div>
			</form>
	</div>
	
<!--Multiselect JavaScript -->
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.multi-select.js')?>"></script>
</div>
			
<script>

	var i = 1;
	function additem() {

		//remove required attributes
		// $("#my-select", "tiket", "tempat", "harian", "penginapan", "transport").setAttribute('reqired', 'false');
//                menentukan target append
		var itemlist = document.getElementById('itemlist');

//                membuat element
		var row = document.createElement('tr');
		var row2 = document.createElement('tr');
		var tempat = document.createElement('td');
		var mulai = document.createElement('td');
		var akhir = document.createElement('td');
		var pegawai = document.createElement('td');
		var harian = document.createElement('td');
		var penginapan = document.createElement('td');
		var tiket = document.createElement('td');
		var transport = document.createElement('td');
		var transport2 = document.createElement('td');
		var transport_lokal = document.createElement('td');
		var aksi = document.createElement('td');


//                meng append element
		itemlist.appendChild(row);
		itemlist.appendChild(row2);
		row.appendChild(tempat);
		row.appendChild(mulai);
		row.appendChild(akhir);
		row.appendChild(pegawai);
		row.appendChild(harian);
		row.appendChild(penginapan);
		row2.appendChild(tiket);
		row2.appendChild(transport);
		row2.appendChild(transport2);
		row2.appendChild(transport_lokal);
		row2.appendChild(aksi);

		var tempat_input = document.createElement('input');
		tempat_input.setAttribute('name', 'tempat_input[' + i + ']');
		tempat_input.setAttribute('class', 'form-control');
		tempat_input.setAttribute('placeholder', 'Tempat ');
		tempat_input.setAttribute('type', 'text');

		var mulai_input = document.createElement('input');
		mulai_input.setAttribute('name', 'mulai_input[' + i + ']');
		mulai_input.setAttribute('class', 'form-control');
		mulai_input.setAttribute('type', 'date');

		var akhir_input = document.createElement('input');
		akhir_input.setAttribute('name', 'akhir_input[' + i + ']');
		akhir_input.setAttribute('class', 'form-control');
		akhir_input.setAttribute('type', 'date');

		var pegawai_input = document.createElement('select');
		pegawai_input.setAttribute('name', 'my-select-pegawai['+ i +']');
		pegawai_input.setAttribute('class', 'form-control');

		var harian_input = document.createElement('select');
		harian_input.setAttribute('name', 'my-select-harian['+ i +']');
		harian_input.setAttribute('class', 'form-control');

		var penginapan_input = document.createElement('select');
		penginapan_input.setAttribute('name', 'my-select-penginapan['+ i +']');
		penginapan_input.setAttribute('class', 'form-control');

		var tiket_input = document.createElement('select');
		tiket_input.setAttribute('name', 'my-select-tiket['+ i +']');
		tiket_input.setAttribute('class', 'form-control');

		var transport_input = document.createElement('select');
		transport_input.setAttribute('name', 'my-select-transport['+ i +']');
		transport_input.setAttribute('class', 'form-control');

		var transport2_input = document.createElement('select');
		transport2_input.setAttribute('name', 'my-select-transport2['+ i +']');
		transport2_input.setAttribute('class', 'form-control');

		var transport_lokal_input = document.createElement('select');
		transport_lokal_input.setAttribute('name', 'my-select-transport-lokal['+ i +']');
		transport_lokal_input.setAttribute('class', 'form-control');

		var option_pegawai_hint = document.createElement('option');
		option_pegawai_hint.setAttribute('value', '' );
		option_pegawai_hint.innerHTML = "Pegawai";
		pegawai_input.appendChild(option_pegawai_hint);
		<?php foreach ($pegawai as $row) { ?>
		var option_pegawai = document.createElement('option');
		option_pegawai.setAttribute('value', '<?php echo $row->id_pegawai?>' );
		option_pegawai.innerHTML = "<?php echo $row->nama_pegawai ?>";
		pegawai_input.appendChild(option_pegawai);
		<?php }
		?>

		var option_harian_hint = document.createElement('option');
		option_harian_hint.setAttribute('value', '' );
		option_harian_hint.innerHTML = "Harian";
		harian_input.appendChild(option_harian_hint);
		<?php foreach ($harian as $row) { ?>
		var option_harian = document.createElement('option');
		option_harian.setAttribute('value', '<?php echo $row->id?>' );
		option_harian.innerHTML = "<?php echo $row->provinsi ?>";
		harian_input.appendChild(option_harian);
		<?php }
		?>

		var option_penginapan_hint = document.createElement('option');
		option_penginapan_hint.setAttribute('value', '' );
		option_penginapan_hint.innerHTML = "Penginapan";
		penginapan_input.appendChild(option_penginapan_hint);
		<?php foreach ($penginapan as $row) { ?>
		var option_penginapan = document.createElement('option');
		option_penginapan.setAttribute('value', '<?php echo $row->id?>' );
		option_penginapan.innerHTML = "<?php echo $row->provinsi ?>";
		penginapan_input.appendChild(option_penginapan);
		<?php }
		?>

		var option_tiket_hint = document.createElement('option');
		option_tiket_hint.setAttribute('value', '' );
		option_tiket_hint.innerHTML = "Tiket Pesawat";
		tiket_input.appendChild(option_tiket_hint);
		<?php foreach ($tiket as $row) { ?>
		var option_tiket = document.createElement('option');
		option_tiket.setAttribute('value', '<?php echo $row->id?>' );
		option_tiket.innerHTML = "<?php echo $row->rute?>";
		tiket_input.appendChild(option_tiket);
		<?php }
		?>

		var option_transport_hint = document.createElement('option');
		option_transport_hint.setAttribute('value', '' );
		option_transport_hint.innerHTML = "Keberangkatan";
		transport_input.appendChild(option_transport_hint);
		<?php foreach ($transport as $row) { ?>
		var option_transport = document.createElement('option');
		option_transport.setAttribute('value', '<?php echo $row->id?>' );
		option_transport.innerHTML = "<?php echo $row->provinsi ?>";
		transport_input.appendChild(option_transport);
		<?php }
		?>

		var option_transport2_hint = document.createElement('option');
		option_transport2_hint.setAttribute('value', '' );
		option_transport2_hint.innerHTML = "Tujuan";
		transport2_input.appendChild(option_transport2_hint);
		<?php foreach ($transport as $row) { ?>
		var option_transport2 = document.createElement('option');
		option_transport2.setAttribute('value', '<?php echo $row->id?>' );
		option_transport2.innerHTML = "<?php echo $row->provinsi ?>";
		transport2_input.appendChild(option_transport2);
		<?php }
		?>

		var option_transport_lokal_hint = document.createElement('option');
		option_transport_lokal_hint.setAttribute('value', '' );
		option_transport_lokal_hint.innerHTML = "Transport Lokal";
		transport_lokal_input.appendChild(option_transport_lokal_hint);
		<?php foreach ($lokal as $row) { ?>
		var option_transport_lokal = document.createElement('option');
		option_transport_lokal.setAttribute('value', '<?php echo $row->id?>' );
		option_transport_lokal.innerHTML = "<?php echo $row->provinsi."-".$row->kabupaten ?>";
		transport_lokal_input.appendChild(option_transport_lokal);
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
		transport_lokal.appendChild(transport_lokal_input);
		aksi.appendChild(hapus);

		hapus.innerHTML = '<button class="btn btn-small btn-default"><i class="fas fa-trash-alt"></i></button>';
//                membuat aksi delete element
		hapus.onclick = function () {
			row2.parentNode.removeChild(row2);
			row.parentNode.removeChild(row);
			i--;
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

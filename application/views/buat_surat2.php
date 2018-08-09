<?php
$tanggal = date("m");
$tahun = date("Y");

/*
 *
 * Get last index of nomor surat
 */
//$json = json_encode($nomor);
//$json = substr($json, -28,-3)
$json = $nomor[0]->nomor;
$json = (int) $json;
$json = $json + 1;
$nomor_surat = $json."/KADIH/".$tanggal."/".$tahun;

?>
<body>
	<div class="container margin">
		<div class="card mb-6">
			<h1>
				<?php ?>
			</h1>
			<!-- Default form contact -->
			<form class="needs-validation" novalidate style="margin: 1%" action="exec_buat_surat" method="post">
				<h2 class="judul">DESKRIPSI UMUM</h2>
				<div class="form-row">
					<div class="col-md-4 mb-3">
						<label for="validationCustom01">Nomor</label>
						<input type="text" class="form-control" name="nomor" id="validationCustom01" placeholder="<?php echo $nomor_surat ?>"
							   value="<?php echo $nomor_surat ?>" required>
					</div>
					<div class="col-md-4 mb-3">
						<label for="validationCustom02">Kegiatan</label>
						<input type="text" class="form-control" id="validationCustom02" name="kegiatan" placeholder="Nama Kegiatan" required autofocus>

					</div>
					<div class="col-md-4 mb-3">
						<label for="validationCustomUsername">Tempat</label>
							<input type="text" class="form-control" id="validationCustom02"
								   name="tempat" placeholder="Dinas ke..." required>

					</div>
				</div>
				<div class="form-row">
					<div class="col-md-4 mb-3">
						<label>Tanggal Mulai</label>
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text" id="inputGroupPrepend"><i class="fa fa-calendar"></i> </span>
							</div>
							<input type="date" class="form-control" id="validationCustomTanggalMulai" name="tgl_mulai" placeholder="Tanggal mulai"
								   aria-describedby="inputGroupPrepend" required>
						</div>
					</div>
					<div class="col-md-4 mb-3">
						<label >Tanggal Akhir</label>
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text" id="inputGroupPrepend"><i class="fa fa-calendar"></i> </span>
							</div>
							<input type="date" class="form-control" id="validationCustomTanggalAkhir" name="tgl_akhir" placeholder="Tanggal berakhir"
								   aria-describedby="inputGroupPrepend" required>
						</div>
					</div>
					<div class="col-md-4 mb-3">
						<label >Jenis Surat</label>
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fa fa-magic"></i> </span>
							</div>
							<select name="jenis" class="custom-select custom-select-lg ">
								<option selected>Jenis Pembayaran Uang</option>
								<option value="1">Langsung</option>
								<option value="2">Reimburse</option>
							</select>
						</div>
					</div>
				</div>
				<div class="form-row">
					<div class="col">
						<label >Nama Pegawai yang ditugaskan: </label>
						<div class="input-group">
							<select multiple="multiple" id="my-select" name="my-select[]">
								<?php foreach ($pegawai as $row) {
								echo
									"<option value='$row->id_pegawai'>$row->nama_pegawai</option>" ;
								}
								?>
							</select>
						</div>
					</div>
				</div>
				<h2 class="judul">RINCIAN BIAYA</h2>
				<div class="form-row">
					<div class="col">
						<label >Uang Harian: </label>
						<div class="input-group">
							<select multiple="multiple" id="my-select-harian" name="my-select-harian[]">
								<?php foreach ($harian as $row) {
									echo
									"<option value='$row->luar_kota'>$row->provinsi</option>" ;
								}
								?>
							</select>
						</div>
					</div>
					<div class="col">
						<label >Uang Penginapan: </label>
						<div class="input-group">
							<select multiple="multiple" id="my-select-penginapan" name="my-select-penginapan[]">
								<?php foreach ($penginapan as $row) {
									echo
									"<option value='$row->eselon_4'>$row->provinsi</option>" ;
								}
								?>
							</select>
						</div>
					</div>

					<div class="col">
						<label >Tiket Pesawat: </label>
						<div class="input-group">
							<select multiple="multiple" id="my-select-tiket" name="my-select-tiket[]">
								<?php foreach ($tiket as $row) {
									echo
									"<option value='$row->biaya_tiket'>$row->rute</option>" ;
								}
								?>
							</select>
						</div>
					</div>
					<div class="col">
						<label >Uang Transportasi: </label>
						<div class="input-group">
							<select multiple="multiple" id="my-select-transport" name="my-select-transport[]">
								<?php foreach ($transport as $row) {
									echo
									"<option value='$row->besaran'>$row->provinsi</option>" ;
								}
								?>
							</select>
						</div>
					</div>
				</div>

				<button class="btn btn-indigo" type="submit">Buat Surat</button>
			</form>
		</div>

	</div>
</body>
<script type="text/javascript">
	// Example starter JavaScript for disabling form submissions if there are invalid fields
	$('#my-select').multiSelect();
	$('#my-select-tiket').multiSelect();
	$('#my-select-harian').multiSelect();
	$('#my-select-penginapan').multiSelect();
	$('#my-select-transport').multiSelect();
</script>


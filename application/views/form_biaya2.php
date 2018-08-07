<?php
$tanggal = date("m");
$tahun = date("Y");

/*
 *
 * Get last index of nomor surat
 */
//$json = json_encode($nomor);
//$json = substr($json, -28,-3)
/*$json = $nomor[0]->nomor;
$json = (int) $json;
$json = $json + 1;
$nomor_surat = $json."/KADIH/".$tanggal."/".$tahun;*/

?>
<body>
	<div class="container margin">
		<div class="card mb-6">
			<h1>
				<?php ?>
			</h1>
			<!-- Default form contact -->
			<form class="needs-validation" novalidate style="margin: 1%" action="exec_buat_surat" method="post">
				<h2 class="judul">ISI BIAYA PERJALANAN DINAS</h2>
				<div class="form-row">
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
									"<option value='$row->biaya_tiket'>$row->kota</option>" ;
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


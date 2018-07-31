<?php
/**
 * Created by PhpStorm.
 * User: MNurilmanBaehaqi
 * Date: 7/31/2018
 * Time: 8:45 AM
 */
?>
<body>
	<div class="container">
		<!-- Default form contact -->
		<form class="text-center border border-light p-5" method="post">

			<p class="h4 mb-4">Buat Surat</p>
			<div class="card">
				<div class="card-body">
					<!-- Name -->
					<input type="text" id="defaultContactFormName" class="form-control mb-4" name="nomor" value="<?php  $nomor_surat ?>">

					<!-- Tempat Dinas -->
					<input type="text" id="defaultContactFormEmail" class="form-control mb-4" name="tempat" placeholder="Dinas ke...">
					<!-- Kegiatan -->
					<input type="text" id="defaultContactFormEmail" class="form-control mb-4" name="kegiatan" placeholder="Kegiatan">

					<!-- Jenis -->
					<label>Jenis Surat</label>
					<select class="browser-default custom-select mb-4" name="jenis">
						<option value="" disabled>Jenis Surat...</option>
						<option value="1" selected>Uang di Depan</option>
						<option value="2">Uang di Akhir</option>
					</select>

					<!-- Start tanggal -->
					<label>Tanggal Mulai </label>
					<input placeholder="Mulai" name="awal_tanggal" type="date"  class="form-control datepicker">

					<!-- End tanggal -->
					<label>Tanggal Akhir</label>
					<input placeholder="Akhir" name="akhir_tanggal" type="date"  class="form-control datepicker">

					<!-- Send button -->
					<button class="btn btn-info btn-block" type="submit">Buat</button>
				</div>
			</div>
		</form>
		<!-- Default form contact -->
	</div>
</body>

